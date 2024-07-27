/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.1
 * 
 * Admin Panel Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	"use strict";
	
	$(document).ready(function () { 
		/* Color Field Type Script */
		$('.cmsmasters-color-field').wpColorPicker( { 
			palettes : 	cmsmasters_setting.palettes.split(',') 
		} );
		
		
		/* Number Field Type Script */
		$('.cmsmasters-range-field').on('change', function () { 
			$(this).next('input.cmsmasters-range-field-number').val($(this).val());
		} );
		
		
		/* Sidebars Field Type Script */
		$('.sidebar_management').on('click', '.sidebar_del', function () { 
			var del_sidebar_number = Number($('#custom_sidebars_number').val()) - 1, 
				li_input = undefined, 
				li_input_val = '';
			
			
			if (confirm(cmsmasters_setting.remove_sidebar)) {
				$('#custom_sidebars_number').val(del_sidebar_number);
				
				
				$(this).parent().remove();
				
				
				for (var n = 1; n <= del_sidebar_number; n += 1) {
					li_input = $('.sidebar_management ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]');
					
					
					li_input_val = li_input.attr('name').split('_-_');
					
					
					$('.sidebar_management ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]').attr( { name :  li_input_val[0] + '_-_' + n + ']'} );
				}
			}
			
			
			return false;
		} );
		
		
		$('#add_sidebar').on('click', function () {
			if ($('#new_sidebar_name').val() !== '') {
				var sidebar_number = Number($('#custom_sidebars_number').val()) + 1, 
					sidebar_name = $('#custom_sidebars_number').attr('name').split('_number]');
				
				
				$('#custom_sidebars_number').val(sidebar_number);
				
				
				$('.sidebar_management ul').append('<li>' + 
					'<a href="#" class="sidebar_del admin-icon-remove" title="' + cmsmasters_setting.remove + '"></a> ' + 
					$('#new_sidebar_name').val() + 
					'<input type="hidden" name="' + sidebar_name[0] + '_-_' + sidebar_number + ']" value="' + $('#new_sidebar_name').val() + '" />' + 
				'</li>');
				
				
				$('#new_sidebar_name').val('');
			}
			
			
			return false;
		} );
		
		
		/* Custom Google Font Field Type Script */
		$('#add_google_web_font').on('click', function () {
			var font_family_label = $(this).data('fontFamilyLabel'),
				font_style_label = $(this).data('fontStyleLabel'),
				option_name = $(this).data('optionName'),
				number = Number($('#google_web_fonts_number').val()) + 1,
				container = $('.google_web_fonts_manager_items');
			
			
			container.append(
				'<div class="google_web_fonts_manager_item">' +
					'<input class="all-options" type="text" id="google_web_font_family" placeholder="' + font_family_label + '" name="' + option_name + number + '_family]" value="" />' + 
					'<input class="regular-text" type="text" id="google_web_font_style" placeholder="' + font_style_label + '" name="' + option_name + number + '_style]" value="" />' + 
					'<span class="remove_google_web_font dashicons-trash"></span>' + 
				'</div>'
			);
			
			
			$('#google_web_fonts_number').val(number);
			
			
			return false;
		} );
		
		$('.google_web_fonts_manager').on('click', '.remove_google_web_font', function () { 
			$(this).closest('.google_web_fonts_manager_item').remove();
		} );

		
		/* Social Field Type Script */
		$('.icon_management').on('click', '.icon_del', function () { 
			var del_icon_number = Number($('#custom_icons_number').val()) - 1;
			
			
			if (confirm(cmsmasters_setting.remove_icon)) {
				$('#custom_icons_number').val(del_icon_number);
				
				
				if ( 
					$('#edit_icon').is(':visible') && 
					$('#edit_icon').data('id') === $(this).parent().find('input[type="hidden"]').attr('id') 
				) {
					$(this).parents('div').eq(0).find('.cmsmasters_remove_icon').trigger('click');
				}
				
				
				$(this).parent().remove();
				
				
				var li_input = undefined, 
					li_input_val = '';
				
				
				for (var n = 1; n <= del_icon_number; n += 1) {
					li_input = $('.icon_management > ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]');
					
					
					li_input_val = li_input.attr('name').split('_-_');
					
					
					$('.icon_management > ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]').attr( { 
						name : 	li_input_val[0] + '_-_' + n + ']', 
						id : 	li_input_val[0] + '_-_' + n + ']' 
					} );
				}
			}
			
			
			return false;
		} );
		
		
		$('.icon_management > ul').on('click', '> li > div', function () { 
			var edit_icon_val = $(this).find('input[type="hidden"]').val().split('|'), 
				edit_icon_class = $(this).attr('class'), 
				edit_icon_id = $(this).find('input[type="hidden"]').attr('id'), 
				social_container = $(this).parents('.icon_management');
			
			
			$('#add_icon').hide();
			
			
			$('#edit_icon').attr( { 
				'data-id' : edit_icon_id 
			} ).show();
			
			
			social_container.find('.icon_upload_image').val(edit_icon_val[0])
			
			social_container.find('.icon_upload_image').next('span').attr('class', edit_icon_val[0]).show();
			
			social_container.find('.cmsmasters_remove_icon').show();
			
			
			$('#new_icon_link').val(edit_icon_val[1]);
			
			$('#new_icon_title').val(edit_icon_val[2]);
			
			
			$('#new_icon_target').prop('checked', ((edit_icon_val[3] == 'true') ? true : false));
			
			
			$('#new_icon_color').val(edit_icon_val[4]).trigger('change');
			
			$('#new_icon_color').closest('.wp-picker-container').find('a.wp-color-result > span').css('background-color', edit_icon_val[4]);
			
			
			$('#new_icon_hover').val(edit_icon_val[5]).trigger('change');
			
			$('#new_icon_hover').closest('.wp-picker-container').find('a.wp-color-result > span').css('background-color', edit_icon_val[5]);
			
			
			$('.icon_upload_link').show();
			
			
			return false;
		} );
		
		
		$('#add_icon').on('click', function () { 
			if ($('#new_icon_name').val() !== '') {
				var icon_number = Number($('#custom_icons_number').val()) + 1, 
					icon_name = $('#custom_icons_number').attr('name').split('_number]'), 
					icons_id = icon_name[0].split('['), 
					icon_class = $(this).parent().find('.icon_upload_image').val();
				
				
				$('#custom_icons_number').val(icon_number);
				
				
				$('.icon_management > ul').append('<li>' + 
					'<div class="' + icon_class + '">' + 
						'<input type="hidden" id="' + icons_id[0] + '_' + icons_id[1] + '_-_' + icon_number + 
						'" name="' + icon_name[0] + '_-_' + icon_number + 
						']" value="' + icon_class + '|' + 
						(($('#new_icon_link').val() != '') ? $('#new_icon_link').val() : '#') + '|' + 
						$('#new_icon_title').val() + '|' + 
						(($('#new_icon_target').is(':checked')) ? 'true' : 'false') + '|' + 
						$('#new_icon_color').val() + '|' + 
						$('#new_icon_hover').val() + '" />' + 
					'</div>' + 
					'<a href="#" class="icon_del admin-icon-remove" title="' + cmsmasters_setting.remove + '"></a> ' + 
					'<span class="icon_move admin-icon-move"></span> ' + 
				'</li>');
				
				
				$(this).parent().find('.cmsmasters_remove_icon').trigger('click');
			}
			
			
			return false;
		} );
		
		
		$('#edit_icon').on('click', function () { 
			var edit_icon_data_id = $(this).attr('data-id'), 
				icon_class = $(this).parent().find('.icon_upload_image').val();
			
			
			if ($('#new_icon_name').val() !== '') {
				$('input#' + edit_icon_data_id).val(icon_class + '|' + 
				(($('#new_icon_link').val() != '') ? $('#new_icon_link').val() : '#') + '|' + 
				$('#new_icon_title').val() + '|' + 
				(($('#new_icon_target').is(':checked')) ? 'true' : 'false') + '|' + 
				$('#new_icon_color').val() + '|' + 
				$('#new_icon_hover').val());
				
				
				$('input#' + edit_icon_data_id).parent().removeAttr('class').addClass(icon_class);
				
				
				$(this).parent().find('.cmsmasters_remove_icon').trigger('click');
			}
			
			
			return false;
		} );
		
		
		$('.icon_management > ul').sortable( { 
			items : 		'> li', 
			placeholder : 	'ui-sortable-highlight', 
			handle : 		'.icon_move', 
			update : 		function () { 
				var numb = 1;
				
				
				$(this).find('> li > div > input').each(function () { 
					$(this).attr('id', $(this).attr('id').slice(0, -1) + numb);
					
					
					$(this).attr('name', $(this).attr('name').slice(0, -2) + numb + ']');
					
					
					numb += 1;
				} );
				
				
				if ($('#edit_icon').is(':visible')) {
					$(this).parent().find('.cmsmasters_remove_icon').trigger('click');
				}
			} 
		} );
	} );
} )(jQuery);


