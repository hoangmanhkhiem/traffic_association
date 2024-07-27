/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/frontend/quiz/components/attempts/index.js":
/*!***********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/attempts/index.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _duration__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../duration */ "./assets/src/apps/js/frontend/quiz/components/duration/index.js");





/**
 * Displays list of all attempt from a quiz.
 */
const Attempts = () => {
  const attempts = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_1__.select)('learnpress/quiz').getData('attempts') || [];
  const hasAttempts = attempts && !!attempts.length;
  return !hasAttempts ? false : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "quiz-attempts"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    className: "attempts-heading"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Last Attempt', 'learnpress')), hasAttempts && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("table", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("thead", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", {
    className: "quiz-attempts__questions"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Questions', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", {
    className: "quiz-attempts__spend"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Time spent', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", {
    className: "quiz-attempts__marks"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Marks', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", {
    className: "quiz-attempts__grade"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Passing grade', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", {
    className: "quiz-attempts__result"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Result', 'learnpress')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tbody", null, attempts.map((row, key) => {
    // Re-write value to attempts.timeSpend
    /*if ( lpQuizSettings.checkNorequizenroll === 1 ) {
    	const timespendStart = window.localStorage.getItem( 'quiz_start_' + lpQuizSettings.id ),
    		timespendEnd = window.localStorage.getItem( 'quiz_end_' + lpQuizSettings.id );
    	if ( timespendStart && timespendEnd ) {
    		row.timeSpend = timeDifference( timespendStart, timespendEnd ).duration;
    	}
    }*/
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
      key: `attempt-${key}`
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
      className: "quiz-attempts__questions"
    }, `${row.questionCorrect} / ${row.questionCount}`), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
      className: "quiz-attempts__spend"
    }, row.timeSpend || '--'), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
      className: "quiz-attempts__marks"
    }, `${row.userMark} / ${row.mark}`), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
      className: "quiz-attempts__grade"
    }, row.passingGrade || '-'), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
      className: "quiz-attempts__result"
    }, `${parseFloat(row.result).toFixed(2)}%`, " ", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, row.graduationText)));
  })))));
};
function timeDifference(earlierDate, laterDate) {
  const oDiff = new Object();

  //  Calculate Differences
  //  -------------------------------------------------------------------  //
  let nTotalDiff = laterDate - earlierDate;
  oDiff.days = Math.floor(nTotalDiff / 1000 / 60 / 60 / 24);
  nTotalDiff -= oDiff.days * 1000 * 60 * 60 * 24;
  oDiff.hours = Math.floor(nTotalDiff / 1000 / 60 / 60);
  nTotalDiff -= oDiff.hours * 1000 * 60 * 60;
  oDiff.minutes = Math.floor(nTotalDiff / 1000 / 60);
  nTotalDiff -= oDiff.minutes * 1000 * 60;
  oDiff.seconds = Math.floor(nTotalDiff / 1000);
  //  -------------------------------------------------------------------  //

  //  Format Duration
  //  -------------------------------------------------------------------  //
  //  Format Hours
  let hourtext = '00';
  if (oDiff.days > 0) {
    hourtext = String(oDiff.days);
  }
  if (hourtext.length == 1) {
    hourtext = '0' + hourtext;
  }

  //  Format Minutes
  let mintext = '00';
  if (oDiff.minutes > 0) {
    mintext = String(oDiff.minutes);
  }
  if (mintext.length == 1) {
    mintext = '0' + mintext;
  }

  //  Format Seconds
  let sectext = '00';
  if (oDiff.seconds > 0) {
    sectext = String(oDiff.seconds);
  }
  if (sectext.length == 1) {
    sectext = '0' + sectext;
  }
  //  Set Duration
  const sDuration = hourtext + ':' + mintext + ':' + sectext;
  oDiff.duration = sDuration;
  //  -------------------------------------------------------------------  //

  return oDiff;
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Attempts);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/buttons/button-check.js":
/*!*****************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/buttons/button-check.js ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__);






class ButtonCheck extends _wordpress_element__WEBPACK_IMPORTED_MODULE_2__.Component {
  constructor() {
    super(...arguments);
    this.state = {
      loading: false
    };
  }
  checkAnswer = () => {
    const {
      checkAnswer,
      question,
      answered
    } = this.props;

    // Fix temporary for FIB.
    if (question.type === 'fill_in_blanks') {
      const elFIB = document.querySelector(`.question-fill_in_blanks[data-id="${question.id}"]`);
      const elInputs = elFIB.querySelectorAll('.lp-fib-input > input');
      elInputs.forEach(elInput => {
        if (elInput.value.length > 0) {
          this.setState({
            loading: true
          });
          checkAnswer(question.id);
          return false;
        }
      });
    }
    if (answered) {
      checkAnswer(question.id);
      this.setState({
        loading: true
      });
    }
  };
  render() {
    const {
      answered
    } = this.props;
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: classnames__WEBPACK_IMPORTED_MODULE_1___default()('lp-button', 'instant-check', {
        loading: this.state.loading
      }),
      onClick: this.checkAnswer
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "instant-check__icon"
    }), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Check answers', 'learnpress'), !answered && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "instant-check__info",
      dangerouslySetInnerHTML: {
        __html: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('You need to answer the question before checking the answer key.', 'learnpress')
      }
    })));
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_4__.compose)((0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.withSelect)((select, {
  question: {
    id
  }
}) => {
  const {
    getQuestionAnswered
  } = select('learnpress/quiz');
  return {
    answered: getQuestionAnswered(id)
  };
}), (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.withDispatch)((dispatch, {
  id
}) => {
  const {
    checkAnswer
  } = dispatch('learnpress/quiz');
  return {
    checkAnswer(id) {
      checkAnswer(id);
    }
  };
}))(ButtonCheck));

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/buttons/button-hint.js":
/*!****************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/buttons/button-hint.js ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);





class ButtonHint extends _wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Component {
  /**
   * Callback to show hint of question
   */
  showHint = () => {
    const {
      showHint,
      question
    } = this.props;
    showHint(question.id, !question.showHint);
  };
  render() {
    const {
      question
    } = this.props;
    return question.hint ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: "btn-show-hint",
      onClick: this.showHint
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Hint', 'learnpress'))) : '';
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__.compose)((0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.withDispatch)((dispatch, {
  id
}) => {
  const {
    showHint
  } = dispatch('learnpress/quiz');
  return {
    showHint(id, show) {
      showHint(id, show);
    }
  };
}))(ButtonHint));

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/buttons/index.js":
/*!**********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/buttons/index.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   MaybeShowButton: () => (/* binding */ MaybeShowButton),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);





class Buttons extends _wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Component {
  startQuiz = event => {
    event && event.preventDefault();
    const btn = document.querySelector('.lp-button.start');
    btn && btn.setAttribute('disabled', 'disabled');
    btn.classList.add('loading');
    const {
      startQuiz,
      status
    } = this.props;
    if (status === 'completed') {
      const {
        confirm,
        isOpen
      } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.select)('learnpress/modal');
      if ('no' === confirm((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Are you sure you want to retake the quiz?', 'learnpress'), this.startQuiz)) {
        !isOpen() && btn && btn.removeAttribute('disabled');
        return;
      }
    }

    // No require enroll
    /*if ( lpQuizSettings.checkNorequizenroll === 1 ) {
    	// Reset data
    	window.localStorage.removeItem( 'quiz_start_' + lpQuizSettings.id );
    	window.localStorage.removeItem( 'quiz_userdata_' + lpQuizSettings.id );
    	window.localStorage.setItem( 'quiz_start_' + lpQuizSettings.id, Date.now() );
    		// Set retake to local.storage
    	const retakenNumber = window.localStorage.getItem( 'quiz_retake_' + lpQuizSettings.id );
    	if ( retakenNumber >= 1 ) {
    		window.localStorage.setItem( 'quiz_retake_' + lpQuizSettings.id, parseInt( retakenNumber ) + 1 );
    	} else {
    		window.localStorage.setItem( 'quiz_retake_' + lpQuizSettings.id, 1 );
    	}
    }*/

    startQuiz();
  };
  nav = to => event => {
    let {
      questionNav,
      currentPage,
      numPages,
      setCurrentPage
    } = this.props;
    switch (to) {
      case 'prev':
        if (currentPage > 1) {
          currentPage = currentPage - 1;
        } else if (questionNav === 'infinity') {
          currentPage = numPages;
        } else {
          currentPage = 1;
        }
        break;
      default:
        if (currentPage < numPages) {
          currentPage = currentPage + 1;
        } else if (questionNav === 'infinity') {
          currentPage = 1;
        } else {
          currentPage = numPages;
        }
    }
    setCurrentPage(currentPage);
  };
  moveTo = pageNum => event => {
    event.preventDefault();
    const {
      numPages,
      setCurrentPage
    } = this.props;
    if (pageNum < 1 || pageNum > numPages) {
      return;
    }
    setCurrentPage(pageNum);
  };
  isLast = () => {
    const {
      currentPage,
      numPages
    } = this.props;
    return currentPage === numPages;
  };
  isFirst = () => {
    const {
      currentPage
    } = this.props;
    return currentPage === 1;
  };
  submit = () => {
    const {
      submitQuiz
    } = this.props;
    const {
      confirm
    } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.select)('learnpress/modal');
    if ('no' === confirm((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Are you sure to submit the quiz?', 'learnpress'), this.submit)) {
      return;
    }
    submitQuiz();
  };
  setQuizMode = mode => () => {
    const {
      setQuizMode
    } = this.props;
    setQuizMode(mode);
  };
  isReviewing = () => {
    const {
      isReviewing
    } = this.props;
    return isReviewing;
  };
  pageNumbers(args) {
    const {
      numPages,
      currentPage
    } = this.props;
    if (numPages < 2) {
      return '';
    }
    args = {
      numPages,
      currentPage,
      midSize: 1,
      endSize: 1,
      prevNext: true,
      ...(args || {})
    };
    if (args.endSize < 1) {
      args.endSize = 1;
    }
    if (args.midSize < 0) {
      args.midSize = 1;
    }
    const numbers = [...Array(numPages).keys()];
    let dots = false;
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "nav-links"
    }, args.prevNext && !this.isFirst() && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: "page-numbers prev",
      "data-type": "question-navx",
      onClick: this.nav('prev')
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Prev', 'learnpress')), numbers.map(number => {
      number = number + 1;
      if (number === args.currentPage) {
        dots = true;
        return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
          key: `page-number-${number}`,
          className: "page-numbers current"
        }, number);
      }
      if (number <= args.endSize || args.currentPage && number >= args.currentPage - args.midSize && number <= args.currentPage + args.midSize || number > args.numPages - args.endSize) {
        dots = true;
        return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
          key: `page-number-${number}`,
          className: "page-numbers",
          onClick: this.moveTo(number)
        }, number);
      } else if (dots) {
        dots = false;
        return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
          key: `page-number-${number}`,
          className: "page-numbers dots"
        }, "\u2026");
      }
      return '';
    }), args.prevNext && !this.isLast() && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: "page-numbers next",
      "data-type": "question-navx",
      onClick: this.nav('next')
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Next', 'learnpress')));
  }
  render() {
    const {
      status,
      questionNav,
      isReviewing,
      showReview,
      numPages,
      question,
      questionsPerPage,
      canRetry,
      retakeNumber,
      requiredPassword,
      allowRetake
    } = this.props;
    const classNames = ['quiz-buttons'];
    if (status === 'started' || isReviewing) {
      classNames.push('align-center');
    }
    if (questionNav === 'questionNav') {
      classNames.push('infinity');
    }
    if (this.isFirst()) {
      classNames.push('is-first');
    }
    if (this.isLast()) {
      classNames.push('is-last');
    }
    const popupSidebar = document.querySelector('#popup-sidebar');
    const quizzApp = document.querySelector('#learn-press-quiz-app');
    let styles = '';
    if (status === 'started' || isReviewing) {
      styles = {
        marginLeft: popupSidebar && popupSidebar.offsetWidth / 2,
        width: quizzApp && quizzApp.offsetWidth
      };
    } else {
      styles = null;
    }
    let navPositionClass = ' fixed';
    if (lpQuizSettings.navigationPosition == 'no') {
      navPositionClass = ' nav-center';
    }
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: classNames.join(' ')
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: `button-left` + (status === 'started' || isReviewing ? navPositionClass : ''),
      style: styles
    }, (status === 'completed' && canRetry || -1 !== ['', 'viewed'].indexOf(status)) && !isReviewing && !requiredPassword && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: "lp-button start",
      onClick: this.startQuiz
    }, status === 'completed' ? `${(0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Retake', 'learnpress')} ${!allowRetake ? ` ${retakeNumber ? ` (${retakeNumber})` : ''}` : ''} ` : ' ' + (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Start', 'learnpress')), ('started' === status || isReviewing) && numPages > 1 && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "questions-pagination"
    }, this.pageNumbers()))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "button-right"
    }, 'started' === status && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, ('infinity' === questionNav || this.isLast()) && !isReviewing && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: "lp-button submit-quiz",
      onClick: this.submit
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Finish Quiz', 'learnpress'))), isReviewing && showReview && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: "lp-button back-quiz",
      onClick: this.setQuizMode('')
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Result', 'learnpress')), 'completed' === status && showReview && !isReviewing && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: "lp-button review-quiz",
      onClick: this.setQuizMode('reviewing')
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Review', 'learnpress')))), this.props.message && this.props.success !== true && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "learn-press-message error"
    }, this.props.message));
  }
}

