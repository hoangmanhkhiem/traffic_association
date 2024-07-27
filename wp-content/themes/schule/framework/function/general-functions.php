<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.9
 * 
 * General Functions
 * Created by CMSMasters
 * 
 */


/* Register CSS Styles */
function schule_register_css_styles() {
	if (!is_admin()) {
		global $post, 
			$wp_styles;
		
		
		$cmsmasters_option = schule_get_global_options();
		
		
		wp_enqueue_style('schule-theme-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'screen, print');
		
		wp_enqueue_style('schule-style', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/style.css', array(), '1.0.0', 'screen, print');
		
		wp_enqueue_style('schule-adaptive', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/adaptive.css', array(), '1.0.0', 'screen, print');
		
		wp_enqueue_style('schule-retina', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/retina.css', array(), '1.0.0', 'screen');
		
		
		if (is_rtl()) {
			wp_enqueue_style('schule-rtl', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/rtl.css', array(), '1.0.0', 'screen');
		}
		
		
		wp_enqueue_style('schule-icons', get_template_directory_uri() . '/css/fontello.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_style('schule-icons-custom', get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/css/fontello-custom.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0.0', 'screen');
		
		
		// iLightBox skins
		$ilightbox_skin = $cmsmasters_option['schule' . '_ilightbox_skin'];
		
		wp_enqueue_style('ilightbox', get_template_directory_uri() . '/css/ilightbox.css', array(), '2.2.0', 'screen');
		
		wp_enqueue_style('ilightbox-skin-' . $ilightbox_skin, get_template_directory_uri() . '/css/ilightbox-skins/' . $ilightbox_skin . '-skin.css', array(), '2.2.0', 'screen');
		
		
		// Fonts and Colors styles
		$upload_dir = wp_upload_dir();
		
		$style_dir = str_replace('\\', '/', $upload_dir['basedir'] . '/cmsmasters_styles');
		
		
		$cmsmasters_styles_dir = get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/css/styles/';
		
		
		if (is_dir($style_dir) && get_option('cmsmasters_style_exists_' . 'schule')) {
			$cmsmasters_styles_dir = $upload_dir['baseurl'] . '/cmsmasters_styles/';
		}
		
		
		wp_enqueue_style('schule-fonts-schemes', $cmsmasters_styles_dir . 'schule' . '.css', array(), '1.0.0', 'screen');
	}
}

add_action('wp_enqueue_scripts', 'schule_register_css_styles');



/* Register JS Scripts */
function schule_register_js_scripts() {
	global $post;
	
	
	$cmsmasters_option = schule_get_global_options();
	
	
	$cmsmasters_localize_array = array( 
		'theme_url' => 							get_template_directory_uri(), 
		'site_url' => 							get_site_url() . '/', 
		'ajaxurl' => 							admin_url('admin-ajax.php'), 
		'nonce_ajax_like' => 					wp_create_nonce('cmsmasters_ajax_like-nonce'), 
		'nonce_ajax_view' => 					wp_create_nonce('cmsmasters_ajax_view-nonce'), 
		'project_puzzle_proportion' => 			schule_project_puzzle_proportion(), 
		'gmap_api_key' => 						$cmsmasters_option['schule' . '_gmap_api_key'], 
		'gmap_api_key_notice' => 				esc_html__('Please add your Google Maps API key', 'schule'), 
		'gmap_api_key_notice_link' => 			esc_html__('read more how', 'schule'), 
		'primary_color' => 						$cmsmasters_option['schule' . '_default_link'], 
		'ilightbox_skin' => 					$cmsmasters_option['schule' . '_ilightbox_skin'], 
		'ilightbox_path' => 					$cmsmasters_option['schule' . '_ilightbox_path'], 
		'ilightbox_infinite' => 				$cmsmasters_option['schule' . '_ilightbox_infinite'], 
		'ilightbox_aspect_ratio' => 			$cmsmasters_option['schule' . '_ilightbox_aspect_ratio'], 
		'ilightbox_mobile_optimizer' => 		$cmsmasters_option['schule' . '_ilightbox_mobile_optimizer'], 
		'ilightbox_max_scale' => 				$cmsmasters_option['schule' . '_ilightbox_max_scale'], 
		'ilightbox_min_scale' => 				$cmsmasters_option['schule' . '_ilightbox_min_scale'], 
		'ilightbox_inner_toolbar' => 			$cmsmasters_option['schule' . '_ilightbox_inner_toolbar'], 
		'ilightbox_smart_recognition' => 		$cmsmasters_option['schule' . '_ilightbox_smart_recognition'], 
		'ilightbox_fullscreen_one_slide' => 	$cmsmasters_option['schule' . '_ilightbox_fullscreen_one_slide'], 
		'ilightbox_fullscreen_viewport' => 		$cmsmasters_option['schule' . '_ilightbox_fullscreen_viewport'], 
		'ilightbox_controls_toolbar' => 		$cmsmasters_option['schule' . '_ilightbox_controls_toolbar'], 
		'ilightbox_controls_arrows' => 			$cmsmasters_option['schule' . '_ilightbox_controls_arrows'], 
		'ilightbox_controls_fullscreen' => 		$cmsmasters_option['schule' . '_ilightbox_controls_fullscreen'], 
		'ilightbox_controls_thumbnail' => 		$cmsmasters_option['schule' . '_ilightbox_controls_thumbnail'], 
		'ilightbox_controls_keyboard' => 		$cmsmasters_option['schule' . '_ilightbox_controls_keyboard'], 
		'ilightbox_controls_mousewheel' => 		$cmsmasters_option['schule' . '_ilightbox_controls_mousewheel'], 
		'ilightbox_controls_swipe' => 			$cmsmasters_option['schule' . '_ilightbox_controls_swipe'], 
		'ilightbox_controls_slideshow' => 		$cmsmasters_option['schule' . '_ilightbox_controls_slideshow'], 
		'ilightbox_close_text' => 				esc_html__('Close', 'schule'), 
		'ilightbox_enter_fullscreen_text' => 	esc_html__('Enter Fullscreen (Shift+Enter)', 'schule'), 
		'ilightbox_exit_fullscreen_text' => 	esc_html__('Exit Fullscreen (Shift+Enter)', 'schule'), 
		'ilightbox_slideshow_text' => 			esc_html__('Slideshow', 'schule'), 
		'ilightbox_next_text' => 				esc_html__('Next', 'schule'), 
		'ilightbox_previous_text' => 			esc_html__('Previous', 'schule'), 
		'ilightbox_load_image_error' => 		esc_html__('An error occurred when trying to load photo.', 'schule'), 
		'ilightbox_load_contents_error' => 		esc_html__('An error occurred when trying to load contents.', 'schule'), 
		'ilightbox_missing_plugin_error' => 	esc_html__("The content your are attempting to view requires the <a href='{pluginspage}' target='_blank'>{type} plugin<\/a>.", 'schule') 
	);
	
	
	wp_enqueue_script('cmsmasters-hover-slider', get_template_directory_uri() . '/js/cmsmasters-hover-slider.min.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('debounced-resize', get_template_directory_uri() . '/js/debounced-resize.min.js', array('jquery'), '1.0.0', false);
	
	wp_enqueue_script('easing', get_template_directory_uri() . '/js/easing.min.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('easy-pie-chart', get_template_directory_uri() . '/js/easy-pie-chart.min.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array('jquery'), '1.0.0', false);
	
	wp_enqueue_script('mousewheel', get_template_directory_uri() . '/js/mousewheel.min.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/js/owlcarousel.min.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('imagesloaded');
	
	wp_enqueue_script('request-animation-frame', get_template_directory_uri() . '/js/request-animation-frame.min.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('respond', get_template_directory_uri() . '/js/respond.min.js', array('jquery'), '1.0.0', false);
	
	wp_enqueue_script('scrollspy', get_template_directory_uri() . '/js/scrollspy.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('scroll-to', get_template_directory_uri() . '/js/scroll-to.min.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('stellar', get_template_directory_uri() . '/js/stellar.min.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('iLightBox', get_template_directory_uri() . '/js/jquery.iLightBox.min.js', array('jquery'), '2.2.0', false);
	
	wp_enqueue_script('schule-script', get_template_directory_uri() . '/js/jquery.script.js', array('jquery'), '1.0.0', true);
	
	wp_localize_script('schule-script', 'cmsmasters_script', $cmsmasters_localize_array);
	
	wp_enqueue_script('schule-theme-script', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/js/jquery.theme-script.js', array('jquery', 'schule-script'), '1.0.0', true);
	
	wp_enqueue_script('twitter', get_template_directory_uri() . '/js/jquery.tweet.min.js', array('jquery'), '1.3.1', true);

	wp_enqueue_script('smooth-sticky', get_template_directory_uri() . '/js/smooth-sticky.min.js', array('jquery'), '1.0.2', true);
	
	
	wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '1.5.19', true);
	
	wp_register_script('isotopeMode', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/js/jquery.isotope.mode.js', array('jquery', 'isotope'), '1.0.0', true);
	
	wp_localize_script('isotopeMode', 'cmsmasters_isotope_mode', $cmsmasters_localize_array);
	
	
	if ( 
		is_a($post, 'WP_Post') && 
		strpos($post->post_content, '[cmsmasters_portfolio ') 
	) {
		wp_enqueue_script('isotope');
		
		wp_enqueue_script('isotopeMode');
	}
	
	
	if ( 
		is_a($post, 'WP_Post') && 
		strpos($post->post_content, '[/cmsmasters_google_map_markers]') && 
		isset($cmsmasters_option['schule' . '_gmap_api_key']) && 
		$cmsmasters_option['schule' . '_gmap_api_key'] != '' 
	) {
		wp_enqueue_script('gMapAPI', '//maps.googleapis.com/maps/api/js?key=' . $cmsmasters_option['schule' . '_gmap_api_key'], array('jquery'), '1.0.0', true);
		
		wp_enqueue_script('gMap', get_template_directory_uri() . '/js/jquery.gMap.min.js', array('jquery', 'gMapAPI'), '3.2.0', true);
	}
	
	
	// Comment Reply enqueue
	if (is_singular() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	
	
	// Add Custom JavaScript
	$cmsmasters_custom_js = stripslashes($cmsmasters_option['schule' . '_custom_js']);
	
	wp_add_inline_script('schule-script', $cmsmasters_custom_js);
	
	
	if (CMSMASTERS_DEVELOPER_MODE) {
		schule_regenerate_styles();
	}
}

add_action('wp_enqueue_scripts', 'schule_register_js_scripts');



/* Fonts Generate Function */
if (!function_exists('schule_theme_fonts_generate')) {

function schule_theme_fonts_generate() {
	$cmsmasters_option = schule_get_global_options();
	
	global $cmsmasters_font_keys;
	
	$cmsmasters_font_keys = array();
	
	$fonts = array();
	
	$font_fields = array(
		'content',
		'link',
		'nav_title',
		'nav_dropdown',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'button',
		'small',
		'input',
		'quote'
	);
	
	$fonts_list = cmsmasters_fonts_list();
	
	
	foreach ($font_fields as $font_field) {
		$font_option = 'schule' . '_' . $font_field . '_font_google_font';
		
		
		if (
			isset($cmsmasters_option[$font_option]) && 
			$cmsmasters_option[$font_option] != ''
		) {
			if (
				array_key_exists($cmsmasters_option[$font_option], $fonts_list['web']) || 
				array_key_exists($cmsmasters_option[$font_option], $fonts_list['local'])
			) {
				$fonts[] = $cmsmasters_option[$font_option];
			}
		}
	}
	
	
	$local_fonts = get_post_meta(get_the_ID(), 'cmsmasters_shortcodes_local_fonts', true);
	
	if ($local_fonts != '') {
		$local_fonts = explode('|', substr($local_fonts, 0, -1));
		
		$fonts = array_merge($fonts, $local_fonts);
	}
	
	
	if (!empty($fonts)) {
		$fonts = array_unique($fonts);
		
		
		foreach ($fonts as $font) {
			$cmsmasters_font_keys[] = $font;
		}
		
		
		cmsmasters_theme_font($fonts);
	}
}

}

add_action('wp_enqueue_scripts', 'schule_theme_fonts_generate');
add_action('enqueue_block_editor_assets', 'schule_theme_fonts_generate');



/* Fonts Enqueue Function */
if (!function_exists('cmsmasters_theme_font')) {

function cmsmasters_theme_font($fonts, $font_name = '') {
	global $cmsmasters_font_keys;
	
	
	if (!isset($cmsmasters_font_keys)) {
		return;
	}
	
	
	if ( 
		$font_name == '' || 
		($font_name != '' && is_array($cmsmasters_font_keys) && !in_array($font_name, $cmsmasters_font_keys)) 
	) {
		$local_fonts = '';
		
		$web_fonts = '';
		
		
		if (is_array($fonts)) {
			foreach($fonts as $font) {
				$check_font = explode(':', $font);
				
				
				if (is_numeric($check_font[0])) {
					$local_fonts .= get_post_meta($check_font[0], 'cmsmasters_font_face', true);
				} else {
					$web_fonts .= $font . '|';
				}
			}
		} else {
			$check_font = explode(':', $fonts);
			
			
			if (is_numeric($check_font[0])) {
				$local_fonts .= get_post_meta($check_font[0], 'cmsmasters_font_face', true);
			} else {
				$web_fonts .= $fonts . '|';
			}
		}
		
		
		if ($local_fonts != '' && $font_name == '') {
			wp_register_style( 'theme_fonts_generate', false );
		
			wp_enqueue_style( 'theme_fonts_generate' );

			wp_add_inline_style('theme_fonts_generate', $local_fonts);
		}
		
		
		if ($web_fonts != '') {
			$web_fonts = str_replace('+', ' ', substr($web_fonts, 0, -1));
			
			
			if ($font_name != '') {
				$font_name = explode(':', $font_name);
				
				$web_font_id = '-' . str_replace('+', '-', strtolower($font_name[0]));
			} else {
				$web_font_id = '';
			}
			
			
			$web_font_url = add_query_arg('family', urlencode($web_fonts), '//fonts.googleapis.com/css');
			
			
			$cmsmasters_option = schule_get_global_options();
			
			
			if (
				isset($cmsmasters_option['schule' . '_google_web_fonts_subset']) && 
				is_array($cmsmasters_option['schule' . '_google_web_fonts_subset'])
			) {
				$web_fonts_subset_array = $cmsmasters_option['schule' . '_google_web_fonts_subset'];
			} else {
				$web_fonts_subset_array = array();
			}
			
			
			$web_fonts_subset = '';
			
			foreach ($web_fonts_subset_array as $subset) {
				$web_fonts_subset .= $subset . ',';
			}
			
			
			if ($web_fonts_subset != '') {
				$web_font_url = $web_font_url . '&amp;subset=' . substr($web_fonts_subset, 0, -1);
			}
			
			
			wp_enqueue_style("google-fonts{$web_font_id}", $web_font_url);
		}
	}
}

}



/* Font Family Substing Generate Function */
function schule_get_google_font($font) {
	if ($font != '') {
		if (strpos($font, ':')) {
			$font_array = explode(':', $font);
			
			
			if (is_numeric($font_array[0])) {
				$font_out = "'" . str_replace('+', ' ', $font_array[1]) . "', ";
			} else {
				$font_out = "'" . str_replace('+', ' ', $font_array[0]) . "', ";
			}
		} elseif (strpos($font, '&')) {
			$font_array = explode('&', $font);
			
			
			$font_out = "'" . str_replace('+', ' ', $font_array[0]) . "', ";
		} else {
			$font_out = "'" . str_replace('+', ' ', $font) . "', ";
		}
	} else {
		$font_out = '';
	}
	
	
	return $font_out;
}



/* Register Default Theme Sidebars */
function schule_the_widgets_init() {
    if (!function_exists('register_sidebars')) {
        return;
    }
    
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'schule'), 
            'id' => 'sidebar_default', 
            'description' => esc_html__('Widgets in this area will be shown in all left and right sidebars till you don\'t use custom sidebar. To display the sidebar please choose the Right or Left Layout Type in the Theme Settings - General - Content options.', 'schule'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
        )
    );
    
    register_sidebar(
        array(
            'name' => esc_html__('Bottom Sidebar', 'schule'), 
            'id' => 'sidebar_bottom', 
            'description' => esc_html__('Widgets in this area will be shown at the bottom of middle block below the content and middle sidebar, but above footer. To display Bottom Sidebar please enable it in the Theme Settings - General - Content - Bottom Sidebar Visibility by Default. You can also display it on concrete page in the Page Layout options.', 'schule'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
        )
    );
    
    register_sidebar(
        array(
            'name' => esc_html__('Archive Sidebar', 'schule'), 
            'id' => 'sidebar_archive', 
            'description' => esc_html__('Widgets in this area will be shown in all left and right sidebars on archives pages. To display the sidebar please choose the Right or Left Layout Type in the Theme Settings - General - Content options.', 'schule'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
        )
    );
    
    register_sidebar(
        array(
            'name' => esc_html__('Search Sidebar', 'schule'), 
            'id' => 'sidebar_search', 
            'description' => esc_html__('Widgets in this area will be shown in left or right sidebar on search page. To display the sidebar please choose the Right or Left Layout Type in the Theme Settings - General - Content options.', 'schule'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
        )
    );
	
	
	$cmsmasters_option = schule_get_global_options();
	
	
	if (isset($cmsmasters_option['schule' . '_sidebar']) && sizeof($cmsmasters_option['schule' . '_sidebar']) > 0) {
		foreach ($cmsmasters_option['schule' . '_sidebar'] as $sidebar) {
			register_sidebar(array( 
				'name' => $sidebar, 
				'id' => generateSlug($sidebar, 45), 
				'description' => esc_html__('Custom sidebar created with cmsmasters admin panel.', 'schule'), 
				'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
				'after_widget' => '</aside>', 
				'before_title' => '<h3 class="widgettitle">', 
				'after_title' => '</h3>' 
			) );
		}
	}
}

add_action('widgets_init', 'schule_the_widgets_init');



/* Register Showing Home Page on Default WordPress Pages Menu */
function schule_page_menu_args($args) {
    $args['show_home'] = true;
    
	
    return $args;
}

add_filter('wp_page_menu_args', 'schule_page_menu_args');



/* Register Post Formats, Feed Links, Post Thumbnails and Set Image Sizes*/
if (function_exists('add_theme_support')) {
	add_theme_support('post-formats', array( 
		'image', 
		'gallery', 
		'video', 
		'audio' 
	));
	
	
	function schule_add_post_type_support_project($post) {
		$screen = get_current_screen();
		
		$post_type = $screen->post_type;
		
		
		if ($post_type == 'project') {
			add_theme_support('post-formats', array( 
				'gallery', 
				'video' 
			));
		}
	}
	
	add_action('load-post.php', 'schule_add_post_type_support_project');
	
	add_action('load-post-new.php', 'schule_add_post_type_support_project');
	
	
	add_theme_support('post-thumbnails');
	
	
	add_theme_support('title-tag');
	
	
	add_theme_support('automatic-feed-links');
	
	
	add_theme_support('html5', array( 
		'comment-list', 
		'comment-form', 
		'search-form', 
		'gallery', 
		'caption' 
	));
	
	
	$thumbnail_list = cmsmasters_image_thumbnail_list();
	
	
	if (!isset($content_width)) {
		$content_width = $thumbnail_list['cmsmasters-full-thumb']['width'];
	}
	
	
	set_post_thumbnail_size($thumbnail_list['post-thumbnail']['width'], $thumbnail_list['post-thumbnail']['height'], $thumbnail_list['post-thumbnail']['crop']);
	
	
	if (function_exists('add_image_size')) {
		foreach ($thumbnail_list as $key => $image_size) {
			if ($key != 'post-thumbnail') {
				add_image_size($key, $image_size['width'], $image_size['height'], (isset($image_size['crop']) ? isset($image_size['crop']) : false));
			}
		}
	}
	
	
	add_filter('image_size_names_choose', 'schule_select_image_size');
}



/* Add Image Thumbnails Size to the List */
function schule_select_image_size($sizes) {
	$thumbnail_list = cmsmasters_image_thumbnail_list();
	
	
	$new_sizes = array();
	
	
	foreach ($thumbnail_list as $key => $image_size) {
		if (isset($image_size['title'])) {
			$new_sizes[$key] = $image_size['title'];
		}
	}
	
	
	$sizes = array_merge($sizes, $new_sizes);
	
	
	return $sizes;
}



/* Register Visual Content Editor CSS Stylesheet */
function schule_add_editor_styles() {
	add_editor_style('framework/admin/inc/css/custom-editor-style.css');
	
	
	add_editor_style('//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext');
}


$cmsmasters_wp_version = get_bloginfo('version');

if (version_compare($cmsmasters_wp_version, '5', '<') && !function_exists('is_gutenberg_page')) {
	add_action('init', 'schule_add_editor_styles');
}



/* Register Removing 'More Text' From Excerpt */
function schule_new_excerpt_more($more) {
	return '...';
}

add_filter('excerpt_more', 'schule_new_excerpt_more');



/* Register Custom Excerpt Length Function */
class Cmsmasters_Excerpt {
	var $length = 55;
	
	function __construct($length) {
		$this->length = $length;
		
		add_filter('excerpt_length', array($this, 'new_length'), 999);
	}
	
	public function new_length() {
		return $this->length;
	}
	
	function output() {
		the_excerpt();
	}
	
	function return_out() {
		return get_the_excerpt();
	}
}

function schule_excerpt($length = 55, $show = true) {
	if ($show) {
		$result = new Cmsmasters_Excerpt($length);
		
		$result->output();
	} else {
		$result = new Cmsmasters_Excerpt($length);
		
		return $result->return_out();
	}
}



/* Register Post Types in Author & Date Archive */
function schule_post_author_archive($query) {
	$post_types = apply_filters('post_types_archive_filter', array(
		'post', 
		'project'
	));
	
	
	if (isset($query) && !is_admin() && ($query->is_author || $query->is_date)) {
		$query->set('post_type', $post_types);
	}
	
	
	return $query;
}

// add_action('pre_get_posts', 'schule_post_author_archive');



/* Check Row p Wrapper */
function schule_rowcheck($content) {
    $content = str_replace('[/cmsmasters_row]</p>', '[/cmsmasters_row]', $content);
    $content = str_replace('<p>[cmsmasters_row', '[cmsmasters_row', $content);
	
	
    return $content;
}



/* Generate Page Shortcodes CSS */
function schule_generate_front_css() {
	$cmsmasters_page_id = schule_get_singular_id();

	$shortcodes_css = get_post_meta($cmsmasters_page_id, 'cmsmasters_shortcodes_custom_css', true);
	
	
	wp_add_inline_style('schule-retina', $shortcodes_css);
}

add_action('wp_enqueue_scripts', 'schule_generate_front_css');



/* Register Removing 'p' Tags that Wrap Divs */
function cmsmasters_divpdel($content) {
	$block = '(address|article|aside|audio|blockquote|canvas|dd|div|dl|fieldset|figcaption|figure|footer|form|h1|h2|h3|h4|h5|h6|header|hgroup|hr|noscript|ol|output|pre|section|table|tfoot|ul|video|style|iframe)';
	
	
	$content = preg_replace('/^<p><\/p>\n/', '', $content);
	$content = preg_replace('/^<\/p>/', '', $content);
	$content = preg_replace('/<p>$/', '', $content);
	$content = preg_replace('/<\/' . $block . '>(\s*)<\/p>/', '</\1>', $content);
	$content = preg_replace('/<' . $block . '([^>]+)>(\s*)<\/p>/', '<\1\2>', $content);
	$content = preg_replace('/<p>\s+<' . $block . '([^>]+)>/', '<\1\2>', $content);
	$content = preg_replace('/<p>\s+<\/' . $block . '>/', '</\1>', $content);
	$content = preg_replace('/<p><' . $block . '/', '<\1', $content);
	$content = preg_replace('/(<a\shref="[^"]*"\sid="[^"]*"\sclass="button[^"]*"[^>]*>[^<]+<\/a>\s*)<\/p>/', '\1', $content);
	
	
    return $content;
}



/* Generate Slug Function */
function generateSlug($phrase, $maxLength) {
	$result = strtolower($phrase);
	
	
	$result = preg_replace("/[^a-z0-9\s-]/", "", $result);
	$result = trim(preg_replace("/[\s-]+/", " ", $result));
	$result = trim(substr($result, 0, $maxLength));
	$result = preg_replace("/\s/", "-", $result);
	
	
	return $result;
}



/* Add Icons List to Database */
function schule_add_global_icons() {
	global $wp_filesystem;
	
	
	if (empty($wp_filesystem)) {
		require_once(ABSPATH . '/wp-admin/includes/file.php');
		
		WP_Filesystem();
	}
	
	
	if ($wp_filesystem) {
		$icons = $wp_filesystem->get_contents(CMSMASTERS_ADMIN . '/inc/fonts/config.json');
		
		$icons_custom = $wp_filesystem->get_contents(get_template_directory() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/admin/fonts/config-custom.json');
		
		
		$arr = json_decode($icons, true);
		
		$arr_custom = json_decode($icons_custom, true);
		
		
		update_option('cmsmasters_' . 'schule' . '_icons', serialize($arr));
		
		update_option('cmsmasters_' . 'schule' . '_icons_custom', serialize($arr_custom));
	}
}



/* Generate Icons List */
function cmsmasters_composer_icons() {
	global $pagenow;
	$screen = get_current_screen();
	
	if ( 
		$pagenow == 'post.php' || 
		$pagenow == 'post-new.php' || 
		$pagenow == 'widgets.php' || 
		$pagenow == 'term.php' || 
		$pagenow == 'edit-tags.php' || 
		$pagenow == 'nav-menus.php' || 
		str_replace('cmsmasters-settings-element', '', $screen->id) != $screen->id 
	) {
		$icons = get_option('cmsmasters_' . 'schule' . '_icons');
		
		$icons_custom = get_option('cmsmasters_' . 'schule' . '_icons_custom');
		
		
		$arr = unserialize($icons);
		
		$arr_custom = unserialize($icons_custom);
		
		$new_icons = '';
		
		
		$out = "\n" . 'function cmsmasters_composer_icons() { ' . "\n\t\t" . 
			'return { ' . "\n\t\t\t";
		
		
		if (!empty($arr_custom)) {
			foreach ($arr_custom['glyphs'] as $item) {
				if ($new_icons != $item['src']) {
					if ($new_icons != '') {
						$out = substr($out, 0, -4);
						
						$out .= ' ' . "\n\t\t\t" . '}, ' . "\n\t\t\t";
					}
					
					
					$out .= "'" . $item['src'] . "' : { \n\t";
					
					
					$new_icons = $item['src'];
				}
				
				
				$out .= "\t\t\t'" . $item['css'] . "' : '" . $arr_custom['css_prefix_text'] . $item['css'] . "', \n\t";
			}
		}
		
		
		if (!empty($arr)) {
			foreach ($arr['glyphs'] as $item) {
				if ($new_icons != $item['src']) {
					if ($new_icons != '') {
						$out = substr($out, 0, -4);
						
						$out .= ' ' . "\n\t\t\t" . '}, ' . "\n\t\t\t";
					}
					
					
					$out .= "'" . $item['src'] . "' : { \n\t";
					
					
					$new_icons = $item['src'];
				}
				
				
				$out .= "\t\t\t'" . $item['css'] . "' : '" . $arr['css_prefix_text'] . $item['css'] . "', \n\t";
			}
		}
		
		
		$out = substr($out, 0, -4);
		
		$out .= ' ' . "\n\t\t\t" . '} ' . "\n\t\t" . 
			'}; ' . "\n\t" . 
		'} ' . "\n";
		
		
		if (wp_script_is('cmsmasters_composer_shortcodes_js', 'queue')) {
			wp_add_inline_script('cmsmasters_composer_shortcodes_js', $out, 'before');
		} elseif (wp_script_is('schule-lightbox-js', 'queue')) {
			wp_add_inline_script('schule-lightbox-js', $out, 'before');
		}
	}
}



/* Generate CSS Rules */
function cmsmasters_color_css($rule, $color) {
	return $rule . ':' . $color . ';';
}



/* Generate RGB from HEX/RGBA Color */
function cmsmasters_color2rgb($color) {
	return (preg_match('/^#[a-f0-9]{3}$/i', $color) || preg_match('/^#[a-f0-9]{6}$/i', $color)) ? cmsmasters_hex2rgb($color) : cmsmasters_rgba2rgb($color);
}



/* Generate RGB Color from HEX */
function cmsmasters_hex2rgb($color) {
	$new_color = substr($color, 1);
	
	$color_len = strlen($new_color);
	
	
	$result = '';
	
	
	if ($color_len == 6) {
		$rgb = str_split($new_color, 2);
	} elseif ($color_len == 3) {
		$rgb = str_split($new_color, 1);
	}
	
	
	foreach ($rgb as $number) {
		$result .= hexdec((strlen($number) == 2) ? $number : $number . $number) . ', ';
	}
	
	
	$rgb_color = substr($result, 0, -2);
	
	
	return $rgb_color;
}



/* Generate HEX Color from RGB */
function cmsmasters_rgb2hex($rgb) {
	$newRGBs = explode(',', $rgb);
	
	
	$r = trim($newRGBs[0]);
	$g = trim($newRGBs[1]);
	$b = trim($newRGBs[2]);
	
	
	$hex_color = '#' . dechex($r) . dechex($g) . dechex($b);
	
	
	return $hex_color;
}



/* Generate RGB Color from RGBA */
function cmsmasters_rgba2rgb($rgba) {
	$newRGBAs = explode(',', $rgba);
	
	$r = trim(substr($newRGBAs[0], 5));
	$g = trim($newRGBAs[1]);
	$b = trim($newRGBAs[2]);
	
	
	$rgb_color = "{$r}, {$g}, {$b}";
	
	
	return $rgb_color;
}



/* Generate HSL Color from RGB */
function cmsmasters_rgb2hsl($rgb) {
	$newRGBs = explode(',', $rgb);
	
	
	$r = trim($newRGBs[0]);
	$g = trim($newRGBs[1]);
	$b = trim($newRGBs[2]);
	
	
	$oldR = $r;
	$oldG = $g;
	$oldB = $b;
	
	
	$r /= 255;
	$g /= 255;
	$b /= 255;
	
	
	$max = max($r, $g, $b);
	$min = min($r, $g, $b);
	
	
	$h;
	$s;
	
	
	$l = ($max + $min) / 2;
	$d = $max - $min;
	
	
	if ($d == 0) {
		$h = $s = 0;
	} else {
		$s = $d / (1 - abs(2 * $l - 1));
		
		
		switch ($max) {
		case $r:
			$h = 60 * fmod((($g - $b) / $d), 6);
			
			
			if ($b > $g) {
				$h += 360;
			}
			
			
			break;
		case $g:
			$h = 60 * (($b - $r) / $d + 2);
			
			
			break;
		case $b:
			$h = 60 * (($r - $g) / $d + 4);
			
			
			break;
		}
	}
	
	
	return array(round($h, 2), round($s, 2), round($l, 2));
}



/* Generate RGB Color from HSL */
function cmsmasters_hsl2rgb($h, $s, $l) {
	$r;
	$g;
	$b;
	
	
	$c = (1 - abs(2 * $l - 1)) * $s;
	$x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
	$m = $l - ($c / 2);
	
	
	if ($h < 60) {
		$r = $c;
		$g = $x;
		$b = 0;
	} else if ($h < 120) {
		$r = $x;
		$g = $c;
		$b = 0;	
	} else if ($h < 180) {
		$r = 0;
		$g = $c;
		$b = $x;	
	} else if ($h < 240) {
		$r = 0;
		$g = $x;
		$b = $c;
	} else if ($h < 300) {
		$r = $x;
		$g = 0;
		$b = $c;
	} else {
		$r = $c;
		$g = 0;
		$b = $x;
	}
	
	
	$r = ($r + $m) * 255;
	$g = ($g + $m) * 255;
	$b = ($b + $m) * 255;
	
	
	return floor($r) . ', ' . floor($g) . ', ' . floor($b);
}



/* Convert Embedded Video URL Function */
function cmsmasters_embedConvert($url) {
	if (str_replace('youtube', '', $url) !== $url) {
		parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
		
		$result = '//www.youtube.com/embed/' . $my_array_of_vars['v'] . '?autoplay=1&autohide=1&border=0&egm=0&showinfo=0';
	} elseif (str_replace('vimeo', '', $url) !== $url) {
		$video_id = substr(parse_url($url, PHP_URL_PATH), 1);
		
		$result = '//player.vimeo.com/video/' . $video_id . '?autoplay=1';
	} else {
		$result = '';
	}
	
	
	return $result;
}



/* Return of get_template_part() */
function cmsmasters_load_template_part($template_name, $part_name = null) {
    ob_start();
	
	
    get_template_part($template_name, $part_name);
	
	
    $out = ob_get_contents();
	
	
    ob_end_clean();
	
	
    return $out;
}



/* Regenerate Custom Styles Function */
function schule_regenerate_styles() {
	$custom_css_fonts = schule_theme_fonts();
	
	$custom_css_colors_primary = schule_theme_colors_primary();
	
	$custom_css_colors_secondary = schule_theme_colors_secondary();
	
	
	$custom_css = $custom_css_fonts . $custom_css_colors_primary . $custom_css_colors_secondary;
	
	
	schule_write_styles($custom_css);
}



/* Regenerate Custom Styles Function for plugins */
function cmsmasters_regenerate_styles() {
	schule_regenerate_styles();
}



/* Write Custom Styles to File Function */
function schule_write_styles($styles, $filename = '') {
	$upload_dir = wp_upload_dir();
	
	
	$style_dir = str_replace('\\', '/', $upload_dir['basedir'] . '/cmsmasters_styles');
	
	
	$is_dir = schule_create_folder($style_dir);
	
	
	if ($is_dir === false) {
		update_option('cmsmasters_style_dir_writable_' . 'schule', 'false');
		
		update_option('cmsmasters_style_exists_' . 'schule', 'false');
		
		
		return;
	}
	
	
	$file = trailingslashit($style_dir) . (($filename != '') ? $filename : 'schule') . '.css';
	
	
	$created = schule_create_file($file, $styles);
	
	
	if ($created === true) {
		update_option('cmsmasters_style_dir_writable_' . 'schule', 'true');
		
		update_option('cmsmasters_style_exists_' . 'schule', 'true');
	}
}



/* Create Folder Function */
function schule_create_folder(&$folder, $addindex = true) {
	if (is_dir($folder) && $addindex == false) {
		return true;
	}
	
	
	$created = wp_mkdir_p(trailingslashit($folder));
	
	
	if ($addindex == false) {
		return $created;
	}
	
	
	$index_file = trailingslashit($folder) . 'index.php';
	
	
	if (file_exists($index_file)) {
		return $created;
	}
	
	
	global $wp_filesystem;
	
	
	if (empty($wp_filesystem)) {
		require_once(ABSPATH . '/wp-admin/includes/file.php');
		
		WP_Filesystem();
	}
	
	
	if ($wp_filesystem) {
		$wp_filesystem->put_contents(
			$index_file,
			"<?php\n// Silence is golden.\n",
			FS_CHMOD_FILE
		);
	}
	
	
	return $created;
}



/* Create File Function */
function schule_create_file($file, $content = '', $verifycontent = true) {
	global $wp_filesystem;
	
	
	if (empty($wp_filesystem)) {
		require_once(ABSPATH . '/wp-admin/includes/file.php');
		
		WP_Filesystem();
	}
	
	
	if ($wp_filesystem) {
		$created = $wp_filesystem->put_contents(
			$file,
			$content,
			FS_CHMOD_FILE
		);
	}
	
	
	if ($created !== false) {
		$created = true;
	}
	
	
	return $created;
}



/* Twitter Shortcode Function */
function cmsmasters_get_tweets( $count = 1 ) {
	$backup_name = 'cmsmasters_' . 'schule' . '_tweets_list_backup';

	$backup_tweets = get_option( $backup_name );

	if ( 'done' === get_transient( 'cmsmasters_' . 'schule' . '_tweets_list_regeneration' ) && ! empty( $backup_tweets ) ) {
		return $backup_tweets;
	}

	$cmsmasters_option = schule_get_global_options();

	if ( empty( $cmsmasters_option['schule' . '_twitter_access_data'] ) ) {
		return $backup_tweets;
	}

	$twitter_api_data = cmsmasters_twitter_api_get_data( $cmsmasters_option['schule' . '_twitter_access_data'] );

	if ( empty( $twitter_api_data ) ) {
		return $backup_tweets;
	}

	$api_tweets = $twitter_api_data->includes->tweets;

	$limit_to_display = min( $count, count( $api_tweets ) );
	$name = $twitter_api_data->data->username;
	$image = $twitter_api_data->data->profile_image_url;

	$tweets = array();

	for ( $i = 0; $i < $limit_to_display; $i++ ) {
		$tweet = $api_tweets[$i];
		$permalink = '//twitter.com/' . $name . '/status/' . $tweet->id;
		$pattern = '/(http|https):(\S)+/';
		$replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
		$text = preg_replace($pattern, $replace, $tweet->text);
		$time = $tweet->created_at;
		$time = date_parse($time);
		$uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);

		$tweets[] = array(
			'text' => $text,
			'name' => $name,
			'permalink' => $permalink,
			'image' => $image,
			'time' => $uTime,
		);
	}

	update_option( $backup_name, $tweets );

	set_transient( 'cmsmasters_' . 'schule' . '_tweets_list_regeneration', 'done', DAY_IN_SECONDS );

	return $tweets;
}

function cmsmasters_twitter_api_get_data( $access_data ) {
	$base_url = 'https://api.twitter.com/2/users/me';

	$fields = array(
		'user.fields' => 'id,public_metrics,username,profile_image_url,most_recent_tweet_id',
		'expansions' => 'most_recent_tweet_id',
		'tweet.fields' => 'id,text,created_at,public_metrics',
	);

	$consumer_key = $access_data['consumer_key'];
	$consumer_secret = $access_data['consumer_secret'];
	$access_token = $access_data['access_token'];
	$access_token_secret = $access_data['access_token_secret'];

	if (
		empty( $consumer_key ) ||
		empty( $consumer_secret ) ||
		empty( $access_token ) ||
		empty( $access_token_secret )
	) {
		return false;
	}

	$oauth_params = array(
		'oauth_consumer_key' => $consumer_key,
		'oauth_nonce' => md5( mt_rand() ),
		'oauth_signature_method' => 'HMAC-SHA1',
		'oauth_timestamp' => time(),
		'oauth_token' => $access_token,
		'oauth_version' => '1.0',
	);

	foreach ( $fields as $field_key => $field_value ) {
		$oauth_params[ $field_key ] = $field_value;
	}

	$base_string = cmsmasters_twitter_api_build_base_string( $base_url, $oauth_params );

	$composite_key = rawurlencode( $consumer_secret ) . '&' . rawurlencode( $access_token_secret );
	$oauth_signature = base64_encode( hash_hmac( 'sha1', $base_string, $composite_key, true ) );
	$oauth_params['oauth_signature'] = $oauth_signature;

	$oauth_header = cmsmasters_twitter_api_build_oauth_header( $oauth_params );

	$request_url = $base_url . cmsmasters_twitter_api_parse_fields_to_string( $fields );

	$response = wp_remote_get( $request_url, array(
		'headers' => $oauth_header,
		'timeout' => 60,
	) );

	if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return false;
	}

	return json_decode( wp_remote_retrieve_body( $response ) );
}

function cmsmasters_twitter_api_build_base_string( $base_url, $oauth_params ) {
	$base_string = array();

	ksort( $oauth_params );

	foreach ( $oauth_params as $key => $value ) {
		$base_string[] = rawurlencode( $key ) . '=' . rawurlencode( $value );
	}

	return 'GET&' . rawurlencode( $base_url ) . '&' . rawurlencode( implode( '&', $base_string ) );
}

function cmsmasters_twitter_api_build_oauth_header( $oauth_params ) {
	$header = 'Authorization: OAuth ';
	$values = array();

	foreach ( $oauth_params as $key => $value ) {
		if ( in_array( $key, array( 'oauth_consumer_key', 'oauth_nonce', 'oauth_signature', 'oauth_signature_method', 'oauth_timestamp', 'oauth_token', 'oauth_version' ) ) ) {
			$values[] = "$key=\"" . rawurlencode( $value ) . "\"";
		}
	}

	$header .= implode( ', ', $values );

	return $header;
}

function cmsmasters_twitter_api_parse_fields_to_string( $fields ) {
	$url_string = '?';
	$length = count( $fields );
	$j = 1;

	foreach ( $fields as $key => $value ) {
		$url_string .= rawurlencode( $key ) . '=' . rawurlencode( $value );

		if ( $j != $length ) {
			$url_string .= '&';
		}

		$j++;
	}

	return $url_string;
}



/* Get Singular ID */
function schule_get_singular_id() {
	$id = false;

	if (is_singular()) {
		$id = get_the_ID();
	} elseif (CMSMASTERS_WOOCOMMERCE && is_shop()) {
		$id = wc_get_page_id('shop');
	}

	return $id;
}



/* Theme Background Styles */
function schule_theme_bg_styles() {
	$cmsmasters_option = schule_get_global_options();
	
	$cmsmasters_page_id = schule_get_singular_id();
	
	$out = "";
	
	
	if ($cmsmasters_option['schule' . '_theme_layout'] == 'boxed') {
		$cmsmasters_bg_default = 'true';
		
		
		if (
			is_singular() || 
			(CMSMASTERS_WOOCOMMERCE && is_shop())
		) {
			$cmsmasters_bg_default = get_post_meta($cmsmasters_page_id, 'cmsmasters_bg_default', true);
		}
		
		
		if ($cmsmasters_bg_default == 'false') {
			$cmsmasters_bg_col = get_post_meta($cmsmasters_page_id, 'cmsmasters_bg_col', true);
			$cmsmasters_bg_img_enable = get_post_meta($cmsmasters_page_id, 'cmsmasters_bg_img_enable', true);
			$cmsmasters_bg_img_str = get_post_meta($cmsmasters_page_id, 'cmsmasters_bg_img', true);
			$cmsmasters_bg_pos = get_post_meta($cmsmasters_page_id, 'cmsmasters_bg_pos', true);
			$cmsmasters_bg_rep = get_post_meta($cmsmasters_page_id, 'cmsmasters_bg_rep', true);
			$cmsmasters_bg_att = get_post_meta($cmsmasters_page_id, 'cmsmasters_bg_att', true);
			$cmsmasters_bg_size = get_post_meta($cmsmasters_page_id, 'cmsmasters_bg_size', true);
		} else {
			$cmsmasters_bg_col = $cmsmasters_option['schule' . '_bg_col'];
			$cmsmasters_bg_img_enable = $cmsmasters_option['schule' . '_bg_img_enable'];
			$cmsmasters_bg_img_str = $cmsmasters_option['schule' . '_bg_img'];
			$cmsmasters_bg_pos = $cmsmasters_option['schule' . '_bg_pos'];
			$cmsmasters_bg_rep = $cmsmasters_option['schule' . '_bg_rep'];
			$cmsmasters_bg_att = $cmsmasters_option['schule' . '_bg_att'];
			$cmsmasters_bg_size = $cmsmasters_option['schule' . '_bg_size'];
		}
		
		
		$cmsmasters_bg_img = (!empty($cmsmasters_bg_img_str) ? explode('|', $cmsmasters_bg_img_str) : $cmsmasters_bg_img_str);
		$cmsmasters_bg_img_url = (isset($cmsmasters_bg_img[0]) && is_numeric($cmsmasters_bg_img[0]) ? wp_get_attachment_image_src((int) $cmsmasters_bg_img[0], 'full') : '');
		$cmsmasters_bg_img_src = (is_array($cmsmasters_bg_img) ? 'url(' . ((is_numeric($cmsmasters_bg_img[0])) ? $cmsmasters_bg_img_url[0] : $cmsmasters_bg_img[1]) . ')' : 'none');
		
		
		$out .= "
	html body {
		background-color : {$cmsmasters_bg_col};";
		
		if ($cmsmasters_bg_img_enable) {
			$out .= "
		background-image : {$cmsmasters_bg_img_src};
		background-position : {$cmsmasters_bg_pos};
		background-repeat : {$cmsmasters_bg_rep};
		background-attachment : {$cmsmasters_bg_att};
		background-size : {$cmsmasters_bg_size};
		";
		}
		
		$out .= "
	}";
	}
	
	
	wp_add_inline_style('schule-style', $out);
}

add_action('wp_enqueue_scripts', 'schule_theme_bg_styles');



/* Get Logo Function */
function schule_logo() {
	$cmsmasters_option = schule_get_global_options();
	
	
	// if ($cmsmasters_option['schule' . '_logo_type'] == 'text') {
	// 	if ($cmsmasters_option['schule' . '_logo_title'] != '') {
	// 		$blog_title = stripslashes($cmsmasters_option['schule' . '_logo_title']);
	// 	} else {
	// 		$blog_title = (get_bloginfo('name')) ? get_bloginfo('name') : 'Schule';
	// 	}
		
		
	// 	if ($cmsmasters_option['schule' . '_logo_subtitle'] != '') {
	// 		$blog_descr = stripslashes($cmsmasters_option['schule' . '_logo_subtitle']);
	// 	} else {
	// 		$blog_descr = (get_bloginfo('description')) ? get_bloginfo('description') : esc_html__('Default Logo Subtitle', 'schule');
	// 	}
		
		
	// 	echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr($blog_title) . '" class="logo">' . "\n\t" . 
	// 		'<span class="logo_text_wrap">' . 
	// 			'<span class="title">' . esc_html($blog_title) . '</span>' . "\n" . 
	// 			($cmsmasters_option['schule' . '_logo_subtitle'] ? '<span class="title_text">' . esc_html($blog_descr) . '</span>' : '') . 
	// 		'</span>' . 
	// 	'</a>';
	// }
	//  else {
		list($logo_width, $logo_height) = getimagesize(get_template_directory() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo.png');
		
		
		// if ($cmsmasters_option['schule' . '_logo_url'] == '') {
			echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" class="logo">' . "\n\t" . 
				'<img src="' . esc_url(get_template_directory_uri()) . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo.png" alt="' . esc_attr(get_bloginfo('name')) . '" />' . "\n\t" . 
				'<img class="logo_retina" src="' . esc_url(get_template_directory_uri()) . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_retina.png" alt="' . esc_attr(get_bloginfo('name')) . '" width="' . round($logo_width) . '" height="' . round($logo_height) . '" />' . "\r" . 
			'</a>' . "\n";
	// 	} else {
	// 		$logo_img = explode('|', $cmsmasters_option['schule' . '_logo_url']);
			
			
	// 		if (is_numeric($logo_img[0])) {
	// 			$logo_img_url = wp_get_attachment_image_src((int) $logo_img[0], 'full');
	// 		}
			
			
	// 		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" class="logo">' . "\n\t" . 
	// 			'<img src="' . ((is_numeric($logo_img[0])) ? esc_url($logo_img_url[0]) : esc_url($logo_img[1])) . '" alt="' . esc_attr(get_bloginfo('name')) . '" />' . "\r";
			
			
	// 		if ($cmsmasters_option['schule' . '_logo_url_retina'] != '') {
	// 			$logo_img_retina = explode('|', $cmsmasters_option['schule' . '_logo_url_retina']);
				
				
	// 			if (is_numeric($logo_img_retina[0])) {
	// 				$logo_img_retina_url = wp_get_attachment_image_src((int) $logo_img_retina[0], 'full');
	// 			}
				
				
	// 			$logo_img_retina_width = ((is_numeric($logo_img_retina[0])) ? ((int) $logo_img_retina_url[1] / 2) : $logo_width);
				
	// 			$logo_img_retina_height = ((is_numeric($logo_img_retina[0])) ? ((int) $logo_img_retina_url[2] / 2) : $logo_height);
				
				
	// 			echo '<img class="logo_retina" src="' . 
	// 			((is_numeric($logo_img_retina[0])) ? esc_url($logo_img_retina_url[0]) : esc_url($logo_img_retina[1])) . 
	// 			'" alt="' . esc_attr(get_bloginfo('name')) . 
	// 			'" width="' . round($logo_img_retina_width) . 
	// 			'" height="' . round($logo_img_retina_height) . 
	// 			'" />' . "\r";
	// 		} else {
	// 			echo '<img class="logo_retina" src="' . ((is_numeric($logo_img[0])) ? esc_url($logo_img_url[0]) : esc_url($logo_img[1])) . '" alt="' . esc_attr(get_bloginfo('name')) . '" />' . "\r";
	// 		}
			
			
	// 		echo '</a>' . "\n";
	// 	}
	// }
}



/* Logo Styles */
function schule_theme_logo_styles() {
	$cmsmasters_option = schule_get_global_options();
	
	$out = "";
	
	
	if ($cmsmasters_option['schule' . '_logo_type'] == 'text') {
		if ($cmsmasters_option['schule' . '_logo_custom_color']) {
			$out .= "
				#header a.logo span.title {
					" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_logo_title_color']) . "
				}
				
				#header a.logo span.title_text {
					" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_logo_subtitle_color']) . "
				}
			";
		}
	} else {
		$defaults = schule_settings_general_defaults();
		
		$header_mid_height = (($cmsmasters_option['schule' . '_header_mid_height'] !== '') ? $cmsmasters_option['schule' . '_header_mid_height'] : $defaults[$tab]['schule' . '_header_mid_height']);
		
		list($logo_width, $logo_height) = getimagesize(get_template_directory() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo.png');
		
		
		if ($cmsmasters_option['schule' . '_logo_url'] == '') {
			if ($logo_height >= $header_mid_height) {
				$logo_def_style_width = (int) ($header_mid_height * ($logo_width / $logo_height));
			} else {
				$logo_def_style_width = $logo_width;
			}
			
			
			$out .= "
	.header_mid .header_mid_inner .logo_wrap {
		width : {$logo_def_style_width}px;
	}
	
	.header_mid_inner .logo img.logo_retina {
		width : {$logo_width}px;
	}
";
		} else {
			$logo_img = explode('|', $cmsmasters_option['schule' . '_logo_url']);
			
			
			if (is_numeric($logo_img[0])) {
				$logo_img_url = wp_get_attachment_image_src((int) $logo_img[0], 'full');
			}
			
			
			$logo_img_width = ((is_numeric($logo_img[0])) ? (int) $logo_img_url[1] : $logo_width);
			
			$logo_img_height = ((is_numeric($logo_img[0])) ? (int) $logo_img_url[2] : $logo_height);
			
			
			if ($logo_img_height >= $header_mid_height) {
				$logo_style_width = (int) ($header_mid_height * ($logo_img_width / $logo_img_height));
			} else {
				$logo_style_width = $logo_img_width;
			}
			
			
			$out .= "
	.header_mid .header_mid_inner .logo_wrap {
		width : {$logo_style_width}px;
	}
";
			
			
			if ($cmsmasters_option['schule' . '_logo_url_retina'] != '') {
				$logo_img_retina = explode('|', $cmsmasters_option['schule' . '_logo_url_retina']);
				
				
				if (is_numeric($logo_img_retina[0])) {
					$logo_img_retina_url = wp_get_attachment_image_src((int) $logo_img_retina[0], 'full');
				}
				
				
				$logo_img_retina_width = ((is_numeric($logo_img_retina[0])) ? ((int) $logo_img_retina_url[1] / 2) : $logo_width);
				
				
				$out .= "
	.header_mid_inner .logo img.logo_retina {
		width : {$logo_img_retina_width}px;
	}
";
			}
		}
	}
	
	
	wp_add_inline_style('schule-style', $out);
}

add_action('wp_enqueue_scripts', 'schule_theme_logo_styles');



/* Get Footer Logo Function */
function schule_footer_logo($cmsmasters_option) {
	echo '<div class="footer_logo_wrap">';
	
	list($logo_footer_width, $logo_footer_height) = getimagesize(get_template_directory() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_footer.png');
	
	
	if ($cmsmasters_option['schule' . '_footer_logo_url'] == '') {
		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" class="footer_logo">' . "\n\t" . 
			'<img src="' . esc_url(get_template_directory_uri()) . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_footer.png" alt="' . esc_attr(get_bloginfo('name')) . '" />' . "\n\t" . 
			'<img class="footer_logo_retina" src="' . esc_url(get_template_directory_uri()) . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_footer_retina.png" alt="' . esc_attr(get_bloginfo('name')) . '" width="' . round($logo_footer_width) . '" height="' . round($logo_footer_height) . '" />' . "\r" . 
		'</a>' . "\n";
	} else {
		$footer_logo_img = explode('|', $cmsmasters_option['schule' . '_footer_logo_url']);
		
		
		if (is_numeric($footer_logo_img[0])) {
			$footer_logo_img_url = wp_get_attachment_image_src((int) $footer_logo_img[0], 'full');
		}
		
		
		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" class="footer_logo">' . "\n\t" . 
			'<img src="' . ((is_numeric($footer_logo_img[0])) ? esc_url($footer_logo_img_url[0]) : esc_url($footer_logo_img[1])) . '" alt="' . esc_attr(get_bloginfo('name')) . '" />' . "\r";
		
		
		if ($cmsmasters_option['schule' . '_footer_logo_url_retina'] != '') {
			$footer_logo_img_retina = explode('|', $cmsmasters_option['schule' . '_footer_logo_url_retina']);
		
			if (is_numeric($footer_logo_img_retina[0])) {
				$footer_logo_img_retina_url = wp_get_attachment_image_src((int) $footer_logo_img_retina[0], 'full');
			}
			
			$footer_logo_img_retina_width = ((is_numeric($footer_logo_img_retina[0])) ? ((int) $footer_logo_img_retina_url[1] / 2) : $logo_footer_width);
			
			$footer_logo_img_retina_height = ((is_numeric($footer_logo_img_retina[0])) ? ((int) $footer_logo_img_retina_url[2] / 2) : $logo_footer_height);
			
			
			echo '<img class="footer_logo_retina" src="' . 
			((is_numeric($footer_logo_img_retina[0])) ? esc_url($footer_logo_img_retina_url[0]) : esc_url($footer_logo_img_retina[1])) . 
			'" alt="' . esc_attr(get_bloginfo('name')) . 
			'" width="' . round($footer_logo_img_retina_width) . 
			'" height="' . round($footer_logo_img_retina_height) . 
			'" />' . "\r";
		} else {
			echo '<img class="footer_logo_retina" src="' . ((is_numeric($footer_logo_img[0])) ? esc_url($footer_logo_img_url[0]) : esc_url($footer_logo_img[1])) . '" alt="' . esc_attr(get_bloginfo('name')) . '" />' . "\r";
		}
		
		
		echo '</a>' . "\n";
	}
	
	
	echo '</div>';
}



/* Get Social Icons Function */
function schule_social_icons() {
	$out = '';
	
	
	if (class_exists('Cmsmasters_Content_Composer')) {
		$cmsmasters_option = schule_get_global_options();
		
		$i = 1;
		
		
		$out .= "
<div class=\"social_wrap\">
	<div class=\"social_wrap_inner\">
		<ul>";
		
		
		foreach ($cmsmasters_option['schule' . '_social_icons'] as $cmsmasters_social_icons) {
			$cmsmasters_social_icon = explode('|', $cmsmasters_social_icons);
			
			if (
				(isset($cmsmasters_social_icon[4]) && trim($cmsmasters_social_icon[4]) != '') ||
				(isset($cmsmasters_social_icon[5]) && trim($cmsmasters_social_icon[5]) != '')
			) {
				$social_icon_color = ' cmsmasters_social_icon_color';
			} else {
				$social_icon_color = '';
			}
			
			$out .= "
				<li>
					<a href=\"" . esc_url(trim($cmsmasters_social_icon[1])) . "\" class=\"cmsmasters_social_icon cmsmasters_social_icon_{$i} " . esc_attr(trim($cmsmasters_social_icon[0])) . "{$social_icon_color}\" title=\"" . esc_attr(trim($cmsmasters_social_icon[2])) . "\"" . ((trim($cmsmasters_social_icon[3]) == "true") ? " target=\"_blank\"" : "") . "></a>
				</li>";
			
			
			$i++;
		}
		
		
		$out .= "
		</ul>
	</div>
</div>";
	}
	
	
	echo schule_return_content($out);
}



/* Get Title Function */
function cmsmasters_title($cmsmasters_id, $show = true) { 
	$cmsmasters_heading = get_post_meta($cmsmasters_id, 'cmsmasters_heading', true);
	
	$cmsmasters_heading_title = get_post_meta($cmsmasters_id, 'cmsmasters_heading_title', true);
	
	$out = '';
	
	if ($cmsmasters_heading == 'custom' && $cmsmasters_heading_title != '') {
		$out .= esc_attr($cmsmasters_heading_title);
	} else {
		$out .= esc_attr(strip_tags(get_the_title($cmsmasters_id) ? get_the_title($cmsmasters_id) : $cmsmasters_id));
	} 
    
	
    if ($show) {
        echo wp_kses_post($out);
    } else {
        return wp_kses_post($out);
    }
}



/* Get Comments Function */
function schule_get_comments($class = false, $show = false, $add_html = false) { 
	$out = '';
	
	if ($add_html) {
		$text = (get_comments_number() == '1') ? esc_html__('comment', 'schule') : esc_html__('comments', 'schule');
	} else {
		$text = '';
	}
	
	if (comments_open()) {
		$out .= '<span class="cmsmasters_comments' . ($class ? ' ' . $class : '') . '">' . 
			'<a class="cmsmasters_theme_icon_comment" href="' . esc_url(get_comments_link()) . '" title="' . esc_attr__('Comment on', 'schule') . ' ' . esc_attr(get_the_title()) . '">' . 
				'<span>' . esc_html(get_comments_number()) . ' ' . $text . '</span>' . 
			'</a>' . 
		'</span>';
	}
	
	
	if ($show) {
		echo schule_return_content($out);
	} else {
		return $out;
	}
}



/* Get Category List */
function schule_get_the_category_list($cmsmasters_id, $taxonomy, $sep = '', $before = '', $after = '', $taxonomy_class = false) {
	$terms = get_the_terms($cmsmasters_id, $taxonomy);
	
	
	if (is_wp_error($terms)) {
		return $terms;
	}
	
	
	if (empty($terms)) {
		return false;
	}
	
	
	$links = array();
	
	
	foreach ($terms as $term) {
		$link = get_term_link($term, $taxonomy);
		
		
		if ($taxonomy_class && CMSMASTERS_CATEGORIES_ICON) {
			$term_meta = get_term_meta($term->term_id, 'cmsmasters_cat_icon', true);
		}
		
		
		if (is_wp_error($link)) {
			return $link;
		}
		
		
		$links[] = '<a href="' . esc_url($link) . '" class="cmsmasters_cat_color' . (($taxonomy_class && CMSMASTERS_CATEGORIES_ICON) ? ' ' . esc_attr($term_meta) : '') . ' cmsmasters_cat_' . esc_attr($term->term_id) . '" rel="category tag">' . esc_html($term->name) . '</a>';
	}
	
	
    $term_links = apply_filters("term_links-$taxonomy", $links);
	
	
	return $before . implode($sep, $term_links) . $after;
}



/* Theme Page Layout and Scheme Function */
function schule_theme_page_layout_scheme() {
	$cmsmasters_option = schule_get_global_options();

	$cmsmasters_page_id = schule_get_singular_id();
	
	
	if (
		is_404() || 
		is_attachment() 
	) {
		$cmsmasters_layout = 'fullwidth';
	} elseif (
		is_singular() || 
		(CMSMASTERS_WOOCOMMERCE && is_shop())
	) {
		$cmsmasters_layout = get_post_meta($cmsmasters_page_id, 'cmsmasters_layout', true);
	} elseif (CMSMASTERS_TRIBE_EVENTS && tribe_is_event_query() && isset($cmsmasters_option['schule' . '_events_layout'])) {
		$cmsmasters_layout = $cmsmasters_option['schule' . '_events_layout'];
	} elseif (is_archive() || is_home()) {
		$cmsmasters_layout = $cmsmasters_option['schule' . '_archives_layout'];
	} elseif (is_search()) {
		$cmsmasters_layout = $cmsmasters_option['schule' . '_search_layout'];
	} else {
		$cmsmasters_layout = $cmsmasters_option['schule' . '_other_layout'];
	}
	
	
	if ($cmsmasters_layout == '') {
		$cmsmasters_layout = $cmsmasters_option['schule' . '_layout'];
	}
	
	
	if ($cmsmasters_layout != 'fullwidth') {
		if ($cmsmasters_page_id) {
			$sidebar_id = get_post_meta($cmsmasters_page_id, 'cmsmasters_sidebar_id', true);
		}
		
		
		if (isset($sidebar_id) && !is_active_sidebar($sidebar_id)) {
			if (!is_active_sidebar('sidebar_default')) {
				$cmsmasters_layout = 'fullwidth';
			}
		} else if ((is_home() || is_archive()) && !is_active_sidebar('sidebar_archive') && !is_active_sidebar('sidebar_default')) {
			$cmsmasters_layout = 'fullwidth';
		} else if (is_search() && !is_active_sidebar('sidebar_search') && !is_active_sidebar('sidebar_default')) {
			$cmsmasters_layout = 'fullwidth';
		}
	}
	
	
	if (
		is_singular() || 
		(CMSMASTERS_WOOCOMMERCE && is_shop())
	) {
		$cmsmasters_page_scheme = get_post_meta($cmsmasters_page_id, 'cmsmasters_page_scheme', true);
	} else {
		$cmsmasters_page_scheme = 'default';
	}
	
	
	if (!isset($cmsmasters_page_scheme) || $cmsmasters_page_scheme == '') {
		$cmsmasters_page_scheme = 'default';
	}
	
	
	$cmsmasters_layout = apply_filters('cmsmasters_theme_page_layout_filter', $cmsmasters_layout);
	
	$cmsmasters_page_scheme = apply_filters('cmsmasters_theme_page_scheme_filter', $cmsmasters_page_scheme);
	
	
	return array($cmsmasters_layout, $cmsmasters_page_scheme);
}



/* Return content */
function schule_return_content($content) {
	return $content;
}



/* Register Moving 'style' Tags from Shortcodes to Content Start */
function schule_global_shortcodes_styles_move($content) {
	return preg_replace("/(?<!['\"])<style.*?>([^`]*?)<\/style>/", '', $content);
}


function schule_row_checker($data) {
	$out = schule_rowcheck($data);
	
	return $out;
}

add_filter('the_content', 'schule_row_checker', 10, 2);



/* Cmsmasters Ajax like callback */
function cmsmasters_ajax_like_callback() {
	$nonce = $_POST['nonce'];
	
	if( wp_verify_nonce($nonce, 'cmsmasters_ajax_like-nonce') ){
		$post_ID = intval( $_POST['id'] );
		
		$add_html = $_POST['add_html'];
		
		$ip = getenv('REMOTE_ADDR');
		
		$ip_name = str_replace('.', '-', $ip);
		
		
		if ($post_ID != '') {
			$likes = (get_post_meta($post_ID, 'cmsmasters_likes', true) != '') ? get_post_meta($post_ID, 'cmsmasters_likes', true) : '0';
			
			
			$ipPost = new WP_Query(array( 
				'post_type' => 		'cmsmasters_like', 
				'post_status' => 	'draft', 
				'post_parent' => 	$post_ID, 
				'name' => 			$ip_name 
			));
			
			
			$ipCheck = $ipPost->posts;
			
			
			if (isset($_COOKIE['like-' . $post_ID]) || count($ipCheck) != 0) {
				echo esc_html($likes);
			} else {
				$plusLike = $likes + 1;
				
				
				update_post_meta($post_ID, 'cmsmasters_likes', $plusLike);
				
				
				if ($add_html == 'true') {
					$text = ($plusLike == '1') ? esc_html__('like', 'schule') : esc_html__('likes', 'schule');
				} else {
					$text = '';
				}
				
				
				setcookie('like-' . $post_ID, time(), time() + 31536000, '/');
				
				
				wp_insert_post(array( 
					'post_type' => 		'cmsmasters_like', 
					'post_status' => 	'draft', 
					'post_parent' => 	$post_ID, 
					'post_name' => 		$ip_name, 
					'post_title' => 	$ip 
				));
				
				
				echo esc_html($plusLike) . ' ' . $text;
			}
		}
		
		wp_die();
	} else { 
		die('Stop!'); 
	}
}

add_action('wp_ajax_cmsmasters_ajax_like', 'cmsmasters_ajax_like_callback');

add_action('wp_ajax_nopriv_cmsmasters_ajax_like', 'cmsmasters_ajax_like_callback');



/* Cmsmasters Ajax view callback */
function cmsmasters_ajax_view_callback() {
	$nonce = $_POST['nonce'];

	if( wp_verify_nonce($nonce, 'cmsmasters_ajax_view-nonce') ){
		$post_ID = intval( $_POST['id'] );
		
		$ip = getenv('REMOTE_ADDR');
		
		$ip_name = str_replace('.', '-', $ip);
		
		
		if ($post_ID != '') {
			$views = (get_post_meta($post_ID, 'cmsmasters_views', true) != '') ? get_post_meta($post_ID, 'cmsmasters_views', true) : '0';
			
			
			$ipPost = new WP_Query(array( 
				'post_type' => 		'cmsmasters_view', 
				'post_status' => 	'draft', 
				'post_parent' => 	$post_ID, 
				'name' => 			$ip_name 
			));
			
			
			$ipCheck = $ipPost->posts;
			
			
			if (isset($_COOKIE['view-' . $post_ID]) || count($ipCheck) != 0) {
				echo esc_html($views);
			} else {
				$plusView = $views + 1;
				
				
				update_post_meta($post_ID, 'cmsmasters_views', $plusView);
				
				
				setcookie('view-' . $post_ID, time(), time() + 31536000, '/');
				
				
				wp_insert_post(array( 
					'post_type' => 		'cmsmasters_view', 
					'post_status' => 	'draft', 
					'post_parent' => 	$post_ID, 
					'post_name' => 		$ip_name, 
					'post_title' => 	$ip 
				));
				
				
				echo esc_html($plusView);
			}
		}
		
		wp_die();
	} else { 
		die('Stop!'); 
	}
}

add_action('wp_ajax_cmsmasters_ajax_view', 'cmsmasters_ajax_view_callback');

add_action('wp_ajax_nopriv_cmsmasters_ajax_view', 'cmsmasters_ajax_view_callback');



/* Cmsmasters Ajax Apply Theme Style callback */
function cmsmasters_ajax_apply_theme_style_callback() {
	$nonce = $_POST['nonce'];
	
	if (wp_verify_nonce($nonce, 'cmsmasters_ajax_apply_theme_style-nonce')) {
		if (isset($_POST['theme_style'])) {
			update_option('cmsmasters_schule_theme_style', $_POST['theme_style']);

			update_option('cmsmasters_schule_theme_style_change', 'change');
		}
		
		wp_die();
	} else { 
		die('Stop!'); 
	}
}

add_action('wp_ajax_cmsmasters_ajax_apply_theme_style', 'cmsmasters_ajax_apply_theme_style_callback');

add_action('wp_ajax_nopriv_cmsmasters_ajax_apply_theme_style', 'cmsmasters_ajax_apply_theme_style_callback');



/* Theme Theme Style Change */
function schule_theme_style_change() {
	if (!CMSMASTERS_THEME_STYLE_COMPATIBILITY) {
		update_option('cmsmasters_schule_theme_style', '');

		return;
	}

	if ('hold' === get_option('cmsmasters_schule_theme_style_change')) {
		return;
	} else {
		schule_add_global_options();
		
		schule_add_global_icons();
		
		schule_regenerate_styles();
		
		update_option('cmsmasters_schule_theme_style_change', 'hold');
	}
}

add_action('init', 'schule_theme_style_change');



/* Cmsmasters Ajax Reset Settings callback */
function cmsmasters_ajax_reset_settings_callback() {
	$nonce = $_POST['nonce'];
	
	if (wp_verify_nonce($nonce, 'cmsmasters_ajax_reset_settings-nonce')) {
		schule_add_global_options(true);
		
		schule_regenerate_styles();
		
		wp_die();
	} else { 
		die('Stop!'); 
	}
}

add_action('wp_ajax_cmsmasters_ajax_reset_settings', 'cmsmasters_ajax_reset_settings_callback');

add_action('wp_ajax_nopriv_cmsmasters_ajax_reset_settings', 'cmsmasters_ajax_reset_settings_callback');



/* Cmsmasters Ajax Import Settings callback */
function cmsmasters_ajax_import_settings_callback() {
	$nonce = $_POST['nonce'];
	
	if (wp_verify_nonce($nonce, 'cmsmasters_ajax_import_settings-nonce')) {
		if (isset($_POST['settings'])) {
			$cmsmasters_php_ver = phpversion();
			
			
			if (version_compare($cmsmasters_php_ver, '5.4.0', '<')) {
				$settings = json_decode(pack("H*", $_POST['settings']), true);
			} else {
				$settings = json_decode(hex2bin($_POST['settings']), true);
			}
			
			
			foreach ($settings as $name => $value) {
				update_option($name, $value);
			}
			
			
			schule_regenerate_styles();
		}
		
		wp_die();
	} else { 
		die('Stop!'); 
	}
}

add_action('wp_ajax_cmsmasters_ajax_import_settings', 'cmsmasters_ajax_import_settings_callback');

add_action('wp_ajax_nopriv_cmsmasters_ajax_import_settings', 'cmsmasters_ajax_import_settings_callback');



/* Cmsmasters Ajax Export Settings callback */
function cmsmasters_ajax_export_settings_callback() {
	$nonce = $_POST['nonce'];
	
	if (wp_verify_nonce($nonce, 'cmsmasters_ajax_export_settings-nonce')) {
		$cmsmasters_global_settings = array( 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_general', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_bg', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_header', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_content', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_footer', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_font_content', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_font_link', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_font_nav', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_font_heading', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_font_other', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_element_sidebar', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_element_icon', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_element_lightbox', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_element_sitemap', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_element_error', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_element_code', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_element_recaptcha', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_single_post', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_single_project', 
			'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_single_profile'
		);
		
		$wp_global_settings = array( 
			'thumbnail_size_w', 
			'thumbnail_size_h', 
			'medium_size_w', 
			'medium_size_h', 
			'large_size_w', 
			'large_size_h', 
			'theme_mods_' . 'schule', 
			'sidebars_widgets', 
			'widget_custom-advertisement', 
			'widget_akismet_widget', 
			'widget_archives', 
			'widget_media_audio', 
			'widget_calendar', 
			'widget_categories', 
			'widget_custom-contact-form', 
			'widget_custom-contact-info', 
			'widget_custom_html', 
			'widget_nav_menu', 
			'widget_custom-divider', 
			'widget_custom-facebook', 
			'widget_custom-flickr', 
			'widget_media_image', 
			'widget_custom-latest-projects', 
			'widget_meta', 
			'widget_pages',
			'widget_custom-most-popular-posts', 
			'widget_custom-popular-projects', 
			'widget_custom-posts-tabs', 
			'widget_recent-comments', 
			'widget_recent-posts', 
			'widget_rss', 
			'widget_search', 
			'widget_tag_cloud', 
			'widget_text', 
			'widget_custom-twitter', 
			'widget_media_video', 
			'widget_layerslider_widget',  
			'widget_rev-slider-widget', 
			'widget_icl_lang_sel_widget' 
		);
		
		
		$cmsmasters_global_colors = array();
		
		
		foreach (schule_all_color_schemes_list() as $key => $value) {
			$cmsmasters_global_colors[] = 'cmsmasters_options_' . 'schule' . CMSMASTERS_THEME_STYLE . '_color_' . $key;
		}
		
		
		$cmsmasters_global_settings = apply_filters('cmsmasters_settings_export_filter', $cmsmasters_global_settings);
		
		
		$options = array_merge($cmsmasters_global_settings, $cmsmasters_global_colors, $wp_global_settings);
		
		
		$settings = array();
		
		
		foreach ($options as $option) {
			if (get_option($option)) {
				$settings[$option] = get_option($option);
			}
		}
		
		
		$result = bin2hex(json_encode($settings));
		
		
		echo schule_return_content($result);
		
		
		wp_die();
	} else { 
		die('Stop!'); 
	}
}

add_action('wp_ajax_cmsmasters_ajax_export_settings', 'cmsmasters_ajax_export_settings_callback');

add_action('wp_ajax_nopriv_cmsmasters_ajax_export_settings', 'cmsmasters_ajax_export_settings_callback');

/* Check Img Args */
function cmsmasters_check_img_agrs( $attachment_id, $args = array( 'title' => '', 'alt' => '' ) ) {
	$attachment = get_post( $attachment_id );

	if ( ! $attachment || 'attachment' !== $attachment->post_type ) {
		return $args;
	}

	$new_args = array(
		'title' => $attachment->post_title,
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
	);

	foreach ( $new_args as $key => $value ) {
		if ( ! empty( $value ) ) {
			$args[ $key ] = $value;
		}
	}

	return $args;
}
