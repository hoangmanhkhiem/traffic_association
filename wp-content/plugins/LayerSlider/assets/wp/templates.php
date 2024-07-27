<?php

// Prevent direct file access
defined( 'LS_ROOT_FILE' ) || exit;

class LS_CustomPageTemplates {

	private $templates;

	public function __construct() {

		$this->templates = [
			'layerslider-blank' => [
				'path'  => LS_ROOT_PATH.'/views/template-blank.php',
				'label' => 'LayerSlider Blank Template'
			]
		];

		// Add our templates to the page template dropdown
		add_filter( 'theme_page_templates', [ $this, 'add_templates' ], 10, 3 );
		add_filter( 'theme_post_templates', [ $this, 'add_templates' ], 10, 3 );

		// Add metabox to the page editor for custom settings
		add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ], 10, 0 );
		add_action( 'save_post', [ $this, 'save_meta_box' ], 10, 1 );

		// Load our templates
		add_filter( 'template_include', [ $this, 'load_templates' ], 10, 1 );
	}


	public function add_templates( $templates, $theme, $post ) {

		foreach( $this->templates as $key => $item ) {
			$templates[ $key ] = $item['label'];
		}

		return $templates;
	}


	public function load_templates( $template ) {

		global $post;

		if( ! $post ) {
			return $template;
		}

		$page_template_slug = get_page_template_slug( $post->ID );

		if( isset( $this->templates[ $page_template_slug ] ) ){
			return $this->templates[ $page_template_slug ]['path'];
		}

		return $template;
	}


	public function add_meta_box() {

		add_meta_box(
			'ls-page-meta-box',
			__( 'LayerSlider', 'LayerSlider' ),
			[ $this, 'render_meta_box' ],
			[ 'post', 'page' ],
			'side',
			'high'
		);
	}


	public function render_meta_box( $post ) {

		$keys 		= get_post_custom_keys( $post->ID );
		$keys 		= ! empty( $keys ) ? $keys : [];

		$center 	= boolval( get_post_meta( $post->ID, 'ls-center-content', true ) );
		$center 	= ! in_array( 'ls-center-content', $keys ) ? true : $center;
		$background = get_post_meta( $post->ID, 'ls-page-background', true );
		$background = ! empty( $background ) ? $background : '#ffffff';

		wp_nonce_field( 'ls-page-meta-box', 'ls-page-meta-box-nonce' );

		?>
		<div>
			<div class="ls-meta-section"><?= __('LayerSlider’s blank template offers a clean canvas free of your theme’s interface elements, making it ideal for pages featuring only LayerSlider projects, such as full-size sliders.', 'LayerSlider') ?></div>
			<div class="ls-meta-section">
				<input type="checkbox" name="ls-use-blank-template" id="ls-use-blank-template" class="ls-metabox-checkbox" <?= $post->page_template === 'layerslider-blank' ? 'checked' : '' ?>>
				<label for="ls-use-blank-template"><?= __('Use Blank Template', 'LayerSlider') ?></label>
			</div>
		</div>
		<div id="ls-page-meta-hidden">
			<div class="ls-meta-section">

				<input type="checkbox" name="ls-center-content" id="ls-center-content" class="ls-metabox-checkbox" <?= $center ? 'checked' : '' ?>>
				<label for="ls-center-content"><?= __('Center Content', 'LayerSlider') ?></label>
			</div>

			<div class="ls-meta-section">

				<input type="color" name="ls-page-background" id="ls-page-background" value="<?= esc_attr( $background ) ?>" />
				<label for="ls-page-background"><?= __( 'Page Background Color', 'LayerSlider' ) ?></label>
			</div>
		</div>
		<?php
	}


	public function save_meta_box( $post_id ) {

		if( ! isset( $_POST['ls-page-meta-box-nonce'] ) || ! wp_verify_nonce( $_POST['ls-page-meta-box-nonce'], 'ls-page-meta-box' ) ) {
			return;
		}

		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if( isset( $_POST['ls-use-blank-template'] ) ) {
			update_post_meta( $post_id, 'ls-page-background', isset( $_POST['ls-page-background'] ) ? sanitize_text_field( $_POST['ls-page-background'] ) : '' );
			update_post_meta( $post_id, 'ls-center-content', ! empty( $_POST['ls-center-content'] ) );
		}
	}
}

new LS_CustomPageTemplates();