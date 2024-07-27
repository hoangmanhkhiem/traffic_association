<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * Tribe Events Fonts Rules
 * Created by CMSMasters
 * 
 */


function schule_tribe_events_fonts($custom_css) {
	$cmsmasters_option = schule_get_global_options();
	
	
	$custom_css .= "
/***************** Start Tribe Events Font Styles ******************/

	/* Start Content Font */
	.tribe-mini-calendar tbody,	
	.tribe-this-week-events-widget .tribe-events-page-title,
	.cmsmasters_single_event .tribe-events-schedule,
	.cmsmasters_single_event .tribe-events-schedule a,
	.cmsmasters_sidebar .widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info,
	.cmsmasters_sidebar .tribe-events-list-widget-content-wrap .duration,
	.cmsmasters_sidebar .tribe-events-list-widget-content-wrap .tribe-events-read-more, 
	.vevent * {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_content_font_google_font']) . $cmsmasters_option['schule' . '_content_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_content_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_content_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_content_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_content_font_font_style'] . ";
	}
	
	.tribe-mini-calendar tbody {
		font-size:" . ((int) $cmsmasters_option['schule' . '_content_font_font_size'] - 1) . "px;
	}
	
	.vevent * {
		font-size:" . ((int) $cmsmasters_option['schule' . '_content_font_font_size'] - 1) . "px;
	}

	.tribe-this-week-events-widget .tribe-events-page-title {
		font-size:" . ((int) $cmsmasters_option['schule' . '_content_font_font_size'] - 2) . "px;
	}
	/* Finish Content Font */
	
	
	/* Start Link Font */
	/* Finish Link Font */
	
	
	/* Start H1 Font */		
	.tribe-events-organizer .cmsmasters_events_organizer_header_left .entry-title,
	.tribe-events-venue .cmsmasters_events_venue_header_left .entry-title,
	.tribe-events-countdown-widget .tribe-countdown-time {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h1_font_google_font']) . $cmsmasters_option['schule' . '_h1_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h1_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h1_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h1_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h1_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h1_font_text_decoration'] . ";
	}

	.tribe-events-countdown-widget .tribe-countdown-time {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] - 4) . "px;
	}
	/* Finish H1 Font */
	
	
	/* Start H2 Font */
	.tribe-events-list .tribe-events-list-event-title,		
	.tribe-mobile-day .tribe-mobile-day-date,
	.tribe-events-page-title,
	.cmsmasters_single_event .tribe-events-single-event-title {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h2_font_google_font']) . $cmsmasters_option['schule' . '_h2_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h2_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h2_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h2_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h2_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h2_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h2_font_text_decoration'] . ";
	}
	/* Finish H2 Font */
	
	
	/* Start H3 Font */

	.cmsmasters_tribe_events_date_day,
	.tribe-events-list .tribe-events-list-event-title a,
	.tribe-events-related-events-title,
	.tribe-mini-calendar-nav-link,
	.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .cmsmasters_event_date_day,
	.cmsmasters_venue_widget_day,
	.one_fourth .tribe-events-countdown-widget .tribe-countdown-time,
	.cmsmasters_sidebar .widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .entry-title a,
		.tribe-events-single-section-title,
	.three_fourth .cmsmasters_sidebar .widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .entry-title a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h3_font_google_font']) . $cmsmasters_option['schule' . '_h3_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h3_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h3_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h3_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h3_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h3_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h3_font_text_decoration'] . ";
	}
	/* Finish H3 Font */
	
	
	/* Start H4 Font */	
	.tribe-events-tooltip .entry-title,
	.tribe-events-photo .tribe-events-list-event-title,
	.tribe-events-photo .tribe-events-list-event-title a,
	.tribe-events-single-section-title {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h4_font_google_font']) . $cmsmasters_option['schule' . '_h4_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h4_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h4_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h4_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h4_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h4_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h4_font_text_decoration'] . ";
	}

	/* Finish H4 Font */
	
	
	/* Start H5 Font */
	#tribe-bar-views .tribe-bar-views-list li,	
	#tribe-events-content > .tribe-events-button,	
	.tribe-mini-calendar [id*=tribe-mini-calendar-month],
	.tribe-this-week-events-widget .tribe-events-viewmore a,	
	.tribe-events-widget-link a,
	#tribe-bar-views .button,
	.cmsmasters_tribe_events_date_month,
	.tribe-events-calendar thead th,
	ul.tribe-related-events .tribe-related-event-info *,
	.tribe-events-grid .tribe-grid-header span,
	.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .entry-title a,
	.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .entry-title,
	.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .cmsmasters_event_date_mon,
	.cmsmasters_venue_widget_mon,
	.tribe-events-venue-widget .vcalendar .cmsmasters_widget_event_info a,
	.tribe-events-venue-widget .vcalendar .cmsmasters_widget_event_info .entry-title,
	.tribe-countdown-text a,
	.one_fourth .tribe-countdown-text a,
	.one_fourth .cmsmasters_sidebar .widget .cmsmasters_widget_event_info .entry-title a,
	.tribe-events-month table tbody tr td a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h5_font_google_font']) . $cmsmasters_option['schule' . '_h5_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h5_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h5_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h5_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h5_font_text_decoration'] . ";
	} 

	#tribe-bar-views .button,
	.tribe-events-calendar thead th,
	.tribe-events-grid .tribe-grid-header span {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 2) . "px;
	}
	#tribe-events-content > .tribe-events-button {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 3) . "px;
	}
	
	.tribe-events-month table tbody tr td a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h5_font_line_height'] - 6) . "px;
	}
	.tribe-mini-calendar [id*=tribe-mini-calendar-month],
	.one_fourth .tribe-countdown-text a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 5) . "px;
	}
	.cmsmasters_tribe_events_date_month,
	.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info .cmsmasters_event_date_mon,
	.cmsmasters_venue_widget_mon {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 6) . "px;
	}
	/* Finish H5 Font */
	
	
	/* Start H6 Font */
	.tribe-bar-filters-inner > div label,
	.tribe-events-sub-nav li a,	
	.tribe-events-list .tribe-events-day-time-slot > h5,
	.tribe-events-list .tribe-events-read-more,	
	.tribe-events-photo .tribe-events-event-meta,
	.tribe-events-photo .tribe-events-event-meta a,
	table.tribe-events-calendar tbody td .tribe-events-viewmore a,
	.tribe-events-tooltip .duration,	
	.tribe-events-grid .column.first,
	.tribe-events-grid .tribe-week-grid-hours,	
	.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item span,
	.tribe-events-organizer .tribe-events-event-meta,
	.tribe-events-organizer .tribe-events-event-meta a,
	.tribe-events-venue .tribe-events-event-meta,
	.tribe-events-venue .tribe-events-event-meta a,
	.widget .vcalendar .cmsmasters_widget_event_info,	
	.widget .vcalendar .cmsmasters_widget_event_venue_info_loc .tribe-events-organizer *,
	.tribe-mini-calendar thead th,
	.tribe_mini_calendar_widget .tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info,
	.tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_venue_info_loc .tribe-events-organizer *,
	.tribe-events-venue-widget .tribe-venue-widget-venue-name a,
	.tribe-events-venue-widget .vcalendar .cmsmasters_widget_event_info,	
	.tribe-this-week-events-widget .tribe-this-week-event .duration,
	.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue,
	.tribe-mobile-day .tribe-events-event-schedule-details, 
	.tribe-mobile-day .tribe-event-schedule-details,
	#tribe-bar-views .tribe-bar-views-list li a,
	.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item a,
	.tribe-mini-calendar tbody a,
	.tribe-mini-calendar tbody span,
	.tribe-this-week-events-widget .tribe-this-week-widget-header-date,
	.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue a,
	.tribe-events-list-widget-content-wrap .tribe-events-venue a,
	.cmsmasters_sidebar .tribe-events-list-widget-content-wrap .tribe-events-venue a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h6_font_google_font']) . $cmsmasters_option['schule' . '_h6_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h6_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h6_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h6_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h6_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h6_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h6_font_text_decoration'] . ";
	}
	
	.cmsmasters_row .tribe-events-countdown-widget .tribe-countdown-time span {
		font-size:" . $cmsmasters_option['schule' . '_h6_font_font_size'] . "px;
	}

	#tribe-bar-views .tribe-bar-views-list li a,
	.tribe-events-list .tribe-events-day-time-slot > h5,
	.cmsmasters_sidebar .tribe-events-list-widget-content-wrap .tribe-events-venue a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] + 3) . "px;
	}
	
	.tribe-events-tooltip .duration,
	.tribe-events-countdown-widget .tribe-countdown-time span {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h6_font_line_height'] - 2) . "px;
	}

	.tribe-events-tooltip .duration {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] - 1) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h6_font_line_height'] - 1) . "px;
	}

	.tribe-events-list .tribe-events-read-more {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] + 2) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h6_font_line_height'] + 2) . "px;
	}
	
	.tribe-events-grid .column.first,
	.tribe-events-grid .tribe-week-grid-hours,
	.tribe-mini-calendar tbody a,
	.tribe-mini-calendar tbody span {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] - 3) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h6_font_line_height'] - 2) . "px;
	}

	.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item span,
	.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item a,
	.widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info,
	.tribe-this-week-events-widget .tribe-this-week-widget-header-date,
	.tribe-this-week-events-widget .tribe-this-week-event .duration,
	.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue a,
	.tribe-events-list-widget-content-wrap .tribe-events-venue a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] + 1) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h6_font_line_height'] + 1) . "px;
	}

	.tribe-mini-calendar thead th {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h6_font_line_height'] - 4) . "px;
	}
	
	.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item_title {
		margin-top:" . ($cmsmasters_option['schule' . '_content_font_line_height'] - $cmsmasters_option['schule' . '_h6_font_line_height']) / 2 . "px;
		margin-bottom:" . ($cmsmasters_option['schule' . '_content_font_line_height'] - $cmsmasters_option['schule' . '_h6_font_line_height']) / 2 . "px;
	}
	/* Finish H6 Font */
	
	
	/* Start Button Font */
	/* Finish Button Font */
	
	
	/* Start Small Text Font */
	table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-],
	table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-] a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_small_font_google_font']) . $cmsmasters_option['schule' . '_small_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_small_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_small_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_small_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_small_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_small_font_text_transform'] . ";
	}
	
	table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-],
	table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-] a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_small_font_font_size'] - 2) . "px;
	}
	/* Finish Small Text Font */

/***************** Finish Tribe Events Font Styles ******************/

";
	
	
	return $custom_css;
}

add_filter('schule_theme_fonts_filter', 'schule_tribe_events_fonts');

