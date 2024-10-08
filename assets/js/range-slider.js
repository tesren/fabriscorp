(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else if(typeof exports === 'object')
		exports["RangeSlider"] = factory();
	else
		root["RangeSlider"] = factory();
})(self, () => {
return /******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ 682:
/***/ ((module, __webpack_exports__, __webpack_require__) => {

/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Z": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(81);
/* harmony import */ var _node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(645);
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__);
// Imports


var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default()((_node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default()));
// Module
___CSS_LOADER_EXPORT___.push([module.id, ".range-slider__container{ \r\n    margin-bottom: 100px;\r\n}\r\n\r\n.range-slider__container{\r\n    position: relative;\r\n}\r\n\r\n.range-slider__container span{\r\n    display: inline-block;\r\n}\r\n\r\n.range-slider__rail {\r\n    width: 100%;\r\n    position: absolute;\r\n    transform: translateY(-50%);\r\n    left: 0;\r\n\r\n    cursor: pointer;\r\n}\r\n\r\n.range-slider__track {\r\n    position: absolute;\r\n    transform: translateY(-50%);\r\n    cursor: pointer;\r\n}\r\n\r\n.range-slider__point {\r\n    top: 0;\r\n    transform: translateX(-50%);\r\n    position: absolute;\r\n    border-radius: 50%;\r\n    cursor: pointer;\r\n    transition: box-shadow 150ms;\r\n}\r\n\r\n.range-slider__container .range-slider__tooltip {\r\n    min-width: 30px;\r\n    font-size: 16px;\r\n    padding: 0.3em 0.6em;\r\n    background-color: gray;\r\n    color: white;\r\n    position: absolute;\r\n    left: 0;\r\n    top: -100%;\r\n    text-align: center;\r\n    border-radius: 3px;\r\n    user-select: none;\r\n    transform: translate(-50%, -50%) scale(0);\r\n    transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;\r\n}\r\n\r\n.range-slider__container .range-slider__tooltip::after {\r\n    content: '';\r\n    background-color: gray;\r\n    width: 1em;\r\n    height: 1em;\r\n    position: absolute;\r\n    bottom: -5px;\r\n    transform: translate(-50%) rotate(45deg);\r\n    left: 50%;\r\n    z-index: -1;\r\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ 645:
/***/ ((module) => {



/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
module.exports = function (cssWithMappingToString) {
  var list = []; // return the list of modules as css string

  list.toString = function toString() {
    return this.map(function (item) {
      var content = "";
      var needLayer = typeof item[5] !== "undefined";

      if (item[4]) {
        content += "@supports (".concat(item[4], ") {");
      }

      if (item[2]) {
        content += "@media ".concat(item[2], " {");
      }

      if (needLayer) {
        content += "@layer".concat(item[5].length > 0 ? " ".concat(item[5]) : "", " {");
      }

      content += cssWithMappingToString(item);

      if (needLayer) {
        content += "}";
      }

      if (item[2]) {
        content += "}";
      }

      if (item[4]) {
        content += "}";
      }

      return content;
    }).join("");
  }; // import a list of modules into the list


  list.i = function i(modules, media, dedupe, supports, layer) {
    if (typeof modules === "string") {
      modules = [[null, modules, undefined]];
    }

    var alreadyImportedModules = {};

    if (dedupe) {
      for (var k = 0; k < this.length; k++) {
        var id = this[k][0];

        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }

    for (var _k = 0; _k < modules.length; _k++) {
      var item = [].concat(modules[_k]);

      if (dedupe && alreadyImportedModules[item[0]]) {
        continue;
      }

      if (typeof layer !== "undefined") {
        if (typeof item[5] === "undefined") {
          item[5] = layer;
        } else {
          item[1] = "@layer".concat(item[5].length > 0 ? " ".concat(item[5]) : "", " {").concat(item[1], "}");
          item[5] = layer;
        }
      }

      if (media) {
        if (!item[2]) {
          item[2] = media;
        } else {
          item[1] = "@media ".concat(item[2], " {").concat(item[1], "}");
          item[2] = media;
        }
      }

      if (supports) {
        if (!item[4]) {
          item[4] = "".concat(supports);
        } else {
          item[1] = "@supports (".concat(item[4], ") {").concat(item[1], "}");
          item[4] = supports;
        }
      }

      list.push(item);
    }
  };

  return list;
};

/***/ }),

/***/ 81:
/***/ ((module) => {



module.exports = function (i) {
  return i[1];
};

/***/ }),

/***/ 379:
/***/ ((module) => {



var stylesInDOM = [];

function getIndexByIdentifier(identifier) {
  var result = -1;

  for (var i = 0; i < stylesInDOM.length; i++) {
    if (stylesInDOM[i].identifier === identifier) {
      result = i;
      break;
    }
  }

  return result;
}

function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var indexByIdentifier = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3],
      supports: item[4],
      layer: item[5]
    };

    if (indexByIdentifier !== -1) {
      stylesInDOM[indexByIdentifier].references++;
      stylesInDOM[indexByIdentifier].updater(obj);
    } else {
      var updater = addElementStyle(obj, options);
      options.byIndex = i;
      stylesInDOM.splice(i, 0, {
        identifier: identifier,
        updater: updater,
        references: 1
      });
    }

    identifiers.push(identifier);
  }

  return identifiers;
}

function addElementStyle(obj, options) {
  var api = options.domAPI(options);
  api.update(obj);

  var updater = function updater(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap && newObj.supports === obj.supports && newObj.layer === obj.layer) {
        return;
      }

      api.update(obj = newObj);
    } else {
      api.remove();
    }
  };

  return updater;
}

module.exports = function (list, options) {
  options = options || {};
  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];

    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDOM[index].references--;
    }

    var newLastIdentifiers = modulesToDom(newList, options);

    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];

      var _index = getIndexByIdentifier(_identifier);

      if (stylesInDOM[_index].references === 0) {
        stylesInDOM[_index].updater();

        stylesInDOM.splice(_index, 1);
      }
    }

    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ }),

