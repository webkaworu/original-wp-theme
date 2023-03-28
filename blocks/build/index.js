/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/faq/edit.js":
/*!*************************!*\
  !*** ./src/faq/edit.js ***!
  \*************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "FAQEdit": function() { return /* binding */ FAQEdit; }
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_2__);




function FAQEdit(props) {
  // console.log(props);
  const {
    className,
    setAttributes
  } = props;
  const {
    question,
    questionLabel,
    answerLabel
  } = props.attributes;
  const classes = classnames__WEBPACK_IMPORTED_MODULE_2___default()(className, {
    'faq-wrap': true,
    'blank-box': true,
    'block-box': true
  });
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps)({
    className: classes
  });
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("dl", {
    className: "faq"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("dt", {
    className: "faq-question faq-item"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "faq-question-label faq-item-label"
  }, questionLabel), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "faq-question-content faq-item-content"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.RichText, {
    tagName: "div",
    className: "faq-question-content",
    placeholder: "\u8CEA\u554F\u3092\u5165\u529B\u3057\u3066\u304F\u3060\u3055\u3044\u2026",
    value: question,
    multiline: false,
    onChange: value => setAttributes({
      question: value
    })
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("dd", {
    className: "faq-answer faq-item"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "faq-answer-label faq-item-label"
  }, answerLabel), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "faq-answer-content faq-item-content"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks, null))))));
}
/* harmony default export */ __webpack_exports__["default"] = (FAQEdit);

/***/ }),

/***/ "./src/faq/index.js":
/*!**************************!*\
  !*** ./src/faq/index.js ***!
  \**************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "metadata": function() { return /* reexport default export from named module */ _block_json__WEBPACK_IMPORTED_MODULE_1__; },
/* harmony export */   "name": function() { return /* binding */ name; },
/* harmony export */   "settings": function() { return /* binding */ settings; }
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./src/faq/block.json");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/faq/edit.js");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./save */ "./src/faq/save.js");




const {
  name
} = _block_json__WEBPACK_IMPORTED_MODULE_1__;

const settings = {
  icon: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "512",
    height: "512",
    viewBox: "0 0 512 512"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("g", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M496,128H296V64a8,8,0,0,0-8-8H16a8,8,0,0,0-8,8V304a8,8,0,0,0,8,8H40v56a8,8,0,0,0,13.66,5.66L115.31,312H216v64a8,8,0,0,0,8,8H396.69l61.65,61.66A8,8,0,0,0,472,440V384h24a8,8,0,0,0,8-8V136A8,8,0,0,0,496,128ZM112,296a8.008,8.008,0,0,0-5.66,2.34L56,348.69V304a8,8,0,0,0-8-8H24V72H280V296Zm376,72H464a8,8,0,0,0-8,8v44.69l-50.34-50.35A8.008,8.008,0,0,0,400,368H232V312h56a8,8,0,0,0,8-8V144H488Z"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M341.31,311.534a8,8,0,0,0,10.224-4.843L363.924,272h40.152l12.39,34.691a8,8,0,0,0,15.068-5.382l-40-112a8,8,0,0,0-15.068,0l-40,112A8,8,0,0,0,341.31,311.534ZM384,215.786,398.362,256H369.638Z"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M194.19,214.876A47.708,47.708,0,0,0,200,192V160a48,48,0,0,0-96,0v32a47.976,47.976,0,0,0,80.228,35.542l10.115,10.115a8,8,0,0,0,11.314-11.314ZM152,224a32.036,32.036,0,0,1-32-32V160a32,32,0,0,1,64,0v32a31.848,31.848,0,0,1-1.882,10.8l-8.461-8.461a8,8,0,0,0-11.314,11.314l10.55,10.55A31.852,31.852,0,0,1,152,224Z"
  }))),
  example: {},
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"],
  save: _save__WEBPACK_IMPORTED_MODULE_3__["default"]
};

/***/ }),

