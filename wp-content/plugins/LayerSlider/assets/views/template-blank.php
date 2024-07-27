<?php
	/**
	 * Template Name: LayerSlider Blank Template
     * Template Post Type: post, page
	 */

	$center 	= boolval( get_post_meta( $post->ID, 'ls-center-content', true ) );
	$background = get_post_meta( get_the_ID(), 'ls-page-background', true );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?= wp_get_document_title(); ?></title>
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
?>


<?php if( $center ) { ?>
<div id="ls-template-outer-wrapper">
	<div id="ls-template-projects-wrapper">
<?php }
		while( have_posts() ) {
			the_post();
			the_content();
		}

if( $center ) { ?>
	</div>
</div>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>