<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.3
 * 
 * Tribe Events Functions
 * Created by CMSMasters
 * 
 */


/* Theme colors for updating default options in The Events Calendar plugin. */
function schule_theme_color( $color ) {
	$cmsmasters_option = schule_get_global_options();

	$colors = array(
		'color' => $cmsmasters_option['schule_default_color'],
		'link' => $cmsmasters_option['schule_default_link'],
		'hover' => $cmsmasters_option['schule_default_hover'],
		'heading' => $cmsmasters_option['schule_default_heading'],
		'bg' => $cmsmasters_option['schule_default_bg'],
		'alternate' => $cmsmasters_option['schule_default_alternate'],
		'border' => $cmsmasters_option['schule_default_border'],
		'secondary' => $cmsmasters_option['schule_default_secondary'],
	);

	$color = $colors[ $color ];

	return $color;
}


function schule_hex_color( $color ) {
	$old_color = schule_theme_color( $color );

	if ( strpos( $old_color, '#' ) === 0 ) {
		return $old_color;
	}

	preg_match( '/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i', $old_color, $new_color );

	return sprintf( '#%02x%02x%02x', $new_color[1], $new_color[2], $new_color[3] );
}


/* Updating default options in The Events Calendar plugin. */
function schule_tribe_update_default_options() {
	if ( 'update' === get_option( 'cmsmasters_event_update_option' ) ) {
		return;
	}

	$option_name = 'tribe_customizer';
	$tribe_options = get_option( $option_name );

	$new_global_elements = array(
		'event_title_color' => schule_hex_color( 'heading' ),
		'event_date_time_color' => schule_hex_color( 'color' ),
		'link_color' => schule_hex_color( 'link' ),
		'background_color_choice' => 'transparent',
		'background_color' => 'transparent',
		'accent_color' => schule_hex_color( 'link' ),
		'map_pin' => '',
	);
	$global_elements = ( ! empty( $tribe_options['global_elements'] ) ? $tribe_options['global_elements'] : $new_global_elements );

	foreach ( $global_elements as $element => $value ) {
		if ( isset( $new_global_elements[ $element ] ) && $new_global_elements[ $element ] !== $global_elements ) {
			$tribe_options['global_elements'][ $element ] = $new_global_elements[ $element ];
		} else {
			add_option( $tribe_options['global_elements'], $tribe_options['global_elements'][ $element ] );
		}
	}

	$new_single_event = array(
		'post_title_color_choice' => 'general',
		'post_title_color' => schule_hex_color( 'heading' ),

	);
	$single_event = ( ! empty( $tribe_options['single_event'] ) ? $tribe_options['single_event'] : $new_single_event );

	foreach ( $single_event as $element => $value ) {
		if ( isset( $new_single_event[ $element ] ) && $new_single_event[ $element ] !== $single_event ) {
			$tribe_options['single_event'][ $element ] = $new_single_event[ $element ];
		} else {
			add_option( $tribe_options['single_event'], $tribe_options['single_event'][ $element ] );
		}
	}

	$new_tec_events_bar = array(
		'events_bar_text_color' => schule_hex_color( 'heading' ),
		'find_events_button_text_color' => schule_hex_color( 'bg' ),
		'events_bar_icon_color_choice' => 'default',
		'events_bar_icon_color' => schule_hex_color( 'heading' ),
		'find_events_button_color_choice' => 'custom',
		'find_events_button_color' => schule_hex_color( 'link' ),
		'events_bar_background_color_choice' => 'default',
		'events_bar_background_color' => schule_hex_color( 'bg' ),
		'view_selector_background_color_choice' => 'default',
		'view_selector_background_color' => schule_hex_color( 'bg' ),
		'events_bar_border_color_choice' => 'default',
		'events_bar_border_color' => schule_hex_color( 'border' ),
	);
	$tec_events_bar = ( ! empty( $tribe_options['tec_events_bar'] ) ? $tribe_options['tec_events_bar'] : $new_tec_events_bar );

	foreach ( $tec_events_bar as $element => $value ) {
		if ( isset( $new_tec_events_bar[ $element ] ) && $new_tec_events_bar[ $element ] !== $tec_events_bar ) {
			$tribe_options['tec_events_bar'][ $element ] = $new_tec_events_bar[ $element ];
		} else {
			add_option( $tribe_options['tec_events_bar'], $tribe_options['tec_events_bar'][ $element ] );
		}
	}

	$new_month_view = array(
		'days_of_week_color' => schule_hex_color( 'heading' ),
		'date_marker_color' => schule_hex_color( 'heading' ),
		'multiday_event_bar_color_choice' => 'default',
		'multiday_event_bar_color' => '#334aff',
		'grid_lines_color' => schule_hex_color( 'border' ),
		'grid_hover_color' => schule_hex_color( 'border' ),
		'grid_background_color_choice' => 'transparent',
		'grid_background_color' => schule_hex_color( 'color' ),
		'tooltip_background_color' => 'default',
	);
	$month_view = ( ! empty( $tribe_options['month_view'] ) ? $tribe_options['month_view'] : $new_month_view );

	foreach ( $month_view as $element => $value ) {
		if ( isset( $new_month_view[ $element ] ) && $new_month_view[ $element ] !== $month_view ) {
			$tribe_options['month_view'][ $element ] = $new_month_view[ $element ];
		} else {
			add_option( $tribe_options['month_view'], $tribe_options['month_view'][ $element ] );
		}
	}

	update_option( $option_name, $tribe_options );

	add_option( 'cmsmasters_event_update_option', 'update', '', 'yes' );
}

