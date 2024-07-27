<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * Tribe Events Colors Rules
 * Created by CMSMasters
 * 
 */


function schule_tribe_events_colors($custom_css) {
	$cmsmasters_option = schule_get_global_options();
	
	
	$cmsmasters_color_schemes = cmsmasters_color_schemes_list();
	
	
	foreach ($cmsmasters_color_schemes as $scheme => $title) {
		$rule = (($scheme != 'default') ? "html .cmsmasters_color_scheme_{$scheme} " : '');
		
		
		$custom_css .= "
/***************** Start {$title} Tribe Events Color Scheme Rules ******************/

	/* Start Main Content Font Color */	
	{$rule}#tribe-bar-views .button:hover,
	{$rule}table.tribe-events-calendar tbody td .tribe-events-month-event-title,
	{$rule}.tribe-events-organizer .tribe-events-event-meta a,
	{$rule}.tribe-events-venue .tribe-events-event-meta a,		
	{$rule}.tribe-events-venue-details a,
	{$rule}.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue a,
	{$rule}.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info a,
	{$rule}.datepicker .datepicker-switch:hover,
	{$rule}.datepicker .next:hover,
	{$rule}.datepicker .prev:hover {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_color']) . "
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}#tribe-bar-views .tribe-bar-views-list li.tribe-bar-active a,
	{$rule}#tribe-bar-views .tribe-bar-views-list li.tribe-bar-active a:hover,
	{$rule}#tribe-bar-views .tribe-bar-views-list li a:hover,
	{$rule}.tribe-events-list .tribe-events-event-meta .author > div:before,
	{$rule}.tribe-events-venue-details a:hover,
	{$rule}.cmsmasters_events_list_event_info .tribe-events-list-event-title a:hover,
	{$rule}.tribe-events-sub-nav li a:hover,
	{$rule}table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-] a:hover,
	{$rule}.tribe-events-photo .tribe-events-event-meta > div:before,
	{$rule}.cmsmasters_single_event .tribe-events-schedule > div:before,
	{$rule}.tribe-events-back a:hover,
	{$rule}.tribe-events-cal-links a:hover,
	{$rule}.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item a:hover,
	{$rule}.tribe-related-event-info a:hover,
	{$rule}.tribe-mini-calendar tbody .tribe-events-present a,
	{$rule}.tribe-mini-calendar tbody .tribe-events-present a:hover,
	{$rule}.tribe-mini-calendar tbody a:hover,
	{$rule}.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info a:hover,
	{$rule}.widget .vcalendar [class*=cmsmasters_theme_icon]:before,
	{$rule}.tribe-mini-calendar-list-wrapper [class*=cmsmasters_theme_icon]:before,
	{$rule}.tribe-venue-widget-wrapper .entry-title a:hover,
	{$rule}.type-tribe_events.tribe-event-featured .entry-title:before,
	{$rule}#tribe-bar-views .tribe-bar-views-list li:hover,
	{$rule}#tribe-bar-views .tribe-bar-views-list li.tribe-bar-active,
	{$rule}.tribe-this-week-events-widget .tribe-this-week-event .duration:before,
	{$rule}.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue:before,
	{$rule}.tribe-countdown-text a:hover,
	{$rule}.tribe-events-list .tribe-event-featured .tribe-events-list-event-title a,
	{$rule}.cmsmasters_sidebar .tribe-events-list-widget-content-wrap .tribe-events-read-more,
	{$rule}.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue a:hover,
	{$rule}.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .entry-title a:hover {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.tribe-mini-calendar tbody a:before,
	{$rule}.tribe-bar-submit .tribe-events-button,
	{$rule}.cmsmasters_tribe_img_date .cmsmasters_tribe_events_date .cmsmasters_tribe_events_date_month,
	{$rule}.tribe-events-calendar thead th,
	{$rule}table.tribe-events-calendar tbody td.tribe-events-present div[id*=tribe-events-daynum-] a,
	{$rule}.tribe-events-month-event-title:hover,
	{$rule}.tribe-events-grid .tribe-grid-header,	
	{$rule}.tribe-events-grid .tribe-week-event:hover .vevent .entry-title a,
	{$rule}.tribe-mini-calendar thead,
	{$rule}.tribe-mini-calendar .tribe-mini-calendar-nav,
	{$rule}.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .cmsmasters_event_date_mon,
	{$rule}.cmsmasters_venue_widget_mon,
	{$rule}.widget.tribe-this-week-events-widget .this-week-today .tribe-this-week-widget-header-date,
	{$rule}table.tribe-events-calendar tbody td.tribe-events-present div[id*=tribe-events-daynum-] {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_link']) . "
	}	
	
	{$rule}.tribe-events-grid .tribe-grid-body .tribe-event-featured.tribe-events-week-hourly-single,
	{$rule}.tribe-bar-submit .tribe-events-button,
	{$rule}.tribe-events-calendar thead th,
	{$rule}.tribe-mini-calendar thead td,
	{$rule}.tribe-mini-calendar .tribe-mini-calendar-nav td {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_' . $scheme . '_link']) . "
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */				
	{$rule}.tribe-events-organizer .cmsmasters_events_organizer_header_right a:hover,
	{$rule}.tribe-events-organizer .tribe-events-event-meta a:hover,
	{$rule}.tribe-events-venue .cmsmasters_events_venue_header_right a:hover,
	{$rule}.tribe-events-venue .tribe-events-event-meta a:hover,	
	{$rule}.tribe-mini-calendar tbody .tribe-events-othermonth,	
	{$rule}.event_hover,
	{$rule}#tribe-bar-views .tribe-bar-views-list li,
	{$rule}#tribe-bar-views .tribe-bar-views-list li a,
	{$rule}.tribe-events-list .tribe-events-day-time-slot > h5,
	{$rule}.tribe-events-past a,
	{$rule}.tribe-events-past .tribe-events-month-event-title a,
	{$rule}.duration .published,
	{$rule}.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item span,
	{$rule}.tribe-mini-calendar thead a:hover,
	{$rule}.tribe-mini-calendar tbody a,
	{$rule}.tribe-mini-calendar tbody span,
	{$rule}.cmsmasters_tribe_venue_widget_name_inner a:hover,
	{$rule}.tribe-this-week-events-widget .tribe-this-week-widget-header-date,
	{$rule}#tribe-events-content > .tribe-events-button:hover,
	{$rule}.tribe-events-past .type-tribe_events .entry-title a,
	{$rule}.fullwidth .tribe-events-calendar .tribe-events-past div {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}.tribe-events-grid .tribe-grid-body .tribe-event-featured.tribe-events-week-hourly-single:hover {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */		
	{$rule}.cmsmasters_single_event_meta dt,
	{$rule}.tribe-events-countdown-widget .tribe-countdown-time,
	{$rule}.tribe-events-notices, 
	{$rule}#tribe-events-content > .tribe-events-button,
	{$rule}#tribe-bar-views .button,
	{$rule}.tribe-events-list-event-description .tribe-events-read-more:hover,
	{$rule}.tribe-events-sub-nav li a,
	{$rule}.tribe-events-future a,
	{$rule}.tribe-events-back a,
	{$rule}.tribe-events-cal-links a,
	{$rule}.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item a,
	{$rule}.tribe-events-grid .tribe-week-event .vevent .entry-title a,	
	{$rule}.tribe-venue-widget-wrapper .entry-title a,
	{$rule}.tribe-this-week-events-widget .tribe-events-page-title,
	{$rule}.type-tribe_events .entry-title a,
	{$rule}.tribe-events-list .tribe-event-featured .tribe-events-list-event-title a:hover,
	{$rule}.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-colon,
	{$rule}.tribe-countdown-text a,
	{$rule}.tribe-events-countdown-widget .tribe-countdown-time span,
	{$rule}.cmsmasters_sidebar .tribe-events-list-widget-content-wrap .tribe-events-read-more:hover,
	{$rule}.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .entry-title a {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_heading']) . "
	}
	
	
	{$rule}.tribe-mini-calendar tbody .tribe-mini-calendar-today a:before {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_heading']) . "
	}

	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$rule}table.tribe-events-calendar thead th,
	{$rule}table.tribe-events-calendar tbody td.tribe-events-present div[id*=tribe-events-daynum-],
	{$rule}table.tribe-events-calendar tbody td.tribe-events-present div[id*=tribe-events-daynum-] a,
	{$rule}table.tribe-events-calendar tbody td.tribe-events-present div[id*=tribe-events-daynum-] a:hover,
	{$rule}.tribe-events-grid .tribe-grid-header a:hover span,
	{$rule}.tribe-events-grid .tribe-grid-header span,	
	{$rule}.tribe-events-grid .tribe-week-event:hover .vevent .entry-title a,
	{$rule}.tribe-mini-calendar thead,	
	{$rule}.tribe-this-week-events-widget .this-week-today .tribe-this-week-widget-header-date,
	{$rule}.event_bg,
	{$rule}.datepicker .datepicker-switch,
	{$rule}.datepicker .next,
	{$rule}.datepicker .prev {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}#tribe-bar-views .button,
	{$rule}#tribe-bar-views .button:hover,
	{$rule}#tribe-bar-views.tribe-bar-views-open .button,
	{$rule}table.tribe-events-calendar tbody td.tribe-events-othermonth div[id*=tribe-events-daynum-],
	{$rule}#tribe-events-content-wrapper #tribe-events-content table.tribe-events-calendar .type-tribe_events.tribe-event-featured,	
	{$rule}.tribe-events-grid .tribe-scroller,
	{$rule}.tribe-events-grid .tribe-week-grid-hours,
	{$rule}.widget.tribe-events-list-widget .tribe-event-featured,
	{$rule}.widget.tribe-events-adv-list-widget .tribe-event-featured .tribe-mini-calendar-event,
	{$rule}.widget .tribe-mini-calendar-list-wrapper .tribe-event-featured,
	{$rule}.tribe-mini-calendar,	
	{$rule}.widget.tribe-events-venue-widget .tribe-event-featured,
	{$rule}.widget.tribe-this-week-events-widget .tribe-this-week-event,
	{$rule}.tribe-events-venue .tribe-events-list .tribe-events-loop .tribe-event-featured,
	{$rule}.tribe-events-organizer .tribe-events-list .tribe-events-loop .tribe-event-featured,
	{$rule}.tribe-events-grid .tribe-grid-body .tribe-event-featured.tribe-events-week-hourly-single,
	{$rule}#tribe-events-content-wrapper .tribe-events-list .tribe-events-loop .tribe-event-featured,
	{$rule}#tribe-events-content-wrapper .tribe-events-list #tribe-events-day.tribe-events-loop .tribe-event-featured,
	{$rule}#tribe-events-content-wrapper .type-tribe_events.tribe-events-photo-event.tribe-event-featured .tribe-events-photo-event-wrap,
	{$rule}#tribe-events-content-wrapper .type-tribe_events.tribe-events-photo-event.tribe-event-featured .tribe-events-photo-event-wrap:hover,
	{$rule}table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-],
	{$rule}.tribe-events-grid .tribe-week-event .vevent .entry-title a {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.tribe-events-grid .tribe-grid-header a:hover,
	{$rule}.tribe-events-grid .tribe-grid-header .tribe-week-today {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['schule' . '_' . $scheme . '_bg']) . ", .1);
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */	
	{$rule}.tribe-events-venue-widget .tribe-venue-widget-venue,
	{$rule}.tribe-events-notices,
	{$rule}.tribe-events-tooltip {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_alternate']) . "
	}

	{$rule}.cmsmasters_tribe_img_date .cmsmasters_tribe_events_date .cmsmasters_tribe_events_date_month,
	{$rule}.cmsmasters_tribe_img_date .cmsmasters_tribe_events_date .cmsmasters_tribe_events_date_day,
	{$rule}.tribe-events-month-event-title a:hover,
	{$rule}.tribe-mini-calendar thead a,
	{$rule}.cmsmasters_event_date_mon,
	{$rule}.cmsmasters_event_date_day,
	{$rule}.tribe-events-venue-widget .cmsmasters_tribe_venue_widget_name_inner:before,
	{$rule}.cmsmasters_tribe_venue_widget_name_inner a,
	{$rule}.cmsmasters_venue_widget_date span,
	{$rule}.tribe-events-past .type-tribe_events .entry-title a:hover {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_alternate']) . "
	}
	
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	{$rule}.tribe-events-single .post_nav:before,
	{$rule}.tribe-events-single .post_nav:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.tribe-events-list .tribe-events-list-separator-month,
	{$rule}.tribe-events-list .tribe-events-day-time-slot > h5,
	{$rule}table.tribe-events-calendar tbody td,
	{$rule}table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-],
	{$rule}.tribe-events-tooltip,
	{$rule}.tribe-events-grid .tribe-scroller,
	{$rule}.tribe-events-grid .tribe-week-grid-block div,
	{$rule}.tribe-events-grid .tribe-grid-allday,
	{$rule}.tribe-events-grid .tribe-grid-content-wrap .column,
	{$rule}.tribe-events-grid .tribe-week-grid-hours div,
	{$rule}.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item,
	{$rule}#tribe-events-footer {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_' . $scheme . '_border']) . "
	}
	
	{$rule}table.tribe-events-calendar tbody td .tribe_events {
		border-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['schule' . '_' . $scheme . '_border']) . ", .3);
	}
	/* Finish Borders Color */
	
	
	/* Start Secondary Color */
	{$rule}.tribe-events-back,	
	{$rule}.tribe-events-cal-links,			
	{$rule}.tribe-events-organizer .cmsmasters_events_organizer_header_right,
	{$rule}.tribe-events-organizer .cmsmasters_events_organizer_header_right a,
	{$rule}.tribe-events-venue .cmsmasters_events_venue_header_right,
	{$rule}.tribe-events-venue .cmsmasters_events_venue_header_right a,		
	{$rule}.tribe-mini-calendar tbody .tribe-events-present,	
	{$rule}.tribe-mobile-day .tribe-mobile-day-date {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_secondary']) . "
	}
	
			
	{$rule}.cmsmasters_tribe_img_date .cmsmasters_tribe_events_date,
	{$rule}.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .cmsmasters_event_date_day,
	{$rule}.tribe-events-venue-widget .cmsmasters_tribe_venue_widget_name_inner,
	{$rule}.datepicker.dropdown-menu table tr td span.active,
	{$rule}.datepicker.dropdown-menu table tr td span.active:active, 
	{$rule}.datepicker.dropdown-menu table tr td span.active:hover, 
	{$rule}.datepicker.dropdown-menu table tr td span.active:hover.active,
	{$rule}.datepicker.dropdown-menu table tr td span.active.active,
	{$rule}.datepicker.dropdown-menu table tr td.active,
	{$rule}.datepicker.dropdown-menu table tr td.active:active, 
	{$rule}.datepicker.dropdown-menu table tr td.active:hover, 
	{$rule}.datepicker.dropdown-menu table tr td.active:hover.active,
	{$rule}.datepicker.dropdown-menu table tr td.active.active,
	{$rule}.cmsmasters_venue_widget_day {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_secondary']) . "
	}
	/* Finish Secondary Color */

/***************** Finish {$title} Tribe Events Color Scheme Rules ******************/

";
	}
	
	
	return $custom_css;
}

add_filter('schule_theme_colors_secondary_filter', 'schule_tribe_events_colors');

