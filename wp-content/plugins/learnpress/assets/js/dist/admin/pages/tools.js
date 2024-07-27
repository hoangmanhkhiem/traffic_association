/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/admin/pages/tools/database/clean_database.js":
/*!*************************************************************************!*\
  !*** ./assets/src/apps/js/admin/pages/tools/database/clean_database.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");
/* harmony import */ var _utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../utils/handle-ajax-api */ "./assets/src/apps/js/utils/handle-ajax-api.js");


const cleanDatabases = () => {
  const elCleanDatabases = document.querySelector('#lp-tool-clean-database');
  if (!elCleanDatabases) {
    return;
  }
  const elBtnCleanDatabases = elCleanDatabases.querySelector('.lp-btn-clean-db');
  elBtnCleanDatabases.addEventListener('click', function (e) {
    e.preventDefault();
    const elToolsSelect = document.querySelector('#tools-select__id');
    const ElToolSelectLi = elToolsSelect.querySelectorAll('ul li input');
    const checkedOne = Array.prototype.slice.call(ElToolSelectLi).some(x => x.checked);
    const prepareMessage = elCleanDatabases.querySelector('.tools-prepare__message');
    if (checkedOne == false) {
      prepareMessage.style.display = 'block';
      prepareMessage.textContent = 'You must choose at least one table to take this action';
      return;
    }
    prepareMessage.style.display = 'none';
    const elLoading = elCleanDatabases.querySelector('.wrapper-lp-loading');
    if (!_utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].init()) {
      return;
    }
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal(elLoading.innerHTML);
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(elCleanDatabases.querySelector('h2').textContent);
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes[0].style.display = 'inline-block';
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes[0].textContent = 'Run';
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo[0].textContent = 'Close';
    const listTables = new Array();
    const ElToolSelectLiCheked = elToolsSelect.querySelectorAll('ul li input:checked');
    ElToolSelectLiCheked.forEach(e => {
      listTables.push(e.value);
    });
    const tables = listTables[0];
    const item = elLoading.querySelector('.progressbar__item');
    const itemtotal = item.getAttribute('data-total');
    const modal = document.querySelector('.lp-modal-body .main-content');
    const notice = modal.querySelector('.lp-tool__message');
    if (itemtotal <= 0) {
      _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes[0].style.display = 'none';
      notice.textContent = 'There is no data that need to be repaired in the chosen tables';
      notice.style.display = 'block';
      return;
    }
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = () => {
      // warn user before doing
      const r = confirm('The modified data is impossible to be restored. Please backup your website before doing this.');
      if (r == false) {
        return;
      }
      const modal = document.querySelector('.lp-modal-body .main-content');
      const notice = modal.querySelector('.lp-tool__message');
      notice.textContent = 'This action is in processing. Don\'t close this page';
      notice.style.display = 'block';
      const url = '/lp/v1/admin/tools/clean-tables';
      const params = {
        tables,
        itemtotal
      };
      _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo[0].style.display = 'none';
      _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes[0].style.display = 'none';
      const functions = {
        success: res => {
          const {
            status,
            message,
            data: {
              processed,
              percent
            }
          } = res;
          const modalItem = modal.querySelector('.progressbar__item');
          const progressBarRows = modalItem.querySelector('.progressbar__rows');
          const progressPercent = modalItem.querySelector('.progressbar__percent');
          const progressValue = modalItem.querySelector('.progressbar__value');
          console.log(status);
          if ('success' === status) {
            setTimeout(() => {
              (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(url, params, functions);
            }, 2000);
            // update processed quantity
            progressBarRows.textContent = processed + ' / ' + itemtotal;
            // update percent
            progressPercent.textContent = '( ' + percent + '%' + ' )';
            // update percent width
            progressValue.style.width = percent + '%';
          } else if ('finished' === status) {
            // Re-update indexs
            progressBarRows.textContent = itemtotal + ' / ' + itemtotal;
            progressPercent.textContent = '( 100% )';
            // Update complete nofication
            const modal = document.querySelector('.lp-modal-body .main-content');
            const notice = modal.querySelector('.lp-tool__message');
            notice.textContent = 'Process has been completed. Press click the finish button to close this popup';
            notice.style.color = 'white';
            notice.style.background = 'green';
            progressValue.style.width = '100%';
            // Show finish button
            _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo[0].style.display = 'inline-block';
            _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo[0].textContent = 'Finish';
            _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo[0].addEventListener('click', function () {
              location.reload();
            });
          } else {
            console.log(message);
          }
        },
        error: err => {
          console.log(err);
        },
        completed: () => {}
      };
      (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(url, params, functions);
    };
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (cleanDatabases);

/***/ }),

/***/ "./assets/src/apps/js/admin/pages/tools/database/create_indexs.js":
/*!************************************************************************!*\
  !*** ./assets/src/apps/js/admin/pages/tools/database/create_indexs.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");
/* harmony import */ var _utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../utils/handle-ajax-api */ "./assets/src/apps/js/utils/handle-ajax-api.js");


const createIndexes = () => {
  const elCreateIndexTables = document.querySelector('#lp-tool-create-indexes-tables');
  if (!elCreateIndexTables) {
    return;
  }
  const elBtnCreateIndexes = elCreateIndexTables.querySelector('.lp-btn-create-indexes');
  elBtnCreateIndexes.addEventListener('click', e => {
    e.preventDefault();
    const elLoading = elCreateIndexTables.querySelector('.wrapper-lp-loading');
    if (!_utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].init()) {
      return;
    }
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal(elLoading.innerHTML);
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(elCreateIndexTables.querySelector('h2').textContent);
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes[0].style.display = 'inline-block';
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes[0].textContent = 'Run';
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo[0].textContent = 'Close';
    const url = '/lp/v1/admin/tools/list-tables-indexs';
    const params = {};
    const functions = {
      success: res => {
        const {
          status,
          message,
          data: {
            tables,
            table
          }
        } = res;
        const elSteps = document.querySelector('.example-lp-group-step');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal(elSteps.innerHTML);
        const elGroupStep = _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay[0].querySelector('.lp-group-step ');

        // Show progress when upgrading.
        const showProgress = (stepCurrent, percent) => {
          const elItemStepCurrent = elGroupStep.querySelector('input[value=' + stepCurrent + ']').closest('.lp-item-step');
          elItemStepCurrent.classList.add('running');
          if (100 === percent) {
            elItemStepCurrent.classList.remove('running');
            elItemStepCurrent.classList.add('completed');
          }
          const progressBar = elItemStepCurrent.querySelector('.progress-bar');
          progressBar.style.width = percent;
        };

        // Scroll to step current.
        const scrollToStepCurrent = stepCurrent => {
          const elItemStepCurrent = elGroupStep.querySelector('input[value=' + stepCurrent + ']').closest('.lp-item-step');
          const offset = elItemStepCurrent.offsetTop - _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elMainContent[0].offsetTop + _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elMainContent[0].scrollTop;
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elMainContent.stop().animate({
            scrollTop: offset
          }, 600);
        };
        for (const table in tables) {
          const elItemStep = _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay[0].querySelector('.lp-item-step').cloneNode(true);
          const input = elItemStep.querySelector('input');
          const label = elItemStep.querySelector('label');
          label.textContent = `Table: ${table}`;
          input.value = table;
          elGroupStep.append(elItemStep);
        }
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = () => {
          const url = '/lp/v1/admin/tools/create-indexs';
          const params = {
            tables,
            table
          };
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo[0].style.display = 'none';
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes[0].style.display = 'none';
          showProgress(table, 0.1);
          const functions = {
            success: res => {
              const {
                status,
                message,
                data: {
                  table,
                  percent
                }
              } = res;
              showProgress(params.table, percent);
              if (undefined !== table) {
                if (params.table !== table) {
                  showProgress(table, 0.1);
                  scrollToStepCurrent(table);
                }
                params.table = table;
              }
              if ('success' === status) {
                setTimeout(() => {
                  (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(url, params, functions);
                }, 2000);
              } else if ('finished' === status) {
                console.log('finished');
                _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo[0].style.display = 'inline-block';
                _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo[0].textContent = 'Finish';
              } else {
                console.log(message);
              }
            },
            error: err => {
              console.log(err);
            },
            completed: () => {}
          };
          (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(url, params, functions);
        };
      },
      error: err => {},
      completed: () => {}
    };
    (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(url, params, functions);
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (createIndexes);

/***/ }),

/***/ "./assets/src/apps/js/admin/pages/tools/database/re-upgrade-db.js":
/*!************************************************************************!*\
  !*** ./assets/src/apps/js/admin/pages/tools/database/re-upgrade-db.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");
/* harmony import */ var _utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../utils/handle-ajax-api */ "./assets/src/apps/js/utils/handle-ajax-api.js");


const reUpgradeDB = () => {
  const elToolReUpgradeDB = document.querySelector('#lp-tool-re-upgrade-db');
  if (!elToolReUpgradeDB) {
    return;
  }

  // Check valid to show popup re-upgrade
  let url = 'lp/v1/database/check-db-valid-re-upgrade';
  (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(url, {}, {
    success(res) {
      const {
        data: {
          can_re_upgrade
        }
      } = res;
      if (!can_re_upgrade) {
        return;
      }
      elToolReUpgradeDB.style.display = 'block';
      const elBtnReUpradeDB = elToolReUpgradeDB.querySelector('.lp-btn-re-upgrade-db');
      const elMessage = elToolReUpgradeDB.querySelector('.learn-press-message');
      elBtnReUpradeDB.addEventListener('click', () => {
        // eslint-disable-next-line no-alert
        if (confirm('Are you want to Re Upgrade!')) {
          url = 'lp/v1/database/del-tb-lp-upgrade-db';
          (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(url, {}, {
            success(res) {
              const {
                status,
                message,
                data: {
                  url
                }
              } = res;
              if ('success' === status && undefined !== url) {
                window.location.href = url;
              }
            },
            error(err) {
              elMessage.classList.add('error');
              elMessage.textContent = err.message;
              elMessage.style.display = 'block';
            }
          });
        }
      });
    },
    error(err) {}
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (reUpgradeDB);

/***/ }),

/***/ "./assets/src/apps/js/admin/pages/tools/database/upgrade.js":
/*!******************************************************************!*\
  !*** ./assets/src/apps/js/admin/pages/tools/database/upgrade.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");
/* harmony import */ var _utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../utils/handle-ajax-api */ "./assets/src/apps/js/utils/handle-ajax-api.js");


const $ = jQuery;
const elToolUpgradeDB = $('#lp-tool-upgrade-db');
const upgradeDB = () => {
  let isUpgrading = 0;
  const elWrapperTermsUpgrade = elToolUpgradeDB.find('.wrapper-terms-upgrade');
  const elStatusUpgrade = elToolUpgradeDB.find('.wrapper-lp-status-upgrade');
  const elWrapperUpgradeMessage = elToolUpgradeDB.find('.wrapper-lp-upgrade-message');
  let checkValidBeforeUpgrade = null;
  const elMessageUpgrading = $('input[name=message-when-upgrading]').val();
  if (elWrapperTermsUpgrade.length) {
    // Show Terms Upgrade.
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal(elWrapperTermsUpgrade.html());
    const elTermUpdate = _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.find('.terms-upgrade');
    const elLPAgreeTerm = elTermUpdate.find('input[name=lp-agree-term]');
    const elTermMessage = elTermUpdate.find('.error');
    checkValidBeforeUpgrade = function () {
      elTermMessage.hide();
      elTermMessage.removeClass('learn-press-message');
      if (elLPAgreeTerm.is(':checked')) {
        (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])('/lp/v1/database/agree_terms', {
          agree_terms: 1
        }, {});
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elFooter.find('.learn-press-notice').remove();
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal(elStatusUpgrade.html());
        return true;
      }
      elTermMessage.show();
      elTermMessage.addClass('learn-press-message');
      _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elMainContent.animate({
        scrollTop: elTermMessage.offset().top
      });
      return false;
    };
  } else {
    // Show Steps Upgrade.
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal(elStatusUpgrade.html());
    checkValidBeforeUpgrade = function () {
      return true;
    };
  }
  _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(elToolUpgradeDB.find('h2').html());
  _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes.text('Upgrade');
  _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes.show();
  _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo.text('Cancel');
  _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = function (e) {
    if (!checkValidBeforeUpgrade()) {
      return;
    }
    const target = e.target;
    // Show message note when upgrading.
    if (target.innerText === 'Upgrade') {
      _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elFooter.prepend('<span class="learn-press-notice">' + elMessageUpgrading + '</span>');
    }
    isUpgrading = 1;
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes.hide();
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo.hide();
    const urlHandle = '/lp/v1/database/upgrade';
    const elGroupStep = _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.find('.lp-group-step');
    const elItemSteps = elToolUpgradeDB.find('.lp-item-step');

    // Get params.
    const steps = [];
    $.each(elItemSteps, function (i, el) {
      const elItemStepsTmp = $(el);
      if (!elItemStepsTmp.hasClass('completed')) {
        const step = elItemStepsTmp.find('input').val();
        steps.push(step);
      }
    });
    const params = {
      steps,
      step: steps[0]
    };
    let elItemStepCurrent = null;

    // Show progress when upgrading.
    const showProgress = (stepCurrent, percent) => {
      elItemStepCurrent = elGroupStep.find('input[value=' + stepCurrent + ']').closest('.lp-item-step');
      elItemStepCurrent.addClass('running');
      if (100 === percent) {
        elItemStepCurrent.removeClass('running').addClass('completed');
      }
      elItemStepCurrent.find('.progress-bar').css('width', percent + '%');
      elItemStepCurrent.find('.percent').text(percent + '%');
    };

    // Scroll to step current.
    const scrollToStepCurrent = stepCurrent => {
      elItemStepCurrent = elGroupStep.find('input[value=' + stepCurrent + ']').closest('.lp-item-step');
      if (!elItemStepCurrent.length) {
        return;
      }
      const offset = elItemStepCurrent.offset().top - _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elMainContent.offset().top + _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elMainContent.scrollTop();
      _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elMainContent.stop().animate({
        scrollTop: offset
      }, 600);
    };
    showProgress(steps[0], 0.1);
    const funcCallBack = {
      success: res => {
        showProgress(params.step, res.percent);
        if (params.step !== res.name) {
          showProgress(res.name, 0.1);
        }
        scrollToStepCurrent(params.step);
        if ('success' === res.status) {
          params.step = res.name;
          params.data = res.data;
          setTimeout(() => {
            (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(urlHandle, params, funcCallBack);
          }, 800);
        } else if ('finished' === res.status) {
          isUpgrading = 0;
          elItemStepCurrent.removeClass('running').addClass('completed');
          setTimeout(() => {
            _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal(elWrapperUpgradeMessage.html());
          }, 1000);
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elFooter.find('.learn-press-notice').remove();
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo.text('Close');
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo.show();
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo.on('click', () => {
            window.location.reload();
          });
        } else {
          isUpgrading = 0;
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elFooter.find('.learn-press-notice').remove();
          elItemStepCurrent.removeClass('running').addClass('error');
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal(elWrapperUpgradeMessage.html(), function () {
            _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes.text('Retry').show();
            _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = () => {
              window.location.href = lpGlobalSettings.siteurl + '/wp-admin/admin.php?page=learn-press-tools&tab=database&action=upgrade-db';
            };
            _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo.show();
            if (!res.message) {
              res.message = 'Upgrade not success! Please clear cache, restart sever then retry or contact to LP to help';
            }
            _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elMainContent.find('.learn-press-message').addClass('error').html(res.message);
          });
        }
      },
      error: err => {
        isUpgrading = 0;
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal(elWrapperUpgradeMessage.html(), function () {
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnYes.text('Retry').show();
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = () => {
            window.location.location = 'wp-admin/admin.php?page=learn-press-tools&tab=database&action=upgrade-db';
          };
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elBtnNo.show();
          if (!err.message) {
            err.message = 'Upgrade not success! Something wrong. Please clear cache, restart sever then retry or contact to LP to help';
          }
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elMainContent.find('.learn-press-message').addClass('error').html(err.message);
        });
      },
      completed: () => {}
    };
    (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(urlHandle, params, funcCallBack);
  };

  // Show confirm if, within upgrading, the user reload the page.
  window.onbeforeunload = function () {
    if (isUpgrading) {
      return 'LP is upgrading Database. Are you want to reload page?';
    }
  };

  // Show confirm if, within upgrading, the user close the page.
  window.onclose = function () {
    if (isUpgrading) {
      return 'LP is upgrading Database. Are you want to close page?';
    }
  };
};
const getStepsUpgradeStatus = () => {
  if (!elToolUpgradeDB.length) {
    return;
  }

  // initial LP Modal Overlay
  if (!_utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].init()) {
    return;
  }
  const elWrapperStatusUpgrade = $('.wrapper-lp-status-upgrade');
  const urlHandle = '/lp/v1/database/get_steps';

  // Show dialog upgrade database.
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const action = urlParams.get('action');
  if ('upgrade-db' === action) {
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(elToolUpgradeDB.find('h2').html());
    _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal($('.wrapper-lp-loading').html());
  }
  const funcCallBack = {
    success: res => {
      const {
        steps_completed,
        steps_default
      } = res;
      if (undefined === steps_completed || undefined === steps_default) {
        console.log('invalid steps_completed and steps_default');
        return false;
      }

      // Render show Steps.
      let htmlStep = '';
      for (const k_gr_steps in steps_default) {
        const step_group = steps_default[k_gr_steps];
        const steps = step_group.steps;
        htmlStep = '<div class="lp-group-step">';
        htmlStep += '<h3>' + step_group.label + '</h3>';
        for (const k_step in steps) {
          const step = steps[k_step];
          let completed = '';
          if (undefined !== steps_completed[k_step]) {
            completed = 'completed';
          }
          htmlStep += '<div class="lp-item-step ' + completed + '">';
          htmlStep += '<div class="lp-item-step-left"><input type="hidden" name="lp_steps_upgrade_db[]" value="' + step.name + '"  /></div>';
          htmlStep += '<div class="lp-item-step-right">';
          htmlStep += '<label for=""><strong></strong>' + step.label + '</label>';
          htmlStep += '<div class="description">' + step.description + '</div>';
          htmlStep += '<div class="percent"></div>';
          htmlStep += '<span class="progress-bar"></span>';
          htmlStep += '</div>';
          htmlStep += '</div>';
        }
        htmlStep += '</div>';
        elWrapperStatusUpgrade.append(htmlStep);
        const elBtnUpgradeDB = $('.lp-btn-upgrade-db');
        if ('upgrade-db' === action) {
          upgradeDB();
        }
        elBtnUpgradeDB.on('click', function () {
          _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
          upgradeDB();
        });
      }
    },
    error: err => {},
    completed: () => {}
  };
  (0,_utils_handle_ajax_api__WEBPACK_IMPORTED_MODULE_1__["default"])(urlHandle, {}, funcCallBack);
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (getStepsUpgradeStatus);

/***/ }),

/***/ "./assets/src/apps/js/admin/pages/tools/reset-data/course.js":
/*!*******************************************************************!*\
  !*** ./assets/src/apps/js/admin/pages/tools/reset-data/course.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

/**
 * Reset course progress.
 *
 * @since 4.0.5.
 * @author Nhamdv - Code choi choi in Physcode.
 */
const {
  __
} = wp.i18n;
const {
  TextControl,
  Button,
  Spinner,
  CheckboxControl,
  Notice
} = wp.components;
const {
  useState,
  useEffect
} = wp.element;
const {
  addQueryArgs
} = wp.url;
const ResetCourse = () => {
  const [loading, setLoading] = useState(false);
  const [search, setSearch] = useState('');
  const [data, setData] = useState([]);
  const [checkData, setCheckData] = useState([]);
  const [message, setMessage] = useState([]);
  const [loadingReset, setLoadingReset] = useState(false);
  useEffect(() => {
    responsiveData(search);
  }, [search]);
  const responsiveData = async s => {
    try {
      if (!s || loading) {
        setMessage([]);
        setData([]);
        return;
      }
      if (s.length < 3) {
        setMessage([{
          status: 'error',
          message: 'Please enter at least 3 characters to searching course.'
        }]);
        setData([]);
        return;
      }
      setLoading(true);
      const response = await wp.apiFetch({
        path: addQueryArgs('lp/v1/admin/tools/reset-data/search-courses', {
          s
        }),
        method: 'GET'
      });
      const {
        status,
        data
      } = response;
      setLoading(false);
      if (status === 'success') {
        setData(data);
        setMessage([]);
      } else {
        setMessage([{
          status: 'error',
          message: response.message || 'LearnPress: Search Course Fail!'
        }]);
        setData([]);
      }
    } catch (error) {
      console.log(error.message);
    }
  };
  function checkItems(id) {
    const datas = [...checkData];
    if (datas.includes(id)) {
      const index = datas.indexOf(id);
      if (index > -1) {
        datas.splice(index, 1);
      }
    } else {
      datas.push(id);
    }
    setCheckData(datas);
  }
  const resetCourse = async () => {
    if (checkData.length === 0) {
      setMessage([{
        status: 'error',
        message: 'Please chooce Course for reset data!'
      }]);
      return;
    }

    // eslint-disable-next-line no-alert
    if (!confirm('Are you sure to reset course progress of all users enrolled this course?')) {
      return;
    }
    const notice = [];
    try {
      setLoadingReset(true);
      for (const courseId of checkData) {
        const response = await wp.apiFetch({
          path: addQueryArgs('lp/v1/admin/tools/reset-data/reset-courses', {
            courseId
          }),
          method: 'GET'
        });
        const {
          status,
          data,
          message
        } = response;
        notice.push({
          status,
          message: message || `Course #${courseId} reset successfully!`
        });
      }
      setLoadingReset(false);
    } catch (error) {
      notice.push({
        status: 'error',
        message: error.message || `LearnPress Error: Reset Course Data.`
      });
    }
    setMessage(notice);
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", null, __('Reset Course Progress', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "description"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, __('This action will reset course progress of all users who have enrolled.', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, __('Search results only show if courses have user data.', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(TextControl, {
    placeholder: __('Search course by name', 'learnpress'),
    value: search,
    onChange: value => setSearch(value),
    style: {
      width: 300
    }
  }))), loading && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Spinner, null), data.length > 0 && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "lp-reset-course_progress",
    style: {
      border: '1px solid #eee'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      background: '#eee'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(CheckboxControl, {
    checked: checkData.length === data.length,
    onChange: () => {
      if (checkData.length === data.length) {
        setCheckData([]);
      } else {
        setCheckData(data.map(dt => dt.id));
      }
    },
    style: {
      margin: 0
    }
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, __('ID', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, __('Name', 'learnpress')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, __('Students', 'learnpress')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      height: '100%',
      maxHeight: 200,
      overflow: 'auto'
    }
  }, data.map(dt => {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        borderTop: '1px solid #eee'
      },
      key: dt.id
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(CheckboxControl, {
      checked: checkData.includes(dt.id),
      onChange: () => checkItems(dt.id)
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, "#", dt.id), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, dt.title), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, dt.students));
  }))), loadingReset ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Spinner, null) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Button, {
    isPrimary: true,
    onClick: () => resetCourse(),
    style: {
      marginTop: 10,
      height: 30
    }
  }, __('Reset now', 'learnpress'))), message.length > 0 && message.map((mess, index) => {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Notice, {
      status: mess.status,
      key: index,
      isDismissible: false
    }, mess.message);
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("style", null, '\
				.lp-reset-course_progress .components-base-control__field {\
					margin: 0;\
				}\
				.components-notice{\
					margin-left: 0;\
				}\
				.lp-reset-course_progress > div > div{\
					display: grid;\
					grid-template-columns: 80px 50px 1fr 80px;\
					align-items: center;\
				}\
				.lp-reset-course_progress > div > div > div{\
					maegin: 0;\
					padding: 8px 10px;\
				}\
				'));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ResetCourse);

