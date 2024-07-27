<?php
/**
 * Photo View Content
 * The content template for the photo view of events. This template is also used for
 * the response that is returned on photo view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/photo/content.php
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


include(get_template_directory() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/templates/pro/photo/content.php');