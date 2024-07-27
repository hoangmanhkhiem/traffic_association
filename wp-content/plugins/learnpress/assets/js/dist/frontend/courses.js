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


/***/ }),

/***/ "./assets/src/js/utils/cookies.js":
/*!****************************************!*\
  !*** ./assets/src/js/utils/cookies.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Cookies = {
  get: (name, def, global) => {
    let ret;
    if (global) {
      ret = wpCookies.get(name);
    } else {
      let ck = wpCookies.get('LP');
      if (ck) {
        ck = JSON.parse(ck);
        ret = name ? ck[name] : ck;
      }
    }
    if (!ret && ret !== def) {
      ret = def;
    }
    return ret;
  },
  set(name, value, expires, path, domain, secure) {
    if (arguments.length > 2) {
      wpCookies.set(name, value, expires, path, domain, secure);
    } else if (arguments.length == 2) {
      let ck = wpCookies.get('LP');
      if (ck) {
        ck = JSON.parse(ck);
      } else {
        ck = {};
      }
      ck[name] = value;
      wpCookies.set('LP', JSON.stringify(ck), '', '/');
    } else {
      wpCookies.set('LP', JSON.stringify(name), '', '/');
    }
  },
  remove(name) {
    const allCookies = Cookies.get();
    const reg = new RegExp(name, 'g');
    const newCookies = {};
    const useRegExp = name.match(/\*/);
    for (const i in allCookies) {
      if (useRegExp) {
        if (!i.match(reg)) {
          newCookies[i] = allCookies[i];
        }
      } else if (name != i) {
        newCookies[i] = allCookies[i];
      }
    }
    Cookies.set(newCookies);
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Cookies);

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
/*!*******************************************!*\
  !*** ./assets/src/js/frontend/courses.js ***!
  \*******************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _api__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../api */ "./assets/src/js/api.js");
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils */ "./assets/src/js/utils.js");
/* harmony import */ var _utils_cookies__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../utils/cookies */ "./assets/src/js/utils/cookies.js");
/**
 * @deprecated 4.2.5.8
 * But still support for theme has html old, override.
 * Todo: if want remove file, need to check theme override file archive, can via remove hook override file.
 */




const elListCoursesIdNewDefault = '.lp-list-courses-default';
if ('undefined' === typeof lpData || 'undefined' === typeof lpSettingCourses) {
  console.log('lpData || lpSettingCourses is undefined');
}

// Call API load courses.
// When LP v4.2.3.3 release a long time, we will remove this function on theme Eduma.
// assets/js/thim-course-filter-v2.js
window.lpArchiveRequestCourse = args => {
  window.lpCourseList.updateEventTypeBeforeFetch('filter');
  window.lpCourseList.triggerFetchAPI(args);
};

