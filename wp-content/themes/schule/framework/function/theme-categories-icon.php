<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Category icons
 * Created by CMSMasters
 * 
 */


/* Add Category Icon */
function schule_add_category_icon() {
	wp_register_script('schule-settings-js', get_template_directory_uri() . '/framework/admin/settings/js/cmsmasters-theme-settings.js', array('jquery', 'farbtastic'), '1.0.0', true);
	
	
	wp_enqueue_script('schule-settings-js');
	
	$id = 'cmsmasters_cat_icon';
	
	echo 
		'<label for="term_meta[cmsmasters_cat_icon]">' . esc_html__('Category Icon', 'schule') . '</label>' . 
		'<div class="icon_management form-field">' . 
		'<p>' . 
			'<input class="icon_upload_image all-options" type="hidden" id="' . $id . '" name="term_meta[cmsmasters_cat_icon]" value="" />' . 
			'<span id="' . $id . '_icon" class="cmsmasters_di_important" data-class="cmsmasters_new_icon_img"></span>' . 
			'<input id="' . $id . '_button" class="cmsmasters_icon_choose_button button" type="button" value="' . esc_attr__('Choose icon', 'schule') . '" />' . 
			'<a href="#" class="cmsmasters_remove_icon admin-icon-remove" title="' . esc_attr__('Cancel changes', 'schule') . '"></a>' . 
		'</p>' . 
	'</div>';
}



/* Edit Category Icon */
function schule_edit_category_icon($term) {
	wp_register_script('schule-settings-js', get_template_directory_uri() . '/framework/admin/settings/js/cmsmasters-theme-settings.js', array('jquery', 'farbtastic'), '1.0.0', true);
	
	wp_enqueue_script('schule-settings-js');
	
	
	$id = 'cmsmasters_cat_icon';
	
	$term_meta = get_term_meta($term->term_id, 'cmsmasters_cat_icon', true);
	
	echo '<tr class="form-field">' . 
		'<th scope="row" valign="top">' . 
			'<label>' . esc_html__('Category Icon', 'schule') . '</label>' . 
		'</th>' . 
		'<td>' . 
			'<div class="icon_management cmsmasters_category_icons">' . 
				'<p>' . 
					'<input class="icon_upload_image all-options" type="hidden" id="' . $id . '" name="term_meta[cmsmasters_cat_icon]" value="'. (esc_attr($term_meta) ? esc_attr($term_meta) : '') .'" />' . 
					'<span id="' . $id . '_icon" data-class="cmsmasters_new_icon_img" class="'. $term_meta .' cmsmasters_di_important"></span>' . 
					'<input id="' . $id . '_button" class="cmsmasters_icon_choose_button button" type="button" value="' . esc_attr__('Choose icon', 'schule') . '" />' . 
					'<a href="#" class="cmsmasters_remove_icon admin-icon-remove' . ($term_meta ? ' cmsmasters_di': '') . '" title="' . esc_attr__('Cancel changes', 'schule') . '"></a>' . 
				'</p>' . 
			'</div>' . 
		'</td>' . 
	'</tr>';
}



/* Save Category Icon */
function schule_save_category_icon($term_id) {
	if (isset($_POST['term_meta'])) {
		$term_meta = get_term_meta($term_id, 'cmsmasters_cat_icon', true);
		
		$cat_keys = array_keys($_POST['term_meta']);
		
		$new_term_meta = '';
		
		
		foreach ($cat_keys as $key) {
			if ($key == 'cmsmasters_cat_icon') {
				$new_term_meta = $_POST['term_meta'][$key];
			}
		}
		
		
		if ($new_term_meta != '') {
			if ($term_meta && $term_meta != '') {
				update_term_meta($term_id, 'cmsmasters_cat_icon', $new_term_meta);
			} else {
				add_term_meta($term_id, 'cmsmasters_cat_icon', $new_term_meta, true);
			}
		}
	}
}

if (apply_filters('cmsmasters_post_compatibility', false)) {
	add_action('category' . '_add_form_fields', 'schule_add_category_icon', 10, 2);
	add_action('category' . '_edit_form_fields', 'schule_edit_category_icon', 10, 2);
	add_action('edited_' . 'category', 'schule_save_category_icon', 10, 2);  
	add_action('create_' . 'category', 'schule_save_category_icon', 10, 2);
}


if (apply_filters('cmsmasters_project_compatibility', false)) {
	add_action('pj-categs' . '_add_form_fields', 'schule_add_category_icon', 10, 2);
	add_action('pj-categs' . '_edit_form_fields', 'schule_edit_category_icon', 10, 2);
	add_action('edited_' . 'pj-categs', 'schule_save_category_icon', 10, 2);  
	add_action('create_' . 'pj-categs', 'schule_save_category_icon', 10, 2);
}


