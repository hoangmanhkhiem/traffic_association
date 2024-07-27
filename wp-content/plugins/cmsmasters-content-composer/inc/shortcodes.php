<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.5.4
 * 
 * CMSMasters Custom Shortcodes
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Shortcodes {

public function __construct() {
	add_shortcode('cmsmasters_row', array($this, 'cmsmasters_row'));
	
	add_shortcode('cmsmasters_column', array($this, 'cmsmasters_column'));
	
	add_shortcode('cmsmasters_text', array($this, 'cmsmasters_text'));
	
	add_shortcode('cmsmasters_notice', array($this, 'cmsmasters_notice'));
	
	add_shortcode('cmsmasters_icon_box', array($this, 'cmsmasters_icon_box'));
	
	add_shortcode('cmsmasters_featured_block', array($this, 'cmsmasters_featured_block'));
	
	add_shortcode('cmsmasters_heading', array($this, 'cmsmasters_custom_heading'));
	
	add_shortcode('cmsmasters_dropcap', array($this, 'cmsmasters_dropcap'));
	
	add_shortcode('cmsmasters_toggles', array($this, 'cmsmasters_toggles'));
	
	add_shortcode('cmsmasters_toggle', array($this, 'cmsmasters_toggle'));
	
	add_shortcode('cmsmasters_tabs', array($this, 'cmsmasters_tabs'));
	
	add_shortcode('cmsmasters_tab', array($this, 'cmsmasters_tab'));
	
	add_shortcode('cmsmasters_icon_list_items', array($this, 'cmsmasters_icon_list_items'));
	
	add_shortcode('cmsmasters_icon_list_item', array($this, 'cmsmasters_icon_list_item'));
	
	add_shortcode('cmsmasters_stats', array($this, 'cmsmasters_stats'));
	
	add_shortcode('cmsmasters_stat', array($this, 'cmsmasters_stat'));
	
	add_shortcode('cmsmasters_counters', array($this, 'cmsmasters_counters'));
	
	add_shortcode('cmsmasters_counter', array($this, 'cmsmasters_counter'));
	
	add_shortcode('cmsmasters_embed', array($this, 'cmsmasters_embed'));
	
	add_shortcode('cmsmasters_videos', array($this, 'cmsmasters_videos'));
	
	add_shortcode('cmsmasters_video_wrap', array($this, 'cmsmasters_video_wrap'));
	
	add_shortcode('cmsmasters_audios', array($this, 'cmsmasters_audios'));
	
	add_shortcode('cmsmasters_table', array($this, 'cmsmasters_table'));
	
	add_shortcode('cmsmasters_tr', array($this, 'cmsmasters_tr'));
	
	add_shortcode('cmsmasters_td', array($this, 'cmsmasters_td'));
	
	add_shortcode('cmsmasters_divider', array($this, 'cmsmasters_divider'));
	
	add_shortcode('cmsmasters_contact_form', array($this, 'cmsmasters_contact_form'));
	
	add_shortcode('cmsmasters_slider', array($this, 'cmsmasters_slider'));
	
	add_shortcode('cmsmasters_clients', array($this, 'cmsmasters_clients'));
	
	add_shortcode('cmsmasters_client', array($this, 'cmsmasters_client'));
	
	add_shortcode('cmsmasters_button', array($this, 'cmsmasters_button'));
	
	add_shortcode('cmsmasters_simple_icon', array($this, 'cmsmasters_simple_icon'));
	
	add_shortcode('cmsmasters_image', array($this, 'cmsmasters_image'));
	
	add_shortcode('cmsmasters_gallery', array($this, 'cmsmasters_gallery'));
	
	add_shortcode('cmsmasters_quotes', array($this, 'cmsmasters_quotes'));
	
	add_shortcode('cmsmasters_quote', array($this, 'cmsmasters_quote'));
	
	add_shortcode('cmsmasters_pricing_table_items', array($this, 'cmsmasters_pricing_table_items'));
	
	add_shortcode('cmsmasters_pricing_table_item', array($this, 'cmsmasters_pricing_table_item'));
	
	add_shortcode('cmsmasters_google_map_markers', array($this, 'cmsmasters_google_map_markers'));
	
	add_shortcode('cmsmasters_google_map_marker', array($this, 'cmsmasters_google_map_marker'));
	
	add_shortcode('cmsmasters_social', array($this, 'cmsmasters_social'));
	
	add_shortcode('cmsmasters_html', array($this, 'cmsmasters_html'));
	
	add_shortcode('cmsmasters_js', array($this, 'cmsmasters_js'));
	
	add_shortcode('cmsmasters_css', array($this, 'cmsmasters_css'));
	
	add_shortcode('cmsmasters_sidebar', array($this, 'cmsmasters_sidebar'));
	
	add_shortcode('cmsmasters_twitter', array($this, 'cmsmasters_twitter'));
	
	add_shortcode('cmsmasters_posts_slider', array($this, 'cmsmasters_posts_slider'));
	
	add_shortcode('cmsmasters_blog', array($this, 'cmsmasters_blog'));
	
	add_shortcode('cmsmasters_portfolio', array($this, 'cmsmasters_portfolio'));
	
	add_shortcode('cmsmasters_profiles', array($this, 'cmsmasters_profiles'));
	
	add_shortcode('cmsmasters_mailpoet', array($this, 'cmsmasters_mailpoet'));
	
	add_action('after_setup_theme', array($this, 'cmsmasters_add_custom_shortcodes'));
	
	
	add_action('save_post', array($this, 'cmsmasters_shortcodes_styles_save'));
	
	add_action('admin_init', array($this, 'cmsmasters_add_shortcodes_id'), 11);
}



public function cmsmasters_add_custom_shortcodes() {
	$cmsmasters_custom_shortcodes = array();
	
	$cmsmasters_custom_shortcodes = apply_filters('cmsmasters_custom_shortcodes_filter', $cmsmasters_custom_shortcodes);
	
	
	if (!empty($cmsmasters_custom_shortcodes)) {
		foreach ($cmsmasters_custom_shortcodes as $cmsmasters_custom_shortcode) {
			add_shortcode($cmsmasters_custom_shortcode, $cmsmasters_custom_shortcode);
		}
	}
}



public static function cmsmasters_generate_front_css($css) {
	return is_admin() ? "<style type=\"text/css\" data-type=\"cmsmasters_shortcodes-custom-css\">$css</style>" : '';
}



public function cmsmasters_shortcodes_styles_save($post_id) {
	$post_object = get_post($post_id);
	
	$style_content = '';
	
	$local_fonts_meta = '';
	
	
	remove_shortcode('tc_cart');
	remove_shortcode('tc_additional_fields');
	remove_shortcode('tc_additional_fields_edd');
	remove_shortcode('tc_process_payment');
	remove_shortcode('tc_ipn');
	remove_shortcode('tc_order_history');
	remove_shortcode('tc_payment');
	remove_shortcode('tc_order_confirmation');
	remove_shortcode('tc_order_details');
	remove_shortcode('ticket');
	remove_shortcode('tc_ticket');
	remove_shortcode('ticket_price');
	remove_shortcode('tc_ticket_price');
	remove_shortcode('tickets_sold');
	remove_shortcode('tickets_left');
	remove_shortcode('event');
	remove_shortcode('tc_event');
	remove_shortcode('event_tickets_sold');
	remove_shortcode('event_tickets_left');
	remove_shortcode('tc_event_date');
	remove_shortcode('tc_event_location');
	remove_shortcode('tc_event_terms');
	remove_shortcode('tc_event_sponsors_logo');
	remove_shortcode('tc_event_logo');
	
	
	preg_match_all("/(?<!['\"])<style.*?>([^`]*?)<\/style>/", do_shortcode($post_object->post_content), $new_content);
	
	
	foreach ($new_content[1] as $new_content_part) {
		$style_content .= $new_content_part;
	}
	
	
	if (empty($style_content)) {
		delete_post_meta($post_id, 'cmsmasters_shortcodes_custom_css');
	} else {
		update_post_meta($post_id, 'cmsmasters_shortcodes_custom_css', $style_content);
	}
	
	
	preg_match_all("/cmsmasters_local_font_start=(.*)=cmsmasters_local_font_end/", do_shortcode($post_object->post_content), $local_fonts);
	
	
	foreach ($local_fonts[1] as $local_fonts_part) {
		$local_fonts_meta .= $local_fonts_part . '|';
	}
	
	
	if (empty($local_fonts_meta)) {
		delete_post_meta($post_id, 'cmsmasters_shortcodes_local_fonts');
	} else {
		update_post_meta($post_id, 'cmsmasters_shortcodes_local_fonts', $local_fonts_meta);
	}
}



public function cmsmasters_add_shortcodes_id() {
	if (!get_option('cmsmasters_shortcodes_ids_generate')) {
		$post_types_args = array(
		  'public' => true
		);
		
		$post_types = get_post_types($post_types_args);
		
		$post_types_list = array();
		
		foreach ($post_types as $post_type => $name) {
			$post_types_list[] = $post_type;
		}
		
		
		$cmsmasters_query_args = array(
			'post_type' => $post_types_list, 
			'posts_per_page' => -1 
		);
		
		$cmsmasters_query = new WP_Query;
		
		$cmsmasters_posts = $cmsmasters_query->query($cmsmasters_query_args);
		
		
		foreach ($cmsmasters_posts as $cmsmasters_post) {
			$content_remove_id = preg_replace('/\s(?:data_)?shortcode_id="[^"\s]+"/i', '', $cmsmasters_post->post_content);
			
			$content_add_id = preg_replace_callback('/\[cmsmasters_([^\s\]]+)/i', array($this, 'cmsmasters_replacement_shortcodes_id'), $content_remove_id);
			
			
			$content = preg_replace('/\[cmsmasters_row\sshortcode_id=/i', '[cmsmasters_row data_shortcode_id=', $content_add_id);
			
			
			$content = preg_replace('/\[cmsmasters_column\sshortcode_id=/i', '[cmsmasters_column data_shortcode_id=', $content);
			
			
			$update_post_args = array(
				'ID' => $cmsmasters_post->ID, 
				'post_content' => $content 
			);
			
			
			wp_update_post($update_post_args);
		}
		
		
		foreach ($cmsmasters_posts as $cmsmasters_post) {
			$this->cmsmasters_shortcodes_styles_save($cmsmasters_post->ID);
		}
		
		
		add_option('cmsmasters_shortcodes_ids_generate', 'true');
	}
}



public function cmsmasters_replacement_shortcodes_id($matches) {
	return '[cmsmasters_' . $matches[1] . ' shortcode_id="' . bin2hex(random_bytes(5)) . '"';
}



/**
 * Section
 */
public function cmsmasters_row($atts, $content = null) {
	extract(shortcode_atts(array( 
		'data_shortcode_id' => 			'', 
		'data_color' => 				'default', 
		'data_bg_color' => 				'', 
		'data_bg_img' => 				'', 
		'data_bg_position' => 			'top center', 
		'data_bg_repeat' => 			'no-repeat', 
		'data_bg_attachment' => 		'scroll', 
		'data_bg_size' => 				'auto', 
		'data_bg_parallax' => 			'', 
		'data_bg_parallax_ratio' => 	'0.5', 
		'data_bg_img_adaptive' => 		'', 
		'data_bg_img_adaptive_divice' => '', 
		'data_color_overlay' => 		'', 
		'data_padding_top' => 			'', 
		'data_padding_bottom' => 		'', 
		'data_resp_vert_pad' => 		'', 
		'data_padding_top_large' => 	'', 
		'data_padding_bottom_large' => 	'', 
		'data_padding_top_laptop' => 	'', 
		'data_padding_bottom_laptop' => '', 
		'data_padding_top_tablet' => 	'', 
		'data_padding_bottom_tablet' => '', 
		'data_padding_top_mobile_h' => 	'', 
		'data_padding_bottom_mobile_h' => '', 
		'data_padding_top_mobile_v' => 	'', 
		'data_padding_bottom_mobile_v' => '', 
		'data_vert_margin' => 			'', 
		'data_margin_top' => 			'', 
		'data_margin_bottom' => 		'', 
		'data_margin_top_large' => 		'', 
		'data_margin_bottom_large' => 	'', 
		'data_margin_top_laptop' => 	'', 
		'data_margin_bottom_laptop' => 	'', 
		'data_margin_top_tablet' => 	'', 
		'data_margin_bottom_tablet' => 	'', 
		'data_margin_top_mobile_h' => 	'', 
		'data_margin_bottom_mobile_h' => '', 
		'data_margin_top_mobile_v' => 	'', 
		'data_margin_bottom_mobile_v' => '', 
		'data_width' => 				'boxed', 
		'data_padding_left' => 			'', 
		'data_padding_right' => 		'', 
		'data_no_margin' => 			'', 
		'data_merge' => 				'', 
		'data_columns_behavior' => 		'', 
		'data_top_style' => 			'default', 
		'data_bot_style' => 			'default', 
		'data_id' => 					'', 
		'data_classes' => 				'' 
	), $atts));
	
	
	global $prev_out;
	
	
	$unique_id = $data_shortcode_id;
	
	
	$out_style = '';
	
	
	$out_style_content = '';
	
	
	if ( 
		$data_bg_img != '' || 
		$data_bg_color != '' 
	) {
		$out_style .= '#cmsmasters_row_' . esc_attr($unique_id) . ' { ';
		
		
		if ($data_bg_color != '') {
			$out_style .= "\n\t" . cmsmasters_color_css('background-color', $data_bg_color);
		}
		
		
		if ($data_bg_img != '') {
			$new_bg_img = explode('|', $data_bg_img);
			
			
			$new_bg_src = wp_get_attachment_image_src($new_bg_img[0], 'full');
			
			
			$out_style .= "\n\t" . 'background-image: url(' . esc_url(($new_bg_src ? $new_bg_src[0] : '' )) . '); ' . 
			"\n\t" . 'background-position: ' . esc_attr($data_bg_position) . '; ' . 
			"\n\t" . 'background-repeat: ' . esc_attr($data_bg_repeat) . '; ' . 
			"\n\t" . 'background-attachment: ' . esc_attr($data_bg_attachment) . '; ' . 
			"\n\t" . 'background-size: ' . esc_attr($data_bg_size) . '; ' . 
			(($data_bg_attachment == 'fixed' && preg_match('/Safari/', $_SERVER['HTTP_USER_AGENT'])) ? "\n\t" . 'position: static; ' : '');
		}
		
		
		$out_style .= "\n" . '} ' . "\n\n";
	}
	
	
	if ( 
		$data_bg_img != '' && 
		$data_bg_img_adaptive != '' 
	) {
		$out_style .= "
		@media only screen and (max-width: " . $data_bg_img_adaptive_divice . "px) {
			#cmsmasters_row_" . esc_attr($unique_id) . ".cmsmasters_row {
				background-image: none;
			}
		}
		";
	}
	
	
	if ($data_padding_top != '') {
		$out_style .= '#cmsmasters_row_' . esc_attr($unique_id) . ' .cmsmasters_row_outer_parent { ' . 
			"\n\t" . 'padding-top: ' . esc_attr($data_padding_top) . 'px; ' . 
		"\n" . '} ' . "\n\n";
	}
	
	
	if ($data_padding_bottom != '') {
		$out_style .= '#cmsmasters_row_' . esc_attr($unique_id) . ' .cmsmasters_row_outer_parent { ' . 
			"\n\t" . 'padding-bottom: ' . esc_attr($data_padding_bottom) . 'px; ' . 
		"\n" . '} ' . "\n\n";
	}
	
	
	if ($data_resp_vert_pad == 'true') {
		if ($data_padding_top_large != '') {
			$custom_width = apply_filters('cmsmasters_responsive_large_dimension_filter', '1440');
			
			$out_style .= "
			@media only screen and (min-width: " . $custom_width . "px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-top: " . esc_attr($data_padding_top_large) . "px;
				}
			}
			";
		}
		
		if ($data_padding_bottom_large != '') {
			$custom_width = apply_filters('cmsmasters_responsive_large_dimension_filter', '1440');
			
			$out_style .= "
			@media only screen and (min-width: " . $custom_width . "px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-bottom: " . esc_attr($data_padding_bottom_large) . "px;
				}
			}
			";
		}
		
		if ($data_padding_top_laptop != '') {
			$out_style .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-top: " . esc_attr($data_padding_top_laptop) . "px;
				}
			}
			";
		}
		
		if ($data_padding_bottom_laptop != '') {
			$out_style .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-bottom: " . esc_attr($data_padding_bottom_laptop) . "px;
				}
			}
			";
		}
		
		if ($data_padding_top_tablet != '') {
			$out_style .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-top: " . esc_attr($data_padding_top_tablet) . "px;
				}
			}
			";
		}
		
		if ($data_padding_bottom_tablet != '') {
			$out_style .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-bottom: " . esc_attr($data_padding_bottom_tablet) . "px;
				}
			}
			";
		}
		
		if ($data_padding_top_mobile_h != '') {
			$out_style .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-top: " . esc_attr($data_padding_top_mobile_h) . "px;
				}
			}
			";
		}
		
		if ($data_padding_bottom_mobile_h != '') {
			$out_style .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-bottom: " . esc_attr($data_padding_bottom_mobile_h) . "px;
				}
			}
			";
		}
		
		if ($data_padding_top_mobile_v != '') {
			$out_style .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-top: " . esc_attr($data_padding_top_mobile_v) . "px;
				}
			}
			";
		}
		
		if ($data_padding_bottom_mobile_v != '') {
			$out_style .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " .cmsmasters_row_outer_parent {
					padding-bottom: " . esc_attr($data_padding_bottom_mobile_v) . "px;
				}
			}
			";
		}
	}
	
	
	if ($data_vert_margin == 'true') {
		if ($data_margin_top != '') {
			$out_style .= "
			#cmsmasters_row_" . esc_attr($unique_id) . " {
				margin-top: " . esc_attr($data_margin_top) . "px;
			}
			";
		}
		
		if ($data_margin_bottom != '') {
			$out_style .= "
			#cmsmasters_row_" . esc_attr($unique_id) . " {
				margin-bottom: " . esc_attr($data_margin_bottom) . "px;
			}
			";
		}
		
		if ($data_margin_top_large != '') {
			$custom_width = apply_filters('cmsmasters_responsive_large_dimension_filter', '1440');
			
			$out_style .= "
			@media only screen and (min-width: " . $custom_width . "px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($data_margin_top_large) . "px;
				}
			}
			";
		}
		
		if ($data_margin_bottom_large != '') {
			$custom_width = apply_filters('cmsmasters_responsive_large_dimension_filter', '1440');
			
			$out_style .= "
			@media only screen and (min-width: " . $custom_width . "px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($data_margin_bottom_large) . "px;
				}
			}
			";
		}
		
		if ($data_margin_top_laptop != '') {
			$out_style .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($data_margin_top_laptop) . "px;
				}
			}
			";
		}
		
		if ($data_margin_bottom_laptop != '') {
			$out_style .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($data_margin_bottom_laptop) . "px;
				}
			}
			";
		}
		
		if ($data_margin_top_tablet != '') {
			$out_style .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($data_margin_top_tablet) . "px;
				}
			}
			";
		}
		
		if ($data_margin_bottom_tablet != '') {
			$out_style .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($data_margin_bottom_tablet) . "px;
				}
			}
			";
		}
		
		if ($data_margin_top_mobile_h != '') {
			$out_style .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($data_margin_top_mobile_h) . "px;
				}
			}
			";
		}
		
		if ($data_margin_bottom_mobile_h != '') {
			$out_style .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($data_margin_bottom_mobile_h) . "px;
				}
			}
			";
		}
		
		if ($data_margin_top_mobile_v != '') {
			$out_style .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($data_margin_top_mobile_v) . "px;
				}
			}
			";
		}
		
		if ($data_margin_bottom_mobile_v != '') {
			$out_style .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_row_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($data_margin_bottom_mobile_v) . "px;
				}
			}
			";
		}
	}
	
	
	if ($data_color_overlay != '') {
		$out_style .= '#cmsmasters_row_' . esc_attr($unique_id) . ' .cmsmasters_row_overlay { ' .
			"\n\t" . cmsmasters_color_css('background-color', $data_color_overlay) . 
		"\n" . '} ' . "\n\n";
	}
	
	
	if ($data_width == 'fullwidth') {
		if ($data_padding_left != '') {
			$out_style_content .= '#cmsmasters_row_' . esc_attr($unique_id) . ' .cmsmasters_row_inner.cmsmasters_row_fullwidth { ' . 
				"\n\t" . 'padding-left:' . esc_attr($data_padding_left) . '%; ' . 
			"\n" . '} ' . "\n";
		}
		
		
		if ($data_padding_right != '') {
			$out_style_content .= '#cmsmasters_row_' . esc_attr($unique_id) . ' .cmsmasters_row_inner.cmsmasters_row_fullwidth { ' . 
				"\n\t" . 'padding-right:' . esc_attr($data_padding_right) . '%; ' . 
			"\n" . '} ' . "\n";
		}
	}
	
	
	if ($data_bg_color != '') {
		if (
			($data_top_style != '' && $data_top_style == 'zigzag') || 
			($data_bot_style != '' && $data_bot_style == 'zigzag')
		) {
			$out_style .= "
			#cmsmasters_row_" . esc_attr($unique_id) . ".cmsmasters_row_top_zigzag:before, 
			#cmsmasters_row_" . esc_attr($unique_id) . ".cmsmasters_row_bot_zigzag:after {
				background-image: -webkit-linear-gradient(135deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%), 
						-webkit-linear-gradient(45deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%);
				background-image: -moz-linear-gradient(135deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%), 
						-moz-linear-gradient(45deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%);
				background-image: -ms-linear-gradient(135deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%), 
						-ms-linear-gradient(45deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%);
				background-image: -o-linear-gradient(135deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%), 
						-o-linear-gradient(45deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%);
				background-image: linear-gradient(315deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%), 
						linear-gradient(45deg, " . esc_attr($data_bg_color) . " 25%, transparent 25%);
			}";
		}
	}
	
	
	$out_start = '<div id="cmsmasters_row_' . esc_attr($unique_id) . '" class="cmsmasters_row cmsmasters_color_scheme_' . esc_attr($data_color) . 
	(($data_classes != '') ? ' ' . esc_attr($data_classes) : '') . 
	($data_top_style != '' ? ' cmsmasters_row_top_' . esc_attr($data_top_style) : '') . 
	($data_bot_style != '' ? ' cmsmasters_row_bot_' . esc_attr($data_bot_style) : '');
	
		if ($data_width == 'fullwidth') {
			$out_start .= ' cmsmasters_row_fullwidth';
		} else {
			$out_start .= ' cmsmasters_row_boxed';
		}
		
	$out_start .= '"' . 
	(($data_bg_parallax != '') ? ' data-stellar-background-ratio="' . esc_attr($data_bg_parallax_ratio) . '"' : '') . 
	'>' . "\n" . 
		'<div' . 
		(($data_id != '') ? ' id="' . esc_attr($data_id) . '"' : '') . 
		' class="cmsmasters_row_outer_parent">' . "\n" . 
			(($data_color_overlay != '') ? '<div class="cmsmasters_row_overlay"></div>' . "\n" : '') . 
			'<div class="cmsmasters_row_outer">' . "\n";
	
	
	$out_content = $prev_out . 
		'<div class="cmsmasters_row_inner' . 
		(($data_width == 'fullwidth') ? ' cmsmasters_row_fullwidth' : '') . 
		(($data_no_margin == 'true') ? ' cmsmasters_row_no_margin' : '') . 
		'">' . "\n" . 
		'<div class="cmsmasters_row_margin' . 
		(($data_columns_behavior == 'true') ? ' cmsmasters_row_columns_behavior' : '') . 
		'">' . "\n" . 
			do_shortcode($content) . 
		'</div>' . "\n" . 
	'</div>' . "\n";
	
	
	$out_finish = '</div>' . "\n" . 
		'</div>' . "\n" . 
	'</div>' . "\n";
	
	
	$shortcode_styles = '';
	
	
	if ($out_style != '' || $out_style_content != '') {
		$shortcode_styles .= $out_style . $out_style_content;
	}
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= $out_start . $out_content . $out_finish;
	
	
	if ($data_merge == 'true') {
		$prev_out = ($out_style_content != '' ? $this->cmsmasters_generate_front_css($out_style_content) : '') . 
			$out_content;
	} else {
		$prev_out = '';
		
		
		return $out;
	}
}



/**
 * Column
 */
