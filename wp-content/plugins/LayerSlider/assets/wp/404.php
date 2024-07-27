<?php

// Prevent direct file access
defined( 'LS_ROOT_FILE' ) || exit;

if( get_option('ls-404-addon-enabled', false ) ) {
	add_action( 'template_redirect', function() {
		if( is_404() ) {
			require_once LS_ROOT_PATH.'/views/template-404.php';
			die();
		}
	}, 1, 0 );
}