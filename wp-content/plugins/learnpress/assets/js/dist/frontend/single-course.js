/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/frontend/material.js":
/*!*************************************************!*\
  !*** ./assets/src/apps/js/frontend/material.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ lpMaterialsLoad)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1__);


function lpMaterialsLoad(is_curriculum = false) {
  // console.log('loaded');
  const Sekeleton = () => {
    const elementSkeleton = document.querySelector('.lp-material-skeleton');
    if (!elementSkeleton) {
      return;
    }
    const loadMoreBtn = elementSkeleton.querySelector('.lp-loadmore-material');
    elementSkeleton.querySelector('.course-material-table').style.display = 'none';
    loadMoreBtn.style.display = 'none';
    getResponse(elementSkeleton);
  };
  const getResponse = async (ele, page = 1) => {
    let itemID = 0;
    if (is_curriculum) {
      const elCurriculum = document.querySelector('.learnpress-course-curriculum');
      if (!elCurriculum) {
        return;
      }
      const itemId = elCurriculum.dataset.id;
      itemID = itemId || 0;
    } else {
      itemID = lpGlobalSettings.post_id;
    }
    const elementMaterial = ele.querySelector('.course-material-table');
    const loadMoreBtn = document.querySelector('.lp-loadmore-material');
    const elListItems = document.querySelector('.lp-list-material');
    try {
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default()({
        path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)(`lp/v1/material/item-materials/${itemID}`, {
          page
        }),
        method: 'GET'
      });
      const {
        data,
        status,
        message
      } = response;
      if (status !== 'success') {
        return console.log(message);
      }
      if (data.items && data.items.length > 0) {
        if (ele.querySelector('.lp-skeleton-animation')) {
          ele.querySelector('.lp-skeleton-animation').remove();
        }
        elementMaterial.style.display = 'table';
        elementMaterial.querySelector('tbody').insertAdjacentHTML('beforeend', data.items);
      } else {
        elListItems.innerHTML = message;
      }
      if (data.load_more) {
        loadMoreBtn.style.display = 'inline-block';
        loadMoreBtn.setAttribute('page', page + 1);
        if (loadMoreBtn.classList.contains('loading')) {
          loadMoreBtn.classList.remove('loading');
        }
      } else {
        loadMoreBtn.style.display = 'none';
      }
    } catch (error) {
      console.log(error.message);
    }
  };
  Sekeleton();
  document.addEventListener('click', function (e) {
    const target = e.target;
    if (target.classList.contains('lp-loadmore-material')) {
      const elementSkeleton = document.querySelector('.lp-material-skeleton');
      const page = parseInt(target.getAttribute('page'));
      target.classList.add('loading');
      getResponse(elementSkeleton, page);
      // target.classList.remove( 'loading' );
    }
  });
}

/***/ }),

/***/ "./assets/src/apps/js/frontend/show-lp-overlay-complete-item.js":
/*!**********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/show-lp-overlay-complete-item.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");

const lpModalOverlayCompleteItem = {
  elBtnFinishCourse: null,
  elBtnCompleteItem: null,
  init() {
    if (!_utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].init()) {
      return;
    }
    if (undefined === lpGlobalSettings || 'yes' !== lpGlobalSettings.option_enable_popup_confirm_finish) {
      return;
    }
    this.elBtnFinishCourse = document.querySelectorAll('.lp-btn-finish-course');
    this.elBtnCompleteItem = document.querySelector('.lp-btn-complete-item');
    if (this.elBtnCompleteItem) {
      this.elBtnCompleteItem.addEventListener('click', e => {
        e.preventDefault();
        const form = e.target.closest('form');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(form.dataset.title);
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal('<div class="pd-2em">' + form.dataset.confirm + '</div>');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = () => {
          form.submit();
        };
      });
    }
    if (this.elBtnFinishCourse) {
      this.elBtnFinishCourse.forEach(element => element.addEventListener('click', e => {
        e.preventDefault();
        const form = e.target.closest('form');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].elLPOverlay.show();
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setTitleModal(form.dataset.title);
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].setContentModal('<div class="pd-2em">' + form.dataset.confirm + '</div>');
        _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__["default"].callBackYes = () => {
          form.submit();
        };
      }));
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (lpModalOverlayCompleteItem);

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-course/index.js":
/*!************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-course/index.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _learnpress_quiz__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @learnpress/quiz */ "@learnpress/quiz");
/* harmony import */ var _learnpress_quiz__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_learnpress_quiz__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./store */ "./assets/src/apps/js/frontend/single-course/store/index.js");
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_store__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _single_curriculum_components_sidebar__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../single-curriculum/components/sidebar */ "./assets/src/apps/js/frontend/single-curriculum/components/sidebar.js");




 // Use toggle in Curriculum tab.

