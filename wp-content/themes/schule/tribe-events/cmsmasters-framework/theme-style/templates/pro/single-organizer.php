<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


$organizer_id = get_the_ID();


while( have_posts() ) : the_post(); ?>
<div class="tribe-events-organizer">
	<div class="tribe-events-organizer-meta vcard tribe-clearfix">
		<!-- Organizer Featured Image -->
		<?php 
		if (has_post_thumbnail()) {
			echo '<div class="cmsmasters_events_organizer_meta_img">' . 
				tribe_event_featured_image(null, 'cmsmasters-full-masonry-thumb') . 
			'</div>';
		}
		?>
		
		
		<div class="cmsmasters_events_organizer_header clearfix">
			<div class="cmsmasters_events_organizer_header_left clearfix">
				<!-- Organizer Title -->
				<?php do_action( 'tribe_events_single_organizer_before_title' ) ?>
				<h2 class="tribe-organizer-name entry-title author fn org"><?php echo tribe_get_organizer( $organizer_id ); ?></h2>
				<?php do_action( 'tribe_events_single_organizer_after_title' ) ?>
				
				<div class="tribe-events-event-meta">
					<!-- Organizer Meta -->
					<?php
					do_action('tribe_events_single_organizer_before_the_meta');
					echo tribe_get_organizer_details();
					do_action('tribe_events_single_organizer_after_the_meta');
					?>
				</div>
			</div>
			<div class="cmsmasters_events_organizer_header_right clearfix">
				<div class="tribe-events-back">
					<a class="cmsmasters_theme_icon_date" href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark"><?php printf( esc_html__( 'Back to %s', 'schule' ), tribe_get_event_label_plural() ); ?></a>
				</div>
			</div>
		</div>
		<?php do_action( 'tribe_events_single_organizer_before_organizer' ) ?>
		
		
		<!-- Organizer Content -->
		<?php if( get_the_content() ) { ?>
		<div class="tribe-organizer-description tribe-events-content entry-content">
			<?php the_content(); ?>
		</div>
		<?php } ?>
	</div>
	<!-- .tribe-events-organizer-meta -->
	<?php do_action( 'tribe_events_single_organizer_after_organizer' ) ?>

	<!-- Upcoming event list -->
	<?php do_action('tribe_events_single_organizer_before_upcoming_events') ?>

	<?php
	// Use the tribe_events_single_organizer_posts_per_page to filter the number of events to get here.
	echo tribe_organizer_upcoming_events( $organizer_id ); ?>

	<?php do_action('tribe_events_single_organizer_after_upcoming_events') ?>
	
</div><!-- .tribe-events-organizer -->
<?php do_action( 'tribe_events_single_organizer_after_template' ) ?>
<?php endwhile; ?>