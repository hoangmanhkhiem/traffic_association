<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.3.3
 * 
 * CMSMasters Donations Form Functions
 * Created by CMSMasters
 * 
 */


/* Get Donations Form Fields Function */
function get_donations_form_fields($type = 'text', $key = '', $field = array()) {
	$out = '';
	
	
	switch ($type) {
	case 'donation_amount':
		$field_name = esc_attr($key);
		
		
		$i = 0;
		
		
		if (!empty($field['options']) && $field['options'][0] != '') {
			foreach ($field['options'] as $key => $value) {
				$out .= '<label for="' . $field_name . esc_attr($value) . '">' . 
					'<input type="radio" value="' . esc_attr($value) . '" name="' . $field_name . '" id="' . $field_name . esc_attr($value) . '"' . (isset($field['value']) ? ' ' . checked($field['value'], esc_attr($value), false) : '') . ' /> ' . 
					cmsmasters_donations_currency(number_format(esc_attr($value), 2, '.', '')) . 
				'</label>';
				
				
				$i++;
			}
		}
		
		
		$out .= '<input type="text" name="' . $field_name . '" id="' . $field_name . '" value="' . (isset($field['value']) ? esc_attr($field['value']) : '') . '"' . (!empty($field['validation']) ? ' class="validate[' . esc_attr($field['validation']) . ']"' : '') . ' placeholder="' . esc_attr($field['placeholder']) . '" maxlength="' . (!empty($field['maxlength']) ? $field['maxlength'] : '') . '" />';
		
		
		break;
	case 'textarea':
		$out .= '<textarea name="' . esc_attr($key) . '" id="' . esc_attr($key) . '"' . (!empty($field['validation']) ? ' class="validate[' . esc_attr($field['validation']) . ']"' : '') . ' cols="30" rows="7" placeholder="' . esc_attr($field['placeholder']) . '">' . (isset($field['value']) ? esc_attr($field['value']) : '') . '</textarea>';
		
		
		break;
	case 'select':
		$out .= ((isset($field['disabled']) && $field['disabled']) ? '<span class="cmsmasters_donation_field_readonly">' : '') . 
		'<select name="' . esc_attr($key) . '" id="' . esc_attr($key) . '"' . (!empty($field['validation']) ? ' class="validate[' . esc_attr($field['validation']) . ']"' : '') . '>';
		
		
		foreach ($field['options'] as $key => $value) {
			if (isset($field['disabled']) && $field['disabled']) {
				$out .= '<option value="' . esc_attr($key) . '"' . (isset($field['disabled']) ? ' ' . selected($field['disabled'], esc_attr($key), false) : '') . '>' . esc_html($value) . '</option>';
			} else {
				$out .= '<option value="' . esc_attr($key) . '"' . (isset($field['value']) ? ' ' . selected($field['value'], esc_attr($key), false) : '') . '>' . esc_html($value) . '</option>';
			}
		}
		
		
		$out .= '</select>' . 
		((isset($field['disabled']) && $field['disabled']) ? '</span>' : '');
		
		
		break;
	case 'radio':
		$field_name = esc_attr($key);
		
		
		$i = 0;
		
		
		foreach ($field['options'] as $key => $value) {
			$out .= '<label for="' . $field_name . $i . '">' . 
				'<input type="radio" name="' . $field_name . '" id="' . $field_name . $i . '" value="' . esc_attr($key) . '"' . (!empty($field['validation']) ? ' class="validate[' . esc_attr($field['validation']) . ']"' : '') . ' ' . checked($field['value'], esc_attr($key), false) . ' /> ' . 
				$value . 
			'</label>';
			
			
			$i++;
		}
		
		
		break;
	case 'checkbox':
		$out .= '<input type="checkbox" name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" value="true"' . (!empty($field['validation']) ? ' class="validate[' . esc_attr($field['validation']) . ']"' : '') . ' ' . checked($field['value'], 'true', false) . ' />';
		
		
		break;
	case 'hidden':
		$out .= '<input type="hidden" name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" value="' . (isset($field['value']) ? esc_attr($field['value']) : '') . '" />';
		
		
		break;
	default:
		$out .= '<input type="text" name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" value="' . (isset($field['value']) ? esc_attr($field['value']) : '') . '"' . (!empty($field['validation']) ? ' class="validate[' . esc_attr($field['validation']) . ']"' : '') . ' placeholder="' . esc_attr($field['placeholder']) . '" maxlength="' . ((!empty($field['maxlength'])) ? $field['maxlength'] : '') . '" />';
	}
	
	
	if (!empty($field['description'])) {
		$out .= '<small class="' . (($field == 'donation_amount' || $field == 'checkbox') ? 'checkbox-description' : 'description') . '">' . esc_html($field['description']) . '</small>';
	}
	
	
	return apply_filters('cmsmasters_donations_form_fields', $out);
}


/* Get Donations Campaigns List Function */
function get_donation_campaigns() {
	$campaigns = get_posts(array( 
		'post_type' => 			'campaign', 
		'orderby' => 			'post_date', 
		'order' => 				'ASC', 
		'posts_per_page' => 	-1, 
		'suppress_filters' => 	false 
	) );
	
	
	$array = array();
	
	
	foreach ($campaigns as $campaign) {
		$array[$campaign->ID] = $campaign->post_title;
	}
	
	
	return $array;
}

