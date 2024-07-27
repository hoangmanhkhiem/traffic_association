<?php
/**
 * Class LP_Quiz_Questions_Filter
 *
 * @author  ThimPress
 * @package LearnPress/Classes/Filters
 * @since  4.1.6
 * @author tungnx
 * @version 1.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

class LP_Quiz_Questions_Filter extends LP_Filter {
	/**
	 * @var array
	 */
	public $question_ids = array();
	/**
	 * @var array
	 */
	public $quiz_ids = array();
}
