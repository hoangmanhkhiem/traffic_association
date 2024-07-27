<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.1
 * 
 * Theme Secondary Color Schemes Rules
 * Created by CMSMasters
 * 
 */


function schule_theme_colors_secondary() {
	$cmsmasters_option = schule_get_global_options();
	
	
	$cmsmasters_color_schemes = cmsmasters_color_schemes_list();
	
	
	$custom_css = "/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.1
 * 
 * Theme Secondary Color Schemes Rules
 * Created by CMSMasters
 * 
 */


/***************** Start Header Middle Color Scheme Rules ******************/

	/* Start Header Middle Content Color */
	.header_mid,
	.header_mid input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	.header_mid textarea,
	.header_mid select,
	.header_mid option {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_mid_color']) . "
	}
	/* Finish Header Middle Content Color */
	
	
	/* Start Header Middle Primary Color */
	.header_mid a,
	.header_mid .button,
	.header_mid .cmsmasters_button,
	.cmsmasters_dynamic_cart .widget_shopping_cart_content .total,
	.cmsmasters_dynamic_cart .widget_shopping_cart_content .total strong,
	.cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_mid_link']) . "
	}
	
	.header_mid input[type=submit]:hover,
	.header_mid input[type=button]:hover,
	.header_mid button:hover,
	.header_mid .social_wrap li a,
	.header_mid .cmsmasters_button:hover,
	.header_mid .resp_mid_nav_wrap .resp_mid_nav > span,
	.header_mid .resp_mid_nav_wrap .resp_mid_nav > span:before,
	.header_mid .resp_mid_nav_wrap .resp_mid_nav > span:after,
	.header_mid .cmsmasters_dynamic_cart .cmsmasters_dynamic_cart_button .count,
	.header_mid .cmsmasters_header_cart_link .count,
	#page .cmsmasters_dynamic_cart .remove:hover:before,
	#page .cmsmasters_dynamic_cart .remove:hover:after,
	.cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button:hover {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_mid_link']) . "
	}
	
	.header_mid .button,
	.header_mid .cmsmasters_button,
	.header_mid .cmsmasters_button:hover,
	.cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button,
	.cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_header_mid_link']) . "
	}
	/* Finish Header Middle Primary Color */
	
	
	/* Start Header Middle Rollover Color */
	.header_mid a:hover,
	.header_mid .button:hover {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_mid_hover']) . "
	}
	
	.header_mid input[type=submit], 
	.header_mid input[type=button], 
	.header_mid button,
	.header_mid .social_wrap li a:hover,
	.header_mid .resp_mid_nav_wrap .resp_mid_nav:hover > span,
	.header_mid .resp_mid_nav_wrap .resp_mid_nav:hover > span:before,
	.header_mid .resp_mid_nav_wrap .resp_mid_nav:hover > span:after,
	#page .cmsmasters_dynamic_cart .remove:before,
	#page .cmsmasters_dynamic_cart .remove:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_mid_hover']) . "
	}
	
	.header_mid input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]):focus,
	.header_mid textarea:focus,
	.header_mid select:focus,
	.header_mid .button:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_header_mid_hover']) . "
	}
	/* Finish Header Middle Rollover Color */
	
	
	/* Start Header Middle Background Color */
	.header_mid input[type=submit],
	.header_mid input[type=button],
	.header_mid button,
	.header_mid input[type=submit]:hover,
	.header_mid input[type=button]:hover,
	.header_mid button:hover {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_mid_bg']) . "
	}
	
	.header_mid,
	.header_mid input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	.header_mid textarea,
	.header_mid select,
	.header_mid option,
	.header_mid .button,
	.header_mid .cmsmasters_button {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_mid_bg']) . "
	}
	/* Finish Header Middle Background Color */
	
	
	/* Start Header Middle Background Color on Scroll */
	.header_mid .social_wrap li a,
	.header_mid .cmsmasters_button:hover,
	.header_mid .cmsmasters_dynamic_cart .cmsmasters_dynamic_cart_button .count,
	.header_mid .cmsmasters_header_cart_link .count,
	.cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button:hover {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_mid_bg_scroll']) . "
	}
	
	.header_mid.header_mid_scroll,
	.cmsmasters_dynamic_cart .widget_shopping_cart_content,
	.cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button,
	.cmsmasters_added_product_info {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_mid_bg_scroll']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		.header_mid {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_mid_bg_scroll']) . "
		}
	}
	/* Finish Header Middle Background Color on Scroll */
	
	
	/* Start Header Middle Borders Color */
	.header_mid input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	.header_mid textarea,
	.header_mid select,
	.header_mid option {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_header_mid_border']) . "
	}
	/* Finish Header Middle Borders Color */
	
	
	/* Start Header Middle Custom Rules */
	.header_mid ::selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['schule' . '_header_mid_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_mid_bg_scroll']) . "
	}
	
	.header_mid ::-moz-selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['schule' . '_header_mid_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_mid_bg_scroll']) . "
	}
	/* Finish Header Middle Custom Rules */

