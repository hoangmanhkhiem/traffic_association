<?php
/**
 * @package 	WordPress
 * @subpackage 	schule
 * @version 	1.1.6
 * 
 * LearnPress Functions
 * Created by CMSMasters
 * 
 */


/* Load Parts for LearnPress Plugin */
require_once(get_template_directory() . '/learnpress/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/function/plugin-colors.php');
require_once(get_template_directory() . '/learnpress/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/function/plugin-fonts.php');


if (CMSMASTERS_CONTENT_COMPOSER && class_exists('Cmsmasters_Content_Composer')) {
	require_once(get_template_directory() . '/learnpress/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/cmsmasters-c-c/cmsmasters-c-c-plugin-functions.php');
	
	require_once(get_template_directory() . '/learnpress/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/cmsmasters-c-c/cmsmasters-c-c-plugin-shortcodes.php');
}


/* Register CSS Styles and Scripts */
function schule_learnpress_register_styles_scripts() {
	// Styles
	$depend_learnpress_style = array();
	
	if (LP()->settings->get('load_css') == 'yes' || LP()->settings->get('load_css') == '') {
		$depend_learnpress_style = array('learnpress');
	}

	wp_enqueue_style('schule-learnpress-style', get_template_directory_uri() . '/learnpress/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/plugin-style.css', $depend_learnpress_style, '1.0.1', 'screen');
	
	wp_enqueue_style('schule-learnpress-adaptive', get_template_directory_uri() . '/learnpress/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/plugin-adaptive.css', $depend_learnpress_style, '1.0.1', 'screen');
	
	
	if (is_rtl()) {
		wp_enqueue_style('schule-learnpress-rtl', get_template_directory_uri() . '/learnpress/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/plugin-rtl.css', $depend_learnpress_style, '1.0.1', 'screen');
	}
}

add_action('wp_enqueue_scripts', 'schule_learnpress_register_styles_scripts');


/* Fix Widgets Page */
function schule_fix_widget_page() {
	if (CMSMASTERS_TRIBE_EVENTS && is_admin() && get_current_screen()->base == "widgets") {
		wp_dequeue_script( 'tribe-select2');
		wp_deregister_script( 'tribe-select2' );
		wp_dequeue_script( 'lp-select2');
		wp_deregister_script( 'lp-select2' );
		wp_dequeue_script( 'rwmb-select2');
		wp_deregister_script( 'rwmb-select2' );
		wp_enqueue_style('select2', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css');
		wp_enqueue_script('select2', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.min.js', '', '', false);
	}
}

add_action('admin_enqueue_scripts', 'schule_fix_widget_page');


function schule_learnpress_headline_type_filter( $type ) {
	$pages = learn_press_static_page_ids();

	if ( is_page( $pages['profile'] ) ) {
		$type = 'disabled';
	}

	if ( is_singular( 'lp_course' ) ) {
		$type = 'disabled';
	}

	return $type;
}

add_filter( 'cmsmasters_headline_type', 'schule_learnpress_headline_type_filter' );


function schule_learnpress_remove_custom_meta_box() {
	remove_meta_box( 'cmsmasters_custom_meta_box', 'lp_course' , 'normal' );

	$pages = learn_press_static_page_ids();

	if ( $pages['profile'] == get_the_ID() ) {
		remove_meta_box( 'cmsmasters_custom_meta_box', null , 'normal' );
	}
}

add_action( 'add_meta_boxes' , 'schule_learnpress_remove_custom_meta_box', 99 );


function schule_learnpress_advanced_settings_filter( $settings ) {
	$cmsmasters_option = schule_get_global_options();

	foreach ( $settings as $index => $setting ) {
		if ( 'primary_color' === $setting['id'] ) {
			$settings[ $index ]['default'] = $cmsmasters_option['schule_default_link'];
			$settings[ $index ]['desc'] = sprintf( __( 'Default: %s', 'schule' ), '<code>' . $cmsmasters_option['schule_default_link'] . '</code>' );
		} elseif ( 'secondary_color' === $setting['id'] ) {
			$settings[ $index ]['default'] = $cmsmasters_option['schule_default_secondary'];
			$settings[ $index ]['desc'] = sprintf( __( 'Default: %s', 'schule' ), '<code>' . $cmsmasters_option['schule_default_secondary'] . '</code>' );
		}
	}

	return $settings;
}

add_filter( 'learn_press_advanced_settings', 'schule_learnpress_advanced_settings_filter' );


function schule_learnpress_print_custom_styles() {
	$cmsmasters_option = schule_get_global_options();
	$primary_color   = LP()->settings()->get( 'primary_color' );
	$secondary_color = LP()->settings()->get( 'secondary_color' );
	?>

	<style id="learn-press-custom-css">
		:root {
			--lp-primary-color: <?php echo ! empty( $primary_color ) ? $primary_color : $cmsmasters_option['schule_default_link']; ?>;
			--lp-secondary-color: <?php echo ! empty( $secondary_color ) ? $secondary_color : $cmsmasters_option['schule_default_secondary']; ?>;
		}
	</style>

	<?php
}

remove_action( 'wp_head', 'learn_press_print_custom_styles' );
add_action( 'wp_head', 'schule_learnpress_print_custom_styles' );


// Active LearnPress templates Override
add_filter( 'learn-press/override-templates', function(){ return true; } );
