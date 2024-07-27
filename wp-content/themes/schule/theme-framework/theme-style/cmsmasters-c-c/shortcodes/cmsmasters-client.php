<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * Content Composer Client Shortcode
 * Created by CMSMasters
 * 
 */


extract(shortcode_atts($new_atts, $atts));


$counter = 0;

if ($content == null) {
	$content = esc_html__('Name', 'schule');
}


if ($logo != '') {
	$client_logo = wp_get_attachment_image_src(strstr($logo, '|', true), 'full');
	$client_logo_overlay = wp_get_attachment_image_src(strstr($logo_overlay, '|', true), 'full');
	
	$this->clients_atts['client_out'] .= '<div class="cmsmasters_clients_item item' . 
		($this->clients_atts['layout'] == 'slider' ? ' cmsmasters_owl_slider_item' : '') . 
		($classes != '' ? ' ' . esc_attr($classes) : '') . 
	'">' . 
		($link != '' ? '<a href="' . esc_url($link) . '"' . ($target == 'blank' ? ' target="_blank"' : '') . '>' : '') . 
			'<img src="' . esc_url($client_logo[0]) . '" alt="' . esc_attr($content) . '" title="' . esc_attr($content) . '" />' . 
			(($client_logo_overlay != '') ? '<span><img src="' .  esc_url($client_logo_overlay[0]) . '" alt="' . esc_attr($content) . '" title="' . esc_attr($content) . '" /></span>' : '') . 
		($link != '' ? '</a>' : '') . 
	'</div>';
}

