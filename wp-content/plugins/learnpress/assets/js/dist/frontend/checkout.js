/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

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
/*!********************************************!*\
  !*** ./assets/src/js/frontend/checkout.js ***!
  \********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utils_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils.js */ "./assets/src/js/utils.js");
/**
 * File JS handling checkout page.
 */



// Events
document.addEventListener('submit', e => {
  window.lpCheckout.submit(e);
});
document.addEventListener('change', e => {
  window.lpCheckout.paymentSelect(e);
});
document.addEventListener('keyup', e => {
  window.lpCheckout.checkEmailGuest(e);
});
window.lpCheckout = {
  idFormCheckout: 'learn-press-checkout-form',
  idBtnPlaceOrder: 'learn-press-checkout-place-order',
  classPaymentMethod: 'lp-payment-method',
  classPaymentMethodForm: 'payment-method-form',
  timeOutCheckEmail: null,
  fetchAPI: (url, params, callBack) => {
    const option = {
      headers: {}
    };
    if (0 !== parseInt(lpData.user_id)) {
      option.headers['X-WP-Nonce'] = lpData.nonce;
    }
    const searchParams = new URLSearchParams();
    Object.keys(params).forEach(key => {
      searchParams.append(key, params[key]);
    });
    option.method = 'POST';
    option.body = searchParams;
    fetch(url, option).then(res => res.text()).then(data => {
      data = (0,_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpAjaxParseJsonOld)(data);
      callBack.success(data);
    }).finally(() => {
      callBack.completed();
    }).catch(err => callBack.error(err));
  },
  submit: e => {
    const formCheckout = e.target;
    if (formCheckout.id !== window.lpCheckout.idFormCheckout) {
      return;
    }
    if (formCheckout.classList.contains('processing')) {
      return;
    }
    e.preventDefault();
    formCheckout.classList.add('processing');
    const btnSubmit = formCheckout.querySelector('button[type="submit"]');
    btnSubmit.disabled = true;
    window.lpCheckout.removeMessage();
    const elBtnPlaceOrder = document.getElementById(window.lpCheckout.idBtnPlaceOrder);
    const urlHandle = new URL(lpCheckoutSettings.ajaxurl);
    urlHandle.searchParams.set('lp-ajax', 'checkout');

    // get values from FormData
    const formData = new FormData(formCheckout);
    const dataSend = Object.fromEntries(Array.from(formData.keys(), key => {
      const val = formData.getAll(key);
      return [key, val.length > 1 ? val : val.pop()];
    }));
    elBtnPlaceOrder.classList.add('loading');
    const callBack = {
      success: response => {
        response = (0,_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpAjaxParseJsonOld)(response);
        const {
          messages,
          result
        } = response;
        if ('success' !== result) {
          window.lpCheckout.showErrors(formCheckout, 'error', messages);
        } else {
          window.location.href = response.redirect;
        }
      },
      error: error => {
        window.lpCheckout.showErrors(formCheckout, 'error', error);
      },
      completed: () => {
        elBtnPlaceOrder.classList.remove('loading');
        formCheckout.classList.remove('processing');
        btnSubmit.disabled = false;
      }
    };
    window.lpCheckout.fetchAPI(urlHandle, dataSend, callBack);
  },
  paymentSelect: e => {
    const target = e.target;
    const elPaymentMethod = target.closest(`.${window.lpCheckout.classPaymentMethod}`);
    if (!elPaymentMethod) {
      return;
    }
    const elUlPaymentMethods = elPaymentMethod.closest('.payment-methods');
    if (!elUlPaymentMethods) {
      return;
    }
    const elPaymentMethods = elUlPaymentMethods.querySelectorAll(`.${window.lpCheckout.classPaymentMethod}`);
    elPaymentMethods.forEach(el => {
      const elPaymentMethodForm = el.querySelector(`.${window.lpCheckout.classPaymentMethodForm}`);
      if (!elPaymentMethodForm) {
        return;
      }
      if (elPaymentMethod !== el) {
        elPaymentMethodForm.style.display = 'none';
      } else {
        elPaymentMethodForm.style.display = 'block';
      }
    });
  },
  checkEmailGuest: e => {
    const target = e.target;
    if (target.id !== 'guest_email') {
      return;
    }
    if (!window.lpCheckout.isEmail(target.value)) {
      return;
    }
    target.classList.add('loading');
    if (window.lpCheckout.timeOutCheckEmail !== null) {
      clearTimeout(window.lpCheckout.timeOutCheckEmail);
    }
    window.lpCheckout.timeOutCheckEmail = setTimeout(() => {
      const callBack = {
        success: response => {
          const {
            message,
            data,
            status
          } = response;
          if ('success' === status) {
            const content = data.content || '';
            const elGuestOutput = document.querySelector('.lp-guest-checkout-output');
            if (elGuestOutput) {
              elGuestOutput.remove();
            }
            target.insertAdjacentHTML('afterend', content);
          } else {
            window.lpCheckout.showErrors(target.closest('form'), status, message);
          }
        },
        error: error => {
          window.lpCheckout.showErrors(target.closest('form'), 'error', error);
        },
        completed: () => {
          target.classList.remove('loading');
        }
      };
      window.lpCheckout.fetchAPI(window.location.href, {
        'lp-ajax': 'checkout-user-email-exists',
        email: target.value
      }, callBack);
    }, 500);
  },
  removeMessage: () => {
    const lpMessage = document.querySelector('.learn-press-message');
    if (!lpMessage) {
      return;
    }
    lpMessage.remove();
  },
  showErrors: (form, status, message) => {
    const mesHtml = `<div class="learn-press-message ${status}">${message}</div>`;
    form.insertAdjacentHTML('afterbegin', mesHtml);
    form.scrollIntoView();
  },
  isEmail: email => {
    return new RegExp('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+@[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$').test(email);
  }
};
/******/ })()
;
//# sourceMappingURL=checkout.js.map