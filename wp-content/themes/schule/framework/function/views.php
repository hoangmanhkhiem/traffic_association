<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Views Functions
 * Changed by CMSMasters
 * 
 */


function cmsmastersView($class = false, $show = false) {
	if (CMSMASTERS_CONTENT_COMPOSER && class_exists('Cmsmasters_Content_Composer')) {
		$post_ID = get_the_ID();
		
		
		$ip = getenv('REMOTE_ADDR');
		
		$ip_name = str_replace('.', '-', $ip);
		
		
		$views = (get_post_meta($post_ID, 'cmsmasters_views', true) != '') ? get_post_meta($post_ID, 'cmsmasters_views', true) : '0';
		
		
		$ipPost = new WP_Query(array( 
			'post_type' => 		'cmsmasters_view', 
			'post_status' => 	'draft', 
			'post_parent' => 	$post_ID, 
			'name' => 			$ip_name 
		));
		
		
		$ipCheck = $ipPost->posts;
		
		
		if (
			is_single() && 
			(
				!isset($_COOKIE['view-' . $post_ID]) || 
				count($ipCheck) == 0
			)
		) {
			$active = ' no_active';
		} elseif (
			isset($_COOKIE['view-' . $post_ID]) || 
			count($ipCheck) != 0
		) {
			$active = ' active';
		} else {
			$active = '';
		}
		
		
		$counter = '<span class="cmsmasters_views' . ($class ? ' ' . $class : '') . '">' . 
			'<span id="cmsmastersView-' . esc_attr($post_ID) . '" class="cmsmastersView cmsmasters_theme_icon_view' . $active . '">' . 
				'<span>' . esc_html($views) . '</span>' . 
			'</span>' . 
		'</span>';
	} else {
		$counter = '';
	}
	
	
	if ($show) {
		echo schule_return_content($counter);
	} else {
		return $counter;
	}
}

