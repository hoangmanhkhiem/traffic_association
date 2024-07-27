<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.0
 * 
 * Theme Vars Functions
 * Created by CMSMasters
 * 
 */


/* Register CSS Styles */
function schule_vars_register_css_styles() {
	wp_enqueue_style('schule-theme-vars-style', get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/css/vars-style.css', array('schule-retina'), '1.0.0', 'screen, print');
}

//add_action('wp_enqueue_scripts', 'schule_vars_register_css_styles');

