<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.1.9
 * 
 * Theme Settings Defaults
 * Created by CMSMasters
 * 
 */


/* Theme Settings General Default Values */
if (!function_exists('schule_settings_general_defaults')) {

function schule_settings_general_defaults($id = false) {
	$settings = array( 
		'general' => array( 
			'schule' . '_theme_layout' => 			'liquid', 
			'schule' . '_logo_type' => 			'image', 
			'schule' . '_logo_url' => 				'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo.png', 
			'schule' . '_logo_url_retina' => 		'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_retina.png', 
			'schule' . '_logo_title' => 			get_bloginfo('name') ? get_bloginfo('name') : 'schule', 
			'schule' . '_logo_subtitle' => 		'', 
			'schule' . '_logo_custom_color' => 	0, 
			'schule' . '_logo_title_color' => 		'', 
			'schule' . '_logo_subtitle_color' => 	'' 
		), 
		'bg' => array( 
			'schule' . '_bg_col' => 			'#ffffff', 
			'schule' . '_bg_img_enable' => 	0, 
			'schule' . '_bg_img' => 			'', 
			'schule' . '_bg_rep' => 			'no-repeat', 
			'schule' . '_bg_pos' => 			'top center', 
			'schule' . '_bg_att' => 			'scroll', 
			'schule' . '_bg_size' => 			'cover' 
		), 
		'header' => array( 
			'schule' . '_fixed_header' => 					1, 
			'schule' . '_header_overlaps' => 				1, 
			'schule' . '_header_top_line' => 				0, 
			'schule' . '_header_top_height' => 			'40', 
			'schule' . '_header_top_line_short_info' => 	'', 
			'schule' . '_header_top_line_add_cont' => 		0, 
			'schule' . '_header_styles' => 				'c_nav', 
			'schule' . '_header_mid_height' => 			'110', 
			'schule' . '_header_bot_height' => 			'68', 
			'schule' . '_header_search' => 				0, 
			'schule' . '_header_add_cont' => 				'social', 
			'schule' . '_header_add_cont_cust_html' => 	''
		), 
		'content' => array( 
			'schule' . '_layout' => 					'r_sidebar', 
			'schule' . '_archives_layout' => 			'r_sidebar', 
			'schule' . '_search_layout' => 			'r_sidebar', 
			'schule' . '_other_layout' => 				'r_sidebar', 
			'schule' . '_heading_alignment' => 		'center', 
			'schule' . '_heading_scheme' => 			'default', 
			'schule' . '_heading_bg_image_enable' => 	1, 
			'schule' . '_heading_bg_image' => 			'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/headline_bg.jpg', 
			'schule' . '_heading_bg_repeat' => 		'no-repeat', 
			'schule' . '_heading_bg_attachment' => 	'scroll', 
			'schule' . '_heading_bg_size' => 			'cover', 
			'schule' . '_heading_bg_color' => 			'', 
			'schule' . '_heading_height' => 			'430', 
			'schule' . '_breadcrumbs' => 				1, 
			'schule' . '_bottom_scheme' => 			'first', 
			'schule' . '_bottom_sidebar' => 			0, 
			'schule' . '_bottom_sidebar_layout' => 	'14141414' 
		), 
		'footer' => array( 
			'schule' . '_footer_scheme' => 				'footer', 
			'schule' . '_footer_type' => 					'default', 
			'schule' . '_footer_additional_content' => 	'social', 
			'schule' . '_footer_logo' => 					1, 
			'schule' . '_footer_logo_url' => 				'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_footer.png', 
			'schule' . '_footer_logo_url_retina' => 		'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_footer_retina.png', 
			'schule' . '_footer_nav' => 					0, 
			'schule' . '_footer_social' => 				0, 
			'schule' . '_footer_html' => 					'', 
			'schule' . '_footer_copyright' => 				'Demo' . ' &copy; ' . '2024' . ' / ' . esc_html__('All Rights Reserved', 'schule') 
		) 
	);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



/* Theme Settings Fonts Default Values */
if (!function_exists('schule_settings_font_defaults')) {

function schule_settings_font_defaults($id = false) {
	$settings = array( 
		'content' => array( 
			'schule' . '_content_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Sans:400,400i,700,700i', 
				'font_size' => 			'18', 
				'line_height' => 		'24', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal' 
			) 
		), 
		'link' => array( 
			'schule' . '_link_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Sans:400,400i,700,700i', 
				'font_size' => 			'18', 
				'line_height' => 		'28', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'schule' . '_link_hover_decoration' => 	'none' 
		), 
		'nav' => array( 
			'schule' . '_nav_title_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Serif:400,400i,700,700i', 
				'font_size' => 			'19', 
				'line_height' => 		'24', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none' 
			), 
			'schule' . '_nav_dropdown_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Sans:400,400i,700,700i', 
				'font_size' => 			'14', 
				'line_height' => 		'19', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none' 
			) 
		), 
		'heading' => array( 
			'schule' . '_h1_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Serif:400,400i,700,700i', 
				'font_size' => 			'50', 
				'line_height' => 		'55', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'schule' . '_h2_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Serif:400,400i,700,700i', 
				'font_size' => 			'32', 
				'line_height' => 		'40', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'schule' . '_h3_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Serif:400,400i,700,700i', 
				'font_size' => 			'28', 
				'line_height' => 		'36', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'schule' . '_h4_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Serif:400,400i,700,700i', 
				'font_size' => 			'22', 
				'line_height' => 		'30', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'schule' . '_h5_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Serif:400,400i,700,700i', 
				'font_size' => 			'20', 
				'line_height' => 		'26', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'schule' . '_h6_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Sans:400,400i,700,700i', 
				'font_size' => 			'15', 
				'line_height' => 		'24', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			) 
		), 
		'other' => array( 
			'schule' . '_button_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Serif:400,400i,700,700i', 
				'font_size' => 			'18', 
				'line_height' => 		'45', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none' 
			), 
			'schule' . '_small_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Sans:400,400i,700,700i', 
				'font_size' => 			'15', 
				'line_height' => 		'20', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none' 
			), 
			'schule' . '_input_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Serif:400,400i,700,700i', 
				'font_size' => 			'16', 
				'line_height' => 		'26', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal' 
			), 
			'schule' . '_quote_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'PT+Serif:400,400i,700,700i', 
				'font_size' => 			'28', 
				'line_height' => 		'40', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal' 
			) 
		),
		'google' => array( 
			'schule' . '_google_web_fonts' => array( 
				'Titillium+Web:300,300italic,400,400italic,600,600italic,700,700italic|Titillium Web', 
				'Roboto:300,300italic,400,400italic,500,500italic,700,700italic|Roboto', 
				'Roboto+Condensed:400,400italic,700,700italic|Roboto Condensed', 
				'Open+Sans:300,300italic,400,400italic,700,700italic|Open Sans', 
				'Open+Sans+Condensed:300,300italic,700|Open Sans Condensed', 
				'Droid+Sans:400,700|Droid Sans', 
				'Droid+Serif:400,400italic,700,700italic|Droid Serif', 
				'PT+Sans:400,400italic,700,700italic|PT Sans', 
				'PT+Sans+Caption:400,700|PT Sans Caption', 
				'PT+Sans+Narrow:400,700|PT Sans Narrow', 
				'PT+Serif:400,400italic,700,700italic|PT Serif', 
				'Ubuntu:400,400italic,700,700italic|Ubuntu', 
				'Ubuntu+Condensed|Ubuntu Condensed', 
				'Headland+One|Headland One', 
				'Source+Sans+Pro:300,300italic,400,400italic,700,700italic|Source Sans Pro', 
				'Lato:400,400italic,700,700italic|Lato', 
				'Cuprum:400,400italic,700,700italic|Cuprum', 
				'Oswald:300,400,700|Oswald', 
				'Yanone+Kaffeesatz:300,400,700|Yanone Kaffeesatz', 
				'Lobster|Lobster', 
				'Lobster+Two:400,400italic,700,700italic|Lobster Two', 
				'Questrial|Questrial', 
				'Raleway:300,400,500,600,700|Raleway', 
				'Dosis:300,400,500,700|Dosis', 
				'Cutive+Mono|Cutive Mono', 
				'Quicksand:300,400,700|Quicksand', 
				'Montserrat:400,700|Montserrat', 
				'Cookie|Cookie',
				'PT+Sans:400,400i,700,700i|PT Sans',
				'PT+Serif:400,400i,700,700i|PT Serif'
			) 
		)  
	);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



