/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/utils/cookies.js":
/*!****************************************!*\
  !*** ./assets/src/js/utils/cookies.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
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

/***/ }),

/***/ "./assets/src/js/utils/event-callback.js":
/*!***********************************************!*\
  !*** ./assets/src/js/utils/event-callback.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/**
 * Manage event callbacks.
Allow add/remove a callback function into custom event of an object.
 *
 * @class
 * @param self
 */
const Event_Callback = function Event_Callback(self) {
  const callbacks = {};
  const $ = window.jQuery;
  this.on = function (event, callback) {
    let namespaces = event.split('.'),
      namespace = '';
    if (namespaces.length > 1) {
      event = namespaces[0];
      namespace = namespaces[1];
    }
    if (!callbacks[event]) {
      callbacks[event] = [[], {}];
    }
    if (namespace) {
      if (!callbacks[event][1][namespace]) {
        callbacks[event][1][namespace] = [];
      }
      callbacks[event][1][namespace].push(callback);
    } else {
      callbacks[event][0].push(callback);
    }
    return self;
  };
  this.off = function (event, callback) {
    let namespaces = event.split('.'),
      namespace = '';
    if (namespaces.length > 1) {
      event = namespaces[0];
      namespace = namespaces[1];
    }
    if (!callbacks[event]) {
      return self;
    }
    let at = -1;
    if (!namespace) {
      if (typeof callback === 'function') {
        at = callbacks[event][0].indexOf(callback);
        if (at < 0) {
          return self;
        }
        callbacks[event][0].splice(at, 1);
      } else {
        callbacks[event][0] = [];
      }
    } else {
      if (!callbacks[event][1][namespace]) {
        return self;
      }
      if (typeof callback === 'function') {
        at = callbacks[event][1][namespace].indexOf(callback);
        if (at < 0) {
          return self;
        }
        callbacks[event][1][namespace].splice(at, 1);
      } else {
        callbacks[event][1][namespace] = [];
      }
    }
    return self;
  };
  this.callEvent = function (event, callbackArgs) {
    if (!callbacks[event]) {
      return;
    }
    if (callbacks[event][0]) {
      for (var i = 0; i < callbacks[event][0].length; i++) {
        typeof callbacks[event][0][i] === 'function' && callbacks[event][i][0].apply(self, callbackArgs);
      }
    }
    if (callbacks[event][1]) {
      for (var i in callbacks[event][1]) {
        for (let j = 0; j < callbacks[event][1][i].length; j++) {
          typeof callbacks[event][1][i][j] === 'function' && callbacks[event][1][i][j].apply(self, callbackArgs);
        }
      }
    }
  };
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Event_Callback);

/***/ }),

/***/ "./assets/src/js/utils/extend.js":
/*!***************************************!*\
  !*** ./assets/src/js/utils/extend.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* export default binding */ __WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ function __WEBPACK_DEFAULT_EXPORT__() {
  window.LP = window.LP || {};
  if (typeof arguments[0] === 'string') {
    LP[arguments[0]] = LP[arguments[0]] || {};
    LP[arguments[0]] = jQuery.extend(LP[arguments[0]], arguments[1]);
  } else {
    LP = jQuery.extend(LP, arguments[0]);
  }
}

/***/ }),

/***/ "./assets/src/js/utils/fn.js":
/*!***********************************!*\
  !*** ./assets/src/js/utils/fn.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/**
 * Auto prepend `LP` prefix for jQuery fn plugin name.
 *
 * Create : $.fn.LP( 'PLUGIN_NAME', func) <=> $.fn.LP_PLUGIN_NAME
 * Usage: $(selector).LP('PLUGIN_NAME') <=> $(selector).LP_PLUGIN_NAME()
 *
 * @version 3.2.6
 */

const $ = window.jQuery;
let exp;
(function () {
  if ($ === undefined) {
    return;
  }
  $.fn.LP = exp = function (widget, fn) {
    if (typeof fn === 'function') {
      $.fn['LP_' + widget] = fn;
    } else if (widget) {
      const args = [];
      if (arguments.length > 1) {
        for (let i = 1; i < arguments.length; i++) {
          args.push(arguments[i]);
        }
      }
      return typeof $(this)['LP_' + widget] === 'function' ? $(this)['LP_' + widget].apply(this, args) : this;
    }
    return this;
  };
})();
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (exp);

/***/ }),

