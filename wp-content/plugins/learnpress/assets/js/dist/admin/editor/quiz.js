/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/admin/editor/actions/modal-quiz-items.js":
/*!*********************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/actions/modal-quiz-items.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const ModalQuizItems = {
  toggle: function (context) {
    context.commit('TOGGLE');
  },
  // open modal
  open: function (context, quizId) {
    context.commit('SET_QUIZ', quizId);
    context.commit('RESET');
    context.commit('TOGGLE');
  },
  // query available question
  searchItems: function (context, payload) {
    context.commit('SEARCH_ITEM_REQUEST');
    LP.Request({
      type: 'search-items',
      query: payload.query,
      page: payload.page,
      exclude: JSON.stringify([])
    }).then(function (response) {
      var result = response.body;
      if (!result.success) {
        return;
      }
      var data = result.data;
      context.commit('SET_LIST_ITEMS', data.items);
      context.commit('UPDATE_PAGINATION', data.pagination);
      context.commit('SEARCH_ITEM_SUCCESS');
    }, function (error) {
      context.commit('SEARCH_ITEMS_FAIL');
      console.log(error);
    });
  },
  // add question
  addItem: function (context, item) {
    context.commit('ADD_ITEM', item);
  },
  // remove question
  removeItem: function (context, index) {
    context.commit('REMOVE_ADDED_ITEM', index);
  },
  addQuestionsToQuiz: function (context, quiz) {
    var items = context.getters.addedItems;
    if (items.length > 0) {
      LP.Request({
        type: 'add-questions-to-quiz',
        items: JSON.stringify(items),
        draft_quiz: JSON.stringify(quiz)
      }).then(function (response) {
        var result = response.body;
        if (result.success) {
          var questions = result.data;

          // update quiz list questions
          context.commit('lqs/SET_QUESTIONS', questions, {
            root: true
          });
          context.commit('TOGGLE');
        }
      }, function (error) {
        console.log(error);
      });
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ModalQuizItems);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/actions/question-list.js":
/*!******************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/actions/question-list.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const $ = window.jQuery;
const QuestionList = {
  toggleAll: function (context) {
    var hidden = context.getters.isHiddenListQuestions;
    if (hidden) {
      context.commit('OPEN_LIST_QUESTIONS');
    } else {
      context.commit('CLOSE_LIST_QUESTIONS');
    }
    LP.Request({
      type: 'hidden-questions',
      hidden: context.getters.hiddenQuestions
    });
  },
  updateQuizQuestionsHidden: function (context, data) {
    LP.Request($.extend({}, data, {
      type: 'update-quiz-questions-hidden'
    }));
  },
  newQuestion: function (context, payload) {
    var newQuestion = JSON.parse(JSON.stringify(payload.question));
    newQuestion.settings = {};
    context.commit('ADD_NEW_QUESTION', newQuestion);
    LP.Request({
      type: 'new-question',
      question: JSON.stringify(payload.question),
      draft_quiz: JSON.stringify(payload.quiz)
    }).then(function (response) {
      var result = response.body;
      if (result.success) {
        context.commit('UPDATE_NEW_QUESTION_TYPE', payload.question.type, {
          root: true
        });
        context.commit('ADD_NEW_QUESTION', result.data);
        context.commit('CLOSE_LIST_QUESTIONS');
        context.commit('OPEN_QUESTION', result.data);
      }
    }, function (error) {
      console.log(error);
    });
  },
  updateQuestionsOrder: function (context, order) {
    LP.Request({
      type: 'sort-questions',
      order: JSON.stringify(order)
    }).then(function (response) {
      context.commit('SORT_QUESTIONS', order);
    }, function (error) {
      console.log(error);
    });
  },
  updateQuestionTitle: function (context, question) {
    context.commit('UPDATE_QUESTION_REQUEST', question.id);
    LP.Request({
      type: 'update-question-title',
      question: JSON.stringify(question)
    }).then(function () {
      context.commit('UPDATE_QUESTION_SUCCESS', question.id);
    }).catch(function () {
      context.commit('UPDATE_QUESTION_FAILURE', question.id);
    });
  },
  changeQuestionType: function (context, payload) {
    context.commit('UPDATE_QUESTION_REQUEST', payload.question_id);
    LP.Request({
      type: 'change-question-type',
      question_id: payload.question_id,
      question_type: payload.type
    }).then(function (response) {
      var result = response.body;
      if (result.success) {
        var question = result.data;
        context.commit('CHANGE_QUESTION_TYPE', question);
        context.commit('UPDATE_NEW_QUESTION_TYPE', question.type.key, {
          root: true
        });
        context.commit('UPDATE_QUESTION_SUCCESS', payload.question_id);
      }
    }).catch(function () {
      context.commit('UPDATE_QUESTION_FAILURE', payload.question_id);
    });
  },
  isHiddenQuestionsSettings: function (context, id) {},
  cloneQuestion: function (context, question) {
    LP.Request({
      type: 'clone-question',
      question: JSON.stringify(question)
    }).then(function (response) {
      var result = response.body;
      if (result.success) {
        var question = result.data;
        context.commit('ADD_NEW_QUESTION', result.data);
        context.commit('UPDATE_NEW_QUESTION_TYPE', question.type.key, {
          root: true
        });
      }
    }, function (error) {
      console.log(error);
    });
  },
  removeQuestion: function (context, question) {
    var question_id = question.id;
    question.temp_id = LP.uniqueId();
    context.commit('REMOVE_QUESTION', question);
    LP.Request({
      type: 'remove-question',
      question_id: question_id
    }).then(function (response) {
      var result = response.body;
      if (result.success) {
        question.id = question.temp_id;
        question.temp_id = 0;
        context.commit('REMOVE_QUESTION', question);
      }
    }, function (error) {
      console.error(error);
    });
  },
  deleteQuestion: function (context, question) {
    var question_id = question.id;
    question.temp_id = LP.uniqueId();
    context.commit('REMOVE_QUESTION', question);
    LP.Request({
      type: 'delete-question',
      question_id: question_id
    }).then(function () {
      question.id = question.temp_id;
      question.temp_id = 0;
      context.commit('REMOVE_QUESTION', question);
      context.commit('UPDATE_QUESTION_SUCCESS', question.id);
    }).catch(function () {
      context.commit('UPDATE_QUESTION_FAILURE', question.id);
    });
  },
  toggleQuestion: function (context, question) {
    if (question.open) {
      context.commit('CLOSE_QUESTION', question);
    } else {
      context.commit('OPEN_QUESTION', question);
    }
    LP.Request({
      type: 'hidden-questions',
      hidden: context.getters.hiddenQuestions
    });
  },
  updateQuestionAnswersOrder: function (context, payload) {
    context.commit('UPDATE_QUESTION_REQUEST', payload.question_id);
    LP.Request({
      type: 'sort-question-answers',
      question_id: payload.question_id,
      order: JSON.stringify(payload.order)
    }).then(function (response) {
      var result = response.body,
        order = result.data;
      context.commit('SORT_QUESTION_ANSWERS', order);
      context.commit('UPDATE_QUESTION_SUCCESS', payload.question_id);
    }, function (error) {
      context.commit('UPDATE_QUESTION_FAILURE', payload.question_id);
      console.log(error);
    });
  },
  updateQuestionAnswerTitle: function (context, payload) {
    context.commit('UPDATE_QUESTION_REQUEST', payload.question_id);
    LP.Request({
      type: 'update-question-answer-title',
      question_id: parseInt(payload.question_id),
      answer: JSON.stringify(payload.answer)
    }).then(function () {
      context.commit('UPDATE_QUESTION_ANSWER_SUCCESS', parseInt(payload.question_id));
      context.commit('UPDATE_QUESTION_SUCCESS', payload.question_id);
    }).catch(function () {
      context.commit('UPDATE_QUESTION_ANSWER_FAILURE', parseInt(payload.question_id));
      context.commit('UPDATE_QUESTION_FAILURE', payload.question_id);
    });
  },
  updateQuestionCorrectAnswer: function (context, payload) {
    context.commit('UPDATE_QUESTION_REQUEST', payload.question_id);
    LP.Request({
      type: 'change-question-correct-answer',
      question_id: payload.question_id,
      correct: JSON.stringify(payload.correct)
    }).then(function (response) {
      var result = response.body;
      if (result.success) {
        context.commit('CHANGE_QUESTION_CORRECT_ANSWERS', result.data);
        context.commit('UPDATE_QUESTION_SUCCESS', payload.question_id);
      }
    }, function (error) {
      context.commit('UPDATE_QUESTION_FAILURE', payload.question_id);
      console.log(error);
    });
  },
  deleteQuestionAnswer: function (context, payload) {
    payload.temp_id = LP.uniqueId();
    context.commit('DELETE_ANSWER', payload);
    context.commit('UPDATE_QUESTION_REQUEST', payload.question_id);
    LP.Request({
      type: 'delete-question-answer',
      question_id: payload.question_id,
      answer_id: payload.answer_id
    }).then(function (response) {
      var result = response.body;
      if (result.success) {
        context.commit('DELETE_QUESTION_ANSWER', {
          question_id: payload.question_id,
          answer_id: payload.temp_id
          //answer_id: payload.answer_id
        });
        context.commit('UPDATE_QUESTION_SUCCESS', payload.question_id);
      }
    }, function (error) {
      context.commit('UPDATE_QUESTION_FAILURE', payload.question_id);
      console.log(error);
    });
  },
  newQuestionAnswer: function (context, data) {
    var temp_id = LP.uniqueId(),
      question_id = data.question_id;
    context.commit('UPDATE_QUESTION_REQUEST', question_id);
    context.commit('ADD_QUESTION_ANSWER', {
      question_id: question_id,
      answer: {
        text: LP_Quiz_Store.getters['i18n/all'].new_option,
        question_answer_id: temp_id
      }
    });
    LP.Request({
      type: 'new-question-answer',
      question_id: question_id,
      question_answer_id: temp_id
    }).then(function (response) {
      var result = response.body;
      if (result.success) {
        var answer = result.data;
        context.commit('ADD_QUESTION_ANSWER', {
          question_id: question_id,
          answer: answer
        });
        context.commit('UPDATE_QUESTION_SUCCESS', question_id);
        data.success && setTimeout(function () {
          data.success.apply(data.context, [answer]);
        }, 300);
      }
    }, function (error) {
      context.commit('UPDATE_QUESTION_FAILURE', question_id);
      console.error(error);
    });
  },
  updateQuestionContent: function (context, question) {
    context.commit('UPDATE_QUESTION_REQUEST', question.id);
    LP.Request({
      type: 'update-question-content',
      question: JSON.stringify(question)
    }).then(function () {
      context.commit('UPDATE_QUESTION_SUCCESS', question.id);
    }).catch(function () {
      context.commit('UPDATE_QUESTION_FAILURE', question.id);
    });
  },
  updateQuestionMeta: function (context, payload) {
    context.commit('UPDATE_QUESTION_REQUEST', payload.question.id);
    LP.Request({
      type: 'update-question-meta',
      question: JSON.stringify(payload.question),
      meta_key: payload.meta_key
    }).then(function () {
      context.commit('UPDATE_QUESTION_SUCCESS', payload.question.id);
    }).catch(function () {
      context.commit('UPDATE_QUESTION_FAILURE', payload.question.id);
    });
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (QuestionList);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/actions/quiz.js":
/*!*********************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/actions/quiz.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Quiz = {
  heartbeat: function (context) {
    LP.Request({
      type: 'heartbeat'
    }).then(function (response) {
      var result = response.body;
      context.commit('UPDATE_HEART_BEAT', !!result.success);
    }, function (error) {
      context.commit('UPDATE_HEART_BEAT', false);
    });
  },
  newRequest: function (context) {
    context.commit('INCREASE_NUMBER_REQUEST');
    context.commit('UPDATE_STATUS', 'loading');
    window.onbeforeunload = function () {
      return '';
    };
  },
  requestCompleted: function (context, status) {
    context.commit('DECREASE_NUMBER_REQUEST');
    if (context.getters.currentRequest === 0) {
      context.commit('UPDATE_STATUS', status);
      window.onbeforeunload = null;
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Quiz);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/fill-in-blanks.js":
/*!***********************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/fill-in-blanks.js ***!
  \***********************************************************/