/**
 * Helper function to check a button should be show or not.
 *
 * Buttons [hint, check]
 */
const MaybeShowButton = (0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__.compose)((0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.withSelect)(select => {
  const {
    getData
  } = select('learnpress/quiz');
  return {
    status: getData('status'),
    showCheck: getData('instantCheck'),
    checkedQuestions: getData('checkedQuestions'),
    hintedQuestions: getData('hintedQuestions'),
    questionsPerPage: getData('questionsPerPage')
  };
}))(props => {
  const {
    showCheck,
    checkedQuestions,
    hintedQuestions,
    question,
    status,
    type,
    Button
  } = props;
  if (status !== 'started') {
    return false;
  }
  const theButton = (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Button, {
    question: question
  });
  switch (type) {
    case 'hint':
      if (!hintedQuestions) {
        return theButton;
      }
      if (!question.hasHint) {
        return false;
      }
      return hintedQuestions.indexOf(question.id) === -1 && theButton;
    case 'check':
      if (!showCheck) {
        return false;
      }
      if (!checkedQuestions) {
        return theButton;
      }
      return checkedQuestions.indexOf(question.id) === -1 && theButton;
  }
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__.compose)([(0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.withSelect)(select => {
  const {
    getData,
    getCurrentQuestion
  } = select('learnpress/quiz');
  const data = {
    id: getData('id'),
    status: getData('status'),
    questionIds: getData('questionIds'),
    questionNav: getData('questionNav'),
    isReviewing: getData('reviewQuestions') && getData('mode') === 'reviewing',
    showReview: getData('reviewQuestions'),
    showCheck: getData('instantCheck'),
    checkedQuestions: getData('checkedQuestions'),
    hintedQuestions: getData('hintedQuestions'),
    numPages: getData('numPages'),
    pages: getData('pages'),
    currentPage: getData('currentPage'),
    questionsPerPage: getData('questionsPerPage'),
    pageNumbers: getData('pageNumbers'),
    keyPressed: getData('keyPressed'),
    canRetry: getData('retakeCount') > 0 && getData('retaken') < getData('retakeCount'),
    retakeNumber: getData('retakeCount') > 0 && getData('retaken') < getData('retakeCount') ? getData('retakeCount') - getData('retaken') : null,
    message: getData('messageResponse') || false,
    success: getData('successResponse') !== undefined ? getData('successResponse') : true,
    requiredPassword: getData('requiredPassword'),
    allowRetake: getData('allowRetake')
  };
  if (data.questionsPerPage === 1) {
    data.question = getCurrentQuestion('object');
  }
  if (lpQuizSettings.checkNorequizenroll === 1) {
    const retakenCurrent = window.localStorage.getItem('quiz_off_retaken_' + lpQuizSettings.id);
    if (getData('retakeCount') > retakenCurrent) {
      data.retakeNumber = getData('retakeCount') - retakenCurrent;
      data.canRetry = true;
    } else {
      data.canRetry = false;
    }
  }
  if (data.allowRetake) {
    data.canRetry = true;
  }
  return data;
}), (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.withDispatch)((dispatch, {
  id
}) => {
  const {
    startQuiz,
    setCurrentQuestion,
    submitQuiz,
    setQuizMode,
    showHint,
    checkAnswer,
    setCurrentPage
  } = dispatch('learnpress/quiz');
  return {
    startQuiz,
    setCurrentQuestion,
    setQuizMode,
    setCurrentPage,
    submitQuiz(id) {
      submitQuiz(id);
    },
    showHint(id) {
      showHint(id);
    },
    checkAnswer(id) {
      checkAnswer(id);
    }
  };
})])(Buttons));

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/content/index.js":
/*!**********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/content/index.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_1__);

/**
 * Quizz Content.
 * Edit: Use React hook.
 *
 * @author nhamdv - ThimPress
 */

const Content = () => {
  const content = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_1__.select)('learnpress/quiz').getData('content');
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "quiz-content",
    dangerouslySetInnerHTML: {
      __html: content
    }
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Content);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/duration/index.js":
/*!***********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/duration/index.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const formatDuration = seconds => {
  let d;
  const dayInSeconds = 3600 * 24;
  if (seconds > dayInSeconds) {
    d = (seconds - seconds % dayInSeconds) / dayInSeconds;
    seconds = seconds % dayInSeconds;
  } else if (seconds == dayInSeconds) {
    return '24:00';
  }
  const x = new Date(seconds * 1000).toUTCString().match(/\d{2}:\d{2}:\d{2}/)[0].split(':');
  if (d) {
    x[0] = parseInt(x[0]) + d * 24;
  }
  const html = x.join(':');
  return html;
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (formatDuration);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/index.js":
/*!**************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/index.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Attempts: () => (/* reexport safe */ _attempts__WEBPACK_IMPORTED_MODULE_5__["default"]),
/* harmony export */   Buttons: () => (/* reexport safe */ _buttons__WEBPACK_IMPORTED_MODULE_3__["default"]),
/* harmony export */   Content: () => (/* reexport safe */ _content__WEBPACK_IMPORTED_MODULE_1__["default"]),
/* harmony export */   Meta: () => (/* reexport safe */ _meta__WEBPACK_IMPORTED_MODULE_2__["default"]),
/* harmony export */   Questions: () => (/* reexport safe */ _questions__WEBPACK_IMPORTED_MODULE_4__["default"]),
/* harmony export */   Result: () => (/* reexport safe */ _result__WEBPACK_IMPORTED_MODULE_7__["default"]),
/* harmony export */   Status: () => (/* reexport safe */ _status__WEBPACK_IMPORTED_MODULE_8__["default"]),
/* harmony export */   Timer: () => (/* reexport safe */ _timer__WEBPACK_IMPORTED_MODULE_6__["default"]),
/* harmony export */   Title: () => (/* reexport safe */ _title__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _title__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./title */ "./assets/src/apps/js/frontend/quiz/components/title/index.js");
/* harmony import */ var _content__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./content */ "./assets/src/apps/js/frontend/quiz/components/content/index.js");
/* harmony import */ var _meta__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./meta */ "./assets/src/apps/js/frontend/quiz/components/meta/index.js");
/* harmony import */ var _buttons__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./buttons */ "./assets/src/apps/js/frontend/quiz/components/buttons/index.js");
/* harmony import */ var _questions__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./questions */ "./assets/src/apps/js/frontend/quiz/components/questions/index.js");
/* harmony import */ var _attempts__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./attempts */ "./assets/src/apps/js/frontend/quiz/components/attempts/index.js");
/* harmony import */ var _timer__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./timer */ "./assets/src/apps/js/frontend/quiz/components/timer/index.js");
/* harmony import */ var _result__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./result */ "./assets/src/apps/js/frontend/quiz/components/result/index.js");
/* harmony import */ var _status__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./status */ "./assets/src/apps/js/frontend/quiz/components/status/index.js");










/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/meta/index.js":
/*!*******************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/meta/index.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _duration__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../duration */ "./assets/src/apps/js/frontend/quiz/components/duration/index.js");

/**
 * Quiz Meta.
 * Edit: Use React Hook.
 *
 * @author Nhamdv - ThimPress
 */



const {
  Hook
} = LP;
const Meta = () => {
  const getData = attr => {
    return (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_1__.select)('learnpress/quiz').getData(attr);
  };
  const metaFields = Hook.applyFilters('quiz-meta-fields', {
    duration: {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Duration:', 'learnpress'),
      name: 'duration',
      content: (0,_duration__WEBPACK_IMPORTED_MODULE_3__["default"])(getData('duration')) || '--'
    },
    passingGrade: {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Passing grade:', 'learnpress'),
      name: 'passing-grade',
      content: getData('passingGrade') || '--'
    },
    questionsCount: {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Questions:', 'learnpress'),
      name: 'questions-count',
      content: getData('questionIds') ? getData('questionIds').length : 0
    }
  });
  return metaFields && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("ul", {
    className: "quiz-intro"
  }, Object.values(metaFields).map((field, i) => {
    const id = field.name || i;
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
      key: `quiz-intro-field-${i}`,
      className: `quiz-intro-item quiz-intro-item--${id}`
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "quiz-intro-item__title",
      dangerouslySetInnerHTML: {
        __html: field.title
      }
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "quiz-intro-item__content",
      dangerouslySetInnerHTML: {
        __html: field.content
      }
    }));
  })));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Meta);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/questions/buttons.js":
/*!**************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/questions/buttons.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _buttons_button_hint__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../buttons/button-hint */ "./assets/src/apps/js/frontend/quiz/components/buttons/button-hint.js");
/* harmony import */ var _buttons_button_check__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../buttons/button-check */ "./assets/src/apps/js/frontend/quiz/components/buttons/button-check.js");
/* harmony import */ var _buttons__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../buttons */ "./assets/src/apps/js/frontend/quiz/components/buttons/index.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_4__);





