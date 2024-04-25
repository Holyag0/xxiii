"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Boletos_ListaClientes_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=script&lang=js":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Shared_TitleAndButtonCad_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../Shared/TitleAndButtonCad.vue */ "./resources/js/Shared/TitleAndButtonCad.vue");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @headlessui/vue */ "./node_modules/@headlessui/vue/dist/headlessui.esm.js");



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    TitleAndButtonCad: _Shared_TitleAndButtonCad_vue__WEBPACK_IMPORTED_MODULE_0__["default"],
    Dialog: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.Dialog,
    DialogOverlay: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.DialogOverlay,
    DialogTitle: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.DialogTitle,
    TransitionChild: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.TransitionChild,
    TransitionRoot: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.TransitionRoot
  },
  setup: function setup() {
    var open = (0,vue__WEBPACK_IMPORTED_MODULE_1__.ref)(false);
    return {
      open: open,
      filtro: {
        nome: '',
        status: '',
        cpf: '',
        auto_escola_id: ''
      }
    };
  },
  props: {
    alunos: Object
  },
  methods: {
    searchDespesas: function searchDespesas() {
      this.$inertia.replace(this.route("aluno.search", {
        search: this.filtro
      }));
      this.open = false;
    },
    searchFornecedor: function searchFornecedor() {
      this.$inertia.replace(this.route("aluno.search", {
        search: this.filtro
      }, {
        preserveState: true,
        replace: true
      }));
    },
    limparFiltro: function limparFiltro() {
      this.route("aluno.index");
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/TitleAndButtonCad.vue?vue&type=script&lang=js":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/TitleAndButtonCad.vue?vue&type=script&lang=js ***!
  \*******************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    title: String,
    link: String
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=template&id=ac7b52b4":
/*!**************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=template&id=ac7b52b4 ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "flex flex-col"
};
var _hoisted_2 = {
  "class": "-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"
};
var _hoisted_3 = {
  "class": "grid grid-cols-4 gap-6"
};
var _hoisted_4 = {
  "class": "px-8 sm:col-span-2 lg:col-span-2"
};
var _hoisted_5 = {
  "class": "flex text-sm font-medium text-right-inline"
};

var _hoisted_6 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  "class": "h-5",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
})], -1
/* HOISTED */
);

var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", {
  "class": "sr-only"
}, "F", -1
/* HOISTED */
);

var _hoisted_8 = [_hoisted_6, _hoisted_7];

var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "sr-only"
}, "Filtrar", -1
/* HOISTED */
);

var _hoisted_10 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  "class": "h-5",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z"
})], -1
/* HOISTED */
);

var _hoisted_11 = {
  "class": "inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
};
var _hoisted_12 = {
  "class": "overflow-hidden border-b border-gray-200 shadow sm:rounded-lg"
};
var _hoisted_13 = {
  "class": "min-w-full divide-y divide-gray-200"
};

var _hoisted_14 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", {
  "class": "bg-gray-50"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  scope: "col",
  "class": "px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
}, "Nome"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  scope: "col",
  "class": "px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
}, "CFC"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  scope: "col",
  "class": "px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
}, "Status"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  scope: "col",
  "class": "px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
}, "CPF"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  scope: "col",
  "class": "px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
}, "Ações")])], -1
/* HOISTED */
);

var _hoisted_15 = {
  "class": "bg-white divide-y divide-gray-200"
};
var _hoisted_16 = {
  "class": "px-6 py-4 text-sm text-gray-500 whitespace-nowrap"
};
var _hoisted_17 = {
  "class": "px-6 py-4 text-sm text-gray-500 whitespace-nowrap"
};
var _hoisted_18 = {
  "class": "px-6 py-4 text-sm text-gray-500 whitespace-nowrap"
};
var _hoisted_19 = {
  "class": "px-6 py-4 text-sm text-gray-500 whitespace-nowrap"
};
var _hoisted_20 = {
  "class": "px-6 py-4 text-sm font-medium text-right whitespace-nowrap"
};

var _hoisted_21 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Visualizar");

var _hoisted_22 = {
  "class": "flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0"
};

var _hoisted_23 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "hidden sm:inline-block sm:align-middle sm:h-screen",
  "aria-hidden": "true"
}, "​", -1
/* HOISTED */
);

var _hoisted_24 = {
  "class": "relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6"
};
var _hoisted_25 = {
  "class": "col-span-3 mb-5 sm:col-span-2 lg:col-span-2"
};

var _hoisted_26 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Centro de Custos", -1
/* HOISTED */
);

var _hoisted_27 = ["value"];
var _hoisted_28 = {
  "class": "col-span-3 mb-5 sm:col-span-2 lg:col-span-1"
};

var _hoisted_29 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Status", -1
/* HOISTED */
);

var _hoisted_30 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  selected: ""
}, "Status", -1
/* HOISTED */
);

var _hoisted_31 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "0"
}, "Á receber", -1
/* HOISTED */
);

