/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.8
 * 
 * Icon Lightbox jQuery Plugin
 * Created by CMSMasters
 * 
 */

 
(function ($) { 
	"use strict";
	
	var CmsmastersLightbox = function (element, parameters) { 
		var defaults = { 
				closeButtons : 		true, 
				backdropClose : 	true, 
				closeButtonText : 	cmsmasters_admin_lightbox.cancel, 
				saveButtonText : 	cmsmasters_admin_lightbox.insert, 
				boxTitle : 			false, 
				loadURL : 			false, 
				loadData : 			false 
			}, 
			obj = this, 
			privateMethods = {};
		
		// Global Methods
		obj.methods = { 
			init : function () { 
				obj.methods.options = $.extend({}, defaults, parameters);
				
				
				obj.methods.setVars();
			}, 
			setVars : function () { 
				obj.methods.el = $(element);
				
				
				obj.methods.body = $('body');
				
				
				obj.methods.lbHTML = '<div class="cmsmastersLightBoxOut">' + 
					'<div class="cmsmastersLightBoxBack"></div>' + 
					'<div class="cmsmastersLightBoxCont">' + 
						'<div class="cmsmastersLightBoxContIn admin-icon-loader animate-spin">' + 
							'<div class="cmsmastersLightBoxContInTop wrap"></div>' + 
							'<div class="cmsmastersLightBoxContInMid"></div>' + 
							'<div class="cmsmastersLightBoxContInBot"></div>' + 
						'</div>' + 
					'</div>' + 
				'</div>';
			}, 
			resetVars : function () { 
				obj.methods.uniqID = privateMethods.getUniqID();
				
				
				obj.methods.lbStructure = $(obj.methods.lbHTML);
				
				
				obj.methods.back = obj.methods.lbStructure.find('.cmsmastersLightBoxBack');
				obj.methods.cont = obj.methods.lbStructure.find('.cmsmastersLightBoxCont');
				
				obj.methods.contIn = obj.methods.cont.find('.cmsmastersLightBoxContIn');
				
				obj.methods.contInTop = obj.methods.contIn.find('.cmsmastersLightBoxContInTop');
				obj.methods.contInMid = obj.methods.contIn.find('.cmsmastersLightBoxContInMid');
				obj.methods.contInBot = obj.methods.contIn.find('.cmsmastersLightBoxContInBot');
				
				
				obj.methods.icons = cmsmasters_composer_icons();
				
				obj.methods.fontsCount = 0;
				
				
				obj.methods.container = '';
				
				obj.methods.firstField = '';
				
				
				obj.methods.buildObj();
				
				
				privateMethods.attachEvents();
			}, 
			buildObj : function () { 
				if (obj.methods.options.closeButtons) {
					obj.methods.contInTop.append('<a href="#" class="cmsmastersLightBoxClose admin-icon-remove" title="' + obj.methods.options.closeButtonText + '"></a>');
					
					
					obj.methods.lbCloseBut = obj.methods.contInTop.find('.cmsmastersLightBoxClose');
				}
				
				
				obj.methods.contInTop.append('<h2>' + cmsmasters_admin_lightbox.choose_icon + '</h2>');
				
				
				obj.methods.lbTitle = obj.methods.contInTop.find('h2');
				
				
				obj.methods.lbTitleText = obj.methods.lbTitle.text();
				
				
				if (obj.methods.options.closeButtons) {
					obj.methods.contInBot.append('<a href="#" class="cmsmastersLightBoxCancel button button-large" title="' + obj.methods.options.closeButtonText + '">' + 
						obj.methods.options.closeButtonText + 
					'</a>');
					
					
					obj.methods.lbCancelBut = obj.methods.contInBot.find('.cmsmastersLightBoxCancel');
				}
				
				
				obj.methods.contInBot.append('<a href="#" class="cmsmastersLightBoxSave button button-primary button-large" title="' + obj.methods.options.saveButtonText + '">' + 
					obj.methods.options.saveButtonText + 
				'</a>');
				
				
				obj.methods.lbSaveBut = obj.methods.contInBot.find('.cmsmastersLightBoxSave');
			}, 
			openLightbox : function (data) { 
				obj.methods.resetVars();
				
				
				obj.methods.lbStructure.attr( { 
					id : 				'cmsmastersLightBox_' + obj.methods.uniqID, 
					'data-id' : 		obj.methods.uniqID, 
					'data-index' : 		data.index 
				} );
				
				
				if (privateMethods.getWinWidth() < 930) {
					obj.methods.cont.addClass('resp');
				}
				
				
				obj.methods.body.append(obj.methods.lbStructure);
				
				
				obj.methods.body.css( { 
					overflow : 'hidden' 
				} ).find('#cmsmastersLightBox_' + obj.methods.uniqID).addClass('showBox preloadBox');
				
				
				if (obj.methods.lbSaveBut.is(':hidden')) {
					obj.methods.lbSaveBut.removeAttr('style');
				}
				
				
				obj.methods.container += obj.methods.generateContainer(data.val);
				
				obj.methods.firstField += obj.methods.generateFirstField(data.val);
				
				
				obj.methods.body.find('#cmsmastersLightBox_' + obj.methods.uniqID).find('.cmsmastersLightBoxContInMid').append(obj.methods.container);
				
				obj.methods.body.find('#cmsmastersLightBox_' + obj.methods.uniqID).find('input.cmsmasters_icon_value').before(obj.methods.firstField);
				
				
				for (var font in obj.methods.icons) {
					if (obj.methods.fontsCount !== 0) {
						obj.methods.generateField(font, data.val);
					}
					
					
					obj.methods.fontsCount += 1;
				}
				
				
				obj.methods.body.find('#cmsmastersLightBox_' + obj.methods.uniqID).removeClass('preloadBox');
				
				
				setTimeout(function () { 
					privateMethods.attachGeneratedEvents();
				}, 100);
			}, 
			generateContainer : function (val) { 
				var fieldContent = '';
				
				
				fieldContent += '<div class="cmsmasters_content_box full_width" data-id="icon_' + obj.methods.uniqID + '" data-type="icon">' + 
					'<div class="cmsmasters_field cmsmasters_field_icon">';
				
				
				fieldContent += '<div class="icons_list_parent">' + 
					'<a href="#" class="cmsmasters_icon_cancel admin-icon-remove"' + ((val !== '') ? '' : ' style="display:none;"') + '>' + cmsmasters_admin_lightbox.deselect + '</a>' + 
					'<div class="cmsmasters_icon_search">' + 
						'<label>' + cmsmasters_admin_lightbox.find_icons + ':<span>(' + cmsmasters_admin_lightbox.min_length + ')</span></label>' + 
						'<input type="text" name="cmsmasters_icon_search" />' + 
					'</div>' + 
					'<div class="cl"></div>';
				
				
				fieldContent += '<label for="cmsmasters_icon_font_select" class="cmsmasters_icon_font_label">' + cmsmasters_admin_lightbox.choose_font + ':</label>' + 
				'<select name="cmsmasters_icon_font_select" class="cmsmasters_icon_font_select">';
				
				
				for (var font in obj.methods.icons) {
					fieldContent += '<option value="' + font + '">' + font.slice(0, 1).toUpperCase() + font.slice(1) + '</option>';
				}
				
				
				fieldContent += '</select>';
				
				
				fieldContent += '<input type="hidden" id="icon_' + obj.methods.uniqID + '" name="icon_' + obj.methods.uniqID + '" value="' + val + '" class="cmsmasters_icon_value" />' + 
				'</div>';
				
				
				fieldContent += '</div>' + 
					'</div>' + 
				'</div>';
				
				
				return fieldContent;
			}, 
			generateFirstField : function (val) { 
				var fieldContent = '', 
					counter = 0;
				
				
				for (var font in obj.methods.icons) {
					if (counter === 0) {
						fieldContent += '<div class="cmsmasters_icon_font cmsmasters_icon_font_' + font + '" style="display: block;">' + 
						'<h3>' + font.slice(0, 1).toUpperCase() + font.slice(1) + '</h3>' + 
						'<ul>';
						
						
						for (var k in obj.methods.icons[font]) {
							fieldContent += '<li' + ((obj.methods.icons[font][k] === val) ? ' class="active"' : '') + '><span class="' + obj.methods.icons[font][k] + '" data-code="' + k + '" title="' + k + '"></span></li>';
						}
						
						
						fieldContent += '</ul>' + 
						'</div>';
					}
					
					
					counter += 1;
				}
				
				
				return fieldContent;
			}, 
			generateField : function (font, val) { 
				var fieldContent = '';
				
				
				fieldContent += '<div class="cmsmasters_icon_font cmsmasters_icon_font_' + font + '">' + 
				'<h3>' + font.slice(0, 1).toUpperCase() + font.slice(1) + '</h3>' + 
				'<ul>';
				
				
				for (var k in obj.methods.icons[font]) {
					fieldContent += '<li' + ((obj.methods.icons[font][k] === val) ? ' class="active"' : '') + '><span class="' + obj.methods.icons[font][k] + '" data-code="' + k + '" title="' + k + '"></span></li>';
				}
				
				
				fieldContent += '</ul>' + 
				'</div>';
				
				
				obj.methods.body.find('#cmsmastersLightBox_' + obj.methods.uniqID).find('input.cmsmasters_icon_value').before(fieldContent);
			}, 
			saveContent : function (id) { 
				var icon_value = '';
				
				
				obj.methods.body.find('#cmsmastersLightBox_' + id).find('.cmsmastersLightBoxContInMid > div').each(function () { 
					if ($(this).is(':visible')) {
						var fieldID = $(this).data('id'), 
							fieldName = fieldID.replace('_' + id, '');
						
						
						if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '') {
							icon_value += $(this).find('> .cmsmasters_field #' + fieldID).val();
						}
					}
				} );
				
				
				setTimeout(function () { 
					privateMethods.loadContent(icon_value, id);
				}, 150);
			}, 
			closeLightbox : function (id) { 
				obj.methods.body.find('#' + id).removeClass('showBox');
				
				
				if (obj.methods.body.find('.cmsmastersLightBoxOut').length < 2) {
					obj.methods.body.css( { 
						overflow : 'auto' 
					} );
				}
				
				
				if (obj.methods.body.find('.cmsmastersLightBoxOut').length > 1) {
					obj.methods.uniqID = obj.methods.body.find('.cmsmastersLightBoxOut').eq(-2).data('id');
				}
				
				
				setTimeout(function () { 
					privateMethods.destroyLightbox(id);
				}, 150);
			} 
		};
		
		// Private Methods
		privateMethods = { 
			attachEvents : function () { 
				obj.methods.lbCloseBut.on('click', function () { 
					var id = privateMethods.getLbID(this);
					
					
					obj.methods.body.find('#' + id).addClass('preloadBox');
					
					
					obj.methods.closeLightbox(id);
					
					
					return false;
				} );
				
				
				obj.methods.lbCancelBut.on('click', function () { 
					var id = privateMethods.getLbID(this);
					
					
					obj.methods.body.find('#' + id).addClass('preloadBox');
					
					
					obj.methods.closeLightbox(id);
					
					
					return false;
				} );
				
				
				if (obj.methods.options.backdropClose) {
					obj.methods.back.on('click', function () { 
						var id = privateMethods.getLbID(this);
						
						
						obj.methods.body.find('#' + id).addClass('preloadBox');
						
						
						obj.methods.closeLightbox(id);
						
						
						return false;
					} );
				}
				
				
				obj.methods.lbSaveBut.on('click', function () { 
					obj.methods.saveContent($(this).parents('.cmsmastersLightBoxOut').data('id'));
					
					
					return false;
				} );
				
				
				$(window).on('resize', function () { 
					if (privateMethods.getWinWidth() < 930) {
						obj.methods.cont.addClass('resp');
					} else if (obj.methods.cont.hasClass('resp')) {
						obj.methods.cont.removeClass('resp');
					}
				} );
			}, 
			loadContent : function (data, id) { 
				var idx = obj.methods.body.find('#cmsmastersLightBox_' + id).data('index').toString(), 
					social_container = $('#' + idx).parents('div').eq(0).find('.icon_upload_link'), 
					contact_info_container = $('#' + idx).parents('div').eq(0).find('.contact_info_upload_link');
				
				
				if (typeof idx === 'string') {
					$('#' + idx).val(data).trigger('change');
					
					
					if (data !== '') {
						$('#' + idx + '_icon').attr('class', data).show();
						
						
						$('#' + idx).parent().find('.cmsmasters_remove_icon').show();
						
						
						social_container.show();
						
						
						if (social_container.nextAll('input.button').eq(1).is(':not(:visible)')) {
							social_container.nextAll('input.button').eq(0).show();
						}
						
						
						contact_info_container.show();
						
						
						if (contact_info_container.nextAll('input.button').eq(1).is(':not(:visible)')) {
							contact_info_container.nextAll('input.button').eq(0).show();
						}
					} else {
						$('#' + idx + '_icon').removeAttr('class').hide();
						
						
						$('#' + idx).parent().find('.cmsmasters_remove_icon').trigger('click');
					}
				} else {
					alert(cmsmasters_admin_lightbox.error_on_page);
					
					
					return false;
				}
				
				
				obj.methods.body.find('#' + id).addClass('preloadBox');
				
				
				obj.methods.closeLightbox('cmsmastersLightBox_' + id);
			}, 
			destroyLightbox : function (id) { 
				obj.methods.body.find('#' + id).find('.cmsmastersLightBoxContInMid > div').remove();
				
				
				obj.methods.body.find('#' + id).remove();
			}, 
			attachGeneratedEvents : function () { 
				// Icons Filter
				$('#cmsmastersLightBox_' + obj.methods.uniqID + ' .cmsmasters_icon_search > input[type="text"]').on('input', function () { 
					var val = $(this).val(), 
						parent = $(this).parents('.icons_list_parent'), 
						font = parent.find('.cmsmasters_icon_font_select').val();
					
					
					parent.find('.cmsmasters_icon_font').hide();
					
					
					if (val !== '' && val.length > 1) {
						parent.find('ul > li > span').each(function () { 
							var code = $(this).data('code');
							
							
							if (code.replace(val, '') !== code) {
								$(this).parent().removeAttr('style');
							} else {
								$(this).parent().css('display', 'none');
							}
						} );
						
						
						parent.find('.cmsmasters_icon_font').show();
					} else {
						parent.find('.cmsmasters_icon_font_' + font).show();
						
						
						parent.find('ul > li').removeAttr('style');
					}
				} );
				
				// Icon Font Choose
				$('#cmsmastersLightBox_' + obj.methods.uniqID + ' .cmsmasters_icon_font_select').on('change', function () { 
					var font = $(this).val(), 
						parent = $(this).parents('.icons_list_parent');
					
					
					parent.find('.cmsmasters_icon_font').hide();
					
					
					parent.find('.cmsmasters_icon_font_' + font).show();
				} );
				
				// Icon Choose
				$('#cmsmastersLightBox_' + obj.methods.uniqID + ' .icons_list_parent ul > li > span').on('click', function () { 
					var parentLi = $(this).parent(), 
						li = $(this).parents('.icons_list_parent').find('ul > li'), 
						cancel = $(this).parents('.icons_list_parent').find('> a.cmsmasters_icon_cancel'), 
						hidden = $(this).parents('.icons_list_parent').find('> input.cmsmasters_icon_value');
					
					
					if (parentLi.hasClass('active')) {
						parentLi.removeClass('active');
						
						
						hidden.val('');
						
						
						cancel.css('display', 'none');
					} else {
						li.removeClass('active');
						
						
						parentLi.addClass('active');
						
						
						hidden.val($(this).attr('class'));
						
						
						cancel.removeAttr('style');
					}
					
					
					return false;
				} );
				
				// Icon Cancel
				$('#cmsmastersLightBox_' + obj.methods.uniqID + ' .icons_list_parent > a.cmsmasters_icon_cancel').on('click', function () { 
					var li = $(this).parents('.icons_list_parent').find('ul > li'), 
						hidden = $(this).parents('.icons_list_parent').find('> input.cmsmasters_icon_value');
					
					
					li.removeClass('active');
					
					
					hidden.val('');
					
					
					$(this).css('display', 'none');
					
					
					return false;
				} );
			}, 
			getLbID : function (el) { 
				return $(el).parents('.cmsmastersLightBoxOut').attr('id');
			}, 
			getUniqID : function () { 
				return (new Date().getTime()).toString(16);
			}, 
			getWinWidth : function () { 
				return $(window).width();
			} 
		};
		
		
		obj.methods.init();
	};
	
	// Plugin Start
	$.fn.cmsmastersLightbox = function (parameters) { 
		return this.each(function () { 
			if ($(this).data('cmsmastersLightbox')) { 
				return;
			}
			
			
			var cmsmastersLightbox = new CmsmastersLightbox(this, parameters);
			
			
			$(this).data('cmsmastersLightbox', cmsmastersLightbox);
		} );
	};
} )(jQuery);

