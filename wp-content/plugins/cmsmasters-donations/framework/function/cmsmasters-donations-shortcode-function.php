<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.3.2
 * 
 * CMSMasters Donations Shortcodes Functions
 * Created by CMSMasters
 * 
 */


if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Cmsmasters_Donations_Shortcodes {

public function __construct() {
	add_shortcode('cmsmasters_submit_donation_form', array($this, 'cmsmasters_submit_donation_form'));
	
	add_shortcode('cmsmasters_donations', array($this, 'cmsmasters_donations'));
	
	add_shortcode('cmsmasters_campaigns', array($this, 'cmsmasters_campaigns'));
	
	add_shortcode('cmsmasters_featured_campaign', array($this, 'cmsmasters_featured_campaign'));
	
	add_filter('cmsmasters_button_atts_filter', array($this, 'cmsmasters_donations_button_atts'));
	
	add_filter('cmsmasters_button_link_filter', array($this, 'cmsmasters_donations_button_link'), 10, 2);
}



/**
 * Button
 */
public function cmsmasters_donations_button_atts($atts) {
	$atts['button_type'] = '';
	$atts['button_campaign'] = '';
	
	
	return $atts;
}

public function cmsmasters_donations_button_link($button_link, $shortcode_atts) {
	extract($shortcode_atts);
	
	
	if ($button_type == 'donation') {
		$cmsmasters_donations_form_page = get_option('cmsmasters_donations_form_page');
		
		
		if ($button_campaign != '') {
			$link = add_query_arg('campaign_id', urlencode($button_campaign), get_permalink($cmsmasters_donations_form_page));
		} else {
			$link = get_permalink($cmsmasters_donations_form_page);
		}
	} else {
		$link = $button_link;
	}
	
	
	return $link;
}



/**
 * Donation Submit Form
 */
public static function cmsmasters_submit_donation_form() {
	global $cmsmasters_donations_forms;
	
	
	wp_enqueue_style('cmsmasters-donations-form');
	
	
	if (is_rtl()) {
		wp_enqueue_style('cmsmasters-donations-form-rtl');
	}
	
	
	wp_enqueue_script('cmsmastersValidation');
	
	wp_enqueue_script('cmsmastersValidationLang');
	
	
	wp_enqueue_script('cmsmasters-donations-form-script');
	
	
	return $cmsmasters_donations_forms->get_form('submit-donation');
}



/**
 * Donations
 */
public $donations_atts;
 
public function cmsmasters_donations($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_donations_atts_filter', array( 
		'shortcode_id' => 		'', 
		'orderby' => 			'', 
		'order' => 				'', 
		'count' => 				'', 
		'campaigns' => 			'', 
		'columns' => 			'', 
		'donation_metadata' => 	'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'donations';
	
	$shortcode_path = CMSMASTERS_DONATIONS_THEME_SHORTCODES_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->donations_atts = array(
		'cmsmasters_donation_metadata' => 	$donation_metadata
	);
	
	$count = ($count == 0 ? -1 : $count);
	
	$args = array( 
		'post_type' => 				'donation', 
		'order' => 					$order, 
		'posts_per_page' => 		$count, 
		'post_status'=> 			'publish',
		'ignore_sticky_posts' => 	true 
	);
	
	
	if ($campaigns != '') {
		$args['meta_query'] = array( 
			array( 
				'key' => 		'cmsmasters_donation_campaign', 
				'value' => 		$campaigns, 
				'compare' => 	'IN'
			) 
		);
	}
	
	
	if ($orderby == 'cmsmasters_donation_amount') {
		$args['orderby'] = 'meta_value_num';
		
		$args['meta_key'] = $orderby;
	} else {
		$args['orderby'] = $orderby;
	}
	
	
	$query = new WP_Query($args);
	
	
	if ($columns == 1) {
		$columns_class = 'one_first';
	} elseif ($columns == 2) {
		$columns_class = 'one_half';
	} elseif ($columns == 3) {
		$columns_class = 'one_third';
	} elseif ($columns == 4) {
		$columns_class = 'one_fourth';
	}
	
	
	$counter = 0;
	
	$out = '';
	
	if ($query->have_posts()) :
		$out .= '<div id="donations_' . $unique_id . '" class="cmsmasters_donations' . 
			(($classes != '') ? ' ' . $classes : '') . 
			'"' . 
			(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n" . 
			'<div class="cmsmasters_row_margin">' . "\n";
				
				while ($query->have_posts()) : $query->the_post();
					if ($counter == $columns) {
						$out .= '</div>' . "\n" . 
						'<div class="cmsmasters_row_margin">' . "\n";
						
						$counter = 0;
					}
					
					$counter += 1;
					
					
					$out .= '<div class="cmsmasters_column ' . $columns_class . '">';
						if (class_exists('Cmsmasters_Content_Composer')) {
							$out .= cmsmasters_composer_ob_load_template('cmsmasters-donations/cmsmasters-framework/theme-style' . CMSMASTERS_DONATIONS_THEME_STYLE . '/post-type/donation-standard.php', $this->donations_atts);
						}
					$out .= '</div>';
					
				endwhile;
				
			$out .= '</div>' . "\n" . 
		'</div>' . "\n";
	endif;
	
	
	
	wp_reset_query();
	
	
	return $out;
}



/**
 * Featured Campaign
 */
public $campaign_atts;
 
public function cmsmasters_featured_campaign($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_featured_campaign_atts_filter', array( 
		'shortcode_id' => 		'', 
		'campaign' => 			'', 
		'campaign_metadata' => 	'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ) );
	
	
	$shortcode_name = 'featured-campaign';
	
	$shortcode_path = CMSMASTERS_DONATIONS_THEME_SHORTCODES_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->campaign_atts = array(
		'cmsmasters_campaign_metadata' => 	$campaign_metadata
	);
	
	
	$args = array( 
		'p' => 						$campaign, 
		'post_type' => 				'campaign', 
		'ignore_sticky_posts' => 	true 
	);
	
	
	$query = new WP_Query($args);
	
	
	$out = '';
	
	if ($query->have_posts()) :
		$out .= '<div id="featured_campaign_' . $unique_id . '" class="cmsmasters_featured_campaign' . 
			(($classes != '') ? ' ' . $classes : '') . 
			'"' . 
			(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n";
			
			while ($query->have_posts()) : $query->the_post();
				if (class_exists('Cmsmasters_Content_Composer')) {						
					$out .= cmsmasters_composer_ob_load_template('cmsmasters-donations/cmsmasters-framework/theme-style' . CMSMASTERS_DONATIONS_THEME_STYLE . '/post-type/campaign-vertical.php', $this->campaign_atts);
				}
			endwhile;
			
		$out .= '</div>' . "\n";
	endif;
	
	
	wp_reset_postdata();
	
	wp_reset_query();
	
	
	return $out;
}



/**
 * Campaigns
 */
public $campaigns_atts;

public function cmsmasters_campaigns($atts, $content = null) {
	$new_atts = apply_filters('cmsmasters_campaigns_atts_filter', array( 
		'shortcode_id' => 			'', 
		'orderby' => 				'', 
		'campaigns_ids' => 			'', 
		'order' => 					'', 
		'campaigns_categories' => 	'', 
		'columns' => 				'', 
		'count' => 					'', 
		'pause' => 					'5', 
		'campaigns_metadata' => 	'', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ) );
	
	
	$shortcode_name = 'campaigns';
	
	$shortcode_path = CMSMASTERS_DONATIONS_THEME_SHORTCODES_DIR . '/cmsmasters-' . $shortcode_name . '.php';
	
	
	if (locate_template($shortcode_path)) {
		ob_start();
		
		
		include(locate_template($shortcode_path));
		
		
		$template_out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $template_out;
	}
	
	
	extract(shortcode_atts($new_atts, $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$this->campaigns_atts = array(
		'cmsmasters_campaigns_metadata' => 	$campaigns_metadata
	);

	$count = ($count == 0 ? -1 : $count);

	$args = array( 
		'post_type' => 				'campaign', 
		'order' => 					$order, 
		'posts_per_page' => 		$count, 
		'ignore_sticky_posts' => 	true 
	);
	
	
	if ($orderby == 'campaigns' && $campaigns_ids != '') {
		$campaigns_ids_array = explode(',', $campaigns_ids);
		
		$args['post__in'] = $campaigns_ids_array;
		
		$args['orderby'] = 'menu_order';
	} else {
		$args['orderby'] = $orderby;
		
		if ($campaigns_categories != '') {
			$cat_array = explode(',', $campaigns_categories);
			
			$args['tax_query'] = array(
				array( 
					'taxonomy' => 	'cp-categs', 
					'field' => 		'slug', 
					'terms' => 		$cat_array 
				)
			);
		}
	}
	
	
	$query = new WP_Query($args);
	
	
	$autoplay = ($pause > 0 ? $pause * 1000 : 'false');
	
	
	$out = "";
	
	
	if ($query->have_posts()) : 
		
		$out .= "<div class=\"cmsmasters_campaigns" . 
			(($classes != '') ? ' ' . $classes : '') . 
		"\" " . 
			(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		">
			<div" . 
				" id=\"cmsmasters_owl_slider_" . esc_attr($unique_id) . "\"" . 
				" class=\"cmsmasters_owl_slider\"" . 
				" data-items=\"" . esc_attr($columns) . "\"" . 
				" data-single-item=\"false\"" . 
				" data-auto-play=\"" . esc_attr($autoplay) . "\"" . 
			">";
				
				while ($query->have_posts()) : $query->the_post();
					
					$out .= '<div class="cmsmasters_owl_slider_item">';
						if (class_exists('Cmsmasters_Content_Composer')) {
							$out .= cmsmasters_composer_ob_load_template('cmsmasters-donations/cmsmasters-framework/theme-style' . CMSMASTERS_DONATIONS_THEME_STYLE . '/post-type/campaign-horizontal.php', $this->campaigns_atts);
						}
					$out .= '</div>';
					
				endwhile;
				
			$out .= '</div>' . 
		'</div>';
	
	endif;
	
	
	wp_reset_postdata();
	
	wp_reset_query();
	
	
	return $out;
}


}

new Cmsmasters_Donations_Shortcodes();
