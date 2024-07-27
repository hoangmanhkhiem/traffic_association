<?php
/**
 * REST API for the Course Review Add-on.
 *
 * @package LearnPress/JWT/RESTAPI
 * @author Nhamdv <daonham95@gmail.com>
 */
if ( class_exists( 'LP_REST_Jwt_Posts_Controller' ) ) {
	class LP_Jwt_Course_Review_V1_Controller extends LP_REST_Jwt_Controller {
		protected $namespace = 'learnpress/v1';

		protected $rest_base = 'review';

		public function register_routes() {
			register_rest_route(
				$this->namespace,
				'/' . $this->rest_base . '/course/(?P<id>[\d]+)',
				array(
					array(
						'methods'             => WP_REST_Server::READABLE,
						'callback'            => array( $this, 'get_item_review' ),
						'permission_callback' => '__return_true',
						'args'                => array(
							'page'     => array(
								'description'       => esc_html__( 'Paged', 'learnpress-course-review' ),
								'type'              => 'integer',
								'sanitize_callback' => 'absint',
							),
							'per_page' => array(
								'description'       => esc_html__( 'Per page', 'learnpress-course-review' ),
								'type'              => 'integer',
								'sanitize_callback' => 'absint',
							),
						),
					),
				)
			);

			register_rest_route(
				$this->namespace,
				'/' . $this->rest_base . '/submit',
				array(
					array(
						'methods'             => WP_REST_Server::CREATABLE,
						'callback'            => array( $this, 'submit_review' ),
						'permission_callback' => '__return_true',
						'args'                => array(
							'id'      => array(
								'description'       => esc_html__( 'Course ID', 'learnpress-course-review' ),
								'type'              => 'integer',
								'sanitize_callback' => 'absint',
							),
							'rate'    => array(
								'description'       => esc_html__( 'Rate', 'learnpress-course-review' ),
								'type'              => 'integer',
								'sanitize_callback' => 'absint',
							),
							'title'   => array(
								'description'       => esc_html__( 'Title', 'learnpress-course-review' ),
								'type'              => 'string',
								'sanitize_callback' => 'sanitize_text_field',
							),
							'content' => array(
								'description'       => esc_html__( 'Content', 'learnpress-course-review' ),
								'type'              => 'string',
								'sanitize_callback' => 'sanitize_text_field',
							),
						),
					),
				)
			);
		}

		protected function check_can_review( $course_id ) {
			$user_id = get_current_user_id();
			$user    = learn_press_get_user( $user_id );

			$can_review = false;

			if ( $user->has_course_status( $course_id, array( 'enrolled', 'completed', 'finished' ) ) && ! $this->user_get_comment( $course_id ) ) {
				$can_review = true;
			}

			return $can_review;
		}

		protected function user_get_comment( $course_id ) {
			static $comments;

			if ( ! isset( $comments ) ) {
				$comments = learn_press_get_user_rate( $course_id, get_current_user_id(), true );
			}

			return $comments;
		}

		public function get_item_review( $request ) {
			$course_id = $request->get_param( 'id' );
			$paged     = ! empty( $request->get_param( 'page' ) ) ? absint( $request->get_param( 'page' ) ) : 1;
			$per_page  = ! empty( $request->get_param( 'per_page' ) ) ? absint( $request->get_param( 'per_page' ) ) : LP_ADDON_COURSE_REVIEW_PER_PAGE;

			$response       = new LP_REST_Response();
			$response->data = new stdClass();

			try {
				if ( empty( $course_id ) ) {
					throw new Exception( esc_html__( 'No Course ID param.', 'learnpress-course-review' ) );
				}

				$course = learn_press_get_course( $course_id );

				if ( ! $course ) {
					throw new Exception( esc_html__( 'Course not found.', 'learnpress-course-review' ) );
				}

				$user = learn_press_get_current_user();

				$course_rate = learn_press_get_course_rate( $course_id, false );

				$course_review = learn_press_get_course_review( $course_id, $paged, $per_page, true );

				$response->data->rated   = $course_rate['rated'] ?? 0;
				$response->data->total   = absint( $course_rate['total'] ?? 0 );
				$response->data->items   = $course_rate['items'] ?? array();
				$response->data->reviews = $course_review ?? array();

				$can_review                 = $this->check_can_review( $course_id );
				$response->data->can_review = $can_review;

				if ( ! $can_review ) {
					$review = $this->user_get_comment( $course_id );

					if ( $review && ! $review->comment_approved ) {
						$response->data->comment_approved = 0;
						$response->message                = esc_html__( 'You have already reviewed this course. It will be visible after it has been approved', 'learnpress-course-review' );
					}
				}

				$response->status = 'success';
			} catch ( \Throwable $th ) {
				$response->message = $th->getMessage();
			}

			return rest_ensure_response( $response );
		}

		public function submit_review( $request ) {
			$course_id = $request->get_param( 'id' );
			$rate      = $request->get_param( 'rate' );
			$title     = $request->get_param( 'title' );
			$content   = $request->get_param( 'content' );

			$user_id  = get_current_user_id();
			$response = new LP_REST_Response();

			try {
				if ( empty( $course_id ) ) {
					throw new Exception( esc_html__( 'No Course ID param.', 'learnpress-course-review' ) );
				}

				if ( empty( $user_id ) ) {
					throw new Exception( esc_html__( 'No User.', 'learnpress-course-review' ) );
				}

				if ( ! $this->check_can_review( $course_id ) ) {
					throw new Exception( esc_html__( 'You can not submit review.', 'learnpress-course-review' ) );
				}

				$add_review = learn_press_add_course_review(
					array(
						'user_id'   => $user_id,
						'course_id' => $course_id,
						'rate'      => ! empty( $rate ) ? $rate : 0,
						'title'     => ! empty( $title ) ? $title : '',
						'content'   => ! empty( $content ) ? $content : '',
						'force'     => true, // Not use cache.
					)
				);

				if ( $add_review ) {
					$response->data->comment_id = $add_review;
					$response->message          = is_admin() ? esc_html__( 'Your review submitted successfully', 'learnpress-course-review' ) : esc_html__( 'Thank you for your review. Your review will be visible after it has been approved', 'learnpress-course-review' );
					$response->status           = 'success';

					// Clear cache
					wp_cache_delete( 'course-' . $course_id, 'lp-course-ratings' );
					$lp_course_review_cache = new LP_Course_Review_Cache( true );
					$lp_course_review_cache->clean_rating( $course_id );
				} else {
					throw new Exception( esc_html__( 'Cannot submit your review.', 'learnpress-course-review' ) );
				}
			} catch ( \Throwable $th ) {
				$response->message = $th->getMessage();
			}

			return rest_ensure_response( $response );
		}
	}
}