public function cmsmasters_column($atts, $content = null) {
	extract(shortcode_atts(array( 
		'data_shortcode_id' => 				'', 
		'data_padding' => 					'', 
		'data_resp_padding' => 				'', 
		'data_padding_large' => 			'', 
		'data_padding_laptop' => 			'', 
		'data_padding_tablet' => 			'', 
		'data_padding_mobile_h' => 			'', 
		'data_padding_mobile_v' => 			'', 
		'data_sticky' => 					'', 
		'data_bg_color' => 					'', 
		'data_bg_img' => 					'', 
		'data_bg_position' => 				'', 
		'data_bg_repeat' => 				'', 
		'data_bg_attachment' => 			'', 
		'data_bg_size' => 					'', 
		'data_bg_img_adaptive' => 			'', 
		'data_bg_img_adaptive_divice' => 	'', 
		'data_color_overlay' => 			'', 
		'data_border_width' => 				'', 
		'data_border_style' => 				'', 
		'data_border_color' => 				'', 
		'data_border_radius' => 			'', 
		'data_box_shadow' => 				'', 
		'data_width' => 					'1/1', 
		'data_animation' => 				'', 
		'data_animation_delay' => 			'', 
		'data_classes' => 					'' 
	), $atts));
	
	
	$unique_id = $data_shortcode_id;
	
	$shortcode_styles = "\n";
	
	
	if (
		$data_bg_color != '' || 
		$data_bg_img != '' || 
		$data_border_width != '' || 
		(
            $data_border_style != '' &&
            $data_border_style != 'default'
        ) || 
		$data_border_color != '' || 
		$data_border_radius != '' ||
		$data_box_shadow != ''
	) {
		$shortcode_styles .= '#cmsmasters_column_' . esc_attr($unique_id) . ' { ' . 
			(($data_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $data_bg_color) : '') . 
			(($data_border_width != '') ? "\n\t" . 'border-width:' . esc_attr($data_border_width) . 'px; ' : '') . 
			(($data_border_style != '' && $data_border_style != 'default') ? "\n\t" . 'border-style:' . esc_attr($data_border_style) . '; ' : '') . 
			(($data_border_color != '') ? "\n\t" . cmsmasters_color_css('border-color', $data_border_color) : '') . 
			(($data_border_radius != '') ? "\n\t" . '-webkit-border-radius:' . esc_attr($data_border_radius) . '; ' . "\n\t" . 'border-radius:' . esc_attr($data_border_radius) . '; overflow:hidden;' : '') . 
			(($data_box_shadow != '') ? "\n\t" . '-webkit-box-shadow:' . esc_attr($data_box_shadow) . '; ' . "\n\t" . '-moz-box-shadow:' . esc_attr($data_box_shadow) . '; ' . "\n\t" . 'box-shadow:' . esc_attr($data_box_shadow) . ';' : '');
			
			
			if ($data_bg_img != '') {
				$new_bg_img = explode('|', $data_bg_img);
				
				
				$new_bg_src = wp_get_attachment_image_src($new_bg_img[0], 'full');
				
				
				$shortcode_styles .= "\n\t" . 'background-image: url(' . esc_url($new_bg_src[0]) . '); ' . 
				"\n\t" . 'background-position: ' . esc_attr($data_bg_position) . '; ' . 
				"\n\t" . 'background-repeat: ' . esc_attr($data_bg_repeat) . '; ' . 
				"\n\t" . 'background-attachment: ' . esc_attr($data_bg_attachment) . '; ' . 
				"\n\t" . 'background-size: ' . esc_attr($data_bg_size) . '; ' . 
				(($data_bg_attachment == 'fixed' && preg_match('/Safari/', $_SERVER['HTTP_USER_AGENT'])) ? "\n\t" . 'position: static; ' : '');
			}
			
			
		$shortcode_styles .= "\n" . '} ' . "\n\n";
	}
	
	
	if ( 
		$data_bg_img != '' && 
		$data_bg_img_adaptive != '' 
	) {
		$shortcode_styles .= "
		@media only screen and (max-width: " . $data_bg_img_adaptive_divice . "px) {
			#cmsmasters_column_" . esc_attr($unique_id) . ".cmsmasters_column {
				background-image: none;
			}
		}
		";
	}
	
	
	if (
		$data_padding != '' || 
		$data_color_overlay != '' 
	) {
		$shortcode_styles .= '#cmsmasters_column_' . esc_attr($unique_id) . ' .cmsmasters_column_inner { ' . 
			(($data_padding != '') ? "\n\t" . 'padding: ' . esc_attr($data_padding) . '; ' : '') . 
			(($data_color_overlay != '') ? "\n\t" . cmsmasters_color_css('background-color', $data_color_overlay) : '') . 
		"\n" . '} ' . "\n\n";
	}
	
	
	if ($data_resp_padding == 'true') {
		if ($data_padding_large != '') {
			$custom_width = apply_filters('cmsmasters_responsive_large_dimension_filter', '1440');
			
			$shortcode_styles .= "
			@media only screen and (min-width: " . $custom_width . "px) {
				#cmsmasters_column_" . esc_attr($unique_id) . " .cmsmasters_column_inner {
					padding: " . esc_attr($data_padding_large) . ";
				}
			}
			";
		}
		
		if ($data_padding_laptop != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_column_" . esc_attr($unique_id) . " .cmsmasters_column_inner {
					padding: " . esc_attr($data_padding_laptop) . ";
				}
			}
			";
		}
		
		if ($data_padding_tablet != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_column_" . esc_attr($unique_id) . " .cmsmasters_column_inner {
					padding: " . esc_attr($data_padding_tablet) . ";
				}
			}
			";
		}
		
		if ($data_padding_mobile_h != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_column_" . esc_attr($unique_id) . " .cmsmasters_column_inner {
					padding: " . esc_attr($data_padding_mobile_h) . ";
				}
			}
			";
		}
		
		if ($data_padding_mobile_v != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_column_" . esc_attr($unique_id) . " .cmsmasters_column_inner {
					padding: " . esc_attr($data_padding_mobile_v) . ";
				}
			}
			";
		}
	}
	
	
	$new_width = '';
	
	
	if ($data_width == '1/1') {
		$new_width = 'one_first';
	} elseif ($data_width == '3/4') {
		$new_width = 'three_fourth';
	} elseif ($data_width == '2/3') {
		$new_width = 'two_third';
	} elseif ($data_width == '1/2') {
		$new_width = 'one_half';
	} elseif ($data_width == '1/3') {
		$new_width = 'one_third';
	} elseif ($data_width == '1/4') {
		$new_width = 'one_fourth';
	}
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
    $out .= cmsmasters_divpdel('<div id="cmsmasters_column_' . esc_attr($unique_id) . '" class="cmsmasters_column ' . esc_attr($new_width) . 
	(($data_sticky != '') ? ' cmsmasters_column_sticky' : '') . 
	(($data_classes != '') ? ' ' . esc_attr($data_classes) : '') . 
	'"' . 
	(($data_animation != '') ? ' data-animation="' . esc_attr($data_animation) . '"' : '') . 
	(($data_animation != '' && $data_animation_delay != '') ? ' data-delay="' . esc_attr($data_animation_delay) . '"' : '') . 
	'>' . "\n" . 
		'<div class="cmsmasters_column_inner">' . 
			do_shortcode(wpautop($content, false)) . 
		'</div>' . 
	'</div>' . "\n");
	
	
	return $out;
}



/**
 * Text Block
 */
public function cmsmasters_text($atts, $content = null) {
	extract(shortcode_atts(array( 
		'shortcode_id' => 		'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
	), $atts));
	
	
    return cmsmasters_divpdel('<div class="cmsmasters_text' . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		do_shortcode(wpautop($content)) . 
	'</div>' . "\n");
}



/**
 * Notice
 */
public function cmsmasters_notice($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_notice_atts_filter', array( 
		'shortcode_id' => 		'', 
		'type' => 				'cmsmasters_notice_success', 
		'icon' => 				'', 
		'close' => 				'', 
		'bg_color' => 			'', 
		'bd_color' => 			'', 
		'color' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
	) );
	
	
	$shortcode_name = 'notice';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	$shortcode_styles = '';
	
	
	if ($type == 'cmsmasters_notice_custom') {
		$shortcode_styles .= "\n" . 
			'#cmsmasters_notice_' . esc_attr($unique_id) . ' { ' . 
				"\n\t" . cmsmasters_color_css('background-color', $bg_color) . 
				"\n\t" . cmsmasters_color_css('border-color', $bd_color) . 
				"\n\t" . cmsmasters_color_css('color', $color) . 
			"\n" . '} ' . "\n" . 
			'#cmsmasters_notice_' . esc_attr($unique_id) . ':before {' . "\n" . 
				"\n\t" . cmsmasters_color_css('color', $bd_color) . 
			"\n" . '}' . 
		"\n";
	}
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
    $out .= '<div id="cmsmasters_notice_' . esc_attr($unique_id) . '" class="cmsmasters_notice ' . esc_attr($type) . 
	(($icon != '') ? ' ' . esc_attr($icon) : '') . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		(($close != '') ? '<a href="#" class="notice_close cmsmasters_theme_icon_cancel"></a>' : '') . 
		cmsmasters_divpdel('<div class="notice_content">' . "\n" . 
			do_shortcode(wpautop($content)) . 
		'</div>' . "\n") . 
	'</div>' . "\n";
	
	
	return $out;
}



/**
 * Icon Box
 */
public function cmsmasters_icon_box($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_icon_box_atts_filter', array( 
		'shortcode_id' => 				'', 
		'box_type' => 					'cmsmasters_icon_heading_left', 
		'title' => 						'', 
		'heading_type' => 				'h1', 
		'box_icon_type' => 				'icon', 
		'box_icon' => 					'cmsmasters-icon-heart-7', 
		'box_icon_number' => 			'1', 
		'box_icon_image' => 			'', 
		'box_icon_size' => 				'0', 
		'box_icon_space' => 			'50', 
		'box_icon_border_width' => 		'0', 
		'box_icon_border_radius' => 	'0', 
		'box_icon_color' => 			'', 
		'box_icon_bg_color' => 			'', 
		'box_icon_bd_color' => 			'', 
		'box_border_width' => 			'0', 
		'box_border_radius' => 			'0', 
		'box_color' => 					'', 
		'box_bg_color' => 				'', 
		'box_bd_color' => 				'', 
		'button_show' => 				'', 
		'button_title' => 				'', 
		'button_link' => 				'#', 
		'button_target' => 				'', 
		'button_style' => 				'', 
		'button_font_family' => 		'', 
		'button_font_size' => 			'', 
		'button_line_height' => 		'', 
		'button_font_weight' => 		'', 
		'button_font_style' => 			'', 
		'button_padding_hor' => 		'', 
		'button_border_width' => 		'', 
		'button_border_style' => 		'', 
		'button_border_radius' => 		'', 
		'button_bg_color' => 			'', 
		'button_text_color' => 			'', 
		'button_border_color' => 		'', 
		'button_bg_color_h' => 			'', 
		'button_text_color_h' => 		'', 
		'button_border_color_h' => 		'', 
		'button_icon' => 				'', 
		'animation' => 					'', 
		'animation_delay' => 			'', 
		'classes' => 					'' 
    ) );
	
	
	$shortcode_name = 'icon-box';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$local_fonts = '';
	
	if ($button_font_family != '') {
		$font_family_array = str_replace('+', ' ', explode(':', $button_font_family));
		
		
		if (is_numeric($font_family_array[0])) {
			$font_family_name = "'" . $font_family_array[1] . "'";
			
			if (is_admin()) {
				$local_fonts .= 'cmsmasters_local_font_start=' . $button_font_family . '=cmsmasters_local_font_end';
			}
		} else {
			$font_family_name = "'" . $font_family_array[0] . "'";
			
			cmsmasters_theme_font($button_font_family, $button_font_family);
		}
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
	
	
	$shortcode_styles = "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' { ' . 
			(($box_border_width != '') ? "\n\t" . 'border-width:' . esc_attr($box_border_width) . 'px; ' : '') . 
			(((int) $box_border_radius > 0) ? "\n\t" . '-webkit-border-radius:' . esc_attr($box_border_radius) . '; ' . "\n\t" . 'border-radius:' . esc_attr($box_border_radius) . '; ' : '') . 
			(($box_color != '') ? "\n\t" . cmsmasters_color_css('color', $box_color) : '') . 
			(($box_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $box_bg_color) : '') . 
			(($box_bd_color != '') ? "\n\t" . cmsmasters_color_css('border-color', $box_bd_color) : '') . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ':before, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .icon_box_heading:before { ' . 
			"\n\t" . 'font-size:' . esc_attr($box_icon_size) . 'px; ' . 
			"\n\t" . 'line-height:' . esc_attr(((int) $box_icon_space - ((int) $box_icon_border_width * 2))) . 'px; ' . 
			"\n\t" . 'width:' . esc_attr($box_icon_space) . 'px; ' . 
			"\n\t" . 'height:' . esc_attr($box_icon_space) . 'px; ' . 
			"\n\t" . 'border-width:' . esc_attr($box_icon_border_width) . 'px; ' . 
			(((int) $box_icon_border_radius > 0) ? "\n\t" . '-webkit-border-radius:' . esc_attr($box_icon_border_radius) . '; ' . "\n\t" . 'border-radius:' . esc_attr($box_icon_border_radius) . '; ' : '') . 
			(($box_icon_color != '') ? "\n\t" . cmsmasters_color_css('color', $box_icon_color) : '') . 
			(($box_icon_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $box_icon_bg_color) : '') . 
			(($box_icon_bd_color != '') ? "\n\t" . cmsmasters_color_css('border-color', $box_icon_bd_color) : '') . 
		"\n" . '} ' . "\n\n";
	
	
	if ( 
		$box_bg_color != '' || 
		( 
			$box_bd_color != '' && 
			((int) $box_border_width > 0) 
		) 
	) {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_heading_left, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_top, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left_top { ' . 
			"\n\t" . 'padding:30px 20px; ' . 
		'} ' . "\n\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_top:before { ' . 
			"\n\t" . 'top:30px;' . 
		'} ' . "\n\n";
	}
	
	
	if ($box_color != '') {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' a:not(.cmsmasters_button), ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' a:not(.cmsmasters_button):hover, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' h1, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' h2, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' h3, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' h4, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' h5, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' h6 { ' . 
			"\n\t" . cmsmasters_color_css('color', $box_color) . 
		'} ' . "\n\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' a:not(.cmsmasters_button) { ' . "\n" . 
			"\n\t" . 'text-decoration:underline;' . 
		'} ' . "\n\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' a:not(.cmsmasters_button):hover { ' . "\n" . 
			"\n\t" . 'text-decoration:none;' . 
		'} ' . "\n\n";
	}
	
	
	if ($box_type == 'cmsmasters_icon_top' || $box_type == 'cmsmasters_icon_box_top') {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' { ' . 
			"\n\t" . 'padding-top:' . esc_attr(((int) $box_icon_space + 30)) . 'px; ' . 
		'} ' . "\n\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ':before, ' . "\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .icon_box_heading:before { ' . 
			"\n\t" . 'margin-left:-' . esc_attr(((int) $box_icon_space / 2)) . 'px; ' . 
		"\n\t" . '} ' . "\n\n";
	}
	
	
	if ($box_type == 'cmsmasters_icon_top') {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_top { ' . 
			"\n\t" . 'padding-top:' . esc_attr(((int) $box_icon_space + 60)) . 'px; ' . 
		"\n\t" . '} ' . "\n\n";
	}
	
	
	if ($box_type == 'cmsmasters_icon_box_top') {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_top { ' . 
			"\n\t" . 'padding-top:' . esc_attr(((int) $box_icon_space - ((int) $box_icon_space / 2) + 30)) . 'px; ' . 
			"\n\t" . 'margin-top:' . esc_attr(((int) $box_icon_space / 2)) . 'px; ' . 
		"\n\t" . '} ' . "\n\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_top:before { ' . 
			"\n\t" . 'top:-' . esc_attr(((int) $box_icon_space / 2)) . 'px; ' . 
		"\n\t" . '} ' . "\n\n";
	}
	
	
	if ($box_type == 'cmsmasters_icon_box_left' || $box_type == 'cmsmasters_icon_box_left_top') {
		if (!is_rtl()) {
			$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left, ' . "\n" . 
			'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left_top { ' . 
				"\n\t" . 'padding-left:' . esc_attr(((int) $box_icon_space - ((int) $box_icon_space / 2) + 30)) . 'px; ' . 
				"\n\t" . 'margin-left:' . esc_attr(((int) $box_icon_space / 2)) . 'px; ' . 
			"\n\t" . '} ' . "\n\n" . 
			'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left:before, ' . "\n" . 
			'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left_top:before { ' . 
				"\n\t" . 'left:-' . esc_attr(((int) $box_icon_space / 2)) . 'px; ' . 
			"\n\t" . '} ' . "\n\n";
		} else {
			$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left, ' . "\n" . 
			'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left_top { ' . 
				"\n\t" . 'padding-right:' . esc_attr(((int) $box_icon_space - ((int) $box_icon_space / 2) + 30)) . 'px; ' . 
				"\n\t" . 'margin-right:' . esc_attr(((int) $box_icon_space / 2)) . 'px; ' . 
			"\n\t" . '} ' . "\n\n" . 
			'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left:before, ' . "\n" . 
			'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left_top:before { ' . 
				"\n\t" . 'right:-' . esc_attr(((int) $box_icon_space / 2)) . 'px; ' . 
			"\n\t" . '} ' . "\n\n";
		}
	}
	
	
	if ($box_type == 'cmsmasters_icon_box_left') {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left:before { ' . 
			"\n\t" . 'margin-top:-' . esc_attr(((int) $box_icon_space / 2)) . 'px; ' . 
		"\n\t" . '} ' . "\n\n";
	}
	
	
	if ($box_type == 'cmsmasters_icon_heading_left') {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_heading_left .icon_box_heading { ' . 
			"\n\t" . 'min-height:' . esc_attr($box_icon_space) . 'px; ' . 
			"\n\t" . 'padding-left:' . esc_attr(((int) $box_icon_space * 1.25)) . 'px; ' . 
		"\n\t" . '} ' . "\n\n";
	}

	
	if ( 
		$box_type == 'cmsmasters_icon_box_left_top' && 
		( 
			$box_bg_color != '' || 
			( 
				$box_bd_color != '' && 
				((int) $box_border_width > 0) 
			) 
		) 
	) {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left_top { ' . 
			"\n\t" . 'padding-top:' . esc_attr(((int) $box_icon_space - ((int) $box_icon_space / 2))) . 'px; ' . 
			"\n\t" . 'margin-top:' . esc_attr($box_icon_space) . 'px; ' . 
		"\n\t" . '} ' . "\n\n" . 
		'#cmsmasters_icon_box_' . esc_attr($unique_id) . '.cmsmasters_icon_box_left_top:before { ' . 
			"\n\t" . 'margin-top:-' . esc_attr(((int) $box_icon_space / 2)) . 'px; ' . 
		"\n\t" . '} ' . "\n\n";
	}
	
	
	if ($box_icon_type == 'image' && $box_icon_image != '') {
		$image_id = explode('|', $box_icon_image);
		
		
		if (is_numeric($image_id[0]) && is_array(wp_get_attachment_image_src($image_id[0], 'full'))) {
			$image_url_src = wp_get_attachment_image_src($image_id[0], 'full');
		
			$image_url = $image_url_src[0];
		} else if ($image_id[0] != '') {
			$image_url = $image_id[0];
		} else {
			$image_url = $image_id[1];
		}
		
		
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . (($box_type != 'cmsmasters_icon_heading_left') ? ':before' : '.cmsmasters_icon_heading_left .icon_box_heading:before') . ' { ' . 
			"\n\t" . 'background-image:url(' . esc_url($image_url) . '); ' . 
		"\n" . '} ' . "\n";
	}
	
	
	if ($box_icon_type == 'number') {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . (($box_type != 'cmsmasters_icon_heading_left') ? ':before' : '.cmsmasters_icon_heading_left .icon_box_heading:before') . ' { ' . 
			"\n\t" . "content:'" . esc_attr($box_icon_number) . "'; " . 
		"\n" . '} ' . "\n";
	}
	
	
	if ($button_show == 'true') {
		$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button:before { ' . 
			"\n\t" . 'margin-right:' . (($button_title != '') ? '.5em; ' : '0;') . 
			"\n\t" . 'margin-left:0; ' . 
			"\n\t" . 'vertical-align:baseline; ' . 
		"\n" . '} ' . "\n\n";
		
		
		if ($button_custom_styles == 'true') {
			$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button { ' . 
				(($button_font_family != '') ? "\n\t" . 'font-family:' . str_replace('+', ' ', $font_family_name) . '; ' : '') . 
				(($button_font_size != '') ? "\n\t" . 'font-size:' . esc_attr($button_font_size) . 'px; ' : '') . 
				(($button_line_height != '') ? "\n\t" . 'line-height:' . esc_attr($button_line_height) . 'px; ' : '') . 
				(($button_font_weight != '' && $button_font_weight != 'default') ? "\n\t" . 'font-weight:' . esc_attr($button_font_weight) . '; ' : '') . 
				(($button_font_style != '' && $button_font_style != 'default') ? "\n\t" . 'font-style:' . esc_attr($button_font_style) . '; ' : '') . 
				(($button_padding_hor != '') ? "\n\t" . 'padding-right:' . esc_attr($button_padding_hor) . 'px; ' : '') . 
				(($button_padding_hor != '') ? "\n\t" . 'padding-left:' . esc_attr($button_padding_hor) . 'px; ' : '') . 
				(($button_border_width != '') ? "\n\t" . 'border-width:' . esc_attr($button_border_width) . 'px; ' : '') . 
				(($button_border_style != '' && $button_border_style != 'default') ? "\n\t" . 'border-style:' . esc_attr($button_border_style) . '; ' : '') . 
				(($button_border_radius != '') ? "\n\t" . '-webkit-border-radius:' . esc_attr($button_border_radius) . '; ' . "\n\t" . 'border-radius:' . esc_attr($button_border_radius) . '; ' : '') . 
				(($button_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color) : '') . 
				(($button_text_color != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color) : '') . 
				(($button_border_color != '') ? "\n\t" . cmsmasters_color_css('border-color', $button_border_color) : '') . 
			"\n" . '} ' . "\n";
			
			$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button:hover { ' . 
				(($button_bg_color_h != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color_h) : '') . 
				(($button_text_color_h != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color_h) : '') . 
				(($button_border_color_h != '') ? "\n\t" . cmsmasters_color_css('border-color', $button_border_color_h) : '') . 
			"\n" . '} ' . "\n";
			
			
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
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_left:hover, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_right:hover, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_top:hover, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_bottom:hover, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_vert:hover, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_hor:hover, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_diag:hover { ' . 
							"\n\t" . cmsmasters_color_css('background-color', $button_bg_color) . 
						"\n" . '} ' . "\n";
					}
					
					if ($button_bg_color_h != '') {
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_left:after, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_right:after, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_top:after, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_bottom:after, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_vert:after, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_hor:after, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_diag:after { ' . 
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
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_dark_bg, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_light_bg, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider, ' .  
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse { ' . 
							"\n\t" . 'padding-left:' . esc_attr($but_icon_pad) . 'px; ' . 
						"\n" . '} ' . "\n";
						
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_dark_bg:before, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_light_bg:before, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:before, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:before, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_dark_bg:after, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_light_bg:after, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:after, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:after { ' . 
							"\n\t" . 'width:' . esc_attr($button_line_height) . 'px; ' . 
						"\n" . '} ' . "\n";
					}
					
					
					if ($button_border_color != '' || $button_border_color_h != '') {
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:after { ' . 
							"\n\t" . cmsmasters_color_css('border-color', $button_border_color) . 
						"\n" . '} ' . "\n";
						
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:hover:after { ' . 
							"\n\t" . cmsmasters_color_css('border-color', $button_border_color_h) . 
						"\n" . '} ' . "\n";
					}
					
					
					if ($button_style == 'cmsmasters_but_icon_inverse') {
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:before { ' . 
							(($button_text_color_h != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color_h) : '') . 
						"\n" . '} ' . "\n";
						
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:after { ' . 
							(($button_bg_color_h != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color_h) : '') . 
						"\n" . '} ' . "\n";
						
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:hover:before { ' . 
							(($button_text_color != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color) : '') . 
						"\n" . '} ' . "\n";
						
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:hover:after { ' . 
							(($button_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color) : '') . 
						"\n" . '} ' . "\n";
					}
				}
				
				
				if (
					$button_style == 'cmsmasters_but_icon_slide_left' || 
					$button_style == 'cmsmasters_but_icon_slide_right' 
				) {
					if ($button_padding_hor != '') {
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_left, ' . 
						'#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_right { ' . 
							"\n\t" . 'padding-left:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
							"\n\t" . 'padding-right:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
						"\n" . '} ' . "\n";
						
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_left:before { ' . 
							"\n\t" . 'width:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
							"\n\t" . 'left:-' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
						"\n" . '} ' . "\n";
						
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_left:hover:before { ' . 
							"\n\t" . 'left:0; ' . 
						"\n" . '} ' . "\n";
						
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_right:before { ' . 
							"\n\t" . 'width:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
							"\n\t" . 'right:-' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
						"\n" . '} ' . "\n";
						
						$shortcode_styles .= '#cmsmasters_icon_box_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_right:hover:before { ' . 
							"\n\t" . 'right:0; ' . 
						"\n" . '} ' . "\n";
					}
				}
			}
		}
	}
	
	
	$shortcode_styles .= "\n";
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= $local_fonts;
	
	
	$box_icon = ($box_icon_type == 'icon') ? $box_icon : '';
	
	
	$out .= '<div id="cmsmasters_icon_box_' . esc_attr($unique_id) . '" class="cmsmasters_icon_box ' . esc_attr($box_type) . ' box_icon_type_' . esc_attr($box_icon_type) . 
	(($box_type != 'cmsmasters_icon_heading_left') ? ' ' . esc_attr($box_icon) : '') . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		'<div class="icon_box_inner">' . "\n";
			
			
			if ($title != '') {
				$out .= '<' . esc_attr($heading_type) . ' class="icon_box_heading' . (($box_type == 'cmsmasters_icon_heading_left') ? ' ' . esc_attr($box_icon)  . '' : '') . '">' . esc_html($title) . '</' . esc_attr($heading_type) . '>' . "\n";
			}
			
			
			$out .= cmsmasters_divpdel('<div class="icon_box_text">' . "\n" . 
				do_shortcode(wpautop($content)) . 
			'</div>' . "\n");
			
			
			if ($button_show == 'true') {
				$out .= '<a href="' . esc_url($button_link) . '" class="cmsmasters_button icon_box_button' . 
				(($button_style != '') ? ' cmsmasters_but_clear_styles ' . esc_attr($button_style) : '') . 
				(($button_icon != '') ? ' ' . esc_attr($button_icon) : '') . 
				'"' . 
				(($button_target == 'blank') ? ' target="_blank"' : '') . 
				'><span>' . esc_html($button_title) . '</span></a>' . "\n";
			}
			
			
		$out .= '</div>' . "\n" . 
	'</div>' . "\n";
	
	
	return $out;
}



/**
 * Featured Block
 */
public function cmsmasters_featured_block($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_featured_block_atts_filter', array( 
		'shortcode_id' => 					'', 
		'text_width' => 					'100', 
		'text_position' => 					'center', 
		'text_padding' => 					'', 
		'resp_text_padding' => 				'', 
		'padding_text_large' => 			'', 
		'padding_text_laptop' => 			'', 
		'padding_text_tablet' => 			'', 
		'padding_text_mobile_h' => 			'', 
		'padding_text_mobile_v' => 			'', 
		'text_align' => 					'left', 
		'block_link' => 					'', 
		'block_link_target' => 				'', 
		'color_overlay' => 					'', 
		'fb_bg_color' => 					'', 
		'bg_img' => 						'', 
		'bg_position' => 					'', 
		'bg_repeat' => 						'', 
		'bg_attachment' => 					'', 
		'bg_size' => 						'', 
		'top_padding' => 					'', 
		'bottom_padding' => 				'', 
		'resp_vert_pad' => 					'', 
		'padding_top_large' => 				'', 
		'padding_bottom_large' => 			'',
		'text_width_large' =>               '',
		'padding_top_laptop' => 			'', 
		'padding_bottom_laptop' => 			'',
		'text_width_laptop' =>              '',
		'padding_top_tablet' => 			'', 
		'padding_bottom_tablet' => 			'',
		'text_width_tablet' =>              '',
		'padding_top_mobile_h' => 			'', 
		'padding_bottom_mobile_h' =>		'',
		'text_width_mobile_h' =>            '',
		'padding_top_mobile_v' => 			'', 
		'padding_bottom_mobile_v' => 		'',
		'text_width_mobile_v' =>            '',
		'border_width' => 					'', 
		'border_style' => 					'', 
		'border_color' => 					'', 
		'border_radius' => 					'', 
		'box_shadow' => 					'', 
		'animation' => 						'', 
		'animation_delay' => 				'', 
		'classes' => 						'' 
	) );
	
	
	$shortcode_name = 'featured-block';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	$shortcode_styles = "\n";
	
	
	if ( 
		$top_padding != '' || 
		$bottom_padding != '' || 
		$border_width != '' || 
		$border_style != '' || 
		$border_color != '' || 
		$border_radius != '' || 
		$box_shadow != '' ||
		$fb_bg_color != '' || 
		$bg_img != '' 
	) {
		$shortcode_styles .= '#cmsmasters_fb_' . esc_attr($unique_id) . ' { ' . 
			(($top_padding != '') ? "\n\t" . 'padding-top:' . esc_attr($top_padding) . 'px; ' : '') . 
			(($bottom_padding != '') ? "\n\t" . 'padding-bottom:' . esc_attr($bottom_padding) . 'px; ' : '') . 
			(($border_width != '') ? "\n\t" . 'border-width:' . esc_attr($border_width) . 'px; ' : '') . 
			(($border_style != '' && $border_style != 'default') ? "\n\t" . 'border-style:' . esc_attr($border_style) . '; ' : '') . 
			(($border_color != '') ? "\n\t" . cmsmasters_color_css('border-color', $border_color) : '') . 
			(($border_radius != '') ? "\n\t" . '-webkit-border-radius:' . esc_attr($border_radius) . '; ' . "\n\t" . 'border-radius:' . esc_attr($border_radius) . '; ' : '') . 
			(($box_shadow != '') ? "\n\t" . '-webkit-box-shadow:' . esc_attr($box_shadow) . '; ' . "\n\t" . '-moz-box-shadow:' . esc_attr($box_shadow) . '; ' . "\n\t" . 'box-shadow:' . esc_attr($box_shadow) . ';' : '') .
			(($fb_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $fb_bg_color) : '');
		
		
		if ($bg_img != '') {
			$new_bg_img = explode('|', $bg_img);
			
			
			$new_bg_src = wp_get_attachment_image_src($new_bg_img[0], 'full');
			
			
			$shortcode_styles .= "\n\t" . 'background-image: url(' . esc_url($new_bg_src[0]) . '); ' . 
			"\n\t" . 'background-position: ' . esc_attr($bg_position) . '; ' . 
			"\n\t" . 'background-repeat: ' . esc_attr($bg_repeat) . '; ' . 
			"\n\t" . 'background-attachment: ' . esc_attr($bg_attachment) . '; ' . 
			"\n\t" . 'background-size: ' . esc_attr($bg_size) . '; ' . 
			(($bg_attachment == 'fixed' && preg_match('/Safari/', $_SERVER['HTTP_USER_AGENT'])) ? "\n\t" . 'position: static; ' : '');
		}
		
		
		$shortcode_styles .= "\n" . '} ' . "\n\n";
	}
	
	
	$shortcode_styles .= '#cmsmasters_fb_' . esc_attr($unique_id) . ' .featured_block_inner { ' . 
			"\n\t" . 'width: ' . esc_attr($text_width) . '%; ' . 
			(($text_padding !='') ? "\n\t" . 'padding: ' . esc_attr($text_padding) . '; ' : '') . 
			"\n\t" . 'text-align: ' . esc_attr($text_align) . '; ' . 
			(($text_position == 'center') ? "\n\t" . 'margin:0 auto; ' : "\n\t" . 'float:' . esc_attr($text_position) . '; ') . 
			(($color_overlay != '') ? "\n\t" . cmsmasters_color_css('background-color', $color_overlay) : '') . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_fb_' . esc_attr($unique_id) . ' .featured_block_text { ' . 
			"\n\t" . 'text-align: ' . esc_attr($text_align) . '; ' . 
		"\n" . '} ' . "\n\n" . 
	"\n";
	
	
	if ($resp_text_padding == 'true') {
		if ($padding_text_large != '') {
			$shortcode_styles .= "
			@media only screen and (min-width: 1440px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					padding: " . esc_attr($padding_text_large) . ";
				}
			}
			";
		}
		
		if ($padding_text_laptop != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					padding: " . esc_attr($padding_text_laptop) . ";
				}
			}
			";
		}
		
		if ($padding_text_tablet != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					padding: " . esc_attr($padding_text_tablet) . ";
				}
			}
			";
		}
		
		if ($padding_text_mobile_h != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					padding: " . esc_attr($padding_text_mobile_h) . ";
				}
			}
			";
		}
		
		if ($padding_text_mobile_v != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					padding: " . esc_attr($padding_text_mobile_v) . ";
				}
			}
			";
		}
	}
	
	
	if ($resp_vert_pad == 'true') {
		if ($padding_top_large != '') {
			$shortcode_styles .= "
			@media only screen and (min-width: 1440px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-top: " . esc_attr($padding_top_large) . "px;
				}
			}
			";
		}
		
		if ($padding_bottom_large != '') {
			$shortcode_styles .= "
			@media only screen and (min-width: 1440px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-bottom: " . esc_attr($padding_bottom_large) . "px;
				}
			}
			";
		}

		if ($text_width_large != '') {
			$shortcode_styles .= "
			@media only screen and (min-width: 1440px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					width: " . esc_attr($text_width_large) . "%;
				}
			}
			";
		}
		
		if ($padding_top_laptop != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-top: " . esc_attr($padding_top_laptop) . "px;
				}
			}
			";
		}
		
		if ($padding_bottom_laptop != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-bottom: " . esc_attr($padding_bottom_laptop) . "px;
				}
			}
			";
		}

		if ($text_width_laptop != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					width: " . esc_attr($text_width_laptop) . "%;
				}
			}
			";
		}
		
		if ($padding_top_tablet != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-top: " . esc_attr($padding_top_tablet) . "px;
				}
			}
			";
		}
		
		if ($padding_bottom_tablet != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-bottom: " . esc_attr($padding_bottom_tablet) . "px;
				}
			}
			";
		}

		if ($text_width_tablet != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					width: " . esc_attr($text_width_tablet) . "%!important;
				}
			}
			";
		}
		
		if ($padding_top_mobile_h != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-top: " . esc_attr($padding_top_mobile_h) . "px;
				}
			}
			";
		}
		
		if ($padding_bottom_mobile_h != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-bottom: " . esc_attr($padding_bottom_mobile_h) . "px;
				}
			}
			";
		}

		if ($text_width_mobile_h != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					width: " . esc_attr($text_width_mobile_h) . "%!important;
				}
			}
			";
		}
		
		if ($padding_top_mobile_v != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-top: " . esc_attr($padding_top_mobile_v) . "px;
				}
			}
			";
		}
		
		if ($padding_bottom_mobile_v != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " {
					padding-bottom: " . esc_attr($padding_bottom_mobile_v) . "px;
				}
			}
			";
		}

		if ($text_width_mobile_v != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_fb_" . esc_attr($unique_id) . " .featured_block_inner {
					width: " . esc_attr($text_width_mobile_v) . "%!important;
				}
			}
			";
		}
	}
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= '<div id="cmsmasters_fb_' . esc_attr($unique_id) . '" class="cmsmasters_featured_block' . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		($block_link != '' ? '<a href="' . esc_url($block_link) . '" class="featured_block_link"' . ($block_link_target == 'blank' ? ' target="_blank"' : '') . '></a>' : '') . 
		'<div class="featured_block_inner">' . "\n" . 
			'<div class="featured_block_text">' . 
				cmsmasters_divpdel(do_shortcode(wpautop($content))) . 
			'</div>' . "\n" . 
		'</div>' . "\n" . 
	'</div>' . "\n";
	
	
	return $out;
}



