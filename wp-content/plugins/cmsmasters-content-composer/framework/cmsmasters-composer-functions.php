<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.2.8
 * 
 * Composer Functions
 * Created by CMSMasters
 * 
 */


function cmsmasters_composer_load_template($template_name, $args = array()) {
	$template = locate_template($template_name);
	
	
	if (is_array($args) && !empty($args)) {
		extract($args);
	}
	
	
	include($template);
	
	
	return $out;
}


function cmsmasters_composer_ob_load_template($template_name, $args = array()) {
	if (locate_template($template_name)) {
		$template = locate_template($template_name);
		
		
		if (is_array($args) && !empty($args)) {
			extract($args);
		}
		
		
		ob_start();
		
		
		include($template);
		
		
		$out = ob_get_contents();
		
		
		ob_end_clean();
		
		
		return $out;
	}
}


/* Cmsmasters Ajax template operator callback */
function cmsmasters_ajax_template_operator_callback() {
	$nonce = $_POST['nonce'];

	if( wp_verify_nonce($nonce, 'cmsmasters_ajax_template_operator-nonce') ){
		if (!is_user_logged_in() || !current_user_can('edit_posts')) {
			die(__('You must be logged in to access this script.', 'cmsmasters-content-composer'));
		}


		global $posts;


		if (isset($_POST['type']) && $_POST['type'] == 'add') {
			$name = $_POST['name'];
			$content = stripslashes($_POST['content']);
			
			
			$ins_post_ID = wp_insert_post(array( 
				'post_title' => wp_strip_all_tags($name), 
				'post_name' => generateSlug(wp_strip_all_tags($name), 30), 
				'post_content' => $content, 
				'post_status' => 'publish', 
				'post_type' => 'content_template' 
			));
			
			
			echo '<li>' . 
				'<a href="#" class="cmsmasters_pattern_paste" title="' . __('Load Selected Template', 'cmsmasters-content-composer') . '" data-id="' . $ins_post_ID . '">' . $name . '</a>' . 
				'<a href="#" class="cmsmasters_pattern_delete admin-icon-delete" title="' . __('Delete Selected Template', 'cmsmasters-content-composer') . '" data-id="' . $ins_post_ID . '"></a>' . 
			'</li>';
		} elseif (isset($_POST['type']) && $_POST['type'] == 'load') {
			$id = $_POST['id'];
			
			
			$template = get_post($id);
			
			
			echo $template->post_content;
		} elseif (isset($_POST['type']) && $_POST['type'] == 'del') {
			$id = $_POST['id'];
			
			
			$template = wp_delete_post($id, true);
			
			
			echo $template->ID;
		}
		
		wp_die();
	} else { 
		die('Stop!'); 
	}
}

add_action('wp_ajax_cmsmasters_ajax_template_operator', 'cmsmasters_ajax_template_operator_callback');

add_action('wp_ajax_nopriv_cmsmasters_ajax_template_operator', 'cmsmasters_ajax_template_operator_callback');