var _hoisted_32 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "1"
}, "Recebida", -1
/* HOISTED */
);

var _hoisted_33 = [_hoisted_30, _hoisted_31, _hoisted_32];
var _hoisted_34 = {
  "class": "col-span-3 mb-5 sm:col-span-2 lg:col-span-1"
};

var _hoisted_35 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "data_inicio",
  "class": "block text-sm font-medium text-gray-700"
}, "Data Inicial", -1
/* HOISTED */
);

var _hoisted_36 = {
  "class": "col-span-3 mb-5 sm:col-span-2 lg:col-span-1"
};

var _hoisted_37 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "data_fim",
  "class": "block text-sm font-medium text-gray-700"
}, "Data Final", -1
/* HOISTED */
);

var _hoisted_38 = {
  "class": "mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_title_and_button_cad = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("title-and-button-cad");

  var _component_Link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Link");

  var _component_DialogOverlay = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("DialogOverlay");

  var _component_TransitionChild = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("TransitionChild");

  var _component_Dialog = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Dialog");

  var _component_TransitionRoot = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("TransitionRoot");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_title_and_button_cad, {
    link: 'aluno.create',
    title: 'Listagem de Clientes'
  }, null, 8
  /* PROPS */
  , ["link"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    onKeyup: _cache[0] || (_cache[0] = function () {
      return $options.searchFornecedor && $options.searchFornecedor.apply($options, arguments);
    }),
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $setup.filtro.nome = $event;
    }),
    type: "text",
    placeholder: "Pesquisar por aluno",
    "class": "block w-full py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
  }, null, 544
  /* HYDRATE_EVENTS, NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.filtro.nome]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: "#",
    onClick: _cache[2] || (_cache[2] = function ($event) {
      return $setup.open = true;
    }),
    "class": "block px-3 py-2 mx-2 mt-1 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"
  }, _hoisted_8), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
    href: _ctx.route('aluno.index'),
    "class": "block px-3 py-2 mt-1 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_9, _hoisted_10];
    }),
    _: 1
    /* STABLE */

  }, 8
  /* PROPS */
  , ["href"])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_13, [_hoisted_14, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", _hoisted_15, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.alunos.data, function (aluno) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: aluno.id
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_16, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(aluno.nome), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(aluno.auto_escola.nome_fantasia), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <span class=\"inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full\"> Active </span> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(aluno.status), 1
    /* TEXT */
    )]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_19, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(aluno.cpf), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_20, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
      href: _ctx.route('aluno.show', aluno.id),
      "class": "text-sm text-blue-600 hover:text-blue-400"
    }, {
      "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
        return [_hoisted_21];
      }),
      _: 2
      /* DYNAMIC */

    }, 1032
    /* PROPS, DYNAMIC_SLOTS */
    , ["href"])])]);
  }), 128
  /* KEYED_FRAGMENT */
  ))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TransitionRoot, {
    as: "template",
    show: $setup.open
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Dialog, {
        as: "div",
        "class": "fixed inset-0 z-10 overflow-y-auto",
        onClose: _cache[9] || (_cache[9] = function ($event) {
          return $setup.open = false;
        })
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TransitionChild, {
            as: "template",
            enter: "ease-out duration-300",
            "enter-from": "opacity-0",
            "enter-to": "opacity-100",
            leave: "ease-in duration-200",
            "leave-from": "opacity-100",
            "leave-to": "opacity-0"
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_DialogOverlay, {
                "class": "fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
              })];
            }),
            _: 1
            /* STABLE */

          }), _hoisted_23, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TransitionChild, {
            as: "template",
            enter: "ease-out duration-300",
            "enter-from": "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95",
            "enter-to": "opacity-100 translate-y-0 sm:scale-100",
            leave: "ease-in duration-200",
            "leave-from": "opacity-100 translate-y-0 sm:scale-100",
            "leave-to": "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [_hoisted_26, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
                "aria-placeholder": "Centro De Custos",
                "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
                  return $setup.filtro.centro_custo_id = $event;
                }),
                id: "centro_custo_id",
                name: "centro_custo_id",
                "class": "block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.centroCustos, function (centroCusto, index) {
                return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
                  key: index,
                  value: index
                }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(centroCusto), 9
                /* TEXT, PROPS */
                , _hoisted_27);
              }), 128
              /* KEYED_FRAGMENT */
              ))], 512
              /* NEED_PATCH */
              ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $setup.filtro.centro_custo_id]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [_hoisted_29, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
                "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
                  return $setup.filtro.status = $event;
                }),
                id: "status",
                name: "status",
                "class": "block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              }, _hoisted_33, 512
              /* NEED_PATCH */
              ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $setup.filtro.status]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [_hoisted_35, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
                  return $setup.filtro.data_inicio = $event;
                }),
                type: "date",
                name: "data_inicio",
                id: "data_inicio",
                "class": "block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              }, null, 512
              /* NEED_PATCH */
              ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.filtro.data_inicio]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [_hoisted_37, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
                  return $setup.filtro.data_fim = $event;
                }),
                type: "date",
                name: "data_fim",
                id: "data_fim",
                "class": "block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              }, null, 512
              /* NEED_PATCH */
              ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.filtro.data_fim]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
                type: "button",
                onClick: _cache[7] || (_cache[7] = function () {
                  return $options.searchDespesas && $options.searchDespesas.apply($options, arguments);
                }),
                "class": "inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm"
              }, "Filtrar"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
                type: "button",
                "class": "inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm",
                onClick: _cache[8] || (_cache[8] = function ($event) {
                  return $setup.open = false;
                }),
                ref: "cancelButtonRef"
              }, "Cancelar", 512
              /* NEED_PATCH */
              )])])];
            }),
            _: 1
            /* STABLE */

          })])];
        }),
        _: 1
        /* STABLE */

      })];
    }),
    _: 1
    /* STABLE */

  }, 8
  /* PROPS */
  , ["show"])])])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/TitleAndButtonCad.vue?vue&type=template&id=2f40db69":