class SingleCourse extends _wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Component {
  render() {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null);
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (SingleCourse);
function run() {
  (0,_single_curriculum_components_sidebar__WEBPACK_IMPORTED_MODULE_4__.Sidebar)();
}
document.addEventListener('DOMContentLoaded', () => {
  run();
});

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-course/store/index.js":
/*!******************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-course/store/index.js ***!
  \******************************************************************/
/***/ (() => {

/**
 * Created by tu on 9/19/19.
 */

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/components/search.js":
/*!****************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/components/search.js ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   searchCourseContent: () => (/* binding */ searchCourseContent)
/* harmony export */ });
const searchCourseContent = () => {
  const popup = document.querySelector('#popup-course');
  const list = document.querySelector('#learn-press-course-curriculum');
  if (popup && list) {
    const items = list.querySelector('.curriculum-sections');
    const form = popup.querySelector('.search-course');
    const search = popup.querySelector('.search-course input[type="text"]');
    if (!search || !items || !form) {
      return;
    }
    const sections = items.querySelectorAll('li.section');
    const dataItems = items.querySelectorAll('li.course-item');
    const dataSearch = [];
    dataItems.forEach(item => {
      const itemID = item.dataset.id;
      const name = item.querySelector('.item-name');
      dataSearch.push({
        id: itemID,
        name: name ? name.textContent.toLowerCase() : ''
      });
    });
    const submit = event => {
      event.preventDefault();
      const inputVal = search.value;
      form.classList.add('searching');
      if (!inputVal) {
        form.classList.remove('searching');
      }
      const outputs = [];
      dataSearch.forEach(i => {
        if (!inputVal || i.name.match(inputVal.toLowerCase())) {
          outputs.push(i.id);
          dataItems.forEach(c => {
            if (outputs.indexOf(c.dataset.id) !== -1) {
              c.classList.remove('hide-if-js');
            } else {
              c.classList.add('hide-if-js');
            }
          });
        }
      });
      sections.forEach(section => {
        const listItem = section.querySelectorAll('.course-item');
        const isTrue = [];
        listItem.forEach(a => {
          if (outputs.includes(a.dataset.id)) {
            isTrue.push(a.dataset.id);
          }
        });
        if (isTrue.length === 0) {
          section.classList.add('hide-if-js');
        } else {
          section.classList.remove('hide-if-js');
        }
      });
    };
    const clear = form.querySelector('.clear');
    if (clear) {
      clear.addEventListener('click', e => {
        e.preventDefault();
        search.value = '';
        submit(e);
      });
    }
    form.addEventListener('submit', submit);
    search.addEventListener('keyup', submit);
  }
};

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/components/sidebar.js":
/*!*****************************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/components/sidebar.js ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Sidebar: () => (/* binding */ Sidebar)
/* harmony export */ });
const $ = jQuery;
const {
  throttle
} = lodash;
const Sidebar = () => {
  // Tungnx - Show/hide sidebar curriculumn
  const elSidebarToggle = document.querySelector('#sidebar-toggle');

  // For style of theme
  const toggleSidebar = toggle => {
    $('body').removeClass('lp-sidebar-toggle__open');
    $('body').removeClass('lp-sidebar-toggle__close');
    if (toggle) {
      $('body').addClass('lp-sidebar-toggle__close');
    } else {
      $('body').addClass('lp-sidebar-toggle__open');
    }
  };

  // For lp and theme
  if (elSidebarToggle) {
    if ($(window).innerWidth() <= 768) {
      elSidebarToggle.setAttribute('checked', 'checked');
    } else if (LP.Cookies.get('sidebar-toggle')) {
      elSidebarToggle.setAttribute('checked', 'checked');
    } else {
      elSidebarToggle.removeAttribute('checked');
    }
    document.querySelector('#popup-course').addEventListener('click', e => {
      if (e.target.id === 'sidebar-toggle') {
        LP.Cookies.set('sidebar-toggle', e.target.checked ? true : false);
        toggleSidebar(LP.Cookies.get('sidebar-toggle'));
      }
    });
  }
  // End editor by tungnx

  const $curriculum = $('#learn-press-course-curriculum');
  $curriculum.find('.section-desc').each((i, el) => {
    const a = $('<span class="show-desc"></span>').on('click', () => {
      b.toggleClass('c');
    });
    const b = $(el).siblings('.section-title').append(a);
  });
  $('.section').each(function () {
    const $section = $(this),
      $toggle = $section.find('.section-left');
    $toggle.on('click', function () {
      const isClose = $section.toggleClass('closed').hasClass('closed');
      const sections = LP.Cookies.get('closed-section-' + lpGlobalSettings.post_id) || [];
      const sectionId = parseInt($section.data('section-id'));
      const at = sections.findIndex(id => {
        return id == sectionId;
      });
      if (isClose) {
        sections.push(parseInt($section.data('section-id')));
      } else {
        sections.splice(at, 1);
      }
      LP.Cookies.remove('closed-section-(.*)');
      LP.Cookies.set('closed-section-' + lpGlobalSettings.post_id, [...new Set(sections)]);
    });
  });
};

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/scrolltoitem.js":
/*!***********************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/scrolltoitem.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");

const $ = jQuery;
const scrollToItemCurrent = {
  init() {
    this.scrollToItemViewing = function () {
      const elItemViewing = $('.viewing-course-item');
      if (elItemViewing.length) {
        const elCourseCurriculumn = $('#learn-press-course-curriculum');
        const heightCourseItemContentHeader = $('#popup-sidebar').outerHeight();
        const heightSectionTitle = $('.section-title').outerHeight();
        const heightSectionHeader = $('.section-header').outerHeight();
        const regex = new RegExp('^viewing-course-item-([0-9].*)');
        const classList = elItemViewing.attr('class');
        const classArr = classList.split(/\s+/);
        let idItem = 0;
        $.each(classArr, function (i, className) {
          const compare = regex.exec(className);
          if (compare) {
            idItem = compare[1];
            return false;
          }
        });
        if (0 === idItem) {
          return;
        }
        const elItemCurrent = $('.course-item-' + idItem);
        elItemCurrent.addClass('current');
        const offSetTop = elItemCurrent.offset().top;
        const offset = elItemCurrent.offset().top - elCourseCurriculumn.offset().top + elCourseCurriculumn.scrollTop();
        elCourseCurriculumn.animate({
          scrollTop: LP.Hook.applyFilters('scroll-item-current', offset - heightSectionHeader)
        }, 800);
      }
    };
    this.scrollToItemViewing();
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (scrollToItemCurrent);

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-curriculum/skeleton.js":
/*!*******************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-curriculum/skeleton.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ courseCurriculumSkeleton)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _scrolltoitem__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./scrolltoitem */ "./assets/src/apps/js/frontend/single-curriculum/scrolltoitem.js");
/* harmony import */ var _components_search__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/search */ "./assets/src/apps/js/frontend/single-curriculum/components/search.js");
// Rest API load content in Tab Curriculum - Nhamdv.

