/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version 	1.2.8
 * 
 * CMSMasters Donations Submit Donation Form Scripts
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function () { 
	(function ($) { 
		var payment_method = $('input:radio[name=donation_payment_method]'), 
			payment_checked = $('input:radio[name=donation_payment_method]:checked');
		
		
		if (payment_checked.lenth && (payment_checked.val() !== 'online')) {
			$('.donation-recurring_donation').hide();
		}
		
		
		payment_method.bind('click', function () { 
			if ($(this).val() === 'online') {
				$('.donation-recurring_donation').show();
			} else {
				$('.donation-recurring_donation').hide();
			}
		} );
	} )(jQuery);
	
	
	(function ($) { 
		var amount_text = $('input:text[name=donation_amount]'), 
			amount_radio = $("input:radio[name=donation_amount]");
		
		
		amount_radio.bind('click', function () { 
			var amount_value = $(this).val();
			
			
			amount_text.val(amount_value);
		} );
		
		
		amount_text.bind('change', function () { 
			amount_radio.prop('checked', false);
		} );
	} )(jQuery);
	
	
	if ( 
		cmsmasters_donations_form_script_params.gateway !== 'stripe' || 
		cmsmasters_donations_form_script_params.confirm 
	) {
		(function ($) { 
			$('#submit-donation-form').validationEngine('attach', { 
				promptPosition : 		'topRight', 
				scroll : 				false, 
				autoPositionUpdate : 	true, 
				showArrow : 			false 
			} );
		} )(jQuery);
	}
} );

