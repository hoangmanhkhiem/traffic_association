<?php
	$title  	= get_option( 'ls-404-addon-title', '' );
	$type   	= get_option( 'ls-404-addon-type', 'slider' );
	$slider 	= get_option( 'ls-404-addon-slider', 0 );
	$page   	= get_option( 'ls-404-addon-page', 0 );
	$background = get_option( 'ls-404-addon-background', '' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<title><?= ! empty( $title ) ? $title : __( 'Page not found' ) ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="<?= LS_ROOT_URL.'/static/public/blank-template.css'?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="background: <?= ! empty($background ) ? $background : 'transparent' ?> !important;">

<?php

if( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
}


if( $type === 'slider' ) { ?>

	<div id="ls-template-slider-wrapper">
		<?php layerslider( (int) $slider ); ?>
	</div>

<?php } else {
	$page = get_post( (int) $page );
	echo do_shortcode( $page->post_content );
}

wp_footer();

?>
</body>
</html>