/**
 * Special Heading
 */
public function cmsmasters_custom_heading($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_custom_heading_atts_filter', array( 
		'shortcode_id' => 			'', 
		'type' => 					'h2', 
		'font_family' => 			'', 
		'font_size' => 				'', 
		'line_height' => 			'', 
		'font_weight' => 			'default', 
		'font_style' => 			'default', 
		'icon' => 					'', 
		'text_align' => 			'left', 
		'color' => 					'', 
		'bg_color' => 				'', 
		'link' => 					'', 
		'target' => 				'', 
		'link_color_h' => 			'', 
		'margin_top' => 			'0', 
		'margin_bottom' => 			'0', 
		'resp_vert_mar' => 			'', 
		'margin_top_large' => 		'', 
		'margin_bottom_large' => 	'', 
		'margin_top_laptop' => 		'', 
		'margin_bottom_laptop' => 	'', 
		'margin_top_tablet' => 		'', 
		'margin_bottom_tablet' => 	'', 
		'margin_top_mobile_h' => 	'', 
		'margin_bottom_mobile_h' => '', 
		'margin_top_mobile_v' => 	'', 
		'margin_bottom_mobile_v' => '', 
		'border_radius' => 			'', 
		'divider' => 				'', 
		'divider_type' => 			'short', 
		'divider_height' => 		'1', 
		'divider_style' => 			'solid', 
		'divider_color' => 			'', 
		'underline' => 				'', 
		'underline_height' => 		'1', 
		'underline_style' => 		'solid', 
		'underline_color' => 		'', 
		'custom_check' =>  			'', 
		'width_monitor' =>  		'', // dont touch
		'custom_font_size' => 		'', // dont touch 
		'custom_line_height' => 	'', // dont touch
		'custom_size_responsive_1' => '', 
		'custom_size_responsive_2' => '', 
		'custom_size_responsive_3' => '', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
	) );
	
	
	$shortcode_name = 'custom-heading';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$local_fonts = '';
	
	if ($font_family != '') {
		$font_family_array = str_replace('+', ' ', explode(':', $font_family));
		
		
		if (is_numeric($font_family_array[0])) {
			$font_family_name = "'" . $font_family_array[1] . "'";
			
			if (is_admin()) {
				$local_fonts .= 'cmsmasters_local_font_start=' . $font_family . '=cmsmasters_local_font_end';
			}
		} else {
			$font_family_name = "'" . $font_family_array[0] . "'";
			
			cmsmasters_theme_font($font_family, $font_family);
		}
	}
	
	
	$shortcode_styles = "\n" . 
		'#cmsmasters_heading_' . esc_attr($unique_id) . ' { ' . 
			"\n\t" . 'text-align:' . esc_attr($text_align) . '; ' . 
			"\n\t" . 'margin-top:' . esc_attr($margin_top) . 'px; ' . 
			"\n\t" . 'margin-bottom:' . esc_attr($margin_bottom) . 'px; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_heading_' . esc_attr($unique_id) . ' .cmsmasters_heading { ' . 
			"\n\t" . 'text-align:' . esc_attr($text_align) . '; ' . 
			(($bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $bg_color) : '') . 
			(($bg_color != '') ? "\n\t" . 'padding-left:1em; ' : '') . 
			(($bg_color != '') ? "\n\t" . 'padding-right:1em; ' : '') . 
			(($divider != '' && $text_align != 'left') ? "\n\t" . 'margin-left:1em; ' : '') . 
			(($divider != '' && $text_align != 'right') ? "\n\t" . 'margin-right:1em; ' : '') . 
			(($border_radius != '') ? "\n\t" . '-webkit-border-radius:' . esc_attr($border_radius) . '; ' . "\n\t" . 'border-radius:' . esc_attr($border_radius) . '; ' : '') . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_heading_' . esc_attr($unique_id) . ' .cmsmasters_heading, ' . 
		'#cmsmasters_heading_' . esc_attr($unique_id) . ' .cmsmasters_heading a { ' . 
			(($font_family != '') ? "\n\t" . 'font-family:' . $font_family_name . '; ' : '') . 
			(($font_size != '' && $font_size != '0') ? "\n\t" . 'font-size:' . esc_attr($font_size) . 'px; ' : '') . 
			(($line_height != '' && $line_height != '0') ? "\n\t" . 'line-height:' . esc_attr($line_height) . 'px; ' : '') . 
			(($font_weight != 'default') ? "\n\t" . 'font-weight:' . esc_attr($font_weight) . '; ' : '') . 
			(($font_style != 'default') ? "\n\t" . 'font-style:' . esc_attr($font_style) . '; ' : '') . 
			(($color != '') ? "\n\t" . cmsmasters_color_css('color', $color) : '') . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_heading_' . esc_attr($unique_id) . ' .cmsmasters_heading a:hover { ' . 
			(($link_color_h != '') ? "\n\t" . cmsmasters_color_css('color', $link_color_h) : '') . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_heading_' . esc_attr($unique_id) . ' .cmsmasters_heading_divider { ' . 
			(($divider != '') ? "\n\t" . 'border-bottom-width:' . esc_attr($divider_height) . 'px; ' : '') . 
			(($divider != '') ? "\n\t" . 'border-bottom-style:' . esc_attr($divider_style) . '; ' : '') . 
			(($divider != '' && $divider_color != '') ? "\n\t" . cmsmasters_color_css('border-bottom-color', $divider_color) : '') . 
			(($divider != '') ? "\n\t" . 'margin-top:-' . esc_attr(round((int) $divider_height / 2)) . 'px; ' : '') . 
		"\n" . '} ' . "\n\n";
		
		
		if ($underline != '') {
			$shortcode_styles .= '#cmsmasters_heading_' . esc_attr($unique_id) . ' .cmsmasters_heading { ' . 
				"\n\t" . 'text-decoration:none; ' . 
				"\n\t" . 'border-bottom-width:' . esc_attr($underline_height) . 'px; ' . 
				"\n\t" . 'border-bottom-style:' . esc_attr($underline_style) . '; ' . 
				($underline_color != '' ? "\n\t" . cmsmasters_color_css('border-bottom-color', $underline_color) : '') . 
			"\n" . '} ' . "\n\n";
		}
		
		
		if ($custom_check != '') {
			if ($custom_size_responsive_1 != '') {
				$custom_size_responsive_1 = explode('|', $custom_size_responsive_1);
				
				$custom_size_responsive_1_width = $custom_size_responsive_1[0];
				$custom_size_responsive_1_fs = $custom_size_responsive_1[1];
				$custom_size_responsive_1_lh = $custom_size_responsive_1[2];
				
				
				if ($custom_size_responsive_1_width != '') {
					$shortcode_styles .= "@media (max-width: " . esc_attr($custom_size_responsive_1_width) . "px) {
						#cmsmasters_heading_" . esc_attr($unique_id) . " .cmsmasters_heading, 
						#cmsmasters_heading_" . esc_attr($unique_id) . " .cmsmasters_heading a { " . 
							(($custom_size_responsive_1_fs != '' && $custom_size_responsive_1_fs != '0') ? "font-size:" . esc_attr($custom_size_responsive_1_fs) . "px;" : "") . 
							(($custom_size_responsive_1_lh != '' && $custom_size_responsive_1_lh != '0') ? "line-height:" . esc_attr($custom_size_responsive_1_lh) . "px;" : "") . 
						"}
					}";
				}
			}
			
			
			if ($custom_size_responsive_2 != '') {
				$custom_size_responsive_2 = explode('|', $custom_size_responsive_2);
				
				$custom_size_responsive_2_width = $custom_size_responsive_2[0];
				$custom_size_responsive_2_fs = $custom_size_responsive_2[1];
				$custom_size_responsive_2_lh = $custom_size_responsive_2[2];
				
				
				if ($custom_size_responsive_2_width != '') {
					$shortcode_styles .= "@media (max-width: " . esc_attr($custom_size_responsive_2_width) . "px) {
						#cmsmasters_heading_" . esc_attr($unique_id) . " .cmsmasters_heading, 
						#cmsmasters_heading_" . esc_attr($unique_id) . " .cmsmasters_heading a { " . 
							(($custom_size_responsive_2_fs != '' && $custom_size_responsive_2_fs != '0') ? "font-size:" . esc_attr($custom_size_responsive_2_fs) . "px;" : "") . 
							(($custom_size_responsive_2_lh != '' && $custom_size_responsive_2_lh != '0') ? "line-height:" . esc_attr($custom_size_responsive_2_lh) . "px;" : "") . 
						"}
					}";
				}
			}
			
			
			if ($custom_size_responsive_3 != '') {
				$custom_size_responsive_3 = explode('|', $custom_size_responsive_3);
				
				$custom_size_responsive_3_width = $custom_size_responsive_3[0];
				$custom_size_responsive_3_fs = $custom_size_responsive_3[1];
				$custom_size_responsive_3_lh = $custom_size_responsive_3[2];
				
				
				if ($custom_size_responsive_3_width != '') {
					$shortcode_styles .= "@media (max-width: " . esc_attr($custom_size_responsive_3_width) . "px) {
						#cmsmasters_heading_" . esc_attr($unique_id) . " .cmsmasters_heading, 
						#cmsmasters_heading_" . esc_attr($unique_id) . " .cmsmasters_heading a { " . 
							(($custom_size_responsive_3_fs != '' && $custom_size_responsive_3_fs != '0') ? "font-size:" . esc_attr($custom_size_responsive_3_fs) . "px;" : "") . 
							(($custom_size_responsive_3_lh != '' && $custom_size_responsive_3_lh != '0') ? "line-height:" . esc_attr($custom_size_responsive_3_lh) . "px;" : "") . 
						"}
					}";
				}
			}
			
			// dont touch start
			if ($width_monitor != '') {
				$shortcode_styles .= '@media (max-width: ' . esc_attr($width_monitor) . 'px) {' . "\n\n" . 
					'#cmsmasters_heading_' . esc_attr($unique_id) . ' .cmsmasters_heading, ' . 
					'#cmsmasters_heading_' . esc_attr($unique_id) . ' .cmsmasters_heading a { ' . 
						(($custom_font_size != '' && $custom_font_size != '0') ? "\n\t" . 'font-size:' . esc_attr($custom_font_size) . 'px; ' : '') . 
						(($custom_line_height != '' && $custom_line_height != '0') ? "\n\t" . 'line-height:' . esc_attr($custom_line_height) . 'px; ' : '') . 
					"\n" . '} ' . "\n" . 
				"\n" . '} ' . "\n\n";
			}
			// dont touch end
		}
		
		
		if ($resp_vert_mar == 'true') {
			if ($margin_top_large != '') {
				$shortcode_styles .= "
				@media only screen and (min-width: 1440px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-top: " . esc_attr($margin_top_large) . "px;
					}
				}
				";
			}
			
			if ($margin_bottom_large != '') {
				$shortcode_styles .= "
				@media only screen and (min-width: 1440px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-bottom: " . esc_attr($margin_bottom_large) . "px;
					}
				}
				";
			}
			
			if ($margin_top_laptop != '') {
				$shortcode_styles .= "
				@media only screen and (max-width: 1024px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-top: " . esc_attr($margin_top_laptop) . "px;
					}
				}
				";
			}
			
			if ($margin_bottom_laptop != '') {
				$shortcode_styles .= "
				@media only screen and (max-width: 1024px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-bottom: " . esc_attr($margin_bottom_laptop) . "px;
					}
				}
				";
			}
			
			if ($margin_top_tablet != '') {
				$shortcode_styles .= "
				@media only screen and (max-width: 768px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-top: " . esc_attr($margin_top_tablet) . "px;
					}
				}
				";
			}
			
			if ($margin_bottom_tablet != '') {
				$shortcode_styles .= "
				@media only screen and (max-width: 768px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-bottom: " . esc_attr($margin_bottom_tablet) . "px;
					}
				}
				";
			}
			
			if ($margin_top_mobile_h != '') {
				$shortcode_styles .= "
				@media only screen and (max-width: 540px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-top: " . esc_attr($margin_top_mobile_h) . "px;
					}
				}
				";
			}
			
			if ($margin_bottom_mobile_h != '') {
				$shortcode_styles .= "
				@media only screen and (max-width: 540px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-bottom: " . esc_attr($margin_bottom_mobile_h) . "px;
					}
				}
				";
			}
			
			if ($margin_top_mobile_v != '') {
				$shortcode_styles .= "
				@media only screen and (max-width: 320px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-top: " . esc_attr($margin_top_mobile_v) . "px;
					}
				}
				";
			}
			
			if ($margin_bottom_mobile_v != '') {
				$shortcode_styles .= "
				@media only screen and (max-width: 320px) {
					#cmsmasters_heading_" . esc_attr($unique_id) . " {
						margin-bottom: " . esc_attr($margin_bottom_mobile_v) . "px;
					}
				}
				";
			}
		}
		
		
	$shortcode_styles .= "\n";
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= $local_fonts;
	
	
	$out .= '<div id="cmsmasters_heading_' . esc_attr($unique_id) . '" class="cmsmasters_heading_wrap cmsmasters_heading_align_' . esc_attr($text_align) . 
	(($divider != '') ? ' cmsmasters_heading_divider_' . esc_attr($divider_type) : '') . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n\t";
	
	
	if ($divider != '' && $text_align != 'left') {
		$out .= '<span class="cmsmasters_heading_divider_left_wrap"><span class="cmsmasters_heading_divider cmsmasters_heading_divider_left"></span></span>' . "\n";
	}
	
	
	$out .= '<' . esc_attr($type) . ' class="cmsmasters_heading' . 
	(($icon != '' && $link == '') ? ' ' . esc_attr($icon) : '') . 
	'">';
	
	
	if ($link != '') {
		$out .= '<a href="' . esc_url($link) . '"' . 
		(($icon != '') ? ' class="' . esc_attr($icon) . '"' : '') . 
		(($target == 'blank') ? ' target="_blank"' : '') . 
		'>';
	}
	
	
	$out .= $content;
	
	
	if ($link != '') {
		$out .= '</a>';
	}
	
	
	$out .= '</' . esc_attr($type) . '>' . "\n";
	
	
	if ($divider != '' && $text_align != 'right') {
		$out .= '<span class="cmsmasters_heading_divider_right_wrap"><span class="cmsmasters_heading_divider cmsmasters_heading_divider_right"></span></span>' . "\n";
	}
	
	
	$out .= '</div>';
	
	
	return $out;
}



