<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.1.1
 * 
 * CMSMasters Donations Forms Class
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Donations_Forms {
	public function __construct() {
		add_filter('the_content', array($this, 'show_form'));
		
		
		add_action('init', array($this, 'load_posted_form'));
	}
	
	
	public function load_posted_form() {
		if (!empty($_POST['cmsmasters_donations_form'])) {
			$this->load_form_class(sanitize_title($_POST['cmsmasters_donations_form']));
		}
	}
	
	
	private function load_form_class($form_name) {
		global $cmsmasters_donations;
		
		
		if (!class_exists('Cmsmasters_Donations_Form')) {
			require_once(CMSMASTERS_DONATIONS_FORMS . 'abstracts/abstract-cmsmasters-donations-form.php');
		}
		
		
		$form_class = 'Cmsmasters_Donations_Form_' . str_replace('-', '_', $form_name);
		
		
		$form_file = CMSMASTERS_DONATIONS_FORMS . 'cmsmasters-donations-form-' . $form_name . '.php';
		
		
		if (class_exists($form_class)) {
			return $form_class;
		}
		
		
		if (!file_exists($form_file)) {
			return false;
		}
		
		
		if (!class_exists($form_class)) {
			include $form_file;
		}
		
		
		call_user_func(array($form_class, 'init'));
		
		
		return $form_class;
	}
	
	
	public function get_form($form_name) {
		if ($form = $this->load_form_class($form_name)) {
			ob_start();
			
			
			call_user_func(array($form, 'output'));
			
			
			return ob_get_clean();
		}
	}
	
	
	public function show_form($content) {
		global $post;
		
		
		$cmsmasters_donations_form_page = get_option('cmsmasters_donations_form_page');
		
		$cmsmasters_donations_form_content = get_option('cmsmasters_donations_form_content');
		
		
		if (function_exists('icl_object_id')) {
			$page_id = icl_object_id($cmsmasters_donations_form_page, 'page', false);
		} else {
			$page_id = $cmsmasters_donations_form_page;
		}
		
		
		if (!is_admin() && is_page($page_id) && $post->ID == $page_id) {
			$form_content = '[cmsmasters_row data_padding_top="50" data_padding_bottom="20" data_classes="cmsmasters_donation_form_wrapper"]' . 
				'[cmsmasters_column data_width="1/1"]' . 
					(($cmsmasters_donations_form_content != '') ? $cmsmasters_donations_form_content . '<p><br /></p>' : '' ) . 
					Cmsmasters_Donations_Shortcodes::cmsmasters_submit_donation_form() . 
				'[/cmsmasters_column]' . 
			'[/cmsmasters_row]';
			
			
			$content = do_shortcode($form_content);
		}
		
		
		return $content;
	}
}

$GLOBALS['cmsmasters_donations_forms'] = new Cmsmasters_Donations_Forms();

