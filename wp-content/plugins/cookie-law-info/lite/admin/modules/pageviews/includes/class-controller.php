<?php

/**
 * Class Controller file.
 *
 * @package CookieYes
 */

namespace CookieYes\Lite\Admin\Modules\Pageviews\Includes;

use CookieYes\Lite\Integrations\Cookieyes\Includes\Cloud;
use CookieYes\Lite\Includes\Cache;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Handles Cookies Operation
 *
 * @class       Controller
 * @version     3.0.0
 * @package     CookieYes
 */
class Controller extends Cloud {


	/**
	 * Instance of the current class
	 *
	 * @var object
	 */
	private static $instance;
	/**
	 * Cookie items
	 *
	 * @var array
	 */
	protected $cache_group = 'pageviews';

	/**
	 * Consent log limit
	 *
	 * @var integer
	 */
	private static $limit = 100;
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

	/**
	 * Get statistics of consent log
	 *
	 * @return array
	 */
	public function get_pageviews() {
		$pageviews = array();
		$this->make_auth_request();
		$data          = array( 'granularity' => '7d' );
		$response      = $this->get(
			'websites/' . $this->get_website_id() . '/pageviews/chart',
			$data
		);
		$response_code = wp_remote_retrieve_response_code( $response );
		if ( 200 === $response_code ) {
			$response = json_decode( wp_remote_retrieve_body( $response ), true );
			$items    = isset( $response['data'] ) ? $response['data'] : array();
			if ( empty( $items ) ) {
				return $pageviews;
			}
			$total = 0;
			foreach ( $items as $item ) {
				$date        = isset( $item['date'] ) ? $item['date'] : '';
				$views       = isset( $item['views'] ) ? absint( $item['views'] ) : 0;
				$pageviews[] = array(
					'date'  => $date,
					'views' => $views,
				);
			}
		}
		Cache::set( 'pageviews', $this->cache_group, $pageviews );
		return $pageviews;
	}
}
