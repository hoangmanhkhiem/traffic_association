/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/frontend/profile/avatar.js":
/*!*******************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile/avatar.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Avatar)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react_easy_crop__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-easy-crop */ "./node_modules/react-easy-crop/index.module.js");





function Avatar() {
  const [file, setFile] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)();
  const [width, setWidth] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(0);
  const [height, setHeight] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(0);
  const [crop, setCrop] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)({
    x: 0,
    y: 0
  });
  const [rotation, setRotation] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(0);
  const [croppedAreaPixels, setCroppedAreaPixels] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(null);
  const [naturalWidth, setNaturalWidth] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(0);
  const [naturalHeight, setNaturalHeight] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(0);
  const [loading, setLoading] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const [skeleton, setSkeleton] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(true);
  const [uploadError, setUploadError] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)('');
  const [notice, setNotice] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)({
    type: '',
    message: ''
  });
  const fileInput = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useRef)();
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    async function getAvatar() {
      setSkeleton(true);
      try {
        const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
          method: 'GET',
          path: 'lp/v1/profile/get-avatar'
        });
        setWidth(response?.data?.width ? parseInt(response.data.width) : 0);
        setHeight(response?.data?.height ? parseInt(response.data.height) : 0);
        setFile(response?.data?.url ? response.data.url : '');
      } catch (error) {
        setNotice({
          type: 'error',
          message: error.message
        });
      }
      setSkeleton(false);
    }
    getAvatar();
  }, []);
  function readFile(file) {
    return new Promise(resolve => {
      const reader = new FileReader();
      reader.addEventListener('load', () => resolve(reader.result), false);
      reader.readAsDataURL(file);
    });
  }
  const onCropComplete = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useCallback)((croppedArea, croppedAreaPixels) => {
    setCroppedAreaPixels(croppedAreaPixels);
  }, []);
  const base64Resize = (base64, width, height) => {
    return new Promise((resolve, reject) => {
      const canvas = document.createElement('canvas');
      const img = document.createElement('img');
      img.src = base64;
      img.setAttribute('crossOrigin', 'anonymous');
      img.onload = () => {
        if (img.naturalWidth > width || img.naturalHeight > height) {
          canvas.width = width;
          canvas.height = height;
          const ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0, width, height);
          resolve(canvas.toDataURL('image/jpeg'));
        }
        resolve(base64);
      };
      img.onerror = err => reject(err);
    });
  };
  const updateAvatar = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useCallback)(async () => {
    setLoading({
      save: true
    });
    try {
      const croppedImage = await getCroppedImg(file, croppedAreaPixels, rotation);
      const imageResize = await base64Resize(croppedImage, width, height);
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
        path: 'lp/v1/profile/upload-avatar',
        method: 'POST',
        data: {
          file: imageResize || ''
        }
      });
      const {
        data,
        status,
        message
      } = await response;
      if (status === 'success') {
        window.location.reload();
      }
      setNotice({
        type: status,
        message
      });
    } catch (e) {
      setNotice({
        type: 'error',
        message: e.message || ''
      });
    }
    setLoading({
      save: false
    });
  }, [croppedAreaPixels, rotation]);
  const setFileInput = async fileUpload => {
    const file = await readFile(fileUpload);
    const img = new Image();
    img.src = await file;
    img.onload = await function () {
      setNaturalWidth(img.naturalWidth);
      setNaturalHeight(img.naturalHeight);
      let error = '';
      if (parseInt(fileUpload.size) > 2097152) {
        error = (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('The file size is too large. You need to upload a file < 2MB.', 'learnpress');
      } else if (img.naturalWidth < width || img.naturalHeight < height) {
        error = (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.sprintf)((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('The image size must be greater than or equal to %1$sx%2$spx', 'learnpress'), width, height);
      }
      if (error) {
        setUploadError(error);
      } else {
        setUploadError('');
        setFile(file);
      }
    };
  };
  async function removeAvatar() {
    if (confirm((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Are you sure you want to remove your avatar?', 'learnpress'))) {
      setLoading({
        remove: true
      });
      try {
        const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
          path: 'lp/v1/profile/remove-avatar',
          method: 'POST'
        });
        const {
          data,
          status,
          message
        } = await response;
        setNotice({
          type: status,
          message
        });
        setFile('');
      } catch (e) {
        setNotice({
          type: 'error',
          message: e.message || ''
        });
      }
      setLoading({
        remove: false
      });
    }
  }
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "learnpress_avatar"
  }, !skeleton ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, file && !uploadError && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, naturalHeight && naturalWidth ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "learnpress_avatar__cropper"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      position: 'relative',
      width: naturalWidth,
      height: naturalHeight,
      zIndex: 9999,
      maxWidth: '100%',
      maxHeight: '800px'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react_easy_crop__WEBPACK_IMPORTED_MODULE_4__["default"], {
    image: file,
    crop: crop,
    zoom: "1",
    cropSize: {
      width,
      height
    },
    onCropChange: setCrop,
    onCropComplete: onCropComplete
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: `learnpress_avatar__button learnpress_avatar__button--save ${loading?.save ? 'learnpress_avatar__button--loading' : ''}`,
    onClick: updateAvatar
  }, lpProfileSettings.text_save))) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "learnpress_avatar__cropper"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
    src: file,
    alt: ""
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: `learnpress_avatar__button learnpress_avatar__button--replace`,
    onClick: () => fileInput.current && fileInput.current.click()
  }, lpProfileSettings.text_replace), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: `learnpress_avatar__button learnpress_avatar__button--remove ${loading?.remove ? 'learnpress_avatar__button--loading' : ''}`,
    onClick: removeAvatar
  }, lpProfileSettings.text_remove)))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("form", {
    style: {
      display: !file ? '' : 'none'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "learnpress_avatar__form"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "learnpress_avatar__form-group"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "avatar-file"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "learnpress_avatar__form__upload"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    viewBox: "64 64 896 896",
    focusable: "false",
    "data-icon": "plus",
    width: "1em",
    height: "1em",
    fill: "currentColor",
    "aria-hidden": "true"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("defs", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("style", null)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, lpProfileSettings.text_upload))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    ref: fileInput,
    type: "file",
    id: "avatar-file",
    accept: "image/*",
    onChange: e => setFileInput(e.target.files && e.target.files.length > 0 ? e.target.files[0] : '')
  }))))), uploadError && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `lp-ajax-message error`,
    style: {
      display: 'block'
    }
  }, uploadError), !uploadError && notice && notice.type && notice.message && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `lp-ajax-message ${notice.type}`,
    style: {
      display: 'block'
    }
  }, notice.message)) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("ul", {
    className: "lp-skeleton-animation"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    style: {
      width: 200,
      height: 200
    }
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    style: {
      width: 200,
      height: 20
    }
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    style: {
      width: 200,
      height: 20
    }
  })));
}

// Link: https://codesandbox.io/s/q8q1mnr01w
const createImage = url => new Promise((resolve, reject) => {
  const image = new Image();
  image.addEventListener('load', () => resolve(image));
  image.addEventListener('error', error => reject(error));
  image.setAttribute('crossOrigin', 'anonymous'); // needed to avoid cross-origin issues on CodeSandbox
  image.src = url;
});
function getRadianAngle(degreeValue) {
  return degreeValue * Math.PI / 180;
}

/**
 * Returns the new bounding area of a rotated rectangle.
 *
 * @param width
 * @param height
 * @param rotation
 */
function rotateSize(width, height, rotation) {
  const rotRad = getRadianAngle(rotation);
  return {
    width: Math.abs(Math.cos(rotRad) * width) + Math.abs(Math.sin(rotRad) * height),
    height: Math.abs(Math.sin(rotRad) * width) + Math.abs(Math.cos(rotRad) * height)
  };
}

/**
 * This function was adapted from the one in the ReadMe of https://github.com/DominicTobias/react-image-crop
 *
 * @param imageSrc
 * @param pixelCrop
 * @param rotation
 * @param flip
 */
async function getCroppedImg(imageSrc, pixelCrop, rotation = 0, flip = {
  horizontal: false,
  vertical: false
}) {
  const image = await createImage(imageSrc);
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');
  if (!ctx) {
    return null;
  }
  const rotRad = getRadianAngle(rotation);

  // calculate bounding box of the rotated image
  const {
    width: bBoxWidth,
    height: bBoxHeight
  } = rotateSize(image.width, image.height, rotation);

  // set canvas size to match the bounding box
  canvas.width = bBoxWidth;
  canvas.height = bBoxHeight;

  // translate canvas context to a central location to allow rotating and flipping around the center
  ctx.translate(bBoxWidth / 2, bBoxHeight / 2);
  ctx.rotate(rotRad);
  ctx.scale(flip.horizontal ? -1 : 1, flip.vertical ? -1 : 1);
  ctx.translate(-image.width / 2, -image.height / 2);

  // draw rotated image
  ctx.drawImage(image, 0, 0);

  // croppedAreaPixels values are bounding box relative
  // extract the cropped image using these values
  const data = ctx.getImageData(pixelCrop.x, pixelCrop.y, pixelCrop.width, pixelCrop.height);

  // set canvas width to final desired crop size - this will clear existing context
  canvas.width = pixelCrop.width;
  canvas.height = pixelCrop.height;

  // paste generated rotate image at the top left corner
  ctx.putImageData(data, 0, 0);

  // As Base64 string
  return canvas.toDataURL('image/jpeg');
}

/***/ }),

/***/ "./assets/src/apps/js/frontend/profile/course-list.js":
/*!************************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile/course-list.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ CourseList)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);

const contentAreaNode = document.querySelector('.lp-content-area');
let containerNode;
let query = {};
function CourseList() {
  containerNode = document.querySelector('.learnpress-course-container');
  if (!containerNode) {
    return;
  }
  const data = JSON.parse(containerNode.querySelector('.lp_profile_data').value);
  query = {
    ...data,
    c_author: data?.userID,
    template: 'user_not_publish'
  };
  getCourses(query);
  pagination();
}
const getCourses = queryParam => {
  containerNode.style.opacity = 0.4;
  wp.apiFetch({
    path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)('lp/v1/courses/archive-course', queryParam),
    method: 'GET'
  }).then(res => {
    if (res.data.content !== undefined) {
      containerNode.innerHTML = res.data.content;
    }

    //pagination
    if (contentAreaNode) {
      const paginationNode = document.querySelector('.learn-press-pagination');
      if (paginationNode) {
        paginationNode.remove();
      }
      if (res.data.pagination !== undefined) {
        contentAreaNode.insertAdjacentHTML('beforeend', res.data.pagination);
      }
    }
  }).catch(err => {
    console.log(err);
  }).finally(() => {
    if (queryParam.paged) {
      const optionScroll = {
        behavior: 'smooth'
      };
      containerNode.scrollIntoView(optionScroll);
    }
    containerNode.style.opacity = 1;
  });
};
const pagination = () => {
  document.addEventListener('click', function (event) {
    const target = event.target;
    const pagination = target.closest('.learn-press-pagination');
    if (!pagination) {
      return;
    }
    let pageLinkNode;
    if (target.tagName.toLowerCase() === 'a') {
      pageLinkNode = target;
    } else if (target.closest('a.page-numbers')) {
      pageLinkNode = target.closest('a.page-numbers');
    } else {
      return;
    }
    event.preventDefault();
    const currentPage = parseInt(pagination.querySelector('.current').innerHTML);
    let paged;
    if (pageLinkNode.classList.contains('next')) {
      paged = currentPage + 1;
    } else if (pageLinkNode.classList.contains('prev')) {
      paged = currentPage - 1;
    } else {
      paged = pageLinkNode.innerHTML;
    }
    query = {
      ...query,
      paged
    };
    getCourses(query);
  });
};

/***/ }),