/*!***********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/TitleAndButtonCad.vue?vue&type=template&id=2f40db69 ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "px-4 py-4 border-b border-gray-200 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8"
};

var _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex-1 min-w-0"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h1", {
  "class": "text-lg font-medium leading-6 text-gray-900 sm:truncate"
})], -1
/* HOISTED */
);

var _hoisted_3 = {
  "class": "flex mt-4 sm:mt-0 sm:ml-4"
};

var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Cadastrar");

function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_Link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Link");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [_hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
    href: _ctx.route($props.link),
    "class": "inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-md shadow-sm order-0 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_4];
    }),
    _: 1
    /* STABLE */

  }, 8
  /* PROPS */
  , ["href"])])]);
}

/***/ }),

/***/ "./resources/js/Pages/Boletos/ListaClientes.vue":
/*!******************************************************!*\
  !*** ./resources/js/Pages/Boletos/ListaClientes.vue ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ListaClientes_vue_vue_type_template_id_ac7b52b4__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ListaClientes.vue?vue&type=template&id=ac7b52b4 */ "./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=template&id=ac7b52b4");
/* harmony import */ var _ListaClientes_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ListaClientes.vue?vue&type=script&lang=js */ "./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=script&lang=js");
/* harmony import */ var _var_www_new_ntc_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_var_www_new_ntc_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_ListaClientes_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_ListaClientes_vue_vue_type_template_id_ac7b52b4__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Boletos/ListaClientes.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Shared/TitleAndButtonCad.vue":
/*!***************************************************!*\
  !*** ./resources/js/Shared/TitleAndButtonCad.vue ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _TitleAndButtonCad_vue_vue_type_template_id_2f40db69__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TitleAndButtonCad.vue?vue&type=template&id=2f40db69 */ "./resources/js/Shared/TitleAndButtonCad.vue?vue&type=template&id=2f40db69");
/* harmony import */ var _TitleAndButtonCad_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TitleAndButtonCad.vue?vue&type=script&lang=js */ "./resources/js/Shared/TitleAndButtonCad.vue?vue&type=script&lang=js");
/* harmony import */ var _var_www_new_ntc_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_var_www_new_ntc_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_TitleAndButtonCad_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_TitleAndButtonCad_vue_vue_type_template_id_2f40db69__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Shared/TitleAndButtonCad.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=script&lang=js":
/*!******************************************************************************!*\
  !*** ./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=script&lang=js ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ListaClientes_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ListaClientes_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./ListaClientes.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/Shared/TitleAndButtonCad.vue?vue&type=script&lang=js":
/*!***************************************************************************!*\
  !*** ./resources/js/Shared/TitleAndButtonCad.vue?vue&type=script&lang=js ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TitleAndButtonCad_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TitleAndButtonCad_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TitleAndButtonCad.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/TitleAndButtonCad.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=template&id=ac7b52b4":
/*!************************************************************************************!*\
  !*** ./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=template&id=ac7b52b4 ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ListaClientes_vue_vue_type_template_id_ac7b52b4__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ListaClientes_vue_vue_type_template_id_ac7b52b4__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./ListaClientes.vue?vue&type=template&id=ac7b52b4 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Boletos/ListaClientes.vue?vue&type=template&id=ac7b52b4");


/***/ }),

/***/ "./resources/js/Shared/TitleAndButtonCad.vue?vue&type=template&id=2f40db69":
/*!*********************************************************************************!*\
  !*** ./resources/js/Shared/TitleAndButtonCad.vue?vue&type=template&id=2f40db69 ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TitleAndButtonCad_vue_vue_type_template_id_2f40db69__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TitleAndButtonCad_vue_vue_type_template_id_2f40db69__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TitleAndButtonCad.vue?vue&type=template&id=2f40db69 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/TitleAndButtonCad.vue?vue&type=template&id=2f40db69");


/***/ })

}]);