/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ 807:
/***/ (() => {

/**
 * Adjust the drawer position by the height of the wp admin bar.
 */
(function () {
  var AdjustDrawerPosition = function () {
    var admin_bar = document.querySelector('.admin-bar');
    if (!admin_bar) return;
    window.addEventListener('load', this.adjust_drawer_position, false);
    window.addEventListener('resize', this.adjust_drawer_position, false);
    window.addEventListener('scroll', this.adjust_drawer_position, false);
  };
  AdjustDrawerPosition.prototype.adjust_drawer_position = function () {
    if (!(document.querySelector('.admin-bar .drawer-btn') && document.querySelector('body.admin-bar .drawer') && document.querySelector('body.admin-bar .drawer-overlay'))) return;
    if (window.matchMedia('(max-width: 600px)').matches) {
      var admin_bar_height = 46;
      var offset_top = 18;
      var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      if (scrollTop > admin_bar_height) {
        document.querySelector('.admin-bar .drawer-btn').style.top = offset_top + 'px';
        document.querySelector('body.admin-bar .drawer').style.top = '0px';
        document.querySelector('body.admin-bar .drawer').style.height = '100%';
        document.querySelector('body.admin-bar .drawer-overlay').style.top = '0px';
      } else {
        document.querySelector('.admin-bar .drawer-btn').style.top = offset_top + admin_bar_height - scrollTop + 'px';
        document.querySelector('body.admin-bar .drawer').style.top = admin_bar_height - scrollTop + 'px';
        document.querySelector('body.admin-bar .drawer').style.height = '';
        document.querySelector('body.admin-bar .drawer-overlay').style.top = admin_bar_height - scrollTop + 'px';
      }
    } else {
      document.querySelector('.admin-bar .drawer-btn').style.top = '';
      document.querySelector('body.admin-bar .drawer').style.top = '';
      document.querySelector('body.admin-bar .drawer').style.height = '';
      document.querySelector('body.admin-bar .drawer-overlay').style.top = '';
    }
  };
  new AdjustDrawerPosition();
})();

/***/ }),

/***/ 273:
/***/ (() => {

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
  var isIe = /(trident|msie)/i.test(navigator.userAgent);
  if (isIe && document.getElementById && window.addEventListener) {
    window.addEventListener('hashchange', function () {
      var id = location.hash.substring(1),
        element;
      if (!/^[A-z0-9_-]+$/.test(id)) {
        return;
      }
      element = document.getElementById(id);
      if (element) {
        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
          element.tabIndex = -1;
        }
        element.focus();
      }
    }, false);
  }
})();

/***/ }),

/***/ 416:
/***/ (() => {

/**
 * Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
 */
(function () {
  var SubMenuFocus = function () {
    var menu = document.querySelector('.global-menu');
    if (!menu || !menu.children) {
      return;
    }
    var menu_item = menu.getElementsByTagName('a');

    // menu_item.forEach( function( o ) {
    //   o.addEventListener( 'focus', this.toggle_focus, false );
    //   o.addEventListener( 'blur', this.toggle_focus, false );
    // });

    for (var i = 0; i < menu_item.length; i++) {
      menu_item[i].addEventListener('focus', this.toggle_focus, false);
      menu_item[i].addEventListener('blur', this.toggle_focus, false);
    }
  };
  SubMenuFocus.prototype.toggle_focus = function () {
    var parents = [];
    var p = this.parentNode;
    while (p !== document.querySelector('.global-menu')) {
      var o = p;
      if (o.classList.contains('menu-item')) {
        parents.push(o);
      }
      p = o.parentNode;
    }
    parents.forEach(function (o) {
      o.classList.toggle('focus');
    });
  };
  new SubMenuFocus();
})();

/***/ }),

/***/ 996:
/***/ (() => {

class ToggleMenu {
  constructor() {
    const menu = document.querySelector('.container .site-navi');
    const button = document.querySelector('#js-drawer-btn');
    const overlay = document.querySelector('.drawer-overlay');
    if (!menu && button) {
      button.parentNode.removeChild(button);
      return;
    }
    if (!button) return;
    button.addEventListener('click', this.toggle_drawer, false);
    overlay.addEventListener('click', this.toggle_drawer, false);
    button.addEventListener('keydown', event => {
      // Enter key or o key
      // TODO: Interference between Enter and Space
      if (event.code === 'Space' || event.code === 'KeyO') {
        document.body.classList.toggle('drawer--on');
        document.querySelector('.site-content').setAttribute('tabindex', 0);
      }
    });
    document.body.addEventListener('keydown', event => {
      if (document.body.classList.contains('drawer--on')) {
        // Tab key, out of focus of drawer
        if (event.code === 'Tab' && document.activeElement.classList.contains('site-content')) {
          document.body.classList.toggle('drawer--on');
          document.querySelector('.site-content').removeAttribute('tabindex');
        }
        // Escape key
        if (event.code === 'Escape') {
          document.body.classList.toggle('drawer--on');
          document.querySelector('.site-content').removeAttribute('tabindex');
          button.focus();
        }
      }
    });
  }
  toggle_drawer() {
    document.body.classList.toggle('drawer--on');
    if (document.body.classList.contains('drawer--on')) {
      document.querySelector('.site-content').setAttribute('tabindex', 0);
    } else {
      document.querySelector('.site-content').removeAttribute('tabindex');
    }
  }
}
new ToggleMenu();

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
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
__webpack_require__(996);
__webpack_require__(807);
__webpack_require__(273);
__webpack_require__(416);
})();

/******/ })()
;