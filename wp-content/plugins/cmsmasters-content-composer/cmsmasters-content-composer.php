<?php 
/*
Plugin Name: CMSMasters Content Composer
Plugin URI: http://cmsmasters.net/
Description: CMSMasters Content Composer created by <a href="http://cmsmasters.net/" title="CMSMasters">CMSMasters</a> team. Content Composer plugin create custom visual editor with shortcodes & settings integrated to WordPress default content editor for new <a href="http://themeforest.net/user/cmsmasters/portfolio" title="cmsmasters">cmsmasters</a> WordPress themes.
Version: 2.5.4
Author: cmsmasters
Author URI: http://cmsmasters.net/
*/

/*  Copyright 2014 CMSMasters (email : cmsmstrs@gmail.com). All Rights Reserved.

	This software is distributed exclusively as appendant 
	to Wordpress themes, created by CMSMasters studio and 
	should be used in strict compliance to the terms, 
	listed in the License Terms & Conditions included 
	in software archive.
	
	If your archive does not include this file, 
	you may find the license text by url 
	http://cmsmasters.net/files/license/cmsmasters-content-composer/license.txt 
	or contact CMSMasters Studio at email 
	copyright.cmsmasters@gmail.com 
	about this.
	
	Please note, that any usage of this software, that 
	contradicts the license terms is a subject to legal pursue 
	and will result copyright reclaim and damage withdrawal.
*/


