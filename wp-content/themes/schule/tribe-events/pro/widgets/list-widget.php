<?php
/**
 * Events Pro List Widget Template
 * This is the template for the output of the events list widget.
 * All the items are turned on and off through the widget admin.
 * There is currently no default styling, which is highly needed.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/widgets/list-widget.php
 *
 * When the template is loaded, the following vars are set:
 *
 * @var string $start
 * @var string $end
 * @var string $venue
 * @var string $address
 * @var string $city
 * @var string $state
 * @var string $province
 * @var string $zip
 * @var string $country
 * @var string $phone
 * @var string $cost
 * @var array  $instance
 *
 * @package TribeEventsCalendarPro
 * 
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.0
 *
 */


if (!defined('ABSPATH')) {
	die('-1');
}


include(get_template_directory() . '/tribe-events/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/templates/pro/widgets/list-widget.php');