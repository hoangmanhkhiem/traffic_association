<?php
/**
 * @author    ThemePunch <info@themepunch.com>
 * @link      https://www.themepunch.com/
 * @copyright 2024 ThemePunch
 */

if(!defined('ABSPATH')) exit();

class RevSliderFrontGlobal extends RevSliderFunctions {
	
	const TABLE_SLIDER			 = 'revslider_sliders';
	const TABLE_SLIDES			 = 'revslider_slides';
	const TABLE_STATIC_SLIDES	 = 'revslider_static_slides';
	const TABLE_CSS				 = 'revslider_css';
	const TABLE_LAYER_ANIMATIONS = 'revslider_layer_animations';
	const TABLE_NAVIGATIONS		 = 'revslider_navigations';
	const TABLE_SETTINGS		 = 'revslider_settings'; //existed prior 5.0 and still needed for updating from 4.x to any version after 5.x
	const CURRENT_TABLE_VERSION	 = '1.0.13';
	
	const YOUTUBE_ARGUMENTS		 = 'hd=1&amp;wmode=opaque&amp;showinfo=0&amp;rel=0';
	const VIMEO_ARGUMENTS		 = 'title=0&amp;byline=0&amp;portrait=0&amp;api=1';

	
	/**
	 * START: DEPRECATED FUNCTIONS THAT ARE IN HERE FOR OLD ADDONS TO WORK PROPERLY
	 **/
	 
	/**
	 * old version of add_admin_bar();
	 **/
	public static function putAdminBarMenus(){
		$f = RevSliderGlobals::instance()->get('RevSliderFunctions');
		$f->add_deprecation_message('putAdminBarMenus', 'add_admin_bar');
		return RevSliderFront::add_admin_bar();
	}
	
	/**
	 * END: DEPRECATED FUNCTIONS THAT ARE IN HERE FOR OLD ADDONS TO WORK PROPERLY
	 **/

	public static function welcome_screen_activate(){
		set_transient('_revslider_welcome_screen_activation_redirect', true, 60);
	}

	/**
	 * Add Meta Generator Tag in FrontEnd
	 * @since: 5.0
	 */
	public static function add_meta_generator(){
		echo apply_filters('revslider_meta_generator', '<meta name="generator" content="Powered by Slider Revolution ' . RS_REVISION . ' - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />' . "\n");
	}

	/**
	 * Create Tables
	 * @only_base needs to be false
	 *  it can only be true by fixing database issues
	 *  this protects that the _bkp tables are not filled after 
	 *  we are already on version 6.0
	 **/
	public static function create_tables($only_base = false){
		$table_version = get_option('revslider_table_version', '1.0.0');
		
		if(version_compare($table_version, self::CURRENT_TABLE_VERSION, '<')){
			global $wpdb;

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

			$sql = "CREATE TABLE " . $wpdb->prefix . self::TABLE_SLIDER . " (
			  id int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			  title tinytext NOT NULL,
			  alias tinytext,
			  params LONGTEXT NOT NULL,
			  settings text NULL,
			  type VARCHAR(191) NOT NULL DEFAULT '',
			  INDEX `type_index` (`type`(8))
			);";
			dbDelta($sql);

			$sql = "CREATE TABLE " . $wpdb->prefix . self::TABLE_SLIDES . " (
			  id int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			  slider_id int(9) NOT NULL,
			  slide_order int not NULL,
			  params LONGTEXT NOT NULL,
			  layers LONGTEXT NOT NULL,
			  settings text NOT NULL DEFAULT '',
			  INDEX `slider_id_index` (`slider_id`)
			);";
			dbDelta($sql);

