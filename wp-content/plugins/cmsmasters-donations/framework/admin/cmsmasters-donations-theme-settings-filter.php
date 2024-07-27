<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.3.1
 * 
 * CMSMasters Donations Settings Filter
 * Created by CMSMasters
 * 
 */


/* General Settings */
function cmsmasters_donations_options_general_fields($options, $tab) {
	$new_options = array();
	
	if ($tab == 'header') {
		foreach($options as $option) {
			if ($option['id'] == CMSMASTERS_DONATIONS_ACTIVE_THEME . '_header_top_line_short_info') {
				$new_options[] = $option;
				
				$new_options[] = array( 
					'section' => 'header_section', 
					'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_header_top_line_donations_but', 
					'title' => esc_html__('Top Donations Button', 'cmsmasters-donations'), 
					'desc' => esc_html__('show', 'cmsmasters-donations'), 
					'type' => 'checkbox', 
					'std' => 0 
				);
				
				$new_options[] = array( 
					'section' => 'header_section', 
					'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_header_top_line_donations_but_text', 
					'title' => esc_html__('Top Donations Button Text', 'cmsmasters-donations'), 
					'desc' => '', 
					'type' => 'text', 
					'std' => esc_html__('Donate Now!', 'cmsmasters-donations'), 
					'class' => 'nohtml' 
				);
				
				$new_options[] = array( 
					'section' => 'header_section', 
					'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_header_top_line_donations_but_link', 
					'title' => esc_html__('Top Donations Button URL', 'cmsmasters-donations'), 
					'desc' => esc_html__('If empty - links to the default donations form page', 'cmsmasters-donations'), 
					'type' => 'text', 
					'std' => '', 
					'class' => 'nohtml' 
				);
			} elseif ($option['id'] == CMSMASTERS_DONATIONS_ACTIVE_THEME . '_header_search') {
				$new_options[] = $option;
				
				$new_options[] = array( 
					'section' => 'header_section', 
					'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_header_donations_but', 
					'title' => esc_html__('Header Donations Button', 'cmsmasters-donations'), 
					'desc' => esc_html__('show', 'cmsmasters-donations'), 
					'type' => 'checkbox', 
					'std' => 0 
				);
				
				$new_options[] = array( 
					'section' => 'header_section', 
					'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_header_donations_but_text', 
					'title' => esc_html__('Header Donations Button Text', 'cmsmasters-donations'), 
					'desc' => '', 
					'type' => 'text', 
					'std' => esc_html__('Donate Now!', 'cmsmasters-donations'), 
					'class' => 'nohtml' 
				);
				
				$new_options[] = array( 
					'section' => 'header_section', 
					'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_header_donations_but_link', 
					'title' => esc_html__('Header Donations Button URL', 'cmsmasters-donations'), 
					'desc' => esc_html__('If empty - links to the default donations form page', 'cmsmasters-donations'), 
					'type' => 'text', 
					'std' => '', 
					'class' => 'nohtml' 
				);
			} else {
				$new_options[] = $option;
			}
		}
	} else {
		$new_options = $options;
	}
	
	
	return $new_options;
}

add_filter('cmsmasters_options_general_fields_filter', 'cmsmasters_donations_options_general_fields', 10, 2);



/* Single Settings */
// Settings Names
function cmsmasters_donations_option_name($cmsmasters_option_name, $tab) {
	if ($tab == 'campaign') {
		$cmsmasters_option_name = 'cmsmasters_options_' . CMSMASTERS_DONATIONS_ACTIVE_THEME . '_single_campaign';
	}
	
	
	return $cmsmasters_option_name;
}

add_filter('cmsmasters_option_name_filter', 'cmsmasters_donations_option_name', 10, 2);


// Add Settings
function cmsmasters_donations_add_global_options($cmsmasters_option_names) {
	$cmsmasters_option_names[] = array( 
		'cmsmasters_options_' . CMSMASTERS_DONATIONS_ACTIVE_THEME . '_single_campaign', 
		cmsmasters_donations_options_single_fields('', 'campaign') 
	);
	
	
	return $cmsmasters_option_names;
}

add_filter('cmsmasters_add_global_options_filter', 'cmsmasters_donations_add_global_options');