const Buttons = function Buttons(props) {
  const {
    question
  } = props;
  const buttons = {
    'instant-check': () => {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_buttons__WEBPACK_IMPORTED_MODULE_3__.MaybeShowButton, {
        type: "check",
        Button: _buttons_button_check__WEBPACK_IMPORTED_MODULE_2__["default"],
        question: question
      });
    },
    hint: () => {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_buttons__WEBPACK_IMPORTED_MODULE_3__.MaybeShowButton, {
        type: "hint",
        Button: _buttons_button_hint__WEBPACK_IMPORTED_MODULE_1__["default"],
        question: question
      });
    }
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_4__.Fragment, null, LP.config.questionFooterButtons().map(name => {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_4__.Fragment, {
      key: `button-${name}`
    }, buttons[name] && buttons[name]());
  }));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Buttons);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/questions/index.js":
/*!************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/questions/index.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _question__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./question */ "./assets/src/apps/js/frontend/quiz/components/questions/question.js");






class Questions extends _wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Component {
  constructor(props) {
    super(...arguments);
    this.needToTop = false;
    this.state = {
      isReviewing: null,
      currentPage: 0,
      self: this
    };
  }
  static getDerivedStateFromProps(props, state) {
    const checkProps = ['isReviewing', 'currentPage'];
    const changedProps = {};
    for (let i = 0; i < checkProps.length; i++) {
      if (props[checkProps[i]] !== state[checkProps[i]]) {
        changedProps[checkProps[i]] = props[checkProps[i]];
      }
    }
    if (Object.values(changedProps).length) {
      state.self.needToTop = true;
      return changedProps;
    }
    return null;
  }

  // componentWillReceiveProps(nextProps){
  //     const checkProps = ['isReviewing', 'currentPage'];
  //
  //     for(let i = 0; i < checkProps.length; i++){
  //         if(this.props[checkProps[i]] !== nextProps[checkProps[i]]){
  //             this.needToTop = true;
  //             return;
  //         }
  //     }
  //
  // }

  // componentWillUpdate() {
  //     this.needToTop = this.state.needToTop;
  //     this.setState({needToTop: false});
  // }

  componentDidUpdate() {
    if (this.needToTop) {
      jQuery('#popup-content').animate({
        scrollTop: 0
      }).find('.content-item-scrollable:last').animate({
        scrollTop: 0
      });
      this.needToTop = false;
    }
  }
  startQuiz = event => {
    event.preventDefault();
    const {
      startQuiz
    } = this.props;
    startQuiz();
  };
  isInVisibleRange = (id, index) => {
    const {
      currentPage,
      questionsPerPage
    } = this.props;
    return currentPage === Math.ceil(index / questionsPerPage);
  };
  nav = event => {
    const {
      sendKey
    } = this.props;
    switch (event.keyCode) {
      case 37:
        return sendKey('left');
      case 38:
        return;
      case 39:
        return sendKey('right');
      case 40:
        return;
      default:
        if (event.keyCode >= 49 && event.keyCode <= 57) {
          sendKey(event.keyCode - 48);
        }
    }
  };
  render() {
    const {
      status,
      currentQuestion,
      questions,
      questionsRendered,
      isReviewing,
      questionsPerPage
    } = this.props;
    let isShow = true;
    if (status === 'completed' && !isReviewing) {
      isShow = false;
    }
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      tabIndex: 100,
      onKeyUp: this.nav
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "quiz-questions",
      style: {
        display: isShow ? '' : 'none'
      }
    }, questions.map((question, index) => {
      const isCurrent = questionsPerPage ? false : currentQuestion === question.id;
      const isRendered = questionsRendered && questionsRendered.indexOf(question.id) !== -1;
      const isVisible = this.isInVisibleRange(question.id, index + 1);
      return isRendered || !isRendered || isVisible ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_question__WEBPACK_IMPORTED_MODULE_5__["default"], {
        key: `loop-question-${question.id}`,
        isCurrent: isCurrent,
        isShow: isVisible,
        isShowIndex: questionsPerPage ? index + 1 : false,
        questionsPerPage: questionsPerPage,
        question: question
      }) : '';
    }))));
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__.compose)((0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.withSelect)((select, a, b) => {
  const {
    getData,
    getQuestions
  } = select('learnpress/quiz');
  return {
    status: getData('status'),
    currentQuestion: getData('currentQuestion'),
    questions: getQuestions(),
    questionsRendered: getData('questionsRendered'),
    isReviewing: getData('mode') === 'reviewing',
    numPages: getData('numPages'),
    currentPage: getData('currentPage'),
    questionsPerPage: getData('questionsPerPage') || 1
  };
}), (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.withDispatch)(dispatch => {
  const {
    startQuiz,
    sendKey
  } = dispatch('learnpress/quiz');
  return {
    startQuiz,
    sendKey
  };
}))(Questions));

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/questions/question.js":
/*!***************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/questions/question.js ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _buttons__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./buttons */ "./assets/src/apps/js/frontend/quiz/components/questions/buttons.js");
/* harmony import */ var _buttons__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../buttons */ "./assets/src/apps/js/frontend/quiz/components/buttons/index.js");
/* harmony import */ var _buttons_button_check__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../buttons/button-check */ "./assets/src/apps/js/frontend/quiz/components/buttons/button-check.js");
/* harmony import */ var _buttons_button_hint__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../buttons/button-hint */ "./assets/src/apps/js/frontend/quiz/components/buttons/button-hint.js");









const $ = window.jQuery;
const {
  uniqueId,
  isArray,
  isNumber,
  bind
} = lodash;
class Question extends _wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Component {
  constructor() {
    super(...arguments);
    this.state = {
      time: null,
      showHint: false
    };
    this.$wrap = null;
  }
  componentDidMount(a) {
    const {
      question,
      isCurrent,
      markQuestionRendered
    } = this.props;
    if (isCurrent) {
      markQuestionRendered(question.id);
    }
    if (!this.state.time) {
      this.setState({
        time: new Date()
      });
    }
    LP.Hook.doAction('lp-question-compatible-builder');
    if (typeof MathJax !== 'undefined' && typeof MathJax.Hub !== 'undefined') {
      MathJax.Hub.Queue(['Typeset', MathJax.Hub]);
    }
    return a;
  }
  setRef = el => {
    this.$wrap = $(el);
  };
  parseOptions = options => {
    if (options) {
      options = !isArray(options) ? JSON.parse(CryptoJS.AES.decrypt(options.data, options.key, {
        format: CryptoJSAesJson
      }).toString(CryptoJS.enc.Utf8)) : options;
      options = !isArray(options) ? JSON.parse(options) : options;
    }
    return options || [];
  };
  getWrapperClass = () => {
    const {
      question,
      answered
    } = this.props;
    const classes = ['question', 'question-' + question.type];
    const options = this.parseOptions(question.options);
    if (options.length && options[0].isTrue !== undefined) {
      classes.push('question-answered');
    }
    return classes;
  };
  getEditLink = () => {
    const {
      question,
      editPermalink
    } = this.props;
    return editPermalink ? editPermalink.replace(/post=(.*[0-9])/, `post=${question.id}`) : '';
  };
  editPermalink = editPermalink => {
    return (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.sprintf)('<a href="%s">%s</a>', editPermalink, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Edit', 'learnpress'));
  };
  render() {
    const {
      question,
      isShow,
      isShowIndex,
      isShowHint,
      status
    } = this.props;
    const QuestionTypes = LP.questionTypes.default;
    const editPermalink = this.getEditLink();
    if (editPermalink) {
      jQuery('#wp-admin-bar-edit-lp_question').find('.ab-item').attr('href', editPermalink);
    }
    const titleParts = {
      index: () => {
        return isShowIndex ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
          className: "question-index"
        }, isShowIndex, ".") : '';
      },
      title: () => {
        return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
          dangerouslySetInnerHTML: {
            __html: question.title
          }
        });
      },
      hint: () => {
        return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_buttons_button_hint__WEBPACK_IMPORTED_MODULE_8__["default"], {
          question: question
        });
      },
      'edit-permalink': () => {
        return editPermalink && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
          dangerouslySetInnerHTML: {
            __html: this.editPermalink(editPermalink)
          },
          className: "edit-link"
        });
      }
    };
    const blocks = {
      title: () => {
        return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
          className: "question-title"
        }, LP.config.questionTitleParts().map(name => {
          return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, {
            key: `title-part-${name}`
          }, titleParts[name] && titleParts[name]());
        }));
      },
      content: () => {
        return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          className: "question-content",
          dangerouslySetInnerHTML: {
            __html: question.content
          }
        });
      },
      'answer-options': () => {
        return this.$wrap && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(QuestionTypes, {
          ...this.props,
          $wrap: this.$wrap
        });
      },
      explanation: () => {
        return question.explanation && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          className: "question-explanation-content"
        }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", {
          className: "explanation-title"
        }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Explanation', 'learnpress'), ":"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          dangerouslySetInnerHTML: {
            __html: question.explanation
          }
        })));
      },
      hint: () => {
        return question.hint && !question.explanation && question.showHint && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          className: "question-hint-content"
        }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", {
          className: "hint-title"
        }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Hint', 'learnpress'), ":"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          dangerouslySetInnerHTML: {
            __html: question.hint
          }
        })));
      },
      buttons: () => {
        return 'started' === status && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_buttons__WEBPACK_IMPORTED_MODULE_5__["default"], {
          question: question
        });
      }
    };
    const configBlocks = LP.config.questionBlocks();
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: this.getWrapperClass().join(' '),
      style: {
        display: isShow ? '' : 'none'
      },
      "data-id": question.id,
      ref: this.setRef
    }, configBlocks.map(name => {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, {
        key: `block-${name}`
      }, blocks[name] ? blocks[name]() : '');
    })));
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__.compose)([(0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.withSelect)((select, {
  question: {
    id
  }
}) => {
  const {
    getData,
    getQuestionAnswered,
    getQuestionMark
  } = select('learnpress/quiz');
  return {
    status: getData('status'),
    questions: getData('question'),
    answered: getQuestionAnswered(id),
    questionsRendered: getData('questionsRendered'),
    editPermalink: getData('editPermalink'),
    numPages: getData('numPages'),
    mark: getQuestionMark(id) || ''
  };
}), (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.withDispatch)(dispatch => {
  const {
    updateUserQuestionAnswers,
    updateUserQuestionFibAnswers,
    markQuestionRendered
  } = dispatch('learnpress/quiz');
  return {
    markQuestionRendered,
    updateUserQuestionAnswers,
    updateUserQuestionFibAnswers
  };
})])(Question));

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/result/index.js":
/*!*********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/result/index.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _single_curriculum_components_items_progress__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../single-curriculum/components/items-progress */ "./assets/src/apps/js/frontend/single-curriculum/components/items-progress.js");

/**
 * Quizz Result.
 * Edit: Use React hook.
 *
 * @author Nhamdv - ThimPress
 */




