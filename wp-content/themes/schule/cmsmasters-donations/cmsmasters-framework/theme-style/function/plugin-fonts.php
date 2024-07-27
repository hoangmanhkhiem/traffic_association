<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * CMSMasters Donations Fonts Rules
 * Created by CMSMasters
 * 
 */


function schule_donations_fonts($custom_css) {
	$cmsmasters_option = schule_get_global_options();
	
	
	$custom_css .= "
/***************** Start CMSMasters Donations Font Styles ******************/

	/* Start Content Font */
	.cmsmasters_single_slider_campaign .cmsmasters_stats .cmsmasters_stat_wrap .cmsmasters_stat_title_wrap * {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_content_font_google_font']) . $cmsmasters_option['schule' . '_content_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_content_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_content_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_content_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_content_font_font_style'] . ";
	}
	
	.cmsmasters_single_slider_campaign .cmsmasters_stats .cmsmasters_stat_wrap .cmsmasters_stat_title_wrap * , 
	.cmsmasters_campaigns .campaign .cmsmasters_stat_title {
		text-transform:none;
	}
	/* Finish Content Font */
	
	
	/* Start Link Font */
	/* Finish Link Font */
	
	
	/* Start Navigation Title Font */
	/* Finish Navigation Title Font */
	
	
	/* Start H1 Font */
	.donations.opened-article > .donation .cmsmasters_donation_amount_currency {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h1_font_google_font']) . $cmsmasters_option['schule' . '_h1_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h1_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h1_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h1_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h1_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h1_font_text_decoration'] . ";
	}

	.donations.opened-article > .donation .cmsmasters_donation_amount_currency {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h1_font_font_size'] + 8) . "px;
	}
	/* Finish H1 Font */
	
	
	/* Start H2 Font */
	/* Finish H2 Font */
	
	
	/* Start H3 Font */	
	.cmsmasters_campaign_wrap_heading .cmsmasters_campaign_header *,
	.opened-article > .campaign .campaign_meta_wrap .cmsmasters_campaign_target_number,
	.opened-article > .campaign .campaign_meta_wrap .cmsmasters_campaign_donations_count_number,
	.cmsmasters_donation_info .cmsmasters_donation_header * {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h3_font_google_font']) . $cmsmasters_option['schule' . '_h3_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h3_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h3_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h3_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h3_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h3_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h3_font_text_decoration'] . ";
	}
	
	@media only screen and (max-width: 600px) {
		.cmsmasters_donation_field > label {
			font-size:" . ((int) $cmsmasters_option['schule' . '_h3_font_font_size'] - 8) . "px;
		}
	}
	/* Finish H3 Font */
	
	
	/* Start H4 Font */ 

	 .donations.opened-article > .donation .cmsmasters_donation_campaign a {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h4_font_google_font']) . $cmsmasters_option['schule' . '_h4_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h4_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h4_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h4_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h4_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h4_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h4_font_text_decoration'] . ";
	}
	
	.cmsmasters_single_slider_campaign .cmsmasters_single_slider_item_title {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h4_font_font_size'] + 2) . "px;
	}
	
	.cmsmasters_featured_campaign .cmsmasters_campaign_donated_percent .cmsmasters_stat_container {
		height:" . ((int) $cmsmasters_option['schule' . '_h4_font_line_height'] * 2 + 220 + 56) . "px;
	}
	/* Finish H4 Font */
	
	
	/* Start H5 Font */	
	.cmsmasters_stats .cmsmasters_stat_title_wrap .cmsmasters_stat_title,	
	.cmsmasters_donations .cmsmasters_donation_footer .cmsmasters_donation_amount_currency,
	.cmsmasters_campaign_inner .cmsmasters_campaign_header *,
	.cmsmasters_donation_field > label,
	.opened-article > .campaign .campaign_meta_wrap .cmsmasters_campaign_target_title,
	.opened-article > .campaign .campaign_meta_wrap .cmsmasters_campaign_donations_count_title,
	.opened-article > .campaign .campaign_meta_wrap .cmsmasters_stat_title_wrap *  {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h5_font_google_font']) . $cmsmasters_option['schule' . '_h5_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h5_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h5_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h5_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h5_font_text_decoration'] . ";
	}
	
	.cmsmasters_donations .cmsmasters_donation_footer .cmsmasters_donation_amount_currency,
	.cmsmasters_donation_field > label {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 2) . "px;
	}
	
	.cmsmasters_featured_campaign .campaign .cmsmasters_campaign_donated_percent h5 {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 3) . "px;
	}
	
	.cmsmasters_stats .cmsmasters_stat_title_wrap .cmsmasters_stat_title,
	.opened-article > .campaign .campaign_meta_wrap .cmsmasters_campaign_target_title,
	.opened-article > .campaign .campaign_meta_wrap .cmsmasters_campaign_donations_count_title,
	.opened-article > .campaign .campaign_meta_wrap .cmsmasters_stat_title_wrap * {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h5_font_font_size'] - 4) . "px;
	}
	/* Finish H5 Font */
	
	
	/* Start H6 Font */
	.donations.opened-article > .donation .cmsmasters_donation_details_item_title, 
	.donations.opened-article > .donation .cmsmasters_donation_details_item_title a, 
	.donations.opened-article > .donation .cmsmasters_donation_details_item_value, 
	.donations.opened-article > .donation .cmsmasters_donation_details_item_value a, 
	.cmsmasters_single_slider_campaign .cmsmasters_stat_subtitle, 
	.opened-article > .campaign .cmsmasters_campaign_cont_info > span * , 
	.opened-article > .campaign .cmsmasters_campaign_cont_info > span, 
	.cmsmasters_donations .donation .cmsmasters_donation_campaign a, 
	#page .cmsmasters_featured_campaign .cmsmasters_campaign_donated_percent .cmsmasters_stat_title,
	cmsmasters_donations .cmsmasters_donation_footer .cmsmasters_donation_amount_title,
	.cmsmasters_featured_campaign .campaign .cmsmasters_campaign_rest_amount,
	.cmsmasters_campaign_content p,
	.cmsmasters_stats .cmsmasters_stat_title_wrap .cmsmasters_percent_don,
	.cmsmasters_donation_field .field_inner > label,
	.field_inner small,
	.donation-anonymous_donation .field_inner small,
	.cmsmasters_donator_fields:nth-child(2) .cmsmasters_donator_field label {
		font-family:" . schule_get_google_font($cmsmasters_option['schule' . '_h6_font_google_font']) . $cmsmasters_option['schule' . '_h6_font_system_font'] . ";
		font-size:" . $cmsmasters_option['schule' . '_h6_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['schule' . '_h6_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['schule' . '_h6_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['schule' . '_h6_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['schule' . '_h6_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['schule' . '_h6_font_text_decoration'] . ";		
	}

	.cmsmasters_donations .donation .cmsmasters_donation_campaign a,
	.cmsmasters_donations .cmsmasters_donation_footer .cmsmasters_donation_amount_title,
	.cmsmasters_stats .cmsmasters_stat_title_wrap .cmsmasters_percent_don,
	.cmsmasters_donation_field .field_inner > label,
	.donation-anonymous_donation .field_inner small,
	.cmsmasters_donator_fields:nth-child(2) .cmsmasters_donator_field label,
	.donations.opened-article > .donation .cmsmasters_donation_details_item_value a,
	.donations.opened-article > .donation .cmsmasters_donation_details_item_title {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] + 1) . "px;
	}
	.cmsmasters_featured_campaign .campaign .cmsmasters_campaign_rest_amount,
	.cmsmasters_campaign_content p {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] + 2) . "px;
	}
	.field_inner small {
		font-size:" . ((int) $cmsmasters_option['schule' . '_h6_font_font_size'] - 1) . "px;
	}
	/* Finish H6 Font */
	
	
	/* Start Button Font */
	.header_donation_but .cmsmasters_button {
		font-size:" . ((int) $cmsmasters_option['schule' . '_button_font_font_size'] - 2) . "px;
	}
	/* Finish Button Font */
	
	
	/* Start Small Text Font */
	/* Finish Small Text Font */

/***************** Finish CMSMasters Donations Font Styles ******************/

";
	
	
	return $custom_css;
}

add_filter('schule_theme_fonts_filter', 'schule_donations_fonts');

