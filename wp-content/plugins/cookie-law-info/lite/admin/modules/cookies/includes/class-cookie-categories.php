<?php
/**
 * Class Cookie_Categories file.
 *
 * @package CookieYes
 */

namespace CookieYes\Lite\Admin\Modules\Cookies\Includes;

use CookieYes\Lite\Includes\Store;
use CookieYes\Lite\Admin\Modules\Cookies\Includes\Category_Controller;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Handles Cookie category Operation
 *
 * @class       Cookie_Categories
 * @version     3.0.0
 * @package     CookieYes
 */
class Cookie_Categories extends Store {

	/**
	 * Instance of the current class
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Data array, with defaults.
	 *
	 * @var array
	 */
	protected $data = array(
		'name'               => '',
		'slug'               => '',
		'description'        => array(),
		'prior_consent'      => false,
		'visibility'         => true,
		'priority'           => 0,
		'meta'               => array(),
		'date_created'       => '',
		'date_modified'      => '',
		'language'           => 'en',
		'sell_personal_data' => true,
		'cookies'            => array(),
	);
	/**
	 * Constructor
	 *
	 * @param mixed $data ID or slug of the cookie.
	 */
	public function __construct( $data = '' ) {
		parent::__construct( $data );

		if ( is_int( $data ) && 0 !== $data ) {
			$this->set_id( $data );
		}
		if ( isset( $data->category_id ) ) {
			$this->set_id( $data->category_id );
			$this->read_direct( $data );
		} else {
			$this->get_data_from_db();
		}
	}

	/**
	 * Create a new cookie
	 *
	 * @param object $object instance of Cookie_Categories.
	 * @return void
	 */
	public function create( $object ) {
		Category_Controller::get_instance()->create_item( $object );
	}
	/**
	 * Read cookie data from database
	 *
	 * @param object $category instance of Cookie_Categories.
	 * @return void
	 */
	public function read( $category ) {
		$this->set_defaults();
		$data = Category_Controller::get_instance()->get_item( $category->get_id() );
		$this->set_data( $data );
	}

	/**
	 * Assign data to objects
	 *
	 * @param array|object $data Array of data.
	 * @return void
	 */
	public function set_data( $data ) {
		if ( isset( $data->category_id ) ) {
			$this->set_multi_item_data(
				array(
					'name'               => $data->name,
					'slug'               => $data->slug,
					'description'        => $data->description,
					'prior_consent'      => $data->prior_consent,
					'visibility'         => $data->visibility,
					'priority'           => $data->priority,
					'sell_personal_data' => $data->sell_personal_data,
					'meta'               => $data->meta,
					'cookies'            => $data->cookies,
					'date_created'       => $data->date_created,
					'date_modified'      => $data->date_modified,
				)
			);
			$this->set_loaded( true );
		}
	}

	/**
	 * Read directly from the data object given.
	 * Used for assigning data to object if it is already fetched from API or DB.
	 *
	 * @param array|object $data Category data.
	 * @return void
	 */
	public function read_direct( $data ) {
		$this->set_data( $data );
	}
	/**
	 * Update cookie category data
	 *
	 * @param object $object Instance of Cookie.
	 * @return void
	 */
	public function update( $object ) {
		Category_Controller::get_instance()->update_item( $object );
	}

	/**
	 * Delete a cookie category from database
	 *
	 * @param object $object Category object.
	 * @return void
	 */
	public function remove( $object ) {
		Category_Controller::get_instance()->delete_item( $object );
	}

	/**
	 * Get translated cookie category name.
	 *
	 * @param string $language Language code.
	 * @return array
	 */
	public function get_name( $language = '' ) {
		$contents        = array();
		$prop            = 'name';
		$data            = $this->get_object_data( $prop );
		$languages       = cky_selected_languages( $language );
		$default_content = isset( $data['en'] ) ? $data['en'] : $this->get_translations( 'en', $prop );
		foreach ( $languages as $lang ) {
			$content           = isset( $data[ $lang ] ) ? $data[ $lang ] : '';
			$content           = empty( $content ) ? $this->get_translations( $lang, $prop ) : $content;
			$content           = empty( $content ) && 'view' === $this->get_context() ? $default_content : $content;
			$contents[ $lang ] = stripslashes( wp_kses_post( $content ) );
		}
		if ( '' !== $language ) {
			return isset( $contents[ $language ] ) ? $contents[ $language ] : '';
		}
		return $contents;
	}

