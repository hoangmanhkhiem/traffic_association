<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.0.0
 * 
 * Views Post Type
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Views {
	public function __construct() {
		$view_labels = array( 
			'name' => esc_html__('Views', 'cmsmasters-content-composer'), 
			'singular_name' => esc_html__('View', 'cmsmasters-content-composer') 
		);
		
		
		$view_args = array( 
			'labels' => $view_labels, 
			'public' => false, 
			'capability_type' => 'post', 
			'hierarchical' => false, 
			'exclude_from_search' => true, 
			'publicly_queryable' => false, 
			'show_ui' => false, 
			'show_in_nav_menus' => false 
		);
		
		
		register_post_type('cmsmasters_view', $view_args);
	}
}


function cmsmasters_views_init() {
	global $lk;
	
	
	$lk = new Cmsmasters_Views();
}

add_action('init', 'cmsmasters_views_init');

