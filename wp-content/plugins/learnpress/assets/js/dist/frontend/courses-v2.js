/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/api.js":
/*!******************************!*\
  !*** ./assets/src/js/api.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/**
 * List API on backend
 *
 * @since 4.2.6
 * @version 1.0.0
 */

const lplistAPI = {};
if ('undefined' !== typeof lpDataAdmin) {
  lplistAPI.admin = {
    apiAdminNotice: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/admin-notices',
    apiAdminOrderStatic: lpDataAdmin.lp_rest_url + 'lp/v1/orders/statistic',
    apiAddons: lpDataAdmin.lp_rest_url + 'lp/v1/addon/all',
    apiAddonAction: lpDataAdmin.lp_rest_url + 'lp/v1/addon/action',
    apiAddonsPurchase: lpDataAdmin.lp_rest_url + 'lp/v1/addon/info-addons-purchase',
    apiSearchCourses: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/search-course',
    apiSearchUsers: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/search-user',
    apiAssignUserCourse: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/assign-user-course',
    apiUnAssignUserCourse: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/unassign-user-course',
    apiAJAX: lpDataAdmin.lp_rest_url + 'lp/v1/load_content_via_ajax/'
  };
}
if ('undefined' !== typeof lpData) {
  lplistAPI.frontend = {
    apiWidgets: lpData.lp_rest_url + 'lp/v1/widgets/api',
    apiCourses: lpData.lp_rest_url + 'lp/v1/courses/archive-course',
    apiAJAX: lpData.lp_rest_url + 'lp/v1/load_content_via_ajax/'
  };
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (lplistAPI);

/***/ }),

/***/ "./assets/src/js/utils.js":
/*!********************************!*\
  !*** ./assets/src/js/utils.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   listenElementCreated: () => (/* binding */ listenElementCreated),
/* harmony export */   listenElementViewed: () => (/* binding */ listenElementViewed),
/* harmony export */   lpAddQueryArgs: () => (/* binding */ lpAddQueryArgs),
/* harmony export */   lpAjaxParseJsonOld: () => (/* binding */ lpAjaxParseJsonOld),
/* harmony export */   lpFetchAPI: () => (/* binding */ lpFetchAPI),
/* harmony export */   lpGetCurrentURLNoParam: () => (/* binding */ lpGetCurrentURLNoParam)
/* harmony export */ });
/**
 * Fetch API.
 *
 * @param url
 * @param data
 * @param functions
 * @since 4.2.5.1
 * @version 1.0.1
 */
const lpFetchAPI = (url, data = {}, functions = {}) => {
  if ('function' === typeof functions.before) {
    functions.before();
  }
  fetch(url, {
    method: 'GET',
    ...data
  }).then(response => response.json()).then(response => {
    if ('function' === typeof functions.success) {
      functions.success(response);
    }
  }).catch(err => {
    if ('function' === typeof functions.error) {
      functions.error(err);
    }
  }).finally(() => {
    if ('function' === typeof functions.completed) {
      functions.completed();
    }
  });
};

/**
 * Get current URL without params.
 *
 * @since 4.2.5.1
 */
const lpGetCurrentURLNoParam = () => {
  let currentUrl = window.location.href;
  const hasParams = currentUrl.includes('?');
  if (hasParams) {
    currentUrl = currentUrl.split('?')[0];
  }
  return currentUrl;
};
const lpAddQueryArgs = (endpoint, args) => {
  const url = new URL(endpoint);
  Object.keys(args).forEach(arg => {
    url.searchParams.set(arg, args[arg]);
  });
  return url;
};

/**
 * Listen element viewed.
 *
 * @param el
 * @param callback
 * @since 4.2.5.8
 */
const listenElementViewed = (el, callback) => {
  const observerSeeItem = new IntersectionObserver(function (entries) {
    for (const entry of entries) {
      if (entry.isIntersecting) {
        callback(entry);
      }
    }
  });
  observerSeeItem.observe(el);
};

/**
 * Listen element created.
 *
 * @param callback
 * @since 4.2.5.8
 */
const listenElementCreated = callback => {
  const observerCreateItem = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      if (mutation.addedNodes) {
        mutation.addedNodes.forEach(function (node) {
          if (node.nodeType === 1) {
            callback(node);
          }
        });
      }
    });
  });
  observerCreateItem.observe(document, {
    childList: true,
    subtree: true
  });
  // End.
};

