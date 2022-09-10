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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/m4u.js":
/*!*****************************!*\
  !*** ./resources/js/m4u.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener('DOMContentLoaded', function () {
  maxInputsCounter();
  beadsAmountAddColorChoosers();
  displayShippingAddressFields();
  var shippingAddressCheckbox = document.getElementById('invoice_is_not_shipping');

  if (shippingAddressCheckbox) {
    shippingAddressCheckbox.addEventListener('change', function () {
      displayShippingAddressFields();
    });
  }
});

function maxInputsCounter() {
  var inputsWithMaxLength = document.querySelectorAll("input[maxlength]");
  inputsWithMaxLength.forEach(function (inputWithMaxLength) {
    var counterEl = inputWithMaxLength.parentNode.querySelector('.input-group-text');

    if (counterEl) {
      inputWithMaxLength.addEventListener('input', function () {
        counterEl.innerHTML = inputWithMaxLength.value.length + '/10';
      });
    }
  });
}

function beadsAmountAddColorChoosers() {
  var beadsAmountElements = document.querySelectorAll('input[name="beadsAmount"]');
  beadsAmountElements.forEach(function (amountEl) {
    amountEl.addEventListener('change', function () {
      var beadsAmount = beadsAmountElements.length;

      if (document.querySelector('input[name="beadsAmount"]:checked')) {
        beadsAmount = document.querySelector('input[name="beadsAmount"]:checked').value;
      }

      var colorChoosersContainer = document.getElementById('beadsAmountColors');
      var allChoosers = colorChoosersContainer.querySelectorAll('.colorChooser');
      allChoosers.forEach(function (chooser, index) {
        if (index + 1 <= beadsAmount) {
          // Show this color chooser
          chooser.style.display = 'block';
        } else {
          chooser.style.display = 'none';
        }
      });
    });
  });
}

function displayShippingAddressFields() {
  var checkbox = document.getElementById('invoice_is_not_shipping');
  var shippingAddressContainer = document.getElementById('shipping_address');

  if (!checkbox || !shippingAddressContainer) {
    return;
  }

  if (checkbox.checked) {
    if (shippingAddressContainer.querySelector('[name="shipping_first_name"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_first_name"]').value = document.querySelector('[name="invoice_first_name"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_last_name"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_last_name"]').value = document.querySelector('[name="invoice_last_name"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_company_name"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_company_name"]').value = document.querySelector('[name="invoice_company_name"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_country"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_country"]').value = document.querySelector('[name="invoice_country"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_street"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_street"]').value = document.querySelector('[name="invoice_street"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_house_number"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_house_number"]').value = document.querySelector('[name="invoice_house_number"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_house_number_ext"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_house_number_ext"]').value = document.querySelector('[name="invoice_house_number_ext"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_postal_code"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_postal_code"]').value = document.querySelector('[name="invoice_postal_code"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_city"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_city"]').value = document.querySelector('[name="invoice_city"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_phone"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_phone"]').value = document.querySelector('[name="invoice_phone"]').value;
    }

    if (shippingAddressContainer.querySelector('[name="shipping_email"]').value === '') {
      shippingAddressContainer.querySelector('[name="shipping_email"]').value = document.querySelector('[name="invoice_email"]').value;
    }

    shippingAddressContainer.classList.remove('d-none');
  } else {
    shippingAddressContainer.classList.add('d-none');
  }
}

/***/ }),

/***/ 1:
/*!***********************************!*\
  !*** multi ./resources/js/m4u.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /shared/httpd/iwscms/resources/js/m4u.js */"./resources/js/m4u.js");


/***/ })

/******/ });