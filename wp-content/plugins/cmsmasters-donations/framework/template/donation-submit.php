<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.0.0
 * 
 * CMSMasters Donation Submission Form Template
 * Created by CMSMasters
 * 
 */


if ( 
	!defined('ABSPATH') || 
	(isset($_GET['action']) && $_GET['action'] == 'edit') 
) {
	exit;
}


global $cmsmasters_donations;


echo "<form action=\"{$action}\" method=\"post\" id=\"submit-donation-form\" class=\"cmsmasters_donations_form\" enctype=\"multipart/form-data\">
	<div class=\"cmsmasters_donation_fields\">
		<h2 class=\"cmsmasters_donation_form_title\">" . __('Donation details', 'cmsmasters-donations') . "</h2>";


do_action('submit_donation_form_donation_fields_start');


foreach ($donation_fields as $key => $field) {
	if ($field['type'] != 'hidden') {
		echo "<div class=\"cmsmasters_donation_field donation-" . esc_attr($key) . "\">
			<label for=\"" . esc_attr($key) . "\">" . esc_html($field['label']) . ($field['required'] ? ' <span class="color_2">*</span>' : '') . "</label>" . 
			"<div class=\"field_inner\">" . 
				get_donations_form_fields($field['type'], $key, $field) . 
			"</div>
		</div>";
	} else {
		echo get_donations_form_fields($field['type'], $key, $field);
	}
}


do_action('submit_donation_form_donation_fields_end');


echo "</div>
<div class=\"cmsmasters_donator_fields\">";


if (!empty($donator_fields)) {
	echo "<h2 class=\"cmsmasters_donation_form_title\">" . __('Donator details', 'cmsmasters-donations') . "</h2>";
	
	
	do_action('submit_donation_form_donator_fields_start');
	
	
	foreach ($donator_fields as $key => $field) {
		if ($field['type'] != 'hidden') {
			echo "<div class=\"cmsmasters_donator_field donator-" . esc_attr($key) . "\">
				<label for=\"" . esc_attr($key) . "\">" . $field['label'] . ($field['required'] ? ' <span class="color_2">*</span>' : '') . "</label>" . 
				"<div class=\"field_inner\">" . 
					get_donations_form_fields($field['type'], $key, $field) . 
				"</div>
			</div>";
		} else {
			echo get_donations_form_fields($field['type'], $key, $field);
		}
	}
	
	
	do_action('submit_donation_form_donator_fields_end');
}


echo "</div>
<div class=\"cmsmasters_submit_fields\">";


wp_nonce_field('submit_form_posted');


echo "<input type=\"hidden\" name=\"cmsmasters_donations_form\" value=\"{$form}\" />
		<input type=\"hidden\" name=\"donation_id\" value=\"" . esc_attr($donation_id) . "\" />
		<input type=\"submit\" name=\"submit_donation\" id=\"donation_submit_button\" class=\"button\" value=\"" . esc_attr($submit_button_text) . "\" />" . 
		(($confirm_donation == 1) ? "" : "<input type=\"hidden\" name=\"continue\" value=\"1\" />") . 
		(($confirm_donation == 1) ? "" : "<input type=\"hidden\" name=\"step\" value=\"1\" />") . 
	"</div>
</form>";

