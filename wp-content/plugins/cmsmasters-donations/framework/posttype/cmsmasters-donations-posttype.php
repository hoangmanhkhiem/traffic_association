<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.2.6
 * 
 * CMSMasters Donations Post Type
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Donations_Post_Type {
	public function __construct() {
		$donation_labels = array( 
			'name' => 					__('Donations', 'cmsmasters-donations'), 
			'singular_name' => 			__('Donation', 'cmsmasters-donations'), 
			'menu_name' => 				__('Donations', 'cmsmasters-donations'), 
			'all_items' => 				__('All Donations', 'cmsmasters-donations'), 
			'add_new' => 				__('Add New', 'cmsmasters-donations'), 
			'add_new_item' => 			__('Add New Donation', 'cmsmasters-donations'), 
			'edit_item' => 				__('Edit Donation', 'cmsmasters-donations'), 
			'new_item' => 				__('New Donation', 'cmsmasters-donations'), 
			'view_item' => 				__('View Donation', 'cmsmasters-donations'), 
			'search_items' => 			__('Search Donations', 'cmsmasters-donations'), 
			'not_found' => 				__('No donations found', 'cmsmasters-donations'), 
			'not_found_in_trash' => 	__('No donations found in Trash', 'cmsmasters-donations') 
		);
		
		
		$donation_args = array( 
			'labels' => 				$donation_labels, 
			'query_var' => 				'donation', 
			'capability_type' => 		'post', 
			'menu_position' => 			54, 
			'menu_icon' => 				'dashicons-heart', 
			'public' => 				true, 
			'show_ui' => 				true, 
			'show_in_nav_menus' => 		false, 
			'show_in_admin_bar' => 		false, 
			'exclude_from_search' => 	true, 
			'hierarchical' => 			false, 
			'has_archive' => 			false, 
			'supports' => array( 
				'title', 
				'thumbnail', 
				'excerpt', 
				'custom-fields' 
			), 
			'rewrite' => array( 
				'slug' => 				'donation', 
				'with_front' => 		true 
			) 
		);
		
		
		register_post_type('donation', $donation_args);
		
		
		add_filter('manage_edit-donation_columns', array(&$this, 'edit_columns'));
		
		add_filter('manage_edit-donation_sortable_columns', array(&$this, 'edit_sortable_columns'));
		
		add_filter('request', array(&$this, 'sortable_columns_orderby'));
		
		
		add_action('manage_posts_custom_column', array(&$this, 'custom_columns'));
		
		
		add_action('admin_footer-edit.php', array($this, 'add_approve_bulk_action'));
		
		add_action('load-edit.php', array($this, 'do_approve_bulk_action'));
		
		add_action('admin_notices', array($this, 'approved_notice'));
		
		
		add_action('admin_footer-post.php', array($this, 'add_post_status'));
		
		add_action('admin_footer-post-new.php', array($this, 'add_post_status'));
		
		
		add_filter('the_donation_message', 'wptexturize');
		
		add_filter('the_donation_message', 'convert_chars');
		
		add_filter('the_donation_message', 'wpautop');
	}
	
	
	public function edit_columns($columns) {
		unset($columns['date']);
		
		
		$new_columns = array(
			'dn_amount' => 		__('Amount', 'cmsmasters-donations'), 
			'dn_recurrence' => 	'<span class="vers"><div class="dashicons dashicons-backup" title="' . __('Recurrence', 'cmsmasters-donations') . '"></div></span>', 
			'dn_donator' => 	__('Donator', 'cmsmasters-donations'), 
			'dn_anonymous' => 	'<span class="vers"><div class="dashicons dashicons-visibility" title="' . __('Donator personal info visibility', 'cmsmasters-donations') . '"></div></span>', 
			'dn_campaign' => 	__('Campaign', 'cmsmasters-donations'), 
			'date' => 			__('Date', 'cmsmasters-donations'), 
			'dn_status' => 		'<span class="vers"><div class="dashicons dashicons-info" title="' . __('Payment status', 'cmsmasters-donations') . '"></div></span>' 
		);
		
		
		if (get_option('cmsmasters_payment_recurrence') == 'hide') {
			unset($new_columns['dn_recurrence']);
		}
		
		
		if (get_option('cmsmasters_payment_campaign') == 'hide') {
			unset($new_columns['dn_campaign']);
		}
		
		
		$result_columns = array_merge($columns, $new_columns);
		
		
		return $result_columns;
	}
	
	
	public function edit_sortable_columns($columns) {
		$columns['dn_amount'] = 'dn_amount';
		
		$columns['dn_recurrence'] = 'dn_recurrence';
		
		$columns['dn_status'] = 'post_status';
		
		
		return $columns;
	}
	
	
	public function sortable_columns_orderby($query) {
		if (isset($query['orderby'])) {
			if ($query['orderby'] == 'dn_amount') {
				$query = array_merge($query, array( 
					'meta_key' => 	'cmsmasters_donation_amount', 
					'orderby' => 	'meta_value_num' 
				) );
			} elseif ($query['orderby'] == 'dn_recurrence') {
				$query = array_merge($query, array( 
					'meta_key' => 	'cmsmasters_recurring_donation', 
					'orderby' => 	'meta_value_num' 
				) );
			}
		}
		
		
		return $query;
	}
	
	
	public function custom_columns($column) {
		global $post;
		
		
		switch ($column) {
			case 'dn_amount':
				$amount = get_post_meta($post->ID, 'cmsmasters_donation_amount', true);
				
				
				echo '<strong>' . cmsmasters_donations_currency($amount) . '</strong>';
				
				
				break;
			case 'dn_recurrence':
				$recurrence = get_post_meta($post->ID, 'cmsmasters_recurrence_period', true);
				
				
				if ($recurrence == '1') {
					echo '<span class="dashicons dashicons-minus" title="' . __('Not recurring', 'cmsmasters-donations') . '"></span>';
				} elseif ($recurrence == '7') {
					_e('Weekly', 'cmsmasters-donations');
				} elseif ($recurrence == '30') {
					_e('Monthly', 'cmsmasters-donations');
				} elseif ($recurrence == '365') {
					_e('Yearly', 'cmsmasters-donations');
				}
				
				
				break;
			case 'dn_donator':
				$firstname = get_the_donator_meta('firstname', $post->ID);
				
				$lastname = get_the_donator_meta('lastname', $post->ID);
				
				$email = get_the_donator_meta('email', $post->ID);
				
				$website = get_the_donator_meta('website', $post->ID, true);
				
				
				if ($firstname == '' && $lastname == '') {
					_e('No information', 'cmsmasters-donations');
				} else {
					if ($email != '') {
						echo '<a href="mailto:' . esc_attr($email) . '" title="' . esc_attr($email) . '">';
					}
					
					
					echo $firstname;
					
					
					if ($firstname != '' && $lastname != '') {
						echo ' ';
					}
					
					
					echo $lastname;
					
					
					if ($email != '') {
						echo '</a>';
					}
					
					
					if ($website != '') {
						echo '<br />' . 
						'<a href="' . esc_url($website) . '" title="' . esc_attr($website) . '" target="_blank">' . esc_attr($website) . '</a>';
					}
				}
				
				
				break;
			case 'dn_anonymous':
				global $post;
				
				
				if (is_anonymous_donation($post)) {
					echo '<span class="dashicons dashicons-no-alt" title="' . __("Donator's personal info is hidden", 'cmsmasters-donations') . '"></span>';
				} else {
					echo '<span class="dashicons dashicons-yes" title="' . __("Donator's personal info is visible", 'cmsmasters-donations') . '"></span>';
				}
				
				
				break;
			case 'dn_campaign':
				global $post;
				
				
				$campaign = get_the_donation_campaign($post);
				
				
				if ($campaign) {
					echo $campaign;
				} else {
					echo '<span class="dashicons dashicons-minus" title="' . __('No specific campaign', 'cmsmasters-donations') . '"></span>';
				}
				
				
				break;
			case 'dn_status':
				global $post;
				
				
				$icon_classes = '';
				
				
				if ($post->post_status == 'publish') {
					$icon_classes = $post->post_status . ' dashicons dashicons-plus';
				} elseif ($post->post_status == 'pending_payment') {
					$icon_classes = $post->post_status . ' dashicons dashicons-minus';
				} else {
					$icon_classes = $post->post_status . ' dashicons dashicons-no';
				}
				
				
				echo '<span class="' . $icon_classes . '" title="' . esc_attr(get_the_donation_status($post)) . '"></span>';
				
				
				break;
		}
	}
	
	
	public function add_approve_bulk_action() {
		global $post_type;
		
		
		if ($post_type == 'donation') {
			echo '<script type="text/javascript"> ' . 
				'jQuery(document).ready(function () { ' . 
					"jQuery('select[name=action], select[name=action2]').append('<option value=\"approve_payments\">" . esc_html__('Approve payment', 'cmsmasters-donations') . "</option>'); " . 
				'} ); ' . 
			'</script>';
		}
	}
	
	
	public function do_approve_bulk_action() {
		$wp_list_table = _get_list_table('WP_Posts_List_Table');
		
		$action = $wp_list_table->current_action();
		
		
		switch($action) {
		case 'approve_payments':
			check_admin_referer('bulk-posts');
			
			
			$post_ids = array_map('absint', array_filter((array) $_GET['post']));
			
			
			$approved_payments = array();
			
			
			if (!empty($post_ids)) {
				foreach($post_ids as $post_id) {
					$donation_data = array( 
						'ID' => 			$post_id, 
						'post_status' => 	'publish' 
					);
					
					
					if (get_post_status($post_id) == 'pending_payment' && wp_update_post($donation_data)) {
						$approved_payments[] = $post_id;
					}
					
					
					if (get_post_status($post_id) == 'pending_offline' && wp_update_post($donation_data)) {
						$notification = new Cmsmasters_Donations_Emails();


						$notification->send_donator_email($post_id);


						$approved_payments[] = $post_id;
					}
				}
			}
			
			
			wp_redirect(remove_query_arg('approve_payments', add_query_arg('approved_payments', urlencode($approved_payments), admin_url('edit.php?post_type=donation'))));
			
			
			exit;
			
			
			break;
		}
		
		
		return;
	}
	
	
	public function approved_notice() {
		global $post_type, 
			$pagenow;
		
		
		if ( 
			$pagenow == 'edit.php' && 
			$post_type == 'donation' && 
			!empty($_REQUEST['approved_payments']) 
		) {
			$approved_payments = $_REQUEST['approved_payments'];
			
			
			if (is_array($approved_payments)) {
				$approved_payments = array_map('absint', $approved_payments);
				
				
				$titles = array();
				
				
				foreach ($approved_payments as $donation_id) {
					$titles[] = get_the_title($donation_id);
				}
				
				
				echo '<div class="updated">' . 
					'<p>';
				
				
				if (sizeof($titles) > 1) {
					printf(esc_html__('%s payments approved', 'cmsmasters-donations'), '&quot;' . implode('&quot;, &quot;', $titles) . '&quot;');
				} else {
					printf(esc_html__('%s payment approved', 'cmsmasters-donations'), '&quot;' . get_the_title($approved_payments[0]) . '&quot;');
				}
				
				
				echo '</p>' . 
				'</div>';
			}
		}
	}
	
	
	public function add_post_status() {
		global $post, 
			$post_type;
		
		
		if ($post_type != 'donation') {
			return;
		}
		
		
		$post_statuses = array( 
			'pending_payment' => 	__('Pending Payment', 'cmsmasters-donations'), 
			'pending_offline' => 	__('Pending Offline Payment', 'cmsmasters-donations') 
		);
		
		
		$options = '';
		
		$display = '';
		
		
		foreach ($post_statuses as $key => $value) {
			$selected = selected($post->post_status, $key, false);
			
			
			$selected AND $display = $value;
			
			
			$options .= "<option value='{$key}'{$selected}>{$value}</option>";
		}
		
		
		echo '<script type="text/javascript">' . 
			'jQuery(document).ready(function ($) { ';
		
		
		if (!empty($display)) {
			echo "$('#post-status-display').html(\"{$display}\");";
		}
		
		
		echo "var select = $('#post-status-select').find('select');" . 
				"$(select).append(\"{$options}\");" . 
			'} );' . 
		'</script>';
	}
}


function cmsmasters_donations_posttype_init() {
	global $dn;
	
	
	$dn = new Cmsmasters_Donations_Post_Type();
}

add_action('init', 'cmsmasters_donations_posttype_init');