/***/ "./assets/src/js/utils/hook.js":
/*!*************************************!*\
  !*** ./assets/src/js/utils/hook.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Hook = {
  hooks: {
    action: {},
    filter: {}
  },
  addAction(action, callable, priority, tag) {
    this.addHook('action', action, callable, priority, tag);
    return this;
  },
  addFilter(action, callable, priority, tag) {
    this.addHook('filter', action, callable, priority, tag);
    return this;
  },
  doAction(action) {
    return this.doHook('action', action, arguments);
  },
  applyFilters(action) {
    return this.doHook('filter', action, arguments);
  },
  removeAction(action, tag) {
    this.removeHook('action', action, tag);
    return this;
  },
  removeFilter(action, priority, tag) {
    this.removeHook('filter', action, priority, tag);
    return this;
  },
  addHook(hookType, action, callable, priority, tag) {
    if (undefined === this.hooks[hookType][action]) {
      this.hooks[hookType][action] = [];
    }
    const hooks = this.hooks[hookType][action];
    if (undefined === tag) {
      tag = action + '_' + hooks.length;
    }
    this.hooks[hookType][action].push({
      tag,
      callable,
      priority
    });
    return this;
  },
  doHook(hookType, action, args) {
    args = Array.prototype.slice.call(args, 1);
    if (undefined !== this.hooks[hookType][action]) {
      let hooks = this.hooks[hookType][action],
        hook;
      hooks.sort(function (a, b) {
        return a.priority - b.priority;
      });
      for (let i = 0; i < hooks.length; i++) {
        hook = hooks[i].callable;
        if (typeof hook !== 'function') {
          hook = window[hook];
        }
        if ('action' === hookType) {
          args[i] = hook.apply(null, args);
        } else {
          args[0] = hook.apply(null, args);
        }
      }
    }
    if ('filter' === hookType) {
      return args[0];
    }
    return args;
  },
  removeHook(hookType, action, priority, tag) {
    if (undefined !== this.hooks[hookType][action]) {
      const hooks = this.hooks[hookType][action];
      for (let i = hooks.length - 1; i >= 0; i--) {
        if ((undefined === tag || tag === hooks[i].tag) && (undefined === priority || priority === hooks[i].priority)) {
          hooks.splice(i, 1);
        }
      }
    }
    return this;
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Hook);

/***/ }),

/***/ "./assets/src/js/utils/iframe-submit.js":
/*!**********************************************!*\
  !*** ./assets/src/js/utils/iframe-submit.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
let iframeCounter = 1;
const $ = window.jQuery || jQuery;
const IframeSubmit = function (form) {
  const iframeId = 'ajax-iframe-' + iframeCounter;
  let $iframe = $('form[name="' + iframeId + '"]');
  if (!$iframe.length) {
    $iframe = $('<iframe />').appendTo(document.body).attr({
      name: iframeId,
      src: '#'
    });
  }
  $(form).on('submit', function () {
    const $form = $(form).clone().appendTo(document.body);
    $form.attr('target', iframeId);
    $form.find('#submit').remove();
    return false;
  });
  iframeCounter++;
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (IframeSubmit);

/***/ }),

/***/ "./assets/src/js/utils/jquery.plugins.js":
/*!***********************************************!*\
  !*** ./assets/src/js/utils/jquery.plugins.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const $ = window.jQuery || jQuery;
const serializeJSON = function serializeJSON(path) {
  const isInput = $(this).is('input') || $(this).is('select') || $(this).is('textarea');
  let unIndexed = isInput ? $(this).serializeArray() : $(this).find('input, select, textarea').serializeArray(),
    indexed = {},
    validate = /(\[([a-zA-Z0-9_-]+)?\]?)/g,
    arrayKeys = {},
    end = false;
  $.each(unIndexed, function () {
    const that = this,
      match = this.name.match(/^([0-9a-zA-Z_-]+)/);
    if (!match) {
      return;
    }
    let keys = this.name.match(validate),
      objPath = "indexed['" + match[0] + "']";
    if (keys) {
      if (typeof indexed[match[0]] != 'object') {
        indexed[match[0]] = {};
      }
      $.each(keys, function (i, prop) {
        prop = prop.replace(/\]|\[/g, '');
        let rawPath = objPath.replace(/'|\[|\]/g, ''),
          objExp = '',
          preObjPath = objPath;
        if (prop == '') {
          if (arrayKeys[rawPath] == undefined) {
            arrayKeys[rawPath] = 0;
          } else {
            arrayKeys[rawPath]++;
          }
          objPath += "['" + arrayKeys[rawPath] + "']";
        } else {
          if (!isNaN(prop)) {
            arrayKeys[rawPath] = prop;
          }
          objPath += "['" + prop + "']";
        }
        try {
          if (i == keys.length - 1) {
            objExp = objPath + '=that.value;';
            end = true;
          } else {
            objExp = objPath + '={}';
            end = false;
          }
          const evalString = '' + 'if( typeof ' + objPath + " == 'undefined'){" + objExp + ';' + '}else{' + 'if(end){' + 'if(typeof ' + preObjPath + "!='object'){" + preObjPath + '={};}' + objExp + '}' + '}';
          eval(evalString);
        } catch (e) {
          console.log('Error:' + e + '\n' + objExp);
        }
      });
    } else {
      indexed[match[0]] = this.value;
    }
  });
  if (path) {
    path = "['" + path.replace('.', "']['") + "']";
    const c = 'try{indexed = indexed' + path + '}catch(ex){console.log(c, ex);}';
    eval(c);
  }
  return indexed;
};
const LP_Tooltip = options => {
  options = $.extend({}, {
    offset: [0, 0]
  }, options || {});
  return $.each(undefined, function () {
    const $el = $(this),
      content = $el.data('content');
    if (!content || $el.data('LP_Tooltip') !== undefined) {
      return;
    }
    let $tooltip = null;
    $el.on('mouseenter', function (e) {
      $tooltip = $('<div class="learn-press-tooltip-bubble"/>').html(content).appendTo($('body')).hide();
      const position = $el.offset();
      if (Array.isArray(options.offset)) {
        const top = options.offset[1],
          left = options.offset[0];
        if ($.isNumeric(left)) {
          position.left += left;
        } else {}
        if ($.isNumeric(top)) {
          position.top += top;
        } else {}
      }
      $tooltip.css({
        top: position.top,
        left: position.left
      });
      $tooltip.fadeIn();
    });
    $el.on('mouseleave', function (e) {
      $tooltip && $tooltip.remove();
    });
    $el.data('tooltip', true);
  });
};
const hasEvent = function hasEvent(name) {
  const events = $(this).data('events');
  if (typeof events.LP == 'undefined') {
    return false;
  }
  for (i = 0; i < events.LP.length; i++) {
    if (events.LP[i].namespace == name) {
      return true;
    }
  }
  return false;
};
const dataToJSON = function dataToJSON() {
  const json = {};
  $.each(this[0].attributes, function () {
    const m = this.name.match(/^data-(.*)/);
    if (m) {
      json[m[1]] = this.value;
    }
  });
  return json;
};
const rows = function rows() {
  const h = $(this).height();
  const lh = $(this).css('line-height').replace('px', '');
  $(this).attr({
    height: h,
    'line-height': lh
  });
  return Math.floor(h / parseInt(lh));
};
const checkLines = function checkLines(p) {
  return this.each(function () {
    const $e = $(this),
      rows = $e.rows();
    p.call(this, rows);
  });
};
const findNext = function findNext(selector) {
  const $selector = $(selector),
    $root = this.first(),
    index = $selector.index($root),
    $next = $selector.eq(index + 1);
  return $next.length ? $next : false;
};
const findPrev = function findPrev(selector) {
  const $selector = $(selector),
    $root = this.first(),
    index = $selector.index($root),
    $prev = $selector.eq(index - 1);
  return $prev.length ? $prev : false;
};
const progress = function progress(v) {
  return this.each(function () {
    const t = parseInt(v / 100 * 360),
      timer = null,
      $this = $(this);
    if (t < 180) {
      $this.find('.progress-circle').removeClass('gt-50');
    } else {
      $this.find('.progress-circle').addClass('gt-50');
    }
    $this.find('.fill').css({
      transform: 'rotate(' + t + 'deg)'
    });
  });
};
$.fn.serializeJSON = serializeJSON;
$.fn.LP_Tooltip = LP_Tooltip;
$.fn.hasEvent = hasEvent;
$.fn.dataToJSON = dataToJSON;
$.fn.rows = rows;
$.fn.checkLines = checkLines;
$.fn.findNext = findNext;
$.fn.findPrev = findPrev;
$.fn.progress = progress;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  serializeJSON,
  LP_Tooltip,
  hasEvent,
  dataToJSON,
  rows,
  checkLines,
  findNext,
  findPrev,
  progress
});

/***/ }),

