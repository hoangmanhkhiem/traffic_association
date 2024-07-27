<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


$events_label_plural = tribe_get_event_label_plural();

?>

<div class="tribe-venue-widget-wrapper">
	<div class="tribe-venue-widget-venue">
		<?php if (has_post_thumbnail($venue_ID)) { ?>
			<div class="tribe-venue-widget-thumbnail">
				<?php echo get_the_post_thumbnail($venue_ID, 'cmsmasters-project-thumb' ); ?>
			</div>
		<?php } ?>
		<div class="tribe-venue-widget-venue-name">
			<span class="cmsmasters_tribe_venue_widget_name_inner cmsmasters_theme_icon_user_address">
				<?php echo tribe_get_venue_link($venue_ID); ?>
			</span>
		</div>
	</div>

	<?php if ( 0 === $events->post_count ): ?>
		<?php printf( esc_html__( 'No upcoming %s.', 'schule' ),  strtolower( $events_label_plural ) ); ?>
	<?php else: ?>
	<?php do_action( 'tribe_events_venue_widget_before_the_list' ); ?>	
	<ul class="tribe-venue-widget-list hfeed vcalendar">		
		<?php while ( $events->have_posts() ): ?>
			<?php $events->the_post(); ?>
			<li class="<?php tribe_events_event_classes() ?>">
				<div class="cmsmasters_venue_widget_date">
					<span class="cmsmasters_venue_widget_mon"><?php echo tribe_get_end_date(null, true, 'M'); ?></span>
					<span class="cmsmasters_venue_widget_day"><?php echo tribe_get_start_date(null, true, 'd'); ?></span>				 
				</div>				
				<div class="cmsmasters_widget_event_info">
					<h4 class="entry-title summary">
						<a href="<?php echo esc_url( tribe_get_event_link() ); ?>"><?php echo get_the_title( get_the_ID() ) ?></a>
					</h4>
					<div class="cmsmasters_widget_event_info_date cmsmasters_theme_icon_time">
						<span class="cmsmasters_event_start_time"><?php echo tribe_get_start_date(null, true, 'g:i a'); ?></span>
					 	<span class="cmsmasters_event_end_time"><?php echo tribe_get_end_date(null, true, ' - g:i a'); ?></span>
					</div>
					<?php if ( tribe_get_cost( get_the_ID() ) != '' ): ?>
					<div class="cmsmasters_widget_event_info_cost cmsmasters_theme_icon_money">
						<span class="tribe-events-event-cost">
							<?php echo tribe_get_cost( get_the_ID(), true ); ?>
						</span>
					</div>
					<?php endif; ?>
				</div>
			</li>
	<?php endwhile;	?>
	</ul>
	<?php do_action( 'tribe_events_venue_widget_after_the_list' ); ?>
	<?php endif; ?>
	<p class="tribe-events-widget-link">
		<a href="<?php echo esc_url( tribe_get_venue_link( $venue_ID, false ) ); ?>"><?php printf( esc_html__( 'View all %s at this %s', 'schule' ), $events_label_plural, tribe_get_venue_label_singular() ); ?></a>
	</p>
</div>
