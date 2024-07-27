/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/frontend/question-types/components/index.js":
/*!************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/question-types/components/index.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   FillInBlanks: () => (/* reexport safe */ _questions_fill_in_blanks__WEBPACK_IMPORTED_MODULE_4__["default"]),
/* harmony export */   MultipleChoices: () => (/* reexport safe */ _questions_multiple_choices__WEBPACK_IMPORTED_MODULE_2__["default"]),
/* harmony export */   QuestionBase: () => (/* reexport safe */ _question_base__WEBPACK_IMPORTED_MODULE_0__["default"]),
/* harmony export */   SingleChoice: () => (/* reexport safe */ _questions_single_choice__WEBPACK_IMPORTED_MODULE_1__["default"]),
/* harmony export */   TrueOrFalse: () => (/* reexport safe */ _questions_true_or_false__WEBPACK_IMPORTED_MODULE_3__["default"])
/* harmony export */ });
/* harmony import */ var _question_base__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./question-base */ "./assets/src/apps/js/frontend/question-types/components/question-base/index.js");
/* harmony import */ var _questions_single_choice__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./questions/single-choice */ "./assets/src/apps/js/frontend/question-types/components/questions/single-choice/index.js");
/* harmony import */ var _questions_multiple_choices__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./questions/multiple-choices */ "./assets/src/apps/js/frontend/question-types/components/questions/multiple-choices/index.js");
/* harmony import */ var _questions_true_or_false__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./questions/true-or-false */ "./assets/src/apps/js/frontend/question-types/components/questions/true-or-false/index.js");
/* harmony import */ var _questions_fill_in_blanks__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./questions/fill-in-blanks */ "./assets/src/apps/js/frontend/question-types/components/questions/fill-in-blanks/index.js");






/***/ }),

/***/ "./assets/src/apps/js/frontend/question-types/components/question-base/index.js":
/*!**************************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/question-types/components/question-base/index.js ***!
  \**************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

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

/* eslint-disable no-mixed-spaces-and-tabs */



const {
  isArray,
  get,
  set
} = lodash;
class QuestionBase extends _wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Component {
  constructor(props) {
    super(...arguments);
    const {
      question
    } = props;
    this.state = {
      optionClass: ['answer-option'],
      questionId: 0,
      options: question ? this.parseOptions(question.options) : [],
      self: this
    };
    if (props.$wrap) {
      this.$wrap = props.$wrap;
    }
  }
  static getDerivedStateFromProps(props, state) {
    return state.self.prepare(props, state);
  }
  componentDidMount() {
    const newState = this.prepare(this.props, this.state);
    if (newState) {
      this.setState(newState);
    }
  }
  prepare = (props, state) => {
    const {
      question
    } = props;
    if (question && question.id !== state.questionId) {
      return {
        options: state.self.parseOptions(question.options)
      };
    }
    return null;
  };
  setInputRef = (el, k) => {
    if (!this.inputs) {
      this.inputs = {};
    }
    this.inputs[k] = el;
  };

  /**
   * Only show correct answer
   * status = completed
   * todo: check isset answered but if skip it will not show.
   *
   * @author Nhamdv
   */
  maybeShowCorrectAnswer = () => {
    const {
      status,
      isCheckedAnswer,
      showCorrectReview,
      isReviewing
    } = this.props;
    return status === 'completed' && showCorrectReview || isCheckedAnswer && !isReviewing;
  };

  /**
   * Disable answer option in review mode or user has checked the question.
   *
   * @param option Doc.
   */
  maybeDisabledOption = option => {
    const {
      answered,
      status,
      isCheckedAnswer
    } = this.props;
    return isCheckedAnswer || status !== 'started';
  };

