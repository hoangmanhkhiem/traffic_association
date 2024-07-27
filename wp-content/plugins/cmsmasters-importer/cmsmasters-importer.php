<?php 
/*
Plugin Name: CMSMasters Importer
Plugin URI: http://cmsmasters.net/
Description: CMSMasters Importer created by <a href="http://cmsmasters.net/" title="CMSMasters">CMSMasters</a> team.
Version: 1.0.7
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
	http://cmsmasters.net/files/license/cmsmasters-importer/license.txt 
	or contact CMSMasters Studio at email 
	copyright.cmsmasters@gmail.com 
	about this.
	
	Please note, that any usage of this software, that 
	contradicts the license terms is a subject to legal pursue 
	and will result copyright reclaim and damage withdrawal.
*/


class Cmsmasters_Importer { 
	function __construct() { 
		define('CMSMASTERS_IMPORTER_VERSION', '1.0.7');
		
		define('CMSMASTERS_IMPORTER_FILE', __FILE__);
		
		define('CMSMASTERS_IMPORTER_ACTIVE_THEME', get_option('cmsmasters_active_theme') ? get_option('cmsmasters_active_theme') : '');
		
		define('CMSMASTERS_IMPORTER_THEME_STYLE', (get_option('cmsmasters_' . CMSMASTERS_IMPORTER_ACTIVE_THEME . '_theme_style') ? get_option('cmsmasters_' . CMSMASTERS_IMPORTER_ACTIVE_THEME . '_theme_style') : ''));
		
		define('CMSMASTERS_IMPORTER_NAME', plugin_basename(CMSMASTERS_IMPORTER_FILE));
		
		define('CMSMASTERS_IMPORTER_PATH', plugin_dir_path(CMSMASTERS_IMPORTER_FILE));
		
		define('CMSMASTERS_IMPORTER_URL', plugin_dir_url(CMSMASTERS_IMPORTER_FILE));
		
		
		require_once(CMSMASTERS_IMPORTER_PATH . 'inc/cmsmasters-theme-importer.php');
		
		
		register_activation_hook(CMSMASTERS_IMPORTER_FILE, array($this, 'cmsmasters_importer_activate'));
		
		register_deactivation_hook(CMSMASTERS_IMPORTER_FILE, array($this, 'cmsmasters_importer_deactivate'));
		
		
		add_action('admin_enqueue_scripts', array($this, 'cmsmasters_importer_enqueue_scripts'));
		
		
		// Load Plugin Local File
		load_plugin_textdomain('cmsmasters-importer', false, dirname(plugin_basename(CMSMASTERS_IMPORTER_FILE)) . '/languages/');
		
		
		add_action('admin_init', array($this, 'cmsmasters_importer_compatibility'));
	}
	
	
	function cmsmasters_importer_enqueue_scripts($hook) {
		wp_enqueue_style('cmsmasters-importer-styles', CMSMASTERS_IMPORTER_URL . 'css/cmsmasters-importer.css', array(), CMSMASTERS_IMPORTER_VERSION, 'screen');
	}
	
	
	public function cmsmasters_importer_activate() {
		$this->cmsmasters_importer_activation_compatibility();
		
		
		if (get_option('cmsmasters_active_importer') != CMSMASTERS_IMPORTER_VERSION) {
			add_option('cmsmasters_active_importer', CMSMASTERS_IMPORTER_VERSION, '', 'yes');
		}
		
		
		flush_rewrite_rules();
	}
	
	
	public function cmsmasters_importer_deactivate() {
		flush_rewrite_rules();
	}
	
	
	public function cmsmasters_importer_activation_compatibility() {
		if ( 
			!defined('CMSMASTERS_IMPORTER') || 
			(defined('CMSMASTERS_IMPORTER') && !CMSMASTERS_IMPORTER) 
		) {
			deactivate_plugins(CMSMASTERS_IMPORTER_NAME);
			
			
			wp_die( 
				__("Your theme doesn't support CMSMasters Importer plugin. Please use appropriate CMSMasters theme.", 'cmsmasters-importer'), 
				__("Error!", 'cmsmasters-importer'), 
				array( 
					'back_link' => 	true 
				) 
			);
		}
	}
	
	
	public function cmsmasters_importer_compatibility() {
		if ( 
			!defined('CMSMASTERS_IMPORTER') || 
			(defined('CMSMASTERS_IMPORTER') && !CMSMASTERS_IMPORTER) 
		) {
			if (is_plugin_active(CMSMASTERS_IMPORTER_NAME)) {
				deactivate_plugins(CMSMASTERS_IMPORTER_NAME);
				
				
				add_action('admin_notices', array($this, 'cmsmasters_importer_compatibility_warning'));
			}
		}
	}
	
	
	public function cmsmasters_importer_compatibility_warning() {
		echo "<div class=\"notice notice-warning is-dismissible\">
			<p><strong>" . __("CMSMasters Importer plugin was deactivated, because your theme doesn't support it. Please use appropriate CMSMasters theme.", 'cmsmasters-importer') . "</strong></p>
		</div>";
	}
}


new Cmsmasters_Importer();

