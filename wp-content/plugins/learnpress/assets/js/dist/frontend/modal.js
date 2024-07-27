/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/frontend/modal/index.js":
/*!****************************************************!*\
  !*** ./assets/src/apps/js/frontend/modal/index.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./store */ "./assets/src/apps/js/frontend/modal/store/index.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_3__);

/**
 * Create Modal popup.
 * Edit: Use React Hook.
 *
 * @author Nhamdv - ThimPress.
 */




const Modal = ({
  children
}) => {
  const {
    show,
    hide,
    confirm
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.dispatch)('learnpress/modal');
  const isShow = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.useSelect)(select => {
    const isOpen = select('learnpress/modal').isOpen();
    return isOpen;
  });
  const message = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.useSelect)(select => {
    const getMessage = select('learnpress/modal').getMessage();
    return getMessage;
  });
  const dataConfirm = c => event => {
    confirm(c);
  };
  const styles = {
    display: isShow ? 'block' : 'none'
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    id: "lp-modal-overlay",
    style: styles
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    id: "lp-modal-window",
    style: styles
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    id: "lp-modal-content",
    dangerouslySetInnerHTML: {
      __html: message
    }
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    id: "lp-modal-buttons"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "lp-button modal-button-ok",
    onClick: dataConfirm('yes')
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('OK', 'learnpress'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "lp-button modal-button-cancel",
    onClick: dataConfirm('no')
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Cancel', 'learnpress')))))), children);
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Modal);

/***/ }),

/***/ "./assets/src/apps/js/frontend/modal/store/actions.js":
/*!************************************************************!*\
  !*** ./assets/src/apps/js/frontend/modal/store/actions.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   confirm: () => (/* binding */ confirm),
/* harmony export */   hide: () => (/* binding */ hide),
/* harmony export */   show: () => (/* binding */ show)
/* harmony export */ });
function show(message, cb) {
  return {
    type: 'SHOW_MODAL',
    message,
    cb
  };
}
function hide() {
  return {
    type: 'HIDE_MODAL'
  };
}
function confirm(value) {
  return {
    type: 'CONFIRM',
    value
  };
}

/***/ }),

/***/ "./assets/src/apps/js/frontend/modal/store/index.js":
/*!**********************************************************!*\
  !*** ./assets/src/apps/js/frontend/modal/store/index.js ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _reducer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./reducer */ "./assets/src/apps/js/frontend/modal/store/reducer.js");
/* harmony import */ var _actions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./actions */ "./assets/src/apps/js/frontend/modal/store/actions.js");
/* harmony import */ var _selectors__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./selectors */ "./assets/src/apps/js/frontend/modal/store/selectors.js");
/* harmony import */ var _middlewares__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./middlewares */ "./assets/src/apps/js/frontend/modal/store/middlewares.js");





const {
  controls: dataControls
} = LP.dataControls;
const store = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.registerStore)('learnpress/modal', {
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

/***/ "./assets/src/apps/js/frontend/modal/store/middlewares.js":
/*!****************************************************************!*\
  !*** ./assets/src/apps/js/frontend/modal/store/middlewares.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var refx__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! refx */ "./node_modules/refx/refx.js");
/* harmony import */ var refx__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(refx__WEBPACK_IMPORTED_MODULE_0__);
/**
 * External dependencies
 */

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

/***/ "./assets/src/apps/js/frontend/modal/store/reducer.js":
/*!************************************************************!*\
  !*** ./assets/src/apps/js/frontend/modal/store/reducer.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Modal: () => (/* binding */ Modal),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const STORE_DATA = {};
const Modal = (state = STORE_DATA, action) => {
  switch (action.type) {
    case 'SHOW_MODAL':
      return {
        ...state,
        isOpen: true,
        message: action.message,
        cb: action.cb
      };
    case 'HIDE_MODAL':
      return {
        ...state,
        isOpen: false,
        message: false,
        cb: null
      };
    case 'CONFIRM':
      state.cb && setTimeout(() => {
        state.cb();
      }, 10);
      return {
        ...state,
        confirm: action.value
      };
  }
  return state;
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Modal);

/***/ }),

/***/ "./assets/src/apps/js/frontend/modal/store/selectors.js":
/*!**************************************************************!*\
  !*** ./assets/src/apps/js/frontend/modal/store/selectors.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   confirm: () => (/* binding */ confirm),
/* harmony export */   getMessage: () => (/* binding */ getMessage),
/* harmony export */   isOpen: () => (/* binding */ isOpen)
/* harmony export */ });
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);

function isOpen(state) {
  return state.isOpen;
}
function getMessage(state) {
  return state.message;
}
function confirm(state, message, cb) {
  const {
    show,
    hide
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.dispatch)('learnpress/modal');
  if (!state.message) {
    show(message, cb);
  } else {
    hide();
    return state.confirm;
  }
  return 'no';
}

/***/ }),

/***/ "./node_modules/refx/refx.js":
/*!***********************************!*\
  !*** ./node_modules/refx/refx.js ***!
  \***********************************/
/***/ ((module) => {



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

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

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
/*!**********************************************!*\
  !*** ./assets/src/apps/js/frontend/modal.js ***!
  \**********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _modal_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modal/index */ "./assets/src/apps/js/frontend/modal/index.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_modal_index__WEBPACK_IMPORTED_MODULE_0__["default"]);
(window.LP = window.LP || {}).modal = __webpack_exports__;
/******/ })()
;
//# sourceMappingURL=modal.js.map