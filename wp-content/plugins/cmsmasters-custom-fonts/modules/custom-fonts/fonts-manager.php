<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Custom Fonts
 * @version		1.0.1
 * 
 * Custom Fonts Manager
 * Created by CMSMasters
 * 
 */


namespace CmsmastersCustomFonts\Modules\Custom_Fonts;


class Fonts_Manager {
	const CPT = 'cmsmasters_font';
	
	const FONT_META_KEY = 'cmsmasters_font_files';
	
	const FONT_FACE_META_KEY = 'cmsmasters_font_face';
	
	
	public function __construct() {
		$this->actions();
		
		new Custom_Fonts();
	}
	
	/**
	 * Register action and filter hooks
	 */
	protected function actions() {
		add_action( 'init', array( $this, 'register_font_post_type' ) );
		
		add_filter( 'post_updated_messages', array( $this, 'font_updated_messages' ) );
		
		add_filter( 'enter_title_here', array( $this, 'change_enter_title_here' ), 10, 2 );
		
		add_action( 'edit_form_after_title', array( $this, 'edit_form_after_title' ) );
		
		add_filter( 'post_row_actions', array( $this, 'change_post_row_actions' ), 10, 2 );
		
		add_filter( 'manage_' . self::CPT . '_posts_columns', array( $this, 'change_posts_columns' ), 100 );
		
		if (is_admin()) {
			add_action( 'admin_menu', array( $this, 'add_font_menu_page' ), 50 );
			
			add_action( 'admin_head', array( $this, 'change_fonts_listing_page' ) );
		}
		
		
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}
	
	/**
	 * Enqueue admin styles
	 */
	public function enqueue_admin_styles() {
		wp_enqueue_style( 'cmsmasters-custom-fonts-admin', CMSMASTERS_CUSTOM_FONTS_URL . 'modules/custom-fonts/css/admin.css', array(), CMSMASTERS_CUSTOM_FONTS_VERSION );
	}
	
	/**
	 * Enqueue admin scripts
	 */
	public function enqueue_admin_scripts() {
		wp_enqueue_script( 'cmsmasters-custom-fonts-admin', CMSMASTERS_CUSTOM_FONTS_URL . 'modules/custom-fonts/js/admin.js', array(), CMSMASTERS_CUSTOM_FONTS_VERSION, true );
	}
	
	/**
	 * Register cmsmasters_font post type
	 */
	public function register_font_post_type() {
		$args = array(
			'labels' => array(
				'name' 					=> esc_html__( 'Custom Fonts', 'cmsmasters-custom-fonts' ),
				'singular_name' 		=> esc_html__( 'Font', 'cmsmasters-custom-fonts' ),
				'add_new' 				=> esc_html__( 'Add New', 'cmsmasters-custom-fonts' ),
				'add_new_item' 			=> esc_html__( 'Add New Font', 'cmsmasters-custom-fonts' ),
				'edit_item' 			=> esc_html__( 'Edit Font', 'cmsmasters-custom-fonts' ),
				'new_item' 				=> esc_html__( 'New Font', 'cmsmasters-custom-fonts' ),
				'all_items' 			=> esc_html__( 'All Fonts', 'cmsmasters-custom-fonts' ),
				'view_item' 			=> esc_html__( 'View Font', 'cmsmasters-custom-fonts' ),
				'search_items' 			=> esc_html__( 'Search Font', 'cmsmasters-custom-fonts' ),
				'not_found' 			=> esc_html__( 'No Fonts found', 'cmsmasters-custom-fonts' ),
				'not_found_in_trash' 	=> esc_html__( 'No Font found in Trash', 'cmsmasters-custom-fonts' ),
				'parent_item_colon' 	=> '',
				'menu_name' 			=> esc_html__( 'Custom Fonts', 'cmsmasters-custom-fonts' ),
			),
			'public' 				=> false,
			'rewrite' 				=> false,
			'show_ui' 				=> true,
			'show_in_menu' 			=> false,
			'show_in_nav_menus' 	=> false,
			'exclude_from_search' 	=> true,
			'capability_type' 		=> 'post',
			'hierarchical' 			=> false,
			'supports' 				=> array('title'),
		);
		
		
		register_post_type( self::CPT, $args );
	}
	
	/**
	 * Update messages for post
	 *
	 * @param array $messages
	 *
	 * @return array
	 */
	public function font_updated_messages( $messages ) {
		$messages[self::CPT] = array(
			0 	=> '',
			1 	=> esc_html__( 'Font updated.', 'cmsmasters-custom-fonts' ),
			2 	=> esc_html__( 'Custom field updated.', 'cmsmasters-custom-fonts' ),
			3 	=> esc_html__( 'Custom field deleted.', 'cmsmasters-custom-fonts' ),
			4 	=> esc_html__( 'Font updated.', 'cmsmasters-custom-fonts' ),
			5 	=> isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Font restored to revision from %s', 'cmsmasters-custom-fonts' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 	=> esc_html__('Font saved.', 'cmsmasters-custom-fonts' ),
			7 	=> esc_html__('Font saved.', 'cmsmasters-custom-fonts' ),
			8 	=> esc_html__('Font submitted.', 'cmsmasters-custom-fonts' ),
			9 	=> esc_html__('Font updated.', 'cmsmasters-custom-fonts' ),
			10 	=> esc_html__('Font draft updated.', 'cmsmasters-custom-fonts' ),
		);
		
		
		return $messages;
	}
	
