<?php
/**
 * Class LP_Course_Reviews_DB
 *
 * @author tungnx
 * @since 4.1.6
 */

defined( 'ABSPATH' ) || exit();

class LP_Course_Reviews_DB extends LP_Database {
	private static $_instance;
	public $tb_comments;
	public $tb_commentmeta;

	protected function __construct() {
		global $wpdb;
		$prefix               = $wpdb->prefix;
		$this->tb_comments    = $prefix . 'comments';
		$this->tb_commentmeta = $prefix . 'commentmeta';
		parent::__construct();
	}

	public static function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Get total rating of a course.
	 *
	 * @param int $course_id
	 *
	 * @return mixed
	 * @throws Exception
	 * @version 1.0.0
	 * @since 4.0.6
	 */
	public function count_rating_of_course( int $course_id = 0 ) {
		$query = $this->wpdb->prepare(
			"SELECT SUM(cm.meta_key = '_lpr_rating') AS total,
			SUM(cm.meta_value = 5) AS five,
			SUM(cm.meta_value = 4) AS four,
			SUM(cm.meta_value = 3) AS three,
			SUM(cm.meta_value = 2) AS two,
			SUM(cm.meta_value = 1) AS one
			FROM {$this->tb_comments} AS c
			INNER JOIN {$this->tb_commentmeta} AS cm
			ON c.comment_ID = cm.comment_id
			INNER JOIN {$this->tb_users} u ON u.ID = c.user_id
			WHERE c.comment_post_ID = %d
			AND c.comment_approved = 1
			AND cm.meta_key = '_lpr_rating'
	        ",
			$course_id
		);

		$result = $this->wpdb->get_row( $query );

		$this->check_execute_has_error();

		return $result;
	}
}