const {
  debounce
} = lodash;
const Result = () => {
  const [percentage, setPercentage] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(0);
  const [done, setDone] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const QuizID = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => {
    return select('learnpress/quiz').getData('id');
  }, []);
  const results = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => {
    return select('learnpress/quiz').getData('results');
  }, []);
  const passingGrade = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => {
    return select('learnpress/quiz').getData('passingGrade');
  }, []);
  const submitting = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => {
    return select('learnpress/quiz').getData('submitting');
  }, []);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    animate();
    let graduation = '';
    if (results.graduation) {
      graduation = results.graduation;
    } else if (results.result >= passingGradeValue) {
      graduation = 'passed';
    } else {
      graduation = 'failed';
    }
    if (graduation) {
      const ele = document.querySelector(`.course-curriculum .course-item.course-item-${QuizID}`);
      if (ele) {
        ele.classList.remove('failed', 'passed');
        ele.classList.add('has-status', 'status-completed', graduation);
      }
    }
    const item = [...document.querySelectorAll('#popup-header .items-progress')][0];
    const elCurriculumSections = document.querySelector('.curriculum-sections');
    if (item && elCurriculumSections) {
      const totalItems = item.dataset.totalItems;
      const itemCompleted = item.querySelector('.items-completed');
      const elProgress = item.querySelector('.learn-press-progress__active');
      if (itemCompleted) {
        // const number = parseInt( itemCompleted.textContent );

        const allItemCompleted = document.querySelectorAll('#popup-sidebar .course-curriculum .course-item.status-completed');
        itemCompleted.textContent = parseInt(allItemCompleted.length);

        // Set progress
        const perCent = parseInt(allItemCompleted.length) * 100 / parseInt(totalItems);
        const percentSet = 100 - perCent;
        elProgress.style.left = '-' + percentSet + '%';
      }
    }
  }, [results]);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    if (submitting !== undefined) {
      updateItemsProgress();
    }
  }, [submitting]);
  const updateItemsProgress = () => {
    const elements = document.querySelectorAll('.popup-header__inner');
    if (elements.length > 0 && elements[0].querySelectorAll('form.form-button-finish-course').length === 0) {
      (0,_single_curriculum_components_items_progress__WEBPACK_IMPORTED_MODULE_4__.getResponse)(elements[0]);
    }
  };
  const animate = () => {
    setPercentage(0);
    setDone(false);
    jQuery.easing._customEasing = function (e, f, a, h, g) {
      return h * Math.sqrt(1 - (f = f / g - 1) * f) + a;
    };
    debounce(() => {
      const $el = jQuery('<span />').css({
        width: 1,
        height: 1
      }).appendTo(document.body);
      $el.css('left', 0).animate({
        left: results.result
      }, {
        duration: 1500,
        step: (now, fx) => {
          setPercentage(now);
        },
        done: () => {
          setDone(true);
          $el.remove();
          jQuery('#quizResultGrade').css({
            transform: 'scale(1.3)',
            transition: 'all 0.25s'
          });
          debounce(() => {
            jQuery('#quizResultGrade').css({
              transform: 'scale(1)'
            });
          }, 500)();
        },
        easing: '_customEasing'
      });
    }, results.result > 0 ? 1000 : 10)();
  };

  /**
   * Render HTML elements.
   *
   */

  let percentResult = percentage;
  if (!Number.isInteger(percentage)) {
    percentResult = parseFloat(percentage).toFixed(2);
  }
  const border = 10;
  const width = 200;
  const radius = width / 2;
  const r = (width - border) / 2;
  const circumference = r * 2 * Math.PI;
  const offset = circumference - percentResult / 100 * circumference;
  const styles = {
    strokeDasharray: `${circumference} ${circumference}`,
    strokeDashoffset: offset
  };
  const passingGradeValue = parseFloat(results.passingGrade || passingGrade);
  let graduation = '';
  if (results.graduation) {
    graduation = results.graduation;
  } else if (percentResult >= passingGradeValue) {
    graduation = 'passed';
  } else {
    graduation = 'failed';
  }
  let message = '';
  if (results.graduationText) {
    message = results.graduationText;
  } else if (graduation === 'passed') {
    message = (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Passed', 'learnpress');
  } else {
    message = (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Failed', 'learnpress');
  }
  const classNames = ['quiz-result', graduation];
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: classNames.join(' ')
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "result-heading"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Your Result', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    id: "quizResultGrade",
    className: "result-grade"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    className: "circle-progress-bar",
    width: width,
    height: width
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("circle", {
    className: "circle-progress-bar__circle",
    stroke: "",
    strokeWidth: border,
    style: styles,
    fill: "transparent",
    r: r,
    cx: radius,
    cy: radius
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "result-achieved"
  }, `${percentResult}%`), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "result-require"
  }, passingGradeValue + '%' || 0)), done && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "result-message"
  }, message), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("ul", {
    className: "result-statistic"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    className: "result-statistic-field result-time-spend"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Time spent', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, results.timeSpend)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    className: "result-statistic-field result-point"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Points', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, results.userMark, " / ", results.mark)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    className: "result-statistic-field result-questions"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Questions', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, results.questionCount)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    className: "result-statistic-field result-questions-correct"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Correct', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, results.questionCorrect)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    className: "result-statistic-field result-questions-wrong"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Wrong', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, results.questionWrong)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    className: "result-statistic-field result-questions-skipped"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Skipped', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, results.questionEmpty)), typeof results.minusPoint !== 'undefined' && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    className: "result-statistic-field result-questions-minus"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Minus points', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, results.minusPoint))));
  function timeDifference(earlierDate, laterDate) {
    const oDiff = new Object();

    //  Calculate Differences
    //  -------------------------------------------------------------------  //
    let nTotalDiff = laterDate - earlierDate;
    oDiff.days = Math.floor(nTotalDiff / 1000 / 60 / 60 / 24);
    nTotalDiff -= oDiff.days * 1000 * 60 * 60 * 24;
    oDiff.hours = Math.floor(nTotalDiff / 1000 / 60 / 60);
    nTotalDiff -= oDiff.hours * 1000 * 60 * 60;
    oDiff.minutes = Math.floor(nTotalDiff / 1000 / 60);
    nTotalDiff -= oDiff.minutes * 1000 * 60;
    oDiff.seconds = Math.floor(nTotalDiff / 1000);
    //  -------------------------------------------------------------------  //

    //  Format Duration
    //  -------------------------------------------------------------------  //
    //  Format Hours
    let hourtext = '00';
    if (oDiff.days > 0) {
      hourtext = String(oDiff.days);
    }
    if (hourtext.length == 1) {
      hourtext = '0' + hourtext;
    }

    //  Format Minutes
    let mintext = '00';
    if (oDiff.minutes > 0) {
      mintext = String(oDiff.minutes);
    }
    if (mintext.length == 1) {
      mintext = '0' + mintext;
    }

    //  Format Seconds
    let sectext = '00';
    if (oDiff.seconds > 0) {
      sectext = String(oDiff.seconds);
    }
    if (sectext.length == 1) {
      sectext = '0' + sectext;
    }
    //  Set Duration
    const sDuration = hourtext + ':' + mintext + ':' + sectext;
    oDiff.duration = sDuration;
    //  -------------------------------------------------------------------  //

    return oDiff;
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Result);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/status/index.js":
/*!*********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/status/index.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _timer__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../timer */ "./assets/src/apps/js/frontend/quiz/components/timer/index.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);





const $ = jQuery;
const {
  debounce
} = lodash;
const Status = () => {
  const {
    submitQuiz
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.dispatch)('learnpress/quiz');
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    const $pc = $('#popup-content');
    if (!$pc.length) {
      return;
    }
    const $sc = $pc.find('.content-item-scrollable:eq(1)');
    const $qs = $pc.find('.quiz-status');
    const pcTop = $qs.offset().top - 92;
    let isFixed = false;

    /**
     * Check when status bar is stopped in the top
     * to add new class into html
     */
    $sc.on('scroll', () => {
      if ($sc.scrollTop() >= pcTop) {
        if (isFixed) {
          return;
        }
        isFixed = true;
      } else {
        if (!isFixed) {
          return;
        }
        isFixed = false;
      }
      if (isFixed) {
        $pc.addClass('fixed-quiz-status');
      } else {
        $pc.removeClass('fixed-quiz-status');
      }
    });
  }, []);

  /**
   * Submit question to record results.
   */
  const submit = () => {
    const {
      confirm
    } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.select)('learnpress/modal');
    if ('no' === confirm((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Are you sure to submit the quiz?', 'learnpress'), submit)) {
      return;
    }
    submitQuiz();
  };
  const getMark = () => {
    const answered = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.select)('learnpress/quiz').getData('answered');
    return Object.values(answered).reduce((m, r) => {
      return m + r.mark;
    }, 0);
  };
  const {
    getData,
    getUserMark
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.select)('learnpress/quiz');
  const currentPage = getData('currentPage');
  const questionsPerPage = getData('questionsPerPage');
  const questionsCount = getData('numberQuestionsToDo');
  const submitting = getData('submitting');
  const duration = getData('duration');
  const userMark = getUserMark();
  const classNames = ['quiz-status'];
  const start = (currentPage - 1) * questionsPerPage + 1;
  let end = start + questionsPerPage - 1;
  let indexHtml = '';
  end = Math.min(end, questionsCount);
  if (submitting) {
    classNames.push('submitting');
  }
  if (end < questionsCount) {
    if (questionsPerPage > 1) {
      indexHtml = (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.sprintf)((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Question <span>%d to %d of %d</span>', 'learnpress'), start, end, questionsCount);
    } else {
      indexHtml = (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.sprintf)((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Question <span>%d of %d</span>', 'learnpress'), start, questionsCount);
    }
  } else {
    indexHtml = (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.sprintf)((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Question <span>%d of %d</span>', 'learnpress'), start, end);
  }
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: classNames.join(' ')
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "questions-index",
    dangerouslySetInnerHTML: {
      __html: indexHtml
    }
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "current-point"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.sprintf)((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Earned Point: %s', 'learnpress'), userMark)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "submit-quiz"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "lp-button",
    id: "button-submit-quiz",
    onClick: submit
  }, !submitting ? (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Finish Quiz', 'learnpress') : (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Submitting…', 'learnpress'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_timer__WEBPACK_IMPORTED_MODULE_3__["default"], null))));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Status);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/timer/index.js":
/*!********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/timer/index.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);

/**
 * Edit: React hook.
 *
 * @author Nhamdv - ThimPress
 */


const Timer = () => {
  const {
    getData
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.select)('learnpress/quiz');
  const {
    submitQuiz
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.dispatch)('learnpress/quiz');
  const totalTime = getData('totalTime');
  const durationTime = getData('duration');
  const [seconds, setSeconds] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(totalTime);
  let [timeSpend, setTimeSpend] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(0);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    const myInterval = setInterval(() => {
      if (durationTime > 0) {
        let remainSeconds = seconds;
        remainSeconds -= 1;
        remainSeconds = wp.hooks.applyFilters('js-lp-quiz-remaining_time', remainSeconds, durationTime);
        if (remainSeconds > 0) {
          setSeconds(remainSeconds);
          timeSpend++;
          setTimeSpend(durationTime - remainSeconds);
        } else {
          clearInterval(myInterval);
          submitQuiz();
        }
      } else {
        // Apply when set duration = 0
        timeSpend++;
        setTimeSpend(timeSpend);
        setSeconds(timeSpend);
      }
    }, 1000);
    return () => clearInterval(myInterval);
  }, [seconds, timeSpend]);
  const formatTime = (separator = ':') => {
    const t = [];
    let m;
    if (totalTime < 3600) {
      t.push((seconds - seconds % 60) / 60);
      t.push(seconds % 60);
    } else if (totalTime) {
      t.push((seconds - seconds % 3600) / 3600);
      m = seconds % 3600;
      t.push((m - m % 60) / 60);
      t.push(m % 60);
    }
    return t.map(a => {
      return a < 10 ? `0${a}` : a;
    }).join(separator);
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "countdown"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("i", {
    className: "lp-icon-stopwatch"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, formatTime()), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "hidden",
    name: "lp-quiz-time-spend",
    value: timeSpend
  }));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Timer);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/components/title/index.js":