/***/ 569:
/***/ ((module) => {



var memo = {};
/* istanbul ignore next  */

function getTarget(target) {
  if (typeof memo[target] === "undefined") {
    var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

    if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
      try {
        // This will throw an exception if access to iframe is blocked
        // due to cross-origin restrictions
        styleTarget = styleTarget.contentDocument.head;
      } catch (e) {
        // istanbul ignore next
        styleTarget = null;
      }
    }

    memo[target] = styleTarget;
  }

  return memo[target];
}
/* istanbul ignore next  */


function insertBySelector(insert, style) {
  var target = getTarget(insert);

  if (!target) {
    throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
  }

  target.appendChild(style);
}

module.exports = insertBySelector;

/***/ }),

/***/ 216:
/***/ ((module) => {



/* istanbul ignore next  */
function insertStyleElement(options) {
  var element = document.createElement("style");
  options.setAttributes(element, options.attributes);
  options.insert(element, options.options);
  return element;
}

module.exports = insertStyleElement;

/***/ }),

/***/ 565:
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {



/* istanbul ignore next  */
function setAttributesWithoutAttributes(styleElement) {
  var nonce =  true ? __webpack_require__.nc : 0;

  if (nonce) {
    styleElement.setAttribute("nonce", nonce);
  }
}

module.exports = setAttributesWithoutAttributes;

/***/ }),

/***/ 795:
/***/ ((module) => {



/* istanbul ignore next  */
function apply(styleElement, options, obj) {
  var css = "";

  if (obj.supports) {
    css += "@supports (".concat(obj.supports, ") {");
  }

  if (obj.media) {
    css += "@media ".concat(obj.media, " {");
  }

  var needLayer = typeof obj.layer !== "undefined";

  if (needLayer) {
    css += "@layer".concat(obj.layer.length > 0 ? " ".concat(obj.layer) : "", " {");
  }

  css += obj.css;

  if (needLayer) {
    css += "}";
  }

  if (obj.media) {
    css += "}";
  }

  if (obj.supports) {
    css += "}";
  }

  var sourceMap = obj.sourceMap;

  if (sourceMap && typeof btoa !== "undefined") {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  options.styleTagTransform(css, styleElement, options.options);
}

function removeStyleElement(styleElement) {
  // istanbul ignore if
  if (styleElement.parentNode === null) {
    return false;
  }

  styleElement.parentNode.removeChild(styleElement);
}
/* istanbul ignore next  */


function domAPI(options) {
  var styleElement = options.insertStyleElement(options);
  return {
    update: function update(obj) {
      apply(styleElement, options, obj);
    },
    remove: function remove() {
      removeStyleElement(styleElement);
    }
  };
}

module.exports = domAPI;

/***/ }),

/***/ 589:
/***/ ((module) => {



/* istanbul ignore next  */
function styleTagTransform(css, styleElement) {
  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css;
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild);
    }

    styleElement.appendChild(document.createTextNode(css));
  }
}

