<?php
/**
 * @package		WordPress
 * @subpackage	Schule
 * @version		1.1.1
 *
 * Tribe Events Fonts Rules
 * Created by CMSMasters
 *
 */

function schule_tribe_events_fonts( $custom_css ) {
	$cmsmasters_option = schule_get_global_options();

	$cmsmasters_shortname = 'schule';
	$cmsmasters_event_title = '_h2';
	$cmsmasters_event_smaller_title = '_h3';
	$cmsmasters_event_meta = '_h6';
	$cmsmasters_single_title = '_h1';
	$cmsmasters_widget_title = '_h3';

	$custom_css .= "
/***************** Start Tribe Events Font Styles ******************/
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-list__event-description,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-list__event-description p,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-day__event-description,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-day__event-description p,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-month__multiday-event-bar-title,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-month__multiday-event-bar-title p,
	.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-description,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-week-grid__multiday-event-bar-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-single .tribe_events,
	.cmsmasters_tribe_events_views_v2 .tribe-events-single .tribe-events-single-event-description,
	.cmsmasters_tribe_events_views_v2 .tribe-events-single .tribe-events-single-event-description p {
		font-family:" . schule_get_google_font( $cmsmasters_option[ $cmsmasters_shortname . '_content_font_google_font' ] ) . $cmsmasters_option[ $cmsmasters_shortname . '_content_font_system_font' ] . ";
		font-size:" . $cmsmasters_option[ $cmsmasters_shortname . '_content_font_font_size' ] . "px;
		line-height:" . $cmsmasters_option[ $cmsmasters_shortname . '_content_font_line_height' ] . "px;
		font-weight:" . $cmsmasters_option[ $cmsmasters_shortname . '_content_font_font_weight' ] . ";
		font-style:" . $cmsmasters_option[ $cmsmasters_shortname . '_content_font_font_style' ] . ";
	}

	.cmsmasters_tribe_events_views_v2 .tribe-events-single *,
	.cmsmasters_tribe_events_views_v2 .tribe-events *,
	.cmsmasters_tribe_events_views_v2 .tribe-events-pro *,
	.tribe-events-calendar-month__calendar-event-tooltip * {
		font-family:" . schule_get_google_font( $cmsmasters_option[ $cmsmasters_shortname . '_content_font_google_font' ] ) . $cmsmasters_option[ $cmsmasters_shortname . '_content_font_system_font' ] . " !important;
	}

	.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-description {
		font-size:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . '_content_font_font_size' ] - 2 ) . "px;
		line-height:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . '_content_font_line_height' ] - 2 ) . "px;
	}

	.cmsmasters_tribe_events_views_v2 .tribe-events .tribe-events-calendar-month__multiday-event-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-events .tribe-events-pro-week-grid__multiday-event-wrapper {
		height:" . $cmsmasters_option[ $cmsmasters_shortname . '_content_font_line_height' ] . "px;
	}

	.cmsmasters_tribe_events_views_v2 .tribe-events-single .tribe-events-single-event-title {
		font-family:" . schule_get_google_font( $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_single_title . '_font_google_font' ] ) . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_single_title . '_font_system_font' ] . ";
		font-size:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_single_title . '_font_font_size' ] . "px;
		line-height:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_single_title . '_font_line_height' ] . "px;
		font-weight:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_single_title . '_font_font_weight' ] . ";
		font-style:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_single_title . '_font_font_style' ] . ";
		text-transform:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_single_title . '_font_text_transform' ] . ";
		text-decoration:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_single_title . '_font_text_decoration' ] . ";
	}

	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-list__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-list__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-day__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-day__event-title a,
	.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-single ul.tribe-related-events li .tribe-related-events-title {
		font-family:" . schule_get_google_font( $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_google_font' ] ) . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_system_font' ] . ";
		font-size:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_font_size' ] . "px;
		line-height:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_line_height' ] . "px;
		font-weight:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_font_weight' ] . ";
		font-style:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_font_style' ] . ";
		text-transform:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_text_transform' ] . ";
		text-decoration:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_text_decoration' ] . ";
	}

	.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-title {
		font-size:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_font_size' ] - 2 ) . "px;
		line-height:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_title . '_font_line_height' ] - 2 ) . "px;
	}

	
	@media only screen and (max-width: 540px) {
		.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-list__event-title,
		.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-list__event-title a,
		.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-day__event-title,
		.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-day__event-title a,
		.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-title,
		.cmsmasters_tribe_events_views_v2 .tribe-events-single ul.tribe-related-events li .tribe-related-events-title {
			font-family:" . schule_get_google_font( $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_google_font' ] ) . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_system_font' ] . ";
			font-size:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_font_size' ] . "px;
			line-height:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_line_height' ] . "px;
			font-weight:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_font_weight' ] . ";
			font-style:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_font_style' ] . ";
			text-transform:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_text_transform' ] . ";
			text-decoration:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_text_decoration' ] . ";
		}
	
		.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-title {
			font-size:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_font_size' ] - 2 ) . "px;
			line-height:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_line_height' ] - 2 ) . "px;
		}
	}

	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-summary__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-summary__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-photo__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-photo__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-calendar-month-mobile-events__mobile-event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-calendar-month-mobile-events__mobile-event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-calendar-month-mobile-events__mobile-event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-calendar-month-mobile-events__mobile-event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-title a {
		font-family:" . schule_get_google_font( $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_google_font' ] ) . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_system_font' ] . ";
		font-size:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_font_size' ] . "px;
		line-height:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_line_height' ] . "px;
		font-weight:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_font_weight' ] . ";
		font-style:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_font_style' ] . ";
		text-transform:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_text_transform' ] . ";
		text-decoration:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_text_decoration' ] . ";
	}

	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-map__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-map__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-calendar-month-mobile-events__mobile-event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-calendar-month-mobile-events__mobile-event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-calendar-month-mobile-events__mobile-event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-calendar-month-mobile-events__mobile-event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-title a {
		font-size:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_font_size' ] - 2 ) . "px;
		line-height:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_smaller_title . '_font_line_height' ] - 2 ) . "px;
	}

	.cmsmasters_tribe_events_views_v2 .cmsmasters_sidebar .widgettitle,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-countdown .tribe-events-widget-countdown__header-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__header-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__header-title {
		font-family:" . schule_get_google_font( $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_widget_title . '_font_google_font' ] ) . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_widget_title . '_font_system_font' ] . ";
		font-size:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_widget_title . '_font_font_size' ] . "px;
		line-height:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_widget_title . '_font_line_height' ] . "px;
		font-weight:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_widget_title . '_font_font_weight' ] . ";
		font-style:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_widget_title . '_font_font_style' ] . ";
		text-transform:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_widget_title . '_font_text_transform' ] . ";
		text-decoration:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_widget_title . '_font_text_decoration' ] . ";
	}

	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-list__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-list__event-venue,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-list__event-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-day__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-day__event-venue,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-calendar-day__event-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-photo__event-datetime,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-photo__event-venue,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-photo__event-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-summary__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-summary__event-venue,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-summary__event-cost,
	.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-datetime,
	.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-events-single .tribe-events-schedule,
	.cmsmasters_tribe_events_views_v2 .tribe-events-single .tribe-events-schedule *,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-header,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-venue,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-header,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-venue,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-calendar-month-mobile-events__mobile-event-datetime,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-calendar-month-mobile-events__mobile-event-datetime,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-countdown .tribe-events-widget-countdown__event-title,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-countdown .tribe-events-widget-countdown__event-title a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__venue-name,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__venue-name a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-venue a,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-organizer-title-wrapper a {
		font-family:" . schule_get_google_font( $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_google_font' ] ) . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_system_font' ] . ";
		font-size:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_font_size' ] . "px;
		line-height:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_line_height' ] . "px;
		font-weight:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_font_weight' ] . ";
		font-style:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_font_style' ] . ";
		text-transform:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_text_transform' ] . ";
		text-decoration:" . $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_text_decoration' ] . ";
	}

	.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-datetime,
	.tribe-events-calendar-month__calendar-event-tooltip .tribe-events-calendar-month__calendar-event-tooltip-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-map__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-map__event-venue,
	.cmsmasters_tribe_events_views_v2 .tribe-common .tribe-events-pro-map__event-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-venue,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-venue,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-cost,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-calendar-month-mobile-events__mobile-event-datetime,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-calendar-month-mobile-events__mobile-event-datetime,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-datetime-wrapper,
	.cmsmasters_tribe_events_views_v2 .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-datetime-wrapper {
		font-size:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_font_size' ] - 2 ) . "px;
		line-height:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . $cmsmasters_event_meta . '_font_line_height' ] - 2 ) . "px;
	}

	.cmsmasters_tribe_events_views_v2 .tribe-events .tribe-events-c-nav__next,
	.cmsmasters_tribe_events_views_v2 .tribe-events .tribe-events-c-nav__prev,
	.cmsmasters_tribe_events_views_v2 .tribe-events-pro .tribe-events-c-small-cta__link {
		font-family:" . schule_get_google_font( $cmsmasters_option[ $cmsmasters_shortname . '_button_font_google_font' ] ) . $cmsmasters_option[ $cmsmasters_shortname . '_button_font_system_font' ] . ";
		font-size:" . $cmsmasters_option[ $cmsmasters_shortname . '_button_font_font_size' ] . "px;
		line-height:" . $cmsmasters_option[ $cmsmasters_shortname . '_button_font_line_height' ] . "px;
		font-weight:" . $cmsmasters_option[ $cmsmasters_shortname . '_button_font_font_weight' ] . ";
		font-style:" . $cmsmasters_option[ $cmsmasters_shortname . '_button_font_font_style' ] . ";
		text-transform:" . $cmsmasters_option[ $cmsmasters_shortname . '_button_font_text_transform' ] . ";
	}

	.cmsmasters_tribe_events_views_v2 .tribe-events-pro .tribe-events-c-small-cta__link {
		font-size:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . '_button_font_font_size' ] - 2 ) . "px;
		line-height:" . ( (int) $cmsmasters_option[ $cmsmasters_shortname . '_button_font_line_height' ] - 2 ) . "px;
	}
/***************** Finish Tribe Events Font Styles ******************/
";

	return $custom_css;
}

add_filter( 'schule_theme_fonts_filter', 'schule_tribe_events_fonts' );