/***/ "./src/faq/save.js":
/*!*************************!*\
  !*** ./src/faq/save.js ***!
  \*************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ save; }
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_2__);



function save({
  attributes
}) {
  const {
    question,
    questionLabel,
    answerLabel,
    questionColor,
    answerColor,
    backgroundColor,
    textColor,
    borderColor,
    fontSize
  } = attributes;
  const questionClass = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.getColorClassName)('question-color', questionColor);
  const answerClass = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.getColorClassName)('answer-color', answerColor);
  const backgroundClass = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.getColorClassName)('background-color', backgroundColor);
  const textClass = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.getColorClassName)('color', textColor);
  const borderClass = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.getColorClassName)('border-color', borderColor);
  const fontSizeClass = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.getFontSizeClass)(fontSize);
  const className = classnames__WEBPACK_IMPORTED_MODULE_2___default()({
    'faq-wrap': true,
    'blank-box': true,
    'block-box': true,
    'has-question-color': questionColor,
    'has-answer-color': answerColor,
    'has-text-color': textColor,
    'has-background': backgroundColor,
    'has-border-color': borderColor,
    [questionClass]: questionClass,
    [answerClass]: answerClass,
    [textClass]: textClass,
    [backgroundClass]: backgroundClass,
    [borderClass]: borderClass,
    [fontSizeClass]: fontSizeClass
  });
  const blockProps = _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps.save({
    className: className
  });
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "card faq_card"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", {
    className: "card-header"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    className: "card-link",
    href: "#"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "title"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.RichText.Content, {
    value: question
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "icon"
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "collapse"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "card-body"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "answer_text"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks.Content, null))))));
}

/***/ }),

/***/ "./src/ggmap/edit.js":
/*!***************************!*\
  !*** ./src/ggmap/edit.js ***!
  \***************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _embed_placeholder__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./embed-placeholder */ "./src/ggmap/embed-placeholder.js");
/* harmony import */ var _embed_preview__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./embed-preview */ "./src/ggmap/embed-preview.js");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/primitives */ "@wordpress/primitives");
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_5__);








const EmbedEdit = props => {
  const [isEditMode, setEditMode] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(true);
  const {
    attributes: {
      iframe,
      previewable
    },
    setAttributes,
    isSelected
  } = props;

  const onChangePreviewable = newPreviewable => {
    setAttributes({
      previewable: newPreviewable === undefined ? false : newPreviewable
    });
  };

  const setIframe = newIframe => {
    setAttributes({
      iframe: newIframe === undefined ? '' : newIframe
    });
  };

  const getBlockControls = () => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.BlockControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Toolbar, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Button, {
      label: "Edit",
      icon: "edit",
      className: "my-custom-button",
      onClick: () => onChangePreviewable(!previewable)
    })));
  };

  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.useBlockProps)();

  if (!previewable) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_5__.View, blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_embed_placeholder__WEBPACK_IMPORTED_MODULE_1__["default"], {
      onSubmit: event => {
        if (event) {
          event.preventDefault();
        }

        onChangePreviewable(true);
        setAttributes({
          iframe
        });
      },
      value: iframe,
      onChange: event => setIframe(event.target.value)
    }));
  }

  return [getBlockControls(), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_5__.View, blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_embed_preview__WEBPACK_IMPORTED_MODULE_2__["default"], {
    iframe: iframe,
    isSelected: isSelected
  }))];
};

/* harmony default export */ __webpack_exports__["default"] = (EmbedEdit);

/***/ }),

