<?php
/**
 * Class LP_Question_Multi_Choice
 *
 * @author  ThimPress
 * @package LearnPress/Classes
 * @version 3.0.0
 * @extend  LP_Question
 */

defined( 'ABSPATH' ) || exit();

if ( ! class_exists( 'LP_Question_Multi_Choice' ) ) {
	/**
	 * Class LP_Question_Multi_Choice
	 */
	class LP_Question_Multi_Choice extends LP_Question {

		/**
		 * Type of this question.
		 *
		 * @var string
		 */
		public $_question_type = 'multi_choice';

		/**
		 * LP_Question_Multi_Choice constructor.
		 *
		 * @param null $the_question
		 * @param null $options
		 *
		 * @throws Exception
		 */
		public function __construct( $the_question = null, $options = null ) {
			parent::__construct( $the_question, $options );
		}

		/**
		 * Allow check answer.
		 *
		 * @return bool
		 */
		public function can_check_answer() {
			return true;
		}

		/**
		 * Check user answer.
		 *
		 * @param null $user_answer
		 *
		 * @return array
		 */
		public function check( $user_answer = null ) {
			$return = parent::check();
			settype( $user_answer, 'array' );
			$answers = $this->get_answers();

			if ( $answers ) {
				$correct = true;
				foreach ( $answers as $key => $option ) {
					$data     = $option->get_data();
					$selected = $this->is_selected_option( $data, $user_answer );

					if ( $selected && ! $option->is_true() ) {
						$correct = false;
					} elseif ( ! $selected && $option->is_true() ) {
						$correct = false;
					}

					// Only one option is selected wrong will wrong the answer.
					if ( ! $correct ) {
						break;
					}
				}

				if ( $correct ) {
					$return = array(
						'correct' => true,
						'mark'    => floatval( $this->get_mark() ),
					);
				}
			}

			return $return;
		}
	}
}