//import apiFetch from '@wordpress/api-fetch';


function courseCurriculumSkeleton(courseID = '') {
  let idItemViewing = 0;
  const elItemViewing = document.querySelector('.viewing-course-item');
  if (elItemViewing) {
    const regex = new RegExp('^viewing-course-item-([0-9].*)');
    const classList = elItemViewing.classList;
    classList.forEach(function (className) {
      const compare = regex.exec(className);
      if (compare) {
        idItemViewing = compare[1];
        return false;
      }
    });
  }
  let isLoadingItems = false;
  let isLoadingSections = false;
  const Sekeleton = () => {
    const elementCurriculum = document.querySelector('.learnpress-course-curriculum');
    if (!elementCurriculum) {
      return;
    }
    getResponse(elementCurriculum);
  };
  const getResponse = async ele => {
    const skeleton = ele.querySelector('.lp-skeleton-animation');
    const itemID = ele.dataset.id;
    const sectionID = ele.dataset.section;
    try {
      const page = 1;
      let url = lpData.lp_rest_url + 'lp/v1/lazy-load/course-curriculum/';
      url = (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)(url, {
        courseId: courseID || lpGlobalSettings.post_id || '',
        page,
        sectionID: sectionID || '',
        idItemViewing
      });
      let paramsFetch = {};
      if (0 !== parseInt(lpData.user_id)) {
        paramsFetch = {
          headers: {
            'X-WP-Nonce': lpData.nonce
          }
        };
      }
      let response = await fetch(url, {
        method: 'GET',
        ...paramsFetch
      });
      response = await response.json();
      const {
        data,
        status,
        message
      } = response;
      const section_ids = data.section_ids;
      if (status === 'error') {
        throw new Error(message || 'Error');
      }
      const returnData = data.content;
      if (sectionID) {
        if (section_ids && !section_ids.includes(sectionID)) {
          const response2 = await getResponsive('', page + 1, sectionID);
          if (response2) {
            const {
              data2,
              pages2,
              page2
            } = response2;
            await parseContentItems({
              ele,
              returnData,
              sectionID,
              itemID,
              data2,
              pages2,
              page2
            });
          }
        } else {
          await parseContentItems({
            ele,
            returnData,
            sectionID,
            itemID
          });
        }
      } else {
        returnData && ele.insertAdjacentHTML('beforeend', returnData);
      }
    } catch (error) {
      ele.insertAdjacentHTML('beforeend', `<div class="lp-ajax-message error" style="display:block">${error.message || 'Error: Query lp/v1/lazy-load/course-curriculum'}</div>`);
    }
    skeleton && skeleton.remove();
    (0,_components_search__WEBPACK_IMPORTED_MODULE_2__.searchCourseContent)();
  };
  const parseContentItems = async ({
    ele,
    returnData,
    sectionID,
    itemID,
    data2,
    pages2,
    page2
  }) => {
    const parser = new DOMParser();
    const doc = parser.parseFromString(returnData, 'text/html');
    if (data2) {
      const sections = doc.querySelector('.curriculum-sections');
      const loadMoreBtn = doc.querySelector('.curriculum-more__button');
      if (loadMoreBtn) {
        if (pages2 <= page2) {
          loadMoreBtn.remove();
        } else {
          loadMoreBtn.dataset.page = page2;
        }
      }
      sections.insertAdjacentHTML('beforeend', data2);
    }
    const section = doc.querySelector(`[data-section-id="${sectionID}"]`);
    if (section) {
      const items = section.querySelectorAll('.course-item');
      const item_ids = [...items].map(item => item.dataset.id);
      const sectionContent = section.querySelector('.section-content');
      const itemLoadMore = section.querySelector('.section-item__loadmore');
      if (itemID && !item_ids.includes(itemID)) {
        const responseItem = await getResponsiveItem('', 2, sectionID, itemID);
        const {
          data3,
          pages3,
          paged3,
          page
        } = responseItem;
        if (pages3 <= paged3 || pages3 <= page) {
          itemLoadMore.remove();
        } else {
          itemLoadMore.dataset.page = page;
        }
        if (data3 && sectionContent) {
          sectionContent.insertAdjacentHTML('beforeend', data3);
        }
      }
    }
    ele.insertAdjacentHTML('beforeend', doc.body.innerHTML);
    _scrolltoitem__WEBPACK_IMPORTED_MODULE_1__["default"].init();
  };
  const getResponsiveItem = async (returnData, paged, sectionID, itemID) => {
    let url = lpData.lp_rest_url + 'lp/v1/lazy-load/course-curriculum-items/';
    url = (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)(url, {
      sectionId: sectionID || '',
      page: paged
    });
    let paramsFetch = {};
    if (0 !== parseInt(lpData.user_id)) {
      paramsFetch = {
        headers: {
          'X-WP-Nonce': lpData.nonce
        }
      };
    }
    let response = await fetch(url, {
      method: 'GET',
      ...paramsFetch
    });
    response = await response.json();
    const {
      data,
      status,
      pages,
      message
    } = response;
    const {
      page
    } = data;
    let item_ids;
    if (status === 'success') {
      const dataTmp = data.content;
      item_ids = data.item_ids;
      returnData += dataTmp;
      if (sectionID && item_ids && itemID && !item_ids.includes(itemID)) {
        return getResponsiveItem(returnData, paged + 1, sectionID, itemID);
      }
    }
    isLoadingItems = false;
    return {
      data3: returnData,
      pages3: pages || data.pages,
      status3: status,
      message3: message,
      page: page || 0
    };
  };
  const getResponsive = async (returnData, page, sectionID) => {
    let url = lpData.lp_rest_url + 'lp/v1/lazy-load/course-curriculum/';
    url = (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)(url, {
      courseId: courseID || lpGlobalSettings.post_id || '',
      page,
      sectionID: sectionID || '',
      loadMore: true
    });
    let paramsFetch = {};
    if (0 !== parseInt(lpData.user_id)) {
      paramsFetch = {
        headers: {
          'X-WP-Nonce': lpData.nonce
        }
      };
    }
    let response = await fetch(url, {
      method: 'GET',
      ...paramsFetch
    });
    response = await response.json();
    const {
      data,
      status,
      message
    } = response;
    const returnDataTmp = data.content;
    const section_ids = data.section_ids;
    const pages = data.pages;
    if (status === 'success') {
      returnData += returnDataTmp;
      if (sectionID && section_ids && section_ids.length > 0 && !section_ids.includes(sectionID)) {
        return getResponsive(returnData, page + 1, sectionID);
      }
    }
    isLoadingSections = false;
    return {
      data2: returnData,
      pages2: pages || data.pages,
      page2: page,
      status2: status,
      message2: message
    };
  };
  Sekeleton();
  document.addEventListener('click', e => {
    const sectionBtns = document.querySelectorAll('.section-item__loadmore');
    [...sectionBtns].map(async sectionBtn => {
      if (sectionBtn.contains(e.target) && !isLoadingItems) {
        isLoadingItems = true;
        const sectionItem = sectionBtn.parentNode;
        const sectionId = sectionItem.getAttribute('data-section-id');
        const sectionContent = sectionItem.querySelector('.section-content');
        const paged = parseInt(sectionBtn.dataset.page);
        sectionBtn.classList.add('loading');
        try {
          const response = await getResponsiveItem('', paged + 1, sectionId, '');
          const {
            data3,
            pages3,
            status3,
            message3
          } = response;
          if (status3 === 'error') {
            throw new Error(message3 || 'Error');
          }
          if (pages3 <= paged + 1) {
            sectionBtn.remove();
          } else {
            sectionBtn.dataset.page = paged + 1;
          }
          sectionContent.insertAdjacentHTML('beforeend', data3);
        } catch (e) {
          sectionContent.insertAdjacentHTML('beforeend', `<div class="lp-ajax-message error" style="display:block">${e.message || 'Error: Query lp/v1/lazy-load/course-curriculum'}</div>`);
        }
        sectionBtn.classList.remove('loading');
        (0,_components_search__WEBPACK_IMPORTED_MODULE_2__.searchCourseContent)();
      }
    });

    // Load more Sections
    const moreSections = document.querySelectorAll('.curriculum-more__button');
    [...moreSections].map(async moreSection => {
      if (moreSection.contains(e.target) && !isLoadingSections) {
        isLoadingSections = true;
        const paged = parseInt(moreSection.dataset.page);
        const sections = moreSection.parentNode.parentNode.querySelector('.curriculum-sections');
        if (paged && sections) {
          moreSection.classList.add('loading');
          try {
            const response2 = await getResponsive('', paged + 1, '');
            const {
              data2,
              pages2,
              status2,
              message2
            } = response2;
            if (status2 === 'error') {
              throw new Error(message2 || 'Error');
            }
            if (pages2 <= paged + 1) {
              moreSection.remove();
            } else {
              moreSection.dataset.page = paged + 1;
            }
            sections.insertAdjacentHTML('beforeend', data2);
          } catch (e) {
            sections.insertAdjacentHTML('beforeend', `<div class="lp-ajax-message error" style="display:block">${e.message || 'Error: Query lp/v1/lazy-load/course-curriculum'}</div>`);
          }
          moreSection.classList.remove('loading');
          (0,_components_search__WEBPACK_IMPORTED_MODULE_2__.searchCourseContent)();
        }
      }
    });

    // Show/Hide accordion
    if (document.querySelector('.learnpress-course-curriculum')) {
      const sections = document.querySelectorAll('.section');
      [...sections].map(section => {
        if (section.contains(e.target)) {
          const toggle = section.querySelector('.section-left');
          toggle.contains(e.target) && section.classList.toggle('closed');
        }
      });
    }
  });
}

