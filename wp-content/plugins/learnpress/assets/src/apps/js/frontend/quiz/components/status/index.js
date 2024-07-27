import { useEffect } from '@wordpress/element';
import { dispatch, select } from '@wordpress/data';
import Timer from '../timer';
import { __, sprintf } from '@wordpress/i18n';

const $ = jQuery;
const { debounce } = lodash;

const Status = () => {
	const { submitQuiz } = dispatch( 'learnpress/quiz' );

	useEffect( () => {
		const $pc = $( '#popup-content' );

		if ( ! $pc.length ) {
			return;
		}

		const $sc = $pc.find( '.content-item-scrollable:eq(1)' );
		const $qs = $pc.find( '.quiz-status' );
		const pcTop = $qs.offset().top - 92;
		let isFixed = false;

		/**
		 * Check when status bar is stopped in the top
		 * to add new class into html
		 */
		$sc.on( 'scroll', () => {
			if ( $sc.scrollTop() >= pcTop ) {
				if ( isFixed ) {
					return;
				}
				isFixed = true;
			} else {
				if ( ! isFixed ) {
					return;
				}
				isFixed = false;
			}

			if ( isFixed ) {
				$pc.addClass( 'fixed-quiz-status' );
			} else {
				$pc.removeClass( 'fixed-quiz-status' );
			}
		} );
	}, [] );

	/**
	 * Submit question to record results.
	 */
	const submit = () => {
		const { confirm } = select( 'learnpress/modal' );

		if ( 'no' === confirm( __( 'Are you sure to submit the quiz?', 'learnpress' ), submit ) ) {
			return;
		}

		submitQuiz();
	};

	const getMark = () => {
		const answered = select( 'learnpress/quiz' ).getData( 'answered' );

		return Object.values( answered ).reduce( ( m, r ) => {
			return m + r.mark;
		}, 0 );
	};

	const { getData, getUserMark } = select( 'learnpress/quiz' );

	const currentPage = getData( 'currentPage' );
	const questionsPerPage = getData( 'questionsPerPage' );
	const questionsCount = getData( 'numberQuestionsToDo' );
	const submitting = getData( 'submitting' );
	const duration = getData( 'duration' );
	const userMark = getUserMark();

	const classNames = [ 'quiz-status' ];

	const start = ( ( currentPage - 1 ) * questionsPerPage ) + 1;
	let end = start + questionsPerPage - 1;
	let indexHtml = '';

	end = Math.min( end, questionsCount );

	if ( submitting ) {
		classNames.push( 'submitting' );
	}

	if ( end < questionsCount ) {
		if ( questionsPerPage > 1 ) {
			indexHtml = sprintf( __( 'Question <span>%d to %d of %d</span>', 'learnpress' ), start, end, questionsCount );
		} else {
			indexHtml = sprintf( __( 'Question <span>%d of %d</span>', 'learnpress' ), start, questionsCount );
		}
	} else {
		indexHtml = sprintf( __( 'Question <span>%d of %d</span>', 'learnpress' ), start, end );
	}

	return (
		<div className={ classNames.join( ' ' ) }>
			<div>
				<div className="questions-index" dangerouslySetInnerHTML={ { __html: indexHtml } } />

				<div className="current-point">
					{ sprintf( __( 'Earned Point: %s', 'learnpress' ), userMark ) }
				</div>

				<div>
					<div className="submit-quiz">
						<button
							className="lp-button" id="button-submit-quiz"
							onClick={ submit }
						>
							{ ! submitting ? __( 'Finish Quiz', 'learnpress' ) : __( 'Submitting…', 'learnpress' ) }
						</button>
					</div>

					{ <Timer /> }
				</div>
			</div>
		</div>
	);
};

export default Status;
