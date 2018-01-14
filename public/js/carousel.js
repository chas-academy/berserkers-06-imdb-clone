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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ 7:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(8);


/***/ }),

/***/ 8:
/***/ (function(module, exports) {

var chart = document.querySelectorAll(".min-item");
var dailyPics = document.querySelectorAll(".unit");
var chartIndex = document.querySelectorAll("#chart-carousel-index span");
var dailyPicsIndex = document.querySelectorAll("#daily-pics-carousel-index span");

var Carousel = function Carousel(index, items, displayValue) {
  var _this = this;

  this.counter = 0;
  this.index = index;
  this.items = items;
  this.startX = 0;
  this.displayValue = displayValue;

  this.addEventListenersForItems = function () {
    this.items.forEach(function (item) {
      item.addEventListener('touchstart', nextItem);
      item.addEventListener('touchend', nextItem);
    });
  };

  var nextItem = function nextItem(e) {

    if (window.innerWidth <= 800) {

      if (e.type === 'touchstart') {

        _this.startX = e.touches[0].clientX;
      } else if (e.type === 'touchend') {

        var endX = e.changedTouches[0].clientX;

        _this.index[_this.counter].style.backgroundColor = "rgba(242, 242, 242, 0.39)";
        _this.items[_this.counter].style.display = "none";

        if (_this.startX > endX) {

          if (_this.counter >= _this.index.length - 1) {

            _this.counter = 0;
          } else {

            _this.counter++;
          }
        } else if (_this.startX < endX) {

          if (_this.counter <= 0) {

            _this.counter = _this.index.length - 1;
          } else {

            _this.counter--;
          }
        }

        _this.items[_this.counter].style.display = _this.displayValue;
        _this.index[_this.counter].style.backgroundColor = "#0D7070";
      }
    }
  };
};

var chartCarousel = new Carousel(chartIndex, chart, 'block');
chartCarousel.addEventListenersForItems();
var DailyPicsCarousel = new Carousel(dailyPicsIndex, dailyPics, 'flex');
DailyPicsCarousel.addEventListenersForItems();

/***/ })

/******/ });