/**
 * Dropcap
 */
public function cmsmasters_dropcap($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_dropcap_atts_filter', array( 
		'shortcode_id' => 	'', 
		'type' => 			'type1', 
		'classes' => 		'' 
	) );
	
	
	$shortcode_name = 'dropcap';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$out = '<div class="cmsmasters_dropcap ' . esc_attr($type) . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'">' . $content . '</div>';
	
	
	return $out;
}



/**
 * Toggles
 */
public $toggles_atts;

public function cmsmasters_toggles($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_toggles_atts_filter', array( 
		'shortcode_id' => 		'', 
		'mode' => 				'toggle', 
		'active' => 			'', 
		'sort' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'toggles';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$this->toggles_atts = array(
		'sort_toggles' => 		array(), 
		'toggle_active' => 		(int) $active, 
		'toggle_counter' => 	0 
	);
	
	
	$toggles_filter = '';
	
	$toggles = do_shortcode($content);
	
	
	if ($sort == 'true') {
		$toggles_filter = '<div class="cmsmasters_toggles_filter">' . "\n\t" . 
			'<a href="#" data-key="all" title="' . esc_attr__('All', 'cmsmasters-content-composer') . '" class="current_filter">' . esc_html__('All', 'cmsmasters-content-composer') . '</a>' . "\n";
		
		foreach ($this->toggles_atts['sort_toggles'] as $sort_toggle_key => $sort_toggle_value) {
			$toggles_filter .= "\t" . ' / <a href="#" data-key="' . esc_attr($sort_toggle_key) . '" title="' . esc_attr($sort_toggle_value) . '">' . esc_html($sort_toggle_value) . '</a>' . "\n";
		}
		
		$toggles_filter .= '</div>';
	}
	
	
	return '<div class="cmsmasters_toggles toggles_mode_' . esc_attr($mode) . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . 
		$toggles_filter . "\n" . 
		$toggles . 
	'</div>';
}

/**
 * Single Toggle
 */
public function cmsmasters_toggle($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_toggle_atts_filter', array( 
		'shortcode_id' => 	'', 
		'title' => 			esc_html__('Title', 'cmsmasters-content-composer'), 
		'tags' => 			'', 
		'classes' => 		'' 
    ) );
	
	
	$shortcode_name = 'toggle';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$this->toggles_atts['toggle_counter']++;
	
	
	$toggle_tags = explode(',', $tags);
	
	
	foreach ($toggle_tags as $toggle_tag) {
		if ($toggle_tag != '') {
			$this->toggles_atts['sort_toggles'][generateSlug(trim($toggle_tag), 30)] = trim($toggle_tag);
		}
	}
	
	
	$out = '<div class="cmsmasters_toggle_wrap' . 
	(($this->toggles_atts['toggle_active'] == $this->toggles_atts['toggle_counter']) ? ' current_toggle' : '') . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'" data-tags="all ';
	
	
	$tgl_tag_str = '';
	
	
	foreach ($toggle_tags as $tgl_tag) {
		$tgl_tag_str .= generateSlug(trim($tgl_tag), 30) . ' ';
	}
	
	
	$out .= substr($tgl_tag_str, 0, strlen($tgl_tag_str) - 1);
	
	
	$out .= '">' . "\n" . 
		'<div class="cmsmasters_toggle_title">' . "\n" . 
			'<span class="cmsmasters_toggle_plus">' . "\n" . 
				'<span class="cmsmasters_toggle_plus_hor"></span>' . "\n" . 
				'<span class="cmsmasters_toggle_plus_vert"></span>' . "\n" . 
			'</span>' . "\n" . 
			'<a href="#">' . esc_html($title) . '</a>' . "\n" . 
		'</div>' . "\n" . 
		'<div class="cmsmasters_toggle">' . "\n" . 
			cmsmasters_divpdel('<div class="cmsmasters_toggle_inner">' . "\n" . 
				do_shortcode(wpautop($content)) . 
			'</div>' . "\n") . 
		'</div>' . "\n" . 
	'</div>';
	
	
	return $out;
}



/**
 * Tabs
 */
public $tabs_atts;

public function cmsmasters_tabs($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_tabs_atts_filter', array( 
		'shortcode_id' => 		'', 
		'mode' => 				'tab', 
		'position' => 			'left', 
		'active' => 			'1', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'tabs';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$this->tabs_atts = array(
		'style_tab' => 		'', 
		'out_tabs' => 		'', 
		'tabs_mode' => 		$mode, 
		'tab_active' => 	(int) $active, 
		'tab_counter' => 	0 
	);
	
	
	$tabs = do_shortcode($content);
	
	
	$shortcode_styles = (($this->tabs_atts['style_tab'] != '') ? $this->tabs_atts['style_tab'] : '');
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= '<div class="cmsmasters_tabs tabs_mode_' . esc_attr($mode) . 
	(($mode == 'tour') ? ' ' . 'tabs_pos_' . esc_attr($position) : '') . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		'<ul class="cmsmasters_tabs_list">' . "\n" . 
			$this->tabs_atts['out_tabs'] . 
		'</ul>' . "\n" . 
		'<div class="cmsmasters_tabs_wrap">' . "\n" . 
			$tabs . 
		'</div>' . "\n" . 
	'</div>';
	
	
	return $out;
}

/**
 * Single Tab
 */
public function cmsmasters_tab($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_tab_atts_filter', array( 
		'shortcode_id' => 	'', 
		'title' => 			esc_html__('Title', 'cmsmasters-content-composer'), 
		'custom_colors' => 	'', 
		'bg_color' => 		'', 
		'icon' => 			'', 
		'classes' => 		'' 
    ) );
	
	
	$shortcode_name = 'tab';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->tabs_atts['tab_counter']++;
	
	if ($custom_colors == 'true') { 
		$this->tabs_atts['style_tab'] .= "\n" . '#cmsmasters_tabs_list_item_' . esc_attr($unique_id) . ' a:hover,' . 
		'#cmsmasters_tabs_list_item_' . esc_attr($unique_id) . '.current_tab a { ' . 
			"\n\t" . cmsmasters_color_css('background-color', $bg_color) . 
			"\n\t" . cmsmasters_color_css('border-color', $bg_color) . 
		"\n" . '} ' . "\n";
	}
	
	
	$this->tabs_atts['out_tabs'] .= '<li id="cmsmasters_tabs_list_item_' . esc_attr($unique_id) . '" class="cmsmasters_tabs_list_item' . 
	(($this->tabs_atts['tab_active'] == $this->tabs_atts['tab_counter']) ? ' current_tab' : '') . 
	'">' . "\n" . 
		'<a href="#"' . 
		(($icon != '') ? ' class="' . esc_attr($icon) . '"' : '') . 
		'>' . "\n" . 
			'<span>' . esc_html($title) . '</span>' . "\n" . 
		'</a>' . "\n" . 
	'</li>';
	
	
	return '<div id="cmsmasters_tab_' . esc_attr($unique_id) . '" class="cmsmasters_tab' . 
	(($this->tabs_atts['tab_active'] == $this->tabs_atts['tab_counter']) ? ' active_tab' : '') . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'">' . "\n" . 
		cmsmasters_divpdel('<div class="cmsmasters_tab_inner">' . "\n" . 
			do_shortcode(wpautop($content)) . 
		'</div>' . "\n") . 
	'</div>';
}



/**
 * Icon List Items
 */
public $icon_list_items_atts;

public function cmsmasters_icon_list_items($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_icon_list_items_atts_filter', array( 
		'shortcode_id' => 		'', 
		'type' => 				'block', 
		'icon_type' => 			'icon', 
		'icon' => 				'cmsmasters-icon-thumbs-up-5', 
		'icon_size' => 			'0', 
		'heading' => 			'h4', 
		'items_color_type' => 	'border', 
		'border_width' => 		'10', 
		'border_radius' => 		'50%', 
		'unifier_width' => 		'0', 
		'position' => 			'left', 
		'icon_space' => 		'100', 
		'item_height' => 		'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'icon-list-items';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$this->icon_list_items_atts = array(
		'style_item' => 			'', 
		'out_inner' => 				'', 
		'list_type' => 				$type, 
		'list_icon_type' => 		$icon_type, 
		'list_icon' => 				$icon, 
		'list_icon_size' => 		$icon_size, 
		'list_heading' => 			$heading, 
		'list_items_color_type' => 	$items_color_type, 
		'list_icon_space' => 		$icon_space 
	);
	
	
	$unique_id = $shortcode_id;
	
	
	if ($this->icon_list_items_atts['list_type'] == 'block') {
		if ($icon_type != 'icon' && $icon_type != 'image') {
			$this->icon_list_items_atts['style_item'] .= '#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' { ' . 
				"\n\t" . 'counter-reset:counter_' . esc_attr($unique_id) . '; ' . 
			"\n" . '} ' . "\n\n" . 
			'#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_item { ' . 
				"\n\t" . 'counter-increment:counter_' . esc_attr($unique_id) . '; ' . 
			"\n" . '} ' . "\n\n" . 
			'#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_item .cmsmasters_icon_list_icon:before { ' . 
				"\n\t" . 'content:counter(counter_' . esc_attr($unique_id) . ', ' . esc_attr($icon_type) . '); ' . 
			"\n" . '} ' . "\n";
		}
		
		
		if ($position == 'left') {
			$this->icon_list_items_atts['style_item'] .= "\n" . '#cmsmasters_icon_list_items_' . esc_attr($unique_id) . '.cmsmasters_icon_list_items .cmsmasters_icon_list_item:before { ' . 
				"\n\t" . 'left:' . esc_attr((((int) $icon_space / 2) - (((int) $unifier_width != 0) ? ($unifier_width / 2) : 0))) . 'px; ' . 
				"\n\t" . 'top:' . esc_attr($icon_space)  . 'px; ' . 
			"\n" . '} ' . "\n";
		} else {
			$this->icon_list_items_atts['style_item'] .= '#cmsmasters_icon_list_items_' . esc_attr($unique_id) . '.cmsmasters_icon_list_pos_right .cmsmasters_icon_list_item:before { ' . 
				"\n\t" . 'left:auto; ' . 
				"\n\t" . 'right:' . esc_attr((((int) $icon_space / 2) - (((int) $unifier_width != 0) ? ($unifier_width / 2) : 0))) . 'px; ' . 
				"\n\t" . 'top:' . esc_attr($icon_space)  . 'px; ' . 
			"\n" . '} ' . "\n";
		}
		
		
		$this->icon_list_items_atts['style_item'] .= '#cmsmasters_icon_list_items_' . esc_attr($unique_id) . '.cmsmasters_icon_list_type_block .cmsmasters_icon_list_item:before { ' . 
			"\n\t" . 'width:' . esc_attr($unifier_width) . 'px; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_icon { ' . 
			"\n\t" . 'width:' . esc_attr($icon_space) . 'px; ' . 
			"\n\t" . 'height:' . esc_attr($icon_space) . 'px; ' . 
			"\n\t" . '-webkit-border-radius:' . esc_attr($border_radius) . '; ' . 
			"\n\t" . 'border-radius:' . esc_attr($border_radius) . '; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_icon:before { ' . 
			"\n\t" . 'font-size:' . esc_attr($icon_size) . 'px; ' . 
			"\n\t" . 'line-height:' . esc_attr($icon_space) . 'px; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_icon:after { ' . 
			"\n\t" . 'border-width:' . esc_attr($border_width) . 'px; ' . 
			"\n\t" . 'width:' . esc_attr(((int) $icon_space + 2)) . 'px; ' . 
			"\n\t" . 'height:' . esc_attr(((int) $icon_space + 2)) . 'px; ' . 
			"\n\t" . '-webkit-border-radius:' . esc_attr($border_radius) . '; ' . 
			"\n\t" . 'border-radius:' . esc_attr($border_radius) . '; ' . 
		"\n" . '} ' . "\n";
	} else {
		$this->icon_list_items_atts['style_item'] .= '#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' { ' . 
			"\n\t" . 'padding-left:' . esc_attr(((int) $icon_size + 20)) . 'px; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_item:before { ' . 
			"\n\t" . 'font-size:' . esc_attr($icon_size) . 'px; ' . 
			"\n\t" . 'left:-' . esc_attr(((int) $icon_size + 20)) . 'px; ' . 
		"\n" . '} ' . "\n";
		
		
		if ($item_height != '') {
			$this->icon_list_items_atts['style_item'] .= '#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_item,' . 
			'#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_item * { ' . 
				"\n\t" . 'line-height:' . esc_attr($item_height) . 'px; ' . 
				"\n\t" . 'padding:0; ' . 
			"\n" . '} ' . "\n\n" . 
			'#cmsmasters_icon_list_items_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_item:before { ' . 
				"\n\t" . 'line-height:' . esc_attr($item_height) . 'px; ' . 
				"\n\t" . 'top:0; ' . 
			"\n" . '} ' . "\n";
		}
	}
	
	
	do_shortcode($content);
	
	
	$shortcode_styles = (($this->icon_list_items_atts['style_item'] != '') ? $this->icon_list_items_atts['style_item'] : '');
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= '<ul id="cmsmasters_icon_list_items_' . esc_attr($unique_id) . '" class="cmsmasters_icon_list_items cmsmasters_icon_list_type_' . esc_attr($type) . (($this->icon_list_items_atts['list_type'] == 'block') ? ' cmsmasters_icon_list_pos_' . esc_attr($position) : '') . (($this->icon_list_items_atts['list_type'] == 'block') ? ' cmsmasters_color_type_' . esc_attr($items_color_type) : '') . 
	(($icon_type != 'icon' && $icon_type != 'image') ? ' cmsmasters_icon_list_icon_type_number' : '') . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . 
		$this->icon_list_items_atts['out_inner'] . 
	'</ul>';
	
	
	return $out;
}

/**
 * Single Icon List Item
 */
public function cmsmasters_icon_list_item($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_icon_list_item_atts_filter', array( 
		'shortcode_id' => 	'', 
		'icon' => 			'', 
		'image' => 			'', 
		'title' => 			esc_html__('Title', 'cmsmasters-content-composer'), 
		'title_link' => 	'', 
		'color' => 			'', 
		'classes' => 		'' 
    ) );
	
	
	$shortcode_name = 'icon-list-item';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->icon_list_items_atts['list_type'] = ($this->icon_list_items_atts['list_type'] != 'list') ? 'block' : 'list';
	
	
	if ($this->icon_list_items_atts['list_type'] == 'block') {
		if ($this->icon_list_items_atts['list_icon_type'] == 'icon') {
			$icon = ($icon != '') ? $icon : $this->icon_list_items_atts['list_icon'];
		} else {
			$icon = '';
		}
		
		
		if ($this->icon_list_items_atts['list_icon_type'] == 'image' && $image != '') {
			$image_id = explode('|', $image);
			
			
			if (is_numeric($image_id[0]) && is_array(wp_get_attachment_image_src($image_id[0], 'full'))) {
				$image_url_src = wp_get_attachment_image_src($image_id[0], 'full');
			
				$image_url = $image_url_src[0];
			} else if ($image_id[0] != '') {
				$image_url = $image_id[0];
			} else {
				$image_url = $image_id[1];
			}
			
			
			$this->icon_list_items_atts['style_item'] .= "\n" . '.cmsmasters_icon_list_items #cmsmasters_icon_list_item_' . esc_attr($unique_id) . '.cmsmasters_icon_type_image .cmsmasters_icon_list_icon { ' . 
				"\n\t" . 'background-image:url(' . esc_url($image_url) . '); ' . 
			"\n" . '} ' . "\n";
		}
		
		
		if ($this->icon_list_items_atts['list_items_color_type'] == 'border') {
			if ($color != '') {
				$this->icon_list_items_atts['style_item'] .= "\n" . '.cmsmasters_icon_list_items.cmsmasters_color_type_border #cmsmasters_icon_list_item_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_icon:after { ' . 
					"\n\t" . cmsmasters_color_css('border-color', $color) . 
				"\n" . '} ' . "\n";
			}
			
			
			$this->icon_list_items_atts['style_item'] .= "\n" . '.cmsmasters_icon_list_items.cmsmasters_color_type_border #cmsmasters_icon_list_item_' . esc_attr($unique_id) . ':hover .cmsmasters_icon_list_icon:after { ' . 
				"\n\t" . 'border-color:transparent; ' . 
				"\n\t" . 'border-width:0; ' . 
			"\n" . '} ' . "\n";
		} elseif ($this->icon_list_items_atts['list_items_color_type'] == 'bg') {
			if ($color != '') {
				$this->icon_list_items_atts['style_item'] .= "\n" . '.cmsmasters_icon_list_items.cmsmasters_color_type_bg #cmsmasters_icon_list_item_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_icon { ' . 
					"\n\t" . cmsmasters_color_css('background-color', $color) . 
				"\n" . '} ' . "\n";
			}
			
			
			$this->icon_list_items_atts['style_item'] .= "\n" . '.cmsmasters_icon_list_items.cmsmasters_color_type_bg #cmsmasters_icon_list_item_' . esc_attr($unique_id) . ':hover .cmsmasters_icon_list_icon:after { ' . 
				"\n\t" . 'border-color:transparent; ' . 
				"\n\t" . 'border-width:0; ' . 
			"\n" . '} ' . "\n";
		} elseif ($this->icon_list_items_atts['list_items_color_type'] == 'icon') {
			if ($color != '') {
				$this->icon_list_items_atts['style_item'] .= "\n" . '.cmsmasters_icon_list_items.cmsmasters_color_type_icon #cmsmasters_icon_list_item_' . esc_attr($unique_id) . ' .cmsmasters_icon_list_icon:before { ' . 
					"\n\t" . cmsmasters_color_css('color', $color) . 
				"\n" . '} ' . "\n\n" . 
				'.cmsmasters_icon_list_items.cmsmasters_color_type_icon #cmsmasters_icon_list_item_' . esc_attr($unique_id) . ':hover .cmsmasters_icon_list_icon { ' . 
					"\n\t" . cmsmasters_color_css('background-color', $color) . 
				"\n" . '} ' . "\n";
			}
			
			
			$this->icon_list_items_atts['style_item'] .= "\n" . '.cmsmasters_icon_list_items.cmsmasters_color_type_icon #cmsmasters_icon_list_item_' . esc_attr($unique_id) . ':hover .cmsmasters_icon_list_icon:before { ' . 
				"\n\t" . 'color:inherit; ' . 
			"\n" . '} ' . "\n";
		}
		
		
		$this->icon_list_items_atts['out_inner'] .= '<li id="cmsmasters_icon_list_item_' . esc_attr($unique_id) . '" class="cmsmasters_icon_list_item' . 
		(($this->icon_list_items_atts['list_icon_type'] == 'image') ? ' cmsmasters_icon_type_image' : '') . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'">' . "\n" . 
			'<div class="cmsmasters_icon_list_item_inner">' . "\n" . 
				'<div class="cmsmasters_icon_list_icon_wrap">' . "\n" . 
					'<span class="cmsmasters_icon_list_icon ' . esc_attr($icon) . '"></span>' . "\n" . 
				'</div>' . "\n" . 
				'<div class="cmsmasters_icon_list_item_content">' . "\n" . 
					'<' . esc_attr($this->icon_list_items_atts['list_heading']) . ' class="cmsmasters_icon_list_item_title">' . 
						($title_link != '' ? '<a href="' . esc_url($title_link) . '">' : '') . 
							esc_html($title) . 
						($title_link != '' ? '</a>' : '') . 
					'</' . esc_attr($this->icon_list_items_atts['list_heading']) . '>' . "\n" . 
					cmsmasters_divpdel('<div class="cmsmasters_icon_list_item_text">' . "\n" . 
						do_shortcode(wpautop($content)) . 
					'</div>' . "\n") . 
				'</div>' . "\n" . 
			'</div>' . "\n" . 
		'</li>';
	} else {
		$icon = ($icon != '') ? $icon : $this->icon_list_items_atts['list_icon'];
		
		
		if ($color != '') {
			$this->icon_list_items_atts['style_item'] .= "\n" . '.cmsmasters_icon_list_items #cmsmasters_icon_list_item_' . esc_attr($unique_id) . ':before { ' . 
				"\n\t" . cmsmasters_color_css('color', $color) . 
			"\n" . '} ' . "\n";
		}
		
		
		$this->icon_list_items_atts['out_inner'] .= '<li id="cmsmasters_icon_list_item_' . esc_attr($unique_id) . '" class="cmsmasters_icon_list_item ' . esc_attr($icon) . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . '">' . 
			(($this->icon_list_items_atts['list_type'] == 'block') ? '<' . esc_attr($this->icon_list_items_atts['list_heading']) . '>' : '') . 
				($title_link != '' ? '<a href="' . esc_url($title_link) . '">' : '') . 
					esc_html($title) . 
				($title_link != '' ? '</a>' : '') . 
			(($this->icon_list_items_atts['list_type'] == 'block') ? '</' . esc_attr($this->icon_list_items_atts['list_heading']) . '>' : '') . 
		'</li>';
	}
}



/**
 * Progress Bars
 */
public $stats_atts;

public function cmsmasters_stats($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_stats_atts_filter', array( 
		'shortcode_id' => 		'', 
		'mode' => 				'bars', 
		'type' => 				'horizontal', 
		'count' => 				'5', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'stats';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
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
	
	
	$out .= '<div class="cmsmasters_stats stats_mode_' . esc_attr($mode) . ' stats_type_' . esc_attr($type) . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . 
		$stats . 
	'</div>';
	
	
	return $out;
}

/**
 * Single Progress Bar
 */
public function cmsmasters_stat($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_stat_atts_filter', array( 
		'shortcode_id' => 	'', 
		'subtitle' => 		'', 
		'progress' => 		'0', 
		'icon' => 			'', 
		'color' => 			'', 
		'classes' => 		'' 
    ) );
	
	
	$shortcode_name = 'stat';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	if ($this->stats_atts['stats_mode'] == 'bars') {
		$this->stats_atts['style_stats'] .= "\n" . '.cmsmasters_stats.shortcode_animated #cmsmasters_stat_' . esc_attr($unique_id) . '.cmsmasters_stat { ' . 
			"\n\t" . (($this->stats_atts['stats_type'] == 'horizontal') ? 'width' : 'height') . ':' . esc_attr($progress) . '%; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_stat_' . esc_attr($unique_id) . ' .cmsmasters_stat_inner { ' . 
			(($color != '') ? "\n\t" . cmsmasters_color_css('background-color', $color) : '') . 
		"\n" . '} ' . "\n";
	}
	
	
	return '<div class="cmsmasters_stat_wrap' . (($this->stats_atts['stats_mode'] == 'circles' || ($this->stats_atts['stats_mode'] == 'bars' && $this->stats_atts['stats_type'] == 'vertical')) ? esc_attr($this->stats_atts['stats_count']) : '') . '">' . "\n" . 
		(($this->stats_atts['stats_mode'] == 'bars' && $this->stats_atts['stats_type'] == 'vertical') ? '<div class="cmsmasters_stat_container">' . "\n" : '') . 
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
					(($content != '' && $this->stats_atts['stats_mode'] == 'bars' && $this->stats_atts['stats_type'] == 'horizontal') ? '<span class="cmsmasters_stat_title">' . esc_html($content) . '</span>' . "\n" : '') . 
					'<span class="cmsmasters_stat_counter_wrap">' . "\n" . 
						'<span class="cmsmasters_stat_counter">' . (($this->stats_atts['stats_mode'] == 'bars') ? esc_html($progress) : '0') . '</span>' . 
						'<span class="cmsmasters_stat_units">%</span>' . "\n" . 
					'</span>' . "\n" . 
					(($content != '' && $this->stats_atts['stats_mode'] == 'circles') ? '<span class="cmsmasters_stat_title">' . esc_html($content) . '</span>' . "\n" : '') . 
				'</div>' . "\n" . 
			'</div>' . "\n" . 
		(($this->stats_atts['stats_mode'] == 'bars' && $this->stats_atts['stats_type'] == 'vertical') ? '</div>' . "\n" : '') . 
		(($content != '' && $this->stats_atts['stats_mode'] == 'bars' && $this->stats_atts['stats_type'] == 'vertical') ? '<span class="cmsmasters_stat_title">' . esc_html($content) . '</span>' . "\n" : '') . 
		(($subtitle != '') ? '<span class="cmsmasters_stat_subtitle">' . esc_html($subtitle) . '</span>' . "\n" : '') . 
	'</div>';
}



