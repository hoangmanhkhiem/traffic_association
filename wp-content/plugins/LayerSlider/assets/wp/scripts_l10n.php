<?php

// Prevent direct file access
defined( 'LS_ROOT_FILE' ) || exit;

$l10n_ls = [

	'adminURL' 	=> admin_url( 'admin.php' ),

	// General
	'save' 			=> __('Save', 'LayerSlider'),
	'saving' 		=> __('Saving ...', 'LayerSlider'),
	'saved' 		=> __('Saved', 'LayerSlider'),
	'error' 		=> __('ERROR', 'LayerSlider'),
	'publish' 		=> __('Publish', 'LayerSlider'),
	'publishing'	=> __('Publishing ...', 'LayerSlider'),
	'published'		=> __('Published', 'LayerSlider'),
	'untitled' 		=> __('Untitled', 'LayerSlider'),
	'working' 		=> __('Working ...', 'LayerSlider'),
	'stop' 			=> __('Stop', 'LayerSlider'),

	'slideNoun' 	=> _x('Slide', 'noun', 'LayerSlider'),
	'slideVerb' 	=> _x('Slide', 'verb', 'LayerSlider'),
	'layer' 		=> __('Layer', 'Layer'),

	'selectAll' 	=> __('Select all', 'LayerSlider'),
	'deselectAll' 	=> __('Deselect all', 'LayerSlider'),

	'ok' 			=> _x('OK', 'Button label', 'LayerSlider'),
	'okUnderstand' 	=> _x('Okay, I understand', 'Button label', 'LayerSlider'),
	'cancel' 		=> _x('CANCEL', 'Button label', 'LayerSlider'),

	'small' 		=> _x('Small', 'Asset size', 'LayerSlider'),
	'medium' 		=> _x('Medium', 'Asset size', 'LayerSlider'),
	'large' 		=> _x('Large', 'Asset size', 'LayerSlider'),
	'extraLarge' 	=> _x('Extra Large', 'Asset size', 'LayerSlider'),
	'original' 		=> _x('Original', 'Asset size', 'LayerSlider'),
	'scalable_a' 	=> _x('Scalable (Auto Size)', 'Asset size', 'LayerSlider'),
	'scalable_o' 	=> _x('Scalable (Original Size)', 'Asset size', 'LayerSlider'),

	// Notifications
	'notifyProjectSaved' 			=> __('Project saved as draft', 'LayerSlider'),
	'notifyProjectPublished' 		=> __('Published & changes are now live', 'LayerSlider'),
	'notifyPresetSaved' 			=> __('Transition preset saved', 'LayerSlider'),
	'notifyCaptureSlide' 			=> __('Capturing slide. This might take a moment ...', 'LayerSlider'),
	'notifyPixieSave'				=> __('Saving image. This might take a moment ...'),
	'notifySettingsSaved' 			=> __('Settings saved'),
	'notifyGoogleFontsMissing' 		=> __('Some fonts might be missing since you disabled Google Fonts.', 'LayerSlider'),
	'notifyMissingPopup' 			=> __('This is a Popup project, which requires license registration to use.', 'LayerSlider'),
	'notifyMissingPopupMT' 			=> __('Register your LayerSlider license to use Popups.', 'LayerSlider'),
	'notifyMissingScene' 			=> __('This is a Sticky or Scroll Scene project, which requires license registration to use on front-end pages.', 'LayerSlider'),
	'notifyScrollSceneSlides' 		=> __('This is a Scroll Scene project, which will display and animate the first slide only.', 'LayerSlider'),
	'notifyMissingEndingTr' 		=> __('Missing Ending Transitions can lead to overlapping layers.', 'LayerSlider'),
	'confirmMissingEndingTrFix' 		=> sprintf(__('To avoid overlapping issues, %sEnding Transition%s will be enabled on layers missing both Ending Transition and Ending Text Transition. You should manually save the project after the changes have been applied.', 'LayerSlider'), '<b>', '</b>'),
	'confirmMissingEndingTrDismiss' 	=> __('Are you sure you want to dismiss this notification without fixing potential issues?', 'LayerSlider'),
	'notifyMissingEndingTrMore' 	=> __('Learn More', 'LayerSlider'),
	'notifyMissingEndingTrFix' 		=> __('Fix Problem', 'LayerSlider'),
	'notifyPremiumTemplate' 		=> __('This is a premium template or a project based on it, which requires license registration to use on front-end pages.', 'LayerSlider'),
	'notifyPremiumTemplateMT' 		=> __('Register your LayerSlider license to use premium templates.', 'LayerSlider'),

	// Modules
	'moduleDLErrorTitle' 	=> __('Download Error', 'LayerSlider'),
	'moduleDLImageEditor' 	=> __('Downloading Image Editor ...', 'LayerSlider'),
	'moduleDLIcons' 		=> __('Downloading Icons ...', 'LayerSlider'),
	'moduleDLAssets' 		=> __('Downloading Assets ...', 'LayerSlider'),

	'assetsDLErrorTitle' 	=> __('Download Error', 'LayerSlider'),
	'assetsDLAsset' 		=> __('Downloading Asset ...'),
	'assetsDLAssetFail' 	=> __('Download Failed. Retrying... (%1$s/%2$s)'),

	'assetsDefaultInspectorTitles' => [
		'objects' 	=> __('Object Details', 'LayerSlider'),
		'photos' 	=> __('Photo Details', 'LayerSlider'),
		'videos' 	=> __('Video Details', 'LayerSlider'),
		'other' 	=> __('Asset Details', 'LayerSlider')
	],

	'assetsSearchObjectsPH' => __('Search 9000+ objects', 'LayerSlider'),
	'assetsSearchPhotosPH' 	=> __('Search millions of royalty-free stock photos', 'LayerSlider'),
	'assetsSearchVideosPH' 	=> __('Search millions of royalty-free stock videos', 'LayerSlider'),
	'assetsAPIErrorTitle' 	=> __('Something went wrong', 'LayerSlider'),
	'assetsAPIErrorText' 	=> __('It seems the remote API is experiencing a temporary outage, and we couldn’t load the assets you’re looking for. Please try again in a few minutes.', 'LayerSlider'),
	'assetsServerErrorTitle'=> __('Something went wrong', 'LayerSlider'),
	'assetsServerErrorText' => sprintf(__('It seems there is a server issue that prevented LayerSlider from accessing the assets you’re looking for. Please check %sSystem Status%s for potential errors, try to temporarily disable themes/plugins to rule out incompatibility issues, or contact your hosting provider to resolve server configuration problems.', 'LayerSlider'), '<a href="'.admin_url( 'admin.php?page=layerslider&section=system-status' ).'" target="_blank">', '</a>'),
	'assetsDLServerErrorTitle'=> __('Something went wrong', 'LayerSlider'),
	'assetsDLServerErrorText' => sprintf(__('It seems there is a server issue that prevented LayerSlider from downloading the selected asset. Please check %sSystem Status%s for potential errors, try to temporarily disable themes/plugins to rule out incompatibility issues, or contact your hosting provider to resolve server configuration problems.', 'LayerSlider'), '<a href="'.admin_url( 'admin.php?page=layerslider&section=system-status' ).'" target="_blank">', '</a>'),


	// Activation
	'activationErrorTitle' 	=> __('Something went wrong ...', 'LayerSlider'),
	'licenseKeyUpdated' 	=> __('License key has been updated', 'LayerSlider'),
	'releaseChannelUpdated' => __('Release channel has been updated', 'LayerSlider'),
	'activationTemplate' 	=> __('License registration is required to access premium templates.', 'LayerSlider'),
	'activationFeature' 	=> __('License registration is required to access this feature.', 'LayerSlider'),
	'activationUpdate' 		=> __('License registration is required to receive automatic updates.', 'LayerSlider'),
	'activationGeneral' 	=> __('Unlock LayerSlider’s Full Potential', 'LayerSlider'),

	'purchaseWWPopups' 		=> __('Purchase This Popup Template Pack ', 'LayerSlider'),

	// Sliders list
	'SLDeleteProjectTitle' 			=> __('Are you sure you want to delete "%s"?', 'LayerSlider'),
	'SLDeleteProjectText' 			=> __('The project will be deleted immediately. You can’t undo this action.', 'LayerSlider'),
	'SLDeleteProjectButton' 		=> __('Delete Project', 'LayerSlider'),

	'SLDeleteProjectsTitle' 		=> __('Delete Selected Projects?', 'LayerSlider'),
	'SLDeleteProjectsText' 			=> __('The selected projects will be deleted immediately. You can’t undo this action.', 'LayerSlider'),
	'SLDeleteProjectsButton' 		=> __('Delete Projects', 'LayerSlider'),

	'SLHideProjectTitle' 			=> __('Are you sure you want to hide "%s"?', 'LayerSlider'),
	'SLHideProjectText' 			=> __('This will also hide it on front-end pages where it’s embedded. Hidden projects can be recovered at any time if you change your mind.', 'LayerSlider'),
	'SLHideProjectButton' 			=> __('Hide Project', 'LayerSlider'),

	'SLHideProjectsTitle' 			=> __('Hide Selected Projects?', 'LayerSlider'),
	'SLHideProjectsText' 			=> __('This will also hide the selected projects on front-end pages where they are embedded. Hidden projects can be recovered at any time if you change your mind.', 'LayerSlider'),
	'SLHideProjectsButton' 			=> __('Hide Projects', 'LayerSlider'),

	'SLExportProjectHTML' 		=> __("You’re about to export this project as HTML. This option is for the jQuery version of LayerSlider and you will *NOT* be able to use the downloaded package on WordPress sites. For that, you need to choose the regular export option. Are you sure you want to continue?\n\nThis message will be suppressed after a couple of attempts. Please mind the difference in the future between the various export methods to avoid potential harm and data loss.", 'LayerSlider'),
	'SLUploadProject' 			=> __('Uploading, please wait ...', 'LayerSlider'),
	'SLEnterCode' 				=> __('Please enter a valid license key. For more information, please click on the “registration guide” link below.', 'LayerSlider'),
	'SLDeactivate' 				=> __('Are you sure you want to deregister this license?', 'LayerSlider'),
	'SLPermissions' 			=> __('WARNING: This option controls who can access to this plugin, you can easily lock out yourself by accident. Please, make sure that you have entered a valid capability without whitespaces or other invalid characters. Do you want to proceed?', 'LayerSlider'),
	'SLJQueryReminder' 			=> __('Do not forget to disable this option later on if it does not help, or if you experience unexpected issues. This includes your entire site, not just LayerSlider.', 'LayerSlider'),

	'SLImportNotice' 	=> sprintf( __('Importing is taking longer than usual. This might be completely normal, but can also indicate a server configuration issue. Please visit %sSystem Status%s to check for potential causes if this screen is stuck.', 'LayerSlider'), '<a href="'.admin_url( 'admin.php?page=layerslider&section=system-status' ).'" target="_blank">', '</a>'),
	'SLImportErrorTitle' 	=> __('Import Error', 'LayerSlider'),
	'SLImportError' 	=> sprintf(__('It seems there is a server issue that prevented LayerSlider from importing your selected project. Please check %sSystem Status%s for potential errors, try to temporarily disable themes/plugins to rule out incompatibility issues or contact your hosting provider to resolve server configuration problems. Retrying the import might also help.', 'LayerSlider'), '<a href="'.admin_url( 'admin.php?page=layerslider&section=system-status' ).'" target="_blank">', '</a>'),
	'SLImportHTTPError' => sprintf(__('It seems there is a server issue that prevented LayerSlider from importing your selected project. Please check %sSystem Status%s for potential errors, try to temporarily disable themes/plugins to rule out incompatibility issues or contact your hosting provider to resolve server configuration problems. Retrying the import might also help. Your HTTP server thrown the following error: %%s', 'LayerSlider'), '<a href="'.admin_url( 'admin.php?page=layerslider&section=system-status' ).'" target="_blank">', '</a>'),
	'SLActivationErrorTitle' => __('Failed to Register Your License', 'LayerSlider'),
	'SLActivationError' => sprintf( __('It seems there is a server issue that prevented LayerSlider from performing license registration. Please check %sSystem Status%s for potential errors, try to temporarily disable themes/plugins to rule out incompatibility issues, or contact your hosting provider to resolve server configuration problems. Your HTTP server thrown the following error: %%s', 'LayerSlider'), '<a href="'.admin_url( 'admin.php?page=layerslider&section=system-status' ).'" target="_blank">', '</a>'),
	'SLRemoveGroupButton' => __('Clear & Remove Group', 'LayerSlider'),
	'SLRemoveGroupTooltip' => __('Moves all projects out of this group, then deletes it. All of your projects will remain available on the main grid.', 'LayerSlider'),
	'SLRemoveGroupConfirm' => __("You’re about to remove this group. All your projects will be moved and remain available on the main grid. \n\nContinue?", 'LayerSlider'),
	'SLScrollTransitionPreviewWarning' => __('Use Project Preview to see scroll transitions in action', 'LayerSlider'),

	// Google Fonts

	'GFRemoveConfirmation' 		=> __('Are you sure you’d like to remove this font? Your existing projects’ appearance will not be affected.', 'LayerSlider'),
	'GFEmptyConfirmation' 		=> __('Are you sure you’d like to remove all globally added fonts? Your existing projects’ appearance will not be affected.', 'LayerSlider'),

	'history' => [

		'GENERAL' 				=> [
			'icon' 	=> lsGetSVGIcon('pencil')
		],

		'SLIDE_SETTINGS' 		=> [
			'title' => __('Slide settings', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('sliders-v-square')
		],
		'SLIDE_IMAGE' 			=> [
			'title' => __('Slide image', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('image')
		],
		'SLIDE_THUMBNAIL' 		=> [
			'title' => __('Slide thumbnail', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('image')
		],
		'LAYER_SELECT' 			=> [
			'title' => __('Select layer', 'LayerSlider'),
			'icon' => lsGetSVGIcon('square-dashed')
		],
		'LAYER_NEW' 			=> [
			'title' => __('New layer', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('layer-plus')
		],
		'LAYER_NEW_M' 			=> [
			'title' => __('New layers', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('layer-plus')
		],
		'LAYER_DELETE' 			=> [
			'title' => __('Delete layer', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('layer-minus')
		],
		'LAYER_DELETE_M' 		=> [
			'title' => __('Delete layers', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('layer-minus')
		],
		'LAYER_DEVICE' 			=> [
			'title' => __('Layer device visibility', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('desktop')
		],

		'LAYER_CONTENT' 		=> [
			'title' => __('Layer content', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('edit')
		],

		'LAYER_SETTINGS' 		=> [
			'title' => __('Layer settings', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('sliders-v-square')
		],
		'LAYER_STYLES' 			=> [
			'title' => __('Layer styles', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('palette')
		],

		'BUTTON_PRESET' 		=> [
			'title' => __('Button preset', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('pencil-paintbrush')
		],

		'LAYER_TRANSITION' 		=> [
			'title' => __('Layer transition', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('wave-sine')
		],
		'ENABLE_LAYER_TRANSITION' 	=> [
			'title' => __('Enable layer transition', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('wave-sine')
		],
		'DISABLE_LAYER_TRANSITION' 	=> [
			'title' => __('Disable layer transition', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('wave-sine')
		],
		'LAYER_POSITION' 		=> [
			'title' => __('Layer position', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('arrows-alt')
		],
		'LAYER_IMAGE' 			=> [
			'title' => __('Layer image', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('image-polaroid')
		],
		'LAYER_HIDE' 			=> [
			'title' => __('Hide layer', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('eye')
		],
		'LAYER_LOCK' 			=> [
			'title' => __('Lock layer', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('lock')
		],
		'LAYER_ALIGN' 			=> [
			'title' => __('Align layer', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('border-inner')
		],
		'LAYER_ORDER' 			=> [
			'title' => __('Layer order', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('sort-size-down')
		],
		'LAYER_TYPE' 			=> [
			'title' => __('Layer type', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('align-left')
		],
		'LAYER_ICON' 			=> [
			'title' => __('Icon change', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('icons')
		],
		'LAYER_RESIZE' 			=> [
			'title' => __('Resize layer', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('expand-alt')
		],
		'LAYER_ROTATE' 			=> [
			'title' => __('Rotate layer', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('sync-alt')
		],
		'LAYER_BG' 				=> [
			'title' => __('Layer background', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('fill')
		],
		'LAYER_PASTE_SETTINGS' 	=> [
			'title' => __('Paste layer settings', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('clipboard')
		],
		'LAYER_SMART_OPERATION' => [
			'title' => __('Smart Operation', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('lightbulb-on')
		],
		'VIDEO_POSTER' 			=> [
			'title' => __('Video poster', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('photo-video')
		],
		'MODIFY_SHAPE' 			=> [
			'title' => __('Modify Shape', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('shapes')
		],
		'MODIFY_OBJECT' 		=> [
			'title' => __('Modify SVG', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('stars')
		],
		'LAYER_APPLY_TRANSITION' => [
			'title' => __('Apply transition', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('stars')
		],
		'LAYER_ACTIONS' 		=> [
			'title' => __('Layer actions', 'LayerSlider'),
			'icon' 	=> lsGetSVGIcon('bullseye-pointer', 'regular', [ 'class' => 'lse-mirror-h' ])
		],

	],

	// Slider Builder
	'SBSearchNavigation' 		=> __('Navigation', 'LayerSlider'),
	'SBProjectSettings' 		=> __('Project Settings', 'LayerSlider'),
	'SBSlideOptions' 			=> __('Slide Options', 'LayerSlider'),
	'SBLayerOptions' 			=> __('Layer Options', 'LayerSlider'),
	'SBSlideTitle' 				=> __('Slide #%d', 'LayerSlider'),
	'SBSlideCopyTitle' 			=> __('Slide #%d copy', 'LayerSlider'),
	'SBLayerTitle' 				=> __('Layer #%d', 'LayerSlider'),
	'SBLayerCopyTitle' 			=> __('Layer #%d copy', 'LayerSlider'),

	// Search
	'SBSearchTitle' 			=> __('Search', 'LayerSlider'),
	'SBSearchSlide' 			=> __('Slide', 'LayerSlider'),
	'SBSearchLayers' 			=> __('Layers', 'LayerSlider'),

	'SBUsedFonts' 				=> __('Used Fonts', 'LayerSlider'),
	'SBDragMe' 					=> __('Drag me :)', 'LayerSlider'),
	'SBPreviewImagePlaceholder'	=> __('Double click to<br> set image', 'LayerSlider'),
	'SBPreviewMediaPlaceholder'	=> __('Double click to<br> add media', 'LayerSlider'),
	'SBPreviewIconPlaceholder'	=> __('Double click to<br> add icon', 'LayerSlider'),
	'SBPreviewShapePlaceholder'	=> __('Double click to<br> add shape', 'LayerSlider'),
	'SBPreviewTextPlaceholder' 	=> __('Text Layer', 'LayerSlider'),
	'SBPreviewHTMLPlaceholder' 	=> __('HTML Layer', 'LayerSlider'),
	'SBPreviewButtonPlaceholder' => __('Button', 'LayerSlider'),
	'SBPreviewAudioPlaceholder' => __('Embedded Audio', 'LayerSlider'),
	'SBPreviewPostPlaceholder' 	=> __('Howdy, [author]', 'LayerSlider'),
	'SBPreviewSlide' 			=> __('Preview Slide', 'LayerSlider'),
	'SBPreviewSlideExit' 		=> __('Stop Preview', 'LayerSlider'),
	'SBPreviewLinkNotAvailable' => __('Auto-generated URLs are not available in Preview. This layer will link to “%s” on your front-end pages.', 'LayerSlider'),
	'SBStaticUntil' 			=> __('Until the end of Slide #%d', 'LayerSlider'),
	'SBPasteLayerError'			=> __('There’s nothing to paste. Copy a layer first!', 'LayerSlider'),
	'SBPasteError' 				=> __('There is nothing to paste! Copy layer style or transition options first.', 'LayerSlider'),
	'SBCPPasteError' 			=> __('There is nothing to paste! Copy a color or gradient first.', 'LayerSlider'),
	'SBRemoveSlideTitle' 		=> __('Remove selected slide?', 'LayerSlider'),
	'SBRemoveSlideTitleName' 	=> __('Remove slide "%s"?', 'LayerSlider'),
	'SBRemoveSlideText' 		=> __('Are you sure you want to remove this slide? You can’t undo this action.', 'LayerSlider'),
	'SBRemoveSlideButton' 		=> __('Remove Slide', 'LayerSlider'),

	'SBRemoveLayerTitle' 		=> __('Remove selected layer?', 'LayerSlider'),
	'SBRemoveLayerTitleName' 	=> __('Remove layer "%s"?', 'LayerSlider'),
	'SBRemoveLayerText' 		=> __('Are you sure you want to remove this layer?', 'LayerSlider'),
	'SBRemoveLayerButton' 		=> __('Remove Layer', 'LayerSlider'),

	'SBRemoveLayersTitle' 		=> __('Remove selected layers?', 'LayerSlider'),
	'SBRemoveLayersText' 		=> __('Are you sure you want to remove the selected layers?', 'LayerSlider'),
	'SBRemoveLayersButton' 		=> __('Remove Layers', 'LayerSlider'),

	'SBMediaLibraryImage' 		=> __('Pick an image to use it in LayerSlider', 'LayerSlider'),
	'SBMediaLibraryMedia'		=> __('Choose video or audio files', 'LayerSlider'),
	'SBMediaLibraryAVError' 	=> __('Please select only video or audio sources without mixing them together.', 'LayerSlider'),
	'SBUploadError' 			=> __('Upload error. Please verify that the uploaded items have the correct file extension and they are supported by WordPress.', 'LayerSlider'),
	'SBUploadErrorMessage' 		=> __('Upload error. Please verify that the uploaded items have the correct file extension and they are supported by WordPress. Your server thrown the following error: %s', 'LayerSlider'),
	'SBInvalidFormat' 			=> __('Invalid format', 'LayerSlider'),
	'SBEnterImageURL' 			=> __('Enter an image URL', 'LayerSlider'),
	'SBTransitionApplyOthers' 	=> __('Are you sure you want to apply the currently selected transitions and effects on the other slides?', 'LayerSlider'),
	'SBPostFilterWarning' 		=> __('No posts were found with the current filters.', 'LayerSlider'),
	'SBSaveErrorTitle' 			=> __('Server Error', 'LayerSlider'),
	'SBSaveError' 				=> sprintf(__('It seems there is a server issue that prevented LayerSlider from saving your work. Please check %sSystem Status%s for potential errors, try to temporarily disable themes/plugins to rule out incompatibility issues, or contact your hosting provider to resolve server configuration problems. Your HTTP server thrown the following error: %%s', 'LayerSlider'), '<a href="'.admin_url( 'admin.php?page=layerslider&section=system-status' ).'" target="_blank">', '</a>'),
	'SBUnsavedChanges' 			=> __('You have unsaved changes on this page. Do you want to leave and discard the changes made since your last save?', 'LayerSlider'),
	'SBLinkTextPage' 			=> __('WP Page: %s', 'LayerSlider'),
	'SBLinkTextPost' 			=> __('WP Post: %s', 'LayerSlider'),
	'SBLinkTextAttachment' 		=> __('WP Attachment: %s', 'LayerSlider'),
	'SBLinkPostDynURL' 			=> __('URL from Dynamic content', 'LayerSlider'),
	'SBLinkSmartAction' 		=> __('LS Action: %s', 'LayerSlider'),
	'SBImportLayerNoProject' 	=> __('No projects found.', 'LayerSlider'),
	'SBImportLayerNoSlide' 		=> __('No slides found.', 'LayerSlider'),
	'SBImportLayerNoLayer' 		=> __('No layers found.', 'LayerSlider'),
	'SBImportLayerSelectSlide' 	=> __('Select a slide first.', 'LayerSlider'),
	'SBImportLayerPTMT' 	=> __('License registration is required to import layers from premium templates.', 'LayerSlider'),
	'SBImportSlidePTMT' 	=> __('License registration is required to import slides from premium templates.', 'LayerSlider'),

	'SBConfirmApplyToAllSlides' => __('Are you sure you want to apply this setting on all slides? You won’t be able to undo this.', 'LayerSlider'),

	'SBLayerTypeImg' 			=> __('Image', 'LayerSlider'),
	'SBLayerTypeIcon' 			=> __('Icon', 'LayerSlider'),
	'SBLayerTypeText' 			=> __('Text', 'LayerSlider'),
	'SBLayerTypeButton' 		=> __('Button', 'LayerSlider'),
	'SBLayerTypeMedia' 			=> __('Video / Audio', 'LayerSlider'),
	'SBLayerTypeHTML' 			=> __('HTML', 'LayerSlider'),
	'SBLayerTypePost' 			=> __('Dynamic', 'LayerSlider'),
	'SBLayerTypeShape' 			=> __('Shape', 'LayerSlider'),
	'SBLayerTypeSVG' 			=> __('SVG', 'LayerSlider'),

	'SBInvalidSVGSource' 		=> __('The entered SVG code doesn’t seem to be valid.', 'LayerSlider'),
	'SBInsertObjectTitle' 		=> __('Insert SVG', 'LayerSlider'),
	'SBModifyObjectTitle' 		=> __('Modify SVG', 'LayerSlider'),

	'SBInsertShapeTitle' 		=> __('Insert Shape', 'LayerSlider'),
	'SBModifyShapeTitle' 		=> __('Modify Shape', 'LayerSlider'),
	'SBShapeOptionsTitle' 		=> _x('%s Options', 'Shape Options (e.g. Wave Options, etc.)', 'LayerSlider'),

	'SBRevisionsLoading' 		=> __('Loading, please wait...', 'LayerSlider'),

	'SBSOPlaceholder'			=> _x('SET', 'Input value is changed via smart operation', 'LayerSlider'),
	'SBNoPreview'				=> __('No Preview'),

	'SBRemoveTransitionPresetConfirmation' 	=> __('Are you sure you want to remove this transition preset? This action cannot be undone.'),
	'SBApplyTransitionPresetTitle' 			=> _x('Disable %s?', '%s will be replaced with a transition name like "Hover Transition"', 'LayerSlider'),
	'SBApplyTransitionPresetText' 			=> __('This preset wants to disable %s in order to work optimally in most cases. The displayed preview showed this recommendation applied. However, this is not a requirement, and you can choose to apply the preset without disabling other transitions.', 'LayerSlider'),
	'SBApplyTransitionPresetOK' 			=> __('Apply Recommendation', 'LayerSlider'),
	'SBApplyTransitionPresetBoth' 			=> __('Keep Transitions', 'LayerSlider'),

	'SBMediaAutoplayNoticeTitle' => __('Audio prevents autoplay', 'LayerSlider'),
	'SBMediaAutoplayNoticeText' => __('Modern web browsers don’t allow autoplay with sound in most cases since it was deemed undesirable. Some exceptions exist. For example, if a user frequently visits a website or interacts with it first by clicking on an element before attempting to autoplay with sound.
<br><br>
There’s no way to circumvent this restriction. You should either autoplay videos muted and offer an unmute button, or wait for visitors to start playback with sound on their own.
<br><br>
LayerSlider will attempt to start playback with sound if you select “Auto” for “Play Muted”. If that’s not possible, it’ll autoplay without sound, and visitors are prompted with an unmute button.', 'LayerSlider'),

	// Transition Builder
	'TBTransitionName' 			=> __('Type transition name', 'LayerSlider'),
	'TBRemoveTransition' 		=> __('Remove transition', 'LayerSlider'),
	'TBRemoveConfirmation' 		=> __('Are you sure you want to remove this transition?', 'LayerSlider'),



	// System Status
	'SSClearGroupsConfirmation'	=> __('Are you sure you want to clear all groups? All your projects will be moved to the main grid, where they remain available to you. Your groups, however, will irreversibly be removed. Do you wish to continue?', 'LayerSlider'),
	'SSClearLocalStorageConfirmation' => __('Clearing LocalStorage might affect some editor interface settings, but everything important, like your projects and plugin settings, are safely stored in your site’s database, and they won’t be touched.', 'LayerSlider')
];