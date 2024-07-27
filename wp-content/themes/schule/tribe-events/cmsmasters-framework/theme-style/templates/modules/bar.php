<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


$filters = tribe_events_get_filters();
$views   = tribe_events_get_views();

$current_url = tribe_events_get_current_filter_url();


do_action('tribe_events_bar_before_template'); 
?>
<div id="tribe-events-bar">
	<form id="tribe-bar-form" class="tribe-clearfix" name="tribe-bar-form" method="post" action="<?php echo esc_attr( $current_url ); ?>">
		
		<!-- Mobile Filters Toggle -->
		<div id="tribe-bar-collapse-toggle" <?php if (count($views) == 1) { ?> class="tribe-bar-collapse-toggle-full-width"<?php } ?>>
			<?php printf( esc_html__( 'Find %s', 'schule' ), tribe_get_event_label_plural() ); ?><span class="tribe-bar-toggle-arrow"></span>
		</div>
		
		
		<?php if ( ! empty( $filters ) ) { ?>
			<div class="tribe-bar-filters">
				<div class="tribe-bar-filters-inner tribe-clearfix">
					<?php foreach ( $filters as $filter ) : ?>
						<div class="<?php echo esc_attr( $filter['name'] ) ?>-filter">
							<label class="label-<?php echo esc_attr( $filter['name'] ) ?>" for="<?php echo esc_attr( $filter['name'] ) ?>"><?php echo wp_kses_post($filter['caption']) ?></label>
							<?php echo schule_return_content($filter['html']); ?>
						</div>
					<?php endforeach; ?>
					<div class="tribe-bar-submit">
						<label>&nbsp;</label>
						<input class="tribe-events-button tribe-no-param" type="submit" name="submit-bar" value="<?php echo esc_attr( sprintf( esc_html__( 'Find %s', 'schule' ), tribe_get_event_label_plural() ) ); ?>" />
					</div>
				</div>
			</div>
		<?php } ?>
		
		
		<!-- Views -->
		<?php if (count($views) > 1) { ?>
		<div id="tribe-bar-views">
			<div class="tribe-bar-views-inner tribe-clearfix">
				<h3 class="tribe-events-visuallyhidden"><?php esc_html_e( 'Event Views Navigation', 'schule' ) ?></h3>
				<label class="button"><?php esc_html_e( 'View as:', 'schule' ); ?></label>
				<select class="tribe-bar-views-select tribe-no-param" name="tribe-bar-view">
						<?php foreach ( $views as $view ) : ?>
						<option <?php echo tribe_is_view( $view['displaying'] ) ? 'selected' : 'tribe-inactive' ?> value="<?php echo esc_attr( $view['url'] ); ?>" data-view="<?php echo esc_attr( $view['displaying'] ); ?>">
							<?php echo schule_return_content($view['anchor']); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<?php } ?>

	</form>
</div>
<?php 
do_action('tribe_events_bar_after_template') ?>

