<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.9
 * 
 * Admin Panel Element Options
 * Created by CMSMasters
 * 
 */


function schule_options_element_tabs() {
	$tabs = array();
	
	$tabs['sidebar'] = esc_attr__('Sidebars', 'schule');
	
	if (class_exists('Cmsmasters_Content_Composer')) {
		$tabs['icon'] = esc_attr__('Social Icons', 'schule');
	}
	
	$tabs['lightbox'] = esc_attr__('Lightbox', 'schule');
	$tabs['sitemap'] = esc_attr__('Sitemap', 'schule');
	$tabs['error'] = esc_attr__('404', 'schule');
	$tabs['code'] = esc_attr__('Custom Codes', 'schule');
	
	if (class_exists('Cmsmasters_Form_Builder')) {
		$tabs['recaptcha'] = esc_attr__('reCAPTCHA', 'schule');
	}
	
	return apply_filters('cmsmasters_options_element_tabs_filter', $tabs);
}


function schule_options_element_sections() {
	$tab = schule_get_the_tab();
	
	switch ($tab) {
	case 'sidebar':
		$sections = array();
		
		$sections['sidebar_section'] = esc_attr__('Custom Sidebars', 'schule');
		
		break;
	case 'icon':
		$sections = array();
		
		$sections['icon_section'] = esc_attr__('Social Icons', 'schule');
		
		break;
	case 'lightbox':
		$sections = array();
		
		$sections['lightbox_section'] = esc_attr__('Theme Lightbox Options', 'schule');
		
		break;
	case 'sitemap':
		$sections = array();
		
		$sections['sitemap_section'] = esc_attr__('Sitemap Page Options', 'schule');
		
		break;
	case 'error':
		$sections = array();
		
		$sections['error_section'] = esc_attr__('404 Error Page Options', 'schule');
		
		break;
	case 'code':
		$sections = array();
		
		$sections['code_section'] = esc_attr__('Custom Codes', 'schule');
		
		break;
	case 'recaptcha':
		$sections = array();
		
		$sections['recaptcha_section'] = esc_attr__('Form Builder Plugin reCAPTCHA Keys', 'schule');
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	return apply_filters('cmsmasters_options_element_sections_filter', $sections, $tab);	
} 


function schule_options_element_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = schule_get_the_tab();
	}
	
	
	$options = array();
	
	
	$defaults = schule_settings_element_defaults();
	
	
	switch ($tab) {
	case 'sidebar':
		$options[] = array( 
			'section' => 'sidebar_section', 
			'id' => 'schule' . '_sidebar', 
			'title' => esc_html__('Custom Sidebars', 'schule'), 
			'desc' => '', 
			'type' => 'sidebar', 
			'std' => $defaults[$tab]['schule' . '_sidebar'] 
		);
		
		break;
	case 'icon':
		$options[] = array( 
			'section' => 'icon_section', 
			'id' => 'schule' . '_social_icons', 
			'title' => esc_html__('Social Icons', 'schule'), 
			'desc' => '', 
			'type' => 'social', 
			'std' => $defaults[$tab]['schule' . '_social_icons'] 
		);
		
		break;
	case 'lightbox':
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_skin', 
			'title' => esc_html__('Skin', 'schule'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_skin'], 
			'choices' => array( 
				esc_html__('Dark', 'schule') . '|dark', 
				esc_html__('Light', 'schule') . '|light', 
				esc_html__('Mac', 'schule') . '|mac', 
				esc_html__('Metro Black', 'schule') . '|metro-black', 
				esc_html__('Metro White', 'schule') . '|metro-white', 
				esc_html__('Parade', 'schule') . '|parade', 
				esc_html__('Smooth', 'schule') . '|smooth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_path', 
			'title' => esc_html__('Path', 'schule'), 
			'desc' => esc_html__('Sets path for switching windows', 'schule'), 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_path'], 
			'choices' => array( 
				esc_html__('Vertical', 'schule') . '|vertical', 
				esc_html__('Horizontal', 'schule') . '|horizontal' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_infinite', 
			'title' => esc_html__('Infinite', 'schule'), 
			'desc' => esc_html__('Sets the ability to infinite the group', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_infinite'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_aspect_ratio', 
			'title' => esc_html__('Keep Aspect Ratio', 'schule'), 
			'desc' => esc_html__('Sets the resizing method used to keep aspect ratio within the viewport', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_aspect_ratio'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_mobile_optimizer', 
			'title' => esc_html__('Mobile Optimizer', 'schule'), 
			'desc' => esc_html__('Make lightboxes optimized for giving better experience with mobile devices', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_mobile_optimizer'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_max_scale', 
			'title' => esc_html__('Max Scale', 'schule'), 
			'desc' => esc_html__('Sets the maximum viewport scale of the content', 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_max_scale'], 
			'min' => 0.1, 
			'max' => 2, 
			'step' => 0.05 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_min_scale', 
			'title' => esc_html__('Min Scale', 'schule'), 
			'desc' => esc_html__('Sets the minimum viewport scale of the content', 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_min_scale'], 
			'min' => 0.1, 
			'max' => 2, 
			'step' => 0.05 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_inner_toolbar', 
			'title' => esc_html__('Inner Toolbar', 'schule'), 
			'desc' => esc_html__('Bring buttons into windows, or let them be over the overlay', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_inner_toolbar'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_smart_recognition', 
			'title' => esc_html__('Smart Recognition', 'schule'), 
			'desc' => esc_html__('Sets content auto recognize from web pages', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_smart_recognition'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_fullscreen_one_slide', 
			'title' => esc_html__('Fullscreen One Slide', 'schule'), 
			'desc' => esc_html__('Decide to fullscreen only one slide or hole gallery the fullscreen mode', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_fullscreen_one_slide'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_fullscreen_viewport', 
			'title' => esc_html__('Fullscreen Viewport', 'schule'), 
			'desc' => esc_html__('Sets the resizing method used to fit content within the fullscreen mode', 'schule'), 
			'type' => 'select', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_fullscreen_viewport'], 
			'choices' => array( 
				esc_html__('Center', 'schule') . '|center', 
				esc_html__('Fit', 'schule') . '|fit', 
				esc_html__('Fill', 'schule') . '|fill', 
				esc_html__('Stretch', 'schule') . '|stretch' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_controls_toolbar', 
			'title' => esc_html__('Toolbar Controls', 'schule'), 
			'desc' => esc_html__('Sets buttons be available or not', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_controls_toolbar'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_controls_arrows', 
			'title' => esc_html__('Arrow Controls', 'schule'), 
			'desc' => esc_html__('Enable the arrow buttons', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_controls_arrows'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_controls_fullscreen', 
			'title' => esc_html__('Fullscreen Controls', 'schule'), 
			'desc' => esc_html__('Sets the fullscreen button', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_controls_fullscreen'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_controls_thumbnail', 
			'title' => esc_html__('Thumbnails Controls', 'schule'), 
			'desc' => esc_html__('Sets the thumbnail navigation', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_controls_thumbnail'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_controls_keyboard', 
			'title' => esc_html__('Keyboard Controls', 'schule'), 
			'desc' => esc_html__('Sets the keyboard navigation', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_controls_keyboard'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_controls_mousewheel', 
			'title' => esc_html__('Mouse Wheel Controls', 'schule'), 
			'desc' => esc_html__('Sets the mousewheel navigation', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_controls_mousewheel'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_controls_swipe', 
			'title' => esc_html__('Swipe Controls', 'schule'), 
			'desc' => esc_html__('Sets the swipe navigation', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_controls_swipe'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'schule' . '_ilightbox_controls_slideshow', 
			'title' => esc_html__('Slideshow Controls', 'schule'), 
			'desc' => esc_html__('Enable the slideshow feature and button', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_ilightbox_controls_slideshow'] 
		);
		
		break;
	case 'sitemap':
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'schule' . '_sitemap_nav', 
			'title' => esc_html__('Website Pages', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_sitemap_nav'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'schule' . '_sitemap_categs', 
			'title' => esc_html__('Blog Archives by Categories', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_sitemap_categs'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'schule' . '_sitemap_tags', 
			'title' => esc_html__('Blog Archives by Tags', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_sitemap_tags'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'schule' . '_sitemap_month', 
			'title' => esc_html__('Blog Archives by Month', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_sitemap_month'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'schule' . '_sitemap_pj_categs', 
			'title' => esc_html__('Portfolio Archives by Categories', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_sitemap_pj_categs'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'schule' . '_sitemap_pj_tags', 
			'title' => esc_html__('Portfolio Archives by Tags', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_sitemap_pj_tags'] 
		);
		
		break;
	case 'error':
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_color', 
			'title' => esc_html__('Text Color', 'schule'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['schule' . '_error_color'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_bg_color', 
			'title' => esc_html__('Background Color', 'schule'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['schule' . '_error_bg_color'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_bg_img_enable', 
			'title' => esc_html__('Background Image Visibility', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_error_bg_img_enable'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_bg_image', 
			'title' => esc_html__('Background Image', 'schule'), 
			'desc' => esc_html__('Choose your custom error page background image.', 'schule'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['schule' . '_error_bg_image'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_bg_rep', 
			'title' => esc_html__('Background Repeat', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_error_bg_rep'], 
			'choices' => array( 
				esc_html__('No Repeat', 'schule') . '|no-repeat', 
				esc_html__('Repeat Horizontally', 'schule') . '|repeat-x', 
				esc_html__('Repeat Vertically', 'schule') . '|repeat-y', 
				esc_html__('Repeat', 'schule') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_bg_pos', 
			'title' => esc_html__('Background Position', 'schule'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['schule' . '_error_bg_pos'], 
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
			'section' => 'error_section', 
			'id' => 'schule' . '_error_bg_att', 
			'title' => esc_html__('Background Attachment', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_error_bg_att'], 
			'choices' => array( 
				esc_html__('Scroll', 'schule') . '|scroll', 
				esc_html__('Fixed', 'schule') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_bg_size', 
			'title' => esc_html__('Background Size', 'schule'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['schule' . '_error_bg_size'], 
			'choices' => array( 
				esc_html__('Auto', 'schule') . '|auto', 
				esc_html__('Cover', 'schule') . '|cover', 
				esc_html__('Contain', 'schule') . '|contain' 
			) 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_search', 
			'title' => esc_html__('Search Line', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_error_search'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_sitemap_button', 
			'title' => esc_html__('Sitemap Button', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_error_sitemap_button'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'schule' . '_error_sitemap_link', 
			'title' => esc_html__('Sitemap Page URL', 'schule'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_error_sitemap_link'], 
			'class' => '' 
		);
		
		break;
	case 'code':
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'schule' . '_custom_css', 
			'title' => esc_html__('Custom CSS', 'schule'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['schule' . '_custom_css'], 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'schule' . '_custom_js', 
			'title' => esc_html__('Custom JavaScript', 'schule'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['schule' . '_custom_js'], 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'schule' . '_gmap_api_key', 
			'title' => esc_html__('Google Maps API key', 'schule'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_gmap_api_key'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'schule' . '_twitter_access_data', 
			'title' => esc_html__('Twitter Access Data', 'schule'), 
			'desc' => sprintf(
				/* translators: Twitter access data. %s: Link to twitter access data generator */
				esc_html__( 'Generate %s and paste access data to fields.', 'schule' ),
				'<a href="' . esc_url( 'https://api.cmsmasters.net/wp-json/cmsmasters-api/v1/twitter-request-token' ) . '" target="_blank">' .
					esc_html__( 'twitter access data', 'schule' ) .
				'</a>'
			), 
			'type' => 'multi-text', 
			'std' => $defaults[$tab]['schule' . '_twitter_access_data'], 
			'class' => 'regular-text', 
			'choices' => array( 
				esc_html__('Consumer Key', 'schule') . '|consumer_key', 
				esc_html__('Consumer Secret', 'schule') . '|consumer_secret', 
				esc_html__('Access Token', 'schule') . '|access_token', 
				esc_html__('Access Token Secret', 'schule') . '|access_token_secret' 
			) 
		);
		
		break;
	case 'recaptcha':
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => 'schule' . '_recaptcha_public_key', 
			'title' => esc_html__('reCAPTCHA Public Key', 'schule'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_recaptcha_public_key'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => 'schule' . '_recaptcha_private_key', 
			'title' => esc_html__('reCAPTCHA Private Key', 'schule'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_recaptcha_private_key'], 
			'class' => '' 
		);
		
		break;
	}
	
	return apply_filters('cmsmasters_options_element_fields_filter', $options, $tab);	
}

