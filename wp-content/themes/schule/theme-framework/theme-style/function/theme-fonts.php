<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.1
 * 
 * Theme Fonts Rules
 * Created by CMSMasters
 * 
 */


function schule_theme_fonts() {
	$cmsmasters_option = schule_get_global_options();
	
	
	$custom_css = "/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.1
 * 
 * Theme Fonts Rules
 * Created by CMSMasters
 * 
 */


/***************** Start Theme Font Styles ******************/

	/* Start Content Font */
	body,
	.cmsmasters_post_default .cmsmasters_post_cont_info, 
	.cmsmasters_post_default .cmsmasters_post_cont_info a, 	
	table tbody tr th,
	table tbody tr td,
	.cmsmasters-form-builder .check_parent input[type=checkbox] + label,
	.cmsmasters-form-builder .check_parent input[type=radio] + label,	
	.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_subtitle,
	.cmsmasters_project_grid .cmsmasters_project_content *,
	.cmsmasters_open_profile .cmsmasters_profile_header .cmsmasters_profile_subtitle,
	.cmsmasters_post_masonry .cmsmasters_post_content p,
	.share_posts a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_content_font_google_font']) . $cmsmasters_option['schule' . '_content_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_content_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_content_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_content_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_content_font_font_style'] . ";
	}
	
	.cmsmasters_likes a:before, 
	.cmsmasters_comments a:before {
		font-size:" . ((int) $cmsmasters_option['schule' . '_content_font_font_size'] - 4) . "px;
	}
	
	.cmsmasters_slider_post_content p,
	.cmsmasters_project_grid .cmsmasters_project_content *,
	.cmsmasters_post_masonry .cmsmasters_post_content p {
		font-size:" . ((int) $cmsmasters_option['schule' . '_content_font_font_size'] - 1) . "px;
	}
	
	.header_top .meta_wrap,
	.header_top .meta_wrap *,
	.widget_recent_entries .post-date,
	.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_subtitle {
		font-size:" . ((int) $cmsmasters_option['schule' . '_content_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_content_font_line_height'] - 2) . "px;
	}
	
	.footer .social_wrap a {
		width:" . ((int) $cmsmasters_option['schule' . '_content_font_line_height'] + 2) . "px;
		height:" . ((int) $cmsmasters_option['schule' . '_content_font_line_height'] + 2) . "px;
	}
	
	.cmsmasters_footer_small .footer_nav > li a,
	.cmsmasters_footer_small .footer_custom_html_wrap {
		line-height:" . ((int) $cmsmasters_option['schule' . '_content_font_line_height'] + 2) . "px;
	}
	
	.cmsmasters_icon_list_items li:before {
		line-height:" . $cmsmasters_option['schule' . '_content_font_line_height'] . "px;
	}
	
	.cmsmasters_likes a,
	.cmsmasters_comments a {
		font-style:" . $cmsmasters_option['schule' . '_content_font_font_style'] . ";
	}
	/* Finish Content Font */


	/* Start Link Font */
	a,	
	.cmsmasters_items_filter_wrap .cmsmasters_items_filter_list li a,
	.cmsmasters_items_filter_wrap .cmsmasters_items_sort_but,
	#wp-calendar tbody td,
	.widget_custom_contact_info_entries .widget_custom_contact_info_desc,
	.widget_custom_contact_info_entries .widget_custom_contact_info_desc *,
	.cmsmasters_project_grid .cmsmasters_project_cont_info *,
	.subpage_nav > span:not([class]),
	.cmsmasters_post_masonry .cmsmasters_post_category a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_link_font_google_font']) . $cmsmasters_option['schule' . '_link_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_link_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_link_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_link_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_link_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_link_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_link_font_text_decoration'] . ";
	}
	
	#wp-calendar tbody td,
	.cmsmasters_project_grid .cmsmasters_project_cont_info *,
	.cmsmasters_post_masonry .cmsmasters_post_category a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_link_font_font_size'] - 1) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_link_font_line_height'] - 1) . "px;
	}
	
	.widget_custom_contact_info_entries .widget_custom_contact_info_desc,
	.widget_custom_contact_info_entries .widget_custom_contact_info_desc *,
	.cmsmasters_slider_post .cmsmasters_slider_post_category a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_link_font_font_size'] - 1) . "px;
	}
	
	.cmsmasters_likes a,
	.cmsmasters_comments a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_link_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_link_font_line_height'] - 2) . "px;
	}
	
	.cmsmasters_comments a:before {
		font-size:" . $cmsmasters_option['schule' . '_link_font_font_size'] . "px;
	}
	
	.widget_nav_menu > div > ul > li ul > li > a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_link_font_font_size'] - 2) . "px;
	}
	
	.cmsmasters_slider_post .cmsmasters_slider_post_footer *,
	.cmsmasters_post_masonry .cmsmasters_post_meta_info *,
	.cmsmasters_open_post .cmsmasters_post_meta_info * {
		line-height:" . $cmsmasters_option['schule' . '_link_font_line_height'] . "px;
	}
	
	a:hover {
		text-decoration:" . $cmsmasters_option['schule' . '_link_hover_decoration'] . ";
	}
	/* Finish Link Font */


	/* Start Navigation Title Font */
	.navigation > li > a,
	.footer_nav > li > a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_nav_title_font_google_font']) . $cmsmasters_option['schule' . '_nav_title_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_nav_title_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_nav_title_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_nav_title_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_nav_title_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_nav_title_font_text_transform'] . ";
	}	
	
	@media only screen and (max-width: 1024px) {
		ul.top_line_nav > li > a,
		ul.top_line_nav ul li a {
			font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_nav_title_font_google_font']) . $cmsmasters_option['schule' . '_nav_title_font_system_font'] . ";
			font-size:" . ((int) $cmsmasters_option['schule' . '_nav_title_font_font_size'] - 2) . "px;
			line-height:" . $cmsmasters_option['schule' . '_nav_title_font_line_height'] . "px;
			font-weight:" . $cmsmasters_option['schule' . '_nav_title_font_font_weight'] . ";
			font-style:" . $cmsmasters_option['schule' . '_nav_title_font_font_style'] . ";
			text-transform:" . $cmsmasters_option['schule' . '_nav_title_font_text_transform'] . ";
		}
	}
	
	@media only screen and (max-width: 1024px) {
		#header .navigation .cmsmasters_resp_nav_toggle,
		#header nav > div > ul div.menu-item-mega-container > ul > li > a .cmsmasters_resp_nav_toggle {
			line-height:" . $cmsmasters_option['schule' . '_nav_title_font_line_height'] . "px;
			width:" . $cmsmasters_option['schule' . '_nav_title_font_line_height'] . "px;
			height:" . $cmsmasters_option['schule' . '_nav_title_font_line_height'] . "px;
		}
	}
	/* Finish Navigation Title Font */


	/* Start Navigation Dropdown Font */
	.navigation ul li a,
	.top_line_nav ul li a,
	.top_line_nav > li > a, 
	nav > div > ul div.menu-item-mega-container > ul > li > a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_nav_dropdown_font_google_font']) . $cmsmasters_option['schule' . '_nav_dropdown_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_nav_dropdown_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_nav_dropdown_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_nav_dropdown_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_nav_dropdown_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_nav_dropdown_font_text_transform'] . ";
	}

	.top_line_nav > li > a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_nav_dropdown_font_font_size'] - 1) . "px;
	}
	
	@media only screen and (max-width: 1024px) {
		#header .navigation ul li a .cmsmasters_resp_nav_toggle {
			line-height:" . $cmsmasters_option['schule' . '_nav_dropdown_font_line_height'] . "px;
			width:" . $cmsmasters_option['schule' . '_nav_dropdown_font_line_height'] . "px;
			height:" . $cmsmasters_option['schule' . '_nav_dropdown_font_line_height'] . "px;
		}
	}
	/* Finish Navigation Dropdown Font */


	/* Start H1 Font */
	h1,
	h1 a,
	.logo .title,
	.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner .cmsmasters_stat_counter_wrap,
		.cmsmasters_pricing_table .cmsmasters_price_wrap,
	.cmsmasters_profile_vertical .cmsmasters_profile_header .cmsmasters_profile_title,	
	.cmsmasters_post_timeline .cmsmasters_post_date .cmsmasters_day {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h1_font_google_font']) . $cmsmasters_option['schule' . '_h1_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h1_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h1_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h1_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h1_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h1_font_text_decoration'] . ";
	}

	@media screen and (max-width:540px) {
		.headline_text h1 {
			font-size:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] - 6) . "px;
			line-height:" . ((int) $cmsmasters_option['schule' . '_h1_font_line_height'] - 6) . "px;
		}
	}
	
	.cmsmasters_dropcap {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h1_font_google_font']) . $cmsmasters_option['schule' . '_h1_font_system_font'] . ";
		font-weight:" . $cmsmasters_option['schule' . '_h1_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h1_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h1_font_text_decoration'] . ";
	}	
	
	.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner .cmsmasters_stat_counter_wrap {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] - 10) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h1_font_line_height'] - 10) . "px;
	}
	
	.cmsmasters_icon_list_items.cmsmasters_icon_list_icon_type_number .cmsmasters_icon_list_item .cmsmasters_icon_list_icon:before,
	.cmsmasters_icon_box.box_icon_type_number:before,
	.cmsmasters_icon_box.cmsmasters_icon_heading_left.box_icon_type_number .icon_box_heading:before {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h1_font_google_font']) . $cmsmasters_option['schule' . '_h1_font_system_font'] . ";
		font-weight:" . $cmsmasters_option['schule' . '_h1_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h1_font_font_style'] . ";
	}
	
	.cmsmasters_dropcap.type1 {
		font-size:48px; /* static */
	}
	
	.cmsmasters_dropcap.type2 {
		font-size:36px; /* static */
	}
	
	.headline_outer .headline_inner .headline_icon:before {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] - 10) . "px;
		line-height:" . $cmsmasters_option['schule' . '_h1_font_line_height'] . "px;
		height:" . $cmsmasters_option['schule' . '_h1_font_line_height'] . "px;
	}
	
	.headline_outer .headline_inner.align_left .headline_icon,
	.headline_outer .headline_inner.align_left .headline_icon + .cmsmasters_breadcrumbs {
		padding-left:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] + 5) . "px;
	}
	
	.headline_outer .headline_inner.align_right .headline_icon,
	.headline_outer .headline_inner.align_right .headline_icon + .cmsmasters_breadcrumbs {
		padding-right:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] + 5) . "px;
	}
	
	.headline_outer .headline_inner.align_center .headline_icon {
		padding-left:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] + 5) . "px;
		margin-left:-" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] + 5) . "px;
	}
	.cmsmasters_pricing_table .cmsmasters_price_wrap {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] - 4) . "px;
	}

	.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_counter_wrap {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] + 6) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h1_font_line_height'] + 6) . "px;
	}
	/* Finish H1 Font */


	/* Start H2 Font */
	h2,
	h2 a,
	.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > a,
	.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_counter_wrap,
	.cmsmasters_profile_vertical .cmsmasters_profile_header .cmsmasters_profile_title a,
	.cmsmasters_open_profile .cmsmasters_profile_header .cmsmasters_profile_title,
	.cmsmasters_open_project .cmsmasters_project_header *,
	.cmsmasters_post_default .cmsmasters_post_header .cmsmasters_post_title a,
	.cmsmasters_open_post .cmsmasters_post_header .cmsmasters_post_title,
	.cmsmasters_post_default .cmsmasters_post_header .entry-title,
	.cmsmasters_archive_type .cmsmasters_archive_item_title,
	.cmsmasters_archive_type .cmsmasters_archive_item_title a, 
	.fullwidth .cmsmasters_post_default .cmsmasters_post_header .cmsmasters_post_title a,
	.fullwidth .cmsmasters_post_timeline .cmsmasters_post_header *,
	.cmsmasters_post_timeline .cmsmasters_post_header * {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h2_font_google_font']) . $cmsmasters_option['schule' . '_h2_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h2_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h2_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h2_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h2_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h2_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h2_font_text_decoration'] . ";
	}

	
	.fullwidth .cmsmasters_post_default .cmsmasters_post_header .cmsmasters_post_title a,
	.fullwidth .cmsmasters_post_timeline .cmsmasters_post_header * {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h2_font_font_size'] + 6) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h2_font_line_height'] + 10) . "px;
	}

	.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_counter_wrap {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h2_font_font_size'] + 4) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h2_font_line_height'] + 4) . "px;
	}
	.cmsmasters_open_profile .cmsmasters_profile_header .cmsmasters_profile_title,
	.cmsmasters_open_project .cmsmasters_project_header *,
	.cmsmasters_post_default .cmsmasters_post_header *,
	.cmsmasters_open_post .cmsmasters_post_header .cmsmasters_post_title,
	.cmsmasters_post_timeline .cmsmasters_post_header *,
	.cmsmasters_post_default .cmsmasters_post_header .cmsmasters_post_title a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h2_font_font_size'] + 2) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h2_font_line_height'] + 2) . "px;
	}

	/* Finish H2 Font */


	/* Start H3 Font */
	h3,
	h3 a,
	.post_comments .post_comments_title,
	.cmsmasters_profile_horizontal .cmsmasters_profile_header .cmsmasters_profile_title a,
	.cmsmasters_pricing_item .cmsmasters_pricing_item_inner .pricing_title,
	.cmsmasters_icon_list_item_title {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h3_font_google_font']) . $cmsmasters_option['schule' . '_h3_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h3_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h3_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h3_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h3_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h3_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h3_font_text_decoration'] . ";
	}

	.bottom_inner .widgettitle {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h3_font_font_size'] - 2) . "px;
	}
	.cmsmasters_icon_list_item_title {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h3_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h3_font_line_height'] - 4) . "px;
	}
	/* Finish H3 Font */


	/* Start H4 Font */
	h4,
	h4 a,
	.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > ul > li > a,
	.cmsmasters_sitemap_wrap .cmsmasters_sitemap_category > li > a,
	.cmsmasters_toggles .cmsmasters_toggle_title a,
	.cmsmasters_slider_project_header *,
	.cmsmasters_quotes_slider .cmsmasters_quote_title,
	.tabs_mode_tab .cmsmasters_tabs_list_item a,
	.cmsmasters_project_puzzle .cmsmasters_project_header *,
	.cmsmasters_open_profile .profile_details_title,
	.cmsmasters_open_project .project_sidebar .project_details_title {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h4_font_google_font']) . $cmsmasters_option['schule' . '_h4_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h4_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h4_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h4_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h4_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h4_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h4_font_text_decoration'] . ";
	}

	.cmsmasters_slider_project_header *,
	.cmsmasters_project_puzzle .cmsmasters_project_header *,
	.cmsmasters_open_profile .profile_details_title,
	.cmsmasters_open_project .project_sidebar .project_details_title {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h4_font_font_size'] + 2) . "px;
	}
	/* Finish H4 Font */


	/* Start H5 Font */
	h5,
	h5 a,	
	.footer_nav > li a,	
	.cmsmasters_slider_post_header *,
	.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_title,
	.cmsmasters_stats .cmsmasters_stat_title,
	.tabs_mode_tour .cmsmasters_tabs_list_item a,
	.cmsmasters_project_grid .cmsmasters_project_header *,
	.sidebar .cmsmasters_slider_project_header *,
	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_tabs_list_item a,
	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_lpr_tabs_cont > a,
	.cmsmasters_post_masonry .cmsmasters_post_header *,
	.cmsmasters_post_timeline .cmsmasters_post_date .cmsmasters_mon_year,
	.cmsmasters_single_slider .cmsmasters_single_slider_item_inner *,
	.tribe-events-list-widget-content-wrap a,
	.tribe-events-list-widget-content-wrap .entry-title, 
	.post_nav > span a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h5_font_google_font']) . $cmsmasters_option['schule' . '_h5_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h5_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h5_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h5_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h5_font_text_decoration'] . ";
	}
	
	.error .error_subtitle {
		font-style:" . $cmsmasters_option['schule' . '_h5_font_font_style'] . ";
	}

	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_tabs_list_item a	 {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 4) . "px;
	}

	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_lpr_tabs_cont > a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h5_font_line_height'] - 4) . "px;
	}
	
	.cmsmasters_stats .cmsmasters_stat_title {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 3) . "px;
	}
	.tabs_mode_tour .cmsmasters_tabs_list_item a,
	.cmsmasters_post_timeline .cmsmasters_post_date .cmsmasters_mon_year {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 2) . "px;
	}
	
	@media only screen and (max-width: 768px) {
		.cmsmasters_archive_type .cmsmasters_archive_item_title,
		.cmsmasters_archive_type .cmsmasters_archive_item_title a, 
		.cmsmasters_post_default .cmsmasters_post_header .entry-title, 
		.fullwidth .cmsmasters_post_default .cmsmasters_post_header .cmsmasters_post_title a {
			font-size:" . $cmsmasters_option['schule' . '_h5_font_font_size'] . "px;
			line-height:" . $cmsmasters_option['schule' . '_h5_font_line_height'] . "px;
		}
	}
	/* Finish H5 Font */


	/* Start H6 Font */
	h6,
	h6 a,
	table thead tr th,
	table tfoot tr td,
	.cmsmasters-form-builder label,
	.wpcf7-form label,
	.wp-caption .wp-caption-text,
	.cmsmasters_img .cmsmasters_img_caption,	
	.cmsmasters_stats.stats_mode_bars .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner .cmsmasters_stat_counter_wrap,	
	.cmsmasters_gallery .cmsmasters_gallery_item.cmsmasters_caption figcaption,	
	.cmsmasters_twitter_wrap .published,
	.cmsmasters_pricing_table .cmsmasters_period,
	.cmsmasters_quotes_slider .cmsmasters_quote_site,
	.cmsmasters_quotes_slider .cmsmasters_quote_site a,
	.cmsmasters_quotes_grid .cmsmasters_quote_site,
	.cmsmasters_quotes_grid .cmsmasters_quote_site a,
	.cmsmasters_open_profile .profile_details_item_title,
	.cmsmasters_open_profile .profile_features_item_title,
	.cmsmasters_slider_post .cmsmasters_slider_post_cont_info,
	.cmsmasters_slider_post .cmsmasters_slider_post_cont_info *,
	.cmsmasters_slider_project .cmsmasters_slider_project_cont_info,
	.cmsmasters_slider_project .cmsmasters_slider_project_cont_info *,
	.cmsmasters_post_default .cmsmasters_post_read_more,
	.cmsmasters_post_default .cmsmasters_post_category a,
	.cmsmasters_post_default .cmsmasters_post_date,
	.cmsmasters_post_masonry .cmsmasters_post_read_more,
	.cmsmasters_post_masonry .cmsmasters_post_cont_info,
	.cmsmasters_post_masonry .cmsmasters_post_cont_info *,	
	.cmsmasters_post_timeline .cmsmasters_post_read_more,
	.cmsmasters_open_post .cmsmasters_post_cont_info,
	.cmsmasters_open_post .cmsmasters_post_cont_info *,
	.about_author .about_author_cont > a,
	.cmsmasters_comment_item .cmsmasters_comment_item_date,
	.cmsmasters_project_puzzle .cmsmasters_project_category,
	.cmsmasters_project_puzzle .cmsmasters_project_category *,
	.cmsmasters_archive_type .cmsmasters_archive_item_type,
	.cmsmasters_archive_type .cmsmasters_archive_item_info,
	.cmsmasters_archive_type .cmsmasters_archive_item_info *,
	.cmsmasters_open_project .project_details_item_title,
	.cmsmasters_open_project .project_features_item_title,
	#wp-calendar thead th,
	#wp-calendar caption,
	.widget_custom_contact_info_entries .widget_custom_contact_info_title,
	.widget_nav_menu > div > ul > li > a,
	.widget_custom_twitter_entries .tweet_time,
	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_tabs_list_item > a:before,
	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_lpr_tabs_cont > .published,
	.cmsmasters_breadcrumbs .cmsmasters_breadcrumbs_inner *,
	.cmsmasters_quotes_slider .cmsmasters_quote_subtitle,
	.cmsmasters_stat_wrap .cmsmasters_stat_subtitle,
	.cmsmasters_profile_header .cmsmasters_profile_subtitle,
	.cmsmasters_project_puzzle .cmsmasters_project_category a,
	input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	textarea,
	.cmsmasters_open_profile .profile_details_item_desc,
	.cmsmasters_open_project .project_sidebar .cmsmasters_project_date,
	.post_comments .cmsmasters_comment_item_title,
	.cmsmasters_comment_item .comment-edit-link,
	.commentlist .comment-reply-link,
	.tribe-events-list-widget-content-wrap .duration,
	.profile_details_item_desc a,
	.cmsmasters_post_timeline .cmsmasters_post_cont_info *,
	.project_details_item_desc a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h6_font_google_font']) . $cmsmasters_option['schule' . '_h6_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h6_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h6_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h6_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h6_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h6_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h6_font_text_decoration'] . ";
	}

	.cmsmasters_breadcrumbs .cmsmasters_breadcrumbs_inner *,
	.cmsmasters_stat_wrap .cmsmasters_stat_subtitle,
	.cmsmasters_profile_header .cmsmasters_profile_subtitle,
	.cmsmasters_pricing_table .cmsmasters_period,
	input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	textarea,
	.cmsmasters_open_profile .profile_details_item_title,
	.cmsmasters_open_profile .profile_details_item_desc,
	.tribe-events-list-widget-content-wrap .duration
	.profile_details_item_desc a,
	.cmsmasters_post_default .cmsmasters_post_date {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] + 1) . "px;
	}
	.cmsmasters_slider_post .cmsmasters_slider_post_read_more,
	.cmsmasters_slider_project .cmsmasters_slider_project_cont_info,
	.cmsmasters_slider_project .cmsmasters_slider_project_cont_info *,
	.cmsmasters_quotes_slider .cmsmasters_quote_subtitle,
	.cmsmasters_project_puzzle .cmsmasters_project_category a,
	.cmsmasters_post_masonry .cmsmasters_post_read_more,
	.cmsmasters_post_default .cmsmasters_post_read_more,
	.cmsmasters_post_default  .cmsmasters_post_category a,	
	.cmsmasters_post_timeline .cmsmasters_post_read_more,
	.post_comments .cmsmasters_comment_item_title,
	.cmsmasters_comment_item .cmsmasters_comment_item_date,
	.cmsmasters_comment_item .comment-edit-link,
	.commentlist .comment-reply-link,
	.cmsmasters_open_post .cmsmasters_post_cont_info *,
	.cmsmasters_post_timeline .cmsmasters_post_cont_info * {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] + 2) . "px;
	}
	
	.cmsmasters_open_profile .profile_details_item_desc,
	.cmsmasters_open_profile .profile_details_item_desc *,
	.cmsmasters_open_profile .profile_features_item_desc,
	.cmsmasters_open_profile .profile_features_item_desc *,
	.cmsmasters_post_timeline .cmsmasters_post_meta_info,
	.cmsmasters_post_timeline .cmsmasters_post_meta_info *,
	.cmsmasters_comment_item .cmsmasters_comment_item_cont_info .comment-edit-link,
	.cmsmasters_project_puzzle .cmsmasters_project_footer,
	.cmsmasters_project_puzzle .cmsmasters_project_footer *,
	.cmsmasters_open_project .project_details_item_desc,
	.cmsmasters_open_project .project_details_item_desc *,
	.cmsmasters_open_project .project_features_item_desc,
	.cmsmasters_open_project .project_features_item_desc *,
	.widget_custom_contact_info_entries .widget_custom_contact_info_desc,
	.widget_custom_contact_info_entries .widget_custom_contact_info_desc *,
	.widget_nav_menu > div > ul > li ul > li > a,
	.cmsmasters_quotes_grid .cmsmasters_quote_content {
		line-height:" . $cmsmasters_option['schule' . '_h6_font_line_height'] . "px;
	}
	
	.widget_custom_twitter_entries .tweet_time	{
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h6_font_line_height'] - 2) . "px;
	}
	.widget_custom_posts_tabs_entries .cmsmasters_tabs .cmsmasters_lpr_tabs_cont > .published 	{
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] - 1) . "px;
	}

	.cmsmasters_quotes_grid .cmsmasters_quote_content {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] + 3) . "px;
	}
	/* Finish H6 Font */


	/* Start Button Font */
	.cmsmasters_button, 
	.button, 
	input[type=submit], 
	input[type=button], 
	button,
	.cmsmasters_header_search_form button {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_button_font_google_font']) . $cmsmasters_option['schule' . '_button_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_button_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_button_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_button_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_button_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_button_font_text_transform'] . ";
	}
	
	.gform_wrapper .gform_footer input.button, 
	.gform_wrapper .gform_footer input[type=submit] {
		font-size:" . $cmsmasters_option['schule' . '_button_font_font_size'] . "px !important;
	}
	
	.cmsmasters_button.cmsmasters_but_icon_dark_bg, 
	.cmsmasters_button.cmsmasters_but_icon_light_bg, 
	.cmsmasters_button.cmsmasters_but_icon_divider, 
	.cmsmasters_button.cmsmasters_but_icon_inverse {
		padding-left:" . ((int) $cmsmasters_option['schule' . '_button_font_line_height'] + 20) . "px;
	}
	
	.cmsmasters_button.cmsmasters_but_icon_dark_bg:before, 
	.cmsmasters_button.cmsmasters_but_icon_light_bg:before, 
	.cmsmasters_button.cmsmasters_but_icon_divider:before, 
	.cmsmasters_button.cmsmasters_but_icon_inverse:before, 
	.cmsmasters_button.cmsmasters_but_icon_dark_bg:after, 
	.cmsmasters_button.cmsmasters_but_icon_light_bg:after, 
	.cmsmasters_button.cmsmasters_but_icon_divider:after, 
	.cmsmasters_button.cmsmasters_but_icon_inverse:after {
		width:" . $cmsmasters_option['schule' . '_button_font_line_height'] . "px;
	}
	/* Finish Button Font */


	/* Start Small Text Font */
	small, 
	form .formError .formErrorContent {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_small_font_google_font']) . $cmsmasters_option['schule' . '_small_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_small_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_small_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_small_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_small_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_small_font_text_transform'] . ";
	}
	
	.gform_wrapper .description, 
	.gform_wrapper .gfield_description, 
	.gform_wrapper .gsection_description, 
	.gform_wrapper .instruction {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_small_font_google_font']) . $cmsmasters_option['schule' . '_small_font_system_font'] . " !important;
		font-size:" . $cmsmasters_option['schule' . '_small_font_font_size'] . "px !important;
		line-height:" . $cmsmasters_option['schule' . '_small_font_line_height'] . "px !important;
	}
	/* Finish Small Text Font */


	/* Start Text Fields Font */		
	select,
	option {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_input_font_google_font']) . $cmsmasters_option['schule' . '_input_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_input_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_input_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_input_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_input_font_font_style'] . ";
	}
	
	.gform_wrapper input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	.gform_wrapper textarea, 
	.gform_wrapper select {
		font-size:" . $cmsmasters_option['schule' . '_input_font_font_size'] . "px !important;
	}
	/* Finish Text Fields Font */


	/* Start Blockquote Font */
	blockquote,
	.cmsmasters_quotes_slider .cmsmasters_quote_content {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_quote_font_google_font']) . $cmsmasters_option['schule' . '_quote_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_quote_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_quote_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_quote_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_quote_font_font_style'] . ";
	}
	
	
	q {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_quote_font_google_font']) . $cmsmasters_option['schule' . '_quote_font_system_font'] . ";
		font-weight:" . $cmsmasters_option['schule' . '_quote_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_quote_font_font_style'] . ";
	}
	/* Finish Blockquote Font */

/***************** Finish Theme Font Styles ******************/


";
	
	
	return apply_filters('schule_theme_fonts_filter', $custom_css);
}

