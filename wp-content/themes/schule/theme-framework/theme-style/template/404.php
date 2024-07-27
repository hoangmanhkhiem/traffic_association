<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * 404 Error Page Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = schule_get_global_options();

?>

</div>

<!-- Start Content -->
<div class="entry">
	<div class="error">
		<div class="error_bg">
			<div class="error_inner">
				<h1 class="error_title"><?php echo esc_html__('404', 'schule'); ?></h1>
				<h4 class="error_subtitle"><?php echo esc_html__("We're sorry, but the page you were looking for doesn't exist.", 'schule'); ?></h4>
			</div>
		</div>
	</div>
</div>
<div class="content_wrap fullwidth">
	<div class="error_cont">
		<?php 
		if ($cmsmasters_option['schule' . '_error_search']) { 
			get_search_form(); 
		}
		
		
		if ($cmsmasters_option['schule' . '_error_sitemap_button'] && $cmsmasters_option['schule' . '_error_sitemap_link'] != '') {
			echo '<div class="error_button_wrap"><a href="' . esc_url($cmsmasters_option['schule' . '_error_sitemap_link']) . '" class="button">' . esc_html__('Sitemap', 'schule') . '</a></div>';
		}
		?>
	</div>
<!-- Finish Content -->