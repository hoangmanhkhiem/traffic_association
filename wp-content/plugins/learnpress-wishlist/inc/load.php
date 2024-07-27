<?php
/**
 * Plugin load class.
 *
 * @author   ThimPress
 * @package  LearnPress/Wishlist/Classes
 * @version  4.0.1
 */

// Prevent loading this file directly
use LP_Addon_Wishlist\Elementor\WishListElementorHandler;

defined( 'ABSPATH' ) || exit;
if ( ! class_exists( 'LP_Addon_Wishlist' ) ) {
	/**
	 * Class LP_Addon_Wishlist.
	 */
	class LP_Addon_Wishlist extends LP_Addon {

		/**
		 * @var string
		 */
		protected $_tab_slug = '';

		/**
		 * @var string
		 */
		public $version = LP_ADDON_WISHLIST_VER;

		/**
		 * @var string
		 */
		public $require_version = LP_ADDON_WISHLIST_REQUIRE_VER;

		/**
		 * Path file addon
		 *
		 * @var string
		 */
		public $plugin_file = LP_ADDON_WISHLIST_FILE;

		/**
		 * LP_Addon_Wishlist constructor.
		 */
		public function __construct() {
			parent::__construct();
			add_filter( 'learn-press/profile-tabs', array( $this, 'wishlist_tab' ), 100, 1 );
			$this->_tab_slug = sanitize_title( __( 'wishlist', 'learnpress-wishlist' ) );
		}

		/**
		 * Defined constants.
		 */
		protected function _define_constants() {
			define( 'LP_ADDON_WISHLIST_PATH', dirname( LP_ADDON_WISHLIST_FILE ) );
			define( 'LP_ADDON_WISHLIST_INC', LP_ADDON_WISHLIST_PATH . '/inc/' );
			define( 'LP_ADDON_WISHLIST_TEMPLATE', LP_ADDON_WISHLIST_PATH . '/templates/' );
		}

		/**
		 * Includes files.
		 */
		protected function _includes() {
			include_once LP_ADDON_WISHLIST_INC . 'functions.php';
			if ( is_plugin_active( 'elementor/elementor.php' ) ) {
				include_once LP_ADDON_WISHLIST_INC . 'Elementor/WishListElementorHandler.php';
				WishListElementorHandler::instance();
			}

			// Rest API
			include_once LP_ADDON_WISHLIST_INC . 'rest-api/class-lp-rest-wishlist-v1-controller.php';
			include_once LP_ADDON_WISHLIST_INC . 'rest-api/class-rest-api.php';
		}

		/**
		 * Init hooks.
		 */
		protected function _init_hooks() {
			add_action( 'learn-press/after-course-buttons', array( $this, 'wishlist_button' ), 100 );
			add_filter( 'learn_press_profile_tab_endpoints', array( $this, 'profile_tab_endpoints' ) );
			LP_Request::register_ajax( 'toggle_course_wishlist', array( $this, 'toggle_course_wishlist' ) );

			//$this->rewrite_endpoint();
		}


		/**
		 * Wishlist scripts.
		 */
		protected function _enqueue_assets() {
			$ver = LP_ADDON_WISHLIST_VER;
			$min = '.min';
			if ( LP_Debug::is_debug() ) {
				$min = '';
				$ver = uniqid();
			}

			wp_register_style( 'lp-course-wishlist', LP_Addon_Wishlist_Preload::$addon->get_plugin_url( "/assets/css/wishlist{$min}.css" ), [], $ver );
			wp_register_script(
				'lp-course-wishlist',
				LP_Addon_Wishlist_Preload::$addon->get_plugin_url( "/assets/js/wishlist{$min}.js" ),
				[ 'jquery' ],
				$ver,
				[ 'strategy'  => 'defer' ]
			);

			wp_enqueue_style( 'lp-course-wishlist' );
			wp_enqueue_script( 'lp-course-wishlist' );
		}

		/**
		 * Rewrite endpoint.
		 */
		public function rewrite_endpoint() {
			$endpoint                                       = preg_replace( '!_!', '-', $this->get_tab_slug() );
			LearnPress::instance()->query_vars[ $endpoint ] = $endpoint;
			add_rewrite_endpoint( $endpoint, EP_ROOT | EP_PAGES );
		}

		public function profile_tab_endpoints( $endpoints ) {
			$endpoints[] = $this->get_tab_slug();

			return $endpoints;
		}

		public function toggle_course_wishlist() {
			sleep( 1 );
			$nonce = ! empty( $_POST['nonce'] ) ? $_POST['nonce'] : null;
			if ( ! wp_verify_nonce( $nonce, 'course-toggle-wishlist' ) ) {
				die( __( 'You have not permission to do this action', 'learnpress-wishlist' ) );
			}

			$course_id = ! empty( $_POST['course_id'] ) ? absint( $_POST['course_id'] ) : 0;
			$user_id   = get_current_user_id();

			if ( ( get_post_type( $course_id ) != 'lp_course' ) || ! $user_id ) {
				return;
			}
			$state    = ! empty( $_POST['state'] ) ? $_POST['state'] : false;
			$wishlist = (array) get_user_meta( $user_id, '_lpr_wish_list', true );
			if ( $state === false ) {
				$state = in_array( $course_id, $wishlist ) ? 'off' : 'on';
			}
			$pos = array_search( $course_id, $wishlist );
			if ( $state == 'on' ) {
				if ( $pos === false ) {
					$wishlist[] = $course_id;
				}
			} else {
				if ( $pos !== false ) {
					unset( $wishlist[ $pos ] );
				}
			}
			if ( sizeof( $wishlist ) ) {
				update_user_meta( $user_id, '_lpr_wish_list', $wishlist );
			} else {
				delete_user_meta( $user_id, '_lpr_wish_list' );
			}
			learn_press_send_json(
				array(
					'state'       => $state,
					'course_id'   => $course_id,
					'user_id'     => $user_id,
					'title'       => $this->_get_state_title( $state ),
					'message'     => '',
					'button_text' => $state != 'on' ? __(
						'Add to Wishlist',
						'learnpress-wishlist'
					) : __( 'Remove from Wishlist', 'learnpress-wishlist' ),
				)
			);
		}

		/**
		 * @param string $state
		 *
		 * @return mixed
		 */
		private function _get_state_title( $state = 'on' ) {
			return $state == 'on' ? __(
				'Remove this course from your wishlist',
				'learnpress-wishlist'
			) : __( 'Add this course to your wishlist', 'learnpress-wishlist' );
		}

		/**
		 * @param string $state
		 *
		 * @return mixed
		 */
		private function _get_state_message( $state = 'on' ) {
			return $state == 'on' ? __(
				'This course added to your wishlist',
				'learnpress-wishlist'
			) : __( 'This course removed from your wishlist', 'learnpress-wishlist' );
		}

		/**
		 * Show wishlist button.
		 *
		 * @param $course_id
		 *
		 * @return void
		 */
		public function wishlist_button( $course_id = 0 ) {
			$user_id = get_current_user_id();
			if ( ! $course_id ) {
				$course_id = get_the_ID();
			}

			//	 If user or course are invalid then return.
			if ( ! $user_id || ! $course_id ) {
				return;
			}

			$classes = array( 'course-wishlist' );
			$state   = learn_press_user_wishlist_has_course( $course_id, $user_id ) ? 'on' : 'off';

			if ( $state == 'on' ) {
				$classes[] = 'on';
			}
			$classes = apply_filters( 'learn_press_course_wishlist_button_classes', $classes, $course_id );
			$title   = $this->_get_state_title( $state );

			// fetch template
			LP_Addon_Wishlist_Preload::$addon->get_template(
				'button.php',
				compact( 'user_id', 'course_id', 'classes', 'title', 'state' )
			);
		}

		public function get_tab_slug() {
			return apply_filters( 'learn_press_course_wishlist_tab_slug', $this->_tab_slug, $this );
		}

		/**
		 * Add Wishlist tab to user profile.
		 *
		 * @param $tabs
		 *
		 * @return mixed
		 */
		public function wishlist_tab( $tabs ) {
			$tabs['wishlist'] = array(
				'title'    => __( 'Wishlist', 'learnpress-wishlist' ),
				'slug'     => $this->get_tab_slug(),
				'callback' => array( $this, 'wishlist_tab_content' ),
				'priority' => 20,
				'icon'     => '<i class="fas fa-heart"></i>',
			);

			return $tabs;
		}

		/**
		 * Display content of tab Wishlist.
		 *
		 * @since 4.0.0
		 * @version 1.0.1
		 */
		public function wishlist_tab_content() {
			$profile      = LP_Profile::instance();
			$viewing_user = $profile->get_user();
			LP_Addon_Wishlist_Preload::$addon->get_template(
				'user-wishlist.php',
				array(
					'wishlist' => $this->get_wishlist_courses( $viewing_user->get_id() ),
				)
			);
		}

		public function get_wishlist_courses( $user_id ) {
			$pid = (array) get_user_meta( $user_id, '_lpr_wish_list', true );

			$args     = array(
				'post_type'           => 'lp_course',
				'post__in'            => $pid,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
				'posts_per_page'      => - 1,
			);
			$query    = new WP_Query( $args );
			$wishlist = array();
			global $post;
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();
					$wishlist[ $post->ID ] = $post;
				endwhile;
			endif;
			wp_reset_postdata();

			return $wishlist;
		}
	}
}