class Cmsmasters_Content_Composer { 
	function __construct() { 
		define('CMSMASTERS_CONTENT_COMPOSER_VERSION', '2.5.4');
		
		define('CMSMASTERS_CONTENT_COMPOSER_FILE', __FILE__);
		
		define('CMSMASTERS_ACTIVE_THEME', get_option('cmsmasters_active_theme') ? get_option('cmsmasters_active_theme') : '');
		
		define('CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE', (get_option('cmsmasters_' . CMSMASTERS_ACTIVE_THEME . '_theme_style') ? get_option('cmsmasters_' . CMSMASTERS_ACTIVE_THEME . '_theme_style') : ''));
		
		define('CMSMASTERS_CONTENT_COMPOSER_NAME', plugin_basename(CMSMASTERS_CONTENT_COMPOSER_FILE));
		
		define('CMSMASTERS_CONTENT_COMPOSER_PATH', plugin_dir_path(CMSMASTERS_CONTENT_COMPOSER_FILE));
		
		define('CMSMASTERS_CONTENT_COMPOSER_URL', plugin_dir_url(CMSMASTERS_CONTENT_COMPOSER_FILE));
		
		define('CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR', 'theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/cmsmasters-c-c/shortcodes');
		
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'framework/cmsmasters-composer-functions.php');
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'framework/cmsmasters-composer-theme-functions.php');
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'framework/cmsmasters-editor-plugin-register.php');
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'framework/cmsmasters-composer-templates-posttype.php');
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'framework/cmsmasters-composer-lightbox-functions.php');
		
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'framework/inc/editor-additions.php');
		
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'inc/shortcodes.php');
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'inc/widgets.php');
		
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'inc/project/projects-posttype.php');
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'inc/profile/profiles-posttype.php');
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'inc/like/likes-posttype.php');
		
		require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'inc/view/views-posttype.php');
		
		
		global $pagenow;
		
		
		$gutenberg_allow_posttype = array( 
			'page', 
			'post', 
			'project', 
			'profile', 
			'events'
		);

		if (
			isset( get_option( 'timetable_events_settings' )['slug'] ) &&
			'' !== get_option( 'timetable_events_settings' )['slug']
		) {
			array_push( $gutenberg_allow_posttype, get_option( 'timetable_events_settings' )['slug'] );
		}
		
		
		if (
			($pagenow == 'post-new.php' && !isset($_GET['post_type'])) || 
			($pagenow == 'post-new.php' && isset($_GET['post_type']) && in_array($_GET['post_type'], $gutenberg_allow_posttype)) || 
			($pagenow == 'post.php' && isset($_GET['post']) && in_array(get_post_type($_GET['post']), $gutenberg_allow_posttype)) 
		) {
			if ( ! class_exists( 'Classic_Editor' ) ) {
				require_once(CMSMASTERS_CONTENT_COMPOSER_PATH . 'gutenberg/gutenberg.php');
				
				add_action('edit_form_after_title', array($this, 'add_gutenberg_button'), 11);
			}
		}
		
		
		add_action('widgets_init', array($this, 'cmsmasters_content_composer_widgets_init'), 1);
		
		
		register_activation_hook(CMSMASTERS_CONTENT_COMPOSER_FILE, array($this, 'cmsmasters_content_composer_activate'));
		
		register_deactivation_hook(CMSMASTERS_CONTENT_COMPOSER_FILE, array($this, 'cmsmasters_content_composer_deactivate'));
		
		
		if (is_admin()) {
			add_action('admin_enqueue_scripts', array($this, 'cmsmasters_composer_enqueue_scripts'));
			
			
			add_action('save_post', array($this, 'save_custom_composer_meta'));
			
			
			if ( 
				$pagenow == 'post-new.php' || 
				($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
			) {
				add_action('admin_print_footer_scripts', array($this, 'cmsmasters_composer_init'), 11);
				
				
				add_action('edit_form_after_title', array($this, 'add_composer_button'));
				
				
				add_action('add_meta_boxes', array($this, 'add_custom_composer_meta_box'), 1);
			}
		}
		
		// Load Plugin Local File
		load_plugin_textdomain('cmsmasters-content-composer', false, dirname(plugin_basename(CMSMASTERS_CONTENT_COMPOSER_FILE)) . '/languages/');
		
		
		// Register Shortcodes for Excerpts and Widgets
		add_filter('the_excerpt', 'do_shortcode');
		
		add_filter('widget_text', 'do_shortcode');
		
		
		add_action('admin_init', array($this, 'cmsmasters_content_composer_compatibility'));
	}
	
	
	function cmsmasters_composer_enqueue_scripts($hook) {
		wp_register_style('cmsmasters-admin-styles', CMSMASTERS_CONTENT_COMPOSER_URL . 'framework/css/cmsmasters-admin.css', array(), CMSMASTERS_CONTENT_COMPOSER_VERSION, 'screen');
		
		wp_enqueue_style('cmsmasters-admin-styles');
		
		
		wp_register_style('cmsmasters_content_composer_css', CMSMASTERS_CONTENT_COMPOSER_URL . 'css/jquery.cmsmastersContentComposer.css', array(), CMSMASTERS_CONTENT_COMPOSER_VERSION, 'screen');
		
		wp_register_style('cmsmasters_composer_lightbox_css', CMSMASTERS_CONTENT_COMPOSER_URL . 'css/jquery.cmsmastersComposerLightbox.css', array(), CMSMASTERS_CONTENT_COMPOSER_VERSION, 'screen');
		
		wp_register_style('cmsmasters_content_composer_css_rtl', CMSMASTERS_CONTENT_COMPOSER_URL . 'css/jquery.cmsmastersContentComposer-rtl.css', array(), CMSMASTERS_CONTENT_COMPOSER_VERSION, 'screen');
		
		wp_register_style('cmsmasters_composer_lightbox_css_rtl', CMSMASTERS_CONTENT_COMPOSER_URL . 'css/jquery.cmsmastersComposerLightbox-rtl.css', array(), CMSMASTERS_CONTENT_COMPOSER_VERSION, 'screen');
		
		
		wp_register_script('cmsmasters_composer_shortcodes_js', CMSMASTERS_CONTENT_COMPOSER_URL . 'js/cmsmastersContentComposer-shortcodes.js', array(), CMSMASTERS_CONTENT_COMPOSER_VERSION, true);
		
		wp_localize_script('cmsmasters_composer_shortcodes_js', 'cmsmasters_shortcodes', array( 
		
		/* Start Global Translations */
		
			// Super Global
			'title' =>											__('Title', 'cmsmasters-content-composer'),
			'subtitle' =>										__('Subtitle', 'cmsmasters-content-composer'),
			'content' =>										__('Content', 'cmsmasters-content-composer'),
			'icon' =>											__('Icon', 'cmsmasters-content-composer'),
			'image' =>											__('Image', 'cmsmasters-content-composer'),
			'number' =>											__('Number', 'cmsmasters-content-composer'),
			'size' =>											__('Size', 'cmsmasters-content-composer'),
			'button' =>											__('Button', 'cmsmasters-content-composer'),
			'link' =>											__('Link', 'cmsmasters-content-composer'),
			'divider' =>										__('Divider', 'cmsmasters-content-composer'),
			'color' =>											__('Color', 'cmsmasters-content-composer'),
			'mode' =>											__('Mode', 'cmsmasters-content-composer'),
			'name' => 											__('Name', 'cmsmasters-content-composer'),
			'icon_type' =>										__('Icon Type', 'cmsmasters-content-composer'),
			'orderby_title' =>									__('Order By', 'cmsmasters-content-composer'),
			'order_title' =>									__('Order', 'cmsmasters-content-composer'),
			'order_descr' =>									__("Designates the ascending or descending order of the 'order by' parameter", 'cmsmasters-content-composer'),
			'categories' =>										__('Categories', 'cmsmasters-content-composer'),
			'layout' =>											__('Layout', 'cmsmasters-content-composer'),
			'click_here' => 									__('click here', 'cmsmasters-content-composer'),
			'more_info' => 										__('for more information', 'cmsmasters-content-composer'),
			'columns_count' =>									__('Columns Count', 'cmsmasters-content-composer'),
			'value_number' => 									__('number', 'cmsmasters-content-composer'),
			'value_zero' => 									__('(0 if empty)', 'cmsmasters-content-composer'),
			'clear_color_note' => 								__('If empty, default color scheme will be applied', 'cmsmasters-content-composer'),
			'note' => 											__('Note:', 'cmsmasters-content-composer'),
			'def_text' => 										__('Click here to change this text', 'cmsmasters-content-composer'),
			'size_zero_note' => 								__('number, in pixels (default value if empty or 0)', 'cmsmasters-content-composer'),
			'text_align' => 									__('Text Align', 'cmsmasters-content-composer'),
			'link_target' => 									__('Link Target', 'cmsmasters-content-composer'),
			'link_target_choice_self' =>						__('Open link in a SAME tab/window', 'cmsmasters-content-composer'),
			'link_target_choice_blank' =>						__('Open link in a NEW tab/window', 'cmsmasters-content-composer'),
			'size_note' =>										__('number, in pixels (default value if empty)', 'cmsmasters-content-composer'),	
			'size_note_pixel' =>								__('number, in pixels', 'cmsmasters-content-composer'),	
			'media_def' =>										__('Enter your link here', 'cmsmasters-content-composer'),
			'top_margin' =>										__('Top Margin', 'cmsmasters-content-composer'),
			'bottom_margin' =>									__('Bottom Margin', 'cmsmasters-content-composer'),
			'autoplay' =>										__('Autoplay', 'cmsmasters-content-composer'),
			'autoplay_descr' =>									__('Animate slider automatically', 'cmsmasters-content-composer'),
			'repeat' =>											__('Repeat', 'cmsmasters-content-composer'),
			'preload' =>										__('Preload', 'cmsmasters-content-composer'),
			'audio' =>											__('Audio', 'cmsmasters-content-composer'),
			'layout_mode' =>									__('Layout Mode', 'cmsmasters-content-composer'),
			'metadata' =>										__('Metadata', 'cmsmasters-content-composer'),
			'height' =>											__('Height', 'cmsmasters-content-composer'),
			'border' =>											__('Border', 'cmsmasters-content-composer'),
			'size_note_short' =>								__('number, in pixels', 'cmsmasters-content-composer'),
			'pause_time' =>										__('Pause Time', 'cmsmasters-content-composer'),
			'autoslide_def' =>										__('if \'0\' - autoslide disabled, if empty - \'5\' (in seconds)', 'cmsmasters-content-composer'),
			'pause_on_hover' =>									__('Pause on Hover', 'cmsmasters-content-composer'),
			'border_radius_descr_note_1' =>						__('You can set any border radius rule here.', 'cmsmasters-content-composer'),
			'border_radius_descr_note_2' =>						__('For creating correct rule please use', 'cmsmasters-content-composer'),
			'border_radius_descr_note_3' =>						__('this link', 'cmsmasters-content-composer'),
			'border_radius_descr_note_4' =>						__('For example: 15px 50px 30px 5px', 'cmsmasters-content-composer'),
			'border_radius_descr_note_5' =>						__('on this screenshot', 'cmsmasters-content-composer'),
			'box_shadow_descr_note_1' =>						__('You can set any box shadow rule here.', 'cmsmasters-content-composer'),
			'box_shadow_descr_note_2' =>						__('For creating correct rule please use', 'cmsmasters-content-composer'),
			'box_shadow_descr_note_3' =>						__('this link', 'cmsmasters-content-composer'),
			'box_shadow_descr_note_4' =>						__('For example: 10px 10px 8px 10px #888888', 'cmsmasters-content-composer'),
			
			
			
			
			// Choices		
			'choice_default' => 								__('Default', 'cmsmasters-content-composer'),
			'choice_left' => 									__('Left', 'cmsmasters-content-composer'),
			'choice_center' => 									__('Center', 'cmsmasters-content-composer'),
			'choice_right' => 									__('Right', 'cmsmasters-content-composer'),
			'choice_enable' => 									__('Enable', 'cmsmasters-content-composer'),	
			'choice_block' =>									__('Block', 'cmsmasters-content-composer'),
			'choice_inline' =>									__('Inline', 'cmsmasters-content-composer'),
			'choice_inline_block' =>							__('Inline-Block', 'cmsmasters-content-composer'),
			'choice_show' => 									__('Show', 'cmsmasters-content-composer'),
			'choice_date' => 									__('Date', 'cmsmasters-content-composer'),
			'choice_amount' => 									__('Amount', 'cmsmasters-content-composer'),
			'choice_image' => 									__('Image', 'cmsmasters-content-composer'),
			'choice_link' => 									__('Link', 'cmsmasters-content-composer'),
			'choice_id' => 										__('ID', 'cmsmasters-content-composer'),
			'choice_menu' => 									__('Menu Order', 'cmsmasters-content-composer'),
			'choice_popular' => 								__('Popular', 'cmsmasters-content-composer'),
			'choice_rand' => 									__('Random', 'cmsmasters-content-composer'),
			'choice_asc' => 									__('ASC', 'cmsmasters-content-composer'),
			'choice_desc' => 									__('DESC', 'cmsmasters-content-composer'),
			'choice_categories' => 								__('Categories', 'cmsmasters-content-composer'),
			'choice_comments' => 								__('Comments', 'cmsmasters-content-composer'),
			'choice_likes' => 									__('Likes', 'cmsmasters-content-composer'),
			'choice_author' => 									__('Author', 'cmsmasters-content-composer'),
			'choice_tags' => 									__('Tags', 'cmsmasters-content-composer'),
			'choice_title' => 									__('Title', 'cmsmasters-content-composer'),
			'choice_excerpt' => 								__('Excerpt', 'cmsmasters-content-composer'),
			'choice_rollover' => 								__('Image Rollover', 'cmsmasters-content-composer'),
			'choice_more' => 									__("'Read More' button", 'cmsmasters-content-composer'),
			'choice_icon_side' => 								__('Side Icon', 'cmsmasters-content-composer'),
			'choice_icon_top' => 								__('Top Icon', 'cmsmasters-content-composer'),
			'choice_vertical' => 								__('Vertical', 'cmsmasters-content-composer'),
			'choice_horizontal' => 								__('Horizontal', 'cmsmasters-content-composer'),			
			'position_choice_left_side' =>						__('Left side', 'cmsmasters-content-composer'),
			'position_choice_right_side' =>						__('Right side', 'cmsmasters-content-composer'),
			'button_icon_descr' =>								__('Choose icon for your button', 'cmsmasters-content-composer'),
			'choice_slider' =>									__('Slider', 'cmsmasters-content-composer'),
			'choice_grid' =>									__('Grid', 'cmsmasters-content-composer'),
			'choice_short' =>									__('Short', 'cmsmasters-content-composer'),
			'choice_medium' =>									__('Medium', 'cmsmasters-content-composer'),
			'choice_long' =>									__('Long', 'cmsmasters-content-composer'),
			'choice_solid' =>									__('Solid', 'cmsmasters-content-composer'),
			'choice_dotted' =>									__('Dotted', 'cmsmasters-content-composer'),
			'choice_dashed' =>									__('Dashed', 'cmsmasters-content-composer'),
			'choice_double' =>									__('Double', 'cmsmasters-content-composer'),
			'choice_groove' =>									__('Groove', 'cmsmasters-content-composer'),
			'choice_ridge' =>									__('Ridge', 'cmsmasters-content-composer'),
			'choice_inset' =>									__('Inset', 'cmsmasters-content-composer'),
			'choice_outset' =>									__('Outset', 'cmsmasters-content-composer'),
			'choice_decimal' =>									__('Decimal number', 'cmsmasters-content-composer'),
			'choice_decimal_zero' =>							__('Decimal leading zero number', 'cmsmasters-content-composer'),
			'choice_l_roman' =>									__('Lower roman number', 'cmsmasters-content-composer'),
			'choice_u_roman' =>									__('Upper roman number', 'cmsmasters-content-composer'),
			'choice_l_greek' =>									__('Lower greek number', 'cmsmasters-content-composer'),
			'choice_l_latin' =>									__('Lower latin number', 'cmsmasters-content-composer'),
			'choice_u_latin' =>									__('Upper latin number', 'cmsmasters-content-composer'),
			'choice_but_bg_hover' =>							__('Change background on hover', 'cmsmasters-content-composer'),
			'cmsmasters_but_bd_underline' =>					__('Border underline', 'cmsmasters-content-composer'),
			'choice_but_bg_slide_left' =>						__('Background slide to left', 'cmsmasters-content-composer'),
			'choice_but_bg_slide_right' =>						__('Background slide to right', 'cmsmasters-content-composer'),
			'choice_but_bg_slide_top' =>						__('Background slide to top', 'cmsmasters-content-composer'),
			'choice_but_bg_slide_bottom' =>						__('Background slide to bottom', 'cmsmasters-content-composer'),
			'choice_but_bg_expand_vert' =>						__('Background expand vertically', 'cmsmasters-content-composer'),
			'choice_but_bg_expand_hor' =>						__('Background expand horizontally', 'cmsmasters-content-composer'),
			'choice_but_bg_expand_diag' =>						__('Background expand diagonally', 'cmsmasters-content-composer'),
			'choice_but_shadow' =>								__('Shadow', 'cmsmasters-content-composer'),
			'choice_but_icon_dark_bg' =>						__('Icon on dark background', 'cmsmasters-content-composer'),
			'choice_but_icon_light_bg' =>						__('Icon on light background', 'cmsmasters-content-composer'),
			'choice_but_icon_divider' =>						__('Icon with divider', 'cmsmasters-content-composer'),
			'choice_but_icon_inverse' =>						__('Inverse icon color', 'cmsmasters-content-composer'),
			'choice_but_slide_left' =>							__('Icon slide from left', 'cmsmasters-content-composer'),
			'choice_but_slide_right' =>							__('Icon slide from right', 'cmsmasters-content-composer'),
			'choice_but_hover_slide_left' =>					__('Replace with icon from left', 'cmsmasters-content-composer'),
			'choice_but_hover_slide_right' =>					__('Replace with icon from right', 'cmsmasters-content-composer'),
			'choice_but_hover_slide_top' =>						__('Replace with icon from top', 'cmsmasters-content-composer'),
			'choice_but_hover_slide_bottom' =>					__('Replace with icon from bottom', 'cmsmasters-content-composer'),
			
			
			// Animation
			'animation_title' => 								__('Animation', 'cmsmasters-content-composer'), 
			'animation_descr' => 								__('Shortcode animation effect when a user scrolls to its position for the first time.', 'cmsmasters-content-composer'), 
			'animation_descr_note' => 							__('This option works only in modern browsers', 'cmsmasters-content-composer'), 
			'animation_delay_title' => 							__('Animation Delay', 'cmsmasters-content-composer'), 
			'animation_delay_descr' => 							__('Delay before shortcode animation starts', 'cmsmasters-content-composer'), 
			'animation_delay_descr_note' => 					__('number, in milliseconds (1 second = 1000 milliseconds)', 'cmsmasters-content-composer'),
			
			// Classes
			'classes_title' => 									__('Additional Classes', 'cmsmasters-content-composer'), 
			'classes_descr' => 									__('You can add additional CSS classes (separated by spaces) to the shortcode, if you wish to style content elements differently', 'cmsmasters-content-composer'),
			
			// Filters & Sorting
			'filter' =>											__('Filter', 'cmsmasters-content-composer'),
			'filter_text_title' =>								__('Filter Button Text', 'cmsmasters-content-composer'),
			'filter_text_descr' =>								__('Enter filter button custom title', 'cmsmasters-content-composer'),
			'filter_text_descr_note' =>							__('if empty, default filter button title will be used', 'cmsmasters-content-composer'),
			'filter_enabled_text_descr_note' =>					__('This option works only if filter enabled', 'cmsmasters-content-composer'),
			'filter_cats_text_title' =>							__("Filter 'All Categories' Text", 'cmsmasters-content-composer'),
			'filter_cats_text_descr' =>							__("Enter filter 'All Categories' custom text", 'cmsmasters-content-composer'),
			'filter_cats_text_descr_note' =>					__("if empty, default filter 'All Categories' text will be used", 'cmsmasters-content-composer'),
			'sorting_name_text_title' =>						__('Sorting By Name Button Text', 'cmsmasters-content-composer'),
			'sorting_name_text_descr' =>						__('Enter sorting by name button custom title', 'cmsmasters-content-composer'),
			'sorting_name_text_descr_note' =>					__('if empty, default sorting by name button title will be used', 'cmsmasters-content-composer'),
			'sorting_date_text_title' =>						__('Sorting By Date Button Text', 'cmsmasters-content-composer'),
			'sorting_date_text_descr' =>						__('Enter sorting by date button custom title', 'cmsmasters-content-composer'),
			'sorting_date_text_descr_note' =>					__('if empty, default sorting by date button title will be used', 'cmsmasters-content-composer'),
			'sorting_enabled_text_descr_note' =>				__('This option works only if sorting enabled', 'cmsmasters-content-composer'),
			'pagination_choice_pagination' =>					__('Pagination', 'cmsmasters-content-composer'),
			'pagination_choice_more' =>							__("'Load More' button", 'cmsmasters-content-composer'),
			'pagination_choice_disabled' =>						__('Disable additional posts', 'cmsmasters-content-composer'),
			'pagination_title' =>								__('Pagination', 'cmsmasters-content-composer'),
			'pagination_descr' =>								__('Choose your method of viewing additional posts', 'cmsmasters-content-composer'),
			'pagination_more_text_title' =>						__("'Load More' Button Text", 'cmsmasters-content-composer'),
			'pagination_more_text_descr' =>						__("Enter 'Load More' button custom title", 'cmsmasters-content-composer'),
			'pagination_more_text_descr_note' =>				__("if empty, default 'Load More' button title will be used", 'cmsmasters-content-composer'),
			'background_color' =>								__('Background Color', 'cmsmasters-content-composer'),
			
		/* Finish Global Translations */
		
		
		
		/* Start cmsmasters_text Translations */
		
			'text_title' => 									__('Text Block', 'cmsmasters-content-composer'), 
			
		/* Finish cmsmasters_text Translations */
		
		
		/* Start cmsmasters_heading Translations */
		
			'heading_title' => 									__('Heading', 'cmsmasters-content-composer'), 
			'heading_field_content_title' => 					__('Heading Text', 'cmsmasters-content-composer'),
			'heading_field_type_title' => 						__('Heading Type', 'cmsmasters-content-composer'),
			'heading_field_font_title' =>						__('Google Font', 'cmsmasters-content-composer'),
			'heading_field_font_size_title' =>					__('Font Size', 'cmsmasters-content-composer'),
			'heading_field_line_height_title' =>				__('Line Height', 'cmsmasters-content-composer'),
			'heading_field_font_weight_title' =>				__('Font Weight', 'cmsmasters-content-composer'),
			'heading_field_font_style_title' =>					__('Font Style', 'cmsmasters-content-composer'),
			'heading_field_icon_title' => 						__('Heading Icon', 'cmsmasters-content-composer'),
			'heading_field_border_radius_title' => 				__('Heading Border Radius', 'cmsmasters-content-composer'),
			'heading_field_border_radius_descr' => 				__('Enter heading background border radius.', 'cmsmasters-content-composer'),
			'heading_field_border_radius_descr_note' => 		__('Works only for headings with background color', 'cmsmasters-content-composer'),
			'heading_field_link_title' =>						__('Heading Link', 'cmsmasters-content-composer'),
			'heading_field_color_title' =>						__('Heading Custom Color', 'cmsmasters-content-composer'),
			'heading_field_color_descr_note' =>					__('If empty, heading will use color of parent section color scheme', 'cmsmasters-content-composer'),
			'heading_field_bg_color_title' =>					__('Heading Custom Background Color', 'cmsmasters-content-composer'),
			'heading_field_link_color_h_title' =>				__('Heading Custom Link Color on Hover', 'cmsmasters-content-composer'),
			'heading_field_resp_vert_mar_title' =>				__('Set Custom Margin for Various Screens', 'cmsmasters-content-composer'),
			'heading_field_divider_color_title' =>				__('Heading Divider Custom Color', 'cmsmasters-content-composer'),
			'heading_field_divider_color_descr_note' =>			__('If empty, heading divider will use border color of parent section color scheme', 'cmsmasters-content-composer'),
			'heading_field_underline' =>						__('Underline', 'cmsmasters-content-composer'),
			'heading_field_underline_height' =>					__('Underline Height', 'cmsmasters-content-composer'),
			'heading_field_underline_style' =>					__('Underline Style', 'cmsmasters-content-composer'),
			'heading_field_underline_color' =>					__('Underline Custom Color', 'cmsmasters-content-composer'),
			'heading_field_custom_check' => 					__('Set Custom Font Size for Various Screens', 'cmsmasters-content-composer'),
			'heading_field_custom_size_responsive_title' => 	__('Custom Font Settings for Resolution', 'cmsmasters-content-composer'),
			'heading_field_custom_size_responsive_descr' => 	__('Add values for max monitor width, font size and line height using | for separation.', 'cmsmasters-content-composer'),
			'heading_field_custom_size_responsive_descr_note' => __('number, in pixels (default value if empty)', 'cmsmasters-content-composer'),
			'heading_field_custom_size_responsive_example' => 	__('For example:', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_heading Translations */
		
		
		/* Start cmsmasters_audios Translations */
			
			'audio_field_audio_descr' => 						__('Here you can add, edit, remove or sort audio links', 'cmsmasters-content-composer'),
			'audio_field_audio_descr_note' => 					__('Please add audio in several formats for your shortcode to work properly in all browsers', 'cmsmasters-content-composer'),
			'audio_field_autoplay_descr' => 					__('If checked, audio will play as soon as the audio is ready', 'cmsmasters-content-composer'),
			'audio_field_repeat_descr' => 						__('If checked, audio will be repeated from the beginning after finishing', 'cmsmasters-content-composer'),
			'audio_field_preload_descr' => 						__('Specifies if and how the audio should be loaded when the page loads', 'cmsmasters-content-composer'),
			'audio_field_preload_choice_none' => 				__('None - the audio should not be loaded when the page loads', 'cmsmasters-content-composer'),
			'audio_field_preload_choice_auto' => 				__('Auto - the audio should be loaded entirely when the page loads', 'cmsmasters-content-composer'),
			'audio_field_preload_choice_metadata' => 			__('Metadata - only metadata should be loaded when the page loads', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_audios Translations */

		/* Start cmsmasters_blog Translations */		
		
			'blog_title' =>										__('Blog', 'cmsmasters-content-composer'),			
			'blog_field_orderby_descr' =>						__('Choose what parameter your posts will be ordered by', 'cmsmasters-content-composer'),			
			'blog_field_postsnumber_title' =>					__('Posts Number', 'cmsmasters-content-composer'),
			'blog_field_postsnumber_descr' =>					__('Enter the number of posts to be shown per page', 'cmsmasters-content-composer'),
			'blog_field_postsnumber_descr_note' =>				__('number, if empty - show all posts', 'cmsmasters-content-composer'),			
			'blog_field_categories_descr' =>					__('Show posts associated with certain categories', 'cmsmasters-content-composer'),
			'blog_field_categories_descr_note' =>				__("If you don't choose any post categories, all your posts will be shown", 'cmsmasters-content-composer'),
			'blog_field_layout_choice_standard' =>				__('Standard', 'cmsmasters-content-composer'),
			'blog_field_layout_choice_columns' =>				__('Columns', 'cmsmasters-content-composer'),
			'blog_field_layout_choice_timeline' =>				__('Timeline', 'cmsmasters-content-composer'),
			'blog_field_layout_mode_descr' =>					__('Choose columns layout mode for your blog posts', 'cmsmasters-content-composer'),
			'blog_field_layout_mode_choice_masonry' =>			__('Masonry', 'cmsmasters-content-composer'),
			'blog_field_columns_count_descr' =>					__('Choose number of posts per row', 'cmsmasters-content-composer'),
			'blog_field_columns_count_descr_note' =>			__('4 columns will be shown for pages with a fullwidth layout only. For pages with a sidebar enabled, maximum columns amount is 3.', 'cmsmasters-content-composer'),
			'blog_field_metadata_descr' =>						__('Choose blog posts metadata you want to be shown', 'cmsmasters-content-composer'),
			'blog_field_filter_descr' =>						__('If checked, blog posts category filter will be shown', 'cmsmasters-content-composer'),
		
		/* Finish cmsmasters_blog Translations */
		
		
		/* Start cmsmasters_button Translations */
		
			'button_field_show_title' =>						__('Show Button', 'cmsmasters-content-composer'),
			'button_field_show_descr' =>						__('If checked, button will be shown', 'cmsmasters-content-composer'),
			'button_field_label_title' =>						__('Button Label', 'cmsmasters-content-composer'),
			'button_field_label_descr' =>						__('Enter button label here', 'cmsmasters-content-composer'),
			'button_field_link_title' =>						__('Button Link', 'cmsmasters-content-composer'),
			'button_field_link_descr' =>						__('Enter button link here', 'cmsmasters-content-composer'),
			'button_field_target_title' =>						__('Button Target', 'cmsmasters-content-composer'),
			'button_field_target_descr' =>						__('Enter button target here', 'cmsmasters-content-composer'),
			'button_field_text_align_title' =>					__('Button Position', 'cmsmasters-content-composer'),
			'button_field_text_align_descr' =>					__('Choose horizontal position for your button', 'cmsmasters-content-composer'),
			'button_field_style_title' =>						__('Choose Button Style', 'cmsmasters-content-composer'),
			'button_field_label_google_font_title' =>			__('Button Label Google Font', 'cmsmasters-content-composer'),
			'button_field_label_google_font_descr' =>			__('Choose custom Google font for your button label', 'cmsmasters-content-composer'),
			'button_field_label_google_font_descr_note' =>		__('if empty, theme default button label font will be used', 'cmsmasters-content-composer'),
			'button_field_label_font_size_title' =>				__('Button Label Font Size', 'cmsmasters-content-composer'),
			'button_field_label_font_size_descr' =>				__('Choose custom font size for your button label ', 'cmsmasters-content-composer'),
			'button_field_label_font_size_descr_note' =>		__('if empty, theme default button label font size will be used', 'cmsmasters-content-composer'),
			'button_field_label_line_hight_title' =>			__('Button Label Line Height', 'cmsmasters-content-composer'),
			'button_field_label_line_height_descr' =>			__('Choose custom line height for your button label ', 'cmsmasters-content-composer'),
			'button_field_label_line_height_descr_note' =>		__('if empty, theme default button label line height will be used', 'cmsmasters-content-composer'),
			'button_field_label_font_weight_title' =>			__('Button Label Font Weight', 'cmsmasters-content-composer'),
			'button_field_label_font_weight_descr' =>			__('Set font weight value for your button label', 'cmsmasters-content-composer'),
			'button_field_label_font_style_title' =>			__('Button Label Font Style', 'cmsmasters-content-composer'),
			'button_field_label_font_style_descr' =>			__('Set font style value for your button label', 'cmsmasters-content-composer'),
			'button_field_label_text_transform_title' =>		__('Button Label Text Transform', 'cmsmasters-content-composer'),
			'button_field_label_text_transform_descr' =>		__('Set text transform value for your button label', 'cmsmasters-content-composer'),
			'button_field_paddings_title' =>					__('Button Left & Right Paddings', 'cmsmasters-content-composer'),
			'button_field_paddings_descr' =>					__('Set right/left paddings for your button (to make it wider or narrower)', 'cmsmasters-content-composer'),
			'button_field_paddings_descr_note' =>				__('if empty, theme default button paddings will be used', 'cmsmasters-content-composer'),
			'button_field_margin_title' =>						__('Button Margins', 'cmsmasters-content-composer'),
			'button_field_margin_descr' =>						__('Set margins for your button', 'cmsmasters-content-composer'),
			'button_field_resp_vert_mar_title' =>				__('Set Custom Margin', 'cmsmasters-content-composer'),
			'button_field_margin_large_title' =>				__('Margin for Large Screens', 'cmsmasters-content-composer'),
			'button_field_margin_large_descr' =>				__('Enter margin for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'button_field_margin_laptop_title' =>				__('Margin for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'button_field_margin_laptop_descr' =>				__('Enter margin for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'button_field_margin_tablet_title' =>				__('Margin for Tablet Vertical View', 'cmsmasters-content-composer'),
			'button_field_margin_tablet_descr' =>				__('Enter margin for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'button_field_margin_mobile_h_title' =>				__('Margin for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'button_field_margin_mobile_h_descr' =>				__('Enter margin for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'button_field_margin_mobile_v_title' =>				__('Margin for Mobile Vertical View', 'cmsmasters-content-composer'),
			'button_field_margin_mobile_v_descr' =>				__('Enter margin for devices with max-width 320px and below', 'cmsmasters-content-composer'),
			'button_field_border_width_title' =>				__('Button Border Width', 'cmsmasters-content-composer'),
			'button_field_border_width_descr' =>				__('Enter button border width', 'cmsmasters-content-composer'),
			'button_field_border_style_title' =>				__('Button Border Style', 'cmsmasters-content-composer'),
			'button_field_border_radius_title' =>				__('Button Border Radius', 'cmsmasters-content-composer'),'button_field_border_radius_descr' =>				__('Enter button border radius (default if empty).', 'cmsmasters-content-composer'),
			'button_field_bg_color_title' =>					__('Button Background Color', 'cmsmasters-content-composer'),
			'button_field_bg_color_descr' =>					__('Choose your custom button background color', 'cmsmasters-content-composer'),
			'button_field_txt_color_title' =>					__('Button Text Color', 'cmsmasters-content-composer'),
			'button_field_txt_color_descr' =>					__('Choose your custom button text color', 'cmsmasters-content-composer'),
			'button_field_bd_color_title' =>					__('Button Border Color', 'cmsmasters-content-composer'),
			'button_field_bd_color_descr' =>					__('Choose your custom button border color', 'cmsmasters-content-composer'),
			'button_field_bg_color_h_title' =>					__('Button Background Color on Mouseover', 'cmsmasters-content-composer'),
			'button_field_bg_color_h_descr' =>					__('Choose your custom button background color on mouseover', 'cmsmasters-content-composer'),
			'button_field_txt_color_h_title' =>					__('Button Text Color on Mouseover', 'cmsmasters-content-composer'),
			'button_field_txt_color_h_descr' =>					__('Choose your custom button text color on mouseover', 'cmsmasters-content-composer'),
			'button_field_bd_color_h_title' =>					__('Button Border Color on Mouseover', 'cmsmasters-content-composer'),
			'button_field_bd_color_h_descr' =>					__('Choose your custom button border color on mouseover', 'cmsmasters-content-composer'),
			'button_field_icon_title' =>						__('Button Icon', 'cmsmasters-content-composer'),
			'button_field_icon_descr' =>						__('Choose an icon for your button', 'cmsmasters-content-composer'),
			'button_field_title_descr' =>						__('Enter button title here', 'cmsmasters-content-composer'),
			'button_field_google_font_descr' =>					__('Choose custom Google font for your button', 'cmsmasters-content-composer'),
			'button_field_google_font_descr_note' =>			__('if empty, theme default button title font will be used', 'cmsmasters-content-composer'),
			'button_field_font_size_descr' =>					__('Choose custom font size for your button title', 'cmsmasters-content-composer'),
			'button_field_font_size_descr_note' =>				__('if empty, theme default button title font size will be used', 'cmsmasters-content-composer'),
			'button_field_line_height_descr' =>					__('Choose custom line height for your button title', 'cmsmasters-content-composer'),
			'button_field_line_height_descr_note' =>			__('if empty, theme default button title line height will be used', 'cmsmasters-content-composer'),
			'button_field_font_weight_descr' =>					__('Set font weight value for your button title', 'cmsmasters-content-composer'),
			'button_field_font_style_descr' =>					__('Choose font style for your button title', 'cmsmasters-content-composer'),
			'button_field_text_align_title' =>					__('Button Position', 'cmsmasters-content-composer'),
			'button_field_text_align_descr' =>					__('Choose horizontal position for your button', 'cmsmasters-content-composer'),
			'button_field_custom_button_colors_title' =>		__('Custom Button Colors', 'cmsmasters-content-composer'),
			'button_field_custom_button_colors_descr' =>		__('If not checked, button will use parent section color scheme colors', 'cmsmasters-content-composer'),
	
		/* Finish cmsmasters_button Translations */		

		
		/* Start cmsmasters_clients Translations */
		
			'clients_title' =>									__('Clients', 'cmsmasters-content-composer'),
			'clients_field_clients_descr' =>					__('Add, edit, remove or sort your clients here to be displayed on page', 'cmsmasters-content-composer'),			
			'clients_field_col_count_descr' =>					__('Choose number of clients per row', 'cmsmasters-content-composer'),			
			'clients_field_height_descr' =>						__('Client items height', 'cmsmasters-content-composer'),
			'clients_field_height_descr_note' =>				__('number, in pixels (default value is 180)', 'cmsmasters-content-composer'),
			
			'clients_field_speed_title' =>						__('Speed', 'cmsmasters-content-composer'),
			'clients_field_speed_descr' =>						__('Slide speed in seconds', 'cmsmasters-content-composer'),
			'clients_field_speed_descr_note' =>					__('If empty - 1 (in seconds)', 'cmsmasters-content-composer'),
			'clients_field_slides_control_title' =>				__('Slides Control', 'cmsmasters-content-composer'),
			'clients_field_arrow_control_title' =>				__('Arrow Control', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_button Translations */		

		
		/* Start cmsmasters_contact_form Translations */
		
			'contact_form_title' =>								__('Contact Form', 'cmsmasters-content-composer'),
			'contact_form_cfb' =>								__('CMSMasters Contact Form Builder', 'cmsmasters-content-composer'),
			'contact_form_cf7' =>								__('Contact Form 7', 'cmsmasters-content-composer'),
			'contact_form_ninja' =>								__('Ninja Forms', 'cmsmasters-content-composer'),
			'contact_form_wpforms' =>							__('WPForms', 'cmsmasters-content-composer'),
			'contact_form_field_form_plugin_title' =>			__('Contact Form Plugin', 'cmsmasters-content-composer'),
			'contact_form_field_form_plugin_descr' =>			__('Choose one of supported contact form plugins', 'cmsmasters-content-composer'),
			'contact_form_field_form_plugin_descr_note' =>		__('Please make sure that the Contact Form plugin you have chosen is currently installed and activated.', 'cmsmasters-content-composer'),
			'contact_form_field_ninja_id_title' =>				__('Ninja - Form Name', 'cmsmasters-content-composer'),
			'contact_form_field_ninja_id_descr' =>				__('Choose your form name from Ninja Forms plugin', 'cmsmasters-content-composer'),
			'contact_form_field_wpforms_id_title' =>			__('WPForms - Form Name', 'cmsmasters-content-composer'),
			'contact_form_field_wpforms_id_descr' =>			__('Choose your form name from WPForms plugin', 'cmsmasters-content-composer'),
			'contact_form_field_cf7_id_title' =>				__('Contact Form 7 - Form Name', 'cmsmasters-content-composer'),
			'contact_form_field_cf7_id_descr' =>				__('Choose your form name from Contact Form 7 plugin', 'cmsmasters-content-composer'),
			'contact_form_field_cfb_id_title' =>				__('CMSMasters Contact Form Builder - Form Name', 'cmsmasters-content-composer'),
			'contact_form_field_cfb_id_descr' =>				__('Choose your form name from CMSMasters Contact Form Builder plugin', 'cmsmasters-content-composer'),
			'contact_form_field_cfb_email_title' =>				__('CMSMasters Contact Form Builder - Email Address', 'cmsmasters-content-composer'),
			'contact_form_field_cfb_email_descr' =>				__('Enter email address for your CMSMasters Contact Form Builder plugin form', 'cmsmasters-content-composer'),
			'contact_form_field_cfb_email_descr_note' =>		__('You can enter multiple email addresses separated by commas', 'cmsmasters-content-composer'),
			'contact_form_field_cfb_email_from_name_title' =>	__('CMSMasters Contact Form Builder - Email From Name', 'cmsmasters-content-composer'),
			'contact_form_field_cfb_email_from_name_descr' =>	__('Enter the From Name, which will be displayed into the From field of the incoming email before your domain name.', 'cmsmasters-content-composer'),
		
		/* Finish cmsmasters_contact_form Translations */
		
		/* Start cmsmasters_divider Translations */
			
			'divider_length' =>									__('Divider Length', 'cmsmasters-content-composer'),
			'divider_width' =>									__('Divider Width', 'cmsmasters-content-composer'),
			'divider_style' =>									__('Divider Style', 'cmsmasters-content-composer'),
			'divider_position' =>								__('Divider Position', 'cmsmasters-content-composer'),
			'divider_custom_color' =>							__('Divider Custom Color', 'cmsmasters-content-composer'),
			'divider_custom_color_descr_note' =>				__('If empty, divider will use border color of parent section color scheme', 'cmsmasters-content-composer'),
		
		/* Finish cmsmasters_divider Translations */	
		
		/* Start cmsmasters_embed Translations */
		
			'embed_title' =>									__('Embed', 'cmsmasters-content-composer'),			
			'embed_field_link_descr' =>							__('Enter your embed link.', 'cmsmasters-content-composer'),
			'embed_field_link_descr_note' =>					__('This field support links from', 'cmsmasters-content-composer'),
			'embed_field_link_descr_note_link' =>				__('such services', 'cmsmasters-content-composer'),
			'embed_field_maxwidth_title' =>						__('Max Width', 'cmsmasters-content-composer'),
			'embed_field_maxwidth_descr' =>						__('Defines max width of the embed', 'cmsmasters-content-composer'),
			'embed_field_maxwidth_descr_note' =>				__("('Media file width' if empty)", 'cmsmasters-content-composer'),
			'embed_field_maxheight_title' =>					__('Max Height', 'cmsmasters-content-composer'),
			'embed_field_maxheight_descr' =>					__('Defines max height of the embed', 'cmsmasters-content-composer'),
			'embed_field_maxheight_descr_note' =>				__("('Media file height' if empty)", 'cmsmasters-content-composer'),
			'embed_field_wrap_title' =>							__('Wrap Video', 'cmsmasters-content-composer'),
			'embed_field_wrap_descr' =>							__('Wrap video into container to ignore default video height/max-height and set a 16:9 proportion instead.', 'cmsmasters-content-composer'),
			'embed_field_wrap_descr_note' =>					__('Recommended only for video embeds', 'cmsmasters-content-composer'),		
					
		/* Finish cmsmasters_embed Translations */	
		
		/* Start cmsmasters_featured_block Translations */
		
			'featured_title' =>									__('Featured Block', 'cmsmasters-content-composer'),
			'featured_field_content_title' =>					__('Content', 'cmsmasters-content-composer'),
			'featured_field_text_width_title' => 				__('Text Block Width', 'cmsmasters-content-composer'), 
			'featured_field_text_width_descr' => 				__('Choose text block width (percentage)', 'cmsmasters-content-composer'), 
			'featured_field_text_position' => 					__('Text Block Position', 'cmsmasters-content-composer'), 
			'featured_field_link_title' =>						__('Featured Block Link', 'cmsmasters-content-composer'), 
			'featured_field_text_padding_title' => 				__('Text Block Paddings', 'cmsmasters-content-composer'), 
			'featured_field_text_padding_descr' => 				__('Enter full paddings CSS rule for text block', 'cmsmasters-content-composer'),
			'featured_text_field_resp_padding_title' =>			__('Set Custom Text Block Paddings for Various Screens', 'cmsmasters-content-composer'), 
			'featured_text_field_padding_large_title' => 		__('Paddings for Large Screens', 'cmsmasters-content-composer'),
			'featured_text_field_padding_large_descr' => 		__('Enter paddings for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'featured_text_field_padding_laptop_title' => 		__('Paddings for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'featured_text_field_padding_laptop_descr' =>		__('Enter paddings for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'featured_text_field_padding_tablet_title' =>		__('Paddings for Tablet Vertical View', 'cmsmasters-content-composer'),
			'featured_text_field_padding_tablet_descr' =>		__('Enter paddings for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'featured_text_field_padding_mobile_h_title' =>		__('Paddings for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'featured_text_field_padding_mobile_h_descr' =>		__('Enter paddings for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'featured_text_field_padding_mobile_v_title' =>		__('Paddings for Mobile Vertical View', 'cmsmasters-content-composer'),
			'featured_text_field_padding_mobile_v_descr' =>		__('Enter paddings for devices with max-width 320px and below', 'cmsmasters-content-composer'), 
			'featured_field_text_padding_descr_note' => 		__('if empty theme default paddings will be used', 'cmsmasters-content-composer'), 
			'featured_field_text_padding_descr_note_1' => 		__('For creating correct rule please use', 'cmsmasters-content-composer'), 
			'featured_field_text_padding_descr_note_2' => 		__('this link', 'cmsmasters-content-composer'), 
			'featured_field_cust_block_color_title' =>			__('Custom Block Colors', 'cmsmasters-content-composer'),
			'featured_field_cust_block_color_descr' =>			__('If not checked, featured block will use parent section color scheme colors', 'cmsmasters-content-composer'),
			'featured_field_block_bg_color_title' =>			__('Background Color', 'cmsmasters-content-composer'),
			'featured_field_bg_size_descr_auto' =>				__('image is added in its actual size regardless of the block dimensions', 'cmsmasters-content-composer'),
			'featured_field_bg_size_descr_cover' =>				__('image is resized to cover the whole block area', 'cmsmasters-content-composer'),
			'featured_field_bg_size_descr_contain' =>			__('image is resized to fit into the block area', 'cmsmasters-content-composer'),
			'featured_field_top_padding_title' =>				__('Featured Block Top Padding', 'cmsmasters-content-composer'),
			'featured_field_bottom_padding_title' =>			__('Featured Block Bottom Padding', 'cmsmasters-content-composer'),
			'featured_field_border_width_title' =>				__('Featured Block Border Width', 'cmsmasters-content-composer'),
			'featured_field_border_width_descr' =>				__('Enter border width', 'cmsmasters-content-composer'),
			'featured_field_border_style_title' =>				__('Featured Block Border Style', 'cmsmasters-content-composer'),
			'featured_field_border_color_title' =>				__('Featured Block Border Color', 'cmsmasters-content-composer'),
			'featured_field_border_radius_title' =>				__('Featured Block Border Radius', 'cmsmasters-content-composer'),
			'featured_field_border_radius_descr' =>				__('Enter featured block border radius', 'cmsmasters-content-composer'),			
			'featured_field_resp_vert_pad_title' =>				__('Set Custom Paddings for Various Screens', 'cmsmasters-content-composer'),
			'featured_field_padding_top_large_title' =>			__('Top Padding for Large Screens', 'cmsmasters-content-composer'),
			'featured_field_padding_top_large_descr' =>			__('Enter top padding for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_large_title' =>		__('Bottom Padding for Large Screens', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_large_descr' =>		__('Enter bottom padding for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'featured_field_text_width_large_title' => 			__('Text Block Width for Large Screens', 'cmsmasters-content-composer'),
			'featured_field_text_width_large_descr' => 			__('Choose text block width (percentage) for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'featured_field_padding_top_laptop_title' =>		__('Top Padding for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'featured_field_padding_top_laptop_descr' =>		__('Enter top padding for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_laptop_title' =>		__('Bottom Padding for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_laptop_descr' =>		__('Enter bottom padding for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'featured_field_text_width_laptop_title' => 		__('Text Block Width for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'featured_field_text_width_laptop_descr' => 		__('Choose text block width (percentage) for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'featured_field_padding_top_tablet_title' =>		__('Top Padding for Tablet Vertical View', 'cmsmasters-content-composer'),
			'featured_field_padding_top_tablet_descr' =>		__('Enter top padding for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_tablet_title' =>		__('Bottom Padding for Tablet Vertical View', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_tablet_descr' =>		__('Enter bottom padding for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'featured_field_text_width_tablet_title' => 		__('Text Block Width for Tablet Vertical View', 'cmsmasters-content-composer'),
			'featured_field_text_width_tablet_descr' => 		__('Choose text block width (percentage) for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'featured_field_padding_top_mobile_h_title' =>		__('Top Padding for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'featured_field_padding_top_mobile_h_descr' =>		__('Enter top padding for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_mobile_h_title' =>	__('Bottom Padding for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_mobile_h_descr' =>	__('Enter bottom padding for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'featured_field_text_width_mobile_h_title' => 		__('Text Block Width for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'featured_field_text_width_mobile_h_descr' => 		__('Choose text block width (percentage) for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'featured_field_padding_top_mobile_v_title' =>		__('Top Padding for Mobile Vertical View', 'cmsmasters-content-composer'),
			'featured_field_padding_top_mobile_v_descr' =>		__('Enter top padding for devices with max-width 320px and below', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_mobile_v_title' =>	__('Bottom Padding for Mobile Vertical View', 'cmsmasters-content-composer'),
			'featured_field_padding_bottom_mobile_v_descr' =>	__('Enter bottom padding for devices with max-width 320px and below', 'cmsmasters-content-composer'),
			'featured_field_text_width_mobile_v_title' => 		__('Text Block Width for Mobile Vertical View', 'cmsmasters-content-composer'),
			'featured_field_text_width_mobile_v_descr' => 		__('Choose text block width (percentage) for devices with max-width 320px and below', 'cmsmasters-content-composer'),
						
		/* Finish cmsmasters_featured_block Translations */
		
		/* Start cmsmasters_gallery Translations */
		
			'gallery_title' =>									__('Gallery', 'cmsmasters-content-composer'),
			'gallery_field_images_title' =>						__('Images', 'cmsmasters-content-composer'),
			'gallery_field_images_descr' =>						__('Choose images to be displayed in the gallery', 'cmsmasters-content-composer'),
			'gallery_field_image_size_slider_title' =>			__('Gallery Big Preview Image Size', 'cmsmasters-content-composer'),
			'gallery_field_image_size_title' =>					__('Gallery Preview Image Size', 'cmsmasters-content-composer'),
			'gallery_field_image_size_descr' =>					__('Choose image size for the preview thumbnails', 'cmsmasters-content-composer'),
			'gallery_field_layout_descr_note' =>				__('For Hover Slider it is recommended that you use images with min size of 820&#215;490 or larger, but with the same image ratio', 'cmsmasters-content-composer'),
			'gallery_field_layout_choice_hover' =>				__('Hover Slider', 'cmsmasters-content-composer'),
			'gallery_field_layout_choice_gallery' =>			__('Image Gallery', 'cmsmasters-content-composer'),
			'gallery_field_gallery_type_title' =>				__('Gallery Type', 'cmsmasters-content-composer'),
			'gallery_field_gallery_type_grid' =>				__('Grid Gallery', 'cmsmasters-content-composer'),
			'gallery_field_gallery_type_masonry' =>				__('Masonry Gallery', 'cmsmasters-content-composer'),
			'gallery_field_gallery_count_title' =>				__('Images Number', 'cmsmasters-content-composer'),
			'gallery_field_gallery_count_descr' =>				__('Amount of images that will appear each time a \'Load More\' button is clicked', 'cmsmasters-content-composer'),
			'gallery_field_gallery_count_descr_note' =>			__('number, if empty - show all images at once', 'cmsmasters-content-composer'),
			'gallery_field_gallery_padding_title' =>			__('Gallery Gap', 'cmsmasters-content-composer'),
			'gallery_field_gallery_padding_descr_note' =>		__('number, in pixels, no gap if empty', 'cmsmasters-content-composer'),
			'gallery_field_hoversl_activesl_title' =>			__('Active Slide', 'cmsmasters-content-composer'),
			'gallery_field_hoversl_activesl_descr_note' =>		__('if empty - 1 (number)', 'cmsmasters-content-composer'),
			'gallery_field_sl_animeffect_title' =>				__('Animation Effect', 'cmsmasters-content-composer'),
			'gallery_field_sl_animeffect_choice_slide' =>		__('Slide', 'cmsmasters-content-composer'),
			'gallery_field_sl_animeffect_choice_fade' =>		__('Fade', 'cmsmasters-content-composer'),
			'gallery_field_sl_slideshow_descr' =>				__('Animate slider automatically', 'cmsmasters-content-composer'),
			'gallery_field_sl_slideshow_speed_title' =>			__('Slideshow Speed', 'cmsmasters-content-composer'),
			'gallery_field_sl_slideshow_speed_descr' =>			__('Set time during which each slide will be shown', 'cmsmasters-content-composer'),
			'gallery_field_sl_slideshow_speed_descr_note' =>	__("if empty - '7' (in seconds)", 'cmsmasters-content-composer'),
			'gallery_field_sl_anim_speed_title' =>				__('Animation Speed', 'cmsmasters-content-composer'),
			'gallery_field_sl_anim_speed_descr' =>				__('Set animation transitions speed', 'cmsmasters-content-composer'),
			'gallery_field_sl_anim_speed_descr_note' =>			__("if empty - '600' (in milliseconds, 1 second = 1000 milliseconds)", 'cmsmasters-content-composer'),
			'gallery_field_sl_rewind_title' =>					__('Rewind', 'cmsmasters-content-composer'),
			'gallery_field_sl_rewind_descr' =>					__('Slide to first when you click next on last slide', 'cmsmasters-content-composer'),
			'gallery_field_sl_rewind_speed_title' =>			__('Rewind speed', 'cmsmasters-content-composer'),
			'gallery_field_sl_rewind_speed_descr' =>			__('Speed of sliding to the first slide', 'cmsmasters-content-composer'),
			'gallery_field_sl_rewind_speed_descr_note' =>		__("if empty - '1000' (in milliseconds, 1 second = 1000 milliseconds)", 'cmsmasters-content-composer'),
			'gallery_field_sl_navcontrol_title' =>				__('Navigation Control', 'cmsmasters-content-composer'),
			'gallery_field_sl_arrownav_title' =>				__('Arrow Navigation', 'cmsmasters-content-composer'),
			'gallery_field_sl_arrownav_descr' =>				__('Slider arrow navigation', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_columns_title' =>			__('Gallery Columns Amount', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_columns_choice_four' =>	__('4 Columns', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_columns_choice_three' =>	__('3 Columns', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_columns_choice_two' =>		__('2 Columns', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_columns_choice_one' =>		__('1 Column', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_imglinks_title' =>			__('Images Links Settings', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_imglinks_choice_box' =>	__('Open images in lightbox', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_imglinks_choice_self' =>	__('Open images in current browser tab/window', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_imglinks_choice_blank' =>	__('Open images in a new browser tab/window', 'cmsmasters-content-composer'),
			'gallery_field_imagegall_imglinks_choice_none' =>	__('Disable links on images', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_gallery Translations */
		
		/* Start cmsmasters_google_map_markers Translations */
		
			'map_markers_title' =>								__('Google Map', 'cmsmasters-content-composer'),
			'map_markers_field_markers_title' =>				__('Markers', 'cmsmasters-content-composer'),
			'map_markers_field_markers_descr' =>				__('Here you can add, edit, remove or sort Google map markers', 'cmsmasters-content-composer'),
			'map_markers_field_address_type_title' =>			__('Address Type', 'cmsmasters-content-composer'),
			'map_markers_field_address_type_choice_address' =>	__('address', 'cmsmasters-content-composer'),
			'map_markers_field_address_type_choice_coord' =>	__('coordinates', 'cmsmasters-content-composer'),
			'map_markers_field_address_title' =>				__('Address', 'cmsmasters-content-composer'),
			'map_markers_field_address_descr' =>				__('Enter address to centre your map at', 'cmsmasters-content-composer'),
			'map_markers_field_latitude_title' =>				__('Latitude', 'cmsmasters-content-composer'),
			'map_markers_field_longitude_title' =>				__('Longitude', 'cmsmasters-content-composer'),
			'map_markers_field_type_title' =>					__('Map Type', 'cmsmasters-content-composer'),
			'map_markers_field_type_choice_roadmap' =>			__('Roadmap', 'cmsmasters-content-composer'),
			'map_markers_field_type_choice_terrain' =>			__('Terrain', 'cmsmasters-content-composer'),
			'map_markers_field_type_choice_hybrid' =>			__('Hybrid', 'cmsmasters-content-composer'),
			'map_markers_field_type_choice_sattelite' =>		__('Satellite', 'cmsmasters-content-composer'),
			'map_markers_field_zoom_title' =>					__('Map Zoom', 'cmsmasters-content-composer'),
			'map_markers_field_height_type_title' =>			__('Map Height Type', 'cmsmasters-content-composer'),
			'map_markers_field_height_type_choice_auto' =>		__('Auto', 'cmsmasters-content-composer'),
			'map_markers_field_height_type_choice_fixed' =>		__('Fixed', 'cmsmasters-content-composer'),
			'map_markers_field_height_descr' =>					__('Set map fixed height', 'cmsmasters-content-composer'),
			'map_markers_field_height_descr_note' =>			__('(if empty - 300)', 'cmsmasters-content-composer'),
			'map_markers_field_scrollwheel_title' =>			__('Scrollwheel Zoom', 'cmsmasters-content-composer'),
			'map_markers_field_doubleclick_zoom_title' =>		__('Double Click Zoom', 'cmsmasters-content-composer'),
			'map_markers_field_pan_control_title' =>			__('Pan Control', 'cmsmasters-content-composer'),
			'map_markers_field_zoom_control_title' =>			__('Zoom Control', 'cmsmasters-content-composer'),
			'map_markers_field_maptype_control_title' =>		__('Map Type Control', 'cmsmasters-content-composer'),
			'map_markers_field_scale_control_title' =>			__('Scale Control', 'cmsmasters-content-composer'),
			'map_markers_field_strtview_control_title' =>		__('Street View Control', 'cmsmasters-content-composer'),
			'map_markers_field_strtview_control_descr_note' =>	__('This control is part of the default UI, and should be set to false when displaying a map type on which the Street View road overlay should not appear (e.g. a non-Earth map type)', 'cmsmasters-content-composer'),
			'map_markers_field_overview_map_control_title' =>	__('Overview Map Control', 'cmsmasters-content-composer'),
						
		/* Finish cmsmasters_google_map_markers Translations */
		
		/* Start cmsmasters_simple_icon and cmsmasters_icon_box Translations */
		
			'icon_title' =>										__('Icon Box', 'cmsmasters-content-composer'),
			'icon_field_box_title_title' =>						__('Box Title', 'cmsmasters-content-composer'),
			'icon_field_box_title_descr' =>						__('Enter box title here', 'cmsmasters-content-composer'),
			'icon_field_box_title_def' =>						__('Enter box title', 'cmsmasters-content-composer'),
			'icon_field_box_icon_pos_title' =>					__('Box Type', 'cmsmasters-content-composer'),
			'icon_box_choice_pos_top' =>						__('Centered box with icon above the title', 'cmsmasters-content-composer'),
			'icon_box_choice_pos_box_top' =>					__('Centered box with icon on the top', 'cmsmasters-content-composer'),
			'icon_box_choice_pos_heading_left' =>				__('Box with icon before title', 'cmsmasters-content-composer'),
			'icon_box_choice_pos_box_left' =>					__('Box with icon on the left', 'cmsmasters-content-composer'),
			'icon_box_choice_pos_box_left_top' =>				__('Box with icon on the left top', 'cmsmasters-content-composer'),
			'icon_box_field_icon_image_title' =>				__('Box Icon Image', 'cmsmasters-content-composer'),
			'icon_box_field_icon_space_descr_note' =>			__("number, in pixels (if empty - '50')", 'cmsmasters-content-composer'),
			'icon_field_box_icon_color_title' =>				__('Box Icon Custom Color', 'cmsmasters-content-composer'),
			'icon_field_box_icon_bg_color_title' =>				__('Box Icon Custom Background Color', 'cmsmasters-content-composer'),
			'icon_field_box_icon_bd_color_title' =>				__('Box Icon Custom Border Color', 'cmsmasters-content-composer'),
			'icon_field_box_color_title' =>						__('Box Custom Color', 'cmsmasters-content-composer'),
			'icon_field_box_bg_color_title' =>					__('Box Custom Background Color', 'cmsmasters-content-composer'),
			'icon_field_box_bd_color_title' =>					__('Box Custom Border Color', 'cmsmasters-content-composer'),
			'icon_box_field_icon_border_width_title' =>			__('Box Icon Border Width', 'cmsmasters-content-composer'),
			'icon_box_field_icon_border_radius_title' =>		__('Box Icon Border Radius', 'cmsmasters-content-composer'),
			'icon_box_field_icon_border_radius_descr' =>		__('Enter box icon border radius', 'cmsmasters-content-composer'),
			'icon_box_field_border_width_title' =>				__('Box Border Width', 'cmsmasters-content-composer'),
			'icon_box_field_border_radius_title' =>				__('Box Border Radius', 'cmsmasters-content-composer'),
			'icon_box_field_border_radius_descr' =>				__('Enter box border radius', 'cmsmasters-content-composer'),
			'icon_field_box_icon_title' =>						__('Box Icon', 'cmsmasters-content-composer'),
			'icon_box_field_icon_number_title' => 				__('Box Icon Number', 'cmsmasters-content-composer'),
			'icon_field_button_label_title' =>					__('Button Label', 'cmsmasters-content-composer'),
			'icon_field_button_label_descr' =>					__('Enter button label here', 'cmsmasters-content-composer'),			
			'icon_field_button_link_title' =>					__('Button Link', 'cmsmasters-content-composer'),
			'icon_field_button_link_descr' =>					__('Enter button link here', 'cmsmasters-content-composer'),
			'icon_field_button_target_title' =>					__('Button Target', 'cmsmasters-content-composer'),
			'icon_field_button_target_descr' =>					__('Choose button link target type', 'cmsmasters-content-composer'),
			'icon_field_icon_descr' =>							__('Choose icon for your shortcode', 'cmsmasters-content-composer'),
			'icon_field_size_descr' =>							__('Choose custom size for your icon', 'cmsmasters-content-composer'),
			'icon_field_size_descr_note' =>						__("number, in pixels ('40' - if empty)", 'cmsmasters-content-composer'),
			'icon_field_space_descr_note' =>					__("number, in pixels (if empty - '60')", 'cmsmasters-content-composer'),
			'icon_field_display_title' =>						__('Display', 'cmsmasters-content-composer'),
			'icon_field_display_descr' =>						__('Choose display type for your icon', 'cmsmasters-content-composer'),
			'icon_field_text_align_title' =>					__('Icon Position', 'cmsmasters-content-composer'),
			'icon_field_text_align_descr' =>					__('Choose horizontal position for your icon', 'cmsmasters-content-composer'),
			'icon_field_border_width_title' =>					__('Icon Spacer Border Width', 'cmsmasters-content-composer'),
			'icon_field_padding_title' =>						__('Icon Paddings', 'cmsmasters-content-composer'),
			'icon_field_padding_descr' =>						__('Enter full paddings CSS rule for icon', 'cmsmasters-content-composer'),
			'icon_field_padding_descr_note' =>					__('if empty theme default paddings will be used', 'cmsmasters-content-composer'),
			'icon_field_padding_descr_note_1' =>				__('For creating correct rule please use', 'cmsmasters-content-composer'),
			'icon_field_padding_descr_note_2' =>				__('this link', 'cmsmasters-content-composer'),
			'icon_field_border_radius_title' =>					__('Icon Spacer Border Radius', 'cmsmasters-content-composer'),
			'icon_field_border_radius_descr' =>					__('Enter icon spacer border radius', 'cmsmasters-content-composer'),
			'icon_field_title' =>								__('Icon Title', 'cmsmasters-content-composer'),
			'icon_field_descr' =>								__('Enter icon title here', 'cmsmasters-content-composer'),
			'icon_field_link_title' =>							__('Icon Link', 'cmsmasters-content-composer'),
			'icon_field_link_descr' =>							__('Enter icon link here', 'cmsmasters-content-composer'),
			'icon_field_target_title' =>						__('Icon Link Target', 'cmsmasters-content-composer'),
			'icon_field_target_descr' =>						__('Choose icon link target type', 'cmsmasters-content-composer'),
			'icon_field_color_title' =>							__('Icon Color', 'cmsmasters-content-composer'),
			'icon_field_bg_color_title' =>						__('Icon Spacer Background Color', 'cmsmasters-content-composer'),
			'icon_field_bd_color_title' =>						__('Icon Spacer Border Color', 'cmsmasters-content-composer'),
			'icon_field_color_h_title' =>						__('Icon Color on Hover', 'cmsmasters-content-composer'),
			'icon_field_bg_color_h_title' =>					__('Icon Spacer Background Color on Hover', 'cmsmasters-content-composer'),
			'icon_field_bd_color_h_title' =>					__('Icon Spacer Border Color on Hover', 'cmsmasters-content-composer'),
		
		/* Finish cmsmasters_simple_icon and cmsmasters_icon_box Translations */		
		
		/* Start cmsmasters_icon_list_items Translations */
		
			'icon_list_title' =>								__('Icon List', 'cmsmasters-content-composer'),
			'icon_list_field_icon_list_descr' =>				__('Here you can add, edit, remove or sort your icon list', 'cmsmasters-content-composer'),
			'icon_list_field_list_type_title' =>				__('List Type', 'cmsmasters-content-composer'),
			'icon_list_field_list_type_descr' =>				__('Choose icon list type', 'cmsmasters-content-composer'),
			'icon_list_field_list_type_choice_block' =>			__('Icon blocks with content', 'cmsmasters-content-composer'),
			'icon_list_field_list_type_choice_list' =>			__('Just list with icons', 'cmsmasters-content-composer'),
			'icon_list_field_icon_type_title' =>				__('Icon Type', 'cmsmasters-content-composer'),
			'icon_list_field_icon_type_descr' =>				__('Choose icon type', 'cmsmasters-content-composer'),
			'icon_list_field_items_color_title' =>				__('List Items Color Type', 'cmsmasters-content-composer'),
			'icon_list_field_items_color_descr' =>				__('Choose list items color type.', 'cmsmasters-content-composer'),
			'icon_list_field_items_color_choice_border' =>		__('Apply a custom color as the color of icon border', 'cmsmasters-content-composer'),
			'icon_list_field_items_color_choice_bg' =>			__('Apply a custom color as the color of icon background', 'cmsmasters-content-composer'),
			'icon_list_field_items_color_choice_icon' =>		__('Apply a custom color as the color of icon', 'cmsmasters-content-composer'),
			'icon_list_field_border_width_title' =>				__('Border Width', 'cmsmasters-content-composer'),
			'icon_list_field_border_width_descr' =>				__('Enter icon border width.', 'cmsmasters-content-composer'),
			'icon_list_field_border_radius_title' =>			__('Border Radius', 'cmsmasters-content-composer'),
			'icon_list_field_border_radius_descr' =>			__('Enter icon border radius', 'cmsmasters-content-composer'),
			'icon_list_field_items_unifier_title' =>			__('List Items Unifier Width', 'cmsmasters-content-composer'),
			'icon_list_field_items_unifier_descr' =>			__('Enter list items unifier width.', 'cmsmasters-content-composer'),
			'icon_list_field_icon_position_title' =>			__('Icon Position', 'cmsmasters-content-composer'),
			'icon_list_field_icon_position_descr' =>			__('Choose icon position.', 'cmsmasters-content-composer'),
			'icon_list_field_icon_position_descr_note' =>		__('This option works only for icon blocks.', 'cmsmasters-content-composer'),
			'icon_list_field_icon_size_title' =>				__('Icon / Number Size', 'cmsmasters-content-composer'),
			'icon_list_field_icon_space_title' =>				__('Icon Space', 'cmsmasters-content-composer'),
			'icon_list_field_icon_space_descr' =>				__('Enter icon space size.', 'cmsmasters-content-composer'),
			'icon_list_field_icon_space_descr_note' =>			__("number, in pixels (if empty - '100')", 'cmsmasters-content-composer'),
			'icon_list_field_item_height_title' =>				__('List Item Height', 'cmsmasters-content-composer'),
			'icon_list_field_item_height_descr' =>				__('Enter list item line height.', 'cmsmasters-content-composer'),
			'icon_list_field_item_height_descr_note' =>			__("number, in pixels (if empty - default line height)", 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_icon_list_items Translations */
		
		
		
		/* Start cmsmasters_image Translations */	
			
			'image_title' =>									__('Image', 'cmsmasters-content-composer'),
			'image_field_image_align_title' =>					__('Image Alignment', 'cmsmasters-content-composer'),
			'image_field_image_align_choice_none' =>			__('No special alignment', 'cmsmasters-content-composer'),
			'image_field_caption_title' =>						__('Image Caption Text', 'cmsmasters-content-composer'),
			'image_field_caption_descr_note' =>					__('No caption if empty', 'cmsmasters-content-composer'),
			'image_field_image_link_title' =>					__('Image Link', 'cmsmasters-content-composer'),
			'image_field_image_link_descr_note' =>				__('No link if empty', 'cmsmasters-content-composer'),
			'image_field_link_target_descr' =>					__('Open link in a new tab/window?', 'cmsmasters-content-composer'),
			'image_field_link_lightbox_title' =>				__('Lightbox', 'cmsmasters-content-composer'),
			'image_field_link_lightbox_descr' =>				__('Open image link in a lightbox?', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_image Translations */	
		
		
		/* Start cmsmasters_notice Translations */	

			'notice_title' =>									__('Notice', 'cmsmasters-content-composer'),
			'notice_field_content_title' =>						__('Notice Text', 'cmsmasters-content-composer'),
			'notice_field_notice_type_title' =>					__('Notice Type', 'cmsmasters-content-composer'),
			'notice_field_notice_type_choice_success' =>		__('Success', 'cmsmasters-content-composer'),
			'notice_field_notice_type_choice_error' =>			__('Error', 'cmsmasters-content-composer'),
			'notice_field_notice_type_choice_info' =>			__('Info', 'cmsmasters-content-composer'),
			'notice_field_notice_type_choice_warning' =>		__('Warning', 'cmsmasters-content-composer'),
			'notice_field_notice_type_choice_download' =>		__('Download', 'cmsmasters-content-composer'),
			'notice_field_notice_type_choice_custom' =>			__('Custom', 'cmsmasters-content-composer'),
			'notice_field_bg_color_descr' =>					__('Set custom background color', 'cmsmasters-content-composer'),
			'notice_field_border_color_title' =>				__('Border Color', 'cmsmasters-content-composer'),
			'notice_field_border_color_descr' =>				__('Set custom border color', 'cmsmasters-content-composer'),
			'notice_field_txt_color_title' =>					__('Text Color', 'cmsmasters-content-composer'),
			'notice_field_txt_color_descr' =>					__('Set custom text color', 'cmsmasters-content-composer'),
			'notice_field_close_button_title' =>				__('Notice Close Button', 'cmsmasters-content-composer'),
			'notice_field_notice_icon_title' =>					__('Notice Icon', 'cmsmasters-content-composer'),
						
		/* Finish cmsmasters_notice Translations */	
		
		
		/* Start cmsmasters_portfolio Translations */	
		
			'portfolio_title' =>								__('Portfolio', 'cmsmasters-content-composer'),			
			'portfolio_field_orderby_descr' =>					__('Choose your portfolio projects order by parameter', 'cmsmasters-content-composer'),			
			'portfolio_field_pj_number_title' =>				__('Projects Number', 'cmsmasters-content-composer'),
			'portfolio_field_pj_number_descr' =>				__('Enter the number of projects for showing per page', 'cmsmasters-content-composer'),
			'portfolio_field_pj_number_descr_note' =>			__('number, if empty - show all projects', 'cmsmasters-content-composer'),			
			'portfolio_field_categories_descr' =>				__('Show projects associated with certain categories.', 'cmsmasters-content-composer'),
			'portfolio_field_categories_descr_note' =>			__("If you don't choose any project categories, all your projects will be shown", 'cmsmasters-content-composer'),			
			'portfolio_field_layout_descr' =>					__('Choose layout type for your portfolio projects', 'cmsmasters-content-composer'),
			'portfolio_field_layout_choice_grid' =>				__('Projects Grid', 'cmsmasters-content-composer'),
			'portfolio_field_layout_choice_puzzle' =>			__('Masonry Puzzle', 'cmsmasters-content-composer'),
			'portfolio_field_layout_mode_descr' =>				__('Choose grid layout mode for your portfolio projects', 'cmsmasters-content-composer'),
			'portfolio_field_layout_mode_choice_perfect' =>		__('Perfect grid', 'cmsmasters-content-composer'),
			'portfolio_field_layout_mode_choice_masonry' =>		__('Masonry grid', 'cmsmasters-content-composer'),			
			'portfolio_field_col_count_descr' =>				__('Choose number of projects per row', 'cmsmasters-content-composer'),
			'portfolio_field_col_count_descr_note' =>			__('4 and 5 columns will be shown for pages with a fullwidth layout only. For pages with a sidebar enabled, maximum columns amount is 3.', 'cmsmasters-content-composer'),
			'portfolio_field_col_count_descr_note_custom' =>	__('And 5 columns will be shown only if custom content width is set and when content area width is 1350px or more.', 'cmsmasters-content-composer'),
			'portfolio_field_metadata_descr' =>					__('Choose portfolio projects metadata that you want to show', 'cmsmasters-content-composer'),
			'portfolio_field_gap_title' =>						__('Gap', 'cmsmasters-content-composer'),
			'portfolio_field_gap_descr' =>						__('Choose the gap between portfolio projects', 'cmsmasters-content-composer'),
			'portfolio_field_gap_choice_large' =>				__('Large gap', 'cmsmasters-content-composer'),
			'portfolio_field_gap_choice_small' =>				__('1 Pixel gap', 'cmsmasters-content-composer'),
			'portfolio_field_gap_choice_zero' =>				__('No gap', 'cmsmasters-content-composer'),
			'portfolio_field_filter_descr' =>					__('If checked, enable portfolio projects category filter', 'cmsmasters-content-composer'),
			'portfolio_field_sorting_title' =>					__('Sorting', 'cmsmasters-content-composer'),
			'portfolio_field_sorting_descr' =>					__('If checked, enable portfolio projects date & name sorting', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_portfolio Translations */
		
		
		/* Start cmsmasters_posts_slider Translations */
		
			'posts_slider_title' =>								__('Posts Slider', 'cmsmasters-content-composer'),			
			'posts_slider_field_orderby_descr' =>				__('Order posts by one of the given parameters', 'cmsmasters-content-composer'),
			'posts_slider_field_poststype_title' =>				__('Choose Posts Type', 'cmsmasters-content-composer'),
			'posts_slider_field_poststype_choice_post' =>		__('Blog posts', 'cmsmasters-content-composer'),
			'posts_slider_field_poststype_choice_project' =>	__('Portfolio projects', 'cmsmasters-content-composer'),
			'posts_slider_field_postscateg_title' =>			__('Posts Categories', 'cmsmasters-content-composer'),
			'posts_slider_field_postscateg_descr' =>			__('Show blog posts associated with certain categories.', 'cmsmasters-content-composer'),
			'posts_slider_field_postscateg_descr_note' =>		__("If you don't choose any post categories, all your posts will be shown", 'cmsmasters-content-composer'),
			'posts_slider_field_pjcateg_title' =>				__('Projects Categories', 'cmsmasters-content-composer'),
			'posts_slider_field_pjcateg_descr' =>				__('Show projects associated with certain categories.', 'cmsmasters-content-composer'),
			'posts_slider_field_pjcateg_descr_note' =>			__("If you don't choose any project categories, all your projects will be shown", 'cmsmasters-content-composer'),			
			'posts_slider_field_col_count_descr' =>				__('Choose number of posts per row', 'cmsmasters-content-composer'),
			'posts_slider_field_postsamount_title' =>			__('Posts Amount', 'cmsmasters-content-composer'),
			'posts_slider_field_postsamount_descr' =>			__('Amount of posts to be shown at once', 'cmsmasters-content-composer'),
			'posts_slider_field_postsamount_descr_note' =>		__('number, if empty - one post will be shown', 'cmsmasters-content-composer'),
			'posts_slider_field_postsnumber_title' =>			__('Posts Number per Page', 'cmsmasters-content-composer'),
			'posts_slider_field_postsnumber_descr_note' =>		__('number, if empty - show all posts', 'cmsmasters-content-composer'),
			
			'posts_slider_field_pausetime_descr' =>				__('Enter your posts slider pause time', 'cmsmasters-content-composer'),
			
			'posts_slider_field_postsmeta_title' =>				__('Posts Metadata', 'cmsmasters-content-composer'),
			'posts_slider_field_postsmeta_descr' =>				__('Choose blog posts metadata you want to be shown', 'cmsmasters-content-composer'),
			'posts_slider_field_pjmeta_title' =>				__('Projects Metadata', 'cmsmasters-content-composer'),
			'posts_slider_field_pjmeta_descr' =>				__('Choose portfolio projects metadata you want to be shown', 'cmsmasters-content-composer'),
		
		/* Finish cmsmasters_posts_slider Translations */
		
		
		/* Start cmsmasters_pricing_table_items Translations */
		
			'pricing_title' =>									__('Pricing Table', 'cmsmasters-content-composer'),
			'pricing_field_offers_title' =>						__('Offers', 'cmsmasters-content-composer'),
			'pricing_field_offers_descr' =>						__('Here you can add, edit, remove or sort pricing table offers', 'cmsmasters-content-composer'),			
			'pricing_field_col_count_descr' =>					__('Choose number of pricing table offers per row', 'cmsmasters-content-composer'),
			
			
		/* Finish cmsmasters_pricing_table_items Translations */
		
		/* Start cmsmasters_profiles Translations */
		
			'profiles_title' =>									__('Profiles', 'cmsmasters-content-composer'),
			'profiles_field_orderby_descr' =>					__('Choose your profiles order by parameter', 'cmsmasters-content-composer'),
			'profiles_field_profiles_number_title' =>			__('Profiles Number per Page', 'cmsmasters-content-composer'),
			'profiles_field_profiles_number_descr_note' =>		__('number, if empty - show all profiles', 'cmsmasters-content-composer'),
			'profiles_field_categories_descr' =>				__('Show profiles associated with certain categories', 'cmsmasters-content-composer'),
			'profiles_field_categories_descr_note' =>			__("If you don't choose any profile categories, all your profiles will be shown", 'cmsmasters-content-composer'),
			'profiles_field_col_count_descr' =>					__('Choose number of profiles per row', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_profiles Translations */
		
		/* Start cmsmasters_stats & cmsmasters_counters Translations */
		
			'prog_bars_title' =>								__('Progress Bars', 'cmsmasters-content-composer'),
			'prog_bars_field_prog_bars_descr' =>				__('Here you can add, edit, remove or sort progress bars', 'cmsmasters-content-composer'),
			'prog_bars_field_mode_descr' =>						__('Choose mode of your progress bars', 'cmsmasters-content-composer'),
			'prog_bars_field_mode_choice_bars' =>				__('Bars', 'cmsmasters-content-composer'),
			'prog_bars_field_mode_choice_circles' =>			__('Circles', 'cmsmasters-content-composer'),
			'prog_bars_field_type_title' => 					__('Progress Bars Type', 'cmsmasters-content-composer'),
			'prog_bars_field_number_per_row_title' =>			__('Number per Row', 'cmsmasters-content-composer'),
			'prog_bars_field_number_per_row_descr_note' =>		__('This option not work for progress bars with mode bars and type horizontal', 'cmsmasters-content-composer'),
			'counters_title' =>									__('Counters', 'cmsmasters-content-composer'),
			'counters_field_counters_descr' =>					__('Here you can add, edit, remove or sort counters', 'cmsmasters-content-composer'),
			'counters_field_type_title' =>						__('Counters Type', 'cmsmasters-content-composer'),
			'counters_field_number_per_row_title' =>			__('Number per Row', 'cmsmasters-content-composer'),
			'counters_field_number_per_row_descr' =>			__('Choose number of counters per row.', 'cmsmasters-content-composer'),
						
		/* Finish cmsmasters_stats Translations */
		
		
		/* Start cmsmasters_quotes Translations */
		
			'quotes_title' =>									__('Quotes', 'cmsmasters-content-composer'),
			'quotes_field_quotes_descr' =>						__('Here you can add, edit, remove or sort quotes', 'cmsmasters-content-composer'),
			'quotes_field_mode_descr' =>						__('Choose your quotes visibility mode', 'cmsmasters-content-composer'),
			'quotes_field_mode_choice_grid' =>					__('Grid mode', 'cmsmasters-content-composer'),
			'quotes_field_mode_choice_slider' =>				__('Slider mode', 'cmsmasters-content-composer'),			
			'quotes_field_col_count_descr' =>					__('Choose number of quotes per row', 'cmsmasters-content-composer'),
			
			'quotes_field_slideshow_speed_descr' =>				__('Time before next quote will appear', 'cmsmasters-content-composer'),
			'quotes_field_slideshow_speed_descr_note' =>		__("if '0' - autoslide disabled", 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_quotes Translations */
		
		
		/* Start cmsmasters_sidebar Translations */
			'sidebar_title' =>									__('Sidebar', 'cmsmasters-content-composer'),
			'sidebar_field_sidebar_descr' =>					__('Choose one of already existing sidebars here', 'cmsmasters-content-composer'),
			'sidebar_field_sidebar_descr_note' =>				__('or, you can create your own sidebar', 'cmsmasters-content-composer'),
			'sidebar_field_sidebar_descr_note_link' =>			__('here', 'cmsmasters-content-composer'),
			'sidebar_field_sidebar_layout_title' =>				__('Sidebar Layout', 'cmsmasters-content-composer'),
			'sidebar_field_sidebar_layout_descr_note' =>		__('we recommend to use this option for horizontal sidebars', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_sidebar Translations */
		
		
		/* Start cmsmasters_slider Translations */
		
			'slider_title' =>									__('Slider', 'cmsmasters-content-composer'),
			'slider_layer' =>									__('Layer Slider', 'cmsmasters-content-composer'),
			'slider_rev' =>										__('Revolution Slider', 'cmsmasters-content-composer'),
			'slider_field_plugin_title' =>						__('Slider Plugin', 'cmsmasters-content-composer'),
			'slider_field_plugin_descr' =>						__('Choose one of supported slider plugins', 'cmsmasters-content-composer'),
			'slider_field_plugin_descr_note' =>					__('Please make sure that the Slider plugin you have chosen is currently installed and activated.', 'cmsmasters-content-composer'),
			'slider_field_layer_id_title' =>					__('Layer Slider Name', 'cmsmasters-content-composer'),
			'slider_field_layer_id_descr' =>					__('Choose your slider name from Layer Slider plugin', 'cmsmasters-content-composer'),
			'slider_field_rev_id_title' =>						__('Revolution Slider Name', 'cmsmasters-content-composer'),
			'slider_field_rev_id_descr' =>						__('Choose your slider name from Revolution Slider plugin', 'cmsmasters-content-composer'),
		
		/* Finish cmsmasters_slider Translations */
		
		
		/* Start cmsmasters_social Translations */
		
			'social_sharing_title' =>							__('Social Sharing', 'cmsmasters-content-composer'),
			'social_sharing_field_fb_button_title' =>			__('Facebook Like Button', 'cmsmasters-content-composer'),
			'social_sharing_field_twitter_button_title' =>		__('Twitter Tweet Button', 'cmsmasters-content-composer'),
			'social_sharing_field_pinterest_button_title' =>	__('Pinterest Pin It Button', 'cmsmasters-content-composer'),
			'social_sharing_field_buttons_type_title' =>		__('Buttons Type', 'cmsmasters-content-composer'),
					
		/* Finish cmsmasters_social Translations */
		
		
		/* Start cmsmasters_table Translations */
		
			'table_title' =>									__('Table', 'cmsmasters-content-composer'),
			'table_field_table_content_title' =>				__('Table Content', 'cmsmasters-content-composer'),
			'table_field_table_content_descr' =>				__('Build your table and fill it with data', 'cmsmasters-content-composer'),
			'table_field_table_caption_title' =>				__('Table Caption', 'cmsmasters-content-composer'),
			'table_field_table_caption_descr' =>				__('Add a short caption for your table so that visitors know what this data is about', 'cmsmasters-content-composer'),
		
		/* Finish cmsmasters_table Translations */
		
		
		/* Start cmsmasters_tabs Translations */
		
			'tabs_title' =>										__('Tabs / Tour', 'cmsmasters-content-composer'),
			'tabs_field_tabs_descr' =>							__('Here you can add, edit, remove or sort tabs', 'cmsmasters-content-composer'),
			'tabs_field_mode_descr' =>							__('How should the tabs be displayed, top or side?', 'cmsmasters-content-composer'),
			'tabs_field_mode_choice_tabs' =>					__('Tabs mode', 'cmsmasters-content-composer'),
			'tabs_field_mode_choice_tour' =>					__('Tour mode', 'cmsmasters-content-composer'),
			'tabs_field_position_title' =>						__('Position', 'cmsmasters-content-composer'),
			'tabs_field_position_descr' =>						__('Choose tour tabs position', 'cmsmasters-content-composer'),
			'tabs_field_active_title' =>						__('Active Tab', 'cmsmasters-content-composer'),
			'tabs_field_active_descr' =>						__('Enter the number of the tab that should be open initially.', 'cmsmasters-content-composer'),
			'tabs_field_active_descr_note' =>					__('If empty first tab should be open on page load', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_tabs Translations */
		
		
		/* Start cmsmasters_toggles Translations */
		
			'toggles_title' =>									__('Toggles / Accordion', 'cmsmasters-content-composer'),
			'toggles_field_toggles_descr' =>					__('Here you can add, edit, remove or sort toggles', 'cmsmasters-content-composer'),
			'toggles_field_mode_descr' =>						__('Should only one toggle be active at a time or can multiple toggles be open at the same time?', 'cmsmasters-content-composer'),
			'toggles_field_mode_choice_toggles' =>				__('Toggles mode', 'cmsmasters-content-composer'),
			'toggles_field_mode_choice_accordion' =>			__('Accordion mode', 'cmsmasters-content-composer'),
			'toggles_field_active_title' =>						__('Active Toggle', 'cmsmasters-content-composer'),
			'toggles_field_active_descr' =>						__('Enter the number of the toggle that should be open initially.', 'cmsmasters-content-composer'),
			'toggles_field_active_descr_note' =>				__('If empty all toggles should be close on page load', 'cmsmasters-content-composer'),
			'toggles_field_sorting_title' =>					__('Sorting', 'cmsmasters-content-composer'),
			'toggles_field_sorting_descr' =>					__('If checked, toggles sorting will be shown', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_toggles Translations */
		
		
		/* Start cmsmasters_twitter Translations */
		
			'twitter_title' =>									__('Twitter Stripe', 'cmsmasters-content-composer'),
			'twitter_field_tweets_date_title' =>				__('Date visibility', 'cmsmasters-content-composer'),
			'twitter_field_tweets_date_descr' =>				__('Show or hide tweet date', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_twitter Translations */
		
		
		/* Start cmsmasters_videos Translations */
		
			'video_title' =>									__('Video', 'cmsmasters-content-composer'),
			'video_field_video_descr' =>						__('Here you can add, edit, remove or sort video links', 'cmsmasters-content-composer'),
			'video_field_video_descr_note' =>					__('Please add video in several formats for your shortcode to work properly in all browsers', 'cmsmasters-content-composer'),
			'video_field_poster_title' =>						__('Poster', 'cmsmasters-content-composer'),
			'video_field_poster_descr' =>						__('Defines image to show as placeholder before the media plays', 'cmsmasters-content-composer'),
			'video_field_maxwidth_title' =>						__('Max Width', 'cmsmasters-content-composer'),
			'video_field_maxwidth_descr' =>						__('Defines max width of the media', 'cmsmasters-content-composer'),
			'video_field_maxheight_title' =>					__('Max Height', 'cmsmasters-content-composer'),
			'video_field_maxheight_descr' =>					__('Defines max height of the media', 'cmsmasters-content-composer'),			
			'video_field_autoplay_descr' =>						__('If checked, video will play as soon as the video is ready', 'cmsmasters-content-composer'),
			'video_field_repeat_descr' =>						__('If checked, video will be repeated from the beginning after finishing', 'cmsmasters-content-composer'),			
			'video_field_preload_descr' =>						__('Specifies if and how the video should be loaded when the page loads', 'cmsmasters-content-composer'),
			'video_field_preload_choice_none' =>				__('None - the video should not be loaded when the page loads', 'cmsmasters-content-composer'),
			'video_field_preload_choice_auto' =>				__('Auto - the video should be loaded entirely when the page loads', 'cmsmasters-content-composer'),
			'video_field_preload_choice_metadata' =>			__('Metadata - only metadata should be loaded when the page loads', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_videos Translations */
		
		/* Start cmsmasters_html Translations */
		
			'custom_html_title' =>								__('Custom HTML', 'cmsmasters-content-composer'),
			'custom_html_field_code_title' =>					__('HTML Code', 'cmsmasters-content-composer'),
			'custom_html_field_code_descr' =>					__('Enter here your custom HTML code', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_html Translations */
		
		
		/* Start cmsmasters_css Translations */
		
			'custom_css_title' =>								__('Custom CSS', 'cmsmasters-content-composer'),
			'custom_css_field_code_title' =>					__('CSS Code', 'cmsmasters-content-composer'),
			'custom_css_field_code_descr' =>					__('Enter here your custom CSS code', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_css Translations */
		
		
		/* Start cmsmasters_js Translations */
		
			'custom_js_title' =>								__('Custom JS', 'cmsmasters-content-composer'),
			'custom_js_field_code_title' =>						__('JavaScript Code', 'cmsmasters-content-composer'),
			'custom_js_field_code_descr' =>						__('Enter here your custom JavaScript code', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_js Translations */
		
		
		/* Start cmsmasters_js Translations */
		
			'mailpoet_title' =>									__('Mail Poet Form', 'cmsmasters-content-composer'),
			'mailpoet_field_form_id_title' =>					__('Mail Poet Form', 'cmsmasters-content-composer'),
			'mailpoet_field_form_id_descr' =>					__('Choose a form to display', 'cmsmasters-content-composer'),
			'mailpoet_field_form_id_descr_note' =>				__('Theme styles will be applied only if you use a form that has following structure:', 'cmsmasters-content-composer'),
			'mailpoet_field_form_id_descr_note_1' =>			__('1. Input field.', 'cmsmasters-content-composer'),
			'mailpoet_field_form_id_descr_note_2' =>			__('2. Submit button.', 'cmsmasters-content-composer'),
			'mailpoet_field_form_id_descr_note_3' =>			__('In other cases default styles are applied.', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_js Translations */
	

	// CMSMasters Custom Multiple Fields Shortcodes Translations
	
		/* Start cmsmasters_audio Translations */
		
			'audio_link_field_audio_link_title' =>				__('Audio Link', 'cmsmasters-content-composer'),
			'audio_link_field_audio_link_descr' =>				__('Enter audio file link here', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_audio Translations */
		
		/* Start cmsmasters_client Translations */
		
			'client_title' =>									__('Client', 'cmsmasters-content-composer'),
			'client_field_name_descr' =>						__('Enter this client name', 'cmsmasters-content-composer'),
			'client_field_logo_title' =>						__('Logo', 'cmsmasters-content-composer'),
			'client_field_logo_descr' =>						__('Choose this client logo', 'cmsmasters-content-composer'),			
			'client_field_link_descr' =>						__('Enter this client website link', 'cmsmasters-content-composer'),
			'client_field_target_title' =>						__('Client Target', 'cmsmasters-content-composer'),
			'client_field_target_descr' =>						__('Enter client target here', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_client Translations */
		
		/* Start cmsmasters_google_map_marker Translations */
		
			'map_marker_title' =>								__('Google Map Marker', 'cmsmasters-content-composer'),
			'map_marker_field_address_type_title' =>			__('Address Type', 'cmsmasters-content-composer'),		
			'map_marker_field_address_type_descr' =>			__('Choose Google map marker address type', 'cmsmasters-content-composer'),
			'map_marker_field_address_descr' =>					__('Enter address to centre this map marker at', 'cmsmasters-content-composer'),
			'map_marker_field_latitude_descr' =>				__('Enter latitude to center your map marker', 'cmsmasters-content-composer'),
			'map_marker_field_longitude_descr' =>				__('Enter longitude to center your map marker', 'cmsmasters-content-composer'),
			'map_marker_field_popup_html_title' =>				__('Popup HTML', 'cmsmasters-content-composer'),
			'map_marker_field_popup_html_descr' =>				__('Enter the content for this marker information popup', 'cmsmasters-content-composer'),
			'map_marker_field_popup_visibility_title' =>		__('Popup Visibility', 'cmsmasters-content-composer'),
			'map_marker_field_popup_visibility_descr' =>		__('If checked, this marker information popup will be shown', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_google_map_marker Translations */
		
		
		/* Start cmsmasters_icon_list_item Translations */
		
			'icon_list_item_title' =>							__('List Item', 'cmsmasters-content-composer'),
			'icon_list_item_field_icon_descr' =>				__('Choose icon for this list item', 'cmsmasters-content-composer'),
			'icon_list_item_field_image_descr' =>				__('Choose image for this list item', 'cmsmasters-content-composer'),
			'icon_list_item_field_title_descr' =>				__('Enter this list item title', 'cmsmasters-content-composer'),
			'icon_list_item_field_title_link_descr' =>			__('Enter this list item title link', 'cmsmasters-content-composer'),
			'icon_list_item_field_content_descr' =>				__('Enter this list item content.', 'cmsmasters-content-composer'),
			'icon_list_item_field_content_descr_note' =>		__('This option works only for icon blocks', 'cmsmasters-content-composer'),
			'icon_list_item_field_item_color_title' =>			__('Custom List Item Color', 'cmsmasters-content-composer'),
			'icon_list_item_field_item_color_descr' =>			__('If not checked, icon list item will use parent section color scheme colors', 'cmsmasters-content-composer'),
			'icon_list_item_field_color_descr' =>				__('Choose list item icon background color.', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_icon_list_item Translations */
		
		
		/* Start cmsmasters_counter Translations */
			'counter_title' =>									__('Counter', 'cmsmasters-content-composer'),
			'counter_subtitle' =>								__('Description', 'cmsmasters-content-composer'),
			'counter_field_counter_value_title' =>				__('Counter Value', 'cmsmasters-content-composer'),
			'counter_field_counter_value_prefix_title' =>		__('Counter Value Prefix', 'cmsmasters-content-composer'),
			'counter_field_counter_value_suffix_title' =>		__('Counter Value Suffix', 'cmsmasters-content-composer'),
			'counter_field_icon_descr' =>						__('Choose icon for your counter', 'cmsmasters-content-composer'),
			'counter_field_counter_color_title' =>				__('Custom Counter Color', 'cmsmasters-content-composer'),
			'counter_field_icon_border_radius_descr' =>			__('Enter counter icon border radius', 'cmsmasters-content-composer'),
			'counter_field_icon_color_title' =>					__('Counter Icon Custom Color', 'cmsmasters-content-composer'),
			'counter_field_icon_bg_color_title' =>				__('Counter Icon Custom Background Color', 'cmsmasters-content-composer'),
			'counter_field_icon_bd_color_title' =>				__('Counter Icon Custom Border Color', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_counter Translations */
		
		
		/* Start cmsmasters_pricing_table_item Translations */
		
			'pricing_offer_title' =>							__('Pricing Table Offer', 'cmsmasters-content-composer'),
			'pricing_offer_field_title_descr' =>				__('Enter this pricing table offer title', 'cmsmasters-content-composer'),
			'pricing_offer_field_price_title' =>				__('Price', 'cmsmasters-content-composer'),
			'pricing_offer_field_price_descr' =>				__('Enter this pricing table offer price', 'cmsmasters-content-composer'),
			'pricing_offer_field_coins_title' =>				__('Coins', 'cmsmasters-content-composer'),
			'pricing_offer_field_coins_descr' =>				__('Enter this pricing table offer price coins', 'cmsmasters-content-composer'),
			'pricing_offer_field_currency_title' =>				__('Currency', 'cmsmasters-content-composer'),
			'pricing_offer_field_currency_descr' =>				__('Enter this pricing table offer currency', 'cmsmasters-content-composer'),
			'pricing_offer_field_period_title' =>				__('Period', 'cmsmasters-content-composer'),
			'pricing_offer_field_period_descr' =>				__('Enter this pricing table offer period', 'cmsmasters-content-composer'),
			'pricing_offer_field_offer_color_title' =>			__('Custom Offer Color', 'cmsmasters-content-composer'),
			'pricing_offer_field_offer_color_descr' =>			__('If not checked, pricing table offer will use parent section color scheme colors', 'cmsmasters-content-composer'),
			'pricing_offer_field_color_descr' =>				__('Choose color for this pricing table offer', 'cmsmasters-content-composer'),
			'pricing_offer_field_features_title' =>				__('Features', 'cmsmasters-content-composer'),
			'pricing_offer_field_features_descr' =>				__('Add pricing table offer features', 'cmsmasters-content-composer'),
			'pricing_offer_field_button_text_title' =>			__('Button Text', 'cmsmasters-content-composer'),
			'pricing_offer_field_button_text_descr' =>			__('Enter this pricing table offer button text', 'cmsmasters-content-composer'),
			'pricing_offer_field_button_link_title' =>			__('Button Link', 'cmsmasters-content-composer'),
			'pricing_offer_field_button_link_descr' =>			__('Enter this pricing table offer button link', 'cmsmasters-content-composer'),
			'pricing_offer_field_best_offer_title' =>			__('Best Offer', 'cmsmasters-content-composer'),
			'pricing_offer_field_best_offer_descr' =>			__('If checked, this pricing table offer will be highlighted', 'cmsmasters-content-composer'),
			'pricing_offer_field_best_offer_custom_bg_title' =>	__('Custom Best Offer Background Color', 'cmsmasters-content-composer'),
			'pricing_offer_field_best_offer_custom_bg_descr' =>	__('If not checked, pricing table best offer will use parent section color scheme colors', 'cmsmasters-content-composer'),
			'pricing_offer_field_best_offer_bg_title' =>		__('Best Offer Background Color', 'cmsmasters-content-composer'),
			'pricing_offer_field_best_offer_bg_descr' =>		__('Choose background color for this pricing table best offer', 'cmsmasters-content-composer'),
			'pricing_offer_field_best_offer_txt_title' =>		__('Best Offer Text Color', 'cmsmasters-content-composer'),
			'pricing_offer_field_best_offer_txt_descr' =>		__('Choose text color for this pricing table best offer', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_pricing_table_item Translations */
		
		/* Start cmsmasters_stat Translations */
		
			'prog_bar_title' =>									__('Progress Bar', 'cmsmasters-content-composer'),
			'prog_bar_field_title_descr' =>						__('Enter this progress bar title', 'cmsmasters-content-composer'),
			'prog_bar_subtitle' =>								__('Description', 'cmsmasters-content-composer'),
			'prog_bar_field_subtitle_descr' =>					__('Enter this progress bar description text', 'cmsmasters-content-composer'),
			'prog_bar_field_progress_title' =>					__('Progress', 'cmsmasters-content-composer'),
			'prog_bar_field_progress_descr' =>					__('Choose this bar progress (percentage)', 'cmsmasters-content-composer'),
			'prog_bar_field_icon_descr' =>						__('Choose icon for your progress bar', 'cmsmasters-content-composer'),
			'prog_bar_field_bar_color_title' =>					__('Bar Color', 'cmsmasters-content-composer'),
			'prog_bar_field_bar_color_descr' =>					__('If not selected, progress bar will use parent section color scheme color', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_stat Translations */
		
		/* Start cmsmasters_quote Translations */
		
			'quote_title' =>									__('Quote', 'cmsmasters-content-composer'),
			'quote_field_image_title' =>						__('Image', 'cmsmasters-content-composer'),
			'quote_field_image_descr' =>						__('Choose this quote author image', 'cmsmasters-content-composer'),
			'quote_field_name_descr' =>							__('Enter this team quote author name', 'cmsmasters-content-composer'),
			'quote_field_subtitle_title' =>						__('Subtitle', 'cmsmasters-content-composer'),
			'quote_field_subtitle_descr' =>						__('Enter this quote subtitle', 'cmsmasters-content-composer'),
			'quote_field_quote_title' =>						__('Quote', 'cmsmasters-content-composer'),
			'quote_field_quote_descr' =>						__('Enter this quote text', 'cmsmasters-content-composer'),
			'quote_field_link_title' =>							__('Website Link', 'cmsmasters-content-composer'),
			'quote_field_link_descr' =>							__('Enter the link of quote author website', 'cmsmasters-content-composer'),
			'quote_field_website_name_title' =>					__('Website Name', 'cmsmasters-content-composer'),
			'quote_field_website_name_descr' =>					__('Enter quote author website name', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_quote Translations */
		
		
		/* Start cmsmasters_tab Translations */
		
			'tab_title' =>										__('Tab', 'cmsmasters-content-composer'),
			'tab_field_title_descr' =>							__('Enter this tab title', 'cmsmasters-content-composer'),
			'tab_field_content_descr' =>						__('Enter this tab content', 'cmsmasters-content-composer'),
			'tab_field_tab_selector_color_title' =>				__('Custom Tab Selector Color', 'cmsmasters-content-composer'),
			'tab_field_tab_selector_color_descr' =>				__('If not checked, tab selector will use parent section color scheme colors', 'cmsmasters-content-composer'),
			'tab_field_tab_color_title' =>						__('Tab Color', 'cmsmasters-content-composer'),
			'tab_field_tab_color_descr' =>						__('Choose tab selector highlight color on mouseover', 'cmsmasters-content-composer'),
			'tab_field_icon_descr' =>							__('Choose icon for this tab', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_tab Translations */
		
		
		/* Start cmsmasters_toggle Translations */
		
			'toggle_title' =>									__('Toggle', 'cmsmasters-content-composer'),
			'toggle_field_title_descr' =>						__('Enter this toggle title', 'cmsmasters-content-composer'),
			'toggle_field_content_descr' =>						__('Enter this toggle content', 'cmsmasters-content-composer'),
			'toggle_field_toggle_tags_title' =>					__('Toggle Tags', 'cmsmasters-content-composer'),
			'toggle_field_toggle_tags_descr' =>					__('Enter additional toggle tags separated with commas.', 'cmsmasters-content-composer'),
			'toggle_field_toggle_tags_descr_note' =>			__('Only for toggles with enabled sorting.', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_toggle Translations */
		
		
		/* Start cmsmasters_video Translations */
		
			'video_link_title' =>								__('Video', 'cmsmasters-content-composer'),
			'video_link_field_video_link_title' =>				__('Video Link', 'cmsmasters-content-composer'),
			'video_link_field_video_link_descr' =>				__('Choose your video file here', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_video Translations */
		
		
	// CMSMasters Editor Shortcodes	Translations
	
		/* Start cmsmasters_dropcap Translations */
		
			'dropcap_title' =>									__('Dropcap', 'cmsmasters-content-composer'), 
			'dropcap_field_content_descr' =>					__('Enter the character/symbol for this dropcap', 'cmsmasters-content-composer'),
			'dropcap_field_type_title' =>						__('Type', 'cmsmasters-content-composer'),
			'dropcap_field_type_descr' =>						__('Choose dropcap type', 'cmsmasters-content-composer'),
			'dropcap_field_type_choice_one' =>					__('Type 1', 'cmsmasters-content-composer'),
			'dropcap_field_type_choice_two' =>					__('Type 2', 'cmsmasters-content-composer'),
			
		/* Finish cmsmasters_dropcap Translations */
		
		
		/* Start CMSMasters Item Shortcode Translations */
		
			'item_title' =>										__('Feature', 'cmsmasters-content-composer'),
			'item_field_title_descr' =>							__('Enter the title for this link', 'cmsmasters-content-composer'),			
			'item_field_link_descr' =>							__('Enter your link here', 'cmsmasters-content-composer'),
			'item_field_icon_descr' =>							__('Choose icon for this link', 'cmsmasters-content-composer'),
			
		/* Finish CMSMasters Item Shortcode Translations */
		
		
		/* Start CMSMasters Column Shortcode Translations */
		
			'column_title' =>									__('Column', 'cmsmasters-content-composer'),
			'column_field_padding_title' =>						__('Paddings', 'cmsmasters-content-composer'),
			'column_field_padding_descr' =>						__('Enter full paddings CSS rule for column', 'cmsmasters-content-composer'),
			'column_field_padding_descr_note' =>				__('if empty theme default paddings will be used', 'cmsmasters-content-composer'),
			'column_field_padding_descr_note_1' =>				__('For creating correct rule please use', 'cmsmasters-content-composer'),
			'column_field_padding_descr_note_2' =>				__('this link', 'cmsmasters-content-composer'),
			'column_field_resp_padding_title' =>				__('Set Custom Paddings for Various Screens', 'cmsmasters-content-composer'),
			'column_field_padding_large_title' =>				__('Paddings for Large Screens', 'cmsmasters-content-composer'),
			'column_field_padding_large_descr' =>				__('Enter paddings for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'column_field_padding_laptop_title' =>				__('Paddings for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'column_field_padding_laptop_descr' =>				__('Enter paddings for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'column_field_padding_tablet_title' =>				__('Paddings for Tablet Vertical View', 'cmsmasters-content-composer'),
			'column_field_padding_tablet_descr' =>				__('Enter paddings for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'column_field_padding_mobile_h_title' =>			__('Paddings for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'column_field_padding_mobile_h_descr' =>			__('Enter paddings for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'column_field_padding_mobile_v_title' =>			__('Paddings for Mobile Vertical View', 'cmsmasters-content-composer'),
			'column_field_padding_mobile_v_descr' =>			__('Enter paddings for devices with max-width 320px and below', 'cmsmasters-content-composer'),
			'column_field_bg_color_title' =>					__('Background Color', 'cmsmasters-content-composer'),
			'column_field_border_width_title' =>				__('Border Width', 'cmsmasters-content-composer'),
			'column_field_border_width_descr' =>				__('Enter border width', 'cmsmasters-content-composer'),
			'column_field_border_style_title' =>				__('Border Style', 'cmsmasters-content-composer'),
			'column_field_border_color_title' =>				__('Border Color', 'cmsmasters-content-composer'),
			'column_field_border_radius_title' =>				__('Border Radius', 'cmsmasters-content-composer'),
			'column_field_border_radius_descr' =>				__('Enter border radius (content that exceeds column area will be truncated)', 'cmsmasters-content-composer'),
			'column_field_box_shadow_title' =>					__('Box Shadow', 'cmsmasters-content-composer'),
			'column_field_box_shadow_descr' =>					__('Enter box shadow', 'cmsmasters-content-composer'),
			'column_field_animation_descr' =>					__('Column animation effect when a user scrolls to its position for the first time.', 'cmsmasters-content-composer'),
			'column_field_animation_delay_descr' =>				__('Delay before column animation starts', 'cmsmasters-content-composer'), 
			'column_field_classes_descr' =>						__('You can add additional CSS classes (separated by spaces) to the column, if you wish to style content elements differently', 'cmsmasters-content-composer'),
			'column_field_sticky' =>							__('Sticky Column', 'cmsmasters-content-composer'),
		/* Finish CMSMasters Column Shortcode Translations */
		
		
		/* Start CMSMasters Row Shortcode Translations */
		
			'row_title' =>										__('Section', 'cmsmasters-content-composer'),
			'row_button' =>										__('New Section', 'cmsmasters-content-composer'),
			'row_field_top_style_title' =>						__('Row Top Style', 'cmsmasters-content-composer'),
			'row_field_top_style_descr' =>						__('If not "default", neither "background image" nor "color overlay" should be used', 'cmsmasters-content-composer'),
			'row_field_bot_style_title' =>						__('Row Bottom Style', 'cmsmasters-content-composer'),
			'row_field_bot_style_descr' =>						__('If not "default", neither "background image" nor "color overlay" should be used', 'cmsmasters-content-composer'),
			'row_field_choice_default' =>						__('Default', 'cmsmasters-content-composer'),
			'row_field_choice_left_diagonal' =>					__('Left Diagonal', 'cmsmasters-content-composer'),
			'row_field_choice_right_diagonal' =>				__('Right Diagonal', 'cmsmasters-content-composer'),
			'row_field_choice_zigzag' =>						__('Zigzag', 'cmsmasters-content-composer'),
			'row_field_choice_triangle' =>						__('Triangle', 'cmsmasters-content-composer'),
			'row_field_color_scheme_title' =>					__('Color Scheme', 'cmsmasters-content-composer'),
			'row_field_color_scheme_descr' =>					__('Choose a color scheme to be used for section', 'cmsmasters-content-composer'),
			'row_field_custom_bg_color_title' =>				__('Custom Background Color', 'cmsmasters-content-composer'),
			'row_field_custom_bg_color_descr' =>				__('If not checked, section background color will match background color for this section color scheme', 'cmsmasters-content-composer'),
			'row_field_bg_color_descr' =>						__('Choose background color for this section', 'cmsmasters-content-composer'),
			'row_field_bg_image_title' =>						__('Background Image', 'cmsmasters-content-composer'),
			'row_field_bg_image_descr' =>						__('Choose background image for this section', 'cmsmasters-content-composer'),
			'row_field_bg_position_title' =>					__('Background Position', 'cmsmasters-content-composer'),
			'row_field_bg_position_descr' =>					__('Select background position for this section', 'cmsmasters-content-composer'),
			'row_field_bg_position_choice_vert_top' =>			__('Vertical: top', 'cmsmasters-content-composer'),
			'row_field_bg_position_choice_vert_center' =>		__('Vertical: center', 'cmsmasters-content-composer'),
			'row_field_bg_position_choice_vert_bottom' =>		__('Vertical: bottom', 'cmsmasters-content-composer'),
			'row_field_bg_position_choice_horiz_left' =>		__('Horizontal: left', 'cmsmasters-content-composer'),
			'row_field_bg_position_choice_horiz_center' =>		__('Horizontal: center', 'cmsmasters-content-composer'),
			'row_field_bg_position_choice_horiz_right' =>		__('Horizontal: right', 'cmsmasters-content-composer'),
			'row_field_bg_repeat_title' =>						__('Background Repeat', 'cmsmasters-content-composer'),
			'row_field_bg_repeat_descr' =>						__('Choose background repeat for this section', 'cmsmasters-content-composer'),
			'row_field_bg_repeat_choice_none' =>				__('No Repeat', 'cmsmasters-content-composer'),
			'row_field_bg_repeat_choice_horiz' =>				__('Repeat Horizontally', 'cmsmasters-content-composer'),
			'row_field_bg_repeat_choice_vert' =>				__('Repeat Vertically', 'cmsmasters-content-composer'),
			'row_field_bg_repeat_choice_repeat' =>				__('Repeat', 'cmsmasters-content-composer'),
			'row_field_bg_repeat_choice_round' =>				__('Round', 'cmsmasters-content-composer'),
			'row_field_bg_attachement_title' =>					__('Background Attachment', 'cmsmasters-content-composer'),
			'row_field_bg_attachement_descr' =>					__('Choose background attachment for this section', 'cmsmasters-content-composer'),
			'row_field_bg_attachement_choice_scroll' =>			__('Scroll', 'cmsmasters-content-composer'),
			'row_field_bg_attachement_choice_fixed' =>			__('Fixed', 'cmsmasters-content-composer'),
			'row_field_bg_size_title' =>						__('Background Size', 'cmsmasters-content-composer'),
			'row_field_bg_size_descr' =>						__('Choose background size for this section', 'cmsmasters-content-composer'),
			'row_field_bg_size_descr_auto' =>					__('image is added in its actual size regardless of the section dimensions', 'cmsmasters-content-composer'),
			'row_field_bg_size_descr_cover' =>					__('image is resized to cover the whole section area', 'cmsmasters-content-composer'),
			'row_field_bg_size_descr_contain' =>				__('image is resized to fit into the section area', 'cmsmasters-content-composer'),
			'row_field_bg_size_choice_auto' =>					__('Auto', 'cmsmasters-content-composer'),
			'row_field_bg_size_choice_cover' =>					__('Cover', 'cmsmasters-content-composer'),
			'row_field_bg_size_choice_contain' =>				__('Contain', 'cmsmasters-content-composer'),
			'row_field_bg_parallax_title' =>					__('Background Parallax', 'cmsmasters-content-composer'),
			'row_field_bg_parallax_descr' =>					__('If checked, background image parallax effect will be enabled', 'cmsmasters-content-composer'),
			'row_field_bg_parallax_ratio_title' =>				__('Background Parallax Ratio', 'cmsmasters-content-composer'),
			'row_field_bg_img_adaptive_title' =>				__('Disable Background Image on Resolution', 'cmsmasters-content-composer'),
			'row_field_bg_img_adaptive_divice_title' =>			__('Choose Resolution', 'cmsmasters-content-composer'),
			'choice_tablet_and_less' =>							__('Tablet (1024px and less)', 'cmsmasters-content-composer'),
			'choice_tablet_small_and_less' =>					__('Tablet Small (768px and less)', 'cmsmasters-content-composer'),
			'choice_mobile_and_less' =>							__('Mobile (540px and less)', 'cmsmasters-content-composer'),
			'choice_phone_mall_and_less' =>						__('Phone Small (320px and less)', 'cmsmasters-content-composer'),
			'row_field_bg_parallax_ratio_descr' =>				__('Background image reposition step on scroll', 'cmsmasters-content-composer'),
			'row_field_color_overlay_visibility_title' =>		__('Color Overlay Visibility', 'cmsmasters-content-composer'),
			'row_field_color_overlay_visibility_descr' =>		__('If checked, section color overlay will be shown over the section background', 'cmsmasters-content-composer'),
			'row_field_color_overlay_title' =>					__('Color Overlay', 'cmsmasters-content-composer'),
			'row_field_color_overlay_descr' =>					__('Choose color overlay for this section', 'cmsmasters-content-composer'),
			'row_field_overlay_opacity_title' =>				__('Overlay Opacity', 'cmsmasters-content-composer'),
			'row_field_overlay_opacity_descr' =>				__('Choose color overlay opacity for this section', 'cmsmasters-content-composer'),
			'row_field_overlay_opacity_descr_note' =>			__('percentage', 'cmsmasters-content-composer'),
			'row_field_top_padding_title' =>					__('Top Padding', 'cmsmasters-content-composer'),
			'row_field_top_padding_descr' =>					__('Enter section top padding', 'cmsmasters-content-composer'),
			'row_field_bottom_padding_title' =>					__('Bottom Padding', 'cmsmasters-content-composer'),
			'row_field_bottom_padding_descr' =>					__('Enter section bottom padding', 'cmsmasters-content-composer'),
			'row_field_resp_vert_pad_title' =>					__('Set Custom Padding for Various Screens', 'cmsmasters-content-composer'),
			'row_field_padding_top_large_title' =>				__('Top Padding for Large Screens', 'cmsmasters-content-composer'),
			'row_field_padding_top_large_descr' =>				__('Enter top padding for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_large_title' =>			__('Bottom Padding for Large Screens', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_large_descr' =>			__('Enter bottom padding for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'row_field_padding_top_laptop_title' =>				__('Top Padding for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'row_field_padding_top_laptop_descr' =>				__('Enter top padding for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_laptop_title' =>			__('Bottom Padding for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_laptop_descr' =>			__('Enter bottom padding for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'row_field_padding_top_tablet_title' =>				__('Top Padding for Tablet Vertical View', 'cmsmasters-content-composer'),
			'row_field_padding_top_tablet_descr' =>				__('Enter top padding for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_tablet_title' =>			__('Bottom Padding for Tablet Vertical View', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_tablet_descr' =>			__('Enter bottom padding for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'row_field_padding_top_mobile_h_title' =>			__('Top Padding for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'row_field_padding_top_mobile_h_descr' =>			__('Enter top padding for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_mobile_h_title' =>		__('Bottom Padding for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_mobile_h_descr' =>		__('Enter bottom padding for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'row_field_padding_top_mobile_v_title' =>			__('Top Padding for Mobile Vertical View', 'cmsmasters-content-composer'),
			'row_field_padding_top_mobile_v_descr' =>			__('Enter top padding for devices with max-width 320px and below', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_mobile_v_title' =>		__('Bottom Padding for Mobile Vertical View', 'cmsmasters-content-composer'),
			'row_field_padding_bottom_mobile_v_descr' =>		__('Enter bottom padding for devices with max-width 320px and below', 'cmsmasters-content-composer'),
			'row_field_content_width_title' =>					__('Content Width', 'cmsmasters-content-composer'),
			'row_field_content_width_descr' =>					__('Choose content width type for this section', 'cmsmasters-content-composer'),
			'row_field_content_width_choice_boxed' =>			__('Boxed', 'cmsmasters-content-composer'),
			'row_field_content_width_choice_custom' =>			__('Custom', 'cmsmasters-content-composer'),
			'row_field_left_custom_padding_title' =>			__('Left Custom Padding', 'cmsmasters-content-composer'),
			'row_field_left_custom_padding_descr' =>			__('Enter section left padding', 'cmsmasters-content-composer'),
			'size_note_percentage' =>							__('number, percentage (default value if empty)', 'cmsmasters-content-composer'),
			'row_field_right_custom_padding_title' =>			__('Right Custom Padding', 'cmsmasters-content-composer'),
			'row_field_right_custom_padding_descr' =>			__('Enter section right padding', 'cmsmasters-content-composer'),
			'row_field_no_margin_title' =>						__('No Margin', 'cmsmasters-content-composer'),
			'row_field_no_margin_descr' =>						__('Disable margins for this section (use this to stick sections together seamlessly)', 'cmsmasters-content-composer'),
			'row_field_merge_title' =>							__('Merge with the Next Section', 'cmsmasters-content-composer'), 
			'row_field_merge_descr' =>							__('If enabled, values for all the settings that are located below, will be imported from the following section. In this case there is NO NEED to apply settings for this section, they will not take effect.', 'cmsmasters-content-composer'),
			'row_field_merge_descr_note' =>						__('Please make sure to enable this ONLY if both are true: <br />1. Another section is present below current section. <br />2. This option is disabled for the section below.', 'cmsmasters-content-composer'), 
			'row_field_columns_behavior_title' =>				__('Columns Custom Height Behavior', 'cmsmasters-content-composer'),
			'row_field_columns_behavior_descr' =>				__('All columns in this section will have equal height.', 'cmsmasters-content-composer'),
			'row_field_columns_behavior_descr_note' =>			__('Each column should contain only one shortcode in this case.', 'cmsmasters-content-composer'),
			'row_field_section_id_title' =>						__('Section ID', 'cmsmasters-content-composer'),
			'row_field_section_id_descr' =>						__("Apply a custom 'id' attribute to the section, so that you could apply a unique style via CSS. This option is also helpful if you want to use anchor links (build one-page navigation) to scroll to this section when a link is clicked.", 'cmsmasters-content-composer'),
			'row_field_section_id_descr_note' =>				__("Use this option with caution and make sure: <br />1. That you use only allowed characters (a-z). No special characters can be used. <br />2. Please don't use the following id values: page, main, header, middle, bottom, footer.", 'cmsmasters-content-composer'),
			'row_field_classes_descr' =>						__('You can add additional CSS classes (separated by spaces) to the section, if you wish to style content elements differently', 'cmsmasters-content-composer'),
			'row_field_vert_margin_title' =>					__('Set Custom Margin', 'cmsmasters-content-composer'),
			'row_field_top_margin_title' =>						__('Top Margin', 'cmsmasters-content-composer'),
			'row_field_top_margin_descr' =>						__('Enter section top margin', 'cmsmasters-content-composer'),
			'row_field_bottom_margin_title' =>					__('Bottom Margin', 'cmsmasters-content-composer'),
			'row_field_bottom_margin_descr' =>					__('Enter section bottom margin', 'cmsmasters-content-composer'),
			'row_field_margin_top_large_title' =>				__('Top Margin for Large Screens', 'cmsmasters-content-composer'),
			'row_field_margin_top_large_descr' =>				__('Enter top margin for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_large_title' =>			__('Bottom Margin for Large Screens', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_large_descr' =>			__('Enter bottom margin for devices with min-width 1440px and above', 'cmsmasters-content-composer'),
			'row_field_margin_top_laptop_title' =>				__('Top Margin for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'row_field_margin_top_laptop_descr' =>				__('Enter top margin for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_laptop_title' =>			__('Bottom Margin for Tablet Horizontal View', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_laptop_descr' =>			__('Enter bottom margin for devices with max-width 1024px and below', 'cmsmasters-content-composer'),
			'row_field_margin_top_tablet_title' =>				__('Top Margin for Tablet Vertical View', 'cmsmasters-content-composer'),
			'row_field_margin_top_tablet_descr' =>				__('Enter top margin for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_tablet_title' =>			__('Bottom Margin for Tablet Vertical View', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_tablet_descr' =>			__('Enter bottom margin for devices with max-width 768px and below', 'cmsmasters-content-composer'),
			'row_field_margin_top_mobile_h_title' =>			__('Top Margin for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'row_field_margin_top_mobile_h_descr' =>			__('Enter top margin for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_mobile_h_title' =>			__('Bottom Margin for Mobile Horizontal View', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_mobile_h_descr' =>			__('Enter bottom margin for devices with max-width 540px and below', 'cmsmasters-content-composer'),
			'row_field_margin_top_mobile_v_title' =>			__('Top Margin for Mobile Vertical View', 'cmsmasters-content-composer'),
			'row_field_margin_top_mobile_v_descr' =>			__('Enter top margin for devices with max-width 320px and below', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_mobile_v_title' =>			__('Bottom Margin for Mobile Vertical View', 'cmsmasters-content-composer'),
			'row_field_margin_bottom_mobile_v_descr' =>			__('Enter bottom margin for devices with max-width 320px and below', 'cmsmasters-content-composer'),
			
		/* Finish CMSMasters Row Shortcode Translations */
		
					
			'admin_url' => 										admin_url(), 
			'theme_url' => 										get_template_directory_uri(), 
			
		
		
		));
		
		
		wp_register_script('cmsmasters_content_composer_js', CMSMASTERS_CONTENT_COMPOSER_URL . 'js/jquery.cmsmastersContentComposer.js', array('jquery'), CMSMASTERS_CONTENT_COMPOSER_VERSION, true);
		
		wp_localize_script('cmsmasters_content_composer_js', 'cmsmasters_composer', array( 
			'remove_section' => 				__('Remove Section', 'cmsmasters-content-composer'), 
			'clone_section' => 					__('Clone Section', 'cmsmasters-content-composer'), 
			'edit_section' => 					__('Edit Section', 'cmsmasters-content-composer'), 
			'edit_column' => 					__('Edit Column', 'cmsmasters-content-composer'), 
			'add_shortcode' => 					__('Add Shortcode', 'cmsmasters-content-composer'), 
			'remove_shortcode' => 				__('Remove Shortcode', 'cmsmasters-content-composer'), 
			'clone_shortcode' => 				__('Clone Shortcode', 'cmsmasters-content-composer'), 
			'edit_shortcode' => 				__('Edit Shortcode', 'cmsmasters-content-composer'), 
			'delete_all' => 					__("Do you really want delete all content?\nAll data will be lost!", 'cmsmasters-content-composer'), 
			'delete_el' => 						__("Do you really want delete this element?\nAll data from this element will be lost!", 'cmsmasters-content-composer'), 
			'delete_tmpl' => 					__("Do you really want delete this template?\nAll data from this template will be lost!", 'cmsmasters-content-composer'), 
			'invalid_tmpl_name' => 				__("Error! Enter valid template name. Minimum 3 character.\nAllowed characters: letters, numbers, whitespace", 'cmsmasters-content-composer'), 
			'new_tmpl_name' => 					__("Enter the name for new template", 'cmsmasters-content-composer'), 
			'error_on_page' => 					__("Error on page!\nPlease reload page and try again", 'cmsmasters-content-composer'), 
			'nonce_ajax_template_operator' => 	wp_create_nonce('cmsmasters_ajax_template_operator-nonce'), 
			'ajaxurl' => 						admin_url('admin-ajax.php') 
		));
		
		
		wp_register_script('cmsmasters_composer_lightbox_js', CMSMASTERS_CONTENT_COMPOSER_URL . 'js/jquery.cmsmastersComposerLightbox.js', array('jquery'), CMSMASTERS_CONTENT_COMPOSER_VERSION, true);
		
		wp_localize_script('cmsmasters_composer_lightbox_js', 'cmsmasters_lightbox', array( 
			'palettes' => 				((function_exists('cmsmasters_color_picker_palettes')) ? implode(',', cmsmasters_color_picker_palettes()) : ''), 
			'cancel' => 				__('Cancel', 'cmsmasters-content-composer'), 
			'update' => 				__('Update', 'cmsmasters-content-composer'), 
			'remove' => 				__('Remove', 'cmsmasters-content-composer'), 
			'deselect' => 				__('Deselect', 'cmsmasters-content-composer'), 
			'local_fonts' => 			__('Local Fonts', 'cmsmasters-content-composer'), 
			'google_web_fonts' => 		__('Google Web Fonts', 'cmsmasters-content-composer'), 
			'add_media' => 				__('Add Media', 'cmsmasters-content-composer'), 
			'shcd_settings' => 			__('Shortcode Settings', 'cmsmasters-content-composer'), 
			'shcd_choose' => 			__('Choose Shortcode', 'cmsmasters-content-composer'), 
			'choose_image' => 			__('Choose Image', 'cmsmasters-content-composer'), 
			'choose_video' => 			__('Choose Video', 'cmsmasters-content-composer'), 
			'choose_audio' => 			__('Choose Audio', 'cmsmasters-content-composer'), 
			'insert_image' => 			__('Insert Image', 'cmsmasters-content-composer'), 
			'insert_video' => 			__('Insert Video', 'cmsmasters-content-composer'), 
			'insert_audio' => 			__('Insert Audio', 'cmsmasters-content-composer'), 
			'create_gallery' => 		__('Create Gallery', 'cmsmasters-content-composer'), 
			'edit_gallery' => 			__('Edit Gallery', 'cmsmasters-content-composer'), 
			'create_edit_gallery' => 	__('Create/Edit Gallery', 'cmsmasters-content-composer'), 
			'insert_gallery' => 		__('Insert Gallery', 'cmsmasters-content-composer'), 
			'choose_icon' => 			__('Choose icon', 'cmsmasters-content-composer'), 
			'add_table_col' => 			__('Add Table Column', 'cmsmasters-content-composer'), 
			'add_table_row' => 			__('Add Table Row', 'cmsmasters-content-composer'), 
			'text_align_left' => 		__('Text Align Left', 'cmsmasters-content-composer'), 
			'text_align_right' => 		__('Text Align Right', 'cmsmasters-content-composer'), 
			'text_align_center' => 		__('Text Align Center', 'cmsmasters-content-composer'), 
			'default_row' => 			__('Default Row', 'cmsmasters-content-composer'), 
			'header_row' => 			__('Header Row', 'cmsmasters-content-composer'), 
			'footer_row' => 			__('Footer Row', 'cmsmasters-content-composer'), 
			'delete_row' => 			__('Delete Row', 'cmsmasters-content-composer'), 
			'delete_col' => 			__('Delete Column', 'cmsmasters-content-composer'), 
			'opacity' => 				__('opacity', 'cmsmasters-content-composer'), 
			'error_on_page' => 			__("Error on page!\nReload page and try again.", 'cmsmasters-content-composer') 
		));
		
		
		wp_register_script('jquery-base64', CMSMASTERS_CONTENT_COMPOSER_URL . 'framework/js/jquery.base64.min.js', array('jquery'), CMSMASTERS_CONTENT_COMPOSER_VERSION, true);
		
		
		wp_register_script('jquery-sticky-kit', CMSMASTERS_CONTENT_COMPOSER_URL . 'framework/js/jquery.sticky-kit.min.js', array('jquery'), CMSMASTERS_CONTENT_COMPOSER_VERSION, true);
		
		
		if ( 
			($hook == 'post.php') || 
			($hook == 'post-new.php') 
		) {
			wp_enqueue_style('cmsmasters_content_composer_css');
			
			wp_enqueue_style('cmsmasters_composer_lightbox_css');
			
			
			if (is_rtl()) {
				wp_enqueue_style('cmsmasters_content_composer_css_rtl');
				
				wp_enqueue_style('cmsmasters_composer_lightbox_css_rtl');
			}
			
			
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-sortable');
			
			
			wp_enqueue_script('jquery-base64');
			
			
			wp_enqueue_script('jquery-sticky-kit');
		}
		
		
		if ( 
			$hook == 'post-new.php' || 
			($hook == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
		) {
			wp_enqueue_script('cmsmasters_composer_shortcodes_js');
			
			
			wp_enqueue_script('cmsmasters_content_composer_js');
			
			wp_enqueue_script('cmsmasters_composer_lightbox_js');
		}
	}
	
	
	function cmsmasters_composer_init() {
		if (wp_script_is('cmsmasters_content_composer_js', 'queue') && wp_script_is('cmsmasters_composer_lightbox_js', 'queue')) {
			echo "
<script type=\"text/javascript\">
	var cmsmastersContentComposer = jQuery('#cmsmasters_composer_content').cmsmastersContentComposer().data('cmsmastersContentComposer'), 
		cmsmastersComposerLightbox = jQuery('#cmsmasters_composer_content').cmsmastersComposerLightbox().data('cmsmastersComposerLightbox');
</script>
";
		}
	}
	
	
	function add_composer_button() {
		global $post;
		
		
		if (post_type_supports($post->post_type, 'editor')) {
			echo '<a href="#" id="cmsmasters_content_composer_button" class="button button-primary button-large admin-icon-composer" data-editor="' . __('Default Editor', 'cmsmasters-content-composer') . '" data-composer="' . __('Content Composer', 'cmsmasters-content-composer') . '">' . __('Content Composer', 'cmsmasters-content-composer') . '</a>';
		}
	}
	
	
	function add_gutenberg_button() {
		global $post;
		
		
		if (post_type_supports($post->post_type, 'editor')) {
			echo '<a href="#" id="cmsmasters_gutenberg_button" class="button button-large">' . __('&#8592; Back to Block Editor', 'cmsmasters-content-composer') . '</a>';
		}
	}
	
	
	function show_cmsmasters_composer_meta_box() {
		global $post;
		
		
		$admin_post_object = $post;
		
		
		$composer_show = get_post_meta($post->ID, 'cmsmasters_composer_show', true);
		$gutenberg_show = get_post_meta($post->ID, 'cmsmasters_gutenberg_show', true);
		$composer_fullscreen = get_post_meta($post->ID, 'cmsmasters_composer_fullscreen', true);
		$composer_begin = get_post_meta($post->ID, 'cmsmasters_composer_begin', true);
		$composer_confirm = get_post_meta($post->ID, 'cmsmasters_composer_confirm', true);
		
		
		$option_query = new WP_Query(array( 
			'orderby' => 'name', 
			'order' => 'ASC', 
			'post_type' => 'content_template', 
			'posts_per_page' => -1 
		));
		
		
		echo '<input type="hidden" name="custom_composer_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />' . 
		'<div class="cmsmasters_composer_container">' . 
			'<div class="cmsmasters_composer_buttons_container">' . 
				'<div class="cmsmasters_composer_buttons_container_wrap"></div>' . 
				'<div class="cmsmasters_composer_templates_container_wrap">' . 
					'<a href="#" class="cmsmasters_composer_fullscreen admin-icon-fullscreen" title="' . __('Expand Content Composer', 'cmsmasters-content-composer') . '"></a>' . 
					'<a href="#" class="cmsmasters_clear_content admin-icon-clear" title="' . __('Clear Composer Content', 'cmsmasters-content-composer') . '"></a>' . 
					'<a href="#" class="button cmsmasters_preview_trigger">' . __('Preview Changes', 'cmsmasters-content-composer') . '</a>' . 
					'<a href="#" class="button button-primary cmsmasters_update_trigger">' . __('Update', 'cmsmasters-content-composer') . '</a>' . 
					'<label for="cmsmasters_composer_begin" class="cmsmasters_composer_begin">' . 
						'<input type="checkbox" id="cmsmasters_composer_begin" name="cmsmasters_composer_begin" value="true"' . (($composer_begin === 'true') ? ' checked="checked"' : '') . ' />' . 
						__('Add elements to the top', 'cmsmasters-content-composer') . 
					'</label>' . 
					'<label for="cmsmasters_composer_confirm" class="cmsmasters_composer_confirm">' . 
						'<input type="checkbox" id="cmsmasters_composer_confirm" name="cmsmasters_composer_confirm" value="true"' . (($composer_confirm === 'true') ? ' checked="checked"' : '') . ' />' . 
						__("Don't confirm element deleting!", 'cmsmasters-content-composer') . 
					'</label>' . 
					'<div class="cmsmasters_pattern_list">' . 
					'<a class="cmsmasters_pattern_list_button button admin-icon-paste">' . __('Templates', 'cmsmasters-content-composer') . '</a>' . 
						'<ul>' . 
							'<li>' . 
								'<a href="#" class="button button-primary button-large cmsmasters_pattern_save_all">' . __('Save All as Template', 'cmsmasters-content-composer') . '</a>' . 
								'<span>' . __('Choose Template:', 'cmsmasters-content-composer') . '</span>' . 
							'</li>';
					
					
					if ($option_query->have_posts()) : 
						while ($option_query->have_posts() ) : $option_query->the_post();
							echo '<li>' . 
								'<a href="#" class="cmsmasters_pattern_paste" title="' . __('Load Selected Template', 'cmsmasters-content-composer') . '" data-id="' . get_the_ID() . '">' . get_the_title() . '</a>' . 
								'<a href="#" class="cmsmasters_pattern_delete admin-icon-delete" title="' . __('Delete Selected Template', 'cmsmasters-content-composer') . '" data-id="' . get_the_ID() . '"></a>' . 
							'</li>';
						endwhile;
					endif;
					
					
					echo '</ul>' . 
					'</div>' . 
					'<a href="#" class="cmsmasters_pattern_save admin-icon-save" title="' . __('Add New Template', 'cmsmasters-content-composer') . '"></a>' . 
				'</div>' . 
			'</div>' . 
			'<div id="cmsmasters_composer_content" class="cmsmasters_composer_content deactivated"></div>' . 
			'<input type="hidden" id="cmsmasters_composer_show" name="cmsmasters_composer_show" value="' . (($composer_show === 'true') ? 'true' : 'false') . '" />' . 
			'<input type="hidden" id="cmsmasters_gutenberg_show" name="cmsmasters_gutenberg_show" value="' . (($gutenberg_show === 'true') ? 'true' : 'false') . '" />' . 
			'<input type="hidden" id="cmsmasters_composer_fullscreen" name="cmsmasters_composer_fullscreen" value="' . (($composer_fullscreen === 'true') ? 'true' : 'false') . '" />' . 
			'<div id="cmsmasters_composer_message_saved_all" class="cmsmasters_message updated">' . 
				'<p>' . __('All content was saved as template successfully.', 'cmsmasters-content-composer') . '</p>' . 
			'</div>' . 
			'<div id="cmsmasters_composer_message_saved" class="cmsmasters_message updated">' . 
				'<p>' . __('Selected sections was saved as template successfully.', 'cmsmasters-content-composer') . '</p>' . 
			'</div>' . 
			'<div id="cmsmasters_composer_message_added" class="cmsmasters_message updated">' . 
				'<p>' . __('Template was loaded to composer successfully.', 'cmsmasters-content-composer') . '</p>' . 
			'</div>' . 
			'<div id="cmsmasters_composer_message_deleted" class="cmsmasters_message error">' . 
				'<p>' . __('Template was deleted successfully.', 'cmsmasters-content-composer') . '</p>' . 
			'</div>' . 
		'</div>';
		
		
		wp_reset_query();
		
		
		$post = $admin_post_object;
	}
	
	
	function add_custom_composer_meta_box() {
		add_meta_box( 
			'cmsmasters_composer_meta_box', 
			__('Visual Content Composer', 'cmsmasters-content-composer'), 
			array($this, 'show_cmsmasters_composer_meta_box'), 
			'', 
			'normal', 
			'high' 
		);
	}
	
	
	function save_custom_composer_meta($post_id) {
		if ( 
			!isset($_POST['custom_composer_meta_box_nonce']) || 
			!wp_verify_nonce($_POST['custom_composer_meta_box_nonce'], basename(__FILE__)) 
		) {
			return $post_id;
		}
		
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		
		
		if ($_POST['post_type'] == 'page') {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		
		$composer_meta_fields = array( 
			'cmsmasters_composer_show', 
			'cmsmasters_gutenberg_show', 
			'cmsmasters_composer_fullscreen', 
			'cmsmasters_composer_begin', 
			'cmsmasters_composer_confirm' 
		);
		
		
		foreach ($composer_meta_fields as $field) {
			$old = get_post_meta($post_id, $field, true);
			
			
			if (isset($_POST[$field])) {
				$new = $_POST[$field];
			} else {
				$new = '';
			}
			
			
			if (isset($new) && $new !== $old) {
				update_post_meta($post_id, $field, $new);
			} elseif (isset($old) && $new === '') {
				delete_post_meta($post_id, $field, $old);
			}
		}
	}
	
	
	function cmsmasters_content_composer_widgets_init() {
		if (!is_blog_installed()) {
			return;
		}
		
		
		if (class_exists('WP_Widget_Custom_Latest_Projects')) {
			register_widget('WP_Widget_Custom_Latest_Projects');
		}
		
		
		if (class_exists('WP_Widget_Custom_Popular_Projects')) {
			register_widget('WP_Widget_Custom_Popular_Projects');
		}
	}
	
	
	public function cmsmasters_content_composer_activate() {
		$this->cmsmasters_content_composer_activation_compatibility();
		
		
		if (get_option('cmsmasters_active_content_composer') != CMSMASTERS_CONTENT_COMPOSER_VERSION) {
			add_option('cmsmasters_active_content_composer', CMSMASTERS_CONTENT_COMPOSER_VERSION, '', 'yes');
		}
		
		
		flush_rewrite_rules();
	}
	
	
	public function cmsmasters_content_composer_deactivate() {
		flush_rewrite_rules();
	}
	
	
	public function cmsmasters_content_composer_activation_compatibility() {
		if ( 
			!defined('CMSMASTERS_CONTENT_COMPOSER') || 
			(defined('CMSMASTERS_CONTENT_COMPOSER') && !CMSMASTERS_CONTENT_COMPOSER) 
		) {
			deactivate_plugins(CMSMASTERS_CONTENT_COMPOSER_NAME);
			
			
			wp_die( 
				__("Your theme doesn't support CMSMasters Content Composer plugin. Please use appropriate CMSMasters theme.", 'cmsmasters-content-composer'), 
				__("Error!", 'cmsmasters-content-composer'), 
				array( 
					'back_link' => 	true 
				) 
			);
		}
	}
	
	
	public function cmsmasters_content_composer_compatibility() {
		if ( 
			!defined('CMSMASTERS_CONTENT_COMPOSER') || 
			(defined('CMSMASTERS_CONTENT_COMPOSER') && !CMSMASTERS_CONTENT_COMPOSER) 
		) {
			if (is_plugin_active(CMSMASTERS_CONTENT_COMPOSER_NAME)) {
				deactivate_plugins(CMSMASTERS_CONTENT_COMPOSER_NAME);
				
				
				add_action('admin_notices', array($this, 'cmsmasters_content_composer_compatibility_warning'));
			}
		}
	}
	
	
	public function cmsmasters_content_composer_compatibility_warning() {
		echo "<div class=\"notice notice-warning is-dismissible\">
			<p><strong>" . __("CMSMasters Content Composer plugin was deactivated, because your theme doesn't support it. Please use appropriate CMSMasters theme.", 'cmsmasters-content-composer') . "</strong></p>
		</div>";
	}
}


new Cmsmasters_Content_Composer();

