<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.3.5
 * 
 * CMSMasters Donations Payment Gateway Abstract Class
 * Created by CMSMasters
 * 
 */


abstract class Cmsmasters_Donations_Gateway {
	protected $settings = array();
	
	protected $gateway_id = '';
	
	protected $gateway_name = '';
	
	
	public function __construct() {
		add_filter('cmsmasters_donations_gateways', array($this, 'add_gateway'));
		
		add_filter('cmsmasters_donations_payments_settings', array($this, 'add_settings'));
	}
	
	
	public function add_gateway($gateways) {
		$gateways[$this->gateway_id] = $this->gateway_name;
		
		
		return $gateways;
	}
	
	
	public function add_settings($settings) {
		return array_merge($settings, $this->settings);
	}
	
	
	public function api_handler() {}
	
	
	public function return_handler() {}
	
	
	public function pay_for_donation($donation_id) {
		return false;
	}
	
	
	public function payment_complete($donation_id) {
		$notification = new Cmsmasters_Donations_Emails();
		
		
		$notification->send_donator_email($donation_id);
		
		
		$donation = get_post($donation_id);
		
		
		if ($donation->post_status == 'pending_payment') {
			$update_donation = array();
			
			
			$update_donation['ID'] = $donation_id;
			
			$update_donation['post_status'] = 'publish';
			
			
			wp_update_post($update_donation);
		}
	}
	
	
	public function send_admin_email($donation_id, $string) {
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		
		
		$message = sprintf(wp_kses(__("Hi,<br><br>%1\$s<br><br>You can view this donation <a href=\"%2\$s\">here</a>.", 'cmsmasters-donations'), array( 
			'a' => array( 
				'href' => array() 
			), 
			'br' => array() 
		)), $string, get_edit_post_link($donation_id, ''));
		
		
		wp_mail(get_option('admin_email'), sprintf(__('Payment for donation #%d has been received', 'cmsmasters-donations'), $donation_id), $message, $headers);
	}
}

