<?php
/**
 * REST API LP Widget.
 *
 * @author Nhamdv <daonham95@gmail.com>
 */

class LP_REST_Widgets_Controller extends LP_Abstract_REST_Controller {
	public function __construct() {
		$this->namespace = 'lp/v1';
		$this->rest_base = 'widgets';

		parent::__construct();
	}

	public function register_routes() {
		$this->routes = array(
			'api' => array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'get_content_widgets' ),
					'permission_callback' => '__return_true',
				),
			),
		);

		parent::register_routes();
	}

	public function get_content_widgets( WP_REST_Request $request ): LP_REST_Response {
		global $wp_widget_factory;

		$response       = new LP_REST_Response();
		$response->data = '';

		try {
			$params    = $request->get_params();
			$widget_id = $params['widget'] ?? false; // LP_Widget.
			$instance  = $params['instance'] ?? false;

			if ( empty( $widget_id ) || empty( $instance ) ) {
				throw new Exception( 'Error: No params!' );
			}

			$widget_object = $wp_widget_factory->get_widget_object( $widget_id );

			if ( ! method_exists( $widget_object, 'lp_rest_api_content' ) ) {
				throw new Exception( 'Error: No method lp_rest_api_content!' );
			}

			$instance = json_decode( $instance, true );

			unset( $params['instance'] );
			unset( $params['hash'] );

			$data = $widget_object->lp_rest_api_content( $instance, $params ); // LP_Widget->lp_rest_api_content.

			if ( is_wp_error( $data ) ) {
				throw new Exception( $data->get_error_message() );
			}

			$response->status = 'success';
			$response->data   = $data;
		} catch ( Throwable $th ) {
			$response->status  = 'error';
			$response->message = $th->getMessage();
		}

		return $response;
	}
}
