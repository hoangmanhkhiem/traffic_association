<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.4.6
 * 
 * Profiles Post Type
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Profiles {
	public function __construct() {
		$current_theme = get_option('template');
		
		$profile_post_settings_array = get_option('cmsmasters_options_' . $current_theme . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '_single_profile');

		$profile_post_slug = 'profile';
		$profile_pl_categs_slug = 'pl-categs';
		
		if ( is_array( $profile_post_settings_array ) && ! empty( $profile_post_settings_array ) ) {
			if ( ! empty( $profile_post_settings_array[$current_theme . '_profile_post_slug'] ) ) {
				$profile_post_slug = $profile_post_settings_array[$current_theme . '_profile_post_slug'];
			}
			
			if ( ! empty( $profile_post_settings_array[$current_theme . '_profile_pl_categs_slug'] ) ) {
				$profile_pl_categs_slug = $profile_post_settings_array[$current_theme . '_profile_pl_categs_slug'];
			}
		}
		
		
		$profile_labels = apply_filters('cmsmasters_profile_labels_filter', array( 
			'name' => 					__('Profiles', 'cmsmasters-content-composer'), 
			'singular_name' => 			__('Profiles', 'cmsmasters-content-composer'), 
			'menu_name' => 				__('Profiles', 'cmsmasters-content-composer'), 
			'all_items' => 				__('All Profiles', 'cmsmasters-content-composer'), 
			'add_new' => 				__('Add New', 'cmsmasters-content-composer'), 
			'add_new_item' => 			__('Add New Profile', 'cmsmasters-content-composer'), 
			'edit_item' => 				__('Edit Profile', 'cmsmasters-content-composer'), 
			'new_item' => 				__('New Profile', 'cmsmasters-content-composer'), 
			'view_item' => 				__('View Profile', 'cmsmasters-content-composer'), 
			'search_items' => 			__('Search Profiles', 'cmsmasters-content-composer'), 
			'not_found' => 				__('No Profiles found', 'cmsmasters-content-composer'), 
			'not_found_in_trash' => 	__('No Profiles found in Trash', 'cmsmasters-content-composer') 
		) );
		
		
		$profile_args = array( 
			'labels' => 			$profile_labels, 
			'query_var' => 			'profile', 
			'capability_type' => 	'post', 
			'menu_position' => 		52, 
			'menu_icon' => 			'dashicons-id', 
			'public' => 			true, 
			'show_ui' => 			true, 
			'hierarchical' => 		false, 
			'has_archive' => 		true, 
			'show_in_rest' =>		true, 
			'supports' => array( 
				'title', 
				'editor', 
				'thumbnail', 
				'excerpt', 
				'trackbacks', 
				'custom-fields', 
				'comments', 
				'revisions', 
				'page-attributes' 
			), 
			'rewrite' => array( 
				'slug' => 			$profile_post_slug, 
				'with_front' => 	true 
			) 
		);
		
		
		register_post_type('profile', $profile_args);
		
		
		add_filter('manage_edit-profile_columns', array(&$this, 'edit_columns'));
		
		add_filter('manage_edit-profile_sortable_columns', array(&$this, 'edit_sortable_columns'));
		
		
		$pl_categs_labels = apply_filters('cmsmasters_pl_categs_labels_filter', array( 
			'name' => 					__('Profile Categories', 'cmsmasters-content-composer'), 
			'singular_name' => 			__('Profile Category', 'cmsmasters-content-composer') 
		) );
		
		
		$pl_categs_args = array (
			'hierarchical' => 		true, 
			'labels' => 			$pl_categs_labels, 
			'rewrite' => array( 
				'slug' => 			$profile_pl_categs_slug, 
				'with_front' => 	true 
			),
			'show_in_rest' =>		true,
		);
		
		register_taxonomy('pl-categs', array('profile'), $pl_categs_args);
		
		
		add_action('manage_posts_custom_column', array(&$this, 'custom_columns'));
	}
	
	
	public function edit_columns($columns) {
		unset($columns['author']);
		
		unset($columns['comments']);
		
		unset($columns['date']);
		
		
		$new_columns = array( 
			'cb' => 			'<input type="checkbox" />', 
			'title' => 			__('Title', 'cmsmasters-content-composer'), 
			'pl_avatar' => 		__('Avatar', 'cmsmasters-content-composer'), 
			'pl_categs' => 		__('Categories', 'cmsmasters-content-composer'), 
			'comments' => 		'<span class="vers"><div title="' . __('Comments', 'cmsmasters-content-composer') . '" class="comment-grey-bubble"></div></span>', 
			'menu_order' => 	'<span class="vers"><div class="dashicons dashicons-sort" title="' . __('Order', 'cmsmasters-content-composer') . '"></div></span>' 
		);
		
		
		$result_columns = array_merge($columns, $new_columns);
		
		
		return $result_columns;
	}
	
	
	public function edit_sortable_columns($columns) {
		$columns['menu_order'] = 'menu_order';
		
		
		return $columns;
	}
	
	
	public function custom_columns($column) {
		switch ($column) {
			case 'pl_avatar':
				if (has_post_thumbnail() != '') {
					echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
						'alt' => cmsmasters_title(get_the_ID(), false), 
						'title' => cmsmasters_title(get_the_ID(), false), 
						'style' => 'width:75px; height:75px;' 
					));
				} else {
					echo '<em>' . __('No Avatar', 'cmsmasters-content-composer') . '</em>';
				}
				
				
				break;
			case 'pl_categs':
				if (get_the_terms(0, 'pl-categs') != '') {
					$pl_categs = get_the_terms(0, 'pl-categs');
					
					$pl_categs_html = array();
					
					
					foreach ($pl_categs as $pl_categ) {
						array_push($pl_categs_html, '<a href="' . get_term_link($pl_categ->slug, 'pl-categs') . '">' . $pl_categ->name . '</a>');
					}
					
					
					echo implode( ', ', $pl_categs_html );
				} else {
					echo '<em>' . __('Uncategorized', 'cmsmasters-content-composer') . '</em>';
				}
				
				
				break;
			case 'menu_order':
				$custom_pl_post = get_post(get_the_ID());
				
				$custom_pl_ord = $custom_pl_post->menu_order;
				
				
				echo $custom_pl_ord;
				
				
				break;
		}
	}
}


function cmsmasters_profiles_init() {
	global $pl;
	
	
	if (defined('CMSMASTERS_PROFILE_COMPATIBLE') && CMSMASTERS_PROFILE_COMPATIBLE) {
		$pl = new Cmsmasters_Profiles();
	}
}

add_action('init', 'cmsmasters_profiles_init');