/***/ }),

/***/ "./assets/src/apps/js/utils/lp-modal-overlay.js":
/*!******************************************************!*\
  !*** ./assets/src/apps/js/utils/lp-modal-overlay.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
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

"use strict";
module.exports = window["React"];

/***/ }),

/***/ "@learnpress/quiz":
/*!******************************!*\
  !*** external ["LP","quiz"] ***!
  \******************************/
/***/ ((module) => {

"use strict";
module.exports = window["LP"]["quiz"];

/***/ }),

/***/ "@wordpress/api-fetch":
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["apiFetch"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/url":
/*!*****************************!*\
  !*** external ["wp","url"] ***!
  \*****************************/
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["url"];

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
/*!******************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-course.js ***!
  \******************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   enrollCourse: () => (/* binding */ enrollCourse),
/* harmony export */   init: () => (/* binding */ init),
/* harmony export */   initCourseSidebar: () => (/* binding */ initCourseSidebar),
/* harmony export */   initCourseTabs: () => (/* binding */ initCourseTabs)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _single_course_index__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./single-course/index */ "./assets/src/apps/js/frontend/single-course/index.js");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _show_lp_overlay_complete_item__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./show-lp-overlay-complete-item */ "./assets/src/apps/js/frontend/show-lp-overlay-complete-item.js");
/* harmony import */ var _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../utils/lp-modal-overlay */ "./assets/src/apps/js/utils/lp-modal-overlay.js");
/* harmony import */ var _single_curriculum_skeleton__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./single-curriculum/skeleton */ "./assets/src/apps/js/frontend/single-curriculum/skeleton.js");
/* harmony import */ var _material__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./material */ "./assets/src/apps/js/frontend/material.js");