// Get Settings
function cmsmasters_donations_get_global_options($cmsmasters_option_names) {
	array_push($cmsmasters_option_names, 'cmsmasters_options_' . CMSMASTERS_DONATIONS_ACTIVE_THEME . '_single_campaign');
	
	
	return $cmsmasters_option_names;
}

add_filter('cmsmasters_get_global_options_filter', 'cmsmasters_donations_get_global_options');
add_filter('cmsmasters_settings_export_filter', 'cmsmasters_donations_get_global_options');


// Single Posts Settings
function cmsmasters_donations_options_single_tabs($tabs) {
	$tabs['campaign'] = esc_attr__('Campaign', 'cmsmasters-donations');
	
	
	return $tabs;
}

add_filter('cmsmasters_options_single_tabs_filter', 'cmsmasters_donations_options_single_tabs');


function cmsmasters_donations_options_single_sections($sections, $tab) {
	if ($tab == 'campaign') {
		$sections = array();
		
		$sections['campaign_section'] = esc_attr__('Donations Campaign Options', 'cmsmasters-donations');
	}
	
	
	return $sections;
}

add_filter('cmsmasters_options_single_sections_filter', 'cmsmasters_donations_options_single_sections', 10, 2);


function cmsmasters_donations_options_single_fields($options, $tab) {
	if (!is_array($options)) {
		$options = array();
	}
	
	
	if ($tab == 'campaign') {
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_layout', 
			'title' => esc_html__('Layout Type', 'cmsmasters-donations'), 
			'desc' => '', 
			'type' => 'radio_img', 
			'std' => 'r_sidebar', 
			'choices' => array( 
				esc_html__('Right Sidebar', 'cmsmasters-donations') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'cmsmasters-donations') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'cmsmasters-donations') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_title', 
			'title' => esc_html__('Campaign Title', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_date', 
			'title' => esc_html__('Campaign Date', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_cat', 
			'title' => esc_html__('Campaign Categories', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_author', 
			'title' => esc_html__('Campaign Author', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_comment', 
			'title' => esc_html__('Campaign Comments', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_tag', 
			'title' => esc_html__('Campaign Tags', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_like', 
			'title' => esc_html__('Campaign Likes', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_nav_box', 
			'title' => esc_html__('Campaign Navigation Box', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_share_box', 
			'title' => esc_html__('Sharing Box', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_author_box', 
			'title' => esc_html__('About Author Box', 'cmsmasters-donations'), 
			'desc' => esc_html__('show', 'cmsmasters-donations'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_more_campaigns_box', 
			'title' => esc_html__('More Campaigns Box', 'cmsmasters-donations'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => 'related', 
			'choices' => array( 
				esc_html__('Show Related Campaigns', 'cmsmasters-donations') . '|related', 
				esc_html__('Show Popular Campaigns', 'cmsmasters-donations') . '|popular', 
				esc_html__('Show Recent Campaigns', 'cmsmasters-donations') . '|recent', 
				esc_html__('Hide More Campaigns Box', 'cmsmasters-donations') . '|hide' 
			) 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_more_campaigns_count', 
			'title' => esc_html__('More Campaigns Box Items Number', 'cmsmasters-donations'), 
			'desc' => esc_html__('campaigns', 'cmsmasters-donations'), 
			'type' => 'number', 
			'std' => '3', 
			'min' => '2', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_more_campaigns_pause', 
			'title' => esc_html__('More Campaigns Slider Pause Time', 'cmsmasters-donations'), 
			'desc' => esc_html__("in seconds, if '0' - autoslide disabled", 'cmsmasters-donations'), 
			'type' => 'number', 
			'std' => '0', 
			'min' => '0', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'campaign_section', 
			'id' => CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_slug', 
			'title' => esc_html__('Campaign Slug', 'cmsmasters-donations'), 
			'desc' => esc_html__('Enter a page slug that should be used for your donations campaign single item', 'cmsmasters-donations'), 
			'type' => 'text', 
			'std' => 'campaign', 
			'class' => '' 
		);
	}
	
	
	return $options;
}

add_filter('cmsmasters_options_single_fields_filter', 'cmsmasters_donations_options_single_fields', 10, 2);