/*!********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/components/title/index.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

const Title = () => {
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "The title");
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Title);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/index.js":
/*!***************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/index.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _components__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components */ "./assets/src/apps/js/frontend/quiz/components/index.js");
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./store */ "./assets/src/apps/js/frontend/quiz/store/index.js");






const {
  chunk
} = lodash;
class Quiz extends _wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Component {
  constructor(props) {
    super(...arguments);
    this.state = {
      currentPage: 1,
      numPages: 0,
      pages: []
    };
  }
  componentDidMount() {
    const {
      settings,
      setQuizData
    } = this.props;
    const {
      question_ids,
      questions_per_page
    } = settings;
    const chunks = chunk(question_ids, questions_per_page);
    settings.currentPage = 1;
    settings.numPages = chunks.length;
    settings.pages = chunks;
    const answered = settings.id ? localStorage.getItem(`LP_Quiz_${settings.id}_Answered`) : false;
    if (answered) {
      settings.answered = JSON.parse(answered);
    }
    setQuizData(settings);
  }
  componentDidUpdate(prevProps, prevState, snapshot) {
    const {
      status
    } = prevProps;
    const elQuizContent = document.querySelector('.quiz-content');
    if (status !== undefined && elQuizContent) {
      elQuizContent.style.display = 'none';
    }
  }
  startQuiz = event => {
    this.props.startQuiz();
  };
  render() {
    const {
      status,
      isReviewing,
      answered
    } = this.props;
    wp.hooks.doAction('lp-js-quiz-answer', answered, status);
    const isA = -1 !== ['', 'completed', 'viewed'].indexOf(status) || !status;
    const notStarted = -1 !== ['', 'viewed', undefined].indexOf(status) || !status;

    // Just render content if status !== undefined (meant all data loaded)
    return undefined !== status && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, !isReviewing && 'completed' === status && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components__WEBPACK_IMPORTED_MODULE_4__.Result, null), !isReviewing && notStarted && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components__WEBPACK_IMPORTED_MODULE_4__.Meta, null), 'started' === status && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components__WEBPACK_IMPORTED_MODULE_4__.Status, null), (-1 !== ['completed', 'started'].indexOf(status) || isReviewing) && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components__WEBPACK_IMPORTED_MODULE_4__.Questions, null), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components__WEBPACK_IMPORTED_MODULE_4__.Buttons, null), isA && !isReviewing && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components__WEBPACK_IMPORTED_MODULE_4__.Attempts, null)));
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_2__.compose)([(0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.withSelect)(select => {
  const {
    getQuestions,
    getData
  } = select('learnpress/quiz');
  return {
    questions: getQuestions(),
    status: getData('status'),
    store: getData(),
    answered: getData('answered'),
    isReviewing: getData('mode') === 'reviewing',
    questionIds: getData('questionIds'),
    checkCount: getData('instantCheck'),
    questionsPerPage: getData('questionsPerPage') || 1
  };
}), (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.withDispatch)(dispatch => {
  const {
    setQuizData,
    startQuiz
  } = dispatch('learnpress/quiz');
  return {
    setQuizData,
    startQuiz
  };
})])(Quiz));

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/store/actions.js":
/*!***********************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/store/actions.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   __requestBeforeStartQuiz: () => (/* binding */ __requestBeforeStartQuiz),
/* harmony export */   __requestCheckAnswerSuccess: () => (/* binding */ __requestCheckAnswerSuccess),
/* harmony export */   __requestShowHintSuccess: () => (/* binding */ __requestShowHintSuccess),
/* harmony export */   __requestStartQuizSuccess: () => (/* binding */ __requestStartQuizSuccess),
/* harmony export */   __requestSubmitQuiz: () => (/* binding */ __requestSubmitQuiz),
/* harmony export */   __requestSubmitQuizSuccess: () => (/* binding */ __requestSubmitQuizSuccess),
/* harmony export */   checkAnswer: () => (/* binding */ checkAnswer),
/* harmony export */   markQuestionRendered: () => (/* binding */ markQuestionRendered),
/* harmony export */   sendKey: () => (/* binding */ sendKey),
/* harmony export */   setCurrentPage: () => (/* binding */ setCurrentPage),
/* harmony export */   setCurrentQuestion: () => (/* binding */ setCurrentQuestion),
/* harmony export */   setQuizData: () => (/* binding */ setQuizData),
/* harmony export */   setQuizMode: () => (/* binding */ setQuizMode),
/* harmony export */   showHint: () => (/* binding */ showHint),
/* harmony export */   startQuiz: () => (/* binding */ startQuiz),
/* harmony export */   submitQuiz: () => (/* binding */ submitQuiz),
/* harmony export */   updateUserQuestionAnswers: () => (/* binding */ updateUserQuestionAnswers),
/* harmony export */   updateUserQuestionFibAnswers: () => (/* binding */ updateUserQuestionFibAnswers)
/* harmony export */ });
/* harmony import */ var _learnpress_data_controls__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @learnpress/data-controls */ "@learnpress/data-controls");
/* harmony import */ var _learnpress_data_controls__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_learnpress_data_controls__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_1__);


function _dispatch() {
  const args = [].slice.call(arguments, 2);
  const d = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_1__.dispatch)(arguments[0]);
  const f = arguments[1];
  d[f](...args);
}
const {
  camelCaseDashObjectKeys,
  Hook
} = LP;
/**
 * Set user data for app.
 *
 * @param key
 * @param data
 */
function setQuizData(key, data) {
  if (typeof key === 'string') {
    data = {
      [key]: data
    };
  } else {
    data = key;
  }
  return {
    type: 'SET_QUIZ_DATA',
    data: camelCaseDashObjectKeys(data)
  };
}

/**
 * Set question will display.
 *
 * @param questionId
 */
function setCurrentQuestion(questionId) {
  return {
    type: 'SET_CURRENT_QUESTION',
    questionId
  };
}
function setCurrentPage(currentPage) {
  return {
    type: 'SET_CURRENT_PAGE',
    currentPage
  };
}
function __requestBeforeStartQuiz(quizId, courseId, userId) {
  return {
    type: 'BEFORE_START_QUIZ'
  };
}
function __requestStartQuizSuccess(results, quizId, courseId, userId) {
  Hook.doAction('quiz-started', results, quizId, courseId, userId);
  return {
    type: 'START_QUIZ_SUCCESS',
    quizId,
    courseId,
    userId,
    results
  };
}

/**
 * Request to api for starting a quiz.
 */
const startQuiz = function* () {
  const {
    itemId,
    courseId
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_1__.select)('learnpress/quiz').getDefaultRestArgs();
  const doStart = Hook.applyFilters('before-start-quiz', true, itemId, courseId);
  if (true !== doStart) {
    return;
  }
  let response = yield (0,_learnpress_data_controls__WEBPACK_IMPORTED_MODULE_0__.apiFetch)({
    path: 'lp/v1/users/start-quiz',
    method: 'POST',
    data: {
      item_id: itemId,
      course_id: courseId
    }
  });
  const btnStart = document.querySelector('.lp-button.start');
  if (response.status !== 'error') {
    response = Hook.applyFilters('request-start-quiz-response', response, itemId, courseId);
    const {
      results
    } = response;
    const {
      duration,
      status,
      question_ids,
      questions
    } = results;

    // No require enroll
    if (lpQuizSettings.checkNorequizenroll === 1) {
      const keyQuizOff = 'quiz_off_' + lpQuizSettings.id;
      window.localStorage.removeItem(keyQuizOff);
      const quizDataOff = {
        endTime: Date.now() + duration * 1000,
        status,
        question_ids,
        questions
      };
      window.localStorage.setItem(keyQuizOff, JSON.stringify(quizDataOff));

      // Set Retake quiz
      const keyQuizOffRetaken = 'quiz_off_retaken_' + lpQuizSettings.id;
      let quizOffRetaken = window.localStorage.getItem(keyQuizOffRetaken);
      if (null === quizOffRetaken) {
        quizOffRetaken = 0;
      } else {
        quizOffRetaken++;
      }
      window.localStorage.setItem(keyQuizOffRetaken, quizOffRetaken);
      // End
    }

    // Reload when start/retake quiz
    window.localStorage.removeItem('LP');
    window.location.reload();

    //yield _dispatch( 'learnpress/quiz', '__requestStartQuizSuccess', camelCaseDashObjectKeys( response ), itemId, courseId );
  } else {
    const elButtons = document.querySelector('.quiz-buttons');
    const message = `<div class="learn-press-message error">${response.message}</div>`;
    elButtons.insertAdjacentHTML('afterend', message);
    btnStart.classList.remove('loading');
  }
};

function __requestSubmitQuiz() {
  return {
    type: 'SUBMIT_QUIZ'
  };
}
function __requestSubmitQuizSuccess(results, quizId, courseId) {
  Hook.doAction('quiz-submitted', results, quizId, courseId);
  return {
    type: 'SUBMIT_QUIZ_SUCCESS',
    results
  };
}
function* submitQuiz() {
  const {
    getDefaultRestArgs,
    getQuestionsSelectedAnswers
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_1__.select)('learnpress/quiz');
  const {
    itemId,
    courseId
  } = getDefaultRestArgs();
  const doSubmit = Hook.applyFilters('before-submit-quiz', true);
  if (true !== doSubmit) {
    return;
  }
  const answered = getQuestionsSelectedAnswers();
  if (lpQuizSettings.checkNorequizenroll === 1) {
    const keyQuizOff = `quiz_off_${lpQuizSettings.id}`;
    const quizDataOffStr = window.localStorage.getItem(keyQuizOff);
    const quizDataOff = JSON.parse(quizDataOffStr);
    const keyAnswer = `LP_Quiz_${itemId}_Answered`;
    const answerDataStr = localStorage.getItem(keyAnswer);
    if (null !== answerDataStr) {
      const data = JSON.parse(answerDataStr);
      for (const [k, v] of Object.entries(data)) {
        answered[k] = v.answered;
      }
    }

    // Added questions not answered
    quizDataOff.question_ids.forEach(question_id => {
      if (!answered[question_id]) {
        answered[question_id] = '';
      }
    });
  }

  // Get time spend did quiz - tungnx
  let timeSpend = 0;
  const elTimeSpend = document.querySelector('input[name=lp-quiz-time-spend]');
  if (elTimeSpend) {
    timeSpend = elTimeSpend.value;
  }
  // End

  let response = yield (0,_learnpress_data_controls__WEBPACK_IMPORTED_MODULE_0__.apiFetch)({
    path: 'lp/v1/users/submit-quiz',
    method: 'POST',
    data: {
      item_id: itemId,
      course_id: courseId,
      answered,
      time_spend: timeSpend
    }
  });
  response = Hook.applyFilters('request-submit-quiz-response', response, itemId, courseId);
  if (response.status === 'success') {
    if (lpQuizSettings.checkNorequizenroll === 1) {
      const keyQuizOff = 'quiz_off_' + lpQuizSettings.id;
      const quizDataOffStr = window.localStorage.getItem(keyQuizOff);
      if (null !== quizDataOffStr) {
        const quizDataOff = JSON.parse(quizDataOffStr);
        quizDataOff.status = response.results.status;
        quizDataOff.results = response.results.results;
        window.localStorage.setItem(keyQuizOff, JSON.stringify(quizDataOff));
        window.localStorage.removeItem('LP_Quiz_' + lpQuizSettings.id + '_Answered');
      }
    }
    yield _dispatch('learnpress/quiz', '__requestSubmitQuizSuccess', camelCaseDashObjectKeys(response.results), itemId, courseId);
  }
}
function updateUserQuestionAnswers(questionId, answers, quizId, courseId = 0, userId = 0) {
  return {
    type: 'UPDATE_USER_QUESTION_ANSWERS',
    questionId,
    answers
  };
}

