<?php
/**
 * Template for displaying item section meta in single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/section/item-meta.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();

if ( ! isset( $item ) ) {
	return;
}

$course = learn_press_get_course();
if ( ! $course ) {
	return;
}

$user = learn_press_get_current_user();
?>

<div class="course-item-meta">

	<?php do_action( 'learn-press/course-section-item/before-' . $item->get_item_type() . '-meta', $item ); ?>

	<?php if ( $item->is_preview() && $user && ! $user->has_completed_item( $item->get_id(), $course->get_id() ) ) : ?>
		<span class="item-meta course-item-preview"
			  data-preview="<?php esc_attr_e( 'Preview', 'learnpress' ); ?>"></span>

	<?php else : ?>
		<span class="item-meta course-item-status" title="<?php echo esc_attr( $item->get_status_title() ); ?>"></span>
	<?php endif; ?>

	<?php do_action( 'learn-press/course-section-item/after-' . $item->get_item_type() . '-meta', $item ); ?>
</div>
