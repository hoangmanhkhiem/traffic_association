<?php
/**
 * Template for displaying list reviews, rating tab of single course.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.2
 */

defined( 'ABSPATH' ) || exit();

if ( empty( $data ) ) {
	return;
}
?>

<div class="lp-rating-reviews">
	<?php
	do_action( 'learn-press/course-review/before-rating-reviews', $data );
	do_action( 'learn-press/course-review/list-rating-reviews', $data );
	do_action( 'learn-press/course-review/before-rating-reviews', $data );
	?>
</div>
