<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.4.0
 * 
 * Content Composer Gutenberg
 * Created by CMSMasters
 * 
 */

class Cmsmasters_Gutenberg {
	protected $is_gutenberg_editor_active = false;

	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_cmsmasters_rest_field' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_assets' ) );
		add_action( 'admin_footer', array( $this, 'print_admin_js_template' ) );

		add_filter( 'use_block_editor_for_post', array( $this, 'block_editor_disable' ) );
		add_filter( 'use_block_editor_for_post_type', array( $this, 'block_editor_disable' ) );
		
		add_action('register_post_type_args', array($this, 'cmsmasters_gutenberg_post_type_filter'), 10, 2);
	}
	
	
	public function cmsmasters_gutenberg_post_type_filter($args, $post_type) {
		if (
			isset($args['public']) &&
			$args['public'] == true && 
			(
				!isset($args['show_in_rest']) || 
				(isset($args['show_in_rest']) && $args['show_in_rest'] == false)
			)
		) {
			$args['show_in_rest'] = true;
		}
		
		
		return $args;
	}
	

	public function register_cmsmasters_rest_field() {
		$rest_field_args = array(
			'update_callback' => function( $request_value, $object ) {
				if ( ! $this->is_current_user_can_edit( $object->ID ) ) {
					return false;
				}

				$this->set_is_composer_page( $object->ID, false );

				return true;
			}
		);
		
		register_rest_field( get_post_types( '', 'names' ), 'gutenberg_cmsmasters_composer_mode', $rest_field_args );
	}

	public function enqueue_assets() {
		$post_id = get_the_ID();

		if ( ! $this->is_current_user_can_edit( $post_id ) ) {
			return;
		}

		$this->is_gutenberg_editor_active = true;

		wp_enqueue_style( 'cmsmasters_composer_gutenberg_css', CMSMASTERS_CONTENT_COMPOSER_URL . 'gutenberg/css/gutenberg.css', array(), CMSMASTERS_CONTENT_COMPOSER_VERSION, 'screen' );

		wp_enqueue_script( 'cmsmasters_composer_gutenberg_js', CMSMASTERS_CONTENT_COMPOSER_URL . 'gutenberg/js/gutenberg.js', array( 'jquery' ), CMSMASTERS_CONTENT_COMPOSER_VERSION, true );

		wp_localize_script( 'cmsmasters_composer_gutenberg_js', 'cmsmasters_gutenberg', array(
			'temp_title' => 		__( 'Temporary title', 'cmsmasters-content-composer' ),
			'is_composer_mode' => 	$this->is_built_with_composer( $post_id ),
			'edit_link' => 			$this->get_edit_url( $post_id )
		) );
	}

	public function print_admin_js_template() {
		if ( ! $this->is_gutenberg_editor_active ) {
			return;
		}

		?>
		<script id="composer-gutenberg-button-switch-mode" type="text/html">
			<div id="composer-switch-mode">
				<button id="composer-switch-mode-button" type="button" class="button button-primary button-large admin-icon-composer">
					<span class="composer-switch-mode-on"><?php _e( '&#8592; Back to Block Editor', 'cmsmasters-content-composer' ); ?></span>
					<span class="composer-switch-mode-off">
						<?php _e( 'Content Composer', 'cmsmasters-content-composer' ); ?>
					</span>
				</button>
			</div>
		</script>

		<script id="composer-gutenberg-panel" type="text/html">
			<div id="composer-editor">
				<a id="composer-go-to-edit-page-link" href="#">
					<div id="composer-editor-button" class="button button-primary button-hero admin-icon-composer">
						<?php _e( 'Content Composer', 'cmsmasters-content-composer' ); ?>
					</div>
					<div class="composer-loader-wrapper">
						<div class="composer-loader admin-icon-composer"></div>
						<div class="composer-loading-title"><?php _e( 'Loading...', 'cmsmasters-content-composer' ); ?></div>
					</div>
				</a>
			</div>
		</script>
		<?php
	}

	public function block_editor_disable() {
		$is_composer = $this->is_built_with_composer( get_the_ID() );

		return $is_composer == 'false' || $is_composer == '';
	}

	public function is_current_user_can_edit( $post_id = 0 ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		if ( 'trash' === get_post_status( $post_id ) ) {
			return false;
		}

		$post_type_object = get_post_type_object( get_post_type( $post_id ) );
		if ( empty( $post_type_object ) ) {
			return false;
		}

		if ( ! isset( $post_type_object->cap->edit_post ) ) {
			return false;
		}

		$edit_cap = $post_type_object->cap->edit_post;
		if ( ! current_user_can( $edit_cap, $post_id ) ) {
			return false;
		}

		if ( get_option( 'page_for_posts' ) === $post_id ) {
			return false;
		}

		return true;
	}

	public function set_is_composer_page( $post_id, $is_composer = true ) {
		if ( $is_composer ) {
			update_post_meta( $post_id, 'cmsmasters_gutenberg_show', 'true' );
			update_post_meta( $post_id, 'cmsmasters_composer_show', 'true' );
		} else {
			delete_post_meta( $post_id, 'cmsmasters_gutenberg_show' );
		}
	}

	public function is_built_with_composer( $post_id ) {
		return get_post_meta( $post_id, 'cmsmasters_gutenberg_show', true );
	}

	public function get_edit_url( $post_id ) {
		$url = add_query_arg(
			array(
				'post' => 				$this->get_main_id( $post_id ),
				'action' => 			'edit'
			),
			admin_url( 'post.php' )
		);

		return $url;
	}
	
	public function get_main_id( $post_id ) {
		$parent_post_id = wp_is_post_revision( $post_id );

		if ( $parent_post_id ) {
			$post_id = $parent_post_id;
		}

		return $post_id;
	}
}

new Cmsmasters_Gutenberg();
