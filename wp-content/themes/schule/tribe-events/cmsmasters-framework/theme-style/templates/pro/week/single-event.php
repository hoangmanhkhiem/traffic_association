<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.0
 */



$image_src = wp_get_attachment_image_src(get_post_thumbnail_id($event->ID), 'cmsmasters-project-thumb');

if ($image_src) {
	$additional_data = array( 
		'imageSrc' => 			$image_src[0], 
		'imageTooltipSrc' => 	$image_src[0] 
	);
} else {
	$additional_data = array();
}

?>
<div id="tribe-events-event-<?php echo esc_attr( $event->ID ); ?>" <?php echo tribe_events_week_event_attributes(); ?> class="<?php tribe_events_event_classes( $event->ID ) ?> tribe-week-event" data-tribejson='<?php echo tribe_events_template_data( $event, $additional_data ); ?>'>
	<div class="hentry vevent tribe-events-week-hourly-single">
		<h5 class="entry-title summary">
			<a href="<?php echo esc_url ( tribe_get_event_link( $event ) ); ?>" class="url" rel="bookmark"><?php echo esc_html($event->post_title); ?></a>
		</h5>
	</div>
</div>
