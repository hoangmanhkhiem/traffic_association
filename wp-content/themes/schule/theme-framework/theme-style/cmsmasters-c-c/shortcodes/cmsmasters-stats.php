<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * Content Composer Stats Shortcode
 * Created by CMSMasters
 * 
 */


extract(shortcode_atts($new_atts, $atts));


if ($mode == 'circles') {
	wp_enqueue_script('easePieChart');
}


$this->stats_atts = array(
	'style_stats' => 	'', 
	'stats_mode' => 	$mode, 
	'stats_type' => 	$type, 
	'stats_count' => 	'' 
);


if ($count == 5) {
	$this->stats_atts['stats_count'] = ' one_fifth';
} elseif ($count == 4) {
	$this->stats_atts['stats_count'] = ' one_fourth';
} elseif ($count == 3) {
	$this->stats_atts['stats_count'] = ' one_third';
} elseif ($count == 2) {
	$this->stats_atts['stats_count'] = ' one_half';
} else {
	$this->stats_atts['stats_count'] = ' one_first';
}


$stats = do_shortcode($content);


$shortcode_styles = (($this->stats_atts['style_stats'] != '') ? $this->stats_atts['style_stats'] : '');


$out = $this->cmsmasters_generate_front_css($shortcode_styles);


$out .= '<div class="cmsmasters_stats stats_mode_' . esc_attr($mode) . 
(($classes != '') ? ' ' . esc_attr($classes) : '') . 
'"' . 
(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
'>' . 
	$stats . 
'</div>';


echo schule_return_content($out);

