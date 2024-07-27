/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/admin/order/export_invoice.js":
/*!*****************************************************!*\
  !*** ./assets/src/js/admin/order/export_invoice.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ export_invoice)
/* harmony export */ });
/**
 * Export invoice to PDF
 */
function export_invoice() {
  let html2pdf_obj, modal;
  document.addEventListener('click', e => {
    const target = e.target;
    if (target.id === 'lp-invoice__export') {
      html2pdf_obj.save();
    } else if (target.id === 'lp-invoice__update') {
      const elOption = document.querySelector('.export-options__content');
      const fields = elOption.querySelectorAll('input');
      const fieldNameUnChecked = [];
      fields.forEach(field => {
        if (!field.checked) {
          fieldNameUnChecked.push(field.name);
        }
      });
      window.localStorage.setItem('lp_invoice_un_fields', JSON.stringify(fieldNameUnChecked));
      window.localStorage.setItem('lp_invoice_show', 1);
      window.location.reload();
    }
  });
  const exportPDF = () => {
    const pdfOptions = {
      margin: [0, 0, 0, 5],
      filename: document.title,
      image: {
        type: 'webp'
      },
      html2canvas: {
        scale: 2.5
      },
      jsPDF: {
        format: 'a4',
        orientation: 'p'
      }
    };
    const html = document.querySelector('#lp-invoice__content');
    html2pdf_obj = html2pdf().set(pdfOptions).from(html);
  };
  const showInfoFields = () => {
    // Get fields name checked
    const fieldsChecked = window.localStorage.getItem('lp_invoice_un_fields');
    const elOptions = document.querySelector('.export-options__content');
    const elInvoiceFields = document.querySelectorAll('.invoice-field');
    elInvoiceFields.forEach(field => {
      const nameClass = field.classList[1];
      if (fieldsChecked && fieldsChecked.includes(nameClass)) {
        field.remove();
        const elOption = elOptions.querySelector(`[name=${nameClass}]`);
        if (elOption) {
          elOption.checked = false;
        }
      }
    });
    const showInvoice = parseInt(window.localStorage.getItem('lp_invoice_show'));
    if (showInvoice === 1) {
      modal.style.display = 'block';
    }
  };
  document.addEventListener('DOMContentLoaded', () => {
    const elExportSection = document.querySelector('#order-export__section');
    if (!elExportSection.length) {
      const tabs = document.querySelectorAll('.tabs');
      const tab = document.querySelectorAll('.tab');
      const panel = document.querySelectorAll('.panel');
      function onTabClick(event) {
        // deactivate existing active tabs and panel

        for (let i = 0; i < tab.length; i++) {
          tab[i].classList.remove('active');
        }
        for (let i = 0; i < panel.length; i++) {
          panel[i].classList.remove('active');
        }

        // activate new tabs and panel
        event.target.classList.add('active');
        const classString = event.target.getAttribute('data-target');
        document.getElementById('panels').getElementsByClassName(classString)[0].classList.add('active');
      }
      for (let i = 0; i < tab.length; i++) {
        tab[i].addEventListener('click', onTabClick, false);
      }

      // Get the modal
      modal = document.getElementById('myModal');
      // Get the button that opens the modal
      const btn = document.getElementById('order-export__button');
      // Get the <span> element that closes the modal
      const span = document.getElementsByClassName('close')[0];
      // When the user clicks on the button, open the modal
      btn.onclick = function () {
        modal.style.display = 'block';
      };

      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
        modal.style.display = 'none';
        window.localStorage.setItem('lp_invoice_show', 0);
      };

      // When the user clicks anywhere outside the modal, close it
      window.onclick = function (event) {
        if (event.target === modal) {
          modal.style.display = 'none';
          window.localStorage.setItem('lp_invoice_show', 0);
        }
      };
      showInfoFields();
      exportPDF();
    }
  });
}

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
  !*** ./assets/src/js/admin/admin-order.js ***!
  \********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _order_export_invoice__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./order/export_invoice */ "./assets/src/js/admin/order/export_invoice.js");

(0,_order_export_invoice__WEBPACK_IMPORTED_MODULE_0__["default"])();
/******/ })()
;
//# sourceMappingURL=admin-order.js.map