/***/ "./assets/src/apps/js/frontend/profile/course-tab.js":
/*!***********************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile/course-tab.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);


// Rest API load content course enrolled, created - Nhamdv.
const courseTab = () => {
  const elements = document.querySelectorAll('.learn-press-course-tab__filter__content');
  const getResponse = (ele, dataset, append = false, viewMoreEle = false) => {
    wp.apiFetch({
      path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)('lp/v1/profile/course-tab', dataset),
      method: 'GET'
    }).then(response => {
      const skeleton = ele.querySelector('.lp-skeleton-animation');
      skeleton && skeleton.remove();
      if (response.status === 'success' && response.data) {
        if (append) {
          ele.innerHTML += response.data;
        } else {
          ele.innerHTML = response.data;
        }
      } else if (append) {
        ele.innerHTML += `<div class="lp-ajax-message" style="display:block">${response.message && response.message}</div>`;
      } else {
        ele.innerHTML = `<div class="lp-ajax-message" style="display:block">${response.message && response.message}</div>`;
      }
      if (viewMoreEle) {
        viewMoreEle.classList.remove('loading');
        const paged = parseInt(viewMoreEle.dataset.paged);
        const numberPage = parseInt(viewMoreEle.dataset.number);
        if (numberPage <= paged) {
          viewMoreEle.remove();
        }
        viewMoreEle.dataset.paged = paged + 1;
      }
      viewMore(ele, dataset);
    }).catch(error => {
      if (append) {
        ele.innerHTML += `<div class="lp-ajax-message error" style="display:block">${error.message && error.message}</div>`;
      } else {
        ele.innerHTML = `<div class="lp-ajax-message error" style="display:block">${error.message && error.message}</div>`;
      }
    });
  };
  if ('IntersectionObserver' in window) {
    const eleObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const ele = entry.target;
          const params = ele.parentNode.querySelector('.lp_profile_tab_input_param');
          const data = {
            ...JSON.parse(params.value),
            status: ele.dataset.tab || ''
          };
          getResponse(ele, data);
          eleObserver.unobserve(ele);
        }
      });
    });
    [...elements].map(ele => {
      if (ele.dataset.tab !== 'all') {
        eleObserver.observe(ele);
      } else {
        const params = ele.parentNode.querySelector('.lp_profile_tab_input_param');
        const data = {
          ...JSON.parse(params.value),
          status: ele.dataset.tab === 'all' ? '' : ele.dataset.tab || ''
        };
        getResponse(ele, data);
      }
    });
  }
  const changeFilter = () => {
    const tabs = document.querySelectorAll('.learn-press-course-tab-filters');
    tabs.forEach(tab => {
      const filters = tab.querySelectorAll('.learn-press-filters a');
      filters.forEach(filter => {
        filter.addEventListener('click', e => {
          e.preventDefault();
          const tabName = filter.dataset.tab;
          [...filters].map(ele => {
            ele.classList.remove('active');
          });
          filter.classList.add('active');
          [...tab.querySelectorAll('.learn-press-course-tab__filter__content')].map(ele => {
            ele.style.display = 'none';
            if (ele.dataset.tab === tabName) {
              ele.style.display = '';
            }
          });
        });
      });
    });
  };
  changeFilter();
  const viewMore = (ele, dataset) => {
    const viewMoreEle = ele.querySelector('button[data-paged]');
    if (viewMoreEle) {
      viewMoreEle.addEventListener('click', e => {
        e.preventDefault();
        const paged = viewMoreEle && viewMoreEle.dataset.paged;
        viewMoreEle.classList.add('loading');
        const element = dataset.layout === 'list' ? '.lp_profile_course_progress' : '.learn-press-courses';
        getResponse(ele.querySelector(element), {
          ...dataset,
          ...{
            paged
          }
        }, true, viewMoreEle);
      });
    }
  };
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (courseTab);

/***/ }),

/***/ "./assets/src/apps/js/frontend/profile/order-recover.js":
/*!**************************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile/order-recover.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ recoverOrder)
/* harmony export */ });
const $ = window.jQuery;
function recoverOrder() {
  const wrap = $('.order-recover'),
    buttonRecoverOrder = wrap.find('.button-recover-order');
  const ajaxRecover = () => {
    wrap.find('.learn-press-message').remove();
    $('.profile-recover-order').find('.learn-press-message').remove();
    $.post({
      url: '',
      data: wrap.serializeJSON(),
      beforeSend() {
        buttonRecoverOrder.addClass('loading').attr('disabled', 'disabled');
      },
      success(response) {
        response = LP.parseJSON(response);
        if (response.message) {
          const $msg = $('<div class="learn-press-message icon"><i class="fa"></i> ' + response.message + '</div>');
          if (response.result == 'error') {
            $msg.addClass('error');
          }
          wrap.before($msg);
        }
        if (response.redirect) {
          window.location.href = response.redirect;
        }
        buttonRecoverOrder.removeClass('loading').removeAttr('disabled', '');
      },
      error() {
        buttonRecoverOrder.removeClass('loading').removeAttr('disabled', '');
      }
    });
  };
  buttonRecoverOrder.on('click', ajaxRecover);
}
;

/***/ }),

/***/ "./assets/src/apps/js/frontend/profile/statistic.js":
/*!**********************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile/statistic.js ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);


// Rest API load content course progress - Nhamdv.
const courseStatistics = () => {
  const elements = document.querySelector('.learn-press-profile-course__statistic');
  if (!elements) {
    return;
  }
  const tabActive = document.querySelector('.lp-profile-nav-tabs li.active');
  if (!tabActive) {
    return;
  }
  let apiUrl = 'lp/v1/profile/student/statistic';
  if (tabActive.classList.contains('courses')) {
    apiUrl = 'lp/v1/profile/instructor/statistic';
  }
  const getResponse = (ele, dataset) => {
    wp.apiFetch({
      path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)(apiUrl, dataset),
      method: 'GET'
    }).then(response => {
      if (response.status === 'success' && response.data) {
        ele.innerHTML = response.data;
      } else {
        ele.innerHTML = `<div class="lp-ajax-message error" style="display:block">${response.message && response.message}</div>`;
      }
    }).catch(err => {
      console.log(err);
      //ele.innerHTML += `<div class="lp-ajax-message error" style="display:block">${ err.message && err.message }</div>`;
    });
  };
  const elArgStatistic = document.querySelector('[name="args_query_user_courses_statistic"]');
  if (!elArgStatistic) {
    return;
  }
  const data = JSON.parse(elArgStatistic.value);
  getResponse(elements, data);
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (courseStatistics);

/***/ }),

/***/ "./node_modules/normalize-wheel/index.js":
/*!***********************************************!*\
  !*** ./node_modules/normalize-wheel/index.js ***!
  \***********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__(/*! ./src/normalizeWheel.js */ "./node_modules/normalize-wheel/src/normalizeWheel.js");


/***/ }),

/***/ "./node_modules/normalize-wheel/src/ExecutionEnvironment.js":
/*!******************************************************************!*\
  !*** ./node_modules/normalize-wheel/src/ExecutionEnvironment.js ***!
  \******************************************************************/
/***/ ((module) => {

"use strict";
/**
 * Copyright (c) 2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 * @providesModule ExecutionEnvironment
 */

/*jslint evil: true */



var canUseDOM = !!(
  typeof window !== 'undefined' &&
  window.document &&
  window.document.createElement
);

/**
 * Simple, lightweight module assisting with the detection and context of
 * Worker. Helps avoid circular dependencies and allows code to reason about
 * whether or not they are in a Worker, even if they never include the main
 * `ReactWorker` dependency.
 */
var ExecutionEnvironment = {

  canUseDOM: canUseDOM,

  canUseWorkers: typeof Worker !== 'undefined',

  canUseEventListeners:
    canUseDOM && !!(window.addEventListener || window.attachEvent),

  canUseViewport: canUseDOM && !!window.screen,

  isInWorker: !canUseDOM // For now, this is true - might change in the future.

};

module.exports = ExecutionEnvironment;


/***/ }),

/***/ "./node_modules/normalize-wheel/src/UserAgent_DEPRECATED.js":
/*!******************************************************************!*\
  !*** ./node_modules/normalize-wheel/src/UserAgent_DEPRECATED.js ***!
  \******************************************************************/
