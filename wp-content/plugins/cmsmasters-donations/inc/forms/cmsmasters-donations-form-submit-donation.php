<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.3.1
 * 
 * CMSMasters Donations Submit Donation Form
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Donations_Form_Submit_Donation extends Cmsmasters_Donations_Form {
	public static $form_name = 'submit-donation';
	
	
	protected static $donation_id;
	
	protected static $steps;
	
	protected static $step;
	
	
	public static function init() {
		add_action('wp', array(__CLASS__, 'process'));
		
		
		self::$step = !empty($_REQUEST['step']) ? max(absint($_REQUEST['step']), 0) : 0;
		
		self::$donation_id = !empty($_REQUEST['donation_id']) ? absint($_REQUEST['donation_id']) : 0;
		
		
		self::$steps = (array) apply_filters('submit_donation_steps', array( 
			'submit' => array( 
				'name' => 		__('Submit Donation', 'cmsmasters-donations'), 
				'view' => 		array(__CLASS__, 'submit'), 
				'handler' => 	array(__CLASS__, 'submit_handler'), 
				'priority' =>	1 
			), 
			'preview' => array( 
				'name' => 		__('Confirmation', 'cmsmasters-donations'), 
				'view' => 		array(__CLASS__, 'preview'), 
				'handler' => 	array(__CLASS__, 'preview_handler'), 
				'priority' => 	2 
			), 
			'done' => array( 
				'name' => 		__('Done', 'cmsmasters-donations'), 
				'view' => 		array(__CLASS__, 'done'), 
				'priority' => 	3 
			) 
		) );
		
		
		usort(self::$steps, array(__CLASS__, 'sort_by_priority'));
		
		
		if ( 
			self::$donation_id && 
			!in_array(get_post_status(self::$donation_id), apply_filters('cmsmasters_donations_valid_submit_donation_statuses', array('preview'))) 
		) {
			self::$donation_id = 0;
			
			self::$step = 0;
		}
	}
	
	
	public static function init_fields() {
		if (self::$fields) {
			return;
		}
		
		
		$campaign_id = isset($_GET['campaign_id']) ? $_GET['campaign_id'] : false;
		
		
		self::$fields = array( 
			'donation' => array( 
				'donation_amount' => array( 
					'label' => 			__('Donation Amount', 'cmsmasters-donations'), 
					'type' => 			'donation_amount', 
					'required' => 		true, 
					'options' => 		explode(',', str_replace(' ', '', get_option('cmsmasters_payment_amount', '5,10,20,50,100'))), 
					'placeholder' => 	__('or enter your own donation amount, e.g: 85', 'cmsmasters-donations'), 
					'validation' => 	'required, custom[number]', 
					'priority' => 		1 
				), 
				'donation_payment_method' => array( 
					'label' => 			__('Payment Method', 'cmsmasters-donations'), 
					'description' => 	__('Select the payment method', 'cmsmasters-donations'),
					'type' => 			'radio',  
					'required' => 		true, 
					'value' => 			'online', 
					'options' => array( 
						'online' => 	__('Online payment', 'cmsmasters-donations'), 
						'offline' => 	__('Offline payment', 'cmsmasters-donations') 
					), 
					'validation' => 	'required', 
					'priority' => 		2 
				), 
				'recurring_donation' => array( 
					'label' => 			__('Recurrence', 'cmsmasters-donations'), 
					'description' => 	__('Select the payment interval', 'cmsmasters-donations'), 
					'type' => 			'select', 
					'required' => 		true, 
					'value' => 			'', 
					'options' => array( 
						'1' => 		__('One-time', 'cmsmasters-donations'), 
						'7' => 		__('Weekly', 'cmsmasters-donations'), 
						'30' => 	__('Monthly', 'cmsmasters-donations'), 
						'365' => 	__('Yearly', 'cmsmasters-donations') 
					), 
					'validation' => 	'', 
					'priority' => 		3 
				), 
				'donation_campaign' => array( 
					'label' => 			__('Campaigns', 'cmsmasters-donations'), 
					'description' => 	__('Select the campaign you would like to contribute to', 'cmsmasters-donations'), 
					'type' => 			'select', 
					'required' => 		((get_option('cmsmasters_payment_campaign') == 'required' || $campaign_id) ? true : false), 
					'options' => 		self::donation_campaigns(), 
					'disabled' => 		(($campaign_id) ? $campaign_id : false), 
					'validation' => 	((get_option('cmsmasters_payment_campaign') == 'required') ? 'required' : ''), 
					'priority' => 		4 
				), 
				'donation_message' => array( 
					'label' => 			__('Message', 'cmsmasters-donations'), 
					'type' => 			'textarea', 
					'required' => 		((get_option('cmsmasters_donator_message') == 'required') ? true : false), 
					'placeholder' => 	__('Your custom message text...', 'cmsmasters-donations'), 
					'validation' => 	((get_option('cmsmasters_donator_message') == 'required') ? 'required' : ''), 
					'priority' => 		5 
				), 
				'anonymous_donation' => array( 
					'label' => 			__('Anonymous donation?', 'cmsmasters-donations'), 
					'type' => 			'checkbox', 
					'required' => 		false, 
					'description' => 	__('Check this box to hide your personal info in our donators list', 'cmsmasters-donations'), 
					'value' => 			'false', 
					'validation' => 	'', 
					'priority' => 		6 
				) 
			), 
			'donator' => array( 
				'donator_firstname' => array( 
					'label' => 			__('First name', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_firstname') == 'required') ? true : false), 
					'placeholder' => 	'', 
					'validation' => 	((get_option('cmsmasters_donator_firstname') == 'required') ? 'required' : ''), 
					'priority' => 		1 
				), 
				'donator_lastname' => array( 
					'label' => 			__('Last name', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_lastname') == 'required') ? true : false), 
					'placeholder' => 	'', 
					'validation' => 	((get_option('cmsmasters_donator_lastname') == 'required') ? 'required' : ''), 
					'priority' => 		2 
				), 
				'donator_email' => array( 
					'label' => 			__('Email', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_email') == 'required') ? true : false), 
					'placeholder' => 	__('email@website.com', 'cmsmasters-donations'), 
					'validation' => 	((get_option('cmsmasters_donator_email') == 'required') ? 'required, custom[email]' : 'custom[email]'), 
					'priority' => 		3 
				), 
				'donator_company' => array( 
					'label' => 			__('Company', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_company') == 'required') ? true : false), 
					'placeholder' => 	'', 
					'validation' => 	((get_option('cmsmasters_donator_company') == 'required') ? 'required' : ''), 
					'priority' => 		4 
				), 
				'donator_address' => array( 
					'label' => 			__('Address', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_address') == 'required') ? true : false), 
					'placeholder' => 	'', 
					'validation' => 	((get_option('cmsmasters_donator_address') == 'required') ? 'required' : ''), 
					'priority' => 		5 
				), 
				'donator_city' => array( 
					'label' => 			__('City', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_city') == 'required') ? true : false), 
					'placeholder' => 	'', 
					'validation' => 	((get_option('cmsmasters_donator_city') == 'required') ? 'required' : ''), 
					'priority' => 		6 
				), 
				'donator_state' => array( 
					'label' => 			__('State / Province', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_state') == 'required') ? true : false), 
					'placeholder' => 	'', 
					'validation' => 	((get_option('cmsmasters_donator_state') == 'required') ? 'required' : ''), 
					'priority' => 		7 
				), 
				'donator_zip' => array( 
					'label' => 			__('Postal / Zip code', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_zip') == 'required') ? true : false), 
					'placeholder' => 	'', 
					'validation' => 	((get_option('cmsmasters_donator_zip') == 'required') ? 'required' : ''), 
					'priority' => 		8 
				), 
				'donator_country' => array( 
					'label' => 			__('Country', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_country') == 'required') ? true : false), 
					'placeholder' => 	'', 
					'validation' => 	((get_option('cmsmasters_donator_country') == 'required') ? 'required' : ''), 
					'priority' => 		9 
				), 
				'donator_phone' => array( 
					'label' => 			__('Phone number', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_phone') == 'required') ? true : false), 
					'placeholder' => 	__('area code + phone number', 'cmsmasters-donations'), 
					'validation' => 	((get_option('cmsmasters_donator_phone') == 'required') ? 'required, custom[onlyNumberSp]' : 'custom[onlyNumberSp]'), 
					'priority' => 		10 
				), 
				'donator_website' => array( 
					'label' => 			__('Website', 'cmsmasters-donations'), 
					'type' => 			'text', 
					'required' => 		((get_option('cmsmasters_donator_website') == 'required') ? true : false), 
					'placeholder' => 	__('http://', 'cmsmasters-donations'), 
					'validation' => 	((get_option('cmsmasters_donator_phone') == 'required') ? 'required, custom[url]' : 'custom[url]'), 
					'priority' => 		11 
				) 
			)
		);
		
		
		if (get_option('cmsmasters_payment_method') == 'hide') {
			unset(self::$fields['donation']['donation_payment_method']);
		}
		
		if (get_option('cmsmasters_payment_recurrence') == 'hide' || get_option('cmsmasters_donations_gateway') == 'stripe') {
			unset(self::$fields['donation']['recurring_donation']);
		}
		
		if (get_option('cmsmasters_payment_campaign') == 'hide' && !$campaign_id) {
			unset(self::$fields['donation']['donation_campaign']);
		}
		
		if (get_option('cmsmasters_donator_message') == 'hide') {
			unset(self::$fields['donation']['donation_message']);
		}
		
		if (get_option('cmsmasters_donator_anonymous') == 'hide') {
			unset(self::$fields['donation']['anonymous_donation']);
		}
		
		
		if (get_option('cmsmasters_donator_firstname') == 'hide') {
			unset(self::$fields['donator']['donator_firstname']);
		}
		
		if (get_option('cmsmasters_donator_lastname') == 'hide') {
			unset(self::$fields['donator']['donator_lastname']);
		}
		
		if (get_option('cmsmasters_donator_email') == 'hide') {
			unset(self::$fields['donator']['donator_email']);
		}
		
		if (get_option('cmsmasters_donator_company') == 'hide') {
			unset(self::$fields['donator']['donator_company']);
		}
		
		if (get_option('cmsmasters_donator_address') == 'hide') {
			unset(self::$fields['donator']['donator_address']);
		}
		
		if (get_option('cmsmasters_donator_city') == 'hide') {
			unset(self::$fields['donator']['donator_city']);
		}
		
		if (get_option('cmsmasters_donator_state') == 'hide') {
			unset(self::$fields['donator']['donator_state']);
		}
		
		if (get_option('cmsmasters_donator_zip') == 'hide') {
			unset(self::$fields['donator']['donator_zip']);
		}
		
		if (get_option('cmsmasters_donator_country') == 'hide') {
			unset(self::$fields['donator']['donator_country']);
		}
		
		if (get_option('cmsmasters_donator_phone') == 'hide') {
			unset(self::$fields['donator']['donator_phone']);
		}
		
		if (get_option('cmsmasters_donator_website') == 'hide') {
			unset(self::$fields['donator']['donator_website']);
		}
	}
	
	
	public static function process() {
		$keys = array_keys(self::$steps);
		
		
		if ( 
			isset($keys[self::$step]) && 
			is_callable(self::$steps[$keys[self::$step]]['handler']) 
		) {
			call_user_func(self::$steps[$keys[self::$step]]['handler']);
		}
	}
	
	
	public static function output() {
		$keys = array_keys(self::$steps);
		
		
		self::show_errors();
		
		
		if ( 
			isset($keys[self::$step]) && 
			is_callable(self::$steps[$keys[self::$step]]['view']) 
		) {
			call_user_func(self::$steps[$keys[self::$step]]['view']);
		}
	}
	
	
	public static function submit() {
		global $cmsmasters_donations, 
			$post;
		
		
		self::init_fields();
		
		
		if ( 
			!empty($_POST['edit_donation']) && 
			self::$donation_id 
		) {
			$donation = get_post(self::$donation_id);
			
			
			foreach (self::$fields as $group_key => $fields) {
				foreach ($fields as $key => $field) {
					switch ($key) {
					case 'donation_message':
						self::$fields[$group_key][$key]['value'] = $donation->post_excerpt;
						
						
						break;
					case 'recurring_donation' :
						self::$fields[$group_key][$key]['value'] = get_post_meta($donation->ID, 'cmsmasters_recurrence_period', true);
						
						
						break;
					default:
						self::$fields[$group_key][$key]['value'] = get_post_meta($donation->ID, 'cmsmasters_' . $key, true);
						
						
						break;
					}
				}
			}
			
			
			self::$fields = apply_filters('submit_donation_form_fields_get_donation_data', self::$fields, $donation);
		}
		
		
		if (get_option('cmsmasters_confirm_donation') == 1) {
			$template_donation_id = self::get_donation_id();
		} elseif ( 
			self::get_donation_id() == 0 || 
			(isset($_GET['cancel']) && $_GET['cancel'] == 'true') 
		) {
			$template_donation_id = 1;
		} else {
			$template_donation_id = self::get_donation_id();
		}
		
		
		get_cmsmasters_donations_template('donation-submit.php', array( 
			'form' => 					self::$form_name, 
			'donation_id' => 			$template_donation_id, 
			'action' => 				self::get_action(), 
			'donation_fields' => 		self::get_fields('donation'), 
			'donator_fields' => 		self::get_fields('donator'), 
			'confirm_donation' => 		get_option('cmsmasters_confirm_donation'), 
			'submit_button_text' => 	((get_option('cmsmasters_confirm_donation') == 1) ? __('Confirm donation', 'cmsmasters-donations') : __('Submit donation', 'cmsmasters-donations')) 
		) );
		
		
		if ( 
			get_option('cmsmasters_confirm_donation') != 1 && 
			isset($_GET['cancel']) && 
			$_GET['cancel'] == 'true' 
		) {
			$update_donation = array();
			
			
			$update_donation['ID'] = $_GET['donation_id'];
			
			$update_donation['post_status'] = 'trash';
			
			
			wp_update_post($update_donation);
		}
	}
	
	
	public static function submit_handler() {
		try {
			$values = self::get_posted_fields();
			
			
			if ( 
				empty($_POST['submit_donation']) || 
				!wp_verify_nonce($_POST['_wpnonce'], 'submit_form_posted') 
			) {
				return;
			}
			
			
			if (is_wp_error(($return = self::validate_fields($values)))) {
				throw new Exception($return->get_error_message());
			}
			
			
			self::save_donation((get_option('cmsmasters_donator_message') == 'hide') ? '' : $values['donation']['donation_message']);
			
			
			self::update_donation_data($values);
			
			
			self::next_step();
			
			
			if (get_option('cmsmasters_confirm_donation') != 1) {
				global $cmsmasters_donations_payments;
				
				
				$cmsmasters_donations_payments->preview_handler(self::$donation_id);
			}
		} catch (Exception $e) {
			self::add_error($e->getMessage());
			
			
			return;
		}
	}
	
	
	public static function preview() {
		global $cmsmasters_donations, 
			$post;
		
		
		if (self::$donation_id) {
			$post = get_post(self::$donation_id);
			
			
			setup_postdata($post);
			
			
			get_cmsmasters_donations_template_part('content-confirm', 'donation');
			
			
			echo "<form method=\"post\" id=\"donation_preview\" data-method=\"" . get_post_meta(self::$donation_id, 'cmsmasters_donation_payment_method', true) . "\">
				<input type=\"submit\" name=\"edit_donation\" class=\"button\" value=\"" . __('Edit donation', 'cmsmasters-donations') . "\" />
				<input type=\"submit\" name=\"continue\" id=\"donation_preview_submit_button\" class=\"button\" value=\"" . apply_filters('submit_donation_step_preview_submit_text', __('Submit Donation', 'cmsmasters-donations')) . "\" />
				<input type=\"hidden\" name=\"donation_id\" value=\"" . esc_attr(self::$donation_id) . "\" />
				<input type=\"hidden\" name=\"step\" value=\"" . esc_attr(self::$step) . "\" />
				<input type=\"hidden\" name=\"cmsmasters_donations_form\" value=\"" . self::$form_name . "\" />
			</form>";
			
			
			if (isset($_GET['cancel']) && $_GET['cancel'] == 'true') {
				$update_donation = array();
				
				
				$update_donation['ID'] = $_GET['donation_id'];
				
				$update_donation['post_status'] = 'preview';
				
				
				wp_update_post($update_donation);
			}
			
			
			wp_reset_postdata();
		}
	}
	
	
	public static function preview_handler() {
		if (!$_POST) {
			return;
		}
		
		
		if (!empty($_POST['edit_donation'])) {
			self::previous_step();
		}
		
		
		if (!empty($_POST['continue'])) {
			$donation = get_post(self::$donation_id);
			
			
			if ($donation->post_status == 'preview') {
				$update_donation = array();
				
				
				$update_donation['ID'] = $donation->ID;
				
				$update_donation['post_status'] = 'pending';
				
				
				wp_update_post($update_donation);
			}
			
			
			self::next_step();
		}
	}
	
	
	public static function done() {
		get_cmsmasters_donations_template('donation-submitted.php', array( 
			'donation' => 	get_post(self::$donation_id) 
		) );
	}
	
	
	protected static function save_donation($post_content = '', $status = 'preview') {
		$donation_data = array( 
			'post_title' => 		__('New Donation', 'cmsmasters-donations'), 
			'post_excerpt' => 		$post_content, 
			'post_status' => 		$status, 
			'post_type' => 			'donation' 
		);
		
		
		if (self::$donation_id) {
			$donation_data['ID'] = self::$donation_id;
			
			
			wp_update_post($donation_data);
		} else {
			self::$donation_id = wp_insert_post($donation_data);
		}
		
		
		$donation_title = array( 
			'ID' => 			self::$donation_id, 
			'post_title' => 	__('Donation #', 'cmsmasters-donations') . self::$donation_id 
		);
		
		
		wp_update_post($donation_title);
	}
	
	
	protected static function update_donation_data($values) {
		update_post_meta(self::$donation_id, 'cmsmasters_donation_amount', $values['donation']['donation_amount']);
		
		
		if (isset($values['donation']['donation_payment_method'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donation_payment_method', $values['donation']['donation_payment_method']);
		} else {
			update_post_meta(self::$donation_id, 'cmsmasters_donation_payment_method', 'online');
		}
		
		
		if (isset($values['donation']['recurring_donation']) && $values['donation']['recurring_donation'] != '1') {
			update_post_meta(self::$donation_id, 'cmsmasters_recurring_donation', true);
			
			update_post_meta(self::$donation_id, 'cmsmasters_recurrence_period', $values['donation']['recurring_donation']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_recurring_donation');
			
			update_post_meta(self::$donation_id, 'cmsmasters_recurrence_period', '1');
		}
		
		
		if (isset($values['donation']['anonymous_donation']) && $values['donation']['anonymous_donation'] == 'true') {
			update_post_meta(self::$donation_id, 'cmsmasters_anonymous_donation', 'true');
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_anonymous_donation');
		}
		
		
		if (isset($values['donation']['donation_campaign']) && $values['donation']['donation_campaign'] != '') {
			update_post_meta(self::$donation_id, 'cmsmasters_donation_campaign', $values['donation']['donation_campaign']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donation_campaign');
		}
		
		
		if (isset($values['donator']['donator_firstname'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_firstname', $values['donator']['donator_firstname']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_firstname');
		}
		
		
		if (isset($values['donator']['donator_lastname'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_lastname', $values['donator']['donator_lastname']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_lastname');
		}
		
		
		if (isset($values['donator']['donator_email'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_email', $values['donator']['donator_email']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_email');
		}
		
		
		if (isset($values['donator']['donator_company'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_company', $values['donator']['donator_company']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_company');
		}
		
		
		if (isset($values['donator']['donator_address'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_address', $values['donator']['donator_address']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_address');
		}
		
		
		if (isset($values['donator']['donator_city'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_city', $values['donator']['donator_city']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_city');
		}
		
		
		if (isset($values['donator']['donator_state'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_state', $values['donator']['donator_state']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_state');
		}
		
		
		if (isset($values['donator']['donator_zip'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_zip', $values['donator']['donator_zip']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_zip');
		}
		
		
		if (isset($values['donator']['donator_country'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_country', $values['donator']['donator_country']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_country');
		}
		
		
		if (isset($values['donator']['donator_phone'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_phone', $values['donator']['donator_phone']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_phone');
		}
		
		
		if (isset($values['donator']['donator_website'])) {
			update_post_meta(self::$donation_id, 'cmsmasters_donator_website', $values['donator']['donator_website']);
		} else {
			delete_post_meta(self::$donation_id, 'cmsmasters_donator_website');
		}
		
		
		do_action('cmsmasters_donations_update_donation_data', self::$donation_id, $values);
	}
	
	
	protected static function get_posted_fields() {
		self::init_fields();
		
		
		$values = array();
		
		
		foreach (self::$fields as $group_key => $fields) {
			foreach ($fields as $key => $field) {
				if ($field['type'] == 'textarea') {
					$values[$group_key][$key] = isset($_POST[$key]) ? wp_kses_post(trim(stripslashes($_POST[$key]))) : '';
				} else {
					$values[$group_key][$key] = isset($_POST[$key]) ? sanitize_text_field(trim(stripslashes($_POST[$key]))) : '';
				}
				
				
				self::$fields[$group_key][$key]['value'] = $values[$group_key][$key];
			}
		}
		
		
		return $values;
	}
	
	
	protected static function validate_fields($values) {
		foreach (self::$fields as $group_key => $fields) {
			foreach ($fields as $key => $field) {
				if ( 
					$field['type'] == 'donation_amount' && 
					!is_numeric($values[$group_key][$key]) 
				) {
					return new WP_Error('validation-error', sprintf(__("%s must be a valid number. Don't include currency symbol.", 'cmsmasters-donations'), $field['label']));
				}
				
				
				if ( 
					$field['required'] && 
					empty($values[$group_key][$key]) 
				) {
					return new WP_Error('validation-error', sprintf(__('%s is a required field', 'cmsmasters-donations'), $field['label']));
				}
			}
		}
		
		
		return apply_filters('submit_donation_form_validate_fields', true, self::$fields, $values);
	}
	
	
	private static function sort_by_priority($a, $b) {
		return $a['priority'] - $b['priority'];
	}
	
	
	private static function donation_campaigns() {
		if (get_option('cmsmasters_payment_campaign') == 'required') {
			$options = array();
		} else {
			$options = array( 
				'' => __('No specific campaign', 'cmsmasters-donations') 
			);
		}
		
		
		$campaigns = get_donation_campaigns();
		
		
		foreach ($campaigns as $key => $value) {
			$options[$key] = sprintf(__('%s - (Target: %s)', 'cmsmasters-donations'), $value, get_the_campaign_target($key));
		}
		
		
		return $options;
	}
	
	
	public static function get_donation_id() {
		return absint(self::$donation_id);
	}
	
	
	public static function next_step() {
		self::$step++;
	}
	
	
	public static function previous_step() {
		self::$step--;
	}
}

