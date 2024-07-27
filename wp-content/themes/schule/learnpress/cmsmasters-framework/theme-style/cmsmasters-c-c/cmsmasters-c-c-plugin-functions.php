<?php
/**
 * @package 	WordPress
 * @subpackage 	schule
 * @version 	1.0.0
 * 
 * LearnPress Content Composer Functions 
 * Created by CMSMasters
 * 
 */


/* Register JS Scripts */
function schule_learnpress_register_c_c_scripts() {
	global $pagenow;
	
	
	if ( 
		$pagenow == 'post-new.php' || 
		($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
	) {
		wp_enqueue_script('schule-learnpress-extend', get_template_directory_uri() . '/learnpress/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/cmsmasters-c-c/js/cmsmasters-c-c-plugin-extend.js', array('cmsmasters_composer_shortcodes_js'), '1.0.0', true);
		
		wp_localize_script('schule-learnpress-extend', 'cmsmasters_learnpress_shortcodes', array( 
			'course_categories' => 						schule_learnpress_course_categories(),
			'learnpress_title' => 						esc_html__('Courses', 'schule'),
			'course_field_orderby_descr' => 			esc_html__('Choose your courses order by parameter', 'schule'),
			'course_field_categories_descr' => 			esc_html__('Show courses associated with certain categories.', 'schule'),
			'course_field_categories_descr_note' => 	esc_html__('If you don\'t choose any course categories, all your courses will be shown', 'schule'),
			'course_field_postsnumber_title' => 		esc_html__('Courses Number', 'schule'),
			'course_field_postsnumber_descr' => 		esc_html__('Enter the number of courses to be shown in shortcode', 'schule'),
			'course_field_postsnumber_descr_note' =>	esc_html__('number, if empty - show all courses', 'schule'),
			'course_field_col_count_descr' =>			esc_html__('Choose number of courses per row', 'schule') 
		));
	}
}

add_action('admin_enqueue_scripts', 'schule_learnpress_register_c_c_scripts');


/* Course Categories */
function schule_learnpress_course_categories() {
	$categories = get_terms('course_category', array( 
		'hide_empty' => 0 
	));
	
	
	$out = array();
	
	
	if (!empty($categories)) {
		foreach ($categories as $category) {
			$out[urldecode(esc_attr($category->slug))] = esc_html($category->name);
		}
	}
	
	
	return $out;
}

