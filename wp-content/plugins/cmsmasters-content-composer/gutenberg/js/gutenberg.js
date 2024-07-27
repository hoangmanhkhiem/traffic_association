/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.4.4
 * 
 * Content Composer Gutenberg
 * Created by CMSMasters
 * 
 */


( function( $ ) {
	'use strict';

	var ComposerGutenbergApp = {

		init: function() {
			var self = this;

			setTimeout( function() {
				self.cacheElements();
				self.bindEvents();
			}, 1 );
		},

		cacheElements: function() {
			var self = this;

			self.isComposerMode = 'true' === cmsmasters_gutenberg.is_composer_mode;

			self.cache = {};

			self.cache.$gutenberg = $( '#editor' );
			self.cache.$switchMode = $( $( '#composer-gutenberg-button-switch-mode' ).html() );
			self.cache.$switchModeButton = this.cache.$switchMode.find( '#composer-switch-mode-button' );

			self.cache.$gutenbergShowMeta = $('#cmsmasters_gutenberg_show');
			self.cache.$composerShowMeta = $('#cmsmasters_composer_show');

			self.toggleStatus();
			self.buildPanel();

			wp.data.subscribe( function() {
				setTimeout( function() {
					self.buildPanel();
				}, 1 );
			} );
		},

		toggleStatus: function() {
			var self = this;

			$( 'body' )
				.toggleClass( 'composer-editor-active', self.isComposerMode )
				.toggleClass( 'composer-editor-inactive', ! self.isComposerMode );
		},

		buildPanel: function() {
			var self = this;

			self.cache.$gutenberg.find( '.edit-post-header-toolbar' ).append( this.cache.$switchMode );

			if ( ! $( '#composer-editor' ).length ) {
				self.cache.$editorPanel = $( $( '#composer-gutenberg-panel' ).html() );
				self.cache.$gurenbergBlockList = self.cache.$gutenberg.find( '.editor-block-list__layout, .editor-post-text-editor' );
				self.cache.$gurenbergBlockList.after( self.cache.$editorPanel );
				
				self.cache.$editorPanelButton = self.cache.$editorPanel.find( '#composer-go-to-edit-page-link' );

				self.cache.$editorPanelButton.on( 'click', function( event ) {
					event.preventDefault();

					self.animateLoader();

					var documentTitle = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'title' ),
						wpEditor = wp.data.dispatch( 'core/editor' );

					if ( ! documentTitle ) {
						wpEditor.editPost( {
							title: cmsmasters_gutenberg.temp_title + ' #' + $( '#post_ID' ).val()
						} );
					}

					wpEditor.savePost();

					self.redirectWhenSave();
				} );
			}
		},

		bindEvents: function() {
			var self = this;

			self.cache.$switchModeButton.on( 'click', function() {
				self.isComposerMode = ! self.isComposerMode;

				self.toggleStatus();

				if ( self.isComposerMode ) {
					self.cache.$gutenbergShowMeta.val('true');
					self.cache.$composerShowMeta.val('true');

					self.cache.$editorPanelButton.trigger( 'click' );
				} else {
					var wpEditor = wp.data.dispatch( 'core/editor' );

					self.cache.$gutenbergShowMeta.val('false');

					wpEditor.editPost( { gutenberg_cmsmasters_composer_mode: false } );
					wpEditor.savePost();
				}
			} );
		},

		redirectWhenSave: function() {
			var self = this;

			setTimeout( function() {
				if ( wp.data.select( 'core/editor' ).isSavingPost() ) {
					self.redirectWhenSave();
				} else {
					location.href = cmsmasters_gutenberg.edit_link;
				}
			}, 300 );
		},

		animateLoader: function() {
			this.cache.$editorPanelButton.addClass( 'composer-animate' );
		}

	};

	$( function() {
		ComposerGutenbergApp.init();
	} );

}( jQuery ) );

