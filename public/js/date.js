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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(4);


/***/ }),
/* 4 */
/***/ (function(module, exports) {

$(document).ready(function () {
	var date = new Date();
	var yesterday = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 1);
	var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
	var days;

	$('#startDate').datepicker({
		uiLibrary: 'bootstrap4',
		iconsLibrary: 'fontawesome',
		maxDate: yesterday
	});

	$('#endDate').datepicker({
		uiLibrary: 'bootstrap4',
		iconsLibrary: 'fontawesome',
		minDate: function minDate() {
			return $('#startDate').val();
		},
		maxDate: function maxDate() {
			var startDate = new Date($('#startDate').val());

			var checkDate = startDate.getDate() + 7;

			if (checkDate > 31) {
				days = checkDate - 30;
			} else if (checkDate > today.getDate()) {
				days = today.getDate() - startDate.getDate() - 1;
			} else {
				days = 6;
			}

			return new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + days);
		}
	});

	if ($("#startDate").val() == '') {
		$('.end #endDate').prop('disabled', true);
		$('.end button').prop('disabled', true);
	}

	$("#startDate").change(function () {
		$('.end #endDate').prop('disabled', false);
		$('.end button').prop('disabled', false);
		$('#endDate').val('');
	});
});

/***/ })
/******/ ]);