/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_single_course_index__WEBPACK_IMPORTED_MODULE_1__["default"]);
const init = () => {
  wp.element.render((0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_single_course_index__WEBPACK_IMPORTED_MODULE_1__["default"], null));
};
const $ = jQuery;
const initCourseTabs = function () {
  $('#learn-press-course-tabs').on('change', 'input[name="learn-press-course-tab-radio"]', function (e) {
    const selectedTab = $('input[name="learn-press-course-tab-radio"]:checked').val();
    LP.Cookies.set('course-tab', selectedTab);
    $('label[for="' + $(e.target).attr('id') + '"]').closest('li').addClass('active').siblings().removeClass('active');
  });
};
const initCourseSidebar = function initCourseSidebar() {
  const $sidebar = $('.course-summary-sidebar');
  if (!$sidebar.length) {
    return;
  }
  const $window = $(window);
  const $scrollable = $sidebar.children();
  const offset = $sidebar.offset();
  let scrollTop = 0;
  const maxHeight = $sidebar.height();
  const scrollHeight = $scrollable.height();
  const options = {
    offsetTop: 32
  };
  const onScroll = function () {
    scrollTop = $window.scrollTop();
    const top = scrollTop - offset.top + options.offsetTop;
    if (top < 0) {
      $sidebar.removeClass('slide-top slide-down');
      $scrollable.css('top', '');
      return;
    }
    if (top > maxHeight - scrollHeight) {
      $sidebar.removeClass('slide-down').addClass('slide-top');
      $scrollable.css('top', maxHeight - scrollHeight);
    } else {
      $sidebar.removeClass('slide-top').addClass('slide-down');
      $scrollable.css('top', options.offsetTop);
    }
  };
  $window.on('scroll.fixed-course-sidebar', onScroll).trigger('scroll.fixed-course-sidebar');
};

