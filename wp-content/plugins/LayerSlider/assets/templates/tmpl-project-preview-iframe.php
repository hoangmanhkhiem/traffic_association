<?php

	// Prevent direct file access
	defined( 'LS_ROOT_FILE' ) || exit;

	$wp_scripts = wp_scripts();

	$uploads = wp_upload_dir();
	$uploads['baseurl'] = set_url_scheme( $uploads['baseurl'] );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LayerSlider Preview</title>

	<!-- Preview CSS & JS -->
	<link rel="stylesheet" href="<?= LS_ROOT_URL.'/static/admin/css/project-iframe.css?ver='.LS_PLUGIN_VERSION ?>">
	<script src="<?= LS_ROOT_URL.'/static/admin/js/webfontloader.js?ver='.LS_PLUGIN_VERSION ?>"></script>
	<script src="<?= LS_ROOT_URL.'/static/admin/js/project-iframe.js?ver='.LS_PLUGIN_VERSION ?>"></script>

	<!-- LayerSlider CSS -->
	<link rel="stylesheet" href="<?= LS_ROOT_URL.'/static/layerslider/css/layerslider.css?ver='.LS_PLUGIN_VERSION ?>">

	<!-- External libraries: jQuery & GreenSock -->
	<script src="<?= site_url( $wp_scripts->registered['jquery-core']->src ) ?>"></script>
	<script src="<?= LS_ROOT_URL.'/static/layerslider/js/layerslider.utils.js?ver='.LS_PLUGIN_VERSION ?>"></script>

	<!-- LayerSlider script files -->
	<script src="<?= LS_ROOT_URL.'/static/layerslider/js/layerslider.transitions.js?ver='.LS_PLUGIN_VERSION ?>"></script>
	<script src="<?= LS_ROOT_URL.'/static/layerslider/js/layerslider.kreaturamedia.jquery.js?ver='.LS_PLUGIN_VERSION ?>"></script>

	<!-- LayerSlider Popup plugin -->
	<link rel="stylesheet" href="<?= LS_ROOT_URL.'/static/layerslider/plugins/popup/layerslider.popup.css?ver='.LS_PLUGIN_VERSION ?>">
	<script src="<?= LS_ROOT_URL.'/static/layerslider/plugins/popup/layerslider.popup.js?ver='.LS_PLUGIN_VERSION ?>"></script>

	<!-- LayerSlider Origami plugin -->
	<link rel="stylesheet" href="<?= LS_ROOT_URL.'/static/layerslider/plugins/origami/layerslider.origami.css?ver='.LS_PLUGIN_VERSION ?>">
	<script src="<?= LS_ROOT_URL.'/static/layerslider/plugins/origami/layerslider.origami.js?ver='.LS_PLUGIN_VERSION ?>"></script>

	<!-- Font Awesome 4 -->
	<link rel="stylesheet" href="<?= LS_ROOT_URL.'/static/font-awesome-4/css/font-awesome.min.css?ver='.LS_PLUGIN_VERSION ?>">

	<!-- User CSS -->
	<?php if( file_exists( $uploads['basedir'].'/layerslider.custom.css' ) ) : ?>
	<link rel="stylesheet" href="<?= $uploads['baseurl'].'/layerslider.custom.css?ver='.filemtime($uploads['basedir'].'/layerslider.custom.css') ?>">
	<?php endif ?>

	<!-- Custom Transitions -->
	<?php if( file_exists( $uploads['basedir'].'/layerslider.custom.transitions.js' ) ) : ?>
	<script src="<?= $uploads['baseurl'].'/layerslider.custom.transitions.js?ver='.filemtime($uploads['basedir'].'/layerslider.custom.transitions.js') ?>"></script>
	<?php endif ?>
</head>
<body class="lse-scrollbar lse-scrollbar-dark">
	<div id="lse-project-scroll-wrapper">
		<div id="lse-project-wrapper"></div>
	</div>

	<?= lsGetSVGIcon('mouse-alt', 'light', [ 'id' => 'lse-project-scroll-icon' ], 'div') ?>

</body>
</html>