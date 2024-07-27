var __ 					= wp.i18n.__,
	el 					= wp.element.createElement,
	registerBlockType 	= wp.blocks.registerBlockType,

	// Inspector Layout
	BlockControls 		= ( wp.blockEditor && wp.blockEditor.BlockControls ) ? wp.blockEditor.BlockControls : wp.editor.BlockControls,
	InspectorControls 	= ( wp.blockEditor && wp.blockEditor.InspectorControls ) ? wp.blockEditor.InspectorControls : wp.editor.InspectorControls,
	PanelBody			= wp.components.PanelBody,
	PanelRow 			= wp.components.PanelRow,

	// Controls
	ToolbarGroup 		= wp.components.ToolbarGroup ? wp.components.ToolbarGroup : wp.components.Toolbar,
	ToolbarButton 		= wp.components.ToolbarButton ? wp.components.ToolbarButton : wp.components.IconButton,
	Button 				= wp.components.Button,
	Icon 				= wp.components.Icon,
	TextControl 		= wp.components.TextControl,
	ToggleControl 		= wp.components.ToggleControl,
	SelectControl 		= wp.components.SelectControl,

	// Misc
	Placeholder 		= wp.components.Placeholder;




// In some rare cases the globally loaded LS_GB_l10n
// variable might not be available due to plugins making
// changes in the WP script queue. The below makes sure
// that we can at least avoid undef JS errors.
if( typeof LS_GB_l10n === 'undefined' ) {
	LS_GB_l10n = {};
}


var LS_IconElement = el('svg', {
		width: 20,
		height: 20
	},
	el( 'path',
		{
			d: "M.485 5.782l9.099 4.128c.266.121 .566.121 .832 0l9.099-4.128c.646-.293.646-1.27 0-1.564L10.416.09a1 1 0 0 0-.832 0L.485 4.218c-.646.293-.646 1.271 0 1.564zm19.03 3.448-2.269-1.029-6.314 2.862c-.295.134-.609.202-.932.202s-.636-.068-.932-.202L2.754 8.202l-2.27 1.029c-.646.293-.646 1.27 0 1.563l9.099 4.125c.266.12 .566.12 .832 0L19.515 10.793c.646-.293.646-1.27 0-1.562zm0 4.992-2.261-1.025-6.323 2.866c-.295.134-.609.202-.932.202s-.636-.068-.932-.202L2.746 13.198.485 14.223c-.646.293-.646 1.27 0 1.563l9.099 4.125c.266.12 .566.12 .832 0L19.515 15.785c.646-.293.646-1.27 0-1.562z"
		}
	)
);

