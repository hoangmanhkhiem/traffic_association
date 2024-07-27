/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * File Uploader jQuery Plugin
 * Created by CMSMasters
 * 
 */


(function ($) { 
	"use strict";
	
	$.fn.cmsmastersMediaUploader = function (parameters) { 
		var defaults = { 
				frameId : 		'cmsmasters-media-select-frame', 
				frameClasses : 	'media-frame cmsmasters-media-select-frame', 
				frameType : 	'select', 
				multiple : 		false, 
				state : 		false, 
				editing : 		false, 
				library : 		'image', 
				frameTitle : 	cmsmasters_admin_uploader.choose, 
				frameButton : 	cmsmasters_admin_uploader.insert 
			}, 
			uploadButton = this, 
			methods = {};
		
		
		methods = { 
			init : function () { 
				methods.options = $.extend({}, defaults, parameters);
				
				
				methods.el = uploadButton;
				
				
				methods.vars = {};
				
				
				methods.vars.frame = undefined;
				
				
				methods.setUploaderVars();
				methods.attachEvents();
			}, 
			setUploaderVars : function () { 
				methods.vars.id = methods.options.frameId;
				methods.vars.className = methods.options.frameClasses;
				methods.vars.frameType = methods.options.frameType;
				methods.vars.multiple = methods.options.multiple;
				methods.vars.state = methods.options.state;
				methods.vars.editing = methods.options.editing;
				methods.vars.library = methods.options.library;
				methods.vars.title = methods.options.frameTitle;
				methods.vars.button = methods.options.frameButton;
				
				
				methods.vars.selectedLine = '';
				
				methods.vars.selectedImg = '';
				
				methods.vars.selectedList = '';
				
				methods.vars.selectedTitle = '';
				
				methods.vars.selectedCaption = '';
				
				methods.vars.selectedAlign = '';
				
				methods.vars.selectedLink = '';
				
				
				methods.vars.frameObjGallery = {};
				
				
				methods.parent = methods.el.parents('.cmsmasters_upload_parent');
			}, 
			buildUploader : function () { 
				var defaultPostId = wp.media.gallery.defaults.id, 
					contArr = methods.parent.find('input[type="hidden"], input[type="text"]').val().split(','), 
					content = '[gallery ids="', 
					shortcode, 
					attachments, 
					selection = false;
				
				
				if (methods.vars.editing) {
					contArr.forEach(function (contArrItem) { 
						var valArray = contArrItem.split('|');
						
						
						content += valArray[0] + ',';
					} );
					
					
					content = content.slice(0, -1) + '"]';
					
					
					shortcode = wp.shortcode.next('gallery', content);
					
					
					if (_.isUndefined(shortcode.shortcode.get('id')) && !_.isUndefined(defaultPostId)) {
						shortcode.shortcode.set('id', defaultPostId);
					}
					
					
					attachments = wp.media.gallery.attachments(shortcode.shortcode);
					
					
					selection = new wp.media.model.Selection(attachments.models, { 
						props : 	attachments.props.toJSON(), 
						multiple : 	true 
					} );
					
					
					selection.gallery = attachments.gallery;
					
					
					selection.more().done(function () { 
						selection.props.set( { 
							query : 	false 
						} );
						
						selection.unmirror();
						
						selection.props.unset('orderby');
					} );
				}
				
				
				methods.vars.frameObj = { 
					id : 			methods.vars.id, 
					className : 	methods.vars.className, 
					frame : 		methods.vars.frameType, 
					multiple : 		methods.vars.multiple, 
					library : { 
						type : methods.vars.library 
					}, 
					title : 		methods.vars.title, 
					button : { 
						text : methods.vars.button 
					} 
				};
				
				
				if (methods.vars.state) {
					methods.vars.frameObjGallery = { 
						state:     		methods.vars.state,
						editing : 		methods.vars.editing, 
						selection : 	selection 
					};
				}
				
				
				$.extend(methods.vars.frameObj, methods.vars.frameObjGallery);
				
				
				methods.vars.frame = wp.media.frames = wp.media(methods.vars.frameObj);
			}, 
			openUploader : function () { 
				methods.vars.frame.open();
			}, 
			startUploader : function () { 
				if (methods.vars.frame) {
					methods.openUploader();
				} else {
					methods.buildUploader();
				}
			}, 
			attachEvents : function () { 
				methods.startUploader();
				
				
				if (methods.vars.state !== 'gallery-library' || methods.vars.state !== 'gallery-edit') {
					methods.vars.frame.on('open', function () { 
						var selection = methods.vars.frame.state().get('selection'), 
							ids = methods.parent.find('input[type="hidden"], input[type="text"]').val().split(',');
						
						
						ids.forEach(function (id) { 
							var imgID = id.split('|'), 
								attachment = wp.media.attachment(imgID[0]);
							
							
							attachment.fetch();
							
							
							selection.add(attachment ? [attachment] : []);
						} );
					} );
				}
				
				
				methods.vars.frame.on('insert', function () { 
					$.when.apply($, methods.vars.frame.state().get('selection').map(function (attachment) { 
						var imgData = attachment.toJSON(), 
							sizeData = methods.vars.frame.state().display(attachment).toJSON();
						
						
						if (methods.vars.multiple) {
							if (imgData.id !== '' && imgData.sizes !== undefined) {
								methods.vars.selectedLine += imgData.id + '|' + ((imgData.sizes.thumbnail) ? imgData.sizes.thumbnail.url : imgData.url) + ',';
								
								
								methods.vars.selectedList += '<li class="cmsmasters_gallery_item">' + 
									'<img src="' + ((imgData.sizes.thumbnail) ? imgData.sizes.thumbnail.url : imgData.url) + '" alt="" data-id="' + imgData.id + '" />' + 
									'<a href="#" class="cmsmasters_gallery_cancel admin-icon-remove" title="' + cmsmasters_admin_uploader.remove + '"></a>' + 
								'</li>';
							}
						} else {
							methods.vars.selectedLine = imgData.id + '|' + imgData.sizes[sizeData.size].url + '|' + sizeData.size;
							
							
							methods.vars.selectedImg = imgData.sizes[sizeData.size].url;
							
							
							methods.vars.selectedTitle = imgData.title;
							
							methods.vars.selectedCaption = imgData.caption;
							
							
							methods.vars.selectedAlign = sizeData.align;
							
							
							if (sizeData.link === 'file') {
								methods.vars.selectedLink = imgData.url;
							} else if (sizeData.link === 'post') {
								methods.vars.selectedLink = imgData.link;
							} else if (sizeData.link === 'custom' && typeof sizeData.linkUrl !== 'undefined') {
								methods.vars.selectedLink = sizeData.linkUrl;
							}
						}
					}, this)).done(function () { 
						if (methods.vars.multiple) {
							methods.parent.find('input[type="hidden"], input[type="text"]').val(methods.vars.selectedLine.slice(0, -1)).trigger('change');
							
							
							methods.parent.find('ul').empty().append(methods.vars.selectedList);
						} else {
							var lightboxID = methods.parent.parents('.cmsmastersBoxOut').data('id'), 
								fieldsCont = methods.parent.parents('.cmsmastersBoxContInMid'), 
								fieldsClasses = methods.parent.find('input.cmsmasters_upload_button').data('classes');
							
							
							methods.parent.find('input[type="hidden"], input[type="text"]').val(methods.vars.selectedLine).trigger('change');
							
							
							methods.parent.find('img.cmsmasters_preview_image').attr( { 
								src : methods.vars.selectedImg 
							} ).parent().css('display', 'block');
							
							
							if (fieldsCont.find('#name_' + lightboxID).val() === '') {
								fieldsCont.find('#name_' + lightboxID).val(methods.vars.selectedTitle);
							}
							
							
							if (fieldsCont.find('#title_' + lightboxID).val() === '') {
								fieldsCont.find('#title_' + lightboxID).val(methods.vars.selectedTitle);
							}
							
							
							if (fieldsClasses.indexOf('cmsmasters-frame-no-caption') === -1 && fieldsCont.find('#caption_' + lightboxID).val() === '') {
								fieldsCont.find('#caption_' + lightboxID).val(methods.vars.selectedCaption);
							}
							
							
							if (fieldsClasses.indexOf('cmsmasters-frame-no-align') === -1) {
								if (fieldsCont.find('input[name="align_' + lightboxID + '"]:checked').val() !== methods.vars.selectedAlign) {
									fieldsCont.find('input[name="align_' + lightboxID + '"]:checked').prop('checked', false);
									
									
									fieldsCont.find('input[name="align_' + lightboxID + '"][value="' + methods.vars.selectedAlign + '"]').prop('checked', true);
								}
							}
							
							
							if (fieldsClasses.indexOf('cmsmasters-frame-no-link') === -1) {
								fieldsCont.find('#link_' + lightboxID).val(methods.vars.selectedLink).trigger('change');
							}
						}
					} );
				} );
				
				
				methods.vars.frame.on('update', function (selection) {
					var gal_list = selection.toJSON(), 
						gal_line = '', 
						gal_html = '';
					
					
					gal_list.forEach(function (gal_item) { 
						if ( 
							gal_item.id !== '' && 
							gal_item.sizes !== undefined 
						) {
							gal_line += gal_item.id + '|' + ((gal_item.sizes.thumbnail) ? gal_item.sizes.thumbnail.url : gal_item.url) + ',';
							
							
							gal_html += '<li class="cmsmasters_gallery_item">' + 
								'<img src="' + ((gal_item.sizes.thumbnail) ? gal_item.sizes.thumbnail.url : gal_item.url) + '" alt="" data-id="' + gal_item.id + '" />' + 
								'<a href="#" class="cmsmasters_gallery_cancel admin-icon-remove" title="' + cmsmasters_admin_uploader.remove + '"></a>' + 
							'</li>';
						}
					} );
					
					
					gal_line = gal_line.slice(0, -1);
					
					
					methods.parent.find('input[type="hidden"], input[type="text"]').val(gal_line);
					
					
					methods.parent.find('ul').empty();
					
					
					methods.parent.find('ul').append(gal_html);
					
					
					if (methods.el.data('state') !== 'gallery-edit') {
						methods.el.data( { 
							state : 	'gallery-edit', 
							editing : 	true 
						} ).val(cmsmasters_admin_uploader.edit_gallery);
					}
				} );
				
				
				methods.vars.frame.on('select', function () { 
					var media_atts = methods.vars.frame.state().get('selection'), 
						media_attachments = media_atts.toJSON(), 
						media_attachment = media_atts.first().toJSON(), 
						selected_line = '', 
						selected_list = '';
					
					
					if (methods.vars.multiple) {
						media_attachments.forEach(function (selection) { 
							if (selection.id !== '' && selection.sizes !== undefined) {
								selected_line += selection.id + '|' + ((selection.sizes.thumbnail) ? selection.sizes.thumbnail.url : selection.url) + ',';
								
								
								selected_list += '<li class="cmsmasters_gallery_item">' + 
									'<img src="' + ((selection.sizes.thumbnail) ? selection.sizes.thumbnail.url : selection.url) + '" alt="" data-id="' + selection.id + '" />' + 
									'<a href="#" class="cmsmasters_gallery_cancel admin-icon-remove" title="' + cmsmasters_admin_uploader.remove + '"></a>' + 
								'</li>';
							}
						} );
						
						
						methods.parent.find('input[type="hidden"], input[type="text"]').val(selected_line.slice(0, -1)).trigger('change');
						
						
						methods.parent.find('ul').empty().append(selected_list);
					} else {
						methods.parent.find('input[type="hidden"], input[type="text"]').val(media_attachment.id + '|' + ((media_attachment.sizes !== undefined && media_attachment.sizes.medium) ? media_attachment.sizes.medium.url : media_attachment.url)).trigger('change');
						
						
						methods.parent.find('img.cmsmasters_preview_image').attr( { 
							src : ((media_attachment.sizes !== undefined && media_attachment.sizes.medium) ? media_attachment.sizes.medium.url : media_attachment.url) 
						} ).parent().css('display', 'block');
					}
				} );
				
				
				methods.openUploader();
			} 
		};
		
		
		methods.init();
	}
	
	
	$('body').on('click', '.cmsmasters_upload_button, .cmsmasters_preview_image', function (e) { 
		e.preventDefault();
		
		
		var uploadButton = ($(this).is('img')) ? $(this).parents('.cmsmasters_upload_parent').find('.cmsmasters_upload_button') : $(this), 
			cmsmastersTitle = uploadButton.data('title'), 
			cmsmastersButton = uploadButton.data('button'), 
			cmsmastersID = uploadButton.data('id'), 
			cmsmastersLibrary = uploadButton.data('library'), 
			cmsmastersType = uploadButton.data('type'), 
			cmsmastersMultiple = uploadButton.data('multiple'), 
			cmsmastersState = uploadButton.data('state'), 
			cmsmastersEditing = uploadButton.data('editing'), 
			cmsmastersSelection = uploadButton.data('selection'), 
			cmsmastersClasses = uploadButton.data('classes');
		
		
		$(e.target).cmsmastersMediaUploader( { 
			frameId : 		cmsmastersID, 
			frameClasses : 	cmsmastersClasses, 
			frameType : 	cmsmastersType, 
			multiple : 		cmsmastersMultiple, 
			state : 		cmsmastersState, 
			editing : 		cmsmastersEditing, 
			selection : 	cmsmastersSelection, 
			library : 		cmsmastersLibrary, 
			frameTitle : 	cmsmastersTitle, 
			frameButton : 	cmsmastersButton 
		} );
	} );
} )(jQuery);