  /**
   * Event callback for clicking on answer option to
   * store answered
   */
  setAnswerChecked = () => event => {
    const {
      updateUserQuestionAnswers,
      question,
      status
    } = this.props;
    if (status !== 'started') {
      return (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('LP Error: can not set answers', 'learnpress');
    }
    const $options = this.$wrap.find('.option-check');
    const answered = [];
    const isSingle = question.type !== 'multi_choice';
    $options.each((i, option) => {
      if (option.checked) {
        answered.push(option.value);
        if (isSingle) {
          return false;
        }
      }
    });
    updateUserQuestionAnswers(question.id, isSingle ? answered[0] : answered);
  };
  maybeCheckedAnswer = value => {
    const {
      answered
    } = this.props;
    if (isArray(answered)) {
      return !!answered.find(a => {
        return a == value;
      });
    }
    return value == answered;
  };
  getOptionType = (questionType, option) => {
    let type = 'radio';
    switch (questionType) {
      case 'multi_choice':
        type = 'checkbox';
        break;
    }
    return type;
  };
  isDefaultType = () => {
    return this.props.supportOptions;
  };
  getWarningMessage = () => {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('The render function should be overwritten from the base.', 'learnpress'));
  };
  getOptionClass = option => {
    const {
      answered
    } = this.props;
    const classes = ['answer-option'];
    return classes;
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
  getOptions = () => {
    return this.state.options || [];
  };
  isCorrect = () => {
    const {
      answered
    } = this.props;
    if (!answered) {
      return false;
    }
    let i, option, options;
    for (i = 0, options = this.getOptions(); i < options.length; i++) {
      option = options[i];
      if (option.isTrue === 'yes') {
        if (answered == option.value) {
          return true;
        }
      }
    }
    return false;
  };
  isChecked = () => {
    const {
      question
    } = this.props;
    return (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.select)('learnpress/quiz').isCheckedAnswer(question.id);
  };
  getCorrectLabel = () => {
    const {
      status,
      answered,
      question
    } = this.props;
    const checker = LP.config.isQuestionCorrect[question.type] || this.isCorrect;
    const isCorrect = checker.call(this);
    return this.maybeShowCorrectAnswer() && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: `question-response` + (isCorrect ? ' correct' : ' incorrect')
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "label"
    }, isCorrect ? (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Correct', 'learnpress') : (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Incorrect', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "point"
    }, sprintf((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('%d/%d point', 'learnpress'), isCorrect ? question.point : 0, question.point)));
  };
  render() {
    const {
      question,
      status
    } = this.props;
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "question-answers"
    }, this.isDefaultType() && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("ul", {
      id: `answer-options-${question.id}`,
      className: "answer-options"
    }, this.getOptions().map(option => {
      const ID = `learn-press-answer-option-${option.uid}`;
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
        className: this.getOptionClass(option).join(' '),
        key: `answer-option-${option.uid}`
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: this.getOptionType(question.type, option),
        className: "option-check",
        name: status === 'started' ? `learn-press-question-${question.id}` : '',
        id: ID,
        ref: el => {
          this.setInputRef(el, option.value);
        },
        onChange: this.setAnswerChecked(),
        disabled: this.maybeDisabledOption(option),
        checked: this.maybeCheckedAnswer(option.value),
        value: status === 'started' ? option.value : ''
      }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
        htmlFor: ID,
        className: "option-title",
        dangerouslySetInnerHTML: {
          __html: option.title || option.value
        }
      }));
    })), !this.isDefaultType() && this.getWarningMessage(), this.getCorrectLabel());
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (QuestionBase);

/***/ }),

/***/ "./assets/src/apps/js/frontend/question-types/components/questions/fill-in-blanks/index.js":
/*!*************************************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/question-types/components/questions/fill-in-blanks/index.js ***!
  \*************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _question_base__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../question-base */ "./assets/src/apps/js/frontend/question-types/components/question-base/index.js");



