<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.1
 * 
 * Header Bottom Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = schule_get_global_options();


if ($cmsmasters_option['schule' . '_header_styles'] != 'default') {
	echo '<div class="header_bot" data-height="' . esc_attr($cmsmasters_option['schule' . '_header_bot_height']) . '">' . 
		'<div class="header_bot_outer">' . 
			'<div class="header_bot_inner">';
				echo '<span class="header_bot_border_top"></span>';
				
				
				do_action('cmsmasters_before_header_bot', $cmsmasters_option);
				
				
				echo '<div class="resp_bot_nav_wrap">' . 
					'<div class="resp_bot_nav_outer">' . 
						'<a class="responsive_nav resp_bot_nav" href="' . esc_js("javascript:void(0)") . '">' . 
							'<span></span>' . 
						'</a>' . 
					'</div>' . 
				'</div>';
				
				
				if (
					CMSMASTERS_WOOCOMMERCE && 
					$cmsmasters_option['schule' . '_header_styles'] == 'c_nav' 
				) {
					schule_woocommerce_header_cart_link(); 
				}
				
				
				echo '<!-- Start Navigation -->' . 
				'<div class="bot_nav_wrap">' . 
					'<nav>';

						$cmsmasters_mov_bar_content = "";

						if ($cmsmasters_option['schule' . '_header_styles'] != 'default') {
							$cmsmasters_mov_bar_content = '<li class="cmsmasters_mov_bar"><span></span></li>';
						}
						
						$nav_args = array( 
							'theme_location' => 	'primary', 
							'menu_id' => 			'navigation', 
							'menu_class' => 		'bot_nav navigation', 
							'link_before' => 		'<span class="nav_item_wrap">', 
							'link_after' => 		'</span>', 
							'fallback_cb' => 		false,
							'items_wrap' => 		'<ul id="navigation" class="bot_nav navigation">%3$s' . $cmsmasters_mov_bar_content . '</ul>' 
						);
						
						
						if (class_exists('Walker_Cmsmasters_Nav_Mega_Menu')) {
							$nav_args['walker'] = new Walker_Cmsmasters_Nav_Mega_Menu();
						}
						
						
						wp_nav_menu($nav_args);
						
					echo '</nav>' . 
				'</div>' . 
				'<!-- Finish Navigation -->';
				
				
				do_action('cmsmasters_after_header_bot', $cmsmasters_option);
			echo '</div>' . 
		'</div>' . 
	'</div>';
}