/***************** Finish Header Middle Color Scheme Rules ******************/



/***************** Start Header Bottom Color Scheme Rules ******************/

	/* Start Header Bottom Content Color */
	.header_bot,
	.header_bot input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	.header_bot textarea,
	.header_bot select,
	.header_bot option {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_bot_color']) . "
	}
	/* Finish Header Bottom Content Color */
	
	
	/* Start Header Bottom Primary Color */
	.header_bot a {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_bot_link']) . "
	}
	
	.header_bot .button:hover,
	.header_bot input[type=submit]:hover,
	.header_bot input[type=button]:hover,
	.header_bot button:hover,
	.header_bot .resp_bot_nav_wrap .resp_bot_nav > span,
	.header_bot .resp_bot_nav_wrap .resp_bot_nav > span:before,
	.header_bot .resp_bot_nav_wrap .resp_bot_nav > span:after,
	#page .header_bot .cmsmasters_dynamic_cart .remove:before,
	#page .header_bot .cmsmasters_dynamic_cart .remove:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_bot_link']) . "
	}
	/* Finish Header Bottom Primary Color */
	
	
	/* Start Header Bottom Rollover Color */
	.header_bot a:hover,
	.header_bot .cmsmasters_dynamic_cart .widget_shopping_cart_content .total,
	.header_bot .cmsmasters_dynamic_cart .widget_shopping_cart_content .total strong,
	.header_bot .cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_bot_hover']) . "
	}
	
	.header_bot .button, 
	.header_bot input[type=submit], 
	.header_bot input[type=button], 
	.header_bot button,
	.header_bot .resp_bot_nav_wrap .resp_bot_nav:hover > span,
	.header_bot .resp_bot_nav_wrap .resp_bot_nav:hover > span:before,
	.header_bot .resp_bot_nav_wrap .resp_bot_nav:hover > span:after,
	.header_bot .resp_bot_nav_wrap .resp_bot_nav.active > span,
	.header_bot .resp_bot_nav_wrap .resp_bot_nav.active > span:before,
	.header_bot .resp_bot_nav_wrap .resp_bot_nav.active > span:after,
	.header_bot .cmsmasters_dynamic_cart .cmsmasters_dynamic_cart_button .count,
	#page .header_bot .cmsmasters_dynamic_cart .remove:hover:before,
	#page .header_bot .cmsmasters_dynamic_cart .remove:hover:after,
	.header_bot .cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button:hover,
	.header_bot .cmsmasters_header_cart_link .count {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_bot_hover']) . "
	}
	
	.header_bot input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]):focus,
	.header_bot textarea:focus,
	.header_bot select:focus,
	.header_bot .cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button,
	.header_bot .cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_header_bot_hover']) . "
	}
	/* Finish Header Bottom Rollover Color */
	
	
	/* Start Header Bottom Background Color */
	.header_bot .button, 
	.header_bot input[type=submit], 
	.header_bot input[type=button], 
	.header_bot button {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_bot_bg']) . "
	}
	
	.header_bot,
	.header_bot input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	.header_bot textarea,
	.header_bot select,
	.header_bot option {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_bot_bg']) . "
	}
	/* Finish Header Bottom Background Color */
	
	
	/* Start Header Bottom Background Color on Scroll */
	.header_bot .cmsmasters_dynamic_cart .cmsmasters_dynamic_cart_button .count,
	.header_bot .cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button:hover,
	.header_bot .cmsmasters_header_cart_link .count {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_bot_bg_scroll']) . "
	}
	
	.header_bot.header_bot_scroll,
	.header_bot .cmsmasters_dynamic_cart .widget_shopping_cart_content,
	.header_bot .cmsmasters_dynamic_cart .widget_shopping_cart_content .buttons .button,
	.header_bot .cmsmasters_added_product_info {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_bot_bg_scroll']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		.header_bot {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_bot_bg_scroll']) . "
		}
	}
	/* Finish Header Bottom Background Color on Scroll */
	
	
	/* Start Header Bottom Borders Color */
	.header_bot .header_bot_outer,
	.header_bot .header_bot_border_top,
	.header_bot input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	.header_bot textarea,
	.header_bot select,
	.header_bot option {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_header_bot_border']) . "
	}
	/* Finish Header Bottom Borders Color */
	
	
	/* Start Header Bottom Custom Rules */
	.header_bot ::selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['schule' . '_header_bot_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_bot_bg']) . "
	}
	
	.header_bot ::-moz-selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['schule' . '_header_bot_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_bot_bg']) . "
	}
	/* Finish Header Bottom Custom Rules */