/***/ "./assets/src/js/utils/local-storage.js":
/*!**********************************************!*\
  !*** ./assets/src/js/utils/local-storage.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const _localStorage = {
  __key: 'LP',
  set(name, value) {
    const data = _localStorage.get();
    const {
      set
    } = lodash;
    set(data, name, value);
    localStorage.setItem(_localStorage.__key, JSON.stringify(data));
  },
  get(name, def) {
    const data = JSON.parse(localStorage.getItem(_localStorage.__key) || '{}');
    const {
      get
    } = lodash;
    const value = get(data, name);
    return !name ? data : value !== undefined ? value : def;
  },
  exists(name) {
    const data = _localStorage.get();

    // return data.hasOwnProperty( name );
    return name in data;
  },
  remove(name) {
    const data = _localStorage.get();
    const newData = lodash.omit(data, name);
    _localStorage.__set(newData);
  },
  __get() {
    return localStorage.getItem(_localStorage.__key);
  },
  __set(data) {
    localStorage.setItem(_localStorage.__key, JSON.stringify(data || '{}'));
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_localStorage);

/***/ }),

/***/ "./assets/src/js/utils/message-box.js":
/*!********************************************!*\
  !*** ./assets/src/js/utils/message-box.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const $ = window.jQuery;
const MessageBox = {
  $block: null,
  $window: null,
  events: {},
  instances: [],
  instance: null,
  quickConfirm(elem, args) {
    const $e = $(elem);
    $('[learn-press-quick-confirm]').each(function () {
      let $ins;
      ($ins = $(this).data('quick-confirm')) && (console.log($ins), $ins.destroy());
    });
    !$e.attr('learn-press-quick-confirm') && $e.attr('learn-press-quick-confirm', 'true').data('quick-confirm', new function (elem, args) {
      var $elem = $(elem),
        $div = $('<span class="learn-press-quick-confirm"></span>').insertAfter($elem),
        //($(document.body)),
        offset = $(elem).position() || {
          left: 0,
          top: 0
        },
        timerOut = null,
        timerHide = null,
        n = 3,
        hide = function () {
          $div.fadeOut('fast', function () {
            $(this).remove();
            $div.parent().css('position', '');
          });
          $elem.removeAttr('learn-press-quick-confirm').data('quick-confirm', undefined);
          stop();
        },
        stop = function () {
          timerHide && clearInterval(timerHide);
          timerOut && clearInterval(timerOut);
        },
        start = function () {
          timerOut = setInterval(function () {
            if (--n == 0) {
              hide.call($div[0]);
              typeof args.onCancel === 'function' && args.onCancel(args.data);
              stop();
            }
            $div.find('span').html(' (' + n + ')');
          }, 1000);
          timerHide = setInterval(function () {
            if (!$elem.is(':visible') || $elem.css('visibility') == 'hidden') {
              stop();
              $div.remove();
              $div.parent().css('position', '');
              typeof args.onCancel === 'function' && args.onCancel(args.data);
            }
          }, 350);
        };
      args = $.extend({
        message: '',
        data: null,
        onOk: null,
        onCancel: null,
        offset: {
          top: 0,
          left: 0
        }
      }, args || {});
      $div.html(args.message || $elem.attr('data-confirm-remove') || 'Are you sure?').append('<span> (' + n + ')</span>').css({});
      $div.click(function () {
        typeof args.onOk === 'function' && args.onOk(args.data);
        hide();
      }).hover(function () {
        stop();
      }, function () {
        start();
      });
      //$div.parent().css('position', 'relative');
      $div.css({
        left: offset.left + $elem.outerWidth() - $div.outerWidth() + args.offset.left,
        top: offset.top + $elem.outerHeight() + args.offset.top + 5
      }).hide().fadeIn('fast');
      start();
      this.destroy = function () {
        $div.remove();
        $elem.removeAttr('learn-press-quick-confirm').data('quick-confirm', undefined);
        stop();
      };
    }(elem, args));
  },
  show(message, args) {
    //this.hide();
    $.proxy(function () {
      args = $.extend({
        title: '',
        buttons: '',
        events: false,
        autohide: false,
        message,
        data: false,
        id: LP.uniqueId(),
        onHide: null
      }, args || {});
      this.instances.push(args);
      this.instance = args;
      const $doc = $(document),
        $body = $(document.body);
      if (!this.$block) {
        this.$block = $('<div id="learn-press-message-box-block"></div>').appendTo($body);
      }
      if (!this.$window) {
        this.$window = $('<div id="learn-press-message-box-window"><div id="message-box-wrap"></div> </div>').insertAfter(this.$block);
        this.$window.click(function () {});
      }
      //this.events = args.events || {};
      this._createWindow(message, args.title, args.buttons);
      this.$block.show();
      this.$window.show().attr('instance', args.id);
      $(window).bind('resize.message-box', $.proxy(this.update, this)).bind('scroll.message-box', $.proxy(this.update, this));
      this.update(true);
      if (args.autohide) {
        setTimeout(function () {
          LP.MessageBox.hide();
          typeof args.onHide === 'function' && args.onHide.call(LP.MessageBox, args);
        }, args.autohide);
      }
    }, this)();
  },
  blockUI(message) {
    message = (message !== false ? message ? message : 'Wait a moment' : '') + '<div class="message-box-animation"></div>';
    this.show(message);
  },
  hide(delay, instance) {
    if (instance) {
      this._removeInstance(instance.id);
    } else if (this.instance) {
      this._removeInstance(this.instance.id);
    }
    if (this.instances.length === 0) {
      if (this.$block) {
        this.$block.hide();
      }
      if (this.$window) {
        this.$window.hide();
      }
      $(window).unbind('resize.message-box', this.update).unbind('scroll.message-box', this.update);
    } else if (this.instance) {
      this._createWindow(this.instance.message, this.instance.title, this.instance.buttons);
    }
  },
  update(force) {
    let that = this,
      $wrap = this.$window.find('#message-box-wrap'),
      timer = $wrap.data('timer'),
      _update = function () {
        LP.Hook.doAction('learn_press_message_box_before_resize', that);
        let $content = $wrap.find('.message-box-content').css('height', '').css('overflow', 'hidden'),
          width = $wrap.outerWidth(),
          height = $wrap.outerHeight(),
          contentHeight = $content.height(),
          windowHeight = $(window).height(),
          top = $wrap.offset().top;
        if (contentHeight > windowHeight - 50) {
          $content.css({
            height: windowHeight - 25
          });
          height = $wrap.outerHeight();
        } else {
          $content.css('height', '').css('overflow', '');
        }
        $wrap.css({
          marginTop: ($(window).height() - height) / 2
        });
        LP.Hook.doAction('learn_press_message_box_resize', height, that);
      };
    if (force) {
      _update();
    }
    timer && clearTimeout(timer);
    timer = setTimeout(_update, 250);
  },
  _removeInstance(id) {
    for (let i = 0; i < this.instances.length; i++) {
      if (this.instances[i].id === id) {
        this.instances.splice(i, 1);
        const len = this.instances.length;
        if (len) {
          this.instance = this.instances[len - 1];
          this.$window.attr('instance', this.instance.id);
        } else {
          this.instance = false;
          this.$window.removeAttr('instance');
        }
        break;
      }
    }
  },
  _getInstance(id) {
    for (let i = 0; i < this.instances.length; i++) {
      if (this.instances[i].id === id) {
        return this.instances[i];
      }
    }
  },
  _createWindow(message, title, buttons) {
    const $wrap = this.$window.find('#message-box-wrap').html('');
    if (title) {
      $wrap.append('<h3 class="message-box-title">' + title + '</h3>');
    }
    $wrap.append($('<div class="message-box-content"></div>').html(message));
    if (buttons) {
      const $buttons = $('<div class="message-box-buttons"></div>');
      switch (buttons) {
        case 'yesNo':
          $buttons.append(this._createButton(LP_Settings.localize.button_yes, 'yes'));
          $buttons.append(this._createButton(LP_Settings.localize.button_no, 'no'));
          break;
        case 'okCancel':
          $buttons.append(this._createButton(LP_Settings.localize.button_ok, 'ok'));
          $buttons.append(this._createButton(LP_Settings.localize.button_cancel, 'cancel'));
          break;
        default:
          $buttons.append(this._createButton(LP_Settings.localize.button_ok, 'ok'));
      }
      $wrap.append($buttons);
    }
  },
  _createButton(title, type) {
    const $button = $('<button type="button" class="button message-box-button message-box-button-' + type + '">' + title + '</button>'),
      callback = 'on' + (type.substr(0, 1).toUpperCase() + type.substr(1));
    $button.data('callback', callback).click(function () {
      const instance = $(this).data('instance'),
        callback = instance.events[$(this).data('callback')];
      if ($.type(callback) === 'function') {
        if (callback.apply(LP.MessageBox, [instance]) === false) {
          // return;
        } else {
          LP.MessageBox.hide(null, instance);
        }
      } else {
        LP.MessageBox.hide(null, instance);
      }
    }).data('instance', this.instance);
    return $button;
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (MessageBox);

/***/ }),

