<?php
/**
 * This Week Day
 * This file loads the this week widget day
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/widgets/this-week/loop-grid-day.php
 *
 * @package TribeEventsCalendar
 * 
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div class="tribe-this-week-widget-day tribe-this-week-widget-day-<?php echo esc_attr( $day['day_number'] ) ?> <?php echo esc_attr( tribe_get_this_week_day_class( $day ) ); ?>">

	<div class="tribe-this-week-widget-header-date">
		<span class="day"><?php echo tribe_get_start_date(null, false, 'F'); ?></span>
		<span class="date"><?php echo tribe_get_start_date(null, false, 'd'); ?></span>
	</div>

		<div class="tribe-this-week-widget-day-wrap">

			<?php if ( $day['has_events'] ) : ?>

				<?php $i = 0; ?>

				<?php foreach ( $day['this_week_events'] as $event ) : ?>

					<?php if ( $i++ >= $day['events_limit'] ) break; ?>

					<!-- This Week Event -->
					<?php tribe_get_template_part( 'pro/widgets/this-week/single-event', 'single', array( 'event' => $event ) ); ?>

				<?php endforeach; ?>

				<!-- This Week Day View More -->
				<?php if ( $day['view_more'] ) : ?>
					<div class="tribe-events-viewmore">
						<?php

						$label_text = $this_week_template_vars['events_label_singular'];
						if ( 1 !== $day['total_events'] ) {
							$label_text = $this_week_template_vars['events_label_plural'];
						}
						
						$day = $day['total_events'];
						
						$view_all_label = sprintf(
						  _n(
						    'View %1$s %2$s',
						    'View All %1$s %2$s',
							$day,
						    'schule'
						  ),
						  $day['total_events'],
						  $label_text
						);

						?>
						<a href="<?php echo esc_url( $day['view_more'] ); ?>"><?php echo esc_html( $view_all_label ); ?> &raquo;</a>
					</div>

				<?php endif ?>
			
			<?php endif; ?>

		</div>

</div>