// Rest API Enroll course - Nhamdv.
const enrollCourse = () => {
  const formEnrolls = document.querySelectorAll('form.enroll-course');
  if (formEnrolls.length > 0) {
    formEnrolls.forEach(formEnroll => {
      const submit = async (id, btnEnroll) => {
        try {
          const response = await wp.apiFetch({
            path: 'lp/v1/courses/enroll-course',
            method: 'POST',
            data: {
              id
            }
          });
          btnEnroll.classList.remove('loading');
          btnEnroll.disabled = false;
          const {
            status,
            data: {
              redirect
            },
            message
          } = response;
          if (message && status) {
            btnEnroll.style.display = 'none';
            formEnroll.innerHTML += `<div class="lp-enroll-notice ${status}">${message}</div>`;
            if (redirect) {
              window.location.href = redirect;
            }
          }
        } catch (error) {
          form.innerHTML += `<div class="lp-enroll-notice error">${error.message && error.message}</div>`;
        }
      };
      formEnroll.addEventListener('submit', event => {
        event.preventDefault();
        const id = formEnroll.querySelector('input[name=enroll-course]').value;
        const btnEnroll = formEnroll.querySelector('button.button-enroll-course');
        btnEnroll.classList.add('loading');
        btnEnroll.disabled = true;
        submit(id, btnEnroll);
      });
    });
  }

  // Reload when press back button in chrome.
  if (document.querySelector('.course-detail-info') !== null) {
    window.addEventListener('pageshow', event => {
      const hasCache = event.persisted || typeof window.performance != 'undefined' && String(window.performance.getEntriesByType('navigation')[0].type) == 'back_forward';
      if (hasCache) {
        location.reload();
      }
    });
  }
};

