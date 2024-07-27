<?php
/**
 * @package 	WordPress
 * @subpackage 	schule
 * @version 	1.1.0
 * 
 * LearnPress Colors Rules
 * Created by CMSMasters
 * 
 */


function schule_learnpress_colors($custom_css) {
	$cmsmasters_option = schule_get_global_options();
	
	
	$cmsmasters_color_schemes = cmsmasters_color_schemes_list();
	
	
	foreach ($cmsmasters_color_schemes as $scheme => $title) {
		$rule = (($scheme != 'default') ? "html .cmsmasters_color_scheme_{$scheme} " : 'html ');
		
		
		$custom_css .= "
/***************** Start {$title} LearnPress Color Scheme Rules ******************/

	/* Start Primary Color */
	{$rule}#page .curriculum-sections .section-content > li [class^=\"cmsmasters_theme_icon_\"], 
	{$rule}#page .curriculum-sections .section-content > li [class*=\" cmsmasters_theme_icon_\"],
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_cource_cat a,
	{$rule}.archive .lp_course .cmsmasters_lrp_archive_content .entry-footer .course-price,
	{$rule}.review-stars-rated .review-stars.filled:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_course_title:before,
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_price,
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_free {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_link']) . "
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	{$rule}.review-stars > li span.dashicons-star-empty:before,
	{$rule}.review-stars-rated .review-stars:before,
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_cource_cat a:hover {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Heading Color */
	{$rule}.archive .lp_course .cmsmasters_lrp_archive_content .cmsmasters_lrp_archive_item_title {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .preloader .cmsmasters_open_link:before {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_heading']) . "
	}
	/* Finish Heading Color */
	
	
	/* Start Alternate Background Color */
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .img_placeholder {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_alternate']) . "
	}
	/* Finish Alternate Background Color */  
	
	
	/* Start Main Background Color */
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_price,
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_free {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_footer, 
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .lpr_course_inner {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_bg']) . "
	}
	/* Finish Main Background Color */
	
	
	/* Start Borders Color */
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_footer, 
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .lpr_course_inner, 
	{$rule}.cmsmasters_learnpress_shortcode .lpr_course_post .img_placeholder, 
	{$rule}.archive .lp_course .cmsmasters_lrp_archive_content .cmsmasters_lrp_archive_item,
	{$rule}.cmsmasters_course_title {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_' . $scheme . '_border']) . "
	}
	/* Finish Borders Color */


	/* Start Button Colors */
	{$rule}.learnpress-page .lp-button,
	{$rule}.learnpress-page #lp-button,
	{$rule}#learn-press-course .learn-press-course-wishlist,
	{$rule}#learn-press-profile .learn-press-course-wishlist,
	{$rule}#learn-press-profile #profile-content .lp-button,
	{$rule}#learn-press-course .course-summary-sidebar .course-sidebar-preview .lp-course-buttons button.button-enroll-course,
	{$rule}#checkout-payment #checkout-order-action button,
	{$rule}#popup-course #popup-content .lp-button.completed {" .
		cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_link']) .
		cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_bg'] . ' !important') .
		cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_' . $scheme . '_border']) .
	"}

	{$rule}.learnpress-page .lp-button:hover,
	{$rule}.learnpress-page #lp-button:hover,
	{$rule}#learn-press-course .learn-press-course-wishlist:hover,
	{$rule}#learn-press-profile .learn-press-course-wishlist:hover,
	{$rule}#learn-press-profile #profile-content .lp-button:hover,
	{$rule}#learn-press-course .course-summary-sidebar .course-sidebar-preview .lp-course-buttons button.button-enroll-course:hover,
	{$rule}#checkout-payment #checkout-order-action button:hover {" .
		cmsmasters_color_css('color', $cmsmasters_option['schule' . '_' . $scheme . '_bg']) .
		cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_' . $scheme . '_secondary'] . ' !important') .
		cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_' . $scheme . '_secondary']) .
	"}
	/* Finish Button Colors */

/***************** Finish {$title} LearnPress Color Scheme Rules ******************/

";
	}
	
	
	return $custom_css;
}

add_filter('schule_theme_colors_secondary_filter', 'schule_learnpress_colors');

