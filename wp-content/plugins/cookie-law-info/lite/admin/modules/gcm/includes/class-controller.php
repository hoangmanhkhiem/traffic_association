<?php
/**
 * Class Controller file.
 *
 * @package CookieYes
 */

namespace CookieYes\Lite\Admin\Modules\Gcm\Includes;

use CookieYes\Lite\Admin\Modules\Gcm\Includes\Gcm_Settings;
use CookieYes\Lite\Integrations\Cookieyes\Includes\Cloud;
use WP_Error;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Controller extends Cloud {

	/**
	 * Instance of the current class
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Return the current instance of the class
	 *
	 * @return object
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function load_common_gcm_settings( $data ) {
		$settings                = new Gcm_Settings();
		$data['settings']        = $settings->get();
		return $data;
	}
}