	/**
	 * Return prior consent of the category.
	 *
	 * @return boolean
	 */
	public function get_prior_consent() {
		return (bool) $this->get_object_data( 'prior_consent' );
	}

	/**
	 * Return visibility of the category.
	 *
	 * @return boolean
	 */
	public function get_visibility() {
		return (bool) $this->get_object_data( 'visibility' );
	}

	/**
	 * Return the priority of the category.
	 *
	 * @return boolean
	 */
	public function get_priority() {
		return absint( $this->get_object_data( 'priority' ) );
	}

	/**
	 * Return true if the category sells any personal data.
	 *
	 * @return boolean
	 */
	public function get_sell_personal_data() {
		return (bool) $this->get_object_data( 'sell_personal_data' );
	}

	/**
	 * Return category meta data.
	 *
	 * @return array
	 */
	public function get_meta() {
		$meta = array();
		$data = $this->get_object_data( 'meta' );
		foreach ( $data as $key => $item ) {
			$meta[ $key ] = sanitize_textarea_field( $item );
		}
		return $meta;
	}

	/**
	 * Return list of cookies associated to each category
	 *
	 * @return array
	 */
	public function get_cookies() {
		return $this->get_object_data( 'cookies' );
	}

	/**
	 * Set the name of the category to an object.
	 *
	 * @param string $data Name of the category.
	 * @return void
	 */
	public function set_name( $data ) {
		$name      = array();
		$languages = cky_selected_languages();
		foreach ( $languages as $lang ) {
			$name[ $lang ] = isset( $data[ $lang ] ) ? wp_filter_post_kses( $data[ $lang ] ) : '';
		}
		$this->set_object_data( 'name', $name );
	}

	/**
	 * Set prior consent of a category
	 *
	 * @param boolean $data True if it sells personal data.
	 * @return void
	 */
	public function set_prior_consent( $data ) {
		$this->set_object_data( 'prior_consent', (bool) $data );
	}

	/**
	 * Set visibility of a category
	 *
	 * @param boolean $data true or false based on the visibility of a category.
	 * @return void
	 */
	public function set_visibility( $data ) {
		$this->set_object_data( 'visibility', (bool) $data );
	}

	/**
	 * Set true/false based on the personal information stored.
	 *
	 * @param boolean $data true if sells personl data.
	 * @return void
	 */
	public function set_sell_personal_data( $data ) {
		$this->set_object_data( 'sell_personal_data', (bool) $data );
	}

	/**
	 * Priority of a category. Based on this category will be ordered.
	 *
	 * @param  integer $data priority number.
	 * @return void
	 */
	public function set_priority( $data ) {
		$this->set_object_data( 'priority', absint( $data ) );
	}

	/**
	 * Set meta data
	 *
	 * @param array $data Meta data array.
	 * @return void
	 */
	public function set_meta( $data ) {
		$this->set_object_data( 'meta', $data );
	}

	/**
	 * Assign cookies to the object
	 *
	 * @param array $data cookie array.
	 * @return void
	 */
	public function set_cookies( $data ) {
		$this->set_object_data( 'cookies', $data );
	}

	/**
	 * Get contents by language.
	 *
	 * @param string $lang Language code.
	 * @param string $key Specific key if any.
	 * @return string
	 */
	public function get_translations( $lang = '', $key = '' ) {
		$slug     = $this->get_slug();
		$contents = wp_cache_get( 'cky_category_contents_' . $lang, 'cky_category_contents' );
		$translated     = \CookieYes\Lite\Admin\Modules\Languages\Includes\Controller::get_instance()->is_cky_translated($lang);
		$upload_dir    = wp_upload_dir();
		if ( ! $contents ) {
			if ( $translated ) {
				$translation = cky_read_json_file( $upload_dir['basedir'] . '/cookieyes/languages/banners/' . esc_html( $lang ) . '.json' );
				if($translation) {
					$contents = $translation['category_data'];
				}
				if(!$contents) {
					$contents = cky_read_json_file( dirname( __FILE__ ) . "/contents/categories/{$lang}.json" );
				}
			}
			if (empty($contents)) {
				$contents = cky_read_json_file( dirname( __FILE__ ) . "/contents/categories/en.json" );
			}
			wp_cache_set( 'cky_category_contents_' . $lang, $contents, 'cky_category_contents', 12 * HOUR_IN_SECONDS );
		}
		return isset( $contents[ $slug ][ $key ] ) ? $contents[ $slug ][ $key ] : '';
	}
}
