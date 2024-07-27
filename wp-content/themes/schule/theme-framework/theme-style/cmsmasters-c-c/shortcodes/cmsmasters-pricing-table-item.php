<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * Content Composer Pricing Table Shortcode
 * Created by CMSMasters
 * 
 */


extract(shortcode_atts($new_atts, $atts));


$unique_id = $shortcode_id;


if ($button_font_family != '') {
	$font_family_array = str_replace('+', ' ', explode(':', $button_font_family));
	
	$font_family_name = "'" . $font_family_array[0] . "'";
	
	$font_family_url = str_replace('+', ' ', $button_font_family);
	
	
	cmsmasters_theme_google_font($font_family_url, $font_family_array[0]);
}


if (
	$button_style != '' || 
	$button_font_family != '' || 
	$button_font_size != '' || 
	$button_line_height != '' || 
	$button_font_weight != '' || 
	$button_font_style != '' || 
	$button_padding_hor != '' || 
	$button_border_width != '' || 
	$button_border_style != '' || 
	$button_border_radius != '' || 
	$button_bg_color != '' || 
	$button_text_color != '' || 
	$button_border_color != '' || 
	$button_bg_color_h != '' || 
	$button_text_color_h != '' || 
	$button_border_color_h != '' 
) {
	$button_custom_styles = 'true';
} else {
	$button_custom_styles = 'false';
}


$feature_array = explode('||', $features);


