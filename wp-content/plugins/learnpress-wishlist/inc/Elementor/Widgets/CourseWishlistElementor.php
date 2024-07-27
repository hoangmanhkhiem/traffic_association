<?php
/**
 * Class CourseWishlistElementor
 *
 * @sicne 4.0.6
 * @version 1.0.0
 */
namespace LP_Addon_Wishlist\Elementor\Widgets;

use LearnPress\ExternalPlugin\Elementor\LPElementorWidgetBase;
use LearnPress\ExternalPlugin\Elementor\Widgets\Course\SingleCourseBaseElementor;
use LP_Addon_Wishlist_Preload;

class CourseWishlistElementor extends LPElementorWidgetBase {
	use SingleCourseBaseElementor;

	public function __construct( $data = [], $args = null ) {
		$this->title    = esc_html__( 'Course Wishlist', 'learnpress-wishlist' );
		$this->name     = 'course_wishlist';
		$this->keywords = [ 'course wishlist', 'wishlist' ];
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->controls = require_once LP_ADDON_WISHLIST_PATH . '/config/elementor/wishlist.php';
		parent::register_controls();
	}

	/**
	 * Show content of widget
	 *
	 * @return void
	 */
	protected function render() {
		try {
			$course = $this->get_course();
			if ( ! $course ) {
				return;
			}
			wp_enqueue_script( 'lp-course-wishlist' );
			LP_Addon_Wishlist_Preload::$addon->wishlist_button( $course->get_id() );
		} catch ( \Throwable $e ) {
			error_log( $e->getMessage() );
		}
	}
}