/* Field Error Highlight Script */
(function ($) { 
	"use strict";
	
	var error_msg = $('#message p[class="setting-error-message"]');
	
	
	if (error_msg.length != 0) {
		var error_setting = error_msg.attr('title');
		
		
		$('label[for="' + error_setting + '"]').addClass('error');
		
		
		$('input[id="' + error_setting + '"]').attr('style', 'border-color:red');
	}
} )(jQuery);


/* Apply Theme Style Button Click Function */
(function ($) { 
	"use strict";
	
	$('.cmsmasters-apply-theme-style').on('click', function () { 
		var settings_field = 	$('#' + cmsmasters_setting.shortname + '_theme_style'), 
			theme_style = 	settings_field.val();
		
		
		$.ajax( { 
			type : 				'POST', 
			url : 				ajaxurl, 
			data : { 
				theme_style :	theme_style, 
				action : 		'cmsmasters_ajax_apply_theme_style', 
				nonce : 		cmsmasters_setting.nonce_ajax_apply_theme_style 
			}, 
			dataType : 			'text' 
		} ).fail(function () { 
			alert(cmsmasters_setting.fail);
		} );
	} );
} )(jQuery);


/* Reset Settings Button Click Function */
(function ($) { 
	"use strict";
	
	$('.cmsmasters-reset-settings').on('click', function () { 
		$.ajax( { 
			type : 				'POST', 
			url : 				ajaxurl, 
			data : { 
				action : 		'cmsmasters_ajax_reset_settings', 
				nonce : 		cmsmasters_setting.nonce_ajax_reset_settings 
			}, 
			dataType : 			'text' 
		} ).done(function () { 
			alert(cmsmasters_setting.done_reset_settings);
		} ).fail(function () { 
			alert(cmsmasters_setting.fail);
		} );
	} );
} )(jQuery);