/***/ ((module) => {

/**
 * Copyright 2004-present Facebook. All Rights Reserved.
 *
 * @providesModule UserAgent_DEPRECATED
 */

/**
 *  Provides entirely client-side User Agent and OS detection. You should prefer
 *  the non-deprecated UserAgent module when possible, which exposes our
 *  authoritative server-side PHP-based detection to the client.
 *
 *  Usage is straightforward:
 *
 *    if (UserAgent_DEPRECATED.ie()) {
 *      //  IE
 *    }
 *
 *  You can also do version checks:
 *
 *    if (UserAgent_DEPRECATED.ie() >= 7) {
 *      //  IE7 or better
 *    }
 *
 *  The browser functions will return NaN if the browser does not match, so
 *  you can also do version compares the other way:
 *
 *    if (UserAgent_DEPRECATED.ie() < 7) {
 *      //  IE6 or worse
 *    }
 *
 *  Note that the version is a float and may include a minor version number,
 *  so you should always use range operators to perform comparisons, not
 *  strict equality.
 *
 *  **Note:** You should **strongly** prefer capability detection to browser
 *  version detection where it's reasonable:
 *
 *    http://www.quirksmode.org/js/support.html
 *
 *  Further, we have a large number of mature wrapper functions and classes
 *  which abstract away many browser irregularities. Check the documentation,
 *  grep for things, or ask on javascript@lists.facebook.com before writing yet
 *  another copy of "event || window.event".
 *
 */

var _populated = false;

// Browsers
var _ie, _firefox, _opera, _webkit, _chrome;

// Actual IE browser for compatibility mode
var _ie_real_version;

// Platforms
var _osx, _windows, _linux, _android;

// Architectures
var _win64;

// Devices
var _iphone, _ipad, _native;

var _mobile;

function _populate() {
  if (_populated) {
    return;
  }

  _populated = true;

  // To work around buggy JS libraries that can't handle multi-digit
  // version numbers, Opera 10's user agent string claims it's Opera
  // 9, then later includes a Version/X.Y field:
  //
  // Opera/9.80 (foo) Presto/2.2.15 Version/10.10
  var uas = navigator.userAgent;
  var agent = /(?:MSIE.(\d+\.\d+))|(?:(?:Firefox|GranParadiso|Iceweasel).(\d+\.\d+))|(?:Opera(?:.+Version.|.)(\d+\.\d+))|(?:AppleWebKit.(\d+(?:\.\d+)?))|(?:Trident\/\d+\.\d+.*rv:(\d+\.\d+))/.exec(uas);
  var os    = /(Mac OS X)|(Windows)|(Linux)/.exec(uas);

  _iphone = /\b(iPhone|iP[ao]d)/.exec(uas);
  _ipad = /\b(iP[ao]d)/.exec(uas);
  _android = /Android/i.exec(uas);
  _native = /FBAN\/\w+;/i.exec(uas);
  _mobile = /Mobile/i.exec(uas);

  // Note that the IE team blog would have you believe you should be checking
  // for 'Win64; x64'.  But MSDN then reveals that you can actually be coming
  // from either x64 or ia64;  so ultimately, you should just check for Win64
  // as in indicator of whether you're in 64-bit IE.  32-bit IE on 64-bit
  // Windows will send 'WOW64' instead.
  _win64 = !!(/Win64/.exec(uas));

  if (agent) {
    _ie = agent[1] ? parseFloat(agent[1]) : (
          agent[5] ? parseFloat(agent[5]) : NaN);
    // IE compatibility mode
    if (_ie && document && document.documentMode) {
      _ie = document.documentMode;
    }
    // grab the "true" ie version from the trident token if available
    var trident = /(?:Trident\/(\d+.\d+))/.exec(uas);
    _ie_real_version = trident ? parseFloat(trident[1]) + 4 : _ie;

    _firefox = agent[2] ? parseFloat(agent[2]) : NaN;
    _opera   = agent[3] ? parseFloat(agent[3]) : NaN;
    _webkit  = agent[4] ? parseFloat(agent[4]) : NaN;
    if (_webkit) {
      // We do not add the regexp to the above test, because it will always
      // match 'safari' only since 'AppleWebKit' appears before 'Chrome' in
      // the userAgent string.
      agent = /(?:Chrome\/(\d+\.\d+))/.exec(uas);
      _chrome = agent && agent[1] ? parseFloat(agent[1]) : NaN;
    } else {
      _chrome = NaN;
    }
  } else {
    _ie = _firefox = _opera = _chrome = _webkit = NaN;
  }

  if (os) {
    if (os[1]) {
      // Detect OS X version.  If no version number matches, set _osx to true.
      // Version examples:  10, 10_6_1, 10.7
      // Parses version number as a float, taking only first two sets of
      // digits.  If only one set of digits is found, returns just the major
      // version number.
      var ver = /(?:Mac OS X (\d+(?:[._]\d+)?))/.exec(uas);

      _osx = ver ? parseFloat(ver[1].replace('_', '.')) : true;
    } else {
      _osx = false;
    }
    _windows = !!os[2];
    _linux   = !!os[3];
  } else {
    _osx = _windows = _linux = false;
  }
}

var UserAgent_DEPRECATED = {

  /**
   *  Check if the UA is Internet Explorer.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  ie: function() {
    return _populate() || _ie;
  },

  /**
   * Check if we're in Internet Explorer compatibility mode.
   *
   * @return bool true if in compatibility mode, false if
   * not compatibility mode or not ie
   */
  ieCompatibilityMode: function() {
    return _populate() || (_ie_real_version > _ie);
  },


  /**
   * Whether the browser is 64-bit IE.  Really, this is kind of weak sauce;  we
   * only need this because Skype can't handle 64-bit IE yet.  We need to remove
   * this when we don't need it -- tracked by #601957.
   */
  ie64: function() {
    return UserAgent_DEPRECATED.ie() && _win64;
  },

  /**
   *  Check if the UA is Firefox.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  firefox: function() {
    return _populate() || _firefox;
  },


  /**
   *  Check if the UA is Opera.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  opera: function() {
    return _populate() || _opera;
  },


  /**
   *  Check if the UA is WebKit.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  webkit: function() {
    return _populate() || _webkit;
  },

  /**
   *  For Push
   *  WILL BE REMOVED VERY SOON. Use UserAgent_DEPRECATED.webkit
   */
  safari: function() {
    return UserAgent_DEPRECATED.webkit();
  },

  /**
   *  Check if the UA is a Chrome browser.
   *
   *
   *  @return float|NaN Version number (if match) or NaN.
   */
  chrome : function() {
    return _populate() || _chrome;
  },


  /**
   *  Check if the user is running Windows.
   *
   *  @return bool `true' if the user's OS is Windows.
   */
  windows: function() {
    return _populate() || _windows;
  },


  /**
   *  Check if the user is running Mac OS X.
   *
   *  @return float|bool   Returns a float if a version number is detected,
   *                       otherwise true/false.
   */
  osx: function() {
    return _populate() || _osx;
  },

  /**
   * Check if the user is running Linux.
   *
   * @return bool `true' if the user's OS is some flavor of Linux.
   */
  linux: function() {
    return _populate() || _linux;
  },

  /**
   * Check if the user is running on an iPhone or iPod platform.
   *
   * @return bool `true' if the user is running some flavor of the
   *    iPhone OS.
   */
  iphone: function() {
    return _populate() || _iphone;
  },

  mobile: function() {
    return _populate() || (_iphone || _ipad || _android || _mobile);
  },

  nativeApp: function() {
    // webviews inside of the native apps
    return _populate() || _native;
  },

  android: function() {
    return _populate() || _android;
  },

  ipad: function() {
    return _populate() || _ipad;
  }
};

module.exports = UserAgent_DEPRECATED;


/***/ }),

/***/ "./node_modules/normalize-wheel/src/isEventSupported.js":
/*!**************************************************************!*\
  !*** ./node_modules/normalize-wheel/src/isEventSupported.js ***!
  \**************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";
/**
 * Copyright 2013-2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 * @providesModule isEventSupported
 */



var ExecutionEnvironment = __webpack_require__(/*! ./ExecutionEnvironment */ "./node_modules/normalize-wheel/src/ExecutionEnvironment.js");

var useHasFeature;
if (ExecutionEnvironment.canUseDOM) {
  useHasFeature =
    document.implementation &&
    document.implementation.hasFeature &&
    // always returns true in newer browsers as per the standard.
    // @see http://dom.spec.whatwg.org/#dom-domimplementation-hasfeature
    document.implementation.hasFeature('', '') !== true;
}

/**
 * Checks if an event is supported in the current execution environment.
 *
 * NOTE: This will not work correctly for non-generic events such as `change`,
 * `reset`, `load`, `error`, and `select`.
 *
 * Borrows from Modernizr.
 *
 * @param {string} eventNameSuffix Event name, e.g. "click".
 * @param {?boolean} capture Check if the capture phase is supported.
 * @return {boolean} True if the event is supported.
 * @internal
 * @license Modernizr 3.0.0pre (Custom Build) | MIT
 */
function isEventSupported(eventNameSuffix, capture) {
  if (!ExecutionEnvironment.canUseDOM ||
      capture && !('addEventListener' in document)) {
    return false;
  }

  var eventName = 'on' + eventNameSuffix;
  var isSupported = eventName in document;

  if (!isSupported) {
    var element = document.createElement('div');
    element.setAttribute(eventName, 'return;');
    isSupported = typeof element[eventName] === 'function';
  }

  if (!isSupported && useHasFeature && eventNameSuffix === 'wheel') {
    // This is the only way to test support for the `wheel` event in IE9+.
    isSupported = document.implementation.hasFeature('Events.wheel', '3.0');
  }

  return isSupported;
}

module.exports = isEventSupported;


/***/ }),

/***/ "./node_modules/normalize-wheel/src/normalizeWheel.js":
/*!************************************************************!*\
  !*** ./node_modules/normalize-wheel/src/normalizeWheel.js ***!
  \************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";
/**
 * Copyright (c) 2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 * @providesModule normalizeWheel
 * @typechecks
 */



var UserAgent_DEPRECATED = __webpack_require__(/*! ./UserAgent_DEPRECATED */ "./node_modules/normalize-wheel/src/UserAgent_DEPRECATED.js");

var isEventSupported = __webpack_require__(/*! ./isEventSupported */ "./node_modules/normalize-wheel/src/isEventSupported.js");


// Reasonable defaults
var PIXEL_STEP  = 10;
var LINE_HEIGHT = 40;
var PAGE_HEIGHT = 800;

