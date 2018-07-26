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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

$(document).ready(function () {
	console.log(window.location.origin);
	// DatePicker
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

	// AccountSelection
	$('#btn-sender').prop("disabled", true);
	$('#btn-account').hide();

	$(".pickedAccount button").attr('class', 'down');
	$(".pickedAccount button").html("<i class='fa fa-angle-down'></i>");

	// $("body").click(function(event){
	// 	if($(event.target).parent('div#accountContainer').length == 1){
	// 		console.log("accountContainer");

	// 		$('#btn-account').show();

	// 		if($(event.target).attr('class') == 'pickedAccount'){
	// 			$('#btn-account').show();
	// 		}
	// 	}else{
	// 		$('#btn-account').hide();
	// 	}
	// });

	$(".pickedAccount").click(function (event) {
		if ($(this).children("button").attr('class') == 'down') {
			$(this).children("button").attr('class', 'up');
			$(this).children("button").html("<i class='fa fa-angle-up'></i>");
			$('#btn-account').show();
		} else {
			$(this).children("button").attr('class', 'down');
			$(this).children("button").html("<i class='fa fa-angle-down'></i>");
			$('#btn-account').hide();
		}
	});

	var obj = {};

	$('#btn-account button').click(function () {
		var picked = $(this).val().split("|");

		if ($(this).hasClass('unPick')) {
			obj[picked[0]] = picked[1];

			$(this).removeClass('unPick');
			$(this).addClass('pick');
		} else {
			delete obj[picked[0]];

			$(this).removeClass('pick');
			$(this).addClass('unPick');
		}

		var selected = Object.keys(obj).length;

		var list = '';

		$.each(obj, function (key, value) {
			list += key + "|";
		});

		$(".accountField").val(list);

		if (selected != 0) {
			$('.pickedAccount span').html(selected + " account(s) selected");
		} else {
			$('.pickedAccount span').html("-- select account --");
		}

		// SenderSelection
		if (obj != '' && selected != 0) {
			$('#btn-sender').prop("disabled", false);
			$('#btn-sender').attr('placeholder', "-- all sender Id --");

			$(this).parent().append("<input type='hidden' class='accountField' name='account' value='" + list + "'/>");

			$.ajax({
				url: window.location.origin + "/report/sender/" + list,
				type: "GET",
				success: function success(data) {
					console.log(data);
				},

				//  	 	$('#btn-sender').append("<option class='senderId' value='all'>-- All Sender ID --</option>");
				//   	$.each(data, function(key, value){
				//    $('#btn-sender').append("<option class='senderId' value='" + value + "'>" + value + "</option>");
				// });
				error: function error(jqXHR, textStatus, errorThrown) {
					console.log(textStatus + " - " + errorThrown);
				}
			});
		} else {
			$('#btn-sender').prop("disabled", true);
			$('#btn-sender').attr('placeholder', "-- n/attr --");
		}
	});
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);