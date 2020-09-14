/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ({

/***/ 11:
/***/ (function(module, exports) {

(function ($) {
  wp.customize.bind('ready', function () {
    wp.customize('header_textcolor', function (setting) {
      wp.customize.control('foresight_site_header_options[display_site_title]', function (control) {
        var checkbox_toggle = function checkbox_toggle(val) {
          if ('blank' === setting.get()) {
            control.setting.set(false);
            control.container.hide(0);
          } else {
            if ('init' != val) {
              control.setting.set(true);
            }

            control.container.show(0);
          }
        };

        checkbox_toggle('init');
        setting.bind(checkbox_toggle);
      });
      wp.customize.control('foresight_site_header_options[display_site_description]', function (control) {
        var checkbox_toggle = function checkbox_toggle(val) {
          if ('blank' === setting.get()) {
            control.setting.set(false);
            control.container.hide(0);
          } else {
            if ('init' != val) {
              control.setting.set(true);
            }

            control.container.show(0);
          }
        };

        checkbox_toggle('init');
        setting.bind(checkbox_toggle);
      });
    });
    wp.customize('foresight_excerpt_options[excerpt_type]', function (setting) {
      wp.customize.control('foresight_excerpt_options[excerpt_length]', function (control) {
        var visibility = function visibility() {
          if ('summary' == setting.get()) {
            control.container.show(0);
          } else {
            control.container.hide(0);
          }
        };

        visibility();
        setting.bind(visibility);
      });
      wp.customize.control('foresight_excerpt_options[more_reading_link]', function (control) {
        var visibility = function visibility() {
          if ('summary' == setting.get()) {
            control.container.show(0);
          } else {
            control.container.hide(0);
          }
        };

        visibility();
        setting.bind(visibility);
      });
    });
    wp.customize.control('blogdescription').priority(20);
  });
})(jQuery);

(function ($) {
  $(document).ready(function () {
    $('.sortable-container').sortable({
      cursor: 'move',
      opacity: 0.7,
      placeholder: 'sortable-placeholder',
      handle: '.ui-handle',
      update: function update(e, ui) {
        $('.multiple-checkbox-item').trigger('change');
      }
    });
    $('.multiple-checkbox-item').on('change', function () {
      sortable_values = $(this).parents('.sortable-container').find('.multiple-checkbox-item').map(function () {
        if ($(this).prop('checked')) {
          return this.value;
        }

        return null;
      }).get().join(',');
      $(this).parents('.sortable-container').prev('.customize-control-multiple-checkbox').val(sortable_values).trigger('change');
    });
  });
})(jQuery);

/***/ })

/******/ });