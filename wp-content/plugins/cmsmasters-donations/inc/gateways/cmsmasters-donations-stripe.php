<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.3.7
 * 
 * CMSMasters Donations Stripe Payment Gateway
 * Created by CMSMasters
 * 
 */


if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Cmsmasters_Donations_Stripe extends Cmsmasters_Donations_Gateway {

	public function __construct() {
		$this->gateway_id = 'stripe';
		
		$this->gateway_name = esc_attr__('Stripe Checkout', 'cmsmasters-donations');
		
		
		$this->settings = array( 
			array( 
				'name' => 		'cmsmasters_donations_stripe_testmode', 
				'std' => 		'no', 
				'label' => 		__('Test Mode', 'cmsmasters-donations'), 
				'desc' => 		__('Enable Test Mode', 'cmsmasters-donations'), 
				'options' => array( 
					'yes' => 	__('Yes', 'cmsmasters-donations'), 
					'no' => 	__('No', 'cmsmasters-donations') 
				), 
				'type' => 		'radio', 
				'class' => 		'gateway-settings gateway-settings-stripe' 
			), 
			array( 
				'name' => 		'cmsmasters_donations_stripe_secret_key', 
				'std' => 		'', 
				'label' => 		__('Secret Key', 'cmsmasters-donations'), 
				'desc' => 		__('Get your API keys from your stripe account.', 'cmsmasters-donations'), 
				'type' => 		'input', 
				'class' => 		'gateway-settings gateway-settings-stripe' 
			), 
			array( 
				'name' => 		'cmsmasters_donations_stripe_publishable_key', 
				'std' => 		'', 
				'label' => 		__('Publishable Key', 'cmsmasters-donations'), 
				'desc' => 		__('Get your API keys from your stripe account.', 'cmsmasters-donations'), 
				'type' => 		'input', 
				'class' => 		'gateway-settings gateway-settings-stripe' 
			), 
			array( 
				'name' => 		'cmsmasters_donations_stripe_name', 
				'std' => 		'', 
				'label' => 		__('Company Name', 'cmsmasters-donations'), 
				'desc' => 		__('Custom company name for stripe payment form.', 'cmsmasters-donations'), 
				'type' => 		'input', 
				'class' => 		'gateway-settings gateway-settings-stripe' 
			), 
			array( 
				'name' => 		'cmsmasters_donations_stripe_description', 
				'std' => 		'', 
				'label' => 		__('Description', 'cmsmasters-donations'), 
				'desc' => 		__('Enter default description for stripe payment form.', 'cmsmasters-donations'), 
				'type' => 		'input', 
				'class' => 		'gateway-settings gateway-settings-stripe' 
			), 
			array( 
				'name' => 		'cmsmasters_donations_stripe_image', 
				'std' => 		'', 
				'label' => 		__('Logo Image', 'cmsmasters-donations'), 
				'desc' => 		__('Choose a square image of your organization or logo for stripe payment form. <br />The recommended minimum size is 128x128px.', 'cmsmasters-donations'), 
				'type' => 		'upload', 
				'class' => 		'gateway-settings gateway-settings-stripe' 
			) 
		);
		
		
		parent::__construct();
	}
	
	
	public function pay_for_donation( $donation_id ) {
		require_once( CMSMASTERS_DONATIONS_GATEWAYS . 'stripe/init.php' );

		$stripe_secret_key = get_option( 'cmsmasters_donations_stripe_secret_key' );

		if ( empty( $stripe_secret_key ) ) {
			Cmsmasters_Donations_Form_Submit_Donation::add_error( __( 'Please add stripe secret key in settings.', 'cmsmasters-donations' ) );
		}

		$stripe = new \Stripe\StripeClient($stripe_secret_key);

		$price_data = array(
			'currency' => strtolower(get_option('cmsmasters_donations_currency')),
			'unit_amount' => get_the_donation_amount($donation_id) * 100,
			'product_data' => [
				'name' => get_option('cmsmasters_donations_stripe_name') ? get_option('cmsmasters_donations_stripe_name') : get_bloginfo('name'),
			],
		);

		$stripe_description = get_option('cmsmasters_donations_stripe_description');

		if ( ! empty( $stripe_description ) ) {
			$price_data['product_data']['description'] = $stripe_description;
		}

		$stripe_image_src = '';
		
		if ( get_option('cmsmasters_donations_stripe_image') ) {
			$stripe_image_id = explode('|', get_option('cmsmasters_donations_stripe_image'));
			
			$stripe_image_array = wp_get_attachment_image_src($stripe_image_id[0]);

			$stripe_image_src = $stripe_image_array[0];
		}

		if ( ! empty( $stripe_image_src ) ) {
			$price_data['product_data']['images'] = [ $stripe_image_src ];
		}

		$checkout_session = $stripe->checkout->sessions->create( [
			'line_items' => [[
				'price_data' => $price_data,
				'quantity' => 1,
			]],
			'mode' => 'payment',
			'submit_type' => 'donate',
			'success_url' => add_query_arg(array(
				'success' => 'true',
				'donation_id' => urlencode($donation_id),
				'step' => urlencode($_REQUEST['step'] + 1),
			), get_permalink()),
			'cancel_url' => add_query_arg(array(
				'cancel' => 'true',
				'donation_id' => urlencode($donation_id),
			), get_permalink()),
		] );

		wp_redirect( $checkout_session->url );

		exit;
	}

}

return new Cmsmasters_Donations_Stripe();