/***/ (() => {

(function ($) {
  window.FIB = {
    getSelectedText: function getSelectedText() {
      let html = '';
      if (typeof window.getSelection !== 'undefined') {
        const sel = window.getSelection();
        if (sel.rangeCount) {
          const container = document.createElement('div');
          for (let i = 0, len = sel.rangeCount; i < len; ++i) {
            container.appendChild(sel.getRangeAt(i).cloneContents());
          }
          html = container.innerHTML;
        }
      } else if (typeof document.selection !== 'undefined') {
        if (document.selection.type === 'Text') {
          html = document.selection.createRange().htmlText;
        }
      }
      return html;
    },
    createTextNode(content) {
      return document.createTextNode(content);
    },
    isContainHtml: function isContainHtml(content) {
      const $el = $(content),
        sel = 'b.fib-blank';
      return $el.is(sel) || $el.find(sel).length || $el.parent().is(sel);
    },
    getSelectionRange: function getSelectionRange() {
      let t = '';
      if (window.getSelection) {
        t = window.getSelection();
      } else if (document.getSelection) {
        t = document.getSelection();
      } else if (document.selection) {
        t = document.selection.createRange().text;
      }
      return t;
    },
    outerHTML($dom) {
      return $('<div>').append($($dom).clone()).html();
    },
    doUpgrade(callback) {
      $.ajax({
        url: '',
        data: {
          'lp-ajax': 'fib-upgrade'
        },
        success(res) {
          console.log(res);
          callback && callback.call(res);
        }
      });
    }
  };
  $(document).ready(function () {
    $('#do-upgrade-fib').on('click', function () {
      const $button = $(this).prop('disabled', true).addClass('ajaxloading');
      FIB.doUpgrade(function () {
        $button.prop('disabled', false).removeClass('ajaxloading');
      });
    });
  });
})(jQuery);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/getters/modal-quiz-items.js":
/*!*********************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/getters/modal-quiz-items.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const ModalQuizItems = {
  status: function (state) {
    return state.status;
  },
  pagination: function (state) {
    return state.pagination;
  },
  items: function (state, _getters) {
    return state.items.map(function (item) {
      var find = _getters.addedItems.find(function (_item) {
        return item.id === _item.id;
      });
      item.added = !!find;
      return item;
    });
  },
  code: function (state) {
    return Date.now();
  },
  addedItems: function (state) {
    return state.addedItems;
  },
  isOpen: function (state) {
    return state.open;
  },
  quiz: function (state) {
    return state.quizId;
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ModalQuizItems);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/getters/question-list.js":
/*!******************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/getters/question-list.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const QuestionList = {
  listQuestions: function (state) {
    return state.questions || [];
  },
  questionsOrder: function (state) {
    return state.order || [];
  },
  externalComponent: function (state) {
    return state.externalComponent || [];
  },
  supportAnswerOptions: function (state) {
    return state.supportAnswerOptions || [];
  },
  hiddenQuestionsSettings: function (state) {
    return state.hidden_questions_settings || [];
  },
  hiddenQuestions: function (state) {
    return state.questions.filter(function (question) {
      return !question.open;
    }).map(function (question) {
      return parseInt(question.id);
    });
  },
  isHiddenListQuestions: function (state, getters) {
    var questions = getters.listQuestions;
    var hiddenQuestions = getters.hiddenQuestions;
    return questions.length === hiddenQuestions.length;
  },
  disableUpdateList: function (state) {
    return state.disableUpdateList;
  },
  statusUpdateQuestions: function (state) {
    return state.statusUpdateQuestions;
  },
  statusUpdateQuestionItem: function (state) {
    return state.statusUpdateQuestionItem;
  },
  statusUpdateQuestionAnswer: function (state) {
    return state.statusUpdateQuestionAnswer;
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (QuestionList);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/getters/quiz.js":
/*!*********************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/getters/quiz.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Quiz = {
  heartbeat: function (state) {
    return state.heartbeat;
  },
  questionTypes: function (state) {
    return state.types;
  },
  defaultNewQuestionType: function (state) {
    return state.default_new;
  },
  action: function (state) {
    return state.action;
  },
  id: function (state) {
    return state.quiz_id;
  },
  status: function (state) {
    return state.status || 'error';
  },
  currentRequest: function (state) {
    return state.countCurrentRequest || 0;
  },
  nonce: function (state) {
    return state.nonce;
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Quiz);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/http.js":
/*!*************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/http.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ HTTP)
/* harmony export */ });
function HTTP(options) {
  const $ = window.jQuery || jQuery;
  const $VueHTTP = Vue.http;
  options = $.extend({
    ns: 'LPRequest',
    store: false
  }, options || {});
  let $publishingAction = null;
  LP.Request = function (payload) {
    $publishingAction = $('#publishing-action');
    payload.id = options.store.getters.id;
    payload.nonce = options.store.getters.nonce;
    payload['lp-ajax'] = options.store.getters.action;
    payload.code = options.store.getters.code;
    $publishingAction.find('#publish').addClass('disabled');
    $publishingAction.find('.spinner').addClass('is-active');
    $publishingAction.addClass('code-' + payload.code);
    return $VueHTTP.post(options.store.getters.urlAjax, payload, {
      emulateJSON: true,
      params: {
        namespace: options.ns,
        code: payload.code
      }
    });
  };
  $VueHTTP.interceptors.push(function (request, next) {
    if (request.params.namespace !== options.ns) {
      next();
      return;
    }
    options.store.dispatch('newRequest');
    next(function (response) {
      if (!jQuery.isPlainObject(response.body)) {
        response.body = LP.parseJSON(response.body);
      }
      const body = response.body;
      const result = body.success || false;
      if (result) {
        options.store.dispatch('requestCompleted', 'successful');
      } else {
        options.store.dispatch('requestCompleted', 'failed');
      }
      $publishingAction.removeClass('code-' + request.params.code);
      if (!$publishingAction.attr('class')) {
        $publishingAction.find('#publish').removeClass('disabled');
        $publishingAction.find('.spinner').removeClass('is-active');
      }
    });
  });
}

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/mutations/modal-quiz-items.js":
/*!***********************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/mutations/modal-quiz-items.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const ModalQuizItems = {
  TOGGLE: function (state) {
    state.open = !state.open;
  },
  SET_QUIZ: function (state, quizId) {
    state.quizId = quizId;
  },
  SET_LIST_ITEMS: function (state, items) {
    state.items = items;
  },
  ADD_ITEM: function (state, item) {
    state.addedItems.push(item);
  },
  REMOVE_ADDED_ITEM: function (state, item) {
    state.addedItems.forEach(function (_item, index) {
      if (_item.id === item.id) {
        state.addedItems.splice(index, 1);
      }
    });
  },
  RESET: function (state) {
    state.addedItems = [];
    state.items = [];
  },
  UPDATE_PAGINATION: function (state, pagination) {
    state.pagination = pagination;
  },
  SEARCH_ITEM_REQUEST: function (state) {
    state.status = 'loading';
  },
  SEARCH_ITEM_SUCCESS: function (state) {
    state.status = 'successful';
  },
  SEARCH_ITEM_FAIL: function (state) {
    state.status = 'fail';
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ModalQuizItems);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/mutations/question-list.js":
/*!********************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/mutations/question-list.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var $ = window.jQuery;
const QuestionList = {
  SORT_QUESTIONS: function (state, orders) {
    state.questions = state.questions.map(function (question) {
      question.order = orders[question.id];
      return question;
    });
  },
  SORT_QUESTION_ANSWERS: function (state, orders) {
    state.questions = state.questions.map(function (question) {
      question.answers.answer_order = orders[question.answers.question_answer_id];
      return question;
    });
  },
  ADD_QUESTION_ANSWER: function (state, payload) {
    state.questions = state.questions.map(function (question) {
      if (question.id === payload.question_id) {
        var found = false;
        if (payload.answer.temp_id) {
          for (var i = 0, n = question.answers.length; i < n; i++) {
            if (question.answers[i].question_answer_id == payload.answer.temp_id) {
              found = true;
              $Vue.set(question.answers, i, payload.answer);
            }
          }
        }
        !found && question.answers.push(payload.answer);
        return question;
      }
      return question;
    });
  },
  CHANGE_QUESTION_CORRECT_ANSWERS: function (state, data) {
    state.questions = state.questions.map(function (question) {
      if (parseInt(question.id) === data.id) {
        question.answers = data.answers;
      }
      return question;
    });
  },
  SET_QUESTIONS: function (state, questions) {
    state.questions = questions;
  },
  ADD_NEW_QUESTION: function (state, question) {
    var found = false;
    if (question.temp_id) {
      for (var i = 0, n = state.questions.length; i < n; i++) {
        if (state.questions[i].id === question.temp_id) {
          $Vue.set(state.questions, i, question);
          found = true;
          break;
        }
      }
    }
    if (!found) {
      var _last_child = $('.lp-list-questions .main > div:last-child');
      if (_last_child.length) {
        var _offset = _last_child.offset().top;
        $('html,body').animate({
          scrollTop: _offset
        });
      }
      state.questions.push(question);
    }
  },
  CHANGE_QUESTION_TYPE: function (state, data) {
    state.questions = state.questions.map(function (question) {
      if (parseInt(question.id) === data.id) {
        question.answers = data.answers;
        question.type = data.type;
        question.open = true;
      }
      return question;
    });
  },
  REMOVE_QUESTION: function (state, item) {
    var questions = state.questions,
      index = questions.indexOf(item);
    if (item.temp_id) {
      state.questions[index].id = item.temp_id;
    } else {
      state.questions.splice(index, 1);
    }
  },
  DELETE_QUESTION_ANSWER: function (state, payload) {
    var question_id = payload.question_id,
      answer_id = payload.answer_id;
    state.questions = state.questions.map(function (question) {
      if (question.id === question_id) {
        var answers = question.answers;
        answers.forEach(function (answer) {
          if (answer.question_answer_id === answer_id) {
            var index = answers.indexOf(answer);
            answers.splice(index, 1);
          }
        });
      }
      return question;
    });
  },
  REMOVE_QUESTIONS: function () {
    // code
  },
  CLOSE_QUESTION: function (state, question) {
    state.questions.forEach(function (_question, index) {
      if (question.id === _question.id) {
        state.questions[index].open = false;
      }
    });
  },
  OPEN_QUESTION: function (state, question) {
    state.questions.forEach(function (_question, index) {
      if (question.id === _question.id) {
        state.questions[index].open = true;
      }
    });
  },
  CLOSE_LIST_QUESTIONS: function (state) {
    state.questions = state.questions.map(function (_question) {
      _question.open = false;
      return _question;
    });
  },
  OPEN_LIST_QUESTIONS: function (state) {
    state.questions = state.questions.map(function (_question) {
      _question.open = true;
      return _question;
    });
  },
  UPDATE_QUESTION_REQUEST: function (state, questionId) {
    $Vue.set(state.statusUpdateQuestionItem, questionId, 'updating');
  },
  UPDATE_QUESTION_SUCCESS: function (state, questionID) {
    $Vue.set(state.statusUpdateQuestionItem, questionID, 'successful');
  },
  UPDATE_QUESTION_FAILURE: function (state, questionID) {
    $Vue.set(state.statusUpdateQuestionItem, questionID, 'failed');
  },
  UPDATE_QUESTION_ANSWER_REQUEST: function (state, question_id) {
    $Vue.set(state.statusUpdateQuestionAnswer, question_id, 'updating');
  },
  UPDATE_QUESTION_ANSWER_SUCCESS: function (state, question_id) {
    $Vue.set(state.statusUpdateQuestionAnswer, question_id, 'successful');
  },
  UPDATE_QUESTION_ANSWER_FAIL: function (state, question_id) {
    $Vue.set(state.statusUpdateQuestionAnswer, question_id, 'failed');
  },
  DELETE_ANSWER: function (state, data) {
    state.questions.map(function (question, index) {
      if (question.id == data.question_id) {
        for (var i = 0, n = question.answers.length; i < n; i++) {
          if (question.answers[i].question_answer_id == data.answer_id) {
            question.answers[i].question_answer_id = data.temp_id;
            //state.questions[index].answers.splice(i, 1);
            break;
          }
        }
        return false;
      }
    });
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (QuestionList);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/mutations/quiz.js":
/*!***********************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/mutations/quiz.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Quiz = {
  UPDATE_HEART_BEAT: function (state, status) {
    state.heartbeat = !!status;
  },
  UPDATE_STATUS: function (state, status) {
    state.status = status;
  },
  UPDATE_NEW_QUESTION_TYPE: function (state, type) {
    state.default_new = type;
  },
  INCREASE_NUMBER_REQUEST: function (state) {
    state.countCurrentRequest++;
  },
  DECREASE_NUMBER_REQUEST: function (state) {
    state.countCurrentRequest--;
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Quiz);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/store/i18n.js":
/*!*******************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/store/i18n.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const $ = window.jQuery || jQuery;
const i18n = function i18n(i18n) {
  const state = $.extend({}, i18n);
  const getters = {
    all: function (state) {
      return state;
    }
  };
  return {
    namespaced: true,
    state: state,
    getters: getters
  };
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (i18n);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/store/modal-quiz-items.js":
/*!*******************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/store/modal-quiz-items.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _getters_modal_quiz_items__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../getters/modal-quiz-items */ "./assets/src/apps/js/admin/editor/getters/modal-quiz-items.js");
/* harmony import */ var _mutations_modal_quiz_items__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../mutations/modal-quiz-items */ "./assets/src/apps/js/admin/editor/mutations/modal-quiz-items.js");
/* harmony import */ var _actions_modal_quiz_items__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../actions/modal-quiz-items */ "./assets/src/apps/js/admin/editor/actions/modal-quiz-items.js");



