<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


$mini_cal_event_atts = tribe_events_get_widget_event_atts();

$post_date = tribe_events_get_widget_event_post_date();
$post_id   = get_the_ID();

$organizer_ids = tribe_get_organizer_ids();
$multiple_organizers = count( $organizer_ids ) > 1;

$city_name   = ! empty( $city ) ? tribe_get_city() : '';
$region_name = ! empty( $region ) ? tribe_get_region() : '';
$zip_text    = ! empty( $zip ) ? tribe_get_zip() : '';

$has_address_details = ! empty( $city_name ) || ! empty( $region_name ) || ! empty( $zip_text );
?>

<div class="tribe-mini-calendar-event event-<?php echo esc_attr( $mini_cal_event_atts['current_post'] ); ?> <?php echo esc_attr( $mini_cal_event_atts['class'] ); ?>">
	<?php
	if (
		tribe( 'tec.featured_events' )->is_featured( $post_id )
		&& get_post_thumbnail_id( $post_id )
	) {
		/**
		 * Fire an action before the list widget featured image
		 */
		do_action( 'tribe_events_list_widget_before_the_event_image' );

		/**
		 * Allow the default post thumbnail size to be filtered
		 *
		 * @param $size
		 */
		$thumbnail_size = apply_filters( 'tribe_events_list_widget_thumbnail_size', 'cmsmasters-small-thumb' );
		?>
		<div class="tribe-event-image">
			<?php the_post_thumbnail( $thumbnail_size ); ?>
		</div>
		<?php

		/**
		 * Fire an action after the list widget featured image
		 */
		do_action( 'tribe_events_list_widget_before_the_event_image' );
	}
	?>

	<div class="tribe-events-list-widget-content-wrap">		
		
		<div class="cmsmasters_widget_event_info">

			<?php if (has_post_thumbnail()): ?>
				<div class="cmsmasters_widget_sidebar_img">
					<?php the_post_thumbnail(); ?>

					<div class="cmsmasters_theme_event_date">
						<span class="cmsmasters_event_date_mon"><?php echo tribe_get_end_date(null, true, 'M'); ?></span>
					 	<span class="cmsmasters_event_date_day"><?php echo tribe_get_start_date(null, true, 'd'); ?></span>				 
					</div>
				</div>					
			<?php endif ?> 
			<?php if (!has_post_thumbnail()): ?>
				<div class="cmsmasters_theme_event_date cmsmasters_date_no_thumbnail">
					<span class="cmsmasters_event_date_mon"><?php echo tribe_get_end_date(null, true, 'M'); ?></span>
				 	<span class="cmsmasters_event_date_day"><?php echo tribe_get_start_date(null, true, 'd'); ?></span>				 
				</div>	
			<?php endif ?>		
				

			<div class="cmsmasters_widget_event_info_wrap">

			<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
				<h4 class="entry-title summary">
					<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h4>
			<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>	
			

			<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>

			<div class="duration cmsmasters_theme_icon_time">
				<div class="cmsms_event_date">
					 <span class="cmsmasters_event_start_time"><?php echo tribe_get_start_date(null, true, 'g:i a'); ?></span>
					 <span class="cmsmasters_event_end_time"><?php echo tribe_get_end_date(null, true, ' - g:i a'); ?></span>
				</div>
			</div>

			<?php if ( isset( $cost ) && $cost && tribe_get_cost() != '' ) : ?>
				<div class="tribe-events-event-cost cmsmasters_theme_icon_money">
					<?php echo tribe_get_cost( null, true ); ?>
				</div>
			<?php endif ?>
			
			<div class="vcard adr location cmsmasters_widget_event_venue_info_loc">
			<?php 
				if ( 
					( isset( $venue ) && $venue && tribe_get_venue() != '' ) || 
					( isset( $address ) && $address && tribe_get_address() != '' ) || 
					( isset( $city_name ) && $city_name && tribe_get_city() != '' ) || 
					( isset( $region_name ) && $region_name && tribe_get_region() != '' ) || 
					( isset( $zip_text ) && $zip_text && tribe_get_zip() != '' ) || 
					( isset( $country ) && $country && tribe_get_country() != '' ) 
				) {
				?>
					<div class="cmsmasters_widget_event_venue_info cmsmasters_theme_icon_user_address">
						<!-- // Price, Venue Name, Address, City, State or Province, Postal Code, Country, Venue Phone, Organizer Name-->
						<?php ob_start(); ?>
						<?php if ( isset( $venue ) && $venue && tribe_get_venue() != '' ) : ?>
							<span class="tribe-events-venue"><?php echo tribe_get_venue_link(); ?></span>
						<?php endif ?>

						<?php if ( isset( $address ) && $address && tribe_get_address() != '' ): ?>
							<span class="tribe-street-address"><?php echo tribe_get_address(); ?></span>
						<?php endif ?>

						<?php
						if ( $has_address_details ) : ?>
							<div>
								<?php if ( ! empty( $city_name ) ) : ?>
									<span class="tribe-events-locality"><?php echo esc_html( $city_name ); ?></span>
								<?php endif ?>

								<?php if ( ! empty( $region_name ) ) : ?>
									<span class="tribe-events-region"><?php echo esc_html( $region_name ); ?></span>
								<?php endif ?>

								<?php if ( ! empty( $zip_text ) ) : ?>
									<span class="tribe-events-postal-code"><?php echo esc_html( $zip_text ); ?></span>
								<?php endif ?>
							</div>
						<?php endif; ?>

						<?php if ( isset( $country ) && $country && tribe_get_country() != '' ) : ?>
							<span class="tribe-country-name"><?php echo tribe_get_country(); ?></span>
						<?php endif ?>

						<?php if ( isset( $phone ) && $phone && tribe_get_phone() != '' ) : ?>
							<span class="tribe-events-tel"><?php echo tribe_get_phone(); ?></span>
						<?php endif ?>

						<?php if ( $location = trim( ob_get_clean() ) ) : ?>
							<div class="tribe-events-location tribe-section-s">
								<?php echo schule_return_content($location); ?>
							</div>
						<?php endif; ?>
					</div> <?php
				} ?>

				<?php ob_start(); ?>
				<?php if ( isset( $organizer ) && $organizer && ! empty( $organizer_ids ) ) : ?>
					<div class="cmsmasters_widget_event_venue_loc cmsmasters_theme_icon_person">
						<span class="tribe-events-organizer">
							<?php echo tribe_get_organizer_label( ! $multiple_organizers ); ?>:
							<?php
							$organizer_links = array();
							foreach ( $organizer_ids as $organizer_id ) {
								if ( ! $organizer_id ) {
									continue;
								}

								$organizer_link = tribe_get_organizer_link( $organizer_id, true );

								$organizer_phone = tribe_get_organizer_phone( $organizer_id );
								if ( ! empty( $organizer_phone ) ) {
									$organizer_link .= '<div class="tribe-events-tel">' . $organizer_phone . '</div>';
								}

								$organizer_links[] = $organizer_link;
							}// end foreach

							$and = _x( 'and', 'list separator for final two elements', 'schule' );
							if ( 1 == count( $organizer_links ) ) {
								echo schule_return_content($organizer_links[0]);
							} elseif ( 2 == count( $organizer_links ) ) {
								echo schule_return_content($organizer_links[0] . ' ' . esc_html( $and ) . ' ' . $organizer_links[1]);
							} else {
								$last_organizer = array_pop( $organizer_links );

								echo implode( ', ', $organizer_links );
								echo esc_html( ', ' . $and . ' ' );
								echo schule_return_content($last_organizer);
							}// end else
							?>
						</span>
					</div>
				<?php endif ?>
				<?php if ( $organizers = trim( ob_get_clean() ) ) : ?>
					<div class="tribe-events-organizer tribe-section-s">
						<?php echo schule_return_content($organizers); ?>
					</div>
				<?php endif; ?>
			</div>	
				<?php do_action( 'tribe_events_before_the_content' ) ?>
					<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
						<?php echo tribe_events_get_the_excerpt(); ?>
						<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Read More', 'schule' ) ?></a>
					</div><!-- .tribe-events-list-event-description -->
				<?php do_action( 'tribe_events_after_the_content' ) ?>
			</div>
		</div>
	</div>
	<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
</div> <!-- .list-info -->

