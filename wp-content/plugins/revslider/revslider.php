<?php
/*
Plugin Name: Slider Revolution
Plugin URI: https://www.sliderrevolution.com/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=info
Description: Slider Revolution - More than just a WordPress Slider
Author: ThemePunch
Text Domain: revslider
Domain Path: /languages
Version: 6.7.0
Author URI: https://themepunch.com/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=info
*/

// If this file is called directly, abort.
if(!defined('WPINC')){ die; }

if(class_exists('RevSliderFront')){
	die('ERROR: It looks like you have more than one instance of Slider Revolution installed. Please remove additional instances for this plugin to work again.');
}

define('RS_REVISION',			'6.7.0');
define('RS_PLUGIN_PATH',		plugin_dir_path(__FILE__));
define('RS_PLUGIN_SLUG_PATH',	plugin_basename(__FILE__));
define('RS_PLUGIN_FILE_PATH',	__FILE__);
define('RS_PLUGIN_SLUG',		apply_filters('set_revslider_slug', 'revslider'));
define('RS_PLUGIN_URL',			get_sr_plugin_url());
define('RS_PLUGIN_URL_CLEAN',	str_replace(array('http://', 'https://'), '//', RS_PLUGIN_URL));
define('RS_DEMO',				false);
define('RS_TP_TOOLS',			'6.7.0'); //holds the version of the tp-tools script, load only the latest!

global $SR_GLOBALS;