// Rest API purchase course - Nhamdv.
const purchaseCourse = () => {
  const forms = document.querySelectorAll('form.purchase-course');
  if (forms.length > 0) {
    forms.forEach(form => {
      // Allow Repurchase.
      const allowRepurchase = () => {
        const continueRepurchases = document.querySelectorAll('.lp_allow_repuchase_select');
        continueRepurchases.forEach(repurchase => {
          const radios = repurchase.querySelectorAll('[name=_lp_allow_repurchase_type]');
          for (let i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
              const repurchaseType = radios[i].value;
              const id = form.querySelector('input[name=purchase-course]').value;
              const btnBuynow = form.querySelector('button.button-purchase-course');
              btnBuynow.classList.add('loading');
              btnBuynow.disabled = true;
              submit(id, btnBuynow, repurchaseType);
              break;
            }
          }
        });
      };
      const submit = async (id, btn, repurchaseType = false) => {
        try {
          const response = await wp.apiFetch({
            path: 'lp/v1/courses/purchase-course',
            method: 'POST',
            data: {
              id,
              repurchaseType
            }
          });
          if (btn) {
            btn.classList.remove('loading');
            btn.disabled = false;
          }
          const {
            status,
            data: {
              redirect,
              type,
              html,
              titlePopup
            },
            message
          } = response;
          if (type === 'allow_repurchase' && status === 'success') {
            if (!form.querySelector('.lp_allow_repuchase_select')) {
              if (!_utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_4__["default"].init()) {
                return;
              }
              _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_4__["default"].elLPOverlay.show();
              _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_4__["default"].setTitleModal(titlePopup || '');
              _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_4__["default"].setContentModal(html);
              _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_4__["default"].callBackYes = () => {
                _utils_lp_modal_overlay__WEBPACK_IMPORTED_MODULE_4__["default"].elLPOverlay.hide();
                allowRepurchase();
              };
            }
          } else if (message && status) {
            form.innerHTML += `<div class="lp-enroll-notice ${status}">${message}</div>`;
            if ('success' === status && redirect) {
              window.location.href = redirect;
            }
          }
        } catch (error) {
          form.innerHTML += `<div class="lp-enroll-notice error">${error.message && error.message}</div>`;
        }
      };
      form.addEventListener('submit', event => {
        event.preventDefault();
        const id = form.querySelector('input[name=purchase-course]').value;
        const btn = form.querySelector('button.button-purchase-course');
        btn.classList.add('loading');
        btn.disabled = true;
        submit(id, btn);
      });
    });
  }
};
const retakeCourse = () => {
  const elFormRetakeCourses = document.querySelectorAll('.lp-form-retake-course');
  if (!elFormRetakeCourses.length) {
    return;
  }
  elFormRetakeCourses.forEach(elFormRetakeCourse => {
    const elButtonRetakeCourses = elFormRetakeCourse.querySelector('.button-retake-course');
    const elCourseId = elFormRetakeCourse.querySelector('[name=retake-course]').value;
    const elAjaxMessage = elFormRetakeCourse.querySelector('.lp-ajax-message');
    const submit = elButtonRetakeCourse => {
      wp.apiFetch({
        path: '/lp/v1/courses/retake-course',
        method: 'POST',
        data: {
          id: elCourseId
        }
      }).then(res => {
        const {
          status,
          message,
          data
        } = res;
        elAjaxMessage.innerHTML = message;
        if (undefined != status && status === 'success') {
          elButtonRetakeCourse.style.display = 'none';
          setTimeout(() => {
            window.location.replace(data.url_redirect);
          }, 1000);
        } else {
          elAjaxMessage.classList.add('error');
        }
      }).catch(err => {
        elAjaxMessage.classList.add('error');
        elAjaxMessage.innerHTML = 'error: ' + err.message;
      }).then(() => {
        elButtonRetakeCourse.classList.remove('loading');
        elButtonRetakeCourse.disabled = false;
        elAjaxMessage.style.display = 'block';
      });
    };
    elFormRetakeCourse.addEventListener('submit', e => {
      e.preventDefault();
    });
    elButtonRetakeCourses.addEventListener('click', e => {
      e.preventDefault();
      elButtonRetakeCourses.classList.add('loading');
      elButtonRetakeCourses.disabled = true;
      submit(elButtonRetakeCourses);
    });
  });
};

