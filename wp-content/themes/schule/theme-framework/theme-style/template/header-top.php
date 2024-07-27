<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Header Top Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = schule_get_global_options();


if ($cmsmasters_option['schule' . '_header_top_line']) {
	echo '<div class="header_top" data-height="' . esc_attr($cmsmasters_option['schule' . '_header_top_height']) . '">' . 
		'<div class="header_top_outer">' . 
			'<div class="header_top_inner">';
				do_action('cmsmasters_before_header_top', $cmsmasters_option);
				
				
				if (
					(class_exists('Cmsmasters_Content_Composer') && $cmsmasters_option['schule' . '_header_top_line_social']) || 
					$cmsmasters_option['schule' . '_header_top_line_short_info'] !== '' 
				) {
					echo '<div class="header_top_right">';
					
					
					if (
						$cmsmasters_option['schule' . '_header_top_line_social'] && 
						isset($cmsmasters_option['schule' . '_social_icons'])
					) {
						// schule_social_icons();
					}
					
					
					if ($cmsmasters_option['schule' . '_header_top_line_short_info'] !== '') {
						echo '<div class="meta_wrap">' . 
							stripslashes($cmsmasters_option['schule' . '_header_top_line_short_info']) . 
						'</div>';
					}
					
					
					echo '</div>';
				}
				
				
				if (
					$cmsmasters_option['schule' . '_header_top_line_nav'] && 
					has_nav_menu('top_line')
				) {
					echo '<div class="header_top_left">' . 
						'<div class="top_nav_wrap">' . 
							'<a class="responsive_top_nav" href="' . esc_js("javascript:void(0)") . '">' . 
								'<span></span>' . 
							'</a>' . 
							'<nav>';
								
								wp_nav_menu(array( 
									'theme_location' => 	'top_line', 
									'menu_id' => 			'top_line_nav', 
									'menu_class' => 		'top_line_nav', 
									'link_before' => 		'<span class="nav_item_wrap">', 
									'link_after' => 		'</span>' 
								));
								
							echo '</nav>' . 
						'</div>' . 
					'</div>';
				}
				
				
				do_action('cmsmasters_after_header_top', $cmsmasters_option);
			echo '</div>' . 
		'</div>' . 
		'<div class="header_top_but closed">' . 
			'<span class="cmsmasters_theme_icon_slide_bottom"></span>' . 
		'</div>' . 
	'</div>';
}

