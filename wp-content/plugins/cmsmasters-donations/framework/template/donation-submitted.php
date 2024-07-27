<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.0.0
 * 
 * CMSMasters Donation Form Submission Notices Template
 * Created by CMSMasters
 * 
 */


switch ($donation->post_status) {
case 'publish':
	echo '<div class="cmsmasters_notice cmsmasters_notice_success cmsmasters_donation_notice cmsmasters_donation_notice_success cmsmasters-icon-check">' . 
		'<a class="notice_close cmsmasters_theme_icon_cancel" href="#"></a>' . 
		'<div class="notice_icon"></div>' . 
		'<div class="notice_content">' . 
			wpautop(esc_html__('Donation validated successfully.', 'cmsmasters-donations')) . 
		'</div>' . 
	'</div>';
	
	
	break;
case 'pending_payment':
	echo '<div class="cmsmasters_notice cmsmasters_notice_success cmsmasters_donation_notice cmsmasters_donation_notice_success cmsmasters-icon-check">' . 
		'<a class="notice_close cmsmasters_theme_icon_cancel" href="#"></a>' . 
		'<div class="notice_icon"></div>' . 
		'<div class="notice_content">' . 
			wpautop(esc_html__("Donation submitted successfully.\nYour donation will be published as soon as we receive the payment gateway validation (it can take several minutes).", 'cmsmasters-donations')) . 
		'</div>' . 
	'</div>';
	
	
	break;
case 'pending_offline' :
	echo '<div class="cmsmasters_notice cmsmasters_notice_success cmsmasters_donation_notice cmsmasters_donation_notice_success cmsmasters-icon-check">' . 
		'<a class="notice_close cmsmasters_theme_icon_cancel" href="#"></a>' . 
		'<div class="notice_icon"></div>' . 
		'<div class="notice_content">' . 
			wpautop(esc_html__("Donation submitted successfully.\nYour donation will be published once payment is received.\nYou choose an offline payment method, so please follow the guide below to send us your payment.", 'cmsmasters-donations')) . 
		'</div>' . 
	'</div>';
	
	
	if (get_option('cmsmasters_donations_offline_payment_text')) {
		echo '<div class="cmsmasters_notice cmsmasters_notice_info cmsmasters_donation_notice cmsmasters_donation_notice_info cmsmasters-icon-info">' . 
			'<a class="notice_close cmsmasters_theme_icon_cancel" href="#"></a>' . 
			'<div class="notice_icon"></div>' . 
			'<div class="notice_content">' . 
				wpautop(esc_html(get_option('cmsmasters_donations_offline_payment_text'))) . 
			'</div>' . 
		'</div>';
	}
	
	
	break;
}


echo '<a href="' . get_page_link(get_option('cmsmasters_donations_form_page')) . '" class="button">' . esc_html__('Make Another Donation', 'cmsmasters-donations') . '</a>';


do_action('cmsmasters_donations_donation_submitted_content_' . str_replace('-', '_', sanitize_title($donation->post_status)), $donation);