/***/ "./assets/src/js/utils/quick-tip.js":
/*!******************************************!*\
  !*** ./assets/src/js/utils/quick-tip.js ***!
  \******************************************/
/***/ (() => {

(function ($) {
  function QuickTip(el, options) {
    const $el = $(el),
      uniId = $el.attr('data-id') || LP.uniqueId();
    options = $.extend({
      event: 'hover',
      autoClose: true,
      single: true,
      closeInterval: 1000,
      arrowOffset: null,
      tipClass: ''
    }, options, $el.data());
    $el.attr('data-id', uniId);
    let content = $el.attr('data-content-tip') || $el.html(),
      $tip = $('<div class="learn-press-tip-floating">' + content + '</div>'),
      t = null,
      closeInterval = 0,
      useData = false,
      arrowOffset = options.arrowOffset === 'el' ? $el.outerWidth() / 2 : 8,
      $content = $('#__' + uniId);
    if ($content.length === 0) {
      $(document.body).append($('<div />').attr('id', '__' + uniId).html(content).css('display', 'none'));
    }
    content = $content.html();
    $tip.addClass(options.tipClass);
    $el.data('content-tip', content);
    if ($el.attr('data-content-tip')) {
      //$el.removeAttr('data-content-tip');
      useData = true;
    }
    closeInterval = options.closeInterval;
    if (options.autoClose === false) {
      $tip.append('<a class="close"></a>');
      $tip.on('click', '.close', function () {
        close();
      });
    }
    function show() {
      if (t) {
        clearTimeout(t);
        return;
      }
      if (options.single) {
        $('.learn-press-tip').not($el).LP('QuickTip', 'close');
      }
      $tip.appendTo(document.body);
      const pos = $el.offset();
      $tip.css({
        top: pos.top - $tip.outerHeight() - 8,
        left: pos.left - $tip.outerWidth() / 2 + arrowOffset
      });
    }
    function hide() {
      t && clearTimeout(t);
      t = setTimeout(function () {
        $tip.detach();
        t = null;
      }, closeInterval);
    }
    function close() {
      closeInterval = 0;
      hide();
      closeInterval = options.closeInterval;
    }
    function open() {
      show();
    }
    if (!useData) {
      $el.html('');
    }
    if (options.event === 'click') {
      $el.on('click', function (e) {
        e.stopPropagation();
        show();
      });
    }
    $(document).on('learn-press/close-all-quick-tip', function () {
      close();
    });
    $el.hover(function (e) {
      e.stopPropagation();
      if (options.event !== 'click') {
        show();
      }
    }, function (e) {
      e.stopPropagation();
      if (options.autoClose) {
        hide();
      }
    }).addClass('ready');
    return {
      close,
      open
    };
  }
  $.fn.LP('QuickTip', function (options) {
    return $.each(this, function () {
      let $tip = $(this).data('quick-tip');
      if (!$tip) {
        $tip = new QuickTip(this, options);
        $(this).data('quick-tip', $tip);
      }
      if (typeof options === 'string') {
        $tip[options] && $tip[options].apply($tip);
      }
    });
  });
})(jQuery);

/***/ }),