// Events
document.addEventListener('change', function (e) {
  const target = e.target;
  if (window.lpCourseList.checkIsNewListCourses()) {
    return;
  }
  window.lpCourseList.onChangeSortBy(e, target);
  window.lpCourseList.onChangeTypeLayout(e, target);
});
document.addEventListener('click', function (e) {
  const target = e.target;
  if (window.lpCourseList.checkIsNewListCourses()) {
    return;
  }
  window.lpCourseList.clickLoadMore(e, target);
  window.lpCourseList.clickNumberPage(e, target);
});
document.addEventListener('scroll', function (e) {
  const target = e.target;
  if (window.lpCourseList.checkIsNewListCourses()) {
    return;
  }
  window.lpCourseList.scrollInfinite(e, target);
});
document.addEventListener('keyup', function (e) {
  const target = e.target;
  if (window.lpCourseList.checkIsNewListCourses()) {
    return;
  }
  window.lpCourseList.searchCourse(e, target);
});
document.addEventListener('submit', function (e) {
  const target = e.target;
  if (window.lpCourseList.checkIsNewListCourses()) {
    return;
  }
  window.lpCourseList.searchCourse(e, target);
});
window.lpCourseList = (() => {
  const classArchiveCourse = 'lp-archive-courses';
  const classListCourse = 'learn-press-courses';
  const classPaginationCourse = 'learn-press-pagination';
  const classSkeletonArchiveCourse = 'lp-archive-course-skeleton';
  const classCoursesPageResult = 'courses-page-result';
  const lpArchiveLoadAjax = parseInt(lpSettingCourses.lpArchiveLoadAjax || 0);
  const lpArchiveNoLoadAjaxFirst = parseInt(lpSettingCourses.lpArchiveNoLoadAjaxFirst) === 1;
  const lpArchiveSkeletonParam = lpData.urlParams || [];
  const currentUrl = (0,_utils__WEBPACK_IMPORTED_MODULE_1__.lpGetCurrentURLNoParam)();
  let filterCourses = {};
  const typePagination = lpSettingCourses.lpArchivePaginationType || 'number';
  let typeEventBeforeFetch;
  let timeOutSearch;
  let isLoadingInfinite = false;
  const fetchAPI = (args, callBack = {}) => {
    //console.log( 'Fetch API Courses' );
    const url = (0,_utils__WEBPACK_IMPORTED_MODULE_1__.lpAddQueryArgs)(_api__WEBPACK_IMPORTED_MODULE_0__["default"].frontend.apiCourses, args);
    let paramsFetch = {};
    if (0 !== parseInt(lpData.user_id)) {
      paramsFetch = {
        headers: {
          'X-WP-Nonce': lpData.nonce
        }
      };
    }
    (0,_utils__WEBPACK_IMPORTED_MODULE_1__.lpFetchAPI)(url, paramsFetch, callBack);
  };
  return {
    init: () => {
      const urlParams = {};
      const urlQueryString = window.location.search;
      const urlSearchParams = new URLSearchParams(urlQueryString);
      for (const [key, val] of urlSearchParams.entries()) {
        urlParams[key] = val;
      }
      filterCourses = {
        ...lpArchiveSkeletonParam,
        ...urlParams
      };
      filterCourses.paged = parseInt(filterCourses.paged || 1);
      if (isNaN(filterCourses.paged)) {
        filterCourses.paged = 1;
      }
      if (lpArchiveNoLoadAjaxFirst && typePagination !== 'number') {
        filterCourses.paged = 1;
      }
      window.localStorage.setItem('lp_filter_courses', JSON.stringify(filterCourses));
    },
    updateEventTypeBeforeFetch: type => {
      typeEventBeforeFetch = type;
    },
    onChangeSortBy: (e, target) => {
      if (!target.classList.contains('courses-order-by')) {
        return;
      }
      e.preventDefault();
      const filterCourses = JSON.parse(window.localStorage.getItem('lp_filter_courses')) || {};
      filterCourses.order_by = target.value || '';
      if ('undefined' !== typeof lpSettingCourses && lpData.is_course_archive && lpSettingCourses.lpArchiveLoadAjax) {
        window.lpCourseList.triggerFetchAPI(filterCourses);
      } else {
        window.location.href = (0,_utils__WEBPACK_IMPORTED_MODULE_1__.lpAddQueryArgs)(currentUrl, filterCourses);
      }
    },
    onChangeTypeLayout: (e, target) => {
      if ('lp-switch-layout-btn' !== target.getAttribute('name')) {
        return;
      }
      const elArchive = target.closest(`.${classArchiveCourse}`);
      if (!elArchive) {
        return;
      }
      const elListCourse = elArchive.querySelector(`.${classListCourse}`);
      if (!elListCourse) {
        return;
      }
      e.preventDefault();
      const layout = target.value;
      if (layout) {
        elListCourse.dataset.layout = layout;
        _utils_cookies__WEBPACK_IMPORTED_MODULE_2__["default"].set('courses-layout', layout);
      }
    },
    clickNumberPage: (e, target) => {
      if (!lpArchiveLoadAjax || parseInt(lpSettingCourses.noLoadCoursesJs)) {
        return;
      }
      if (target.classList.contains('page-numbers')) {
        const parentArchive = target.closest(`.${classArchiveCourse}`);
        if (!parentArchive) {
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
        typeEventBeforeFetch = 'number';
        window.lpCourseList.triggerFetchAPI(filterCourses);
        return;
      }
      const parent = target.closest('.page-numbers');
      if (parent) {
        e.preventDefault();
        parent.click();
      }
    },
    clickLoadMore: (e, target) => {
      if (!target.classList.contains('courses-btn-load-more')) {
        return;
      }
      const elArchive = target.closest(`.${classArchiveCourse}`);
      if (!elArchive) {
        return;
      }
      const elListCourse = elArchive.querySelector(`.${classListCourse}`);
      if (!elListCourse) {
        return;
      }
      e.preventDefault();
      ++filterCourses.paged;
      typeEventBeforeFetch = 'load-more';
      window.lpCourseList.triggerFetchAPI(filterCourses);
    },
    scrollInfinite: (e, target) => {
      const elArchive = document.querySelector(`.${classArchiveCourse}`);
      if (!elArchive) {
        return;
      }
      const elInfinite = elArchive.querySelector('.courses-load-infinite');
      if (!elInfinite) {
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
            typeEventBeforeFetch = 'infinite';
            window.lpCourseList.triggerFetchAPI(filterCourses);

            //observer.unobserve( entry.target );
          }
        }
      });
      observer.observe(elInfinite);
    },
    triggerFetchAPI: args => {
      // For case, click on pagination, filter.
      const elArchive = document.querySelector(`.${classArchiveCourse}`);
      if (!elArchive) {
        return;
      }
      const elListCourse = elArchive.querySelector(`.${classListCourse}`);
      if (!elListCourse) {
        return;
      }
      filterCourses = args;
      let callBack;
      switch (typeEventBeforeFetch) {
        case 'load-more':
          callBack = window.lpCourseList.callBackPaginationTypeLoadMore(elArchive, elListCourse);
          break;
        case 'infinite':
          callBack = window.lpCourseList.callBackPaginationTypeInfinite(elArchive, elListCourse);
          break;
        case 'custom':
          callBack = args.customCallBack || false;
          break;
        case 'filter':
        default:
          // number
          // Change url by params filter courses
          //callBack = window.lpCourseList.callBackPaginationTypeNumber( elListCourse );
          callBack = window.lpCourseList.callBackFilter(args, elArchive, elListCourse);
          break;
      }
      if (!callBack) {
        return;
      }

      //console.log( 'Args', args );

      fetchAPI(args, callBack);
    },
    callBackFilter: (args, elArchive, elListCourse) => {
      if (!elListCourse) {
        return;
      }
      const skeleton = elListCourse.querySelector(`.${classSkeletonArchiveCourse}`);
      return {
        before: () => {
          window.history.pushState('', '', (0,_utils__WEBPACK_IMPORTED_MODULE_1__.lpAddQueryArgs)(currentUrl, args));
          window.localStorage.setItem('lp_filter_courses', JSON.stringify(args));
          if (skeleton) {
            skeleton.style.display = 'block';
          }
        },
        success: res => {
          // Remove all items before insert new items.
          const elLis = elListCourse.querySelectorAll(`:not(.${classSkeletonArchiveCourse})`);
          elLis.forEach(elLi => {
            const parent = elLi.closest(`.${classSkeletonArchiveCourse}`);
            if (parent) {
              return;
            }
            elLi.remove();
          });

          // Insert new items.
          elListCourse.insertAdjacentHTML('afterbegin', res.data.content || '');

          // Check if Pagination exists will remove.
          const elPagination = document.querySelector(`.${classPaginationCourse}`);
          if (elPagination) {
            elPagination.remove();
          }

          // Insert Pagination.
          const pagination = res.data.pagination || '';
          elListCourse.insertAdjacentHTML('afterend', pagination);

          // Set showing results page.
          const elCoursesPageResult = document.querySelector(`.${classCoursesPageResult}`);
          if (elCoursesPageResult) {
            elCoursesPageResult.innerHTML = res.data.from_to || '';
          }
        },
        error: error => {
          elListCourse.innerHTML += `<div class="lp-ajax-message error" style="display:block">${error.message || 'Error'}</div>`;
        },
        completed: () => {
          if (skeleton) {
            skeleton.style.display = 'none';
          }
          // Scroll to archive element
          const optionScroll = {
            behavior: 'smooth'
          };
          elListCourse.closest(`.${classArchiveCourse}`).scrollIntoView(optionScroll);
        }
      };
    },
    /*callBackPaginationTypeNumber: ( elListCourse ) => {
    	if ( ! elListCourse ) {
    		return;
    	}
    	const skeleton = elListCourse.querySelector( `.${ classSkeletonArchiveCourse }` );
    		return {
    		before: () => {
    			const urlPush = lpAddQueryArgs( currentUrl, args );
    			window.history.pushState( '', '', urlPush );
    			// Save filter courses to Storage
    			window.localStorage.setItem( 'lp_filter_courses', JSON.stringify( args ) );
    			if ( skeleton ) {
    				skeleton.style.display = 'block';
    			}
    		},
    		success: ( res ) => {
    			// Remove all items before insert new items.
    			const elLis = elListCourse.querySelectorAll( `:not(.${ classSkeletonArchiveCourse })` );
    			elLis.forEach( ( elLi ) => {
    				const parent = elLi.closest( `.${ classSkeletonArchiveCourse }` );
    				if ( parent ) {
    					return;
    				}
    				elLi.remove();
    			} );
    				// Insert new items.
    			elListCourse.insertAdjacentHTML( 'afterbegin', res.data.content || '' );
    				// Check if Pagination exists will remove.
    			const elPagination = document.querySelector( `.${ classPaginationCourse }` );
    			if ( elPagination ) {
    				elPagination.remove();
    			}
    				// Insert Pagination.
    			const pagination = res.data.pagination || '';
    			elListCourse.insertAdjacentHTML( 'afterend', pagination );
    		},
    		error: ( error ) => {
    			elListCourse.innerHTML += `<div class="lp-ajax-message error" style="display:block">${ error.message || 'Error' }</div>`;
    		},
    		completed: () => {
    			if ( skeleton ) {
    				skeleton.style.display = 'none';
    			}
    				// Scroll to archive element
    			const optionScroll = { behavior: 'smooth' };
    			elListCourse.closest( '.lp-archive-courses' ).scrollIntoView( optionScroll );
    		},
    	};
    },*/
    callBackPaginationTypeLoadMore: (elArchive, elListCourse) => {
      //console.log( 'callBackPaginationTypeLoadMore' );
      if (!elListCourse || !elArchive) {
        return false;
      }
      const btnLoadMore = elArchive.querySelector('.courses-btn-load-more');
      let elLoading;
      if (btnLoadMore) {
        elLoading = btnLoadMore.querySelector('.lp-loading-circle');
      }
      //const skeleton = document.querySelector( `.${ classSkeletonArchiveCourse }` );

      return {
        before: () => {
          if (btnLoadMore) {
            elLoading.classList.remove('hide');
            btnLoadMore.setAttribute('disabled', 'disabled');
          }

          /*if ( skeleton ) {
          	skeleton.style.display = 'block';
          }*/
        },
        success: res => {
          elListCourse.insertAdjacentHTML('beforeend', res.data.content || '');
          elListCourse.insertAdjacentHTML('afterend', res.data.pagination || '');

          // Set showing results page.
          const elCoursesPageResult = document.querySelector(`.${classCoursesPageResult}`);
          if (elCoursesPageResult) {
            elCoursesPageResult.innerHTML = res.data.from_to || '';
          }
        },
        error: error => {
          elListCourse.innerHTML += `<div class="lp-ajax-message error" style="display:block">${error.message || 'Error'}</div>`;
        },
        completed: () => {
          if (btnLoadMore) {
            elLoading.classList.add('hide');
            btnLoadMore.remove();
          }

          /*if ( skeleton ) {
          	skeleton.style.display = 'none';
          }*/
        }
      };
    },
    callBackPaginationTypeInfinite: (elArchive, elListCourse) => {
      //console.log( 'callBackPaginationTypeInfinite' );
      if (!elListCourse || !elListCourse) {
        return;
      }
      const elInfinite = elArchive.querySelector('.courses-load-infinite');
      if (!elInfinite) {
        return;
      }
      const loading = elInfinite.querySelector('.lp-loading-circle');
      isLoadingInfinite = true;
      elInfinite.classList.remove('courses-load-infinite');
      return {
        before: () => {
          loading.classList.remove('hide');
        },
        success: res => {
          elListCourse.insertAdjacentHTML('beforeend', res.data.content || '');
          if (res.data.pagination) {
            elListCourse.insertAdjacentHTML('afterend', res.data.pagination || '');
          }

          // Set showing results page.
          const elCoursesPageResult = document.querySelector(`.${classCoursesPageResult}`);
          if (elCoursesPageResult) {
            elCoursesPageResult.innerHTML = res.data.from_to || '';
          }
        },
        error: error => {
          elListCourse.innerHTML += `<div class="lp-ajax-message error" style="display:block">${error.message || 'Error'}</div>`;
        },
        completed: () => {
          elInfinite.remove();
          isLoadingInfinite = false;
        }
      };
    },
    searchCourse: (e, target) => {
      if ('c_search' === target.name) {
        e.preventDefault();
        const parentFormSearch = target.closest('form.search-courses');
        if (!parentFormSearch) {
          return;
        }
        const btnSearch = parentFormSearch.querySelector('button[type="submit"]');
        btnSearch.click();
        return;
      }
      if (!target.classList.contains('search-courses')) {
        return;
      }
      const formSearchCourses = target;
      e.preventDefault();
      const elArchive = formSearchCourses.closest(`.${classArchiveCourse}`);
      if (!elArchive) {
        return;
      }
      const elListCourse = elArchive.querySelector(`.${classListCourse}`);
      if (!elListCourse) {
        return;
      }
      const elInputSearch = formSearchCourses.querySelector('input[name=c_search]');
      const keyword = elInputSearch.value;
      if (!keyword || keyword && keyword.length > 2) {
        if (undefined !== timeOutSearch) {
          clearTimeout(timeOutSearch);
        }
        timeOutSearch = setTimeout(function () {
          typeEventBeforeFetch = 'filter';
          filterCourses.c_search = keyword;
          filterCourses.paged = 1;
          window.lpCourseList.triggerFetchAPI(filterCourses);
        }, 800);
      }
    },
    ajaxEnableLoadPage: () => {
      // For case enable AJAX when load page.
      let countTime = 0;
      if (!lpArchiveNoLoadAjaxFirst) {
        let detectedElArchive;
        const callBack = {
          success: res => {
            detectedElArchive = setInterval(function () {
              const skeleton = document.querySelector(`.${classSkeletonArchiveCourse}`);
              const elArchive = document.querySelector(`.${classArchiveCourse}`);
              let elListCourse;
              if (elArchive) {
                elListCourse = elArchive.querySelector(`.${classListCourse}`);
              }
              ++countTime;
              if (countTime > 5000) {
                clearInterval(detectedElArchive);
              }
              if (elListCourse && skeleton) {
                clearInterval(detectedElArchive);
                elListCourse.insertAdjacentHTML('afterbegin', res.data.content || '');
                skeleton.style.display = 'none';
                const pagination = res.data.pagination || '';
                elListCourse.insertAdjacentHTML('afterend', pagination);

                // Set showing results page.
                const elCoursesPageResult = document.querySelector(`.${classCoursesPageResult}`);
                if (elCoursesPageResult) {
                  elCoursesPageResult.innerHTML = res.data.from_to || '';
                }
              }
            }, 1);
          }
        };
        if ('number' !== typePagination) {
          filterCourses.paged = 1;
        }
        fetchAPI(filterCourses, callBack);
      }
    },
    getFilterParams: () => {
      return filterCourses;
    },
    // Check has exists new list courses.
    checkIsNewListCourses: () => {
      const elListCoursesNew = document.querySelector(elListCoursesIdNewDefault);
      return !!elListCoursesNew;
    }
  };
})();
document.addEventListener('DOMContentLoaded', function () {
  if (window.lpCourseList.checkIsNewListCourses()) {
    return;
  }
  window.lpCourseList.init();
  window.lpCourseList.ajaxEnableLoadPage();
});
/******/ })()
;
//# sourceMappingURL=courses.js.map