/***************** Finish Header Bottom Color Scheme Rules ******************/



/***************** Start Navigation Color Scheme Rules ******************/

	/* Start Navigation Title Link Color */
	@media only screen and (min-width: 1025px) {
		#page ul.navigation > li > a, 
		ul.navigation > li > a .nav_tag {
			" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_title_link']) . "
		}
		
		ul.navigation > li > a .nav_tag {
			" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_navigation_title_link']) . "
		}
	}
	/* Finish Navigation Title Link Color */
	
	
	/* Start Navigation Title Link Hover Color */
	@media only screen and (min-width: 1025px) {
		#page ul.navigation > li > a:hover, 
		ul.navigation > li > a:hover .nav_subtitle,
		ul.navigation > li:hover > a,
		ul.navigation > li:hover > a .nav_subtitle, 
		ul.navigation > li > a:hover .nav_tag {
			" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_title_link_hover']) . "
		}
		
		ul.navigation > li.menu-item > a:hover .nav_tag, 
		ul.navigation > li.menu-item > a:hover .nav_tag {
			" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_navigation_title_link_hover']) . "
		}
	}
	/* Finish Navigation Title Link Hover Color */
	
	
	/* Start Navigation Title Link Current Color */

	.mid_nav .cmsmasters_mov_bar span, 
	.bot_nav .cmsmasters_mov_bar span {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_navigation_title_link_current']) . "
	}

	@media only screen and (min-width: 1025px) {
		ul.navigation > li.menu-item.current-menu-item > a,
		ul.navigation > li.menu-item.current-menu-item > a .nav_subtitle,
		ul.navigation > li.menu-item.current-menu-item > a .nav_tag,
		ul.navigation > li.menu-item.current-menu-ancestor > a,
		ul.navigation > li.menu-item.current-menu-ancestor > a .nav_subtitle,
		ul.navigation > li.menu-item.current-menu-ancestor > a .nav_tag,
		ul.navigation > li.menu-item-highlight > a,
		ul.navigation > li.menu-item-highlight > a .nav_subtitle,
		ul.navigation > li.menu-item-highlight > a .nav_tag,
		ul.navigation > li.page_item.current_page_item > a,
		ul.navigation > li.page_item.current_page_item > a .nav_subtitle,
		ul.navigation > li.page_item.current_page_item > a .nav_tag,
		ul.navigation > li.page_item.current_page_ancestor  > a,
		ul.navigation > li.page_item.current_page_ancestor  > a .nav_subtitle,
		ul.navigation > li.page_item.current_page_ancestor  > a .nav_tag {
			" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_title_link_current']) . "
		}
		
		ul.navigation > li.menu-item.current-menu-item > a .nav_tag, 
		ul.navigation > li.menu-item.current-menu-ancestor > a .nav_tag,
		ul.navigation > li.menu-item-highlight > a .nav_tag,
		ul.navigation > li.page_item.current_page_item > a .nav_tag,
		ul.navigation > li.page_item.current_page_ancestor  > a .nav_tag {
			" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_navigation_title_link_current']) . "
		}
	}
	/* Finish Navigation Title Link Current Color */
	
	
	/* Start Navigation Title Link Subtitle Color */
	@media only screen and (min-width: 1025px) {
		ul.navigation > li > a .nav_subtitle {
			" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_title_link_subtitle']) . "
		}
	}
	/* Finish Navigation Title Link Subtitle Color */
	
	
	/* Start Navigation Title Link Background Color */
	@media only screen and (min-width: 1025px) {
		ul.navigation > li > a {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_navigation_title_link_bg']) . "
		}
	}
	/* Finish Navigation Title Link Background Color */
	
	
	/* Start Navigation Title Link Hover Background Color */
	@media only screen and (min-width: 1025px) {
		ul.navigation > li > a:hover,
		ul.navigation > li:hover > a {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_navigation_title_link_bg_hover']) . "
		}
	}
	/* Finish Navigation Title Link Hover Background Color */
	
	
	/* Start Navigation Title Link Current Background Color */
	@media only screen and (min-width: 1025px) {
		ul.navigation > li.menu-item.current-menu-item > a, 
		ul.navigation > li.menu-item.current-menu-ancestor > a,
		ul.navigation > li.menu-item-highlight > a,
		ul.navigation > li.page_item.current_page_item > a {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_navigation_title_link_bg_current']) . "
		}
	}
	/* Finish Navigation Title Link Current Background Color */
	
	
	/* Start Navigation Title Link Border Color */
	@media only screen and (min-width: 1025px) {
		ul.navigation > li > a {
			" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_navigation_title_link_border']) . "
		}
	}
	/* Finish Navigation Title Link Border Color */
	
	
	/* Start Navigation Dropdown Text Color */
	.navigation li .menu-item-mega-description-container, 
	.navigation li .menu-item-mega-description-container * {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_dropdown_text']) . "
	}
	/* Finish Navigation Dropdown Tex Color */
	
	
	/* Start Navigation Dropdown Background Color */
	@media only screen and (max-width: 1024px) {
		ul.navigation {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_navigation_dropdown_bg']) . "
		}
	}
	
	@media only screen and (min-width: 1025px) {
		ul.navigation ul, 
		ul.navigation .menu-item-mega-container {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_navigation_dropdown_bg']) . "
		}
	}
	/* Finish Navigation Dropdown Background Color */
	
	
	/* Start Navigation Dropdown Border Color */
	@media only screen and (min-width: 1025px) {
		ul.navigation ul, 
		ul.navigation .menu-item-mega-container {
			" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_navigation_dropdown_border']) . "
		}
	}
	/* Finish Navigation Dropdown Border Color */
	
	
	/* Start Navigation Dropdown Link Color */
	.navigation li a, 
	.navigation li a .nav_tag {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_dropdown_link']) . "
	}
	
	@media only screen and (min-width: 1025px) {
		.navigation div.menu-item-mega-container > ul > li > a:not([href]):hover, 
		.navigation div.menu-item-mega-container > ul > li > a:not([href]):hover .nav_subtitle {
			" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_dropdown_link']) . "
		}
	}
	/* Finish Navigation Dropdown Link Color */
	
	
	/* Start Navigation Dropdown Link Hover Color */
	.navigation li > a:hover,
	.navigation li > a:hover .nav_subtitle,
	.navigation li.current-menu-item > a,
	.navigation li.current-menu-item > a .nav_subtitle,
	.navigation li.current-menu-ancestor > a,
	.navigation li.current-menu-ancestor > a .nav_subtitle,
	.navigation li.menu-item-highlight > a,
	.navigation li.menu-item-highlight > a .nav_subtitle,
	.navigation li a:hover .nav_tag,
	.navigation li.page_item.current_page_item > a,
	.navigation li.page_item.current_page_item > a .nav_subtitle {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_dropdown_link_hover']) . "
	}
	
	@media only screen and (min-width: 1025px) {
		ul.navigation li > ul li:hover > a, 
		ul.navigation li > ul li:hover > a .nav_subtitle {
			" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_dropdown_link_hover']) . "
		}
	}
	/* Finish Navigation Dropdown Link Hover Color */
	
	
	/* Start Navigation Dropdown Link Subtitle Color */
	.navigation li a .nav_subtitle {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_navigation_dropdown_link_subtitle']) . "
	}
	/* Finish Navigation Dropdown Link Subtitle Color */
	
	
	/* Start Navigation Dropdown Link Hover Highlight Color */
	.navigation li > a:hover,
	.navigation li.current-menu-item > a,
	.navigation li.current-menu-ancestor > a,
	.navigation li.menu-item-highlight > a,
	.navigation li.page_item.current_page_item > a {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_navigation_dropdown_link_highlight']) . "
	}
	
	@media only screen and (min-width: 1025px) {
		ul.navigation li > ul li:hover > a {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_navigation_dropdown_link_highlight']) . "
		}
		
		.navigation div.menu-item-mega-container > ul > li > a:not([href]):hover {
			background-color:transparent;
		}
	}
	/* Finish Navigation Dropdown Link Hover Highlight Color */
	
	
	/* Start Navigation Dropdown Link Border Color */
	@media only screen and (min-width: 1025px) {
		.navigation li a {
			" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_navigation_dropdown_link_border']) . "
		}
	}
	
	@media only screen and (max-width: 1024px) {
		.navigation li {
			" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_navigation_dropdown_link_border']) . "
		}
	}
	/* Finish Navigation Dropdown Link Border Color */

