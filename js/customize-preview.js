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
/******/ 	return __webpack_require__(__webpack_require__.s = 12);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports) {

/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {
  // Site title and description.
  wp.customize('blogname', function (value) {
    value.bind(function (to) {
      $('.site-title a').text(to);
    });
  });
  wp.customize('blogdescription', function (value) {
    value.bind(function (to) {
      $('.site-description').text(to);
    });
  });
  wp.customize('foresight_site_header_options[display_site_title]', function (value) {
    value.bind(function (to) {
      var header_textcolor = wp.customize('header_textcolor').get();

      if ('blank' == header_textcolor) {
        to = false;
      }

      if (to) {
        $('.site-title').css({
          'clip': 'auto',
          'position': 'relative'
        });
      } else {
        $('.site-title').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      }
    });
  });
  wp.customize('foresight_site_header_options[display_site_description]', function (value) {
    value.bind(function (to) {
      var header_textcolor = wp.customize('header_textcolor').get();

      if ('blank' == header_textcolor) {
        to = false;
      }

      if (to) {
        $('.site-description').css({
          'clip': 'auto',
          'position': 'relative'
        });
      } else {
        $('.site-description').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      }
    });
  }); // Header text color.

  wp.customize('header_textcolor', function (value) {
    value.bind(function (to) {
      if (!to) {
        to = 'unset';
      }

      document.documentElement.style.setProperty('--custom-header-text-color', to);
    });
  });
  wp.customize('foresight_color_options[header-background-color]', function (value) {
    value.bind(function (to) {
      if (!to) {
        to = 'unset';
      }

      document.documentElement.style.setProperty('--custom-header-background-color', to);
    });
  });
  wp.customize('foresight_color_options[footer-background-color]', function (value) {
    value.bind(function (to) {
      if (!to) {
        to = 'unset';
      }

      document.documentElement.style.setProperty('--custom-footer-background-color', to);
    });
  });
  wp.customize('foresight_color_options[primary-color]', function (value) {
    value.bind(function (to) {
      if (!to) {
        to = 'unset';
      }

      document.documentElement.style.setProperty('--custom-primary-color', to);
    });
  });
  wp.customize('foresight_color_options[secondary-color]', function (value) {
    value.bind(function (to) {
      if (!to) {
        to = 'unset';
      }

      document.documentElement.style.setProperty('--custom-secondary-color', to);
      document.documentElement.style.setProperty('--custom-link-text-color', to);
    });
  });
  wp.customize('foresight_color_options[tertiary-color]', function (value) {
    value.bind(function (to) {
      if (!to) {
        to = 'unset';
      }

      document.documentElement.style.setProperty('--custom-tertiary-color', to);
      document.documentElement.style.setProperty('--custom-link-text-hover-color', to);
    });
  });
})(jQuery);

/***/ })

/******/ });