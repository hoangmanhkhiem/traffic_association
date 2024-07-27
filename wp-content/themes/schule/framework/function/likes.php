<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Likes Functions
 * Changed by CMSMasters
 * 
 */


function cmsmasters_like($class = false, $show = false, $add_html = 'false') {
	if (CMSMASTERS_CONTENT_COMPOSER && class_exists('Cmsmasters_Content_Composer')) {
		$post_ID = get_the_ID();
		
		
		$ip = getenv('REMOTE_ADDR');
		
		$ip_name = str_replace('.', '-', $ip);
		
		
		$likes = (get_post_meta($post_ID, 'cmsmasters_likes', true) != '') ? get_post_meta($post_ID, 'cmsmasters_likes', true) : '0';
		
		
		if ($add_html == 'true') {
			$text = ($likes == '1') ? esc_html__('like', 'schule') : esc_html__('likes', 'schule');
		} else {
			$text = '';
		}
		
		
		$ipPost = new WP_Query(array( 
			'post_type' => 		'cmsmasters_like', 
			'post_status' => 	'draft', 
			'post_parent' => 	$post_ID, 
			'name' => 			$ip_name 
		));
		
		
		$ipCheck = $ipPost->posts;
		
		
		if (
			isset($_COOKIE['like-' . $post_ID]) || 
			count($ipCheck) != 0
		) {
			$onclick = 'return false;';
			$active = ' active';
		} else {
			$onclick = 'cmsmastersLike(' . esc_attr($post_ID) . ', ' . $add_html . '); return false;';
			$active = '';
		}
		
		
		$counter = '<span class="cmsmasters_likes' . ($class ? ' ' . $class : '') . '">' . 
			'<a href="#" onclick="' . $onclick . '" id="cmsmastersLike-' . esc_attr($post_ID) . '" class="cmsmastersLike cmsmasters_theme_icon_like' . $active . '">' . 
				'<span>' . esc_html($likes) . ' ' . $text . '</span>' . 
			'</a>' . 
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

