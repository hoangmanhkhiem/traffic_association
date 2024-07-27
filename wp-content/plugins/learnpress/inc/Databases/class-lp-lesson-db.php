<?php
/**
 * Class LP_Lesson_DB
 *
 * @author tungnx
 * @since 3.2.7.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class LP_Lesson_DB extends LP_Database {
	private static $_instance;

	protected function __construct() {
		parent::__construct();
	}

	public static function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Get section id by lesson id
	 *
	 * @param int $lesson_id
	 *
	 * @return string|null
	 */
	public function get_section_by_lesson_id( $lesson_id = 0 ) {
		$query = $this->wpdb->prepare(
			"
			SELECT section_id FROM $this->tb_lp_section_items
			WHERE item_type = %s
			AND item_id = %d",
			LP_LESSON_CPT,
			$lesson_id
		);

		$result = $this->wpdb->get_var( $query );

		return $result;
	}

	/**
	 * Get total lessons set preview
	 *
	 * @return string|null
	 */
	public function get_total_preview_items() {
		$query = $this->wpdb->prepare(
			"
		        SELECT COUNT(ID) FROM $this->tb_posts p
		        INNER JOIN {$this->tb_postmeta} pm
		        ON p.ID = pm.post_id
		        AND pm.meta_key = %s
		        WHERE pm.meta_value = %s
		        AND p.post_type = %s",
			'_lp_preview',
			'yes',
			LP_LESSON_CPT
		);

		return $this->wpdb->get_var( $query );
	}

	/**
	 * Get total lessons no set preview
	 *
	 * @param int $total_preview_items
	 *
	 * @return string|null
	 */
	public function get_total_no_preview_items( $total_preview_items = 0 ) {
		global $wpdb;
		$query = $wpdb->prepare(
			"
		        SELECT COUNT(ID)
		        FROM {$wpdb->posts} p
		        WHERE p.post_type = %s
		        AND p.post_status NOT LIKE 'auto-draft'
		        AND p.post_status NOT LIKE 'trash'
		        ",
			LP_LESSON_CPT
		);

		return $wpdb->get_var( $query ) - $total_preview_items;
	}

	/**
	 * Get preview lesson in Courses database.
	 *
	 * @param int $course_id
	 * @return void
	 *
	 * @todo Set cache or save when save_course.
	 */
	public function get_count_preview_in_course( $course_id ) {
		$query = $this->wpdb->prepare(
			"SELECT COUNT(ID) FROM $this->tb_posts AS p
			INNER JOIN {$this->tb_postmeta} AS pm ON p.ID = pm.post_id AND pm.meta_key = %s
			INNER JOIN {$this->tb_lp_section_items} AS section_items ON section_items.item_id = p.ID
			INNER JOIN {$this->tb_lp_sections} AS sections ON sections.section_course_id = %d AND sections.section_id = section_items.section_id
			WHERE pm.meta_value = %s
			AND p.post_type = %s",
			'_lp_preview',
			$course_id,
			'yes',
			LP_LESSON_CPT
		);

		return $this->wpdb->get_var( $query );
	}
}

LP_Lesson_DB::getInstance();

