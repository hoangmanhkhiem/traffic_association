<?php 
/**
 * @package 	WordPress
 * @subpackage 	schule
 * @version 	1.0.0
 * 
 * LearnPress Admin Options
 * Created by CMSMasters
 * 
 */


/* Filter for Options */
function schule_learnpress_meta_fields($custom_all_meta_fields) {
	$cmsmasters_option = schule_get_global_options();
	
	
	$cmsmasters_global_lpr_post_layout = (isset($cmsmasters_option['schule' . '_lpr_post_layout']) && $cmsmasters_option['schule' . '_lpr_post_layout'] !== '') ? $cmsmasters_option['schule' . '_lpr_post_layout'] : 'fullwidth';
	
	$cmsmasters_global_lpr_course_title = (isset($cmsmasters_option['schule' . '_lpr_course_title']) && $cmsmasters_option['schule' . '_lpr_course_title'] !== '') ? (($cmsmasters_option['schule' . '_lpr_course_title'] == 1) ? 'true' : 'false') : 'true';
	
	$cmsmasters_global_lpr_course_image = (isset($cmsmasters_option['schule' . '_lpr_course_image']) && $cmsmasters_option['schule' . '_lpr_course_image'] !== '') ? (($cmsmasters_option['schule' . '_lpr_course_image'] == 1) ? 'true' : 'false') : 'true';
	
	
	$custom_all_meta_fields_new = array();
	
	
	if (
		(isset($_GET['post_type']) && $_GET['post_type'] == 'lp_course') || 
		(isset($_POST['post_type']) && $_POST['post_type'] == 'lp_course') || 
		(isset($_GET['post']) && get_post_type($_GET['post']) == 'lp_course') 
	) {
		foreach ($custom_all_meta_fields as $custom_all_meta_field) {
			if ($custom_all_meta_field['id'] == 'cmsmasters_other_tabs') {
				$custom_all_meta_field['std'] = 'cmsmasters_lpr_course';
				
				
				$tabs_array = array();
				
				$tabs_array['cmsmasters_lpr_course'] = array( 
					'label' => esc_html__('Course', 'schule'), 
					'value'	=> 'cmsmasters_lpr_course' 
				);
				
				
				foreach ($custom_all_meta_field['options'] as $key => $val) {
					$tabs_array[$key] = $val;
				}
				
				
				$custom_all_meta_field['options'] = $tabs_array;
				
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_layout' && 
				$custom_all_meta_field['type'] == 'tab_start'
			) {
				$custom_all_meta_field['std'] = '';
				
				
				$custom_all_meta_fields_new[] = array( 
					'id'	=> 'cmsmasters_lpr_course', 
					'type'	=> 'tab_start', 
					'std'	=> 'true' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Course Title', 'schule'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_lpr_course_title', 
					'type'	=> 'checkbox', 
					'hide'	=> '', 
					'std'	=> $cmsmasters_global_lpr_course_title 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Course Featured Image', 'schule'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_lpr_course_image', 
					'type'	=> 'checkbox', 
					'hide'	=> '', 
					'std'	=> $cmsmasters_global_lpr_course_image 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'id'	=> 'cmsmasters_lpr_course', 
					'type'	=> 'tab_finish' 
				);
				
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_layout' && 
				$custom_all_meta_field['type'] != 'tab_start' && 
				$custom_all_meta_field['type'] != 'tab_finish'
			) {
				
				$custom_all_meta_field['std'] = $cmsmasters_global_lpr_post_layout;
				
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} else {
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			}
		}
	} else {
		$custom_all_meta_fields_new = $custom_all_meta_fields;
	}
	
	
	return $custom_all_meta_fields_new;
}

add_filter('get_custom_all_meta_fields_filter', 'schule_learnpress_meta_fields');



function schule_learnpress_remove_custom_meta_box() {
	if (get_post_type() == 'lp_quiz') {
		remove_meta_box( 
			'cmsmasters_custom_meta_box', 
			'lp_quiz', 
			'normal' 
		);
	}
}

add_action('add_meta_boxes', 'schule_learnpress_remove_custom_meta_box');
