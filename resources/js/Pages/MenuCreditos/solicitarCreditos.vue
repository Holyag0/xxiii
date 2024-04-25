<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Solicitação de Créditos</title>
  </Head>
  
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      
    <bread-crumbs class="ml-8 mr-8 " :pages="links" />
 
    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
      <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
        
         <form @submit.prevent='aprovarCreditocredito' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">

                <div class="col-span-4 sm:col-span-3">
                  <label for="data_pagamento" class="block text-sm font-medium text-gray-700">Data de Pagamento</label>
                  <input v-model="credito.data_pagamento" type="date" name="data_pagamento" id="data_pagamento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="credito.errors.data_pagamento" v-text="credito.errors.data_pagamento" class="mt-1 text-xs text-red-500"></div>
                </div>
              
                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                  <input v-model="credito.descricao" type="text" name="descricao" id="descricao" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="credito.errors.descricao" v-text="credito.errors.descricao" class="mt-1 text-xs text-red-500"></div>
                </div>
                
              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('creditos.visualizar', auto_escola_id)" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="credito.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Finalizar</button>
            </div>

            <progress v-if="credito.progress" :value="credito.progress.percentage" max="100">
              {{ credito.progress.percentage }}%
            </progress>
          </div>
        </form>
        
        
        <h2 class="p-2 mt-2">Crédito Disponível para o CFC:  <span class="text-green-500">{{convertFloatMoney(valorCreditoFinal)}}</span></h2>
      </div>
    </div>
    
    </div>
  </div>
</template>

<script>
import BreadCrumbs from '../../Shared/BreadCrumbs.vue'
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from 'vue'
import {mask} from 'vue-the-mask'

export default {
  components: { BreadCrumbs },
  setup() {
    const open = ref(false)
    return {
      credito:useForm({
        data_pagamento: '',
        descricao: '',
        valor_pago: '',
        relacaoCreditos: Object,
        auto_escola_id: '',
        errors: Object,
      }),
       links:[
        { name: 'Menu de Créditos', href: 'menuCreditos', current: false },
        { name: 'Solicitação de Créditos', current: true },
      ],
      open,
    }
  },
  computed: {
    valorCreditoFinal: function () {
      let valor_credito = 0

      this.creditosDisponiveis.forEach((element) => {
          valor_credito += parseFloat(element.valor_credito)
      })
      
      return valor_credito
    }
  },
  methods:{
    aprovarCreditocredito(){
      this.credito.auto_escola_id = this.auto_escola_id
      this.credito.relacaoCreditos = this.creditosDisponiveis
      this.credito.valor_pago = this.valorCreditoFinal
      this.credito.post(this.route('creditos.aprovar'))
    }
  },
  props: {
    creditosDisponiveis: Object,
    auto_escola_id: Number
  },
   directives: {mask}
}
</script>