/***/ }),

/***/ "./assets/src/apps/js/admin/pages/tools/reset-data/index.js":
/*!******************************************************************!*\
  !*** ./assets/src/apps/js/admin/pages/tools/reset-data/index.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _course__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./course */ "./assets/src/apps/js/admin/pages/tools/reset-data/course.js");


const resetData = () => {
  if (document.querySelectorAll('#learn-press-reset-course-users').length > 0) {
    wp.element.render((0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_course__WEBPACK_IMPORTED_MODULE_1__["default"], null), [...document.querySelectorAll('#learn-press-reset-course-users')][0]);
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (resetData);

/***/ }),

/***/ "./assets/src/apps/js/utils/handle-ajax-api.js":
/*!*****************************************************!*\
  !*** ./assets/src/apps/js/utils/handle-ajax-api.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const handleAjax = function (url, params, functions) {
  wp.apiFetch({
    path: url,
    method: 'POST',
    data: params
  }).then(res => {
    if ('function' === typeof functions.success) {
      functions.success(res);
    }
  }).catch(err => {
    if ('function' === typeof functions.error) {
      functions.error(err);
    }
  }).then(() => {
    if ('function' === typeof functions.completed) {
      functions.completed();
    }
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (handleAjax);

/***/ }),

/***/ "./assets/src/apps/js/utils/lp-modal-overlay.js":
/*!******************************************************!*\
  !*** ./assets/src/apps/js/utils/lp-modal-overlay.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const $ = jQuery;
let elLPOverlay = null;
const lpModalOverlay = {
  elLPOverlay: null,
  elMainContent: null,
  elTitle: null,
  elBtnYes: null,
  elBtnNo: null,
  elFooter: null,
  elCalledModal: null,
  callBackYes: null,
  instance: null,
  init() {
    if (this.instance) {
      return true;
    }
    this.elLPOverlay = $('.lp-overlay');
    if (!this.elLPOverlay.length) {
      return false;
    }
    elLPOverlay = this.elLPOverlay;
    this.elMainContent = elLPOverlay.find('.main-content');
    this.elTitle = elLPOverlay.find('.modal-title');
    this.elBtnYes = elLPOverlay.find('.btn-yes');
    this.elBtnNo = elLPOverlay.find('.btn-no');
    this.elFooter = elLPOverlay.find('.lp-modal-footer');
    $(document).on('click', '.close, .btn-no', function () {
      elLPOverlay.hide();
    });
    $(document).on('click', '.btn-yes', function (e) {
      e.preventDefault();
      e.stopPropagation();
      if ('function' === typeof lpModalOverlay.callBackYes) {
        lpModalOverlay.callBackYes(e);
      }
    });
    this.instance = this;
    return true;
  },
  setElCalledModal(elCalledModal) {
    this.elCalledModal = elCalledModal;
  },
  setContentModal(content, event) {
    this.elMainContent.html(content);
    if ('function' === typeof event) {
      event();
    }
  },
  setTitleModal(content) {
    this.elTitle.html(content);
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (lpModalOverlay);

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

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
/*!*************************************************!*\
  !*** ./assets/src/apps/js/admin/pages/tools.js ***!
  \*************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _tools_database_upgrade__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./tools/database/upgrade */ "./assets/src/apps/js/admin/pages/tools/database/upgrade.js");