/**
 * Counters
 */
public $counters_atts;

public function cmsmasters_counters($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_counters_atts_filter', array( 
		'shortcode_id' => 			'', 
		'type' => 					'horizontal', 
		'count' => 					'5', 
		'icon_size' => 				'0', 
		'icon_space' => 			'0', 
		'icon_border_width' => 		'0', 
		'icon_border_radius' => 	'0', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ) );
	
	
	$shortcode_name = 'counters';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->counters_atts = array(
		'style_counters' => '', 
		'counters_count' => '' 
	);
	
	
	if ($count == 5) {
		$this->counters_atts['counters_count'] = ' one_fifth';
	} elseif ($count == 4) {
		$this->counters_atts['counters_count'] = ' one_fourth';
	} elseif ($count == 3) {
		$this->counters_atts['counters_count'] = ' one_third';
	} elseif ($count == 2) {
		$this->counters_atts['counters_count'] = ' one_half';
	} else {
		$this->counters_atts['counters_count'] = ' one_first';
	}
	
	
	$this->counters_atts['style_counters'] = "\n" . '#cmsmasters_counters_' . esc_attr($unique_id) . ' .cmsmasters_counter.counter_has_icon .cmsmasters_counter_inner, ' . "\n" . 
	'#cmsmasters_counters_' . esc_attr($unique_id) . ' .cmsmasters_counter.counter_has_image .cmsmasters_counter_inner { ' . 
		"\n\t" . 'padding-' . (($type == 'horizontal') ? ((is_rtl()) ? 'right' : 'left') : 'top') . ':' . esc_attr((int) (($type == 'horizontal') ? $icon_space + 20 : $icon_space + 10)) . 'px; ' . 
	"\n" . '} ' . "\n\n" . 
	'#cmsmasters_counters_' . esc_attr($unique_id) . '.counters_type_horizontal .cmsmasters_counter.counter_has_icon .cmsmasters_counter_subtitle, ' . "\n" . 
	'#cmsmasters_counters_' . esc_attr($unique_id) . '.counters_type_horizontal .cmsmasters_counter.counter_has_image .cmsmasters_counter_subtitle { ' . 
		"\n\t" . 'padding-' . ((is_rtl()) ? 'right' : 'left') . ':' . esc_attr(((int) $icon_space + 20)) . 'px; ' . 
	"\n" . '} ' . "\n\n" . 
	'#cmsmasters_counters_' . esc_attr($unique_id) . '.counters_type_vertical .cmsmasters_counter .cmsmasters_counter_inner:before { ' . 
		"\n\t" . 'margin-' . ((is_rtl()) ? 'right' : 'left') . ':-' . esc_attr(((int) $icon_space / 2)) . 'px; ' . 
	"\n" . '} ' . "\n\n" . 
	'#cmsmasters_counters_' . esc_attr($unique_id) . '.counters_type_horizontal .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_counter_wrap { ' . 
		"\n\t" . 'line-height:' . esc_attr($icon_space) . 'px; ' . 
	"\n" . '} ' . "\n\n" . 
	'#cmsmasters_counters_' . esc_attr($unique_id) . ' .cmsmasters_counter .cmsmasters_counter_inner:before { ' . 
		"\n\t" . 'font-size:' . esc_attr($icon_size) . 'px; ' . 
		"\n\t" . 'line-height:' . esc_attr(((int) $icon_space - ((int) $icon_border_width * 2))) . 'px; ' . 
		"\n\t" . 'width:' . esc_attr($icon_space) . 'px; ' . 
		"\n\t" . 'height:' . esc_attr($icon_space) . 'px; ' . 
		"\n\t" . 'border-width:' . esc_attr($icon_border_width) . 'px; ' . 
		(((int) $icon_border_radius > 0) ? "\n\t" . '-webkit-border-radius:' . esc_attr($icon_border_radius) . '; ' : '') . 
		(((int) $icon_border_radius > 0) ? "\n\t" . 'border-radius:' . esc_attr($icon_border_radius) . '; ' : '') . 
	"\n" . '} ' . "\n\n";
	
	
	$counters = do_shortcode($content);
	
	
	$shortcode_styles = (($this->counters_atts['style_counters'] != '') ? $this->counters_atts['style_counters'] : '');
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= '<div id="cmsmasters_counters_' . esc_attr($unique_id) . '" class="cmsmasters_counters counters_type_' . esc_attr($type) . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . 
		$counters . 
	'</div>';
	
	
	return $out;
}

/**
 * Single Counter
 */
public function cmsmasters_counter($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_counter_atts_filter', array( 
		'shortcode_id' => 	'', 
		'subtitle' => 		'', 
		'value' => 			'0', 
		'value_prefix' => 	'', 
		'value_suffix' => 	'', 
		'color' => 			'', 
		'icon_type' => 		'icon', 
		'icon' => 			'', 
		'image' => 			'', 
		'icon_color' => 	'', 
		'icon_bg_color' => 	'', 
		'icon_bd_color' => 	'', 
		'classes' => 		'' 
    ) );
	
	
	$shortcode_name = 'counter';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->counters_atts['style_counters'] .= "\n" . '#cmsmasters_counter_' . esc_attr($unique_id) . ' .cmsmasters_counter_inner:before { ' . 
		(($icon_color != '') ? "\n\t" . cmsmasters_color_css('color', $icon_color) : '') . 
		(($icon_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $icon_bg_color) : '') . 
		(($icon_bd_color != '') ? "\n\t" . cmsmasters_color_css('border-color', $icon_bd_color) : '') . 
	"\n" . '} ' . "\n\n";
	
	
	if ($icon_type == 'image' && $image != '') {
		$image_id = explode('|', $image);
		
		
		$image_url_array = wp_get_attachment_image_src($image_id[0], 'full');
		
		
		if (is_numeric($image_id[0]) && is_array($image_url_array)) {
			$image_url = $image_url_array[0];
		} else if ($image_id[0] != '') {
			$image_url = $image_id[0];
		} else {
			$image_url = $image_id[1];
		}
		
		
		$this->counters_atts['style_counters'] .= '#cmsmasters_counter_' . esc_attr($unique_id) . ' .cmsmasters_counter_inner:before { ' . 
			"\n\t" . "content:''; " . 
			"\n\t" . 'background-image:url(' . esc_url($image_url) . '); ' . 
		"\n" . '} ' . "\n";
	}
	
	
	if ($color != '') {
		$this->counters_atts['style_counters'] .= '#cmsmasters_counter_' . esc_attr($unique_id) . ' .cmsmasters_counter_counter_wrap { ' . 
			"\n\t" . cmsmasters_color_css('color', $color) . 
		"\n" . '} ' . "\n";
	}
	
	
	return '<div class="cmsmasters_counter_wrap' . esc_attr($this->counters_atts['counters_count']) . '">' . "\n" . 
		'<div id="cmsmasters_counter_' . esc_attr($unique_id) . '" class="cmsmasters_counter' . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		(($icon_type == 'icon' && $icon != '') ? ' counter_has_icon' : '') . 
		(($icon_type == 'image' && $image != '') ? ' counter_has_image' : '') . 
		'" data-percent="' . esc_attr($value) . '">' . "\n" . 
			'<div class="cmsmasters_counter_inner' . 
			(($icon != '') ? ' ' . esc_attr($icon) : '') . 
			'">' . "\n" . 
				'<span class="cmsmasters_counter_counter_wrap">' . "\n" . 
					'<span class="cmsmasters_counter_prefix">' . esc_html($value_prefix) . '</span>' . 
					'<span class="cmsmasters_counter_counter">0</span>' . 
					'<span class="cmsmasters_counter_suffix">' . esc_html($value_suffix) . '</span>' . "\n" . 
				'</span>' . "\n" . 
				(($content != '') ? '<span class="cmsmasters_counter_title">' . esc_html($content) . '</span>' . "\n" : '') . 
			'</div>' . "\n" . 
			(($subtitle != '') ? '<span class="cmsmasters_counter_subtitle">' . esc_html($subtitle) . '</span>' . "\n" : '') . 
		'</div>' . "\n" . 
	'</div>';
}



/**
 * Embed
 */
public function cmsmasters_embed($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_embed_atts_filter', array( 
		'shortcode_id' => 		'', 
		'link' => 				'', 
		'width' => 				'', 
		'height' => 			'', 
		'wrap' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'embed';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	global $wp_embed;
	
	
    $shcd_out = '';
	
	
	if ($wrap != '') {
		$shcd_out .= '[cmsmasters_video_wrap' . 
		(($width != '') ? ' width="' . esc_attr($width) . '"' : '') . 
		(($animation != '') ? ' animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		(($classes != '') ? ' classes="' . esc_attr($classes) . '"' : '') . 
		']';
	} else {
		$shcd_out .= '<div class="cmsmasters_embed_wrap' . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'>' . "\n";
	}
	
	
	$shcd_out .= $wp_embed->run_shortcode('[embed' . 
	(($width != '') ? ' width="' . esc_attr($width) . '"' : '') . 
	(($height != '') ? ' height="' . esc_attr($height) . '"' : '') . 
	']' . esc_url($link) . '[/embed]');
	
	
	if ($wrap != '') {
		$shcd_out .= '[/cmsmasters_video_wrap]';
	} else {
		$shcd_out .= '</div>';
	}
	
	
	$out = do_shortcode($shcd_out);
	
	
	return $out;
}



/**
 * Videos
 */
public function cmsmasters_videos($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_videos_atts_filter', array( 
		'shortcode_id' => 		'', 
		'poster' => 			'', 
		'width' => 				'', 
		'height' => 			'', 
		'wrap' => 				'', 
		'autoplay' => 			'', 
		'loop' => 				'', 
		'preload' => 			'none', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'videos';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$out = '';
	
	
	$attrs = array( 
		'preload' => $preload 
	);
	
	
	if ($poster != '') {
		$newPosterArray = explode('|', $poster);
		
		
		$newPoster = wp_get_attachment_image_src($newPosterArray[0], 'full');
		
		
		$attrs['poster'] = $newPoster[0];
	}
	
	
	if ($width != '') {
		$attrs['width'] = $width;
	}
	
	
	if ($height != '') {
		$attrs['height'] = $height;
	}
	
	
	if ($autoplay != '') {
		$attrs['autoplay'] = 'on';
	}
	
	
	if ($loop != '') {
		$attrs['loop'] = 'on';
	}
	
	
	$content = str_replace('[/cmsmasters_video][cmsmasters_video]', ',', $content);
	
	$content = str_replace('[cmsmasters_video]', '', $content);
	
	$content = str_replace('[/cmsmasters_video]', '', $content);
	
	
	$newContentArray = explode(',', $content);
	
	
	foreach ($newContentArray as $newContentItem) {
		$newContentItemArray = explode('|', $newContentItem);
		
		
		if (count($newContentItemArray) > 1) {
			$newContentItemVal = $newContentItemArray[1];
		} else {
			$newContentItemVal = $newContentItemArray[0];
		}
		
		
		$attrs[substr(strrchr($newContentItemVal, '.'), 1)] = $newContentItemVal;
	}
	
	
	if ($wrap != '') {
		$out .= '[cmsmasters_video_wrap' . 
		($shortcode_id != '' ? ' shortcode_id="' . esc_attr($shortcode_id) . '"' : '') . 
		(($width != '') ? ' width="' . esc_attr($width) . '"' : '') . 
		(($animation != '') ? ' animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		(($classes != '') ? ' classes="' . esc_attr($classes) . '"' : '') . 
		']';
	} else {
		$out .= '<div class="cmsmasters_video' . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'>' . "\n";
	}
	
	
	$out .= wp_video_shortcode($attrs);
	
	
	if ($wrap != '') {
		$out .= '[/cmsmasters_video_wrap]';
	} else {
		$out .= '</div>';
	}
	
	
	$out = do_shortcode($out);
	
	
	return $out;
}



/**
 * Video Wrap
 */
public function cmsmasters_video_wrap($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_video_wrap_atts_filter', array( 
		'shortcode_id' => 		'', 
		'width' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'video-wrap';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	$shortcode_styles = '';
	
	
	if ($width != '') {
		$shortcode_styles .= "\n" . 
			'#cmsmasters_video_wrap_' . esc_attr($unique_id) . ' { ' . 
				"\n\t" . 'max-width:' . esc_attr($width) . 'px; ' . 
			"\n" . '} ' . 
		"\n";
	}
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
    $out .= cmsmasters_divpdel('<div id="cmsmasters_video_wrap_' . esc_attr($unique_id) . '" class="cmsmasters_video_wrap' . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		do_shortcode(wpautop($content)) . 
	'</div>' . "\n");
	
	
	return $out;
}



/**
 * Audio
 */
public function cmsmasters_audios($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_audios_atts_filter', array( 
		'shortcode_id' => 		'', 
		'autoplay' => 			'', 
		'loop' => 				'', 
		'preload' => 			'none', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'audios';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$attrs = array( 
		'preload' => $preload 
	);
	
	
	if ($autoplay != '') {
		$attrs['autoplay'] = 'on';
	}
	
	
	if ($loop != '') {
		$attrs['loop'] = 'on';
	}
	
	
	$content = str_replace('[/cmsmasters_audio][cmsmasters_audio]', ',', $content);
	
	$content = str_replace('[cmsmasters_audio]', '', $content);
	
	$content = str_replace('[/cmsmasters_audio]', '', $content);
	
	
	$newContentArray = explode(',', $content);
	
	
	foreach ($newContentArray as $newContentItem) {
		$newContentItemArray = explode('|', $newContentItem);
		
		
		if (count($newContentItemArray) > 1) {
			$newContentItemVal = $newContentItemArray[1];
		} else {
			$newContentItemVal = $newContentItemArray[0];
		}
		
		
		$attrs[substr(strrchr($newContentItemVal, '.'), 1)] = $newContentItemVal;
	}
	
	
	return '<div class="cmsmasters_audio' . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		wp_audio_shortcode($attrs) . 
	'</div>';
}



/**
 * Table
 */
public function cmsmasters_table($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_table_atts_filter', array( 
		'shortcode_id' => 		'', 
		'caption' => 			'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'table';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	return '<div class="cmsmasters_wrap_table">' . 
		'<table class="cmsmasters_table' . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'>' . 
			'<caption>' . esc_html($caption) . '</caption>' . 
			do_shortcode($content) . 
		'</table>' . 
	'</div>';
}

/**
 * Table Row
 */
public function cmsmasters_tr($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_tr_atts_filter', array( 
		'type' => 	'' 
    ) );
	
	
	$shortcode_name = 'tr';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$out = '';
	
	
	if ($type == 'header') {
		$out .= '<thead>';
	} else if ($type == 'footer') {
		$out .= '<tfoot>';
	}
	
	
	$out .= '<tr' . 
		(($type != '') ? ' class="cmsmasters_table_row_' . esc_attr($type) . '"' : '') . 
	'>' . 
		do_shortcode($content) . 
	'</tr>';
	
	
	if ($type == 'header') {
		$out .= '</thead>';
	} else if ($type == 'footer') {
		$out .= '</tfoot>';
	}
	
	
	return $out;
}

/**
 * Table Cell
 */
public function cmsmasters_td($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_td_atts_filter', array( 
		'type' => 	'', 
		'align' => 	'left' 
    ) );
	
	
	$shortcode_name = 'td';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	return '<' . (($type == 'header') ? 'th' : 'td') . 
	(($align != '') ? ' class="cmsmasters_table_cell_align' . esc_attr($align) . '"' : '') . 
	'>' . 
		do_shortcode($content) . 
	'</' . (($type == 'header') ? 'th' : 'td') . '>';
}



/**
 * Divider
 */
public function cmsmasters_divider($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_divider_atts_filter', array( 
		'shortcode_id' => 			'', 
		'width' => 					'short', 
		'height' => 				'1', 
		'style' => 					'solid', 
		'position' => 				'center', 
		'color' => 					'', 
		'margin_top' => 			'0', 
		'margin_bottom' => 			'0', 
		'resp_vert_mar' => 			'', 
		'margin_top_large' => 		'', 
		'margin_bottom_large' => 	'', 
		'margin_top_laptop' => 		'', 
		'margin_bottom_laptop' => 	'', 
		'margin_top_tablet' => 		'', 
		'margin_bottom_tablet' => 	'', 
		'margin_top_mobile_h' => 	'', 
		'margin_bottom_mobile_h' => '', 
		'margin_top_mobile_v' => 	'', 
		'margin_bottom_mobile_v' => '', 
		'classes' => 				'' 
	) );
	
	
	$shortcode_name = 'divider';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$shortcode_styles = "\n" . 
		'#cmsmasters_divider_' . esc_attr($unique_id) . ' { ' . 
			"\n\t" . 'border-bottom-width:' . esc_attr($height) . 'px; ' . 
			"\n\t" . 'border-bottom-style:' . esc_attr($style) . '; ' . 
			"\n\t" . 'margin-top:' . esc_attr($margin_top) . 'px; ' . 
			"\n\t" . 'margin-bottom:' . esc_attr($margin_bottom) . 'px; ' . 
			(($color != '') ? "\n\t" . cmsmasters_color_css('border-bottom-color', $color) : '') . 
		"\n" . '} ' . 
	"\n";
	
	
	if ($resp_vert_mar == 'true') {
		if ($margin_top_large != '') {
			$shortcode_styles .= "
			@media only screen and (min-width: 1440px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($margin_top_large) . "px;
				}
			}
			";
		}
		
		if ($margin_bottom_large != '') {
			$shortcode_styles .= "
			@media only screen and (min-width: 1440px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($margin_bottom_large) . "px;
				}
			}
			";
		}
		
		if ($margin_top_laptop != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($margin_top_laptop) . "px;
				}
			}
			";
		}
		
		if ($margin_bottom_laptop != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 1024px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($margin_bottom_laptop) . "px;
				}
			}
			";
		}
		
		if ($margin_top_tablet != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($margin_top_tablet) . "px;
				}
			}
			";
		}
		
		if ($margin_bottom_tablet != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 768px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($margin_bottom_tablet) . "px;
				}
			}
			";
		}
		
		if ($margin_top_mobile_h != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($margin_top_mobile_h) . "px;
				}
			}
			";
		}
		
		if ($margin_bottom_mobile_h != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 540px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($margin_bottom_mobile_h) . "px;
				}
			}
			";
		}
		
		if ($margin_top_mobile_v != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-top: " . esc_attr($margin_top_mobile_v) . "px;
				}
			}
			";
		}
		
		if ($margin_bottom_mobile_v != '') {
			$shortcode_styles .= "
			@media only screen and (max-width: 320px) {
				#cmsmasters_divider_" . esc_attr($unique_id) . " {
					margin-bottom: " . esc_attr($margin_bottom_mobile_v) . "px;
				}
			}
			";
		}
	}
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= '<div id="cmsmasters_divider_' . esc_attr($unique_id) . '" class="' . 
	(($height < 1) ? 'cl' : 'cmsmasters_divider cmsmasters_divider_width_' . esc_attr($width) . ' cmsmasters_divider_pos_' . esc_attr($position)) . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"></div>';
	
	
	return $out;
}



/**
 * Contact Form
 */
public function cmsmasters_contact_form($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_contact_form_atts_filter', array( 
		'shortcode_id' => 		'', 
		'form_plugin' => 		'',
		'form_ninja' =>     '',
		'form_wpforms' =>   '', 
		'form_cf7' => 			'', 
		'form_cfb' => 			'', 
		'email_cfb' => 			'', 
		'email_from_name_cfb' => 'wordpress', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'contact-form';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
    $out = '<div class="cmsmasters_contact_form' . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>';
	
	
	if ($form_plugin == 'cf7' && $form_cf7 != '') {
		$cf7_array = explode('{|}', $form_cf7);
		
		
		$out .= do_shortcode('[contact-form-7 id="' . esc_attr($cf7_array[0]) . '" title="' . stripslashes($cf7_array[1]) . '"]');
	} elseif ($form_plugin == 'wpforms' && $form_wpforms != '') {
		$wpforms_array = explode('{|}', $form_wpforms);
		
		
		$out .= do_shortcode('[wpforms id="' . esc_attr($wpforms_array[0]) . '" title="' . stripslashes($wpforms_array[1]) . '"]'); 
  } elseif ($form_plugin == 'ninja' && $form_ninja != '') {
		$ninja_array = explode('{|}', $form_ninja);
		
		
		$out .= do_shortcode('[ninja_form id="' . esc_attr($ninja_array[0]) . '" title="' . stripslashes($ninja_array[1]) . '"]'); 
  } elseif ($form_plugin == 'cfb' && $form_cfb != '' && $email_cfb != '') {
		$out .= do_shortcode('[cmsmasters_contact_form_sc formname="' . esc_attr($form_cfb) . '" email="' . esc_attr($email_cfb) . '" fromname="' . esc_attr($email_from_name_cfb) . '"]');
	}
	
	
	$out .= '</div>';
	
	
	return $out;
}



/**
 * Slider
 */
public function cmsmasters_slider($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_slider_atts_filter', array( 
		'shortcode_id' => 		'', 
		'slider_plugin' => 		'', 
		'slider_layer' => 		'', 
		'slider_rev' => 		'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'slider';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
    $out = '<div class="cmsmasters_slider' . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'">';
	
	
	if ($slider_plugin == 'layer' && $slider_layer != '') {
		$out .= do_shortcode('[layerslider id="' . esc_attr($slider_layer) . '"]');
	} elseif ($slider_plugin == 'rev' && $slider_rev != '') {
		$out .= do_shortcode('[rev_slider alias="' . esc_attr($slider_rev) . '"]');
	}
	
	
	$out .= '</div>';
	
	
	return $out;
}



/**
 * Clients
 */
public $clients_atts;

public function cmsmasters_clients($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_clients_atts_filter', array( 
		'shortcode_id' => 		'', 
		'columns' => 			'5', 
		'layout' => 			'', 
		'height' => 			'180', 
		'autoplay' => 			'', 
		'speed' => 				'1', 
		'slides_control' => 	'', 
		'arrow_control' => 		'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'clients';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->clients_atts = array(
		'client_out' => '', 
		'layout' => $layout 
	);
	
	
	$clients_col = '';
	
	if ($columns == 1) {
		$clients_col = 'clients_one';
	} elseif ($columns == 2) {
		$clients_col = 'clients_two';
	} elseif ($columns == 3) {
		$clients_col = 'clients_three';
	} elseif ($columns == 4) {
		$clients_col = 'clients_four';
	} elseif ($columns == 5) {
		$clients_col = 'clients_five';
	}
	
	
	do_shortcode($content);
	
	$shortcode_styles = "\n" . 
		'#cmsmasters_clients_' . esc_attr($unique_id) . ' .cmsmasters_clients_item { ' . 
			'height:' . esc_attr($height) . 'px; ' .  
			'line-height:' . esc_attr($height) . 'px; ' .  
		'} ' . "\n" . 
		'#cmsmasters_clients_' . esc_attr($unique_id) . ' .cmsmasters_clients_item a { ' . 
			'line-height:' . esc_attr($height) . 'px; ' .  
		'} ' . 
	"\n";
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	if ($layout == 'slider') {
		$autoplay = ($autoplay != 'true' ? 'false' : '5000');
		$speed = ((int) $speed * 1000);
		$slides_control = ($slides_control != 'true' ? 'false' : 'true');
		$arrow_control = ($arrow_control != 'true' ? 'false' : 'true');
		
		$out .= '<div class="cmsmasters_clients_slider_wrap' . (($classes != '') ? ' ' . esc_attr($classes) : '') . (($arrow_control == 'true') ? ' enable_arrow_control' : '') . (($slides_control == 'true') ? ' enable_slider_control' : '') . '"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'>' . "\n" . 
			"<div" . 
				" id=\"cmsmasters_clients_" . esc_attr($unique_id) . "\"" . 
				" class=\"cmsmasters_owl_slider owl-carousel cmsmasters_clients_slider" . ($slides_control == 'true' ? ' enable_slides_control' : '') . ($arrow_control == 'true' ? ' enable_arrow_control' : '') . "\"" . 
				" data-items=\"" . esc_attr($columns) . "\"" . 
				" data-single-item=\"false\"" . 
				" data-auto-play=\"" . esc_attr($autoplay) . "\"" . 
				" data-slide-speed=\"" . esc_attr($speed) . "\"" . 
				" data-pagination-speed=\"" . esc_attr($speed) . "\"" . 
				" data-pagination=\"" . esc_attr($slides_control) . "\"" . 
				" data-navigation=\"" . esc_attr($arrow_control) . "\"" . 
			">" . 
				$this->clients_atts['client_out'] . 
			'</div>' . "\n" . 
		'</div>' . "\n";
	} else {
		$out .= '<div class="cmsmasters_clients_grid_wrap' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'>' . "\n" . 
		'<div id="cmsmasters_clients_' . esc_attr($unique_id) . '" class="cmsmasters_clients_grid' . ' ' . esc_attr($clients_col) . '">' . "\n" . 
		'<div class="cmsmasters_clients_items slides">' . "\n" . 
			$this->clients_atts['client_out'] . 
		'</div>' . "\n" . 
		'</div>' . "\n" . 
		'</div>' . "\n";
	}
	
	return $out;
}

