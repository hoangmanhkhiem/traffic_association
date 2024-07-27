<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.2.0
 * 
 * TGM-Plugin-Activation 2.6.1
 * Created by CMSMasters
 * 
 */


require_once(get_template_directory() . '/framework/class/class-tgm-plugin-activation.php');


if (!function_exists('schule_register_theme_plugins')) {

function schule_register_theme_plugins() { 
	$plugins = array( 
		array( 
			'name'					=> esc_html__('CMSMasters Content Composer', 'schule'), 
			'slug'					=> 'cmsmasters-content-composer', 
			'source'				=> get_template_directory() . '/theme-vars/plugins/cmsmasters-content-composer.zip', 
			'required'				=> true, 
			'version'				=> '2.5.4', 
			'force_activation'		=> false, 
			'force_deactivation' 	=> false 
		), 
		array( 
			'name'					=> esc_html__('CMSMasters Custom Fonts', 'schule'), 
			'slug'					=> 'cmsmasters-custom-fonts', 
			'source'				=> get_template_directory() . '/theme-vars/plugins/cmsmasters-custom-fonts.zip', 
			'required'				=> true, 
			'version'				=> '1.0.1', 
			'force_activation'		=> false, 
			'force_deactivation' 	=> false 
		), 
		array( 
			'name'					=> esc_html__('CMSMasters Mega Menu', 'schule'), 
			'slug'					=> 'cmsmasters-mega-menu', 
			'source'				=> get_template_directory() . '/theme-vars/plugins/cmsmasters-mega-menu.zip', 
			'required'				=> true, 
			'version'				=> '1.2.9', 
			'force_activation'		=> false, 
			'force_deactivation' 	=> false 
		),
		array( 
			'name'					=> esc_html__('CMSMasters Donations', 'schule'), 
			'slug'					=> 'cmsmasters-donations', 
			'source'				=> get_template_directory() . '/theme-vars/plugins/cmsmasters-donations.zip', 
			'required'				=> true, 
			'version'				=> '1.3.7', 
			'force_activation'		=> false, 
			'force_deactivation' 	=> false 
		),  
		array( 
			'name'					=> esc_html__('CMSMasters Importer', 'schule'), 
			'slug'					=> 'cmsmasters-importer', 
			'source'				=> get_template_directory() . '/theme-vars/plugins/cmsmasters-importer.zip', 
			'required'				=> true, 
			'version'				=> '1.0.7', 
			'force_activation'		=> false, 
			'force_deactivation' 	=> false 
		), 
		array( 
			'name' 					=> esc_html__('LayerSlider WP', 'schule'), 
			'slug' 					=> 'LayerSlider', 
			'source'				=> get_template_directory() . '/theme-vars/plugins/LayerSlider.zip', 
			'required'				=> false, 
			'version'				=> '7.10.1', 
			'force_activation'		=> false, 
			'force_deactivation' 	=> false 
		), 
		array( 
			'name' 					=> esc_html__('Revolution Slider', 'schule'), 
			'slug' 					=> 'revslider', 
			'source'				=> get_template_directory() . '/theme-vars/plugins/revslider.zip', 
			'required'				=> false, 
			'version'				=> '6.7.0',
			'force_activation'		=> false, 
			'force_deactivation' 	=> false 
		),  
		array( 
			'name'					=> esc_html__('Envato Market', 'schule'), 
			'slug'					=> 'envato-market', 
			'source'				=> 'https://envato.github.io/wp-envato-market/dist/envato-market.zip', 
			'required'				=> false 
		), 
		array( 
			'name'					=> esc_html__('GDPR Cookie Consent', 'schule'), 
			'slug'					=> 'cookie-law-info', 
			'required'				=> false 
		), 
		array( 
			'name' 					=> esc_html__('The Events Calendar', 'schule'), 
			'slug' 					=> 'the-events-calendar', 
			'required'				=> false 
		), 
		array( 
			'name' 					=> esc_html__('LearnPress', 'schule'), 
			'slug' 					=> 'learnpress', 
			'required' 				=> false 
		),
		array( 
			'name' 					=> esc_html__('LearnPress Course Review', 'schule'), 
			'slug' 					=> 'learnpress-course-review', 
			'required' 				=> false 
		), 
		array( 
			'name' 					=> esc_html__('LearnPress Courses Wishlist', 'schule'), 
			'slug' 					=> 'learnpress-wishlist', 
			'required' 				=> false 
		), 
		array( 
			'name' 					=> esc_html__('LearnPress Prerequisite Courses', 'schule'), 
			'slug' 					=> 'learnpress-prerequisites-courses', 
			'required' 				=> false 
		),
		array( 
			'name' 					=> esc_html__('Contact Form 7', 'schule'), 
			'slug' 					=> 'contact-form-7', 
			'required' 				=> false 
		), 
		array( 
			'name'					=> esc_html__('MailPoet 3', 'schule'), 
			'slug'					=> 'mailpoet', 
			'required'				=> false 
		) 
	);
	
	
	$config = array( 
		'id' => 			'schule', 
		'menu' => 			'theme-required-plugins', 
		'strings' => array( 
			'page_title' => 	esc_html__('Theme Required & Recommended Plugins', 'schule'), 
			'menu_title' => 	esc_html__('Theme Plugins', 'schule'), 
			'return' => 		esc_html__('Return to Theme Required & Recommended Plugins', 'schule') 
		) 
	);
	
	
	tgmpa($plugins, $config);
}

}

add_action('tgmpa_register', 'schule_register_theme_plugins');