let flagEventEnterInput = false;
class QuestionFillInBlanks extends _question_base__WEBPACK_IMPORTED_MODULE_2__["default"] {
  componentDidMount() {
    const {
      answered,
      question
    } = this.props;
    if (answered) {
      const allFIBs = document.querySelectorAll('.lp-fib-input > input');
      [...allFIBs].map(ele => {
        const question_id = parseInt(ele.closest('.question').dataset.id);
        if (question_id === question.id) {
          if (answered[ele.dataset.id]) {
            ele.value = answered[ele.dataset.id];
          }
        }
      });
    }
    this.updateFibAnswer();
  }
  componentDidUpdate(prevProps) {
    if (!prevProps.answered) {
      this.updateFibAnswer();
    }
  }
  updateFibAnswer = () => {
    if (!flagEventEnterInput) {
      document.addEventListener('input', e => {
        const target = e.target;
        const parent = target.closest('.lp-fib-input');
        if (parent) {
          const elQuestionFIB = target.closest('.question-fill_in_blanks');
          const question_id = elQuestionFIB.dataset.id;
          this.setAnswered(question_id, target.dataset.id, target.value);
        }
      });
    }
    flagEventEnterInput = true;
  };
  setAnswered = (question_id, id, value) => {
    const {
      updateUserQuestionFibAnswers,
      question,
      status
    } = this.props;
    if (status !== 'started') {
      return 'LP Error: can not set answers';
    }
    const newAnswered = {};
    newAnswered[id] = value;
    updateUserQuestionFibAnswers(question_id, id, value);
  };
  getCorrectLabel = () => {
    const {
      question,
      mark
    } = this.props;
    let getMark = mark || 0;
    if (mark) {
      if (!Number.isInteger(mark)) {
        getMark = mark.toFixed(2);
      }
    }
    return this.maybeShowCorrectAnswer() && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "question-response correct"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "label"
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Points', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "point"
    }, `${getMark}/${question.point} ${(0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('point', 'learnpress')}`), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "lp-fib-note"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      style: {
        background: '#00adff'
      }
    }), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Correct', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "lp-fib-note"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      style: {
        background: '#d85554'
      }
    }), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Incorrect', 'learnpress')));
  };
  convertInputField = option => {
    const {
      answered,
      isReviewing,
      showCorrectReview,
      isCheckedAnswer
    } = this.props;
    let title = option.title;
    const answers = option?.answers;
    option.ids.map((id, index) => {
      const textReplace = '{{FIB_' + id + '}}';
      let elContent = '';
      const answerID = answers ? answers?.[id] : undefined;
      if (answerID || isReviewing) {
        var _answerID$correct;
        elContent += `<span class="lp-fib-answered ${(showCorrectReview || isCheckedAnswer) && answerID?.correct ? answerID?.isCorrect ? 'correct' : 'fail' : ''}">`;
        if (!answerID?.isCorrect) {
          var _answered$id;
          elContent += `<span class="lp-fib-answered__answer">${(_answered$id = answered?.[id]) !== null && _answered$id !== void 0 ? _answered$id : ''}</span>`;
        }
        if (!answerID?.isCorrect && answerID?.correct) {
          elContent += ' → ';
        }
        elContent += `<span class="lp-fib-answered__fill">${(_answerID$correct = answerID?.correct) !== null && _answerID$correct !== void 0 ? _answerID$correct : ''}</span>`;
        elContent += '</span>';
      } else {
        elContent += '<div class="lp-fib-input" style="display: inline-block; width: auto;">';
        elContent += '<input type="text" data-id="' + id + '" value="" />';
        elContent += '</div>';
      }
      title = title.replace(textReplace, elContent);
    });
    return title;
  };
  render() {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "lp-fib-content"
    }, this.getOptions().map(option => {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        key: `blank-${option.uid}`,
        dangerouslySetInnerHTML: {
          __html: this.convertInputField(option) || option.value
        }
      });
    })), !this.isDefaultType() && this.getWarningMessage(), this.getCorrectLabel());
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (QuestionFillInBlanks);

/***/ }),

/***/ "./assets/src/apps/js/frontend/question-types/components/questions/multiple-choices/index.js":
/*!***************************************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/question-types/components/questions/multiple-choices/index.js ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _question_base__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../question-base */ "./assets/src/apps/js/frontend/question-types/components/question-base/index.js");



const {
  isBoolean
} = lodash;
class QuestionMultipleChoices extends _question_base__WEBPACK_IMPORTED_MODULE_2__["default"] {
  isCorrect = () => {
    const {
      answered
    } = this.props;
    if (isBoolean(answered) || !answered) {
      return false;
    }
    let i, option, options;
    for (i = 0, options = this.getOptions(); i < options.length; i++) {
      option = options[i];
      if (option.isTrue === 'yes') {
        if (answered.indexOf(option.value) === -1) {
          return false;
        }
      } else if (answered.indexOf(option.value) !== -1) {
        return false;
      }
    }
    return true;
  };
  getOptionClass = option => {
    const {
      answered
    } = this.props;
    const optionClass = [...this.state.optionClass];
    if (this.maybeShowCorrectAnswer()) {
      if (option.isTrue === 'yes') {
        optionClass.push('answer-correct');
      }
      if (answered) {
        if (option.isTrue === 'yes') {
          answered.indexOf(option.value) !== -1 && optionClass.push('answered-correct');
        } else {
          answered.indexOf(option.value) !== -1 && optionClass.push('answered-wrong');
        }
      }
    }
    return optionClass;
  };
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (QuestionMultipleChoices);

/***/ }),

/***/ "./assets/src/apps/js/frontend/question-types/components/questions/single-choice/index.js":
/*!************************************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/question-types/components/questions/single-choice/index.js ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _question_base__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../question-base */ "./assets/src/apps/js/frontend/question-types/components/question-base/index.js");
/* eslint-disable no-mixed-spaces-and-tabs */

class QuestionSingleChoice extends _question_base__WEBPACK_IMPORTED_MODULE_0__["default"] {
  getOptionClass = option => {
    const {
      answered
    } = this.props;
    const optionClass = [...this.state.optionClass];
    if (this.maybeShowCorrectAnswer()) {
      if (option.isTrue === 'yes') {
        optionClass.push('answer-correct');
      }
      if (answered) {
        if (option.isTrue === 'yes') {
          answered === option.value && optionClass.push('answered-correct');
        } else {
          answered === option.value && optionClass.push('answered-wrong');
        }
      }
    }
    return optionClass;
  };
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (QuestionSingleChoice);

/***/ }),