/**
 * Single Client
 */
public function cmsmasters_client($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_client_atts_filter', array( 
		'shortcode_id' => 	'', 
		'logo' => 			'', 
		'link' => 			'', 
		'target' => 		'blank', 
		'classes' => 		'' 
    ) );
	
	
	$shortcode_name = 'client';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$counter = 0;
	
	if ($content == null) {
		$content = esc_html__('Name', 'cmsmasters-content-composer');
	}
	
	
	if ($logo != '') {
		$client_logo = wp_get_attachment_image_src(strstr($logo, '|', true), 'full');
		
		$this->clients_atts['client_out'] .= '<div class="cmsmasters_clients_item item' . 
			($this->clients_atts['layout'] == 'slider' ? ' cmsmasters_owl_slider_item' : '') . 
			($classes != '' ? ' ' . esc_attr($classes) : '') . 
		'">' . 
			($link != '' ? '<a href="' . esc_url($link) . '"' . ($target == 'blank' ? ' target="_blank"' : '') . '>' : '') . 
				'<img src="' . esc_url($client_logo[0]) . '" alt="' . esc_attr($content) . '" title="' . esc_attr($content) . '" />' . 
			($link != '' ? '</a>' : '') . 
		'</div>';
	}
}



/**
 * Button
 */
public function cmsmasters_button($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_button_atts_filter', array( 
		'shortcode_id' => 			'', 
		'button_title' => 			'', 
		'button_link' => 			'#', 
		'button_target' => 			'', 
		'button_text_align' => 		'center', 
		'button_style' => 			'', 
		'button_font_family' => 	'', 
		'button_font_size' => 		'', 
		'button_line_height' => 	'', 
		'button_font_weight' => 	'', 
		'button_font_style' => 		'', 
		'button_text_transform' => 	'', 
		'button_padding_hor' => 	'', 
		'button_margins' => 		'', 
		'button_resp_mar' => 		'', 
		'button_margin_large' => 	'', 
		'button_margin_laptop' => 	'', 
		'button_margin_tablet' => 	'', 
		'button_margin_mobile_h' => '', 
		'button_margin_mobile_v' => '', 
		'button_border_width' => 	'', 
		'button_border_style' => 	'', 
		'button_border_radius' => 	'', 
		'button_bg_color' => 		'', 
		'button_text_color' => 		'', 
		'button_border_color' => 	'', 
		'button_bg_color_h' => 		'', 
		'button_text_color_h' => 	'', 
		'button_border_color_h' => 	'', 
		'button_icon' => 			'', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ) );
	
	
	$shortcode_name = 'button';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	$shortcode_atts = shortcode_atts($new_atts, $atts);
	
	extract($shortcode_atts);
	
	
	$unique_id = $shortcode_id;
	
	
	$local_fonts = '';
	
	if ($button_font_family != '') {
		$font_family_array = str_replace('+', ' ', explode(':', $button_font_family));
		
		
		if (is_numeric($font_family_array[0])) {
			$font_family_name = "'" . $font_family_array[1] . "'";
			
			if (is_admin()) {
				$local_fonts .= 'cmsmasters_local_font_start=' . $button_font_family . '=cmsmasters_local_font_end';
			}
		} else {
			$font_family_name = "'" . $font_family_array[0] . "'";
			
			cmsmasters_theme_font($button_font_family, $button_font_family);
		}
	}
	
	
	if (
		$button_style != '' || 
		$button_font_family != '' || 
		$button_font_size != '' || 
		$button_line_height != '' || 
		$button_font_weight != '' || 
		$button_font_style != '' || 
		$button_text_transform != '' || 
		$button_padding_hor != '' || 
		$button_margins != '' || 
		$button_resp_mar != '' || 
		$button_margin_large != '' || 
		$button_margin_laptop != '' || 
		$button_margin_tablet != '' || 
		$button_margin_mobile_h != '' || 
		$button_margin_mobile_v != '' || 
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
	
	
	$shortcode_styles = "\n" . 
		'#cmsmasters_button_' . esc_attr($unique_id) . ' { ' . 
			"\n\t" . (($button_text_align == 'center') ? '' : (($button_text_align == 'inline') ? 'display:inline-block; ' : 'float:' . esc_attr($button_text_align) . '; ')) . 
			"\n\t" . (($button_text_align == 'inline') ? '' : 'text-align:' . esc_attr($button_text_align)) . '; ' . 
			"\n\t" . (($button_custom_styles == 'true' && $button_margins != '') ? "\n\t" . 'margin:' . esc_attr($button_margins) . ';' : '') . 
		"\n" . '} ' . "\n\n" . 
		'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button:before { ' . 
			"\n\t" . 'margin-right:' . (($content != null) ? '.5em; ' : '0;') . 
			"\n\t" . 'margin-left:0; ' . 
			"\n\t" . 'vertical-align:baseline; ' . 
		"\n" . '} ' . "\n\n";
		
		
		if ($button_text_align == 'inline' && $button_resp_mar == 'true') {
			if ($button_margin_large != '') {
				$shortcode_styles .= "\n" . 
					'@media only screen and (min-width: 1440px) {
						#cmsmasters_button_' . esc_attr($unique_id) . ' { ' . 
							'margin:' . esc_attr($button_margin_large) . ';
						}
					}
				';
			}
			
			if ($button_margin_laptop != '') {
				$shortcode_styles .= "\n" . 
					'@media only screen and (max-width: 1024px) {
						#cmsmasters_button_' . esc_attr($unique_id) . ' { ' . 
							'margin:' . esc_attr($button_margin_laptop) . ';
						}
					}
				';
			}
			
			if ($button_margin_tablet != '') {
				$shortcode_styles .= "\n" . 
					'@media only screen and (max-width: 768px) {
						#cmsmasters_button_' . esc_attr($unique_id) . ' { ' . 
							'margin:' . esc_attr($button_margin_tablet) . ';
						}
					}
				';
			}
			
			if ($button_margin_mobile_h != '') {
				$shortcode_styles .= "\n" . 
					'@media only screen and (max-width: 540px) {
						#cmsmasters_button_' . esc_attr($unique_id) . ' { ' . 
							'margin:' . esc_attr($button_margin_mobile_h) . ';
						}
					}
				';
			}
			
			if ($button_margin_mobile_v != '') {
				$shortcode_styles .= "\n" . 
					'@media only screen and (max-width: 320px) {
						#cmsmasters_button_' . esc_attr($unique_id) . ' { ' . 
							'margin:' . esc_attr($button_margin_mobile_v) . ';
						}
					}
				';
			}
		}
		
		
		if ($button_custom_styles == 'true') {
			$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button { ' . 
				(($button_font_family != '') ? "\n\t" . 'font-family:' . str_replace('+', ' ', $font_family_name) . '; ' : '') . 
				(($button_font_size != '') ? "\n\t" . 'font-size:' . esc_attr($button_font_size) . 'px; ' : '') . 
				(($button_line_height != '') ? "\n\t" . 'line-height:' . esc_attr($button_line_height) . 'px; ' : '') . 
				(($button_font_weight != '' && $button_font_weight != 'default') ? "\n\t" . 'font-weight:' . esc_attr($button_font_weight) . '; ' : '') . 
				(($button_font_style != '' && $button_font_style != 'default') ? "\n\t" . 'font-style:' . esc_attr($button_font_style) . '; ' : '') . 
				(($button_text_transform != '' && $button_text_transform != 'default') ? "\n\t" . 'text-transform:' . esc_attr($button_text_transform) . '; ' : '') . 
				(($button_padding_hor != '') ? "\n\t" . 'padding-right:' . esc_attr($button_padding_hor) . 'px; ' : '') . 
				(($button_padding_hor != '') ? "\n\t" . 'padding-left:' . esc_attr($button_padding_hor) . 'px; ' : '') . 
				(($button_border_width != '') ? "\n\t" . 'border-' . (($button_style == 'cmsmasters_but_bd_underline') ? 'bottom-' : '') . 'width:' . esc_attr($button_border_width) . 'px; ' : '') . 
				(($button_border_style != '' && $button_border_style != 'default') ? "\n\t" . 'border-style:' . esc_attr($button_border_style) . '; ' : '') . 
				(($button_border_radius != '') ? "\n\t" . '-webkit-border-radius:' . esc_attr($button_border_radius) . '; ' . "\n\t" . 'border-radius:' . esc_attr($button_border_radius) . '; ' : '') . 
				(($button_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color) : '') . 
				(($button_text_color != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color) : '') . 
				(($button_border_color != '') ? "\n\t" . cmsmasters_color_css('border-color', $button_border_color) : '') . 
			"\n" . '} ' . "\n";
			
			$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button:hover { ' . 
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
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_left:hover, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_right:hover, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_top:hover, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_bottom:hover, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_vert:hover, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_hor:hover, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_diag:hover { ' . 
						"\n\t" . cmsmasters_color_css('background-color', $button_bg_color) . 
					"\n" . '} ' . "\n";
				}
				
				if ($button_bg_color_h != '') {
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_left:after, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_right:after, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_top:after, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_slide_bottom:after, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_vert:after, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_hor:after, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_bg_expand_diag:after { ' . 
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
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_dark_bg, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_light_bg, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider, ' .  
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse { ' . 
						"\n\t" . 'padding-left:' . esc_attr($but_icon_pad) . 'px; ' . 
					"\n" . '} ' . "\n";
					
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_dark_bg:before, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_light_bg:before, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:before, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:before, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_dark_bg:after, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_light_bg:after, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:after, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:after { ' . 
						"\n\t" . 'width:' . esc_attr($button_line_height) . 'px; ' . 
					"\n" . '} ' . "\n";
				}
				
				
				if ($button_border_color != '' || $button_border_color_h != '') {
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:after { ' . 
						"\n\t" . cmsmasters_color_css('border-color', $button_border_color) . 
					"\n" . '} ' . "\n";
					
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_divider:hover:after { ' . 
						"\n\t" . cmsmasters_color_css('border-color', $button_border_color_h) . 
					"\n" . '} ' . "\n";
				}
				
				
				if ($button_style == 'cmsmasters_but_icon_inverse') {
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:before { ' . 
						(($button_text_color_h != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color_h) : '') . 
					"\n" . '} ' . "\n";
				
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:after { ' . 
						(($button_bg_color_h != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color_h) : '') . 
					"\n" . '} ' . "\n";
					
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:hover:before { ' . 
						(($button_text_color != '') ? "\n\t" . cmsmasters_color_css('color', $button_text_color) : '') . 
					"\n" . '} ' . "\n";
					
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_inverse:hover:after { ' . 
						(($button_bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $button_bg_color) : '') . 
					"\n" . '} ' . "\n";
				}
			}
			
			
			if (
				$button_style == 'cmsmasters_but_icon_slide_left' || 
				$button_style == 'cmsmasters_but_icon_slide_right' 
			) {
				if ($button_padding_hor != '') {
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_left, ' . 
					'#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_right { ' . 
						"\n\t" . 'padding-left:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
						"\n\t" . 'padding-right:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
					"\n" . '} ' . "\n";
					
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_left:before { ' . 
						"\n\t" . 'width:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
						"\n\t" . 'left:-' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
					"\n" . '} ' . "\n";
					
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_left:hover:before { ' . 
						"\n\t" . 'left:0; ' . 
					"\n" . '} ' . "\n";
					
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_right:before { ' . 
						"\n\t" . 'width:' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
						"\n\t" . 'right:-' . esc_attr(($button_padding_hor * 2)) . 'px; ' . 
					"\n" . '} ' . "\n";
					
					$shortcode_styles .= '#cmsmasters_button_' . esc_attr($unique_id) . ' .cmsmasters_button.cmsmasters_but_icon_slide_right:hover:before { ' . 
						"\n\t" . 'right:0; ' . 
					"\n" . '} ' . "\n";
				}
			}
		}
		
	$shortcode_styles .= "\n";
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= $local_fonts;
	
	
	$link = apply_filters('cmsmasters_button_link_filter', $button_link, $shortcode_atts);
	
	
	$out .= '<div id="cmsmasters_button_' . esc_attr($unique_id) . '" class="button_wrap">' . 
		'<a href="' . esc_url($link) . '" class="cmsmasters_button' . 
		(($button_style != '') ? ' cmsmasters_but_clear_styles ' . esc_attr($button_style) : '') . 
		(($button_icon != '') ? ' ' . esc_attr($button_icon) : '') . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		(($button_target == 'blank') ? ' target="_blank"' : '') . 
		'><span>' . esc_html($content) . '</span></a>' . 
	'</div>' . "\n";
	
	
	return $out;
}



/**
 * Icon
 */
public function cmsmasters_simple_icon($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_simple_icon_atts_filter', array( 
		'shortcode_id' => 			'', 
		'icon' => 					'', 
		'size' => 					'40', 
		'space' => 					'60', 
		'display' => 				'block', 
		'padding' => 			'', 
		'text_align' => 			'center', 
		'border_width' => 			'0', 
		'border_radius' => 			'0', 
		'color' => 					'', 
		'bg_color' => 				'', 
		'bd_color' => 				'', 
		'title' => 					'', 
		'link' => 					'', 
		'target' => 				'', 
		'color_h' => 				'', 
		'bg_color_h' => 			'', 
		'bd_color_h' => 			'', 
		'animation' => 				'', 
		'animation_delay' => 		'' 
	) );
	
	
	$shortcode_name = 'simple-icon';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$shortcode_styles = "\n" . 
		'#cmsmasters_icon_' . esc_attr($unique_id) . ' { ' . 
			"\n\t" . 'display:' . esc_attr($display) . '; ' . 
			"\n\t" . 'text-align:' . esc_attr($text_align) . '; ' . 
			(($padding != '') ? "\n\t" . 'padding: ' . esc_attr($padding) . '; ' : '') . 
		'} ' . "\n\n" . 
		'#cmsmasters_icon_' . esc_attr($unique_id) . ' .cmsmasters_simple_icon { ' . 
			"\n\t" . 'border-width:' . esc_attr($border_width) . 'px; ' . 
			"\n\t" . 'width:' . esc_attr($space) . 'px; ' . 
			"\n\t" . 'height:' . esc_attr($space) . 'px; ' . 
			"\n\t" . 'font-size:' . esc_attr($size) . 'px; ' . 
			"\n\t" . 'line-height:' . esc_attr(((int) $space - ((int) $border_width * 2))) . 'px; ' . 
			"\n\t" . 'text-align:' . esc_attr($text_align) . '; ' . 
			(($border_radius != '') ? "\n\t" . '-webkit-border-radius:' . esc_attr($border_radius) . '; ' . "\n\t" . 'border-radius:' . esc_attr($border_radius) . '; ' : '') . 
			(($color != '') ? "\n\t" . cmsmasters_color_css('color', $color) : '') . 
			(($bg_color != '') ? "\n\t" . cmsmasters_color_css('background-color', $bg_color) : '') . 
			(($bd_color != '') ? "\n\t" . cmsmasters_color_css('border-color', $bd_color) : '') . 
		'} ' . "\n" . 
		'#cmsmasters_icon_' . esc_attr($unique_id) . ' a:hover .cmsmasters_simple_icon {' . 
			(($color_h != '') ? "\n\t" . cmsmasters_color_css('color', $color_h) : '') . 
			(($bg_color_h != '') ? "\n\t" . cmsmasters_color_css('background-color', $bg_color_h) : '') . 
			(($bd_color_h != '') ? "\n\t" . cmsmasters_color_css('border-color', $bd_color_h) : '') . 
		'} ' . "\n" . 
		'#cmsmasters_icon_' . esc_attr($unique_id) . ' .cmsmasters_simple_icon_title { ' . 
			(($color != '') ? "\n\t" . cmsmasters_color_css('color', $color) : '') . 
		'} ' . "\n" . 
		'#cmsmasters_icon_' . esc_attr($unique_id) . ' a:hover .cmsmasters_simple_icon_title {' . 
			(($color_h != '') ? "\n\t" . cmsmasters_color_css('color', $color_h) : '') . 
		'} ' . "\n" . 
	"\n";
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
    $out .= '<div id="cmsmasters_icon_' . esc_attr($unique_id) . '" class="cmsmasters_icon_wrap">' . 
		(($link != '') ? '<a href="' . esc_url($link) . '"' . (($target == 'blank') ? ' target="_blank"' : '') . '>' : '') . 
			'<span class="cmsmasters_simple_icon' . 
			(($icon != '') ? ' ' . esc_attr($icon) : '') . 
			(($content != '') ? ' ' . esc_attr($content) : '') . 
			'"' . 
			(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
			'></span>' . 
		(($link != '') ? '<span class="cmsmasters_simple_icon_title">' . esc_html($title) . '</span></a>' : '') . 
		(($link != '') ? '' : '<span class="cmsmasters_simple_icon_title">' . esc_html($title) . '</span>') .  
	'</div>' . "\n";
	
	
	return $out;
}



/**
 * Image
 */
public function cmsmasters_image($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_image_atts_filter', array( 
		'shortcode_id' => 		'', 
		'align' => 				'', 
		'caption' => 			'', 
		'link' => 				'', 
		'target' => 			'', 
		'lightbox' => 			'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'image';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$out = '';
	
	
	if ($content != null) {
		if ($align == 'left') {
			$img_align = ' cmsmasters_image_l';
		} elseif ($align == 'right') {
			$img_align = ' cmsmasters_image_r';
		} elseif ($align == 'center') {
			$img_align = ' cmsmasters_image_c';
		} else {
			$img_align = ' cmsmasters_image_n';
		}
		
		
		$image_thumb = explode('|', $content);
		
		$image_id = $image_thumb[0];
		
		
		if (!isset($image_thumb[2]) || $image_thumb[2] == '') {
			$image_size = 'full';
		} else {
			$image_size = $image_thumb[2];
		}
		
		
		if (is_numeric($image_id)) {
			$image = wp_get_attachment_image_src($image_id, $image_size);
			
			$image_src = $image[0];
			
			$image_alt = trim(strip_tags(get_post_meta($image_id, '_wp_attachment_image_alt', true)));
			
			$out .= ($align == 'center' ? '<div class="aligncenter">' : '');
			
			
			$out .= '<div class="cmsmasters_img ' . esc_attr($img_align) . 
			(($caption != '') ? ' with_caption' : '') . 
			(($classes != '') ? ' ' . esc_attr($classes) : '') . 
			'"' . 
			(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
			'>' . 
				($link != '' ? '<a href="' . esc_url($link) . '"' . ($lightbox == 'true' ? ' rel="ilightbox[img_' . esc_attr(uniqid()) . ']"' : '') . ($target == 'true' ? ' target="_blank"' : '') . '>' : '') . 
					'<img src="' . esc_url($image_src) . '"' . ($image_alt != '' ? ' alt="' . esc_attr($image_alt) . '"' : '') . ' />' . 
				($link != '' ? '</a>' : '') . 
				($caption != '' ? '<p class="cmsmasters_img_caption">' . esc_html($caption) . '</p>' : '') . 
			'</div>';
			
			
			$out .= ($align == 'center' ? '</div>' : '');
		}
	}
	
	
	return $out;
}



/**
 * Gallery
 */
public function cmsmasters_gallery($atts, $content = null) { 
    $new_atts = apply_filters('cmsmasters_gallery_atts_filter', array( 
		'shortcode_id' => 			'', 
		'layout' => 				'', 
		'gallery_type' => 			'grid', 
		'gallery_count' => 			'', 
		'gallery_more_text' => 		'', 
		'gallery_padding' => 		'0', 
		'image_size_slider' => 		'', 
		'image_size_gallery' => 	'', 
		'hover_pause' => 			'5', 
		'hover_active' => 			'1', 
		'hover_pause_on_hover' => 	'true', 
		'slider_effect' => 			'', 
		'slider_autoplay' => 		'', 
		'slider_slideshow_speed' => '7', 
		'slider_animation_speed' => '600', 
		'slider_pause_on_hover' => 	'', 
		'slider_rewind' => 			'', 
		'slider_rewind_speed' => 	'1000', 
		'slider_nav_control' => 	'', 
		'slider_nav_arrow' => 		'', 
		'gallery_columns' => 		'', 
		'gallery_links' => 			'', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ) );
	
	
	$shortcode_name = 'gallery';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$images = explode(',', do_shortcode($content));
	
	
	$out = '';
	
	
	if ($layout == 'slider') {
		if ($image_size_slider == 'thumbnail' || $image_size_slider == 'medium' || $image_size_slider == 'large' || $image_size_slider == 'full') {
			$slider_size = get_option($image_size_slider . '_size_w');
		} else {
			$slider_size_array = cmsmasters_image_thumbnail_list();
			
			$slider_size = $slider_size_array[$image_size_slider]['width'];
		}
	} elseif ($layout == 'gallery') {
		if ($image_size_gallery == 'thumbnail' || $image_size_gallery == 'medium' || $image_size_gallery == 'large' || $image_size_gallery == 'full') {
			$slider_size = get_option($image_size_gallery . '_size_w');
		} else {
			$slider_size_array = cmsmasters_image_thumbnail_list();
			
			$slider_size = $slider_size_array[$image_size_gallery]['width'];
		}
	}
	
	if ($content != null) {
		if ($layout == 'hover') {
			$out .= '<div' . 
				' id="cmsmasters_hover_slider_' . esc_attr($unique_id) . '"' . 
				' class="cmsmasters_hover_slider' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '"' . 
				' data-thumb-width="100"' . 
				' data-thumb-height="60"' . 
				' data-active-slide="' . esc_attr($hover_active) . '"' . 
				' data-pause-time="' . esc_attr($hover_pause * 1000) . '"' . 
				' data-pause-on-hover="' . esc_attr($hover_pause_on_hover) . '"' . 
				(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
				(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
			'>' . 
				'<ul class="cmsmasters_hover_slider_items">' . "\n";
				
				
				foreach ($images as $image) { 
					$out .= '<li>' . 
						'<figure class="cmsmasters_hover_slider_full_img">' . 
							wp_get_attachment_image(strstr($image, '|', true), 'post-thumbnail') . 
						'</figure>' . 
					'</li>';
				}
				
				
				$out .= '</ul>' . "\n" . 
			'</div>' . "\n";
		} elseif ($layout == 'slider') {
			$slider_autoplay = ($slider_autoplay != 'true' ? 'false' : ((int) $slider_slideshow_speed * 1000));
			$slider_pause_on_hover = ($slider_pause_on_hover != 'true' ? 'false' : 'true');
			$slider_rewind = ($slider_rewind != 'true' ? 'false' : 'true');
			$slider_effect = ($slider_effect == 'slide' ? 'false' : 'fade');
			$slider_nav_control = ($slider_nav_control != 'true' ? 'false' : 'true');
			$slider_nav_arrow = ($slider_nav_arrow != 'true' ? 'false' : 'true');
			
			$out .= '<div class="cmsmasters_content_slider_wrap' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '" style="max-width:' . esc_attr($slider_size) . 'px;"' . 
			(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
			'>' . 
				"<div" . 
					" id=\"cmsmasters_slider_" . esc_attr($unique_id) . "\"" . 
					" class=\"cmsmasters_owl_slider owl-carousel cmsmasters_content_slider\"" . 
					" data-auto-play=\"" . esc_attr($slider_autoplay) . "\"" . 
					" data-stop-on-hover=\"" . esc_attr($slider_pause_on_hover) . "\"" . 
					" data-rewind-nav=\"" . esc_attr($slider_rewind) . "\"" . 
					" data-slide-speed=\"" . esc_attr($slider_animation_speed) . "\"" . 
					" data-pagination-speed=\"" . esc_attr($slider_animation_speed) . "\"" . 
					" data-rewind-speed=\"" . esc_attr($slider_rewind_speed) . "\"" . 
					" data-transition-style=\"" . esc_attr($slider_effect) . "\"" . 
					" data-pagination=\"" . esc_attr($slider_nav_control) . "\"" . 
					" data-navigation=\"" . esc_attr($slider_nav_arrow) . "\"" . 
				">";
			
			
			foreach ($images as $image) { 
				$out .= '<div class="cmsmasters_owl_slider_item cmsmasters_content_slider_item">' . 
					wp_get_attachment_image(strstr($image, '|', true), $image_size_slider) . 
				'</div>';
			}
			
			$out .= '</div>' . "\n" . 
			'</div>' . "\n";
		} else {
			$gallery_more_text = ($gallery_more_text != '') ? $gallery_more_text : esc_html__('Load More', 'cmsmasters-content-composer');
			
			$out_gallery_items = '';
			
			$hidden_gallery_items = '';
			
			$gallery_count = (($gallery_count == '' || $gallery_count == 0) ? 0 : $gallery_count);
			
			
			$i = 0;
			
			foreach ($images as $image) {
				$i += 1;
				
				$image_src = wp_get_attachment_image_src(strstr($image, '|', true), 'full');
				
				$image_caption = wp_get_attachment_caption(strstr($image, '|', true));
				
				$gallery_item = '<li class="cmsmasters_gallery_item' . ((get_post_field('post_excerpt', strstr($image, '|', true)) != '') ? ' cmsmasters_caption' : '') . '">' . 
					'<figure>';
						
						if ($gallery_links != 'none') {
							$gallery_item .= '<a'. (($gallery_links == 'blank') ? ' target="_blank"' : '') . ' href="' . esc_url($image_src[0]) . '"' . (($gallery_links == 'lightbox' && ($gallery_count == 0 || $i <= $gallery_count)) ? ' rel="ilightbox[' . esc_attr($unique_id) . ']"' : '') . ($image_caption != '' ? ' data-caption="' . esc_attr($image_caption) . '"' : '') . '>';
						}
						
						$gallery_item .= wp_get_attachment_image(strstr($image, '|', true), $image_size_gallery);
						
						if ($gallery_links != 'none') {
							$gallery_item .= '</a>';
						}
						
						$gallery_item .= ((get_post_field('post_excerpt', strstr($image, '|', true)) != '') ? '<figcaption>' . get_post_field('post_excerpt', strstr($image, '|', true)) . '</figcaption>' : '') . 
					'</figure>' . 
				'</li>';
				
				
				if ($gallery_count == 0 || $i <= $gallery_count) {
					$out_gallery_items .= $gallery_item;
				} else {
					$hidden_gallery_items .= $gallery_item;
				}
			}
			
			
			$out .= '<div' . 
				' id="cmsmasters_gallery_' . esc_attr($unique_id) . '"' . 
				' class="cmsmasters_gallery_wrap' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '"' . 
				' data-type="' . esc_attr($gallery_type) . '"' . 
				' data-count="' . esc_attr($gallery_count) . '"' . 
				(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
				(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
			'>';
			
			
			wp_enqueue_script('isotope');
			
			wp_enqueue_script('isotopeMode');
			
			
			$shortcode_styles = "
				#cmsmasters_gallery_" . esc_attr($unique_id) . " .cmsmasters_gallery {
					margin:0 0 0 -" . esc_attr($gallery_padding) . "px;
				}
				
				#cmsmasters_gallery_" . esc_attr($unique_id) . " .cmsmasters_gallery .cmsmasters_gallery_item {
					padding:0 0 " . esc_attr($gallery_padding) . "px " . esc_attr($gallery_padding) . "px;
				}
			";
			
			
			$out .= $this->cmsmasters_generate_front_css($shortcode_styles);
			
			
			$out .= '<ul class="cmsmasters_gallery' . 
				(($gallery_columns != '') ? ' cmsmasters_' . esc_attr($gallery_columns) : '') . 
				' cmsmasters_more_items_loader' . 
			'">' . 
				$out_gallery_items . 
			'</ul>';
			
			
			if ($hidden_gallery_items != '') {
				$out .= '<ul class="cmsmasters_hidden_gallery dn">' . 
					$hidden_gallery_items . 
				'</ul>';
				
				
				$out .= '<div class="cmsmasters_wrap_more_items">' . 
					'<div class="cmsmasters_more_gallery_items cmsmasters_wrap_items_loader">' . 
						'<a href="' . esc_js("javascript:void(0)") . '" class="cmsmasters_button cmsmasters_gallery_items_loader cmsmasters_items_loader">' . 
							'<span>' . esc_html($gallery_more_text) . '</span>' . 
						'</a>' . 
					'</div>' . 
				'</div>';
			}
			
			
			$out .= "</div>";
		}
		
		return $out;
	}
}



/**
 * Quotes
 */
public $quotes_atts;

public function cmsmasters_quotes($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_quotes_atts_filter', array( 
		'shortcode_id' => 		'', 
		'mode' => 				'grid', 
		'columns' => 			'2', 
		'speed' => 				'10', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'quotes';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	if ($columns == '4') {
		$new_columns = 'quote_four';
	} elseif ($columns == '3') {
		$new_columns = 'quote_three';
	} elseif ($columns == '2') {
		$new_columns = 'quote_two';
	} else {
		$new_columns = 'quote_one';
	}
	
	
	$this->quotes_atts = array(
		'quote_mode' => 	$mode, 
		'quote_counter' => 	0, 
		'column_count' => 	$columns, 
		'quote_content' => 	'', 
		'quote_image' => 	'', 
		'quote_name' => 	'', 
		'quote_subtitle' => '', 
		'quote_link' => 	'', 
		'quote_website' => 	'' 
	);
	
	
	$unique_id = $shortcode_id;
	
	$quotes_out = '';
	
	
	$quote_out = do_shortcode($content);
	
	
	if ($this->quotes_atts['quote_mode'] == 'slider') {
		$autoplay = ($speed > 0 ? $speed * 1000 : 'false');
		
		$quotes_out .= '<div class="cmsmasters_quotes_slider_wrap' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'>' . "\n" . 
			"<div" . 
				" id=\"cmsmasters_quotes_slider_" . esc_attr($unique_id) . "\"" . 
				" class=\"cmsmasters_owl_slider owl-carousel cmsmasters_quotes cmsmasters_quotes_slider\"" . 
				" data-auto-play=\"" . esc_attr($autoplay) . "\"" . 
			">" . 
				$quote_out . 
			'</div>' . "\n" . 
		'</div>';
	} else {
		$quotes_out .= '<div class="cmsmasters_quotes cmsmasters_quotes_grid ' . esc_attr($new_columns) . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'>' . "\n" . 
			'<span class="cmsmasters_quotes_vert"><span></span></span>' . 
			'<div class="cmsmasters_quotes_list">' . "\n" . 
				$quote_out . 
				'<span class="cl"></span>' . 
			'</div>' . "\n" . 
		'</div>';
	}
	
	
	return $quotes_out;
}

/**
 * Single Quote
 */
public function cmsmasters_quote($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_quote_atts_filter', array( 
		'shortcode_id' => 	'', 
		'image' => 			'', 
		'name' => 			'', 
		'subtitle' => 		'', 
		'link' => 			'', 
		'website' => 		'', 
		'classes' => 		'' 
    ) );
	
	
	$shortcode_name = 'quote';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	if ($content == null || $content == "<br />\n") {
		$this->quotes_atts['quote_content'] = esc_html__('Enter quote text here', 'cmsmasters-content-composer');
	} else {
		$this->quotes_atts['quote_content'] = $content;
	}
	
	$this->quotes_atts['quote_image'] = 	$image;
	$this->quotes_atts['quote_name'] = 		$name;
	$this->quotes_atts['quote_subtitle'] = 	$subtitle;
	$this->quotes_atts['quote_link'] = 		$link;
	$this->quotes_atts['quote_website'] = 	$website;
	
	
	$quote_out = '';
	
	
	if ($this->quotes_atts['quote_mode'] == 'grid' && ($this->quotes_atts['quote_counter'] == $this->quotes_atts['column_count'])) {
		$quote_out .= '<span class="cl"></span></div><div class="cmsmasters_quotes_list">';
		
		$this->quotes_atts['quote_counter'] = 0;
	}
	
	$this->quotes_atts['quote_counter']++;
	
	
	$quote_out .= '<div class="cmsmasters_quote' . 
		($this->quotes_atts['quote_mode'] == 'slider' ? ' cmsmasters_owl_slider_item' : '') . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'">' . "\n" . 
	
		cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/quote/quote-' . $this->quotes_atts['quote_mode'] . '.php', $this->quotes_atts) . 
		
	'</div>' . "\n";
	
	
	return $quote_out;
}



/**
 * Pricing Table Items
 */
public $pricing_table_items_atts;

public function cmsmasters_pricing_table_items($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_pricing_table_items_atts_filter', array( 
		'shortcode_id' => 		'', 
		'columns' => 			'4', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'pricing-table-items';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$this->pricing_table_items_atts = array(
		'style_pricing' => '' 
	);
	
	
	if ($columns == '4') {
		$price_columns = 'pricing_four';
	} elseif ($columns == '3') {
		$price_columns = 'pricing_three';
	} elseif ($columns == '2') {
		$price_columns = 'pricing_two';
	} else {
		$price_columns = 'pricing_one';
	}
	
	
	$price_out = do_shortcode($content);
	
	
	$shortcode_styles = (($this->pricing_table_items_atts['style_pricing'] != '') ? $this->pricing_table_items_atts['style_pricing'] : '');
	
	
	$out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$out .= '<div class="cmsmasters_pricing_table' . ' ' . esc_attr($price_columns) . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		$price_out . 
	'</div>' . "\n";
	
	
	return $out;
}

/**
 * Single Pricing Table Items
 */
public function cmsmasters_pricing_table_item($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_pricing_table_item_atts_filter', array( 
		'shortcode_id' => 			'', 
		'price' => 					'100', 
		'coins' => 					'', 
		'currency' => 				'$', 
		'period' => 				'', 
		'features' => 				'', 
		'best' => 					'', 
		'best_bg_color' => 			'', 
		'best_text_color' => 		'', 
		'button_show' => 			'', 
		'button_title' => 			'', 
		'button_link' => 			'#', 
		'button_target' => 			'', 
		'button_style' => 			'', 
		'button_font_family' => 	'', 
		'button_font_size' => 		'', 
		'button_line_height' => 	'', 
		'button_font_weight' => 	'', 
		'button_font_style' => 		'', 
		'button_padding_hor' => 	'', 
		'button_border_width' => 	'', 
		'button_border_style' => 	'', 
		'button_border_radius' => 	'', 
		'button_bg_color' => 		'', 
		'button_text_color' => 		'', 
		'button_border_color' => 	'', 
		'button_bg_color_h' => 		'', 
		'button_text_color_h' => 	'', 
		'button_border_color_h' => 	'', 
		'button_icon' => 			'', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ) );
	
	
	$shortcode_name = 'pricing-table-item';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$local_fonts = '';
	
	if ($button_font_family != '') {
		$font_family_array = str_replace('+', ' ', explode(':', $button_font_family));
		
		
		if (is_numeric($font_family_array[0])) {
			$font_family_name = "'" . $font_family_array[1] . "'";
			
			if (is_admin()) {
				$local_fonts .= 'cmsmasters_local_font_start=' . $button_font_family . '=cmsmasters_local_font_end';
			}
		} else {
			$font_family_name = "'" . $font_family_array[0] . "'";
			
			cmsmasters_theme_font($button_font_family, $button_font_family);
		}
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
			$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' { ' . 
				"\n\t" . cmsmasters_color_css('background-color', $best_bg_color) . 
			"\n" . '} ' . "\n";
		}
		
		
		if ($best_text_color != '') {
			$this->pricing_table_items_atts['style_pricing'] .= '#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .pricing_title, ' . 
			'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .pricing_title *, ' . 
			'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_price_wrap, ' . 
			'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .cmsmasters_price_wrap *, ' . 
			'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .feature_list, ' . 
			'#cmsmasters_pricing_item_' . esc_attr($unique_id) . ' .feature_list * { ' . 
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
				(($button_font_weight != '' && $button_font_weight != 'default') ? "\n\t" . 'font-weight:' . esc_attr($button_font_weight) . '; ' : '') . 
				(($button_font_style != '' && $button_font_style != 'default') ? "\n\t" . 'font-style:' . esc_attr($button_font_style) . '; ' : '') . 
				(($button_padding_hor != '') ? "\n\t" . 'padding-right:' . esc_attr($button_padding_hor) . 'px; ' : '') . 
				(($button_padding_hor != '') ? "\n\t" . 'padding-left:' . esc_attr($button_padding_hor) . 'px; ' : '') . 
				(($button_border_width != '') ? "\n\t" . 'border-width:' . esc_attr($button_border_width) . 'px; ' : '') . 
				(($button_border_style != '' && $button_border_style != 'default') ? "\n\t" . 'border-style:' . esc_attr($button_border_style) . '; ' : '') . 
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
	
	
	$price_out = $local_fonts;
	
	
	$price_out .= '<div id="cmsmasters_pricing_item_' . esc_attr($unique_id) . '" class="cmsmasters_pricing_item' . 
	(($best == 'true') ? ' pricing_best' : '') . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		'<div class="cmsmasters_pricing_item_inner">' . "\n" . 
			'<h3 class="pricing_title">' . esc_html($content) . '</h3>' . "\n" . 
			'<div class="cmsmasters_price_wrap">' . "\n" . 
			'<span class="cmsmasters_currency">' . esc_html($currency) . '</span>' . "\n" . 
			'<span class="cmsmasters_price">' . esc_html($price) . '</span>' . "\n" . 
			(($coins != '') ? '<span class="cmsmasters_coins">.' . esc_html($coins) . '</span>' . "\n" : '') . 
			(($period != '') ? '<br /><span class="cmsmasters_period">' . esc_html($period) . '</span>' . "\n" : '') . 
			'</div>' . "\n";
			
			
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
	
	
	return $price_out;
}



/**
 * Google Map Markers
 */
public $google_map_markers_atts;

public function cmsmasters_google_map_markers($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_google_map_markers_atts_filter', array( 
		'shortcode_id' => 			'', 
		'address_type' => 			'', 
		'address' => 				'', 
		'latitude' => 				'', 
		'longitude' => 				'', 
		'type' => 					'', 
		'zoom' => 					'14', 
		'height_type' => 			'', 
		'height' => 				'300', 
		'scroll_wheel' => 			'false', 
		'double_click_zoom' => 		'false', 
		'pan_control' => 			'false', 
		'zoom_control' => 			'false', 
		'map_type_control' => 		'false', 
		'scale_control' => 			'false', 
		'street_view_control' => 	'false', 
		'overview_map_control' => 	'false', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ) );
	
	
	$shortcode_name = 'google-map-markers';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$this->google_map_markers_atts = array(
		'map_out' => '' 
	);
	
	
	do_shortcode($content);
	
	
	$unique_id = $shortcode_id;
	
	$shortcode_styles = '';
	
	
	if ($height_type == 'fixed') {
		$shortcode_styles .= "\n" . 
			'#google_map_' . esc_attr($unique_id) . '{' . "\n\t" . 
				'height: ' . esc_attr($height) . 'px;' . "\n" . 
			'}' . "\n" . 
		"\n";
	}
	
	
	$maps_out = $this->cmsmasters_generate_front_css($shortcode_styles);
	
	
	$maps_out .= ($height_type != 'fixed' ? '<div class="resizable_block">' . "\n" : '') . 
		'<div' . 
			' id="google_map_' . esc_attr($unique_id) . '"' . 
			' class="cmsmasters_google_map google_map' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '"';
			
			if ($address_type == 'address') {
				$maps_out .= ' data-address="' . esc_attr($address) . '"';
			} else {
				$maps_out .= ' data-latitude="' . esc_attr($latitude) . '"' . 
				' data-longitude="' . esc_attr($longitude) . '"';
			}
			
			$maps_out .= ' data-maptype="' . esc_attr($type) . '"' . 
			' data-zoom="' . esc_attr($zoom) . '"' . 
			' data-scrollwheel="' . esc_attr($scroll_wheel) . '"' . 
			' data-doubleclickzoom="' . esc_attr($double_click_zoom) . '"' . 
			' data-pan-control="' . esc_attr($pan_control) . '"' . 
			' data-zoom-control="' . esc_attr($zoom_control) . '"' . 
			' data-map-type-control="' . esc_attr($map_type_control) . '"' . 
			' data-scale-control="' . esc_attr($scale_control) . '"' . 
			' data-street-view-control="' . esc_attr($street_view_control) . '"' . 
			' data-overview-map-control="' . esc_attr($overview_map_control) . '"' . 
			' data-markers="' . esc_attr($this->google_map_markers_atts['map_out']) . '"' . 
			(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'></div>' . "\n" . 
	($height_type != 'fixed' ? '</div>' . "\n" : '');
	
	
	$maps_out = cmsmasters_divpdel($maps_out);
	
	
	return $maps_out;
}

/**
 * Google Map Marker
 */
public function cmsmasters_google_map_marker($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_google_map_marker_atts_filter', array( 
		'shortcode_id' => 	'', 
		'address_type' => 	'', 
		'address' => 		'', 
		'latitude' => 		'', 
		'longitude' => 		'', 
		'popup' => 			''
    ) );
	
	
	$shortcode_name = 'google-map-marker';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	if ($address_type == 'address') { 
		$this->google_map_markers_atts['map_out'] .= 'address: ' . esc_attr($address) . '///'; 
	} elseif  ($address_type == 'coordinates') { 
		$this->google_map_markers_atts['map_out'] .= 'latitude: ' . esc_attr($latitude) . '///' . 
		'longitude: ' . esc_attr($longitude) . '///';
	} 
	
	
	$this->google_map_markers_atts['map_out'] .= (($content != '') ? 'html: ' . str_replace(array("\r", "\n"), '', cmsmasters_divpdel($content)) . '///' : '') . 
	(($popup == 'true') ? 'popup: true///' : '');
	$this->google_map_markers_atts['map_out'] .= '|||';
}



/**
 * Social Sharing
 */
public function cmsmasters_social($atts, $content = null) {
    $new_atts = apply_filters('cmsmasters_social_atts_filter', array( 
		'shortcode_id' => 		'', 
		'facebook' => 			'', 
		'twitter' => 			'', 
		'pinterest' => 			'', 
		'type' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'social';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$page_link = urlencode(get_permalink());
	
	$social_title = cmsmasters_title(get_the_ID(), false);
	
	$website_name = get_bloginfo('name');
	
	
	$out = '';
	
	if ($facebook == 'true' || $twitter == 'true' || $pinterest == 'true') {
		$out .= '<div class="cmsmasters_sharing' . 
		(($type == 'vertical') ? ' social_vertical' : '') . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'>' . "\n";
		
		if ($twitter == 'true') {
			$out .= '<div class="share_wrap">' . "\n" . 
				'<a href="https://twitter.com/intent/tweet?text=' . urlencode(html_entity_decode(sprintf(esc_attr__("Check out '%s' on %s website", 'cmsmasters-content-composer'), $social_title, $website_name), ENT_QUOTES, 'UTF-8')) . '&url=' . $page_link . '" class="button cmsmasters-icon-twitter">' . esc_html__('Twitter', 'cmsmasters-content-composer') . '</a>' . "\n" . 
			'</div>' . "\n";
		}
		
		if ($pinterest == 'true') {
			$out .= '<div class="share_wrap">' . "\n" . 
				'<a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-custom="true" class="button cmsmasters_pinterest_button cmsmasters-icon-pinterest">' . esc_html__('Pinterest', 'cmsmasters-content-composer') . '</a>' . "\n" . 
			'</div>' . "\n";
		}
		
		if ($facebook == 'true') {
			$out .= '<div class="share_wrap">' . "\n" . 
				'<a href="https://www.facebook.com/sharer/sharer.php?display=popup&u=' . $page_link . '" class="button cmsmasters-icon-facebook">' . esc_html__('Facebook', 'cmsmasters-content-composer') . '</a>' . "\n" . 
			'</div>' . "\n";
		}
		
		$out .= '</div>' . "\n";
	}
	
	return $out;
}



/**
 * Custom HTML
 */
public function cmsmasters_html($atts, $content = null) {
    extract(shortcode_atts(array( 
		'shortcode_id' => 	'', 
		'classes' => 		'' 
    ), $atts));
	
	
	$out = '';
	
	
	if ($content != null ) {
		$out .= cmsmasters_divpdel('<div class="custom_html' . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'">' . "\n" . 
		wpautop(base64_decode($content)) . 
		'</div>' . "\n");
	}
	
	
	return $out;
}



/**
 * Custom JS
 */
public function cmsmasters_js($atts, $content = null) {
    extract(shortcode_atts(array( 
		'shortcode_id' => 	'', 
		'classes' => 		'' 
    ), $atts));
	
	
	$out = '';
	
	
	if ($content != null ) {
		$out .= '<div class="custom_js' . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'">' . "\n" . 
		'<script type="text/javascript">' . "\n" . 
			base64_decode($content) . 
		'</script>' . "\n" . 
		'</div>' . "\n";
	}
	
	
	return $out;
}



/**
 * Custom CSS
 */
public function cmsmasters_css($atts, $content = null) {
    extract(shortcode_atts(array( 
		'shortcode_id' => 	'' 
    ), $atts));
	
	
	$out = '';
	
	
	if ($content != null ) {
		$shortcode_styles = base64_decode($content);
		
		
		$out .= $this->cmsmasters_generate_front_css($shortcode_styles);
	}
	
	
	return $out;
}



/**
 * Sidebar
 */
public function cmsmasters_sidebar($atts, $content = null) { 
    extract(shortcode_atts(array( 
		'shortcode_id' => 	'', 
		'sidebar' => 		'', 
		'layout' => 		'', 
		'classes' => 		'' 
    ), $atts));
	
	
	$layout_sidebar = '';
	
	$out = '';
	
	
	if ($layout == '') {
		$layout_sidebar = 'sidebar_layout_11';
	} elseif ($layout == '1212') {
		$layout_sidebar = 'sidebar_layout_1212';
	} elseif ($layout == '1323') {
		$layout_sidebar = 'sidebar_layout_1323';
	} elseif ($layout == '2313') {
		$layout_sidebar = 'sidebar_layout_2313';
	} elseif ($layout == '1434') {
		$layout_sidebar = 'sidebar_layout_1434';
	} elseif ($layout == '3414') {
		$layout_sidebar = 'sidebar_layout_3414';
	} elseif ($layout == '131313') {
		$layout_sidebar = 'sidebar_layout_131313';
	} elseif ($layout == '121414') {
		$layout_sidebar = 'sidebar_layout_121414';
	} elseif ($layout == '141214') {
		$layout_sidebar = 'sidebar_layout_141214';
	} elseif ($layout == '141412') {
		$layout_sidebar = 'sidebar_layout_141412';
	} elseif ($layout == '14141414') {
		$layout_sidebar = 'sidebar_layout_14141414';
	}
	
	if(!function_exists('get_dynamic_sidebar')){
		function get_dynamic_sidebar($sidebar = 1) {
			$sidebar_contents = '';
			
			ob_start();
			
			dynamic_sidebar($sidebar);
			
			$sidebar_contents = ob_get_clean();
			
			return $sidebar_contents;
		}
	}
	
	if ($sidebar != '') {
		$out = '<div class="cmsmasters_sidebar ' . esc_attr($layout_sidebar) . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		'">' . 
		get_dynamic_sidebar($sidebar);
		
		$out .= '<div class="cl"></div>' . "\n" . 
		'</div>';
	}
	
	
	return $out;
}



/**
 * Twitter Stripe
 */
public function cmsmasters_twitter($atts, $content = null) { 
    $new_atts = apply_filters('cmsmasters_twitter_atts_filter', array( 
		'shortcode_id' => 		'', 
		'date' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'twitter';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	$unique_id = $shortcode_id;
	
	$out = '<div class="cmsmasters_twitter_wrap' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '"' . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . 
		'<div class="cmsmasters_theme_icon_user_twitter twr_icon"></div>' . "\n" . 
		"<div" . 
			" id=\"cmsmasters_twitter_" . esc_attr($unique_id) . "\"" . 
			" class=\"cmsmasters_twitter\"" . 
		">";
			$tweets = cmsmasters_get_tweets();
			
			if (!empty($tweets)) {
				foreach ($tweets as $t) {
					$out .= '<div class="cmsmasters_twitter_item">' . "\n" . 
						(($date == 'true') ? '<abbr title="" class="published">' . human_time_diff( $t['time'], current_time('timestamp') ) . ' ' . esc_html__('ago', 'cmsmasters-content-composer') . '</abbr>' : '') . 
						'<span class="cmsmasters_twitter_item_content">' . "\n" . $t['text'] . '</span>' . "\n" . 
					'</div>' . "\n";
				}
			} else {
				$out .= '<div class="cmsmasters_notice cmsmasters_notice_error cmsmasters_theme_icon_cancel">' . "\n" . 
					'<div class="notice_content">' . "\n" . 
						'<p>' . esc_html__('Please add your Twitter API keys', 'cmsmasters-content-composer') . ', ' . '<a target="_blank" href="http://cmsmasters.net/twitter-functionality/">' . esc_html__('read more how', 'cmsmasters-content-composer') . '</a></p>' . "\n" . 
					'</div>' . "\n" . 
				'</div>' . "\n";
			}
			
		$out .= '</div>' . 
	'</div>';
	
	return $out;
}



/**
 * Posts Slider
 */
public $posts_slider_atts;

public function cmsmasters_posts_slider($atts, $content = null) { 
    $new_atts = apply_filters('cmsmasters_posts_slider_atts_filter', array( 
		'shortcode_id' => 			'', 
		'orderby' => 				'', 
		'order' => 					'', 
		'post_type' => 				'', 
		'blog_categories' => 		'', 
		'portfolio_categories' => 	'', 
		'columns' => 				'', 
		'amount' => 				'', 
		'count' => 					'1000', 
		'pause' => 					'', 
		'speed' => 					'', 
		'blog_metadata' => 			'', 
		'portfolio_metadata' => 	'', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ) );
	
	
	$shortcode_name = 'posts-slider';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->posts_slider_atts = array(
		'cmsmasters_post_metadata' => 		$blog_metadata, 
		'cmsmasters_project_metadata' => 	$portfolio_metadata 
	);
	
	
	if (!isset($post_type) || $post_type == '') {
		$post_type = 'post';
	}
	
	
    $args = array( 
		'post_type' => 				$post_type,
		'orderby' => 				$orderby, 
		'order' => 					$order, 
		'posts_per_page' => 		$count, 
		'ignore_sticky_posts' => 	true 
	);
	
	
	if ($post_type == 'post' && $blog_categories != '') {
		$args['category_name'] = $blog_categories;
	} elseif ($post_type == 'project' && $portfolio_categories != '') {
		$cat_array = explode(",", $portfolio_categories);
		
		$args['tax_query'] = array(
			array( 
				'taxonomy' => 	'pj-categs', 
				'field' => 		'slug', 
				'terms' => 		$cat_array 
			)
		);
	}
	
	
	$query = new WP_Query($args);
	
	
	if ($post_type == 'post') {
		$columns = 1;
	}
	
	
	$amount_count = 0;
	
	$amount = ($amount == '' ? 1 : $amount);
	
	$pause = ($pause == '' ? 0 : $pause);
	
	$autoplay = ($pause > 0 ? $pause * 1000 : 'false');
	
	
	$out = "";
	
	
	if ($query->have_posts()) : 
		
		$out .= "<div class=\"cmsmasters_posts_slider" . 
			(($classes != '') ? ' ' . esc_attr($classes) : '') . 
		"\" " . 
			(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		">
			<div" . 
				" id=\"cmsmasters_slider_" . esc_attr($unique_id) . "\"" . 
				" class=\"cmsmasters_owl_slider owl-carousel\"" . 
				" data-items=\"" . esc_attr($columns) . "\"" . 
				" data-single-item=\"false\"" . 
				" data-auto-play=\"" . esc_attr($autoplay) . "\"" . 
			">";
				
				
				if ($post_type == 'post') {
					$out .= '<div class="cmsmasters_owl_slider_item">';
				
						while ($query->have_posts()) : $query->the_post();
							
							if ($amount_count == $amount) {
								$out .= '</div><div class="cmsmasters_owl_slider_item">';
								
								$amount_count = 0;
							}
							
							
							$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/posts-slider/slider-post.php', $this->posts_slider_atts);
							
							
							$amount_count ++;
							
						endwhile;
					
					$out .= '</div>';
				}
				
				
				if ($post_type == 'project') {
					while ($query->have_posts()) : $query->the_post();
						
						$out .= '<div class="cmsmasters_owl_slider_item">' . 
							cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/posts-slider/slider-project.php', $this->posts_slider_atts) . 
						'</div>';
						
					endwhile;
				}
				
				
			$out .= '</div>' . 
		'</div>';
	
	endif;
	
	
	wp_reset_postdata();
	
	
	return $out;
}



/**
 * Blog
 */
public $blog_atts;

public function cmsmasters_blog($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_blog_atts_filter', array( 
		'shortcode_id' => 		'', 
		'orderby' => 			'date', 
		'order' => 				'DESC', 
		'count' => 				'1000', 
		'categories' => 		'', 
		'layout' => 			'standard', 
		'layout_mode' => 		'', 
		'columns' => 			'', 
		'metadata' => 			'', 
		'filter' => 			'', 
		'filter_text' => 		'', 
		'filter_cats_text' => 	'', 
		'pagination' => 		'pagination', 
		'more_text' => 			'', 
		'classes' => 			'' 
	) );
	
	
	$shortcode_name = 'blog';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->blog_atts = array(
		'cmsmasters_metadata' => $metadata 
	);
	
	
	$more_text = ($more_text != '') ? $more_text : esc_html__('Load More Posts', 'cmsmasters-content-composer');
	
	
	$filter_text = ($filter_text != '') ? $filter_text : esc_html__('Filter', 'cmsmasters-content-composer');
	
	
	$filter_cats_text = ($filter_cats_text != '') ? $filter_cats_text : esc_html__('All Categories', 'cmsmasters-content-composer');
	
	
	$out = '<div' . 
		' id="blog_' . esc_attr($unique_id) . '"' . 
		' class="cmsmasters_wrap_blog entry-summary' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '"' . 
		' data-layout="' . esc_attr($layout) . '"' . 
		' data-layout-mode="' . esc_attr($layout_mode) . '"' . 
		' data-url="' . CMSMASTERS_CONTENT_COMPOSER_URL . '"' . 
		' data-orderby="' . esc_attr($orderby) . '"' . 
		' data-order="' . esc_attr($order) . '"' . 
		' data-count="' . esc_attr($count) . '"' . 
		' data-categories="' . esc_attr($categories) . '"' . 
		' data-metadata="' . esc_attr($metadata) . '"' . 
		' data-pagination="' . esc_attr($pagination) . '"' . 
	'>';
	
	
	if ( 
		$layout != 'standard' || 
		($layout == 'standard' && $pagination == 'more') 
	) {
		wp_enqueue_script('isotope');
		
		wp_enqueue_script('isotopeMode');
		
		
		if ($filter !== '') {
			$out .= "<div class=\"cmsmasters_post_filter_wrap cmsmasters_items_filter_wrap\">
				<div class=\"cmsmasters_post_filter cmsmasters_items_filter\">
					<span class=\"cmsmasters_post_filter_loader cmsmasters_items_filter_loader\"></span>
					<div class=\"cmsmasters_post_filter_block cmsmasters_items_filter_block\">
						<a class=\"cmsmasters_post_filter_but cmsmasters_items_filter_but cmsmasters_theme_icon_resp_nav button\">
							<span>" . esc_html($filter_text) . "</span>
						</a>
						<ul class=\"cmsmasters_post_filter_list cmsmasters_items_filter_list\">
							<li class=\"current\">
								<a class=\"button\" data-filter=\"article.post\"  title=\"" . esc_attr($filter_cats_text) . "\" href=\"" . esc_js("javascript:void(0)") . "\">
									<span>" . esc_html($filter_cats_text) . "</span>
								</a>
							</li>";
							
							
							$cat_args = array( 
								'orderby' => 	'name' 
							);
							
							
							if ($categories != '') {
								$cat_array = explode(',', $categories);
								
								
								for ($i = 0; $i < count($cat_array); $i++) {
									$idObj = get_category_by_slug($cat_array[$i]);
									
									$cat_array[$i] = $idObj->term_id;
								}
							} else {
								$cat_array = $categories;
							}
							
							
							if (is_array($cat_array) && count($cat_array) == 1 && $categories != '') {
								$cat_args['child_of'] = $categories;
							} elseif (is_array($cat_array) && count($cat_array) > 1) {
								$cat_args['include'] = $cat_array;
							}
							
							
							$post_categs = get_terms('category', $cat_args);
							
							
							if (is_array($post_categs) && !empty($post_categs)) {
								foreach ($post_categs as $post_categ) {
									$out .= "<li>
										<a class=\"button\" href=\"#\" data-filter=\"article.post[data-category~='" . esc_attr($post_categ->slug) . "']\" title=\"" . esc_attr($post_categ->name) . "\">
											<span>" . esc_html($post_categ->name) . "</span>
										</a>
									</li>";
								}
							}
							
						$out .= "</ul>
					</div>
				</div>
			</div>";
		}
	}
	
	$out .= '<div class="blog ' . 
		esc_attr($layout) . 
		(($layout_mode !== '') ? ' ' . esc_attr($layout_mode) : '') . 
		(($columns !== '') ? ' cmsmasters_' . esc_attr($columns) : '') . 
	'">';
	
	
	$orderby = ($orderby == 'popular') ? 'meta_value_num' : $orderby;
	
	
	$args = array( 
		'post_type' => 				'post', 
		'orderby' => 				$orderby, 
		'order' => 					$order, 
		'posts_per_page' => 		$count, 
		'category_name' => 			$categories 
	);
	
	
	if ($pagination == 'more') {
		$args['ignore_sticky_posts'] = 1;
	}
	
	
	if ($pagination == 'pagination') {
		$args['paged'] = absint( empty( $_GET["cmsmasters-{$shortcode_id}-page"] ) ? 1 : $_GET["cmsmasters-{$shortcode_id}-page"] );
	}
	
	if ($orderby == 'meta_value_num') {
		$args['meta_key'] = 'cmsmasters_likes';
	}
	
	
	$query = new WP_Query($args);
	
	
	if ($query->have_posts()) : 
		while ($query->have_posts()) : $query->the_post();
			if ($layout == 'columns') {
				$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/blog/post-masonry.php', $this->blog_atts);
			} elseif ($layout == 'timeline') {
				$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/blog/post-timeline.php', $this->blog_atts);
			} elseif (
				$layout != 'standard' && 
				$layout != 'columns' && 
				$layout != 'timeline' && 
				$layout != '' 
			) {
				$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/blog/post-' . $layout . '.php', $this->blog_atts);
			} else {
				$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/blog/post-default.php', $this->blog_atts);
			}
		endwhile;
		
		
		if ($pagination == 'more') {
			wp_enqueue_style('mediaelement');
			
			wp_enqueue_style('wp-mediaelement');
			
			
			wp_enqueue_script('mediaelement');
			
			wp_enqueue_script('wp-mediaelement');
		}
	endif;
	
	
	$out .= '</div>';
	
	
	if ($pagination !== 'disabled') {
		$out .= '<div class="cmsmasters_wrap_more_posts cmsmasters_wrap_more_items">';
		
			if ($pagination == 'pagination' && $query->max_num_pages > 1) {
				$out .= cmsmasters_pagination($query->max_num_pages, $shortcode_id);
			} elseif ($pagination == 'more' && $query->found_posts > $count) {
				$out .= "<div class=\"cmsmasters_wrap_post_loader cmsmasters_wrap_items_loader\">
					<a href=\"" . esc_js("javascript:void(0)") . "\" class=\"cmsmasters_button cmsmasters_post_loader cmsmasters_items_loader\">
						<span>" . esc_html($more_text) . "</span>
					</a>
				</div>";
			}
		
		$out .= '</div>';
	}
	
	$out .= '</div>';
	
	
	wp_reset_postdata();
	
	
	return $out;
}



/**
 * Portfolio
 */
public $portfolio_atts;

public function cmsmasters_portfolio($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_portfolio_atts_filter', array( 
		'shortcode_id' => 		'', 
		'orderby' => 			'date', 
		'order' => 				'DESC', 
		'count' => 				'1000', 
		'categories' => 		'', 
		'layout' => 			'grid', 
		'layout_mode' => 		'perfect', 
		'columns' => 			'4', 
		'metadata_grid' => 		'', 
		'metadata_puzzle' => 	'', 
		'gap' => 				'large', 
		'filter' => 			'', 
		'filter_text' => 		'', 
		'filter_cats_text' => 	'', 
		'sorting' => 			'', 
		'sorting_name_text' => 	'', 
		'sorting_date_text' => 	'', 
		'pagination' => 		'pagination', 
		'more_text' => 			'', 
		'classes' => 			'' 
	) );
	
	
	$shortcode_name = 'portfolio';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	if ($layout == 'puzzle') {
		$metadata = $metadata_puzzle;
	} else {
		$metadata = $metadata_grid;
	}
	
	
	$this->portfolio_atts = array(
		'cmsmasters_pj_metadata' => 	$metadata, 
		'cmsmasters_pj_layout_mode' => 	$layout_mode, 
		'cmsmasters_pj_gap' => 			$gap 
	);
	
	
	$more_text = ($more_text != '') ? $more_text : esc_html__('Load More Projects', 'cmsmasters-content-composer');
	
	$filter_text = ($filter_text != '') ? $filter_text : esc_html__('Filter', 'cmsmasters-content-composer');
	
	$filter_cats_text = ($filter_cats_text != '') ? $filter_cats_text : esc_html__('All Categories', 'cmsmasters-content-composer');
	
	$sorting_name_text = ($sorting_name_text != '') ? $sorting_name_text : esc_html__('Name', 'cmsmasters-content-composer');
	
	$sorting_date_text = ($sorting_date_text != '') ? $sorting_date_text : esc_html__('Date', 'cmsmasters-content-composer');
	
	
	$out = '<div' . 
		' id="portfolio_' . esc_attr($unique_id) . '"' . 
		' class="cmsmasters_wrap_portfolio entry-summary' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '"' . 
		' data-layout="' . esc_attr($layout) . '"' . 
		' data-layout-mode="' . esc_attr($layout_mode) . '"' . 
		' data-url="' . CMSMASTERS_CONTENT_COMPOSER_URL . '"' . 
		' data-orderby="' . esc_attr($orderby) . '"' . 
		' data-order="' . esc_attr($order) . '"' . 
		' data-count="' . esc_attr($count) . '"' . 
		' data-categories="' . esc_attr($categories) . '"' . 
		' data-metadata="' . esc_attr($metadata) . '"' . 
	'>';
	
	
	if ($filter != '' || $sorting != '') {
		$out .= "<div class=\"cmsmasters_project_filter_wrap cmsmasters_items_filter_wrap\">
			<div class=\"cmsmasters_project_filter cmsmasters_items_filter\">
				<span class=\"cmsmasters_project_filter_loader cmsmasters_items_filter_loader\"></span>";
				
				if ($sorting != '') {
					$out .= "<div class=\"cmsmasters_project_sort_block cmsmasters_items_sort_block\">
						<a href=\"#\" name=\"project_name\" title=\"" . esc_attr($sorting_name_text) . "\" class=\"button cmsmasters_project_sort_but cmsmasters_items_sort_but cmsmasters_theme_icon_slide_bottom" . 
						(($orderby == 'name') ? " current" . 
						(($order == 'DESC') ? " reversed" : "") : "") . 
						"\">
							<span>" . esc_html($sorting_name_text) . "</span>
						</a>
						<a href=\"#\" name=\"project_date\" title=\"" . esc_attr($sorting_date_text) . "\" class=\"button cmsmasters_project_sort_but cmsmasters_items_sort_but cmsmasters_theme_icon_slide_bottom" . 
						(($orderby == 'date') ? " current" . 
						(($order == 'DESC') ? " reversed" : "") : "") . 
						"\">
							<span>" . esc_html($sorting_date_text) . "</span>
						</a>
					</div>";
				}
				
				
				if ($filter != '') {
					$out .= "<div class=\"cmsmasters_project_filter_block cmsmasters_items_filter_block\">
						<a class=\"cmsmasters_project_filter_but cmsmasters_items_filter_but cmsmasters_theme_icon_resp_nav button\">
							<span>" . esc_html($filter_text) . "</span>
						</a>
						<ul class=\"cmsmasters_project_filter_list cmsmasters_items_filter_list\">
							<li class=\"current\">
								<a class=\"button\" data-filter=\"article.project\"  title=\"" . esc_attr($filter_cats_text) . "\" href=\"" . esc_js("javascript:void(0)") . "\">
									<span>" . esc_html($filter_cats_text) . "</span>
								</a>
							</li>";
							
							
							if ($categories != '') {
								$cat_array = explode(',', $categories);
								
								
								for ($i = 0; $i < count($cat_array); $i++) {
									$idObj = get_term_by('slug', $cat_array[$i], 'pj-categs');
									
									if (is_object($idObj)) {
										$cat_array[$i] = $idObj->term_id;
									}
								}
							} else {
								$cat_array = $categories;
							}
							
							
							$cat_args = array( 
								'orderby' => 	'name', 
								'include' => 	$cat_array 
							);
							
							
							$project_categs = get_terms('pj-categs', $cat_args);
							
							
							if (is_array($project_categs) && !empty($project_categs)) {
								foreach ($project_categs as $project_categ) {
									$out .= "<li>
										<a class=\"button\" href=\"#\" data-filter=\"article.project[data-category~='" . esc_attr($project_categ->slug) . "']\" title=\"" . esc_attr($project_categ->name) . "\">
											<span>" . esc_html($project_categ->name) . "</span>
										</a>
									</li>";
								}
							}
						
						$out .= "</ul>
					</div>";
				}
				
			$out .= "</div>
		</div>";
	}
	
	$out .= '<div class="portfolio ' . esc_attr($layout) . ' ' . esc_attr($gap) . '_gap ' . esc_attr($layout_mode) . 
		(($layout != 'puzzle') ? ' cmsmasters_' . esc_attr($columns) : '') . 
	'">';
	
	
	$orderby = ($orderby == 'popular') ? 'meta_value_num' : $orderby;
	
	
	$args = array( 
		'post_type' => 				'project', 
		'orderby' => 				$orderby, 
		'order' => 					$order, 
		'posts_per_page' => 		$count 
	);
	
	if ($layout == 'puzzle') {
		$args['ignore_sticky_posts'] = true;
	}
	
	if ($categories != '') {
		$cat_array = explode(",", $categories);
		
		$args['tax_query'] = array( 
			array( 
				'taxonomy' => 'pj-categs', 
				'field' => 'slug', 
				'terms' => $cat_array 
			)
		);
	}
	
	
	if ($pagination == 'pagination') {
		$args['paged'] = absint( empty( $_GET["cmsmasters-{$shortcode_id}-page"] ) ? 1 : $_GET["cmsmasters-{$shortcode_id}-page"] );
	}
	
	
	if ($orderby == 'meta_value_num') {
		$args['meta_key'] = 'cmsmasters_likes';
	}
	
	
	$query = new WP_Query($args);
	
	
	if ($query->have_posts()) : 
		while ($query->have_posts()) : $query->the_post();
			if ($layout == 'puzzle') {
				$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/portfolio/project-puzzle.php', $this->portfolio_atts);
			} else {
				$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/portfolio/project-grid.php', $this->portfolio_atts);
			}
		endwhile;
		
		
		if ($pagination == 'more') {
			wp_enqueue_style('mediaelement');
			
			wp_enqueue_style('wp-mediaelement');
			
			
			wp_enqueue_script('mediaelement');
			
			wp_enqueue_script('wp-mediaelement');
		}
	endif;
	
	
	$out .= '</div>';
	
	
	if ($pagination !== 'disabled') {
		$out .= '<div class="cmsmasters_wrap_more_projects cmsmasters_wrap_more_items">';
		
			if ($pagination == 'pagination' && $query->max_num_pages > 1) {
				$out .= cmsmasters_pagination($query->max_num_pages, $shortcode_id);
			} elseif ($pagination == 'more' && $query->found_posts > $count) {
				$out .= "<div class=\"cmsmasters_wrap_project_loader cmsmasters_wrap_items_loader\">
					<a href=\"" . esc_js("javascript:void(0)") . "\" class=\"cmsmasters_button cmsmasters_project_loader cmsmasters_items_loader\">
						<span>" . esc_html($more_text) . "</span>
					</a>
				</div>";
			}
		
		$out .= '</div>';
	}
	
	$out .= '</div>';
	
	
	wp_reset_postdata();
	
	
	return $out;
}



/**
 * Profiles
 */
public $profiles_atts;

public function cmsmasters_profiles($atts, $content = null) { 
    $new_atts = apply_filters('cmsmasters_profiles_atts_filter', array( 
		'shortcode_id' => 		'', 
		'orderby' => 			'', 
		'order' => 				'', 
		'count' => 				'1000', 
		'categories' => 		'', 
		'layout' => 			'', 
		'columns' => 			'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'profiles';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = uniqid();
	
	
	$this->profiles_atts = array(
		'profile_id' => $shortcode_id,
		'profile_columns' => $columns 
	);
	
	
	$args = array( 
		'post_type' => 				'profile', 
		'orderby' => 				$orderby, 
		'order' => 					$order, 
		'posts_per_page' => 		$count, 
		'ignore_sticky_posts' => 	true 
	);
	
	
	if ($categories != '') {
		$cat_array = explode(",", $categories);
		
		$args['tax_query'] = array( 
			array( 
				'taxonomy' => 	'pl-categs', 
				'field' => 		'slug', 
				'terms' => 		$cat_array 
			)
		);
	}
	
	
	$query = new WP_Query($args);
	
	
	$out = '';
	
	
	if ($query->have_posts()) :
		
		$out .= '<div id="cmsmasters_profile_' . esc_attr($unique_id) . '" class="cmsmasters_profile ' . esc_attr($layout) . 
			(($classes != '') ? ' ' . esc_attr($classes) : '') . 
			'"' . 
			(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
		'>' . "\n";
		
		
        while ($query->have_posts()) : $query->the_post();
			
			if ($layout == 'vertical') {
				$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/profile/profile-vertical.php', $this->profiles_atts);
			} else {
				$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_CONTENT_COMPOSER_THEME_STYLE . '/post-type/profile/profile-horizontal.php', $this->profiles_atts);
			}
			
		endwhile;
		
		
		$out .= '</div>' . "\n";
		
    endif;
	
	
	wp_reset_postdata();
	
	
	return $out;
}



/**
 * MailPoet
 */
public function cmsmasters_mailpoet($atts, $content = null) {
	if (!CMSMASTERS_MAILPOET) {
		return '';
	}
	
	
    $new_atts = apply_filters('cmsmasters_mailpoet_atts_filter', array( 
		'shortcode_id' => 		'', 
		'form_id' => 			'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			''  
    ) );
	
	
	$shortcode_name = 'mailpoet';
	
	$shortcode_path = CMSMASTERS_CONTENT_COMPOSER_TEMPLATE_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	if ($form_id == '') {
		return '';
	}
	
	
    $out = '<div class="cmsmasters_mailpoet' . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>';
	
	
	if (class_exists('\MailPoet\Config\Initializer')) {
		$formsRepository = \MailPoet\DI\ContainerWrapper::getInstance()->get( \MailPoet\Form\FormsRepository::class );
		$form = $formsRepository->findOneById( $form_id );
		$form_data = ( isset( $form ) && ! empty( $form->getBody() ) ? $form->getBody() : array() );
		
		
		if (
			count($form_data) == 2 && 
			(
				(
					isset($form_data['block-1']) && 
					$form_data['block-1']['type'] == 'text' && 
					$form_data['block-2']['type'] == 'submit' 
				) || (
					isset($form_data[0]) && 
					$form_data[0]['type'] == 'text' && 
					$form_data[1]['type'] == 'submit' 
				)
			)
		) {
			$out .= '<div class="cmsmasters_mailpoet_form">' . 
				do_shortcode('[mailpoet_form id="' . $form_id . '"]') . 
			'</div>';
		} else {
			$out .= do_shortcode('[mailpoet_form id="' . $form_id . '"]');
		}
	} elseif (class_exists('WYSIJA')) {
		$model_forms = WYSIJA::get('forms', 'model');
		
		$form_data = $model_forms->getOne(array('form_id' => (int) $form_id));
		
		if (isset($form_data['data'])) {
			$form_data = maybe_unserialize(base64_decode($form_data['data']));
			
			$form_data = $form_data['body'];
		} else {
			$form_data = array();
		}
		
		
		if (
			count($form_data) == 2 && 
			(
				(
					isset($form_data['block-1']) && 
					$form_data['block-1']['type'] == 'input' && 
					$form_data['block-2']['type'] == 'submit' 
				) || (
					isset($form_data[0]) && 
					$form_data[0]['type'] == 'input' && 
					$form_data[1]['type'] == 'submit' 
				)
			)
		) {
			$out .= '<div class="cmsmasters_mailpoet_form">' . 
				do_shortcode('[wysija_form id="' . $form_id . '"]') . 
			'</div>';
		} else {
			$out .= do_shortcode('[wysija_form id="' . $form_id . '"]');
		}
	}
	
	
	$out .= '</div>';
	
	
	return $out;
}

}

new Cmsmasters_Shortcodes();


function cmsmasters_theme_generate_front_css($css) {
	return is_admin() ? "<style type=\"text/css\" data-type=\"cmsmasters_shortcodes-custom-css\">$css</style>" : '';
}


