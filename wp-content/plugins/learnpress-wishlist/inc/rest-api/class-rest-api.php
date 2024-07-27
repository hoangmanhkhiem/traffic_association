<?php
/**
 * Register Rest API
 *
 * @author Nhamdv <daonham95@gmail.com>
 *
 */
class LP_Wishlist_Rest_API {
	protected static $instance = null;

	public function __construct() {
		add_filter( 'lp_rest_api_get_rest_namespaces', array( $this, 'rest_api_init' ) );
	}

	public function rest_api_init( $data ) {
		$data['learnpress/v1']['wishlist'] = 'LP_Jwt_Wishlist_V1_Controller';

		return $data;
	}

	public static function instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}
}

LP_Wishlist_Rest_API::instance();