/***/ "./assets/src/js/utils/show-password.js":
/*!**********************************************!*\
  !*** ./assets/src/js/utils/show-password.js ***!
  \**********************************************/
/***/ (() => {

const $ = jQuery;
$(function () {
  $('.form-field input[type="password"]').wrap('<span class="lp-password-input"></span>');
  $('.lp-password-input').append('<span class="lp-show-password-input"></span>');
  $('.lp-show-password-input').on('click', function () {
    $(this).toggleClass('display-password');
    if ($(this).hasClass('display-password')) {
      $(this).siblings(['input[type="password"]']).prop('type', 'text');
    } else {
      $(this).siblings('input[type="text"]').prop('type', 'password');
    }
  });
});

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
/*!**************************************!*\
  !*** ./assets/src/js/utils/index.js ***!
  \**************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _extend__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./extend */ "./assets/src/js/utils/extend.js");
/* harmony import */ var _fn__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./fn */ "./assets/src/js/utils/fn.js");
/* harmony import */ var _quick_tip__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./quick-tip */ "./assets/src/js/utils/quick-tip.js");
/* harmony import */ var _quick_tip__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_quick_tip__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _message_box__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./message-box */ "./assets/src/js/utils/message-box.js");
/* harmony import */ var _event_callback__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./event-callback */ "./assets/src/js/utils/event-callback.js");
/* harmony import */ var _hook__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./hook */ "./assets/src/js/utils/hook.js");
/* harmony import */ var _cookies__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./cookies */ "./assets/src/js/utils/cookies.js");
/* harmony import */ var _local_storage__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./local-storage */ "./assets/src/js/utils/local-storage.js");
/* harmony import */ var _jquery_plugins__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./jquery.plugins */ "./assets/src/js/utils/jquery.plugins.js");
/* harmony import */ var _iframe_submit__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./iframe-submit */ "./assets/src/js/utils/iframe-submit.js");
/* harmony import */ var _show_password__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./show-password */ "./assets/src/js/utils/show-password.js");
/* harmony import */ var _show_password__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(_show_password__WEBPACK_IMPORTED_MODULE_10__);
/**
 * Utility functions may use for both admin and frontend.
 *
 * @version 3.2.6
 */












