<?php
/**
 * Dashboard controller class.
 *
 * @link       https://www.cookieyes.com/
 * @since      3.0.0
 *
 * @package    CookieYes\Lite\Admin\Modules\Dashboard\Includes
 */

namespace CookieYes\Lite\Admin\Modules\Dashboard\Includes;

use CookieYes\Lite\Integrations\Cookieyes\Includes\Cloud;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Dashboard controller class.
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
	public $languages;

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
	 * Load data
	 *
	 * @return array
	 */
	public function get_items() {
		$data = array();
		if ( ! $this->get_website_id() ) {
			return $data;
		}
		$response      = $this->get(
			'websites/' . $this->get_website_id() . '/dashboard'
		);
		$response_code = wp_remote_retrieve_response_code( $response );
		if ( 200 === $response_code ) {
			$response = json_decode( wp_remote_retrieve_body( $response ), true );
			$stats    = isset( $response['statistics'] ) ? $response['statistics'] : array();
			$data     = array(
				'cookies'    => isset( $stats['total_cookies'] ) ? $stats['total_cookies'] : 0,
				'scripts'    => isset( $stats['total_scripts'] ) ? $stats['total_scripts'] : 0,
				'categories' => isset( $stats['total_categories'] ) ? $stats['total_categories'] : 0,
				'pages'      => isset( $stats['total_pages'] ) ? $stats['total_pages'] : 0,
			);
		}
		return $data;
	}

	public function get_plans() {
		$data = array();
		$response      = $this->get(
			'plans'
		);
		$response_code = wp_remote_retrieve_response_code( $response );
		if ( 200 === $response_code ) {
			$response = json_decode( wp_remote_retrieve_body( $response ), true );
			if (isset($response['freePlan'])) {
				$item = $response['freePlan'];
				$data['plan']['free']['features']['scan_limit'] = isset($item['scan_limit']) ? $item['scan_limit'] : '';
				$data['plan']['free']['features']['page_view_limit'] = isset($item['features']['page_view_limit']) ? $item['features']['page_view_limit'] : '';
				if (isset($item['features'])) {
					foreach ($item['features'] as $key => $value) {
						$data['plan']['free']['features'][$key] = $value;
					}
				}
			}
			if (isset($response['paidPlans'])) {
				$items = $response['paidPlans'];
				foreach($items as $val) {
					if($val['slug'] === 'basic-monthly') {
						$data['plan']['basic']['features']['scan_limit'] = isset($val['scan_limit']) ? $val['scan_limit'] : '';
						$data['plan']['basic']['features']['page_view_limit'] = isset($val['features']['page_view_limit']) ? $val['features']['page_view_limit'] : '';
						if (isset($val['features'])) {
							foreach ($val['features'] as $key => $value) {
								$data['plan']['basic']['features'][$key] = $value;
							}
						}
						if(isset($val['currency'])){
							$data['plan']['basic']['monthly'][$val['currency']] = isset($val['cost']) ? $val['cost'] : '';
						}
					}
					if($val['slug'] === 'pro-monthly') {
						$data['plan']['pro']['features']['scan_limit'] = isset($val['scan_limit']) ? $val['scan_limit'] : '';
						$data['plan']['pro']['features']['page_view_limit'] = isset($val['features']['page_view_limit']) ? $val['features']['page_view_limit'] : '';
						if (isset($val['features'])) {
							foreach ($val['features'] as $key => $value) {
								$data['plan']['pro']['features'][$key] = $value;
							}
						}
						if(isset($val['currency'])){
							$data['plan']['pro']['monthly'][$val['currency']] = isset($val['cost']) ? $val['cost'] : '';
						}
					}
					if($val['slug'] === 'ultimate-monthly') {
						$data['plan']['ultimate']['features']['scan_limit'] = isset($val['scan_limit']) ? $val['scan_limit'] : '';
						$data['plan']['ultimate']['features']['page_view_limit'] = isset($val['features']['page_view_limit']) ? $val['features']['page_view_limit'] : '';
						if (isset($val['features'])) {
							foreach ($val['features'] as $key => $value) {
								$data['plan']['ultimate']['features'][$key] = $value;
							}
						}
						if(isset($val['currency'])){
							$data['plan']['ultimate']['monthly'][$val['currency']] = isset($val['cost']) ? $val['cost'] : '';
						}
					}
					if(isset($val['currency'])) {
						if($val['slug'] === 'basic-yearly') {
							$data['plan']['basic']['yearly'][$val['currency']] = isset($val['cost']) ? $val['cost'] : '';
						}
						elseif($val['slug'] === 'pro-yearly') {
							$data['plan']['pro']['yearly'][$val['currency']] = isset($val['cost']) ? $val['cost'] : '';
						}
						elseif($val['slug'] === 'ultimate-yearly') {
							$data['plan']['ultimate']['yearly'][$val['currency']] = isset($val['cost']) ? $val['cost'] : '';
						}
					}
				}
			}
		}
		return $data;
	}

	public function get_currencies() {
		$data = array();
		$response      = $this->get(
			'currencies'
		);
		$response_code = wp_remote_retrieve_response_code( $response );
		if ( 200 === $response_code ) {
			$response = json_decode( wp_remote_retrieve_body( $response ), true );
			if( $response['success'] ) {
				$data = isset( $response['data'] ) ? $response['data'] : array();
			}
		}
		return $data;
	}
}