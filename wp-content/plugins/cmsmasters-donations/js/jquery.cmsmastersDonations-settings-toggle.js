/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version 	1.2.7
 * 
 * CMSMasters Donations Admin Settings Toggles Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	/* General 'Header' Tab Fields Load */
	if ($('#' + cmsmasters_donations_settings.shortname + '_header_top_line').is(':not(:checked)')) {
		$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but').parents('tr').hide();
	}
	
	if ($('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but').is(':not(:checked)')) {
		$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_text').parents('tr').hide();
		$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_link').parents('tr').hide();
	}
	
	
	if ($('input[name*="' + cmsmasters_donations_settings.shortname + '_header_styles"]:checked').val() === 'default') {
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').parents('tr').hide();
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').hide();
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_link').parents('tr').hide();
	}
	
	if ($('input[name*="' + cmsmasters_donations_settings.shortname + '_header_styles"]:checked').val() === 'c_nav') {
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').parents('tr').hide();
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').hide();
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_link').parents('tr').hide();
	}
	
	if ($('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').is(':not(:checked)')) {
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').hide();
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_link').parents('tr').hide();
	}
	
	
	
	/* General 'Header' Tab Fields Change */
	$('#' + cmsmasters_donations_settings.shortname + '_header_top_line').on('change', function () { 
		if ($('#' + cmsmasters_donations_settings.shortname + '_header_top_line').is(':checked')) {
			$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but').parents('tr').show();
			
			if ($('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but').is(':checked')) {
				$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_text').parents('tr').show();
				$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_link').parents('tr').show();
			} else {
				$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_text').parents('tr').hide();
				$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_link').parents('tr').hide();
			}
		} else {
			$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but').parents('tr').hide();
			$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_text').parents('tr').hide();
			$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_link').parents('tr').hide();
		}
	} );
	
	$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but').on('change', function () { 
		if ($('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but').is(':checked')) {
			$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_text').parents('tr').show();
			$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_link').parents('tr').show();
		} else {
			$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_text').parents('tr').hide();
			$('#' + cmsmasters_donations_settings.shortname + '_header_top_line_donations_but_link').parents('tr').hide();
		}
	} );
	
	
	$('input[name*="' + cmsmasters_donations_settings.shortname + '_header_styles"]').on('change', function () { 
		if ($('input[name*="' + cmsmasters_donations_settings.shortname + '_header_styles"]:checked').val() === 'default') {
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').parents('tr').hide();
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').hide();
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_link').parents('tr').hide();
		} else if ($('input[name*="' + cmsmasters_donations_settings.shortname + '_header_styles"]:checked').val() === 'c_nav') {
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').parents('tr').hide();
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').hide();
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_link').parents('tr').hide();
		} else {
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').parents('tr').show();
			
			if ($('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').is(':checked')) {
				$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').show();
				$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_link').parents('tr').show();
			} else {
				$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').hide();
				$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_link').parents('tr').hide();
			}
		}
	} );
	
	$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').on('change', function () { 
		if ($('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').is(':checked')) {
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').show();
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_link').parents('tr').show();
		} else {
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').hide();
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_link').parents('tr').hide();
		}
	} );
} )(jQuery);