const $ = jQuery;
String.prototype.getQueryVar = function (name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  const regex = new RegExp('[\\?&]' + name + '=([^&#]*)'),
    results = regex.exec(this);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};
String.prototype.addQueryVar = function (name, value) {
  let url = this,
    m = url.split('#');
  url = m[0];
  if (name.match(/\[/)) {
    url += url.match(/\?/) ? '&' : '?';
    url += name + '=' + value;
  } else if (url.indexOf('&' + name + '=') != -1 || url.indexOf('?' + name + '=') != -1) {
    url = url.replace(new RegExp(name + '=([^&#]*)', 'g'), name + '=' + value);
  } else {
    url += url.match(/\?/) ? '&' : '?';
    url += name + '=' + value;
  }
  return url + (m[1] ? '#' + m[1] : '');
};
String.prototype.removeQueryVar = function (name) {
  let url = this;
  const m = url.split('#');
  url = m[0];
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  const regex = new RegExp('[\\?&]' + name + '([\[][^=]*)?=([^&#]*)', 'g');
  url = url.replace(regex, '');
  return url + (m[1] ? '#' + m[1] : '');
};

// if ( $.isEmptyObject( '' ) == false ) {
// 	$.isEmptyObject = function( a ) {
// 		let prop;
// 		for ( prop in a ) {
// 			if ( a.hasOwnProperty( prop ) ) {
// 				return false;
// 			}
// 		}
// 		return true;
// 	};
// }

const _default = {
  Hook: _hook__WEBPACK_IMPORTED_MODULE_5__["default"],
  setUrl(url, ember, title) {
    if (url) {
      history.pushState({}, title, url);
      LP.Hook.doAction('learn_press_set_location_url', url);
    }
  },
  toggleGroupSection(el, target) {
    const $el = $(el),
      isHide = $el.hasClass('hide-if-js');
    if (isHide) {
      $el.hide().removeClass('hide-if-js');
    }
    $el.removeClass('hide-if-js').slideToggle(function () {
      const $this = $(this);
      if ($this.is(':visible')) {
        $(target).addClass('toggle-on').removeClass('toggle-off');
      } else {
        $(target).addClass('toggle-off').removeClass('toggle-on');
      }
    });
  },
  overflow(el, v) {
    const $el = $(el),
      overflow = $el.css('overflow');
    if (v) {
      $el.css('overflow', v).data('overflow', overflow);
    } else {
      $el.css('overflow', $el.data('overflow'));
    }
  },
  getUrl() {
    return window.location.href;
  },
  addQueryVar(name, value, url) {
    return (url === undefined ? window.location.href : url).addQueryVar(name, value);
  },
  removeQueryVar(name, url) {
    return (url === undefined ? window.location.href : url).removeQueryVar(name);
  },
  reload(url) {
    if (!url) {
      url = window.location.href;
    }
    window.location.href = url;
  },
  parseResponse(response, type) {
    const m = response.match(/<-- LP_AJAX_START -->(.*)<-- LP_AJAX_END -->/s);
    if (m) {
      response = m[1];
    }
    return (type || 'json') === 'json' ? this.parseJSON(response) : response;
  },
  parseJSON(data) {
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
  },
  ajax(args) {
    const type = args.type || 'post',
      dataType = args.dataType || 'json',
      data = args.action ? $.extend(args.data, {
        'lp-ajax': args.action
      }) : args.data,
      beforeSend = args.beforeSend || function () {},
      url = args.url || window.location.href;
    //                        console.debug( beforeSend );
    $.ajax({
      data,
      url,
      type,
      dataType: 'html',
      beforeSend: beforeSend.apply(null, args),
      success(raw) {
        const response = LP.parseResponse(raw, dataType);
        typeof args.success === 'function' && args.success(response, raw);
      },
      error() {
        typeof args.error === 'function' && args.error.apply(null, LP.funcArgs2Array());
      }
    });
  },
  doAjax(args) {
    const type = args.type || 'post',
      dataType = args.dataType || 'json',
      action = (args.prefix === undefined || 'learnpress_') + args.action,
      data = args.action ? $.extend(args.data, {
        action
      }) : args.data;
    $.ajax({
      data,
      url: args.url || window.location.href,
      type,
      dataType: 'html',
      success(raw) {
        const response = LP.parseResponse(raw, dataType);
        typeof args.success === 'function' && args.success(response, raw);
      },
      error() {
        typeof args.error === 'function' && args.error.apply(null, LP.funcArgs2Array());
      }
    });
  },
  funcArgs2Array(args) {
    const arr = [];
    for (let i = 0; i < args.length; i++) {
      arr.push(args[i]);
    }
    return arr;
  },
  addFilter(action, callback) {
    const $doc = $(document),
      event = 'LP.' + action;
    $doc.on(event, callback);
    LP.log($doc.data('events'));
    return this;
  },
  applyFilters() {
    const $doc = $(document),
      action = arguments[0],
      args = this.funcArgs2Array(arguments);
    if ($doc.hasEvent(action)) {
      args[0] = 'LP.' + action;
      return $doc.triggerHandler.apply($doc, args);
    }
    return args[1];
  },
  addAction(action, callback) {
    return this.addFilter(action, callback);
  },
  doAction() {
    const $doc = $(document),
      action = arguments[0],
      args = this.funcArgs2Array(arguments);
    if ($doc.hasEvent(action)) {
      args[0] = 'LP.' + action;
      $doc.trigger.apply($doc, args);
    }
  },
  toElement(element, args) {
    if ($(element).length === 0) {
      return;
    }
    args = $.extend({
      delay: 300,
      duration: 'slow',
      offset: 50,
      container: null,
      callback: null,
      invisible: false
    }, args || {});
    let $container = $(args.container),
      rootTop = 0;
    if ($container.length === 0) {
      $container = $('body, html');
    }
    rootTop = $container.offset().top;
    const to = $(element).offset().top + $container.scrollTop() - rootTop - args.offset;
    function isElementInView(element, fullyInView) {
      const pageTop = $container.scrollTop();
      const pageBottom = pageTop + $container.height();
      const elementTop = $(element).offset().top - $container.offset().top;
      const elementBottom = elementTop + $(element).height();
      if (fullyInView === true) {
        return pageTop < elementTop && pageBottom > elementBottom;
      }
      return elementTop <= pageBottom && elementBottom >= pageTop;
    }
    if (args.invisible && isElementInView(element, true)) {
      return;
    }
    $container.fadeIn(10).delay(args.delay).animate({
      scrollTop: to
    }, args.duration, args.callback);
  },
  uniqueId(prefix, more_entropy) {
    if (typeof prefix === 'undefined') {
      prefix = '';
    }
    let retId;
    const formatSeed = function (seed, reqWidth) {
      seed = parseInt(seed, 10).toString(16); // to hex str
      if (reqWidth < seed.length) {
        // so long we split
        return seed.slice(seed.length - reqWidth);
      }
      if (reqWidth > seed.length) {
        // so short we pad
        return new Array(1 + (reqWidth - seed.length)).join('0') + seed;
      }
      return seed;
    };

    // BEGIN REDUNDANT
    if (!this.php_js) {
      this.php_js = {};
    }
    // END REDUNDANT
    if (!this.php_js.uniqidSeed) {
      // init seed with big random int
      this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    this.php_js.uniqidSeed++;
    retId = prefix; // start with prefix, add current milliseconds hex string
    retId += formatSeed(parseInt(new Date().getTime() / 1000, 10), 8);
    retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
    if (more_entropy) {
      // for more entropy we add a float lower to 10
      retId += (Math.random() * 10).toFixed(8).toString();
    }
    return retId;
  },
  log() {
    //if (typeof LEARN_PRESS_DEBUG != 'undefined' && LEARN_PRESS_DEBUG && console) {
    for (let i = 0, n = arguments.length; i < n; i++) {
      console.log(arguments[i]);
    }
    //}
  },
  blockContent() {
    if ($('#learn-press-block-content').length === 0) {
      $(LP.template('learn-press-template-block-content', {})).appendTo($('body'));
    }
    LP.hideMainScrollbar().addClass('block-content');
    $(document).trigger('learn_press_block_content');
  },
  unblockContent() {
    setTimeout(function () {
      LP.showMainScrollbar().removeClass('block-content');
      $(document).trigger('learn_press_unblock_content');
    }, 350);
  },
  hideMainScrollbar(el) {
    if (!el) {
      el = 'html, body';
    }
    const $el = $(el);
    $el.each(function () {
      const $root = $(this),
        overflow = $root.css('overflow');
      $root.css('overflow', 'hidden').attr('overflow', overflow);
    });
    return $el;
  },
  showMainScrollbar(el) {
    if (!el) {
      el = 'html, body';
    }
    const $el = $(el);
    $el.each(function () {
      const $root = $(this),
        overflow = $root.attr('overflow');
      $root.css('overflow', overflow).removeAttr('overflow');
    });
    return $el;
  },
  template: typeof _ !== 'undefined' ? _.memoize(function (id, data) {
    let compiled,
      options = {
        evaluate: /<#([\s\S]+?)#>/g,
        interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
        escape: /\{\{([^\}]+?)\}\}(?!\})/g,
        variable: 'data'
      };
    const tmpl = function (data) {
      compiled = compiled || _.template($('#' + id).html(), null, options);
      return compiled(data);
    };
    return data ? tmpl(data) : tmpl;
  }, function (a, b) {
    return a + '-' + JSON.stringify(b);
  }) : function () {
    return '';
  },
  alert(localize, callback) {
    let title = '',
      message = '';
    if (typeof localize === 'string') {
      message = localize;
    } else {
      if (typeof localize.title !== 'undefined') {
        title = localize.title;
      }
      if (typeof localize.message !== 'undefined') {
        message = localize.message;
      }
    }
    $.alerts.alert(message, title, function (e) {
      LP._on_alert_hide();
      callback && callback(e);
    });
    this._on_alert_show();
  },
  confirm(localize, callback) {
    let title = '',
      message = '';
    if (typeof localize === 'string') {
      message = localize;
    } else {
      if (typeof localize.title !== 'undefined') {
        title = localize.title;
      }
      if (typeof localize.message !== 'undefined') {
        message = localize.message;
      }
    }
    $.alerts.confirm(message, title, function (e) {
      LP._on_alert_hide();
      callback && callback(e);
    });
    this._on_alert_show();
  },
  _on_alert_show() {
    const $container = $('#popup_container'),
      $placeholder = $('<span id="popup_container_placeholder" />').insertAfter($container).data('xxx', $container);
    $container.stop().css('top', '-=50').css('opacity', '0').animate({
      top: '+=50',
      opacity: 1
    }, 250);
  },
  _on_alert_hide() {
    const $holder = $('#popup_container_placeholder'),
      $container = $holder.data('xxx');
    if ($container) {
      $container.replaceWith($holder);
    }
    $container.appendTo($(document.body));
    $container.stop().animate({
      top: '+=50',
      opacity: 0
    }, 250, function () {
      $(this).remove();
    });
  },
  sendMessage(data, object, targetOrigin, transfer) {
    if ($.isPlainObject(data)) {
      data = JSON.stringify(data);
    }
    object = object || window;
    targetOrigin = targetOrigin || '*';
    object.postMessage(data, targetOrigin, transfer);
  },
  receiveMessage(event, b) {
    let target = event.origin || event.originalEvent.origin,
      data = event.data || event.originalEvent.data || '';
    if (typeof data === 'string' || data instanceof String) {
      if (data.indexOf('{') === 0) {
        data = LP.parseJSON(data);
      }
    }
    LP.Hook.doAction('learn_press_receive_message', data, target);
  },
  camelCaseDashObjectKeys(obj, deep = true) {
    const self = LP;
    const isArray = function (a) {
      return Array.isArray(a);
    };
    const isObject = function (o) {
      return o === Object(o) && !isArray(o) && typeof o !== 'function';
    };
    const toCamel = s => {
      return s.replace(/([-_][a-z])/ig, $1 => {
        return $1.toUpperCase().replace('-', '').replace('_', '');
      });
    };
    if (isObject(obj)) {
      const n = {};
      Object.keys(obj).forEach(k => {
        n[toCamel(k)] = deep ? self.camelCaseDashObjectKeys(obj[k]) : obj[k];
      });
      return n;
    } else if (isArray(obj)) {
      return obj.map(i => {
        return self.camelCaseDashObjectKeys(i);
      });
    }
    return obj;
  },
  IframeSubmit: _iframe_submit__WEBPACK_IMPORTED_MODULE_9__["default"]
};
$(document).ready(function () {
  if (typeof $.alerts !== 'undefined') {
    $.alerts.overlayColor = '#000';
    $.alerts.overlayOpacity = 0.5;
    $.alerts.okButton = lpGlobalSettings.localize.button_ok;
    $.alerts.cancelButton = lpGlobalSettings.localize.button_cancel;
  }
  $('.learn-press-message.fixed').each(function () {
    const $el = $(this),
      options = $el.data();
    (function ($el, options) {
      if (options.delayIn) {
        setTimeout(function () {
          $el.show().hide().fadeIn();
        }, options.delayIn);
      }
      if (options.delayOut) {
        setTimeout(function () {
          $el.fadeOut();
        }, options.delayOut + (options.delayIn || 0));
      }
    })($el, options);
  });
  setTimeout(function () {
    $('.learn-press-nav-tabs li.active:not(.default) a').trigger('click');
  }, 300);

  //$( 'body.course-item-popup' ).parent().css( 'overflow', 'hidden' );

  (function () {
    let timer = null,
      callback = function () {
        $('.auto-check-lines').checkLines(function (r) {
          if (r > 1) {
            $(this).removeClass('single-lines');
          } else {
            $(this).addClass('single-lines');
          }
          $(this).attr('rows', r);
        });
      };
    $(window).on('resize.check-lines', function () {
      if (timer) {
        timer && clearTimeout(timer);
        timer = setTimeout(callback, 300);
      } else {
        callback();
      }
    });
  })();
  $('.learn-press-tooltip, .lp-passing-conditional').LP_Tooltip({
    offset: [24, 24]
  });
  $('.learn-press-icon').LP_Tooltip({
    offset: [30, 30]
  });
  $('.learn-press-message[data-autoclose]').each(function () {
    const $el = $(this),
      delay = parseInt($el.data('autoclose'));
    if (delay) {
      setTimeout(function ($el) {
        $el.fadeOut();
      }, delay, $el);
    }
  });
  $(document).on('click', function () {
    $(document).trigger('learn-press/close-all-quick-tip');
  });
});
(0,_extend__WEBPACK_IMPORTED_MODULE_0__["default"])({
  Event_Callback: _event_callback__WEBPACK_IMPORTED_MODULE_4__["default"],
  MessageBox: _message_box__WEBPACK_IMPORTED_MODULE_3__["default"],
  Cookies: _cookies__WEBPACK_IMPORTED_MODULE_6__["default"],
  localStorage: _local_storage__WEBPACK_IMPORTED_MODULE_7__["default"],
  ..._default
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  fn: _fn__WEBPACK_IMPORTED_MODULE_1__["default"],
  QuickTip: (_quick_tip__WEBPACK_IMPORTED_MODULE_2___default()),
  Cookies: _cookies__WEBPACK_IMPORTED_MODULE_6__["default"],
  localStorage: _local_storage__WEBPACK_IMPORTED_MODULE_7__["default"],
  showPass: (_show_password__WEBPACK_IMPORTED_MODULE_10___default())
});
})();

/******/ })()
;
//# sourceMappingURL=utils.js.map