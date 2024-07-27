<?php
/**
 * Class Api file.
 *
 * @package Gcm
 */

namespace CookieYes\Lite\Admin\Modules\Gcm\Api;

use WP_REST_Server;
use WP_Error;
use CookieYes\Lite\Includes\Rest_Controller;
use CookieYes\Lite\Admin\Modules\Gcm\Includes\Gcm_Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Api extends Rest_Controller {

	/**
	 * Endpoint namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'cky/v1';
	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = 'gcm';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ), 10 );
	}
	/**
	 * Register the routes for gcm.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'create_item' ),
					'permission_callback' => array( $this, 'create_item_permissions_check' ),
					'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::CREATABLE ),
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);
	}

	/**
	 * Create gcm.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_Error|WP_REST_Response
	 */
	public function create_item( $request ) {
		if ( false === cky_is_cloud_request() ) {
			return new WP_Error( 'cookieyes_rest_invalid_data', __( 'Invalid method', 'cookie-law-info' ), array( 'status' => 404 ) );
		}
		$data = $this->prepare_item_for_database( $request );
		$context = ! empty( $request['context'] ) ? $request['context'] : 'view';
		$data    = $this->add_additional_fields_to_object( $data, $request );
		$data    = $this->filter_response_by_context( $data, $context );
		return rest_ensure_response( $data );
	}

	public function prepare_item_for_database( $request ) {
		$object     = new Gcm_Settings();
		$data       = $object->get();
		$schema     = $this->get_item_schema();
		$properties = isset( $schema['properties'] ) && is_array( $schema['properties'] ) ? $schema['properties'] : array();
		if ( ! empty( $properties ) ) {
			$properties_keys = array_keys(
				array_filter(
					$properties,
					function( $property ) {
						return isset( $property['readonly'] ) && true === $property['readonly'] ? false : true;
					}
				)
			);
			foreach ( $properties_keys as $key ) {
				$value        = isset( $request[ $key ] ) ? $request[ $key ] : '';
				$data[ $key ] = $value;
			}
		}
		$object->update( $data );
		return $object->get();
	}

	/**
	 * Get the Gcm's schema, conforming to JSON Schema.
	 *
	 * @return array
	 */
	public function get_item_schema() {
		$schema = array(
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			'title'      => 'gcm',
			'type'       => 'object',
			'properties' => array(
				'status'           => array(
					'description' => __( 'GCM status.', 'cookie-law-info' ),
					'type'        => 'boolean',
					'context'     => array( 'view', 'edit' ),
				),
				'default_settings'         => array(
					'description' => __( 'Default settings.', 'cookie-law-info' ),
					'type'        => 'array',
					'context'     => array( 'view', 'edit' ),
				),
				'wait_for_update'          => array(
					'description' => __( 'Wait for update.', 'cookie-law-info' ),
					'type'        => 'integer',
					'context'     => array( 'view', 'edit' ),
				),
				'url_passthrough'      => array(
					'description' => __( 'Pass ad click information through URLs.', 'cookie-law-info' ),
					'type'        => 'boolean',
					'context'     => array( 'view', 'edit' ),
				),
				'ads_data_redaction' => array(
					'description' => __( 'Redact ads data.', 'cookie-law-info' ),
					'type'        => 'boolean',
					'context'     => array( 'view', 'edit' ),
				),
			),
		);

		return $this->add_additional_fields_schema( $schema );
	}
}
