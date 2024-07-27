<?php
/**
 * Class FilterCourseRatingTemplate
 *
 * Filter course by rating
 * @since 4.1.2
 * @version 1.0.0
 */

use LearnPress\Helpers\Singleton;
use LearnPress\Helpers\Template;
use LearnPress\TemplateHooks\Course\FilterCourseTemplate;

class FilterCourseRatingTemplate {
	use Singleton;

	public function init() {
		//add field to widget settings
		add_filter( 'learn-press/widget/course-filter/settings', [ $this, 'add_course_filter_widget_fields' ] );
		// add html to filter course widget
		add_action( 'learn-press/filter-courses/sections/field/html', [ $this, 'filter_section_field' ], 10, 4 );
		// handle query course
		add_filter( 'learn-press/courses/handle_params_for_query_courses', [ $this, 'handle_filter_params_c_review_star' ], 10, 2 );
		// add rating to course archive page
		add_filter( 'learn-press/list-courses/layout/item/section/bottom/meta', [ $this, 'courses_rating_item' ], 10, 3 );
		// Add sort by rating to course archive page
		add_filter( 'learn-press/courses/order-by/values', [ $this, 'add_sort_by_rating' ] );
		// Query order by rating
		add_filter( 'lp/courses/filter/order_by/rating', [ $this, 'query_order_by_rating' ] );
	}

	/**
	 * add widget setting fields
	 * @param array $settings course filter setting fields
	 */
	public function add_course_filter_widget_fields( array $settings ): array {
		$fields = [];
		foreach ( $settings['fields']['options'] as $key => $value ) {
			$fields[ $key ] = $value;
			if ( 'level' === $key ) {
				$fields['course_review'] = [
					'id'    => 'course_review',
					'label' => esc_html__( 'Course Reviews', 'learnpress' ),
				];
			}
		}
		$settings['fields']['options'] = $fields;

		$order_fields = [];
		foreach ( $settings['fields']['std'] as $value ) {
			$order_fields[] = $value;
			if ( 'level' === $value ) {
				$order_fields[] = 'course_review';
			}
		}
		$settings['fields']['std'] = $order_fields;

		return $settings;
	}

	/**
	 * filter_section_field add html to course filter widget
	 * @param  array &$sections
	 * @param  string $field    filter field
	 * @param  array $data      FilterCourseTemplate $data
	 */
	public function filter_section_field( &$sections, $field, $data ) {
		if ( $field == 'course_review' ) {
			$sections[ $field ] = [ 'text_html' => self::html_filter_course_review( $data ) ];
		}
	}

	/**
	 * Html course review field
	 *
	 * @param  array $data
	 * @return string html
	 */
	public static function html_filter_course_review( array $data = [] ): string {
		$content = '';
		try {
			$html_wrapper = apply_filters(
				'learn-press/filter-courses/sections/review/wrapper',
				[
					'<div class="lp-field-star">' => '</div>',
				],
				$data
			);

			FilterCourseTemplate::instance()->check_param_url_has_lang( $data );
			$params_url    = $data['params_url'] ?? [];
			$data_selected = $params_url['c_review_star'] ?? '';
			ob_start();

			for ( $i = 0; $i < 5; $i ++ ) {
				$checked = checked( $data_selected, $i, false );
				?>
				<div class="lp-course-filter__field">
					<input type="radio" name="c_review_star" id="review-star-<?php echo $i; ?>"
						   value="<?php echo $i; ?>" <?php echo $checked; ?>/>
					<?php
					if ( 0 === $i ) {
						echo esc_html__( 'All rating', 'learnpress-course-review' );
					} else {
						$args = [ 'rated' => $i ];
						echo sprintf( '<div class="lp-filter-item-star review-star-%d">', $i );
						//echo sprintf( '%s %s & up', $i, _n( 'star', 'stars', $i, 'learnpress-course-review' ) );
						Template::instance()->get_template( LP_ADDON_COURSE_REVIEW_TMPL . 'rating-stars.php', $args );
						echo sprintf( '<span>%s</span>', __( '& up', 'learnpress-course-review' ) );
						echo '</div>';
					}
					?>
				</div>
				<?php
			}

			$content = ob_get_clean();
			$content = Template::instance()->nest_elements( $html_wrapper, $content );
			$content = FilterCourseTemplate::instance()->html_item( esc_html__( 'Rating', 'learnpress-course-review' ), $content );
		} catch ( Throwable $e ) {
			ob_end_clean();
			error_log( __METHOD__ . '-' . $e->getMessage() );
		}

		return $content;
	}

	public function handle_filter_params_c_review_star( LP_Course_Filter $filter, array $params ) {
		// error_log('params-'.json_encode($params));
		if ( ! empty( $params['c_review_star'] ) ) {
			$lp_course_db    = LP_Course_DB::getInstance();
			$tb_postmeta     = $lp_course_db->tb_postmeta;
			$filter->join[]  = "INNER JOIN $tb_postmeta AS pmrated ON p.ID = pmrated.post_id";
			$filter->where[] = $lp_course_db->wpdb->prepare( 'AND pmrated.meta_key = %s', LP_Addon_Course_Review::META_KEY_RATING_AVERAGE );
			$filter->where[] = $lp_course_db->wpdb->prepare( 'AND pmrated.meta_value >= %d', intval( $params['c_review_star'] ) );
		}
	}

	/**
	 * Show star review in course item
	 *
	 * @param array $course_meta
	 * @param LP_Course $course
	 * @param array $settings
	 *
	 * @return array
	 */
	public function courses_rating_item( array $course_meta, LP_Course $course, array $settings ): array {
		$course_average_review = (float) get_post_meta( $course->get_id(), LP_Addon_Course_Review::META_KEY_RATING_AVERAGE, true );
		if ( empty( $course_average_review ) ) {
			return $course_meta;
		}

		$args = [
			'rated' => (float) number_format( $course_average_review, 1 )
		];

		ob_start();
		Template::instance()->get_template( LP_ADDON_COURSE_REVIEW_TMPL . 'rating-stars.php', $args );
		$html = ob_get_clean();

		$wrapper                      = [ '<div class="review-stars-rated">' => '</div>' ];
		$course_meta['course_rating'] = [
			'course_rating' => Template::instance()->nest_elements( $wrapper, $html )
		];

		return $course_meta;
	}

	/**
	 * Show option sort by rating
	 * @param array $list_order_by
	 *
	 * @return array
	 */
	public function add_sort_by_rating( array $list_order_by = [] ): array {
		$list_order_by['rating'] = esc_html__( 'Average Ratings', 'learnpress-course-review' );

		return $list_order_by;
	}

	/**
	 * Query order by rating
	 *
	 * @param LP_Course_Filter $filter
	 *
	 * @return LP_Course_Filter
	 */
	public function query_order_by_rating( LP_Course_Filter $filter ): LP_Course_Filter {
		$lp_course_db     = LP_Course_DB::getInstance();
		$filter->join[]   = "INNER JOIN $lp_course_db->tb_postmeta AS rpm ON p.ID = rpm.post_id";
		$filter->where[]  = $lp_course_db->wpdb->prepare( 'AND rpm.meta_key = %s', LP_Addon_Course_Review::META_KEY_RATING_AVERAGE );
		$filter->order_by = 'rpm.meta_value';
		$filter->order    = 'DESC';

		return $filter;

	}
}
