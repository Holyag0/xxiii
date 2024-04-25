
<template>
    <div  v-if="aluno.vendas != ''" class="mt-2 mb-2 overflow-hidden bg-white shadow sm:rounded-md"> 
      <div v-for="venda in aluno.vendas" :key='venda.id' class="overflow-hidden bg-white border-gray-400 border-solid sm:rounded-md">
        <ul role="list" class="grid grid-cols-1 gap-8 sm:grid-cols-1 lg:grid-cols-1">
          <li class="col-span-1 bg-white divide-y divide-gray-200 rounded-lg shadow">
            <div class="flex items-center justify-between w-full p-6 space-x-6">
              <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">
                  <h3 class="font-medium text-gray-900 truncate">EXAMES  | {{venda.nome}}</h3>
                </div>
                <p>
                  <!-- <a href="#" class="items-center justify-center w-0 py-2 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                    <CheckIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                    <span class="ml-3">Encerrar processo</span>
                  </a> -->
                </p>
              
            
                <div v-for="exame in venda.exames " :key="exame.id" class="text-sm font-medium text-gray-700 border border-transparent rounded-bl-lg hover:text-gray-500">
                  <lancarExame :auth="auth" :exame='exame' :aluno='aluno' :profissionais='profissionais'  />
                </div>

              </div>
            </div>
          </li>
        </ul>
      </div> 
    </div>

    <div v-else class="bg-indigo-50">
      <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-24 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 md:text-4xl">
          <span class="block">Nenhum exame lançado!</span>
          <span class="block text-indigo-600">Aguarde até que novos exames sejam agendados.</span>
        </h2>
      </div>
    </div>
</template>

<script>
import { CheckIcon } from '@heroicons/vue/solid'
import lancarExame from './lancarExame.vue'
import dadosTestExame from './dadosTestExame.vue'

export default {
  components: {
    CheckIcon,
    lancarExame,
    dadosTestExame
  },
  setup() {
    return {
    }
  },
  methods:{
    
  },
  props: {
    aluno: Object,
    profissionais: Object,
    auth: Object
  }
}

</script>