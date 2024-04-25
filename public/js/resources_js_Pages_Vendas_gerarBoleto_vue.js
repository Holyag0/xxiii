"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Vendas_gerarBoleto_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=script&lang=js":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=script&lang=js ***!
  \*******************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _inertiajs_inertia_vue3__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @inertiajs/inertia-vue3 */ "./node_modules/@inertiajs/inertia-vue3/dist/index.js");
/* harmony import */ var vue_the_mask__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-the-mask */ "./node_modules/vue-the-mask/dist/vue-the-mask.js");
/* harmony import */ var vue_the_mask__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue_the_mask__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _headlessui_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @headlessui/vue */ "./node_modules/@headlessui/vue/dist/components/dialog/dialog.js");
/* harmony import */ var _headlessui_vue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @headlessui/vue */ "./node_modules/@headlessui/vue/dist/components/transitions/transition.js");




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    Dialog: _headlessui_vue__WEBPACK_IMPORTED_MODULE_3__.Dialog,
    DialogOverlay: _headlessui_vue__WEBPACK_IMPORTED_MODULE_3__.DialogOverlay,
    DialogTitle: _headlessui_vue__WEBPACK_IMPORTED_MODULE_3__.DialogTitle,
    TransitionChild: _headlessui_vue__WEBPACK_IMPORTED_MODULE_4__.TransitionChild,
    TransitionRoot: _headlessui_vue__WEBPACK_IMPORTED_MODULE_4__.TransitionRoot
  },
  setup: function setup() {
    return {
      boleto: (0,_inertiajs_inertia_vue3__WEBPACK_IMPORTED_MODULE_0__.useForm)({
        aluno_id: '',
        nome_venda: '',
        valor_venda: '',
        errors: Object
      })
    };
  },
  methods: {
    gerarBoleto: function gerarBoleto(venda) {
      this.boleto.aluno_id = venda.aluno_id;
      this.boleto.valor_venda = this.convertFloatMoney(this.convertMoneyFloat(venda.valor_venda) - this.convertMoneyFloat(venda.desconto));
      this.boleto.nome_venda = venda.nome;
      this.boleto.post(this.route('gerarBoleto', venda.id));
      this.$notify({
        title: "Notificação",
        text: "Aguarde! Seu boleto está sendo gerado!",
        position: 'top right'
      });
    },
    convertFloatMoney: function convertFloatMoney(value) {
      var inteiro = null,
        decimal = null,
        c = null,
        j = null;
      var aux = new Array();
      value = "" + value;
      c = value.indexOf(".", 0);
      if (c > 0) {
        inteiro = value.substring(0, c);
        decimal = value.substring(c + 1, value.length);
      } else {
        inteiro = value;
      }
      for (j = inteiro.length, c = 0; j > 0; j -= 3, c++) {
        aux[c] = inteiro.substring(j - 3, j);
      }
      inteiro = "";
      for (c = aux.length - 1; c >= 0; c--) {
        inteiro += aux[c] + '.';
      }
      inteiro = inteiro.substring(0, inteiro.length - 1);
      decimal = parseInt(decimal);
      if (isNaN(decimal)) {
        decimal = "00";
      } else {
        decimal = "" + decimal;
        if (decimal.length === 1) {
          decimal = decimal + "0";
        }
      }
      value = "R$ " + inteiro + "," + decimal;
      return value;
    },
    convertMoneyFloat: function convertMoneyFloat(value) {
      if (value === "") {
        value = 0;
      } else {
        var currency = value;
        var regex = /([+-]?[0-9|^.|^,]+)[\.|,]([0-9]+)$/igm;
        var result = regex.exec(currency);
        var floatResult = result ? result[1].replace(/[.,]/g, "") + "." + result[2] : currency.replace(/[^0-9-+]/g, "");
        return floatResult;
      }
      return value;
    }
  },
  directives: {
    mask: vue_the_mask__WEBPACK_IMPORTED_MODULE_1__.mask
  },
  props: {
    venda: Object,
    transacao: Object
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=template&id=abc14352":
/*!***********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=template&id=abc14352 ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  "class": "w-5 h-5",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"
})], -1 /* HOISTED */);
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_notifications = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("notifications");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: "#",
    onClick: _cache[0] || (_cache[0] = function ($event) {
      return $options.gerarBoleto($props.venda);
    }),
    "class": "inline-flex items-center px-6 py-2 mb-4 text-sm font-medium"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Gerar Boleto "), _hoisted_1]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_notifications)], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./resources/js/Pages/Vendas/gerarBoleto.vue":
/*!***************************************************!*\
  !*** ./resources/js/Pages/Vendas/gerarBoleto.vue ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _gerarBoleto_vue_vue_type_template_id_abc14352__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./gerarBoleto.vue?vue&type=template&id=abc14352 */ "./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=template&id=abc14352");
/* harmony import */ var _gerarBoleto_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./gerarBoleto.vue?vue&type=script&lang=js */ "./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=script&lang=js");
/* harmony import */ var _var_www_sae_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_var_www_sae_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_gerarBoleto_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_gerarBoleto_vue_vue_type_template_id_abc14352__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Vendas/gerarBoleto.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=script&lang=js":
/*!***************************************************************************!*\
  !*** ./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=script&lang=js ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_gerarBoleto_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_gerarBoleto_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./gerarBoleto.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=template&id=abc14352":
/*!*********************************************************************************!*\
  !*** ./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=template&id=abc14352 ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_gerarBoleto_vue_vue_type_template_id_abc14352__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_gerarBoleto_vue_vue_type_template_id_abc14352__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./gerarBoleto.vue?vue&type=template&id=abc14352 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Vendas/gerarBoleto.vue?vue&type=template&id=abc14352");


/***/ })

}]);