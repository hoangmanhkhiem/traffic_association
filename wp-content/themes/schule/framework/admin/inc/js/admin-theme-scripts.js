/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Script for Admin Panel
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function() { 
	"use strict";
	
	(function ($) { 
		/* Icons Lightbox Start */
		var cmsmastersLightbox = $('body').cmsmastersLightbox().data('cmsmastersLightbox');
		
		
		/* Open Icons Lightbox */
		$('body').on('click', '.cmsmasters_icon_choose_button', function () { 
			var icon_input = $(this).parent().find('.icon_upload_image');
			
			
			cmsmastersLightbox.methods.openLightbox( { 
				index : 	icon_input.attr('id'), 
				val : 		icon_input.val() 
			} );
		} );
		
		
		/* Selected Contact Info Remove */
		$('body').on('click', '.cmsmasters_remove_icon_contact_info', function () { 
			var contact_info_container = $(this).parents('div').eq(0).find('.contact_info_upload_link');
			
			
			$(this).parent().find('.icon_upload_image').val('').trigger('change');
			
			
			$(this).parent().find('.icon_upload_image').next('span').removeAttr('class').hide();
			
			
			$(this).hide();
			
			
			if (contact_info_container.length > 0) { 
				contact_info_container.hide();
				
				
				contact_info_container.nextAll('input.button').removeAttr('data-id').hide();
				
				
				contact_info_container.find('a.wp-color-result > span').css('background-color', 'transparent');
				
				
				contact_info_container.find('input:not(.button)').each(function () { 
					if ($(this).attr('type') !== 'checkbox') { 
						$(this).val('');
					} else { 
						$(this).prop('checked', false);
					}
				} );
			}
			
			
			return false;
		} );
		
		
		/* Selected Icon Remove */
		$('body').on('click', '.cmsmasters_remove_icon', function () { 
			var social_container = $(this).parents('div').eq(0).find('.icon_upload_link');
			
			
			if ($(this).parents('div').eq(0).hasClass('cmsmasters_category_icons')) {
				$(this).parent().find('.icon_upload_image').val('false').trigger('change');
			} else {
				$(this).parent().find('.icon_upload_image').val('').trigger('change');
			}
			
			
			$(this).parent().find('.icon_upload_image').next('span').removeAttr('class').hide();
			
			
			$(this).hide();
			
			
			if (social_container.length > 0) {
				social_container.hide();
				
				
				social_container.nextAll('input.button').removeAttr('data-id').hide();
				
				
				social_container.find('a.wp-color-result > span').css('background-color', 'transparent');
				
				
				social_container.find('input:not(.button)').each(function () { 
					if ($(this).attr('type') !== 'checkbox') {
						$(this).val('');
					} else {
						$(this).prop('checked', false);
					}
				} );
			}
			
			
			return false;
		} );
		
		
		/* Uploaded Image Remove */
		$('body').on('click', '.cmsmasters_upload .cmsmasters_upload_cancel', function () { 
			$(this).parent().fadeOut(500, function () {
				$(this).removeClass('cmsmasters_db').find('.cmsmasters_preview_image').attr('src', '');
				
				
				$(this).next().val('').trigger('change');
			} );
			
			
			return false;
		} );
	} )(jQuery);
} );

