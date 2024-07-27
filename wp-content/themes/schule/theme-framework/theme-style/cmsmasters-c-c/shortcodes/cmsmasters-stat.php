<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * Content Composer Stat Shortcode
 * Created by CMSMasters
 * 
 */


extract(shortcode_atts($new_atts, $atts));


$unique_id = $shortcode_id;


if ($this->stats_atts['stats_mode'] == 'bars') {
	$this->stats_atts['style_stats'] .= "\n" . '.cmsmasters_stats.shortcode_animated #cmsmasters_stat_' . esc_attr($unique_id) . '.cmsmasters_stat { ' . 
		"\n\t" . 'width:' . esc_attr($progress) . '%; ' . 
	"\n" . '} ' . "\n\n" . 
	'#cmsmasters_stat_' . esc_attr($unique_id) . ' .cmsmasters_stat_inner { ' . 
		(($color != '') ? "\n\t" . cmsmasters_color_css('background-color', $color) : '') . 
	"\n" . '} ' . "\n";
}


if ($this->stats_atts['stats_mode'] == 'circles') {
	$this->stats_atts['style_stats'] .= "\n" . '#cmsmasters_stat_' . esc_attr($unique_id) . ' .cmsmasters_stat_inner:before { ' . 
		(($color != '') ? "\n\t" . cmsmasters_color_css('color', $color) : '') . 
	"\n" . '} ' . "\n";
}


$out = '<div class="cmsmasters_stat_wrap' . (($this->stats_atts['stats_mode'] == 'circles') ? esc_attr($this->stats_atts['stats_count']) : '') . '">' . "\n" . 
	'<div id="cmsmasters_stat_' . esc_attr($unique_id) . '" class="cmsmasters_stat' . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	(($content == '' && $icon == '') ? ' stat_only_number' : '') . 
	(($content != '' && $icon != '') ? ' stat_has_titleicon' : '') . '"' . 
	' data-percent="' . esc_attr($progress) . '"' . 
	(($this->stats_atts['stats_mode'] == 'circles' && $color != '') ? ' data-bar-color="' . esc_attr($color) . '"' : '') . 
	'>' . "\n" . 
		'<div class="cmsmasters_stat_inner' . 
		(($icon != '') ? ' ' . esc_attr($icon) : '') . 
		'">' . "\n" . 
			(($content != '' && $this->stats_atts['stats_mode'] == 'bars') ? '<span class="cmsmasters_stat_title">' . esc_html($content) . '</span>' . "\n" : '') . 
			'<span class="cmsmasters_stat_counter_wrap">' . "\n" . 
				'<span class="cmsmasters_stat_counter">' . (($this->stats_atts['stats_mode'] == 'bars') ? esc_html($progress) : '0') . '</span>' . 
				'<span class="cmsmasters_stat_units">%</span>' . "\n" . 
			'</span>' . "\n" . 
		'</div>' . "\n" . 
	'</div>' . "\n" . 
	(($content != '' && $this->stats_atts['stats_mode'] == 'circles') ? '<span class="cmsmasters_stat_title">' . esc_html($content) . '</span>' . "\n" : '') . 
	(($subtitle != '') ? '<span class="cmsmasters_stat_subtitle">' . esc_html($subtitle) . '</span>' . "\n" : '') . 
'</div>';


echo schule_return_content($out);