			$sql = "CREATE TABLE " . $wpdb->prefix . self::TABLE_STATIC_SLIDES . " (
			  id int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			  slider_id int(9) NOT NULL,
			  params LONGTEXT NOT NULL,
			  layers LONGTEXT NOT NULL,
			  settings text NOT NULL,
			  INDEX `slider_id_index` (`slider_id`)
			);";
			dbDelta($sql);

			$sql = "CREATE TABLE " . $wpdb->prefix . self::TABLE_CSS . " (
			  id int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			  handle TEXT NOT NULL,
			  settings LONGTEXT,
			  hover LONGTEXT,
			  advanced LONGTEXT,
			  params LONGTEXT NOT NULL,
			  INDEX `handle_index` (`handle`(64))
			);";
			dbDelta($sql);

			$sql = "CREATE TABLE " . $wpdb->prefix . self::TABLE_LAYER_ANIMATIONS . " (
			  id int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			  handle TEXT NOT NULL,
			  params TEXT NOT NULL,
			  settings text NULL
			);";
			dbDelta($sql);

			$sql = "CREATE TABLE " . $wpdb->prefix . self::TABLE_NAVIGATIONS . " (
			  id int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			  name VARCHAR(191) NOT NULL,
			  handle VARCHAR(191) NOT NULL,
			  type VARCHAR(191) NOT NULL,
			  css LONGTEXT NOT NULL,
			  markup LONGTEXT NOT NULL,
			  settings LONGTEXT NULL
			);";
			dbDelta($sql);

			//create CSS entries
			$result = $wpdb->get_row("SELECT COUNT( DISTINCT id ) AS NumberOfEntrys FROM " . $wpdb->prefix . self::TABLE_CSS);
			if(!empty($result) && $result->NumberOfEntrys == 0){
				$css_class = RevSliderGlobals::instance()->get('RevSliderCssParser');
				$css_class->import_css_captions();
			}

			//V7 tables
			$sql = "CREATE TABLE " . $wpdb->prefix . self::TABLE_SLIDER."7" . " (
				id int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				title tinytext NOT NULL,
				alias tinytext,
				params LONGTEXT NOT NULL,
				settings text NULL,
				type VARCHAR(191) NOT NULL DEFAULT '',
				INDEX `type_index` (`type`(8))
			  );";
			  dbDelta($sql);
  
			  $sql = "CREATE TABLE " . $wpdb->prefix . self::TABLE_SLIDES."7" . " (
				id int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				slider_id int NOT NULL,
				slide_order int not NULL,
				params LONGTEXT NOT NULL,
				layers LONGTEXT NOT NULL,
				settings text NOT NULL DEFAULT '',
				static VARCHAR(191) NOT NULL DEFAULT '',
				INDEX `slider_id_index` (`slider_id`)
			  );";
			  dbDelta($sql);

			update_option('revslider_table_version', self::CURRENT_TABLE_VERSION);
			//$table_version = self::CURRENT_TABLE_VERSION;
		}
	}

	/**
	 * Add functionality to gutenberg, elementor, visual composer and so on
	 **/
	public static function add_post_editor(){
		/**
		 * Page Editor Extensions
		 **/
		if(function_exists('is_user_logged_in') && is_user_logged_in()){
			//only include gutenberg for production
			if(is_admin() && defined('ABSPATH')){
				include_once(ABSPATH . 'wp-admin/includes/plugin.php');
				if(function_exists('is_plugin_active') && !is_plugin_active('revslider-gutenberg/plugin.php')){
					require_once(RS_PLUGIN_PATH . 'admin/includes/shortcode_generator/gutenberg/gutenberg-block.php');
					new RevSliderGutenberg('gutenberg/');
				}
			}
			
			require_once(RS_PLUGIN_PATH . 'admin/includes/shortcode_generator/shortcode_generator.class.php');
			add_action('enqueue_block_assets', array('RevSliderShortcodeWizard', 'sr_theme_block_editor_assets'));

			//Shortcode Wizard Includes
			//WPB Functionality
			require_once(RS_PLUGIN_PATH . 'admin/includes/shortcode_generator/wpbakery/wpbakery.class.php');
			add_action('vc_before_init', array('RevSliderWpbakeryShortcode', 'visual_composer_include')); //VC functionality
			add_action('admin_enqueue_scripts', array('RevSliderShortcodeWizard', 'enqueue_scripts'));
			add_action('admin_footer', array('RevSliderShortcodeWizard', 'enqueue_files'));
			//add_action('wp_footer', array('RevSliderShortcodeWizard', 'enqueue_files'));
			add_action('vc_before_init', array('RevSliderShortcodeWizard', 'add_styles')); //VC functionality
		}
		
		

		//Elementor Functionality
		require_once(RS_PLUGIN_PATH . 'admin/includes/shortcode_generator/elementor/elementor.class.php');
		add_action('init', array('RevSliderElementor', 'init'));
		add_action('elementor/editor/before_enqueue_scripts', array('RevSliderShortcodeWizard', 'enqueue_files'));
	}

	/**
	 * sets the post saving value to true, so that the output echo will not be done
	 **/
	public static function set_post_saving(){
		global $SR_GLOBALS;
		$SR_GLOBALS['save_post'] = true;
	}
	
	/**
	 * get the images from posts/pages for yoast seo
	 **/
	public static function get_images_for_seo($url, $type, $user){
		if(in_array($type, array('user', 'term'), true)) return $url;
		if(!is_object($user) || !isset($user->ID)) return $url;
		
		$post = get_post($user->ID);
		if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'rev_slider')){
			preg_match_all('/\[rev_slider.*alias=.(.*)"\]/', $post->post_content, $shortcodes);
			
			if(isset($shortcodes[1]) && $shortcodes[1] !== ''){
				foreach($shortcodes[1] as $s){
					if(strpos($s, '"') !== false){
						$s = explode('"', $s);
						$s = (isset($s[0])) ? $s[0] : '';
					}
					if(!RevSliderSlider::alias_exists($s)) continue;
					
					$sldr = new RevSliderSlider();
					$sldr->init_by_alias($s);
					$sldr->get_slides();
					$imgs = $sldr->get_images();
					if(!empty($imgs)){
						if(!isset($url['images'])) $url['images'] = array();
						foreach($imgs as $v){
							$url['images'][] = $v;
						}
					}
				}
			}
		}
		
		return $url;
	}

	/**
	 * prevent WP Rocket from removing our frontend css for font loading
	 */
	public static function wp_rocket_inline_atts_exclusions($inline_atts_exclusions){
		$inline_atts_exclusions[] = "sr7-inline-css";	
		return $inline_atts_exclusions;
	}
}