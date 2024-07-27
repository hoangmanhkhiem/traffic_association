<?php
/**
 * Class Gcm file.
 *
 * @package CookieYes
 */

namespace CookieYes\Lite\Admin\Modules\Gcm;

use CookieYes\Lite\Includes\Modules;
use CookieYes\Lite\Admin\Modules\Gcm\Api\Api;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Gcm extends Modules {
	/**
	 * Constructor.
	 */
	public function init() {
		$controller = Includes\Controller::get_instance();
		add_filter( 'cky_admin_scripts_gcm_config', array( $controller, 'load_common_gcm_settings' ) );
		$this->load_apis();
		$this->load_gcm_default();
	}

	/**
	 * Load API files
	 *
	 * @return void
	 */
	public function load_apis() {
		new Api();
	}

	/**
	 * Main menu template
	 *
	 * @return void
	 */
	public function menu_page_template() {
		echo '<div id="cky-app"></div>';
	}

	public function load_gcm_default() {
		if ( false === cky_first_time_install() ||  false !== get_option( 'cky_gcm_settings', false ) ) {
			return;
		}
		$settings = new \CookieYes\Lite\Admin\Modules\Gcm\Includes\Gcm_Settings();
		$default  = $settings->get_defaults();
		$settings->update( $default );
	}
}