	/**
	 * Add menu page
	 */
	public function add_font_menu_page() {
		$menu_title = esc_html__( 'Custom Fonts', 'cmsmasters-custom-fonts' );
		
		
		add_submenu_page(
			'cmsmasters-settings',
			$menu_title,
			$menu_title,
			'manage_options',
			'edit.php?post_type=' . self::CPT
		);
	}
	
	/**
	 * Change "Enter Title" field for font post type
	 *
	 * @param $title, $post
	 *
	 * @return string
	 */
	public function change_enter_title_here( $title, $post ) {
		if ( isset( $post->post_type ) && self::CPT === $post->post_type ) {
			return esc_html__( 'Enter Font Family', 'cmsmasters-custom-fonts' );
		}
		
		return $title;
	}
	
	/**
	 * Information for add self-hosted Google Font
	 *
	 * @param $post
	 *
	 * @show information
	 */
	public function edit_form_after_title( $post ) {
		if ( $post->post_type === 'cmsmasters_font' ) {
			echo '<div class="cmsmasters_custom_fonts_info">' . 
				sprintf( wp_kses( __( '<p>To add self-hosted Google Font access the <a href="%1$s" target="_blank">Google WebFonts Helper</a>, select a font and required charsets and styles: <a href="%2$s" target="_blank">screenshot</a>.<br />Download the font and unzip the archive.<br />Enter Font Family and click on the Add Font Variation button: <a href="%3$s" target="_blank">screenshot</a>.<br />Choose needed Weight and Style: <a href="%4$s" target="_blank">screenshot</a> and upload font files from the downloaded archive to the appropriate fields.</p>', 'cmsmasters-custom-fonts' ), array( 'a' => array( 'href' => array(), 'target' => array() ), 'br' => array(), 'p' => array(), 'h4' => array())), esc_url( 'https://google-webfonts-helper.herokuapp.com/fonts' ), esc_url( 'https://www.screencast.com/t/1hqC4tMEY' ), esc_url( 'https://www.screencast.com/t/BjmiaJg89' ), esc_url( 'https://www.screencast.com/t/N1Ge3MtzsitC' ) ) . 
			'</div>';
		}
	}
	
	/**
	 * Change post row actions
	 *
	 * @param $actions, $post
	 *
	 * @return array
	 */
	public function change_post_row_actions( $actions, $post ) {
		if ( self::CPT !== $post->post_type ) {
			return $actions;
		}
		
		unset( $actions['inline hide-if-no-js'] );
		
		return $actions;
	}
	
	/**
	 * Change columns for listing page
	 *
	 * @param $columns
	 *
	 * @return array
	 */
	public function change_posts_columns( $columns ) {
		return array(
			'cb' 			=> '<input type="checkbox" />',
			'title' 		=> esc_html__( 'Font Family', 'cmsmasters-custom-fonts' ),
			'font_preview' 	=> esc_html__( 'Preview', 'cmsmasters-custom-fonts' ),
			'font_vars' 	=> esc_html__( 'Variations', 'cmsmasters-custom-fonts' ),
		);
	}
	
	/**
	 * Run actions and filters for change font post type listing page
	 */
	public function change_fonts_listing_page() {
		global $typenow;
		
		
		if ( self::CPT !== $typenow ) {
			return;
		}
		
		
		add_filter( 'months_dropdown_results', '__return_empty_array' );
		add_action( 'manage_' . self::CPT . '_posts_custom_column', array( $this, 'change_fonts_listing_columns' ), 10, 2 );
		add_filter( 'screen_options_show_screen', '__return_false' );
	}
	
	/**
	 * Change listing page columns for font post type
	 *
	 * @param $columns, $post_id
	 */
	public function change_fonts_listing_columns( $column, $post_id ) {
		if ( 'font_preview' === $column ) {
			$font_face = get_post_meta( $post_id, self::FONT_FACE_META_KEY, true );
			
			
			if ( !$font_face ) {
				return;
			}
			
			
			printf( '<style>%s</style><span style="font-family: \'%s\';">%s</span>', $font_face, get_the_title( $post_id ), esc_html__( 'The quick brown fox jumps over the lazy dog.', 'cmsmasters-custom-fonts' ) );
		}
		
		
		if ( 'font_vars' === $column ) {
			$font_listing_vars = get_post_meta( $post_id, self::FONT_META_KEY, true );
			
			$font_listing_vars = is_array($font_listing_vars) ? $font_listing_vars : array();
			
			
			foreach ($font_listing_vars as $var) {
				echo '<span class="cmsmasters_font_listing_var">';
				
				
				if ($var['font_weight'] == 'normal' && $var['font_style'] == 'normal') {
					echo 'regular';
				} else {
					echo ($var['font_weight'] != 'normal' ? $var['font_weight'] : '') . ($var['font_style'] != 'normal' ? ' ' . $var['font_style'] : '');
				}
				
				
				echo '</span>';
			}
		}
	}
}

