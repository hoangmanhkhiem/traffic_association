/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * CMSMasters Donations Admin Settings Toggles Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	"use strict";
	
	/* General 'Header' Tab Fields Load */
	if ($('input[name*="' + cmsmasters_donations_settings.shortname + '_header_styles"]:checked').val() === 'default') {
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').parents('tr').show();
		$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').show();
	}
	
	
	
	/* General 'Header' Tab Fields Change */
	$('input[name*="' + cmsmasters_donations_settings.shortname + '_header_styles"]').on('change', function () { 
		if ($('input[name*="' + cmsmasters_donations_settings.shortname + '_header_styles"]:checked').val() === 'default') {
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but').parents('tr').show();
			$('#' + cmsmasters_donations_settings.shortname + '_header_donations_but_text').parents('tr').show();
		}
	} );
} )(jQuery);