/***/ "./src/ggmap/embed-placeholder.js":
/*!****************************************!*\
  !*** ./src/ggmap/embed-placeholder.js ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);




const EmbedPlaceholder = ({
  value,
  onSubmit,
  onChange,
  cannotEmbed,
  fallback,
  tryAgain
}) => {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Placeholder, {
    icon: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.BlockIcon, {
      icon: "location-alt",
      showColors: true
    }),
    label: "Google Map",
    className: "wp-block-embed custom_meta_box",
    instructions: "\u30B5\u30A4\u30C8\u306B\u8868\u793A\u3057\u305F\u3044\u30B0\u30FC\u30B0\u30EB\u30DE\u30C3\u30D7\u306Eiframe\u3092\u8CBC\u308A\u4ED8\u3051\u307E\u3059\u3002"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("form", {
    onSubmit: onSubmit
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "d-flex w-100"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    className: "form-control",
    placeholder: "\u30B0\u30FC\u30B0\u30EB\u30DE\u30C3\u30D7\u306E\u57CB\u3081\u8FBC\u307F\u30B3\u30FC\u30C9\u3092\u3053\u3053\u306B\u5165\u529B\u3057\u3066\u304F\u3060\u3055\u3044\u3002",
    rows: "3",
    onChange: onChange
  }, value || ''), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Button, {
    variant: "primary",
    className: "is-primary align-self-center ms-3",
    type: "submit"
  }, "\u57CB\u3081\u8FBC\u307F"))), cannotEmbed && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "components-placeholder__error"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "components-placeholder__instructions"
  }, "\u3053\u306E\u30B3\u30F3\u30C6\u30F3\u30C4\u3092\u57CB\u3081\u8FBC\u3080\u3053\u3068\u304C\u3067\u304D\u307E\u305B\u3093\u3002"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Button, {
    variant: "secondary",
    onClick: tryAgain
  }, "\u3082\u3046\u4E00\u5EA6")));
};

/* harmony default export */ __webpack_exports__["default"] = (EmbedPlaceholder);

/***/ }),

/***/ "./src/ggmap/embed-preview.js":
/*!************************************!*\
  !*** ./src/ggmap/embed-preview.js ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);



class EmbedPreview extends _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Component {
  constructor() {
    super(...arguments);
    this.hideOverlay = this.hideOverlay.bind(this);
    this.state = {
      interactive: false
    };
  }

  static getDerivedStateFromProps(nextProps, state) {
    if (!nextProps.isSelected && state.interactive) {
      return {
        interactive: false
      };
    }

    return null;
  }

  hideOverlay() {
    this.setState({
      interactive: true
    });
  }

  render() {
    const {
      iframe
    } = this.props;
    const {
      interactive
    } = this.state;
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "wp-block-embed__wrapper"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "ggmap",
      dangerouslySetInnerHTML: {
        __html: iframe
      }
    }), !interactive && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "block-library-embed__interactive-overlay",
      onMouseUp: this.hideOverlay
    }));
  }

}

/* harmony default export */ __webpack_exports__["default"] = (EmbedPreview); // const EmbedPreview = ( {
// 	iframe
// } ) => {
// 	return (
// 		<div className="ggmap" dangerouslySetInnerHTML={{__html: iframe}} />
// 	);
// };
// export default EmbedPreview;

/***/ }),

/***/ "./src/ggmap/index.js":
/*!****************************!*\
  !*** ./src/ggmap/index.js ***!
  \****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "metadata": function() { return /* reexport default export from named module */ _block_json__WEBPACK_IMPORTED_MODULE_0__; },
/* harmony export */   "name": function() { return /* binding */ name; },
/* harmony export */   "settings": function() { return /* binding */ settings; }
/* harmony export */ });
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./block.json */ "./src/ggmap/block.json");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./edit */ "./src/ggmap/edit.js");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./save */ "./src/ggmap/save.js");



const {
  name
} = _block_json__WEBPACK_IMPORTED_MODULE_0__;

const settings = {
  icon: 'location-alt',
  example: {},
  edit: _edit__WEBPACK_IMPORTED_MODULE_1__["default"],
  save: _save__WEBPACK_IMPORTED_MODULE_2__["default"]
}; // registerBlockType( 'theme-origin/google-map', {
// 	title      : 'Google Map',
// 	icon       : 'location-alt',
// 	category   : 'theme-origin',
// 	description: 'グーグルマップを埋め込みます。',
// 	keywords   : ['グーグル', 'マップ', 'google', 'map'],
// 	supports   : { align: ['center', 'wide', 'full'] },
// 	attributes : {
// 		iframe: {
// 			type: 'string'
// 		},
// 		previewable: {
// 			type   : 'boolean',
// 			default: false
// 		},
// 		align: {
// 			default: 'center'
// 		}
// 	},
// 	edit,
// 	save
// });

/***/ }),

