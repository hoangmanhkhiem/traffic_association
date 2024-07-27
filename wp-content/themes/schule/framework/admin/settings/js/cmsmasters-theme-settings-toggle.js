/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Admin Panel Toggles Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	"use strict";
	
	/* General 'General' Tab Fields Load */
	if ($('input[id^="' + cmsmasters_settings.shortname + '_logo_type"]:checked').val() === 'image') {
		$('#' + cmsmasters_settings.shortname + '_logo_title').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_logo_subtitle').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_logo_custom_color').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_logo_title_color').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_logo_subtitle_color').parents('tr').hide();
	} else if ($('input[id^="' + cmsmasters_settings.shortname + '_logo_type"]:checked').val() === 'text') {
		$('#' + cmsmasters_settings.shortname + '_logo_url').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_logo_url_retina').parents('tr').hide();
		
		if ($('#' + cmsmasters_settings.shortname + '_logo_custom_color').is(':not(:checked)')) {
			$('#' + cmsmasters_settings.shortname + '_logo_title_color').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_logo_subtitle_color').parents('tr').hide();
		}
	}
	
	/* General 'General' Tab 'Logo Type' Field Change */
	$('input[id^="' + cmsmasters_settings.shortname + '_logo_type"]').on('change', function () { 
		if ($(this).is(':checked') && $(this).val() === 'image') {
			$('#' + cmsmasters_settings.shortname + '_logo_url').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_logo_url_retina').parents('tr').show();
			
			$('#' + cmsmasters_settings.shortname + '_logo_title').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_logo_subtitle').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_logo_custom_color').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_logo_title_color').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_logo_subtitle_color').parents('tr').hide();
		} else if ($(this).is(':checked') && $(this).val() === 'text') {
			$('#' + cmsmasters_settings.shortname + '_logo_title').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_logo_subtitle').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_logo_custom_color').parents('tr').show();
			
			if ($('#' + cmsmasters_settings.shortname + '_logo_custom_color').is(':checked')) {
				$('#' + cmsmasters_settings.shortname + '_logo_title_color').parents('tr').show();
				$('#' + cmsmasters_settings.shortname + '_logo_subtitle_color').parents('tr').show();
			}
			
			$('#' + cmsmasters_settings.shortname + '_logo_url').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_logo_url_retina').parents('tr').hide();
		}
	} );
	
	/* General 'General' Tab 'Custom Text Colors' Field Change */
	$('#' + cmsmasters_settings.shortname + '_logo_custom_color').on('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsmasters_settings.shortname + '_logo_title_color').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_logo_subtitle_color').parents('tr').show();
		} else {
			$('#' + cmsmasters_settings.shortname + '_logo_title_color').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_logo_subtitle_color').parents('tr').hide();
		}
	} );
	
	
	
	/* General 'Background' Tab Fields Load */
	if ($('#' + cmsmasters_settings.shortname + '_bg_img_enable').is(':not(:checked)')) {
		$('#' + cmsmasters_settings.shortname + '_bg_img').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_bg_rep"]').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_bg_pos"]').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_bg_att"]').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_bg_size"]').parents('tr').hide();
	}
	
	/* General 'Background' Tab Fields Change */
	$('#' + cmsmasters_settings.shortname + '_bg_img_enable').on('change', function () { 
		if ($('#' + cmsmasters_settings.shortname + '_bg_img_enable').is(':checked')) {
			$('#' + cmsmasters_settings.shortname + '_bg_img').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_bg_rep"]').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_bg_pos"]').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_bg_att"]').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_bg_size"]').parents('tr').show();
		} else {
			$('#' + cmsmasters_settings.shortname + '_bg_img').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_bg_rep"]').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_bg_pos"]').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_bg_att"]').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_bg_size"]').parents('tr').hide();
		}
	} );
	
	
	
	/* General 'Header' Tab Fields Load */
	if ($('#' + cmsmasters_settings.shortname + '_header_top_line').is(':not(:checked)')) {
		$('#' + cmsmasters_settings.shortname + '_header_top_scheme').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_header_top_height').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_header_top_line_short_info').parents('tr').hide();
		$('input[name*="' + cmsmasters_settings.shortname + '_header_top_line_add_cont"]').parents('tr').hide();
	}
	
	
	if ($('input[name*="' + cmsmasters_settings.shortname + '_header_styles"]:checked').val() === 'default') {
		$('#' + cmsmasters_settings.shortname + '_header_bot_height').parents('tr').hide();
		$('input[name*="' + cmsmasters_settings.shortname + '_header_add_cont"]').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
	}
	
	if ($('input[name*="' + cmsmasters_settings.shortname + '_header_styles"]:checked').val() === 'c_nav') {
		$('#' + cmsmasters_settings.shortname + '_header_search').parents('tr').hide();
		$('input[name*="' + cmsmasters_settings.shortname + '_header_add_cont"]').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
	}
	
	if ($('input[name*="' + cmsmasters_settings.shortname + '_header_add_cont"]:checked').val() !== 'cust_html') {
		$('#' + cmsmasters_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
	}
	
	
	/* General 'Header' Tab Fields Change */
	$('#' + cmsmasters_settings.shortname + '_header_top_line').on('change', function () { 
		if ($('#' + cmsmasters_settings.shortname + '_header_top_line').is(':checked')) {
			$('#' + cmsmasters_settings.shortname + '_header_top_scheme').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_header_top_height').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_header_top_line_short_info').parents('tr').show();
			$('input[name*="' + cmsmasters_settings.shortname + '_header_top_line_add_cont"]').parents('tr').show();
		} else {
			$('#' + cmsmasters_settings.shortname + '_header_top_scheme').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_header_top_height').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_header_top_line_short_info').parents('tr').hide();
			$('input[name*="' + cmsmasters_settings.shortname + '_header_top_line_add_cont"]').parents('tr').hide();
		}
	} );
	
	
	$('input[name*="' + cmsmasters_settings.shortname + '_header_styles"]').on('change', function () { 
		if ($('input[name*="' + cmsmasters_settings.shortname + '_header_styles"]:checked').val() === 'default') {
			$('#' + cmsmasters_settings.shortname + '_header_bot_height').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_header_search').parents('tr').show();
			$('input[name*="' + cmsmasters_settings.shortname + '_header_add_cont"]').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
		} else if ($('input[name*="' + cmsmasters_settings.shortname + '_header_styles"]:checked').val() === 'c_nav') {
			$('#' + cmsmasters_settings.shortname + '_header_bot_height').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_header_search').parents('tr').hide();
			$('input[name*="' + cmsmasters_settings.shortname + '_header_add_cont"]').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
		} else {
			$('#' + cmsmasters_settings.shortname + '_header_bot_height').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_header_search').parents('tr').show();
			$('input[name*="' + cmsmasters_settings.shortname + '_header_add_cont"]').parents('tr').show();
			
			if ($('input[name*="' + cmsmasters_settings.shortname + '_header_add_cont"]:checked').val() === 'cust_html') {
				$('#' + cmsmasters_settings.shortname + '_header_add_cont_cust_html').parents('tr').show();
			}
		}
	} );
	
	$('input[name*="' + cmsmasters_settings.shortname + '_header_add_cont"]').on('change', function () { 
		if ($('input[name*="' + cmsmasters_settings.shortname + '_header_add_cont"]:checked').val() === 'cust_html') {
			$('#' + cmsmasters_settings.shortname + '_header_add_cont_cust_html').parents('tr').show();
		} else {
			$('#' + cmsmasters_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
		}
	} );
	
	
	
	/* General 'Content' Tab Fields Load */
	if ($('#' + cmsmasters_settings.shortname + '_heading_bg_image_enable').is(':not(:checked)')) {
		$('#' + cmsmasters_settings.shortname + '_heading_bg_image').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_heading_bg_repeat"]').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_heading_bg_attachment"]').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_heading_bg_size"]').parents('tr').hide();
	}
	
	/* General 'Content' Tab Fields Change */
	$('#' + cmsmasters_settings.shortname + '_heading_bg_image_enable').on('change', function () { 
		if ($('#' + cmsmasters_settings.shortname + '_heading_bg_image_enable').is(':checked')) {
			$('#' + cmsmasters_settings.shortname + '_heading_bg_image').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_heading_bg_repeat"]').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_heading_bg_attachment"]').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_heading_bg_size"]').parents('tr').show();
		} else {
			$('#' + cmsmasters_settings.shortname + '_heading_bg_image').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_heading_bg_repeat"]').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_heading_bg_attachment"]').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_heading_bg_size"]').parents('tr').hide();
		}
	} );
	
	
	
	/* General 'Footer' Tab Fields Load */
	if ($('input[name*="' + cmsmasters_settings.shortname + '_footer_type"]:checked').val() !== 'small') {
		$('input[name*="' + cmsmasters_settings.shortname + '_footer_additional_content"]').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_footer_html').parents('tr').show();
		$('#' + cmsmasters_settings.shortname + '_footer_logo').parents('tr').show();
		
		
		if ($('#' + cmsmasters_settings.shortname + '_footer_logo').is(':not(:checked)')) {
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url_retina').parents('tr').hide();
		}
	} else {
		$('input[name*="' + cmsmasters_settings.shortname + '_footer_additional_content"]').parents('tr').show();
		
		$('#' + cmsmasters_settings.shortname + '_footer_logo').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_footer_logo_url').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_footer_logo_url_retina').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_footer_nav').parents('tr').hide();
		$('#' + cmsmasters_settings.shortname + '_footer_social').parents('tr').hide();
		
		if ($('input[name*="' + cmsmasters_settings.shortname + '_footer_additional_content"]:checked').val() !== 'text') {
			$('#' + cmsmasters_settings.shortname + '_footer_html').parents('tr').hide();
		}
	}
	
	
	/* General 'Footer' Tab Fields Change */
	$('input[name*="' + cmsmasters_settings.shortname + '_footer_type"]').on('change', function () { 
		if ($('input[name*="' + cmsmasters_settings.shortname + '_footer_type"]:checked').val() === 'small') {
			$('input[name*="' + cmsmasters_settings.shortname + '_footer_additional_content"]').parents('tr').show();
			
			$('#' + cmsmasters_settings.shortname + '_footer_logo').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url_retina').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_footer_nav').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_footer_social').parents('tr').hide();
			
			
			if ($('input[name*="' + cmsmasters_settings.shortname + '_footer_additional_content"]:checked').val() === 'text') {
				$('#' + cmsmasters_settings.shortname + '_footer_html').parents('tr').show();
			} else {
				$('#' + cmsmasters_settings.shortname + '_footer_html').parents('tr').hide();
			}
		} else {
			$('input[name*="' + cmsmasters_settings.shortname + '_footer_additional_content"]').parents('tr').hide();
			
			$('#' + cmsmasters_settings.shortname + '_footer_logo').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url_retina').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_footer_nav').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_footer_social').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_footer_html').parents('tr').show();
			
			
			if ($('#' + cmsmasters_settings.shortname + '_footer_logo').is(':not(:checked)')) {
				$('#' + cmsmasters_settings.shortname + '_footer_logo_url').parents('tr').hide();
				$('#' + cmsmasters_settings.shortname + '_footer_logo_url_retina').parents('tr').hide();
			}
		}
	} );
	
	
	/* General 'Footer' Tab 'Footer Logo' Field Change */
	$('#' + cmsmasters_settings.shortname + '_footer_logo').on('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url').parents('tr').show();
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url_retina').parents('tr').show();
		} else if ($(this).is(':not(:checked)')) {
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url').parents('tr').hide();
			$('#' + cmsmasters_settings.shortname + '_footer_logo_url_retina').parents('tr').hide();
		}
	} );
	
	
	/* General 'Footer' Tab 'Additional Content' Change */
	$('input[name*="' + cmsmasters_settings.shortname + '_footer_additional_content"]').on('change', function () { 
		if ($('input[name*="' + cmsmasters_settings.shortname + '_footer_type"]:checked').val() === 'small') {
			if ($('input[name*="' + cmsmasters_settings.shortname + '_footer_additional_content"]:checked').val() === 'text') {
				$('#' + cmsmasters_settings.shortname + '_footer_html').parents('tr').show();
			} else {
				$('#' + cmsmasters_settings.shortname + '_footer_html').parents('tr').hide();
			}
		}
	} );
	
	
	
	/* Elements '404' Tab Fields Load */
	if ($('#' + cmsmasters_settings.shortname + '_error_sitemap_button').is(':not(:checked)')) {
		$('#' + cmsmasters_settings.shortname + '_error_sitemap_link').parents('tr').hide();
	}
	
	if ($('#' + cmsmasters_settings.shortname + '_error_bg_img_enable').is(':not(:checked)')) {
		$('#' + cmsmasters_settings.shortname + '_error_bg_image').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_error_bg_rep"]').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_error_bg_pos"]').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_error_bg_att"]').parents('tr').hide();
		$('label[for="' + cmsmasters_settings.shortname + '_error_bg_size"]').parents('tr').hide();
	}
	
	/* Elements '404' Tab Fields Change */
	$('#' + cmsmasters_settings.shortname + '_error_sitemap_button').on('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsmasters_settings.shortname + '_error_sitemap_link').parents('tr').show();
		} else {
			$('#' + cmsmasters_settings.shortname + '_error_sitemap_link').parents('tr').hide();
		}
	} );
	
	$('#' + cmsmasters_settings.shortname + '_error_bg_img_enable').on('change', function () { 
		if ($('#' + cmsmasters_settings.shortname + '_error_bg_img_enable').is(':checked')) {
			$('#' + cmsmasters_settings.shortname + '_error_bg_image').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_error_bg_rep"]').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_error_bg_pos"]').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_error_bg_att"]').parents('tr').show();
			$('label[for="' + cmsmasters_settings.shortname + '_error_bg_size"]').parents('tr').show();
		} else {
			$('#' + cmsmasters_settings.shortname + '_error_bg_image').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_error_bg_rep"]').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_error_bg_pos"]').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_error_bg_att"]').parents('tr').hide();
			$('label[for="' + cmsmasters_settings.shortname + '_error_bg_size"]').parents('tr').hide();
		}
	} );
	
	
	
	/* Single Posts 'Project' Tab Fields Load */
	if ($('#' + cmsmasters_settings.shortname + '_portfolio_project_link').is(':not(:checked)')) {
		$('#' + cmsmasters_settings.shortname + '_portfolio_project_link_text').parents('tr').hide();
	}
	
	/* Single Posts 'Project' Tab 'Project Link' Field Change */
	$('#' + cmsmasters_settings.shortname + '_portfolio_project_link').on('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsmasters_settings.shortname + '_portfolio_project_link_text').parents('tr').show();
		} else {
			$('#' + cmsmasters_settings.shortname + '_portfolio_project_link_text').parents('tr').hide();
		}
	} );
} )(jQuery);

