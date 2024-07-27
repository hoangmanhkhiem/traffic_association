<?php
/**
 * LearnPress Wishlist Functions
 *
 * Define common functions for both front-end and back-end
 *
 * @author   ThimPress
 * @package  LearnPress/Wishlist/Functions
 * @version  3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'learn_press_course_wishlist_template' ) ) {
	/**
	 * Get wishlist template.
	 *
	 * @param string $name
	 * @param array $args
	 * @deprecated 4.0.5
	 */
	function learn_press_course_wishlist_template( $name, $args = [] ) {
		//_deprecated_function( __FUNCTION__, '4.0.5', 'LP_Addon_Wishlist_Preload::$addon->get_template' );
		LP_Addon_Wishlist_Preload::$addon->get_template( $name, $args );
		//learn_press_get_template( $name, $args, learn_press_template_path() . '/addons/wishlist/', LP_ADDON_WISHLIST_TEMPLATE );
	}
}

if ( ! function_exists( 'learn_press_wishlist_get_template' ) ) {
	/**
	 * Get template.
	 *
	 * @param      $name
	 * @param null $args
	 * @deprecated 4.0.5
	 */
	function learn_press_wishlist_get_template( $name, $args = null ) {
		//_deprecated_function( __FUNCTION__, '4.0.5', 'LP_Addon_Wishlist_Preload::$addon->get_template' );
		learn_press_get_template( $name, $args, learn_press_template_path() . '/addons/wishlist/', LP_ADDON_WISHLIST_PATH . '/templates/' );
	}
}

add_action( 'learn_press_wishlist_loop_item_title', 'learn_press_wishlist_loop_item_title', 5 );

if ( ! function_exists( 'learn_press_wishlist_loop_item_title' ) ) {
	/**
	 * Loop item title.
	 */
	function learn_press_wishlist_loop_item_title() {
		LP_Addon_Wishlist_Preload::$addon->get_template( 'loop/title.php' );
	}
}

if ( ! function_exists( 'learn_press_user_wishlist_has_course' ) ) {
	/**
	 * Check user has course in wishlist.
	 *
	 * @param null $course_id
	 * @param null $user_id
	 *
	 * @return bool
	 */
	function learn_press_user_wishlist_has_course( $course_id = null, $user_id = null ) {
		if ( ! $course_id ) {
			$course_id = get_the_ID();
		}

		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}

		$wish_list = (array) get_user_meta( $user_id, '_lpr_wish_list', true );

		return in_array( $course_id, $wish_list );
	}
}

add_action( 'learn_press_after_take_course', 'learn_press_update_wish_list', 10, 2 );
if ( ! function_exists( 'learn_press_update_wish_list' ) ) {
	/**
	 * Update user's wishlist.
	 *
	 * @param $user_id
	 * @param $course_id
	 */
	function learn_press_update_wish_list( $user_id, $course_id ) {
		if ( ! $user_id || ! $course_id ) {
			return;
		}
		$wish_list = get_user_meta( $user_id, '_lpr_wish_list', true );
		if ( ! $wish_list ) {
			$wish_list = array();
		}
		$key = array_search( $course_id, $wish_list );
		if ( $key !== false ) {
			unset( $wish_list[ $key ] );
		}
		update_user_meta( $user_id, '_lpr_wish_list', $wish_list );
	}
}

if ( ! function_exists( 'learn_press_buddypress_is_active' ) ) {
	/**
	 * Check BuddyPress active.
	 *
	 * @return bool
	 */
	function learn_press_buddypress_is_active() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		return class_exists( 'BuddyPress' ) && is_plugin_active( 'buddypress/bp-loader.php' );
	}
}

if ( learn_press_buddypress_is_active() ) {

	/*
	 * Set up sub admin bar wishlist.
	 */
	add_filter( 'learn_press_bp_courses_bar', 'learn_press_bp_courses_bar_wishlist', 20 );
	function learn_press_bp_courses_bar_wishlist( $wp_admin_nav ) {

		$courses_slug = apply_filters( 'learn_press_bp_courses_slug', '' );
		$courses_link = learn_press_get_current_bp_link();

		$wp_admin_nav[] = array(
			'parent' => 'my-account-' . $courses_slug,
			'id'     => 'my-account-' . $courses_slug . '-wishlist',
			'title'  => __( 'Wishlist', 'learnpress_wishlist' ),
			'href'   => trailingslashit( $courses_link . 'wishlist' ),
		);

		return $wp_admin_nav;
	}

	/*
	 * Setup sub navigation wishlist.
	 */
	if ( bp_is_my_profile() || current_user_can( 'manage_options' ) ) {
		add_filter( 'learn_press_bp_courses_sub_navs', 'learn_press_bp_courses_nav_wishlist' );

		function learn_press_bp_courses_nav_wishlist( $sub_navs ) {
			$nav_wishlist = array(
				'name'                    => __( 'Wishlist', 'learnpress_wishlist' ),
				'slug'                    => 'wishlist',
				'show_for_displayed_user' => false,
				'position'                => 10,
				'screen_function'         => 'learn_press_bp_courses_wishlist',
				'parent_url'              => learn_press_get_current_bp_link(),
				'parent_slug'             => apply_filters( 'learn_press_bp_courses_slug', '' ),
			);
			array_push( $sub_navs, $nav_wishlist );

			return $sub_navs;
		}

		function learn_press_bp_courses_wishlist() {
			add_action( 'bp_template_title', 'learn_press_bp_courses_wishlist_title' );
			add_action( 'bp_template_content', 'learn_press_bp_courses_wishlist_content' );
			bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
		}

		/*
		 * Setup title of navigation all.
		 */
		function learn_press_bp_courses_wishlist_title() {
			echo __( 'Your wishlist', 'learnpress_wishlist' );
		}

		/*
		 * Setup content of navigation all.
		 */
		function learn_press_bp_courses_wishlist_content() {
			global $bp;
			echo apply_filters( 'learn_press_user_wishlist_tab_content', '', get_user_by( 'id', $bp->displayed_user->id ) );
		}
	}
}
