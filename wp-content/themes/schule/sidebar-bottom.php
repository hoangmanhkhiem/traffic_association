<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * Sidebar Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = schule_get_global_options();

if (is_singular()) {
	$cmsmasters_page_id = get_the_ID();
} elseif (CMSMASTERS_WOOCOMMERCE && is_shop()) {
	$cmsmasters_page_id = wc_get_page_id('shop');
}


if ( 
	is_singular() || 
	(CMSMASTERS_WOOCOMMERCE && is_shop())
) {
	$cmsmasters_bottom_sidebar = get_post_meta($cmsmasters_page_id, 'cmsmasters_bottom_sidebar', true) !== '' ? get_post_meta($cmsmasters_page_id, 'cmsmasters_bottom_sidebar', true) : ($cmsmasters_option['schule' . '_bottom_sidebar'] == 1 ? 'true' : 'false');
	
	$cmsmasters_bottom_sidebar_layout = get_post_meta($cmsmasters_page_id, 'cmsmasters_bottom_sidebar_layout', true) !== '' ? get_post_meta($cmsmasters_page_id, 'cmsmasters_bottom_sidebar_layout', true) : $cmsmasters_option['schule' . '_bottom_sidebar_layout'];
} else {
	$cmsmasters_bottom_sidebar = $cmsmasters_option['schule' . '_bottom_sidebar'] == 1 ? 'true' : 'false';
	
	$cmsmasters_bottom_sidebar_layout = $cmsmasters_option['schule' . '_bottom_sidebar_layout'];
}

 
if (isset($cmsmasters_page_id)) {
	$bottom_sidebar_id = get_post_meta($cmsmasters_page_id, 'cmsmasters_bottom_sidebar_id', true);
}	


if ( 
	!is_home() && 
	!is_404() && 
	$cmsmasters_bottom_sidebar == 'true' && 
	(
		(isset($bottom_sidebar_id) && is_dynamic_sidebar($bottom_sidebar_id) && is_active_sidebar($bottom_sidebar_id)) || 
		is_active_sidebar('sidebar_bottom')
	)
) { ?>
	<!-- Start Bottom -->
	<div id="bottom" class="cmsmasters_color_scheme_<?php echo esc_html($cmsmasters_option['schule' . '_bottom_scheme']) ?>">
		<div class="bottom_bg">
			<div class="bottom_outer">
				<div class="bottom_inner sidebar_layout_<?php echo esc_html($cmsmasters_bottom_sidebar_layout) ?>">
	<?php 
	if (isset($bottom_sidebar_id) && is_dynamic_sidebar($bottom_sidebar_id) && is_active_sidebar($bottom_sidebar_id)) {
		dynamic_sidebar($bottom_sidebar_id);
	} else if (is_active_sidebar('sidebar_bottom')) {
		dynamic_sidebar('sidebar_bottom');
	}
	
	?>
				</div>
			</div>
		</div>
	</div>
	<!-- Finish Bottom -->
	<?php 
}

