<?php
/**
 * Template for displaying rating stars.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/rating-stars.php.
 *
 * @author  ThimPress
 * @package LearnPress/Course-Review/Templates
 * version  3.0.8
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! isset( $rated ) ) {
	return;
}

$percent = min( 100, (float) $rated * 20 );
$title   = sprintf( __( '%s out of 5 stars', 'learnpress-course-review' ), $rated );
LP_Addon_Course_Review_Preload::$addon->check_load_file_style();
?>
<div class="review-stars-rated" title="<?php echo esc_attr( $title ); ?>">
	<?php
	for ( $i = 1; $i <= 5; $i ++ ) {
		$p = ( $i * 20 );
		$r = max( $p <= $percent ? 100 : ( $percent - ( $i - 1 ) * 20 ) * 5, 0 );
		?>
		<div class="review-star">
			<em class="far lp-review-svg-star">
				<?php echo LP_Addon_Course_Review::get_svg_star() ?>
			</em>
			<em class="fas lp-review-svg-star" style="width:<?php echo $r; ?>%;">
				<?php echo LP_Addon_Course_Review::get_svg_star() ?>
			</em>
		</div>
	<?php } ?>
</div>
