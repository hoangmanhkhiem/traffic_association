/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version 	1.0.0
 * 
 * CMSMasters Donations Settings Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	$(document).ready(function () {
		$('.nav-tab-wrapper a').bind('click', function () { 
			var tab = $(this), 
				tabhref = tab.attr('href');
			
			
			$('.settings_panel').hide();
			
			
			$('.nav-tab-active').removeClass('nav-tab-active');
			
			
			$(tabhref).show();
			
			
			tab.addClass('nav-tab-active');
			
			
			return false;
		} );
		
		
		$('.nav-tab-wrapper a:first').trigger('click');
	} );
} )(jQuery);