/**
 * Mouse wheel (and 2-finger trackpad) support on the web sucks.  It is
 * complicated, thus this doc is long and (hopefully) detailed enough to answer
 * your questions.
 *
 * If you need to react to the mouse wheel in a predictable way, this code is
 * like your bestest friend. * hugs *
 *
 * As of today, there are 4 DOM event types you can listen to:
 *
 *   'wheel'                -- Chrome(31+), FF(17+), IE(9+)
 *   'mousewheel'           -- Chrome, IE(6+), Opera, Safari
 *   'MozMousePixelScroll'  -- FF(3.5 only!) (2010-2013) -- don't bother!
 *   'DOMMouseScroll'       -- FF(0.9.7+) since 2003
 *
 * So what to do?  The is the best:
 *
 *   normalizeWheel.getEventType();
 *
 * In your event callback, use this code to get sane interpretation of the
 * deltas.  This code will return an object with properties:
 *
 *   spinX   -- normalized spin speed (use for zoom) - x plane
 *   spinY   -- " - y plane
 *   pixelX  -- normalized distance (to pixels) - x plane
 *   pixelY  -- " - y plane
 *
 * Wheel values are provided by the browser assuming you are using the wheel to
 * scroll a web page by a number of lines or pixels (or pages).  Values can vary
 * significantly on different platforms and browsers, forgetting that you can
 * scroll at different speeds.  Some devices (like trackpads) emit more events
 * at smaller increments with fine granularity, and some emit massive jumps with
 * linear speed or acceleration.
 *
 * This code does its best to normalize the deltas for you:
 *
 *   - spin is trying to normalize how far the wheel was spun (or trackpad
 *     dragged).  This is super useful for zoom support where you want to
 *     throw away the chunky scroll steps on the PC and make those equal to
 *     the slow and smooth tiny steps on the Mac. Key data: This code tries to
 *     resolve a single slow step on a wheel to 1.
 *
 *   - pixel is normalizing the desired scroll delta in pixel units.  You'll
 *     get the crazy differences between browsers, but at least it'll be in
 *     pixels!
 *
 *   - positive value indicates scrolling DOWN/RIGHT, negative UP/LEFT.  This
 *     should translate to positive value zooming IN, negative zooming OUT.
 *     This matches the newer 'wheel' event.
 *
 * Why are there spinX, spinY (or pixels)?
 *
 *   - spinX is a 2-finger side drag on the trackpad, and a shift + wheel turn
 *     with a mouse.  It results in side-scrolling in the browser by default.
 *
 *   - spinY is what you expect -- it's the classic axis of a mouse wheel.
 *
 *   - I dropped spinZ/pixelZ.  It is supported by the DOM 3 'wheel' event and
 *     probably is by browsers in conjunction with fancy 3D controllers .. but
 *     you know.
 *
 * Implementation info:
 *
 * Examples of 'wheel' event if you scroll slowly (down) by one step with an
 * average mouse:
 *
 *   OS X + Chrome  (mouse)     -    4   pixel delta  (wheelDelta -120)
 *   OS X + Safari  (mouse)     -  N/A   pixel delta  (wheelDelta  -12)
 *   OS X + Firefox (mouse)     -    0.1 line  delta  (wheelDelta  N/A)
 *   Win8 + Chrome  (mouse)     -  100   pixel delta  (wheelDelta -120)
 *   Win8 + Firefox (mouse)     -    3   line  delta  (wheelDelta -120)
 *
 * On the trackpad:
 *
 *   OS X + Chrome  (trackpad)  -    2   pixel delta  (wheelDelta   -6)
 *   OS X + Firefox (trackpad)  -    1   pixel delta  (wheelDelta  N/A)
 *
 * On other/older browsers.. it's more complicated as there can be multiple and
 * also missing delta values.
 *
 * The 'wheel' event is more standard:
 *
 * http://www.w3.org/TR/DOM-Level-3-Events/#events-wheelevents
 *
 * The basics is that it includes a unit, deltaMode (pixels, lines, pages), and
 * deltaX, deltaY and deltaZ.  Some browsers provide other values to maintain
 * backward compatibility with older events.  Those other values help us
 * better normalize spin speed.  Example of what the browsers provide:
 *
 *                          | event.wheelDelta | event.detail
 *        ------------------+------------------+--------------
 *          Safari v5/OS X  |       -120       |       0
 *          Safari v5/Win7  |       -120       |       0
 *         Chrome v17/OS X  |       -120       |       0
 *         Chrome v17/Win7  |       -120       |       0
 *                IE9/Win7  |       -120       |   undefined
 *         Firefox v4/OS X  |     undefined    |       1
 *         Firefox v4/Win7  |     undefined    |       3
 *
 */
function normalizeWheel(/*object*/ event) /*object*/ {
  var sX = 0, sY = 0,       // spinX, spinY
      pX = 0, pY = 0;       // pixelX, pixelY

  // Legacy
  if ('detail'      in event) { sY = event.detail; }
  if ('wheelDelta'  in event) { sY = -event.wheelDelta / 120; }
  if ('wheelDeltaY' in event) { sY = -event.wheelDeltaY / 120; }
  if ('wheelDeltaX' in event) { sX = -event.wheelDeltaX / 120; }

  // side scrolling on FF with DOMMouseScroll
  if ( 'axis' in event && event.axis === event.HORIZONTAL_AXIS ) {
    sX = sY;
    sY = 0;
  }

  pX = sX * PIXEL_STEP;
  pY = sY * PIXEL_STEP;

  if ('deltaY' in event) { pY = event.deltaY; }
  if ('deltaX' in event) { pX = event.deltaX; }

  if ((pX || pY) && event.deltaMode) {
    if (event.deltaMode == 1) {          // delta in LINE units
      pX *= LINE_HEIGHT;
      pY *= LINE_HEIGHT;
    } else {                             // delta in PAGE units
      pX *= PAGE_HEIGHT;
      pY *= PAGE_HEIGHT;
    }
  }

  // Fall-back if spin cannot be determined
  if (pX && !sX) { sX = (pX < 1) ? -1 : 1; }
  if (pY && !sY) { sY = (pY < 1) ? -1 : 1; }

  return { spinX  : sX,
           spinY  : sY,
           pixelX : pX,
           pixelY : pY };
}


/**
 * The best combination if you prefer spinX + spinY normalization.  It favors
 * the older DOMMouseScroll for Firefox, as FF does not include wheelDelta with
 * 'wheel' event, making spin speed determination impossible.
 */
normalizeWheel.getEventType = function() /*string*/ {
  return (UserAgent_DEPRECATED.firefox())
           ? 'DOMMouseScroll'
           : (isEventSupported('wheel'))
               ? 'wheel'
               : 'mousewheel';
};

module.exports = normalizeWheel;


/***/ }),

/***/ "./node_modules/react-easy-crop/index.module.js":
/*!******************************************************!*\
  !*** ./node_modules/react-easy-crop/index.module.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Cropper),
/* harmony export */   getInitialCropFromCroppedAreaPercentages: () => (/* binding */ getInitialCropFromCroppedAreaPercentages),
/* harmony export */   getInitialCropFromCroppedAreaPixels: () => (/* binding */ getInitialCropFromCroppedAreaPixels)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ "./node_modules/react-easy-crop/node_modules/tslib/tslib.es6.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var normalize_wheel__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! normalize-wheel */ "./node_modules/normalize-wheel/index.js");
/* harmony import */ var normalize_wheel__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(normalize_wheel__WEBPACK_IMPORTED_MODULE_1__);




/**
 * Compute the dimension of the crop area based on media size,
 * aspect ratio and optionally rotation
 */
function getCropSize(mediaWidth, mediaHeight, containerWidth, containerHeight, aspect, rotation) {
  if (rotation === void 0) {
    rotation = 0;
  }
  var _a = rotateSize(mediaWidth, mediaHeight, rotation),
    width = _a.width,
    height = _a.height;
  var fittingWidth = Math.min(width, containerWidth);
  var fittingHeight = Math.min(height, containerHeight);
  if (fittingWidth > fittingHeight * aspect) {
    return {
      width: fittingHeight * aspect,
      height: fittingHeight
    };
  }
  return {
    width: fittingWidth,
    height: fittingWidth / aspect
  };
}
/**
 * Compute media zoom.
 * We fit the media into the container with "max-width: 100%; max-height: 100%;"
 */
function getMediaZoom(mediaSize) {
  // Take the axis with more pixels to improve accuracy
  return mediaSize.width > mediaSize.height ? mediaSize.width / mediaSize.naturalWidth : mediaSize.height / mediaSize.naturalHeight;
}
/**
 * Ensure a new media position stays in the crop area.
 */
function restrictPosition(position, mediaSize, cropSize, zoom, rotation) {
  if (rotation === void 0) {
    rotation = 0;
  }
  var _a = rotateSize(mediaSize.width, mediaSize.height, rotation),
    width = _a.width,
    height = _a.height;
  return {
    x: restrictPositionCoord(position.x, width, cropSize.width, zoom),
    y: restrictPositionCoord(position.y, height, cropSize.height, zoom)
  };
}
function restrictPositionCoord(position, mediaSize, cropSize, zoom) {
  var maxPosition = mediaSize * zoom / 2 - cropSize / 2;
  return clamp(position, -maxPosition, maxPosition);
}
function getDistanceBetweenPoints(pointA, pointB) {
  return Math.sqrt(Math.pow(pointA.y - pointB.y, 2) + Math.pow(pointA.x - pointB.x, 2));
}
function getRotationBetweenPoints(pointA, pointB) {
  return Math.atan2(pointB.y - pointA.y, pointB.x - pointA.x) * 180 / Math.PI;
}
/**
 * Compute the output cropped area of the media in percentages and pixels.
 * x/y are the top-left coordinates on the src media
 */
function computeCroppedArea(crop, mediaSize, cropSize, aspect, zoom, rotation, restrictPosition) {
  if (rotation === void 0) {
    rotation = 0;
  }
  if (restrictPosition === void 0) {
    restrictPosition = true;
  }
  // if the media is rotated by the user, we cannot limit the position anymore
  // as it might need to be negative.
  var limitAreaFn = restrictPosition ? limitArea : noOp;
  var mediaBBoxSize = rotateSize(mediaSize.width, mediaSize.height, rotation);
  var mediaNaturalBBoxSize = rotateSize(mediaSize.naturalWidth, mediaSize.naturalHeight, rotation);
  // calculate the crop area in percentages
  // in the rotated space
  var croppedAreaPercentages = {
    x: limitAreaFn(100, ((mediaBBoxSize.width - cropSize.width / zoom) / 2 - crop.x / zoom) / mediaBBoxSize.width * 100),
    y: limitAreaFn(100, ((mediaBBoxSize.height - cropSize.height / zoom) / 2 - crop.y / zoom) / mediaBBoxSize.height * 100),
    width: limitAreaFn(100, cropSize.width / mediaBBoxSize.width * 100 / zoom),
    height: limitAreaFn(100, cropSize.height / mediaBBoxSize.height * 100 / zoom)
  };
  // we compute the pixels size naively
  var widthInPixels = Math.round(limitAreaFn(mediaNaturalBBoxSize.width, croppedAreaPercentages.width * mediaNaturalBBoxSize.width / 100));
  var heightInPixels = Math.round(limitAreaFn(mediaNaturalBBoxSize.height, croppedAreaPercentages.height * mediaNaturalBBoxSize.height / 100));
  var isImgWiderThanHigh = mediaNaturalBBoxSize.width >= mediaNaturalBBoxSize.height * aspect;
  // then we ensure the width and height exactly match the aspect (to avoid rounding approximations)
  // if the media is wider than high, when zoom is 0, the crop height will be equals to image height
  // thus we want to compute the width from the height and aspect for accuracy.
  // Otherwise, we compute the height from width and aspect.
  var sizePixels = isImgWiderThanHigh ? {
    width: Math.round(heightInPixels * aspect),
    height: heightInPixels
  } : {
    width: widthInPixels,
    height: Math.round(widthInPixels / aspect)
  };
  var croppedAreaPixels = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, sizePixels), {
    x: Math.round(limitAreaFn(mediaNaturalBBoxSize.width - sizePixels.width, croppedAreaPercentages.x * mediaNaturalBBoxSize.width / 100)),
    y: Math.round(limitAreaFn(mediaNaturalBBoxSize.height - sizePixels.height, croppedAreaPercentages.y * mediaNaturalBBoxSize.height / 100))
  });
  return {
    croppedAreaPercentages: croppedAreaPercentages,
    croppedAreaPixels: croppedAreaPixels
  };
}
/**
 * Ensure the returned value is between 0 and max
 */
