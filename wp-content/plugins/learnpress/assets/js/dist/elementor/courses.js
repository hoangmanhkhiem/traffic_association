/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/utils/utils.js":
/*!*******************************************!*\
  !*** ./assets/src/apps/js/utils/utils.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   lpAddQueryArgs: () => (/* binding */ lpAddQueryArgs),
/* harmony export */   lpFetchAPI: () => (/* binding */ lpFetchAPI),
/* harmony export */   lpGetCurrentURLNoParam: () => (/* binding */ lpGetCurrentURLNoParam)
/* harmony export */ });
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


/***/ }),

/***/ "./assets/src/js/utils/cookie.js":
/*!***************************************!*\
  !*** ./assets/src/js/utils/cookie.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/**
 * Cookie
 *
 * @since 4.2.3.4
 * @version 1.0.0
 */
const Cookie = {
  set: (cname, cvalue, exdays) => {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    const expires = 'expires=' + d.toUTCString();
    document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
  },
  get: cname => {
    const name = cname + '=';
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) === 0) {
        return c.substring(name.length, c.length);
      }
    }
    return '';
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Cookie);

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
/*!********************************************!*\
  !*** ./assets/src/js/elementor/courses.js ***!
  \********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _apps_js_utils_utils__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../apps/js/utils/utils */ "./assets/src/apps/js/utils/utils.js");
/* harmony import */ var _utils_cookie__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/cookie */ "./assets/src/js/utils/cookie.js");


