<?php
/**
 * Class WishListElementorHandler
 *
 * Hook to register widgets, dynamic tags, ... for LearnPress Elementor handler.
 *
 * @since 4.0.6
 * @version 1.0.0
 */
namespace LP_Addon_Wishlist\Elementor;

use LearnPress\Helpers\Singleton;
use LP_Addon_Wishlist\Elementor\Widgets\CourseWishlistElementor;

class WishListElementorHandler {
	use Singleton;

	/**
	 * Hooks to register widgets, dynamic tags, ...
	 *
	 * @return void
	 */
	public function init() {
		add_filter( 'lp/elementor/widgets', [ $this, 'register_widgets' ] );
	}

	/**
	 * @param $lp_widgets array
	 * @return mixed
	 */
	public function register_widgets( array $lp_widgets ): array {
		include_once LP_ADDON_WISHLIST_INC . 'Elementor/Widgets/CourseWishlistElementor.php';

		$lp_widgets['course-wishlist'] = CourseWishlistElementor::class;

		return $lp_widgets;
	}
}