function limitArea(max, value) {
  return Math.min(max, Math.max(0, value));
}
function noOp(_max, value) {
  return value;
}
/**
 * Compute crop and zoom from the croppedAreaPercentages.
 */
function getInitialCropFromCroppedAreaPercentages(croppedAreaPercentages, mediaSize, rotation, cropSize, minZoom, maxZoom) {
  var mediaBBoxSize = rotateSize(mediaSize.width, mediaSize.height, rotation);
  // This is the inverse process of computeCroppedArea
  var zoom = clamp(cropSize.width / mediaBBoxSize.width * (100 / croppedAreaPercentages.width), minZoom, maxZoom);
  var crop = {
    x: zoom * mediaBBoxSize.width / 2 - cropSize.width / 2 - mediaBBoxSize.width * zoom * (croppedAreaPercentages.x / 100),
    y: zoom * mediaBBoxSize.height / 2 - cropSize.height / 2 - mediaBBoxSize.height * zoom * (croppedAreaPercentages.y / 100)
  };
  return {
    crop: crop,
    zoom: zoom
  };
}
/**
 * Compute zoom from the croppedAreaPixels
 */
function getZoomFromCroppedAreaPixels(croppedAreaPixels, mediaSize, cropSize) {
  var mediaZoom = getMediaZoom(mediaSize);
  return cropSize.height > cropSize.width ? cropSize.height / (croppedAreaPixels.height * mediaZoom) : cropSize.width / (croppedAreaPixels.width * mediaZoom);
}
/**
 * Compute crop and zoom from the croppedAreaPixels
 */
function getInitialCropFromCroppedAreaPixels(croppedAreaPixels, mediaSize, rotation, cropSize, minZoom, maxZoom) {
  if (rotation === void 0) {
    rotation = 0;
  }
  var mediaNaturalBBoxSize = rotateSize(mediaSize.naturalWidth, mediaSize.naturalHeight, rotation);
  var zoom = clamp(getZoomFromCroppedAreaPixels(croppedAreaPixels, mediaSize, cropSize), minZoom, maxZoom);
  var cropZoom = cropSize.height > cropSize.width ? cropSize.height / croppedAreaPixels.height : cropSize.width / croppedAreaPixels.width;
  var crop = {
    x: ((mediaNaturalBBoxSize.width - croppedAreaPixels.width) / 2 - croppedAreaPixels.x) * cropZoom,
    y: ((mediaNaturalBBoxSize.height - croppedAreaPixels.height) / 2 - croppedAreaPixels.y) * cropZoom
  };
  return {
    crop: crop,
    zoom: zoom
  };
}
/**
 * Return the point that is the center of point a and b
 */
function getCenter(a, b) {
  return {
    x: (b.x + a.x) / 2,
    y: (b.y + a.y) / 2
  };
}
function getRadianAngle(degreeValue) {
  return degreeValue * Math.PI / 180;
}
/**
 * Returns the new bounding area of a rotated rectangle.
 */
function rotateSize(width, height, rotation) {
  var rotRad = getRadianAngle(rotation);
  return {
    width: Math.abs(Math.cos(rotRad) * width) + Math.abs(Math.sin(rotRad) * height),
    height: Math.abs(Math.sin(rotRad) * width) + Math.abs(Math.cos(rotRad) * height)
  };
}
/**
 * Clamp value between min and max
 */
function clamp(value, min, max) {
  return Math.min(Math.max(value, min), max);
}
/**
 * Combine multiple class names into a single string.
 */
function classNames() {
  var args = [];
  for (var _i = 0; _i < arguments.length; _i++) {
    args[_i] = arguments[_i];
  }
  return args.filter(function (value) {
    if (typeof value === 'string' && value.length > 0) {
      return true;
    }
    return false;
  }).join(' ').trim();
}

var css_248z = ".reactEasyCrop_Container {\n  position: absolute;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  overflow: hidden;\n  user-select: none;\n  touch-action: none;\n  cursor: move;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n\n.reactEasyCrop_Image,\n.reactEasyCrop_Video {\n  will-change: transform; /* this improves performances and prevent painting issues on iOS Chrome */\n}\n\n.reactEasyCrop_Contain {\n  max-width: 100%;\n  max-height: 100%;\n  margin: auto;\n  position: absolute;\n  top: 0;\n  bottom: 0;\n  left: 0;\n  right: 0;\n}\n.reactEasyCrop_Cover_Horizontal {\n  width: 100%;\n  height: auto;\n}\n.reactEasyCrop_Cover_Vertical {\n  width: auto;\n  height: 100%;\n}\n\n.reactEasyCrop_CropArea {\n  position: absolute;\n  left: 50%;\n  top: 50%;\n  transform: translate(-50%, -50%);\n  border: 1px solid rgba(255, 255, 255, 0.5);\n  box-sizing: border-box;\n  box-shadow: 0 0 0 9999em;\n  color: rgba(0, 0, 0, 0.5);\n  overflow: hidden;\n}\n\n.reactEasyCrop_CropAreaRound {\n  border-radius: 50%;\n}\n\n.reactEasyCrop_CropAreaGrid::before {\n  content: ' ';\n  box-sizing: border-box;\n  position: absolute;\n  border: 1px solid rgba(255, 255, 255, 0.5);\n  top: 0;\n  bottom: 0;\n  left: 33.33%;\n  right: 33.33%;\n  border-top: 0;\n  border-bottom: 0;\n}\n\n.reactEasyCrop_CropAreaGrid::after {\n  content: ' ';\n  box-sizing: border-box;\n  position: absolute;\n  border: 1px solid rgba(255, 255, 255, 0.5);\n  top: 33.33%;\n  bottom: 33.33%;\n  left: 0;\n  right: 0;\n  border-left: 0;\n  border-right: 0;\n}\n";

