<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.4.6
 * 
 * Projects Post Type
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Projects {
	public function __construct() {
		$current_theme = get_option('template');
		
		$portfolio_project_settings_array = get_option('cmsmasters_options_' . $current_theme . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '_single_project');

		$portfolio_project_slug = 'project';
		$portfolio_pj_categs_slug = 'pj-categs';
		$portfolio_pj_tags_slug = 'pj-tags';
		
		if ( is_array( $portfolio_project_settings_array ) && ! empty( $portfolio_project_settings_array ) ) {
			if ( ! empty( $portfolio_project_settings_array[$current_theme . '_portfolio_project_slug'] ) ) {
				$portfolio_project_slug = $portfolio_project_settings_array[$current_theme . '_portfolio_project_slug'];
			}
			
			if ( ! empty( $portfolio_project_settings_array[$current_theme . '_portfolio_pj_categs_slug'] ) ) {
				$portfolio_pj_categs_slug = $portfolio_project_settings_array[$current_theme . '_portfolio_pj_categs_slug'];
			}
			
			if ( ! empty( $portfolio_project_settings_array[$current_theme . '_portfolio_pj_tags_slug'] ) ) {
				$portfolio_pj_tags_slug = $portfolio_project_settings_array[$current_theme . '_portfolio_pj_tags_slug'];
			}
		}
		
		
		$project_labels = apply_filters('cmsmasters_project_labels_filter', array( 
			'name' => 					__('Projects', 'cmsmasters-content-composer'), 
			'singular_name' => 			__('Project', 'cmsmasters-content-composer'), 
			'menu_name' => 				__('Projects', 'cmsmasters-content-composer'), 
			'all_items' => 				__('All Projects', 'cmsmasters-content-composer'), 
			'add_new' => 				__('Add New', 'cmsmasters-content-composer'), 
			'add_new_item' => 			__('Add New Project', 'cmsmasters-content-composer'), 
			'edit_item' => 				__('Edit Project', 'cmsmasters-content-composer'), 
			'new_item' => 				__('New Project', 'cmsmasters-content-composer'), 
			'view_item' => 				__('View Project', 'cmsmasters-content-composer'), 
			'search_items' => 			__('Search Projects', 'cmsmasters-content-composer'), 
			'not_found' => 				__('No projects found', 'cmsmasters-content-composer'), 
			'not_found_in_trash' => 	__('No projects found in Trash', 'cmsmasters-content-composer') 
		) );
		
		
		$project_args = array( 
			'labels' => 			$project_labels, 
			'query_var' => 			'project', 
			'capability_type' => 	'post', 
			'menu_position' => 		51, 
			'menu_icon' => 			'dashicons-images-alt', 
			'public' => 			true, 
			'show_ui' => 			true, 
			'hierarchical' => 		false, 
			'has_archive' => 		true, 
			'show_in_rest' =>		true, 
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
				'page-attributes', 
				'post-formats' 
			), 
			'rewrite' => array( 
				'slug' => 			$portfolio_project_slug, 
				'with_front' => 	true 
			),
		);
		
		
		register_post_type('project', $project_args);
		
		
		if (function_exists('add_theme_support')) {
			
			// Add post-formats to post_type 'project'
			function cmsmasters_add_post_formats_to_project() {
				add_post_type_support('project', 'post-formats');
				
				register_taxonomy_for_object_type('post_format', 'project');
			}
		}
		
		add_action('init', 'cmsmasters_add_post_formats_to_project', 11);
		
		
		add_filter('manage_edit-project_columns', array(&$this, 'edit_columns'));
		
		add_filter('manage_edit-project_sortable_columns', array(&$this, 'edit_sortable_columns'));
		
		
		$pj_categs_labels = apply_filters('cmsmasters_pj_categs_labels_filter', array( 
			'name' => 					__('Project Categories', 'cmsmasters-content-composer'), 
			'singular_name' => 			__('Project Category', 'cmsmasters-content-composer') 
		) );
		
		
		$pj_categs_args = array (
			'hierarchical' => 		true, 
			'labels' => 			$pj_categs_labels, 
			'rewrite' => array( 
				'slug' => 			$portfolio_pj_categs_slug, 
				'with_front' => 	true 
			),
			'show_in_rest'          => true,
		);
		
		
		register_taxonomy('pj-categs', array('project'), $pj_categs_args);
		
		
		$pj_tags_labels = apply_filters('cmsmasters_pj_tags_labels_filter', array( 
			'name' => 					__('Project Tags', 'cmsmasters-content-composer'), 
			'singular_name' => 			__('Project Tag', 'cmsmasters-content-composer') 
		) );
		
		
		$pj_tags_args = array (
			'hierarchical' => 		false, 
			'labels' => 			$pj_tags_labels, 
			'rewrite' => array( 
				'slug' => 			$portfolio_pj_tags_slug, 
				'with_front' => 	true 
			),
			'show_in_rest' =>		true,
		);
		
		
		register_taxonomy('pj-tags', array('project'), $pj_tags_args);
		
		
		add_action('manage_posts_custom_column', array(&$this, 'custom_columns'));
	}
	
	
	public function edit_columns($columns) {
		unset($columns['author']);
		
		unset($columns['comments']);
		
		unset($columns['date']);
		
		
		$new_columns = array(
			'pj_thumb' => 		__('Thumbnail', 'cmsmasters-content-composer'), 
			'pj_categs' => 		__('Categories', 'cmsmasters-content-composer'), 
			'pj_tags' => 		__('Tags', 'cmsmasters-content-composer'), 
			'date' => 			__('Date', 'cmsmasters-content-composer'), 
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
			case 'pj_thumb':
				if (has_post_thumbnail() != '') {
					echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
						'alt' => 	cmsmasters_title(get_the_ID(), false), 
						'title' => 	cmsmasters_title(get_the_ID(), false), 
						'style' => 	'width:75px; height:75px;' 
					));
				} else {
					echo '<em>' . __('No Thumbnail', 'cmsmasters-content-composer') . '</em>';
				}
				
				
				break;
			case 'pj_categs':
				if (get_the_terms(0, 'pj-categs') != '') {
					$pj_categs = get_the_terms(0, 'pj-categs');
					
					$pj_categs_html = array();
					
					
					foreach ($pj_categs as $pj_categ) {
						array_push($pj_categs_html, '<a href="' . get_term_link($pj_categ->slug, 'pj-categs') . '">' . $pj_categ->name . '</a>');
					}
					
					
					echo implode( ', ', $pj_categs_html );
				} else {
					echo '<em>' . __('Uncategorized', 'cmsmasters-content-composer') . '</em>';
				}
				
				
				break;
			case 'pj_tags':
				if (get_the_terms(0, 'pj-tags') != '') {
					$pj_tags = get_the_terms(0, 'pj-tags');
					
					$pj_tag_html = array();
					
					
					foreach ($pj_tags as $pj_tag) {
						array_push($pj_tag_html, '<a href="' . get_term_link($pj_tag->slug, 'pj-tags') . '">' . $pj_tag->name . '</a>');
					}
					
					
					echo implode( ', ', $pj_tag_html );
				} else {
					echo '<em>' . __('No Tags', 'cmsmasters-content-composer') . '</em>';
				}
				
				
				break;
		}
	}
}


function cmsmasters_projects_init() {
	global $pj;
	
	
	if (defined('CMSMASTERS_PROJECT_COMPATIBLE') && CMSMASTERS_PROJECT_COMPATIBLE) {
		$pj = new Cmsmasters_Projects();
	}
}

add_action('init', 'cmsmasters_projects_init');