if (apply_filters('cmsmasters_profile_compatibility', false)) {
	add_action('pl-categs' . '_add_form_fields', 'schule_add_category_icon', 10, 2);
	add_action('pl-categs' . '_edit_form_fields', 'schule_edit_category_icon', 10, 2);
	add_action('edited_' . 'pl-categs', 'schule_save_category_icon', 10, 2);  
	add_action('create_' . 'pl-categs', 'schule_save_category_icon', 10, 2);
}


if (
	CMSMASTERS_WOOCOMMERCE && 
	apply_filters('cmsmasters_woocommerce_compatibility', false)
) {
	add_action('product_cat' . '_add_form_fields', 'schule_add_category_icon', 10, 2);
	add_action('product_cat' . '_edit_form_fields', 'schule_edit_category_icon', 10, 2);
	add_action('edited_' . 'product_cat', 'schule_save_category_icon', 10, 2);
	add_action('create_' . 'product_cat', 'schule_save_category_icon', 10, 2);
}


if (
	CMSMASTERS_TRIBE_EVENTS && 
	apply_filters('cmsmasters_tribe_events_compatibility', false)
) {
	add_action('tribe_events_cat' . '_add_form_fields', 'schule_add_category_icon', 10, 2);
	add_action('tribe_events_cat' . '_edit_form_fields', 'schule_edit_category_icon', 10, 2);
	add_action('edited_' . 'tribe_events_cat', 'schule_save_category_icon', 10, 2);
	add_action('create_' . 'tribe_events_cat', 'schule_save_category_icon', 10, 2);
}


if (
	CMSMASTERS_DONATIONS && 
	class_exists('Cmsmasters_Donations') && 
	apply_filters('cmsmasters_donations_compatibility', false)
) {
	add_action('cp-categs' . '_add_form_fields', 'schule_add_category_icon', 10, 2);
	add_action('cp-categs' . '_edit_form_fields', 'schule_edit_category_icon', 10, 2);
	add_action('edited_' . 'cp-categs', 'schule_save_category_icon', 10, 2);
	add_action('create_' . 'cp-categs', 'schule_save_category_icon', 10, 2);
}


if (
	CMSMASTERS_SERMONS && 
	class_exists('Cmsmasters_Sermons') && 
	apply_filters('cmsmasters_sermons_compatibility', false)
) {
	add_action('srm-categs' . '_add_form_fields', 'schule_add_category_icon', 10, 2);
	add_action('srm-categs' . '_edit_form_fields', 'schule_edit_category_icon', 10, 2);
	add_action('edited_' . 'srm-categs', 'schule_save_category_icon', 10, 2);
	add_action('create_' . 'srm-categs', 'schule_save_category_icon', 10, 2);
}


if (
	CMSMASTERS_TIMETABLE && 
	apply_filters('cmsmasters_timetable_compatibility', false)
) {
	add_action('events_category' . '_add_form_fields', 'schule_add_category_icon', 10, 2);
	add_action('events_category' . '_edit_form_fields', 'schule_edit_category_icon', 10, 2);
	add_action('edited_' . 'events_category', 'schule_save_category_icon', 10, 2);
	add_action('create_' . 'events_category', 'schule_save_category_icon', 10, 2);
}



/* Category icons Args */
function schule_icon_category_args() {
	$args = array( 
		'hide_empty' => false 
	);
	
	$args['taxonomy'] = array('category');
	
	
	if (
		CMSMASTERS_CONTENT_COMPOSER && 
		class_exists('Cmsmasters_Content_Composer') && 
		apply_filters('cmsmasters_project_compatibility', false)
	) {
		$args['taxonomy'][] = 'pj-categs';
	}
	
	
	if (
		CMSMASTERS_CONTENT_COMPOSER && 
		class_exists('Cmsmasters_Content_Composer') && 
		apply_filters('cmsmasters_profile_compatibility', false)
	) {
		$args['taxonomy'][] = 'pl-categs';
	}
	
	
	if (
		CMSMASTERS_WOOCOMMERCE &&
		apply_filters('cmsmasters_woocommerce_compatibility', false)
	) {
		$args['taxonomy'][] = 'product_cat';
	}
	
	
	if (
		CMSMASTERS_TRIBE_EVENTS &&
		apply_filters('cmsmasters_tribe_events_compatibility', false)
	) {
		$args['taxonomy'][] = 'tribe_events_cat';
	}
	
	
	if (
		CMSMASTERS_DONATIONS && 
		class_exists('Cmsmasters_Donations') &&
		apply_filters('cmsmasters_donations_compatibility', false)
	) {
		$args['taxonomy'][] = 'cp-categs';
	}
	
	
	if (
		CMSMASTERS_SERMONS && 
		class_exists('Cmsmasters_Sermons') && 
		apply_filters('cmsmasters_sermons_compatibility', false)
	) {
		$args['taxonomy'][] = 'srm-categs';
	}
	
	
	if (
		CMSMASTERS_TIMETABLE && 
		apply_filters('cmsmasters_timetable_compatibility', false) 
	) {
		$args['taxonomy'][] = 'events_category';
	}
	
	
	return $args;
}

