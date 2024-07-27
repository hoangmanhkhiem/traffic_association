<?php
/**
 * Template for displaying course review.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/course-review.php.
 *
 * @author ThimPress
 * @package LearnPress/Course-Review/Templates
 * @version 3.0.2
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( empty( $course_review ) || empty( $course_id ) ) {
	return;
}

$reviews = $course_review['reviews'] ?? [];
$pages   = (int) ( $course_review['pages'] ?? 0 );
$paged   = $paged ?? 1;
$total   = $course_review['total'] ?? 0;
if ( ! $total ) {
	return;
}
?>
<?php if ( $paged === 1 ) { ?>
<div id="course-reviews">
	<h3 class="course-review-head"><?php _e( 'Reviews', 'learnpress-course-review' ); ?></h3>
	<ul class="course-reviews-list">
		<?php } ?>
		<?php foreach ( $reviews as $review ) { ?>
			<?php
			LP_Addon_Course_Review_Preload::$addon->get_template(
				'item-review.php',
				compact( 'review', 'course_id', 'course_review' )
			);
			?>
		<?php } ?>
		<?php if ( $paged === 1 ) : ?>
	</ul>
	<?php endif; ?>
	<?php if ( $paged === 1 && $pages > 1 ) { ?>
		<button class="lp-button course-review-load-more" id="course-review-load-more"
				data-paged="<?php echo absint( $course_review['paged'] + 1 ); ?>"
				data-id="<?php echo $course_id; ?>"
				data-number="<?php echo absint( $pages ); ?>">
			<?php esc_html_e( ' View more ', 'learnpress-course-review' ); ?>
		</button>
	<?php } ?>
	<?php if ( $paged === 1 ) { ?>
</div>
<?php } ?>
