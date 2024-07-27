<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<h3 class="tribe-events-single-section-title"><?php echo tribe_get_organizer_label( ! $multiple ); ?></h3>
	<div class="cmsmasters_event_meta_info">
		<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}

			?>
			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e('Organizer Name:', 'schule'); ?></span>
				<span class="cmsmasters_event_meta_info_item_descr fn org"><?php echo tribe_get_organizer_link( $organizer ); ?></span>
			</div>
			<?php
		}

		if ( ! $multiple ) { // only show organizer details if there is one
			if ( ! empty( $phone ) ) {
				?>
				<div class="cmsmasters_event_meta_info_item">
					<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Phone:', 'schule' ) ?></span>
					<span class="cmsmasters_event_meta_info_item_descr tel"><?php echo esc_html( $phone ); ?></span>
				</div>
				<?php
			}//end if

			if ( ! empty( $email ) ) {
				?>
				<div class="cmsmasters_event_meta_info_item">
					<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Email:', 'schule' ) ?></span>
					<span class="cmsmasters_event_meta_info_item_descr email"><?php echo esc_html( $email ); ?></span>
				</div>
				<?php
			}//end if

			if ( ! empty( $website ) ) {
				?>
				<div class="cmsmasters_event_meta_info_item">
					<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Website:', 'schule' ) ?></span>
					<span class="cmsmasters_event_meta_info_item_descr url"><?php echo wp_kses( $website, 'post' ); ?></span>
				</div>
				<?php
			}//end if
		}//end if

		do_action( 'tribe_events_single_meta_organizer_section_end' );
		?>
	</div>
</div>