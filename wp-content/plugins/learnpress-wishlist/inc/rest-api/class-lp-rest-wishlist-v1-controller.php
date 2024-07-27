<?php
/**
 * REST API for the Wishlist Add-on.
 *
 * @package LearnPress/JWT/RESTAPI
 * @author Nhamdv <daonham95@gmail.com>
 */
if ( class_exists( 'LP_REST_Jwt_Posts_Controller' ) ) {
	class LP_Jwt_Wishlist_V1_Controller extends LP_REST_Jwt_Controller {
		protected $namespace = 'learnpress/v1';

		protected $rest_base = 'wishlist';

		public function register_routes() {
			register_rest_route(
				$this->namespace,
				'/' . $this->rest_base,
				array(
					array(
						'methods'             => WP_REST_Server::READABLE,
						'callback'            => array( $this, 'get_wishlists' ),
						'permission_callback' => '__return_true',
					),
				)
			);

			register_rest_route(
				$this->namespace,
				'/' . $this->rest_base . '/course/(?P<id>[\d]+)',
				array(
					array(
						'methods'             => WP_REST_Server::READABLE,
						'callback'            => array( $this, 'get_course_wishlist' ),
						'permission_callback' => '__return_true',
					),
				)
			);

			register_rest_route(
				$this->namespace,
				'/' . $this->rest_base . '/toggle',
				array(
					array(
						'methods'             => WP_REST_Server::CREATABLE,
						'callback'            => array( $this, 'add_remove_to_wishlist' ),
						'permission_callback' => '__return_true',
						'args'                => array(
							'id' => array(
								'description'       => esc_html__( 'Course ID', 'learnpress' ),
								'type'              => 'integer',
								'sanitize_callback' => 'absint',
							),
						),
					),
				)
			);
		}

		public function get_wishlists( $request ) {
			$user_id = get_current_user_id();

			$response       = new LP_REST_Response();
			$response->data = new stdClass();

			try {
				if ( empty( $user_id ) ) {
					throw new Exception( esc_html__( 'Login to continue', 'learnpress' ) );
				}

				$user_wishlist = get_user_meta( $user_id, '_lpr_wish_list', true );

				if ( ! empty( $user_wishlist ) ) {
					$response->data->items = $this->rest_do_course_request( $user_wishlist );
				} else {
					$response->data->items = array();
				}

				$response->status = 'success';
			} catch ( \Throwable $th ) {
				$response->message = $th->getMessage();
			}

			return rest_ensure_response( $response );
		}

		public function get_course_wishlist( $request ) {
			$course_id = $request->get_param( 'id' );
			$user_id   = get_current_user_id();

			$response             = new LP_REST_Response();
			$response->data       = new stdClass();
			$response->data->text = array(
				'add'    => esc_html__( 'Add to wishlist', 'learnpress-wishlist' ),
				'remove' => esc_html__( 'Remove from wishlist', 'learnpress-wishlist' ),
			);

			try {
				if ( empty( $course_id ) ) {
					throw new Exception( esc_html__( 'No Course ID param.', 'learnpress' ) );
				}

				$user_wishlist = get_user_meta( $user_id, '_lpr_wish_list', true );

				if ( ! empty( $user_wishlist ) && in_array( absint( $course_id ), $user_wishlist ) ) {
					$response->message           = esc_html__( 'This course available in your wishlist', 'learnpress-wishlist' );
					$response->data->in_wishlist = 'yes';
				} else {
					$response->message           = esc_html__( 'This course not in your wishlist', 'learnpress-wishlist' );
					$response->data->in_wishlist = 'no';
				}

				if ( $user_wishlist ) {
					$response->data->items = $this->rest_do_course_request( $user_wishlist );
				}

				$response->status = 'success';
			} catch ( \Throwable $th ) {
				$response->message = $th->getMessage();
			}

			return rest_ensure_response( $response );
		}

		public function add_remove_to_wishlist( $request ) {
			$course_id = $request->get_param( 'id' );
			$user_id   = get_current_user_id();

			$response             = new LP_REST_Response();
			$response->data       = new stdClass();
			$response->data->text = array(
				'add'    => esc_html__( 'Add to wishlist', 'learnpress-wishlist' ),
				'remove' => esc_html__( 'Remove from wishlist', 'learnpress-wishlist' ),
			);

			try {
				if ( empty( $course_id ) || get_post_type( $course_id ) !== LP_COURSE_CPT ) {
					throw new Exception( esc_html__( 'No Course ID param.', 'learnpress' ) );
				}

				if ( empty( $user_id ) ) {
					throw new Exception( esc_html__( 'No User.', 'learnpress' ) );
				}

				$user_wishlist = get_user_meta( $user_id, '_lpr_wish_list', true );
				$wishlists     = $user_wishlist ? $user_wishlist : array();

				if ( ! empty( $wishlists ) && in_array( $course_id, $wishlists ) ) {
					$pos = array_search( $course_id, $wishlists );

					unset( $wishlists[ $pos ] );

					$response->data->type = 'remove';
					$response->message    = esc_html__( 'This course has been removed from your wishlists', 'learnpress-wishlist' );
				} else {
					$wishlists[] = $course_id;

					$response->data->type = 'add';
					$response->message    = esc_html__( 'This course has been added to your wishlists', 'learnpress-wishlist' );
				}

				if ( ! empty( $wishlists ) && count( $wishlists ) > 0 ) {
					update_user_meta( $user_id, '_lpr_wish_list', $wishlists );

					$response->data->items = $this->rest_do_course_request( $wishlists );
				} else {
					delete_user_meta( $user_id, '_lpr_wish_list' );
				}

				$response->status = 'success';
			} catch ( \Throwable $th ) {
				$response->message = $th->getMessage();
			}

			return rest_ensure_response( $response );
		}

		public function rest_do_course_request( $course_ids ) {
			if ( empty( $course_ids ) ) {
				return array();
			}

			$requests = new WP_REST_Request( 'GET', '/learnpress/v1/courses' );

			$requests->set_query_params( array( 'include' => $course_ids ) );
			$responses = rest_do_request( $requests );
			$server    = rest_get_server();
			$data      = $server->response_to_data( $responses, false );

			return ! empty( $data ) ? $data : array();
		}
	}
}
