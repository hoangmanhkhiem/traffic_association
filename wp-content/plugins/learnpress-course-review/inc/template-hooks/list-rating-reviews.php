<?php

namespace LP_Addon_Course_Review;

use LP_Addon_Course_Review_Preload;

/**
 * Class Template
 *
 * @package RealPress\Helpers
 * @since 1.0.1
 * @version 1.0.0
 */
class LP_Addon_Review_List_Rating_Reviews_Template {
	public $template;

	public static function instance() {
		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self();
		}

		return $instance;
	}

	protected function __construct() {
		add_action( 'learn-press/course-review/list-rating-reviews', array( $this, 'list_rating_reviews' ) );
	}

	/**
	 * Load templates for single property
	 *
	 * @param array $data
	 *
	 * @return void
	 */

	public function list_rating_reviews( array $data ) {
		$elms = apply_filters(
			'learn-press/course-review/list-rating-reviews/elements',
			[
				'course-sum-rating.php',
				'form-submit-review.php',
				'item-review-wait-approve',
				'list-reviews.php',
			],
			$data
		);

		foreach ( $elms as $elm ) {
			LP_Addon_Course_Review_Preload::$addon->get_template( $elm, $data );
		}
	}
}

LP_Addon_Review_List_Rating_Reviews_Template::instance();
