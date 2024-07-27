/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.4.5
 * 
 * Visual Content Composer jQuery Plugin
 * Created by CMSMasters
 * 
 */

 
(function ($) { 
	var ContentComposer = function (element, parameters) { 
		var defaults = { 
				editorID : 				'content', 
				composerButton : 		'#cmsmasters_content_composer_button', 
				toGutenbergButton : 	'#cmsmasters_gutenberg_button' 
			}, 
			obj = this, 
			privateMethods = {};
		
		// Global Methods
		obj.methods = { 
			init : function () { 
				obj.methods.options = $.extend({}, defaults, parameters);
				
				
				obj.methods.el = $(element);
				
				obj.methods.elCont = obj.methods.el.parent();
				
				
				obj.methods.body = $('body');
				
				
				obj.methods.setVars();
				
				
				privateMethods.attachStaticEvents();
				
				
				privateMethods.composerAutoStart();
			}, 
			setVars : function () { 
				obj.methods.editorID = obj.methods.options.editorID;
				
				obj.methods.composerButton = $(obj.methods.options.composerButton);
				
				obj.methods.toGutenbergButton = $(obj.methods.options.toGutenbergButton);
				
				
				obj.methods.butCont = obj.methods.elCont.find('> .cmsmasters_composer_buttons_container');
				
				
				obj.methods.butElems = obj.methods.butCont.find('> .cmsmasters_composer_buttons_container_wrap');
				
				
				obj.methods.butTemp = obj.methods.butCont.find('> .cmsmasters_composer_templates_container_wrap');
				
				
				obj.methods.content = $('#' + obj.methods.editorID);
				
				obj.methods.publish = $('#publish');
				
				
				obj.methods.editorHTML = false;
				
				obj.methods.shortcodes = [];
				
				
				obj.methods.composerShow = $('#cmsmasters_composer_show');

				obj.methods.gutenbergShow = $('#cmsmasters_gutenberg_show');
				
				obj.methods.composerFullScreen = $('#cmsmasters_composer_fullscreen');
				
				obj.methods.composerBegin = $('#cmsmasters_composer_begin');
				
				obj.methods.composerConfirm = $('#cmsmasters_composer_confirm');
				
				
				obj.methods.templates = obj.methods.butTemp.find('.cmsmasters_pattern_list > ul');
				
				
				obj.methods.messageSave = $('#cmsmasters_composer_message_saved');
				obj.methods.messageSaveAll = $('#cmsmasters_composer_message_saved_all');
				obj.methods.messageLoad = $('#cmsmasters_composer_message_added');
				obj.methods.messageDelete = $('#cmsmasters_composer_message_deleted');
				
				
				obj.methods.cmsmastersShortcodes = '';
				obj.methods.pairShortcodes = '';
				obj.methods.unpairedShortcodes = '';
				
				obj.methods.pairMultipleShortcodes = '';
				
				obj.methods.pairEditorShortcodes = '';
				
				
				for (var key in cmsmastersShortcodes) {
					obj.methods.cmsmastersShortcodes += key + '|';
				}
				
				obj.methods.cmsmastersShortcodes = obj.methods.cmsmastersShortcodes.slice(0, -1);
				
				
				for (var key in cmsmastersShortcodes) {
					if (cmsmastersShortcodes[key].pair) {
						obj.methods.pairShortcodes += key + '|';
					}
				}
				
				obj.methods.pairShortcodes = obj.methods.pairShortcodes.slice(0, -1);
				
				
				for (var key in cmsmastersShortcodes) {
					if (!cmsmastersShortcodes[key].pair) {
						obj.methods.unpairedShortcodes += key + '|';
					}
				}
				
				obj.methods.unpairedShortcodes = obj.methods.unpairedShortcodes.slice(0, -1);
				
				
				for (var key in cmsmastersMultipleShortcodes) {
					if (cmsmastersMultipleShortcodes[key].pair) {
						obj.methods.pairMultipleShortcodes += key + '|';
					}
				}
				
				obj.methods.pairMultipleShortcodes = obj.methods.pairMultipleShortcodes.slice(0, -1);
				
				
				for (var key in cmsmastersEditorShortcodes) {
					if (cmsmastersEditorShortcodes[key].pair) {
						obj.methods.pairEditorShortcodes += key + '|';
					}
				}
				
				obj.methods.pairEditorShortcodes = obj.methods.pairEditorShortcodes.slice(0, -1);
			}, 
			composerToggle : function () { 
				if ($('#postdivrich').is(':visible')) {
					if ($('#wp-' + obj.methods.editorID + '-wrap').hasClass('html-active')) {
						obj.methods.editorHTML = true;
						
						
						switchEditors.go(obj.methods.editorID, 'tmce');
					} else {
						obj.methods.editorHTML = false;
					}
					
					
					obj.methods.parseContent(false);
					
					
					obj.methods.appendControls();
					
					
					$('#postdivrich').hide();
					
					$('#cmsmasters_composer_meta_box').show();
					
					
					obj.methods.composerButton.text(obj.methods.composerButton.data('editor'));
					
					
					obj.methods.composerShow.val('true');
					
					
					obj.methods.startObj();
					
					
					obj.methods.buildButtons();
					
					
					obj.methods.el.removeClass('deactivated');
					
					
					obj.methods.composerStickyStart();
					
					
					privateMethods.composerAutoFullScreen();
				} else {
					privateMethods.detachEvents();
					
					
					if (obj.methods.editorHTML) {
						obj.methods.editorHTML = false;
						
						
						switchEditors.go(obj.methods.editorID, 'html');
					}
					
					
					$('#postdivrich').show();
					
					$('#cmsmasters_composer_meta_box').hide();
					
					
					obj.methods.composerButton.text(obj.methods.composerButton.data('composer'));
					
					
					obj.methods.composerShow.val('false');
					
					
					obj.methods.el.addClass('deactivated').empty();
				}
			}, 
			parseContent : function (template) { 
				tinyMCE.get(obj.methods.editorID).save();
				
				
				var editorShortcodes = template ? template : switchEditors.pre_wpautop(obj.methods.content.val()), 
					newEditorShortcodes = '', 
					newContent = '', 
					newContentString = '', 
					rowsArray = [];
				
				// Set content line breaks
				newEditorShortcodes = editorShortcodes.replace(/(\[cmsmasters_row(?:\s[^\]]*)?\])\s?\[cmsmasters_column/g, "$1\n\n[cmsmasters_column").replace(/\[\/cmsmasters_column\]\s?\[\/cmsmasters_row]/g, "[/cmsmasters_column]\n\n[/cmsmasters_row]").replace(/\[\/cmsmasters_column\]\s?\[cmsmasters_column/g, "[/cmsmasters_column]\n\n[cmsmasters_column").replace(/(\[cmsmasters_column(?:\s[^\]]*)?\])\s?\[/g, "$1\n\n[").replace(/\]\s?\[\/cmsmasters_column]/g, "]\n\n[/cmsmasters_column]");
				
				// Rows split
				rowsArray = newEditorShortcodes.split(/(\[cmsmasters_row(?:\s[^\]]*)?\])([\s\S]*?)\[\/cmsmasters_row\]/g);
				
				
				for (var i = 0, ilength = rowsArray.length; i < ilength; i += 1) {
					if (/\[cmsmasters_row(?:\s.*)?\]/g.test(rowsArray[i])) {
						var rowAttrs = /\[cmsmasters_row(\s.*)?\]/g.exec(rowsArray[i]);
						
						
						i += 1;
						
						
						if (rowsArray[i] !== '') {
							newContentString = obj.methods.parseRow(rowsArray[i]);
						}
						
						
						if (newContentString === '') {
							newContentString = '<div class="cmsmasters_column"></div>';
						}
						
						
						newContent += '<div class="cmsmasters_row' + (template ? ' hideEl' : '') + '"' + ((rowAttrs[1] !== undefined) ? rowAttrs[1].replace(/\sdata_([^=]+)=/g, " data-$1=") : '') + '>' + newContentString + '</div>';
					} else if (rowsArray[i] !== '') {
						newContentString = obj.methods.parseRow(rowsArray[i]);
						
						
						if (newContentString !== '') {
							newContent += '<div class="cmsmasters_row' + (template ? ' hideEl' : '') + '">' + newContentString + '</div>';
						}
					}
				}
				
				
				if (!template) {
					obj.methods.el.empty();
					
					
					obj.methods.el.append(newContent);
				} else {
					if (obj.methods.composerBegin.is(':checked')) {
						obj.methods.el.prepend(newContent);
					} else {
						obj.methods.el.append(newContent);
					}
				}
				
				
				privateMethods.setColumnsWidth();
			}, 
			parseRow : function (row) { 
				var newColumn = '', 
					newColumnArray = [], 
					colOpen = /<div class="cmsmasters_column"\s?.*>/g, 
					newContentString = '';
				
				// Columns shortcodes to HTML conversion
				newColumn = row.replace(/[\s\S]*?\[cmsmasters_column(\s.*)?\]([\s\S]*?)\[\/cmsmasters_column\][\s\S]*?/g, '<div class="cmsmasters_column"$1>$2[/cmsmasters_column]').replace(/<div class="cmsmasters_column"(\s.*)?>([\s\S]*(?!<\/div class="cmsmasters_column"(\s.*)?>))\[\/cmsmasters_column\][\s\S]*(?!<\/div class="cmsmasters_column"(\s.*)?>)/g, '<div class="cmsmasters_column"$1>$2[/cmsmasters_column]');
				
				// Columns split
				newColumnArray = newColumn.replace(/\sdata_([^=]+)=/g, " data-$1=").split(/(<div class="cmsmasters_column"\s?.*>)([\s\S]*?)(\[\/cmsmasters_column\])/g);
				
				
				for (var j = 0, jlength = newColumnArray.length; j < jlength; j += 1) {
					if ( 
						newColumnArray[j] !== '' && 
						newColumnArray[j] !== "\n\n" && 
						newColumnArray[j] !== /\s+/g 
					) {
						// If column open div
						if (colOpen.test(newColumnArray[j])) {
							newContentString += newColumnArray[j];
						// If column close tag
						} else if (/^\[\/cmsmasters_column\]/g.test(newColumnArray[j])) {
							newContentString += '</div>';
						} else {
							// If next element not column div or close div
							if (colOpen.test(newColumnArray[j - 1]) && /^\[\/cmsmasters_column\]/g.test(newColumnArray[j + 1])) {
								newContentString += obj.methods.convertShortcodes(newColumnArray[j], false);
							} else {
								newContentString += '<div class="cmsmasters_column">' + obj.methods.convertShortcodes(newColumnArray[j], false) + '</div>';
							}
						}
					}
				}
				
				
				return newContentString;
			}, 
			convertShortcodes : function (text, shcd) { 
				var newText = '', 
					newTextArray = [], 
					shcdTrigger = false, 
					tagMemory = '', 
					newInnerContent = '', 
					newInnerShortcode = '', 
					innerShCdsCount = 0, 
					reCmsmastersShCds = new RegExp("(\\[(?:\\/)?(?:" + ((shcd) ? shcd : obj.methods.cmsmastersShortcodes) + ")(?:\\s\\w+=[\"'][^\"']+[\"'])*\\])", "g"), 
					reCmsmastersPairShCds = new RegExp("\\[(" + ((shcd && cmsmastersMultipleShortcodes[shcd].pair) ? shcd : obj.methods.pairShortcodes) + ")(?:\\s\\w+=[\"'][^\"']+[\"'])*\\]", "g"), 
					reCmsmastersPairShCd = new RegExp("\\[(" + ((shcd && cmsmastersMultipleShortcodes[shcd].pair) ? shcd : obj.methods.pairShortcodes) + ")\\s?.*\\]", "g"), 
					reCmsmastersUnpairedShCd = new RegExp("(\\[(" + ((shcd && !cmsmastersMultipleShortcodes[shcd].pair) ? shcd : obj.methods.unpairedShortcodes) + ")\\s?.*\\])", "g");
				
				// Shortcodes split
				newTextArray = text.split(reCmsmastersShCds);
				
				
				if (newTextArray.length > 1) {
					for (var i = 0, ilength = newTextArray.length; i < ilength; i += 1) {
						var reCmsmastersPairShCdsTest = reCmsmastersPairShCds.test(newTextArray[i]);
						
						
						if (newTextArray[i] !== '' && newTextArray[i] !== "\n\n") {
							if (shcdTrigger === true) {
								var reTagPlus = new RegExp("\\[" + tagMemory + "(?:\\s\\w+=[\"'][^\"']+[\"'])*\\]", "g");
								
								
								if (reTagPlus.test(newTextArray[i])) {
									innerShCdsCount += 1;
									
									
									newInnerContent += newTextArray[i];
								} else if (newTextArray[i] === '[/' + tagMemory + ']' && innerShCdsCount > 0) {
									innerShCdsCount -= 1;
									
									
									newInnerContent += newTextArray[i];
								} else if (newTextArray[i] === '[/' + tagMemory + ']' && innerShCdsCount < 1) {
									var tagAttrsArray = newInnerShortcode.slice(tagMemory.length + 2, -2).split('" '), 
										tagAttrsLength = tagAttrsArray.length, 
										tagAttr = [], 
										tagAttrs = {}, 
										shcdVisual = (shcd) ? cmsmastersMultipleShortcodes[tagMemory].visual : cmsmastersShortcodes[tagMemory].visual, 
										tagContent = newInnerContent, 
										visualContent = '';
									
									
									if (tagAttrsLength > 0 && tagAttrsArray[0] !== '') {
										for (var j = 0; j < tagAttrsLength; j += 1) {
											tagAttr = tagAttrsArray[j].split('="');
											
											
											tagAttrs[tagAttr[0]] = tagAttr[1];
										}
									}
									
									
									if (typeof shcdVisual === 'string') {
										visualContent = shcdVisual.replace(/\{\{\sdata\.([^\s]+)\s\}\}/g, function (str, data) { 
											if (data === ((shcd) ? cmsmastersMultipleShortcodes[tagMemory].content : cmsmastersShortcodes[tagMemory].content)) {
												if (((shcd) ? cmsmastersMultipleShortcodes[tagMemory].fields[data].type : cmsmastersShortcodes[tagMemory].fields[data].type) === 'upload') {
													var newImgLink = tagContent.split('|');
													
													
													return ((newImgLink.length > 1) ? newImgLink[1] : newImgLink[0]);
												} else {
													if ( 
														(shcd && cmsmastersMultipleShortcodes[tagMemory].fields[data].type === 'editor') || 
														(!shcd && cmsmastersShortcodes[tagMemory].fields[data].type === 'editor') 
													) {
														return obj.methods.convertToContent(tagContent);
													} else {
														return tagContent;
													}
												}
											}
											
											
											for (var key in tagAttrs) {
												if (key === data && data !== ((shcd) ? cmsmastersMultipleShortcodes[tagMemory].content : cmsmastersShortcodes[tagMemory].content)) {
													return tagAttrs[key];
												}
											}
											
											
											return '';
										} );
									} else if (shcdVisual) {
										if (shcd) {
											visualContent = obj.methods.convertToContent(tagContent);
										} else {
											visualContent = (!cmsmastersShortcodes[tagMemory].multiple) ? obj.methods.convertToContent(tagContent) : '<span class="cmsmastersShortcodeTitle ' + cmsmastersShortcodes[tagMemory].icon + '">' + cmsmastersShortcodes[tagMemory].title + '</span>';
										}
									} else {
										visualContent = '<span class="cmsmastersShortcodeTitle ' + cmsmastersShortcodes[tagMemory].icon + '">' + cmsmastersShortcodes[tagMemory].title + '</span>';
									}
									
									
									if (shcd && cmsmastersMultipleShortcodes[tagMemory].fields[cmsmastersMultipleShortcodes[tagMemory].content].type === 'editor') {
										newInnerShortcode += obj.methods.convertToContent(newInnerContent.replace(/<p([^>]*)><br\s*\/?>\s*/g, '<p$1>').replace(/<\/p><br\s*\/?>\s*/g, '</p>')).replace(/<p([^>]*)>\s*/g, '<p$1>').replace(/\s*<p[^>]*><br\s?\/?><\/p>/g, '') + newTextArray[i];
									} else if (!shcd && cmsmastersShortcodes[tagMemory].fields[cmsmastersShortcodes[tagMemory].content].type === 'editor') {
										newInnerShortcode += obj.methods.convertToContent(newInnerContent.replace(/<p([^>]*)><br\s*\/?>\s*/g, '<p$1>').replace(/<\/p><br\s*\/?>\s*/g, '</p>')).replace(/<p([^>]*)>\s*/g, '<p$1>').replace(/\s*<p[^>]*><br\s?\/?><\/p>/g, '') + newTextArray[i];
									} else if (!shcd && cmsmastersShortcodes[tagMemory].fields[cmsmastersShortcodes[tagMemory].content].type === 'multiple') {
										var shortTagRegExp1 = new RegExp("<p[^>]*>(\\[" + tagMemory.slice(0, -1) + "(?:\\s\\w+=[\"'][^\"']+[\"'])*\\])", "g"), 
											shortTagRegExp2 = new RegExp("(\\[" + tagMemory.slice(0, -1) + "(?:\\s\\w+=[\"'][^\"']+[\"'])*\\])<\\/p>", "g"), 
											shortTagRegExp3 = new RegExp("<p[^>]*>(\\[\\/" + tagMemory.slice(0, -1) + "\\])", "g"), 
											shortTagRegExp4 = new RegExp("(\\[\\/" + tagMemory.slice(0, -1) + "\\])<\\/p>\\s*", "g");
										
										
										newInnerShortcode += obj.methods.convertToContent(newInnerContent.replace(/<p([^>]*)><br\s*\/?>\s*/g, '<p$1>').replace(/<\/p><br\s*\/?>\s*/g, '</p>')).replace(/<p([^>]*)>\s*/g, '<p$1>').replace(/\s*<p[^>]*><br\s?\/?><\/p>/g, '').replace(shortTagRegExp1, '$1').replace(shortTagRegExp2, '$1').replace(shortTagRegExp3, '$1').replace(shortTagRegExp4, '$1') + newTextArray[i];
									} else {
										newInnerShortcode += newInnerContent + newTextArray[i];
									}
									
									
									newText += visualContent + '</div>' + 
										'<div class="innerCode">' + newInnerShortcode + '</div>' + 
									'</div>';
									
									
									newInnerContent = '';
									
									newInnerShortcode = '';
									
									
									shcdTrigger = false;
								} else {
									newInnerContent += newTextArray[i];
								}
							} else if (newTextArray[i].slice(0, 1) === '[') {
								if (reCmsmastersPairShCdsTest) {
									shcdTrigger = true;
									
									
									newInnerShortcode += newTextArray[i];
									
									
									tagMemory = newTextArray[i].replace(reCmsmastersPairShCd, '$1');
									
									
									newText += newTextArray[i].replace(reCmsmastersPairShCd, '<div class="$1">' + 
										'<div class="innerContent">');
								} else {
									newText += newTextArray[i].replace(reCmsmastersUnpairedShCd, function (str, re1, re2) { 
										return '<div class="' + re2 + '">' + 
											'<div class="innerContent"><span class="cmsmastersShortcodeTitle' + ((shcd) ? '' : ' ' + cmsmastersShortcodes[re2].icon) + '">' + ((shcd) ? cmsmastersMultipleShortcodes[re2].title : cmsmastersShortcodes[re2].title) + '</span></div>' + 
											'<div class="innerCode">' + obj.methods.convertToContent(re1) + '</div>' + 
										'</div>';
									} );
								}
							} else {
								newText += '<div class="cmsmasters_text">' + 
									'<div class="innerContent">' + obj.methods.convertToContent(newTextArray[i]) + '</div>' + 
									'<div class="innerCode">[cmsmasters_text]' + obj.methods.convertToContent(newTextArray[i]) + '[/cmsmasters_text]</div>' + 
								'</div>';
							}
						}
					}
				} else {
					newText = '<div class="cmsmasters_text">' + 
						'<div class="innerContent">' + obj.methods.convertToContent(newTextArray[0]) + '</div>' + 
						'<div class="innerCode">[cmsmasters_text]' + obj.methods.convertToContent(newTextArray[0]) + '[/cmsmasters_text]</div>' + 
					'</div>';
				}
				
				
				return newText;
			}, 
			resetBlocks : function () { 
				obj.methods.rows = obj.methods.el.find('> div.cmsmasters_row');
				
				obj.methods.cols = (obj.methods.rows.find('> div.innerRow').length > 0) ? obj.methods.rows.find('> div.innerRow > div.cmsmasters_column') : obj.methods.rows.find('> div.cmsmasters_column');
				
				obj.methods.shcds = (obj.methods.cols.find('> div.innerColumn').length > 0) ? obj.methods.cols.find('> div.innerColumn > div') : obj.methods.cols.find('> div');
			}, 
			appendControls : function () { 
				obj.methods.resetBlocks();
				
				
				obj.methods.rows.each(function () { 
					obj.methods.appendRowControl($(this));
				} );
				
				
				obj.methods.cols.each(function () { 
					obj.methods.appendColumnControl($(this));
				} );
				
				
				obj.methods.shcds.each(function () { 
					obj.methods.appendShCdControl($(this));
				} );
			}, 
			appendRowControl : function (el) { 
				var cols = el.find('> div'), 
					colsCount = cols.length, 
					colsLayout = '';
				
				
				for (var i = 0; i < colsCount; i += 1) {
					colsLayout += cols.eq(i).data('width') + '+';
				}
				
				
				colsLayout = colsLayout.slice(0, -1);
				
				
				el.wrapInner('<div class="innerRow"></div>').prepend('<div class="innerHead">' + 
					'<span>' + cmsmastersRow.title + '</span>' + 
					'<a href="#" class="cmsmastersDelBut admin-icon-remove" title="' + cmsmasters_composer.remove_section + '"></a>' + 
					'<a href="#" class="cmsmastersCopyBut admin-icon-copy" title="' + cmsmasters_composer.clone_section + '"></a>' + 
					'<a href="#" class="cmsmastersEditBut admin-icon-edit" title="' + cmsmasters_composer.edit_section + '"></a>' + 
					'<ul class="cmsmastersColumnButs">' + 
						'<li' + ((colsLayout === '1/1') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-11" data-width="1/1" title="1/1"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '1/2+1/2') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-1212" data-width="1/2+1/2" title="1/2 + 1/2"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '1/3+2/3') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-1323" data-width="1/3+2/3" title="1/3 + 2/3"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '2/3+1/3') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-2313" data-width="2/3+1/3" title="2/3 + 1/3"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '1/4+3/4') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-1434" data-width="1/4+3/4" title="1/4 + 3/4"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '3/4+1/4') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-3414" data-width="3/4+1/4" title="3/4 + 1/4"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '1/3+1/3+1/3') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-131313" data-width="1/3+1/3+1/3" title="1/3 + 1/3 + 1/3"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '1/2+1/4+1/4') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-121414" data-width="1/2+1/4+1/4" title="1/2 + 1/4 + 1/4"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '1/4+1/2+1/4') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-141214" data-width="1/4+1/2+1/4" title="1/4 + 1/2 + 1/4"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '1/4+1/4+1/2') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-141412" data-width="1/4+1/4+1/2" title="1/4 + 1/4 + 1/2"></a>' + 
						'</li>' + 
						'<li' + ((colsLayout === '1/4+1/4+1/4+1/4') ? ' class="current"' : '') + '>' + 
							'<a href="#" class="admin-icon-column-14141414" data-width="1/4+1/4+1/4+1/4" title="1/4 + 1/4 + 1/4 + 1/4"></a>' + 
						'</li>' + 
					'</ul>' + 
				'</div>');
			}, 
			appendColumnControl : function (el) { 
				el.wrapInner('<div class="innerColumn"></div>').prepend('<div class="innerHead">' + 
					'<span>' + privateMethods.convertClass(el) + '</span>' + 
					'<a href="#" class="cmsmastersAddBut admin-icon-add" title="' + cmsmasters_composer.add_shortcode + '"></a>' + 
					'<a href="#" class="cmsmastersEditBut admin-icon-edit" title="' + cmsmasters_composer.edit_column + '"></a>' + 
				'</div>').find('.innerColumn').append('<a href="#" class="cmsmastersAddBut admin-icon-add" title="' + cmsmasters_composer.add_shortcode + '"></a>');
			}, 
			appendShCdControl : function (el) { 
				el.wrapInner('<div class="innerShortcode"></div>').prepend('<div class="innerHead">' + 
					'<a href="#" class="cmsmastersDelBut admin-icon-remove" title="' + cmsmasters_composer.remove_shortcode + '"></a>' + 
					'<a href="#" class="cmsmastersCopyBut admin-icon-copy" title="' + cmsmasters_composer.clone_shortcode + '"></a>' + 
					'<a href="#" class="cmsmastersEditBut admin-icon-edit" title="' + cmsmasters_composer.edit_shortcode + '"></a>' + 
				'</div>').append('<a href="#" class="cmsmastersEditShortcodeBut admin-icon-edit"></a>');
			}, 
			startObj : function () { 
				obj.methods.resetBlocks();
				
				
				obj.methods.el.selectable( { 
					filter : '> div.cmsmasters_row', 
					cancel : 'a, .innerHead, .cmsmasters_text, .cmsmasters_icon_box, .ui-sortable-helper, .ui-sortable-placeholder', 
					selecting : function () { 
						obj.methods.butTemp.find('.cmsmasters_pattern_save').css( { 
							display : 'block',
							opacity : 1, 
							visibility : 'visible' 
						} );
					}, 
					stop : function () { 
						var selectedList = obj.methods.el.find('> div.cmsmasters_row.ui-selected');
						
						
						if (selectedList.length < 1) {
							obj.methods.butTemp.find('.cmsmasters_pattern_save').css( { 
								display : 'block',
								opacity : 0, 
								visibility : 'hidden' 
							} );
						}
					} 
				} );
				
				
				obj.methods.el.droppable( { 
					accept : 'a[data-shortcode]', 
					greedy : true, 
					tolerance : 'fit', 
					hoverClass : 'cmsmastersComposerHover', 
					deactivate : function (event, ui) { 
						$(event.target).removeClass('cmsmastersComposerHover');
					}, 
					drop : function (event, ui) { 
						if (!ui.draggable.hasClass('iris-square-value')) {
							if (event.originalEvent.type === 'mouseup') {
								if (ui.draggable.hasClass('cmsmasters_row')) {
									var rowAttrs = '',
										columnAttrs = '';
									
									
									for (var k in cmsmastersRow.fields) {
										if (cmsmastersRow.fields[k].def !== '') {
											rowAttrs += ' data-' + k + '="' + cmsmastersRow.fields[k].def + '"';
										} else if (k === 'shortcode_id') {
											rowAttrs += ' data-' + k + '="' + privateMethods.getUniqID() + '"';
										}
									}
									
									
									for (var k in cmsmastersColumn.fields) {
										if (cmsmastersColumn.fields[k].def !== '') {
											columnAttrs += ' data-' + k + '="' + cmsmastersColumn.fields[k].def + '"';
										} else if (k === 'shortcode_id') {
											columnAttrs += ' data-' + k + '="' + privateMethods.getUniqID() + '"';
										}
									}
									
									
									ui.draggable.html('<div class="cmsmasters_row cmsmasters_dropped hideEl"' + rowAttrs + '>' + 
										'<div class="cmsmasters_column one_first" data-width="1/1"' + columnAttrs + '></div>' + 
									'</div>');
									
									
									setTimeout(function () { 
										ui.draggable.find('.cmsmasters_column').parent().unwrap('a.' + ui.draggable.data('shortcode'));
										
										
										if (obj.methods.el.find('> .cmsmasters_dropped').length > 0) {
											obj.methods.appendRowControl(obj.methods.el.find('> .cmsmasters_dropped'));
											
											
											obj.methods.appendColumnControl(obj.methods.el.find('> .cmsmasters_dropped .cmsmasters_column'));
											
											
											obj.methods.el.find('> .cmsmasters_dropped').removeClass('cmsmasters_dropped');
											
											
											setTimeout(function () { 
												obj.methods.el.find('> .hideEl').addClass('showEl');
											
											
												setTimeout(function () { 
													obj.methods.el.find('> .hideEl').removeClass('hideEl showEl');
													
													
													setTimeout(function () { 
														obj.methods.makeRowsDroppable();
														
														
														obj.methods.updateContent(false);
													}, 150);
												}, 300);
											}, 100);
										}
									}, 100);
								} else {
									var out = '', 
										attrs = '', 
										rowAttrs = '', 
										columnAttrs = '', 
										shcdContField = cmsmastersShortcodes[ui.draggable.data('shortcode')].content, 
										shcdDef = (ui.draggable.data('pair') && shcdContField) ? cmsmastersShortcodes[ui.draggable.data('shortcode')].fields[shcdContField].def : false, 
										shcdDefNew = '';
									
									
									if (typeof cmsmastersShortcodes[ui.draggable.data('shortcode')].visual === 'string') {
										shcdDefNew = cmsmastersShortcodes[ui.draggable.data('shortcode')].visual.replace(/\{\{\sdata\.([^\s]+)\s\}\}/g, function (str, data) { 
											return cmsmastersShortcodes[ui.draggable.data('shortcode')].fields[data].def;
										} );
									}
									
									
									for (var k in cmsmastersShortcodes[ui.draggable.data('shortcode')].fields) {
										if (cmsmastersShortcodes[ui.draggable.data('shortcode')].content !== k) {
											if (cmsmastersShortcodes[ui.draggable.data('shortcode')].fields[k].def !== '') {
												attrs += ' ' + k + '="' + cmsmastersShortcodes[ui.draggable.data('shortcode')].fields[k].def + '"';
											} else if (k === 'shortcode_id') {
												attrs += ' ' + k + '="' + privateMethods.getUniqID() + '"';
											}
										}
									}
									
									
									for (var k in cmsmastersRow.fields) {
										if (cmsmastersRow.fields[k].def !== '') {
											rowAttrs += ' data-' + k + '="' + cmsmastersRow.fields[k].def + '"';
										} else if (k === 'shortcode_id') {
											rowAttrs += ' data-' + k + '="' + privateMethods.getUniqID() + '"';
										}
									}
									
									
									for (var k in cmsmastersColumn.fields) {
										if (cmsmastersColumn.fields[k].def !== '') {
											columnAttrs += ' data-' + k + '="' + cmsmastersColumn.fields[k].def + '"';
										} else if (k === 'shortcode_id') {
											columnAttrs += ' data-' + k + '="' + privateMethods.getUniqID() + '"';
										}
									}
									
									
									out += '<div class="cmsmasters_row cmsmasters_dropped hideEl"' + rowAttrs + '>' + 
										'<div class="cmsmasters_column one_first" data-width="1/1"' + columnAttrs + '>' + 
											'<div class="' + ui.draggable.data('shortcode') + '">' + 
												'<div class="innerContent">' + 
													((ui.draggable.data('pair') && typeof cmsmastersShortcodes[ui.draggable.data('shortcode')].visual === 'string') ? ((shcdDefNew !== '') ? shcdDefNew : shcdDef) : '<span class="cmsmastersShortcodeTitle ' + cmsmastersShortcodes[ui.draggable.data('shortcode')].icon + '">' + cmsmastersShortcodes[ui.draggable.data('shortcode')].title + '</span>') + 
												'</div>' + 
												'<div class="innerCode">' + 
													'[' + ui.draggable.data('shortcode') + attrs + ']' + (ui.draggable.data('pair') ? shcdDef + '[/' + ui.draggable.data('shortcode') + ']' : '') + 
												'</div>' + 
											'</div>' + 
										'</div>' + 
									'</div>';
									
									
									ui.draggable.html(out);
									
									
									setTimeout(function () { 
										ui.draggable.find('.cmsmasters_dropped').unwrap('a.cmsmasters_row');
										
										
										if (obj.methods.el.find('.cmsmasters_dropped').length > 0) {
											obj.methods.appendRowControl(obj.methods.el.find('> .cmsmasters_dropped'));
											
											obj.methods.appendColumnControl(obj.methods.el.find('> .cmsmasters_dropped .cmsmasters_column'));
											
											obj.methods.appendShCdControl(obj.methods.el.find('> .cmsmasters_dropped .cmsmasters_column > .innerColumn > div'));
											
											
											obj.methods.el.find('.cmsmasters_dropped').removeClass('cmsmasters_dropped');
											
											
											setTimeout(function () { 
												obj.methods.el.find('.hideEl').addClass('showEl');
											
											
												setTimeout(function () { 
													obj.methods.el.find('.hideEl').removeClass('hideEl showEl');
													
													
													setTimeout(function () { 
														obj.methods.makeRowsDroppable();
														
														
														obj.methods.updateContent(false);
													}, 150);
												}, 300);
											}, 100);
										}
									}, 150);
								}
							}
						}
					} 
				} );
				
				
				obj.methods.el.sortable( { 
					items : '> div', 
					handle : '> .innerHead', 
					tolerance : 'pointer', 
					axis : 'y', 
					opacity : 0.25, 
					cursor : 'move', 
					start : function (event, ui) { 
						var placeClasses = ui.item[0].className.replace(/cmsmasters_\S+/g, '').replace(/ui-\S+/g, '');
						
						
						$(ui.placeholder).addClass(placeClasses);
						
						
						$(ui.item).addClass('cmsmasters_move_add');
						
						
						$(ui.item).find('.innerShortcode').height(2);
					}, 
					stop : function (event, ui) { 
						privateMethods.moveAddButton(obj.methods.el.find('.cmsmasters_move_add').parents('.innerColumn'));
						
						
						$(ui.item).removeClass('cmsmasters_move_add').find('.innerShortcode').removeAttr('style');
					}, 
					update : function () { 
						setTimeout(function () { 
							obj.methods.updateContent(false);
						}, 150);
					} 
				} );
				
				
				obj.methods.makeRowsDroppable();
				
				
				privateMethods.attachEvents();
			}, 
			makeRowsDroppable : function () { 
				obj.methods.resetBlocks();
				
				
				obj.methods.rows.find('> .innerRow').sortable( { 
					items : '> div', 
					handle : '> .innerHead', 
					containment : 'parent', 
					tolerance : 'pointer', 
					axis : 'x', 
					opacity : 0.25, 
					cursor : 'move', 
					update : function () { 
						setTimeout(function () { 
							obj.methods.updateContent(false);
						}, 150);
					} 
				} );
				
				
				obj.methods.makeColumnsSortable();
			}, 
			makeColumnsSortable : function () { 
				obj.methods.resetBlocks();
				
				
				obj.methods.cols.find('> .innerColumn').droppable( { 
					accept : 'a[data-shortcode]:not(a.cmsmasters_row)', 
					greedy : true, 
					tolerance : 'pointer', 
					hoverClass : 'cmsmastersColumnHover', 
					deactivate : function (event, ui) { 
						$(event.target).removeClass('cmsmastersColumnHover');
					}, 
					drop : function (event, ui) { 
						if (!ui.draggable.hasClass('iris-square-value')) {
							if (event.originalEvent.type === 'mouseup') {
								var out = '', 
									attrs = '', 
									rowAttrs = '', 
									columnAttrs = '', 
									shcdContField = cmsmastersShortcodes[ui.draggable.data('shortcode')].content, 
									shcdDef = (ui.draggable.data('pair') && shcdContField) ? cmsmastersShortcodes[ui.draggable.data('shortcode')].fields[shcdContField].def : false, 
									shcdDefNew = '';
								
								
								if (typeof cmsmastersShortcodes[ui.draggable.data('shortcode')].visual === 'string') {
									shcdDefNew = cmsmastersShortcodes[ui.draggable.data('shortcode')].visual.replace(/\{\{\sdata\.([^\s]+)\s\}\}/g, function (str, data) { 
										return cmsmastersShortcodes[ui.draggable.data('shortcode')].fields[data].def;
									} );
								}
								
								
								for (var k in cmsmastersShortcodes[ui.draggable.data('shortcode')].fields) {
									if (cmsmastersShortcodes[ui.draggable.data('shortcode')].content !== k) {
										if (cmsmastersShortcodes[ui.draggable.data('shortcode')].fields[k].def !== '') {
											attrs += ' ' + k + '="' + cmsmastersShortcodes[ui.draggable.data('shortcode')].fields[k].def + '"';
										} else if (k === 'shortcode_id') {
											attrs += ' ' + k + '="' + privateMethods.getUniqID() + '"';
										}
									}
								}
								
								
								for (var k in cmsmastersRow.fields) {
									if (cmsmastersRow.fields[k].def !== '') {
										rowAttrs += ' data-' + k + '="' + cmsmastersRow.fields[k].def + '"';
									} else if (k === 'shortcode_id') {
										rowAttrs += ' data-' + k + '="' + privateMethods.getUniqID() + '"';
									}
								}
								
								
								for (var k in cmsmastersColumn.fields) {
									if (cmsmastersColumn.fields[k].def !== '') {
										columnAttrs += ' data-' + k + '="' + cmsmastersColumn.fields[k].def + '"';
									} else if (k === 'shortcode_id') {
										columnAttrs += ' data-' + k + '="' + privateMethods.getUniqID() + '"';
									}
								}
								
								
								out += '<div class="' + ui.draggable.data('shortcode') + ' cmsmasters_dropped hideEl">' + 
									'<div class="innerContent">' + 
										((ui.draggable.data('pair') && typeof cmsmastersShortcodes[ui.draggable.data('shortcode')].visual === 'string') ? ((shcdDefNew !== '') ? shcdDefNew : shcdDef) : '<span class="cmsmastersShortcodeTitle ' + cmsmastersShortcodes[ui.draggable.data('shortcode')].icon + '">' + cmsmastersShortcodes[ui.draggable.data('shortcode')].title + '</span>') + 
									'</div>' + 
									'<div class="innerCode">' + 
										'[' + ui.draggable.data('shortcode') + attrs + ']' + (ui.draggable.data('pair') ? shcdDef + '[/' + ui.draggable.data('shortcode') + ']' : '') + 
									'</div>' + 
								'</div>';
								
								
								ui.draggable.html(out);
								
								
								setTimeout(function () { 
									ui.draggable.find('.cmsmasters_dropped').unwrap('a.' + ui.draggable.data('shortcode'));
									
									
									if (obj.methods.el.find('.cmsmasters_dropped').length > 0) {
										obj.methods.appendShCdControl(obj.methods.el.find('.cmsmasters_dropped'));
										
										
										obj.methods.el.find('.cmsmasters_dropped').removeClass('cmsmasters_dropped');
										
										
										setTimeout(function () { 
											obj.methods.el.find('.hideEl').addClass('showEl');
										
										
											setTimeout(function () { 
												privateMethods.moveAddButton(obj.methods.el.find('.hideEl').parents('.innerColumn'));
												
												
												obj.methods.el.find('.hideEl').removeClass('hideEl showEl');
												
												
												setTimeout(function () { 
													obj.methods.makeColumnsSortable();
													
													
													obj.methods.updateContent(false);
												}, 150);
											}, 300);
										}, 100);
									}
								}, 150);
							} else if ($(ui.draggable[0].parentNode).is('.innerColumn')) {
								ui.draggable.remove();
							}
						}
					} 
				} );
				
				
				obj.methods.cols.find('> .innerColumn').sortable( { 
					items : '> div', 
					handle : '> .innerHead', 
					opacity : 0.25, 
					cursor : 'move', 
					connectWith : '.innerColumn', 
					cursorAt : { 
						left : 75 
					}, 
					start : function (event, ui) { 
						var placeClasses = ui.item[0].className.replace(/cmsmasters_\S+/g, '').replace(/ui-\S+/g, '');
						
						
						$(ui.placeholder).addClass(placeClasses);
						
						
						$(ui.item).width(300).addClass('cmsmasters_move_add');
						
						
						$(ui.item).find('.innerShortcode').height(2);
					}, 
					stop : function (event, ui) { 
						privateMethods.moveAddButton(obj.methods.el.find('.cmsmasters_move_add').parents('.innerColumn'));
						
						
						$(ui.item).removeClass('cmsmasters_move_add').find('.innerShortcode').removeAttr('style');
					}, 
					update : function () { 
						setTimeout(function () { 
							obj.methods.updateContent(false);
						}, 150);
					} 
				} );
			}, 
			buildButtons : function () { 
				if (obj.methods.butElems.find('> ul').length < 1) {
					var out = '<ul>' + 
						'<li>' + 
							'<a href="#" class="cmsmasters_row ' + cmsmastersRow.icon + '" data-shortcode="cmsmasters_row" title="' + cmsmastersRow.button + '">' + 
								'<span>' + cmsmastersRow.button + '</span>' + 
							'</a>' + 
						'</li>';
					
					
					for (var key in cmsmastersShortcodes) {
						out += '<li>' + 
							'<a href="#" class="' + key + ' ' + cmsmastersShortcodes[key].icon + '" title="' + cmsmastersShortcodes[key].title + '" data-shortcode="' + key + '" data-pair="' + ((cmsmastersShortcodes[key].pair) ? true : false) + '" data-multiple="' + ((cmsmastersShortcodes[key].multiple) ? true : false) + '">' + 
								'<span>' + cmsmastersShortcodes[key].title + '</span>' + 
							'</a>' + 
						'</li>';
					}
					
					
					out += '</ul>';
					
					
					obj.methods.butElems.append(out);
					
					
					setTimeout(function () { 
						obj.methods.button_row = obj.methods.butElems.find('a.cmsmasters_row');
						
						
						obj.methods.buttons = obj.methods.butElems.find('a:not(.cmsmasters_row)');
						
						
						obj.methods.button_row.draggable( { 
							helper : 'clone', 
							delay : 150, 
							stack : obj.methods.butElems.find('> ul > li'), 
							zIndex : 100, 
							opacity : 0.75, 
							cursor : 'move', 
							revert : 'invalid', 
							connectToSortable : '#' + obj.methods.el.attr('id'), 
							cursorAt : { 
								top : 12, 
								left : 75 
							}, 
							start : function (event, ui) {
								$(ui.helper).attr('class', 'cmsmasters_row').css( { 
									border : 0, 
									background : 'none', 
									fontSize : 13, 
									textAlign : 'left', 
									width : 300, 
									height: 75, 
									padding : '25px 0 0' 
								} ).addClass('ui-front').wrapInner('<div class="cmsmasters_row"></div>').empty().append('<div class="innerRow"></div>').find('.innerRow').height(63).append('<span class="cmsmastersShortcodeTitle admin-icon-row"></span>').parent().prepend('<div class="innerHead">' + 
									'<span>' + cmsmastersRow.title + '</span>' + 
								'</div>');
							} 
						} );
						
						
						obj.methods.resetBlocks();
						
						
						obj.methods.buttons.draggable( { 
							helper : 'clone', 
							delay : 150, 
							stack : obj.methods.butElems.find('> ul > li'), 
							opacity : 0.75, 
							cursor : 'move',
							revert : 'invalid', 
							connectToSortable : '#' + obj.methods.el.attr('id') + ', #' + obj.methods.el.attr('id') + ' > .cmsmasters_row .cmsmasters_column > .innerColumn', 
							cursorAt : { 
								top : 12, 
								left : 75 
							}, 
							start : function (event, ui) { 
								$(ui.helper).attr('class', ui.helper.data('shortcode')).css( { 
									border : 0, 
									background : 'none', 
									display : 'block', 
									fontSize : 13, 
									textAlign : 'left', 
									width : 300, 
									height : 90, 
									padding : '25px 0 0' 
								} ).addClass('ui-front').wrapInner('<div class="' + ui.helper.data('shortcode') + '"></div>').empty().append('<div class="innerHead"></div>').append('<div class="innerShortcode"></div>').parent().find('.innerShortcode').append('<div class="innerContent">' + 
									'<span class="cmsmastersShortcodeTitle ' + cmsmastersShortcodes[ui.helper.data('shortcode')].icon + '">' + cmsmastersShortcodes[ui.helper.data('shortcode')].title + '</span>' + 
								'</div>');
							} 
						} );
					}, 100);
				}
			}, 
			updateContent : function (selected) { 
				obj.methods.resetBlocks();
				
				
				var newPostContent = '', 
					newRows = selected ? obj.methods.rows.filter('.ui-selected') : obj.methods.rows, 
					row = undefined, 
					rowData = {}, 
					columns = [], 
					column = undefined, 
					columnData = {}, 
					shortcodes = [], 
					shortcode = undefined;
				
				
				for (var i = 0, ilength = newRows.length; i < ilength; i += 1) {
					row = newRows.eq(i);
					
					rowData = row.data();
					
					
					columns = row.find('.cmsmasters_column');
					
					
					newPostContent += '[cmsmasters_row';
					
					
					for (var key in rowData) {
						if (typeof rowData[key] !== 'object') {
							newPostContent += ' data_' + key + '="' + rowData[key] + '"';
						}
					}
					
					
					newPostContent += ']' + '';
					
					
					for (var j = 0, jlength = columns.length; j < jlength; j += 1) {
						column = columns.eq(j);
						
						columnData = column.data();
						
						
						shortcodes = column.find('> .innerColumn > div');
						
						
						newPostContent += '[cmsmasters_column';
						
						
						for (var k in columnData) {
							if (typeof columnData[k] !== 'object') {
								newPostContent += ' data_' + k + '="' + columnData[k] + '"';
							}
						}
						
						
						newPostContent += ']' + '';
						
						
						for (var h = 0, hlength = shortcodes.length; h < hlength; h += 1) {
							shortcode = shortcodes.eq(h);
							
							
							newPostContent += shortcode.find('.innerShortcode > .innerCode').html() + '';
						}
						
						
						newPostContent += '[/cmsmasters_column]' + '';
					}
					
					
					newPostContent += '[/cmsmasters_row]' + '';
				}
				
				
				if (!selected) {
					setTimeout(function () { 
						tinyMCE.setActive(tinyMCE.get('content'));
						
						
						tinyMCE.activeEditor.setContent(newPostContent);
					}, 100);
				} else {
					return newPostContent;
				}
			}, 
			addShortcode : function (shcd, col, prepend) { 
				var out = '', 
					rowAttrs = '',
					columnAttrs = '';
				
				
				for (var k in cmsmastersRow.fields) {
					if (cmsmastersRow.fields[k].def !== '') {
						rowAttrs += ' data-' + k + '="' + cmsmastersRow.fields[k].def + '"';
					}
				}
				
				
				for (var k in cmsmastersColumn.fields) {
					if (cmsmastersColumn.fields[k].def !== '') {
						columnAttrs += ' data-' + k + '="' + cmsmastersColumn.fields[k].def + '"';
					}
				}
				
				
				rowAttrs += ' data-shortcode_id="' + privateMethods.getUniqID() + '"';
				
				columnAttrs += ' data-shortcode_id="' + privateMethods.getUniqID() + '"';
				
				
				if (shcd === 'cmsmasters_row') {
					out = '<div class="cmsmasters_row hideEl"' + rowAttrs + '>' + 
						'<div class="cmsmasters_column one_first" data-width="1/1"' + columnAttrs + '></div>' + 
					'</div>';
				} else {
					var attrs = '', 
						shcdDefVisual = '', 
						shcdContField = cmsmastersShortcodes[shcd].content, 
						shcdDef = (cmsmastersShortcodes[shcd].fields && shcdContField) ? cmsmastersShortcodes[shcd].fields[shcdContField].def : false;
					
					
					if (typeof cmsmastersShortcodes[shcd].visual === 'string') {
						shcdDefVisual = cmsmastersShortcodes[shcd].visual.replace(/\{\{\sdata\.([^\s]+)\s\}\}/g, function (str, data) { 
							return cmsmastersShortcodes[shcd].fields[data].def;
						} );
					}
					
					
					for (var k in cmsmastersShortcodes[shcd].fields) {
						if ( 
							cmsmastersShortcodes[shcd].content !== k && 
							cmsmastersShortcodes[shcd].fields[k].def !== ''
						) {
							attrs += ' ' + k + '="' + cmsmastersShortcodes[shcd].fields[k].def + '"';
						}
					}
					
					
					attrs += ' shortcode_id="' + privateMethods.getUniqID() + '"';
					
					
					if (!col) {
						out = '<div class="cmsmasters_row hideEl"' + rowAttrs + '>' + 
							'<div class="cmsmasters_column one_first" data-width="1/1"' + columnAttrs + '>' + 
								'<div class="' + shcd + '">' + 
									'<div class="innerContent">' + 
										((cmsmastersShortcodes[shcd].pair && typeof cmsmastersShortcodes[shcd].visual === 'string') ? ((shcdDefVisual !== '') ? shcdDefVisual : shcdDef) : '<span class="cmsmastersShortcodeTitle ' + cmsmastersShortcodes[shcd].icon + '">' + cmsmastersShortcodes[shcd].title + '</span>') + 
									'</div>' + 
									'<div class="innerCode">' + 
										'[' + shcd + attrs + ']' + (cmsmastersShortcodes[shcd].pair ? shcdDef + '[/' + shcd + ']' : '') + 
									'</div>' + 
								'</div>' + 
							'</div>' + 
						'</div>';
					} else {
						out = '<div class="' + shcd + ' hideEl">' + 
							'<div class="innerContent">' + 
								((cmsmastersShortcodes[shcd].pair && typeof cmsmastersShortcodes[shcd].visual === 'string') ? ((shcdDefVisual !== '') ? shcdDefVisual : shcdDef) : '<span class="cmsmastersShortcodeTitle ' + cmsmastersShortcodes[shcd].icon + '">' + cmsmastersShortcodes[shcd].title + '</span>') + 
							'</div>' + 
							'<div class="innerCode">' + 
								'[' + shcd + attrs + ']' + (cmsmastersShortcodes[shcd].pair ? shcdDef + '[/' + shcd + ']' : '') + 
							'</div>' + 
						'</div>';
					}
				}
				
				if (!col) {
					if (obj.methods.composerBegin.is(':checked')) {
						obj.methods.el.prepend(out);
					} else {
						obj.methods.el.append(out);
					}
				} else {
					if (prepend) {
						obj.methods.el.find('> div.cmsmasters_row:eq(' + col[1] + ') > div.innerRow > div.cmsmasters_column:eq(' + col[0] + ') > div.innerColumn').prepend(out);
					} else {
						$(out).insertBefore(obj.methods.el.find('> div.cmsmasters_row:eq(' + col[1] + ') > div.innerRow > div.cmsmasters_column:eq(' + col[0] + ') > div.innerColumn > a.cmsmastersAddBut'));
					}
				}
				
				
				setTimeout(function () { 
					if (!col) {
						obj.methods.appendRowControl(obj.methods.el.find('> div.cmsmasters_row.hideEl'));
						
						obj.methods.appendColumnControl(obj.methods.el.find('> div.cmsmasters_row.hideEl > div.innerRow > div.cmsmasters_column'));
						
						obj.methods.appendShCdControl(obj.methods.el.find('> div.cmsmasters_row.hideEl > div.innerRow > div.cmsmasters_column > div.innerColumn > div'));
					} else {
						obj.methods.appendShCdControl(obj.methods.el.find('> div.cmsmasters_row:eq(' + col[1] + ') > div.innerRow > div.cmsmasters_column:eq(' + col[0] + ') > div.innerColumn > div.hideEl'));
					}
					
					
					setTimeout(function () { 
						obj.methods.el.find('.hideEl').addClass('showEl');
					
					
						setTimeout(function () { 
							obj.methods.el.find('.hideEl').removeClass('hideEl showEl');
							
							
							setTimeout(function () { 
								if (!col) {
									obj.methods.makeRowsDroppable();
								}
								
								
								obj.methods.updateContent(false);
							}, 150);
						}, 300);
					}, 100);
				}, 100);
			}, 
			openShortcodesLightbox : function (el) { 
				var col = el.parents('.cmsmasters_column'), 
					elObj = { 
						index : 	col.index() + '|' + col.parents('.cmsmasters_row').index(), 
						prepend : 	(el.parent().is('.innerHead') ? true : false), 
						editor : 	false 
					};
				
				
				cmsmastersComposerLightbox.methods.openShortcodes(elObj);
			}, 
			changeLayout : function (el) { 
				var row = el.parents('.cmsmasters_row'), 
					innerRow = row.find('> .innerRow'), 
					columns = innerRow.find('> .cmsmasters_column'), 
					colCount = columns.length, 
					rWidthArray = el.data('width').split('+'), 
					rWidthArrayLength = rWidthArray.length, 
					extraCols = '', 
					extraContent = '', 
					extraShortcodes = '';
				
				
				el.parents('.cmsmastersColumnButs').find('> li').removeClass('current');
				
				
				el.parent().addClass('current');
				
				
				for (var i = 0; i < colCount; i += 1) {
					if (rWidthArray[i] !== undefined) {
						columns.eq(i).data('width', rWidthArray[i]).attr('class', 'cmsmasters_column ' + privateMethods.converWidth(rWidthArray[i])).find('> .innerHead > span').text(rWidthArray[i]);
					} else {
						extraContent += columns.eq(i).find('> .innerColumn').html();
						
						
						columns.eq(i).remove();
					}
				}
				
				
				if (colCount < rWidthArrayLength) {
					for (var j = 0, jlength = rWidthArrayLength - colCount; j < jlength; j += 1) {
						extraCols += '<div class="cmsmasters_column ' + privateMethods.converWidth(rWidthArray[colCount + j]) + '" data-width="' + rWidthArray[colCount + j] + '" data-shortcode_id="' + privateMethods.getUniqID() + '">' + 
							'<div class="innerHead">' + 
								'<span>' + rWidthArray[colCount + j] + '</span>' + 
								'<a href="#" class="cmsmastersAddBut admin-icon-add" title="' + cmsmasters_composer.add_shortcode + '"></a>' + 
								'<a href="#" class="cmsmastersEditBut admin-icon-edit" title="' + cmsmasters_composer.edit_column + '"></a>' + 
							'</div>' + 
							'<div class="innerColumn">' + 
								'<a href="#" class="cmsmastersAddBut admin-icon-add" title="' + cmsmasters_composer.add_shortcode + '"></a>' + 
							'</div>' + 
							'<div class="innerCode"></div>' + 
						'</div>';
					}
					
					
					innerRow.append(extraCols);
					
					
					obj.methods.makeColumnsSortable();
				} else if (colCount > rWidthArrayLength) {
					$(extraContent).each(function () { 
						if ($(this).is('a.cmsmastersAddBut')) {
							$(this).remove();
						} else {
							extraShortcodes += $(this)[0].outerHTML;
						}
					} );
					
					
					columns.eq(rWidthArrayLength - 1).find('> .innerColumn').append(extraShortcodes);
				}
				
				
				obj.methods.updateContent(false);
			}, 
			editElement : function (el) { 
				var elObj = {};
				
				
				if (el.hasClass('cmsmasters_row')) {
					elObj = { 
						type : 		'cmsmasters_row', 
						index : 	el.index() + '', 
						content : 	el.data() 
					};
				} else if (el.hasClass('cmsmasters_column')) {
					elObj = { 
						type : 		'cmsmasters_column', 
						index : 	el.index() + '|' + el.parents('.cmsmasters_row').index(), 
						content : 	el.data() 
					};
				} else {
					elObj = { 
						type : 		el.attr('class'), 
						index : 	el.index() + '|' + el.parents('.cmsmasters_column').index() + '|' + el.parents('.cmsmasters_row').index(), 
						content : 	el.find('.innerCode').html() 
					};
				}
				
				
				cmsmastersComposerLightbox.methods.openLightbox(elObj);
			}, 
			copyElement : function (el) { 
				var elClone = el.clone().addClass('hideEl');
				
				
				if (elClone.hasClass('cmsmasters_row')) {
					elClone.attr('data-shortcode_id', privateMethods.getUniqID());
					
					elClone.find('.cmsmasters_column').each(function () {
						$(this).attr('data-shortcode_id', privateMethods.getUniqID());
					} );
				}
				
				
				elClone.find('.innerCode').each(function () {
					var newID = $(this).html().replace(/shortcode_id=["'][^"']+["']/g, function() {
						return 'shortcode_id="' + privateMethods.getUniqID() + '"';
					} );
					
					
					$(this).html(newID);
				} );
				
				
				el.after(elClone);
				
				
				setTimeout(function () { 
					var elNew = el.next();
					
					
					elNew.addClass('showEl');
					
					
					setTimeout(function () { 
						elNew.removeClass('hideEl showEl');
						
						
						setTimeout(function () { 
							if (el.hasClass('cmsmasters_row')) {
								obj.methods.makeRowsDroppable();
							}
							
							
							obj.methods.updateContent(false);
						}, 100);
					}, 300);
				}, 100);
			}, 
			deleteElement : function (el) { 
				if (obj.methods.composerConfirm.is(':checked') || confirm(cmsmasters_composer.delete_el)) {
					el.addClass('hideEl');
					
					
					setTimeout(function () { 
						el.remove();
						
						
						setTimeout(function () { 
							obj.methods.updateContent(false);
						}, 150);
					}, 300);
				}
			}, 
			composerStartFullScreen : function (el) { 
				if (el.hasClass('admin-icon-fullscreen')) {
					el.addClass('admin-icon-fullscreen-exit').removeClass('admin-icon-fullscreen');
					
					
					obj.methods.body.addClass('cmsmasters_set_fullscreen');
					
					
					obj.methods.composerFullScreen.val('true');
					
					
					obj.methods.el.css('margin-top', obj.methods.butCont.outerHeight() - 28);
					
					obj.methods.butCont.css('width', obj.methods.el.outerWidth() + 16);
					
					obj.methods.composerStickyTrigger(false);
				} else {
					el.addClass('admin-icon-fullscreen').removeClass('admin-icon-fullscreen-exit');
					
					
					obj.methods.el.removeAttr('style');
					
					
					obj.methods.butCont.removeAttr('style');
					
					
					obj.methods.composerFullScreen.val('false');
					
					
					obj.methods.body.removeClass('cmsmasters_set_fullscreen');
					
					
					obj.methods.composerStickyTrigger(true);
				}
			}, 
			composerStickyStart : function () { 
				obj.methods.butCont.stick_in_parent( {
					offset_top : 	(($('#wpadminbar').css('position') === 'fixed') ? $('#wpadminbar').height() : 0) 
				} ).on("sticky_kit:bottom", function (el) {
					$(el.target).css('bottom', '300px');
				} );
			}, 
			composerStickyTrigger : function (trigger) { 
				if (trigger) {
					setTimeout(function () {
						obj.methods.composerStickyStart();
					}, 300);
				} else {
					obj.methods.butCont.trigger("sticky_kit:detach");
				}
			}, 
			convertToContent : function (text) { 
				return switchEditors.wpautop(text);
			} 
		};
		
		// Private Methods
		privateMethods = { 
			attachStaticEvents : function () { 
				// Declare CONTENT COMPOSER Button Click Event
				obj.methods.composerButton.bind('click', function () { 
					obj.methods.composerToggle();
					
					
					return false;
				} );
				
				
				// Declare 'Back to Block Editor' Button Click Event
				obj.methods.toGutenbergButton.bind('click', function () { 
					obj.methods.gutenbergShow.val('false');
					
					obj.methods.publish.trigger('click');
					
					
					return false;
				} );
				
				
				// Declare TEMPLATES Button Click Event
				obj.methods.butTemp.on('click', '.cmsmasters_pattern_list_button', function () { 
					return false;
				} );
				
				
				// Declare SAVE TEMPLATE Button Click Event
				obj.methods.butTemp.on('click', '.cmsmasters_pattern_save, .cmsmasters_pattern_save_all', function () { 
					var button = $(this), 
						saveBut = obj.methods.butTemp.find('.cmsmasters_pattern_save'), 
						selectedList = obj.methods.el.find('> div.cmsmasters_row.ui-selected'), 
						newContent = switchEditors.pre_wpautop(obj.methods.content.val()), 
						newName = prompt(cmsmasters_composer.new_tmpl_name);
					
					
					if (button.is('.cmsmasters_pattern_save') && selectedList.length > 0) {
						newContent = switchEditors.pre_wpautop(obj.methods.updateContent(true));
					} else {
						selectedList.removeClass('ui-selected');
						
						
						saveBut.css( { 
							display : 'none', 
							opacity : 0, 
							visibility : 'hidden' 
						} );
					}
					
					
					if (newName.length > 2) {
						$.ajax( { 
							type : 				'POST',
							url : 				ajaxurl,
							data : { 
								action : 		'cmsmasters_ajax_template_operator',
								type : 			'add', 
								name : newName, 
								content : newContent,
								nonce : 		cmsmasters_composer.nonce_ajax_template_operator 
							},
							dataType : 			'text'
						} ).done(function (data) { 
							obj.methods.templates.append(data);
							
							
							if (button.is('.cmsmasters_pattern_save') && selectedList.length > 0) {
								selectedList.removeClass('ui-selected');
								
								
								saveBut.css( { 
									display : 'none', 
									opacity : 0, 
									visibility : 'hidden' 
								} );
								
								
								obj.methods.messageSave.fadeIn(100).delay(1000).fadeOut(100);
							} else {
								obj.methods.messageSaveAll.fadeIn(100).delay(1000).fadeOut(100);
							}
						} ).fail(function () { 
							alert(cmsmasters_composer.error_on_page);
						} );
					} else {
						alert(cmsmasters_composer.invalid_tmpl_name);
					}
					
					
					return false;
				} );
				
				
				// Declare LOAD TEMPLATE Button Click Event
				obj.methods.butTemp.on('click', '.cmsmasters_pattern_paste', function () { 
					if ($(this).data('id') !== '') {
						$.ajax( { 
							type : 				'POST',
							url : 				ajaxurl,
							data : { 
								action : 		'cmsmasters_ajax_template_operator',
								type : 			'load', 
								id : 			$(this).data('id'),
								nonce : 		cmsmasters_composer.nonce_ajax_template_operator 
							},
							dataType : 			'text'
						} ).done(function (data) { 
							obj.methods.parseContent(data);
							
							
							obj.methods.el.find('> div.cmsmasters_row.hideEl').each(function () { 
								obj.methods.appendRowControl($(this));
							} );
							
							
							obj.methods.el.find('> div.cmsmasters_row.hideEl > .innerRow > .cmsmasters_column').each(function () { 
								obj.methods.appendColumnControl($(this));
							} );
							
							
							obj.methods.el.find('> div.cmsmasters_row.hideEl > .innerRow > .cmsmasters_column > .innerColumn > div').each(function () { 
								obj.methods.appendShCdControl($(this));
							} );
							
							
							setTimeout(function () { 
								var elNew = obj.methods.el.find('> div.cmsmasters_row.hideEl');
								
								
								elNew.each(function () {
									$(this).attr('data-shortcode_id', privateMethods.getUniqID());
									
									
									$(this).find('.innerCode').each(function () { 
										var newID = $(this).html().replace(/shortcode_id=["'][^"']+["']/g, 'shortcode_id="' + privateMethods.getUniqID() + '"');
										
										
										$(this).html(newID);
									} );
								} );
								
								
								elNew.addClass('showEl');
								
								
								setTimeout(function () { 
									elNew.removeClass('hideEl showEl');
									
									
									setTimeout(function () { 
										obj.methods.makeRowsDroppable();
										
										
										obj.methods.updateContent(false);
										
										
										obj.methods.messageLoad.fadeIn(100).delay(1000).fadeOut(100);
									}, 100);
								}, 300);
							}, 100);
						} ).fail(function () { 
							alert(cmsmasters_composer.error_on_page);
						} );
					} else {
						alert(cmsmasters_composer.error_on_page);
					}
					
					
					return false;
				} );
				
				
				// Declare DELETE TEMPLATE Button Click Event
				obj.methods.butTemp.on('click', '.cmsmasters_pattern_delete', function () { 
					if (confirm(cmsmasters_composer.delete_tmpl)) {
						if ($(this).data('id') !== '') {
							$.ajax( { 
								type : 				'POST',
								url : 				ajaxurl,
								data : { 
									action : 		'cmsmasters_ajax_template_operator',
									type : 			'del', 
									id : 			$(this).data('id'),
									nonce : 		cmsmasters_composer.nonce_ajax_template_operator 
								},
								dataType : 			'text'
							} ).done(function (id) { 
								obj.methods.templates.find('a[data-id="' + id + '"]').eq(0).parents('li').remove();
								
								
								obj.methods.messageDelete.fadeIn(100).delay(1000).fadeOut(100);
							} ).fail(function () { 
								alert(cmsmasters_composer.error_on_page);
							} );
						} else {
							alert(cmsmasters_composer.error_on_page);
						}
					}
					
					
					return false;
				} );
				
				
				// Declare CLEAR COMPOSER Button Click Event
				obj.methods.butTemp.on('click', '.cmsmasters_clear_content', function () { 
					if (confirm(cmsmasters_composer.delete_all)) {
						obj.methods.el.find('> div.cmsmasters_row').remove();
						
						
						setTimeout(function () { 
							obj.methods.updateContent(false);
						}, 150);
					}
					
					
					return false;
				} );
				
				
				// Declare FULLSCREEN Button Click Event
				obj.methods.butTemp.on('click', '.cmsmasters_composer_fullscreen', function () { 
					obj.methods.composerStartFullScreen($(this));
					
					
					return false;
				} );
				
				
				// Declare FULLSCREEN UPDATE Button Click Event
				obj.methods.butTemp.on('click', '.cmsmasters_update_trigger', function () { 
					$('#publishing-action > input#publish').trigger('click');
					
					
					return false;
				} );
				
				
				// Declare FULLSCREEN PREVIEW Button Click Event
				obj.methods.butTemp.on('click', '.cmsmasters_preview_trigger', function () { 
					$('#preview-action > a#post-preview').trigger('click');
					
					
					return false;
				} );
				
				
				// Declare FULLSCREEN RESIZE Event
				$(window).bind('resize', function () { 
					clearTimeout(obj.methods.windowResize);


					obj.methods.windowResize = setTimeout(function () {
						if (obj.methods.body.hasClass('cmsmasters_set_fullscreen')) {
							if (obj.methods.el.css('margin-top') !== obj.methods.butCont.outerHeight() - 28 + 'px') {
								obj.methods.el.css('margin-top', obj.methods.butCont.outerHeight() - 28);
							}

							
							if (obj.methods.butCont.css('width') !== obj.methods.el.outerWidth() + 16 + 'px') {
								obj.methods.butCont.css('width', obj.methods.el.outerWidth() + 16);
							}
						}
					}, 300);
				} );
			}, 
			composerAutoStart : function () { 
				if (obj.methods.composerShow.val() === 'true') {
					var startInterval = setInterval(function () { 
						if ( 
							typeof tinyMCE !== 'undefined' && 
							typeof tinyMCE.get(obj.methods.editorID) !== 'undefined' && 
							tinyMCE.get(obj.methods.editorID) !== null 
						) {
							clearInterval(startInterval);
							
							
							obj.methods.composerToggle();
						} else {
							if ($('#wp-' + obj.methods.editorID + '-wrap').hasClass('html-active')) {
								switchEditors.go(obj.methods.editorID, 'tmce');
							}
						}
					}, 100);
				}
			}, 
			composerAutoFullScreen : function () { 
				if (obj.methods.composerFullScreen.val() === 'true') {
					obj.methods.composerStartFullScreen(obj.methods.butTemp.find('.cmsmasters_composer_fullscreen'));
				}
			}, 
			attachEvents : function () { 
				// Declare SHORTCODE Button Click Event
				obj.methods.butElems.on('click', '> ul > li > a', function () { 
					$(this).clone().css( { 
						position : 'absolute', 
						top : 0, 
						zIndex : 100 
					} ).insertAfter($(this));
					
					
					$(this).next().animate( { 
						borderColor : '#e6db55', 
						backgroundColor : '#ffffe0', 
						color : ($(this).hasClass('cmsmasters_row') ? '#d54e21' : '#21759d'), 
						width : '10%', 
						left : '45%' 
					}, { 
						queue : false, 
						duration : 250 
					} ).animate( { 
						top : '250px' 
					}, { 
						queue : false, 
						duration : 500 
					} ).animate( { 
						opacity : 0 
					}, 750, function () { 
						$(this).remove();
					} );
					
					
					obj.methods.addShortcode($(this).data('shortcode'), false, false);
					
					
					return false;
				} );
				
				
				// Declare Column ADD Button Click Event
				obj.methods.el.on('click', 'a.cmsmastersAddBut', function () { 
					obj.methods.openShortcodesLightbox($(this));
					
					
					return false;
				} );
				
				
				// Declare Row LAYOUT CHANGE Buttons Click Event
				obj.methods.el.on('click', 'ul.cmsmastersColumnButs > li > a', function () { 
					obj.methods.changeLayout($(this));
					
					
					return false;
				} );
				
				
				// Declare Element EDIT Button Click Event
				obj.methods.el.on('click', 'a.cmsmastersEditBut, a.cmsmastersEditShortcodeBut', function () { 
					var el = $(this).parent();
					
					
					if (el.is('.innerHead')) {
						el = $(this).parents('.innerHead').parent();
					}
					
					
					obj.methods.editElement(el);
					
					
					return false;
				} );
				
				
				// Declare Element COPY Button Click Event
				obj.methods.el.on('click', 'a.cmsmastersCopyBut', function () { 
					var el = $(this).parents('.innerHead').parent();
					
					
					obj.methods.copyElement(el);
					
					
					return false;
				} );
				
				
				// Declare Element DELETE Button Click Event
				obj.methods.el.on('click', 'a.cmsmastersDelBut', function () { 
					var el = $(this).parents('.innerHead').parent();
					
					
					obj.methods.deleteElement(el);
					
					
					return false;
				} );
			}, 
			detachEvents : function () { 
				// Undeclare SHORTCODE Button Click Event
				obj.methods.butElems.off('click', '> ul > li > a');
				
				// Undeclare Column ADD Button Click Event
				obj.methods.el.off('click', 'a.cmsmastersAddBut');
				
				// Undeclare Row LAYOUT CHANGE Buttons Click Event
				obj.methods.el.off('click', 'ul.cmsmastersColumnButs > li > a');
				
				// Undeclare Element EDIT Button Click Event
				obj.methods.el.off('click', 'a.cmsmastersEditBut, a.cmsmastersEditShortcodeBut');
				
				// Undeclare Element COPY Button Click Event
				obj.methods.el.off('click', 'a.cmsmastersCopyBut');
				
				// Undeclare Element DELETE Button Click Event
				obj.methods.el.off('click', 'a.cmsmastersDelBut');
			}, 
			moveAddButton : function (col) { 
				var addBut = col.find('> a.cmsmastersAddBut'), 
					addButClone = addBut.clone(), 
					shcdsLength = col.find('> div').length;
				
				
				if (addBut.index() === 0 || addBut.index() < shcdsLength) {
					addBut.remove();
					
					
					col.append(addButClone);
				}
			}, 
			setColumnsWidth : function () { 
				obj.methods.el.find('div.cmsmasters_column').each(function () { 
					if ($(this).attr('data-width') !== undefined) {
						$(this).addClass(privateMethods.converWidth($(this).attr('data-width')));
					} else {
						$(this).addClass('one_first').attr('data-width', '1/1');
					}
				} );
			}, 
			converWidth : function (width) { 
				if (width === '1/1') {
					width = 'one_first';
				} else if (width === '3/4') {
					width = 'three_fourth';
				} else if (width === '2/3') {
					width = 'two_third';
				} else if (width === '1/2') {
					width = 'one_half';
				} else if (width === '1/3') {
					width = 'one_third';
				} else if (width === '1/4') {
					width = 'one_fourth';
				}
				
				
				return width;
			}, 
			convertClass : function (el) { 
				var width = '1/1', 
					classes = el.attr('class') ? el.attr('class').split(' ') : [];
				
				
				if (classes[1] !== undefined) {
					if (classes[1] === 'three_fourth') {
						width = '3/4';
					} else if (classes[1] === 'two_third') {
						width = '2/3';
					} else if (classes[1] === 'one_half') {
						width = '1/2';
					} else if (classes[1] === 'one_third') {
						width = '1/3';
					} else if (classes[1] === 'one_fourth') {
						width = '1/4';
					}
				}
				
				
				return width;
			}, 
			getUniqID : function () { 
				return Math.random().toString(36).substr(3, 10);
			}
		};
		
		
		obj.methods.init();
	};
	
	// Plugin Start
	$.fn.cmsmastersContentComposer = function (parameters) { 
		return this.each(function () { 
			if ($(this).data('cmsmastersContentComposer')) { 
				return;
			}
			
			
			var cmsmastersContentComposer = new ContentComposer(this, parameters);
			
			
			$(this).data('cmsmastersContentComposer', cmsmastersContentComposer);
		} );
	};
})(jQuery);

