<?php
/**
 * Plugin load class.
 *
 * @author   ThimPress
 * @package  LearnPress/Prerequisites-Courses/Classes
 * @version  3.0.1
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Addon_Prerequisites_Courses' ) ) {
	/**
	 * Class LP_Addon_Prerequisites_Courses
	 */
	class LP_Addon_Prerequisites_Courses extends LP_Addon {

		/**
		 * @var string
		 */
		public $version = LP_ADDON_PREREQUISITES_COURSES_VER;

		/**
		 * @var string
		 */
		public $require_version = LP_ADDON_PREREQUISITES_COURSES_REQUIRE_VER;

		/**
		 * Path file addon
		 *
		 * @var string
		 */
		public $plugin_file = LP_ADDON_PREREQUISITES_COURSES_FILE;

		/**
		 * LP_Addon_Prerequisites_Courses constructor.
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @since 3.0.0
		 */
		protected function _includes() {
			require_once LP_ADDON_PREREQUISITES_COURSES_PATH . '/inc/class-lp-prere-hooks.php';

			LP_Prere_Course_Hooks::get_instance();
		}

		/**
		 * Get prerequisites of course.
		 *
		 * @param int $course_id
		 *
		 * @return array
		 */
		public static function get_prerequisite_courses( int $course_id = 0 ): array {
			$required_course_ids = get_post_meta( $course_id, '_lp_course_prerequisite', true );
			return ! empty( $required_course_ids ) ? $required_course_ids : [];
		}

		/**`
		 * Show notice required pass prerequisites courses.
		 *
		 * @since 3.0.0
		 * @version 3.0.1
		 * @editor tungnx
		 * @Todo theme coaching is using this function
		 */
		public function enroll_notice() {
			return;
			LP_Prere_Course_Hooks::get_instance()->check_condition();
		}
	}
}

add_action( 'plugins_loaded', array( 'LP_Addon_Prerequisites_Courses', 'instance' ) );
