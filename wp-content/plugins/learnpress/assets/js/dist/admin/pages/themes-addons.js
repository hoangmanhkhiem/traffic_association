/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/admin/pages/addons/search-lp-addons-themes.js":
/*!**************************************************************************!*\
  !*** ./assets/src/apps/js/admin/pages/addons/search-lp-addons-themes.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
(function ($) {
  let timer = null,
    $wraps = null,
    $cloneWraps = null;
  const onSearch = function (keyword) {
    if (!$cloneWraps) {
      $cloneWraps = $wraps.clone();
    }
    const keywords = keyword.toLowerCase().split(/\s+/).filter(function (a, b) {
      return a.length >= 3;
    });
    const foundItems = function ($w1, $w2) {
      return $w1.find('.plugin-card').each(function () {
        const $item = $(this),
          itemText = $item.find('.item-title').text().toLowerCase(),
          itemDesc = $item.find('.column-description, .theme-description').text();
        const found = function () {
          const reg = new RegExp(keywords.join('|'), 'ig');
          return itemText.match(reg) || itemDesc.match(reg);
        };
        if (keywords.length) {
          if (found()) {
            const $clone = $item.clone();
            $w2.append($clone);
          }
        } else {
          $w2.append($item.clone());
        }
      });
    };
    $wraps.each(function (i) {
      const $this = $(this).html(''),
        $items = foundItems($cloneWraps.eq(i), $this),
        count = $this.children().length;
      $this.prev('h2').find('span').html(count);
    });
  };
  $(document).on('keyup', '.lp-search-addon', function (e) {
    timer && clearTimeout(timer);
    timer = setTimeout(onSearch, 300, e.target.value);
  });
  $(function () {
    $wraps = $('.addons-browse');
  });
})(jQuery);
const searchThemesAddons = () => {};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (searchThemesAddons);

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
/*!*********************************************************!*\
  !*** ./assets/src/apps/js/admin/pages/themes-addons.js ***!
  \*********************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _addons_search_lp_addons_themes__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./addons/search-lp-addons-themes */ "./assets/src/apps/js/admin/pages/addons/search-lp-addons-themes.js");

document.addEventListener('DOMContentLoaded', function (event) {
  (0,_addons_search_lp_addons_themes__WEBPACK_IMPORTED_MODULE_0__["default"])();
});
/******/ })()
;
//# sourceMappingURL=themes-addons.js.map