/***/ "./assets/src/apps/js/frontend/question-types/components/questions/true-or-false/index.js":
/*!************************************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/question-types/components/questions/true-or-false/index.js ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _question_base__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../question-base */ "./assets/src/apps/js/frontend/question-types/components/question-base/index.js");

class QuestionTrueOrFalse extends _question_base__WEBPACK_IMPORTED_MODULE_0__["default"] {
  getOptionClass = option => {
    const {
      answered
    } = this.props;
    const optionClass = [...this.state.optionClass];
    if (this.maybeShowCorrectAnswer()) {
      if (option.isTrue === 'yes') {
        optionClass.push('answer-correct');
      }
      if (answered) {
        if (option.isTrue === 'yes') {
          answered === option.value && optionClass.push('answered-correct');
        } else {
          answered === option.value && optionClass.push('answered-wrong');
        }
      }
    }
    return optionClass;
  };
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (QuestionTrueOrFalse);

/***/ }),

/***/ "./assets/src/apps/js/frontend/question-types/index.js":
/*!*************************************************************!*\
  !*** ./assets/src/apps/js/frontend/question-types/index.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   FillInBlanks: () => (/* reexport safe */ _components__WEBPACK_IMPORTED_MODULE_5__.FillInBlanks),
/* harmony export */   MultipleChoices: () => (/* reexport safe */ _components__WEBPACK_IMPORTED_MODULE_5__.MultipleChoices),
/* harmony export */   QuestionBase: () => (/* reexport safe */ _components__WEBPACK_IMPORTED_MODULE_5__.QuestionBase),
/* harmony export */   SingleChoice: () => (/* reexport safe */ _components__WEBPACK_IMPORTED_MODULE_5__.SingleChoice),
/* harmony export */   TrueOrFalse: () => (/* reexport safe */ _components__WEBPACK_IMPORTED_MODULE_5__.TrueOrFalse),
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
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components */ "./assets/src/apps/js/frontend/question-types/components/index.js");






class QuestionTypes extends _wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Component {
  getQuestion = () => {
    const {
      question
    } = this.props;
    const types = LP.Hook.applyFilters('question-types', {
      single_choice: LP.questionTypes.SingleChoice,
      multi_choice: LP.questionTypes.MultipleChoices,
      true_or_false: LP.questionTypes.TrueOrFalse,
      fill_in_blanks: LP.questionTypes.FillInBlanks
    });
    return types[question.type];
  };
  render() {
    const {
      question,
      supportOptions
    } = this.props;
    const childProps = {
      ...this.props
    };
    childProps.supportOptions = supportOptions.indexOf(question.type) !== -1;
    const TheQuestion = this.getQuestion() || function () {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "question-types",
        dangerouslySetInnerHTML: {
          __html: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.sprintf)((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Question <code>%s</code> invalid!', 'learnpress'), question.type)
        }
      });
    };
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(TheQuestion, {
      ...childProps
    }));
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_2__.compose)((0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.withSelect)((select, {
  question: {
    id
  }
}) => {
  const {
    getData,
    isCheckedAnswer
  } = select('learnpress/quiz');
  return {
    supportOptions: getData('supportOptions'),
    isCheckedAnswer: isCheckedAnswer(id),
    keyPressed: getData('keyPressed'),
    showCorrectReview: getData('showCorrectReview'),
    isReviewing: getData('mode') === 'reviewing'
  };
}), (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.withDispatch)(() => {
  return {};
}))(QuestionTypes));

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/compose":
/*!*********************************!*\
  !*** external ["wp","compose"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["compose"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

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
/*!*******************************************************!*\
  !*** ./assets/src/apps/js/frontend/question-types.js ***!
  \*******************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   FillInBlanks: () => (/* reexport safe */ _question_types_index__WEBPACK_IMPORTED_MODULE_0__.FillInBlanks),
/* harmony export */   MultipleChoices: () => (/* reexport safe */ _question_types_index__WEBPACK_IMPORTED_MODULE_0__.MultipleChoices),
/* harmony export */   QuestionBase: () => (/* reexport safe */ _question_types_index__WEBPACK_IMPORTED_MODULE_0__.QuestionBase),
/* harmony export */   SingleChoice: () => (/* reexport safe */ _question_types_index__WEBPACK_IMPORTED_MODULE_0__.SingleChoice),
/* harmony export */   TrueOrFalse: () => (/* reexport safe */ _question_types_index__WEBPACK_IMPORTED_MODULE_0__.TrueOrFalse),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _question_types_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./question-types/index */ "./assets/src/apps/js/frontend/question-types/index.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_question_types_index__WEBPACK_IMPORTED_MODULE_0__["default"]);
(window.LP = window.LP || {}).questionTypes = __webpack_exports__;
/******/ })()
;
//# sourceMappingURL=question-types.js.map