window.lpElWidgetCoursesByPage = (() => {
  const classCoursesWrapper = 'list-courses-elm-wrapper';
  const classListCourse = 'list-courses-elm';
  const classPaginationCourse = 'learn-press-pagination';
  const classCoursesPageResult = 'courses-page-result';
  const classSkeleton = 'lp-skeleton-animation';
  let filterCourses = {};
  const currentUrl = (0,_apps_js_utils_utils__WEBPACK_IMPORTED_MODULE_0__.lpGetCurrentURLNoParam)();
  let urlAPI;
  let typePagination = 'number';
  let firstLoad = true;
  let timeOutSearch;
  let isLoadingInfinite = false;
  const isLoadRest = false;
  const fetchAPI = (args, callBack = {}) => {
    //console.log( 'Fetch API Courses' );
    const paramsFetch = {
      method: 'POST',
      body: JSON.stringify(args),
      headers: {
        'Content-Type': 'application/json' // Set the content type to JSON
      }
    };
    if ('undefined' !== typeof args.nonce) {
      paramsFetch.headers['X-WP-Nonce'] = args.nonce;
    }
    (0,_apps_js_utils_utils__WEBPACK_IMPORTED_MODULE_0__.lpFetchAPI)(urlAPI + 'lp/v1/courses/courses-widget-by-page', paramsFetch, callBack);
  };
  const callBackFilter = elCoursesWrapper => {
    if (!elCoursesWrapper) {
      return;
    }
    const skeleton = elCoursesWrapper.querySelector(`.${classSkeleton}`);
    const elListCourse = elCoursesWrapper.querySelector(`.${classListCourse}`);
    const elPagination = elCoursesWrapper.querySelector(`.${classPaginationCourse}`);
    const elCoursesPageResult = elCoursesWrapper.querySelector(`.${classCoursesPageResult}`);
    return {
      before: () => {},
      success: res => {
        const divTmp = document.createElement('div');
        divTmp.innerHTML = res.data.content || '';
        const elListCourseTmp = divTmp.querySelector(`.${classListCourse}`);
        const elPaginationTmp = divTmp.querySelector(`.${classPaginationCourse}`);
        const elCoursesPageResultTmp = divTmp.querySelector(`.${classCoursesPageResult}`);
        if (elListCourse) {
          elListCourse.innerHTML = elListCourseTmp.innerHTML;
          if (elPagination) {
            elPagination.innerHTML = elPaginationTmp.innerHTML;
          }
          if (elCoursesPageResult) {
            elCoursesPageResult.innerHTML = elCoursesPageResultTmp.innerHTML;
          }

          // Scroll to el
          const optionScroll = {
            behavior: 'smooth'
          };
          elListCourse.scrollIntoView(optionScroll);
        } else {
          elCoursesWrapper.insertAdjacentHTML('beforeend', res.data.content || '');
        }
        if (res.data.pagination) {
          elCoursesWrapper.insertAdjacentHTML('beforeend', res.data.pagination || '');
        }
      },
      error: error => {},
      completed: () => {
        if (skeleton) {
          skeleton.style.display = 'none';
        }
      }
    };
  };
  const callBackPaginationTypeLoadMore = elCoursesWrapper => {
    const btnLoadMore = elCoursesWrapper.querySelector('.courses-btn-load-more');
    let elLoading;
    if (btnLoadMore) {
      elLoading = btnLoadMore.querySelector('.lp-loading-circle');
    }
    const skeleton = elCoursesWrapper.querySelector(`.${classSkeleton}`);
    const elListCourse = elCoursesWrapper.querySelector(`.${classListCourse}`);
    return {
      before: () => {
        if (btnLoadMore) {
          elLoading.classList.remove('hide');
          btnLoadMore.setAttribute('disabled', 'disabled');
        }
      },
      success: res => {
        const divTmp = document.createElement('div');
        divTmp.innerHTML = res.data.content || '';
        const elListCourseTmp = divTmp.querySelector(`.${classListCourse}`);
        const elPaginationTmp = divTmp.querySelector(`.${classPaginationCourse}`);
        if (elListCourse) {
          elListCourse.insertAdjacentHTML('beforeend', elListCourseTmp.innerHTML);
          if (!elPaginationTmp) {
            btnLoadMore.remove();
          }
        } else {
          elCoursesWrapper.insertAdjacentHTML('beforeend', res.data.content || '');
        }
        if (res.data.pagination) {
          elCoursesWrapper.insertAdjacentHTML('beforeend', res.data.pagination || '');
        }
      },
      error: error => {},
      completed: () => {
        if (skeleton) {
          skeleton.style.display = 'none';
        }
        if (btnLoadMore) {
          elLoading.classList.add('hide');
          btnLoadMore.removeAttribute('disabled');
        }
      }
    };
  };
  const callBackPaginationTypeInfinite = elCoursesWrapper => {
    const skeleton = elCoursesWrapper.querySelector(`.${classSkeleton}`);
    const elInfinite = elCoursesWrapper.querySelector('.courses-load-infinite');
    let loading;
    if (elInfinite) {
      loading = elInfinite.querySelector('.lp-loading-circle');
    }
    const elListCourse = elCoursesWrapper.querySelector(`.${classListCourse}`);
    return {
      before: () => {
        isLoadingInfinite = true;
        if (loading) {
          loading.classList.remove('hide');
        }
      },
      success: res => {
        const divTmp = document.createElement('div');
        divTmp.innerHTML = res.data.content || '';
        const elListCourseTmp = divTmp.querySelector(`.${classListCourse}`);
        const elPaginationTmp = divTmp.querySelector(`.${classPaginationCourse}`);
        if (elListCourse) {
          elListCourse.insertAdjacentHTML('beforeend', elListCourseTmp.innerHTML);
          if (!elPaginationTmp) {
            elInfinite.remove();
          }
        } else {
          elCoursesWrapper.insertAdjacentHTML('beforeend', res.data.content || '');
        }
        if (res.data.pagination) {
          elCoursesWrapper.insertAdjacentHTML('beforeend', res.data.pagination || '');
        }
      },
      error: error => {},
      completed: () => {
        isLoadingInfinite = false;
        if (skeleton) {
          skeleton.style.display = 'none';
        }
        if (elInfinite) {
          loading.classList.add('hide');
        }
      }
    };
  };
  const callApiCoursesOfWidget = (elCoursesWrapper, args = {}) => {
    var _settingsWidget$lp_re, _settingsWidget$cours;
    console.log('/*** loadApiCoursesOfWidget ***/');
    const idWidget = elCoursesWrapper.dataset.widgetId;
    let settingsWidget = window[`lpWidget_${idWidget}`];
    if (!settingsWidget) {
      return;
    }
    if ('yes' !== settingsWidget.courses_rest) {
      return;
    }
    if ('yes' === settingsWidget.courses_rest_no_load_page && firstLoad) {
      firstLoad = false;
      return;
    }
    settingsWidget = {
      ...settingsWidget,
      ...args
    };
    urlAPI = (_settingsWidget$lp_re = settingsWidget.lp_rest_url) !== null && _settingsWidget$lp_re !== void 0 ? _settingsWidget$lp_re : '';
    typePagination = (_settingsWidget$cours = settingsWidget.courses_rest_pagination_type) !== null && _settingsWidget$cours !== void 0 ? _settingsWidget$cours : 'number';
    let callBack;
    switch (typePagination) {
      case 'load-more':
        callBack = callBackPaginationTypeLoadMore(elCoursesWrapper);
        break;
      case 'infinite':
        callBack = callBackPaginationTypeInfinite(elCoursesWrapper);
        break;
      default:
        // number
        callBack = callBackFilter(elCoursesWrapper);
        break;
    }
    if (!callBack) {
      return;
    }
    fetchAPI(settingsWidget, callBack);
  };
  const findAllWidgetCoursesByPage = () => {
    const elCoursesWrappers = document.querySelectorAll(`.${classCoursesWrapper}`);
    if (!elCoursesWrappers) {
      return;
    }
    elCoursesWrappers.forEach(el => {
      callApiCoursesOfWidget(el);
    });
  };
  const onChangeSortBy = (e, target) => {
    if (!target.classList.contains('courses-order-by')) {
      return;
    }
    const elCoursesWrapper = target.closest(`.${classCoursesWrapper}`);
    if (!elCoursesWrapper) {
      return;
    }
    e.preventDefault();
    const idWidget = elCoursesWrapper.dataset.widgetId;
    const settingsWidget = window[`lpWidget_${idWidget}`];
    filterCourses.order_by = target.value;
    filterCourses.paged = 1;
    if ('yes' !== settingsWidget.courses_rest) {
      window.location.href = (0,_apps_js_utils_utils__WEBPACK_IMPORTED_MODULE_0__.lpAddQueryArgs)(currentUrl, filterCourses);
    } else {
      callApiCoursesOfWidget(elCoursesWrapper, filterCourses);
    }
  };
  const onChangeLayout = (e, target) => {
    if (!target.classList.contains('courses-layout')) {
      if (!target.closest('.courses-layout')) {
        return;
      }
      target = target.closest('.courses-layout');
    }
    const elCoursesWrapper = target.closest(`.${classCoursesWrapper}`);
    if (!elCoursesWrapper) {
      return;
    }
    e.preventDefault();
    const elListCourse = elCoursesWrapper.querySelector(`.${classListCourse}`);
    const elUlLayouts = target.closest('.courses-layouts-display-list');
    const widgetId = elCoursesWrapper.dataset.widgetId;
    const elLayouts = elUlLayouts.querySelectorAll('li');
    elLayouts.forEach(el => {
      el.classList.remove('active');
    });
    const layout = target.dataset.layout;
    target.classList.add('active');
    elListCourse.classList.remove('grid', 'list');
    elListCourse.classList.add(layout);
    _utils_cookie__WEBPACK_IMPORTED_MODULE_1__["default"].set(`layout_widget_${widgetId}`, layout, 7);
  };
  const events = () => {
    document.addEventListener('change', function (e) {
      const target = e.target;
      onChangeSortBy(e, target);
    });
    document.addEventListener('click', function (e) {
      const target = e.target;
      clickLoadMore(e, target);
      clickNumberPage(e, target);
      onChangeLayout(e, target);
    });
    document.addEventListener('scroll', function (e) {
      const target = e.target;
      scrollInfinite(e, target);
    });
    document.addEventListener('keyup', function (e) {
      const target = e.target;

      //window.lpCourseList.searchCourse( e, target );
    });
    document.addEventListener('submit', function (e) {
      const target = e.target;

      //window.lpCourseList.searchCourse( e, target );
    });
  };
  const clickNumberPage = (e, target) => {
    if (!target.classList.contains('page-numbers')) {
      if (!target.closest('.page-numbers')) {
        return;
      }
      target = target.closest('.page-numbers');
    }
    const elCoursesWrapper = target.closest(`.${classCoursesWrapper}`);
    if (!elCoursesWrapper) {
      return;
    }
    const idWidget = elCoursesWrapper.dataset.widgetId;
    const settingsWidget = window[`lpWidget_${idWidget}`];
    if (!settingsWidget || 'yes' !== settingsWidget.courses_rest) {
      return;
    }
    e.preventDefault();
    const pageCurrent = filterCourses.paged;
    if (target.classList.contains('prev')) {
      filterCourses.paged = pageCurrent - 1;
    } else if (target.classList.contains('next')) {
      filterCourses.paged = pageCurrent + 1;
    } else {
      filterCourses.paged = parseInt(target.textContent);
    }
    callApiCoursesOfWidget(elCoursesWrapper, filterCourses);
  };
  const clickLoadMore = (e, target) => {
    if (!target.classList.contains('courses-btn-load-more')) {
      if (!target.closest('.courses-btn-load-more')) {
        return;
      }
      target = target.closest('.courses-btn-load-more');
    }
    const elCoursesWrapper = target.closest(`.${classCoursesWrapper}`);
    if (!elCoursesWrapper) {
      return;
    }
    const idWidget = elCoursesWrapper.dataset.widgetId;
    const settingsWidget = window[`lpWidget_${idWidget}`];
    if (!settingsWidget || 'yes' !== settingsWidget.courses_rest) {
      return;
    }
    e.preventDefault();
    ++filterCourses.paged;
    callApiCoursesOfWidget(elCoursesWrapper, filterCourses);
  };
  const scrollInfinite = (e, target) => {
    const elCoursesWrapper = document.querySelector(`.${classCoursesWrapper}`);
    if (!elCoursesWrapper) {
      return;
    }
    const elInfinite = elCoursesWrapper.querySelector('.courses-load-infinite');
    if (!elInfinite) {
      return;
    }
    const idWidget = elCoursesWrapper.dataset.widgetId;
    const settingsWidget = window[`lpWidget_${idWidget}`];
    if (!settingsWidget || 'yes' !== settingsWidget.courses_rest) {
      return;
    }

    // Create an IntersectionObserver object.
    const observer = new IntersectionObserver(function (entries) {
      for (const entry of entries) {
        // If the entry is intersecting, load the image.
        if (entry.isIntersecting) {
          if (isLoadingInfinite) {
            return;
          }
          ++filterCourses.paged;
          callApiCoursesOfWidget(elCoursesWrapper, filterCourses);
          observer.unobserve(entry.target);
        }
      }
    });
    observer.observe(elInfinite);
  };
  return {
    init: () => {
      const urlParams = {};
      const urlQueryString = window.location.search;
      const urlSearchParams = new URLSearchParams(urlQueryString);
      for (const [key, val] of urlSearchParams.entries()) {
        urlParams[key] = val;
      }

      //filterCourses = { ...lpArchiveSkeletonParam, ...urlParams };
      filterCourses = {
        ...urlParams
      };
      filterCourses.paged = parseInt(filterCourses.paged || 1);
      findAllWidgetCoursesByPage();
      events();
    }
  };
})();
document.addEventListener('DOMContentLoaded', function () {
  window.lpElWidgetCoursesByPage.init();
});
/******/ })()
;
//# sourceMappingURL=courses.js.map