<template>
<a href="#" @click="gerarBoleto(venda)" class="inline-flex items-center px-6 py-2 mb-4 text-sm font-medium"> 
    Gerar Boleto <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
</a>

<notifications />

</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import {mask} from 'vue-the-mask'
import { ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'


export default {
   components:{
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
  },
  setup() {
    return {
      boleto: useForm({
        aluno_id: '',
        nome_venda: '',
        valor_venda: '',
        errors: Object,
      }),
    }
  },
  methods:{
    gerarBoleto(venda){
      this.boleto.aluno_id = venda.aluno_id
      this.boleto.valor_venda = this.convertFloatMoney(this.convertMoneyFloat(venda.valor_venda) - this.convertMoneyFloat(venda.desconto))
      this.boleto.nome_venda = venda.nome
      this.boleto.post(this.route('gerarBoleto', venda.id))
      this.$notify({
        title: "Notificação",
        text: "Aguarde! Seu boleto está sendo gerado!",
        position: 'top right'
      });
    },
    convertFloatMoney(value) {
      var inteiro = null, decimal = null, c = null, j = null
      var aux = new Array()
      value = ""+value
      c = value.indexOf(".",0)

      if(c > 0){
          inteiro = value.substring(0,c)
          decimal = value.substring(c+1,value.length)
      }else{
          inteiro = value
      }
      
      
      for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
          aux[c]=inteiro.substring(j-3,j)
      }
      
      
      inteiro = ""
      for(c = aux.length-1; c >= 0; c--){
          inteiro += aux[c]+'.'
      }
      
      
      inteiro = inteiro.substring(0,inteiro.length-1)
      
      decimal = parseInt(decimal)
      if(isNaN(decimal)){
          decimal = "00"
      }else{
          decimal = ""+decimal;
          if(decimal.length === 1){
              decimal = decimal+"0"
          }
      }
      
      
      value = "R$ "+inteiro+","+decimal
      
      
      return value
    },
    convertMoneyFloat(value) {
      if(value === ""){
          value =  0
      }else{
          let currency = value;
          let regex = /([+-]?[0-9|^.|^,]+)[\.|,]([0-9]+)$/igm
          let result = regex.exec(currency);
          let floatResult = result ? result[1].replace(/[.,]/g, "") + "." + result[2] : currency.replace(/[^0-9-+]/g, "");

          return floatResult;
      }
      return value;
    },
  },
  directives: {mask},
  props: {
    venda: Object,
    transacao: Object
  }
}
</script>