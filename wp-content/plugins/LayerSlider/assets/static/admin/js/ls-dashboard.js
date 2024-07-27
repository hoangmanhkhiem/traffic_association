var importModalWindowTimeline = null,
	importModalWindowTransition = null,
	importModalThumbnailsTransition = null,

	draggedSliderItem = null,
	targetSliderItem = null,

	sliderDragGroupingTimeout = null,
	sliderGroupRenameTimeout = null,

	$lastOpenedGroup,

	activeShuffleContainerIndex = 0

	projectRenameTimeout = 0;

var LS_importQueue = [];


// Stores the lastly selected slider item
// foe which the context menu was opened.
var LS_contextMenuSliderItem;


jQuery(function($) {

	// Check if addons buttons should pulse/highlight
	jQuery( '#ls-addons-button' ).closest( '.ls-item' ).addClass( 'ls--highlight-' + ( localStorage.getItem( 'lsDashboard.addonsHighlight' ) || 'enabled' ) );



	kmUI.dropdown.init();

	$('#ls-list-main-menu ls-button[data-scroll]').on('click', function() {
		scrollToElement( $( this ).data('scroll') );
	});

	// Auto-submit filter/search bar when choosing different view mode
	// from drop-down menus.
	$('#ls-slider-filters').on('change', 'select', function() {
		$(this).closest('#ls-slider-filters').submit();
	});

	$('#ls-plugin-settings-tabs input[name="ls_google_fonts_status"]').on('change', function() {

		var $checkbox 	= $( this ),
			$wrapper 	= $('.ls-show-if-google-fonts-enabled');

		$wrapper[ $checkbox.prop('checked') ? 'removeClass' : 'addClass' ]('ls-hidden');
	}).change();

	$('#ls-plugin-settings-tabs .ls-empty-google-fonts').on('click', function( event ) {

		event.preventDefault();
		lsCommon.smartAlert.confirm( LS_l10n.GFEmptyConfirmation, () => {
			document.location.href = $( this ).attr('href');
		});
	});

	$('#ls-global-google-fonts').on('click', '.ls-remove-font', function() {

		lsCommon.smartAlert.confirm( LS_l10n.GFRemoveConfirmation, () => {

			var $fontItem = $( this ).closest('.ls-font-item');

			$fontItem.css({ opacity: 0, transform: 'scale(0)'});
			setTimeout( function() {
				$fontItem.remove();
				saveGoogleFonts();
			}, 250 );
		});
	});

	$( document ).on('click', '.ls-open-plugin-settings-button', function() {

		kmw.modal.open({
			content: $('#tmpl-plugin-settings-content'),
			outerClasses: 'plugin-settings-content-modal',
			clip: true,
			minWidth: 400,
			maxHeight: '90%',
			maxWidth: 1280,
			sidebar: {
				left: {
					width: 300,
					customHeaderHeight: true,
					content: $('#tmpl-plugin-settings-sidebar')
				}
			}
		});
	});

	$( document ).on('click', '.ls-open-fonts-library', function() {

		LS_fontLibrary.open( function( fontName ) {

			LS_fontLibrary.close();

			setTimeout( function() {

				var $template = $( $('#ls-font-item-template').html() );

				$template.find('.ls-font-name').text( fontName ).css('font-family', '"'+fontName+'"');
				$('#ls-global-google-fonts').prepend( $template );
				saveGoogleFonts();
			}, 800 );
		});
	});


	$( document ).on('click', '#ls-plugin-settings-content input', function( event ) {

		const 	$checkbox 	= $( this ),
				checked 	= $checkbox.prop('checked');

		// Enable warning
		if( checked && $checkbox.data('warning-enable') ) {

			event.preventDefault();
			event.stopPropagation();

			lsCommon.smartAlert.confirm( $checkbox.data('warning-enable'), () => {
				$checkbox.prop('checked', true ).trigger('change');
			});

		}

		// Disable warning
		if( ! checked && $checkbox.data('warning-disable') ) {

			event.preventDefault();
			event.stopPropagation();

			lsCommon.smartAlert.confirm( $( this ).data('warning-disable'), () => {
				$checkbox.prop('checked', false ).trigger('change');
			});
		}

	});


	var pluginSettingsTimout;
	$( document ).on('change input', '#ls-plugin-settings-content input, #ls-plugin-settings-content select', function() {

		clearTimeout( pluginSettingsTimout );
		pluginSettingsTimout = setTimeout( function() {

			const formData = $('#ls-plugin-settings-content').serialize();

			$.post( ajaxurl, formData, ( responseData ) => {

			});

		}, 500 );
	});

	$( document ).on('click', '.ls-show-canceled-activation-modal', function() {
		kmw.modal.open({
			content: '#tmpl-canceled-activation-modal',
			modalClasses: 'tmpl-canceled-activation-modal',
			minWidth: 400,
			maxWidth: 960,
		});
	});


	$('#ls-notification-clear-button').click( function() {

		$('.ls-notifications-button').removeClass('ls-active');
		$('#ls-notification-panel .ls-notification-unread').removeClass('ls-notification-unread');
		$('.ls-fancy-notice-wrapper .ls-notification-dismissible').slideUp( 400, function() {
			$( this ).remove();

			if( ! $('.ls-fancy-notice-wrapper').children().length ) {
				$('#ls-list-main-menu').removeClass('ls-has-inline-notifications');
			}
		});

		$.getJSON( ajaxurl, { action: 'ls_clear_notifications' });
	});

	jQuery('.ls-slider-list-items').on('click', ':checkbox', function() {

		$( this ).closest('.slider-item').toggleClass('ls-selected');
		checkSliderSelection();
	});



	$('.ls-slider-list-items').on('contextmenu', '.slider-item', function( event ) {

		if( $( event.target ).is('input') ) {
			return true;
		}

		var $sliderItem = $( this );

		if( $sliderItem.hasClass('group-item') ) {
			event.preventDefault();
			return;
		}

		LS_contextMenuSliderItem = $sliderItem;

		LS_ContextMenu.open( event, {
			width: 230,
			selector: '.ls-sliders-list-context-menu',
			template: '#tmpl-ls-sliders-list-context-menu',
			onBeforeOpen: function( $contextMenu ) {

				if( event.manualOpen ) {
					$sliderItem.addClass('ls-context-menu-open');
				}

				$sliderItem.addClass('ls-highlight-row');
				$contextMenu.removeClass('ls-hidden-slider');

				if( $sliderItem.data('hidden') ) {
					$contextMenu.addClass('ls-hidden-slider');
				}
			},

			onClose: function() {
				$('.slider-item').removeClass('ls-context-menu-open ls-highlight-row');
			}
		});


	}).on('click', '.slider-item .ls-preview', function( event ) {

		if( event.ctrlKey || event.metaKey ) {

			event.preventDefault();

			$( this ).closest('.slider-item').find('.slider-checkbox').click();
		}


	}).on('mouseenter', '.slider-actions-button, .slider-item-wrapper input', function() {
		$( this ).closest('.slider-item').addClass('ls-block-active-state');

	}).on('mouseleave', '.slider-actions-button, .slider-item-wrapper input', function() {
		$( this ).closest('.slider-item').removeClass('ls-block-active-state');

	}).on('input', '.slider-item-wrapper .ls--project-name-input', function() {

		var $this = $( this );

		clearTimeout( projectRenameTimeout );
		projectRenameTimeout = setTimeout( function() {

			var $item = $this.closest('.slider-item'),
				data  = $item.data(),
				nonce = $('.ls-slider-list-form input[name="_wpnonce"]').val();

			$.post( ajaxurl, {
				action: 'ls_rename_project',
				id: data.id,
				name: $this.val(),
				_wpnonce: nonce,
			});

		}, 500 );


	}).on('click', '.slider-actions-button', function() {

		var $this 	= jQuery( this ),
			offsets = $this.offset(),
			width 	= $this.width(),
			height 	= $this.height();


		jQuery('.ls-slider-list-items').triggerHandler(

			jQuery.Event( 'contextmenu', {
				target: $this[0],
				pageX: offsets.left - 3,
				pageY: offsets.top + height + 7,
				manualOpen: true,
				alignRight: {
					pageX: offsets.left + width
				}
			})
		);


	}).on('click', '.slider-item.group-item', function( e ) {
		e.preventDefault();

		var $this 		= $( this ),
			groupName 	= $.trim( $this.find('.ls-name ls-span').html() ).replace(/"/g, '&quot;');

		$lastOpenedGroup = $this;

		kmw.modal.open({
			into: '.ls-sliders-grid',
			title: '<input value="'+groupName+'"><a href="#" class="ls--button ls--bg-blue ls--small ls-remove-group-button" data-help="'+LS_l10n.SLRemoveGroupTooltip+'" data-help-delay="100">'+LS_l10n.SLRemoveGroupButton+'</a>',
			content: $this.next().children(),
			maxWidth: 1380,
			minWidth: 600,
			spacing: 60,
			modalClasses: 'ls-slider-group-modal-window ls--form-control',
			animationIn: 'scale',
			overlaySettings: {
				animationIn: 'fade',
				customClasses: 'ls-project-group-modal-overlay'
			},
			onBeforeOpen: function() {
				jQuery('#ls-slider-selection-bar-placeholder').show();
				jQuery('#ls-slider-selection-bar').addClass('ls-overlay-selection-bar');
			},
			onClose: function() {
				jQuery('#ls-slider-selection-bar-placeholder').hide();
				jQuery('#ls-slider-selection-bar').removeClass('ls-overlay-selection-bar');
			}
		});



		setTimeout( function() {
			removeSliderFromGroupDraggable();
		}, 200);

	});


	$( document ).on('input', '.ls-slider-group-modal-window .kmw-modal-title input', function() {

		$this = $( this );

		clearTimeout( sliderGroupRenameTimeout );
		sliderGroupRenameTimeout = setTimeout( function() {

			$.get( ajaxurl, {
				action: 'ls_rename_slider_group',
				nonce: LS_pageMeta.dashboardNonce,
				groupId: $lastOpenedGroup.data('id'),
				name: $this.val()
			});

		}, 300 );


		$lastOpenedGroup.find('.ls-name ls-span').text( $this.val() );
	});

	$( document ).on('click', '.ls-slider-group-modal-window .ls-remove-group-button', function( e) {

		e.preventDefault();
		kmUI.popover.close();

		lsCommon.smartAlert.confirm( LS_l10n.SLRemoveGroupConfirm, () => {

			$.get( ajaxurl, {
				action: 'ls_delete_slider_group',
				nonce: LS_pageMeta.dashboardNonce,
				groupId: $lastOpenedGroup.data('id'),
			});

			var $sliders = $('.ls-slider-group-modal-window .slider-item');

			// Destroy previous draggable instance (if any)
			if( $sliders.hasClass('ui-draggable') ) {
				$sliders.draggable('destroy');
			}

			// Destroy previous droppable instance (if any)
			if( $sliders.hasClass('ui-droppable') ) {
				$sliders.droppable('destroy');
			}

			$sliders.prependTo('.ls-sliders-grid');

			setTimeout( function() {
				addSliderToGroupDraggable();
				addSliderToGroupDroppable();

				createSliderGroupDroppable();
			}, 300 );


			$lastOpenedGroup.next().remove();
			$lastOpenedGroup.remove();

			kmw.modal.close();
		});

	});

	jQuery('#ls-add-slider-button').click( function( e ) {
		e.preventDefault();

		kmw.modal.open({
			content: '#tmpl-add-new-slider',
			maxWidth: 415,
			minWidth: 415,
			onOpen: function() {
				$('#add-new-slider-modal input').focus();
			}

		});
	});

	jQuery('#ls-addons-button').click( function( e ) {
		e.preventDefault();

		kmw.modal.open({
			id: 'ls-premium-benefits-modal',
			content: '<iframe src="https://layerslider.com/premium-embed/" frameborder="0" allowtransparency="true" allowfullscreen="true"></iframe>',
			maxWidth: 1280,
			maxHeight: '100%',
			padding: 0,
			spacing: 20,
			closeButton: true
		});
	});


	// Add-Ons
	// var LS_Addons = {

	// 	initialized: false,
	// 	$modal: null,

	// 	init: function(){

	// 		jQuery('#ls-addons-button' ).on( 'click', function(e){
	// 			e.preventDefault();
	// 			kmw.modal.close();
	// 			LS_Addons.openModal();

	// 			// disable pulse/highlight effect
	// 			localStorage.setItem( 'lsDashboard.addonsHighlight', 'disabled' );
	// 		});
	// 	},

	// 	attachEvents: function(){

	// 		jQuery(document).on( 'mouseenter', '#ls-addons-modal-window .ls--video', function(e){
	// 			$( this ).attr( 'loop', '' );
	// 			this.play();

	// 		}).on( 'mouseleave', '#ls-addons-modal-window ls-col:not(".kmw-active") .ls--video', function(e){
	// 			$( this ).removeAttr( 'loop' );
	// 			if( $( this ).is( '.ls--allowstop') ){
	// 				this.pause();
	// 			}

	// 		}).on('click', '#ls-addons-grid .kmw-menuitem', function(e) {
	// 			LS_Addons.openAddon( $( this ) );
	// 			$( '#ls-addons-grid .kmw-menuitem .ls--video' ).trigger( 'mouseleave' );
	// 		});

	// 	},

	// 	openModal: function(){

	// 		kmw.modal.open({
	// 			id: 'ls-addons-modal-window',
	// 			content: $('#ls-addons-modal-content'),
	// 			maxWidth: 1200,
	// 			overlaySettings: {
	// 				customClasses: 'ls--dark-overlay'
	// 			},
	// 			sidebar: {
	// 				right: {
	// 					title: ' ', // Important for having the kmw-sidebar-title element in place
	// 					width: 400,
	// 					content: $('#ls-addons-modal-sidebar')
	// 				}
	// 			},
	// 			onBeforeOpen: function() {

	// 				LS_Addons.$modal = jQuery('#ls-addons-modal-window');

	// 				if( ! LS_Addons.initialized ) {
	// 					LS_Addons.initialized = true;
	// 					LS_Addons.attachEvents();
	// 				}

	// 				LS_Addons.maintainSidebarTitle();
	// 			}
	// 		});
	// 	},

	// 	closeModal: function(){
	// 		kmw.modal.close();
	// 	},

	// 	maintainSidebarTitle: function() {

	// 		var $menuItems = $('#ls-addons-grid .kmw-menuitem'),
	// 			$activeItem = $menuItems.filter('.kmw-active');

	// 			if( $activeItem.length ) {
	// 				$activeItem.click();
	// 			 } else {
	// 				$menuItems.first().click();
	// 			 }
	// 	},

	// 	openAddon: function( $tab ) {

	// 		var title = $tab.find('.ls--title').text(),
	// 			$sidebarTitle = LS_Addons.$modal.find('.kmw-sidebar-title');
	// 			$sidebarTitle.text( title );
	// 	}
	// };

	// LS_Addons.init();



	// Import Sliders
	$('#ls-list-buttons').on('click', '#ls-import-button', function(e) {
		e.preventDefault();

		kmw.modal.open({
			content: $('#tmpl-upload-sliders').text(),
			minWidth: 400,
			maxWidth: 700
		});

	});

	// Pagivation
	$('.pagination-links a.disabled').click(function(e) {
		e.preventDefault();
	});



	// Drag and drop import
	var importTileDropZone;
	$( document ).on('dragenter.ls', '.ls-item.import-sliders', function( e ) {
		e.preventDefault();
		importTileDropZone = e.target;
		$( this ).addClass('ls-dragover')

	}).on('dragleave.ls drop.ls', '.ls-item.import-sliders', function( e ) {
		e.preventDefault();
		if( e.target == importTileDropZone ) {
			$( this ).removeClass('ls-dragover')
		}

	}).on('dragover.ls', '.ls-item.import-sliders', function( e ) {
		e.preventDefault();

	}).on('drop.ls', '.ls-item.import-sliders', function( event ) {

		var oe 		= event.originalEvent,
			files 	= event.originalEvent.dataTransfer.files,
			$this 	= $( this ),
			$form 	= $('#tmpl-quick-import-form');


		// Prevent uploading empty or multiple file selection
		if( files.length === 0 ||  files.length > 1 ) {
			return false;
		}

		// Prevent uploading files other than ZIP packages
		if( files[0].name.toLowerCase().indexOf('.zip') === -1 ) {
			return false;
		}


		if( ! $form.length ) {
			$form = $( $('#tmpl-quick-import').text() ).prependTo('body');
		}

		$this.addClass('importing');

		$form.find('input[type="file"]')[0].files = files;
		$form.submit();
	});

	// Import window file input
	$( document ).on( 'change', '#ls-upload-modal-window .ls-form-file input', function() {

		var file = this.files[0],
			$input = $(this),
			$parent = $input.parent(),
			$span = $input.prev();

		if( !$input.data( 'original-text' ) ){
			$input.data( 'original-text', $span.text() );
		}

		if( file ) {
			$span.text( file.name );
			$parent.addClass( 'file-chosen' );
		} else {
			$span.text( $input.data( 'original-text' ) );
			$parent.removeClass( 'file-chosen' );
		}
	});




	// Import sample slider
	$( '#ls-browse-templates-button' ).on( 'click', function( event ) {

		event.preventDefault();

		var	$modal;

		// If the Template Store was previously opened on the current page,
		// just grab the element, do not bother re-appending and setting
		// up events, etc.

		// Append dark overlay
		if( !jQuery( '#ls-import-modal-overlay' ).length ){
			jQuery( '<div id="ls-import-modal-overlay">' ).appendTo( '#wpwrap' );
		}

		if( jQuery( '#ls-import-modal-window' ).length ){

			$modal = jQuery( '#ls-import-modal-window' );

		// First time open on the current page. Set up the UI and others.
		} else {

			// Append the template & setup the live logo
			$modal = jQuery( jQuery('#tmpl-import-sliders').text() ).hide().prependTo('body');

			// Update last store view date
			if( $modal.hasClass('has-updates') ) {
				jQuery.get( window.ajaxurl, { action: 'ls_store_opened' });
			}

			importModalWindowTimeline = new TimelineMax({
				onStart: function(){
					jQuery( '#ls-import-modal-overlay' ).show();
					jQuery( 'html, body' ).addClass( 'ls-no-overflow' );
					jQuery(document).on( 'keyup.LS', function( e ) {
						if( e.keyCode === 27 ){
							jQuery( '#ls-browse-templates-button' ).data( 'lsModalTimeline' ).reverse().timeScale(1.5);
						}
					});
				},
				onComplete: function(){
					if( importModalWindowTimeline ) {
						importModalWindowTimeline.remove( importModalThumbnailsTransition );
					}
					featuredSlideshow.start();

				},
				onReverseComplete: function(){
					featuredSlideshow.stop();
					jQuery( 'html, body' ).removeClass( 'ls-no-overflow' );
					jQuery(document).off( 'keyup.LS' );
					jQuery( '#ls-import-modal-overlay' ).hide();
					TweenMax.set( jQuery( '#ls-import-modal-window' )[0], { css: { y: -100000 } });
				},
				paused: true
			});

			$(this).data( 'lsModalTimeline', importModalWindowTimeline );

			importModalWindowTimeline.fromTo( $('#ls-import-modal-overlay')[0], 0.75, {
				autoCSS: false,
				css: {
					opacity: 0
				}
			},{
				autoCSS: false,
				css: {
					opacity: 0.75
				},
				ease: Quart.easeInOut
			}, 0 );

			importModalThumbnailsTransition = TweenMax.fromTo( $( '#ls-import-modal-window ls-templates-container.ls--active' )[0], 0.5, {
				autoCSS: false,
				css: {
					opacity: 0
				}
			},{
				autoCSS: false,
				css: {
					opacity: 1
				},
				ease: Quart.easeInOut
			});

			importModalWindowTimeline.add( importModalThumbnailsTransition, 0.75 );
		}

		importModalWindowTimeline.remove( importModalWindowTransition );

		importModalWindowTransition = TweenMax.fromTo( $modal[0], 0.75, {
			autoCSS: false,
			css: {
				position: 'fixed',
				display: 'block',
				y: 0,
				x: jQuery( window ).width()
			}
		},{
			autoCSS: false,
			css: {
				x: 0
			},
			ease: Quart.easeInOut
		}, 0 );

		importModalWindowTimeline.add( importModalWindowTransition, 0 );

		importModalWindowTimeline.play();
	});


	$( document ).on( 'click', '#ls-import-modal-window .ls--close-templates', function(){
		$( '#ls-browse-templates-button' ).data( 'lsModalTimeline' ).reverse();

	}).on('submit', '#ls-upload-modal-window form', function(e) {

		jQuery('.button', this).text(LS_l10n.SLUploadProject).addClass('saving');

	}).on('click', '.ls-open-add-new-slider', function(e) {

		e.preventDefault();

		kmw.modal.close();

		$('#ls-add-slider-button').click();

	}).on('click', '.ls-open-template-store', function(e) {

		e.preventDefault();

		kmw.modal.close();

		setTimeout(function() {
			$('#ls-browse-templates-button').click();
		}, $(this).data('delay') || 0);
	});

	$('#ls--release-channel select').change( function() {

	var $select = $( this ),
		$form 	= $select.closest('form');


		$.getJSON( ajaxurl, $form.serialize(), function( data ) {

			kmUI.notify.show({
				icon: 'success',
				text: LS_l10n.releaseChannelUpdated,
				timeout: 2000
			});
		});
	});

	// Template Store: Category selector
	$( document ).on( 'click', '#ls-import-modal-window [data-show-category]', function() {
		var $el = $( this );
		changeCategory( $( this ).attr('data-show-category') );

		if( $el.attr( 'data-show-tag') ){
			$( '#ls-import-modal-window ls-templates-container.ls--active ls-tag[data-handle="'+ $el.attr( 'data-show-tag') +'"]' ).click();
		}
	});

	var changeCategory = function( category ){
		$( '#ls-import-modal-window ls-templates-nav [data-show-category]' ).removeClass('ls--active');
		$( '#ls-import-modal-window ls-templates-nav [data-show-category="'+category+'"]' ).addClass( 'ls--active' );

		$( '#ls-import-modal-window ls-templates-container' ).removeClass( 'ls--active' );
		$( '#ls-import-modal-window ls-templates-container[data-category="'+category+'"]' ).addClass( 'ls--active' );

		$( 'ls-templates-containers' ).scrollTop(0);
	};

	// Template Store: Collections
	$( document ).on( 'click', '#ls-import-modal-window [data-show-category="collections"]', function(e){
		e.preventDefault();
		if( !$('#ls--collection-templates').children().length ){
			$( 'ls-templates-holder.ls--collections-list ls-template.ls--active' ).click();
		}
	}).on( 'click', '#ls-import-modal-window [data-show-collection]', function(e){
		e.preventDefault();
		changeCategory( 'collections' );
		$( 'ls-templates-holder.ls--collections-list ls-template[data-handle="'+$(this).attr('data-show-collection')+'"]' ).click();
	}).on( 'click', '#ls-import-modal-window ls-templates-holder.ls--collections-list ls-template', function(){
		var $activeCollectionSelector = $( this );
		$activeCollectionSelector.addClass( 'ls--active' ).siblings().removeClass( 'ls--active' );
		getCollectionItems( $activeCollectionSelector.attr( 'data-handle'), $activeCollectionSelector.attr( 'data-name' ) );
	});

	// Template Store: Tags
	$( document ).on( 'click', '#ls-import-modal-window ls-tag', function() {

		var $curTag = $(this),
			handle = $curTag.attr( 'data-handle' ),
			$templatesContainer = $curTag.closest( 'ls-templates-container' ),
			$templatesHolder = $templatesContainer.find( 'ls-templates-holder' ),
			$allTemplates = $templatesHolder.find( 'ls-template' ),
			$filteredTemplates = $templatesHolder.find( 'ls-template[data-groups*="'+handle+'"]' ),
			$allButFilteredTemplates = $templatesHolder.find( 'ls-template:not([data-groups*="'+handle+'"])' ),
			$descHolder = $templatesContainer.find( 'ls-tag-descriptions-holder' ),
			$allDesc = $descHolder.find('ls-tag-description');

			$( 'ls-templates-containers' ).scrollTop(0);

			$allDesc.hide();
			$allDesc.filter('[data-handle="' + handle + '"]').css('display','flex');

			$curTag.addClass('ls--active').siblings().removeClass('ls--active');
			$allTemplates.show();
			if( handle === '' || handle === 'all' ){
				return;
			}
			$allButFilteredTemplates.hide();
	});

	var getCollectionItems = function( handle, name ){

		$( '#ls--collection-templates' ).empty();
		$( '.ls-template-collections-target ls-template[data-collections*="' + handle + '"]' )
			.clone()
			.show()
			.sort( ( a, b ) => {
				return parseInt( b.dataset.order ) - parseInt( a.dataset.order );
			})
			.appendTo( '#ls--collection-templates' );
		$( '#ls--collection-title ls-ib span').text( name );
	};

	// Template Store: Featured
	$( document ).on( 'click', '#ls-import-modal-window ls-featured-bullet', function( event ) {
		var index = $( this ).index( '#ls-import-modal-window ls-templates-featured ls-featured-bullet' );
		featuredSlideshow.change( index, event );
	});

	var featuredSlideshow = {

		timer: 60,
		interval: 0,

		start: function(){

			this.itemsNum = $( '#ls-import-modal-window ls-templates-featured ls-featured-bullet' ).length;

			if( this.itemsNum > 1 ){
				this.currentIndex = 0;
				this.timer = parseInt( $( '#ls-import-modal-window ls-templates-featured' ).attr( 'data-slideshow-interval' ) ) || this.timer;

				this.startInterval();
			}
		},

		startInterval: function() {

			clearInterval( this.interval );
			this.interval = setInterval( () => {
				this.change();
			}, this.timer * 1000 );
		},

		stop: function(){
			clearInterval( this.interval );
		},

		change: function( index, event ){

			if( typeof index !== 'undefined' ) {
				this.currentIndex = index;
			} else {

				if( this.currentIndex + 1 >= this.itemsNum ){
					this.currentIndex = 0;
				}else{
					this.currentIndex++;
				}
			}

			var $bullet = $('#ls-import-modal-window ls-templates-featured ls-featured-bullet').eq( this.currentIndex );

			$bullet.addClass('ls--active').siblings( 'ls-featured-bullet' ).removeClass( 'ls--active' );
			$( '#ls-import-modal-window ls-templates-featured ls-featured-item' ).eq( this.currentIndex ).addClass( 'ls--active' ).siblings( 'ls-featured-item' ).removeClass( 'ls--active' );

			if( typeof event !== 'undefined' ) {
				featuredSlideshow.startInterval();
			}
		}
	};



	// Auto-update and License registration
	$('#ls--box-license form').submit(function(e) {

		// Prevent browser default submission
		e.preventDefault();

		var $form 	= $(this),
			$key 	= $form.find('input[name="purchase_code"]'),
			$button = $form.find('.button-save:visible');

		if( $key.val().length < 10 ) {
			lsCommon.smartAlert.open( LS_l10n.SLEnterCode );
			return false;
		}

		// Send request and provide feedback message
		$button.data('text', $button.text() ).text(LS_l10n.working);

		// Post it
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: $(this).serialize(),
			error: function( jqXHR, textStatus, errorThrown ) {
				lsCommon.smartAlert.open({
					width: 700,
					theme: 'red',
					title: LS_l10n.SLActivationErrorTitle,
					text: LS_l10n.SLActivationError.replace('%s', errorThrown)
				});
				$button.removeClass('saving').text( $button.data('text') );
			},
			success: function( data ) {

				// Parse response and set message
				data = $.parseJSON(data);

				// Success
				if( data && ! data.errCode ) {

					// Updated license, was already registered
					if( LS_slidersMeta.isActivatedSite ) {

						kmUI.notify.show({
							icon: 'success',
							text: LS_l10n.licenseKeyUpdated,
							timeout: 2000
						});
					}

					// Make sure that features requiring activation will
					// work without refreshing the page.
					LS_slidersMeta.isActivatedSite = true;

					// Update GUI to reflect the "registered" state
					$( '#ls--license-slider' ).layerSlider( 2 );
					LS__setRegistered( true );

				// HTML-based error message (if any)
				} else if( typeof data.messageHTML !== "undefined" ) {

					kmw.modal.open({
						title: data.titleHTML ? data.titleHTML : LS_l10n.activationErrorTitle,
						content: '<div id="tmpl-activation-error-modal-window">'+data.messageHTML+'</div>',
						maxWidth: 660,
						minWidth: 400
					});

				// Alert message (if any)
				} else if( typeof data.message !== "undefined" ) {
					lsCommon.smartAlert.open( data.message );
				}

				$button.removeClass('saving').text( $button.data('text') );
			}
		});
	});


	// Auto-update deauthorization
	$('#ls--box-license a.ls-deauthorize').click(function(event) {
		event.preventDefault();

		var $form = $(this).closest('form');

		$.get( ajaxurl, $.param({ action: 'ls_deauthorize_site' }), function(data) {

			// Parse response and set message
			var data = $.parseJSON(data);

			if( data && ! data.errCode ) {

				$form.find('.ls--key input').val('');

				LS_slidersMeta.isActivatedSite = false;


				// Update GUI to reflect the "registered" state
				$( '#ls--license-slider' ).layerSlider( 1 );
				LS__setRegistered( false );

				// Display notification modal window
				kmw.modal.open({
					content: '#tmpl-deregister-license',
					maxWidth: 560,
					minWidth: 560
				});
			}

			// Alert message (if any)
			if( typeof data.message !== "undefined" ) {
				lsCommon.smartAlert.open( data.message );
			}
		});
	});

	var lsShowActivationBox = function( activateBox ) {

		document.location.hash = '';

		kmw.modal.close();

		var $box = $('#ls--box-license');


		if( ! $box.length || $box.is(':hidden') ) {
			kmw.modal.open({
				content: '#tmpl-activation-unavailable',
				maxWidth: 600
			});

			return false;
		}

		scrollToElement( $('#ls--box-license') );
	};

	$( document ).on('click', '.ls-show-activation-box', function(e) {
		e.preventDefault();
		lsShowActivationBox();
	}).on('click', '.ls-premium-lock-templates', function( e ) {
		e.preventDefault();
		lsDisplayActivationWindow({
			title: LS_l10n.notifyPremiumTemplateMT
		});
	});

	$( document ).on('click', '#lse-activation-modal-window .lse-button-activation', function( e ) {

		e.preventDefault();

		if( $(this).closest('#ls-import-modal-window').length ) {

			jQuery(document).trigger( jQuery.Event('keyup', { keyCode: 27 }) );
			setTimeout(function() {
				lsShowActivationBox( true );
			}, 800);

		} else {

			kmw.modal.close( false, {
				onClose: function() {
					lsShowActivationBox( true );
				}
			});
		}
	});

	if( document.location.href.indexOf('#activationBox') !== -1 ) {
		setTimeout(function() {
			lsShowActivationBox( true );
		}, 500 );
	}


	// Shortcode
	$('input.ls-shortcode').click(function() {
		this.focus();
		this.select();
	});

	// Template Store Import
	$( document ).on('click', '#ls-import-modal-window .ls--import-template-button', function( event ) {
		event.preventDefault();

		var $item 		= jQuery(this),
			name 		= $item.data('name'),
			handle 		= $item.data('handle'),
			category 	= $item.data('category'),
			bundled 	= !! $item.data('bundled'),
			action 		= bundled ? 'ls_import_bundled' : 'ls_import_online';


		// Premium notice
		if( $item.data('premium') && ! LS_slidersMeta.isActivatedSite ) {

			lsDisplayActivationWindow({
				into: '#ls-import-modal-window',
				title: LS_l10n.activationTemplate
			});

			return;

		// Version warning
		} else if( $item.data('version-warning') ) {

			kmw.modal.open({
				into: '#ls-import-modal-window',
				content: '#tmpl-version-warning',
				id: 'ls-version-warning',
				minWidth: 500,
				maxWidth: 500
			});
			return;
		}

		kmw.modal.open({
			content: '#tmpl-importing',
			into: '#ls-import-modal-window',
			minWidth: 300,
			maxWidth: 300,
			closeButton: false,
			closeOnEscape: false,
			animationIn: 'scale',
			overlaySettings: {
				closeOnClick: false,
				animationIn: 'fade'
			}
		});

		jQuery.ajax({
			url: ajaxurl,
			data: {
				action: action,
				slider: handle,
				name: name,
				category: category,
				security: window.lsImportNonce
			},

			beforeSend: function( jqXHR, settings ) {

				setTimeout( function( ) {

					var $modal = jQuery('#ls-loading-modal-window').closest('.kmw-modal');

					TweenLite.to( $modal[0], 0.5, {
						minWidth: 580,
						maxWidth: 580,
						height: 446,
						maxHeight: 480,

						onComplete: function() {
							$('<div class="ls-import-notice">'+LS_l10n.SLImportNotice+'</div>')
							.hide()
							.appendTo( $modal.find('.kmw-modal-content') )
							.fadeIn( 250 );
						}
					});
				}, 1000*60 );
			},

			success: function(data, textStatus, jqXHR) {

				data = data ? JSON.parse( data ) : {};

				if( data.success ) {

					if( LS_importQueue && LS_importQueue.length > 0 ) {
						kmw.modal.close();
						lsDownloadNextTemplate();
						return;

					} else {
						document.location.href = data.url;
					}

				} else {

					kmw.modal.close();

					if( data.reload ) {
						if( LS_importQueue && LS_importQueue.length > 0 ) {
							lsDownloadNextTemplate();

						} else {
							window.location.reload( true );
						}

						return;
					}

					if( data.errCode && data.errCode == 'ERR_WW_POPUPS_PURCHASE_NOT_FOUND') {

						lsDisplayActivationWindow({
							into: '#ls-import-modal-window',
							title: LS_l10n.purchaseWWPopups,
							content: '#tmpl-purchase-webshopworks-popups',
							minHeight: 680,
							maxHeight: 680
						});

						return;
					}

					setTimeout(function() {

						lsCommon.smartAlert.open({
							theme: 'red',
							width: 700,
							title: data.title || LS_l10n.SLImportErrorTitle,
							text: data.message || LS_l10n.SLImportError,
						});

					}, 600);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {

				kmw.modal.close();

				setTimeout(function() {

					lsCommon.smartAlert.open({
						width: 700,
						theme: 'red',
						title: LS_l10n.SLImportErrorTitle,
						text: LS_l10n.SLImportHTTPError.replace('%s', errorThrown)
					});

				}, 600);
			},
			complete: function() {

			}
		});
	});

	if( document.location.hash === '#open-template-store' ) {
		setTimeout( function() {
			$('#ls-browse-templates-button').click();
		}, 500);


	} else if( document.location.hash === '#open-addons' ) {
		setTimeout( function() {
			$('#ls-addons-button').click();
		}, 500);
	}



	var addSliderToGroupDraggable = function() {

		$('.ls-sliders-grid > .slider-item').draggable({
			scope: 'add-to-group',
			cancel: '.group-item, .ls-hero',
			handle: '.ls-preview',
			distance: 5,
			helper: 'clone',
			revert: 'invalid',
			revertDuration: 300,
			start: function( event, ui ) {

				draggedSliderItem = event.target;
				$( draggedSliderItem ).addClass('dragging-original');
			},

			stop: function( event, ui ) {
				$( event.target ).removeClass('dragging-original');
			}
		});
	};


	var addSliderToGroupDroppable = function() {

		$('.ls-sliders-grid .group-item').droppable({
			scope: 'add-to-group',
			accept: '.slider-item',
			tolerance: 'pointer',
			hoverClass: 'slider-dropping',
			over: function( event, ui ) {

				ui.helper.find('.ls-preview').addClass('slider-dropping');
			},

			out: function( event, ui ) {
				ui.helper.find('.ls-preview').removeClass('slider-dropping');
			},


			drop: function( event, ui ) {

				addSliderToGroup( event.target, draggedSliderItem );
			}
		});
	};



	var removeSliderFromGroupDraggable = function() {

		$('.ls-sliders-grid .kmw-modal-inner .slider-item').draggable({
			scope: 'remove-from-group',
			handle: '.ls-preview',
			appendTo: '.ls-sliders-grid',
			distance: 5,
			helper: 'clone',
			zIndex: 9999999,
			revert: 'invalid',
			revertDuration: 300,
			start: function( event, ui ) {
				draggedSliderItem = event.target;
				$( draggedSliderItem ).addClass('dragging-original');
				$('#ls-group-remove-area').addClass('active');
			},

			stop: function( event, ui ) {
				$( draggedSliderItem ).removeClass('dragging-original');
				$('#ls-group-remove-area').removeClass('active');
			}
		});
	};


	var removeSliderFromGroupDroppable = function() {

		$('#ls-group-remove-area .ls-drop-area').droppable({
			scope: 'remove-from-group',
			accept: '.slider-item',
			tolerance: 'pointer',

			over: function( event, ui ) {
				ui.draggable.addClass('over-drag-area');
				ui.helper.find('.ls-preview').addClass('cursor-default');
				$( event.target ).addClass('over');
			},

			out: function( event, ui ) {
				ui.draggable.removeClass('over-drag-area');
				ui.helper.find('.ls-preview').removeClass('cursor-default');
				$( event.target ).removeClass('over');
			},

			drop: function( event, ui ) {

				$( event.target ).removeClass('over');
				ui.draggable.removeClass('over-drag-area');

				removeSliderFromGroup(
					$lastOpenedGroup,
					ui.draggable
				);
			}
		});
	};



	var createSliderGroupLastEvent;

	var createSliderGroupDroppable = function() {

		$('.ls-sliders-grid .slider-item:not(.ls-hero,.group-item)').droppable({
			scope: 'add-to-group',
			accept: '.slider-item',
			tolerance: 'pointer',
			hoverClass: 'slider-dropping',

			over: function( event, ui ) {

				var f = function(){
					targetSliderItem = event.target;
					$( event.target ).addClass('create-group');
					ui.helper.find('.ls-preview').addClass('slider-dropping');
					createSliderGroupLastEvent = 'over';
				};

				if( createSliderGroupLastEvent == 'over' ){
					setTimeout( function(){
						f();
					}, 0 );
				} else {
					f();
				}
			},

			out: function( event, ui ) {

				var f = function(){
					targetSliderItem = null;
					$('.slider-item').removeClass('create-group');
					ui.helper.find('.ls-preview').removeClass('slider-dropping');
					createSliderGroupLastEvent = 'out';
				};

				if( createSliderGroupLastEvent == 'out' ){

					setTimeout( function(){
						f();
					}, 0 );
				} else {
					f();
				}
			},

			deactivate: function( event, ui ) {
				clearTimeout( sliderDragGroupingTimeout );
				$('.slider-item').removeClass('create-group');
				ui.helper.find('.ls-preview').removeClass('slider-dropping');
			},

			drop: function( event, ui ) {

				if( targetSliderItem ) {

					var $template 	= $( $('#tmpl-slider-group-item').text() ),
						$markup 	= $template.insertAfter( targetSliderItem ),
						$group 		= $markup.filter('.group-item');

					addSliderToGroup( $group, targetSliderItem, true );
					addSliderToGroup( $group, draggedSliderItem, true );

					$( targetSliderItem ).hide();
					$( draggedSliderItem ).hide();

					addSliderToGroupDroppable();

					$.getJSON( ajaxurl, {
						action: 'ls_create_slider_group',
						nonce: LS_pageMeta.dashboardNonce,
						items: [
							$( targetSliderItem ).data('id'),
							$( draggedSliderItem ).data('id')
						]

					}, function( data ) {

						if( data.success && data.groupId ) {
							$group.data('id', data.groupId );
						}
					});
				}
			}
		});
	};






	var addSliderToGroup = function( groupElement, sliderElement, withoutXHR ) {

		var $group 			= $( groupElement ),
			$groupItems 	= $group.find('.ls-items'),
			$slider 		= $( sliderElement ),
			$sliderPreview 	= $slider.find('.ls-preview'),
			$groupItem 		= $( $('#tmpl-slider-group-placeholder').text() );

		// XHR request to add slider to group
		if( ! withoutXHR ) {
			$.get( ajaxurl, {
				action: 'ls_add_slider_to_group',
				nonce: LS_pageMeta.dashboardNonce,
				sliderId: $slider.data('id'),
				groupId: $group.data('id')
			});
		}


		// Add slider to group on UI
		if( ! $sliderPreview.find('.no-preview').length ) {
			$groupItem.find('.ls-preview').css('background-image', $sliderPreview.css('background-image') );
			$groupItem.find('.ls-preview').empty();
		}

		// Destroy previous draggable instance (if any)
		if( $slider.hasClass('ui-draggable') ) {
			$slider.draggable('destroy');
		}

		// Destroy previous droppable instance (if any)
		if( $slider.hasClass('ui-droppable') ) {
			$slider.droppable('destroy');
		}

		$slider.clone( true, true )
			.removeClass('dragging-original')
			.removeClass('create-group')
			.appendTo( $group.next().children() );

		$groupItem.appendTo( $groupItems );
		setTimeout( function() {
			$groupItem.removeClass('ls-scale0');
		}, 100 );

		// Remove the original element
		$slider.remove();
	};



	var removeSliderFromGroup = function( groupElement, sliderElement, withoutXHR ) {

		var $group 			= $( groupElement ),
			$groupItems 	= $group.find('.ls-items'),
			$slider 		= $( sliderElement ),
			$sliderPreview 	= $slider.find('.ls-preview'),
			$siblings 		= $slider.siblings();

		// XHR request to add slider to group
		if( ! withoutXHR ) {
			$.get( ajaxurl, {
				action: 'ls_remove_slider_from_group',
				nonce: LS_pageMeta.dashboardNonce,
				sliderId: $slider.data('id'),
				groupId: $group.data('id')
			});
		}

		// Remove from preview items
		$groupItems.children().eq( $slider.index() ).remove();

		// Destroy previous draggable instance (if any)
		if( $slider.hasClass('ui-draggable') ) {
			$slider.draggable('destroy');
		}

		// Destroy previous droppable instance (if any)
		if( $slider.hasClass('ui-droppable') ) {
			$slider.droppable('destroy');
		}

		// Remove slider from group
		$slider.prependTo('.ls-sliders-grid');

		setTimeout( function() {
			addSliderToGroupDraggable();
			addSliderToGroupDroppable();

			createSliderGroupDroppable();
		}, 300 );


		// Handle auto-group deletion in case of removing
		// the last element.
		if( $siblings.length < 1 ) {

			$group.next().remove();
			$group.remove();

			kmw.modal.close();
		}
	};


	$('#ls-slider-selection-bar').on('click', 'ls-button', function( event ) {
		event.preventDefault();
		performSliderAction( $( this ).data('action') );
	});

	$( document ).on('click', '.ls-sliders-list-context-menu li', function( event ) {
		event.preventDefault();
		performSliderAction( $( this ).data('action'), {
			sliderItem: LS_contextMenuSliderItem,
			selectSliderItem: true
		});
	});



	var checkSliderSelection = function() {

		$selected = $('.ls-slider-list-items :checkbox:checked' );

		if( $selected.length ) {
			$('.ls-sliders-grid').addClass('ls-has-selection');
			$('body').addClass('ls-has-slider-selection');

			if( $selected.length > 1 ) {
				$('body').addClass('ls-has-multiple-slider-selection');
			} else {
				$('body').removeClass('ls-has-multiple-slider-selection');
			}

			if( $selected.closest('.slider-item.ls-dimmed').length ) {
				$('body').addClass('ls-has-hidden-slider-selection');
			} else {
				$('body').removeClass('ls-has-hidden-slider-selection');
			}


			if( $selected.closest('.slider-item:not(.ls-dimmed)').length ) {
				$('body').addClass('ls-has-published-slider-selection');
			} else {
				$('body').removeClass('ls-has-published-slider-selection');
			}


		} else {
			$('.ls-sliders-grid').removeClass('ls-has-selection');
			$('body').removeClass('ls-has-slider-selection ls-has-multiple-slider-selection ls-has-hidden-slider-selection ls-has-published-slider-selection');
		}
	};

	checkSliderSelection();


	var startSliderSelection = function() {

	};

	var stopSliderSelection = function() {

	};

	var performSliderAction = function( action, actionProperties ) {

		actionProperties = actionProperties || {};

		var $form 			= $('.ls-slider-list-form'),
			$bulkSelect 	= $('.ls-bulk-actions select[name="action"]'),
			$sliderItem		= $('.slider-item.ls-selected'),
			sliderName 		= '';

		if( actionProperties.sliderItem ) {
			$sliderItem = $( actionProperties.sliderItem );
		}

		if( actionProperties.selectSliderItem ) {
			$sliderItem.find('.slider-checkbox').prop('checked', true );
		}

		sliderName = $sliderItem.find('input.ls--project-name-input').val();

		switch( action ) {

			case 'cancel':
				$('.slider-item :checkbox').prop('checked', false);
				$('.slider-item.ls-selected' ).removeClass('ls-selected');
				checkSliderSelection();
				break;

			case 'embed':
				showSliderEmbedModal(
					$sliderItem.data('id'),
					$sliderItem.data('slug')
				);
				break;

			case 'export':
				$bulkSelect.val('export');
				$form.submit();
				break;

			case 'export-html':
				if( exportSliderAsHTML() ) {
					$bulkSelect.val('export-html');
					$form.submit();
				}
				break;

			case 'duplicate':
				$bulkSelect.val('duplicate');
				$form.submit();
				break;

			case 'revisions':
				document.location.href = $sliderItem.data('revisions');
				break;

			case 'hide':

				lsCommon.smartAlert.open({
					type: 'confirm',
					width: 650,
					title: $sliderItem.length > 1 ? LS_l10n.SLHideProjectsTitle : LS_l10n.SLHideProjectTitle.replace( '%s', sliderName ),
					text: $sliderItem.length > 1 ? LS_l10n.SLHideProjectsText : LS_l10n.SLHideProjectText,
					buttons: {
						ok: {
							label: $sliderItem.length > 1 ? LS_l10n.SLHideProjectsButton : LS_l10n.SLHideProjectButton
						}
					},
					onConfirm: () => {

						if( actionProperties.selectSliderItem ) {
							$sliderItem.find('.slider-checkbox').prop('checked', true );
						}

						$bulkSelect.val('hide');
						$form.submit();

						if( actionProperties.selectSliderItem ) {
							$sliderItem.find('.slider-checkbox').prop('checked', false );
						}
					}
				});
				break;

			case 'unhide':
				$bulkSelect.val('restore');
				$form.submit();
				break;

			case 'group':
				$bulkSelect.val('group');
				$form.submit();
				break;

			case 'merge':
				$bulkSelect.val('merge');
				$form.submit();
				break;

			case 'delete':
				lsCommon.smartAlert.open({
					type: 'confirm',
					width: 650,
					theme: 'red',
					title: $sliderItem.length > 1 ? LS_l10n.SLDeleteProjectsTitle : LS_l10n.SLDeleteProjectTitle.replace( '%s', sliderName ),
					text: $sliderItem.length > 1 ? LS_l10n.SLDeleteProjectsText : LS_l10n.SLDeleteProjectText,
					textAlign: 'center',
					buttons: {
						ok: {
							label: $sliderItem.length > 1 ? LS_l10n.SLDeleteProjectsButton : LS_l10n.SLDeleteProjectButton
						}
					},
					onConfirm: () => {

						if( actionProperties.selectSliderItem ) {
							$sliderItem.find('.slider-checkbox').prop('checked', true );
						}

						$bulkSelect.val('delete');
						$form.submit();

						if( actionProperties.selectSliderItem ) {
							$sliderItem.find('.slider-checkbox').prop('checked', false );
						}
					}
				});
				break;
		}

		if( actionProperties.selectSliderItem ) {
			$sliderItem.find('.slider-checkbox').prop('checked', false );
		}
	};

	var showSliderEmbedModal = function( sliderId, sliderSlug ) {

		var $modal 	= kmw.modal.open({
			content: jQuery('#tmpl-embed-project'),
			minWidth: 400,
			maxWidth: 980,
			sidebar: {
				left: {
					width: 300,
					content: jQuery('#tmpl-embed-project-sidebar')
				}
			}
		});

		$modal.find('input.lse-shortcode').val('[layerslider id="'+(sliderSlug || sliderId)+'"]');

	};


	var exportSliderAsHTML = function() {

		if( ! LS_slidersMeta.isActivatedSite ) {
			lsDisplayActivationWindow();
			return false;
		}



		if( window.localStorage ) {

			if( ! localStorage.lsExportHTMLWarning ) {
				localStorage.lsExportHTMLWarning = 0;
			}

			var counter = parseInt( localStorage.lsExportHTMLWarning ) || 0;

			if( counter < 3 ) {

				localStorage.lsExportHTMLWarning = ++counter;

				if( ! confirm( LS_l10n.SLExportProjectHTML ) ) {
					return false;
				}
			}
		}

		return true;
	};

	var scrollToElement = function( target, callback ) {

		if( ! target ) {
			return;
		}

		var $target = $( target );

		if( $target.length ) {
			$('html,body')
				.stop( true, true )
				.animate({
					scrollTop: $target.offset().top - 50
				}, 500, function() {
					if( callback ) {
						callback();
					}
				});
		}
	};

	var saveGoogleFonts = function() {

		var data = {
			action: 'ls_save_google_fonts',
			_wpnonce: $('#ls-global-google-fonts-nonce').text(),
			fonts: []
		};

		$('#ls-global-google-fonts .ls-font-name').each( function() {
			data.fonts.push( $( this ).text() );
		});

		$.post( ajaxurl, data );
	};


	// Group draggable & droppable
	addSliderToGroupDraggable();
	addSliderToGroupDroppable();

	createSliderGroupDroppable();

	removeSliderFromGroupDraggable();
	removeSliderFromGroupDroppable();

	var LS__setRegistered = function( registered){
		if( registered ){
			$('#ls--admin-boxes, #ls--projects-list').removeClass('ls--not-registered').addClass('ls--registered');
		}else{
			$('#ls--admin-boxes, #ls--projects-list').removeClass('ls--registered').addClass('ls--not-registered');
		}

	};

	// Initialize sliders on the main admin page
	$( '#ls--license-slider' ).layerSlider({
		createdWith: '6.11.5',
		sliderVersion: '6.11.5',
		allowFullscreen: false,
		firstSlide: LS_slidersMeta.isActivatedSite ? 2 : 1,
		autoStart: false,
		startInViewport: true,
		keybNav: false,
		touchNav: false,
		skin: 'noskin',
		navPrevNext: false,
		hoverPrevNext: false,
		navStartStop: false,
		navButtons: false,
		showCircleTimer: false,
		useSrcset: false,
		skinsPath: LS_pageMeta.skinsPath
	});
});

var lsDownloadAllTemplates = function() {

	lsCommon.smartAlert.confirm( 'Import all templates? This will take a long time.', () => {

		LS_importQueue = [];
		jQuery('#ls-browse-templates-button').click();

		setTimeout( () => {

			jQuery('ls-templates-container').filter('[data-category="sliders"],[data-category="kreatura-popups"],[data-category="webshopworks-popups"]').find('ls-template').each( function() {

				LS_importQueue.push({
					isPending: true,
					element: this
				});
			});

			lsDownloadNextTemplate();
		}, 2000 );
	});
};

var lsDownloadNextTemplate = function() {

	// Exit early if the queue is empty
	if( ! LS_importQueue || ! LS_importQueue.length ) {
		return;
	}

	var template, templateIndex;

	// Find the next unprocessed item from the queue
	for( var c = 0; c < LS_importQueue.length; c++ ) {
		if( LS_importQueue[c].isPending ) {
			template = LS_importQueue[c];
			templateIndex = c;
			break;
		}
	}

	// Did not find unprocessed items, empty the queue and exit
	if( ! template ) {
		LS_importQueue = [];
		return;
	}

	// Otherwise, mark the item as processed
	template.isPending = false;

	// Gather template data
	var $item = jQuery( template.element ),
		projectName = $item.find('ls-template-name').text();

	// Start importing
	console.log('Downloading Template ('+(templateIndex+1)+'/'+(LS_importQueue.length)+'): ' + projectName );
	$item.find('.ls--import-template-button').click();
};