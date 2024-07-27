<?php
/**
 * Plugin Name: LearnPress - Course Wishlist
 * Plugin URI: http://thimpress.com/learnpress
 * Description: Wishlist feature.
 * Author: ThimPress
 * Version: 4.0.7
 * Author URI: http://thimpress.com
 * Tags: learnpress
 * Text Domain: learnpress-wishlist
 * Domain Path: /languages/
 * Require_LP_Version: 4.2.6.2
 *
 * @package LearnPress-Course-Wishlist
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

const LP_ADDON_WISHLIST_FILE = __FILE__;

/**
 * Class LP_Addon_Wishlist_Preload
 */
class LP_Addon_Wishlist_Preload {
	/**
	 * @var array|string[]
	 */
	public static $addon_info = array();
	/**
	 * @var LP_Addon_Wishlist $addon
	 */
	public static $addon;

	/**
	 * Singleton.
	 *
	 * @return LP_Addon_Wishlist_Preload|mixed
	 */
	public static function instance() {
		static $instance;
		if ( is_null( $instance ) ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * LP_Addon_Wishlist_Preload constructor.
	 */
	protected function __construct() {
		// Set Base name plugin.
		define( 'LP_ADDON_WISHLIST_BASENAME', plugin_basename( LP_ADDON_WISHLIST_FILE ) );

		// Set version addon for LP check .
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		self::$addon_info = get_file_data(
			LP_ADDON_WISHLIST_FILE,
			array(
				'Name'               => 'Plugin Name',
				'Require_LP_Version' => 'Require_LP_Version',
				'Version'            => 'Version',
			)
		);

		define( 'LP_ADDON_WISHLIST_VER', self::$addon_info['Version'] );
		define( 'LP_ADDON_WISHLIST_REQUIRE_VER', self::$addon_info['Require_LP_Version'] );

		// Check LP activated .
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			add_action( 'admin_notices', array( $this, 'show_note_errors_require_lp' ) );

			deactivate_plugins( LP_ADDON_WISHLIST_BASENAME );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			return;
		}

		// Sure LP loaded.
		add_action( 'learn-press/ready', array( $this, 'load' ) );
	}

	/**
	 * Load addon
	 */
	public function load() {
		self::$addon = LP_Addon::load( 'LP_Addon_Wishlist', 'inc/load.php', __FILE__ );
	}

	public function show_note_errors_require_lp() {
		?>
		<div class="notice notice-error">
			<p><?php echo( 'Please active <strong>LP version ' . LP_ADDON_WISHLIST_REQUIRE_VER . ' or later</strong> before active <strong>' . self::$addon_info['Name'] . '</strong>' ); ?></p>
		</div>
		<?php
	}
}

LP_Addon_Wishlist_Preload::instance();
