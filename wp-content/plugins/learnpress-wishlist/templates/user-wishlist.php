<?php
/**
 * Template for displaying the list of course is in wishlist.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/wishlist/user-wishlist.php.
 *
 * @author ThimPress
 * @package LearnPress/Wishlist/Templates
 * @version 3.0.1
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

global $post;
?>
	<div id="learn-press-profile-tab-course-wishlist" class="<?php echo isset( $wishlist ) ? 'has-courses' : ''; ?>">
		<?php if ( isset( $wishlist ) ) { ?>
			<ul class="profile-courses courses-list learn-press-wishlist-courses">
				<?php
				foreach ( $wishlist as $post ) {
					?>
					<?php LP_Addon_Wishlist_Preload::$addon->get_template( 'wishlist-content.php' ); ?>
				<?php } ?>
			</ul>
		<?php } ?>
		<?php learn_press_display_message( apply_filters( 'learn_press_wishlist_empty_course', __( 'No courses in your wishlist!', 'learnpress-wishlist' ) ) ); ?>
	</div>
<?php
wp_reset_postdata();
