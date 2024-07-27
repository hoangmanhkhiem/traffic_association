<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.0.0
 * 
 * Register Composer Shortcodes for Editor
 * Created by CMSMasters
 * 
 */


if (!class_exists('CMSMastersShortcodes')) {
	class CMSMastersShortcodes { 
		public $buttonName;
		
		
        public $buttonTitle;
		
		
		function __construct() { 
			$this->buttonName = 'cmsmasters_shortcodes';
			
			$this->buttonTitle = __('CMSMasters Shortcodes', 'cmsmasters-content-composer');
		}
		
		
		function addButton() { 
			if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
				return;
			}
			
			
			if (get_user_option('rich_editing') == 'true') {
				add_filter('mce_external_plugins', array($this, 'registerTmcePlugin'));
				
				
				add_filter('mce_buttons', array($this, 'registerButton'));
			}
		}
		
		
		function registerTmcePlugin($buttons) { 
			$buttons[$this->buttonName] = CMSMASTERS_CONTENT_COMPOSER_URL . 'framework/js/cmsmasters-editor-shortcodes-plugin.js';
			
			
			return $buttons;
		}
		
		
		function registerButton($buttons) { 
			array_push($buttons, $this->buttonName);
			
			
			return $buttons;
		}
	}
}


if (!isset($cmsmasters_shortcodes)) {
	$cmsmasters_shortcodes = new CMSMastersShortcodes();
	
	
	add_action('admin_head', array($cmsmasters_shortcodes, 'addButton'));
}