if ($best == 'true') {
	if ($best_bg_color != '') {
		$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_pricing_item_inner { ' . 
			"\n\t" . cmsmasters_color_css('border-color', $best_bg_color) . 
		"\n" . '} ' . "\n";
	}
	
	
	if ($best_text_color != '') {
		$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_currency, ' . 
		'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_price, ' . 
		'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_coins, ' . 
		'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .feature_list li .feature_icon:before { ' . 
			"\n\t" . cmsmasters_color_css('color', $best_text_color) . 
		"\n" . '} ' . "\n";
	}
}


if ($button_show == 'true') {
	$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button:before { ' . 
		"\n\t" . 'margin-right:' . (($button_title != '') ? '.5em; ' : '0;') . 
		"\n\t" . 'margin-left:0; ' . 
		"\n\t" . 'vertical-align:baseline; ' . 
	"\n" . '} ' . "\n\n";
	
	if ($button_custom_styles == 'true') {
		$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button { ' . 
			(($button_font_family != '') ? "\n\t" . 'font-family:' . str_replace('+', ' ', $font_family_name) . '; ' : '') . 
			(($button_font_size != '') ? "\n\t" . 'font-size:' . esc_attr($button_font_size) . 'px; ' : '') . 
			(($button_line_height != '') ? "\n\t" . 'line-height:' . esc_attr($button_line_height) . 'px; ' : '') . 
			(($button_font_weight != '') ? "\n\t" . 'font-weight:' . esc_attr($button_font_weight) . '; ' : '') . 
			(($button_font_style != '') ? "\n\t" . 'font-style:' . esc_attr($button_font_style) . '; ' : '') . 
			(($button_padding_hor != '') ? "\n\t" . 'padding-right:' . esc_attr($button_padding_hor) . 'px; ' : '') . 
			(($button_padding_hor != '') ? "\n\t" . 'padding-left:' . esc_attr($button_padding_hor) . 'px; ' : '') . 
			(($button_border_width != '') ? "\n\t" . 'border-width:' . esc_attr($button_border_width) . 'px; ' : '') . 
			(($button_border_style != '') ? "\n\t" . 'border-style:' . esc_attr($button_border_style) . '; ' : '') . 
			(($button_border_radius != '') ? "\n\t" . '-webkit-border-radius:' . esc_attr($button_border_radius) . '; ' . "\n\t" . 'border-radius:' . esc_attr($button_border_radius) . '; ' : '') . 
			(($button_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color) : '') . 
			(($button_text_color != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color) : '') . 
			(($button_border_color != '') ? "\n\t" . cmsmasters_color_css('border-color', $button_border_color) : '') . 
		"\n" . '} ' . "\n";
		
		$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button:hover { ' . 
			(($button_bg_color_h != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color_h) : '') . 
			(($button_text_color_h != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color_h) : '') . 
			(($button_border_color_h != '') ? "\n\t" . cmsmasters_color_css('border-color', $button_border_color_h) : '') . 
		"\n" . '} ' . "\n";
	}
	
	
	if ($button_style != '') {
		if (
			$button_style == 'cmsmasters_but_bg_slide_left' || 
			$button_style == 'cmsmasters_but_bg_slide_right' || 
			$button_style == 'cmsmasters_but_bg_slide_top' || 
			$button_style == 'cmsmasters_but_bg_slide_bottom' || 
			$button_style == 'cmsmasters_but_bg_expand_vert' || 
			$button_style == 'cmsmasters_but_bg_expand_hor' || 
			$button_style == 'cmsmasters_but_bg_expand_diag' 
		) {
			if ($button_bg_color != '') {
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_left:hover, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_right:hover, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_top:hover, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_bottom:hover, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_vert:hover, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_hor:hover, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_diag:hover { ' . 
					"\n\t" . cmsmasters_color_css('background-color', $button_bg_color) . 
				"\n" . '} ' . "\n";
			}
			
			if ($button_bg_color_h != '') {
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_left:after, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_right:after, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_top:after, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_bottom:after, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_vert:after, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_hor:after, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_diag:after { ' . 
					"\n\t" . cmsmasters_color_css('background-color', $button_bg_color_h) . 
				"\n" . '} ' . "\n";
			}
		}
		
		
		if (
			$button_style == 'cmsmasters_but_icon_dark_bg' || 
			$button_style == 'cmsmasters_but_icon_light_bg' || 
			$button_style == 'cmsmasters_but_icon_divider' || 
			$button_style == 'cmsmasters_but_icon_inverse' 
		) {
			$but_icon_pad = ($button_padding_hor != '' ? $button_padding_hor : '20') + ($button_line_height != '' ? $button_line_height : '40');
			
			if ($button_padding_hor != '' || $button_line_height != '') {
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_dark_bg, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_light_bg, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider, ' .  
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse { ' . 
					"\n\t" . 'padding-left:' . esc_attr($but_icon_pad) . 'px; ' . 
				"\n" . '} ' . "\n";
				
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_dark_bg:before, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_light_bg:before, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:before, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:before, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_dark_bg:after, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_light_bg:after, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:after, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:after { ' . 
					"\n\t" . 'width:' . esc_attr($button_line_height) . 'px; ' . 
				"\n" . '} ' . "\n";
			}
			
			
			if ($button_border_color != '' || $button_border_color_h != '') {
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:after { ' . 
					"\n\t" . cmsmasters_color_css('border-color', $button_border_color) . 
				"\n" . '} ' . "\n";
				
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:hover:after { ' . 
					"\n\t" . cmsmasters_color_css('border-color', $button_border_color_h) . 
				"\n" . '} ' . "\n";
			}
			
			
			if ($button_style == 'cmsmasters_but_icon_inverse') {
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:before { ' . 
					(($button_text_color_h != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color_h) : '') . 
				"\n" . '} ' . "\n";
				
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:after { ' . 
					(($button_bg_color_h != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color_h) : '') . 
				"\n" . '} ' . "\n";
				
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:hover:before { ' . 
					(($button_text_color != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color) : '') . 
				"\n" . '} ' . "\n";
				
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:hover:after { ' . 
					(($button_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color) : '') . 
				"\n" . '} ' . "\n";
			}
		}
		
		
		if (
			$button_style == 'cmsmasters_but_icon_slide_left' || 
			$button_style == 'cmsmasters_but_icon_slide_right' 
		) {
			if ($button_padding_hor != '') {
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_left, ' . 
				'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_right { ' . 
					"\n\t" . 'padding-left:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
					"\n\t" . 'padding-right:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
				"\n" . '} ' . "\n";
				
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_left:before { ' . 
					"\n\t" . 'width:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
					"\n\t" . 'left:-' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
				"\n" . '} ' . "\n";
				
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_left:hover:before { ' . 
					"\n\t" . 'left:0; ' . 
				"\n" . '} ' . "\n";
				
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_right:before { ' . 
					"\n\t" . 'width:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
					"\n\t" . 'right:-' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
				"\n" . '} ' . "\n";
				
				$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_right:hover:before { ' . 
					"\n\t" . 'right:0; ' . 
				"\n" . '} ' . "\n";
			}
		}
	}
}


$price_out = '<div id="cmsmasters_pricing_item_' . esc_attr($unique_id) . '" class="cmsmasters_pricing_item' . 
(($best == 'true') ? ' pricing_best' : '') . 
(($classes != '') ? ' ' . esc_attr($classes) : '') . 
'"' . 
(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
'>' . "\n" . 
	'<div class="cmsmasters_pricing_item_inner">' . "\n" . 
		'<h2 class="pricing_title">' . esc_html($content) . '</h2>' . "\n";
		
		
		if (!empty($feature_array) && $feature_array[0] != '') {
			$price_out .= '<ul class="feature_list">' . "\n";
			
			
			foreach ($feature_array as $feature) { 
				$feature_atts = explode('|', $feature);
				
				
				$feature_atts = preg_replace('/^title\{([^\}]*)\}/','$1', $feature_atts);
				
				$feature_atts = preg_replace('/^link\{([^\}]*)\}/','$1', $feature_atts);
				
				$feature_atts = preg_replace('/^icon\{([^\}]*)\}/','$1', $feature_atts);
				
				$price_out .= '<li>' . 
				((isset($feature_atts[2]) && $feature_atts[2] != '') ? '<span class="feature_icon ' . esc_attr($feature_atts[2]) . '">' : '') . 
				((isset($feature_atts[1]) && $feature_atts[1] != '') ? '<a href="' . esc_url($feature_atts[1]) . '" class="feature_link">' : '') . 
				esc_html($feature_atts[0]) . 
				((isset($feature_atts[1]) && $feature_atts[1] != '') ? '</a>' : '') . 
				((isset($feature_atts[2]) && $feature_atts[2] != '') ? '</span>' : '') . 
				'</li>' . "\n";
			}
			
			
			$price_out .= '</ul>' . "\n";
		}
		
		
		$price_out .= '<div class="cmsmasters_price_wrap">' . "\n" . 
			'<span class="cmsmasters_currency">' . esc_html($currency) . '</span>' . "\n" . 
			'<span class="cmsmasters_price">' . esc_html($price) . '</span>' . "\n" . 
			(($coins != '') ? '<span class="cmsmasters_coins">.' . esc_html($coins) . '</span>' . "\n" : '') . 
			(($period != '') ? '<br /><span class="cmsmasters_period">' . esc_html($period) . '</span>' . "\n" : '') . 
		'</div>' . "\n";
		
		
		if ($button_show == 'true') {
			$price_out .= '<a href="' . esc_url($button_link) . '" class="cmsmasters_button' . 
			(($button_style != '') ? ' cmsmasters_but_clear_styles ' . esc_attr($button_style) : '') . 
			(($button_icon != '') ? ' ' . esc_attr($button_icon) : '') . 
			'"' . 
			(($button_target == 'blank') ? ' target="_blank"' : '') . 
			'><span>' . esc_html($button_title) . '</span></a>' . "\n";
		}
	
	$price_out .= '</div>' . "\n" . 
'</div>' . "\n";


echo schule_return_content($price_out);

