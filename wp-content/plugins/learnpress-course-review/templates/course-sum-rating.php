<?php
/**
 * Template for displaying course rate.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/course-rate.php.
 *
 * @author  ThimPress
 * @package LearnPress/Course-Review/Templates
 * version  3.0.3
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! isset( $course_rate_res ) ) {
	return;
}

$rated = $course_rate_res['rated'];
$total = $course_rate_res['total'] ?? 0;
?>
<div class="course-rate">
	<div class="course-rate__summary">
		<div class="course-rate__summary-value"><?php echo esc_html( $rated ); ?></div>
		<div class="course-rate__summary-stars">
			<?php
			LP_Addon_Course_Review_Preload::$addon->get_template( 'rating-stars.php', [ 'rated' => $rated ] );
			?>
		</div>
		<div class="course-rate__summary-text">
			<?php printf( _n( '<span>%d</span> rating', '<span>%d</span> ratings', $total, 'learnpress-course-review' ), $total ); ?>
		</div>
	</div>
	<div class="course-rate__details">
		<?php
		foreach ( $course_rate_res['items'] as $item ) :
			?>
			<div class="course-rate__details-row">
				<span class="course-rate__details-row-star">
					<?php echo esc_html( $item['rated'] ); ?>
				</span>
				<em class="fas lp-review-svg-star">
					<?php echo LP_Addon_Course_Review::get_svg_star() ?>
				</em>
				<div class="course-rate__details-row-value">
					<div class="rating-gray"></div>
					<div class="rating" style="width:<?php echo $item['percent']; ?>%;"
						title="<?php echo esc_attr( $item['percent'] ); ?>%">
					</div>

				</div>
				<span class="rating-count"><?php echo $item['total']; ?></span>
			</div>
			<?php
		endforeach;
		?>
	</div>
</div>
