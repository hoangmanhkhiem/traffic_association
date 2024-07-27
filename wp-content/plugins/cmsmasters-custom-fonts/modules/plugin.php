<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Custom Fonts
 * @version		1.0.0
 * 
 * Created by CMSMasters
 * 
 */


namespace CmsmastersCustomFonts;


class Plugin {
	public function __construct() {
		require_once(CMSMASTERS_CUSTOM_FONTS_PATH . 'modules/autoloader.php');
		
		
		Autoloader::run();
		
		
		new Modules\Custom_Fonts\Fonts_Manager;
	}
}

new Plugin();

