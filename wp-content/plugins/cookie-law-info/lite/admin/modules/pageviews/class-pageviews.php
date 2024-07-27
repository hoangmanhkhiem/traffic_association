<?php

/**
 * Class Pageviews file.
 *
 * @package CookieYes
 */

namespace CookieYes\Lite\Admin\Modules\Pageviews;

use CookieYes\Lite\Includes\Modules;
use CookieYes\Lite\Admin\Modules\Pageviews\Includes\Controller;
use CookieYes\Lite\Admin\Modules\Pageviews\Api\Api;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Handles Cookies Operation
 *
 * @class       Pageviews
 * @version     3.0.0
 * @package     CookieYes
 */
class Pageviews extends Modules {


	/**
	 * Pageviews controller class.
	 *
	 * @var object
	 */
	private $controller;

	/**
	 * Constructor.
	 */
	public function init() {
		$this->load_apis();
		$this->controller = Controller::get_instance();
	}

	/**
	 * Load API files
	 *
	 * @return void
	 */
	public function load_apis() {
		new Api();
	}
}
