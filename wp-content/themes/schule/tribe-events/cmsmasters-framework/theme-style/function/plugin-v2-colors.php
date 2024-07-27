<?php
/**
 * @package		WordPress
 * @subpackage	Schule
 * @version		1.1.2
 *
 * Tribe Events Colors Rules
 * Created by CMSMasters
 *
 */

function schule_tribe_events_colors( $custom_css ) {
	$cmsmasters_option = schule_get_global_options();

	$cmsmasters_color_schemes = cmsmasters_color_schemes_list();

	foreach ( $cmsmasters_color_schemes as $scheme => $title ) {
		$rule = "html .cmsmasters_tribe_events_views_v2 " . ( ( 'default' !== $scheme ) ? ".cmsmasters_color_scheme_{$scheme}" : '' );
		$rule_skeleton = ( ( 'default' !== $scheme ) ? "html .cmsmasters_tribe_events_views_v2.cmsmasters_tribe_events_style_mode_skeleton .cmsmasters_color_scheme_{$scheme} " : '' );
		$hover_rule = ( ( 'default' !== $scheme ) ? "html #page.cmsmasters_tribe_events_views_v2 .cmsmasters_color_scheme_{$scheme} " : '' );

		$cmsmasters_shortname = 'schule';
		$cmsmasters_event_meta = '_color';

		$custom_css .= "
/***************** Start {$title} Tribe Events Color Scheme Rules ******************/
	{$rule} .tribe-events-calendar-list__event-description,
	{$rule} .tribe-events-calendar-list__event-venue,
	{$rule} .tribe-events-calendar-list__event-cost,
	{$rule} .tribe-events .tribe-events-calendar-latest-past__event-datetime-wrapper,
	{$rule} .tribe-events .tribe-events-calendar-latest-past__event-venue,
	{$rule} .tribe-events .tribe-events-calendar-latest-past__event-description,
	{$rule} .tribe-events .tribe-events-calendar-latest-past__event-cost,
	{$rule} .tribe-events-calendar-day__event-venue,
	{$rule} .tribe-events-calendar-day__event-cost,
	{$rule} .tribe-events-calendar-day__event-description,
	{$rule} .tribe-events-pro-photo__event-venue,
	{$rule} .tribe-events-pro-photo__event-cost,
	{$rule} .tribe-events-pro-summary__event-venue,
	{$rule} .tribe-events-pro-summary__event-cost,
	{$rule} .tribe-events-pro .tribe-events-pro-week-grid__events-time-tag,
	{$rule} .tribe-events-pro-map__event-venue,
	{$rule} .tribe-events-pro-map__event-cost,
	{$rule} .tribe-events-single .tribe-events-schedule .tribe-events-cost,
	{$rule} .tribe-events-single .tribe-events-single-event-description,
	{$rule} .tribe-events-single .tribe-events-event-meta .tribe-events-meta-group dd,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-datetime-wrapper,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-venue,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-cost,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-venue,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-cost,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-countdown .tribe-events-widget-countdown__number .tribe-events-widget-countdown__under,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-date-tag-month,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-datetime-wrapper,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-datetime-wrapper,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-date-tag-month,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-venue,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-cost-price,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-organizer-contact {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . $cmsmasters_event_meta ] ) . "
	}

	{$rule} .tribe-events .tribe-events-header__events-bar .tribe-events-c-events-bar__search-container .tribe-events-c-search__input-control input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	{$rule} .tribe-events .tribe-events-header__events-bar .tribe-events-c-events-bar__search-container .tribe-events-c-search__input-control input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]):focus {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . $cmsmasters_event_meta ] ) . "
	}

	{$rule} .tribe-events .tribe-events-header__events-bar .tribe-events-c-events-bar__search-container .tribe-events-c-search__input-control input::-webkit-input-placeholder {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . $cmsmasters_event_meta ] ) . "
	}
	
	{$rule} .tribe-events .tribe-events-header__events-bar .tribe-events-c-events-bar__search-container .tribe-events-c-search__input-control input:-moz-placeholder {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . $cmsmasters_event_meta ] ) . "
	}

	{$rule} .tribe-events .tribe-events-header__events-bar .tribe-events-c-events-bar__search-container .tribe-events-c-search__input-control input:focus::-webkit-input-placeholder {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . $cmsmasters_event_meta ] ) . "
	}
	
	{$rule} .tribe-events .tribe-events-header__events-bar .tribe-events-c-events-bar__search-container .tribe-events-c-search__input-control input:focus:-moz-placeholder {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . $cmsmasters_event_meta ] ) . "
	}
	
	{$rule} .tribe-events-pro-organizer__meta .tribe-events-pro-organizer__meta-row .tribe-events-pro-organizer__meta-email a,
	{$rule} .tribe-events-pro-venue__meta .tribe-events-pro-venue__meta-details .tribe-events-pro-venue__meta-address-details a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__venue-info-group--website a {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_link' ] ) . "
	}

	{$hover_rule} .tribe-events .tribe-events-c-nav__next:focus,
	{$hover_rule} .tribe-events .tribe-events-c-nav__next:hover,
	{$hover_rule} .tribe-events .tribe-events-c-nav__prev:focus,
	{$hover_rule} .tribe-events .tribe-events-c-nav__prev:hover,
	{$hover_rule} .tribe-events .tribe-events-header__top-bar .tribe-events-c-top-bar__datepicker > button:hover,
	{$hover_rule} .tribe-events-calendar-list__event-title a:hover,
	{$hover_rule} .tribe-events .tribe-events-calendar-latest-past__event-title a:hover,
	{$hover_rule} .tribe-events-calendar-day__event-title a:hover,
	{$hover_rule} .tribe-events-pro-photo__event-title a:hover,
	{$hover_rule} .tribe-events-pro-summary__event-title a:hover,
	{$hover_rule} .tribe-events-pro .tribe-events-c-small-cta__link:hover,
	{$hover_rule} #tribe-events-pg-template .tribe-events-back a:hover,
	{$hover_rule} #tribe-events-l-container .tribe-events-back a:hover,
	{$hover_rule} .tribe-events-single .tribe-events-event-meta.primary > div dd a:hover,
	{$hover_rule} .tribe-events-single .tribe-events-event-meta.secondary > div dd a:hover,
	{$hover_rule} .tribe-events-single ul.tribe-related-events li .tribe-related-events-title a:hover,
	{$hover_rule} .tribe-events-pro-organizer__meta .tribe-events-pro-organizer__meta-row .tribe-events-pro-organizer__meta-email a:hover,
	{$hover_rule} .tribe-events-pro-venue__meta .tribe-events-pro-venue__meta-details .tribe-events-pro-venue__meta-address-details a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-title a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-widget-events-week__view-more a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-mobile-events__event-title a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-widget-events-week__view-more a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-calendar-month-mobile-events__mobile-event-title a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-calendar-month-mobile-events__mobile-event-title a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-widget-events-month__view-more a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-widget-events-month__view-more a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-countdown .tribe-events-widget-countdown__event-title a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__venue-name a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__view-more a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-title a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__venue-info-group--website a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-title a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__view-more a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-venue a:hover,
	{$hover_rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-organizer-title-wrapper a:hover,
	{$hover_rule} .tribe-events .tribe-events-header__events-bar .tribe-events-c-events-bar__views .tribe-events-c-view-selector__content .tribe-events-c-view-selector__list-item:hover a,
	{$hover_rule} .tribe-events .tribe-events-header__events-bar .tribe-events-c-events-bar__views .tribe-events-c-view-selector__content .tribe-events-c-view-selector__list-item:focus a {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_hover' ] ) . "
	}
	
	{$rule} .tribe-events .tribe-events-c-top-bar__nav-link:hover,
	{$rule} .tribe-events .tribe-events-c-top-bar__nav-link:hover path {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_hover' ] ) . "
		" . cmsmasters_color_css( 'fill', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_hover' ] ) . "
	}

	{$rule} .tribe-events .tribe-events-c-nav__next,
	{$rule} .tribe-events .tribe-events-c-nav__prev,
	{$rule} .tribe-events .tribe-events-header__top-bar .tribe-events-c-top-bar__datepicker > button,
	{$rule} .tribe-events-calendar-list__month-separator-text,
	{$rule} .tribe-events-calendar-list__event-date-tag-weekday,
	{$rule} .tribe-events-calendar-list__event-date-tag-daynum,
	{$rule} .tribe-events-calendar-latest-past .tribe-events-calendar-latest-past__heading,
	{$rule} .tribe-events-calendar-latest-past .tribe-events-calendar-latest-past__event-date-tag-datetime > span,
	{$rule} .tribe-events .tribe-events-calendar-latest-past__event-title,
	{$rule} .tribe-events .tribe-events-calendar-latest-past__event-title a,
	{$rule} .tribe-events-calendar-day__type-separator-text,
	{$rule} .tribe-events-pro-photo__event-date-tag-month,
	{$rule} .tribe-events-pro-photo__event-date-tag-daynum,
	{$rule} .tribe-events-pro-summary__event-date-tag,
	{$rule} .tribe-events-pro-summary__event-title,
	{$rule} .tribe-events-pro-summary__event-title a,
	{$rule} .tribe-events-pro .tribe-events-pro-week-grid__header-column-weekday,
	{$rule} .tribe-events-pro .tribe-events-pro-week-grid__header-column-daynum,
	{$rule} .tribe-events-pro-map__event-date-tag-month,
	{$rule} .tribe-events-pro-map__event-date-tag-datetime,
	{$rule} .tribe-events-pro .tribe-events-c-small-cta__link,
	{$rule} #tribe-events-pg-template .tribe-events-back,
	{$rule} #tribe-events-pg-template .tribe-events-back a,
	{$rule} #tribe-events-l-container .tribe-events-back,
	{$rule} #tribe-events-l-container .tribe-events-back a,
	{$rule} .tribe-events-single .tribe-events-event-meta .tribe-events-single-section-title,
	{$rule} .tribe-events-single .tribe-events-event-meta .tribe-events-meta-group dt,
	{$rule} .cmsmasters_sidebar .widgettitle,
	{$rule} .tribe-events-pro-organizer__meta .tribe-events-pro-organizer__meta-title,
	{$rule} .tribe-events-pro-venue__meta .tribe-events-pro-venue__meta-title,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-day-selector__day-weekday,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-day-selector__day-daynum,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-title,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-title a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-pro-week-mobile-events__event-type-separator-text,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-widget-events-week__view-more,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-week .tribe-events-widget-events-week__view-more a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-day-selector__day-weekday,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-pro-week-day-selector__day-daynum,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-widget-events-week__view-more,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-shortcode-events-week .tribe-events-widget-events-week__view-more a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-c-top-bar__nav-list-date,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-calendar-month__header-row span,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-c-day-marker__date,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-widget-events-month__view-more,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-month .tribe-events-widget-events-month__view-more a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-c-top-bar__nav-list-date,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-calendar-month__header-row span,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-c-day-marker__date,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-widget-events-month__view-more,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-widget-events-shortcode-month .tribe-events-widget-events-month__view-more a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-countdown .tribe-events-widget-countdown__header-title,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-countdown .tribe-events-widget-countdown__event-title a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-countdown .tribe-events-widget-countdown__number,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__venue-name,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__venue-name a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-date-tag-daynum,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__venue-info-group,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__view-more,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__view-more a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-title,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-featured-venue .tribe-events-widget-featured-venue__event-title a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__header-title,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-date-tag-daynum,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-title,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-title a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__view-more a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-venue a,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-organizer-title-wrapper,
	{$rule} .tribe-events-widget.tribe-common.tribe-events.tribe-events-view--widget-events-list .tribe-events-widget-events-list__event-organizer-title-wrapper a {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_heading' ] ) . "
	}

	{$rule} .tribe-events-widget.tribe-events-widget-events-month .tribe-events-calendar-month__mobile-events-icon,
	{$rule} .tribe-events-widget.tribe-events-widget-events-shortcode-month .tribe-events-calendar-month__mobile-events-icon {
		" . cmsmasters_color_css( 'background-color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_heading' ] ) . "
	}

	{$rule} .tribe-events-pro .tribe-events-pro-map__event-card-button:hover,
	{$rule} .tribe-events-pro .tribe-events-pro-map__event-card-button:focus {
		" . cmsmasters_color_css( 'background-color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_alternate' ] ) . "
	}

	{$rule} .tribe-events .tribe-events-c-top-bar__nav-link,
	{$rule} .tribe-events .tribe-events-c-top-bar__nav-link path {
		" . cmsmasters_color_css( 'color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_border' ] ) . "
		" . cmsmasters_color_css( 'fill', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_border' ] ) . "
	}

	{$rule_skeleton} .tribe-events-c-view-selector__content,
	{$rule} .tribe-events-pro .tribe-events-pro-map__event-card-button,
	{$rule} .tribe-events-pro .tribe-events-pro-map__event-card-button:hover,
	{$rule} .tribe-events-pro .tribe-events-pro-map__event-card-button:focus {
		" . cmsmasters_color_css( 'border-color', $cmsmasters_option[ $cmsmasters_shortname . '_' . $scheme . '_border' ] ) . "
	}
/***************** Finish {$title} Tribe Events Color Scheme Rules ******************/

";
	}

	return $custom_css;
}

add_filter( 'schule_theme_colors_secondary_filter', 'schule_tribe_events_colors' );

