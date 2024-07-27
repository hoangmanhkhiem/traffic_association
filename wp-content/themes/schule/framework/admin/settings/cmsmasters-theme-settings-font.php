<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Admin Panel Fonts Options
 * Created by CMSMasters
 * 
 */


function schule_options_font_tabs() {
	$tabs = array();
	
	$tabs['content'] = esc_attr__('Content', 'schule');
	$tabs['link'] = esc_attr__('Links', 'schule');
	$tabs['nav'] = esc_attr__('Navigation', 'schule');
	$tabs['heading'] = esc_attr__('Heading', 'schule');
	$tabs['other'] = esc_attr__('Other', 'schule');
	$tabs['google'] = esc_attr__('Google Fonts', 'schule');
	
	return apply_filters('cmsmasters_options_font_tabs_filter', $tabs);
}


function schule_options_font_sections() {
	$tab = schule_get_the_tab();
	
	switch ($tab) {
	case 'content':
		$sections = array();
		
		$sections['content_section'] = esc_html__('Content Font Options', 'schule');
		
		break;
	case 'link':
		$sections = array();
		
		$sections['link_section'] = esc_html__('Links Font Options', 'schule');
		
		break;
	case 'nav':
		$sections = array();
		
		$sections['nav_section'] = esc_html__('Navigation Font Options', 'schule');
		
		break;
	case 'heading':
		$sections = array();
		
		$sections['heading_section'] = esc_html__('Headings Font Options', 'schule');
		
		break;
	case 'other':
		$sections = array();
		
		$sections['other_section'] = esc_html__('Other Fonts Options', 'schule');
		
		break;
	case 'google':
		$sections = array();
		
		$sections['google_section'] = esc_html__('Serving Google Fonts from CDN', 'schule');
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	return apply_filters('cmsmasters_options_font_sections_filter', $sections, $tab);
} 


function schule_options_font_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = schule_get_the_tab();
	}
	
	
	$options = array();
	
	
	$defaults = schule_settings_font_defaults();
	
	
	switch ($tab) {
	case 'content':
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_content_font', 
			'title' => esc_html__('Main Content Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_content_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'link':
		$options[] = array( 
			'section' => 'link_section', 
			'id' => 'schule' . '_link_font', 
			'title' => esc_html__('Links Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_link_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'link_section', 
			'id' => 'schule' . '_link_hover_decoration', 
			'title' => esc_html__('Links Hover Text Decoration', 'schule'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['schule' . '_link_hover_decoration'], 
			'choices' => schule_text_decoration_list() 
		);
		
		break;
	case 'nav':
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => 'schule' . '_nav_title_font', 
			'title' => esc_html__('Navigation Title Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_nav_title_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => 'schule' . '_nav_dropdown_font', 
			'title' => esc_html__('Navigation Dropdown Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_nav_dropdown_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		break;
	case 'heading':
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'schule' . '_h1_font', 
			'title' => esc_html__('H1 Tag Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_h1_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'schule' . '_h2_font', 
			'title' => esc_html__('H2 Tag Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_h2_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'schule' . '_h3_font', 
			'title' => esc_html__('H3 Tag Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_h3_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'schule' . '_h4_font', 
			'title' => esc_html__('H4 Tag Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_h4_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'schule' . '_h5_font', 
			'title' => esc_html__('H5 Tag Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_h5_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'schule' . '_h6_font', 
			'title' => esc_html__('H6 Tag Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_h6_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		break;
	case 'other':
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'schule' . '_button_font', 
			'title' => esc_html__('Button Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_button_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'schule' . '_small_font', 
			'title' => esc_html__('Small Tag Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_small_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'schule' . '_input_font', 
			'title' => esc_html__('Text Fields Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_input_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'schule' . '_quote_font', 
			'title' => esc_html__('Blockquote Font', 'schule'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['schule' . '_quote_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'google':
		$options[] = array( 
			'section' => 'google_section', 
			'id' => 'schule' . '_google_web_fonts', 
			'title' => esc_html__('Google Fonts', 'schule'), 
			'desc' => '', 
			'type' => 'google_web_fonts', 
			'std' => $defaults[$tab]['schule' . '_google_web_fonts'] 
		);
		
		$options[] = array( 
			'section' => 'google_section', 
			'id' => 'schule' . '_google_web_fonts_subset', 
			'title' => esc_html__('Google Fonts Subset', 'schule'), 
			'desc' => '', 
			'type' => 'select_multiple', 
			'std' => '', 
			'choices' => array( 
				esc_html__('Latin Extended', 'schule') . '|' . 'latin-ext', 
				esc_html__('Arabic', 'schule') . '|' . 'arabic', 
				esc_html__('Cyrillic', 'schule') . '|' . 'cyrillic', 
				esc_html__('Cyrillic Extended', 'schule') . '|' . 'cyrillic-ext', 
				esc_html__('Greek', 'schule') . '|' . 'greek', 
				esc_html__('Greek Extended', 'schule') . '|' . 'greek-ext', 
				esc_html__('Vietnamese', 'schule') . '|' . 'vietnamese', 
				esc_html__('Japanese', 'schule') . '|' . 'japanese', 
				esc_html__('Korean', 'schule') . '|' . 'korean', 
				esc_html__('Thai', 'schule') . '|' . 'thai', 
				esc_html__('Bengali', 'schule') . '|' . 'bengali', 
				esc_html__('Devanagari', 'schule') . '|' . 'devanagari', 
				esc_html__('Gujarati', 'schule') . '|' . 'gujarati', 
				esc_html__('Gurmukhi', 'schule') . '|' . 'gurmukhi', 
				esc_html__('Hebrew', 'schule') . '|' . 'hebrew', 
				esc_html__('Kannada', 'schule') . '|' . 'kannada', 
				esc_html__('Khmer', 'schule') . '|' . 'khmer', 
				esc_html__('Malayalam', 'schule') . '|' . 'malayalam', 
				esc_html__('Myanmar', 'schule') . '|' . 'myanmar', 
				esc_html__('Oriya', 'schule') . '|' . 'oriya', 
				esc_html__('Sinhala', 'schule') . '|' . 'sinhala', 
				esc_html__('Tamil', 'schule') . '|' . 'tamil', 
				esc_html__('Telugu', 'schule') . '|' . 'telugu' 
			) 
		);
		
		break;
	}
	
	return apply_filters('cmsmasters_options_font_fields_filter', $options, $tab);	
}