/* harmony import */ var _tools_database_create_indexs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./tools/database/create_indexs */ "./assets/src/apps/js/admin/pages/tools/database/create_indexs.js");
/* harmony import */ var _tools_database_re_upgrade_db__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./tools/database/re-upgrade-db */ "./assets/src/apps/js/admin/pages/tools/database/re-upgrade-db.js");
/* harmony import */ var _tools_database_clean_database__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./tools/database/clean_database */ "./assets/src/apps/js/admin/pages/tools/database/clean_database.js");
/* harmony import */ var _tools_reset_data__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./tools/reset-data */ "./assets/src/apps/js/admin/pages/tools/reset-data/index.js");





(function ($) {
  const $doc = $(document);
  let isRunning = false;
  const installSampleCourse = function installSampleCourse(e) {
    e.preventDefault();
    const $button = $(this);
    if (isRunning) {
      return;
    }
    if (!confirm(lpGlobalSettings.i18n.confirm_install_sample_data)) {
      return;
    }
    $button.addClass('disabled').html($button.data('installing-text'));
    $('.lp-install-sample__response').remove();
    isRunning = true;
    $.ajax({
      url: $button.attr('href'),
      data: $('.lp-install-sample__options').serializeJSON(),
      success(response) {
        $button.removeClass('disabled').html($button.data('text'));
        isRunning = false;
        $(response).insertBefore($button.parent());
      },
      error() {
        $button.removeClass('disabled').html($button.data('text'));
        isRunning = false;
        $(response).insertBefore($button.parent());
      }
    });
  };
  const uninstallSampleCourse = function uninstallSampleCourse(e) {
    e.preventDefault();
    const $button = $(this);
    if (isRunning) {
      return;
    }
    if (!confirm(lpGlobalSettings.i18n.confirm_uninstall_sample_data)) {
      return;
    }
    $button.addClass('disabled').html($button.data('uninstalling-text'));
    isRunning = true;
    $.ajax({
      url: $button.attr('href'),
      success(response) {
        $button.removeClass('disabled').html($button.data('text'));
        isRunning = false;
        $(response).insertBefore($button.parent());
      },
      error() {
        $button.removeClass('disabled').html($button.data('text'));
        isRunning = false;
        $(response).insertBefore($button.parent());
      }
    });
  };
  const clearHardCache = function clearHardCache(e) {
    e.preventDefault();
    const $button = $(this);
    if ($button.hasClass('disabled')) {
      return;
    }
    $button.addClass('disabled').html($button.data('cleaning-text'));
    $.ajax({
      url: $button.attr('href'),
      data: {},
      success(response) {
        $button.removeClass('disabled').html($button.data('text'));
      },
      error() {
        $button.removeClass('disabled').html($button.data('text'));
      }
    });
  };
  const toggleHardCache = function toggleHardCache() {
    $.ajax({
      url: 'admin.php?page=lp-toggle-hard-cache-option',
      data: {
        v: this.checked ? 'yes' : 'no'
      },
      success(response) {},
      error() {}
    });
  };
  const toggleOptions = function toggleOptions(e) {
    e.preventDefault();
    $('.lp-install-sample__options').toggleClass('hide-if-js');
  };
  $(function () {
    (0,_tools_database_upgrade__WEBPACK_IMPORTED_MODULE_0__["default"])();
    (0,_tools_database_create_indexs__WEBPACK_IMPORTED_MODULE_1__["default"])();
    (0,_tools_database_re_upgrade_db__WEBPACK_IMPORTED_MODULE_2__["default"])();
    (0,_tools_reset_data__WEBPACK_IMPORTED_MODULE_4__["default"])();
    (0,_tools_database_clean_database__WEBPACK_IMPORTED_MODULE_3__["default"])();
    $doc.on('click', '.lp-install-sample__install', installSampleCourse).on('click', '.lp-install-sample__uninstall', uninstallSampleCourse).on('click', '#learn-press-clear-cache', clearHardCache).on('click', 'input[name="enable_hard_cache"]', toggleHardCache).on('click', '.lp-install-sample__toggle-options', toggleOptions);
  });
})(jQuery);
/******/ })()
;
//# sourceMappingURL=tools.js.map