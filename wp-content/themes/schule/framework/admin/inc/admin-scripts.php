<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.0
 * 
 * Admin Panel Scripts & Styles
 * Created by CMSMasters
 * 
 */


function schule_admin_register($hook) {
	global $pagenow;
	
	$screen = get_current_screen();
	
	
	wp_enqueue_style('wp-color-picker');
	
	wp_enqueue_script('wp-color-picker');
	
	wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', array(
		'clear' => 					esc_attr__('Clear', 'schule'),
		'clearAriaLabel' => 		esc_attr__('Clear color', 'schule'),
		'defaultLabel' => 			esc_attr__('Color value', 'schule'),
		'defaultString' => 			esc_attr__('Default', 'schule'),
		'defaultAriaLabel' => 		esc_attr__('Select default color', 'schule'),
		'pick' => 					esc_attr__('Select Color', 'schule'),
	) ); 
	
	wp_enqueue_script('wp-color-picker-alpha', get_template_directory_uri() . '/framework/admin/inc/js/wp-color-picker-alpha.js', array('jquery', 'wp-color-picker'), '2.1.4', true);
	
	
	wp_enqueue_style('schule-admin-icons-font', get_template_directory_uri() . '/framework/admin/inc/css/admin-icons-font.css', array(), '1.0.0', 'screen');
	
	wp_enqueue_style('schule-lightbox', get_template_directory_uri() . '/framework/admin/inc/css/jquery.cmsmastersLightbox.css', array(), '1.0.0', 'screen');
	
	if (is_rtl()) {
		wp_enqueue_style('schule-lightbox-rtl', get_template_directory_uri() . '/framework/admin/inc/css/jquery.cmsmastersLightbox-rtl.css', array(), '1.0.0', 'screen');
	}
	
	
	wp_enqueue_script('schule-uploader-js', get_template_directory_uri() . '/framework/admin/inc/js/jquery.cmsmastersUploader.js', array('jquery'), '1.0.0', true);
	
	wp_localize_script('schule-uploader-js', 'cmsmasters_admin_uploader', array( 
		'choose' => 				esc_attr__('Choose image', 'schule'), 
		'insert' => 				esc_attr__('Insert image', 'schule'), 
		'remove' => 				esc_attr__('Remove', 'schule'), 
		'edit_gallery' => 			esc_attr__('Edit gallery', 'schule') 
	));
	
	
	wp_enqueue_script('schule-lightbox-js', get_template_directory_uri() . '/framework/admin/inc/js/jquery.cmsmastersLightbox.js', array('jquery'), '1.0.0', true);
	
	wp_localize_script('schule-lightbox-js', 'cmsmasters_admin_lightbox', array( 
		'cancel' => 				esc_attr__('Cancel', 'schule'), 
		'insert' => 				esc_attr__('Insert', 'schule'), 
		'deselect' => 				esc_attr__('Deselect', 'schule'), 
		'choose_icon' => 			esc_attr__('Choose Icon', 'schule'), 
		'find_icons' => 			esc_attr__('Find icons', 'schule'), 
		'min_length' => 			esc_attr__('min 2 symbols', 'schule'), 
		'choose_font' => 			esc_attr__('Choose icons font', 'schule'), 
		'error_on_page' => 			esc_attr__("Error on page!\nReload page and try again.", 'schule') 
	));
	
	
	if ( 
		$hook == 'post.php' || 
		$hook == 'post-new.php' || 
		$hook == 'widgets.php' || 
		$hook == 'term.php' || 
		$hook == 'edit-tags.php' || 
		$hook == 'nav-menus.php' || 
		str_replace('cmsmasters-settings-element', '', $screen->id) != $screen->id 
	) {
		wp_enqueue_style('schule-icons', get_template_directory_uri() . '/css/fontello.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_style('schule-icons-custom', get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/css/fontello-custom.css', array(), '1.0.0', 'screen');
	}
	
	
	if ( 
		$hook == 'widgets.php' || 
		$hook == 'nav-menus.php' 
	) {
		wp_enqueue_media();
	}
	
	
	wp_enqueue_style('schule-admin-styles', get_template_directory_uri() . '/framework/admin/inc/css/admin-theme-styles.css', array(), '1.0.0', 'screen');
	
	if (is_rtl()) {
		wp_enqueue_style('schule-admin-styles-rtl', get_template_directory_uri() . '/framework/admin/inc/css/admin-theme-styles-rtl.css', array(), '1.0.0', 'screen');
	}
	
	
	wp_enqueue_script('schule-admin-scripts', get_template_directory_uri() . '/framework/admin/inc/js/admin-theme-scripts.js', array('jquery'), '1.0.0', true);
	
	
	if ($hook == 'widgets.php') {
		wp_enqueue_style('schule-widgets-styles', get_template_directory_uri() . '/framework/admin/inc/css/widgets-styles.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_script('schule-widgets-scripts', get_template_directory_uri() . '/framework/admin/inc/js/widgets-scripts.js', array('jquery'), '1.0.0', true);
	}
}

add_action('admin_enqueue_scripts', 'schule_admin_register');

add_action('admin_enqueue_scripts', 'cmsmasters_composer_icons');

