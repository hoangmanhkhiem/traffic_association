/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Custom Fonts
 * @version 	1.0.0
 * 
 * Fonts Admin Scripts
 * Created by CMSMasters
 * 
 */


(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({
	1:[
		function(require,module,exports){
			var FontManager = require( './cmsmasters-font-manager' );
			
			window.cmsmastersFontManager = {
				fontManager: new FontManager()
			};
			
			jQuery( function() {
				cmsmastersFontManager.fontManager.init();
			} );
		},
		{
			"./cmsmasters-font-manager":2
		}
	],
	2:[
		function(require,module,exports){
			module.exports = function() {
				var self = this;

				self.fields = {
					upload: require( './cmsmasters-font-manager-upload' ),
					repeater: require( './cmsmasters-font-manager-repeater' )
				};

				self.selectors = {
					editPageClass: 'post-type-cmsmasters_font',
					title: '#title',
					repeaterBlock: '.repeater-block',
					repeaterTitle: '.repeater-title',
					removeRowBtn: '.remove-repeater-row',
					editRowBtn: '.toggle-repeater-row',
					closeRowBtn: '.close-repeater-row',
					styleInput: '.font_style',
					weightInput: '.font_weight',
					customFontsMetaBox: '#cmsmasters-custom-font-metabox',
					closeHandle: 'button.handlediv',
					toolbar: '.cmsmasters-field-toolbar',
					inlinePreview: '.inline-preview',
					fileUrlInput: '.cmsmasters-field-file input[type="text"]'
				};

				self.fontLabelTemplate = '<ul class="row-font-label"><li class="row-font-weight">{{weight}}</li><li class="row-font-style">{{style}}</li><li class="row-font-preview">{{preview}}</li>{{toolbar}}</ul>';

				self.renderTemplate = function( tpl, data ) {
					var re = /{{([^}}]+)?}}/g, match;
					while ( match = re.exec( tpl ) ) {
						tpl = tpl.replace( match[ 0 ], data[ match[ 1 ] ] );
					}
					return tpl;
				};

				self.ucFirst = function( string ) {
					return string.charAt( 0 ).toUpperCase() + string.slice( 1 );
				};

				self.getPreviewStyle = function( $table ) {
					var self = cmsmastersFontManager.fontManager,
						fontFamily = jQuery( self.selectors.title ).val(),
						style = $table.find( 'select' + self.selectors.styleInput ).first().val(),
						weight = $table.find( 'select' + self.selectors.weightInput ).first().val();

					return {
						style: self.ucFirst( style ),
						weight: self.ucFirst( weight ),
						styleAttribute: 'font-family: ' + fontFamily + ' ;font-style: ' + style + '; font-weight: ' + weight + ';'
					};
				};

				self.updateRowLabel = function( event, $table ) {
					var self = cmsmastersFontManager.fontManager,
						$block = $table.closest( self.selectors.repeaterBlock ),
						$deleteBtn = $block.find( self.selectors.removeRowBtn ).first(),
						$editBtn = $block.find( self.selectors.editRowBtn ).first(),
						$closeBtn = $block.find( self.selectors.closeRowBtn ).first(),
						$toolbar = $table.find( self.selectors.toolbar ).last().clone(),
						previewStyle = self.getPreviewStyle( $table ),
						toolbarHtml;

					if ( $editBtn.length > 0 ) {
						$editBtn.not( self.selectors.toolbar + ' ' + self.selectors.editRowBtn ).remove();
					}

					if ( $closeBtn.length > 0 ) {
						$closeBtn.not( self.selectors.toolbar + ' ' + self.selectors.closeRowBtn ).remove();
					}

					if ( $deleteBtn.length > 0 ) {
						$deleteBtn.not( self.selectors.toolbar + ' ' + self.selectors.removeRowBtn ).remove();
					}

					toolbarHtml =  jQuery( '<li class="row-font-actions">' ).append( $toolbar )[0].outerHTML;

					return self.renderTemplate( self.fontLabelTemplate, {
						weight: '<span class="label">Weight:</span>' + previewStyle.weight,
						style: '<span class="label">Style:</span>' + previewStyle.style,
						preview: '<span style="' + previewStyle.styleAttribute + '">The Quick Brown Fox Jumps Over The Lazy Dog.</span>',
						toolbar: toolbarHtml
					});
				};

				self.onRepeaterToggleVisible = function( event, $btn, $table ) {
					var self = cmsmastersFontManager.fontManager,
						$previewElement = $table.find( self.selectors.inlinePreview ),
						previewStyle = self.getPreviewStyle( $table );

					$previewElement.attr( 'style', previewStyle.styleAttribute );
				};

				self.onRepeaterNewRow = function( event, $btn, $block ) {
					var self = cmsmastersFontManager.fontManager;
					$block.find( self.selectors.removeRowBtn ).first().remove();
					$block.find( self.selectors.editRowBtn ).first().remove();
					$block.find( self.selectors.closeRowBtn ).first().remove();
				};

				self.maybeToggle = function( event ) {
					var self = cmsmastersFontManager.fontManager;
					event.preventDefault();

					if ( jQuery( this ).is( ':visible' ) && ! jQuery( event.target ).hasClass( self.selectors.editRowBtn ) ) {
						jQuery( this ).find( self.selectors.editRowBtn ).click();
					}
				};

				self.onInputChange = function( event ) {
					var self = this,
						$el = jQuery( event.target ).next();

					self.fields.upload.setFields( $el );
					self.fields.upload.setLabels( $el );
					self.fields.upload.replaceButtonClass( $el );
				};

				self.bind = function() {
					jQuery( document ).on( 'repeaterComputedLabel', this.updateRowLabel )
						.on( 'onRepeaterToggleVisible', this.onRepeaterToggleVisible )
						.on( 'onRepeaterNewRow', this.onRepeaterNewRow )
						.on( 'click', this.selectors.repeaterTitle, this.maybeToggle )
						.on( 'input', this.selectors.fileUrlInput, this.onInputChange.bind( this ) );
				};

				self.removeCloseHandle = function() {
					jQuery( this.selectors.closeHandle ).remove();
					jQuery( this.selectors.customFontsMetaBox ).removeClass( 'closed' ).removeClass( 'postbox' );
				};

				self.titleRequired = function() {
					jQuery( self.selectors.title ).prop( 'required', true );
				};

				self.init = function() {
					if ( ! jQuery( 'body' ).hasClass( self.selectors.editPageClass ) ) {
						return;
					}

					this.removeCloseHandle();
					this.titleRequired();
					this.bind();
					this.fields.upload.init();
					this.fields.repeater.init();
				};
			};

		},
		{
			"./cmsmasters-font-manager-repeater":3,
			"./cmsmasters-font-manager-upload":4
		}
	],
	3:[
		function(require,module,exports){
			module.exports =  {
				selectors: {
					add: '.add-repeater-row',
					remove: '.remove-repeater-row',
					toggle: '.toggle-repeater-row',
					close: '.close-repeater-row',
					sort: '.sort-repeater-row',
					table: '.form-table',
					block: '.repeater-block',
					repeaterLabel: '.repeater-title',
					repeaterField: '.cmsmasters-field-repeater'
				},

				counters: [],

				trigger: function( eventName, params ) {
					jQuery( document ).trigger( eventName, params );
				},

				triggerHandler: function( eventName, params ) {
					return jQuery( document ).triggerHandler( eventName, params );
				},

				countBlocks: function( $btn ) {
					return $btn.closest( this.selectors.repeaterField ).find( this.selectors.block ).length || 0;
				},

				add: function( btn ) {
					var self = this,
						$btn = jQuery( btn ),
						id = $btn.data( 'template-id' ),
						repeaterBlock;
					if ( ! self.counters.hasOwnProperty( id ) ) {
						self.counters[ id ] = self.countBlocks( $btn );
					}
					self.counters[ id ] += 1;
					repeaterBlock = jQuery( '#' + id ).html();
					repeaterBlock = self.replaceAll( '__counter__', self.counters[ id ], repeaterBlock );
					$btn.before( repeaterBlock );
					self.trigger( 'onRepeaterNewRow', [ $btn, $btn.prev() ] );
				},

				remove: function( btn ) {
					var self = this;
					jQuery( btn ).closest( self.selectors.block ).remove();
				},

				toggle: function( btn ) {
					var self = this,
						$btn = jQuery( btn ),
						$table = $btn.closest( self.selectors.block ).find( self.selectors.table ),
						$toggleLabel = $btn.closest( self.selectors.block ).find( self.selectors.repeaterLabel );

					$table.toggle( 0, 'none', function() {
						if ( $table.is( ':visible' ) ) {
							$table.closest( self.selectors.block ).addClass( 'block-visible' );
							self.trigger( 'onRepeaterToggleVisible', [ $btn, $table, $toggleLabel ] );
						} else {
							$table.closest( self.selectors.block ).removeClass( 'block-visible' );
							self.trigger( 'onRepeaterToggleHidden', [ $btn, $table, $toggleLabel ] );
						}
					} );

					$toggleLabel.toggle();

					// Update row label
					self.updateRowLabel( btn );
				},

				close: function( btn ) {
					var self = this,
						$btn = jQuery( btn ),
						$table = $btn.closest( self.selectors.block ).find( self.selectors.table ),
						$toggleLabel = $btn.closest( self.selectors.block ).find( self.selectors.repeaterLabel );

					$table.closest( self.selectors.block ).removeClass( 'block-visible' );
					$table.hide();
					self.trigger( 'onRepeaterToggleHidden', [ $btn, $table, $toggleLabel ] );
					$toggleLabel.show();
					self.updateRowLabel( btn );
				},

				updateRowLabel: function( btn ) {
					var self = this,
						$btn = jQuery( btn ),
						$table = $btn.closest( self.selectors.block ).find( self.selectors.table ),
						$toggleLabel = $btn.closest( self.selectors.block ).find( self.selectors.repeaterLabel );

					var selector = $toggleLabel.data( 'selector' );
					// For some browsers, `attr` is undefined; for others,  `attr` is false.  Check for both.
					if ( typeof selector !== typeof undefined && false !== selector ) {
						var value = false,
							std = $toggleLabel.data( 'default' );

						if ( $table.find( selector ).length ) {
							value = $table.find( selector ).val();
						}

						//filter hook
						var computedLabel = self.triggerHandler( 'repeaterComputedLabel', [ $table, $toggleLabel, value ] );

						// For some browsers, `attr` is undefined; for others,  `attr` is false.  Check for both.
						if ( undefined !== computedLabel && false !== computedLabel ) {
							value = computedLabel;
						}

						// Fallback to default row label
						if ( undefined === value || false === value ) {
							value = std;
						}

						$toggleLabel.html( value );
					}
				},

				replaceAll: function( search, replace, string ) {
					return string.replace( new RegExp( search, 'g' ), replace );
				},

				init: function() {
					var self = this;
					jQuery( document )
						.on( 'click', this.selectors.add, function( event ) {
							event.preventDefault();
							self.add( jQuery( this ), event );
						} )
						.on( 'click', this.selectors.remove, function( event ) {
							event.preventDefault();
							var result = confirm( jQuery( this ).data( 'confirm' ).toString() );
							if ( ! result ) {
								return;
							}
							self.remove( jQuery( this ), event );
						} )
						.on( 'click', this.selectors.toggle, function( event ) {
							event.preventDefault();
							event.stopPropagation();
							self.toggle( jQuery( this ), event );
						} )
						.on( 'click', this.selectors.close, function( event ) {
							event.preventDefault();
							event.stopPropagation();
							self.close( jQuery( this ), event );
						} );

					jQuery( this.selectors.toggle ).each( function() {
						self.updateRowLabel( jQuery( this ) );
					} );

					this.trigger( 'onRepeaterLoaded', [ this ] );
				}
			};
		},
		{}
	],
	4:[
		function(require,module,exports){
			module.exports = {
				$btn: null,
				fileId: null,
				fileUrl: null,
				fileFrame: [],

				selectors: {
					uploadBtnClass: 'cmsmasters-upload-btn',
					clearBtnClass: 'cmsmasters-upload-clear-btn',
					uploadBtn: '.cmsmasters-upload-btn',
					clearBtn: '.cmsmasters-upload-clear-btn'
				},

				hasValue: function() {
					return ( '' !== jQuery( this.fileUrl ).val() );
				},

				setLabels: function( $el ) {
					if ( ! this.hasValue() ) {
						$el.val( $el.data( 'upload_text' ) );
					} else {
						$el.val( $el.data( 'remove_text' ) );
					}
				},

				setFields: function( el ) {
					var self = this;
					self.fileUrl = jQuery( el ).prev();
					self.fileId = jQuery( self.fileUrl ).prev();
				},

				setUploadParams: function( ext, name ) {
					var self = this;
					self.fileFrame[ name ].uploader.uploader.param( 'uploadeType', ext );
					self.fileFrame[ name ].uploader.uploader.param( 'uploadeTypecaller', 'cmsmasters-admin-upload' );
				},

				replaceButtonClass: function( el ) {
					if ( this.hasValue() ) {
						jQuery( el ).removeClass( this.selectors.uploadBtnClass ).addClass( this.selectors.clearBtnClass );
					} else {
						jQuery( el ).removeClass( this.selectors.clearBtnClass ).addClass( this.selectors.uploadBtnClass );
					}
					this.setLabels( el );
				},

				uploadFile: function( el ) {
					var self = this,
						$el = jQuery( el ),
						mime = $el.attr( 'data-mime_type' ) || '',
						ext = $el.attr( 'data-ext' ) || false,
						name = $el.attr( 'id' );
					// If the media frame already exists, reopen it.
					if ( 'undefined' !== typeof self.fileFrame[ name ] ) {
						if ( ext ) {
							self.setUploadParams( ext, name );
						}

						self.fileFrame[ name ].open();

						return;
					}

					// Create the media frame.
					self.fileFrame[ name ] = wp.media( {
						library: {
							type: mime.split( ',' )
						},
						title: $el.data( 'box_title' ),
						button: {
							text: $el.data( 'box_action' )
						},
						multiple: false
					} );

					// When an file is selected, run a callback.
					self.fileFrame[ name ].on( 'select', function() {
						// We set multiple to false so only get one image from the uploader
						var attachment = self.fileFrame[ name ].state().get( 'selection' ).first().toJSON();
						// Do something with attachment.id and/or attachment.url here
						jQuery( self.fileId ).val( attachment.id );
						jQuery( self.fileUrl ).val( attachment.url );
						self.replaceButtonClass( el );
						self.updatePreview( el );
					});

					// Finally, open the modal
					self.fileFrame[ name ].open();
					if ( ext ) {
						self.setUploadParams( ext, name );
					}
				},

				updatePreview: function( el ) {
					var self = this,
						$ul = jQuery( el ).parent().find( 'ul' ),
						$li = jQuery( '<li>' ),
						showUrlType = jQuery( el ).data( 'preview_anchor' ) || 'full';

					$ul.html( '' );

					if ( self.hasValue() && 'none' !== showUrlType ) {
						var anchor = jQuery( self.fileUrl ).val();
						if ( 'full' !== showUrlType ) {
							anchor = anchor.substring( anchor.lastIndexOf( '/' ) + 1 );
						}

						$li.html( '<a href="' + jQuery( self.fileUrl ).val() + '" download>' + anchor + '</a>' );
						$ul.append( $li );
					}
				},

				setup: function() {
					var self = this;
					jQuery( self.selectors.uploadBtn + ', ' + self.selectors.clearBtn ).each( function() {
						self.setFields( jQuery( this ) );
						self.updatePreview( jQuery( this ) );
						self.setLabels( jQuery( this ) );
						self.replaceButtonClass( jQuery( this ) );
					});
				},

				init: function() {
					var self = this;

					jQuery( document ).on( 'click', self.selectors.uploadBtn, function( event ) {
						event.preventDefault();
						self.setFields( jQuery( this ) );
						self.uploadFile( jQuery( this ) );
					} );

					jQuery( document ).on( 'click', self.selectors.clearBtn, function( event ) {
						event.preventDefault();
						self.setFields( jQuery( this ) );
						jQuery( self.fileUrl ).val( '' );
						jQuery( self.fileId ).val( '' );

						self.updatePreview( jQuery( this ) );
						self.replaceButtonClass( jQuery( this ) );
					} );

					this.setup();

					jQuery( document ).on( 'onRepeaterNewRow', function() {
						self.setup();
					} );
				}
			};
		},
		{}
	]
},
{},
[1]
)