/**
 * Handle when user change value on input fill in blanks.
 *
 * @param questionId
 * @param idInput
 * @param valueInput
 * @param quizId
 * @param courseId
 * @param userId
 * @since 4.2.5.9
 * @version 1.0.0
 */
function updateUserQuestionFibAnswers(questionId, idInput, valueInput, quizId, courseId = 0, userId = 0) {
  return {
    type: 'UPDATE_USER_QUESTION_FIB_ANSWERS',
    questionId,
    idInput,
    valueInput
  };
}
function __requestShowHintSuccess(id, showHint) {
  return {
    type: 'SET_QUESTION_HINT',
    questionId: id,
    showHint
  };
}
function* showHint(id, showHint) {
  yield _dispatch('learnpress/quiz', '__requestShowHintSuccess', id, showHint);
}
function __requestCheckAnswerSuccess(id, result) {
  return {
    type: 'CHECK_ANSWER',
    questionId: id,
    ...result
  };
}
function* checkAnswer(id) {
  const {
    getDefaultRestArgs,
    getQuestionAnswered
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_1__.select)('learnpress/quiz');
  const {
    itemId,
    courseId
  } = getDefaultRestArgs();
  const result = yield (0,_learnpress_data_controls__WEBPACK_IMPORTED_MODULE_0__.apiFetch)({
    path: 'lp/v1/users/check-answer',
    method: 'POST',
    data: {
      item_id: itemId,
      course_id: courseId,
      question_id: id,
      answered: getQuestionAnswered(id) || ''
    }
  });
  if (result.status === 'success') {
    // No require enroll
    if (lpQuizSettings.checkNorequizenroll === 1) {
      const keyQuizOff = 'quiz_off_' + lpQuizSettings.id;
      const quizDataOffStr = window.localStorage.getItem(keyQuizOff);
      if (null !== quizDataOffStr) {
        const quizDataOff = JSON.parse(quizDataOffStr);
        const questionOptions = result.options;
        if (undefined === quizDataOff.checked_questions) {
          quizDataOff.checked_questions = [];
          quizDataOff.checked_questions.push(id);
        } else if (-1 === quizDataOff.checked_questions.indexOf(id)) {
          quizDataOff.checked_questions.push(id);
        }
        if (undefined === quizDataOff.question_options) {
          quizDataOff.question_options = {};
          quizDataOff.question_options[id] = questionOptions;
        } else if (undefined === quizDataOff.question_options[id]) {
          quizDataOff.question_options[id] = questionOptions;
        }
        window.localStorage.setItem(keyQuizOff, JSON.stringify(quizDataOff));

        //console.log( quizDataOff );
      }
    }
    yield _dispatch('learnpress/quiz', '__requestCheckAnswerSuccess', id, camelCaseDashObjectKeys(result));
  }
}
function markQuestionRendered(questionId) {
  return {
    type: 'MARK_QUESTION_RENDERED',
    questionId
  };
}
function setQuizMode(mode) {
  return {
    type: 'SET_QUIZ_MODE',
    mode
  };
}
function sendKey(keyPressed) {
  setTimeout(() => {
    _dispatch('learnpress/quiz', 'sendKey', '');
  }, 300);
  return {
    type: 'SEND_KEY',
    keyPressed
  };
}

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/store/index.js":
/*!*********************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/store/index.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _reducer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./reducer */ "./assets/src/apps/js/frontend/quiz/store/reducer.js");
/* harmony import */ var _actions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./actions */ "./assets/src/apps/js/frontend/quiz/store/actions.js");
/* harmony import */ var _selectors__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./selectors */ "./assets/src/apps/js/frontend/quiz/store/selectors.js");
/* harmony import */ var _middlewares__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./middlewares */ "./assets/src/apps/js/frontend/quiz/store/middlewares.js");





const {
  controls: dataControls
} = LP.dataControls;
const store = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.registerStore)('learnpress/quiz', {
  reducer: _reducer__WEBPACK_IMPORTED_MODULE_1__["default"],
  selectors: _selectors__WEBPACK_IMPORTED_MODULE_3__,
  actions: _actions__WEBPACK_IMPORTED_MODULE_2__,
  controls: {
    ...dataControls
  }
});
(0,_middlewares__WEBPACK_IMPORTED_MODULE_4__["default"])(store);
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (store);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/store/middlewares.js":
/*!***************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/store/middlewares.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var refx__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! refx */ "./node_modules/refx/refx.js");
/* harmony import */ var refx__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(refx__WEBPACK_IMPORTED_MODULE_0__);
/**
 * External dependencies
 */


/**
 * Internal dependencies
 */
//import effects from './effects';

const effects = {
  ENROLL_COURSE_X: (action, store) => {
    enrollCourse: (action, store) => {
      const {
        dispatch
      } = store;

      //dispatch()
    };
  }
};

/**
 * Applies the custom middlewares used specifically in the editor module.
 *
 * @param {Object} store Store Object.
 *
 * @return {Object} Update Store Object.
 */
function applyMiddlewares(store) {
  let enhancedDispatch = () => {
    throw new Error('Dispatching while constructing your middleware is not allowed. ' + 'Other middleware would not be applied to this dispatch.');
  };
  const middlewareAPI = {
    getState: store.getState,
    dispatch: (...args) => enhancedDispatch(...args)
  };
  enhancedDispatch = refx__WEBPACK_IMPORTED_MODULE_0___default()(effects)(middlewareAPI)(store.dispatch);
  store.dispatch = enhancedDispatch;
  return store;
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (applyMiddlewares);

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/store/reducer.js":
/*!***********************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/store/reducer.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   blocks: () => (/* binding */ blocks),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   setItemStatus: () => (/* binding */ setItemStatus),
/* harmony export */   userQuiz: () => (/* binding */ userQuiz)
/* harmony export */ });
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);

const {
  omit,
  flow,
  isArray,
  chunk
} = lodash;
const {
  camelCaseDashObjectKeys
} = LP;
const {
  get: storageGet,
  set: storageSet
} = LP.localStorage;
const STORE_DATA = {};
const setItemStatus = (item, status) => {
  const userSettings = {
    ...item.userSettings,
    status
  };
  return {
    ...item,
    userSettings
  };
};
const updateUserQuestionAnswer = (state, action) => {
  const {
    answered,
    id
  } = state;
  const newAnswer = {
    ...(answered[action.questionId] || {}),
    answered: action.answers,
    temp: true
  };
  if (id) {
    localStorage.setItem(`LP_Quiz_${id}_Answered`, JSON.stringify({
      ...state.answered,
      [action.questionId]: newAnswer
    }));
  }
  return {
    ...state,
    answered: {
      ...state.answered,
      [action.questionId]: newAnswer
    }
  };
};
const updateUserQuestionFibAnswer = (state, action) => {
  const {
    id
  } = state;
  const {
    questionId,
    idInput,
    valueInput
  } = action;
  if (state.answered.hasOwnProperty(questionId)) {
    state.answered[questionId].answered[idInput] = valueInput;
  } else {
    state.answered[action.questionId] = {
      answered: {
        [idInput]: valueInput
      },
      temp: true
    };
  }
  localStorage.setItem(`LP_Quiz_${id}_Answered`, JSON.stringify(state.answered));
  return state;
};
const markQuestionRendered = (state, action) => {
  const {
    questionsRendered
  } = state;
  if (isArray(questionsRendered)) {
    questionsRendered.push(action.questionId);
    return {
      ...state,
      questionsRendered: [...questionsRendered]
    };
  }
  return {
    ...state,
    questionsRendered: [action.questionId]
  };
};
const resetCurrentPage = (state, args) => {
  if (args.currentPage) {
    storageSet(`Q${state.id}.currentPage`, args.currentPage);
  }
  return {
    ...state,
    ...args
  };
};
const setQuestionHint = (state, action) => {
  const questions = state.questions.map(question => {
    return question.id == action.questionId ? {
      ...question,
      showHint: action.showHint
    } : question;
  });
  return {
    ...state,
    questions: [...questions]
  };
};
const checkAnswer = (state, action) => {
  const questions = state.questions.map(question => {
    if (question.id !== action.questionId) {
      return question;
    }
    const newArgs = {
      explanation: action.explanation
    };
    if (action.options) {
      newArgs.options = action.options;
    }
    return {
      ...question,
      ...newArgs
    };
  });
  const answered = {
    ...state.answered,
    [action.questionId]: action.result
  };
  let newAnswered = localStorage.getItem(`LP_Quiz_${state.id}_Answered`);
  if (newAnswered) {
    newAnswered = {
      ...JSON.parse(newAnswered),
      ...answered
    };
    localStorage.setItem(`LP_Quiz_${state.id}_Answered`, JSON.stringify(newAnswered));
  }
  return {
    ...state,
    questions: [...questions],
    answered,
    checkedQuestions: [...state.checkedQuestions, action.questionId]
  };
};
const submitQuiz = (state, action) => {
  localStorage.removeItem(`LP_Quiz_${state.id}_Answered`);
  const questions = state.questions.map(question => {
    const newArgs = {};
    if (state.reviewQuestions) {
      if (action.results.questions[question.id]?.explanation) {
        newArgs.explanation = action.results.questions[question.id].explanation;
      }
      if (action.results.questions[question.id]?.options) {
        newArgs.options = action.results.questions[question.id].options;
      }
    }
    return {
      ...question,
      ...newArgs
    };
  });
  return resetCurrentPage(state, {
    submitting: false,
    currentPage: 1,
    ...action.results,
    questions: [...questions]
  });
};
const startQuizz = (state, action) => {
  const successResponse = action.results.success !== undefined ? action.results.success : false;
  const messageResponse = action.results.message || false;
  const chunks = chunk(action.results.results.questionIds, state.questionsPerPage);
  state.numPages = chunks.length;
  return resetCurrentPage(state, {
    checkedQuestions: [],
    hintedQuestions: [],
    mode: '',
    currentPage: 1,
    ...action.results.results,
    successResponse,
    messageResponse
  });
};
const userQuiz = (state = STORE_DATA, action) => {
  switch (action.type) {
    case 'SET_QUIZ_DATA':
      if (1 > action.data.questionsPerPage) {
        action.data.questionsPerPage = 1;
      }
      const chunks = chunk(state.questionIds || action.data.questionIds, action.data.questionsPerPage);
      action.data.numPages = chunks.length;
      action.data.pages = chunks;
      return {
        ...state,
        ...action.data,
        currentPage: storageGet(`Q${action.data.id}.currentPage`) || action.data.currentPage
      };
    case 'SUBMIT_QUIZ':
      return {
        ...state,
        submitting: true
      };
    case 'START_QUIZ':
    case 'START_QUIZ_SUCCESS':
      return startQuizz(state, action);
    case 'SET_CURRENT_QUESTION':
      storageSet(`Q${state.id}.currentQuestion`, action.questionId);
      return {
        ...state,
        currentQuestion: action.questionId
      };
    case 'SET_CURRENT_PAGE':
      storageSet(`Q${state.id}.currentPage`, action.currentPage);
      return {
        ...state,
        currentPage: action.currentPage
      };
    case 'SUBMIT_QUIZ_SUCCESS':
      return submitQuiz(state, action);
    case 'UPDATE_USER_QUESTION_ANSWERS':
      return state.status === 'started' ? updateUserQuestionAnswer(state, action) : state;
    case 'UPDATE_USER_QUESTION_FIB_ANSWERS':
      return state.status === 'started' ? updateUserQuestionFibAnswer(state, action) : state;
    case 'MARK_QUESTION_RENDERED':
      return markQuestionRendered(state, action);
    case 'SET_QUIZ_MODE':
      if (action.mode == 'reviewing') {
        return resetCurrentPage(state, {
          mode: action.mode
        });
      }
      return {
        ...state,
        mode: action.mode
      };
    case 'SET_QUESTION_HINT':
      return setQuestionHint(state, action);
    case 'CHECK_ANSWER':
      return checkAnswer(state, action);
    case 'SEND_KEY':
      return {
        ...state,
        keyPressed: action.keyPressed
      };
  }
  return state;
};
const blocks = flow(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.combineReducers, reducer => (state, action) => {
  return reducer(state, action);
}, reducer => (state, action) => {
  return reducer(state, action);
}, reducer => (state, action) => {
  return reducer(state, action);
})({
  a(state = {
    a: 1
  }, action) {
    return state;
  },
  b(state = {
    b: 2
  }, action) {
    return state;
  }
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.combineReducers)({
  blocks,
  userQuiz
}));