module.exports = styleTagTransform;

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
/******/ 			id: moduleId,
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
/******/ 	/* webpack/runtime/nonce */
/******/ 	(() => {
/******/ 		__webpack_require__.nc = undefined;
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {

// EXPORTS
__webpack_require__.d(__webpack_exports__, {
  "default": () => (/* binding */ RangeSlider)
});

// EXTERNAL MODULE: ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js
var injectStylesIntoStyleTag = __webpack_require__(379);
var injectStylesIntoStyleTag_default = /*#__PURE__*/__webpack_require__.n(injectStylesIntoStyleTag);
// EXTERNAL MODULE: ./node_modules/style-loader/dist/runtime/styleDomAPI.js
var styleDomAPI = __webpack_require__(795);
var styleDomAPI_default = /*#__PURE__*/__webpack_require__.n(styleDomAPI);
// EXTERNAL MODULE: ./node_modules/style-loader/dist/runtime/insertBySelector.js
var insertBySelector = __webpack_require__(569);
var insertBySelector_default = /*#__PURE__*/__webpack_require__.n(insertBySelector);
// EXTERNAL MODULE: ./node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js
var setAttributesWithoutAttributes = __webpack_require__(565);
var setAttributesWithoutAttributes_default = /*#__PURE__*/__webpack_require__.n(setAttributesWithoutAttributes);
// EXTERNAL MODULE: ./node_modules/style-loader/dist/runtime/insertStyleElement.js
var insertStyleElement = __webpack_require__(216);
var insertStyleElement_default = /*#__PURE__*/__webpack_require__.n(insertStyleElement);
// EXTERNAL MODULE: ./node_modules/style-loader/dist/runtime/styleTagTransform.js
var styleTagTransform = __webpack_require__(589);
var styleTagTransform_default = /*#__PURE__*/__webpack_require__.n(styleTagTransform);
// EXTERNAL MODULE: ./node_modules/css-loader/dist/cjs.js!./src/range-slider.css
var range_slider = __webpack_require__(682);
;// CONCATENATED MODULE: ./src/range-slider.css

      
      
      
      
      
      
      
      
      

var options = {};

options.styleTagTransform = (styleTagTransform_default());
options.setAttributes = (setAttributesWithoutAttributes_default());

      options.insert = insertBySelector_default().bind(null, "head");
    
options.domAPI = (styleDomAPI_default());
options.insertStyleElement = (insertStyleElement_default());

var update = injectStylesIntoStyleTag_default()(range_slider/* default */.Z, options);




       /* harmony default export */ const src_range_slider = (range_slider/* default */.Z && range_slider/* default.locals */.Z.locals ? range_slider/* default.locals */.Z.locals : undefined);

;// CONCATENATED MODULE: ./src/range-slider.js
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/*
    This is a RangeSlider html component for one of my projects
    It allows to have multiple points and different ranges of values with specified steps to jumb.
    It has a easy api to customize sizes and colors of points, tracks, etc.
    It has onChange method, which receives and callback and calls it with current values
*/


var RangeSlider = /*#__PURE__*/function () {
  /**
   * Create slider
   * @param  {string} selector
   * @param  {object} props={}
   */
  function RangeSlider(selector) {
    var props = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

    _classCallCheck(this, RangeSlider);

    this.defaultProps = {
      values: [25, 75],
      step: 1,
      min: 0,
      max: 100,
      colors: {
        points: "rgb(25, 118, 210)",
        // ['red', 'green', 'blue']
        rail: "rgba(25, 118, 210, 0.4)",
        tracks: "rgb(25, 118, 210)" // // ['red', 'green']

      },
      pointRadius: 15,
      railHeight: 5,
      trackHeight: 5
    };
    this.allProps = _objectSpread(_objectSpread(_objectSpread({}, this.defaultProps), props), {}, {
      values: _toConsumableArray(props.values || this.defaultProps.values),
      colors: _objectSpread(_objectSpread({}, this.defaultProps.colors), props.colors)
    });
    this.container = this.initContainer(selector);
    this.pointPositions = this.generatePointPositions();
    this.possibleValues = this.generatePossibleValues();
    this.jump = this.container.offsetWidth / Math.ceil((this.allProps.max - this.allProps.min) / this.allProps.step);
    this.rail = this.initRail();
    this.tracks = this.initTracks(this.allProps.values.length - 1);
    this.tooltip = this.initTooltip();
    this.points = this.initPoints(this.allProps.values.length);
    this.drawScene();
    this.documentMouseupHandler = this.documentMouseupHandler.bind(this);
    this.documentMouseMoveHandler = this.documentMouseMoveHandler.bind(this);
    this.selectedPointIndex = -1;
    this.changeHandlers = [];
    return this;
  }
  /**
   * Draw all elements with initial positions
   */


  _createClass(RangeSlider, [{
    key: "drawScene",
    value: function drawScene() {
      var _this = this;

      this.container.classList.add("range-slider__container");
      this.container.appendChild(this.rail);
      this.container.appendChild(this.tooltip);
      this.tracks.forEach(function (track) {
        return _this.container.appendChild(track);
      });
      this.points.forEach(function (point) {
        return _this.container.appendChild(point);
      });
    }
  }, {
    key: "generatePointPositions",
    value: function generatePointPositions() {
      var _this2 = this;

      return this.allProps.values.map(function (value) {
        var percentage = value / _this2.allProps.max * 100;
        return Math.floor(percentage / 100 * _this2.container.offsetWidth);
      });
    }
    /**
     * Generate all values that can slider have starting from min, to max increased by step
     */

  }, {
    key: "generatePossibleValues",
    value: function generatePossibleValues() {
      var values = [];

      for (var i = this.allProps.min; i <= this.allProps.max; i += this.allProps.step) {
        values.push(Math.round(i * 100) / 100);
      }

      if (this.allProps.max % this.allProps.step > 0) {
        values.push(Math.round(this.allProps.max * 100) / 100);
      }

      return values;
    }
    /**
     * Initialize container
     * @param  {string} selector
     */

  }, {
    key: "initContainer",
    value: function initContainer(selector) {
      var container = document.querySelector(selector);
      container.classList.add("range-slider__container");
      container.style.height = this.allProps.pointRadius * 2 + "px";
      return container;
    }
    /**
     * Initialize Rail
     */

  }, {
    key: "initRail",
    value: function initRail() {
      var _this3 = this;

      var rail = document.createElement("span");
      rail.classList.add("range-slider__rail");
      rail.style.background = this.allProps.colors.rail;
      rail.style.height = this.allProps.railHeight + "px";
      rail.style.top = this.allProps.pointRadius + "px";
      rail.addEventListener("click", function (e) {
        return _this3.railClickHandler(e);
      });
      return rail;
    }
    /**
     * Initialize all tracks (equal to number of points - 1)
     * @param  {number} count
     */

  }, {
    key: "initTracks",
    value: function initTracks(count) {
      var tracks = [];

      for (var i = 0; i < count; i++) {
        tracks.push(this.initTrack(i));
      }

      return tracks;
    }
    /**
     * Initialize single track at specific index position
     * @param  {number} index
     */

  }, {
    key: "initTrack",
    value: function initTrack(index) {
      var _this4 = this;

      var track = document.createElement("span");
      track.classList.add("range-slider__track");
      var trackPointPositions = this.pointPositions.slice(index, index + 2);
      track.style.left = Math.min.apply(Math, _toConsumableArray(trackPointPositions)) + "px";
      track.style.top = this.allProps.pointRadius + "px";
      track.style.width = Math.max.apply(Math, _toConsumableArray(trackPointPositions)) - Math.min.apply(Math, _toConsumableArray(trackPointPositions)) + "px";
      track.style.height = this.allProps.trackHeight + "px";
      var trackColors = this.allProps.colors.tracks;
      track.style.background = Array.isArray(trackColors) ? trackColors[index] || trackColors[trackColors.length - 1] : trackColors;
      track.addEventListener("click", function (e) {
        return _this4.railClickHandler(e);
      });
      return track;
    }
    /**
     * Initialize all points (equal to number of values)
     * @param  {number} count
     */

  }, {
    key: "initPoints",
    value: function initPoints(count) {
      var points = [];

      for (var i = 0; i < count; i++) {
        points.push(this.initPoint(i));
      }

      return points;
    }
    /**
     * Initialize single track at specific index position
     * @param  {number} index
     */

  }, {
    key: "initPoint",
    value: function initPoint(index) {
      var _this5 = this;

      var point = document.createElement("span");
      point.classList.add("range-slider__point");
      point.style.width = this.allProps.pointRadius * 2 + "px";
      point.style.height = this.allProps.pointRadius * 2 + "px";
      point.style.left = "".concat(this.pointPositions[index] / this.container.offsetWidth * 100, "%");
      var pointColors = this.allProps.colors.points;
      point.style.background = Array.isArray(pointColors) ? pointColors[index] || pointColors[pointColors.length - 1] : pointColors;
      point.addEventListener("mousedown", function (e) {
        return _this5.pointClickHandler(e, index);
      });
      point.addEventListener("mouseover", function (e) {
        return _this5.pointMouseoverHandler(e, index);
      });
      point.addEventListener("mouseout", function (e) {
        return _this5.pointMouseOutHandler(e, index);
      });
      return point;
    }
    /**
     * Initialize tooltip
     */

  }, {
    key: "initTooltip",
    value: function initTooltip() {
      var tooltip = document.createElement("span");
      tooltip.classList.add("range-slider__tooltip");
      tooltip.style.fontSize = this.allProps.pointRadius + "px";
      return tooltip;
    }
    /**
     * Draw points, tracks and tooltip (on rail click or on drag)
     */

  }, {
    key: "draw",
    value: function draw() {
      var _this6 = this;

      this.points.forEach(function (point, i) {
        point.style.left = "".concat(_this6.pointPositions[i] / _this6.container.offsetWidth * 100, "%");
      });
      this.tracks.forEach(function (track, i) {
        var trackPointPositions = _this6.pointPositions.slice(i, i + 2);

        track.style.left = Math.min.apply(Math, _toConsumableArray(trackPointPositions)) + "px";
        track.style.width = Math.max.apply(Math, _toConsumableArray(trackPointPositions)) - Math.min.apply(Math, _toConsumableArray(trackPointPositions)) + "px";
      });
      this.tooltip.style.left = this.pointPositions[this.selectedPointIndex] + "px";
      this.tooltip.textContent = this.allProps.values[this.selectedPointIndex].toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });;
    }
    /**
     * Redraw on rail click
     * @param  {Event} e
     */

  }, {
    key: "railClickHandler",
    value: function railClickHandler(e) {
      var newPosition = this.getMouseRelativePosition(e.pageX);
      var closestPositionIndex = this.getClosestPointIndex(newPosition);
      this.pointPositions[closestPositionIndex] = newPosition;
      this.draw();
    }
    /**
     * Find the closest possible point position fro current mouse position
     * in order to move the point
     * @param  {number} mousePoisition
     */

  }, {
    key: "getClosestPointIndex",
    value: function getClosestPointIndex(mousePoisition) {
      var shortestDistance = Infinity;
      var index = 0;

      for (var i in this.pointPositions) {
        var dist = Math.abs(mousePoisition - this.pointPositions[i]);

        if (shortestDistance > dist) {
          shortestDistance = dist;
          index = i;
        }
      }

      return index;
    }
    /**
     * Stop point moving on mouse up
     */

  }, {
    key: "documentMouseupHandler",
    value: function documentMouseupHandler() {
      var _this7 = this;

      this.changeHandlers.forEach(function (func) {
        return func(_this7.allProps.values);
      });
      this.points[this.selectedPointIndex].style.boxShadow = "none";
      this.selectedPointIndex = -1;
      this.tooltip.style.transform = "translate(-50%, -60%) scale(0)";
      document.removeEventListener("mouseup", this.documentMouseupHandler);
      document.removeEventListener("mousemove", this.documentMouseMoveHandler);
    }
    /**
     * Start point moving on mouse move
     * @param {Event} e
     */

  }, {
    key: "documentMouseMoveHandler",
    value: function documentMouseMoveHandler(e) {
      var newPoisition = this.getMouseRelativePosition(e.pageX);
      var extra = Math.floor(newPoisition % this.jump);

      if (extra > this.jump / 2) {
        newPoisition += this.jump - extra;
      } else {
        newPoisition -= extra;
      }

      if (newPoisition < 0) {
        newPoisition = 0;
      } else if (newPoisition > this.container.offsetWidth) {
        newPoisition = this.container.offsetWidth;
      }

      this.pointPositions[this.selectedPointIndex] = newPoisition;
      this.allProps.values[this.selectedPointIndex] = this.possibleValues[Math.floor(newPoisition / this.jump)];
      this.draw();
    }
    /**
     * Register document listeners on point click
     * and save clicked point index
     * @param {Event} e
     */

  }, {
    key: "pointClickHandler",
    value: function pointClickHandler(e, index) {
      e.preventDefault();
      this.selectedPointIndex = index;
      document.addEventListener("mouseup", this.documentMouseupHandler);
      document.addEventListener("mousemove", this.documentMouseMoveHandler);
    }
    /**
     * Point mouse over box shadow and tooltip displaying
     * @param {Event} e
     * @param {number} index
     */

  }, {
    key: "pointMouseoverHandler",
    value: function pointMouseoverHandler(e, index) {
      var transparentColor = RangeSlider.addTransparencyToColor(this.points[index].style.backgroundColor, 16);

      if (this.selectedPointIndex < 0) {
        this.points[index].style.boxShadow = "0px 0px 0px ".concat(Math.floor(this.allProps.pointRadius / 1.5), "px ").concat(transparentColor);
      }

      this.tooltip.style.transform = "translate(-50%, -60%) scale(1)";
      this.tooltip.style.left = this.pointPositions[index] + "px";
      this.tooltip.textContent = this.allProps.values[index].toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
    }
    /**
     * Add transparency for rgb, rgba or hex color
     * @param {string} color
     * @param {number} percentage
     */

  }, {
    key: "pointMouseOutHandler",
    value:
    /**
     * Hide shadow and tooltip on mouse out
     * @param {Event} e
     * @param {number} index
     */
    function pointMouseOutHandler(e, index) {
      if (this.selectedPointIndex < 0) {
        this.points[index].style.boxShadow = "none";
        this.tooltip.style.transform = "translate(-50%, -60%) scale(0)";
      }
    }
    /**
     * Get mouse position relatively from containers left position on the page
     */

  }, {
    key: "getMouseRelativePosition",
    value: function getMouseRelativePosition(pageX) {
      return pageX - this.container.offsetLeft;
    }
    /**
     * Register onChange callback to call it on slider move end passing all the present values
     */

  }, {
    key: "onChange",
    value: function onChange(func) {
      if (typeof func !== "function") {
        throw new Error("Please provide function as onChange callback");
      }

      this.changeHandlers.push(func);
      return this;
    }
  }], [{
    key: "addTransparencyToColor",
    value: function addTransparencyToColor(color, percentage) {
      if (color.startsWith("rgba")) {
        return color.replace(/(\d+)(?!.*\d)/, percentage + "%");
      }

      if (color.startsWith("rgb")) {
        var newColor = color.replace(/(\))(?!.*\))/, ", ".concat(percentage, "%)"));
        return newColor.replace("rgb", "rgba");
      }

      if (color.startsWith("#")) {
        return color + percentage.toString(16);
      }

      return color;
    }
  }]);

  return RangeSlider;
}();


})();

__webpack_exports__ = __webpack_exports__["default"];
/******/ 	return __webpack_exports__;
/******/ })()
;
});