<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule Child
 * @version		1.0.0
 * 
 * Child Theme Functions File
 * Created by CMSMasters
 * 
 */


function schule_child_enqueue_styles() {
    wp_enqueue_style('schule-child-style', get_stylesheet_uri(), array(), '1.0.0', 'screen, print');
}

add_action('wp_enqueue_scripts', 'schule_child_enqueue_styles', 11);
?>