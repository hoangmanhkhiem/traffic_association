/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/admin/editor/actions/question.js":
/*!*************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/actions/question.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Question = {
  changeQuestionType(context, payload) {
    const draftQuestion = undefined !== payload.question ? payload.question : '';
    LP.Request({
      type: 'change-question-type',
      question_type: payload.type,
      draft_question: context.getters.autoDraft ? draftQuestion : ''
    }).then(function (response) {
      const result = response.body;
      if (result.success) {
        context.commit('UPDATE_AUTO_DRAFT_STATUS', false);
        context.commit('CHANGE_QUESTION_TYPE', result.data);
      }
    });
  },
  updateAnswersOrder(context, order) {
    LP.Request({
      type: 'sort-answer',
      order
    }).then(function (response) {
      const result = response.body;
      if (result.success) {
        // context.commit('SET_ANSWERS', result.data);
      }
    });
  },
  updateAnswerTitle(context, answer) {
    if (typeof answer.question_answer_id == 'undefined') {
      return;
    }
    answer = JSON.stringify(answer);
    LP.Request({
      type: 'update-answer-title',
      answer
    });
  },
  updateCorrectAnswer(context, correct) {
    LP.Request({
      type: 'change-correct',
      correct: JSON.stringify(correct)
    }).then(function (response) {
      const result = response.body;
      if (result.success) {
        context.commit('UPDATE_ANSWERS', result.data);
        context.commit('UPDATE_AUTO_DRAFT_STATUS', false);
      }
    });
  },
  deleteAnswer(context, payload) {
    context.commit('DELETE_ANSWER', payload.id);
    LP.Request({
      type: 'delete-answer',
      answer_id: payload.id
    }).then(function (response) {
      const result = response.body;
      if (result.success) {
        context.commit('SET_ANSWERS', result.data);
      } else {
        // notice error
      }
    });
  },
  newAnswer(context, data) {
    context.commit('ADD_NEW_ANSWER', data.answer);
    LP.Request({
      type: 'new-answer'
    }).then(function (response) {
      const result = response.body;
      if (result.success) {
        context.commit('UPDATE_ANSWERS', result.data);
      } else {
        // notice error
      }
    });
  },
  newRequest(context) {
    context.commit('INCREASE_NUMBER_REQUEST');
    context.commit('UPDATE_STATUS', 'loading');
    window.onbeforeunload = function () {
      return '';
    };
  },
  requestCompleted(context, status) {
    context.commit('DECREASE_NUMBER_REQUEST');
    if (context.getters.currentRequest === 0) {
      context.commit('UPDATE_STATUS', status);
      window.onbeforeunload = null;
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Question);

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

/***/ "./assets/src/apps/js/admin/editor/getters/question.js":
/*!*************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/getters/question.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Question = {
  id: function (state) {
    return state.id;
  },
  type: function (state) {
    return state.type;
  },
  code: function (state) {
    return Date.now();
  },
  autoDraft: function (state) {
    return state.auto_draft;
  },
  answers: function (state) {
    return Object.values(state.answers) || [];
  },
  settings: function (state) {
    return state.setting;
  },
  types: function (state) {
    return state.questionTypes || [];
  },
  numberCorrect: function (state) {
    var correct = 0;
    Object.keys(state.answers).forEach(function (key) {
      if (state.answers[key].is_true === 'yes') {
        correct += 1;
      }
    });
    return correct;
  },
  status: function (state) {
    return state.status;
  },
  currentRequest: function (state) {
    return state.countCurrentRequest || 0;
  },
  action: function (state) {
    return state.action;
  },
  nonce: function (state) {
    return state.nonce;
  },
  externalComponent: function (state) {
    return state.externalComponent || [];
  },
  supportAnswerOptions: function (state) {
    return state.supportAnswerOptions || [];
  },
  state: function (state) {
    return state;
  },
  i18n: function (state) {
    return state.i18n;
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Question);

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

/***/ "./assets/src/apps/js/admin/editor/mutations/question.js":
/*!***************************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/mutations/question.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Question = {
  UPDATE_STATUS: function (state, status) {
    state.status = status;
  },
  UPDATE_AUTO_DRAFT_STATUS: function (state, status) {
    state.auto_draft = status;
  },
  CHANGE_QUESTION_TYPE: function (state, question) {
    state.answers = question.answers;
    state.type = question.type;
  },
  SET_ANSWERS: function (state, answers) {
    state.answers = answers;
  },
  DELETE_ANSWER: function (state, id) {
    for (var i = 0, n = state.answers.length; i < n; i++) {
      if (state.answers[i].question_answer_id == id) {
        state.answers[i].question_answer_id = LP.uniqueId();
        break;
      }
    }
  },
  ADD_NEW_ANSWER: function (state, answer) {
    state.answers.push(answer);
  },
  UPDATE_ANSWERS: function (state, answers) {
    state.answers = answers;
  },
  INCREASE_NUMBER_REQUEST: function (state) {
    state.countCurrentRequest++;
  },
  DECREASE_NUMBER_REQUEST: function (state) {
    state.countCurrentRequest--;
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Question);

/***/ }),

/***/ "./assets/src/apps/js/admin/editor/store/question.js":
/*!***********************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/store/question.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _getters_question__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../getters/question */ "./assets/src/apps/js/admin/editor/getters/question.js");
/* harmony import */ var _mutations_question__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../mutations/question */ "./assets/src/apps/js/admin/editor/mutations/question.js");
/* harmony import */ var _actions_question__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../actions/question */ "./assets/src/apps/js/admin/editor/actions/question.js");



const $ = window.jQuery || jQuery;
const Question = function Question(data) {
  var state = $.extend({
    status: 'successful',
    countCurrentRequest: 0,
    i18n: $.extend({}, data.i18n)
  }, data.root);
  return {
    state: state,
    getters: _getters_question__WEBPACK_IMPORTED_MODULE_0__["default"],
    mutations: _mutations_question__WEBPACK_IMPORTED_MODULE_1__["default"],
    actions: _actions_question__WEBPACK_IMPORTED_MODULE_2__["default"]
  };
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Question);

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
/*!*****************************************************!*\
  !*** ./assets/src/apps/js/admin/editor/question.js ***!
  \*****************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _http__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./http */ "./assets/src/apps/js/admin/editor/http.js");
/* harmony import */ var _store_question__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./store/question */ "./assets/src/apps/js/admin/editor/store/question.js");
/* harmony import */ var _fill_in_blanks__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./fill-in-blanks */ "./assets/src/apps/js/admin/editor/fill-in-blanks.js");
/* harmony import */ var _fill_in_blanks__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_fill_in_blanks__WEBPACK_IMPORTED_MODULE_2__);



window.$Vue = window.$Vue || Vue;
window.$Vuex = window.$Vuex || Vuex;
const $ = window.jQuery;

/**
 * Init app.
 *
 * @since 3.0.0
 */
$(document).ready(function () {
  window.LP_Question_Store = new $Vuex.Store((0,_store_question__WEBPACK_IMPORTED_MODULE_1__["default"])(lp_question_editor));
  (0,_http__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ns: 'LPQuestionEditorRequest',
    store: LP_Question_Store
  });
  setTimeout(() => {
    if ($('#admin-editor-lp_question').length) {
      window.LP_Question_Editor = new $Vue({
        el: '#admin-editor-lp_question',
        template: '<lp-question-editor></lp-question-editor>'
      });
    }
  }, 100);
});
})();

/******/ })()
;
//# sourceMappingURL=question.js.map