const $ = window.jQuery || jQuery;
const Quiz = function (data) {
  var state = $.extend({
    quizId: false,
    pagination: '',
    status: ''
  }, data.chooseItems);
  return {
    namespaced: true,
    state: state,
    getters: _getters_modal_quiz_items__WEBPACK_IMPORTED_MODULE_0__["default"],
    mutations: _mutations_modal_quiz_items__WEBPACK_IMPORTED_MODULE_1__["default"],
    actions: _actions_modal_quiz_items__WEBPACK_IMPORTED_MODULE_2__["default"]
  };
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Quiz);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/store/question-list.js":
/*!****************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/store/question-list.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _getters_question_list__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../getters/question-list */ "./assets/src/apps/js/admin/editor/getters/question-list.js");
/* harmony import */ var _mutations_question_list__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../mutations/question-list */ "./assets/src/apps/js/admin/editor/mutations/question-list.js");
/* harmony import */ var _actions_question_list__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../actions/question-list */ "./assets/src/apps/js/admin/editor/actions/question-list.js");



const $ = window.jQuery || jQuery;
const QuestionList = function QuestionList(data) {
  const listQuestions = data.listQuestions;
  const state = $.extend({
    statusUpdateQuestions: {},
    statusUpdateQuestionItem: {},
    statusUpdateQuestionAnswer: {},
    questions: listQuestions.questions.map(function (question) {
      const hiddenQuestions = listQuestions.hidden_questions;
      const ArrQuestionIds = Object.keys(hiddenQuestions);
      const find = ArrQuestionIds.find(function (questionId) {
        return parseInt(question.id) === parseInt(questionId);
      });
      question.open = !find;
      return question;
    })
  }, listQuestions);
  return {
    namespaced: true,
    state,
    getters: _getters_question_list__WEBPACK_IMPORTED_MODULE_0__["default"],
    mutations: _mutations_question_list__WEBPACK_IMPORTED_MODULE_1__["default"],
    actions: _actions_question_list__WEBPACK_IMPORTED_MODULE_2__["default"]
  };
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (QuestionList);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/store/quiz.js":
/*!*******************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/store/quiz.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _getters_quiz__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../getters/quiz */ "./assets/src/apps/js/admin/editor/getters/quiz.js");
/* harmony import */ var _mutations_quiz__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../mutations/quiz */ "./assets/src/apps/js/admin/editor/mutations/quiz.js");
/* harmony import */ var _actions_quiz__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../actions/quiz */ "./assets/src/apps/js/admin/editor/actions/quiz.js");
/* harmony import */ var _store_modal_quiz_items__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../store/modal-quiz-items */ "./assets/src/apps/js/admin/editor/store/modal-quiz-items.js");
/* harmony import */ var _store_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../store/i18n */ "./assets/src/apps/js/admin/editor/store/i18n.js");
/* harmony import */ var _store_question_list__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../store/question-list */ "./assets/src/apps/js/admin/editor/store/question-list.js");