var MIN_ZOOM = 1;
var MAX_ZOOM = 3;
var Cropper = /** @class */function (_super) {
  (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(Cropper, _super);
  function Cropper() {
    var _this = _super !== null && _super.apply(this, arguments) || this;
    _this.imageRef = react__WEBPACK_IMPORTED_MODULE_0___default().createRef();
    _this.videoRef = react__WEBPACK_IMPORTED_MODULE_0___default().createRef();
    _this.containerRef = null;
    _this.styleRef = null;
    _this.containerRect = null;
    _this.mediaSize = {
      width: 0,
      height: 0,
      naturalWidth: 0,
      naturalHeight: 0
    };
    _this.dragStartPosition = {
      x: 0,
      y: 0
    };
    _this.dragStartCrop = {
      x: 0,
      y: 0
    };
    _this.gestureZoomStart = 0;
    _this.gestureRotationStart = 0;
    _this.isTouching = false;
    _this.lastPinchDistance = 0;
    _this.lastPinchRotation = 0;
    _this.rafDragTimeout = null;
    _this.rafPinchTimeout = null;
    _this.wheelTimer = null;
    _this.currentDoc = typeof document !== 'undefined' ? document : null;
    _this.currentWindow = typeof window !== 'undefined' ? window : null;
    _this.resizeObserver = null;
    _this.state = {
      cropSize: null,
      hasWheelJustStarted: false
    };
    _this.initResizeObserver = function () {
      if (typeof window.ResizeObserver === 'undefined' || !_this.containerRef) {
        return;
      }
      var isFirstResize = true;
      _this.resizeObserver = new window.ResizeObserver(function (entries) {
        if (isFirstResize) {
          isFirstResize = false; // observe() is called on mount, we don't want to trigger a recompute on mount
          return;
        }
        _this.computeSizes();
      });
      _this.resizeObserver.observe(_this.containerRef);
    };
    // this is to prevent Safari on iOS >= 10 to zoom the page
    _this.preventZoomSafari = function (e) {
      return e.preventDefault();
    };
    _this.cleanEvents = function () {
      if (!_this.currentDoc) return;
      _this.currentDoc.removeEventListener('mousemove', _this.onMouseMove);
      _this.currentDoc.removeEventListener('mouseup', _this.onDragStopped);
      _this.currentDoc.removeEventListener('touchmove', _this.onTouchMove);
      _this.currentDoc.removeEventListener('touchend', _this.onDragStopped);
      _this.currentDoc.removeEventListener('gesturemove', _this.onGestureMove);
      _this.currentDoc.removeEventListener('gestureend', _this.onGestureEnd);
    };
    _this.clearScrollEvent = function () {
      if (_this.containerRef) _this.containerRef.removeEventListener('wheel', _this.onWheel);
      if (_this.wheelTimer) {
        clearTimeout(_this.wheelTimer);
      }
    };
    _this.onMediaLoad = function () {
      var cropSize = _this.computeSizes();
      if (cropSize) {
        _this.emitCropData();
        _this.setInitialCrop(cropSize);
      }
      if (_this.props.onMediaLoaded) {
        _this.props.onMediaLoaded(_this.mediaSize);
      }
    };
    _this.setInitialCrop = function (cropSize) {
      if (_this.props.initialCroppedAreaPercentages) {
        var _a = getInitialCropFromCroppedAreaPercentages(_this.props.initialCroppedAreaPercentages, _this.mediaSize, _this.props.rotation, cropSize, _this.props.minZoom, _this.props.maxZoom),
          crop = _a.crop,
          zoom = _a.zoom;
        _this.props.onCropChange(crop);
        _this.props.onZoomChange && _this.props.onZoomChange(zoom);
      } else if (_this.props.initialCroppedAreaPixels) {
        var _b = getInitialCropFromCroppedAreaPixels(_this.props.initialCroppedAreaPixels, _this.mediaSize, _this.props.rotation, cropSize, _this.props.minZoom, _this.props.maxZoom),
          crop = _b.crop,
          zoom = _b.zoom;
        _this.props.onCropChange(crop);
        _this.props.onZoomChange && _this.props.onZoomChange(zoom);
      }
    };
    _this.computeSizes = function () {
      var _a, _b, _c, _d, _e, _f;
      var mediaRef = _this.imageRef.current || _this.videoRef.current;
      if (mediaRef && _this.containerRef) {
        _this.containerRect = _this.containerRef.getBoundingClientRect();
        var containerAspect = _this.containerRect.width / _this.containerRect.height;
        var naturalWidth = ((_a = _this.imageRef.current) === null || _a === void 0 ? void 0 : _a.naturalWidth) || ((_b = _this.videoRef.current) === null || _b === void 0 ? void 0 : _b.videoWidth) || 0;
        var naturalHeight = ((_c = _this.imageRef.current) === null || _c === void 0 ? void 0 : _c.naturalHeight) || ((_d = _this.videoRef.current) === null || _d === void 0 ? void 0 : _d.videoHeight) || 0;
        var isMediaScaledDown = mediaRef.offsetWidth < naturalWidth || mediaRef.offsetHeight < naturalHeight;
        var mediaAspect = naturalWidth / naturalHeight;
        // We do not rely on the offsetWidth/offsetHeight if the media is scaled down
        // as the values they report are rounded. That will result in precision losses
        // when calculating zoom. We use the fact that the media is positionned relative
        // to the container. That allows us to use the container's dimensions
        // and natural aspect ratio of the media to calculate accurate media size.
        // However, for this to work, the container should not be rotated
        var renderedMediaSize = void 0;
        if (isMediaScaledDown) {
          switch (_this.props.objectFit) {
            default:
            case 'contain':
              renderedMediaSize = containerAspect > mediaAspect ? {
                width: _this.containerRect.height * mediaAspect,
                height: _this.containerRect.height
              } : {
                width: _this.containerRect.width,
                height: _this.containerRect.width / mediaAspect
              };
              break;
            case 'horizontal-cover':
              renderedMediaSize = {
                width: _this.containerRect.width,
                height: _this.containerRect.width / mediaAspect
              };
              break;
            case 'vertical-cover':
              renderedMediaSize = {
                width: _this.containerRect.height * mediaAspect,
                height: _this.containerRect.height
              };
              break;
            case 'auto-cover':
              renderedMediaSize = naturalWidth > naturalHeight ? {
                width: _this.containerRect.width,
                height: _this.containerRect.width / mediaAspect
              } : {
                width: _this.containerRect.height * mediaAspect,
                height: _this.containerRect.height
              };
              break;
          }
        } else {
          renderedMediaSize = {
            width: mediaRef.offsetWidth,
            height: mediaRef.offsetHeight
          };
        }
        _this.mediaSize = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, renderedMediaSize), {
          naturalWidth: naturalWidth,
          naturalHeight: naturalHeight
        });
        // set media size in the parent
        if (_this.props.setMediaSize) {
          _this.props.setMediaSize(_this.mediaSize);
        }
        var cropSize = _this.props.cropSize ? _this.props.cropSize : getCropSize(_this.mediaSize.width, _this.mediaSize.height, _this.containerRect.width, _this.containerRect.height, _this.props.aspect, _this.props.rotation);
        if (((_e = _this.state.cropSize) === null || _e === void 0 ? void 0 : _e.height) !== cropSize.height || ((_f = _this.state.cropSize) === null || _f === void 0 ? void 0 : _f.width) !== cropSize.width) {
          _this.props.onCropSizeChange && _this.props.onCropSizeChange(cropSize);
        }
        _this.setState({
          cropSize: cropSize
        }, _this.recomputeCropPosition);
        // pass crop size to parent
        if (_this.props.setCropSize) {
          _this.props.setCropSize(cropSize);
        }
        return cropSize;
      }
    };
    _this.onMouseDown = function (e) {
      if (!_this.currentDoc) return;
      e.preventDefault();
      _this.currentDoc.addEventListener('mousemove', _this.onMouseMove);
      _this.currentDoc.addEventListener('mouseup', _this.onDragStopped);
      _this.onDragStart(Cropper.getMousePoint(e));
    };
    _this.onMouseMove = function (e) {
      return _this.onDrag(Cropper.getMousePoint(e));
    };
    _this.onTouchStart = function (e) {
      if (!_this.currentDoc) return;
      _this.isTouching = true;
      if (_this.props.onTouchRequest && !_this.props.onTouchRequest(e)) {
        return;
      }
      _this.currentDoc.addEventListener('touchmove', _this.onTouchMove, {
        passive: false
      }); // iOS 11 now defaults to passive: true
      _this.currentDoc.addEventListener('touchend', _this.onDragStopped);
      if (e.touches.length === 2) {
        _this.onPinchStart(e);
      } else if (e.touches.length === 1) {
        _this.onDragStart(Cropper.getTouchPoint(e.touches[0]));
      }
    };
    _this.onTouchMove = function (e) {
      // Prevent whole page from scrolling on iOS.
      e.preventDefault();
      if (e.touches.length === 2) {
        _this.onPinchMove(e);
      } else if (e.touches.length === 1) {
        _this.onDrag(Cropper.getTouchPoint(e.touches[0]));
      }
    };
    _this.onGestureStart = function (e) {
      if (!_this.currentDoc) return;
      e.preventDefault();
      _this.currentDoc.addEventListener('gesturechange', _this.onGestureMove);
      _this.currentDoc.addEventListener('gestureend', _this.onGestureEnd);
      _this.gestureZoomStart = _this.props.zoom;
      _this.gestureRotationStart = _this.props.rotation;
    };
    _this.onGestureMove = function (e) {
      e.preventDefault();
      if (_this.isTouching) {
        // this is to avoid conflict between gesture and touch events
        return;
      }
      var point = Cropper.getMousePoint(e);
      var newZoom = _this.gestureZoomStart - 1 + e.scale;
      _this.setNewZoom(newZoom, point, {
        shouldUpdatePosition: true
      });
      if (_this.props.onRotationChange) {
        var newRotation = _this.gestureRotationStart + e.rotation;
        _this.props.onRotationChange(newRotation);
      }
    };
    _this.onGestureEnd = function (e) {
      _this.cleanEvents();
    };
    _this.onDragStart = function (_a) {
      var _b, _c;
      var x = _a.x,
        y = _a.y;
      _this.dragStartPosition = {
        x: x,
        y: y
      };
      _this.dragStartCrop = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, _this.props.crop);
      (_c = (_b = _this.props).onInteractionStart) === null || _c === void 0 ? void 0 : _c.call(_b);
    };
    _this.onDrag = function (_a) {
      var x = _a.x,
        y = _a.y;
      if (!_this.currentWindow) return;
      if (_this.rafDragTimeout) _this.currentWindow.cancelAnimationFrame(_this.rafDragTimeout);
      _this.rafDragTimeout = _this.currentWindow.requestAnimationFrame(function () {
        if (!_this.state.cropSize) return;
        if (x === undefined || y === undefined) return;
        var offsetX = x - _this.dragStartPosition.x;
        var offsetY = y - _this.dragStartPosition.y;
        var requestedPosition = {
          x: _this.dragStartCrop.x + offsetX,
          y: _this.dragStartCrop.y + offsetY
        };
        var newPosition = _this.props.restrictPosition ? restrictPosition(requestedPosition, _this.mediaSize, _this.state.cropSize, _this.props.zoom, _this.props.rotation) : requestedPosition;
        _this.props.onCropChange(newPosition);
      });
    };
    _this.onDragStopped = function () {
      var _a, _b;
      _this.isTouching = false;
      _this.cleanEvents();
      _this.emitCropData();
      (_b = (_a = _this.props).onInteractionEnd) === null || _b === void 0 ? void 0 : _b.call(_a);
    };
    _this.onWheel = function (e) {
      if (!_this.currentWindow) return;
      if (_this.props.onWheelRequest && !_this.props.onWheelRequest(e)) {
        return;
      }
      e.preventDefault();
      var point = Cropper.getMousePoint(e);
      var pixelY = normalize_wheel__WEBPACK_IMPORTED_MODULE_1___default()(e).pixelY;
      var newZoom = _this.props.zoom - pixelY * _this.props.zoomSpeed / 200;
      _this.setNewZoom(newZoom, point, {
        shouldUpdatePosition: true
      });
      if (!_this.state.hasWheelJustStarted) {
        _this.setState({
          hasWheelJustStarted: true
        }, function () {
          var _a, _b;
          return (_b = (_a = _this.props).onInteractionStart) === null || _b === void 0 ? void 0 : _b.call(_a);
        });
      }
      if (_this.wheelTimer) {
        clearTimeout(_this.wheelTimer);
      }
      _this.wheelTimer = _this.currentWindow.setTimeout(function () {
        return _this.setState({
          hasWheelJustStarted: false
        }, function () {
          var _a, _b;
          return (_b = (_a = _this.props).onInteractionEnd) === null || _b === void 0 ? void 0 : _b.call(_a);
        });
      }, 250);
    };
    _this.getPointOnContainer = function (_a) {
      var x = _a.x,
        y = _a.y;
      if (!_this.containerRect) {
        throw new Error('The Cropper is not mounted');
      }
      return {
        x: _this.containerRect.width / 2 - (x - _this.containerRect.left),
        y: _this.containerRect.height / 2 - (y - _this.containerRect.top)
      };
    };
    _this.getPointOnMedia = function (_a) {
      var x = _a.x,
        y = _a.y;
      var _b = _this.props,
        crop = _b.crop,
        zoom = _b.zoom;
      return {
        x: (x + crop.x) / zoom,
        y: (y + crop.y) / zoom
      };
    };
    _this.setNewZoom = function (zoom, point, _a) {
      var _b = _a === void 0 ? {} : _a,
        _c = _b.shouldUpdatePosition,
        shouldUpdatePosition = _c === void 0 ? true : _c;
      if (!_this.state.cropSize || !_this.props.onZoomChange) return;
      var newZoom = clamp(zoom, _this.props.minZoom, _this.props.maxZoom);
      if (shouldUpdatePosition) {
        var zoomPoint = _this.getPointOnContainer(point);
        var zoomTarget = _this.getPointOnMedia(zoomPoint);
        var requestedPosition = {
          x: zoomTarget.x * newZoom - zoomPoint.x,
          y: zoomTarget.y * newZoom - zoomPoint.y
        };
        var newPosition = _this.props.restrictPosition ? restrictPosition(requestedPosition, _this.mediaSize, _this.state.cropSize, newZoom, _this.props.rotation) : requestedPosition;
        _this.props.onCropChange(newPosition);
      }
      _this.props.onZoomChange(newZoom);
    };
    _this.getCropData = function () {
      if (!_this.state.cropSize) {
        return null;
      }
      // this is to ensure the crop is correctly restricted after a zoom back (https://github.com/ValentinH/react-easy-crop/issues/6)
      var restrictedPosition = _this.props.restrictPosition ? restrictPosition(_this.props.crop, _this.mediaSize, _this.state.cropSize, _this.props.zoom, _this.props.rotation) : _this.props.crop;
      return computeCroppedArea(restrictedPosition, _this.mediaSize, _this.state.cropSize, _this.getAspect(), _this.props.zoom, _this.props.rotation, _this.props.restrictPosition);
    };
    _this.emitCropData = function () {
      var cropData = _this.getCropData();
      if (!cropData) return;
      var croppedAreaPercentages = cropData.croppedAreaPercentages,
        croppedAreaPixels = cropData.croppedAreaPixels;
      if (_this.props.onCropComplete) {
        _this.props.onCropComplete(croppedAreaPercentages, croppedAreaPixels);
      }
      if (_this.props.onCropAreaChange) {
        _this.props.onCropAreaChange(croppedAreaPercentages, croppedAreaPixels);
      }
    };
    _this.emitCropAreaChange = function () {
      var cropData = _this.getCropData();
      if (!cropData) return;
      var croppedAreaPercentages = cropData.croppedAreaPercentages,
        croppedAreaPixels = cropData.croppedAreaPixels;
      if (_this.props.onCropAreaChange) {
        _this.props.onCropAreaChange(croppedAreaPercentages, croppedAreaPixels);
      }
    };
    _this.recomputeCropPosition = function () {
      if (!_this.state.cropSize) return;
      var newPosition = _this.props.restrictPosition ? restrictPosition(_this.props.crop, _this.mediaSize, _this.state.cropSize, _this.props.zoom, _this.props.rotation) : _this.props.crop;
      _this.props.onCropChange(newPosition);
      _this.emitCropData();
    };
    return _this;
  }
  Cropper.prototype.componentDidMount = function () {
    if (!this.currentDoc || !this.currentWindow) return;
    if (this.containerRef) {
      if (this.containerRef.ownerDocument) {
        this.currentDoc = this.containerRef.ownerDocument;
      }
      if (this.currentDoc.defaultView) {
        this.currentWindow = this.currentDoc.defaultView;
      }
      this.initResizeObserver();
      // only add window resize listener if ResizeObserver is not supported. Otherwise, it would be redundant
      if (typeof window.ResizeObserver === 'undefined') {
        this.currentWindow.addEventListener('resize', this.computeSizes);
      }
      this.props.zoomWithScroll && this.containerRef.addEventListener('wheel', this.onWheel, {
        passive: false
      });
      this.containerRef.addEventListener('gesturestart', this.onGestureStart);
    }
    if (!this.props.disableAutomaticStylesInjection) {
      this.styleRef = this.currentDoc.createElement('style');
      this.styleRef.setAttribute('type', 'text/css');
      if (this.props.nonce) {
        this.styleRef.setAttribute('nonce', this.props.nonce);
      }
      this.styleRef.innerHTML = css_248z;
      this.currentDoc.head.appendChild(this.styleRef);
    }
    // when rendered via SSR, the image can already be loaded and its onLoad callback will never be called
    if (this.imageRef.current && this.imageRef.current.complete) {
      this.onMediaLoad();
    }
    // set image and video refs in the parent if the callbacks exist
    if (this.props.setImageRef) {
      this.props.setImageRef(this.imageRef);
    }
    if (this.props.setVideoRef) {
      this.props.setVideoRef(this.videoRef);
    }
  };
  Cropper.prototype.componentWillUnmount = function () {
    var _a, _b;
    if (!this.currentDoc || !this.currentWindow) return;
    if (typeof window.ResizeObserver === 'undefined') {
      this.currentWindow.removeEventListener('resize', this.computeSizes);
    }
    (_a = this.resizeObserver) === null || _a === void 0 ? void 0 : _a.disconnect();
    if (this.containerRef) {
      this.containerRef.removeEventListener('gesturestart', this.preventZoomSafari);
    }
    if (this.styleRef) {
      (_b = this.styleRef.parentNode) === null || _b === void 0 ? void 0 : _b.removeChild(this.styleRef);
    }
    this.cleanEvents();
    this.props.zoomWithScroll && this.clearScrollEvent();
  };
  Cropper.prototype.componentDidUpdate = function (prevProps) {
    var _a, _b, _c, _d, _e, _f, _g, _h, _j;
    if (prevProps.rotation !== this.props.rotation) {
      this.computeSizes();
      this.recomputeCropPosition();
    } else if (prevProps.aspect !== this.props.aspect) {
      this.computeSizes();
    } else if (prevProps.zoom !== this.props.zoom) {
      this.recomputeCropPosition();
    } else if (((_a = prevProps.cropSize) === null || _a === void 0 ? void 0 : _a.height) !== ((_b = this.props.cropSize) === null || _b === void 0 ? void 0 : _b.height) || ((_c = prevProps.cropSize) === null || _c === void 0 ? void 0 : _c.width) !== ((_d = this.props.cropSize) === null || _d === void 0 ? void 0 : _d.width)) {
      this.computeSizes();
    } else if (((_e = prevProps.crop) === null || _e === void 0 ? void 0 : _e.x) !== ((_f = this.props.crop) === null || _f === void 0 ? void 0 : _f.x) || ((_g = prevProps.crop) === null || _g === void 0 ? void 0 : _g.y) !== ((_h = this.props.crop) === null || _h === void 0 ? void 0 : _h.y)) {
      this.emitCropAreaChange();
    }
    if (prevProps.zoomWithScroll !== this.props.zoomWithScroll && this.containerRef) {
      this.props.zoomWithScroll ? this.containerRef.addEventListener('wheel', this.onWheel, {
        passive: false
      }) : this.clearScrollEvent();
    }
    if (prevProps.video !== this.props.video) {
      (_j = this.videoRef.current) === null || _j === void 0 ? void 0 : _j.load();
    }
  };
  Cropper.prototype.getAspect = function () {
    var _a = this.props,
      cropSize = _a.cropSize,
      aspect = _a.aspect;
    if (cropSize) {
      return cropSize.width / cropSize.height;
    }
    return aspect;
  };
  Cropper.prototype.onPinchStart = function (e) {
    var pointA = Cropper.getTouchPoint(e.touches[0]);
    var pointB = Cropper.getTouchPoint(e.touches[1]);
    this.lastPinchDistance = getDistanceBetweenPoints(pointA, pointB);
    this.lastPinchRotation = getRotationBetweenPoints(pointA, pointB);
    this.onDragStart(getCenter(pointA, pointB));
  };
  Cropper.prototype.onPinchMove = function (e) {
    var _this = this;
    if (!this.currentDoc || !this.currentWindow) return;
    var pointA = Cropper.getTouchPoint(e.touches[0]);
    var pointB = Cropper.getTouchPoint(e.touches[1]);
    var center = getCenter(pointA, pointB);
    this.onDrag(center);
    if (this.rafPinchTimeout) this.currentWindow.cancelAnimationFrame(this.rafPinchTimeout);
    this.rafPinchTimeout = this.currentWindow.requestAnimationFrame(function () {
      var distance = getDistanceBetweenPoints(pointA, pointB);
      var newZoom = _this.props.zoom * (distance / _this.lastPinchDistance);
      _this.setNewZoom(newZoom, center, {
        shouldUpdatePosition: false
      });
      _this.lastPinchDistance = distance;
      var rotation = getRotationBetweenPoints(pointA, pointB);
      var newRotation = _this.props.rotation + (rotation - _this.lastPinchRotation);
      _this.props.onRotationChange && _this.props.onRotationChange(newRotation);
      _this.lastPinchRotation = rotation;
    });
  };
  Cropper.prototype.render = function () {
    var _this = this;
    var _a = this.props,
      image = _a.image,
      video = _a.video,
      mediaProps = _a.mediaProps,
      transform = _a.transform,
      _b = _a.crop,
      x = _b.x,
      y = _b.y,
      rotation = _a.rotation,
      zoom = _a.zoom,
      cropShape = _a.cropShape,
      showGrid = _a.showGrid,
      _c = _a.style,
      containerStyle = _c.containerStyle,
      cropAreaStyle = _c.cropAreaStyle,
      mediaStyle = _c.mediaStyle,
      _d = _a.classes,
      containerClassName = _d.containerClassName,
      cropAreaClassName = _d.cropAreaClassName,
      mediaClassName = _d.mediaClassName,
      objectFit = _a.objectFit;
    return react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
      onMouseDown: this.onMouseDown,
      onTouchStart: this.onTouchStart,
      ref: function ref(el) {
        return _this.containerRef = el;
      },
      "data-testid": "container",
      style: containerStyle,
      className: classNames('reactEasyCrop_Container', containerClassName)
    }, image ? react__WEBPACK_IMPORTED_MODULE_0___default().createElement("img", (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({
      alt: "",
      className: classNames('reactEasyCrop_Image', objectFit === 'contain' && 'reactEasyCrop_Contain', objectFit === 'horizontal-cover' && 'reactEasyCrop_Cover_Horizontal', objectFit === 'vertical-cover' && 'reactEasyCrop_Cover_Vertical', objectFit === 'auto-cover' && (this.mediaSize.naturalWidth > this.mediaSize.naturalHeight ? 'reactEasyCrop_Cover_Horizontal' : 'reactEasyCrop_Cover_Vertical'), mediaClassName)
    }, mediaProps, {
      src: image,
      ref: this.imageRef,
      style: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, mediaStyle), {
        transform: transform || "translate(".concat(x, "px, ").concat(y, "px) rotate(").concat(rotation, "deg) scale(").concat(zoom, ")")
      }),
      onLoad: this.onMediaLoad
    })) : video && react__WEBPACK_IMPORTED_MODULE_0___default().createElement("video", (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({
      autoPlay: true,
      loop: true,
      muted: true,
      className: classNames('reactEasyCrop_Video', objectFit === 'contain' && 'reactEasyCrop_Contain', objectFit === 'horizontal-cover' && 'reactEasyCrop_Cover_Horizontal', objectFit === 'vertical-cover' && 'reactEasyCrop_Cover_Vertical', objectFit === 'auto-cover' && (this.mediaSize.naturalWidth > this.mediaSize.naturalHeight ? 'reactEasyCrop_Cover_Horizontal' : 'reactEasyCrop_Cover_Vertical'), mediaClassName)
    }, mediaProps, {
      ref: this.videoRef,
      onLoadedMetadata: this.onMediaLoad,
      style: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, mediaStyle), {
        transform: transform || "translate(".concat(x, "px, ").concat(y, "px) rotate(").concat(rotation, "deg) scale(").concat(zoom, ")")
      }),
      controls: false
    }), (Array.isArray(video) ? video : [{
      src: video
    }]).map(function (item) {
      return react__WEBPACK_IMPORTED_MODULE_0___default().createElement("source", (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({
        key: item.src
      }, item));
    })), this.state.cropSize && react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
      style: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, cropAreaStyle), {
        width: this.state.cropSize.width,
        height: this.state.cropSize.height
      }),
      "data-testid": "cropper",
      className: classNames('reactEasyCrop_CropArea', cropShape === 'round' && 'reactEasyCrop_CropAreaRound', showGrid && 'reactEasyCrop_CropAreaGrid', cropAreaClassName)
    }));
  };
  Cropper.defaultProps = {
    zoom: 1,
    rotation: 0,
    aspect: 4 / 3,
    maxZoom: MAX_ZOOM,
    minZoom: MIN_ZOOM,
    cropShape: 'rect',
    objectFit: 'contain',
    showGrid: true,
    style: {},
    classes: {},
    mediaProps: {},
    zoomSpeed: 1,
    restrictPosition: true,
    zoomWithScroll: true
  };
  Cropper.getMousePoint = function (e) {
    return {
      x: Number(e.clientX),
      y: Number(e.clientY)
    };
  };
  Cropper.getTouchPoint = function (touch) {
    return {
      x: Number(touch.clientX),
      y: Number(touch.clientY)
    };
  };
  return Cropper;
}((react__WEBPACK_IMPORTED_MODULE_0___default().Component));


