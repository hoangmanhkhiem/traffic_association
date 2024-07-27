<?php 
/*
Plugin Name: CMSMasters Custom Fonts
Plugin URI: http://cmsmasters.net/
Description: CMSMasters Custom Fonts created by <a href="http://cmsmasters.net/" title="CMSMasters">CMSMasters</a> team.
Version: 1.0.1
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
	http://cmsmasters.net/files/license/cmsmasters-custom-fonts/license.txt 
	or contact CMSMasters Studio at email 
	copyright.cmsmasters@gmail.com 
	about this.
	
	Please note, that any usage of this software, that 
	contradicts the license terms is a subject to legal pursue 
	and will result copyright reclaim and damage withdrawal.
*/


class Cmsmasters_Custom_Fonts { 
	function __construct() { 
		define('CMSMASTERS_CUSTOM_FONTS_VERSION', '1.0.1');
		
		define('CMSMASTERS_CUSTOM_FONTS_FILE', __FILE__);
		
		define('CMSMASTERS_CUSTOM_FONTS_ACTIVE_THEME', get_option('cmsmasters_active_theme') ? get_option('cmsmasters_active_theme') : '');
		
		define('CMSMASTERS_CUSTOM_FONTS_THEME_STYLE', (get_option('cmsmasters_' . CMSMASTERS_CUSTOM_FONTS_ACTIVE_THEME . '_theme_style') ? get_option('cmsmasters_' . CMSMASTERS_CUSTOM_FONTS_ACTIVE_THEME . '_theme_style') : ''));
		
		define('CMSMASTERS_CUSTOM_FONTS_NAME', plugin_basename(CMSMASTERS_CUSTOM_FONTS_FILE));
		
		define('CMSMASTERS_CUSTOM_FONTS_PATH', plugin_dir_path(CMSMASTERS_CUSTOM_FONTS_FILE));
		
		define('CMSMASTERS_CUSTOM_FONTS_URL', plugin_dir_url(CMSMASTERS_CUSTOM_FONTS_FILE));
		
		
		require_once(CMSMASTERS_CUSTOM_FONTS_PATH . 'modules/plugin.php');
		
		
		register_activation_hook(CMSMASTERS_CUSTOM_FONTS_FILE, array($this, 'cmsmasters_custom_fonts_activate'));
		
		register_deactivation_hook(CMSMASTERS_CUSTOM_FONTS_FILE, array($this, 'cmsmasters_custom_fonts_deactivate'));
		
		
		// Load Plugin Local File
		load_plugin_textdomain('cmsmasters-custom-fonts', false, dirname(plugin_basename(CMSMASTERS_CUSTOM_FONTS_FILE)) . '/languages/');
		
		
		add_action('admin_init', array($this, 'cmsmasters_custom_fonts_compatibility'));
	}
	
	
	public function cmsmasters_custom_fonts_activate() {
		$this->cmsmasters_custom_fonts_activation_compatibility();
		
		
		if (get_option('cmsmasters_active_custom_fonts') != CMSMASTERS_CUSTOM_FONTS_VERSION) {
			add_option('cmsmasters_active_custom_fonts', CMSMASTERS_CUSTOM_FONTS_VERSION, '', 'yes');
		}
		
		
		flush_rewrite_rules();
	}
	
	
	public function cmsmasters_custom_fonts_deactivate() {
		flush_rewrite_rules();
	}
	
	
	public function cmsmasters_custom_fonts_activation_compatibility() {
		if ( 
			!defined('CMSMASTERS_CUSTOM_FONTS') || 
			(defined('CMSMASTERS_CUSTOM_FONTS') && !CMSMASTERS_CUSTOM_FONTS) 
		) {
			deactivate_plugins(CMSMASTERS_CUSTOM_FONTS_NAME);
			
			
			wp_die( 
				__("Your theme doesn't support CMSMasters Custom Fonts plugin. Please use appropriate CMSMasters theme.", 'cmsmasters-custom-fonts'), 
				__("Error!", 'cmsmasters-custom-fonts'), 
				array( 
					'back_link' => 	true 
				) 
			);
		}
	}
	
	
	public function cmsmasters_custom_fonts_compatibility() {
		if ( 
			!defined('CMSMASTERS_CUSTOM_FONTS') || 
			(defined('CMSMASTERS_CUSTOM_FONTS') && !CMSMASTERS_CUSTOM_FONTS) 
		) {
			if (is_plugin_active(CMSMASTERS_CUSTOM_FONTS_NAME)) {
				deactivate_plugins(CMSMASTERS_CUSTOM_FONTS_NAME);
				
				
				add_action('admin_notices', array($this, 'cmsmasters_custom_fonts_compatibility_warning'));
			}
		}
	}
	
	
	public function cmsmasters_custom_fonts_compatibility_warning() {
		echo "<div class=\"notice notice-warning is-dismissible\">
			<p><strong>" . __("CMSMasters Custom Fonts plugin was deactivated, because your theme doesn't support it. Please use appropriate CMSMasters theme.", 'cmsmasters-custom-fonts') . "</strong></p>
		</div>";
	}
}


new Cmsmasters_Custom_Fonts();

