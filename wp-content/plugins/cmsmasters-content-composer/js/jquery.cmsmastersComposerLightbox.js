/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.4.8
 * 
 * Visual Content Composer Lightbox jQuery Plugin
 * Created by CMSMasters
 * 
 */

 
(function ($) { 
	var ComposerLightbox = function (element, parameters) { 
		var defaults = { 
				closeButtons : 		true, 
				backdropClose : 	false, 
				closeButtonText : 	cmsmasters_lightbox.cancel, 
				saveButtonText : 	cmsmasters_lightbox.update, 
				mediaButtonText : 	cmsmasters_lightbox.add_media, 
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
				
				
				obj.methods.lbHTML = '<div class="cmsmastersBoxOut">' + 
					'<div class="cmsmastersBoxBack"></div>' + 
					'<div class="cmsmastersBoxCont">' + 
						'<div class="cmsmastersBoxContIn admin-icon-loader animate-spin">' + 
							'<div class="cmsmastersBoxContInTop wrap"></div>' + 
							'<div class="cmsmastersBoxContInMid"></div>' + 
							'<div class="cmsmastersBoxContInBot"></div>' + 
						'</div>' + 
					'</div>' + 
				'</div>';
			}, 
			resetVars : function () { 
				obj.methods.uniqID = privateMethods.getUniqID();
				
				
				obj.methods.lbStructure = $(obj.methods.lbHTML);
				
				
				obj.methods.back = obj.methods.lbStructure.find('.cmsmastersBoxBack');
				obj.methods.cont = obj.methods.lbStructure.find('.cmsmastersBoxCont');
				
				obj.methods.contIn = obj.methods.cont.find('.cmsmastersBoxContIn');
				
				obj.methods.contInTop = obj.methods.contIn.find('.cmsmastersBoxContInTop');
				obj.methods.contInMid = obj.methods.contIn.find('.cmsmastersBoxContInMid');
				obj.methods.contInBot = obj.methods.contIn.find('.cmsmastersBoxContInBot');
				
				
				obj.methods.fields = '';
				
				
				obj.methods.shcdIndex = undefined;
				
				
				obj.methods.colIndex = undefined;
				
				
				obj.methods.startEditor = false;
				
				
				obj.methods.eventsArray = [];
				
				
				obj.methods.buildObj();
				
				
				privateMethods.attachEvents();
			}, 
			buildObj : function () { 
				if (obj.methods.options.closeButtons) {
					obj.methods.contInTop.append('<a href="#" class="cmsmastersBoxClose admin-icon-remove" title="' + obj.methods.options.closeButtonText + '"></a>');
					
					
					obj.methods.lbCloseBut = obj.methods.contInTop.find('.cmsmastersBoxClose');
				}
				
				
				obj.methods.contInTop.append('<h2>' + cmsmasters_lightbox.shcd_settings + '</h2>');
				
				
				obj.methods.lbTitle = obj.methods.contInTop.find('h2');
				
				
				obj.methods.lbTitleText = obj.methods.lbTitle.text();
				
				
				if (obj.methods.options.closeButtons) {
					obj.methods.contInBot.append('<a href="#" class="cmsmastersBoxCancel button button-large" title="' + obj.methods.options.closeButtonText + '">' + 
						obj.methods.options.closeButtonText + 
					'</a>');
					
					
					obj.methods.lbCancelBut = obj.methods.contInBot.find('.cmsmastersBoxCancel');
				}
				
				
				obj.methods.contInBot.append('<a href="#" class="cmsmastersBoxSave button button-primary button-large" title="' + obj.methods.options.saveButtonText + '">' + 
					obj.methods.options.saveButtonText + 
				'</a>');
				
				
				obj.methods.lbSaveBut = obj.methods.contInBot.find('.cmsmastersBoxSave');
			}, 
			openLightbox : function (shcd) { 
				obj.methods.resetVars();
				
				
				obj.methods.lbStructure.attr( { 
					id : 				'cmsmastersBox_' + obj.methods.uniqID, 
					'data-id' : 		obj.methods.uniqID, 
					'data-index' : 		((shcd.index !== undefined) ? shcd.index : false), 
					'data-shortcode' : 	shcd.type 
				} );
				
				
				if (shcd.editor) {
					obj.methods.lbStructure.attr('data-editor', shcd.editor);
				} else {
					obj.methods.lbStructure.removeAttr('data-editor');
				}
				
				
				if (shcd.multiple) {
					obj.methods.lbStructure.attr('data-multiple', shcd.multiple);
				} else {
					obj.methods.lbStructure.removeAttr('data-multiple');
				}
				
				
				if (shcd.for_editor) {
					obj.methods.lbStructure.attr('data-for_editor', shcd.for_editor);
				} else {
					obj.methods.lbStructure.removeAttr('data-for_editor');
				}
				
				
				if (shcd.link) {
					obj.methods.lbStructure.attr('data-link', shcd.link);
				} else {
					obj.methods.lbStructure.removeAttr('data-link');
				}
				
				
				if (privateMethods.getWinWidth() < 930) {
					obj.methods.cont.addClass('resp');
				}
				
				
				obj.methods.body.append(obj.methods.lbStructure);
				
				
				if (shcd.type === 'cmsmasters_row') {
					obj.methods.lbTitle.text(cmsmastersRow.title + ' ' + obj.methods.lbTitleText);
				} else if (shcd.type === 'cmsmasters_column') {
					obj.methods.lbTitle.text(cmsmastersColumn.title + ' ' + obj.methods.lbTitleText);
				} else if (shcd.link) {
					obj.methods.lbTitle.text(cmsmastersLinkShortcode.title + ' ' + obj.methods.lbTitleText);
				} else if (shcd.multiple) {
					obj.methods.lbTitle.text(cmsmastersMultipleShortcodes[shcd.type].title + ' ' + obj.methods.lbTitleText);
				} else if (shcd.for_editor) {
					obj.methods.lbTitle.text(cmsmastersEditorShortcodes[shcd.type].title + ' ' + obj.methods.lbTitleText);
				} else {
					obj.methods.lbTitle.text(cmsmastersShortcodes[shcd.type].title + ' ' + obj.methods.lbTitleText);
				}
				
				
				obj.methods.body.css( { 
					overflow : 'hidden' 
				} ).find('#cmsmastersBox_' + obj.methods.uniqID).addClass('showBox preloadBox');
				
				
				if (obj.methods.lbSaveBut.is(':hidden')) {
					obj.methods.lbSaveBut.removeAttr('style');
				}
				
				
				if (shcd.link) {
					var shcdContentArray = shcd.content.split('|'), 
						shcdAttrKey = '', 
						shcdAttrsObject = {};
					
					
					for (var j = 0, jlength = shcdContentArray.length; j < jlength; j += 1) {
						if (j === 0) {
							shcdAttrKey = 'title';
							
							
							shcdContentArray[j] = shcdContentArray[j].replace(/title\{([^\}]*)\}/g, '$1');
						} else if (j === 1) {
							shcdAttrKey = 'link';
							
							
							shcdContentArray[j] = shcdContentArray[j].replace(/link\{([^\}]*)\}/g, '$1');
						} else if (j === 2) {
							shcdAttrKey = 'icon';
							
							
							shcdContentArray[j] = shcdContentArray[j].replace(/icon\{([^\}]*)\}/g, '$1');
						}
						
						
						shcdAttrsObject[shcdAttrKey] = shcdContentArray[j];
					}
				} else {
					var reCmsmastersParseContent = new RegExp("\\[" + shcd.type + "((?:\\s\\w+=[\"'][^\"']+[\"'])*)\\]([\\s\\S]*)", "g"), 
						reArray = (shcd.content ? reCmsmastersParseContent.exec(shcd.content) : [shcd.type, '', '']), 
						shcdContent = '', 
						shcdAttrsArray = [], 
						shcdAttrs = [], 
						shcdAttrsObject = {};
					
					
					if (shcd.type !== 'cmsmasters_row' && shcd.type !== 'cmsmasters_column') {
						if (reArray[1] !== '') {
							shcdAttrsArray = reArray[1].slice(1, -1).split(/["|']\s/g);
							
							
							for (var i = 0, ilength = shcdAttrsArray.length; i < ilength; i += 1) {
								shcdAttrs = /([^=]+)=["|']([\s\S]*)/g.exec(shcdAttrsArray[i]);
								
								
								if (shcdAttrs === null) {
									shcdAttrs = /([^=]+)=["|']([\s\S]*)/g.exec(shcdAttrsArray[i] + '" ' + shcdAttrsArray[i + 1]);
									
									
									i += 1;
								}
								
								
								shcdAttrsObject[shcdAttrs[1]] = shcdAttrs[2];
							}
						}
						
						
						if (reArray[2] !== '') {
							shcdContent += reArray[2].slice(0, -(shcd.type.length + 3)).replace(/^(?:<br>|<br \/>){2}/g, '').replace(/(?:<br>|<br \/>){2}$/g, '');
						}
					} else {
						for (var k in shcd.content) {
							if (typeof shcd.content[k] !== 'object' && typeof shcd.content[k] !== 'array') {
								shcdAttrsObject[k] = shcd.content[k];
							}
						}
					}
				}
				
				
				if (shcd.type === 'cmsmasters_row') {
					for (var key in cmsmastersRow.fields) {
						obj.methods.fields += obj.methods.generateField(key, cmsmastersRow.fields[key], ((shcdAttrsObject[key] !== undefined) ? shcdAttrsObject[key] : ''), shcd.type);
					}
				} else if (shcd.type === 'cmsmasters_column') {
					for (var key in cmsmastersColumn.fields) {
						obj.methods.fields += obj.methods.generateField(key, cmsmastersColumn.fields[key], ((shcdAttrsObject[key] !== undefined) ? shcdAttrsObject[key] : ''), shcd.type);
					}
				} else {
					if (shcd.link) {
						for (var key in cmsmastersLinkShortcode.fields) {
							obj.methods.fields += obj.methods.generateField(key, cmsmastersLinkShortcode.fields[key], ((shcdAttrsObject[key] !== undefined) ? shcdAttrsObject[key] : ''), shcd.type);
						}
					} else if (shcd.multiple) {
						for (var key in cmsmastersMultipleShortcodes[shcd.type].fields) {
							if (cmsmastersMultipleShortcodes[shcd.type].content === key) {
								obj.methods.fields += obj.methods.generateField(key, cmsmastersMultipleShortcodes[shcd.type].fields[key], shcdContent, shcd.type);
							} else {
								obj.methods.fields += obj.methods.generateField(key, cmsmastersMultipleShortcodes[shcd.type].fields[key], ((shcdAttrsObject[key] !== undefined) ? shcdAttrsObject[key] : ''), shcd.type);
							}
						}
					} else if (shcd.for_editor) {
						for (var key in cmsmastersEditorShortcodes[shcd.type].fields) {
							if (cmsmastersEditorShortcodes[shcd.type].content === key) {
								obj.methods.fields += obj.methods.generateField(key, cmsmastersEditorShortcodes[shcd.type].fields[key], shcdContent, shcd.type);
							} else {
								obj.methods.fields += obj.methods.generateField(key, cmsmastersEditorShortcodes[shcd.type].fields[key], ((shcdAttrsObject[key] !== undefined) ? shcdAttrsObject[key] : ''), shcd.type);
							}
						}
					} else {
						for (var key in cmsmastersShortcodes[shcd.type].fields) {
							if (cmsmastersShortcodes[shcd.type].content === key) {
								obj.methods.fields += obj.methods.generateField(key, cmsmastersShortcodes[shcd.type].fields[key], shcdContent, shcd.type);
							} else {
								obj.methods.fields += obj.methods.generateField(key, cmsmastersShortcodes[shcd.type].fields[key], ((shcdAttrsObject[key] !== undefined) ? shcdAttrsObject[key] : ''), shcd.type);
							}
						}
					}
				}
				
				
				obj.methods.body.find('#cmsmastersBox_' + obj.methods.uniqID).find('.cmsmastersBoxContInMid').append(obj.methods.fields);
				
				
				obj.methods.startEditor = true;
				
				
				obj.methods.body.find('#cmsmastersBox_' + obj.methods.uniqID).removeClass('preloadBox');
				
				
				setTimeout(function () { 
					privateMethods.attachDependenceEvents();
					
					
					privateMethods.attachGeneratedEvents();
				}, 100);
			}, 
			openShortcodes : function (elData) { 
				obj.methods.resetVars();
				
				
				if (elData.index) {
					obj.methods.colIndex = elData.index.split('|');
				} else {
					obj.methods.colIndex = false;
				}
				
				
				obj.methods.lbStructure.attr( { 
					id : 				'cmsmastersBox_' + obj.methods.uniqID, 
					'data-shortcode' : 	'cmsmasters_shortcodes' 
				} );
				
				
				if (privateMethods.getWinWidth() < 930) {
					obj.methods.cont.addClass('resp');
				}
				
				
				obj.methods.body.append(obj.methods.lbStructure);
				
				
				obj.methods.lbTitle.text(cmsmasters_lightbox.shcd_choose);
				
				
				obj.methods.body.css( { 
					overflow : 'hidden' 
				} ).find('#cmsmastersBox_' + obj.methods.uniqID).addClass('showBox preloadBox');
				
				
				obj.methods.lbSaveBut.css('display', 'none');
				
				
				obj.methods.body.find('#cmsmastersBox_' + obj.methods.uniqID).find('.cmsmastersBoxContInMid').append(obj.methods.generateShortcodes(elData.prepend, elData.editor));
				
				
				obj.methods.eventsArray.push('shortcodes');
				
				
				obj.methods.body.find('#cmsmastersBox_' + obj.methods.uniqID).removeClass('preloadBox');
				
				
				setTimeout(function () { 
					privateMethods.attachGeneratedEvents();
				}, 100);
			}, 
			generateShortcodes : function (prepend, cmsmasters_editor) { 
				out = '<div class="cmsmasters_content_box cmsmasters_shortcodes full_width" data-id="cmsmasters_shortcode_' + obj.methods.uniqID + '" data-prepend="' + prepend + '">' + 
					'<div class="cmsmasters_field">' + 
						'<ul>';
				
				
				if (cmsmasters_editor) {
					for (var key in cmsmastersEditorShortcodes) {
						out += '<li>' + 
							'<a href="#" class="' + key + ' ' + cmsmastersEditorShortcodes[key].icon + '" data-shortcode="' + key + '" data-pair="' + ((cmsmastersEditorShortcodes[key].pair) ? true : false) + '" data-editor="' + cmsmasters_editor + '">' + 
								'<span>' + cmsmastersEditorShortcodes[key].title + '</span>' + 
							'</a>' + 
						'</li>';
					}
				}
				
				
				for (var key in cmsmastersShortcodes) {
					out += '<li>' + 
						'<a href="#" class="' + key + ' ' + cmsmastersShortcodes[key].icon + '" data-shortcode="' + key + '" data-pair="' + ((cmsmastersShortcodes[key].pair) ? true : false) + '">' + 
							'<span>' + cmsmastersShortcodes[key].title + '</span>' + 
						'</a>' + 
					'</li>';
				}
				
				
				out += '</ul>' + 
					'</div>' + 
				'</div>';
				
				
				return out;
			}, 
			generateField : function (key, field, val, shcd) { 
				var fieldContent = '';
				
				
				fieldContent += '<div class="cmsmasters_content_box' + ((field.width !== 'full') ? ' ' + field.width + '_width' : ' full_width') + '" data-id="' + key + '_' + obj.methods.uniqID + '" data-type="' + field.type + '"' + ((typeof field.depend === 'string' && field.depend !== '') ? ' style="display:none;"' : '') + '>' + 
					'<div class="cmsmasters_caption">' + 
						'<label for="' + key + '_' + obj.methods.uniqID + '">' + 
							field.title + 
							((field.required) ? '<abbr class="required" title="required">*</abbr>' : '') + 
						'</label>' + 
						((field.descr !== '') ? '<p>' + field.descr + '</p>' : '') + 
					'</div>' + 
					'<div class="cmsmasters_field cmsmasters_field_' + field.type + '">';
				
				
				switch (field.type) { 
				case 'editor':
					fieldContent += '<div class="wp-' + key + '_' + obj.methods.uniqID + '-container-wrap" id="wp-' + key + '_' + obj.methods.uniqID + '-editor-container-wrap">' + 
						'<div class="wp-core-ui wp-editor-wrap tmce-active" id="wp-' + key + '_' + obj.methods.uniqID + '-wrap">' + 
							'<link media="all" type="text/css" href="' + document.location.host + '/wp-includes/css/editor.min.css" id="editor-buttons-css" rel="stylesheet" />' + 
							'<div class="wp-editor-tools hide-if-no-js" id="wp-' + key + '_' + obj.methods.uniqID + '-editor-tools">' + 
								'<div class="wp-editor-tabs">' + 
									'<a class="wp-switch-editor switch-html" id="' + key + '_' + obj.methods.uniqID + '-html">Text</a>' + 
									'<a class="wp-switch-editor switch-tmce" id="' + key + '_' + obj.methods.uniqID + '-tmce">Visual</a>' + 
								'</div>' + 
								'<div class="wp-media-buttons" id="wp-' + key + '_' + obj.methods.uniqID + '-media-buttons">' + 
									'<a title="Add Media" data-editor="' + key + '_' + obj.methods.uniqID + '" class="button insert-media add_media" id="insert-media-button-' + key + '_' + obj.methods.uniqID + '" href="#"><span class="wp-media-buttons-icon"></span> Add Media</a>' + 
								'</div>' + 
							'</div>' + 
							'<div class="wp-editor-container" id="wp-' + key + '_' + obj.methods.uniqID + '-editor-container">' + 
								'<textarea id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" cols="40" rows="15" class="wp-editor-area">' + val + '</textarea>' + 
							'</div>' + 
						'</div>' + 
					'</div>';
					
					
					var editorStartInterval = setInterval(function () { 
						if (obj.methods.startEditor) {
							privateMethods.generateEditor(key + '_' + obj.methods.uniqID);
							
							
							clearInterval(editorStartInterval);
						}
					}, 50);
					
					
					break;
				case 'uri_encode_editor':
					fieldContent += '<div class="wp-' + key + '_' + obj.methods.uniqID + '-container-wrap" id="wp-' + key + '_' + obj.methods.uniqID + '-editor-container-wrap">' + 
						'<div class="wp-core-ui wp-editor-wrap tmce-active" id="wp-' + key + '_' + obj.methods.uniqID + '-wrap">' + 
							'<link media="all" type="text/css" href="' + document.location.host + '/wp-includes/css/editor.min.css" id="editor-buttons-css" rel="stylesheet" />' + 
							'<div class="wp-editor-tools hide-if-no-js" id="wp-' + key + '_' + obj.methods.uniqID + '-editor-tools">' + 
								'<div class="wp-editor-tabs">' + 
									'<a class="wp-switch-editor switch-html" id="' + key + '_' + obj.methods.uniqID + '-html">Text</a>' + 
									'<a class="wp-switch-editor switch-tmce" id="' + key + '_' + obj.methods.uniqID + '-tmce">Visual</a>' + 
								'</div>' + 
								'<div class="wp-media-buttons" id="wp-' + key + '_' + obj.methods.uniqID + '-media-buttons">' + 
									'<a title="Add Media" data-editor="' + key + '_' + obj.methods.uniqID + '" class="button insert-media add_media" id="insert-media-button-' + key + '_' + obj.methods.uniqID + '" href="#"><span class="wp-media-buttons-icon"></span> Add Media</a>' + 
								'</div>' + 
							'</div>' + 
							'<div class="wp-editor-container" id="wp-' + key + '_' + obj.methods.uniqID + '-editor-container">' + 
								'<textarea id="' + key + '_' + obj.methods.uniqID + '" class="cmsmasters_not_focus" name="' + key + '_' + obj.methods.uniqID + '" cols="40" rows="15" class="wp-editor-area">' + decodeURI(val) + '</textarea>' + 
							'</div>' + 
						'</div>' + 
					'</div>';
					
					
					var editorStartInterval = setInterval(function () { 
						if (obj.methods.startEditor) {
							privateMethods.generateEditor(key + '_' + obj.methods.uniqID);
							
							
							clearInterval(editorStartInterval);
						}
					}, 50);
					
					
					break;
				case 'input':
					fieldContent += '<input type="' + ((field.width === 'number') ? 'number' : 'text') + '" id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" value="' + privateMethods.unSanitizeContent(val) + '"' + ((field.required) ? ' aria-required="true"' : '') + ((field.min) ? ' min="' + field.min + '"' : '') + ((field.max) ? ' max="' + field.max + '"' : '') + ((field.step) ? ' step="' + field.step + '"' : '') + ' />';
					
					
					break;
				case 'hidden':
					fieldContent += '<input type="hidden" id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" value="' + val + '"' + ((field.required) ? ' aria-required="true"' : '') + ' />';
					
					
					break;
				case 'range':
					fieldContent += '<input type="range" id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" value="' + val + '"' + ((field.required) ? ' aria-required="true"' : '') + ((field.min) ? ' min="' + field.min + '"' : '') + ((field.max) ? ' max="' + field.max + '"' : '') + ((field.step) ? ' step="' + field.step + '"' : '') + ' />' + 
					'<input type="text" id="' + key + '_' + obj.methods.uniqID + '_number" name="' + key + '_' + obj.methods.uniqID + '_number" value="' + val + '" readonly="readonly" />';
					
					
					obj.methods.eventsArray.push('range');
					
					
					break;
				case 'textarea':
					fieldContent += '<textarea id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '"' + ((field.required) ? ' aria-required="true"' : '') + '>' + privateMethods.unSanitizeContent(val) + '</textarea>';
					
					
					break;
				case 'base64':
					fieldContent += '<textarea id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '"' + ((field.required) ? ' aria-required="true"' : '') + '>' + privateMethods.base64Decode(val) + '</textarea>';
					
					
					break;
				case 'select':
					fieldContent += '<select id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '"' + ((field.required) ? ' aria-required="true"' : '') + '>';
					
					
					for (var k in field.choises) {
						fieldContent += '<option value="' + k + '"' + ((((val !== '') ? val.toString() : field.def) === k) ? ' selected="selected"' : '') + '>' + field.choises[k] + '</option>';
					}
					
					
					fieldContent += '</select>';
					
					
					break;
				case 'select_group':
					fieldContent += '<select id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '"' + ((field.required) ? ' aria-required="true"' : '') + '>';
					

					for (var k in field.choises) {
						if (k === '') {
							fieldContent += '<option value="' + k + '"' + ((((val !== '') ? val.toString() : field.def) === k) ? ' selected="selected"' : '') + '>' + field.choises[k] + '</option>';
						} else {
							fieldContent += '<optgroup label="' + (k === 'local' ? cmsmasters_lightbox.local_fonts : cmsmasters_lightbox.google_web_fonts) + '">';
							
							for (var font in field.choises[k]) {
								fieldContent += '<option value="' + font + '"' + ((((val !== '') ? val.toString() : field.def) === font) ? ' selected="selected"' : '') + '>' + field.choises[k][font] + '</option>';
							}
							
							fieldContent += '</optgroup>';
						}
					}
					
					
					fieldContent += '</select>';
					
					
					break;
				case 'select_multiple':
					var defVals = field.def.split(','), 
						newVals = val.toString().split(',');
					
					
					fieldContent += '<select id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '"' + ((field.required) ? ' aria-required="true"' : '') + ' multiple="multiple" size="5">';
					
					
					for (var k in field.choises) {
						fieldContent += '<option value="' + k + '"' + ((((val !== '') ? $.inArray(k, newVals) : $.inArray(k, defVals)) !== -1) ? ' selected="selected"' : '') + '>' + field.choises[k] + '</option>';
					}
					
					
					fieldContent += '</select>' + 
					'<a href="#" class="cmsmasters_cat_cancel admin-icon-remove"' + ((val !== '') ? '' : ' style="display:none;"') + '>' + cmsmasters_lightbox.deselect + '</a>';
					
					
					obj.methods.eventsArray.push('select_multiple');
					
					
					break;
				case 'radio':
					var i = 0;
					
					
					fieldContent += '<div class="cmsmasters_check_parent" id="' + key + '_' + obj.methods.uniqID + '">';
					
					
					for (var k in field.choises) {
						fieldContent += '<div class="cmsmasters_check">' + 
							'<input type="radio" id="' + key + '_' + obj.methods.uniqID + '_' + i + '" name="' + key + '_' + obj.methods.uniqID + '" value="' + k + '"' + ((k === ((val !== '') ? val : field.def)) ? ' checked="checked"' : '') + '>' + 
							'<label for="' + key + '_' + obj.methods.uniqID + '_' + i + '">' + field.choises[k] + '</label>' + 
						'</div>';
						
						
						i += 1;
					}
					
					
					fieldContent += '</div>';
					
					
					break;
				case 'checkbox':
					var j = 0, 
						newVals = val.toString().split(',');
					
					
					fieldContent += '<div class="cmsmasters_check_parent" id="' + key + '_' + obj.methods.uniqID + '">';
					
					
					for (var k in field.choises) {
						fieldContent += '<div class="cmsmasters_check">' + 
							'<label for="' + key + '_' + obj.methods.uniqID + '_' + j + '">' + 
								'<input type="checkbox" id="' + key + '_' + obj.methods.uniqID + '_' + j + '" name="' + key + '_' + obj.methods.uniqID + '_' + j + '" value="' + k + '"' + ((val !== '' && $.inArray(k, newVals) !== -1) ? ' checked="checked"' : '') + '>' + 
								field.choises[k] + 
							'</label>' + 
						'</div>';
						
						
						j += 1;
					}
					
					
					fieldContent += '</div>';
					
					
					break;
				case 'color':
					fieldContent += '<input type="text" id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" value="' + ((val !== '') ? val : field.def) + '" class="cmsmasters_color_field" data-default-color="' + field.def + '" />';
					
					
					obj.methods.eventsArray.push('color');
					
					
					break;
				case 'rgba':
					var arr_val = val.split('|'), 
						def_val = field.def.split('|'), 
						new_color = (val !== '') ? arr_val[0] : ((field.def !== '') ? def_val[0] : ''), 
						new_alpha = (val !== '') ? arr_val[1] : ((field.def !== '') ? def_val[1] : '100');
					
					
					fieldContent += '<input type="text" id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" value="' + new_color + '" class="cmsmasters_color_field" data-default-color="' + ((field.def !== '') ? def_val[0] : '') + '" data-alpha="true" data-reset-alpha="true" />';
					
					
					obj.methods.eventsArray.push('color');
					
					
					break;
				case 'upload':
					var newVal = val.split('|');
					
					
					fieldContent += '<div class="cmsmasters_upload_parent cmsmasters_select_parent">' + 
						'<input type="button" id="cmsmasters_upload_' + obj.methods.uniqID + '_button" class="cmsmasters_upload_button button button-large" value="' + ((field.library === 'image') ? cmsmasters_lightbox.choose_image : ((field.library === 'video') ? cmsmasters_lightbox.choose_video : cmsmasters_lightbox.choose_audio)) + '" data-title="' + ((field.library === 'image') ? cmsmasters_lightbox.choose_image : ((field.library === 'video') ? cmsmasters_lightbox.choose_video : cmsmasters_lightbox.choose_audio)) + '" data-button="' + ((field.library === 'image') ? cmsmasters_lightbox.insert_image : ((field.library === 'video') ? cmsmasters_lightbox.insert_video : cmsmasters_lightbox.insert_audio)) + '" data-id="cmsmasters-media-select-frame-' + key + '_' + obj.methods.uniqID + '" data-classes="media-frame cmsmasters-media-select-frame' + ((!field.description) ? ' cmsmasters-frame-no-description' : '') + ((!field.caption) ? ' cmsmasters-frame-no-caption' : '') + ((!field.align) ? ' cmsmasters-frame-no-align' : '') + ((!field.link) ? ' cmsmasters-frame-no-link' : '') + ((!field.size) ? ' cmsmasters-frame-no-size' : '') + '" data-library="' + field.library + '" data-type="' + field.frame + '"' + ((field.frame === 'post') ? ' data-state="insert"' : '') + ' data-multiple="' + field.multiple + '" />';
					
					
					if (field.library === 'image') {
						fieldContent += '<div class="cmsmasters_upload"' + ((val !== '' && typeof newVal[1] !== 'undefined') ? ' style="display:block;"' : '') + '>' + 
							'<img src="' + ((val !== '' && typeof newVal[1] !== 'undefined') ? newVal[1] : '') + '" class="cmsmasters_preview_image" alt="" />' + 
							'<a href="#" class="cmsmasters_upload_cancel admin-icon-remove" title="' + cmsmasters_lightbox.remove + '"></a>' + 
						'</div>';
					}
					
					
					fieldContent += '<input type="' + ((field.library === 'image') ? 'hidden' : 'text') + '" id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" class="cmsmasters_upload_image" value="' + val + '" />' + 
					'</div>';
					
					
					obj.methods.eventsArray.push('upload');
					
					
					break;
				case 'gallery':
					var newVals = val.split(',');
					
					
					fieldContent += '<div class="cmsmasters_upload_parent cmsmasters_gallery_parent">' + 
						'<input type="button" id="cmsmasters_gallery_' + obj.methods.uniqID + '_button" class="cmsmasters_upload_button button button-large" value="' + ((val !== '') ? cmsmasters_lightbox.edit_gallery : cmsmasters_lightbox.create_gallery) + '" data-title="' + cmsmasters_lightbox.create_edit_gallery + '" data-button="' + cmsmasters_lightbox.insert_gallery + '" data-id="cmsmasters-media-gallery-frame-' + key + '_' + obj.methods.uniqID + '" data-classes="media-frame cmsmasters-media-gallery-frame cmsmasters-frame-no-description" data-library="image" data-type="post" data-state="' + ((val !== '') ? 'gallery-edit' : 'gallery-library') + '" data-multiple="true"' + ((val !== '') ? ' data-editing="true"' : '') + ' />' + 
						'<ul class="cmsmasters_gallery">';
					
					
					if (val !== '') {
						for (var i = 0, ilength = newVals.length; i < ilength; i += 1) {
							var newVal = newVals[i].split('|');
							
							
							fieldContent += '<li class="cmsmasters_gallery_item">' + 
								'<img src="' + newVal[1] + '" alt="" data-id="' + newVal[0] + '" class="cmsmasters_gallery_image" />' + 
								'<a href="#" class="cmsmasters_gallery_cancel admin-icon-remove" title="Remove"></a>' + 
							'</li>';
						}
					}
					
					
					fieldContent += '</ul>' + 
						'<input type="hidden" id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" class="cmsmasters_gallery_images" value="' + val + '" />' + 
					'</div>';
					
					
					obj.methods.eventsArray.push('gallery');
					
					
					break;
				case 'icon':
					fieldContent += '<div class="icons_list_parent">' + 
						'<p>' + 
							'<input class="icon_upload_image all-options" type="hidden" id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" value="' + val + '" />' + 
							'<span id="' + key + '_' + obj.methods.uniqID + '_icon" data-class="cmsmasters_new_icon_img"' + ((val !== '') ? ' class="' + val + '" style="display:block;"' : '"') + '></span>' + 
							'<input id="' + key + '_' + obj.methods.uniqID + '_button" class="cmsmasters_icon_choose_button button" type="button" value="' + cmsmasters_lightbox.choose_icon + '" />' + 
							'<a href="#" class="cmsmasters_remove_icon admin-icon-remove" title="' + cmsmasters_lightbox.remove + '"' + ((val !== '') ? ' style="display:inline-block;"' : '') + '></a>' + 
						'</p>' + 
					'</div>';
					
					
					break;
				case 'multiple':
					fieldContent += '<div class="cmsmasters_multiple_parent">' + 
						'<div class="cmsmasters_multiple_fields">' + 
							cmsmastersContentComposer.methods.convertShortcodes(val, shcd.slice(0, -1)) + 
						'</div>' + 
						'<a href="#" class="cmsmasters_multi_add admin-icon-add"></a>' + 
						'<textarea id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" class="cmsmasters_multiple_value" style="display:none;">' + val.replace(/<br\s?\/?>/g, "\n") + '</textarea>' + 
					'</div>';
					
					
					obj.methods.eventsArray.push('multiple');
					
					
					break;
				case 'table':
					var tr = val.split(/\[\/cmsmasters_tr\]\[/g), 
						trLength = tr.length, 
						trf = tr[0].split(/\[\/cmsmasters_td\]\[/g), 
						trl = tr[trLength - 1].split(/\[\/cmsmasters_td\]\[/g);
					
					
					fieldContent += '<div class="cmsmasters_table_parent">' + 
						'<input type="button" id="cmsmasters_table_' + obj.methods.uniqID + '_column_button" class="cmsmasters_table_column_button button button-large" value="' + cmsmasters_lightbox.add_table_col + '" />' + 
						'<input type="button" id="cmsmasters_table_' + obj.methods.uniqID + '_row_button" class="cmsmasters_table_row_button button button-large" value="' + cmsmasters_lightbox.add_table_row + '" />' + 
						'<div class="cmsmasters_table">' + 
							'<div class="cmsmasters_table_row  cmsmasters_table_row_top">' + 
								'<div class="cmsmasters_table_cell cmsmasters_table_cell_top"></div>';
					
					
					for (var f = 0, flength = trf.length; f < flength; f += 1) {
						if (f === 0) {
							trf[f] = trf[f].replace(/\[cmsmasters_tr[^\]]*\]\[/g, '');
							
							
							if ((flength - 1) === 0) {
								trf[f] = trf[f].replace(/\[\/cmsmasters_td\]/g, '');
							}
						} else if (f === (flength - 1)) {
							trf[f] = trf[f].replace(/\[\/cmsmasters_td\]/g, '');
						}
						
						
						var selectedCol = (trf[f].slice(13, 14) === ' ') ? trf[f].replace(/cmsmasters_td(\stype="([^"]*)")?\salign="([^"]*)"\][^\[]*/g, '$3') : '';
						
						
						fieldContent += '<div class="cmsmasters_table_cell cmsmasters_table_cell_top">' + 
							'<select id="cmsmasters_column_select_' + f + '" name="cmsmasters_column_select_' + f + '" class="cmsmasters_column_select">' + 
								'<option value="left"' + ((selectedCol === 'left') ? ' selected="selected"' : '') + '>' + cmsmasters_lightbox.text_align_left + '</option>' + 
								'<option value="center"' + ((selectedCol === 'center') ? ' selected="selected"' : '') + '>' + cmsmasters_lightbox.text_align_center + '</option>' + 
								'<option value="right"' + ((selectedCol === 'right') ? ' selected="selected"' : '') + '>' + cmsmasters_lightbox.text_align_right + '</option>' + 
							'</select>' + 
						'</div>';
					}
					
					
					fieldContent += '<div class="cmsmasters_table_cell cmsmasters_table_cell_top"></div>' + 
					'</div>';
					
					
					for (var i = 0, ilength = tr.length; i < ilength; i += 1) {
						fieldContent += '<div class="cmsmasters_table_row">';
						
						
						if (i === 0) {
							tr[i] = tr[i].slice(1);
							
							
							if ((ilength - 1) === 0) {
								tr[i] = tr[i].replace(/\[\/cmsmasters_tr\]/g, '');
							}
						} else if (i === (ilength - 1)) {
							tr[i] = tr[i].replace(/\[\/cmsmasters_tr\]/g, '');
						}
						
						
						var td = tr[i].split(/\[\/cmsmasters_td\]\[cmsmasters_td[^\]]*]/g), 
							selectedRow = (td[0].slice(13, 14) === ' ') ? td[0].replace(/cmsmasters_tr\stype="([^"]*)"\]\[cmsmasters_td[^\]]*\][^\[]*/g, '$1') : '';
						
						
						fieldContent += '<div class="cmsmasters_table_cell">' + 
							'<select id="cmsmasters_row_select_' + i + '" name="cmsmasters_row_select_' + i + '" class="cmsmasters_row_select">' + 
								'<option value=""' + ((selectedRow === '') ? ' selected="selected"' : '') + '>' + cmsmasters_lightbox.default_row + '</option>' + 
								'<option value="header"' + ((selectedRow === 'header') ? ' selected="selected"' : '') + '>' + cmsmasters_lightbox.header_row + '</option>' + 
								'<option value="footer"' + ((selectedRow === 'footer') ? ' selected="selected"' : '') + '>' + cmsmasters_lightbox.footer_row + '</option>' + 
							'</select>' + 
						'</div>';
						
						
						for (var j = 0, jlength = td.length; j < jlength; j += 1) {
							if (j === 0) {
								td[j] = td[j].replace(/cmsmasters_tr[^\]]*\]\[cmsmasters_td[^\]]*\]/g, '');
							} else if (j === (jlength - 1)) {
								td[j] = td[j].replace(/\[\/cmsmasters_td\]/g, '');
							}
							
							
							fieldContent += '<div class="cmsmasters_table_cell cmsmasters_change_cell">' + td[j].replace(/\n/g, "<br />") + '</div>';
						}
						
						
						fieldContent += '<div class="cmsmasters_table_cell">' + 
								'<a href="#" class="cmsmasters_row_remove admin-icon-remove" title="' + cmsmasters_lightbox.delete_row + '"></a>' + 
							'</div>' + 
						'</div>';
					}
					
					
					fieldContent += '<div class="cmsmasters_table_row cmsmasters_table_row_bot">' + 
						'<div class="cmsmasters_table_cell cmsmasters_table_cell_bot"></div>';
					
					
					for (var l = 0, llength = trl.length - 1; l < llength; l += 1) {
						fieldContent += '<div class="cmsmasters_table_cell cmsmasters_table_cell_bot">' + 
							'<a href="#" class="cmsmasters_column_remove admin-icon-remove" title="' + cmsmasters_lightbox.delete_col + '"></a>' + 
						'</div>';
					}
					
					
					fieldContent += '<div class="cmsmasters_table_cell cmsmasters_table_cell_bot"></div>' + 
							'</div>' + 
						'</div>' + 
						'<textarea id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" class="cmsmasters_table_value">' + val + '</textarea>' + 
					'</div>';
					
					
					obj.methods.eventsArray.push('table');
					
					
					break;
				case 'link':
					var newLinks = val.split('||');
					
					
					fieldContent += '<div class="cmsmasters_link_parent">' + 
						'<ul class="cmsmasters_link_fields">';
					
					
					if (val !== '') {
						for (var i = 0, ilength = newLinks.length; i < ilength; i += 1) {
							var newLink = newLinks[i].split('|');
							
							
							fieldContent += '<li>' + 
								'<span class="cmsmasters_link_handle admin-icon-move"></span>' + 
								'<div class="cmsmasters_link_wrap">' + 
									'<span class="cmsmasters_link_text ' + 
									((typeof newLink[2] !== 'undefined') ? newLink[2].replace(/icon\{([^\}]*)\}/g, '$1') : '') + '">' + 
									((typeof newLink[0] !== 'undefined') ? newLink[0].replace(/title\{([^\}]*)\}/g, '$1') : '') + 
									((typeof newLink[1] !== 'undefined') ? '<span class="cmsmasters_link_hide_empty">' + newLink[1].replace(/link\{([^\}]*)\}/g, '$1') + '</span>' : '') + 
									'</span>' + 
								'</div>' + 
								'<a href="#" class="cmsmasters_link_del admin-icon-remove" title="' + cmsmasters_lightbox.remove + '"></a>' + 
								'<input type="hidden" id="cmsmasters_link_field_' + i + '" name="cmsmasters_link_field_' + i + '" class="cmsmasters_link_field" value="' + newLinks[i] + '" />' + 
							'</li>';
						}
					}
					
					
					fieldContent += '</ul>' + 
						'<a href="#" class="cmsmasters_link_add admin-icon-add"></a>' + 
						'<input type="hidden" id="' + key + '_' + obj.methods.uniqID + '" name="' + key + '_' + obj.methods.uniqID + '" class="cmsmasters_link_value" value="' + val + '" />' + 
					'</div>';
					
					
					obj.methods.eventsArray.push('link');
					
					
					break;
				default:
				}
				
				
				fieldContent += '</div>' + 
					'</div>' + 
				'</div>';
				
				
				return fieldContent;
			}, 
			saveContent : function (id, multiple) { 
				var shcd = obj.methods.body.find('#cmsmastersBox_' + id).data('shortcode'), 
					link = obj.methods.body.find('#cmsmastersBox_' + id).data('link'), 
					for_editor = obj.methods.body.find('#cmsmastersBox_' + id).data('for_editor'), 
					contField = '', 
					attrs = {}, 
					attributes = '', 
					content = '', 
					shcdVisual = '', 
					newContent = '', 
					shortcode = '', 
					uploadContent = false;
				
				
				if (shcd === 'cmsmasters_row') {
					contField = cmsmastersRow.content;
				} else if (shcd === 'cmsmasters_column') {
					contField = cmsmastersColumn.content;
				} else if (multiple) {
					contField = cmsmastersMultipleShortcodes[shcd].content;
				} else if (for_editor) {
					contField = cmsmastersEditorShortcodes[shcd].content;
				} else if (link) {
					contField = cmsmastersLinkShortcode.content;
				} else {
					contField = cmsmastersShortcodes[shcd].content;
				}
				
				
				obj.methods.body.find('#cmsmastersBox_' + id).find('.cmsmastersBoxContInMid > div').each(function () { 
					if ($(this).is(':visible') || $(this).data('type') === 'hidden') {
						var fieldID = $(this).data('id'), 
							fieldName = fieldID.replace('_' + id, '');
						
						
						switch ($(this).data('type')) { 
						case 'editor':
							if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '' || fieldName === contField) {
								if ($('#wp-content-wrap').hasClass('html-active')) {
									$('#wp-content-wrap').find('> .wp-editor-tools .switch-tmce').trigger('click');
								}
								
								
								if ($('#wp-' + fieldID + '-wrap').hasClass('html-active')) {
									$('#wp-' + fieldID + '-wrap').find('> .wp-editor-tools a.switch-tmce').trigger('click');
								}
								
								
								tinyMCE.get(fieldID).save();
								
								
								if (fieldName !== contField) {
									attrs[fieldName] = switchEditors.pre_wpautop(privateMethods.sanitizeContent($(this).find('> .cmsmasters_field #' + fieldID).val()));
								} else {
									content = cmsmastersContentComposer.methods.convertToContent(switchEditors.pre_wpautop($(this).find('> .cmsmasters_field #' + fieldID).val()));
								}
							}
							
							
							break;
						case 'uri_encode_editor':
							if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '' || fieldName === contField) {
								if ($('#wp-content-wrap').hasClass('html-active')) {
									$('#wp-content-wrap').find('> .wp-editor-tools .switch-tmce').trigger('click');
								}
								
								
								if ($('#wp-' + fieldID + '-wrap').hasClass('html-active')) {
									$('#wp-' + fieldID + '-wrap').find('> .wp-editor-tools a.switch-tmce').trigger('click');
								}
								
								
								tinyMCE.get(fieldID).save();
								
								
								if (fieldName !== contField) {
									attrs[fieldName] = switchEditors.pre_wpautop(encodeURI($(this).find('> .cmsmasters_field #' + fieldID).val()));
								} else {
									content = cmsmastersContentComposer.methods.convertToContent(switchEditors.pre_wpautop(encodeURI($(this).find('> .cmsmasters_field #' + fieldID).val())));
								}
							}
							
							
							break;
						case 'input':
							if (link) {
								attrs[fieldName] = fieldName + '{' + privateMethods.sanitizeContent($(this).find('> .cmsmasters_field #' + fieldID).val()) + '}';
							} else if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '' || fieldName === contField) {
								if (fieldName !== contField) {
									attrs[fieldName] = privateMethods.sanitizeContent($(this).find('> .cmsmasters_field #' + fieldID).val());
								} else {
									content = $(this).find('> .cmsmasters_field #' + fieldID).val();
								}
							}
							
							
							break;
						case 'textarea':
							if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '' || fieldName === contField) {
								if (fieldName !== contField) {
									attrs[fieldName] = switchEditors.pre_wpautop(privateMethods.sanitizeContent($(this).find('> .cmsmasters_field #' + fieldID).val()));
								} else {
									content = $(this).find('> .cmsmasters_field #' + fieldID).val();
								}
							}
							
							
							break;
						case 'base64':
							if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '' || fieldName === contField) {
								if (fieldName !== contField) {
									attrs[fieldName] = privateMethods.base64Encode($(this).find('> .cmsmasters_field #' + fieldID).val());
								} else {
									content = privateMethods.base64Encode($(this).find('> .cmsmasters_field #' + fieldID).val());
								}
							}
							
							
							break;
						case 'select_multiple':
							var options = $(this).find('> .cmsmasters_field #' + fieldID + ' > option:selected'), 
								vals = '';
							
							
							if (options.length > 0) {
								for (var i = 0, ilength = options.length; i < ilength; i += 1) {
									vals += options.eq(i).val() + ',';
								}
								
								
								vals = vals.slice(0, -1);
								
								
								attrs[fieldName] = vals;
							}
							
							
							break;
						case 'upload':
							if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '' || fieldName === contField) {
								if (fieldName !== contField) {
									attrs[fieldName] = $(this).find('> .cmsmasters_field #' + fieldID).val();
								} else {
									var newImageArray = $(this).find('> .cmsmasters_field #' + fieldID).val().split('|');
									
									
									uploadContent = $(this).find('> .cmsmasters_field #' + fieldID).val();
									
									
									if (newImageArray.length > 1) {
										content = newImageArray[1];
									} else {
										content = newImageArray[0];
									}
								}
							}
							
							
							break;
						case 'gallery':
							if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '' || fieldName === contField) {
								if (fieldName !== contField) {
									attrs[fieldName] = $(this).find('> .cmsmasters_field #' + fieldID).val();
								} else {
									content = $(this).find('> .cmsmasters_field #' + fieldID).val();
								}
							}
							
							
							break;
						case 'radio':
							var radio = $(this).find('> .cmsmasters_field #' + fieldID + ' > .cmsmasters_check > input[type=radio]:checked');
							
							
							if (radio.length > 0) {
								attrs[fieldName] = radio.val();
							}
							
							
							break;
						case 'checkbox':
							var checkboxes = $(this).find('> .cmsmasters_field #' + fieldID + ' > .cmsmasters_check > label > input[type=checkbox]:checked'), 
								vals = '';
							
							
							if (checkboxes.length > 0) {
								for (var i = 0, ilength = checkboxes.length; i < ilength; i += 1) {
									vals += checkboxes.eq(i).val() + ',';
								}
								
								
								vals = vals.slice(0, -1);
								
								
								attrs[fieldName] = vals;
							}
							
							
							break;
						case 'multiple':
							if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '') {
								content = $(this).find('> .cmsmasters_field #' + fieldID).val();
							} else {
								content = cmsmastersShortcodes[shcd].def;
							}
							
							
							break;
						case 'table':
							if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '') {
								content = $(this).find('> .cmsmasters_field #' + fieldID).val().replace(/\n/g, '<br />');
							}
							
							
							break;
						case 'hidden':
							if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '') {
								attrs[fieldName] = $(this).find('> .cmsmasters_field #' + fieldID).val();
							}
							
							
							break;
						default:
							if (link) {
								attrs[fieldName] = fieldName + '{' + $(this).find('> .cmsmasters_field #' + fieldID).val() + '}';
							} else if ($(this).find('> .cmsmasters_field #' + fieldID).val() !== '') {
								attrs[fieldName] = $(this).find('> .cmsmasters_field #' + fieldID).val();
							}
						}
					}
				} );
				
				
				setTimeout(function () { 
					if (link) {
						for (var k in attrs) {
							attributes += attrs[k] + '|';
						}
						
						
						shortcode = attributes.slice(0, -1);
						
						
						newContent = '<span class="cmsmasters_link_text ' + 
						((typeof attrs['icon'] !== 'undefined') ? attrs['icon'].replace(/icon\{([^\}]*)\}/g, '$1') : '') + '">' + 
						((typeof attrs['title'] !== 'undefined') ? attrs['title'].replace(/title\{([^\}]*)\}/g, '$1') : '') + 
						((typeof attrs['link'] !== 'undefined') ? '<span class="cmsmasters_link_hide_empty">' + attrs['link'].replace(/link\{([^\}]*)\}/g, '$1') + '</span>' : '') + 
						'</span>';
						
						
						privateMethods.loadLink(shortcode, newContent, id);
					} else if (shcd !== 'cmsmasters_row' && shcd !== 'cmsmasters_column') {
						if (multiple) {
							shcdVisual = cmsmastersMultipleShortcodes[shcd].visual;
						} else if (for_editor) {
							shcdVisual = cmsmastersEditorShortcodes[shcd].visual;
						} else {
							shcdVisual = cmsmastersShortcodes[shcd].visual;
						}
						
						
						for (var k in attrs) {
							attributes += ' ' + k + '="' + attrs[k] + '"';
						}
						
						
						shortcode += '[' + shcd + attributes + ']';
						
						
						if (typeof shcdVisual === 'string' && !$.isEmptyObject(attrs)) {
							newContent = shcdVisual.replace(/\{\{\sdata\.([^\s]+)\s\}\}/g, function (str, data) { 
								for (var key in attrs) {
									if (data === contField) {
										return content;
									} else if (key === data) {
										return attrs[key];
									}
								}
								
								
								return '';
							} );
						} else {
							newContent = content;
						}
						
						
						if (uploadContent) {
							content = uploadContent;
						}
						
						
						if (multiple && !for_editor && $.inArray(shcd, cmsmastersContentComposer.methods.pairMultipleShortcodes.split('|')) !== -1) {
							shortcode += content + '[/' + shcd + ']';
						} else if (!multiple && for_editor && $.inArray(shcd, cmsmastersContentComposer.methods.pairEditorShortcodes.split('|')) !== -1) {
							shortcode += content + '[/' + shcd + ']';
						} else if (!multiple && !for_editor && $.inArray(shcd, cmsmastersContentComposer.methods.pairShortcodes.split('|')) !== -1) {
							shortcode += content + '[/' + shcd + ']';
						}
						
						
						if (multiple && !cmsmastersMultipleShortcodes[shcd].visual) {
							newContent = '<span class="cmsmastersShortcodeTitle">' + cmsmastersMultipleShortcodes[shcd].title + '</span>';
						} else if (for_editor && !cmsmastersEditorShortcodes[shcd].visual) {
							newContent = '<span class="cmsmastersShortcodeTitle">' + cmsmastersEditorShortcodes[shcd].title + '</span>';
						} else if (!multiple && !for_editor && !cmsmastersShortcodes[shcd].visual) {
							newContent = '<span class="cmsmastersShortcodeTitle ' + cmsmastersShortcodes[shcd].icon + '">' + cmsmastersShortcodes[shcd].title + '</span>';
						}
						
						
						if (obj.methods.body.find('#cmsmastersBox_' + id).data('editor') === undefined) {
							if (typeof shcdVisual === 'string') {
								var loadInterval = setInterval(function () { 
									if (newContent !== '') {
										clearInterval(loadInterval);
										
										
										if (multiple) {
											privateMethods.loadMultiple(shortcode, newContent, id);
										} else {
											privateMethods.loadContent(shortcode, newContent, id);
										}
									}
								}, 50);
							} else {
								privateMethods.loadContent(shortcode, newContent, id);
							}
						} else {
							obj.methods.closeLightbox('cmsmastersBox_' + id);
							
							
							tinyMCE.get(obj.methods.body.find('#cmsmastersBox_' + id).data('editor')).focus();
							
							
							window.tinyMCE.activeEditor.selection.setContent(shortcode);
						}
					} else {
						privateMethods.loadContent(attrs, false, id);
					}
				}, 150);
			}, 
			closeLightbox : function (id) { 
				if (obj.methods.body.find('#' + id).find('.cmsmastersBoxContInMid .mceIframeContainer').length > 0) {
					tinyMCE.get(tinyMCE.activeEditor.editorId).focus();
					
					tinyMCE.execCommand('mceRemoveEditor', true, tinyMCE.activeEditor.editorId);
				}
				
				
				obj.methods.body.find('#' + id).removeClass('showBox');
				
				
				if (obj.methods.body.find('.cmsmastersBoxOut').length < 2) {
					obj.methods.body.css( { 
						overflow : 'auto' 
					} );
				}
				
				
				if (obj.methods.body.find('.cmsmastersBoxOut').length > 1) {
					obj.methods.uniqID = obj.methods.body.find('.cmsmastersBoxOut').eq(-2).data('id');
				}
				
				
				setTimeout(function () { 
					privateMethods.destroyLightbox(id);
				}, 150);
			} 
		};
		
		// Private Methods
		privateMethods = { 
			attachEvents : function () { 
				obj.methods.lbCloseBut.bind('click', function () { 
					var id = privateMethods.getLbID(this);
					
					
					obj.methods.body.find('#' + id).addClass('preloadBox');
					
					
					obj.methods.closeLightbox(id);
					
					
					return false;
				} );
				
				
				obj.methods.lbCancelBut.bind('click', function () { 
					var id = privateMethods.getLbID(this);
					
					
					obj.methods.body.find('#' + id).addClass('preloadBox');
					
					
					obj.methods.closeLightbox(id);
					
					
					return false;
				} );
				
				
				if (obj.methods.options.backdropClose) {
					obj.methods.back.bind('click', function () { 
						var id = privateMethods.getLbID(this);
						
						
						obj.methods.body.find('#' + id).addClass('preloadBox');
						
						
						obj.methods.closeLightbox(id);
						
						
						return false;
					} );
				}
				
				
				obj.methods.lbSaveBut.bind('click', function () { 
					obj.methods.saveContent($(this).parents('.cmsmastersBoxOut').data('id'), (($(this).parents('.cmsmastersBoxOut').data('multiple')) ? true : false));
					
					
					return false;
				} );
				
				
				$(window).bind('resize', function () { 
					if (privateMethods.getWinWidth() < 930) {
						obj.methods.cont.addClass('resp');
					} else if (obj.methods.cont.hasClass('resp')) {
						obj.methods.cont.removeClass('resp');
					}
				} );
			}, 
			generateEditor : function (editorID) { 
				var init = tinyMCEPreInit.mceInit['content'];
				
				
				init['selector'] = '#' + editorID;
				init['wpautop'] = false;
				
				
				tinyMCE.init(init);
				
				
				if (!$('#' + editorID).hasClass('cmsmasters_not_focus')) {
					tinyMCE.get(editorID).focus();
				}
				
				
				window.wpActiveEditor = editorID;
				
				
				quicktags( { 
					id : editorID 
				} );
				
				QTags.addButton( 
					'column', 
					'col', 
					'[one_first]', 
					'[/one_first]', 
					'', 
					'', 
					111, 
					true 
				);
				
				
				var containerWrap = $('#' + editorID).parents('.wp-' + editorID + '-container-wrap');
				
				
				containerWrap.find('.wp-switch-editor').removeAttr('onclick');
				
				
				if ($('#wp-' + editorID + '-wrap').hasClass('html-active')) {
					$('#wp-' + editorID + '-wrap').removeClass('html-active').addClass('tmce-active');
				}
				
				
				containerWrap.find('.switch-tmce').bind('click', function () { 
					containerWrap.find('.wp-editor-wrap').removeClass('html-active').addClass('tmce-active');
					
					
					var valContent = $(this).parents('.wp-' + editorID + '-container-wrap').find('textarea#' + editorID).val(), 
						val = switchEditors.wpautop(valContent);
					
					
					$('textarea#' + editorID).val(val);
					
					
					tinyMCE.execCommand('mceAddEditor', true, editorID);
					
					if (tinyMCE.get(editorID)) {
						tinyMCE.get(editorID).focus();
					}
				} );
				
				
				containerWrap.find('.switch-html').bind('click', function () { 
					containerWrap.find('.wp-editor-wrap').removeClass('tmce-active').addClass('html-active');
					
					
					if (tinyMCE.get(editorID)) {
						tinyMCE.get(editorID).focus();
					}
					
					tinyMCE.execCommand('mceRemoveEditor', true, editorID);
				} );
			}, 
			loadContent : function (data, content, id) { 
				var idx = obj.methods.body.find('#cmsmastersBox_' + id).data('index').toString(), 
					index = (idx.indexOf('|') !== -1) ? idx.split('|') : idx;
				
				
				if (index.length === 3 && typeof index !== 'string') {
					obj.methods.el.find('> div.cmsmasters_row').eq(index[2]).find('> .innerRow > div.cmsmasters_column').eq(index[1]).find('> .innerColumn > div').eq(index[0]).find('> .innerShortcode > .innerCode').html(data);
					
					
					obj.methods.el.find('> div.cmsmasters_row').eq(index[2]).find('> .innerRow > div.cmsmasters_column').eq(index[1]).find('> .innerColumn > div').eq(index[0]).find('> .innerShortcode > .innerContent').html(content);
				} else if (index.length === 2 && typeof index !== 'string') {
					for (var key in cmsmastersColumn.fields) {
						obj.methods.el.find('> div.cmsmasters_row').eq(index[1]).find('> .innerRow > div.cmsmasters_column').eq(index[0]).removeAttr('data-' + key).removeData(key);
					}
					
					
					for (var k in data) {
						obj.methods.el.find('> div.cmsmasters_row').eq(index[1]).find('> .innerRow > div.cmsmasters_column').eq(index[0]).data(k, data[k]);
					}
				} else if (typeof index === 'string') {
					for (var key in cmsmastersRow.fields) {
						obj.methods.el.find('> div.cmsmasters_row').eq(index).removeAttr('data-' + key).removeData(key);
					}
					
					
					for (var k in data) {
						obj.methods.el.find('> div.cmsmasters_row').eq(index).data(k, data[k]);
					}
				} else {
					alert(cmsmasters_lightbox.error_on_page);
					
					
					return false;
				}
				
				
				obj.methods.body.find('#' + id).addClass('preloadBox');
				
				
				obj.methods.closeLightbox('cmsmastersBox_' + id);
				
				
				setTimeout(function () { 
					cmsmastersContentComposer.methods.updateContent();
				}, 150);
			}, 
			loadMultiple : function (data, content, id) { 
				var idx = obj.methods.body.find('#cmsmastersBox_' + id).data('index');
				
				
				obj.methods.body.find('.cmsmastersBoxOut').eq(-2).find('.cmsmasters_multiple_fields > div').eq(idx).find('> .innerCode').html(data.replace(/<\/p>\s+\[\//g, '</p>[/').replace(/\]\s+<p>/g, ']<p>').replace(/<\/p>\s+<([^\/])/g, '</p><$1'));
				
				
				obj.methods.body.find('.cmsmastersBoxOut').eq(-2).find('.cmsmasters_multiple_fields > div').eq(idx).find('> .innerContent').html(content);
				
				
				obj.methods.closeLightbox('cmsmastersBox_' + id);
				
				
				privateMethods.multiUpdate(obj.methods.body.find('.cmsmastersBoxOut').eq(-2).data('id'));
			}, 
			loadLink : function (data, content, id) { 
				var idx = obj.methods.body.find('#cmsmastersBox_' + id).data('index');
				
				
				obj.methods.body.find('.cmsmastersBoxOut').eq(-2).find('.cmsmasters_link_fields > li').eq(idx).find('> .cmsmasters_link_field').val(data);
				
				
				obj.methods.body.find('.cmsmastersBoxOut').eq(-2).find('.cmsmasters_link_fields > li').eq(idx).find('> .cmsmasters_link_wrap').html(content);
				
				
				obj.methods.closeLightbox('cmsmastersBox_' + id);
				
				
				privateMethods.linkUpdate(obj.methods.body.find('.cmsmastersBoxOut').eq(-2).data('id'));
			}, 
			destroyLightbox : function (id) { 
				obj.methods.body.find('#' + id).find('.cmsmastersBoxContInMid > div').remove();
				
				
				obj.methods.body.find('#' + id).remove();
			}, 
			attachDependenceEvents : function () { 
				var id = '_' + obj.methods.uniqID, 
					shcd = obj.methods.body.find('#cmsmastersBox' + id).data('shortcode'), 
					multi = obj.methods.body.find('#cmsmastersBox' + id).data('multiple'), 
					for_editor = obj.methods.body.find('#cmsmastersBox' + id).data('for_editor'), 
					link = obj.methods.body.find('#cmsmastersBox' + id).data('link'), 
					newFields = [], 
					dependField = [], 
					dependFields = {};
				
				
				if (shcd !== 'cmsmasters_row' && shcd !== 'cmsmasters_column') {
					if (multi) {
						newFields = cmsmastersMultipleShortcodes[shcd].fields;
					} else if (for_editor) {
						newFields = cmsmastersEditorShortcodes[shcd].fields;
					} else if (link) {
						newFields = cmsmastersLinkShortcode.fields;
					} else {
						newFields = cmsmastersShortcodes[shcd].fields;
					}
				} else if (shcd === 'cmsmasters_row') {
					newFields = cmsmastersRow.fields;
				} else {
					newFields = cmsmastersColumn.fields;
				}
				
				
				for (var key in newFields) {
					if (typeof newFields[key].depend === 'string') {
						dependField = newFields[key].depend.split(':');
						
						
						if (typeof dependFields[dependField[0] + id] === 'object') {
							if (typeof dependFields[dependField[0] + id][dependField[1]] === 'undefined') {
								dependFields[dependField[0] + id][dependField[1]] = new Array(key + id);
							} else {
								dependFields[dependField[0] + id][dependField[1]].push(key + id);
							}
						} else {
							dependFields[dependField[0] + id] = {};
							
							
							dependFields[dependField[0] + id][dependField[1]] = new Array(key + id);
						}
					}
				}
				
				
				for (var k in dependFields) {
					var lightbox = obj.methods.body.find('#cmsmastersBox' + id), 
						fieldParent = lightbox.find('div[data-id="' + k + '"]'), 
						fieldType = fieldParent.data('type');
					
					
					if (fieldType === 'select') {
						for (var x in dependFields[k]) {
							if (fieldParent.find('select#' + k).val() === x) {
								for (var i = 0, ilength = dependFields[k][x].length; i < ilength; i += 1) {
									lightbox.find('div[data-id="' + dependFields[k][x][i] + '"]').slideDown('fast');
								}
							}
						}
						
						
						fieldParent.find('select#' + k).bind('change', function (e) { 
							var newK = $(e.target).attr('id');
							
							
							for (var y in dependFields[newK]) {
								if ($(this).val() === y) {
									for (var j = 0, jlength = dependFields[newK][y].length; j < jlength; j += 1) {
										lightbox.find('div[data-id="' + dependFields[newK][y][j] + '"]').slideDown('fast');
									}
								} else {
									for (var l = 0, llength = dependFields[newK][y].length; l < llength; l += 1) {
										lightbox.find('div[data-id="' + dependFields[newK][y][l] + '"]').slideUp('fast');
									}
								}
							}
						} );
					} else if (fieldType === 'radio') {
						for (var x in dependFields[k]) {
							if (fieldParent.find('input[name="' + k + '"]:checked').val() === x) {
								for (var i = 0, ilength = dependFields[k][x].length; i < ilength; i += 1) {
									lightbox.find('div[data-id="' + dependFields[k][x][i] + '"]').slideDown('fast');
								}
							}
						}
						
						
						fieldParent.find('input[name="' + k + '"]').bind('change', function (e) { 
							var newK = $(e.target).attr('name');
							
							
							for (var y in dependFields[newK]) {
								if ($(this).val() === y) {
									for (var j = 0, jlength = dependFields[newK][y].length; j < jlength; j += 1) {
										lightbox.find('div[data-id="' + dependFields[newK][y][j] + '"]').slideDown('fast');
									}
								} else {
									for (var l = 0, llength = dependFields[newK][y].length; l < llength; l += 1) {
										lightbox.find('div[data-id="' + dependFields[newK][y][l] + '"]').slideUp('fast');
									}
								}
							}
						} );
					} else if (fieldType === 'checkbox') {
						for (var w in dependFields[k]) {
							if (fieldParent.find('input[type="checkbox"]:checked').val() === w) {
								for (var m = 0, mlength = dependFields[k][w].length; m < mlength; m += 1) {
									lightbox.find('div[data-id="' + dependFields[k][w][m] + '"]').slideDown('fast');
								}
							}
						}
						
						
						fieldParent.find('input[type="checkbox"]').bind('change', function (e) { 
							var newK = $(e.target).parents('div[data-id]').data('id');
							
							
							for (var y in dependFields[newK]) {
								if ($(this).is(':checked') && $(this).val() === y) {
									for (var j = 0, jlength = dependFields[newK][y].length; j < jlength; j += 1) {
										lightbox.find('div[data-id="' + dependFields[newK][y][j] + '"]').slideDown('fast');
									}
								} else {
									for (var l = 0, llength = dependFields[newK][y].length; l < llength; l += 1) {
										lightbox.find('div[data-id="' + dependFields[newK][y][l] + '"]').slideUp('fast');
									}
								}
							}
						} );
					} else if (fieldType === 'upload' || fieldType === 'input') {
						for (var s in dependFields[k]) {
							if (fieldParent.find('input#' + k).val() !== '') {
								for (var n = 0, nlength = dependFields[k][s].length; n < nlength; n += 1) {
									lightbox.find('div[data-id="' + dependFields[k][s][n] + '"]').slideDown('fast');
								}
							}
						}
						
						
						fieldParent.find('input#' + k).bind('change', function (e) { 
							var newK = $(e.target).attr('id');
							
							
							for (var y in dependFields[newK]) {
								if ($(this).val() !== '') {
									for (var j = 0, jlength = dependFields[newK][y].length; j < jlength; j += 1) {
										lightbox.find('div[data-id="' + dependFields[newK][y][j] + '"]').slideDown('fast');
									}
								} else {
									for (var l = 0, llength = dependFields[newK][y].length; l < llength; l += 1) {
										lightbox.find('div[data-id="' + dependFields[newK][y][l] + '"]').slideUp('fast');
									}
								}
							}
						} );
					} else if (fieldType === 'hidden') {
						for (var x in dependFields[k]) {
							if (fieldParent.find('input[name="' + k + '"]').val() === x) {
								for (var i = 0, ilength = dependFields[k][x].length; i < ilength; i += 1) {
									lightbox.find('div[data-id="' + dependFields[k][x][i] + '"]').slideDown('fast');
								}
							}
						}
					}
				}
			}, 
			attachGeneratedEvents : function () { 
				// Type Shortcodes
				if ($.inArray('shortcodes', obj.methods.eventsArray) !== -1) {
					// Shortcode Choose
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_shortcodes ul li a').bind('click', function () { 
						var shcd = $(this).data('shortcode'), 
							prepend = $(this).parents('.cmsmasters_shortcodes').data('prepend'), 
							cmsmasters_editor = $(this).data('editor');
						
						
						if (obj.methods.colIndex) {
							cmsmastersContentComposer.methods.addShortcode(shcd, obj.methods.colIndex, prepend);
							
							
							obj.methods.closeLightbox('cmsmastersBox_' + obj.methods.uniqID);
						} else {
							var attrs = '',	
								contentPart = '', 
								elObj = {};
							
							
							if (cmsmasters_editor) {
								for (var k in cmsmastersEditorShortcodes[shcd].fields) {
									if ( 
										k !== cmsmastersEditorShortcodes[shcd].content && 
										cmsmastersEditorShortcodes[shcd].fields[k].def !== ''
									) {
										attrs += ' ' + k + '="' + cmsmastersEditorShortcodes[shcd].fields[k].def + '"';
									}
								}
								
								
								attrs += ' shortcode_id="' + privateMethods.getAttrUniqID() + '"';
								
								
								contentPart = cmsmastersEditorShortcodes[shcd].pair ? cmsmastersEditorShortcodes[shcd].def + '[/' + shcd + ']' : '';
							} else {
								for (var k in cmsmastersShortcodes[shcd].fields) {
									if ( 
										k !== cmsmastersShortcodes[shcd].content && 
										cmsmastersShortcodes[shcd].fields[k].def !== ''
									) {
										attrs += ' ' + k + '="' + cmsmastersShortcodes[shcd].fields[k].def + '"';
									}
								}
								
								
								attrs += ' shortcode_id="' + privateMethods.getAttrUniqID() + '"';
								
								
								contentPart = cmsmastersShortcodes[shcd].pair ? cmsmastersShortcodes[shcd].def + '[/' + shcd + ']' : '';
							}
							
							
							elObj = { 
								type : 			shcd, 
								index : 		obj.methods.colIndex, 
								content : 		'[' + shcd + attrs + ']' + contentPart, 
								editor : 		window.tinyMCE.activeEditor.id, 
								for_editor : 	(cmsmasters_editor ? true : false) 
							};
							
							
							obj.methods.closeLightbox('cmsmastersBox_' + obj.methods.uniqID);
							
							
							setTimeout(function () { 
								obj.methods.openLightbox(elObj);
							}, 150);
						}
						
						
						return false;
					} );
				}
				
				// Type Select Multiple
				if ($.inArray('select_multiple', obj.methods.eventsArray) !== -1) {
					// Select Change
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_field_select_multiple select').bind('change', function () { 
						$(this).parents('.cmsmasters_field_select_multiple').find('.cmsmasters_cat_cancel').fadeIn('fast');
					} );
					
					// Cancel Select Choises
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_cat_cancel').bind('click', function () { 
						$(this).parents('.cmsmasters_field_select_multiple').find('select > option').removeProp('selected');
						
						
						$(this).fadeOut('fast');
						
						
						return false;
					} );
				}
				
				// Type Color
				if ($.inArray('color', obj.methods.eventsArray) !== -1) {
					// Color Picker
					if (cmsmasters_lightbox.palettes !== '') {
						$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_color_field').wpColorPicker( { 
							palettes : 	cmsmasters_lightbox.palettes.split(',') 
						} );
					} else {
						$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_color_field').wpColorPicker();
					}
				}
				
				// Type Range
				if ($.inArray('range', obj.methods.eventsArray) !== -1) {
					// Range Number Change
					$('#cmsmastersBox_' + obj.methods.uniqID + ' input[type="range"]').bind('change', function () { 
						$(this).next('input[type=text]').val($(this).val());
					} );
				}
				
				// Type Upload
				if ($.inArray('upload', obj.methods.eventsArray) !== -1) {
					// Uploaded Image Remove
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_upload_cancel').bind('click', function () { 
						$(this).parent().fadeOut(500, function () {
							$(this).removeAttr('style').find('.cmsmasters_preview_image').attr('src', '');
							
							
							$(this).next().val('').trigger('change');
						} );
						
						
						return false;
					} );
				}
				
				// Type Gallery
				if ($.inArray('gallery', obj.methods.eventsArray) !== -1) {
					// Gallery Image Remove
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_gallery').on('click', '.cmsmasters_gallery_cancel', function () { 
						$(this).parents('li').fadeOut(500, function () {
							if ($(this).parents('ul').find('li').length < 2) {
								$(this).parents('ul').parent().find('.cmsmasters_upload_button').data( { 
									state : 	'gallery-library', 
									editing : 	false 
								} ).val(cmsmasters_lightbox.create_gallery);
							}
							
							
							$(this).remove();
							
							
							privateMethods.galUpdate(obj.methods.uniqID);
						} );
						
						
						return false;
					} );
					
					// Sort Gallery Images
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_gallery').sortable( { 
						items : '> li', 
						handle : '> img', 
						tolerance : 'pointer', 
						opacity : 0.85, 
						cursor : 'move', 
						update : function () { 
							privateMethods.galUpdate(obj.methods.uniqID);
						} 
					} );
				}
				
				// Type Multiple
				if ($.inArray('multiple', obj.methods.eventsArray) !== -1) {
					// Add Controls
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_multiple_fields > div').each(function () { 
						privateMethods.multiAddControls($(this));
					} );
					
					// Add New Element
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_multiple_parent > .cmsmasters_multi_add').bind('click', function () { 
						var shcd = $('#cmsmastersBox_' + obj.methods.uniqID).data('shortcode').slice(0, -1), 
							multiFields = $(this).parents('.cmsmasters_multiple_parent').find('.cmsmasters_multiple_fields'), 
							attrs = '', 
							val = '', 
							html = undefined;
						
						
						for (var k in cmsmastersMultipleShortcodes[shcd].fields) {
							if ( 
								cmsmastersMultipleShortcodes[shcd].content !== k && 
								cmsmastersMultipleShortcodes[shcd].fields[k].def !== ''
							) {
								attrs += ' ' + k + '="' + cmsmastersMultipleShortcodes[shcd].fields[k].def + '"';
							}
						}
						
						
						attrs += ' shortcode_id="' + privateMethods.getAttrUniqID() + '"';
						
						
						val = '[' + shcd + attrs + ']' + (cmsmastersMultipleShortcodes[shcd].pair ? cmsmastersMultipleShortcodes[shcd].def + '[/' + shcd + ']' : '');
						
						
						html = $(cmsmastersContentComposer.methods.convertShortcodes(val, shcd)).hide();
						
						
						multiFields.append(html);
						
						
						multiFields.find('> div:eq(-1)').slideDown('fast');
						
						
						privateMethods.multiAddControls(multiFields.find('> div:eq(-1)'));
						
						
						privateMethods.multiUpdate(obj.methods.uniqID);
						
						
						return false;
					} );
					
					// Edit Element
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_multiple_fields').on('click', '> div > .innerContent', function () { 
						var shcd = $('#cmsmastersBox_' + obj.methods.uniqID).data('shortcode').slice(0, -1), 
							elObj = {}, 
							newCode = $(this).parent().find('.innerCode').html().replace(/shortcode_id=["'][^"']+["']/g, function () { 
								return 'shortcode_id="' + privateMethods.getAttrUniqID() + '"';
							} );
						
						
						elObj = { 
							type : 		shcd, 
							index : 	$(this).parent().index(), 
							content : 	newCode, 
							multiple : 	true 
						};
						
						
						setTimeout(function () { 
							obj.methods.openLightbox(elObj);
						}, 150);
						
						
						return false;
					} );
					
					// Copy Element
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_multiple_fields').on('click', '> div > .cmsmasters_multi_copy', function () { 
						var el = 		$(this).parent(), 
							elClone = 	el.clone();
						
						
						el.after(elClone.hide());
						
						
						el.next().slideDown('fast', function () { 
							privateMethods.multiUpdate(obj.methods.uniqID);
						} );
						
						
						return false;
					} );
					
					// Delete Element
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_multiple_fields').on('click', '> div > .cmsmasters_multi_del', function () { 
						$(this).parent().slideUp('fast', function () { 
							$(this).remove();
							
							
							privateMethods.multiUpdate(obj.methods.uniqID);
						} );
						
						
						return false;
					} );
					
					// Sort Elements
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_multiple_fields').sortable( { 
						items : '> div', 
						handle : '> .cmsmasters_multi_handle', 
						containment : 'parent', 
						tolerance : 'pointer', 
						axis : 'y', 
						opacity : 0.85, 
						cursor : 'move', 
						update : function () { 
							privateMethods.multiUpdate(obj.methods.uniqID);
						} 
					} );
				}
				
				// Type Table
				if ($.inArray('table', obj.methods.eventsArray) !== -1) {
					// Apply Column Text Align
					privateMethods.applyColAlign();
					
					// Apply Row Type
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table .cmsmasters_table_row').each(function () { 
						if ($(this).is(':not(.cmsmasters_table_row_top)') && $(this).is(':not(.cmsmasters_table_row_bot)')) {
							var rowType = $(this).find('.cmsmasters_table_cell:eq(0) .cmsmasters_row_select').val();
							
							
							if (rowType !== '') {
								$(this).addClass('cmsmasters_table_row_' + rowType);
							}
							
							
							$(this).find('.cmsmasters_table_cell').filter(':not(:eq(0))').filter(':not(:eq(-1))').each(function () { 
								if (rowType === 'header') {
									$(this).addClass('.cmsmasters_table_cell_haeder');
								}
							} );
						}
					} );
					
					// Change Column Text Align
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table').on('change', '.cmsmasters_column_select', function () { 
						var index = $(this).parents('.cmsmasters_table_cell').index(), 
							colAlign = $(this).val();
						
						
						$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table .cmsmasters_table_row').each(function () { 
							if ($(this).is(':not(.cmsmasters_table_row_top)') && $(this).is(':not(.cmsmasters_table_row_bot)')) {
								$(this).find('.cmsmasters_table_cell').eq(index).removeClass('cmsmasters_table_cell_aligncenter cmsmasters_table_cell_alignright').addClass('cmsmasters_table_cell_align' + colAlign);
							}
						} );
						
						
						setTimeout(function () { 
							privateMethods.tableUpdate(obj.methods.uniqID);
						}, 150);
					} );
					
					// Change Row Type
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table').on('change', '.cmsmasters_row_select', function () { 
						var row = $(this).parents('.cmsmasters_table_row'), 
							rowType = $(this).val();
						
						
						row.removeClass('cmsmasters_table_row_header cmsmasters_table_row_footer').addClass('cmsmasters_table_row_' + rowType);
						
						
						row.find('.cmsmasters_table_cell').filter(':not(:eq(0))').filter(':not(:eq(-1))').each(function () { 
							if (rowType === 'header') {
								$(this).addClass('.cmsmasters_table_cell_haeder');
							}
						} );
						
						
						setTimeout(function () { 
							privateMethods.tableUpdate(obj.methods.uniqID);
						}, 150);
					} );
					
					// Edit Table Cell Text
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table').on('click', '.cmsmasters_table_cell.cmsmasters_change_cell', function () { 
						var cellText = $(this).html().replace(/<br\s?\/?>/g, "\n");
						
						
						$(this).removeClass('cmsmasters_change_cell').html('<textarea></textarea>').find('textarea').focus().html(cellText);
					} );
					
					// Change Table Cell Text
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table').on('focusout mouseleave', '.cmsmasters_table_cell textarea', function () { 
						var textArea = $(this), 
							cellText = textArea.val().replace(/\n/g, "<br />");
						
						
						setTimeout(function () { 
							textArea.parents('.cmsmasters_table_cell').addClass('cmsmasters_change_cell').html(cellText);
							
							
							setTimeout(function () { 
								privateMethods.tableUpdate(obj.methods.uniqID);
							}, 150);
						}, 100);
					} );
					
					// Add New Table Row
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table_row_button').bind('click', function () { 
						var rowCols = $('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table .cmsmasters_table_row:eq(0) .cmsmasters_table_cell').filter(':not(:eq(0))').filter(':not(:eq(-1))'), 
							colsCount = rowCols.length, 
							newRow = '<div class="cmsmasters_table_row">' + 
							'<div class="cmsmasters_table_cell">' + 
								'<select id="cmsmasters_row_select_' + colsCount + '" name="cmsmasters_row_select_' + colsCount + '" class="cmsmasters_row_select">' + 
									'<option value="">' + cmsmasters_lightbox.default_row + '</option>' + 
									'<option value="header">' + cmsmasters_lightbox.header_row + '</option>' + 
									'<option value="footer">' + cmsmasters_lightbox.footer_row + '</option>' + 
								'</select>' + 
							'</div>';
						
						
						rowCols.each(function () { 
							newRow += '<div class="cmsmasters_table_cell cmsmasters_change_cell"></div>';
						} );
						
						
						newRow += '<div class="cmsmasters_table_cell">' + 
								'<a class="cmsmasters_row_remove admin-icon-remove" title="' + cmsmasters_lightbox.delete_row + '" href="#"></a>' + 
							'</div>' + 
						'</div>';
						
						
						$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table .cmsmasters_table_row_bot').before(newRow);
						
						
						privateMethods.applyColAlign();
						
						
						setTimeout(function () { 
							privateMethods.tableUpdate(obj.methods.uniqID);
						}, 150);
						
						
						return false;
					} );
					
					// Add New Table Column
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table_column_button').bind('click', function () { 
						var tableRows = $('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table .cmsmasters_table_row');
						
						
						tableRows.each(function () { 
							var lastCell = $(this).find('.cmsmasters_table_cell').eq(-1);
							
							
							if ($(this).hasClass('cmsmasters_table_row_top')) {
								var cellsCount = $(this).find('.cmsmasters_table_cell').length - 2;
								
								
								lastCell.before('<div class="cmsmasters_table_cell cmsmasters_table_cell_top">' + 
									'<select id="cmsmasters_column_select_' + cellsCount + '" name="cmsmasters_column_select_' + cellsCount + '" class="cmsmasters_column_select">' + 
										'<option value="left">' + cmsmasters_lightbox.text_align_left + '</option>' + 
										'<option value="center">' + cmsmasters_lightbox.text_align_center + '</option>' + 
										'<option value="right">' + cmsmasters_lightbox.text_align_right + '</option>' + 
									'</select>' + 
								'</div>');
							} else if ($(this).hasClass('cmsmasters_table_row_bot')) {
								lastCell.before('<div class="cmsmasters_table_cell cmsmasters_table_cell_bot">' + 
									'<a class="cmsmasters_column_remove admin-icon-remove" title="' + cmsmasters_lightbox.delete_col + '" href="#"></a>' + 
								'</div>');
							} else {
								lastCell.before('<div class="cmsmasters_table_cell cmsmasters_change_cell"></div>');
							}
						} );
						
						
						setTimeout(function () { 
							privateMethods.tableUpdate(obj.methods.uniqID);
						}, 150);
						
						
						return false;
					} );
					
					// Delete Table Row
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table').on('click', '.cmsmasters_row_remove', function () { 
						$(this).parents('.cmsmasters_table_row').fadeOut('fast', function () { 
							$(this).remove();
							
							
							setTimeout(function () { 
								privateMethods.tableUpdate(obj.methods.uniqID);
							}, 150);
						} );
						
						
						return false;
					} );
					
					// Delete Table Column
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table').on('click', '.cmsmasters_column_remove', function () { 
						var colIndex = $(this).parents('.cmsmasters_table_cell').index();
						
						
						$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table .cmsmasters_table_row').each(function () { 
							$(this).find('.cmsmasters_table_cell').eq(colIndex).fadeOut('fast', function () { 
								$(this).remove();
							} );
						} );
						
						
						setTimeout(function () { 
							privateMethods.tableUpdate(obj.methods.uniqID);
						}, 150);
						
						
						return false;
					} );
				}
				
				// Type Link
				if ($.inArray('link', obj.methods.eventsArray) !== -1) {
					// Add New Element
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_link_parent > .cmsmasters_link_add').bind('click', function () { 
						var multiFields = $(this).parents('.cmsmasters_link_parent').find('.cmsmasters_link_fields'), 
							fieldsLength = multiFields.find('> li').length, 
							html = undefined;
						
						
						html = '<li>' + 
							'<span class="cmsmasters_link_handle admin-icon-move"></span>' + 
							'<div class="cmsmasters_link_wrap">' + 
								'<span class="cmsmasters_link_text"></span>' + 
							'</div>' + 
							'<a href="#" class="cmsmasters_link_del admin-icon-remove" title="' + cmsmasters_lightbox.remove + '"></a>' + 
							'<input type="hidden" id="cmsmasters_link_field_' + fieldsLength + '" name="cmsmasters_link_field_' + fieldsLength + '" class="cmsmasters_link_field" value="" />' + 
						'</li>';
						
						
						multiFields.append(html);
						
						
						multiFields.find('> li:eq(-1)').slideDown('fast');
						
						
						privateMethods.linkUpdate(obj.methods.uniqID);
						
						
						return false;
					} );
					
					// Edit Element
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_link_fields').on('click', '> li > .cmsmasters_link_wrap', function () { 
						var shcd = $('#cmsmastersBox_' + obj.methods.uniqID).data('shortcode') + '_link', 
							elObj = {};
						
						
						elObj = { 
							type : 		shcd, 
							index : 	$(this).parents('li').index(), 
							content : 	$(this).parents('li').find('.cmsmasters_link_field').val(), 
							link : 		true 
						};
						
						
						setTimeout(function () { 
							obj.methods.openLightbox(elObj);
						}, 150);
						
						
						return false;
					} );
					
					// Delete Element
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_link_fields').on('click', '> li > .cmsmasters_link_del', function () { 
						$(this).parents('li').slideUp('fast', function () { 
							$(this).remove();
							
							
							privateMethods.linkUpdate(obj.methods.uniqID);
						} );
						
						
						return false;
					} );
					
					// Sort Elements
					$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_link_fields').sortable( { 
						items : '> li', 
						handle : '> .cmsmasters_link_handle', 
						containment : 'parent', 
						tolerance : 'pointer', 
						axis : 'y', 
						opacity : 0.85, 
						cursor : 'move', 
						update : function () { 
							privateMethods.linkUpdate(obj.methods.uniqID);
						} 
					} );
				}
			}, 
			getLbID : function (el) { 
				return $(el).parents('.cmsmastersBoxOut').attr('id');
			}, 
			getUniqID : function () { 
				return (new Date().getTime()).toString(16);
			}, 
			getWinWidth : function () { 
				return $(window).width();
			}, 
			sanitizeContent : function (content) { 
				return (typeof content === 'string') ? content.replace(/\[/g, '').replace(/\]/g, '').replace(/\n/g, '&#60;br /&#62;').replace(/</g, '&#60;').replace(/>/g, '&#62;').replace(/\"/g, '&#8243;').replace(/\'/g, '&#8242;') : '';
			}, 
			unSanitizeContent : function (content) { 
				return (typeof content === 'string') ? content.replace(/&#60;br\s?\/?&#62;/g, "\n").replace(/&#8243;/g, '"').replace(/&#8242;/g, "'").replace(/<br\s?\/?>/g, "\n").replace(/\u2033/g, '"').replace(/\u2032/g, "'") : content;
			}, 
			base64Encode : function (content) { 
				$.base64.utf8encode = true;
				
				return $.base64.btoa(content);
			}, 
			base64Decode : function (content) { 
				$.base64.utf8decode = true;
				
				return $.base64.atob(content);
			}, 
			multiAddControls : function (el) { 
				el.prepend('<span class="cmsmasters_multi_handle admin-icon-move"></span>');
				
				
				el.append('<a href="#" class="cmsmasters_multi_del admin-icon-remove"></a>');
				
				
				el.append('<a href="#" class="cmsmasters_multi_copy admin-icon-copy"></a>');
			}, 
			galUpdate : function (id) { 
				setTimeout(function () { 
					var newText = '';
					
					
					$('#cmsmastersBox_' + id + ' .cmsmasters_gallery > li').each(function () { 
						newText += $(this).find('img').data('id') + '|';
						
						newText += $(this).find('img').attr('src') + ',';
					} );
					
					
					if (newText !== '') {
						newText = newText.slice(0, -1);
					} else {
						$('#cmsmastersBox_' + id + ' .cmsmasters_gallery_images').trigger('change');
					}
					
					
					$('#cmsmastersBox_' + id + ' .cmsmasters_gallery_images').val(newText);
				}, 150);
			}, 
			multiUpdate : function (id) { 
				setTimeout(function () { 
					var newText = '';
					
					
					$('#cmsmastersBox_' + id + ' .cmsmasters_multiple_fields > div').each(function () { 
						newText += $(this).find('.innerCode').html();
					} );
					
					
					$('#cmsmastersBox_' + id + ' .cmsmasters_multiple_value').text(newText);
				}, 150);
			}, 
			tableUpdate : function (id) { 
				setTimeout(function () { 
					var newText = '', 
						alignArray = [];
					
					
					$('#cmsmastersBox_' + id + ' .cmsmasters_table > .cmsmasters_table_row.cmsmasters_table_row_top .cmsmasters_table_cell').filter(':not(:first-child)').filter(':not(:last-child)').each(function () { 
						alignArray.push($(this).find('select').val());
					} );
					
					
					$('#cmsmastersBox_' + id + ' .cmsmasters_table > .cmsmasters_table_row').filter(':not(.cmsmasters_table_row_top)').filter(':not(.cmsmasters_table_row_bot)').each(function () { 
						var rowType = $(this).find('.cmsmasters_table_cell:eq(0) select').val();
						
						
						newText += '[cmsmasters_tr' + ((rowType !== '') ? ' type="' + rowType + '"' : '') + ']';
						
						
						$(this).find('.cmsmasters_table_cell').filter(':not(:eq(0))').filter(':not(:eq(-1))').each(function (n) { 
							newText += '[cmsmasters_td' + 
							((rowType === 'header') ? ' type="header"' : '') + 
							((alignArray[n] !== '') ? ' align="' + alignArray[n] + '"' : '') + 
							']' + $(this).html() + '[/cmsmasters_td]';
						} );
						
						
						newText += '[/cmsmasters_tr]';
					} );
					
					
					$('#cmsmastersBox_' + id + ' .cmsmasters_table_value').text(newText);
				}, 150);
			}, 
			applyColAlign : function () { 
				$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table .cmsmasters_table_cell_top').each(function (id) { 
					if ($(this).html() !== '') {
						var colAlign = $(this).find('.cmsmasters_column_select').val();
						
						
						if (colAlign !== '') {
							$('#cmsmastersBox_' + obj.methods.uniqID + ' .cmsmasters_table .cmsmasters_table_row').each(function () { 
								if ($(this).is(':not(.cmsmasters_table_row_top)') && $(this).is(':not(.cmsmasters_table_row_bot)')) {
									$(this).find('.cmsmasters_table_cell').eq(id).addClass('cmsmasters_table_cell_align' + colAlign);
								}
							} );
						}
					}
				} );
			}, 
			linkUpdate : function (id) { 
				setTimeout(function () { 
					var newText = '';
					
					
					$('#cmsmastersBox_' + id + ' .cmsmasters_link_fields > li').each(function () { 
						newText += $(this).find('.cmsmasters_link_field').val() + '||';
					} );
					
					
					$('#cmsmastersBox_' + id + ' .cmsmasters_link_value').val(newText.slice(0, -2));
				}, 150);
			}, 
			getAttrUniqID : function () { 
				return Math.random().toString(36).substr(3, 10);
			} 
		};
		
		
		obj.methods.init();
	};
	
	// Plugin Start
	$.fn.cmsmastersComposerLightbox = function (parameters) { 
		return this.each(function () { 
			if ($(this).data('cmsmastersComposerLightbox')) { 
				return;
			}
			
			
			var cmsmastersComposerLightbox = new ComposerLightbox(this, parameters);
			
			
			$(this).data('cmsmastersComposerLightbox', cmsmastersComposerLightbox);
		} );
	};
} )(jQuery);

