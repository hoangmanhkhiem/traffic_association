<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.1.1
 * 
 * Theme Admin Settings
 * Created by CMSMasters
 * 
 */

 
/* General Settings */
function schule_theme_options_general_fields($options, $tab) {
	if ($tab == 'header') {
		$options_new = array();
		
		foreach ($options as $option) {
			if ($option['id'] == 'schule' . '_header_top_line_add_cont') {
				// remove this field
				
				$options_new[] = array( 
					'section' => 'header_section', 
					'id' => 'schule' . '_header_top_line_social', 
					'title' => esc_html__('Top Line Social Icons', 'schule'), 
					'desc' => esc_html__('show', 'schule'), 
					'type' => 'checkbox', 
					'std' => 1 
				);
				
				$options_new[] = array( 
					'section' => 'header_section', 
					'id' => 'schule' . '_header_top_line_nav', 
					'title' => esc_html__('Top Line Navigation', 'schule'), 
					'desc' => esc_html__('show', 'schule'), 
					'type' => 'checkbox', 
					'std' => 1
				);
			} else {
				$options_new[] = $option;
			}
		}
		
		$options = $options_new;
	}
	
	
	return $options;
}

add_filter('cmsmasters_options_general_fields_filter', 'schule_theme_options_general_fields', 10, 2);



/* Color Settings */
function schule_theme_options_color_fields($options, $tab) {
	$defaults = schule_color_schemes_defaults();
	
	
	if ($tab != 'header' && $tab != 'navigation' && $tab != 'header_top') {
		$options[] = array( 
			'section' => $tab . '_section', 
			'id' => 'schule' . '_' . $tab . '_secondary', 
			'title' => esc_html__('Secondary Color', 'schule'), 
			'desc' => esc_html__('Secondary color for some elements', 'schule'), 
			'type' => 'rgba', 
			'std' => (isset($defaults[$tab])) ? $defaults[$tab]['secondary'] : $defaults['default']['secondary'] 
		);
	}
	
	
	return $options;
}

add_filter('cmsmasters_options_color_fields_filter', 'schule_theme_options_color_fields', 10, 2);



