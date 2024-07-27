<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.0.0
 * 
 * Likes Post Type
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Likes {
	public function __construct() {
		$like_labels = array( 
			'name' => esc_html__('Likes', 'cmsmasters-content-composer'), 
			'singular_name' => esc_html__('Like', 'cmsmasters-content-composer') 
		);
		
		
		$like_args = array( 
			'labels' => $like_labels, 
			'public' => false, 
			'capability_type' => 'post', 
			'hierarchical' => false, 
			'exclude_from_search' => true, 
			'publicly_queryable' => false, 
			'show_ui' => false, 
			'show_in_nav_menus' => false 
		);
		
		
		register_post_type('cmsmasters_like', $like_args);
	}
}


function cmsmasters_likes_init() {
	global $lk;
	
	
	$lk = new Cmsmasters_Likes();
}

add_action('init', 'cmsmasters_likes_init');