//# sourceMappingURL=index.module.js.map


/***/ }),

/***/ "./node_modules/react-easy-crop/node_modules/tslib/tslib.es6.js":
/*!**********************************************************************!*\
  !*** ./node_modules/react-easy-crop/node_modules/tslib/tslib.es6.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   __assign: () => (/* binding */ __assign),
/* harmony export */   __asyncDelegator: () => (/* binding */ __asyncDelegator),
/* harmony export */   __asyncGenerator: () => (/* binding */ __asyncGenerator),
/* harmony export */   __asyncValues: () => (/* binding */ __asyncValues),
/* harmony export */   __await: () => (/* binding */ __await),
/* harmony export */   __awaiter: () => (/* binding */ __awaiter),
/* harmony export */   __classPrivateFieldGet: () => (/* binding */ __classPrivateFieldGet),
/* harmony export */   __classPrivateFieldSet: () => (/* binding */ __classPrivateFieldSet),
/* harmony export */   __createBinding: () => (/* binding */ __createBinding),
/* harmony export */   __decorate: () => (/* binding */ __decorate),
/* harmony export */   __exportStar: () => (/* binding */ __exportStar),
/* harmony export */   __extends: () => (/* binding */ __extends),
/* harmony export */   __generator: () => (/* binding */ __generator),
/* harmony export */   __importDefault: () => (/* binding */ __importDefault),
/* harmony export */   __importStar: () => (/* binding */ __importStar),
/* harmony export */   __makeTemplateObject: () => (/* binding */ __makeTemplateObject),
/* harmony export */   __metadata: () => (/* binding */ __metadata),
/* harmony export */   __param: () => (/* binding */ __param),
/* harmony export */   __read: () => (/* binding */ __read),
/* harmony export */   __rest: () => (/* binding */ __rest),
/* harmony export */   __spread: () => (/* binding */ __spread),
/* harmony export */   __spreadArrays: () => (/* binding */ __spreadArrays),
/* harmony export */   __values: () => (/* binding */ __values)
/* harmony export */ });
/*! *****************************************************************************
Copyright (c) Microsoft Corporation.

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
***************************************************************************** */
/* global Reflect, Promise */

