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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/shopresponsive.js":
/*!****************************************!*\
  !*** ./resources/js/shopresponsive.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//Created by Alvin S. Raquem
//2019
var toggle = document.getElementById('toggle-button');
var nav = document.getElementById("mainnav");
var dropdowncontent = document.getElementsByClassName("dropdown-content");

if (toggle) {
  toggle.onclick = function () {
    if (nav.style.width == "100%") {
      nav.style.width = "0";

      for (var y = 0; y < dropdowncontent.length; y++) {
        if (x != y) {
          dropdowncontent[y].style.display = "none";
        }
      }
    } else {
      nav.style.width = "100%";
    }
  };
}

function match(x) {
  if (x.matches && nav) {
    nav.style.width = "100%";
  } else {
    if (nav) {
      nav.style.width = "0";

      for (var y = 0; y < dropdowncontent.length; y++) {
        if (x != y) {
          dropdowncontent[y].style.display = "none";
        }
      }
    }
  }
}

var x = window.matchMedia("(min-width: 801px)");
match(x);
x.addListener(match);
var dropbtn = document.getElementsByClassName("dropbtn");

var _loop = function _loop(_x) {
  dropbtn[_x].onclick = function () {
    for (var y = 0; y < dropdowncontent.length; y++) {
      if (_x != y) {
        dropdowncontent[y].style.display = "none";
      }
    }

    var childdiv = this.nextElementSibling;
    childdiv.style.display == "block" ? childdiv.style.display = "none" : childdiv.style.display = "block";
  };
};

for (var _x = 0; _x < dropbtn.length; _x++) {
  _loop(_x);
}

function OpenDisplay(evt, targetdiv) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tab-content");

  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");

  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(targetdiv).style.display = "block";
  evt.currentTarget.className += " active";
}

if (document.getElementById("defaultOpen")) {
  document.getElementById("defaultOpen").click();
}

/***/ }),

/***/ 2:
/*!**********************************************!*\
  !*** multi ./resources/js/shopresponsive.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Alvin\Desktop\Ashop\resources\js\shopresponsive.js */"./resources/js/shopresponsive.js");


/***/ })

/******/ });