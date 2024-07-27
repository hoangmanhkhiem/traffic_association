<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.1.0
 * 
 * CMSMasters Donations Paypal Payment Gateway
 * Created by CMSMasters
 * 
 */


if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Cmsmasters_Donations_PayPal extends Cmsmasters_Donations_Gateway {
	private $liveurl = 'https://www.paypal.com/cgi-bin/webscr';
	
	private $testurl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	
	
	public function __construct() {
		$this->gateway_id = 'paypal';
		
		$this->gateway_name = esc_attr__('PayPal Checkout', 'cmsmasters-donations');
		
		
		$this->settings = array( 
			array( 
				'name' => 		'cmsmasters_donations_paypal_email', 
				'std' => 		'', 
				'label' => 		__('PayPal Email', 'cmsmasters-donations'), 
				'desc' => 		__('Your PayPal email address.', 'cmsmasters-donations'), 
				'type' => 		'input', 
				'class' => 		'gateway-settings gateway-settings-paypal' 
			), 
			array( 
				'name' => 		'cmsmasters_donations_paypal_identity_token', 
				'std' => 		'', 
				'label' => 		__('PayPal Identity Token', 'cmsmasters-donations'), 
				'desc' => 		__("Optionally enable 'Payment Data Transfer' (Profile > Website Payment Preferences) and then copy your identity token here. <br />This will allow payments to be verified without the need for PayPal IPN.", 'cmsmasters-donations'), 
				'type' => 		'input', 
				'class' => 		'gateway-settings gateway-settings-paypal' 
			), 
			array( 
				'name' => 		'cmsmasters_donations_paypal_sandbox', 
				'std' => 		'no', 
				'label' => 		__('PayPal Sandbox', 'cmsmasters-donations'), 
				'desc' => 		__('Enable PayPal Sandbox (use for testing)', 'cmsmasters-donations'), 
				'options' => array( 
					'yes' => 	__('Yes', 'cmsmasters-donations'), 
					'no' => 	__('No', 'cmsmasters-donations') 
				), 
				'type' => 		'radio', 
				'class' => 		'gateway-settings gateway-settings-paypal' 
			) 
		);
		
		
		parent::__construct();
	}
	
	
	public function pay_for_donation($donation_id) {
		if (is_recurring_donation($donation_id)) {
			add_filter('cmsmasters_donations_paypal_args', array($this, 'paypal_recurring_args'));
		}
		
		
		$payment_link = $this->get_paypal_payment_link($donation_id);
		
		
		wp_redirect($payment_link);
		
		
		exit;
	}
	
	
	private function get_paypal_payment_link($donation_id) {
		$paypal_args = apply_filters('cmsmasters_donations_paypal_args', array( 
			'cmd' => 			'_cart', 
			'business' => 		get_option('cmsmasters_donations_paypal_email'), 
			'currency_code' => 	get_option('cmsmasters_donations_currency'), 
			'charset' => 		'UTF-8', 
			'rm' => 			2, 
			'upload' => 		1, 
			'no_note' => 		1, 
			'return' => add_query_arg(array( 
				'success' => 		'true', 
				'donation_id' => 	urlencode($donation_id), 
				'step' => 			urlencode($_REQUEST['step'] + 1) 
			), get_permalink()), 
			'cancel_return' => add_query_arg(array( 
				'cancel' => 		'true', 
				'donation_id' => 	urlencode($donation_id) 
			), get_permalink()), 
			'invoice' => 		strtoupper(str_replace(' ', '-', get_bloginfo('name'))) . '-DONATION-' . $donation_id, 
			'custom' => 		$donation_id, 
			'notify_url' => add_query_arg(array( 
				'cmsmasters-donations-api' => 	'Cmsmasters_Donations_Payments', 
				'gateway' => 				urlencode($this->gateway_id) 
			), home_url()), 
			'no_shipping' => 	1, 
			'item_name_1' => 	get_the_title($donation_id), 
			'quantity_1' => 	1, 
			'amount_1' => 		get_the_donation_amount($donation_id) 
		) );
		
		
		if (get_option('cmsmasters_confirm_donation') == 1) {
			$paypal_args['cancel_return'] = add_query_arg(array( 
				'cancel' => 		'true', 
				'donation_id' => 	urlencode($donation_id), 
				'step' => 			urlencode($_REQUEST['step']) 
			), get_permalink());
		}
		
		
		$paypal_args = http_build_query($paypal_args, '', '&');
		
		
		if (get_option('cmsmasters_donations_paypal_sandbox') == 'yes') {
			$paypal_adr = $this->testurl . '?test_ipn=1&';
		} else {
			$paypal_adr = $this->liveurl . '?';
		}
		
		
		return $paypal_adr . $paypal_args;
	}
	
	
	public function paypal_recurring_args($paypal_args) {
		global $post;
		
		
		$donation_id = $paypal_args['custom'];
		
		
		unset($paypal_args['amount_1']);
		
		unset($paypal_args['item_name_1']);
		
		
		$paypal_args['cmd'] = '_xclick-subscriptions';
		
		$paypal_args['item_name'] = esc_attr__('New recurring donation', 'cmsmasters-donations') . ' &quot;' . get_the_title($donation_id) . '&quot;';
		
		$paypal_args['src'] = 1;
		
		$paypal_args['sra'] = 1;
		
		$paypal_args['a3'] = get_the_donation_amount($donation_id);
		
		$paypal_args['p3'] = 1;
		
		$paypal_args['t3'] = $this->get_the_paypal_recurrence_period($donation_id);
		
		
		return $paypal_args;
	}
	
	
	public function get_the_paypal_recurrence_period($donation_id = null) {
		$recurrence_period = get_post_meta($donation_id, 'cmsmasters_recurrence_period', true);
		
		
		switch ($recurrence_period) {
		case '7':
			$recurrence_period = 'W';
			
			
			break;
		case '30':
			$recurrence_period = 'M';
			
			
			break;
		case '365':
			$recurrence_period = 'Y';
			
			
			break;
		}
		
		
		return $recurrence_period;
	}
	
	
	public function api_handler() {
		if (get_option('cmsmasters_donations_paypal_sandbox') == 'yes') {
			$paypal_adr = $this->testurl . '?test_ipn=1&';
		} else {
			$paypal_adr = $this->liveurl . '?';
		}
		
		
		$received_values = array( 
			'cmd' => 	'_notify-validate' 
		);
		
		
		$received_values += stripslashes_deep($_POST);
		
		
        $params = array( 
        	'body' => 			$received_values,
        	'sslverify' => 		false,
        	'timeout' => 		60,
        	'user-agent' => 	'cmsmasters_donations',
        	'httpversion' => 	'1.1',
        	'headers' => array( 
				'host' => 	'www.paypal.com' 
			) 
        );
		
		
        $response = wp_remote_post($paypal_adr, $params);
		
		
        if ( 
			!is_wp_error($response) && 
			$response['response']['code'] >= 200 && 
			$response['response']['code'] < 300 && 
			strcmp($response['body'], "VERIFIED") == 0 
		) {
			$this->valid_paypal_ipn_request();
		}
	}
	
	
    public function return_handler() {
		$posted = stripslashes_deep($_REQUEST);
		
		
	    if (!empty($posted['cm'])) {
	    	$donation_id = absint($posted['cm']);
			
			
	    	$donation = get_post($donation_id);
			
			
	    	$posted['st'] = strtolower($posted['st']);
			
			
			switch ($posted['st']) {
			case 'completed':
				if ($donation->post_status != 'pending_payment') {
					return false;
				}
				
				
				if (get_option('cmsmasters_donations_paypal_sandbox') == 'yes') {
					$paypal_adr = $this->testurl;
				} else {
					$paypal_adr = $this->liveurl;
				}
				
				
				$pdt = array( 
					'body' => array( 
						'cmd' => 	'_notify-synch', 
						'tx' => 	$posted['tx'], 
						'at' => 	get_option('cmsmasters_donations_paypal_identity_token') 
					), 
					'sslverify' => 		false, 
					'timeout' => 		60, 
					'user-agent' => 	'cmsmasters_donations', 
					'httpversion' => 	'1.1', 
					'headers' => array( 
						'host' => 	'www.paypal.com' 
					) 
				);
				
				
				$response = wp_remote_post($paypal_adr, $pdt);
				
				
				if (is_wp_error($response)) {
					return false;
				}
				
				
				if (!strpos($response['body'], "SUCCESS") === 0) {
					return false;
				}
				
				
				update_post_meta($donation_id, 'cmsmasters_transaction_id', $posted['tx']);
				
				
				$this->payment_complete($donation_id);
				
				
				$this->send_admin_email($donation_id, sprintf(esc_html__('Payment has been received in full for donation #%d - this donation has been published.', 'cmsmasters-donations'), $donation_id));
				
				
				break;
	        }
        }
    }
	
	
    public function valid_paypal_ipn_request() {
		$posted = stripslashes_deep($_POST);
		
		
	    if (!empty($posted['custom'])) {
	    	$donation_id = absint($posted['custom']);
			
			
	    	$donation = get_post($donation_id);
			
			
	    	$posted['payment_status'] = strtolower($posted['payment_status']);
			
			
	    	if ($posted['test_ipn'] == 1 && $posted['payment_status'] == 'pending') {
        		$posted['payment_status'] = 'completed';
			}
			
			
			switch ($posted['payment_status']) {
			case 'completed':
				if ($donation->post_status != 'pending_payment') {
					return false;
				}
				
				
				update_post_meta($donation_id, 'cmsmasters_donator_paypal_address', $posted['payer_email']);
				
				update_post_meta($donation_id, 'cmsmasters_transaction_id', $posted['txn_id']);
				
				
				$this->send_admin_email($donation_id, sprintf(esc_html__('Payment has been received in full for donation #%d - this donation has been published.', 'cmsmasters-donations'), $donation_id));
				
				
				$this->gateway->payment_complete($donation_id);
				
				
				break;
			case 'pending':
				$this->send_admin_email($donation_id, sprintf(esc_html__('PayPal payment is pending for donation #%d - this donation has *not* been automatically approved.', 'cmsmasters-donations'), $donation_id));
				
				
				break;
			case 'chargeback':
				$this->send_admin_email($donation_id, sprintf(esc_html__('The payment for donation #%d was reversed. Please check this donation/payment and change the status manually if need be.', 'cmsmasters-donations'), $donation_id));
				
				
				break;
	        }
        }
		
		
		exit;
    }
}

return new Cmsmasters_Donations_PayPal();

