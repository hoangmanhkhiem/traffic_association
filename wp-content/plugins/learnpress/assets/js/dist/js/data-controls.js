/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "@wordpress/api-fetch":
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["wp"]["apiFetch"];

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
/*!*********************************************!*\
  !*** ./assets/src/apps/js/data-controls.js ***!
  \*********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   apiFetch: () => (/* binding */ apiFetch),
/* harmony export */   controls: () => (/* binding */ controls),
/* harmony export */   dispatch: () => (/* binding */ dispatch),
/* harmony export */   select: () => (/* binding */ select)
/* harmony export */ });
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__);

const createRegistryControl = function createRegistryControl(registryControl) {
  registryControl.isRegistryControl = true;
  return registryControl;
};
const apiFetch = request => {
  return {
    type: 'API_FETCH',
    request
  };
};
function select(storeKey, selectorName, ...args) {
  return {
    type: 'SELECT',
    storeKey,
    selectorName,
    args
  };
}
function dispatch(storeKey, actionName, ...args) {
  return {
    type: 'DISPATCH',
    storeKey,
    actionName,
    args
  };
}
const resolveSelect = (registry, {
  storeKey,
  selectorName,
  args
}) => {
  return new Promise(resolve => {
    const hasFinished = () => registry.select('').hasFinishedResolution(storeKey, selectorName, args);
    const getResult = () => registry.select(storeKey)[selectorName].apply(null, args);
    const result = getResult();
    if (hasFinished()) {
      return resolve(result);
    }
    const unsubscribe = registry.subscribe(() => {
      if (hasFinished()) {
        unsubscribe();
        resolve(getResult());
      }
    });
  });
};
const controls = {
  API_FETCH({
    request
  }) {
    return _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default()(request);
  },
  SELECT: createRegistryControl(registry => ({
    storeKey,
    selectorName,
    args
  }) => {
    return registry.select(storeKey)[selectorName].hasResolver ? resolveSelect(registry, {
      storeKey,
      selectorName,
      args
    }) : registry.select(storeKey)[selectorName](...args);
  }),
  DISPATCH: createRegistryControl(registry => ({
    storeKey,
    actionName,
    args
  }) => {
    return registry.dispatch(storeKey)[actionName](...args);
  })
};
(window.LP = window.LP || {}).dataControls = __webpack_exports__;
/******/ })()
;
//# sourceMappingURL=data-controls.js.map