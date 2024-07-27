<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.0
 */


?>
<div id="tribe-events-event-<?php echo esc_attr( $event->ID ); ?>" class="<?php tribe_events_event_classes( $event->ID ) ?> tribe-this-week-event" >

	<h5 class="entry-title summary">
		<a href="<?php echo esc_url( tribe_get_event_link( $event->ID ) ); ?>" rel="bookmark"><?php echo esc_html( $event->post_title ); ?></a>
	</h5>

	<div class="duration cmsmasters_theme_icon_time">
		<span class="cmsmasters_event_start_time"><?php echo tribe_get_start_date($event->ID, true, 'g:i a'); ?></span>
		<span class="cmsmasters_event_end_time"><?php echo tribe_get_end_date($event->ID, true, ' - g:i a'); ?></span>
	</div>	

	<?php if (tribe_get_venue_link( $event->ID ) != ''): ?>
		<div class="fn org tribe-venue cmsmasters_theme_icon_user_address">
			<?php echo tribe_get_venue_link( $event->ID ); ?>
		</div>
	<?php endif ?>
</div>