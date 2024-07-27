<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


if ( ! tribe_get_venue_id() ) {
	return;
}

$phone   = tribe_get_phone();
$website = tribe_get_venue_website_link();

?>

<div class="tribe-events-meta-group tribe-events-meta-group-venue">
	<h3 class="tribe-events-single-section-title"><?php echo esc_html(tribe_get_venue_label_singular()); ?></h3>
	<div class="cmsmasters_event_meta_info">
		<?php do_action('tribe_events_single_meta_venue_section_start'); ?>

		<div class="cmsmasters_event_meta_info_item">
			<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e('Venue Name:', 'schule'); ?></span>
			<span class="cmsmasters_event_meta_info_item_descr author fn org"><?php echo tribe_get_venue(); ?></span>
		</div>

		<?php if ( tribe_address_exists() ) : ?>
			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e('Address:', 'schule'); ?></span>
				<span class="cmsmasters_event_meta_info_item_descr location tribe-events-address">
					<?php echo tribe_get_full_address(); ?>

					<?php if ( tribe_show_google_map_link() ) : ?>
						<?php echo '<br />' . tribe_get_map_link_html(); ?>
					<?php endif; ?>
				</span>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $phone ) ): ?>
			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Phone:', 'schule' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr tel"><?php echo esc_html( $phone ); ?></span>
			</div>
		<?php endif ?>

		<?php if ( ! empty( $website ) ): ?>
			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Website:', 'schule' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr url"><?php echo wp_kses( $website, 'post' ); ?></span>
			</div>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_venue_section_end' ) ?>
	</div>
</div>