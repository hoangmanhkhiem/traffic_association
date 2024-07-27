<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.2.2
 * 
 * CMSMasters Donations Settings
 * Created by CMSMasters
 * 
 */


if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Cmsmasters_Donations_Settings {
	function __construct() {
		$this->settings_group = 'cmsmasters_donations';
		
		
		add_action('admin_init', array($this, 'register_settings'));
		
		
		add_action('admin_menu', array($this, 'admin_menu'));
		
		
		add_action('admin_enqueue_scripts', array($this, 'donations_admin_enqueue_scripts'));
	}
	
	
	protected function init_settings() {
		global $cmsmasters_emails;
		
		
		$this->settings = apply_filters('cmsmasters_donations_settings', array( 
			'donations' => array( 
				__('General', 'cmsmasters-donations'), 
				array( 
					array( 
						'name' => 			'cmsmasters_donations_form_page', 
						'std' => 			'', 
						'label' => 			__('Donations Submit Form Page', 'cmsmasters-donations'), 
						'desc' => 			__('Choose the page where you want to show donations submit form.', 'cmsmasters-donations'), 
						'type' => 			'select', 
						'options' => 		$this->donations_page_list() 
					), 
					array( 
						'name' => 			'cmsmasters_donations_target', 
						'std' => 			'', 
						'label' => 			__('Global Donations Target', 'cmsmasters-donations'), 
						'desc' => 			__('The amount of money you would like to collect.<br /> If empty, summarizes the targets of all campaigns.', 'cmsmasters-donations'), 
						'type' => 			'number', 
						'min' => 			'0', 
						'step' => 			'10' 
					), 
					array( 
						'name' => 			'cmsmasters_donations_currency_symbol', 
						'std' => 			'$', 
						'placeholder' => 	'e.g: $', 
						'label' => 			__('Donations Currency Symbol', 'cmsmasters-donations'), 
						'desc' => 			'' 
					), 
					array( 
						'name' => 			'cmsmasters_donations_currency_symbol_pos', 
						'std' => 			'before', 
						'label' => 			__('Currency Symbol Position', 'cmsmasters-donations'), 
						'desc' => 			'', 
						'type' => 			'radio', 
						'options' => array( 
							'before' => 	__('Before number', 'cmsmasters-donations'), 
							'after' => 		__('After number', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 			'cmsmasters_donations_currency_symbol_space', 
						'std' => 			'0', 
						'label' => 			__('Currency Symbol Space', 'cmsmasters-donations'), 
						'cb_label' => 		__('Insert space between currency symbol and amount?', 'cmsmasters-donations'), 
						'desc' => 			'', 
						'type' => 			'checkbox' 
					), 
					array( 
						'name' => 			'cmsmasters_confirm_donation', 
						'std' => 			'0', 
						'label' => 			__('Confirm Donations?', 'cmsmasters-donations'), 
						'cb_label' => 		__('Show donation confirm screen', 'cmsmasters-donations'), 
						'desc' => 			__('If checked, donation confirmation screen will be showen after form submition.', 'cmsmasters-donations'), 
						'type' => 			'checkbox' 
					) 
				) 
			), 
			'donation_form' => array( 
				__('Form', 'cmsmasters-donations'), 
				array( 
					array( 
						'name' => 			'cmsmasters_donations_form_content', 
						'std' => 			'', 
						'label' => 			__('Donations Page Content', 'cmsmasters-donations'), 
						'desc' => 			__('Enter the content that will be shown before the donations submit form.', 'cmsmasters-donations'), 
						'type' => 			'textarea', 
						'options' => 		'' 
					), 
					array( 
						'name' => 			'cmsmasters_payment_amount', 
						'std' => 			'5,10,20,50,100', 
						'placeholder' => 	__('e.g: 5,10,20,50,100', 'cmsmasters-donations'), 
						'label' => 			__('Donation Amount', 'cmsmasters-donations'), 
						'desc' => 			__('Enter the variants of donation amounts separated by commas', 'cmsmasters-donations') 
					), 
					array( 
						'name' => 			'cmsmasters_payment_method', 
						'std' => 			'required', 
						'label' => 			__('Payment Method', 'cmsmasters-donations'), 
						'desc' => 			__('If hidden - online payment method will be used by default', 'cmsmasters-donations'), 
						'type' => 			'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 			'cmsmasters_payment_recurrence', 
						'std' => 			'required', 
						'label' => 			__('Payment Recurrence', 'cmsmasters-donations'), 
						'desc' => 			__('If hidden - only onetime payment will be available. <br />Not working for <code>stripe</code> payment gateway.', 'cmsmasters-donations'), 
						'type' => 			'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_payment_campaign', 
						'std' => 		'optional', 
						'label' => 		__('Payment Campaign', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_message', 
						'std' => 		'optional', 
						'label' => 		__('Message', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_anonymous', 
						'std' => 		'optional', 
						'label' => 		__('Anonymous Donation', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_firstname', 
						'std' => 		'required', 
						'label' => 		__('First Name', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_lastname', 
						'std' => 		'required', 
						'label' => 		__('Last Name', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_email', 
						'std' => 		'required', 
						'label' => 		__('Email', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_company', 
						'std' => 		'hide', 
						'label' => 		__('Company', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_address', 
						'std' => 		'optional', 
						'label' => 		__('Address', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_city', 
						'std' => 		'hide', 
						'label' => 		__('City', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_state', 
						'std' => 		'hide', 
						'label' => 		__('State / Province', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_zip', 
						'std' => 		'optional', 
						'label' => 		__('Postal / Zip Code', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_country', 
						'std' => 		'hide', 
						'label' => 		__('Country', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_phone', 
						'std' => 		'hide', 
						'label' => 		__('Phone Number', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					), 
					array( 
						'name' => 		'cmsmasters_donator_website', 
						'std' => 		'hide', 
						'label' => 		__('Website', 'cmsmasters-donations'), 
						'desc' => 		'', 
						'type' => 		'radio', 
						'options' => array( 
							'required' => 	__('Required', 'cmsmasters-donations'), 
							'optional' => 	__('Optional', 'cmsmasters-donations'), 
							'hide' => 		__('Hide', 'cmsmasters-donations') 
						) 
					) 
				) 
			), 
			'donation_emails' => array( 
				__('Emails', 'cmsmasters-donations'), 
				array( 
					array( 
						'name' => 		'cmsmasters_donations_donator_email_template', 
						'std' => 		Cmsmasters_Donations_Emails::get_default_email(), 
						'label' => 		__('Donator Email Template', 'cmsmasters-donations'), 
						'desc' => 		__('Enter the content for the email sent to donators or leave blank to use the default message.', 'cmsmasters-donations') . '<br/>' . __('The following tags can be used to insert data dynamically:', 'cmsmasters-donations') . '<br/>' . '<code>{donator_firstname}</code>' . ' - ' . __('The donator firstname', 'cmsmasters-donations') . '<br/>' . '<code>{donator_lastname}</code>' . ' - ' . __('The donator lastname', 'cmsmasters-donations') . '<br/>' . '<code>{donation_date}</code>' . ' - ' . __('The donation date', 'cmsmasters-donations') . '<br/>' . '<code>{donation_amount}</code>' . ' - ' . __('The donation amount', 'cmsmasters-donations'), 
						'type' => 		'textarea' 
					) 
				) 
			) 
		));
	}
	
	
	public function register_settings() {
		$this->init_settings();
		
		
		foreach ($this->settings as $section) {
			foreach ($section[1] as $option) {
				if (isset($option['std'])) {
					add_option($option['name'], $option['std']);
				}
				
				
				register_setting($this->settings_group, $option['name']);
			}
		}
	}
	
	
	public function output() {
		$this->init_settings();
		
		
		echo '<div class="wrap">' . 
			'<form method="post" action="options.php">';
		
		
		settings_fields($this->settings_group);
		
		
		echo '<h2 class="nav-tab-wrapper">';
		
		
		foreach ($this->settings as $section) {
			echo '<a href="#settings-' . sanitize_title($section[0]) . '" class="nav-tab">' . esc_html($section[0]) . '</a>';
		}
		
		
		echo '</h2>' . 
		'<br/>';
		
		
		foreach ($this->settings as $section) {
			echo '<div id="settings-' . sanitize_title( $section[0] ) . '" class="settings_panel">' . 
				'<table class="form-table">';
			
			
			foreach ($section[1] as $option) {
				$option['type'] = !empty($option['type']) ? $option['type'] : '';
				
				$placeholder = !empty($option['placeholder']) ? ' placeholder="' . $option['placeholder'] . '"' : '';
				
				$min = !empty($option['min']) ? ' min="' . $option['min'] . '"' : '';
				
				$max = !empty($option['max']) ? ' max="' . $option['max'] . '"' : '';
				
				$step = !empty($option['step']) ? ' step="' . $option['step'] . '"' : '';
				
				
				$value = get_option($option['name']);
				
				
				$attributes = array();
				
				
				if (!empty($option['attributes']) && is_array($option['attributes'])) {
					foreach ($option['attributes'] as $attribute_name => $attribute_value) {
						$attributes[] = esc_attr($attribute_name) . '="' . esc_attr($attribute_value) . '"';
					}
				}
				
				
				echo '<tr valign="top" class="' . (!empty($option['class']) ? $option['class'] : '') . '">' . 
					'<th scope="row">' . 
						'<label for="setting-' . $option['name'] . '">' . $option['label'] . '</label>' . 
					'</th>' . 
					'<td>';
				
				
				switch ($option['type']) {
				case 'textarea':
					echo '<textarea id="setting-' . $option['name'] . '" class="large-text" cols="30" rows="7" name="' . $option['name'] . '"' . $placeholder . '>' . esc_textarea($value) . '</textarea>';
					
					
					if ($option['desc']) {
						echo ' <p class="description">' . $option['desc'] . '</p>';
					}
					
					
					break;
				case 'number':
					echo '<input id="setting-' . $option['name'] . '" class="number-text" type="number" name="' . $option['name'] . '" value="' . esc_attr($value) . '"' . $min . $max . $step . ' />';
					
					
					if ($option['desc']) {
						echo ' <p class="description">' . $option['desc'] . '</p>';
					}
					
					
					break;
				case 'select':
					echo '<select id="setting-' . $option['name'] . '" class="regular-text" name="' . $option['name'] . '">';
					
					
					foreach ($option['options'] as $key => $name) {
						echo '<option value="' . esc_attr($key) . '" ' . selected($value, $key, false) . '>' . esc_html($name) . '</option>';
					}
					
					
					echo '</select>';
					
					
					if ($option['desc']) {
						echo ' <p class="description">' . $option['desc'] . '</p>';
					}
					
					
					break;
				case 'radio':
					$i = 0;
					
					
					foreach ($option['options'] as $key => $name) {
						echo ($i != 0) ? '<br />' : '';
						
						
						echo '<label for="setting-' . $option['name'] . $i . '">' . 
							'<input id="setting-' . $option['name'] . $i . '" name="' . $option['name'] . '" type="radio" value="' . esc_attr($key) . '" ' . checked($value, esc_attr($key), false) . ' /> ' . 
							esc_html($name) . 
						'</label>';
						
						
						$i++;
					}
					
					
					if ($option['desc']) {
						echo ' <p class="description">' . $option['desc'] . '</p>';
					}
					
					
					break;
				case 'checkbox':
					echo '<label for="setting-' . $option['name'] . '">' . 
						'<input id="setting-' . $option['name'] . '" name="' . $option['name'] . '" type="checkbox" value="1" ' . checked('1', $value, false) . ' /> ' . 
						$option['cb_label'] . 
					'</label>';
					
					
					if ($option['desc']) {
						echo ' <p class="description">' . $option['desc'] . '</p>';
					}
					
					
					break;
				case 'upload':
					$image_array = explode('|', $option['std']);
					
					
					$id_array = explode('|', $value);
					
					
					$image = (isset($image_array[1]) && $image_array[1] != '') ? $image_array[1] : '';
					
					
					if ( 
						$value != $option['std'] && 
						isset($id_array[1]) && 
						$id_array[1] != '' 
					) {
						$image = $id_array[1];
					}
					
					
					echo '<div class="cmsmasters_upload_parent cmsmasters_select_parent">' . 
						'<input type="button" id="cmsmasters_upload_' . $option['name'] . '_button" class="cmsmasters_upload_button button button-large" value="' . esc_attr__('Choose Image', 'cmsmasters-donations') . '" data-title="' . esc_attr__('Choose Image', 'cmsmasters-donations') . '" data-button="' . __('Insert Image', 'cmsmasters-donations') . '" data-id="cmsmasters-media-select-frame-' . $option['name'] . '" data-classes="media-frame cmsmasters-media-select-frame cmsmasters-frame-no-description cmsmasters-frame-no-caption cmsmasters-frame-no-align cmsmasters-frame-no-link cmsmasters-frame-no-size" data-library="image" data-type="select" />' . 
						'<div class="cmsmasters_upload"' . (($image != '') ? ' style="display:block;"' : '') . '>' . 
							'<img src="' . (($image != '') ? $image : '') . '" class="cmsmasters_preview_image" alt="" />' . 
							'<a href="#" class="cmsmasters_upload_cancel admin-icon-remove" title="' . esc_attr__('Remove', 'cmsmasters-donations') . '"></a>' . 
						'</div>' . 
						'<input id="setting-' . $option['name'] . '" name="' . $option['name'] . '" type="hidden" class="cmsmasters_upload_image" value="' . $value . '" />' . 
					'</div>';
					
					
					if ($option['desc']) {
						echo ' <p class="description">' . $option['desc'] . '</p>';
					}
					
					
					break;
				default:
					echo '<input id="setting-' . $option['name'] . '" class="regular-text" type="text" name="' . $option['name'] . '" value="' . esc_attr($value) . '"' . $placeholder . ' />';
					
					
					if ($option['desc']) {
						echo ' <p class="description">' . $option['desc'] . '</p>';
					}
					
					
					break;
				}
				
				
				echo '</td>' . 
				'</tr>';
			}
			
			
			echo '</table>' . 
			'</div>';
		}
		
		
		echo '<p class="submit">' . 
					'<input type="submit" class="button-primary" value="' . __('Save Changes', 'cmsmasters-donations') . '" />' . 
				'</p>' . 
			'</form>' . 
		'</div>';
	}
	
	
	function donations_admin_enqueue_scripts() {
		wp_register_style('cmsmasters-donations-admin', CMSMASTERS_DONATIONS_URL . 'framework/admin/css/cmsmasters-donations.css', array(), CMSMASTERS_DONATIONS_VERSION, 'screen');
		
		wp_enqueue_style('cmsmasters-donations-admin');
		
		
		wp_register_script('cmsmasters-donations-admin-js', CMSMASTERS_DONATIONS_URL . 'framework/admin/js/cmsmasters-donations.js', array('jquery'), CMSMASTERS_DONATIONS_VERSION, true);
		
		
		if (isset($_GET['page']) && $_GET['page'] == 'cmsmasters-donations-settings') {
			wp_enqueue_script('cmsmasters-donations-admin-js');
		}
	}
	
	
	function admin_menu() {
		add_options_page( 
			__('Donations Settings', 'cmsmasters-donations'), 
			__('Donations', 'cmsmasters-donations'), 
			'manage_options', 
			'cmsmasters-donations-settings', 
			array($this, 'output') 
		);
	}
	
	
	function donations_page_list() {
		$pages = get_pages(array( 
			'hierarchical' => 	false 
		) );
		
		
		$list = array();
		
		
		foreach ($pages as $page) {
			$list[$page->ID] = $page->post_title;
		}
		
		
		return $list;
	}
}

$cmsmasters_donations_settings = new Cmsmasters_Donations_Settings();

