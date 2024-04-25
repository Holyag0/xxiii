<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Créditos Disponíveis</title>
  </Head>
  
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      
    <bread-crumbs class="ml-8 mr-8 " :pages="links" />
 
    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
      <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Cliente</th>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">CPF</th>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Valor Pacote</th>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Crédito</th>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Pacote</th> 
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="credito in creditosDisponiveis" :key="credito.id">
              
              <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ credito.id }}
              </td>

              <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ credito.aluno.nome }}
              </td>
              
              <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ credito.aluno.cpf }}
              </td>
              
              <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ convertFloatMoney(credito.valor_pacote) }}
              </td>

              <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                 <span class="text-green-500"> {{ convertFloatMoney(credito.valor_credito) }} </span>
              </td>

              <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ credito.boleto.venda.pacote.nome }}
              </td>
            </tr>
          </tbody>
        </table>
        
        <h2 class="p-2 mt-2">Crédito Disponível para o CFC:  <span class="text-green-500">{{convertFloatMoney(valorCreditoFinal)}}</span></h2>
      </div>
    </div>

    <div class="px-4 py-3 text-left bg-gray-50 sm:px-6">
      <Link :href="route('menuCreditos')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
      <Link v-if="valorCreditoFinal > 0" :href="route('creditos.solicitar', auto_escola_id)" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Solicitar Crédito</Link>
    </div>
    
    </div>
  </div>
</template>

<script>
import BreadCrumbs from '../../Shared/BreadCrumbs.vue'
import { ref } from 'vue'
import {mask} from 'vue-the-mask'

export default {
  components: { BreadCrumbs },
  setup() {
    const open = ref(false)
    return {
       links:[
        { name: 'Menu de Créditos', href: 'menuCreditos', current: false },
        { name: 'Listagem de Créditos Disponíveis', current: true },
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
      
      console.log(valor_credito)
      return valor_credito
    }
  },
  methods:{

  },
  props: {
    creditosDisponiveis: Object,
    auto_escola_id: Number
  },
   directives: {mask}
}
</script>