<?php
/**
 * Course review widget class.
 *
 * @author   ThimPress
 * @package  LearnPress/Course-Review/Classes
 * @version  3.0.2
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

// Creating the widget
class LearnPress_Course_Review_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'lpr_course_review',
			__( 'LearnPress - Course Review', 'learnpress-course-review' ),
			array( 'description' => __( 'Display ratings and reviews of course', 'learnpress-course-review' ) )
		);
		add_action(
			'wp_ajax_learnpress_reviews_search_course',
			array(
				__CLASS__,
				'learnpress_reviews_search_course',
			)
		);

		add_action( 'admin_footer', array( $this, 'footer_js' ) );
	}

	/**
	 *
	 */
	public static function learnpress_reviews_search_course() {
		$return = array();

		// you can use WP_Query, query_posts() or get_posts() here - it doesn't matter
		$search_results = new WP_Query(
			array(
				's'                   => $_GET['q'], // the search query
				'post_status'         => 'publish', // if you don't want drafts to be returned
				'ignore_sticky_posts' => 1,
				'post_type'           => LP_COURSE_CPT,
				'posts_per_page'      => 50, // how much to show at once
			)
		);
		if ( $search_results->have_posts() ) :
			while ( $search_results->have_posts() ) :
				$search_results->the_post();
				// shorten the title a little
				$title    = ( mb_strlen( $search_results->post->post_title ) > 50 ) ? mb_substr( $search_results->post->post_title, 0, 49 ) . '...' : $search_results->post->post_title;
				$return[] = array( $search_results->post->ID, $title ); // array( Post ID, Post Title )
			endwhile;
		endif;
		echo json_encode( $return );
		die;
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		wp_enqueue_script( 'course-review' );
		wp_enqueue_style( 'course-review' );
		$title = apply_filters( 'widget_title', $instance['title'] ?? '' );
		echo $args['before_widget'] ?? '';

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$user      = learn_press_get_current_user();
		$course_id = $instance['course_id'] ?? 0;
		if ( ! $course_id ) {
			$course_id = get_the_ID();
		}
		$setting = $instance;

		$data_for_template = compact( 'course_id', 'user', 'setting' );
		if ( 'yes' === $instance['show_rate'] ) {
			$course_rate_res                      = learn_press_get_course_rate( $course_id, false );
			$data_for_template['course_rate_res'] = $course_rate_res;
		}
		if ( 'yes' === $instance['show_review'] ) {
			$course_review                      = learn_press_get_course_review( $course_id, 1 );
			$data_for_template['course_review'] = $course_review;
		}

		ob_start();
		LP_Addon_Course_Review_Preload::$addon->get_template(
			'list-rating-reviews.php',
			[ 'data' => $data_for_template ]
		);

		$content = ob_get_clean();
		echo $content;
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title          = isset( $instance['title'] ) ? $instance['title'] : __( 'New title', 'wpb_widget_domain' );
		$course_id      = isset( $instance['course_id'] ) ? $instance['course_id'] : '';
		$show_rate      = isset( $instance['show_rate'] ) ? $instance['show_rate'] : 'no';
		$show_review    = isset( $instance['show_review'] ) ? $instance['show_review'] : 'no';
		$display_amount = isset( $instance['display_amount'] ) ? $instance['display_amount'] : 5;
		if ( $course_id ) {
			$checked      = "selected='selected'";
			$review_title = get_the_title( $course_id );
			$option       = "<option value='{$course_id}' {$checked}>{$review_title}</option>";
		} else {
			$option = "<option value='0'>" . __( 'Pick up 1 course', 'learnpress-course-review' ) . '</option>';
		}
		// Reset Post Data
		wp_reset_postdata();
		wp_enqueue_script( 'select2' );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'learnpress-course-review' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
					name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
					value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<div class="rwmb-input">
			<label for="<?php echo $this->get_field_id( 'course_id' ); ?>"><?php _e( 'Course Id:', 'learnpress-course-review' ); ?></label>
			<select class="rwmb-select " name="<?php echo $this->get_field_name( 'course_id' ); ?>"
					id="<?php echo $this->get_field_id( 'course_id' ); ?>">
				<?php echo $option; ?>
			</select>
		</div>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_rate' ); ?>"><?php _e( 'Show Rate:', 'learnpress-course-review' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'show_rate' ); ?>"
					name="<?php echo $this->get_field_name( 'show_rate' ); ?>" type="checkbox"
					value="yes" <?php checked( $show_rate, 'yes', true ); ?>/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_review' ); ?>"><?php _e( 'Show Review:', 'learnpress-course-review' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'show_review' ); ?>"
					name="<?php echo $this->get_field_name( 'show_review' ); ?>" type="checkbox"
					value="yes" <?php checked( $show_review, 'yes', true ); ?> />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'display_amount' ); ?>"><?php _e( 'Amount Display:', 'learnpress-course-review' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'display_amount' ); ?>"
					name="<?php echo $this->get_field_name( 'display_amount' ); ?>" type="number"
					value="<?php echo esc_attr( $display_amount ); ?>"/>
		</p>

		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;
		$instance['title']          = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['course_id']      = ( ! empty( $new_instance['course_id'] ) ) ? strip_tags( $new_instance['course_id'] ) : '';
		$instance['show_rate']      = ( ! empty( $new_instance['show_rate'] ) ) ? strip_tags( $new_instance['show_rate'] ) : '';
		$instance['show_review']    = ( ! empty( $new_instance['show_review'] ) ) ? strip_tags( $new_instance['show_review'] ) : '';
		$instance['display_amount'] = ( ! empty( $new_instance['display_amount'] ) ) ? strip_tags( $new_instance['display_amount'] ) : 5;

		return $instance;
	}

	public function footer_js() {
		?>
		<script>
			jQuery(function ($) {
				function initWidget(widget) {
					$(widget).find('select[id*="course_id"]').select2({
						placeholder: '<?php esc_attr_e( 'Select a course', 'learnpress-course-review' ); ?>',
						minimumInputLength: 3,
						ajax: {
							url: ajaxurl,
							dataType: 'json',
							quietMillis: 250,
							data: function (params) {
								return {
									q: params.term, // search term
									action: 'learnpress_reviews_search_course'
								};
							},
							processResults: function (data) {
								var options = [];
								if (data) {

									// data is the array of arrays, and each of them contains ID and the Label of the option
									$.each(data, function (index, text) { // do not forget that "index" is just auto incremented value
										options.push({id: text[0], text: text[1]});
									});

								}
								return {
									results: options
								};
							},
							cache: true
						},
						language: {
							noResults: function (params) {
								return '<?php esc_attr_e( 'There is no course to select.', 'learnpress-course-review' ); ?>';
							}
						}
					});
				}

				// Init select2 on widgets are existed
				$('#widgets-right').find('[id*="_lpr_course_review"]').each(function () {
					initWidget(this);
				})

				// Init select2 on new widget after added to sidebar
				// Or after press Save button
				$(document).on('widget-updated widget-added', function (e, el) {
					initWidget(el);
				});
			});
		</script>
		<?php
	}
}