/***/ }),

/***/ "./assets/src/apps/js/frontend/quiz/store/selectors.js":
/*!*************************************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz/store/selectors.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getCurrentQuestion: () => (/* binding */ getCurrentQuestion),
/* harmony export */   getData: () => (/* binding */ getData),
/* harmony export */   getDefaultRestArgs: () => (/* binding */ getDefaultRestArgs),
/* harmony export */   getItemStatus: () => (/* binding */ getItemStatus),
/* harmony export */   getProp: () => (/* binding */ getProp),
/* harmony export */   getQuestion: () => (/* binding */ getQuestion),
/* harmony export */   getQuestionAnswered: () => (/* binding */ getQuestionAnswered),
/* harmony export */   getQuestionMark: () => (/* binding */ getQuestionMark),
/* harmony export */   getQuestionOptions: () => (/* binding */ getQuestionOptions),
/* harmony export */   getQuestions: () => (/* binding */ getQuestions),
/* harmony export */   getQuestionsSelectedAnswers: () => (/* binding */ getQuestionsSelectedAnswers),
/* harmony export */   getQuizAnswered: () => (/* binding */ getQuizAnswered),
/* harmony export */   getQuizAttempts: () => (/* binding */ getQuizAttempts),
/* harmony export */   getUserMark: () => (/* binding */ getUserMark),
/* harmony export */   isCheckedAnswer: () => (/* binding */ isCheckedAnswer),
/* harmony export */   isCorrect: () => (/* binding */ isCorrect)
/* harmony export */ });
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);

const {
  get,
  isArray
} = lodash;
const getQuestionOptions = function getQuestionOptions(state, id) {
  console.time('parseOptions');
  const question = getQuestion(state, id);
  let options = question.options;
  options = !isArray(options) ? JSON.parse(CryptoJS.AES.decrypt(options.data, options.key, {
    format: CryptoJSAesJson
  }).toString(CryptoJS.enc.Utf8)) : options;
  options = !isArray(options) ? JSON.parse(options) : options;
  console.timeEnd('parseOptions');
  return options;
};


/**
 * Get current status of an item in course.
 *
 * @param state
 * @param itemId
 */
function getItemStatus(state, itemId) {
  const item = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('course-learner/user').getItemById(itemId);
  return item ? get(item, 'userSettings.status') : '';
}
function getProp(state, prop, defaultValue) {
  return state[prop] || defaultValue;
}

/**
 * Get quiz attempted.
 *
 * @param state
 * @param itemId
 * @return {Array}
 */
function getQuizAttempts(state, itemId) {
  const item = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('course-learner/user').getItemById(itemId);
  return item ? get(item, 'userSettings.attempts') : [];
}

/**
 * Get answers for a quiz user has did.
 *
 * @param state
 * @param itemId
 * @return {{}}
 */
function getQuizAnswered(state, itemId) {
  const item = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('course-learner/user').getItemById(itemId);
  return item ? get(item, 'userSettings.answered', {}) : {};
}

/**
 * Get all questions in quiz.
 *
 * @param state
 * @return {*}
 */
function getQuestions(state) {
  const {
    userQuiz
  } = state;
  const questions = get(userQuiz, 'questions');
  return questions ? Object.values(questions) : [];
}

/**
 * Get property of store data.
 *
 * @param state - Store data
 * @param prop - Optional. NULL will return all data.
 * @return {*}
 */
function getData(state, prop) {
  const {
    userQuiz
  } = state;
  if (prop) {
    return get(userQuiz, prop);
  }
  return userQuiz;
}
function getDefaultRestArgs(state) {
  const {
    userQuiz
  } = state;
  return {
    itemId: userQuiz.id,
    courseId: userQuiz.courseId
  };
}
function getQuestionAnswered(state, id) {
  const {
    userQuiz
  } = state;
  return get(userQuiz, `answered.${id}.answered`) || undefined;
}
function getQuestionMark(state, id) {
  const {
    userQuiz
  } = state;
  return get(userQuiz, `answered.${id}.mark`) || undefined;
}

/**
 * Get current question is doing.
 *
 * @param {Object} state
 * @param {string} ret
 * @return {*}
 */
function getCurrentQuestion(state, ret = '') {
  const questionsPerPage = get(state, 'userQuiz.questionsPerPage') || 1;
  if (questionsPerPage > 1) {
    return false;
  }
  const currentPage = get(state, 'userQuiz.currentPage') || 1;
  return ret === 'object' ? get(state, `userQuiz.questions[${currentPage - 1}]`) : get(state, `userQuiz.questionIds[${currentPage - 1}]`);
}

/**
 * Return a question contains fully data with title, content, ...
 *
 * @param state
 * @param theId
 */
const getQuestion = function getQuestion(state, theId) {
  const {
    userQuiz
  } = state;
  const s = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('learnpress/quiz');
  const questions = s.getQuestions();
  return questions.find(q => {
    return q.id == theId;
  });
};


/**
 * If user has used 'Instant check' for a question.
 *
 * @param {Object} state - Global state for app.
 * @param {number} id
 * @return {boolean}
 */
function isCheckedAnswer(state, id) {
  const checkedQuestions = get(state, 'userQuiz.checkedQuestions') || [];
  return checkedQuestions.indexOf(id) !== -1;
}
function isCorrect(state, id) {}

/**
 * Get questions user has selected answers.
 *
 * @param {Object} state. Global app state
 * @param state
 * @param {number} questionId
 * @return {{}}
 */
const getQuestionsSelectedAnswers = function (state, questionId) {
  const data = get(state, 'userQuiz.answered');
  const returnData = {};
  for (const loopId in data) {
    if (!data.hasOwnProperty(loopId)) {
      continue;
    }

    // Answer filled by user
    if (data[loopId].temp || data[loopId].blanks) {
      // If specific a question then return it only.
      if (questionId && loopId === questionId) {
        return data[loopId].answered;
      }
      returnData[loopId] = data[loopId].answered;
    }
  }
  return returnData;
};


/**
 * Get mark user earned.
 * Just for questions user has used 'Instant check' button.
 *
 * @param state
 * @return {number}
 */
function getUserMark(state) {
  const userQuiz = state.userQuiz || {};
  const {
    answered,
    negativeMarking,
    questions,
    checkedQuestions
  } = userQuiz;
  let totalMark = 0;
  for (let id in answered) {
    if (!answered.hasOwnProperty(id)) {
      continue;
    }
    id = parseInt(id);
    const data = answered[id];
    const questionMark = data.questionMark ? data.questionMark : function () {
      const question = questions.find(q => {
        return q.id === id;
      });
      return question ? question.point : 0;
    }();
    const isChecked = checkedQuestions.indexOf(id) !== -1;
    if (data.temp) {
      continue;
    }
    if (negativeMarking) {
      if (data.answered) {
        totalMark = data.correct ? totalMark + data.mark : totalMark - questionMark;
      }
    } else if (data.answered && data.correct) {
      totalMark += data.mark;
    }
  }
  return totalMark > 0 ? totalMark : 0;
}

/***/ }),

/***/ "./assets/src/apps/js/frontend/show-lp-overlay-complete-item.js":
/*!**********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/show-lp-overlay-complete-item.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");

const lpModalOverlayCompleteItem = {
  elBtnFinishCourse: null,
  elBtnCompleteItem: null,
  init() {
    if (!_utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].init()) {
      return;
    }
    if (undefined === lpGlobalSettings || 'yes' !== lpGlobalSettings.option_enable_popup_confirm_finish) {
      return;
    }
    this.elBtnFinishCourse = document.querySelectorAll('.lp-btn-finish-course');
    this.elBtnCompleteItem = document.querySelector('.lp-btn-complete-item');
    if (this.elBtnCompleteItem) {
      this.elBtnCompleteItem.addEventListener('click', e => {
        e.preventDefault();
        const form = e.target.closest('form');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(form.dataset.title);
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal('<div class="pd-2em">' + form.dataset.confirm + '</div>');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = () => {
          form.submit();
        };
      });
    }
    if (this.elBtnFinishCourse) {
      this.elBtnFinishCourse.forEach(element => element.addEventListener('click', e => {
        e.preventDefault();
        const form = e.target.closest('form');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(form.dataset.title);
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal('<div class="pd-2em">' + form.dataset.confirm + '</div>');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = () => {
          form.submit();
        };
      }));
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (lpModalOverlayCompleteItem);

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/components/compatible.js":
/*!********************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/components/compatible.js ***!
  \********************************************************************************/