/* Import Button Click Function */
(function ($) { 
	"use strict";
	
	$('.cmsmasters-demo-import').on('click', function () { 
		var settings_field = 	$('#' + cmsmasters_setting.shortname + '_demo_import'), 
			theme_settings = 	settings_field.val();
		
		
		$.ajax( { 
			type : 				'POST', 
			url : 				ajaxurl, 
			data : { 
				settings :		theme_settings, 
				action : 		'cmsmasters_ajax_import_settings', 
				nonce : 		cmsmasters_setting.nonce_ajax_import_settings 
			}, 
			dataType : 			'text' 
		} ).done(function () { 
			settings_field.val('');
			
			
			alert(cmsmasters_setting.done);
		} ).fail(function () { 
			alert(cmsmasters_setting.fail);
		} );
	} );
} )(jQuery);


/* Export Button Click Function */
(function ($) { 
	"use strict";
	
	$('input.cmsmasters-demo-export').on('click', function () { 
		var data = { 
			action : 		'cmsmasters_ajax_export_settings', 
			nonce : 		cmsmasters_setting.nonce_ajax_export_settings 
		};
		
		
		var IEversion = detectIE(); 
		
		function detectIE() { 
			var ua = window.navigator.userAgent; 
			
			var msie = ua.indexOf('MSIE '); 
			if (msie > 0) { 
				return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10); 
			} 
			
			var trident = ua.indexOf('Trident/'); 
			if (trident > 0) { 
				var rv = ua.indexOf('rv:'); 
				return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10); 
			} 
			
			var edge = ua.indexOf('Edge/'); 
			if (edge > 0) {
				return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
			}

			return false;
		}
		
		
		$.post(ajaxurl, data, function (response) {
			var blob = new Blob([response], {
					type : 		'plain/text', 
					endings : 	'native' 
				} ),
				link = document.createElement('a');
			
			if (IEversion !== false) {
				if ( $( "#cmsmasters-demo-export-content" ).length == 0 ) {
					var trToAppendTo = 'tr.cmsmasters-demo-export > td';
					$(trToAppendTo).append('<br><br><textarea id="cmsmasters-demo-export-content" rows="5" cols="50">');
					$(trToAppendTo).append('</textarea><br><br><span class="description">Copy and paste this code into the import window</span>');
				}
				
				$('#cmsmasters-demo-export-content').val(response);
			} else { 
				link.href = window.URL.createObjectURL(blob);
				
				document.body.appendChild(link);
				
				link.download = 'theme-settings' + cmsmasters_setting.theme_style_name + '.txt';
				
				link.click();
				
				document.body.removeChild(link);
			}
		} );
		
		return false;
	} );
} )(jQuery);

