/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.1.0
 * 
 * Post, Page, Project & Profile Options Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	"use strict";
	
	$(document).ready(function () { 
		/* Color Field Type Script */
		$('.cmsmasters-color-field').wpColorPicker( { 
			palettes : 	cmsmasters_options.palettes.split(',') 
		} );
		
		
		/* Range Field Type Script */
		$('.cmsmasters-range-field').on('change', function () { 
			$(this).next('input.cmsmasters-range-field-number').val($(this).val());
		} );
		
		
		/* Options Tabs Change */
		$('h2.nav-tab-wrapper a.nav-tab').on('click', function () { 
			if ($(this).is(':not(.nav-tab-active)')) {
				$(this).parent().find('a.nav-tab.nav-tab-active').removeClass('nav-tab-active');
				$(this).parent().parent().find('div.nav-tab-content.nav-tab-content-active').hide();
				$(this).addClass('nav-tab-active').parent().parent().find('div' + $(this).attr('href')).addClass('nav-tab-content-active').show();
			}
			
			return false;
		} );
		
		
		/* Run funds stat */
		var funds_stat_width = $('.cmsmasters_funds_stat').data('width');

		$('.cmsmasters_funds_stat').attr('style', funds_stat_width);
		
		
		/* Gallery Image Remove */
		$('table.form-table .cmsmasters_gallery').on('click', '.cmsmasters_gallery_cancel', function () { 
			$(this).parents('li').fadeOut(500, function () {
				if ($(this).parents('ul').find('li').length < 2) {
					$(this).parents('ul').parent().find('.cmsmasters_upload_button').data( { 
						state : 	'gallery-library', 
						editing : 	false 
					} ).val(cmsmasters_options.create_gallery);
				}
				
				
				var listParent = $(this).parents('.cmsmasters_gallery_parent');
				
				
				$(this).remove();
				
				
				setTimeout(function () { 
					var newText = '';
					
					
					$('table.form-table .cmsmasters_gallery > li').each(function () { 
						newText += $(this).find('img').data('id') + '|';
						
						newText += $(this).find('img').attr('src') + ',';
					} );
					
					
					if (newText !== '') {
						newText = newText.slice(0, -1);
					}
					
					
					listParent.find('input[type="hidden"]').val(newText);
				}, 150);
			} );
			
			
			return false;
		} );
		
		
		/* Sort Gallery Images */
		$('table.form-table .cmsmasters_gallery').sortable( { 
			items : '> li', 
			handle : '> img', 
			tolerance : 'pointer', 
			opacity : 0.85, 
			cursor : 'move', 
			update : function (el) { 
				setTimeout(function () { 
					var newText = '';
					
					
					$('table.form-table .cmsmasters_gallery > li').each(function () { 
						newText += $(this).find('img').data('id') + '|';
						
						newText += $(this).find('img').attr('src') + ',';
					} );
					
					
					if (newText !== '') {
						newText = newText.slice(0, -1);
					}
					
					
					$(el.target).parents('.cmsmasters_gallery_parent').find('input[type="hidden"]').val(newText);
				}, 150);
			} 
		} );
		
		
		/* Repeatable Add Button Click */
		$('.repeatable-add').on('click', function () { 
			var field = $(this).parents('td').find('.custom_repeatable li:last').clone(true), 
				fieldLocation = $(this).parents('td').find('.custom_repeatable li:last');
			
			$('input', field).val('').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			if (field.hasClass('cmsmasters_dn')) {
				field.removeClass('cmsmasters_dn');
				
				field.insertAfter(fieldLocation, $(this).parents('td'));
				
				$(this).parents('td').find('.custom_repeatable li:first').remove();
			} else {
				field.insertAfter(fieldLocation, $(this).parents('td'));
			}
			
			return false;
		} );
		
		
		/* Repeatable Link Add Button Click */
		$('.repeatable-link-add').on('click', function () { 
			var select_name = $(this).prev().find('option:selected').text(), 
				select_link = $(this).prev().val(), 
				field = $(this).parents('td').find('.custom_repeatable li:last').clone(true), 
				fieldLocation = $(this).parents('td').find('.custom_repeatable li:last');
			
			$('input.cmsmasters_name', field).val((select_link !== '') ? select_name : '').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			$('input.cmsmasters_link', field).val((select_link !== '') ? select_link : '').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			if (field.hasClass('cmsmasters_dn')) {
				field.removeClass('cmsmasters_dn');
				
				field.insertAfter(fieldLocation, $(this).parents('td'));
				
				$(this).parents('td').find('.custom_repeatable li:first').remove();
			} else {
				field.insertAfter(fieldLocation, $(this).parents('td'));
			}
			
			return false;
		} );
		
		
		/* Repeatable Multiple Add Button Click */
		$('.repeatable-multiple-add').on('click', function () { 
			var field = $(this).parents('td').find('.custom_repeatable li:last').clone(true), 
				fieldLocation = $(this).parents('td').find('.custom_repeatable li:last');
			
			$('input.cmsmasters_name', field).val('').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			$('textarea.cmsmasters_val', field).val('').text('').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			if (field.hasClass('cmsmasters_dn')) {
				field.removeClass('cmsmasters_dn');
				
				field.insertAfter(fieldLocation, $(this).parents('td'));
				
				$(this).parents('td').find('.custom_repeatable li:first').remove();
			} else {
				field.insertAfter(fieldLocation, $(this).parents('td'));
			}
			
			return false;
		} );
		
		
		/* Repeatable Media Add Button Click */
		$('.repeatable-media-add').on('click', function () { 
			var select_format = $(this).prev().val(), 
				field = $(this).parents('td').find('.custom_repeatable li:last').clone(true), 
				fieldLocation = $(this).parents('td').find('.custom_repeatable li:last');
			
			if (select_format === '') {
				alert(cmsmasters_options.select_format);
				
				return false;
			}
			
			for (var i = 0, ilength = $(this).parents('td').find('.custom_repeatable li').length; i < ilength; i += 1) {
				if ($(this).parents('td').find('.custom_repeatable li:eq(' + i + ')').find('input.cmsmasters_format').val() === select_format) {
					alert(cmsmasters_options.link_exists);
					
					return false;
				}
			}
			
			$('input.cmsmasters_format', field).val(select_format).attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			$('input.cmsmasters_link', field).val('').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			if (field.hasClass('cmsmasters_dn')) {
				field.removeClass('cmsmasters_dn');
				
				field.insertAfter(fieldLocation, $(this).parents('td'));
				
				$(this).parents('td').find('.custom_repeatable li:first').remove();
			} else {
				field.insertAfter(fieldLocation, $(this).parents('td'));
			}
			
			return false;
		} );
		
		
		/* Repeatable Remove Button Click */
		$('.custom_repeatable').on('click', '.repeatable-remove', function () {
			if (confirm(cmsmasters_options.want_remove)) {
				if ($(this).parent().prev().is('li') || $(this).parent().next().is('li')) {
					$(this).parent().remove();
				} else {
					$(this).parent().find('.cmsmasters_name').val('');
					$(this).parent().find('.cmsmasters_val').text('');
					
					$(this).parent().addClass('cmsmasters_dn');
				}
			}
			
			return false;
		} );
		
		
		/* Repeatable Copy Button Click */
		$('.custom_repeatable').on('click', '.repeatable-copy', function () {
			var field = $(this).parents('li'), 
				fieldTitle = field.find('input.cmsmasters_name').val(), 
				fieldValues = field.find('textarea.cmsmasters_val').val(), 
				fieldClone = field.clone();
			
			
			fieldClone.insertAfter(field);
			
			
			field.next().find('input.cmsmasters_name').val(fieldTitle);
			
			field.next().find('textarea.cmsmasters_val').val(fieldValues);
			
			
			setTimeout(function () { 
				var fields = field.parents('ul').find('li'), 
					i = 0;
				
				
				fields.each(function () { 
					$('input.cmsmasters_name', this).attr('name', function (index, name) { 
						return name.replace(/(\d+)/, function (fullMatch, n) { 
							return i;
						} );
					} ).attr('id', function (index, id) { 
						return id.replace(/(\d+)/, function (fullMatch, n) { 
							return i;
						} );
					} );
					
					
					$('textarea.cmsmasters_val', this).attr('name', function (index, name) { 
						return name.replace(/(\d+)/, function (fullMatch, n) { 
							return i;
						} );
					} ).attr('id', function (index, id) { 
						return id.replace(/(\d+)/, function (fullMatch, n) { 
							return i;
						} );
					} );
					
					
					i += 1;
				} );
			}, 500);
			
			
			return false;
		} );
		
		
		/* Repeatable Sorting Script */
		$('.custom_repeatable').sortable( { 
			opacity : 0.7, 
			revert : true, 
			cursor : 'move', 
			handle : '.sort' 
		} );
		
		
		/* Project Size Change Script */
		$('.cmsmasters_tr_radio_img_pj input[type="radio"]').on('change', function () { 
			var pj_size = $(this).attr('data-size');
			
			
			$(this).parents('tr.cmsmasters_tr_radio_img_pj').find('span.description > strong.pj_size').html(pj_size);
			
			
			return false;
		} );
		
		
		/* Contact Info Field Type Script */
		$('.contact_info_management').on('click', '.icon_del', function () { 
			var del_icon_number = Number($('#custom_contact_icons_number').val()) - 1;
			
			if (confirm(cmsmasters_options.remove_icon)) {
				$('#custom_contact_icons_number').val(del_icon_number);
				
				
				if ( 
					$('#edit_contact_info').is(':visible') && 
					$('#edit_contact_info').data('id') === $(this).parent().find('input[type="hidden"]').attr('id') 
				) {
					$(this).parents('div').eq(0).find('.cmsmasters_remove_icon').trigger('click');
				}
				
				
				$(this).parent().remove();
				
				
				var li_input = undefined, 
					li_input_val = '';
				
				
				for (var n = 1; n <= del_icon_number; n += 1) { 
					li_input = $('.contact_info_management > ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]');
					
					
					li_input_val = li_input.attr('name').split('[');
					
					
					$('.contact_info_management > ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]').attr( { 
						name : 	li_input_val[0] + '[' + n + ']', 
						id : 	li_input_val[0] + '_' + n 
					} );
				}
			}
			
			
			return false;
		} );
		
		
		$('.contact_info_management > ul').on('click', '> li > div', function () { 
			var edit_contact_info_val = $(this).find('input[type="hidden"]').val().split('|'), 
				edit_contact_info_class = $(this).attr('class'), 
				edit_contact_info_id = $(this).find('input[type="hidden"]').attr('id'), 
				social_container = $(this).parents('.contact_info_management');
			
			$('#add_contact_info').hide();
			
			
			$('#edit_contact_info').attr( { 
				'data-id' : edit_contact_info_id 
			} ).show();
			
			
			social_container.find('.icon_upload_image').val(edit_contact_info_val[0]);
			
			social_container.find('.icon_upload_image').next('span').attr('class', edit_contact_info_val[0]).show();
			
			social_container.find('.cmsmasters_remove_icon').show();
			
			
			$('#contact_info_link').val(edit_contact_info_val[1]);
			
			$('#contact_info_title').val(edit_contact_info_val[2]);
			
			
			$('#contact_info_target').prop('checked', ((edit_contact_info_val[3] == 'true') ? true : false));
			
			
			$('.contact_info_upload_link').show();
			
			
			return false;
		} );
		
		
		$('#add_contact_info').on('click', function () { 
			
			if ($('#new_icon_name').val() !== '') {
				var icon_number = Number($('#custom_contact_icons_number').val()) + 1, 
					icon_name = $('#custom_contact_icons_number').attr('name').split('_number'), 
					icon_class = $(this).parent().find('.icon_upload_image').val();
				
				
				$('#custom_contact_icons_number').val(icon_number);
				
				
				$('.contact_info_management > ul').append('<li>' + 
					'<div class="' + icon_class + '">' + 
						$('#contact_info_title').val() + 
						'<input type="hidden" id="' + icon_name[0] + '_' + icon_number + 
						'" name="' + icon_name[0] + '[' + icon_number + 
						']" value="' + icon_class + '|' + 
						(($('#contact_info_link').val() != '') ? $('#contact_info_link').val() : '') + '|' + 
						$('#contact_info_title').val() + '|' + 
						(($('#contact_info_target').is(':checked')) ? 'true' : 'false') + '" />' + 
					'</div>' + 
					'<a href="#" class="icon_del admin-icon-remove" title="' + cmsmasters_options.remove + '"></a> ' + 
					'<span class="icon_move admin-icon-move"></span> ' + 
				'</li>');
				
				
				$(this).parent().find('.cmsmasters_remove_icon').trigger('click');
				
				$('#contact_info_link').val('');
				
				$('#contact_info_title').val('');
				
				
				$('#contact_info_target').prop('checked', false);
				
				
				$('.contact_info_upload_link').hide();
				
				
				$('#add_contact_info').hide();
			}
			
			
			return false;
		} );
		
		
		$('#edit_contact_info').on('click', function () { 
			var edit_contact_info_data_id = $(this).attr('data-id'), 
				icon_class = $(this).parent().find('.icon_upload_image').val();
			
			
			if ($('#new_icon_name').val() !== '') { 
				$('input#' + edit_contact_info_data_id).val(icon_class + '|' + 
				(($('#contact_info_link').val() != '') ? $('#contact_info_link').val() : '') + '|' + 
				$('#contact_info_title').val() + '|' + 
				(($('#contact_info_target').is(':checked')) ? 'true' : 'false'));
				
				
				$('input#' + edit_contact_info_data_id).parent().removeAttr('class').addClass(icon_class);
				
				
				$(this).parent().find('.cmsmasters_remove_icon').trigger('click');
				
				
				$('#contact_info_link').val('');
				
				$('#contact_info_title').val('');
				
				
				$('#contact_info_target').prop('checked', false);
				
				
				$('.contact_info_upload_link').hide();
				
				
				$('#edit_contact_info').hide();
			}
			
			
			return false;
		} );
		
		
		$('.contact_info_management > ul').sortable( { 
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
				
				
				if ($('#edit_contact_info').is(':visible')) {
					$(this).parent().find('.cmsmasters_remove_icon').trigger('click');
				}
			} 
		} );
		
		
		/* Social Field Type Script */
		$('.icon_management').on('click', '.icon_del', function () { 
			var del_icon_number = Number($('#custom_icons_number').val()) - 1;
			
			
			if (confirm(cmsmasters_options.remove_icon)) {
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
					
					
					li_input_val = li_input.attr('name').split('[');
					
					
					$('.icon_management > ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]').attr( { 
						name : 	li_input_val[0] + '[' + n + ']', 
						id : 	li_input_val[0] + '_' + n 
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
			
			
			social_container.find('.icon_upload_image').val(edit_icon_val[0]);
			
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
					icon_name = $('#custom_icons_number').attr('name').split('_number'), 
					icon_class = $(this).parent().find('.icon_upload_image').val();
				
				
				$('#custom_icons_number').val(icon_number);
				
				
				$('.icon_management > ul').append('<li>' + 
					'<div class="' + icon_class + '">' + 
						'<input type="hidden" id="' + icon_name[0] + '_' + icon_number + 
						'" name="' + icon_name[0] + '[' + icon_number + 
						']" value="' + icon_class + '|' + 
						(($('#new_icon_link').val() != '') ? $('#new_icon_link').val() : '#') + '|' + 
						$('#new_icon_title').val() + '|' + 
						(($('#new_icon_target').is(':checked')) ? 'true' : 'false') + '|' + 
						$('#new_icon_color').val() + '|' + 
						$('#new_icon_hover').val() + '" />' + 
					'</div>' + 
					'<a href="#" class="icon_del admin-icon-remove" title="' + cmsmasters_options.remove + '"></a> ' + 
					'<span class="icon_move admin-icon-move"></span> ' + 
				'</li>');
				
				
				$(this).parent().find('.cmsmasters_remove_icon').trigger('click');
				
				
				$('#new_icon_link').val('');
				
				$('#new_icon_title').val('');
				
				
				$('#new_icon_target').prop('checked', false);
				
				
				$('.icon_upload_link').hide();
				
				
				$('#add_icon').hide();
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
				
				
				$('#new_icon_link').val('');
				
				$('#new_icon_title').val('');
				
				
				$('#new_icon_target').prop('checked', false);
				
				
				$('.icon_upload_link').hide();
				
				
				$('#edit_icon').hide();
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


/* Update Media Uploader Images ID's Function */
function cmsmastersOptionsUploadIdsUpdate() { 
	"use strict";
	
	var href_array = '';
	
	
	jQuery('ul.gallery_post_image_list > li').each(function () { 
		href_array += jQuery(this).find('> a').attr('href') + ',';
	} );
	
	
	jQuery('ul.gallery_post_image_list').next().val(href_array.slice(0, -1));
}

