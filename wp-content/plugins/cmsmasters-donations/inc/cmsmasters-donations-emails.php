<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.3.5
 * 
 * CMSMasters Donations Emails
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Donations_Emails {
	public function __construct() {
		add_action('send-donator-email', array($this, 'send_donator_email'));
	}
	
	
	public function send_donator_email($donation_id) {
		$donation = get_post($donation_id);
		
		
		if (!$donation) {
			return;
		}
		
		
		$donator_email = get_post_meta($donation_id, 'cmsmasters_donator_email', true);
		
		
		$email = $this->format_email($donation_id);
		
		
		add_filter('wp_mail_from_name', array($this, 'mail_from_name'));
		
		
		if ($email && $donator_email != '') {
			wp_mail( 
				$donator_email, 
				apply_filters('cmsmasters_donations_donator_email_subject', sprintf(__('Your Donation "%s"', 'cmsmasters-donations'), $donation->post_title), $donation), 
				$email 
			);
		}
		
		
		remove_filter('wp_mail_from_name', array($this, 'mail_from_name'));
	}
	
	
	public function send_admin_email_offline($donation_id, $string) {
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		
		
		$message = sprintf(wp_kses(__("Hi,<br><br>%1\$s<br><br>You can view this donation <a href=\"%2\$s\">here</a>.", 'cmsmasters-donations'), array( 
			'a' => array( 
				'href' => array() 
			), 
			'br' => array() 
		)), $string, get_edit_post_link($donation_id, ''));
		
		
		wp_mail(get_option('admin_email'), sprintf(__('New offline payment #%d is pending for donation', 'cmsmasters-donations'), $donation_id), $message, $headers);
	}
	
	
	public function format_email($donation_id) {
		$donation = get_post($donation_id);
		
		$donator_firstname = get_post_meta($donation_id, 'cmsmasters_donator_firstname', true);
		
		$donator_lastname = get_post_meta($donation_id, 'cmsmasters_donator_lastname', true);
		
		$template = get_option('cmsmasters_donations_donator_email_template');
		
		
		if (!$template) {
			$template = self::get_default_email();
		}
		
		
		ob_start();
		
		
		get_cmsmasters_donations_template('content-donator-email.php');
		
		
		$donation_details = ob_get_clean();
		
		
		$replacements = array( 
			'{donator_firstname}' => 	$donator_firstname, 
			'{donator_lastname}' => 	$donator_lastname, 
			'{donation_amount}' => 		get_the_donation_amount_currency($donation_id), 
			'{donation_date}' => 		date_i18n(get_option('date_format'), strtotime($donation->post_date)), 
			'{donation_details}' => 	$donation_details 
		);
		
		
		$template = str_replace(array_keys($replacements), array_values($replacements), $template);
		
		
		return apply_filters('cmsmasters_donations_donator_email_template', $template);
	}
	
	
	public function mail_from_name($name) {
	    return get_bloginfo('name');
	}
	
	
	public static function get_default_email() {
		return "Dear {donator_firstname} {donator_lastname},

Thank you for your generous donation of {donation_amount} on {donation_date}. Your willingness to help us is deeply appreciated and we would like to thank you very much for your contribution.

Frankly, we could not do this without you. We, and those we serve, deeply appreciate your generosity.

Sincerely,

Our Team";
	}
}

$GLOBAL['cmsmasters_emails'] = new Cmsmasters_Donations_Emails();

