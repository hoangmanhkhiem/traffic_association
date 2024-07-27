jQuery(document).ready(function($) {

	// In some rare cases the globally loaded LS_MCE_l10n
	// variable might not be available due to plugins making
	// changes in the WP script queue. The below makes sure
	// that we can at least avoid undef JS errors.
	if( typeof LS_MCE_l10n === 'undefined' ) {
		LS_MCE_l10n = {};
	}

	tinymce.create('tinymce.plugins.layerslider_plugin', {

		init : function(ed, url) {


			// Button props
			ed.addButton('layerslider_button', {
				title : LS_MCE_l10n.MCEAddLayerSlider,
				cmd : 'layerslider_insert_shortcode',
				onClick : $.proxy( this.openPopup, this ),
				image: 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMCAyMCI+PHBhdGggZmlsbD0iIzUwNTc1ZSIgZD0iTS40ODUgNS43ODJsOS4wOTkgNC4xMjhjLjI2Ni4xMjEgLjU2Ni4xMjEgLjgzMiAwbDkuMDk5LTQuMTI4Yy42NDYtLjI5My42NDYtMS4yNyAwLTEuNTY0TDEwLjQxNi4wOWExIDEgMCAwIDAtLjgzMiAwTC40ODUgNC4yMThjLS42NDYuMjkzLS42NDYgMS4yNzEgMCAxLjU2NHptMTkuMDMgMy40NDgtMi4yNjktMS4wMjktNi4zMTQgMi44NjJjLS4yOTUuMTM0LS42MDkuMjAyLS45MzIuMjAycy0uNjM2LS4wNjgtLjkzMi0uMjAyTDIuNzU0IDguMjAybC0yLjI3IDEuMDI5Yy0uNjQ2LjI5My0uNjQ2IDEuMjcgMCAxLjU2M2w5LjA5OSA0LjEyNWMuMjY2LjEyIC41NjYuMTIgLjgzMiAwTDE5LjUxNSAxMC43OTNjLjY0Ni0uMjkzLjY0Ni0xLjI3IDAtMS41NjJ6bTAgNC45OTItMi4yNjEtMS4wMjUtNi4zMjMgMi44NjZjLS4yOTUuMTM0LS42MDkuMjAyLS45MzIuMjAycy0uNjM2LS4wNjgtLjkzMi0uMjAyTDIuNzQ2IDEzLjE5OC40ODUgMTQuMjIzYy0uNjQ2LjI5My0uNjQ2IDEuMjcgMCAxLjU2M2w5LjA5OSA0LjEyNWMuMjY2LjEyIC41NjYuMTIgLjgzMiAwTDE5LjUxNSAxNS43ODVjLjY0Ni0uMjkzLjY0Ni0xLjI3IDAtMS41NjJ6Ii8+PC9zdmc+'
			});
		},

		openPopup : function(e) {

			LS_SliderLibrary.open({

			    onChange: function( sliderData ) {

					var embedId = sliderData.slug ? sliderData.slug : sliderData.id;

					tinymce.execCommand('mceInsertContent', false, '[layerslider id="'+embedId+'"]');
				}
			});
		}
	});

	// Add button
	tinymce.PluginManager.add('layerslider_button', tinymce.plugins.layerslider_plugin);
});
