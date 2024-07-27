<?php
/**
 * LPCourseReviewBackGround
 */
defined( 'ABSPATH' ) || exit;

class LPCourseReviewBackGround extends LP_Async_Request {
	protected $prefix = 'lp_course_review';
	protected $action = 'background_course_review';
	protected static $instance;

	public static function instance(): self {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	protected function handle() {
		try {
			@set_time_limit( 0 );
			$handle_name = LP_Request::get_param( 'handle_name' );
			if ( $handle_name == 'calculate_rating_average_courses' ) {
				$this->calculate_rating_average_courses();
			}
			die;
		} catch ( Throwable $e ) {
			error_log( $e->getMessage() );
		}
	}

	/**
	 * Calculate rating average all courses published
	 */
	protected function calculate_rating_average_courses() {
		$course_ids = get_posts(
			[
				'fields'      => 'ids',
				'post_type'   => LP_COURSE_CPT,
				'post_status' => 'publish',
				'numberposts' => - 1,
			]
		);

		if ( ! empty( $course_ids ) ) {
			foreach ( $course_ids as $id ) {
				$rating = LP_Addon_Course_Review_Preload::$addon->get_rating_of_course( $id );
				LP_Addon_Course_Review::set_course_rating_average( $id, $rating['rated'] );
			}
		}
	}
}

LPCourseReviewBackGround::instance();