/***/ "./src/ggmap/save.js":
/*!***************************!*\
  !*** ./src/ggmap/save.js ***!
  \***************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ save; }
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);


function save({
  attributes,
  className
}) {
  const {
    iframe
  } = attributes;

  if (!iframe) {
    return null;
  }

  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps.save({
    className: className
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "ggmap",
    dangerouslySetInnerHTML: {
      __html: iframe
    }
  }));
}

/***/ }),

/***/ "./node_modules/classnames/index.js":
/*!******************************************!*\
  !*** ./node_modules/classnames/index.js ***!
  \******************************************/
/***/ (function(module, exports) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */

(function () {
	'use strict';

	var hasOwn = {}.hasOwnProperty;

	function classNames() {
		var classes = [];

		for (var i = 0; i < arguments.length; i++) {
			var arg = arguments[i];
			if (!arg) continue;

			var argType = typeof arg;

			if (argType === 'string' || argType === 'number') {
				classes.push(arg);
			} else if (Array.isArray(arg)) {
				if (arg.length) {
					var inner = classNames.apply(null, arg);
					if (inner) {
						classes.push(inner);
					}
				}
			} else if (argType === 'object') {
				if (arg.toString === Object.prototype.toString) {
					for (var key in arg) {
						if (hasOwn.call(arg, key) && arg[key]) {
							classes.push(key);
						}
					}
				} else {
					classes.push(arg.toString());
				}
			}
		}

		return classes.join(' ');
	}

	if ( true && module.exports) {
		classNames.default = classNames;
		module.exports = classNames;
	} else if (true) {
		// register as 'classnames', consistent with npm package name
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function () {
			return classNames;
		}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else {}
}());


/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/primitives":
/*!************************************!*\
  !*** external ["wp","primitives"] ***!
  \************************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["primitives"];

/***/ }),

/***/ "./src/faq/block.json":
/*!****************************!*\
  !*** ./src/faq/block.json ***!
  \****************************/
/***/ (function(module) {

"use strict";
module.exports = JSON.parse('{"apiVersion":2,"name":"theme-origin/faq","title":"FAQ","category":"theme-origin","description":"よくある質問と回答。","keywords":["よくある","質問","FAQ","faq"],"attributes":{"question":{"type":"string","default":""},"questionLabel":{"type":"string","default":"Q"},"answerLabel":{"type":"string","default":"A"}}}');

/***/ }),

/***/ "./src/ggmap/block.json":
/*!******************************!*\
  !*** ./src/ggmap/block.json ***!
  \******************************/
/***/ (function(module) {

"use strict";
module.exports = JSON.parse('{"apiVersion":2,"name":"theme-origin/google-map","title":"Google Map","category":"theme-origin","description":"グーグルマップを埋め込みます。","keywords":["グーグル","マップ","google","map"],"textdomain":"default","attributes":{"iframe":{"type":"string"},"previewable":{"type":"boolean","default":false},"align":{"default":"center"}},"supports":{"align":["wide","full"]}}');

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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "__experimentalGetCoreBlocks": function() { return /* binding */ __experimentalGetCoreBlocks; },
/* harmony export */   "registerCoreBlocks": function() { return /* binding */ registerCoreBlocks; }
/* harmony export */ });
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _ggmap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ggmap */ "./src/ggmap/index.js");
/* harmony import */ var _faq__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./faq */ "./src/faq/index.js");
/**
 * WordPress dependencies
 */

/**
 * Internal dependencies
 */



/**
 * Function to register an individual block.
 *
 * @param {Object} block The block to be registered.
 *
 */

const registerBlock = block => {
  if (!block) {
    return;
  }

  const {
    metadata,
    settings,
    name
  } = block;
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)({
    name,
    ...metadata
  }, settings);
};

const __experimentalGetCoreBlocks = () => [_ggmap__WEBPACK_IMPORTED_MODULE_1__, _faq__WEBPACK_IMPORTED_MODULE_2__];
const registerCoreBlocks = (blocks = __experimentalGetCoreBlocks()) => {
  blocks.forEach(registerBlock);
};
registerCoreBlocks();
}();
/******/ })()
;
//# sourceMappingURL=index.js.map