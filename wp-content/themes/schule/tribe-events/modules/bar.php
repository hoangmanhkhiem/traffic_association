<?php
/**
 * Events Navigation Bar Module Template
 * Renders our events navigation bar used across our views
 *
 * $filters and $views variables are loaded in and coming from
 * the show funcion in: lib/tribe-events-bar.class.php
 *
 * @package TribeEventsCalendar
 * 
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.0
 *
 */


if (!defined('ABSPATH')) {
	die('-1');
}


include(get_template_directory() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/templates/modules/bar.php');