<?php 
/**
 * @package 	WordPress
 * @subpackage 	schule
 * @version 	1.0.0
 * 
 * LearnPress Admin Settings
 * Created by CMSMasters
 * 
 */


/* Filters for Settings */
// Settings Names
function schule_learnpress_option_name($cmsmasters_option_name, $tab) {
	if ($tab == 'lpr_course') {
		$cmsmasters_option_name = 'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_single_lpr_course';
	}
	
	
	return $cmsmasters_option_name;
}

add_filter('cmsmasters_option_name_filter', 'schule_learnpress_option_name', 10, 2);


// Add Settings
function schule_learnpress_add_global_options($cmsmasters_option_names) {
	$cmsmasters_option_names[] = array( 
		'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_single_lpr_course', 
		schule_options_single_fields('lpr_course') 
	);
	
	
	return $cmsmasters_option_names;
}

add_filter('cmsmasters_add_global_options_filter', 'schule_learnpress_add_global_options');


// Get Settings
function schule_learnpress_get_global_options($cmsmasters_option_names) {
	array_push($cmsmasters_option_names, 'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_single_lpr_course');
	
	
	return $cmsmasters_option_names;
}

add_filter('cmsmasters_get_global_options_filter', 'schule_learnpress_get_global_options');
add_filter('cmsmasters_settings_export_filter', 'schule_learnpress_get_global_options');


// Single Posts Settings
function schule_learnpress_options_single_tabs($tabs) {
	$tabs['lpr_course'] = esc_attr__('Course', 'schule');
	
	
	return $tabs;
}

add_filter('cmsmasters_options_single_tabs_filter', 'schule_learnpress_options_single_tabs');


function schule_learnpress_options_single_sections($sections, $tab) {
	if ($tab == 'lpr_course') {
		$sections = array();
		
		$sections['lpr_course_section'] = esc_attr__('LearnPress Course Options', 'schule');
	}
	
	
	return $sections;
}

add_filter('cmsmasters_options_single_sections_filter', 'schule_learnpress_options_single_sections', 10, 2);


function schule_learnpress_options_single_fields($options, $tab) {
	if ($tab == 'lpr_course') {
		$options[] = array( 
			'section' => 'lpr_course_section', 
			'id' => 'schule' . '_lpr_post_layout', 
			'title' => esc_html__('Layout Type', 'schule'), 
			'desc' => '', 
			'type' => 'radio_img', 
			'std' => 'fullwidth', 
			'choices' => array( 
				esc_html__('Right Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lpr_course_section', 
			'id' => 'schule' . '_lpr_course_title', 
			'title' => esc_html__('Course Title', 'schule'), 
			'desc' => esc_html__('show', 'schule'),  
			'type' => 'checkbox', 
			'std' => 1
		);
		
		$options[] = array( 
			'section' => 'lpr_course_section', 
			'id' => 'schule' . '_lpr_course_image', 
			'title' => esc_html__('Course Featured Image', 'schule'), 
			'desc' => esc_html__('show', 'schule'),  
			'type' => 'checkbox', 
			'std' => 1
		);
	}
	
	
	return $options;
}

add_filter('cmsmasters_options_single_fields_filter', 'schule_learnpress_options_single_fields', 10, 2);

