<?php 
/*
Plugin Name: CMSMasters Donations
Plugin URI: http://cmsmasters.net/
Description: CMSMasters Donations created by <a href="http://cmsmasters.net/" title="CMSMasters">CMSMasters</a> team. This plugin creates custom post type that allows you to collect donations using paypal in new <a href="http://themeforest.net/user/cmsmasters/portfolio" title="cmsmasters">cmsmasters</a> WordPress themes.
Version: 1.3.7
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
	http://cmsmasters.net/files/license/cmsmasters-donations/license.txt 
	or contact CMSMasters Studio at email 
	copyright.cmsmasters@gmail.com 
	about this.
	
	Please note, that any usage of this software, that 
	contradicts the license terms is a subject to legal pursue 
	and will result copyright reclaim and damage withdrawal.
*/


if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Cmsmasters_Donations {
	public function __construct() {
		define('CMSMASTERS_DONATIONS_VERSION', '1.3.6');
		
		define('CMSMASTERS_DONATIONS_FILE', __FILE__);
		
		$cmsmasters_active_theme = get_option('cmsmasters_active_theme') ? get_option('cmsmasters_active_theme') : '';
		
		define('CMSMASTERS_DONATIONS_THEME_STYLE', (get_option('cmsmasters_' . $cmsmasters_active_theme . '_theme_style') ? get_option('cmsmasters_' . $cmsmasters_active_theme . '_theme_style') : ''));
		
		define('CMSMASTERS_DONATIONS_NAME', plugin_basename(CMSMASTERS_DONATIONS_FILE));
		
		define('CMSMASTERS_DONATIONS_PATH', plugin_dir_path(CMSMASTERS_DONATIONS_FILE));
		
		define('CMSMASTERS_DONATIONS_URL', plugin_dir_url(CMSMASTERS_DONATIONS_FILE));
		
		define('CMSMASTERS_DONATIONS_ACTIVE_THEME', get_option('cmsmasters_active_theme'));
		
		define('CMSMASTERS_DONATIONS_THEME_SHORTCODES_DIR', 'cmsmasters-donations/cmsmasters-framework/theme-style' . CMSMASTERS_DONATIONS_THEME_STYLE . '/cmsmasters-c-c/shortcodes');
		
		define('CMSMASTERS_DONATIONS_THEME_TEMPLATES_DIR', 'cmsmasters-donations/cmsmasters-framework/theme-style' . CMSMASTERS_DONATIONS_THEME_STYLE . '/templates');
		
		
		define('CMSMASTERS_DONATIONS_FRAMEWORK', CMSMASTERS_DONATIONS_PATH . 'framework/');
		
		define('CMSMASTERS_DONATIONS_ADMIN', CMSMASTERS_DONATIONS_FRAMEWORK . 'admin/');
		
		define('CMSMASTERS_DONATIONS_FUNCTION', CMSMASTERS_DONATIONS_FRAMEWORK . 'function/');
		
		define('CMSMASTERS_DONATIONS_POSTTYPE', CMSMASTERS_DONATIONS_FRAMEWORK . 'posttype/');
		
		define('CMSMASTERS_DONATIONS_TEMPLATE', CMSMASTERS_DONATIONS_FRAMEWORK . 'template/');
		
		
		define('CMSMASTERS_DONATIONS_INC', CMSMASTERS_DONATIONS_PATH . 'inc/');
		
		define('CMSMASTERS_DONATIONS_FORMS', CMSMASTERS_DONATIONS_INC . 'forms/');
		
		define('CMSMASTERS_DONATIONS_GATEWAYS', CMSMASTERS_DONATIONS_INC . 'gateways/');
		
		
		if (is_admin()) {
			require_once(CMSMASTERS_DONATIONS_ADMIN . 'cmsmasters-donations-settings.php');
		}
		
		
		require_once(CMSMASTERS_DONATIONS_ADMIN . 'cmsmasters-donations-theme-settings-filter.php');
		
		require_once(CMSMASTERS_DONATIONS_ADMIN . 'cmsmasters-donations-theme-options-filter.php');
		
		
		require_once(CMSMASTERS_DONATIONS_POSTTYPE . 'cmsmasters-campaigns-posttype.php');
		
		require_once(CMSMASTERS_DONATIONS_POSTTYPE . 'cmsmasters-donations-posttype.php');
		
		
		require_once(CMSMASTERS_DONATIONS_FUNCTION . 'cmsmasters-donations-template-function.php');
		
		require_once(CMSMASTERS_DONATIONS_FUNCTION . 'cmsmasters-donations-shortcode-function.php');
		
		require_once(CMSMASTERS_DONATIONS_FUNCTION . 'cmsmasters-donations-form-function.php');
		
		
		require_once(CMSMASTERS_DONATIONS_INC . 'cmsmasters-donations-forms.php');
		
		require_once(CMSMASTERS_DONATIONS_INC . 'cmsmasters-donations-emails.php');
		
		
		require_once(CMSMASTERS_DONATIONS_INC . 'cmsmasters-donations-api.php');
		
		require_once(CMSMASTERS_DONATIONS_INC . 'cmsmasters-donations-payments.php');
		
		
		add_action('admin_enqueue_scripts', array($this, 'cmsmasters_donations_admin_scripts'));
		
		add_action('wp_enqueue_scripts', array($this, 'cmsmasters_donations_frontend_scripts'));
		
		add_action('admin_footer', array($this, 'cmsmasters_donations_shortcodes_init'));
		
		add_action('admin_init', array($this, 'cmsmasters_donations_compatibility'));
		
		
		register_activation_hook(CMSMASTERS_DONATIONS_FILE, array($this, 'cmsmasters_donations_activate'));
		
		register_deactivation_hook(CMSMASTERS_DONATIONS_FILE, array($this, 'cmsmasters_donations_deactivate'));
		
		
		add_filter('plugin_action_links_' . plugin_basename(CMSMASTERS_DONATIONS_FILE), array($this, 'cmsmasters_donations_action_links'));
		
		
		// Load Plugin Local File
		load_plugin_textdomain('cmsmasters-donations', false, dirname(plugin_basename(CMSMASTERS_DONATIONS_FILE)) . '/languages/');
	}
	
	
	public function cmsmasters_donations_admin_scripts() {
		global $pagenow;
		
		
		wp_enqueue_script('cmsmasters-donations-settings-toggle', CMSMASTERS_DONATIONS_URL . 'js/jquery.cmsmastersDonations-settings-toggle.js', array('jquery'), '1.0.0', true);
		
		wp_localize_script('cmsmasters-donations-settings-toggle', 'cmsmasters_donations_settings', array( 
			'shortname' => 	CMSMASTERS_DONATIONS_ACTIVE_THEME 
		));
		
		
		$screen = get_current_screen();
		
		if ($screen->id  == 'settings_page_cmsmasters-donations-settings') {
			wp_enqueue_media();
		}
		
		
		if ( 
			$pagenow == 'post-new.php' || 
			($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
		) {
			wp_enqueue_script('cmsmasters-donations-c-c-shortcodes-extend', CMSMASTERS_DONATIONS_URL . 'js/jquery.cmsmastersDonations-c-c-shortcodes-extend.js', array('cmsmasters_composer_shortcodes_js'), '1.0.0', true);
			
			wp_localize_script('cmsmasters-donations-c-c-shortcodes-extend', 'cmsmasters_donations_shortcodes', array( 
				'choice_campaign' => 								__('Campaign Name', 'cmsmasters-donations'),
				'choice_rest_amount' => 							__('Amount of donations still needed', 'cmsmasters-donations'),
				'choice_donated_percent' => 						__('Progress percent', 'cmsmasters-donations'),
				'choice_donation_but' => 							__('Donation button', 'cmsmasters-donations'),
				'button_field_type_title' =>						__('Button Type', 'cmsmasters-donations'),
				'choice_button_type_regular' =>						__('Regular Button', 'cmsmasters-donations'),
				'choice_button_type_donation' =>					__('Donation Button', 'cmsmasters-donations'),
				'button_field_campaign_title' =>					__('Donation Campaign', 'cmsmasters-donations'),
				
				/* Donations */
				'donations_title' =>								__('Donations', 'cmsmasters-donations'), 
				'donations_field_donations_number_title' =>			__('Number of Donations to Show', 'cmsmasters-donations'), 
				'donations_field_donations_number_descr_note' =>	__('Set 0 to show all donations', 'cmsmasters-donations'), 
				'donations_field_campaigns_title' =>				__('Campaigns', 'cmsmasters-donations'), 
				'donations_field_campaigns_descr' =>				__('Campaigns to show donations from', 'cmsmasters-donations'), 
				'donations_field_campaigns_descr_note' =>			__('Donations from all campaigns will be shown if none is selected', 'cmsmasters-donations'), 
				'donations_field_postsmeta_title' =>				__('Donations Meta to Display', 'cmsmasters-donations'), 
				
				/* Featured Campaign */
				'featured_campaign_title' =>						__('Featured Campaign', 'cmsmasters-donations'), 
				'featured_campaign_field_campaign_title' =>			__('Campaign to Show', 'cmsmasters-donations'), 
				'featured_campaign_field_postsmeta_title' =>		__('Campaign Meta to Display', 'cmsmasters-donations'), 
				
				/* Campaigns */
				'campaigns_title' =>								__('Campaigns', 'cmsmasters-donations'), 
				'campaigns_field_campaigns_ids_title' =>			__('Campaigns', 'cmsmasters-donations'), 
				'campaigns_field_campaigns_ids_descr' =>			__('Select one or several campaigns', 'cmsmasters-donations'), 
				'campaigns_field_campaigns_ids_descr_note' =>		__('All campaigns will be shown if none is selected', 'cmsmasters-donations'), 
				'campaigns_field_campaigns_categories_title' =>		__('Categories', 'cmsmasters-donations'), 
				'campaigns_field_campaigns_categories_descr' =>		__('Select one or several categories to show campaigns from', 'cmsmasters-donations'), 
				'campaigns_field_campaigns_categories_note' =>		__('Can be used only if \'Order By\' parameter is set to \'Date\' or \'Random\'. Select none to show all', 'cmsmasters-donations'), 
				'campaigns_field_campaigns_number_title' =>			__('Number of Campaigns to Show', 'cmsmasters-donations'), 
				'campaigns_field_campaigns_number_descr_note' =>	__('Set 0 to show all campaigns', 'cmsmasters-donations'), 
				'campaigns_field_pausetime_descr' =>				__('Enter your campaigns slider pause time', 'cmsmasters-donations'), 
				'campaigns_field_campaigns_metadata_title' =>		__('Campaigns Meta to Display', 'cmsmasters-donations'), 
			));
		}
	}
	
	
	public function cmsmasters_donations_frontend_scripts() {
		wp_register_style('cmsmasters-donations-form', CMSMASTERS_DONATIONS_URL . 'css/cmsmasters-donations-form.css', array(), CMSMASTERS_DONATIONS_VERSION, 'screen');
		
		wp_register_style('cmsmasters-donations-form-rtl', CMSMASTERS_DONATIONS_URL . 'css/cmsmasters-donations-form-rtl.css', array(), CMSMASTERS_DONATIONS_VERSION, 'screen');
		
		
		wp_register_script('cmsmastersValidation', CMSMASTERS_DONATIONS_URL . 'js/jquery.validationEngine.min.js', array('jquery'), '2.6.2', true);
		
		wp_register_script('cmsmastersValidationLang', CMSMASTERS_DONATIONS_URL . 'js/jquery.validationEngine-lang.js', array('jquery', 'cmsmastersValidation'), CMSMASTERS_DONATIONS_VERSION, true);
		
		wp_localize_script('cmsmastersValidationLang', 'cmsmasters_ve_lang', array( 
			'required' => 			__('* This field is required', 'cmsmasters-donations'), 
			'select_option' => 		__('* Please select an option', 'cmsmasters-donations'), 
			'required_checkbox' => 	__('* This checkbox is required', 'cmsmasters-donations'), 
			'min' => 				__('* Minimum', 'cmsmasters-donations'), 
			'max' => 				__('* Maximum', 'cmsmasters-donations'), 
			'allowed' => 			__(' characters allowed', 'cmsmasters-donations'), 
			'invalid_email' => 		__('* Invalid email address', 'cmsmasters-donations'), 
			'invalid_number' => 	__('* Invalid number', 'cmsmasters-donations'), 
			'invalid_url' => 		__('* Invalid URL', 'cmsmasters-donations'), 
			'numbers_spaces' => 	__('* Numbers and spaces only', 'cmsmasters-donations'), 
			'letters_spaces' => 	__('* Letters and spaces only', 'cmsmasters-donations') 
		));
		
		
		wp_register_script('cmsmasters-donations-form-script', CMSMASTERS_DONATIONS_URL . 'js/jquery.cmsmastersDonations-form.js', array('jquery', 'cmsmastersValidation', 'cmsmastersValidationLang'), CMSMASTERS_DONATIONS_VERSION, true);
		
		wp_localize_script('cmsmasters-donations-form-script', 'cmsmasters_donations_form_script_params', array( 
			'gateway' => 	(get_option('cmsmasters_donations_gateway') == 'stripe') ? 'stripe' : 'paypal', 
			'confirm' => 	(get_option('cmsmasters_confirm_donation') == 1) ? true : false 
		) );
	}
	
	
	// Shortcodes Init
	public function cmsmasters_donations_shortcodes_init() {
		global $pagenow;
		
		
		if ( 
			is_admin() && 
			$pagenow == 'post-new.php' || 
			($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
		) {
			if (wp_script_is('cmsmasters_content_composer_js', 'queue') && wp_script_is('cmsmasters_composer_lightbox_js', 'queue')) {
				$this->cmsmasters_donations_campaign_ids();
				
				$this->cmsmasters_donations_donation_but_campaign_ids();
				
				$this->cmsmasters_donations_campaign_categories();
			}
		}
	}
	
	
	// Campaign IDs
	public function cmsmasters_donations_campaign_ids() {
		$campaign_ids = get_posts(array(
			'numberposts' => -1, 
			'post_type' => 'campaign'
		));
		
		
		$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
		'/* <![CDATA[ */' . "\n\t" . 
			'function cmsmasters_composer_campaign_ids() { ' . "\n\t\t" . 
				'return { ' . "\n";
		
		
		if (!empty($campaign_ids)) {
			foreach ($campaign_ids as $campaign_id) {
				$out .= "\t\t\t\"" . $campaign_id->ID . "\" : \"" . esc_html($campaign_id->post_title) . "\", \n";
			}
			
			
			$out = substr($out, 0, -3);
		}
		
		
		$out .= "\n\t\t" . '}; ' . "\n\t" . 
			'} ' . "\n" . 
		'/* ]]> */' . "\n" . 
		'</script>' . "\n\n";
		
		
		echo $out;
	}
	
	
	// Donation Button Campaign IDs
	public function cmsmasters_donations_donation_but_campaign_ids() {
		$campaign_ids = get_posts(array(
			'numberposts' => -1, 
			'post_type' => 'campaign'
		));
		
		
		$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
		'/* <![CDATA[ */' . "\n\t" . 
			'function cmsmasters_composer_donation_but_campaign_ids() { ' . "\n\t\t" . 
				'return { ' . "\n" . 
					"\t\t\t\"\" : \"" . esc_html__('No specific campaign', 'cmsmasters_content_composer') . "\", \n";
		
		
		if (!empty($campaign_ids)) {
			foreach ($campaign_ids as $campaign_id) {
				$out .= "\t\t\t\"" . $campaign_id->ID . "\" : \"" . esc_html($campaign_id->post_title) . "\", \n";
			}
			
			
			$out = substr($out, 0, -3);
		}
		
		
		$out .= "\n\t\t" . '}; ' . "\n\t" . 
			'} ' . "\n" . 
		'/* ]]> */' . "\n" . 
		'</script>' . "\n\n";
		
		
		echo $out;
	}
	
	
	// Campaign Categories
	public function cmsmasters_donations_campaign_categories() {
		$categories = get_terms('cp-categs', array( 
			'hide_empty' => 0 
		));
		
		
		$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
		'/* <![CDATA[ */' . "\n\t" . 
			'function cmsmasters_composer_campaign_categories() { ' . "\n\t\t" . 
				'return { ' . "\n";
		
		
		if (!empty($categories)) {
			foreach ($categories as $category) {
				$out .= "\t\t\t\"" . $category->slug . "\" : \"" . esc_html($category->name) . "\", \n";
			}
			
			
			$out = substr($out, 0, -3);
		}
		
		
		$out .= "\n\t\t" . '}; ' . "\n\t" . 
			'} ' . "\n" . 
		'/* ]]> */' . "\n" . 
		'</script>' . "\n\n";
		
		
		echo $out;
	}
	
	
	public function cmsmasters_donations_action_links($links) {
		$settings_link = '<a href="' . get_admin_url(null, 'options-general.php?page=cmsmasters-donations-settings') . '" title="' . __('Donations Settings', 'cmsmasters-donations') . '">' . __('Settings', 'cmsmasters-donations') . '</a>';
		
		
		array_unshift($links, $settings_link);
		
		
		return $links;
	}
	
	
	public function cmsmasters_donations_activate() {
		$this->cmsmasters_donations_activation_compatibility();
		
		
		if (get_option('cmsmasters_active_donations') != CMSMASTERS_DONATIONS_VERSION) {
			add_option('cmsmasters_active_donations', CMSMASTERS_DONATIONS_VERSION, '', 'yes');
		}
		
		
		flush_rewrite_rules();
	}
	
	
	public function cmsmasters_donations_deactivate() {
		flush_rewrite_rules();
	}
	
	
	public function cmsmasters_donations_activation_compatibility() {
		if ( 
			!defined('CMSMASTERS_DONATIONS') || 
			(defined('CMSMASTERS_DONATIONS') && !CMSMASTERS_DONATIONS) 
		) {
			deactivate_plugins(CMSMASTERS_DONATIONS_NAME);
			
			
			wp_die( 
				__("Your theme doesn't support CMSMasters Donations plugin. Please use appropriate CMSMasters theme.", 'cmsmasters-donations'), 
				__("Error!", 'cmsmasters-donations'), 
				array( 
					'back_link' => 	true 
				) 
			);
		}
	}
	
	
	public function cmsmasters_donations_compatibility() {
		if ( 
			!defined('CMSMASTERS_DONATIONS') || 
			(defined('CMSMASTERS_DONATIONS') && !CMSMASTERS_DONATIONS) 
		) {
			if (is_plugin_active(CMSMASTERS_DONATIONS_NAME)) {
				deactivate_plugins(CMSMASTERS_DONATIONS_NAME);
				
				
				add_action('admin_notices', array($this, 'cmsmasters_donations_compatibility_warning'));
			}
		}
	}
	
	
	public function cmsmasters_donations_compatibility_warning() {
		echo "<div class=\"notice notice-warning is-dismissible\">
			<p><strong>" . __("CMSMasters Donations plugin was deactivated, because your theme doesn't support it. Please use appropriate CMSMasters theme.", 'cmsmasters-donations') . "</strong></p>
		</div>";
	}
}

$GLOBALS['cmsmasters_donations'] = new Cmsmasters_Donations();

