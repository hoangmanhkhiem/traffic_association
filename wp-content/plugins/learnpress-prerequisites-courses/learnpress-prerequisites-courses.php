<?php
/**
 * Plugin Name: LearnPress - Prerequisites Courses
 * Plugin URI: http://thimpress.com/learnpress
 * Description: Course you have to finish before you can enroll to this course.
 * Author: ThimPress
 * Version: 4.0.7
 * Author URI: http://thimpress.com
 * Tags: learnpress, lms, add-on, prerequisites courses
 * Text Domain: learnpress-prerequisites-courses
 * Domain Path: /languages/
 * Require_LP_Version: 4.2.6
 *
 * @package learnpress-prerequisites
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

const LP_ADDON_PREREQUISITES_COURSES_FILE = __FILE__;
define( 'LP_ADDON_PREREQUISITES_COURSES_PATH', dirname( __FILE__ ) );

/**
 * Class LP_Addon_Prerequisites_Courses_Preload
 */
class LP_Addon_Prerequisites_Courses_Preload {
	/**
	 * @var array
	 */
	public static $addon_info = array();

	/**
	 * LP_Addon_Prerequisites_Courses_Preload constructor.
	 */
	public function __construct() {
		// Set Base name plugin.
		define( 'LP_ADDON_PREREQUISITES_COURSES_BASENAME', plugin_basename( LP_ADDON_PREREQUISITES_COURSES_FILE ) );

		// Set version addon for LP check .
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		self::$addon_info = get_file_data(
			LP_ADDON_PREREQUISITES_COURSES_FILE,
			array(
				'Name'               => 'Plugin Name',
				'Require_LP_Version' => 'Require_LP_Version',
				'Version'            => 'Version',
			)
		);

		define( 'LP_ADDON_PREREQUISITES_COURSES_VER', self::$addon_info['Version'] );
		define( 'LP_ADDON_PREREQUISITES_COURSES_REQUIRE_VER', self::$addon_info['Require_LP_Version'] );

		// Check LP activated .
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			add_action( 'admin_notices', array( $this, 'show_note_errors_require_lp' ) );

			deactivate_plugins( LP_ADDON_PREREQUISITES_COURSES_BASENAME );

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
		/**
		 * @var LP_Addon_Prerequisites_Courses $lp_addon_prerequisites_courses
		 */
		global $lp_addon_prerequisites_courses;
		$lp_addon_prerequisites_courses = LP_Addon::load( 'LP_Addon_Prerequisites_Courses', 'inc/load.php', __FILE__ );
	}

	/**
	 * Show note errors require lp version.
	 */
	public function show_note_errors_require_lp() {
		?>
		<div class="notice notice-error">
			<p><?php echo( 'Please active <strong>LP version ' . LP_ADDON_PREREQUISITES_COURSES_REQUIRE_VER . ' or later</strong> before active <strong>' . self::$addon_info['Name'] . '</strong>' ); ?></p>
		</div>
		<?php
	}
}

new LP_Addon_Prerequisites_Courses_Preload();