/***/ (() => {

/**
 * Compatible with Page Builder.
 *
 * @author nhamdv
 */

LP.Hook.addAction('lp-compatible-builder', () => {
  LP.Hook.removeAction('lp-compatible-builder');
  if (typeof elementorFrontend !== 'undefined') {
    [...document.querySelectorAll('#popup-content')][0].addEventListener('scroll', () => {
      Waypoint.refreshAll();
      window.dispatchEvent(new Event('resize'));
    });
  }
  if (typeof vc_js !== 'undefined' && typeof VcWaypoint !== 'undefined') {
    [...document.querySelectorAll('#popup-content')][0].addEventListener('scroll', () => {
      VcWaypoint.refreshAll();
    });
  }
});
LP.Hook.addAction('lp-quiz-compatible-builder', () => {
  LP.Hook.removeAction('lp-quiz-compatible-builder');
  LP.Hook.doAction('lp-compatible-builder');
  if (typeof elementorFrontend !== 'undefined') {
    return window.elementorFrontend.init();
  }
  if (typeof vc_js !== 'undefined') {
    if (typeof vc_round_charts !== 'undefined') {
      vc_round_charts();
    }
    if (typeof vc_pieChart !== 'undefined') {
      vc_pieChart();
    }
    if (typeof vc_line_charts !== 'undefined') {
      vc_line_charts();
    }
    return window.vc_js();
  }
});
LP.Hook.addAction('lp-question-compatible-builder', () => {
  LP.Hook.removeAction('lp-question-compatible-builder');
  LP.Hook.removeAction('lp-quiz-compatible-builder');
  LP.Hook.doAction('lp-compatible-builder');
  if (typeof elementorFrontend !== 'undefined') {
    return window.elementorFrontend.init();
  }
  if (typeof vc_js !== 'undefined') {
    if (typeof vc_round_charts !== 'undefined') {
      vc_round_charts();
    }
    if (typeof vc_pieChart !== 'undefined') {
      vc_pieChart();
    }
    if (typeof vc_line_charts !== 'undefined') {
      vc_line_charts();
    }
    return window.vc_js();
  }
});

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/components/items-progress.js":
/*!************************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/components/items-progress.js ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getResponse: () => (/* binding */ getResponse),
/* harmony export */   itemsProgress: () => (/* binding */ itemsProgress)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _show_lp_overlay_complete_item__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../show-lp-overlay-complete-item */ "./assets/src/apps/js/frontend/show-lp-overlay-complete-item.js");
// Rest API load content course progress - Nhamdv.


const itemsProgress = () => {
  const elements = document.querySelectorAll('.popup-header__inner');
  if (!elements.length) {
    return;
  }
  if (document.querySelector('#learn-press-quiz-app div.quiz-result') !== null) {
    return;
  }
  if (elements[0].querySelectorAll('form.form-button-finish-course').length !== 0) {
    return;
  }
  const user_id = lpGlobalSettings.user_id || 0;
  if (user_id === 0) {
    return;
  }
  if ('IntersectionObserver' in window) {
    const eleObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const ele = entry.target;
          getResponse(ele);
          eleObserver.unobserve(ele);
        }
      });
    });
    [...elements].map(ele => eleObserver.observe(ele));
  }
};
const getResponse = async ele => {
  const response = await wp.apiFetch({
    path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)('lp/v1/lazy-load/items-progress', {
      courseId: lpGlobalSettings.post_id || '',
      userId: lpGlobalSettings.user_id || ''
    }),
    method: 'GET'
  });
  const {
    data
  } = response;
  ele.innerHTML += data;
  ele.classList.add('can-finish-course');
  _show_lp_overlay_complete_item__WEBPACK_IMPORTED_MODULE_1__["default"].init();
};

/***/ }),

/***/ "./assets/src/apps/js/utils/lp-modal-overlay.js":
/*!******************************************************!*\
  !*** ./assets/src/apps/js/utils/lp-modal-overlay.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const $ = jQuery;
let elLPOverlay = null;
const lpModalOverlay = {
  elLPOverlay: null,
  elMainContent: null,
  elTitle: null,
  elBtnYes: null,
  elBtnNo: null,
  elFooter: null,
  elCalledModal: null,
  callBackYes: null,
  instance: null,
  init() {
    if (this.instance) {
      return true;
    }
    this.elLPOverlay = $('.lp-overlay');
    if (!this.elLPOverlay.length) {
      return false;
    }
    elLPOverlay = this.elLPOverlay;
    this.elMainContent = elLPOverlay.find('.main-content');
    this.elTitle = elLPOverlay.find('.modal-title');
    this.elBtnYes = elLPOverlay.find('.btn-yes');
    this.elBtnNo = elLPOverlay.find('.btn-no');
    this.elFooter = elLPOverlay.find('.lp-modal-footer');
    $(document).on('click', '.close, .btn-no', function () {
      elLPOverlay.hide();
    });
    $(document).on('click', '.btn-yes', function (e) {
      e.preventDefault();
      e.stopPropagation();
      if ('function' === typeof lpModalOverlay.callBackYes) {
        lpModalOverlay.callBackYes(e);
      }
    });
    this.instance = this;
    return true;
  },
  setElCalledModal(elCalledModal) {
    this.elCalledModal = elCalledModal;
  },
  setContentModal(content, event) {
    this.elMainContent.html(content);
    if ('function' === typeof event) {
      event();
    }
  },
  setTitleModal(content) {
    this.elTitle.html(content);
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (lpModalOverlay);

/***/ }),

/***/ "./node_modules/refx/refx.js":
/*!***********************************!*\
  !*** ./node_modules/refx/refx.js ***!
  \***********************************/
/***/ ((module) => {

"use strict";


function flattenIntoMap( map, effects ) {
	var i;
	if ( Array.isArray( effects ) ) {
		for ( i = 0; i < effects.length; i++ ) {
			flattenIntoMap( map, effects[ i ] );
		}
	} else {
		for ( i in effects ) {
			map[ i ] = ( map[ i ] || [] ).concat( effects[ i ] );
		}
	}
}

function refx( effects ) {
	var map = {},
		middleware;

	flattenIntoMap( map, effects );

	middleware = function( store ) {
		return function( next ) {
			return function( action ) {
				var handlers = map[ action.type ],
					result = next( action ),
					i, handlerAction;

				if ( handlers ) {
					for ( i = 0; i < handlers.length; i++ ) {
						handlerAction = handlers[ i ]( action, store );
						if ( handlerAction ) {
							store.dispatch( handlerAction );
						}
					}
				}

				return result;
			};
		};
	};

	middleware.effects = map;

	return middleware;
}

module.exports = refx;


/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

"use strict";
module.exports = window["React"];

/***/ }),

/***/ "@learnpress/data-controls":
/*!**************************************!*\
  !*** external ["LP","dataControls"] ***!
  \**************************************/
/***/ ((module) => {

"use strict";
module.exports = window["LP"]["dataControls"];

/***/ }),

/***/ "@wordpress/compose":
/*!*********************************!*\
  !*** external ["wp","compose"] ***!
  \*********************************/
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["compose"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "@wordpress/url":
/*!*****************************!*\
  !*** external ["wp","url"] ***!
  \*****************************/
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["url"];

/***/ }),

/***/ "./node_modules/classnames/index.js":
/*!******************************************!*\
  !*** ./node_modules/classnames/index.js ***!
  \******************************************/
/***/ ((module, exports) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	Copyright (c) 2018 Jed Watson.
	Licensed under the MIT License (MIT), see
	http://jedwatson.github.io/classnames
*/
/* global define */

(function () {
	'use strict';

	var hasOwn = {}.hasOwnProperty;

	function classNames () {
		var classes = '';

		for (var i = 0; i < arguments.length; i++) {
			var arg = arguments[i];
			if (arg) {
				classes = appendClass(classes, parseValue(arg));
			}
		}

		return classes;
	}

	function parseValue (arg) {
		if (typeof arg === 'string' || typeof arg === 'number') {
			return arg;
		}

		if (typeof arg !== 'object') {
			return '';
		}

		if (Array.isArray(arg)) {
			return classNames.apply(null, arg);
		}

		if (arg.toString !== Object.prototype.toString && !arg.toString.toString().includes('[native code]')) {
			return arg.toString();
		}

		var classes = '';

		for (var key in arg) {
			if (hasOwn.call(arg, key) && arg[key]) {
				classes = appendClass(classes, key);
			}
		}

		return classes;
	}

	function appendClass (value, newClass) {
		if (!newClass) {
			return value;
		}
	
		if (value) {
			return value + ' ' + newClass;
		}
	
		return value + newClass;
	}

	if ( true && module.exports) {
		classNames.default = classNames;
		module.exports = classNames;
	} else if (true) {
		// register as 'classnames', consistent with npm package name
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function () {
			return classNames;
		}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else {}
}());


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!*********************************************!*\
  !*** ./assets/src/apps/js/frontend/quiz.js ***!
  \*********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   init: () => (/* binding */ init)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _quiz_index__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./quiz/index */ "./assets/src/apps/js/frontend/quiz/index.js");
/* harmony import */ var _single_curriculum_components_compatible__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./single-curriculum/components/compatible */ "./assets/src/apps/js/frontend/single-curriculum/components/compatible.js");
/* harmony import */ var _single_curriculum_components_compatible__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_single_curriculum_components_compatible__WEBPACK_IMPORTED_MODULE_2__);



const {
  modal: {
    default: Modal
  }
} = LP;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_quiz_index__WEBPACK_IMPORTED_MODULE_1__["default"]);
const init = (elem, settings) => {
  // For no require enroll
  if (lpQuizSettings.checkNorequizenroll === 1) {
    const keyQuizOff = 'quiz_off_' + lpQuizSettings.id;
    const quizDataOffStr = window.localStorage.getItem(keyQuizOff);
    if (null !== quizDataOffStr) {
      const quizDataOff = JSON.parse(quizDataOffStr);
      settings.status = quizDataOff.status;
      settings.questions = quizDataOff.questions;
      if ('started' === quizDataOff.status) {
        const now = Date.now();
        settings.total_time = Math.floor((quizDataOff.endTime - now) / 1000);
      } else if ('completed' === quizDataOff.status) {
        settings.results = quizDataOff.results;
        settings.answered = quizDataOff.results.answered;
        settings.questions = quizDataOff.results.questions;
      }
      if (undefined !== quizDataOff.checked_questions) {
        settings.checked_questions = quizDataOff.checked_questions;
      }
      if (undefined !== quizDataOff.question_options) {
        //settings.checked_questions = quizDataOff.checked_questions;

        for (const i in settings.questions) {
          const question = settings.questions[i];
          if (undefined !== quizDataOff.question_options[question.id]) {
            question.options = quizDataOff.question_options[question.id];
          }
          settings.questions[i] = question;
        }
      }
    }
  }

  //console.log(settings);

  wp.element.render((0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Modal, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_quiz_index__WEBPACK_IMPORTED_MODULE_1__["default"], {
    settings: settings
  })), [...document.querySelectorAll(elem)][0]);
  LP.Hook.doAction('lp-quiz-compatible-builder');
};
})();

(window.LP = window.LP || {}).quiz = __webpack_exports__;
/******/ })()
;
//# sourceMappingURL=quiz.js.map