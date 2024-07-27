<?php

class LS_GoogleFontsManager {

	// Shared among instances, it's a global list of loaded fonts and
	// their variants to prevent loading the same font multiple times.
	private static $loadedFonts = [];

	// Instance specific array of fonts to load.
	private $fonts = [];

	private $uploadsBaseDir;
	private $googleFontsDir;


	public function __construct() {
		$uploads = wp_upload_dir();
		$this->uploadsBaseDir = $uploads['basedir'];
		$this->googleFontsDir = $this->uploadsBaseDir.'/layerslider/google-fonts';
	}

	public function getInlineStyle( $fontList ) {

		// Return empty string if the font list is empty or not an array
		if( empty( $fontList ) || ! is_array( $fontList ) ) {
			return '';
		}

		// Normalize & process font list
		$this->fonts = $this->processFontList( $fontList );

		// Load from local cache
		if( get_option('layerslider-google-fonts-host-locally', false ) ) {
			return $this->getInlineStyleLocal();

		// Load from Google
		} else {
			return $this->getInlineStyleRemote();
		}
	}


	private function processFontList( $fontList ) {

		$fontsIndex = [];

		$allVariants = [
			'100', '100i',
			'200', '200i',
			'300', '300i',
			'400', '400i',
			'500', '500i',
			'600', '600i',
			'700', '700i',
			'800', '800i',
			'900', '900i'
		];

		foreach( $fontList as $font ) {

			$fontData = explode( ':' , $font['param'] );
			$fontName = urldecode( $fontData[0] );
			$fontVariants = $allVariants;

			if( ! empty( $font['variants'] ) && is_array( $font['variants'] ) ) {
				$fontVariants = $font['variants'];
			}

			// Add font-weight 400 if not present to ensure a successful request to the Google Fonts API.
			// Having the regular variant loaded is also a good practice to handle unexpected cases.
			if( ! in_array( '400', $fontVariants ) ) {
				$fontVariants[] = '400';
			}

			foreach( $fontVariants as $fontVariant ) {

				// This specific font and specific variant is not yet loaded.
				if( empty( self::$loadedFonts[ $fontName ][ $fontVariant ] ) ) {

					// Global marker to prevent loading it again
					self::$loadedFonts[ $fontName ][ $fontVariant ] = true;

					// Instance marker to load the font
					$fontsIndex[ $fontName ][ $fontVariant ] = true;
				}
			}
		}

		foreach( $fontsIndex as $fontName => $fontVariants ) {
			$fontsIndex[ $fontName ] = [
				'name' => $fontName,
				'url' => urlencode( $fontName ) .':'. implode( ',', array_keys( $fontVariants ) ),
				'variants' => array_keys( $fontVariants )
			];
		}

		return $fontsIndex;
	}


	// ----- REMOTE FUNCTIONS -----


	private function getInlineStyleRemote() {

		if( empty( $this->fonts ) ) {
			return '';
		}

		return '<link href="'.$this->getRemoteURL().'" rel="stylesheet">';
	}


	private function getRemoteURL() {

		$fontURLs = [];

		foreach( $this->fonts as $fontName => $fontData ) {
			$fontURLs[] = $fontData['url'];
		}

		return 'https://fonts.googleapis.com/css?family='.implode( '%7C', $fontURLs );
	}


	// ----- LOCAL FUNCTIONS -----


	private function getFontFilesFromCache( $fontData ) {

		// var_dump( $fontData);

		$folderName = sanitize_file_name( $fontData['name'] );
		$fontFolder = $this->googleFontsDir.'/'.$folderName;

		$files = glob( $fontFolder.'/*.woff2' );

		if( ! file_exists( $fontFolder ) || empty( $files ) ) {
			$this->downloadFontFilesToCache( $fontData );
			$files = glob( $fontFolder.'/*.woff2' );
		}

		return ! empty( $files ) ? $files : [];
	}



	private function downloadFontFilesToCache( $fontData ) {

		if (!function_exists('download_url')) require_once ABSPATH . 'wp-admin/includes/file.php';

		$folderName = sanitize_file_name( $fontData['name'] );
		$fontFolder = $this->googleFontsDir.'/'.$folderName;
		$dlURLs = [];

		wp_mkdir_p( $fontFolder );

		if( ! is_writable( $fontFolder ) ) {
			return false;
		}

		$response = wp_remote_retrieve_body( wp_remote_get( 'https://fonts.googleapis.com/css?family='.$fontData['url'], [
			'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
		]));

		if( empty( $response ) ) {
			return false;
		}


		preg_match_all( '/http.*?\.woff2/', $response, $dlURLs );

		if( ! empty( $dlURLs[0] ) ) {
			foreach( $dlURLs[0] as $url ) {

				$fileName = sanitize_file_name( basename( $url ) );
				$filePath = $fontFolder.'/'.$fileName;

				$tmp = download_url( $url );
				copy( $tmp, $filePath );
				unlink( $tmp );
			}
		}

		return true;
	}



	private function getFontFaceRule( $fontData ) {

		$files = $this->getFontFilesFromCache( $fontData );


		$cssRules = [];
		$cssRules[] = '@font-face {';
		$cssRules[] = 'font-family: "'.$fontData['name'].'";';
		$cssRules[] = 'font-style: normal;';
		$cssRules[] = 'font-weight: 400;';
		$cssRules[] = 'src: local("'.$fontData['name'].'"), url("'.$this->googleFontsDir.'.woff2") format("woff2");';
		$cssRules[] = '}';

		return implode( ' ', $cssRules );
	}


	private function getInlineStyleLocal() {

		$cssRules = [];

		foreach( $this->fonts as $fontData ) {
			$cssRules[] = $this->getFontFaceRule( $fontData );
		}

		if( ! empty( $cssRules ) ) {
			return '<style>'.implode( ' ', $cssRules ).'</style>';
		}

		return '';
	}

}