var extendStatics = function(d, b) {
    extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
    return extendStatics(d, b);
};

function __extends(d, b) {
    extendStatics(d, b);
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
}

var __assign = function() {
    __assign = Object.assign || function __assign(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
        }
        return t;
    }
    return __assign.apply(this, arguments);
}

function __rest(s, e) {
    var t = {};
    for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p) && e.indexOf(p) < 0)
        t[p] = s[p];
    if (s != null && typeof Object.getOwnPropertySymbols === "function")
        for (var i = 0, p = Object.getOwnPropertySymbols(s); i < p.length; i++) {
            if (e.indexOf(p[i]) < 0 && Object.prototype.propertyIsEnumerable.call(s, p[i]))
                t[p[i]] = s[p[i]];
        }
    return t;
}

function __decorate(decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
}

function __param(paramIndex, decorator) {
    return function (target, key) { decorator(target, key, paramIndex); }
}

function __metadata(metadataKey, metadataValue) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(metadataKey, metadataValue);
}

function __awaiter(thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
}

function __generator(thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
}

var __createBinding = Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
});

function __exportStar(m, o) {
    for (var p in m) if (p !== "default" && !Object.prototype.hasOwnProperty.call(o, p)) __createBinding(o, m, p);
}

function __values(o) {
    var s = typeof Symbol === "function" && Symbol.iterator, m = s && o[s], i = 0;
    if (m) return m.call(o);
    if (o && typeof o.length === "number") return {
        next: function () {
            if (o && i >= o.length) o = void 0;
            return { value: o && o[i++], done: !o };
        }
    };
    throw new TypeError(s ? "Object is not iterable." : "Symbol.iterator is not defined.");
}

function __read(o, n) {
    var m = typeof Symbol === "function" && o[Symbol.iterator];
    if (!m) return o;
    var i = m.call(o), r, ar = [], e;
    try {
        while ((n === void 0 || n-- > 0) && !(r = i.next()).done) ar.push(r.value);
    }
    catch (error) { e = { error: error }; }
    finally {
        try {
            if (r && !r.done && (m = i["return"])) m.call(i);
        }
        finally { if (e) throw e.error; }
    }
    return ar;
}

function __spread() {
    for (var ar = [], i = 0; i < arguments.length; i++)
        ar = ar.concat(__read(arguments[i]));
    return ar;
}

function __spreadArrays() {
    for (var s = 0, i = 0, il = arguments.length; i < il; i++) s += arguments[i].length;
    for (var r = Array(s), k = 0, i = 0; i < il; i++)
        for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++)
            r[k] = a[j];
    return r;
};

function __await(v) {
    return this instanceof __await ? (this.v = v, this) : new __await(v);
}

function __asyncGenerator(thisArg, _arguments, generator) {
    if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
    var g = generator.apply(thisArg, _arguments || []), i, q = [];
    return i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () { return this; }, i;
    function verb(n) { if (g[n]) i[n] = function (v) { return new Promise(function (a, b) { q.push([n, v, a, b]) > 1 || resume(n, v); }); }; }
    function resume(n, v) { try { step(g[n](v)); } catch (e) { settle(q[0][3], e); } }
    function step(r) { r.value instanceof __await ? Promise.resolve(r.value.v).then(fulfill, reject) : settle(q[0][2], r); }
    function fulfill(value) { resume("next", value); }
    function reject(value) { resume("throw", value); }
    function settle(f, v) { if (f(v), q.shift(), q.length) resume(q[0][0], q[0][1]); }
}

function __asyncDelegator(o) {
    var i, p;
    return i = {}, verb("next"), verb("throw", function (e) { throw e; }), verb("return"), i[Symbol.iterator] = function () { return this; }, i;
    function verb(n, f) { i[n] = o[n] ? function (v) { return (p = !p) ? { value: __await(o[n](v)), done: n === "return" } : f ? f(v) : v; } : f; }
}

function __asyncValues(o) {
    if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
    var m = o[Symbol.asyncIterator], i;
    return m ? m.call(o) : (o = typeof __values === "function" ? __values(o) : o[Symbol.iterator](), i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () { return this; }, i);
    function verb(n) { i[n] = o[n] && function (v) { return new Promise(function (resolve, reject) { v = o[n](v), settle(resolve, reject, v.done, v.value); }); }; }
    function settle(resolve, reject, d, v) { Promise.resolve(v).then(function(v) { resolve({ value: v, done: d }); }, reject); }
}

function __makeTemplateObject(cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};

var __setModuleDefault = Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
};

function __importStar(mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (k !== "default" && Object.prototype.hasOwnProperty.call(mod, k)) __createBinding(result, mod, k);
    __setModuleDefault(result, mod);
    return result;
}

function __importDefault(mod) {
    return (mod && mod.__esModule) ? mod : { default: mod };
}

function __classPrivateFieldGet(receiver, privateMap) {
    if (!privateMap.has(receiver)) {
        throw new TypeError("attempted to get private field on non-instance");
    }
    return privateMap.get(receiver);
}

function __classPrivateFieldSet(receiver, privateMap, value) {
    if (!privateMap.has(receiver)) {
        throw new TypeError("attempted to set private field on non-instance");
    }
    privateMap.set(receiver, value);
    return value;
}


/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

"use strict";
module.exports = window["React"];

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

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["i18n"];

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
/*!************************************************!*\
  !*** ./assets/src/apps/js/frontend/profile.js ***!
  \************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _profile_course_tab__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./profile/course-tab */ "./assets/src/apps/js/frontend/profile/course-tab.js");
/* harmony import */ var _profile_statistic__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./profile/statistic */ "./assets/src/apps/js/frontend/profile/statistic.js");
/* harmony import */ var _profile_order_recover__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./profile/order-recover */ "./assets/src/apps/js/frontend/profile/order-recover.js");
/* harmony import */ var _profile_avatar__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./profile/avatar */ "./assets/src/apps/js/frontend/profile/avatar.js");
/* harmony import */ var _profile_course_list__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./profile/course-list */ "./assets/src/apps/js/frontend/profile/course-list.js");






document.addEventListener('DOMContentLoaded', function (event) {
  (0,_profile_course_tab__WEBPACK_IMPORTED_MODULE_1__["default"])();
  (0,_profile_statistic__WEBPACK_IMPORTED_MODULE_2__["default"])();
  (0,_profile_order_recover__WEBPACK_IMPORTED_MODULE_3__["default"])();
  (0,_profile_course_list__WEBPACK_IMPORTED_MODULE_5__["default"])();
});
if (document.getElementById('learnpress-avatar-upload')) {
  wp.element.render((0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_profile_avatar__WEBPACK_IMPORTED_MODULE_4__["default"], null), document.getElementById('learnpress-avatar-upload'));
}
})();

/******/ })()
;
//# sourceMappingURL=profile.js.map