// WP Color Picker Palettes
if (!function_exists('cmsmasters_color_picker_palettes')) {

function cmsmasters_color_picker_palettes() {
	$palettes = array( 
		'#454545', 
		'#9b0c23', 
		'#969696', 
		'#000000', 
		'#f0f0f3', 
		'#f7f7f7', 
		'#dedede', 
		'#002147' 
	);
	
	
	return $palettes;
}

}



// Theme Settings Color Schemes Default Colors
if (!function_exists('schule_color_schemes_defaults')) {

function schule_color_schemes_defaults($id = false) {
	$settings = array( 
		'default' => array( // content default color scheme
			'color' => 		'#454545', 
			'link' => 		'#9b0c23', 
			'hover' => 		'#969696', 
			'heading' => 	'#000000', 
			'bg' => 		'#f0f0f3', 
			'alternate' => 	'#f7f7f7', 
			'border' => 	'#dedede', 
			'secondary' => 	'#002147' 
		), 
		'header' => array( // Header color scheme
			'mid_color' => 		'#ffffff', 
			'mid_link' => 		'#ffffff', 
			'mid_hover' => 		'rgba(255,255,255,0.6)', 
			'mid_bg' => 		'rgba(34,39,48,0.5)', 
			'mid_bg_scroll' => 	'#222730', 
			'mid_border' => 	'#ffffff', 
			'bot_color' => 		'#ffffff', 
			'bot_link' => 		'#ffffff', 
			'bot_hover' => 		'#ffffff', 
			'bot_bg' => 		'rgba(34,39,48,0.5)', 
			'bot_bg_scroll' => 	'#222730', 
			'bot_border' => 	'rgba(255,255,255,0)' 
		), 
		'navigation' => array( // Navigation color scheme
			'title_link' => 			'#ffffff', 
			'title_link_hover' => 		'rgba(255,255,255,0.6)', 
			'title_link_current' => 	'#ffffff', 
			'title_link_subtitle' => 	'rgba(255,255,255,0.6)', 
			'title_link_bg' => 			'rgba(255,255,255,0)', 
			'title_link_bg_hover' => 	'rgba(255,255,255,0)', 
			'title_link_bg_current' => 	'rgba(255,255,255,0)', 
			'title_link_border' => 		'rgba(255,255,255,0)', 
			'dropdown_text' => 			'#ffffff', 
			'dropdown_bg' => 			'#2b323d', 
			'dropdown_border' => 		'rgba(255,255,255,0)', 
			'dropdown_link' => 			'rgba(255,255,255,0.65)', 
			'dropdown_link_hover' => 	'#ffffff', 
			'dropdown_link_subtitle' => 'rgba(255,255,255,0.3)', 
			'dropdown_link_highlight' => 'rgba(241,80,57,0)', 
			'dropdown_link_border' => 	'rgba(255,255,255,0)' 
		), 
		'header_top' => array( // Header Top color scheme
			'color' => 					'#8396ad', 
			'link' => 					'#8396ad', 
			'hover' => 					'rgba(131,150,173,0.7)', 
			'bg' => 					'#002147', 
			'border' => 				'rgba(255,255,255,0)', 
			'title_link' => 			'#8396ad', 
			'title_link_hover' => 		'rgba(131,150,173,0.7)', 
			'title_link_bg' => 			'rgba(255,255,255,0)', 
			'title_link_bg_hover' => 	'rgba(29,32,35,0)', 
			'title_link_border' => 		'rgba(29,32,35,0)', 
			'dropdown_bg' => 			'#2b323d', 
			'dropdown_border' => 		'rgba(255,255,255,0)', 
			'dropdown_link' => 			'rgba(255,255,255,0.65)', 
			'dropdown_link_hover' => 	'#ffffff', 
			'dropdown_link_highlight' => 'rgba(255,255,255,0)', 
			'dropdown_link_border' => 	'rgba(255,255,255,0)' 
		), 
		'footer' => array( // Footer color scheme
			'color' => 		'#3b5470', 
			'link' => 		'#6885a6', 
			'hover' => 		'#3b5470', 
			'heading' => 	'#ffffff', 
			'bg' => 		'#00142a', 
			'alternate' => 	'#001936', 
			'border' => 	'rgba(255,255,255,0)', 
			'secondary' => 	'#3b5470' 
		), 
		'first' => array( // custom color scheme 1
			'color' => 		'#ffffff', 
			'link' => 		'#6885a6', 
			'hover' => 		'rgba(255,255,255,0.7)', 
			'heading' => 	'#ffffff', 
			'bg' => 		'#001936', 
			'alternate' => 	'#fdfdfd', 
			'border' => 	'#6885a6', 
			'secondary' => 	'#002147' 
		), 
		'second' => array( // custom color scheme 2
			'color' => 		'#454545', 
			'link' => 		'#9b0c23', 
			'hover' => 		'#969696', 
			'heading' => 	'#000000', 
			'bg' => 		'#ffffff', 
			'alternate' => 	'#fdfdfd', 
			'border' => 	'#dedede', 
			'secondary' => 	'#002147' 
		), 
		'third' => array( // custom color scheme 3
			'color' => 		'#ffffff', 
			'link' => 		'#9b0c23', 
			'hover' => 		'#ffffff', 
			'heading' => 	'#ffffff', 
			'bg' => 		'#f0f0f3', 
			'alternate' => 	'#fdfdfd', 
			'border' => 	'rgba(255,255,255,0.2)', 
			'secondary' => 	'#002147' 
		) 
	);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



// Theme Settings Elements Default Values
if (!function_exists('schule_settings_element_defaults')) {

function schule_settings_element_defaults($id = false) {
	$settings = array( 
		'sidebar' => array( 
			'schule' . '_sidebar' => 	'' 
		), 
		'icon' => array( 
			'schule' . '_social_icons' => array( 
				'cmsmasters-icon-facebook-1|#|' . esc_html__('Facebook', 'schule') . '|true||', 
				'cmsmasters-icon-gplus-1|#|' . esc_html__('Google+', 'schule') . '|true||', 
				'cmsmasters-icon-instagram|#|' . esc_html__('Instagram', 'schule') . '|true||', 
				'cmsmasters-icon-twitter|#|' . esc_html__('Twitter', 'schule') . '|true||', 
				'cmsmasters-icon-youtube-play|#|' . esc_html__('YouTube', 'schule') . '|true||' 
			) 
		), 
		'lightbox' => array( 
			'schule' . '_ilightbox_skin' => 					'dark', 
			'schule' . '_ilightbox_path' => 					'vertical', 
			'schule' . '_ilightbox_infinite' => 				0, 
			'schule' . '_ilightbox_aspect_ratio' => 			1, 
			'schule' . '_ilightbox_mobile_optimizer' => 		1, 
			'schule' . '_ilightbox_max_scale' => 				1, 
			'schule' . '_ilightbox_min_scale' => 				0.2, 
			'schule' . '_ilightbox_inner_toolbar' => 			0, 
			'schule' . '_ilightbox_smart_recognition' => 		0, 
			'schule' . '_ilightbox_fullscreen_one_slide' => 	0, 
			'schule' . '_ilightbox_fullscreen_viewport' => 	'center', 
			'schule' . '_ilightbox_controls_toolbar' => 		1, 
			'schule' . '_ilightbox_controls_arrows' => 		0, 
			'schule' . '_ilightbox_controls_fullscreen' => 	1, 
			'schule' . '_ilightbox_controls_thumbnail' => 		1, 
			'schule' . '_ilightbox_controls_keyboard' => 		1, 
			'schule' . '_ilightbox_controls_mousewheel' => 	1, 
			'schule' . '_ilightbox_controls_swipe' => 			1, 
			'schule' . '_ilightbox_controls_slideshow' => 		0 
		), 
		'sitemap' => array( 
			'schule' . '_sitemap_nav' => 			1, 
			'schule' . '_sitemap_categs' => 		1, 
			'schule' . '_sitemap_tags' => 			1, 
			'schule' . '_sitemap_month' => 		1, 
			'schule' . '_sitemap_pj_categs' => 	1, 
			'schule' . '_sitemap_pj_tags' => 		1 
		), 
		'error' => array( 
			'schule' . '_error_color' => 				'#000000', 
			'schule' . '_error_bg_color' => 			'#fcfcfc', 
			'schule' . '_error_bg_img_enable' => 		0, 
			'schule' . '_error_bg_image' => 			'', 
			'schule' . '_error_bg_rep' => 				'no-repeat', 
			'schule' . '_error_bg_pos' => 				'top center', 
			'schule' . '_error_bg_att' => 				'scroll', 
			'schule' . '_error_bg_size' => 			'cover', 
			'schule' . '_error_search' => 				1, 
			'schule' . '_error_sitemap_button' =>		1, 
			'schule' . '_error_sitemap_link' => 		'' 
		), 
		'code' => array( 
			'schule' . '_custom_css' => 			'', 
			'schule' . '_custom_js' => 			'', 
			'schule' . '_gmap_api_key' => 			'', 
			'schule' . '_twitter_access_data' => 	array(), 
		), 
		'recaptcha' => array( 
			'schule' . '_recaptcha_public_key' => 		'', 
			'schule' . '_recaptcha_private_key' => 	'' 
		) 
	);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



// Theme Settings Single Posts Default Values
if (!function_exists('schule_settings_single_defaults')) {

function schule_settings_single_defaults($id = false) {
	$settings = array( 
		'post' => array( 
			'schule' . '_blog_post_layout' => 			'fullwidth', 
			'schule' . '_blog_post_title' => 			1, 
			'schule' . '_blog_post_date' => 			1, 
			'schule' . '_blog_post_cat' => 			1, 
			'schule' . '_blog_post_author' => 			1, 
			'schule' . '_blog_post_comment' => 		1, 
			'schule' . '_blog_post_tag' => 			1, 
			'schule' . '_blog_post_like' => 			1, 
			'schule' . '_blog_post_nav_box' => 		1, 
			'schule' . '_blog_post_nav_order_cat' => 	0, 
			'schule' . '_blog_post_share_box' => 		1, 
			'schule' . '_blog_post_author_box' => 		1, 
			'schule' . '_blog_more_posts_box' => 		'popular', 
			'schule' . '_blog_more_posts_count' => 	'3', 
			'schule' . '_blog_more_posts_pause' => 	'5' 
		), 
		'project' => array( 
			'schule' . '_portfolio_project_title' => 			1, 
			'schule' . '_portfolio_project_details_title' => 	esc_html__('Project details', 'schule'), 
			'schule' . '_portfolio_project_date' => 			1, 
			'schule' . '_portfolio_project_cat' => 			1, 
			'schule' . '_portfolio_project_author' => 			1, 
			'schule' . '_portfolio_project_comment' => 		0, 
			'schule' . '_portfolio_project_tag' => 			0, 
			'schule' . '_portfolio_project_like' => 			1, 
			'schule' . '_portfolio_project_link' => 			0, 
			'schule' . '_portfolio_project_share_box' => 		1, 
			'schule' . '_portfolio_project_nav_box' => 		1, 
			'schule' . '_portfolio_project_nav_order_cat' => 	0, 
			'schule' . '_portfolio_project_author_box' => 		1, 
			'schule' . '_portfolio_more_projects_box' => 		'popular', 
			'schule' . '_portfolio_more_projects_count' => 	'4', 
			'schule' . '_portfolio_more_projects_pause' => 	'5', 
			'schule' . '_portfolio_project_slug' => 			'project', 
			'schule' . '_portfolio_pj_categs_slug' => 			'pj-categs', 
			'schule' . '_portfolio_pj_tags_slug' => 			'pj-tags' 
		), 
		'profile' => array( 
			'schule' . '_profile_post_title' => 			1, 
			'schule' . '_profile_post_details_title' => 	esc_html__('Profile details', 'schule'), 
			'schule' . '_profile_post_cat' => 				1, 
			'schule' . '_profile_post_comment' => 			1, 
			'schule' . '_profile_post_like' => 			1, 
			'schule' . '_profile_post_nav_box' => 			1, 
			'schule' . '_profile_post_nav_order_cat' => 		0, 
			'schule' . '_profile_post_share_box' => 		1, 
			'schule' . '_profile_post_slug' => 			'profile', 
			'schule' . '_profile_pl_categs_slug' => 		'pl-categs' 
		) 
	);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



/* Project Puzzle Proportion */
if (!function_exists('schule_project_puzzle_proportion')) {

function schule_project_puzzle_proportion() {
	return 0.7069;
}

}



/* Project Puzzle Proportion */
if (!function_exists('schule_project_puzzle_large_gar_parameters')) {

function schule_project_puzzle_large_gar_parameters() {
	$parameter = array ( 
		'container_width' 		=> 1160, 
		'bottomStaticPadding' 	=> 2 
	);
	
	
	return $parameter;
}

}



/* Theme Image Thumbnails Size */
if (!function_exists('schule_get_image_thumbnail_list')) {

function schule_get_image_thumbnail_list() {
	$list = array( 
		'cmsmasters-small-thumb' => array( 
			'width' => 		75, 
			'height' => 	75, 
			'crop' => 		true 
		), 
		'cmsmasters-square-thumb' => array( 
			'width' => 		300, 
			'height' => 	300, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Square', 'schule') 
		), 
		'cmsmasters-blog-masonry-thumb' => array( 
			'width' => 		580, 
			'height' => 	366, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Masonry Blog', 'schule') 
		), 
		'cmsmasters-project-thumb' => array( 
			'width' => 		580, 
			'height' => 	410, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Project', 'schule') 
		), 
		'cmsmasters-project-masonry-thumb' => array( 
			'width' => 		580, 
			'height' => 	9999, 
			'title' => 		esc_attr__('Masonry Project', 'schule') 
		), 
		'post-thumbnail' => array( 
			'width' => 		860, 
			'height' => 	575, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Featured', 'schule') 
		), 
		'cmsmasters-masonry-thumb' => array( 
			'width' => 		860, 
			'height' => 	9999, 
			'title' => 		esc_attr__('Masonry', 'schule') 
		), 
		'cmsmasters-full-thumb' => array( 
			'width' => 		1160, 
			'height' => 	770, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Full', 'schule') 
		), 
		'cmsmasters-project-full-thumb' => array( 
			'width' => 		1160, 
			'height' => 	820, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Project Full', 'schule') 
		), 
		'cmsmasters-full-masonry-thumb' => array( 
			'width' => 		1160, 
			'height' => 	9999, 
			'title' => 		esc_attr__('Masonry Full', 'schule') 
		) 
	);
	
	
	return $list;
}

}



/* Project Post Type Registration Rename */
if (!function_exists('schule_project_labels')) {

function schule_project_labels() {
	return array( 
		'name' => 					esc_html__('Projects', 'schule'), 
		'singular_name' => 			esc_html__('Project', 'schule'), 
		'menu_name' => 				esc_html__('Projects', 'schule'), 
		'all_items' => 				esc_html__('All Projects', 'schule'), 
		'add_new' => 				esc_html__('Add New', 'schule'), 
		'add_new_item' => 			esc_html__('Add New Project', 'schule'), 
		'edit_item' => 				esc_html__('Edit Project', 'schule'), 
		'new_item' => 				esc_html__('New Project', 'schule'), 
		'view_item' => 				esc_html__('View Project', 'schule'), 
		'search_items' => 			esc_html__('Search Projects', 'schule'), 
		'not_found' => 				esc_html__('No projects found', 'schule'), 
		'not_found_in_trash' => 	esc_html__('No projects found in Trash', 'schule') 
	);
}

}

// add_filter('cmsmasters_project_labels_filter', 'schule_project_labels');


if (!function_exists('schule_pj_categs_labels')) {

function schule_pj_categs_labels() {
	return array( 
		'name' => 					esc_html__('Project Categories', 'schule'), 
		'singular_name' => 			esc_html__('Project Category', 'schule') 
	);
}

}

// add_filter('cmsmasters_pj_categs_labels_filter', 'schule_pj_categs_labels');


if (!function_exists('schule_pj_tags_labels')) {

function schule_pj_tags_labels() {
	return array( 
		'name' => 					esc_html__('Project Tags', 'schule'), 
		'singular_name' => 			esc_html__('Project Tag', 'schule') 
	);
}

}

// add_filter('cmsmasters_pj_tags_labels_filter', 'schule_pj_tags_labels');



/* Profile Post Type Registration Rename */
if (!function_exists('schule_profile_labels')) {

function schule_profile_labels() {
	return array( 
		'name' => 					esc_html__('Profiles', 'schule'), 
		'singular_name' => 			esc_html__('Profiles', 'schule'), 
		'menu_name' => 				esc_html__('Profiles', 'schule'), 
		'all_items' => 				esc_html__('All Profiles', 'schule'), 
		'add_new' => 				esc_html__('Add New', 'schule'), 
		'add_new_item' => 			esc_html__('Add New Profile', 'schule'), 
		'edit_item' => 				esc_html__('Edit Profile', 'schule'), 
		'new_item' => 				esc_html__('New Profile', 'schule'), 
		'view_item' => 				esc_html__('View Profile', 'schule'), 
		'search_items' => 			esc_html__('Search Profiles', 'schule'), 
		'not_found' => 				esc_html__('No Profiles found', 'schule'), 
		'not_found_in_trash' => 	esc_html__('No Profiles found in Trash', 'schule') 
	);
}

}

// add_filter('cmsmasters_profile_labels_filter', 'schule_profile_labels');


if (!function_exists('schule_pl_categs_labels')) {

function schule_pl_categs_labels() {
	return array( 
		'name' => 					esc_html__('Profile Categories', 'schule'), 
		'singular_name' => 			esc_html__('Profile Category', 'schule') 
	);
}

}

// add_filter('cmsmasters_pl_categs_labels_filter', 'schule_pl_categs_labels');

