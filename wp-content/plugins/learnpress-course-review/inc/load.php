<?php
/**
 * Plugin load class.
 *
 * @author   ThimPress
 * @package  LearnPress/Course-Review/Classes
 * @version  3.0.2
 */

// Prevent loading this file directly
use LearnPress\Helpers\Template;
use LearnPress\Models\CourseModel;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Addon_Course_Review' ) ) {
	/**
	 * Class LP_Addon_Course_Review.
	 */
	class LP_Addon_Course_Review extends LP_Addon {
		/**
		 * @var string
		 */
		public $version = LP_ADDON_COURSE_REVIEW_VER;
		/**
		 * @var string
		 */
		public $require_version = LP_ADDON_COURSE_REVIEW_REQUIRE_VER;
		/**
		 * Path file addon
		 *
		 * @var string
		 */
		public $plugin_file = LP_ADDON_COURSE_REVIEW_FILE;

		/**
		 * @var string
		 */
		private static $comment_type = 'review';

		const META_KEY_RATING_AVERAGE = 'lp_course_rating_average';

		/**
		 * LP_Addon_Course_Review constructor.
		 */
		public function __construct() {
			parent::__construct();
			add_action( 'widgets_init', array( $this, 'load_widget' ) );
		}

		/**
		 * Define Learnpress Course Review constants.
		 *
		 * @since 3.0.0
		 */
		protected function _define_constants() {
			define( 'LP_ADDON_COURSE_REVIEW_PATH', dirname( LP_ADDON_COURSE_REVIEW_FILE ) );
			define( 'LP_ADDON_COURSE_REVIEW_PER_PAGE', apply_filters( 'learn-press/course-review/per-page', 5 ) );
			define( 'LP_ADDON_COURSE_REVIEW_TMPL', LP_ADDON_COURSE_REVIEW_PATH . '/templates/' );
			//define( 'LP_ADDON_COURSE_REVIEW_THEME_TMPL', learn_press_template_path() . '/addons/course-review/' );
			define( 'LP_ADDON_COURSE_REVIEW_URL', untrailingslashit( plugins_url( '/', __DIR__ ) ) );
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @since 3.0.0
		 */
		protected function _includes() {
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/class-lp-course-review-cache.php';
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/databases/class-lp-course-reviews-db.php';
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/functions.php';
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/widgets.php';
			// Rest API
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/rest-api/jwt/class-lp-rest-review-v1-controller.php';
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/rest-api/class-lp-rest-courses-reviews-controller.php';
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/rest-api/class-rest-api.php';
			// Template hooks
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/template-hooks/list-rating-reviews.php';
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/template-hooks/filter-course-rating.php';
			FilterCourseRatingTemplate::instance();
			require_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/background/class-lp-course-review-background.php';
		}

		/**
		 * Init hooks.
		 */
		protected function _init_hooks() {
			//api v2
			add_filter(
				'learn-press/core-api/controllers',
				function ( $controller ) {
					$controller[] = 'LP_REST_Courses_Reviews_Controller';
					return $controller;
				}
			);

			add_filter( 'learn-press/course-tabs', array( $this, 'add_course_tab_reviews' ), 5 );

			add_action( 'wp_enqueue_scripts', array( $this, 'review_assets' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_assets' ) );
			//LP_Request::register_ajax( 'add_review', array( $this, 'add_review' ) );
			add_shortcode( 'learn_press_review', array( $this, 'shortcode_review' ) );
			// Clear cache when update comment. (Approve|Unapprove|Edit|Spam|Trash)
			add_action(
				'wp_set_comment_status',
				function ( $comment_id ) {
					$comment = get_comment( $comment_id );
					if ( ! $comment ) {
						return;
					}

					$post_id = $comment->comment_post_ID;
					if ( LP_COURSE_CPT !== get_post_type( $post_id ) ) {
						return;
					}

					$lp_course_reviews_cache = new LP_Course_Review_Cache( true );
					$lp_course_reviews_cache->clean_rating( $post_id );
				}
			);
			add_filter( 'learnPress/prepare_struct_courses_response/courseObjPrepare', [ $this, 'rest_api_courses' ], 10, 2 );

			$this->init_comment_table();
			$this->calculate_rating_average_courses();
		}

		/**
		 * Admin assets.
		 * @since 4.0.0
		 * @version 1.0.1
		 */
		public function admin_enqueue_assets() {
			$is_rtl = is_rtl() ? '-rtl' : '';
			$min    = '.min';
			$v      = LP_ADDON_COURSE_REVIEW_VER;
			if ( LP_Debug::is_debug() ) {
				$v   = rand();
				$min = '';
			}

			wp_enqueue_style( 'course-review', LP_ADDON_COURSE_REVIEW_URL . "/assets/css/admin{$is_rtl}{$min}.css", [], $v );
		}

		/**
		 * Single course assets.
		 *
		 * @since 4.0.0
		 * @version 1.0.2
		 */
		public function review_assets() {
			$is_rtl = is_rtl() ? '-rtl' : '';
			$min    = '.min';
			$v      = LP_ADDON_COURSE_REVIEW_VER;
			if ( LP_Debug::is_debug() ) {
				$v   = rand();
				$min = '';
			}

			wp_register_style(
				'course-review',
				LP_Addon_Course_Review_Preload::$addon->get_plugin_url( "assets/css/course-review{$is_rtl}{$min}.css" ),
				[],
				$v
			);
			wp_register_script(
				'course-review',
				LP_Addon_Course_Review_Preload::$addon->get_plugin_url( "assets/js/course-review-v2{$min}.js" ),
				[],
				$v,
				[
					'strategy'  => 'defer',
				]
			);

			if ( LP_PAGE_SINGLE_COURSE === LP_Page_Controller::page_current() ) {
				wp_enqueue_script( 'course-review' );
				//wp_enqueue_style( 'course-review' );

				wp_localize_script(
					'course-review',
					'learn_press_course_review',
					array(
						'localize' => array(
							'empty_title'   => __( 'Please enter the review title', 'learnpress-course-review' ),
							'empty_content' => __( 'Please enter the review content', 'learnpress-course-review' ),
							'empty_rating'  => __( 'Please select your rating', 'learnpress-course-review' ),
						),
					)
				);
			}
		}

		/**
		 * Check if not register style, load style inline.
		 *
		 * @return void
		 * @since 4.1.2
		 * @version 1.0.0
		 */
		public function check_load_file_style() {
			if ( wp_style_is( 'course-review', 'registered' ) ) {
				wp_enqueue_style( 'course-review' );
			} else {
				$is_rtl = is_rtl() ? '-rtl' : '';
				$min    = '.min';
				if ( LP_Debug::is_debug() ) {
					$min = '';
				}

				$file_style = LP_Addon_Course_Review_Preload::$addon->get_plugin_url( "assets/css/course-review{$is_rtl}{$min}.css" );
				wp_register_style( 'course-review', $file_style, [], LP_ADDON_COURSE_REVIEW_VER );
				?>
				<style id="lp-course-review-star-style">
					<?php echo wp_remote_fopen( $file_style ); ?>
				</style>
				<?php
			}
		}

		public function exclude_rating( $query ) {
			$query->query_vars['type__not_in'] = 'review';
		}

		/**
		 * @deprecated 4.1.2
		 */
		public function add_review() {
			_deprecated_function( __METHOD__, '4.1.2' );
			$response = array( 'result' => 'success' );
			$nonce    = ! empty( $_REQUEST['review_nonce'] ) ? $_REQUEST['review_nonce'] : '';
			$id       = ! empty( $_REQUEST['comment_post_ID'] ) ? absint( $_REQUEST['comment_post_ID'] ) : 0;
			$rate     = ! empty( $_REQUEST['rating'] ) ? $_REQUEST['rating'] : '0';
			$title    = ! empty( $_REQUEST['review_title'] ) ? $_REQUEST['review_title'] : '';
			$content  = ! empty( $_REQUEST['review_content'] ) ? $_REQUEST['review_content'] : '';

			if ( wp_verify_nonce( $nonce, 'learn_press_course_review_' . $id ) ) {
				$response['result']  = 'fail';
				$response['message'] = __( 'Error', 'learnpress-course-review' );
			}

			if ( get_post_type( $id ) != 'lp_course' ) {
				$response['result']  = 'fail';
				$response['message'] = __( 'Invalid course', 'learnpress-course-review' );
			}

			$return = learn_press_add_course_review(
				array(
					'user_id'   => get_current_user_id(),
					'course_id' => $id,
					'rate'      => $rate,
					'title'     => $title,
					'content'   => $content,
				)
			);

			// Clear cache
			//wp_cache_delete( 'course-' . $id, 'lp-course-ratings' );
			$lp_course_review_cache = new LP_Course_Review_Cache( true );
			$lp_course_review_cache->clean_rating( $id );

			$response['comment'] = $return;
			learn_press_send_json( $response );
		}

		public function init_comment_table() {
			//wp_enqueue_style( 'course-review', LP_ADDON_COURSE_REVIEW_URL . '/assets/css/course-review.css' );

			add_filter( 'admin_comment_types_dropdown', array( $this, 'add_comment_type_filter' ) );
			if ( is_admin() ) {
				add_filter( 'comment_text', array( $this, 'add_comment_content_filter' ) );
			}

			add_filter( 'comment_row_actions', array( $this, 'edit_comment_row_actions' ), 10, 2 );
		}

		public function edit_comment_row_actions( $actions, $comment ) {
			if ( ! $comment || $comment->comment_type != 'review' ) {
				return $actions;
			}
			unset( $actions['reply'] );

			return $actions;
		}

		public function add_comment_type_filter( $cmt_types ) {
			$cmt_types[ self::$comment_type ] = __( 'Course review', 'learnpress-course-review' );

			return $cmt_types;
		}

		public function add_comment_content_filter( $cmt_text ) {
			global $comment;
			if ( ! $comment || $comment->comment_type != 'review' ) {
				return $cmt_text;
			}

			ob_start();
			$rated = get_comment_meta( $comment->comment_ID, '_lpr_rating', true );
			echo '<div class="course-rate">';
			LP_Addon_Course_Review_Preload::$addon->get_template( 'rating-stars.php', [ 'rated' => $rated ] );
			echo '</div>';
			$cmt_text .= ob_get_clean();

			return $cmt_text;
		}

		public function add_comment_post_type_filter() {
			?>
			<label class="screen-reader-text"
				for="filter-by-comment-post-type"><?php _e( 'Filter by post type' ); ?></label>
			<select id="filter-by-comment-post-type" name="post_type">
				<?php
				$comment_post_types = apply_filters(
					'learn_press_admin_comment_post_type_types_dropdown',
					array(
						''          => __( 'All post type', 'learnpress-course-review' ),
						'lp_course' => __( 'Course comments', 'learnpress-course-review' ),
					)
				);

				foreach ( $comment_post_types as $type => $label ) {
					echo "\t" . '<option value="' . esc_attr( $type ) . '"' . selected( $comment_post_types, $type, false ) . ">$label</option>\n";
				}
				?>

			</select>
			<?php
		}

		/**
		 * Shortcode course review.
		 *
		 * @param array $setting
		 *
		 * @return false|string|void
		 */
		public function shortcode_review( array $setting = [] ) {
			wp_enqueue_style( 'learnpress' );
			wp_enqueue_style( 'course-review' );
			wp_enqueue_script( 'course-review' );

			$setting = shortcode_atts(
				array(
					'course_id'      => 0,
					'show_rate'      => 'yes',
					'show_review'    => 'yes',
					'display_amount' => '5',
				),
				$setting,
				'shortcode_review'
			);

			$course_id = $setting['course_id'];
			$course    = learn_press_get_course( $course_id );
			if ( ! $course ) {
				$message_data = [
					'status'  => 'warning',
					'content' => __( '[learn_press_review-warning] Course is invalid', 'learnpress-course-review' ),
				];
				ob_start();
				Template::instance()->get_frontend_template( 'global/lp-message.php', compact( 'message_data' ) );
				return ob_get_clean();
			}

			$user              = learn_press_get_current_user();
			$data_for_template = compact( 'course_id', 'user', 'setting' );
			if ( 'yes' === $setting['show_rate'] ) {
				$course_rate_res                      = learn_press_get_course_rate( $course_id, false );
				$data_for_template['course_rate_res'] = $course_rate_res;
			}
			if ( 'yes' === $setting['show_review'] ) {
				$course_review                      = learn_press_get_course_review( $course_id, 1 );
				$data_for_template['course_review'] = $course_review;
			}

			$data_for_template = apply_filters( 'lp/shortcode/course-review/data', $data_for_template );
			ob_start();
			LP_Addon_Course_Review_Preload::$addon->get_template(
				apply_filters( 'lp/shortcode/course-review/rating-comments/template', 'list-rating-reviews.php' ),
				[ 'data' => $data_for_template ]
			);

			return ob_get_clean();
		}

		public function load_widget() {
			register_widget( 'LearnPress_Course_Review_Widget' );
		}


		public function add_course_tab_reviews( $tabs ) {
			$tabs['reviews'] = array(
				'title'    => __( 'Reviews', 'learnpress-course-review' ),
				'priority' => 60,
				'callback' => array( $this, 'add_course_tab_reviews_callback' ),
			);

			return $tabs;
		}

		public function add_course_tab_reviews_callback() {
			// $user      = learn_press_get_current_user();
			$course_id = learn_press_get_course_id();
			if ( empty( $course_id ) ) {
				return;
			}
			?>
			<div class="learnpress-course-review" data-id="<?php echo $course_id; ?>">
				<ul class="lp-skeleton-animation">
					<li style="width: 100%; height: 20px"></li>
					<li style="width: 100%; height: 20px"></li>
					<li style="width: 100%; height: 20px"></li>
					<li style="width: 100%; height: 20px"></li>
					<li style="width: 100%; height: 20px"></li>
					<li style="width: 100%; height: 20px"></li>
					<li style="width: 100%; height: 20px"></li>
				</ul>
			</div>
			<?php
		}

		/**
		 * Get rating of course.
		 *
		 * @param int $course_id
		 *
		 * @version 1.0.0
		 * @since 4.0.6
		 * @return array
		 */
		public function get_rating_of_course( int $course_id = 0 ): array {
			$lp_course_review_cache = new LP_Course_Review_Cache( true );
			$rating                 = [
				'course_id' => $course_id,
				'total'     => 0,
				'rated'     => 0,
				'items'     => [
					5 => [
						'rated'         => 5,
						'total'         => 0,
						'percent'       => 0,
						'percent_float' => 0,
					],
					4 => [
						'rated'         => 4,
						'total'         => 0,
						'percent'       => 0,
						'percent_float' => 0,
					],
					3 => [
						'rated'         => 3,
						'total'         => 0,
						'percent'       => 0,
						'percent_float' => 0,
					],
					2 => [
						'rated'         => 2,
						'total'         => 0,
						'percent'       => 0,
						'percent_float' => 0,
					],
					1 => [
						'rated'         => 1,
						'total'         => 0,
						'percent'       => 0,
						'percent_float' => 0,
					],
				],
			];

			try {
				$rating_cache = $lp_course_review_cache->get_rating( $course_id );
				if ( false !== $rating_cache ) {
					return json_decode( $rating_cache, true );
				}

				$lp_course_reviews_db = LP_Course_Reviews_DB::getInstance();
				$rating_rs            = $lp_course_reviews_db->count_rating_of_course( $course_id );
				if ( ! $rating_rs ) {
					throw new Exception();
				}

				$rating['total'] = (int) $rating_rs->total;
				$total_rating    = 0;
				for ( $star = 1; $star <= 5; $star++ ) {
					$key = '';
					switch ( $star ) {
						case 1:
							$key = 'one';
							break;
						case 2:
							$key = 'two';
							break;
						case 3:
							$key = 'three';
							break;
						case 4:
							$key = 'four';
							break;
						case 5:
							$key = 'five';
							break;
					}

					// Calculate total rating by type.
					$rating['items'][ $star ]['rated']   = $star;
					$rating['items'][ $star ]['total']   = (int) $rating_rs->{$key};
					$rating['items'][ $star ]['percent'] = (int) ( $rating_rs->total ? $rating_rs->{$key} * 100 / $rating_rs->total : 0 );

					// Sum rating.
					$count_star    = $rating_rs->{$key};
					$total_rating += $count_star * $star;
				}

				// Calculate average rating.
				$rating_average  = $rating_rs->total ? $total_rating / $rating_rs->total : 0;
				if ( is_float( $rating_average ) ) {
					$rating_average = (float) number_format( $rating_average, 1 );
				}
				$rating['rated'] = $rating_average;

				// Set cache
				$lp_course_review_cache->set_rating( $course_id, json_encode( $rating ) );
			} catch ( Throwable $e ) {
				error_log( $e->getMessage() );
			}

			return $rating;
		}

		/**
		 * Calculate rating average all courses.
		 * For case user upgrade plugin (not install First)
		 * Apply new feature - filter course rating, need param from meta to compare.
		 * For a long time will remove this function.
		 *
		 * @return void
		 * @since 4.1.2
		 */
		public function calculate_rating_average_courses() {
			if ( ! is_admin() ) {
				return;
			}

			$is_calculated = get_option( 'lp_calculated_rating_average_courses' );
			if ( ! empty( $is_calculated ) ) {
				return;
			}

			update_option( 'lp_calculated_rating_average_courses', 1 );
			$params = [ 'handle_name' => 'calculate_rating_average_courses' ];
			LPCourseReviewBackGround::instance()->data( $params )->dispatch();
		}

		/**
		 * Set rating average for course
		 *
		 * @param int $course_id
		 * @param float $average
		 *
		 * @return void
		 * @since 4.1.2
		 * @version 1.0.0
		 */
		public static function set_course_rating_average( int $course_id, float $average ) {
			update_post_meta( $course_id, LP_Addon_Course_Review::META_KEY_RATING_AVERAGE, $average );
		}

		public static function get_svg_star() {
			//return wp_remote_fopen( LP_Addon_Course_Review_Preload::$addon->get_plugin_url( 'assets/images/svg-star.svg' ) );
			return file_get_contents( LP_ADDON_COURSE_REVIEW_PATH. '/assets/images/svg-star.svg' );
		}

		/**
		 * Hook get rating for API of APP.
		 *
		 * @param stdClass|mixed $courseObjPrepare
		 * @param CourseModel $course form LP v4.2.6.9
		 *
		 * @return stdClass|mixed
		 * @since 4.1.3
		 * @version 1.0.0
		 */
		public function rest_api_courses( $courseObjPrepare, CourseModel $course ) {
			$courseObjPrepare->rating = learn_press_get_course_rate( $course->get_id() );

			return $courseObjPrepare;
		}
	}
}