registerBlockType( 'kreatura/layerslider', {

	title: 'LayerSlider',
	description: LS_GB_l10n.BlockDesc,
	keywords: [
		'animation',
		'gallery',
		'popup'
	],
	icon: LS_IconElement,
	category: 'widgets',
	supports: {
		html: false
	},

	example: {
		attributes: {
			name: LS_GB_l10n.BlockExampleTitle,
			slideCount: 5,
			previewURL: LS_GB_l10n.BlockExamplePreview,
			isExample: true
		},
	},

	attributes: {

		id: {
			type: 'string',
			default: ''
		},

		name: {
			type: 'string',
			default: ''
		},

		previewURL: {
			type: 'string',
			default: ''
		},

		type: {
			type: 'string',
			default: ''
		},

		autostart: {
			type: 'string',
			default: ''
		},

		firstslide: {
			type: 'string',
			default: ''
		},

		skin: {
			type: 'string',
			default: ''
		},

		slideCount: {
			type: 'integer',
			default: 1
		},

		marginTop: {
			type: 'string',
			default: ''
		},

		marginRight: {
			type: 'string',
			default: ''
		},

		marginBottom: {
			type: 'string',
			default: ''
		},

		marginLeft: {
			type: 'string',
			default: ''
		},

		lastUpdated: {
			type: 'integer',
			default: 0
		},

		isExample: {
			type: 'bool',
			default: false
		}
	},

	edit: function( props  ) {

		var attrs = props.attributes;
		var controls = [];

		if( attrs.id ) {
			var timestamp = lsGetTimestamp();
			if( attrs.lastUpdated < timestamp - 30 ) {
				lsUpdateBlockData( props );
			}
		}




		// INSPECTOR CONTROLS
		// --------------------------------

		var layoutOptions = [{
			value: '',
			label: LS_GB_l10n.LayoutInherit
		}];

		if( LS_GB_l10n.layouts ) {
			for( var layoutHandle in LS_GB_l10n.layouts ) {
				layoutOptions.push({
					value: layoutHandle,
					label: LS_GB_l10n.layouts[ layoutHandle ]
				})
			}
		}


		var skinsOptions = [{
			value: '',
			label: LS_GB_l10n.SkinInherit
		}];

		if( LS_GB_l10n.skins ) {
			for( var skinHandle in LS_GB_l10n.skins ) {
				skinsOptions.push({
					value: skinHandle,
					label: LS_GB_l10n.skins[ skinHandle ]
				})
			}
		}


		var lsInspectorControls =

			el( InspectorControls, {},

				el( PanelBody, { title: LS_GB_l10n.ProjectInfoPanel },
					el( 'div', { className: 'ls-gb-project-info' },

						el( 'div', null,
							el( 'div', null, LS_GB_l10n.ProjectInfoID),
							el( 'div', null, LS_GB_l10n.ProjectInfoName ),
						),
						el( 'div', null,
							el( 'div', null, attrs.id ),
							el( 'div', null, attrs.name ),
						)
					),
					el( Button, {
						text: LS_GB_l10n.ProjectInfoReplace,
						icon: 'screenoptions',
						variant: 'secondary',
						onClick: function() {
							lsOpenProjectLibrary( props );
						},
						style: {
							width: '100%',
							marginBottom: '10px'
						}
						
					}),
					el( Button, {
						text: LS_GB_l10n.ProjectInfoEdit,
						icon: 'edit',
						variant: 'secondary',
						onClick: function() {
							lsOpenProjectInEditor( attrs.id );
						},
						style: {
							width: '100%'
						}
					})
				),

				// Panel Body
				el( PanelBody, { title: LS_GB_l10n.OverridePanel },

					// Description
					el( 'p', null, LS_GB_l10n.OverridePanelDesc ),

					// Layout
					el( SelectControl, {
						label: LS_GB_l10n.LayoutLabel,
						value: attrs.type,
						onChange: function( newValue ) {
							props.setAttributes({ type: newValue })
						},
						options: layoutOptions
					}),

					// Skins
					el( SelectControl, {
						label: LS_GB_l10n.SkinLabel,
						value: attrs.skin,
						onChange: function( newValue ) {
							props.setAttributes({ skin: newValue })
						},
						options: skinsOptions
					}),


					// Auto Start Slideshow
					el( SelectControl, {
						label: LS_GB_l10n.AutoStartLabel,
						value: attrs.autostart,
						onChange: function( newValue ) {
							props.setAttributes({ autostart: newValue })
						},
						options: [
							{ value: '', label: LS_GB_l10n.AutoStartInherit },
							{ value: 'enabled', label: LS_GB_l10n.AutoStartEnable },
							{ value: 'disabled', label: LS_GB_l10n.AutoStartDisable },
						]
					}),


					// First Slide
					el( TextControl, {
						label: LS_GB_l10n.FirstSlideLabel,
						value: attrs.firstslide,
						placeholder: LS_GB_l10n.FirstSlideInherit,
						type: 'number',
						onChange: function( newValue ) {
							props.setAttributes({ firstslide: newValue });
						}
					}),
				),

				el( PanelBody, { title: LS_GB_l10n.LayoutPanel },

					// Description
					el( 'p', null, LS_GB_l10n.LayoutPanelDesc ),

					// Margin Controls
					el( 'p', {}, LS_GB_l10n.MarginLabel ),
					el( 'div', { className: 'ls-gb-margin-holder' },

						el( TextControl, {
							className: 'ls-gb-margin ls-gb-margin-top',
							value: attrs.marginTop,
							placeholder: '0px',
							onChange: function( newValue ) {
								props.setAttributes({ marginTop: newValue });
							}
						}),

						el( TextControl, {
							className: 'ls-gb-margin ls-gb-margin-right',
							value: attrs.marginRight,
							placeholder: LS_GB_l10n.MarginAutoPlaceholder,
							onChange: function( newValue ) {
								props.setAttributes({ marginRight: newValue });
							}
						}),

						el( TextControl, {
							className: 'ls-gb-margin ls-gb-margin-bottom',
							value: attrs.marginBottom,
							placeholder: '0px',
							onChange: function( newValue ) {
								props.setAttributes({ marginBottom: newValue });
							}
						}),

						el( TextControl, {
							className: 'ls-gb-margin ls-gb-margin-left',
							value: attrs.marginLeft,
							placeholder: LS_GB_l10n.MarginAutoPlaceholder,
							onChange: function( newValue ) {
								props.setAttributes({ marginLeft: newValue });
							}
						})
					)
				)
			);




		// BLOCK PLACEHOLDER
		// --------------------------------
		var lsBlockPlaceholder =
			el( Placeholder, {
					icon: el( Icon, {
						className: 'editor-block-icon block-editor-block-icon',
						icon: LS_IconElement
					}),
					label: 'LayerSlider',
					instructions: LS_GB_l10n.PlaceholderDesc,
				},

				el( Button, {
					isLarge: true,
					variant: 'primary',
					onClick: function() {
						lsOpenProjectLibrary( props );
					}
				}, LS_GB_l10n.SliderLibraryButton )

			);



		// Block Controls
		var lsBlockControls =

			el( BlockControls, null,
				el( ToolbarGroup, null,

					el( ToolbarButton, {
						label: LS_GB_l10n.BlockEditLabel,
						icon: 'screenoptions',
						onClick: function() {
							lsOpenProjectLibrary( props );
						}
					})
				),


				el( ToolbarGroup, null,

					el( ToolbarButton, {
						label: LS_GB_l10n.BlockSliderEditorLabel,
						icon: 'edit',
						onClick: function() {
							lsOpenProjectInEditor( attrs.id );
						}
					})
				)
			);




		// BLOCK CONTENT
		// --------------------------------
		var classNames = 'ls-gb-block-content';

		if( ! attrs.previewURL || attrs.previewURL.indexOf('blank.gif') !== -1 ) {
			classNames += ' ls-no-preview';
		}

		var lsBlockContent = el(
			'div', {
				className: classNames,
				style: {
					backgroundImage: 'url('+attrs.previewURL+')',
					marginTop: attrs.marginTop ? parseInt( attrs.marginTop )+'px' : 0,
					marginRight: attrs.marginRight ? parseInt( attrs.marginRight )+'px' : 0,
					marginBottom: attrs.marginBottom ? parseInt( attrs.marginBottom )+'px' : 0,
					marginLeft: attrs.marginLeft ? parseInt( attrs.marginLeft )+'px' : 0,
				}
			},
				el('div', { className: 'ls-info' },
					el( 'div', { className: 'ls-id' }, LS_GB_l10n.BlockTitle.replace('%d', attrs.id ) ),
					el( 'div', { className: 'ls-name' }, attrs.name )
				),

				el('span', { className: 'ls-arrow-left dashicons dashicons-arrow-left-alt2' }),
				el('span', { className: 'ls-arrow-right dashicons dashicons-arrow-right-alt2' }),
		);



		if( attrs.slideCount && attrs.slideCount > 1 ) {

			var lsSlidesHolder = el('div', { className: 'ls-slides-holder' } );
			lsBlockContent.props.children.push( lsSlidesHolder );

			if( ! lsSlidesHolder.props.children ) {
				lsSlidesHolder.props.children = [];
			}

			for( var c = 0; c < attrs.slideCount; c++ ) {

				lsSlidesHolder.props.children.push(
					el('span', { className: 'ls-slide-marker dashicons dashicons-marker' })
				);
			}
		}


		if( ! attrs.id && ! attrs.isExample ) {
			controls.push( lsBlockPlaceholder );
		} else {
			controls.push( lsBlockControls, lsBlockContent, lsInspectorControls );
		}

		return controls;
	},


	save: function( props ) {

		// We're going to be rendering in PHP, so save() can just return null.
		return null;
	}

});

function lsUpdateBlockData( props ) {

	props.setAttributes({
		lastUpdated: lsGetTimestamp()
	});

	jQuery.getJSON( LS_SLibrary_l10n.ajaxurl, {
		action: 'ls_get_slider_details',
		sliderID: props.attributes.id
	}, function( sliderData ) {

		if( sliderData ) {
			props.setAttributes({
				name: sliderData.name,
				previewURL: sliderData.previewurl,
				slideCount: sliderData.slidecount,
				lastUpdated: lsGetTimestamp()
			});
		}
	});
}


function lsOpenProjectLibrary( props ) {
	LS_SliderLibrary.open({
		onChange: function( sliderData ) {
			props.setAttributes({
				id: sliderData.id.toString(),
				name: sliderData.name,
				previewURL: sliderData.previewurl,
				slideCount: sliderData.slidecount,
				lastUpdated: lsGetTimestamp()
			});
		}
	});
}

function lsOpenProjectInEditor( id ) {
	window.open(LS_GB_l10n.edit_url + id, '_blank');
}

function lsGetTimestamp() {
	return Date.now() / 1000 | 0;
}