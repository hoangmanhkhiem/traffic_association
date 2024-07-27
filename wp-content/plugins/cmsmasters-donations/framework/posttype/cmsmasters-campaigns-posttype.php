<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.3.6
 * 
 * CMSMasters Donations Campaigns Post Type
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Campaigns_Post_Type {
	public function __construct() {
		$current_theme = get_option('template');

		$donations_campaign_settings_array = get_option( 'cmsmasters_options_' . $current_theme . '_single_campaign' );

		$donations_campaign_slug = ( $donations_campaign_settings_array ? $donations_campaign_settings_array[ $current_theme . '_donations_campaign_slug' ] : '' );

		$campaign_labels = array(
			'name' => 					__('Campaigns', 'cmsmasters-donations'),
			'singular_name' => 			__('Campaign', 'cmsmasters-donations'),
			'menu_name' => 				__('Campaigns', 'cmsmasters-donations'),
			'all_items' => 				__('All Campaigns', 'cmsmasters-donations'),
			'add_new' => 				__('Add New', 'cmsmasters-donations'),
			'add_new_item' => 			__('Add New Campaign', 'cmsmasters-donations'),
			'edit_item' => 				__('Edit Campaign', 'cmsmasters-donations'),
			'new_item' => 				__('New Campaign', 'cmsmasters-donations'),
			'view_item' => 				__('View Campaign', 'cmsmasters-donations'),
			'search_items' => 			__('Search Campaigns', 'cmsmasters-donations'),
			'not_found' => 				__('No campaigns found', 'cmsmasters-donations'),
			'not_found_in_trash' => 	__('No campaigns found in Trash', 'cmsmasters-donations')
		);

		$campaign_args = array(
			'labels' => 			$campaign_labels, 
			'query_var' => 			'campaign', 
			'capability_type' => 	'post', 
			'menu_position' => 		53, 
			'menu_icon' => 			'dashicons-megaphone', 
			'public' => 			true, 
			'show_ui' => 			true, 
			'hierarchical' => 		false, 
			'has_archive' => 		true, 
			'supports' => array( 
				'title', 
				'editor', 
				'author', 
				'thumbnail', 
				'excerpt', 
				'trackbacks', 
				'custom-fields', 
				'comments', 
				'revisions', 
				'page-attributes' 
			), 
			'rewrite' => array( 
				'slug' => 			(isset($donations_campaign_slug) && $donations_campaign_slug != '') ? $donations_campaign_slug : 'campaign', 
				'with_front' => 	true 
			) 
		);
		
		
		register_post_type('campaign', $campaign_args);
		
		
		add_filter('manage_edit-campaign_columns', array(&$this, 'edit_columns'));
		
		add_filter('manage_edit-campaign_sortable_columns', array(&$this, 'edit_sortable_columns'));
		
		add_filter('request', array(&$this, 'sortable_columns_orderby'));
		
		
		register_taxonomy('cp-categs', array('campaign'), array( 
			'hierarchical' => 		true, 
			'label' => 				__('Campaign Categories', 'cmsmasters-donations'), 
			'singular_label' => 	__('Campaign Category', 'cmsmasters-donations'), 
			'rewrite' => array( 
				'slug' => 			'cp-categs', 
				'with_front' => 	true 
			) 
		));
		
		
		register_taxonomy('cp-tags', array('campaign'), array( 
			'hierarchical' => 		false, 
			'label' => 				__('Campaign Tags', 'cmsmasters-donations'), 
			'singular_label' => 	__('Campaign Tag', 'cmsmasters-donations'), 
			'rewrite' => array( 
				'slug' => 			'cp-tags', 
				'with_front' => 	true 
			) 
		));
		
		
		add_action('manage_posts_custom_column', array(&$this, 'custom_columns'));
	}
	
	
	public function edit_columns($columns) {
		unset($columns['author']);
		
		unset($columns['comments']);
		
		unset($columns['date']);
		
		
		$new_columns = array(
			'cp_thumb' => 		__('Thumbnail', 'cmsmasters-donations'), 
			'cp_target' => 		__('Target', 'cmsmasters-donations'), 
			'cp_funds' => 		__('Funds', 'cmsmasters-donations'), 
			'cp_categs' => 		__('Categories', 'cmsmasters-donations'), 
			'date' => 			__('Date', 'cmsmasters-donations'), 
			'comments' => 		'<span class="vers"><div title="' . __('Comments', 'cmsmasters-donations') . '" class="comment-grey-bubble"></div></span>', 
			'menu_order' => 	'<span class="vers"><div class="dashicons dashicons-sort" title="' . __('Order', 'cmsmasters-donations') . '"></div></span>' 
		);
		
		
		$result_columns = array_merge($columns, $new_columns);
		
		
		return $result_columns;
	}
	
	
	public function edit_sortable_columns($columns) {
		$columns['cp_target'] = 'cp_target';
		
		$columns['cp_funds'] = 'cp_funds';
		
		$columns['menu_order'] = 'menu_order';
		
		
		return $columns;
	}
	
	
	public function sortable_columns_orderby($query) {
		if (isset($query['orderby'])) {
			if ($query['orderby'] == 'cp_target') {
				$query = array_merge($query, array( 
					'meta_key' => 	'cmsmasters_campaign_target', 
					'orderby' => 	'meta_value_num' 
				) );
			} elseif ($query['orderby'] == 'cp_funds') {
				$query = array_merge($query, array( 
					'meta_key' => 	'cmsmasters_campaign_funds', 
					'orderby' => 	'meta_value_num' 
				) );
			}
		}
		
		
		return $query;
	}
	
	
	public function custom_columns($column) {
		switch ($column) {
			case 'cp_thumb':
				if (has_post_thumbnail() != '') {
					echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
						'alt' => 	cmsmasters_title(get_the_ID(), false), 
						'title' => 	cmsmasters_title(get_the_ID(), false), 
						'style' => 	'width:75px; height:75px;' 
					));
				} else {
					echo '<em>' . __('No Thumbnail', 'cmsmasters-donations') . '</em>';
				}
				
				
				break;
			case 'cp_target':
				global $post;
				
				
				$target = get_the_campaign_target($post->ID);
				
				
				echo cmsmasters_donations_currency($target);
				
				
				break;
			case 'cp_funds':
				global $post;
				
				
				$admin_post_object = $post;
				
				
				$target = get_the_campaign_target($admin_post_object->ID);
				
				$funds = get_the_funds($admin_post_object->ID);
				
				$funds_number = get_the_funds($admin_post_object->ID, true);
				
				
				echo '<strong>' . ($target != 0 ? round(((100 / $target) * $funds), 1) : 0) . '%</strong>' . 
				'<br />' . 
				'<strong>' . cmsmasters_donations_currency(round($funds, 2)) . '</strong>' . 
				'<br />' . 
				'<span>' . __('count', 'cmsmasters-donations') . ' - <strong>' . $funds_number . '</strong></span>' . 
				'<br />' . 
				'<span>' . cmsmasters_donations_currency(round(($target - $funds), 2)) . ' ' . __('to go', 'cmsmasters-donations') . '</span>';
				
				
				$post = $admin_post_object;
				
				
				break;
			case 'cp_categs':
				if (get_the_terms(0, 'cp-categs') != '') {
					$cp_categs = get_the_terms(0, 'cp-categs');
					
					$cp_categs_html = array();
					
					
					foreach ($cp_categs as $cp_categ) {
						array_push($cp_categs_html, '<a href="' . get_term_link($cp_categ->slug, 'cp-categs') . '">' . $cp_categ->name . '</a>');
					}
					
					
					echo implode(', ', $cp_categs_html);
				} else {
					echo '<em>' . __('Uncategorized', 'cmsmasters-donations') . '</em>';
				}
				
				
				break;
		}
	}
}


function cmsmasters_campaigns_posttype_init() {
	global $cp;
	
	
	$cp = new Cmsmasters_Campaigns_Post_Type();
}

add_action('init', 'cmsmasters_campaigns_posttype_init');

