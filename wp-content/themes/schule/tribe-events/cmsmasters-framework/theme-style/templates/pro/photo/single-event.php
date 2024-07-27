<?php 
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.0
 */


global $post;

?>

<div class="tribe-events-photo-event-wrap">

	<?php echo tribe_event_featured_image( null, 'cmsmasters-blog-masonry-thumb' ); ?>

	<div class="tribe-events-event-details tribe-clearfix">



		<!-- Event Title -->
		<?php do_action( 'tribe_events_before_the_event_title' ); ?>
		<h3 class="tribe-events-list-event-title entry-title summary">
			<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h3>
		<?php do_action( 'tribe_events_after_the_event_title' ); ?>

		<!-- Event Meta -->
		<?php do_action( 'tribe_events_before_the_meta' ); ?>
		<div class="tribe-events-event-meta">
			<div class="updated published time-details cmsmasters_theme_icon_time">
				<?php if ( ! empty( $post->distance ) ) : ?>
					<strong>[<?php echo tribe_get_distance_with_unit( $post->distance ); ?>]</strong>
				<?php endif; ?>
				<?php echo tribe_events_event_schedule_details(); ?>
			</div>
		</div><!-- .tribe-events-event-meta -->
		<?php do_action( 'tribe_events_after_the_meta' ); ?>

		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ); ?>
		<div class="tribe-events-list-photo-description tribe-events-content entry-summary description">
			<?php echo tribe_events_get_the_excerpt() ?>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ) ?>

	</div><!-- /.tribe-events-event-details -->

</div><!-- /.tribe-events-photo-event-wrap -->
