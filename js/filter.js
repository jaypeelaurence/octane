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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(6);


/***/ }),

/***/ 6:
/***/ (function(module, exports) {

$(document).ready(function () {
	if (window.origin == "http://127.0.0.1:8000") {
		var location = window.origin;
	} else {
		var location = "http://10.1.9.59/octane";
	}

	// Filter Selection
	$('.senderId .searchField').keypress(function (char) {
		return false;
	});

	$('#btn-account').hide();
	$('#btn-sender').hide();
	$('#btn-user').hide();

	$('#senderContainer .searchField').prop("disabled", true);
	$('#senderContainer button').prop("disabled", true);

	$("div.pickedUser button").attr('class', 'down');
	$("div.pickedUser button").html("<i class='fa fa-angle-down'></i>");

	$("div.pickedAccount button").attr('class', 'down');
	$("div.pickedAccount button").html("<i class='fa fa-angle-down'></i>");

	$('div.pickedSender button').attr('class', 'down');
	$('div.pickedSender button').html("<i class='fa fa-angle-down'></i>");

	$("body").click(function (event) {
		if ($(event.target).parent('div.pickedUser').length == 1 || $(event.target).parent('div#userContainer').length == 1 || $(event.target).parent('div#btn-user').length == 1) {

			var pickedUser = $('div.pickedUser button');

			if (pickedUser.attr('class') == 'down') {
				pickedUser.attr('class', 'up');
				pickedUser.html("<i class='fa fa-angle-up'></i>");
				$('#btn-user').show();
			} else {
				pickedUser.attr('class', 'down');
				pickedUser.html("<i class='fa fa-angle-down'></i>");
				$('#btn-user').hide();
			}

			if ($(event.target).parent('div#btn-user').length == 1 || $(event.target).parent('div#dropDown').length == 1) {
				pickedUser.attr('class', 'up');
				pickedUser.html("<i class='fa fa-angle-up'></i>");
				$('#btn-user').show();
			}
		} else {
			$('#btn-user').hide();

			$('div.pickedUser button').attr('class', 'down');
			$('div.pickedUser button').html("<i class='fa fa-angle-down'></i>");
		}

		if ($(event.target).parent('div.pickedAccount').length == 1 || $(event.target).parent('div#accountContainer').length == 1 || $(event.target).parent('div#btn-account').length == 1) {

			var pickedAccount = $('div.pickedAccount button');

			if (pickedAccount.attr('class') == 'down') {
				pickedAccount.attr('class', 'up');
				pickedAccount.html("<i class='fa fa-angle-up'></i>");
				$('#btn-account').show();
			} else {
				pickedAccount.attr('class', 'down');
				pickedAccount.html("<i class='fa fa-angle-down'></i>");
				$('#btn-account').hide();
			}

			if ($(event.target).parent('div#btn-account').length == 1 || $(event.target).parent('div#dropDown').length == 1) {
				pickedAccount.attr('class', 'up');
				pickedAccount.html("<i class='fa fa-angle-up'></i>");
				$('#btn-account').show();
			}
		} else {
			$('#btn-account').hide();

			$('div.pickedAccount button').attr('class', 'down');
			$('div.pickedAccount button').html("<i class='fa fa-angle-down'></i>");
		}

		if ($(event.target).parent('div.pickedSender').length == 1 || $(event.target).parent('div#senderContainer').length == 1 || $(event.target).parent('div#btn-sender').length == 1) {

			var pickedSender = $('div.pickedSender button');

			if (pickedSender.attr('class') == 'down') {
				pickedSender.attr('class', 'up');
				pickedSender.html("<i class='fa fa-angle-up'></i>");

				$('#btn-sender').show();
			} else {
				pickedSender.attr('class', 'down');
				pickedSender.html("<i class='fa fa-angle-down'></i>");
				$('#btn-sender').hide();
			}

			if ($(event.target).parent('div#btn-sender').length == 1) {
				pickedSender.attr('class', 'up');
				pickedSender.html("<i class='fa fa-angle-up'></i>");
				$('#btn-sender').show();

				$('input.senderField').val('');

				var set = $(event.target);

				var check = 0;
				var len = 0;

				if (set.hasClass('unPick')) {
					$('#btn-sender button').removeClass('pick');
					$('#btn-sender button').addClass('unPick');

					set.removeClass('unPick');
					set.addClass('pick');

					check = 1;
					len = set.val().split(" => ");
				} else {
					$('#btn-sender button').removeClass('pick');
					$('#btn-sender button').addClass('unPick');

					set.removeClass('pick');
					set.addClass('unPick');

					$('.senderId .searchField').val('');
				}

				if (len != 0 && check == 1) {
					$('input.senderField').val(set.val());
					if (len.length == 1) {
						$('.senderId .searchField').val(set.val());
					} else {
						$('.senderId .searchField').val(len[0] + " - " + len[1]);
					}
				}
			}
		} else {
			$('#btn-sender').hide();

			$('div.pickedSender button').attr('class', 'down');
			$('div.pickedSender button').html("<i class='fa fa-angle-down'></i>");
		}
	});

	// Account Selection
	var obj = {};

	var accoutList;

	var load = {
		setAccount: function setAccount() {
			$.ajax({
				url: location + "/report/account",
				type: "GET",
				success: function success(data) {
					for (var i = 0; i < data.length; i++) {
						if (obj[data[i].id]) {
							$('#btn-account').append("<button type='button' class='pick' value='" + data[i].id + " | " + data[i].account + "'>" + data[i].account + "</button>");
						} else {
							$('#btn-account').append("<button type='button' class='unPick' value='" + data[i].id + " | " + data[i].account + "'>" + data[i].account + "</button>");
						}
					}

					accoutist = data;
				},
				error: function error(jqXHR, textStatus, errorThrown) {
					console.log(textStatus + " - " + errorThrown);
				}
			});
		},
		dropAccount: function dropAccount() {
			$('#btn-account button').remove();
		},
		setUser: function setUser() {
			$.ajax({
				url: location + "/manage-account/list/account",
				type: "GET",
				success: function success(data) {
					for (var i = 0; i < data.length; i++) {
						$('#btn-user').append("<button type='button' class='unPick' value='" + data[i].id + " | " + data[i].firstname + " " + data[i].lastname + "'>" + data[i].firstname + " " + data[i].lastname + "</button>");
					}
				},
				error: function error(jqXHR, textStatus, errorThrown) {
					console.log(textStatus + " - " + errorThrown);
				}
			});
		},
		dropUser: function dropUser() {
			$('#btn-user button').remove();
		}
	};

	load.setAccount();

	$('body').click(function (event) {
		if ($(event.target).parent("#btn-user").length == 1) {
			var userButton = $(event.target);

			var picked = userButton.val().split(" | ");
			if (userButton.hasClass('unPick')) {
				$('#btn-user button').removeClass('pick');
				$('#btn-user button').addClass('unPick');
				userButton.addClass('pick');

				userButton.removeClass('unPick');
				userButton.addClass('pick');

				$('.pickedUser .searchField').val(picked[1]);
				$('.userField').val(userButton.val());
			} else {
				$('input.searchField').val("");

				$('.userField').val('');
				userButton.removeClass('pick');
				userButton.addClass('unPick');
			}
		}

		if ($(event.target).parent("#btn-account").length == 1) {
			var accountButton = $(event.target);

			var picked = accountButton.val().split(" | ");

			$('.senderId .senderField').val('');

			if (accountButton.hasClass('unPick')) {
				obj[picked[0]] = picked[1];

				accountButton.removeClass('unPick');
				accountButton.addClass('pick');
			} else {
				delete obj[picked[0]];

				accountButton.removeClass('pick');
				accountButton.addClass('unPick');
			}

			var selected = Object.keys(obj).length;

			var list = '';

			$.each(obj, function (key, value) {
				list += key + "|";
			});

			$(".accountField").val(list);

			if (selected != 0) {
				$('.pickedAccount .searchField').attr('placeholder', selected + " account(s) selected");
			} else {
				$('.pickedAccount .searchField').attr('placeholder', "-- Type account name --");
			}

			if (obj != '' && selected != 0) {
				$('#senderContainer .searchField').prop("disabled", false);
				$('#senderContainer button').prop("disabled", false);

				$(this).parent().append("<input type='hidden' class='accountField' name='account' value='" + list + "'/>");

				$('#btn-sender').html("<button type='button' class='unPick' value='All Sender ID'>-- All Sender ID --</button>");

				$.ajax({
					url: location + "/report/sender/" + list,
					type: "GET",
					success: function success(data) {
						$.each(data, function (key, value) {
							$('#btn-sender').append("<button type='button' class='unPick' value='" + value[0] + " => " + value[1] + "'>" + value[0] + " - " + value[1] + "</button>");
						});
					},
					error: function error(jqXHR, textStatus, errorThrown) {
						console.log(textStatus + " - " + errorThrown);
					}
				});
			} else {
				$('#senderContainer .searchField').prop("disabled", true);
				$('#senderContainer .searchField').val("");
				$('#senderContainer .searchField').attr('placeholder', "-- N/A --");
			}
		}
	});

	load.setUser();

	//AutoComplete Selection	
	var set;

	$('body').on('keyup', function (event) {
		if ($(event.target).parent("div#searchContainer.pickedAccount").length == 1) {
			load.dropAccount();

			clearInterval(set);
			var strAcctValid = null;

			if ($(event.target).val().length == 0) {
				load.setAccount();
			} else {
				strAcctValid = true;
			}

			var timer = 0;
			var run = 0;

			set = setInterval(function () {
				timer += 1;

				if (timer == 2) {
					if (strAcctValid) {
						var strAcct = $(event.target).val().toLowerCase();
						$.ajax({
							url: location + "/report/account/search/" + encodeURI(strAcct),
							type: "GET",
							success: function success(data) {
								console.log(data);

								for (var i = 0; i < data.length; i++) {
									if (obj[data[i].id]) {
										$('#btn-account').append("<button type='button' class='pick' value='" + data[i].id + " | " + data[i].account + "'>" + data[i].account + "</button>");
									} else {
										$('#btn-account').append("<button type='button' class='unPick' value='" + data[i].id + " | " + data[i].account + "'>" + data[i].account + "</button>");
									}
								}
							},
							error: function error(jqXHR, textStatus, errorThrown) {
								console.log(textStatus + " - " + errorThrown);
							}
						});
					}
					clearInterval(set);
				}
			}, 500);
		}

		if ($(event.target).parent("div#searchContainer.pickedUser").length == 1) {
			load.dropUser();

			clearInterval(set);
			var strUserValid = null;

			if ($(event.target).val().length == 0) {
				load.setUser();
			} else {
				strUserValid = true;
			}

			var timer = 0;
			var run = 0;

			set = setInterval(function () {
				timer += 1;

				if (timer == 2) {
					if (strUserValid) {
						var strUser = $(event.target).val();

						$.ajax({
							url: location + "/manage-account/list/account/" + encodeURI(strUser),
							type: "GET",
							success: function success(data) {
								console.log(data);
								for (var i = 0; i < data.length; i++) {
									$('#btn-user').append("<button type='button' class='unPick' value='" + data[i].id + " | " + data[i].firstname + " " + data[i].lastname + "'>" + data[i].firstname + " " + data[i].lastname + "</button>");
								}
							},
							error: function error(jqXHR, textStatus, errorThrown) {
								console.log(textStatus + " - " + errorThrown);
							}
						});
					}
					clearInterval(set);
				}
			}, 500);

			load.dropUser();
		}
	});
});

/***/ })

/******/ });