// Rest API load content course progress - Nhamdv.
const courseProgress = () => {
  const elements = document.querySelectorAll('.lp-course-progress-wrapper');
  if (!elements.length) {
    return;
  }
  if ('IntersectionObserver' in window) {
    const eleObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const ele = entry.target;
          setTimeout(function () {
            getResponse(ele);
          }, 600);
          eleObserver.unobserve(ele);
        }
      });
    });
    [...elements].map(ele => eleObserver.observe(ele));
  }
  const getResponse = async ele => {
    const response = await wp.apiFetch({
      path: 'lp/v1/lazy-load/course-progress',
      method: 'POST',
      data: {
        courseId: lpGlobalSettings.post_id || '',
        userId: lpGlobalSettings.user_id || ''
      }
    });
    const {
      data
    } = response;
    ele.innerHTML = data;
  };
};
const accordionExtraTab = () => {
  const elements = document.querySelectorAll('.course-extra-box');
  [...elements].map(ele => {
    const title = ele.querySelector('.course-extra-box__title');
    ele.classList.remove('active');
    const content = ele.querySelector('.course-extra-box__content');
    content.style.height = '0';
    title.addEventListener('click', () => {
      const isActive = ele.classList.contains('active');
      [...elements].forEach(otherEle => {
        if (otherEle !== ele) {
          otherEle.classList.remove('active');
          otherEle.querySelector('.course-extra-box__content').style.height = '0';
        }
      });
      if (isActive) {
        ele.classList.remove('active');
        content.style.height = '0';
      } else {
        ele.classList.add('active');
        content.style.height = content.scrollHeight + 'px';
      }
    });
  });
};
const courseContinue = () => {
  const formContinue = document.querySelectorAll('form.continue-course');
  if (formContinue != null && lpGlobalSettings.user_id > 0) {
    const getResponse = async ele => {
      const response = await wp.apiFetch({
        path: 'lp/v1/courses/continue-course',
        method: 'POST',
        data: {
          courseId: lpGlobalSettings.post_id || '',
          userId: lpGlobalSettings.user_id || ''
        }
      });
      return response;
    };
    getResponse(formContinue).then(function (result) {
      if (result.status === 'success') {
        formContinue.forEach(form => {
          form.style.display = 'inline-block';
          form.action = result.data;
        });
      }
    });
  }
};

$(window).on('load', () => {
  const $popup = $('#popup-course');
  let timerClearScroll;
  const $curriculum = $('#learn-press-course-curriculum');
  accordionExtraTab();
  initCourseTabs();
  initCourseSidebar();
  enrollCourse();
  purchaseCourse();
  retakeCourse();
  courseProgress();
  courseContinue();
  _show_lp_overlay_complete_item__WEBPACK_IMPORTED_MODULE_3__["default"].init();
  (0,_material__WEBPACK_IMPORTED_MODULE_6__["default"])();
  //courseCurriculumSkeleton();
});
const detectedElCurriculum = setInterval(function () {
  const elementCurriculum = document.querySelector('.learnpress-course-curriculum');
  if (elementCurriculum) {
    (0,_single_curriculum_skeleton__WEBPACK_IMPORTED_MODULE_5__["default"])();
    clearInterval(detectedElCurriculum);
  }
}, 1);

// Add callback for Thimkits
LP.Hook.addAction('lp_course_curriculum_skeleton', function (id) {
  (0,_single_curriculum_skeleton__WEBPACK_IMPORTED_MODULE_5__["default"])(id);
});
})();

/******/ })()
;
//# sourceMappingURL=single-course.js.map