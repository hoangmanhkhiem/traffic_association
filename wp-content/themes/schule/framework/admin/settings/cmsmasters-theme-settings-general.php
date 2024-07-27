<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.0
 * 
 * Admin Panel General Options
 * Created by CMSMasters
 * 
 */


function schule_options_general_tabs() {
	$cmsmasters_option = schule_get_global_options();
	
	$tabs = array();
	
	$tabs['general'] = esc_attr__('General', 'schule');
	
	if ($cmsmasters_option['schule' . '_theme_layout'] === 'boxed') {
		$tabs['bg'] = esc_attr__('Background', 'schule');
	}
	
	if (CMSMASTERS_THEME_STYLE_COMPATIBILITY) {
		$tabs['theme_style'] = esc_attr__('Theme Style', 'schule');
	}
	
	$tabs['header'] = esc_attr__('Header', 'schule');
	$tabs['content'] = esc_attr__('Content', 'schule');
	$tabs['footer'] = esc_attr__('Footer', 'schule');
	
	return apply_filters('cmsmasters_options_general_tabs_filter', $tabs);
}


function schule_options_general_sections() {
	$tab = schule_get_the_tab();
	
	switch ($tab) {
	case 'general':
		$sections = array();
		
		$sections['general_section'] = esc_attr__('General Options', 'schule');
		
		break;
	case 'bg':
		$sections = array();
		
		$sections['bg_section'] = esc_attr__('Background Options', 'schule');
		
		break;
	case 'theme_style':
		$sections = array();
		
		$sections['theme_style_section'] = esc_attr__('Theme Design Style', 'schule');
		
		break;
	case 'header':
		$sections = array();
		
		$sections['header_section'] = esc_attr__('Header Options', 'schule');
		
		break;
	case 'content':
		$sections = array();
		
		$sections['content_section'] = esc_attr__('Content Options', 'schule');
		
		break;
	case 'footer':
		$sections = array();
		
		$sections['footer_section'] = esc_attr__('Footer Options', 'schule');
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	return apply_filters('cmsmasters_options_general_sections_filter', $sections, $tab);
} 


function schule_options_general_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = schule_get_the_tab();
	}
	
	$options = array();
	
	
	$defaults = schule_settings_general_defaults();
	
	
	switch ($tab) {
	case 'general':
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'schule' . '_theme_layout', 
			'title' => esc_html__('Theme Layout', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_theme_layout'], 
			'choices' => array( 
				esc_html__('Liquid', 'schule') . '|liquid', 
				esc_html__('Boxed', 'schule') . '|boxed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'schule' . '_logo_type', 
			'title' => esc_html__('Logo Type', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_logo_type'], 
			'choices' => array( 
				esc_html__('Image', 'schule') . '|image', 
				esc_html__('Text', 'schule') . '|text' 
			) 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'schule' . '_logo_url', 
			'title' => esc_html__('Logo Image', 'schule'), 
			'desc' => esc_html__('Choose your website logo image.', 'schule'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['schule' . '_logo_url'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'schule' . '_logo_url_retina', 
			'title' => esc_html__('Retina Logo Image', 'schule'), 
			'desc' => esc_html__('Choose logo image for retina displays. Logo for Retina displays should be twice the size of the default one.', 'schule'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['schule' . '_logo_url_retina'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'schule' . '_logo_title', 
			'title' => esc_html__('Logo Title', 'schule'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_logo_title'], 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'schule' . '_logo_subtitle', 
			'title' => esc_html__('Logo Subtitle', 'schule'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_logo_subtitle'], 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'schule' . '_logo_custom_color', 
			'title' => esc_html__('Custom Text Colors', 'schule'), 
			'desc' => esc_html__('enable', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_logo_custom_color'] 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'schule' . '_logo_title_color', 
			'title' => esc_html__('Logo Title Color', 'schule'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['schule' . '_logo_title_color'] 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'schule' . '_logo_subtitle_color', 
			'title' => esc_html__('Logo Subtitle Color', 'schule'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['schule' . '_logo_subtitle_color'] 
		);
		
		break;
	case 'bg':
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'schule' . '_bg_col', 
			'title' => esc_html__('Background Color', 'schule'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => $defaults[$tab]['schule' . '_bg_col'] 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'schule' . '_bg_img_enable', 
			'title' => esc_html__('Background Image Visibility', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_bg_img_enable'] 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'schule' . '_bg_img', 
			'title' => esc_html__('Background Image', 'schule'), 
			'desc' => esc_html__('Choose your custom website background image url.', 'schule'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['schule' . '_bg_img'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'schule' . '_bg_rep', 
			'title' => esc_html__('Background Repeat', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_bg_rep'], 
			'choices' => array( 
				esc_html__('No Repeat', 'schule') . '|no-repeat', 
				esc_html__('Repeat Horizontally', 'schule') . '|repeat-x', 
				esc_html__('Repeat Vertically', 'schule') . '|repeat-y', 
				esc_html__('Repeat', 'schule') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'schule' . '_bg_pos', 
			'title' => esc_html__('Background Position', 'schule'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['schule' . '_bg_pos'], 
			'choices' => array( 
				esc_html__('Top Left', 'schule') . '|top left', 
				esc_html__('Top Center', 'schule') . '|top center', 
				esc_html__('Top Right', 'schule') . '|top right', 
				esc_html__('Center Left', 'schule') . '|center left', 
				esc_html__('Center Center', 'schule') . '|center center', 
				esc_html__('Center Right', 'schule') . '|center right', 
				esc_html__('Bottom Left', 'schule') . '|bottom left', 
				esc_html__('Bottom Center', 'schule') . '|bottom center', 
				esc_html__('Bottom Right', 'schule') . '|bottom right' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'schule' . '_bg_att', 
			'title' => esc_html__('Background Attachment', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_bg_att'], 
			'choices' => array( 
				esc_html__('Scroll', 'schule') . '|scroll', 
				esc_html__('Fixed', 'schule') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'schule' . '_bg_size', 
			'title' => esc_html__('Background Size', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_bg_size'], 
			'choices' => array( 
				esc_html__('Auto', 'schule') . '|auto', 
				esc_html__('Cover', 'schule') . '|cover', 
				esc_html__('Contain', 'schule') . '|contain' 
			) 
		);
		
		break;
	case 'theme_style':
		$options[] = array( 
			'section' => 'theme_style_section', 
			'id' => 'schule' . '_theme_style', 
			'title' => esc_html__('Choose Theme Style', 'schule'), 
			'desc' => '', 
			'type' => 'select_theme_style', 
			'std' => '', 
			'choices' => schule_all_theme_styles() 
		);
		
		break;
	case 'header':
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_fixed_header', 
			'title' => esc_html__('Fixed Header', 'schule'), 
			'desc' => esc_html__('enable', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_fixed_header'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_overlaps', 
			'title' => esc_html__('Header Overlaps Content by Default', 'schule'), 
			'desc' => esc_html__('enable', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_header_overlaps'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_top_line', 
			'title' => esc_html__('Top Line', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_header_top_line'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_top_height', 
			'title' => esc_html__('Top Height', 'schule'), 
			'desc' => esc_html__('pixels', 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_header_top_height'], 
			'min' => '10' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_top_line_short_info', 
			'title' => esc_html__('Top Short Info', 'schule'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'schule') . '</strong>', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['schule' . '_header_top_line_short_info'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_top_line_add_cont', 
			'title' => esc_html__('Top Additional Content', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_header_top_line_add_cont'], 
			'choices' => array( 
				esc_html__('None', 'schule') . '|none', 
				esc_html__('Top Line Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'schule') . '|social', 
				esc_html__('Top Line Navigation (will be shown if set in Appearance - Menus tab)', 'schule') . '|nav' 
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_styles', 
			'title' => esc_html__('Header Styles', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_header_styles'], 
			'choices' => array( 
				esc_html__('Default Style', 'schule') . '|default', 
				esc_html__('Compact Style Left Navigation', 'schule') . '|l_nav', 
				esc_html__('Compact Style Right Navigation', 'schule') . '|r_nav', 
				esc_html__('Compact Style Center Navigation', 'schule') . '|c_nav'
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_mid_height', 
			'title' => esc_html__('Header Middle Height', 'schule'), 
			'desc' => esc_html__('pixels', 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_header_mid_height'], 
			'min' => '40' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_bot_height', 
			'title' => esc_html__('Header Bottom Height', 'schule'), 
			'desc' => esc_html__('pixels', 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_header_bot_height'], 
			'min' => '20' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_search', 
			'title' => esc_html__('Header Search', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_header_search'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_add_cont', 
			'title' => esc_html__('Header Additional Content', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_header_add_cont'], 
			'choices' => array( 
				esc_html__('None', 'schule') . '|none', 
				esc_html__('Header Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'schule') . '|social', 
				esc_html__('Header Custom HTML', 'schule') . '|cust_html' 
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'schule' . '_header_add_cont_cust_html', 
			'title' => esc_html__('Header Custom HTML', 'schule'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'schule') . '</strong>', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['schule' . '_header_add_cont_cust_html'], 
			'class' => '' 
		);
		
		break;
	case 'content':
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_layout', 
			'title' => esc_html__('Layout Type by Default', 'schule'), 
			'desc' => esc_html__('Choosing layout with a sidebar please make sure to add widgets to the Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'schule'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['schule' . '_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_archives_layout', 
			'title' => esc_html__('Archives Layout Type', 'schule'), 
			'desc' => esc_html__('Choosing layout with a sidebar please make sure to add widgets to the Archive Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'schule'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['schule' . '_archives_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_search_layout', 
			'title' => esc_html__('Search Layout Type', 'schule'), 
			'desc' => esc_html__('Choosing layout with a sidebar please make sure to add widgets to the Search Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'schule'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['schule' . '_search_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_other_layout', 
			'title' => esc_html__('Other Layout Type', 'schule'), 
			'desc' => esc_html__('Layout for pages of non-listed types. Choosing layout with a sidebar please make sure to add widgets to the Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'schule'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['schule' . '_other_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_heading_alignment', 
			'title' => esc_html__('Heading Alignment by Default', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_heading_alignment'], 
			'choices' => array( 
				esc_html__('Left', 'schule') . '|left', 
				esc_html__('Right', 'schule') . '|right', 
				esc_html__('Center', 'schule') . '|center' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_heading_scheme', 
			'title' => esc_html__('Heading Color Scheme by Default', 'schule'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['schule' . '_heading_scheme'], 
			'choices' => cmsmasters_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_heading_bg_image_enable', 
			'title' => esc_html__('Heading Background Image Visibility by Default', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_heading_bg_image_enable'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_heading_bg_image', 
			'title' => esc_html__('Heading Background Image by Default', 'schule'), 
			'desc' => esc_html__('Choose your custom heading background image by default.', 'schule'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['schule' . '_heading_bg_image'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_heading_bg_repeat', 
			'title' => esc_html__('Heading Background Repeat by Default', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_heading_bg_repeat'], 
			'choices' => array( 
				esc_html__('No Repeat', 'schule') . '|no-repeat', 
				esc_html__('Repeat Horizontally', 'schule') . '|repeat-x', 
				esc_html__('Repeat Vertically', 'schule') . '|repeat-y', 
				esc_html__('Repeat', 'schule') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_heading_bg_attachment', 
			'title' => esc_html__('Heading Background Attachment by Default', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_heading_bg_attachment'], 
			'choices' => array( 
				esc_html__('Scroll', 'schule') . '|scroll', 
				esc_html__('Fixed', 'schule') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_heading_bg_size', 
			'title' => esc_html__('Heading Background Size by Default', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_heading_bg_size'], 
			'choices' => array( 
				esc_html__('Auto', 'schule') . '|auto', 
				esc_html__('Cover', 'schule') . '|cover', 
				esc_html__('Contain', 'schule') . '|contain' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_heading_bg_color', 
			'title' => esc_html__('Heading Background Color Overlay by Default', 'schule'), 
			'desc' => '',  
			'type' => 'rgba', 
			'std' => $defaults[$tab]['schule' . '_heading_bg_color'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_heading_height', 
			'title' => esc_html__('Heading Height by Default', 'schule'), 
			'desc' => esc_html__('pixels', 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_heading_height'], 
			'min' => '0' 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_breadcrumbs', 
			'title' => esc_html__('Breadcrumbs Visibility by Default', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_breadcrumbs'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_bottom_scheme', 
			'title' => esc_html__('Bottom Color Scheme', 'schule'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['schule' . '_bottom_scheme'], 
			'choices' => cmsmasters_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_bottom_sidebar', 
			'title' => esc_html__('Bottom Sidebar Visibility by Default', 'schule'), 
			'desc' => esc_html__('show', 'schule') . '<br><br>' . esc_html__('Please make sure to add widgets in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_bottom_sidebar'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'schule' . '_bottom_sidebar_layout', 
			'title' => esc_html__('Bottom Sidebar Layout by Default', 'schule'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['schule' . '_bottom_sidebar_layout'], 
			'choices' => array( 
				'1/1|11', 
				'1/2 + 1/2|1212', 
				'1/3 + 2/3|1323', 
				'2/3 + 1/3|2313', 
				'1/4 + 3/4|1434', 
				'3/4 + 1/4|3414', 
				'1/3 + 1/3 + 1/3|131313', 
				'1/2 + 1/4 + 1/4|121414', 
				'1/4 + 1/2 + 1/4|141214', 
				'1/4 + 1/4 + 1/2|141412', 
				'1/4 + 1/4 + 1/4 + 1/4|14141414' 
			) 
		);
		
		break;
	case 'footer':
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_scheme', 
			'title' => esc_html__('Footer Color Scheme', 'schule'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['schule' . '_footer_scheme'], 
			'choices' => cmsmasters_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_type', 
			'title' => esc_html__('Footer Type', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_footer_type'], 
			'choices' => array( 
				esc_html__('Default', 'schule') . '|default', 
				esc_html__('Small', 'schule') . '|small' 
			) 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_additional_content', 
			'title' => esc_html__('Footer Additional Content', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_footer_additional_content'], 
			'choices' => array( 
				esc_html__('None', 'schule') . '|none', 
				esc_html__('Footer Navigation (will be shown if set in Appearance - Menus tab)', 'schule') . '|nav', 
				esc_html__('Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'schule') . '|social', 
				esc_html__('Custom HTML', 'schule') . '|text' 
			) 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_logo', 
			'title' => esc_html__('Footer Logo', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_footer_logo'] 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_logo_url', 
			'title' => esc_html__('Footer Logo', 'schule'), 
			'desc' => esc_html__('Choose your website footer logo image.', 'schule'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['schule' . '_footer_logo_url'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_logo_url_retina', 
			'title' => esc_html__('Footer Logo for Retina', 'schule'), 
			'desc' => esc_html__('Choose your website footer logo image for retina.', 'schule'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['schule' . '_footer_logo_url_retina'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_nav', 
			'title' => esc_html__('Footer Navigation', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_footer_nav'] 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_social', 
			'title' => esc_html__('Footer Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_footer_social'] 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_html', 
			'title' => esc_html__('Footer Custom HTML', 'schule'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'schule') . '</strong>', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['schule' . '_footer_html'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'schule' . '_footer_copyright', 
			'title' => esc_html__('Copyright Text', 'schule'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_footer_copyright'], 
			'class' => '' 
		);
		
		break;
	}
	
	return apply_filters('cmsmasters_options_general_fields_filter', $options, $tab);
}