/***************** Finish Navigation Color Scheme Rules ******************/



/***************** Start Header Top Color Scheme Rules ******************/

	/* Start Header Top Content Color */
	.header_top {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_color']) . "
	}
	/* Finish Header Top Content Color */
	
	
	/* Start Header Top Primary Color */
	.header_top a, 
	.header_top .header_top_but:hover, 
	.header_top .header_top_but.opened {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_link']) . "
	}
	
	.header_top .social_wrap a,
	.header_top .responsive_top_nav > span,
	.header_top .responsive_top_nav > span:before,
	.header_top .responsive_top_nav > span:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_top_link']) . "
	}
	/* Finish Header Top Primary Color */
	
	
	/* Start Header Top Rollover Color */
	.header_top a:hover,
	.header_top .meta_wrap [class^=cmsmasters-icon-]:before,
	.header_top .meta_wrap [class*= cmsmasters-icon-]:before,
	.header_top .header_top_but {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_hover']) . "
	}
	
	.header_top .social_wrap a:hover,
	.header_top .responsive_top_nav:hover > span,
	.header_top .responsive_top_nav:hover > span:before,
	.header_top .responsive_top_nav:hover > span:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_top_hover']) . "
	}
	/* Finish Header Top Rollover Color */
	
	
	/* Start Header Top Background Color */
	.header_top .social_wrap a,
	.header_top .social_wrap a:hover {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_bg']) . "
	}
	
	.header_top {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_top_bg']) . "
	}
	/* Finish Header Top Background Color */
	
	
	/* Start Header Top Borders Color */
	.header_top .header_top_but {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_header_top_border']) . "
	}
	/* Finish Header Top Borders Color */
	
	
	/* Start Header Top Custom Rules */
	.header_top ::selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['schule' . '_header_top_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_bg']) . "
	}
	
	.header_top ::-moz-selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['schule' . '_header_top_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_bg']) . "
	}
	/* Finish Header Top Custom Rules */

