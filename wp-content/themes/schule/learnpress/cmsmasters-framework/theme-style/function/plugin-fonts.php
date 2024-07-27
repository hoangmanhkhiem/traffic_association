<?php
/**
 * @package 	WordPress
 * @subpackage 	schule
 * @version 	1.1.0
 * 
 * LearnPress Fonts Rules
 * Created by CMSMasters
 * 
 */


function schule_learnpress_fonts($custom_css) {
	$cmsmasters_option = schule_get_global_options();
	
	
	$custom_css .= "
/***************** Start LearnPress Font Styles ******************/

	/* Start Content Font */
	.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_cource_duration {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_content_font_google_font']) . $cmsmasters_option['schule' . '_content_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_content_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_content_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_content_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_content_font_font_style'] . ";
	}

	#page .cmsmasters_learnpress_shortcode .lpr_course_post .review-stars-rated {
		margin-top:" . (((int) $cmsmasters_option['schule' . '_content_font_line_height'] - 16) / 2) . "px;
		margin-bottom:" . (((int) $cmsmasters_option['schule' . '_content_font_line_height'] - 16) / 2) . "px;
	}
	/* Finish Content Font */


	/* Start H1 Font */
	.cmsmasters_course_title {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h1_font_google_font']) . $cmsmasters_option['schule' . '_h1_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h1_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h1_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h1_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h1_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h1_font_text_decoration'] . ";
	}
	/* Finish H1 Font */
	
	
	/* Start H5 Font */
	.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_footer,
	.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_footer a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h5_font_google_font']) . $cmsmasters_option['schule' . '_h5_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h5_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h5_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h5_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h5_font_text_decoration'] . ";
	}

	.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_footer,
	.cmsmasters_learnpress_shortcode .lpr_course_post .cmsmasters_course_footer a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h5_font_line_height'] - 4) . "px;
	}
	
	/* Finish H5 Font */
	
	
	/* Start H6 Font */
	.cmsmasters_cource_cat a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h6_font_google_font']) . $cmsmasters_option['schule' . '_h6_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h6_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h6_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h6_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h6_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h6_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h6_font_text_decoration'] . ";
	}

	.cmsmasters_cource_cat a {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] + 1) . "px;
		line-height:" . ((int) $cmsmasters_option['schule' . '_h6_font_line_height'] + 1) . "px;
	}
	
	/* Finish H6 Font */


	/* Start Button Font */
	.learnpress-page .lp-button,
	.learnpress-page #lp-button,
	#learn-press-course .learn-press-course-wishlist,
	#learn-press-profile .learn-press-course-wishlist,
	#learn-press-course .course-summary-sidebar .course-sidebar-preview .lp-course-buttons button,
	#learn-press-profile #profile-content .lp-button,
	#checkout-payment #checkout-order-action button,
	#popup-course #popup-content .lp-button.completed {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_button_font_google_font']) . $cmsmasters_option['schule' . '_button_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_button_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_button_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_button_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_button_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_button_font_text_transform'] . ";
	}
	/* Finish Button Font */
	

/***************** Finish LearPress Font Styles ******************/

";
	
	
	return $custom_css;
}

add_filter('schule_theme_fonts_filter', 'schule_learnpress_fonts');