const $ = window.jQuery || jQuery;
const Quiz = function Quiz(data) {
  const state = $.extend({
    status: 'success',
    heartbeat: true,
    countCurrentRequest: 0
  }, data.root);
  return {
    state: state,
    getters: _getters_quiz__WEBPACK_IMPORTED_MODULE_0__["default"],
    mutations: _mutations_quiz__WEBPACK_IMPORTED_MODULE_1__["default"],
    actions: _actions_quiz__WEBPACK_IMPORTED_MODULE_2__["default"],
    modules: {
      cqi: (0,_store_modal_quiz_items__WEBPACK_IMPORTED_MODULE_3__["default"])(data),
      i18n: (0,_store_i18n__WEBPACK_IMPORTED_MODULE_4__["default"])(data.i18n),
      lqs: (0,_store_question_list__WEBPACK_IMPORTED_MODULE_5__["default"])(data)
    }
  };
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Quiz);

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
/*!*************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/quiz.js ***!
  \*************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _store_quiz__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./store/quiz */ "./assets/src/apps/js/admin/editor/store/quiz.js");
/* harmony import */ var _http__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./http */ "./assets/src/apps/js/admin/editor/http.js");
/* harmony import */ var _fill_in_blanks__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./fill-in-blanks */ "./assets/src/apps/js/admin/editor/fill-in-blanks.js");
/* harmony import */ var _fill_in_blanks__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_fill_in_blanks__WEBPACK_IMPORTED_MODULE_2__);



window.$Vue = window.$Vue || Vue;
window.$Vuex = window.$Vuex || Vuex;

/**
 * Init app.
 *
 * @since 3.0.0
 */

window.jQuery(document).ready(function () {
  window.LP_Quiz_Store = new $Vuex.Store((0,_store_quiz__WEBPACK_IMPORTED_MODULE_0__["default"])(lp_quiz_editor));
  (0,_http__WEBPACK_IMPORTED_MODULE_1__["default"])({
    ns: 'LPListQuizQuestionsRequest',
    store: LP_Quiz_Store
  });
  setTimeout(() => {
    window.LP_Quiz_Editor = new $Vue({
      el: '#admin-editor-lp_quiz',
      template: '<lp-quiz-editor></lp-quiz-editor>'
    });
  }, 100);
});
})();

/******/ })()
;
//# sourceMappingURL=quiz.js.map