/***************** Finish Header Top Color Scheme Rules ******************/



/***************** Start Header Top Navigation Color Scheme Rules ******************/

	/* Start Header Top Navigation Title Link Color */
	@media only screen and (min-width: 1025px) {
		ul.top_line_nav > li > a {
			" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_title_link']) . "
		}
	}
	/* Finish Header Top Navigation Title Link Color */
	
	
	/* Start Header Top Navigation Title Link Hover Color */
	@media only screen and (min-width: 1025px) {
		ul.top_line_nav > li > a:hover,
		ul.top_line_nav > li:hover > a,
		ul.top_line_nav > li.current-menu-item > a,
		ul.top_line_nav > li.current-menu-ancestor > a {
			" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_title_link_hover']) . "
		}
	}
	/* Finish Header Top Navigation Title Link Hover Color */
	
	
	/* Start Header Top Navigation Title Link Background Color */
	@media only screen and (min-width: 1025px) {
		ul.top_line_nav > li > a {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_top_title_link_bg']) . "
		}
	}
	/* Finish Header Top Navigation Title Link Background Color */
	
	
	/* Start Header Top Navigation Title Link Hover Background Color */
	@media only screen and (min-width: 1025px) {
		ul.top_line_nav > li > a:hover,
		ul.top_line_nav > li:hover > a,
		ul.top_line_nav > li.current-menu-item > a,
		ul.top_line_nav > li.current-menu-ancestor > a {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_top_title_link_bg_hover']) . "
		}
	}
	/* Finish Header Top Navigation Title Link Hover Background Color */
	
	
	/* Start Header Top Navigation Title Link Border Color */
	@media only screen and (min-width: 1025px) {
		ul.top_line_nav > li {
			" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_header_top_title_link_border']) . "
		}
	}
	/* Finish Header Top Navigation Title Link Border Color */
	
	
	/* Start Header Top Navigation Dropdown Background Color */
	
	@media only screen and (min-width: 1025px) {
		ul.top_line_nav ul {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_top_dropdown_bg']) . "
		}
	}
	/* Finish Header Top Navigation Dropdown Background Color */
	
	
	/* Start Header Top Navigation Dropdown Border Color */
	@media only screen and (min-width: 1025px) {
		ul.top_line_nav ul {
			" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_header_top_dropdown_border']) . "
		}
	}
	/* Finish Header Top Navigation Dropdown Border Color */
	
	
	/* Start Header Top Navigation Dropdown Link Color */
	.top_line_nav li a {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_dropdown_link']) . "
	}
	/* Finish Header Top Navigation Dropdown Link Color */
	
	
	/* Start Header Top Navigation Dropdown Link Hover Color */
	.top_line_nav li > a:hover,
	.top_line_nav li.current-menu-item > a {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_dropdown_link_hover']) . "
	}
	
	@media only screen and (min-width: 1025px) {
		ul.top_line_nav ul li:hover > a, 
		ul.top_line_nav ul li.current-menu-ancestor > a {
			" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_header_top_dropdown_link_hover']) . "
		}
	}
	/* Finish Header Top Navigation Dropdown Link Hover Color */
	
	
	/* Start Header Top Navigation Dropdown Link Hover Highlight Color */
	.top_line_nav li > a:hover,
	.top_line_nav li.current-menu-item > a {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_top_dropdown_link_highlight']) . "
	}
	
	@media only screen and (min-width: 1025px) {
		ul.top_line_nav ul li:hover > a,
		ul.top_line_nav ul li.current-menu-ancestor > a {
			" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_header_top_dropdown_link_highlight']) . "
		}
	}
	/* Finish Header Top Navigation Dropdown Link Hover Highlight Color */
	
	
	/* Start Header Top Navigation Dropdown Link Border Color */
	.top_line_nav li {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_header_top_dropdown_link_border']) . "
	}
	/* Finish Header Top Navigation Dropdown Link Border Color */

/***************** Finish Header Top Navigation Color Scheme Rules ******************/

";
	
	
	return apply_filters('schule_theme_colors_secondary_filter', $custom_css);
}

