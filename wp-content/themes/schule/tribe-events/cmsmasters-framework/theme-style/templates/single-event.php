<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

if (have_posts()) : the_post();

?>

<div id="tribe-events-content" class="tribe-events-single vevent hentry">
	<div id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_single_event'); ?>>
		<?php 
		tribe_the_notices();
		
		
		if (has_post_thumbnail()) {
			echo '<div class="cmsmasters_single_event_img">' . 
				tribe_event_featured_image($event_id, 'cmsmasters-full-masonry-thumb', false) . 
			'</div>';
		}
		?>
		
		<div class="cmsmasters_single_event_header clearfix">
			<div class="cmsmasters_single_event_header_left clearfix">
				<?php 
				the_title('<h2 class="tribe-events-single-event-title summary entry-title">', '</h2>');
				
				
				echo '<div class="tribe-events-schedule updated published clearfix">' . 
					tribe_events_event_schedule_details($event_id, '<div class="tribe-events-date cmsmasters_theme_icon_time">', '</div>');
					
					
					if (tribe_get_cost()) {
						echo '<div class="tribe-events-cost cmsmasters_theme_icon_money">' . tribe_get_cost( null, true ) . '</div>';
					}
					
				echo '</div>';
				?>
			</div>
			<div class="cmsmasters_single_event_header_right clearfix">
				<div class="tribe-events-back">
					<a class="cmsmasters_theme_icon_date" href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( esc_html__( 'All %s', 'schule' ), $events_label_plural ); ?></a>
				</div>
				
				
				<?php
				$cmsmasters_tribe_events_ical = new Tribe__Events__iCal();
				
				$cmsmasters_tribe_events_ical->single_event_links(); 
				?>
			</div>
		</div>
		<?php
		
		do_action('tribe_events_single_event_before_the_content');
		
		
		echo '<div class="tribe-events-single-event-description cmsmasters_single_event_content tribe-events-content entry-content description">';
			
			the_content();
			
		echo '</div>';
		
		
		do_action('tribe_events_single_event_after_the_content');
		
	echo '</div>';
	
	
	do_action('tribe_events_single_event_before_the_meta');
	
	
	if (!apply_filters('tribe_events_single_event_meta_legacy_mode', false)) {
		tribe_get_template_part( 'modules/meta' );
	} else {
		echo tribe_events_single_event_meta();
	}
	
	
	if (tribe_embed_google_map()) {
		echo '<div class="cmsmasters_single_event_map' . (!has_post_thumbnail() ? ' cmsmasters_single_event_full_width' : '') . '">';
			
			tribe_get_template_part('modules/meta/map');
			
		echo '</div>';
	}
	
	
	$cmsmasters_post_type = get_post_type();
	
	$published_events = wp_count_posts($cmsmasters_post_type)->publish;
	
	if ($published_events > 1) {
		echo '<aside id="tribe-events-sub-nav" class="post_nav">' . 
			'<span class="tribe-events-nav-previous cmsmasters_prev_post">'; 
				
				tribe_the_prev_event_link('%title%');
				
				echo '<span class="cmsmasters_prev_arrow"><span></span></span>' . 
			'</span>' . 
			'<span class="tribe-events-nav-next cmsmasters_next_post">';
				
				tribe_the_next_event_link('%title%');
				
				echo '<span class="cmsmasters_next_arrow"><span></span></span>' . 
			'</span>' . 
		'</aside>';
	}
	
	
	do_action('tribe_events_single_event_after_the_meta');
	
	
	if (get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option('showComments', false)) {
		comments_template();
	}
	
echo '</div>';


endif;

