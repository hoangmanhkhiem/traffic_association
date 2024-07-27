<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


$events_label_plural = tribe_get_event_label_plural();
$events_label_plural_lowercase = tribe_get_event_label_plural_lowercase();

$posts = tribe_get_list_widget_events();

// Check if any event posts are found.
if ( $posts ) : ?>

	<ol class="hfeed vcalendar">
		<?php
		// Setup the post data for each event.
		foreach ( $posts as $post ) :
			setup_postdata( $post );
			
			if ($post->post_type == 'tribe_events') {
				?>
				<li class="tribe-events-list-widget-events <?php tribe_events_event_classes() ?>">

				<div class="cmsmasters_widget_event_info">

					<?php if (has_post_thumbnail()): ?>
						<div class="cmsmasters_widget_sidebar_img">
							<?php the_post_thumbnail(); ?>
							<div class="cmsmasters_list_widget_date">
								<span class="cmsmasters_list_widget_mon"><?php echo tribe_get_end_date(null, true, 'M'); ?></span>
								<span class="cmsmasters_list_widget_day"><?php echo tribe_get_start_date(null, true, 'd'); ?></span>				 
							</div>
						</div>
					<?php endif ?> 
					<?php if (!has_post_thumbnail()): ?>
						<div class="cmsmasters_list_widget_date">
							<span class="cmsmasters_list_widget_mon"><?php echo tribe_get_end_date(null, true, 'M'); ?></span>
							<span class="cmsmasters_list_widget_day"><?php echo tribe_get_start_date(null, true, 'd'); ?></span>				 
						</div>
					<?php endif ?>		
						<div class="cmsmasters_widget_event_info_wrap">
							<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
							<!-- Event Title -->
							<h4 class="entry-title summary">
								<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h4>

							<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>
							<!-- Event Time -->

							<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>

							<div class="cmsmasters_widget_event_info">
								<div class="duration cmsmasters_theme_icon_time">
									<?php echo tribe_events_event_schedule_details(); ?>
								</div>
							</div>

							<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
						</div>
					</div>
				</li>
		<?php
			}
		endforeach;
		?>
	</ol><!-- .tribe-list-widget -->

	<p class="tribe-events-widget-link">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark"><?php printf( esc_html__( 'View All %s', 'schule' ), $events_label_plural ); ?></a>
	</p>

<?php
// No events were found.
else : ?>
	<p><?php printf( esc_html__( 'There are no upcoming %s at this time.', 'schule' ), $events_label_plural_lowercase ); ?></p>
<?php
endif;