// Parse JSON from string with content include LP_AJAX_START.
const lpAjaxParseJsonOld = data => {
  if (typeof data !== 'string') {
    return data;
  }
  const m = String.raw({
    raw: data
  }).match(/<-- LP_AJAX_START -->(.*)<-- LP_AJAX_END -->/s);
  try {
    if (m) {
      data = JSON.parse(m[1].replace(/(?:\r\n|\r|\n)/g, ''));
    } else {
      data = JSON.parse(data);
    }
  } catch (e) {
    data = {};
  }
  return data;
};


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
/*!**********************************************!*\
  !*** ./assets/src/js/frontend/courses-v2.js ***!
  \**********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _api__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../api */ "./assets/src/js/api.js");
/* harmony import */ var _utils_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils.js */ "./assets/src/js/utils.js");
/**
 * Handle events for courses list.
 *
 * @since 4.2.5.8
 * @version 1.0.1
 */



if ('undefined' === typeof lpData) {
  console.log('lpData is undefined');
}

// Events
document.addEventListener('change', function (e) {
  const target = e.target;
  window.lpCoursesList.onChangeSortBy(e, target);
  window.lpCoursesList.onChangeTypeLayout(e, target);
});
document.addEventListener('click', function (e) {
  const target = e.target;
  window.lpCoursesList.clickNumberPage(e, target);
  window.lpCoursesList.LoadMore(e, target);
});
document.addEventListener('keyup', function (e) {
  const target = e.target;
  window.lpCoursesList.searchCourse(e, target);
});
document.addEventListener('submit', function (e) {
  const target = e.target;

  //window.lpCourseList.searchCourse( e, target );
});
let timeOutSearch;
window.lpCoursesList = (() => {
  const classListCourse = '.lp-list-courses-no-css';
  const classLPTarget = '.lp-target';
  const classLoadMore = 'courses-btn-load-more-no-css';
  const classPageResult = '.courses-page-result';
  const classLoading = '.lp-loading-no-css';
  const urlCurrent = (0,_utils_js__WEBPACK_IMPORTED_MODULE_1__.lpGetCurrentURLNoParam)();
  return {
    clickNumberPage: (e, target) => {
      const btnNumber = target.closest('.page-numbers:not(.disabled)');
      if (!btnNumber) {
        return;
      }
      const elLPTarget = btnNumber.closest(`${classLPTarget}`);
      if (!elLPTarget) {
        return;
      }
      const dataObj = JSON.parse(elLPTarget.dataset.send);
      const dataSend = {
        ...dataObj
      };
      if (!dataSend.args.hasOwnProperty('paged')) {
        dataSend.args.paged = 1;
      }

      // If no load ajax, will return.
      if (dataSend.args.courses_load_ajax === 0) {
        return;
      }
      e.preventDefault();
      if (btnNumber.classList.contains('prev')) {
        dataSend.args.paged--;
      } else if (btnNumber.classList.contains('next')) {
        dataSend.args.paged++;
      } else {
        dataSend.args.paged = btnNumber.textContent;
      }
      elLPTarget.dataset.send = JSON.stringify(dataSend);

      // Set url params to reload page.
      // Todo: need check allow set url params.
      lpData.urlParams.paged = dataSend.args.paged;
      window.history.pushState({}, '', (0,_utils_js__WEBPACK_IMPORTED_MODULE_1__.lpAddQueryArgs)(urlCurrent, lpData.urlParams));
      // End.

      // Show loading
      const elLoading = elLPTarget.closest('div:not(.lp-target)').querySelector('.lp-loading-change');
      if (elLoading) {
        elLoading.style.display = 'block';
      }
      // End

      // Scroll to archive element
      const elLPTargetY = elLPTarget.getBoundingClientRect().top + window.scrollY;
      window.scrollTo({
        top: elLPTargetY
      });
      const callBack = {
        success: response => {
          //console.log( 'response', response );
          const {
            status,
            message,
            data
          } = response;
          elLPTarget.innerHTML = data.content || '';
        },
        error: error => {
          console.log(error);
        },
        completed: () => {
          //console.log( 'completed' );
          if (elLoading) {
            elLoading.style.display = 'none';
          }
        }
      };
      window.lpAJAXG.fetchAPI(_api__WEBPACK_IMPORTED_MODULE_0__["default"].frontend.apiAJAX, dataSend, callBack);
    },
    LoadMore: (e, target) => {
      const btnLoadMore = target.closest(`.${classLoadMore + ':not(.disabled)'}`);
      if (!btnLoadMore) {
        return;
      }
      const elLPTarget = btnLoadMore.closest(`${classLPTarget}`);
      if (!elLPTarget) {
        return;
      }
      e.preventDefault();
      btnLoadMore.classList.add('disabled');
      const elLoading = btnLoadMore.querySelector(classLoading);
      const dataObj = JSON.parse(elLPTarget.dataset.send);
      const dataSend = {
        ...dataObj
      };
      if (!dataSend.args.hasOwnProperty('paged')) {
        dataSend.args.paged = 1;
      }
      dataSend.args.paged++;
      elLPTarget.dataset.send = JSON.stringify(dataSend);
      if (elLoading) {
        elLoading.classList.remove('hide');
      }
      const callBack = {
        success: response => {
          const {
            status,
            message,
            data
          } = response;
          const paged = parseInt(data.paged);
          const totalPages = parseInt(data.total_pages);
          const newEl = document.createElement('div');
          newEl.innerHTML = data.content || '';
          const elListCourse = elLPTarget.querySelector(classListCourse);
          const elPageResult = elLPTarget.querySelector(classPageResult);
          const elPageResultNew = newEl.querySelector(classPageResult);
          elListCourse.insertAdjacentHTML('beforeend', newEl.querySelector(classListCourse).innerHTML);
          if (elPageResult && elPageResultNew) {
            elPageResult.innerHTML = elPageResultNew.innerHTML;
          }
          if (paged >= totalPages) {
            btnLoadMore.remove();
          }
        },
        error: error => {
          console.log(error);
        },
        completed: () => {
          //console.log( 'completed' );
          if (elLoading) {
            elLoading.classList.add('hide');
          }
          btnLoadMore.classList.remove('disabled');
        }
      };
      window.lpAJAXG.fetchAPI(_api__WEBPACK_IMPORTED_MODULE_0__["default"].frontend.apiAJAX, dataSend, callBack);
    },
    LoadInfinite: () => {
      // When see element, will call API to load more items.
      const callBackAfterSeeItem = entry => {
        const elInfinite = entry.target;
        const elLoading = elInfinite.querySelector(`${classLoading}:not(.disabled)`);
        if (!elLoading) {
          return;
        }
        elLoading.classList.remove('hide');
        elLoading.classList.add('disabled');
        const elLPTarget = elInfinite.closest(classLPTarget);
        if (!elLPTarget) {
          return;
        }
        const dataObj = JSON.parse(elLPTarget.dataset.send);
        const dataSend = {
          ...dataObj
        }; // Clone object

        if (!dataSend.args.hasOwnProperty('paged')) {
          dataSend.args.paged = 1;
        }

        // Handle set data send to call API
        dataSend.args.paged++;
        elLPTarget.dataset.send = JSON.stringify(dataSend);
        const callBack = {
          success: response => {
            const {
              status,
              message,
              data
            } = response;
            const newEl = document.createElement('div');
            newEl.innerHTML = data.content || '';
            const elListCourse = elLPTarget.querySelector(classListCourse);
            const elPageResult = elLPTarget.querySelector(classPageResult);
            const elPageResultNew = newEl.querySelector(classPageResult);
            elListCourse.insertAdjacentHTML('beforeend', newEl.querySelector(classListCourse).innerHTML);
            if (elPageResult && elPageResultNew) {
              elPageResult.innerHTML = elPageResultNew.innerHTML;
            }
            if (data.total_pages === data.paged) {
              elInfinite.remove();
            }
          },
          error: error => {
            console.log(error);
          },
          completed: () => {
            //console.log( 'completed' );
            elLoading.classList.add('hide');
            elLoading.classList.remove('disabled');
          }
        };
        window.lpAJAXG.fetchAPI(_api__WEBPACK_IMPORTED_MODULE_0__["default"].frontend.apiAJAX, dataSend, callBack);
      };

      // Listen el courses load infinite have just created.
      (0,_utils_js__WEBPACK_IMPORTED_MODULE_1__.listenElementCreated)(node => {
        if (node.classList.contains('courses-load-infinite-no-css')) {
          (0,_utils_js__WEBPACK_IMPORTED_MODULE_1__.listenElementViewed)(node, callBackAfterSeeItem);
        }
      });

      // If el created on DOMContentLoaded.
      const elInfinite = document.querySelector('.courses-load-infinite-no-css');
      if (elInfinite) {
        (0,_utils_js__WEBPACK_IMPORTED_MODULE_1__.listenElementViewed)(elInfinite, callBackAfterSeeItem);
      }
    },
    onChangeSortBy: (e, target) => {
      if (!target.classList.contains('courses-order-by')) {
        return;
      }
      const elLPTarget = target.closest(classLPTarget);
      if (!elLPTarget) {
        lpData.urlParams.paged = 1;
        lpData.urlParams.order_by = target.value || '';
        window.location.href = (0,_utils_js__WEBPACK_IMPORTED_MODULE_1__.lpAddQueryArgs)(urlCurrent, lpData.urlParams);
        return;
      }
      e.preventDefault();
      const dataObj = JSON.parse(elLPTarget.dataset.send);
      const dataSend = {
        ...dataObj
      };
      dataSend.args.paged = 1;
      dataSend.args.order_by = target.value || '';
      elLPTarget.dataset.send = JSON.stringify(dataSend);

      // Set url params to reload page.
      // Todo: need check allow set url params.
      lpData.urlParams.paged = dataSend.args.paged;
      lpData.urlParams.order_by = dataSend.args.order_by;
      window.history.pushState({}, '', (0,_utils_js__WEBPACK_IMPORTED_MODULE_1__.lpAddQueryArgs)(urlCurrent, lpData.urlParams));
      // End.

      // Show loading
      const elLoading = elLPTarget.closest('div:not(.lp-target)').querySelector('.lp-loading-change');
      if (elLoading) {
        elLoading.style.display = 'block';
      }
      // End

      const callBack = {
        success: response => {
          //console.log( 'response', response );
          const {
            status,
            message,
            data
          } = response;
          elLPTarget.innerHTML = data.content || '';
        },
        error: error => {
          console.log(error);
        },
        completed: () => {
          //console.log( 'completed' );
          if (elLoading) {
            elLoading.style.display = 'none';
          }
        }
      };
      window.lpAJAXG.fetchAPI(_api__WEBPACK_IMPORTED_MODULE_0__["default"].frontend.apiAJAX, dataSend, callBack);
    },
    onChangeTypeLayout: (e, target) => {
      if ('lp-switch-layout-btn' !== target.getAttribute('name')) {
        return;
      }
      const elListCourse = document.querySelector(classListCourse);
      if (!elListCourse) {
        return;
      }
      e.preventDefault();
      const layout = target.value;
      if (layout) {
        elListCourse.dataset.layout = layout;
        window.wpCookies.set('courses-layout', layout, 24 * 60 * 60, '/');
      }
    },
    searchCourse: (e, target) => {
      if ('c_search' !== target.name) {
        return;
      }
      const elLPTarget = target.closest(classLPTarget);
      if (!elLPTarget) {
        return;
      }
      e.preventDefault();
      const dataObj = JSON.parse(elLPTarget.dataset.send);
      const dataSend = {
        ...dataObj
      };
      const keyword = target.value;
      dataSend.args.c_search = keyword || '';
      dataSend.args.paged = 1;
      elLPTarget.dataset.send = JSON.stringify(dataSend);

      // Set url params to reload page.
      // Todo: need check allow set url params.
      lpData.urlParams.paged = dataSend.args.paged;
      lpData.urlParams.c_search = dataSend.args.c_search;
      window.history.pushState({}, '', (0,_utils_js__WEBPACK_IMPORTED_MODULE_1__.lpAddQueryArgs)((0,_utils_js__WEBPACK_IMPORTED_MODULE_1__.lpGetCurrentURLNoParam)(), lpData.urlParams));
      // End.

      if (!keyword || keyword && keyword.length > 2) {
        if (undefined !== timeOutSearch) {
          clearTimeout(timeOutSearch);
        }
        timeOutSearch = setTimeout(function () {
          const callBack = {
            success: response => {
              //console.log( 'response', response );
              const {
                status,
                message,
                data
              } = response;
              elLPTarget.innerHTML = data.content || '';
            },
            error: error => {
              console.log(error);
            },
            completed: () => {
              //console.log( 'completed' );
            }
          };
          window.lpAJAXG.fetchAPI(_api__WEBPACK_IMPORTED_MODULE_0__["default"].frontend.apiAJAX, dataSend, callBack);
        }, 800);
      }
    }
  };
})();
window.lpCoursesList.LoadInfinite();
/******/ })()
;
//# sourceMappingURL=courses-v2.js.map