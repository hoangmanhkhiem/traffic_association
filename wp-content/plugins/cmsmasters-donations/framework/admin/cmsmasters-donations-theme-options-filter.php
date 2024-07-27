<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.2.2
 * 
 * CMSMasters Donations Options Filter
 * Created by CMSMasters
 * 
 */


function cmsmasters_donations_meta_fields($custom_all_meta_fields) {
	$custom_all_meta_fields_new = array();
	
	
	if (
		(isset($_GET['post_type']) && $_GET['post_type'] == 'campaign') || 
		(isset($_POST['post_type']) && $_POST['post_type'] == 'campaign') || 
		(isset($_GET['post']) && get_post_type($_GET['post']) == 'campaign') 
	) {
		$cmsmasters_option = array();
		
		$cmsmasters_option_name = 'cmsmasters_options_' . CMSMASTERS_DONATIONS_ACTIVE_THEME . '_single_campaign';
		
		
		if (get_option($cmsmasters_option_name) != false) {
			$option = get_option($cmsmasters_option_name);
			
			$cmsmasters_option = array_merge($cmsmasters_option, $option);
		}
		
		
		$cmsmasters_global_donations_campaign_layout = (isset($cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_layout']) && $cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_layout'] !== '') ? $cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_layout'] : 'r_sidebar';
		
		$cmsmasters_global_donations_campaign_title = (isset($cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_title']) && $cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_title'] !== '') ? (($cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_title'] == 1) ? 'true' : 'false') : 'true';
		
		$cmsmasters_global_donations_campaign_share_box = (isset($cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_share_box']) && $cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_share_box'] !== '') ? (($cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_share_box'] == 1) ? 'true' : 'false') : 'true';
		
		$cmsmasters_global_donations_campaign_author_box = (isset($cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_author_box']) && $cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_author_box'] !== '') ? (($cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_campaign_author_box'] == 1) ? 'true' : 'false') : 'true';
		
		$cmsmasters_global_donations_more_campaigns_box = (isset($cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_more_campaigns_box'])) ? $cmsmasters_option[CMSMASTERS_DONATIONS_ACTIVE_THEME . '_donations_more_campaigns_box'] : 'related';
		
		
		foreach ($custom_all_meta_fields as $custom_all_meta_field) {
			if ($custom_all_meta_field['id'] == 'cmsmasters_other_tabs') {
				$custom_all_meta_field['std'] = 'cmsmasters_campaign';
				
				
				$tabs_array = array();
				
				$tabs_array['cmsmasters_campaign'] = array( 
					'label' => esc_html__('Campaign', 'cmsmasters-donations'), 
					'value'	=> 'cmsmasters_campaign' 
				);
				
				
				foreach ($custom_all_meta_field['options'] as $key => $val) {
					$tabs_array[$key] = $val;
				}
				
				
				$custom_all_meta_field['options'] = $tabs_array;
				
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_layout' && 
				$custom_all_meta_field['type'] == 'tab_start'
			) {
				$custom_all_meta_field['std'] = '';
				
				
				$custom_all_meta_fields_new[] = array( 
					'id'	=> 'cmsmasters_campaign', 
					'type'	=> 'tab_start', 
					'std'	=> 'true' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Campaign Target', 'cmsmasters-donations'), 
					'desc'	=> esc_html__('do not add currency symbol', 'cmsmasters-donations'), 
					'id'	=> 'cmsmasters_campaign_target', 
					'type'	=> 'number', 
					'hide'	=> '', 
					'std'	=> '0', 
					'min' 	=> '0', 
					'max' 	=> '', 
					'step' 	=> '10', 
					'size' 	=> '10' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Campaign Funds', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_campaign_funds', 
					'type'	=> 'funds', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Campaign Title', 'cmsmasters-donations'), 
					'desc'	=> esc_html__('Show', 'cmsmasters-donations'), 
					'id'	=> 'cmsmasters_campaign_title', 
					'type'	=> 'checkbox', 
					'hide'	=> '', 
					'std'	=> $cmsmasters_global_donations_campaign_title 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Sharing Box', 'cmsmasters-donations'), 
					'desc'	=> esc_html__('Show', 'cmsmasters-donations'), 
					'id'	=> 'cmsmasters_campaign_sharing_box', 
					'type'	=> 'checkbox', 
					'hide'	=> '', 
					'std'	=> $cmsmasters_global_donations_campaign_share_box 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('About Author Box', 'cmsmasters-donations'), 
					'desc'	=> esc_html__('Show', 'cmsmasters-donations'), 
					'id'	=> 'cmsmasters_campaign_author_box', 
					'type'	=> 'checkbox', 
					'hide'	=> '', 
					'std'	=> $cmsmasters_global_donations_campaign_author_box 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('More Posts Box', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_campaign_more_posts', 
					'type'	=> 'select', 
					'hide'	=> '', 
					'std'	=> $cmsmasters_global_donations_more_campaigns_box, 
					'options' => array( 
						'related' => array( 
							'label' => esc_html__('Show Related Tab', 'cmsmasters-donations'), 
							'value'	=> 'related' 
						), 
						'popular' => array( 
							'label' => esc_html__('Show Popular Tab', 'cmsmasters-donations'), 
							'value'	=> 'popular' 
						), 
						'recent' => array( 
							'label' => esc_html__('Show Recent Tab', 'cmsmasters-donations'), 
							'value'	=> 'recent' 
						), 
						'hide' => array( 
							'label' => esc_html__('Hide More Posts Box', 'cmsmasters-donations'), 
							'value'	=> 'hide' 
						) 
					) 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__("'Donate Now' Button Text", 'cmsmasters-donations'), 
					'desc'	=> esc_html__("Enter the 'Donate Now' button text that should be used in you campaign", 'cmsmasters-donations'), 
					'id'	=> 'cmsmasters_campaign_read_more', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> esc_html__('Donate Now', 'cmsmasters-donations') 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'id'	=> 'cmsmasters_campaign', 
					'type'	=> 'tab_finish' 
				);
				
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_layout' && 
				$custom_all_meta_field['type'] != 'tab_start' && 
				$custom_all_meta_field['type'] != 'tab_finish'
			) {
				$custom_all_meta_field['std'] = $cmsmasters_global_donations_campaign_layout;
				
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} else {
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			}
		}
	} elseif (
		(isset($_GET['post_type']) && $_GET['post_type'] == 'donation') || 
		(isset($_POST['post_type']) && $_POST['post_type'] == 'donation') || 
		(isset($_GET['post']) && get_post_type($_GET['post']) == 'donation') 
	) {
		foreach ($custom_all_meta_fields as $custom_all_meta_field) {
			if ($custom_all_meta_field['id'] == 'cmsmasters_other_tabs') {
				$custom_all_meta_field['std'] = 'cmsmasters_donation';
				
				
				$tabs_array = array();
				
				$tabs_array['cmsmasters_donation'] = array( 
					'label' => esc_html__('Donation', 'cmsmasters-donations'), 
					'value'	=> 'cmsmasters_donation' 
				);
				
				$tabs_array['cmsmasters_donator'] = array( 
					'label' => esc_html__('Donator', 'cmsmasters-donations'), 
					'value'	=> 'cmsmasters_donator' 
				);
				
				
				foreach ($custom_all_meta_field['options'] as $key => $val) {
					$tabs_array[$key] = $val;
				}
				
				
				$custom_all_meta_field['options'] = $tabs_array;
				
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_layout' && 
				$custom_all_meta_field['type'] == 'tab_start'
			) {
				$custom_all_meta_field['std'] = '';
				
				
				$custom_all_meta_fields_new[] = array( 
					'id'	=> 'cmsmasters_donation', 
					'type'	=> 'tab_start', 
					'std'	=> 'true' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Amount', 'cmsmasters-donations'), 
					'desc'	=> esc_html__('do not add currency symbol. Note: changes apply only to appearance, not to money transfer process.', 'cmsmasters-donations'), 
					'id'	=> 'cmsmasters_donation_amount', 
					'type'	=> 'number', 
					'hide'	=> '', 
					'std'	=> '', 
					'min' 	=> '1', 
					'max' 	=> '', 
					'step' 	=> '1' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Recurrence', 'cmsmasters-donations'), 
					'desc'	=> esc_html__('Choose whether and how often you want to repeat this donation. Note: changes apply only to appearance, not to money transfer process.', 'cmsmasters-donations'), 
					'id'	=> 'cmsmasters_recurrence_period', 
					'type'	=> 'radio', 
					'hide'	=> '', 
					'std'	=> '1', 
					'options' => array( 
						'1' => array( 
							'label' => esc_html__('Not recurring', 'cmsmasters-donations'), 
							'value'	=> '1' 
						), 
						'7' => array( 
							'label' => esc_html__('Weekly', 'cmsmasters-donations'), 
							'value'	=> '7' 
						), 
						'30' => array( 
							'label' => esc_html__('Monthly', 'cmsmasters-donations'), 
							'value'	=> '30' 
						), 
						'365' => array( 
							'label' => esc_html__('Yearly', 'cmsmasters-donations'), 
							'value'	=> '365' 
						) 
					) 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Campaign', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donation_campaign', 
					'type'	=> 'select', 
					'hide'	=> '', 
					'std'	=> '', 
					'options' => cmsmasters_donations_get_campaigns() 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Hide Donator Information?', 'cmsmasters-donations'), 
					'desc'	=> esc_html__('Yes', 'cmsmasters-donations'), 
					'id'	=> 'cmsmasters_anonymous_donation', 
					'type'	=> 'checkbox', 
					'hide'	=> '', 
					'std'	=> 'false' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Donations Navigation Box', 'cmsmasters-donations'), 
					'desc'	=> esc_html__('Show', 'cmsmasters-donations'), 
					'id'	=> 'cmsmasters_donation_nav_box', 
					'type'	=> 'checkbox', 
					'hide'	=> '', 
					'std'	=> 'true' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'id'	=> 'cmsmasters_donation', 
					'type'	=> 'tab_finish' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'id'	=> 'cmsmasters_donator', 
					'type'	=> 'tab_start', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Donator Details Title', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_details_title', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> 'Details' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('First Name', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_firstname', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Last Name', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_lastname', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Email', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_email', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Company', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_company', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Address', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_address', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('City', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_city', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('State / Province', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_state', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Postal / Zip Code', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_zip', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Country', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_country', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Phone Number', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_phone', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Website', 'cmsmasters-donations'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_donator_website', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'id'	=> 'cmsmasters_donator', 
					'type'	=> 'tab_finish' 
				);
				
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_layout' && 
				$custom_all_meta_field['type'] != 'tab_start' && 
				$custom_all_meta_field['type'] != 'tab_finish'
			) {
				// remove layout field
			} elseif ($custom_all_meta_field['id'] == 'cmsmasters_sidebar_id') {
				// remove right/left sidebar field
			} else {
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			}
		}
	} else {
		$custom_all_meta_fields_new = $custom_all_meta_fields;
	}
	
	
	return $custom_all_meta_fields_new;
}

add_filter('get_custom_all_meta_fields_filter', 'cmsmasters_donations_meta_fields');



/* Get Donation Campaigns Array For Select */
function cmsmasters_donations_get_campaigns() {
	$campaigns = get_posts(array( 
		'post_type' => 			'campaign', 
		'orderby' => 			'post_date', 
		'order' => 				'ASC', 
		'posts_per_page' => 	-1 
	) );
	
	
	$array = array();
	
	
	$array[''] = array( 
		'label' => 	esc_html__('No special campaign', 'cmsmasters-donations'), 
		'value' => 	'' 
	);
	
	
	foreach ($campaigns as $campaign) {
		$array[$campaign->ID] = array( 
			'label' => 	$campaign->post_title, 
			'value' => 	$campaign->ID 
		);
	}
	
	
	return $array;
}