add_action( 'init', 'schule_tribe_update_default_options' );


/* The Events Calendar and related plugins: Add your own location for template file loading. */
function schule_tribe_additional_template_locations( string $file, string $template ) {
	$new_locations = array();

	if ( ! tribe_events_views_v2_is_enabled() ) {
		$new_locations['themes_root'] = trailingslashit( get_theme_root() ) . 'schule/tribe-events';
	}

	$new_locations['my_plugin'] = trailingslashit( plugin_dir_path( WP_PLUGIN_DIR ) ) . 'plugins/the-events-calendar/src/views';

	foreach ( $new_locations as $location ) {
		$new_file = trailingslashit( $location ) . $template;

		if ( file_exists( $new_file ) ) {
			return $new_file;
		}
	}

	return $file;
}

add_filter( 'tribe_events_template', 'schule_tribe_additional_template_locations', 10, 2 );


/* Load Parts */
if ( tribe_events_views_v2_is_enabled() ) {
	require_once( get_template_directory() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/function/plugin-v2-colors.php' );
	require_once( get_template_directory() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/function/plugin-v2-fonts.php' );
} else {
	require_once( get_template_directory() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/admin/plugin-settings.php' );
	require_once( get_template_directory() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/function/plugin-colors.php' );
	require_once( get_template_directory() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/function/plugin-fonts.php' );
}


/* Register CSS Styles and Scripts */
function schule_tribe_events_register_styles_scripts() {
	// Styles
	if ( tribe_events_views_v2_is_enabled() ) {
		wp_enqueue_style( 'schule-tribe-events-v2-style', get_template_directory_uri() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/plugin-v2-style.css', array(), '1.0.0', 'screen' );
	} else {
		wp_enqueue_style( 'schule-tribe-events-style', get_template_directory_uri() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/plugin-style.css', array(), '1.0.0', 'screen' );

		wp_enqueue_style( 'schule-tribe-events-adaptive', get_template_directory_uri() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/plugin-adaptive.css', array(), '1.0.0', 'screen' );

		if ( is_rtl() ) {
			wp_enqueue_style( 'schule-tribe-events-rtl', get_template_directory_uri() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/plugin-rtl.css', array(), '1.0.0', 'screen' );
		}
	}
}

add_action('wp_enqueue_scripts', 'schule_tribe_events_register_styles_scripts');


/* Replace Styles */
function schule_tribe_events_stylesheet_url() {
	if ( ! tribe_events_views_v2_is_enabled() ) {
		wp_deregister_style( 'tribe-events-calendar-style' );
		wp_deregister_style( 'tribe-events-full-calendar-style' );
		wp_deregister_style( 'tribe-events-admin-menu' );
		
		wp_enqueue_style( 'tribe-events-bootstrap-datepicker-css' );

		wp_deregister_style( 'tribe-events-views-v2-full' );
		wp_deregister_style( 'tribe-common-full-style' );
	}
}

add_action('wp_enqueue_scripts', 'schule_tribe_events_stylesheet_url', 100);


/* Replace Pro Styles */
function schule_tribe_events_pro_stylesheet_url() {
	if ( ! tribe_events_views_v2_is_enabled() ) {
		wp_deregister_style( 'tribe-events-calendar-pro-style' );
		wp_deregister_style( 'tribe-events-full-pro-calendar-style' );
		wp_deregister_style( 'widget-calendar-pro-style' );

		wp_deregister_style( 'tribe-events-pro-views-v2-full' );
	}
}

add_action('wp_enqueue_scripts', 'schule_tribe_events_pro_stylesheet_url', 100);


/* Replace Widget Styles */
function schule_tribe_events_pro_widget_calendar_stylesheet_url() {
	if ( ! tribe_events_views_v2_is_enabled() ) {
		return '';
	}
}

add_filter('tribe_events_pro_widget_calendar_stylesheet_url', 'schule_tribe_events_pro_widget_calendar_stylesheet_url');


/* Replace Responsive Styles */
function schule_tribe_events_mobile_breakpoint() {
	if ( ! tribe_events_views_v2_is_enabled() ) {
		return 768;
	}
}

add_filter('tribe_events_mobile_breakpoint', 'schule_tribe_events_mobile_breakpoint');


/* Events Archive, Venue and Organizer Layout */
function schule_tribe_events_layout($cmsmasters_layout) {
	if (
		tribe_events_views_v2_is_enabled() &&
		tribe_is_event_query() &&
		(
			is_archive() ||
			tribe_is_venue() ||
			tribe_is_organizer()
		)
	) {
		$cmsmasters_layout = 'fullwidth';
	}
	
	
	return $cmsmasters_layout;
}

add_filter('cmsmasters_theme_page_layout_filter', 'schule_tribe_events_layout');