$SR_GLOBALS = array(
	'addon_notice_merged'	=> 0,
	'animations'			=> array(),
	'collections'			=> array(
		'css'	=> array(),
		'ids'	=> array(),
		'js'	=> array('revapi' => array(), 'js' => array(), 'minimal' => '', 'stream' => array()),
		'trans'	=> array(),
		'nav'	=> array('arrows' => array(), 'thumbs' => array(), 'bullets' => array(), 'tabs' => array(), 'scrubber' => array()),
		'v6tov7'=> array('n' => array(), 's' => array()),
	),
	'deprecated'			=> array(),
	'fonts'					=> array('queue' => array(), 'loaded' => array()),
	'front_version'			=> get_sr_current_engine(),
	'header_js'				=> false,
	'icon_sets'				=> array(
		'Materialicons' => array('css' => false, 'parsed' => false),
		'FontAwesome'	=> array('css' => false, 'parsed' => false),
		'PeIcon'		=> array('css' => false, 'parsed' => false),
		'RevIcon'		=> array('css' => false, 'parsed' => false)
	),
	'data_init'				=> true,
	'js_init'				=> false,
	'loaded_by_editor'		=> false,
	'preview_mode'			=> false,
	'save_post'				=> false,
	'use_table_version'		=> 6,
	'serial'				=> 0,
	'bad_extensions'		=> array(
		'php', 'php2', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'phps', 'pht', 'phtm', 'phtml', 'pgif', 'shtml', 'htaccess', 'phar', 'inc', 'hphp', 'ctp', 'module',
		'asp', 'aspx', 'config', 'ashx', 'asmx', 'aspq', 'axd', 'cshtm', 'cshtml', 'rem', 'soap', 'vbhtm', 'vbhtml', 'asa', 'cer', 'shtml',
		'jsp', 'jspx', 'jsw', 'jsv', 'jspf', 'wss', 'do', 'action',
		'cfm, .cfml, .cfc, .dbm',
		'swf',
		'pl', 'cgi',
		'yaws',
		'zip', 'rar', '7z',
		'html', 'htm', 'js', 'exe', 'bat', 'cmd', 'vbs', 'msi', 'reg', 'scr', 'com', 'pif', 'jsp', 'asp', 'aspx', 'cgi', 'pl', 'swf', 'htaccess', 'sh', 'py', 'rb', 'ps1', 'psm1', 'jar', 'jspx', 'xhtml', 'jspx', 'shtml', 'ini', 'dll', 'sys', 'jspx'
	),
	'mime_types'			=> array(
		'image'	=> array('jpg|jpeg|jpe' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif', 'bmp' => 'image/bmp', 'webp' => 'image/webp', 'svg' => 'image/svg+xml'),
		'video'	=> array('mpeg|mpg|mpe' => 'video/mpeg', 'mp4|m4v' => 'video/mp4', 'ogv' => 'video/ogg', 'webm' => 'video/webm')
	)
);

//include framework files
require_once(RS_PLUGIN_PATH . 'includes/data.class.php');
require_once(RS_PLUGIN_PATH . 'includes/functions.class.php');
require_once(RS_PLUGIN_PATH . 'includes/cache.class.php');
require_once(RS_PLUGIN_PATH . 'includes/em-integration.class.php');
require_once(RS_PLUGIN_PATH . 'includes/cssparser.class.php');
require_once(RS_PLUGIN_PATH . 'includes/woocommerce.class.php');

require_once(RS_PLUGIN_PATH . 'includes/colorpicker.class.php');
require_once(RS_PLUGIN_PATH . 'includes/navigation.class.php');
require_once(RS_PLUGIN_PATH . 'includes/object-library.class.php');
require_once(RS_PLUGIN_PATH . 'admin/includes/loadbalancer.class.php');
require_once(RS_PLUGIN_PATH . 'admin/includes/plugin-update.class.php');
require_once(RS_PLUGIN_PATH . 'admin/includes/widget.class.php');
require_once(RS_PLUGIN_PATH . 'includes/extension.class.php');
require_once(RS_PLUGIN_PATH . 'includes/favorite.class.php');
require_once(RS_PLUGIN_PATH . 'includes/aq-resizer.class.php');
require_once(RS_PLUGIN_PATH . 'includes/page-template.class.php');

require_once(RS_PLUGIN_PATH . 'includes/external/facebook.class.php');
require_once(RS_PLUGIN_PATH . 'includes/external/flickr.class.php');
require_once(RS_PLUGIN_PATH . 'includes/external/instagram.class.php');
require_once(RS_PLUGIN_PATH . 'includes/external/vimeo.class.php');
require_once(RS_PLUGIN_PATH . 'includes/external/youtube.class.php');

require_once(RS_PLUGIN_PATH . 'includes/slider.class.php');
require_once(RS_PLUGIN_PATH . 'includes/slide.class.php');
require_once(RS_PLUGIN_PATH . 'includes/output.sr6.class.php');
require_once(RS_PLUGIN_PATH . 'includes/output.sr7.class.php');
require_once(RS_PLUGIN_PATH . 'public/revslider-front-global.class.php');
if($SR_GLOBALS['front_version'] === 6){
	require_once(RS_PLUGIN_PATH . 'sr6/revslider-front.class.php');
}else{
	require_once(RS_PLUGIN_PATH . 'public/revslider-front.class.php');
}

require_once(RS_PLUGIN_PATH . 'includes/globals.class.php');
require_once(RS_PLUGIN_PATH . 'includes/api.class.php');
require_once(RS_PLUGIN_PATH . 'includes/backwards.php');
require_once(RS_PLUGIN_PATH . 'includes/wpml.class.php');

//divi
require_once(RS_PLUGIN_PATH . 'admin/includes/shortcode_generator/divi/revslider-divi.php');

try{
	RevSliderFunctions::set_memory_limit();

	function rev_slider_shortcode($args, $mid_content = null){

		//do not render in elementor preview iframe
		if(isset($_GET['elementor-preview'])) return false;

		//do not render on saving a post/page
		global $SR_GLOBALS;
		if($SR_GLOBALS['save_post']) return false;
		
		//skip shortcode generation if any of these functions found in backtrace 
		//function can be provided as array item without key
		//or as 'class' => 'function'
		$skip_functions = apply_filters(
			'rs_shortcode_skip_functions',
			array(
				'WC_Structured_Data' => 'generate_product_data', // woocommerce
				'AIOSEO\Plugin\Common\Meta\Description' => 'getDescription', // all-in-one-seo
				//'Elementor\Core\Editor\Editor' => 'print_editor_template', // elementor
			)
		);

		$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		foreach($backtrace as $trace){
			foreach($skip_functions as $class => $func){
				if($trace['function'] == $func){
					//no class was provided, func matched, return
					if(!is_string($class)) return false;
					//class provided in key, compare with trace class
					if(isset($trace['class']) && $trace['class'] == $class) return false;
				}
			}
		}
		
		$sc		= shortcode_atts(array('alias' => '', 'layout' => '', 'modal' => '', 'offset' => '', 'order' => '', 'settings' => '', 'skin' => '', 'usage' => '', 'zindex' => ''), $args, 'rev_slider');
		$sc		= array_map('wp_kses_post', $sc);
		$output = ($SR_GLOBALS['front_version'] === 6) ? new RevSliderOutput() : new RevSlider7Output();

		if(is_admin() && $output->_is_gutenberg_page()) return false;

		$slider_alias = ($sc['alias'] != '') ? $sc['alias'] : $output->get_val($args, 0); //backwards compatibility

		//this fixes an issue with the Visual Composer extension
		if(empty($slider_alias)){
			return (function_exists('is_user_logged_in') && is_user_logged_in()) ? '<div><img src="' . RS_PLUGIN_URL_CLEAN . 'admin/assets/images/rs6_logo_2x.png"></div>' : '';
		}

		$output->set_custom_order($sc['order']);
		$output->set_custom_settings($sc['settings']);
		$output->set_custom_skin($sc['skin']);

		$gallery_ids = $output->check_for_shortcodes($mid_content); //check for example on gallery shortcode and do stuff
		if($gallery_ids !== false) $output->set_gallery_ids($gallery_ids);

		ob_start();
		
		//reset after each Slider back to origin
		$table_version = $SR_GLOBALS['use_table_version'];

		if($SR_GLOBALS['front_version'] === 6){
			$slider = $output->add_slider_to_stage($slider_alias, $sc['usage'], $sc['layout'], $sc['offset'], $sc['modal']);
		}else{
			$output->set_usage($sc['usage']);
			$output->set_layout($sc['layout']);
			$output->set_offset($sc['offset']);
			$sc['modal'] = (empty($sc['modal'])) ? 'true' : $sc['modal'];
			if($sc['usage'] === 'modal') $output->set_modal($sc['modal']);
			$slider = $output->add_slider_to_stage($slider_alias);
		}
		$content = ob_get_contents();

		$SR_GLOBALS['use_table_version'] = $table_version;

		ob_clean();
		ob_end_clean();

		if(!empty($sc_attr['zindex'])){
			$content = '<div class="wp-block-themepunch-revslider" style="z-index:'.esc_attr($sc_attr['zindex']).';">'. $content .'</div>';
		}

		if(empty($slider)) return $content;
		$filter = ($slider->v7) ? $slider->get_param(array('general', 'outPutFilter'), '') : $slider->get_param(array('troubleshooting', 'outPutFilter'), '');
		switch($filter){
			case 'compress':
				$content = str_replace(array("\n", "\r"), '', $content);
				return $content;
			case 'echo':
				global $SR_GLOBALS;
				if($SR_GLOBALS['save_post']) return $content;
				echo $content; //bypass the filters
			break;
		}

		return $content;
	}
	
	$SR_wpml	= RevSliderGlobals::instance()->get('RevSliderWpml');
	$SR_api		= RevSliderGlobals::instance()->get('RevSliderApi');
	$rslb		= RevSliderGlobals::instance()->get('RevSliderLoadBalancer');
	$rslb->refresh_server_list();
	add_shortcode('rev_slider', 'rev_slider_shortcode');
	add_shortcode('sr7', 'rev_slider_shortcode');
	add_action('save_post', array('RevSliderFront', 'set_post_saving'));
	add_action('widgets_init', array('RevSliderWidget', 'register_widget'));

	if(is_admin()){
		require_once(RS_PLUGIN_PATH . 'admin/includes/license.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/addons.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/template.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/functions-admin.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/folder.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/import.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/export.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/export-html.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/newsletter.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/revslider-admin.class.php');
		require_once(RS_PLUGIN_PATH . 'includes/update.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/tracking.class.php');
		//require_once(RS_PLUGIN_PATH . 'admin/includes/debug.php');
		$sr_track	= RevSliderGlobals::instance()->get('RevSliderTracking');
		$sr_admin	= RevSliderGlobals::instance()->get('RevSliderAdmin');
	}else{
		$rev_slider_front = new RevSliderFront();
	}

	register_activation_hook(__FILE__, array('RevSliderFront', 'create_tables'));
	register_activation_hook(__FILE__, array('RevSliderFront', 'welcome_screen_activate'));

	add_action('plugins_loaded', array('RevSliderFront', 'create_tables'));
	add_action('plugins_loaded', array('RevSliderPluginUpdate', 'do_update_checks')); //add update checks
	add_action('plugins_loaded', array('RevSliderPageTemplate', 'get_instance'));
	add_action('plugins_loaded', array('RevSliderFront', 'add_post_editor'));
	add_filter('wpseo_sitemap_entry', array('RevSliderFront', 'get_images_for_seo'), 10, 3);
	add_filter('rocket_rucss_inline_atts_exclusions', array('RevSliderFront', 'wp_rocket_inline_atts_exclusions'));
}catch(Exception $e){
	$message = $e->getMessage();
	//$trace = $e->getTraceAsString();
	echo _e('Revolution Slider Error:', 'revslider').' <b>'. esc_html($message) .'</b>';
}

/**
 * add RevSlider to the page/post
 */
function putRevSlider($data, $put_in = ''){
	add_revslider($data, $put_in);
}

function add_revslider($data, $put_in = ''){
	global $SR_GLOBALS;

	//reset after each Slider back to origin
	$table_version = $SR_GLOBALS['use_table_version'];
	$output		= ($SR_GLOBALS['front_version'] === 6) ? new RevSliderOutput() : new RevSlider7Output();
	$g_values	= $output->get_global_settings();
	$add_to		= $output->get_val($g_values, 'includeids', '');
	$output->set_add_to($add_to);
	if($output->check_add_to(true) == false && $output->_truefalse($output->get_val($g_values, 'allinclude', true)) == false){
		$output->print_error_message(__('If you want to use the PHP function "add_revslider" in your code please make sure to activate ', 'revslider').__('"Include RevSlider libraries globally" ', 'revslider').__('and/or add the current page to the ', 'revslider').__('"Pages to include RevSlider libraries" option ', 'revslider').__('in the "Global Settings" of Slider Revolution.', 'revslider'));
		return false;
	}

	ob_start();
	$output->set_add_to($put_in);
	$slider = $output->add_slider_to_stage($data);
	$content = ob_get_contents();
	ob_clean();
	ob_end_clean();

	echo $content;

	$SR_GLOBALS['use_table_version'] = $table_version;
}

function get_sr_plugin_url(){
	$url = str_replace('index.php', '', plugins_url('index.php', __FILE__ ));
	if(strpos($url, 'http') === false){
		$site_url	= get_site_url();
		$url		= (substr($site_url, -1) === '/') ? substr($site_url, 0, -1). $url : $site_url. $url;
	}
	
	return str_replace(array(chr(10), chr(13)), '', $url);
}

function get_sr_current_engine(){
	$global	= get_option('revslider-global-settings', '');
	$global	= (!is_array($global)) ? json_decode($global, true) : $global;
	$engine	= (isset($global['getTec']) && isset($global['getTec']['engine']) && $global['getTec']['engine'] === 'SR7') ? 7 : 6;
	$engine	= (isset($_GET['srengine']) && (intval($_GET['srengine']) === 6 || intval($_GET['srengine']) === 7)) ? intval($_GET['srengine']) : $engine;
	if(isset($_REQUEST['action']) && isset($_REQUEST['client_action']) && isset($_REQUEST['nonce'])){ // && wp_verify_nonce($_REQUEST['nonce'], 'revslider_actions') !== false
		if($_REQUEST['action'] === 'rs_ajax_action' && $_REQUEST['client_action'] === 'preview_slider') $engine = 6;
	}

	return $engine;
}