<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Custom Fonts
 * @version		1.0.0
 * 
 * Custom Fonts Autoloader
 * Created by CMSMasters
 * 
 */


namespace CmsmastersCustomFonts;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * CMSMasters Custom Fonts autoloader.
 *
 * CMSMasters Custom Fonts autoloader handler class is responsible for
 * loading the different classes needed to run the plugin.
 */
final class Autoloader {

	/**
	 * Classes map.
	 *
	 * Maps CMSMasters Custom Fonts classes to file names.
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 */
	private static $classes_map = array();

	/**
	 * Run autoloader.
	 *
	 * Register a function as `__autoload()` implementation.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function run() {
		spl_autoload_register( array( __CLASS__, 'autoload' ) );
	}

	/**
	 * Autoloader method.
	 * 
	 * For a given class, check if it exist and load it.
	 * Fired by `spl_autoload_register` function.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	private static function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		if ( ! class_exists( $class ) ) {
			$relative_class_name = preg_replace( '/^' . __NAMESPACE__ . '\\\/', '', $class );

			if ( isset( self::$classes_map[ $relative_class_name ] ) ) {
				$filepath = CMSMASTERS_CUSTOM_FONTS_PATH . self::$classes_map[ $relative_class_name ];
			} else {
				$filename = strtolower(
					preg_replace(
						array( '/([a-z])([A-Z])/', '/_/', '/\\\/' ),
						array( '$1-$2', '-', DIRECTORY_SEPARATOR ),
						$relative_class_name
					)
				);

				$filepath = CMSMASTERS_CUSTOM_FONTS_PATH . $filename . '.php';
			}

			if ( is_readable( $filepath ) ) {
				require $filepath;
			}
		}
	}
}
