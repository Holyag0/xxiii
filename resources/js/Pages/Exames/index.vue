
<template>
  <div v-if="exames.data != ''">
    <ul v-for="exame in exames.data" :key="exame.id" role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <li  class="col-span-4 mt-4 bg-white divide-y divide-gray-200 rounded-lg shadow">
        <div class="flex items-center justify-between w-full p-6 space-x-6">
          <div  class="flex-1 truncate">
            <div  class="flex items-center space-x-3">
              <h3 class="text-sm font-medium text-gray-900 truncate">{{exame.venda.aluno.nome}}</h3>
              <span  v-if="exame.status == 'Aprovado'" class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">{{exame.status}}</span>
              <span  v-if="exame.status == 'Agendado' || exame.status=='Perícia Médica' || exame.status=='À Fazer'" class="flex-shrink-0 inline-block px-2 py-0.5 text-orange-500 text-xs font-medium bg-orange-100 rounded-full">{{exame.status}}</span>
                <span  v-if="exame.status == 'Inapto Temporariamente'" class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-xs font-medium bg-red-100 rounded-full">{{exame.status}}</span>
            </div>
            <p class="mt-1 text-sm text-gray-500 truncate">{{exame.tipo}}</p>
          </div>

        <h3 class="text-sm font-medium text-gray-900 truncate">{{exame.venda.nome}}</h3>
        </div>
        <div>
          <div class="flex -mt-px divide-x divide-gray-200">
            <div class="flex flex-1 w-0">
              <a :href="route('exames.edit', exame.id)" :exame="exame" class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px text-sm font-medium text-gray-700 border border-transparent rounded-bl-lg hover:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                  <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zm6.905 9.97a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72V18a.75.75 0 001.5 0v-4.19l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd" />
                  <path d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                </svg>
                <span class="ml-3">Lançar Exames</span>
              </a>
            </div>
            <div v-if="exame.tipo=='Exame Psicológico'" class="flex flex-1 w-0 -ml-px">
                <indexDadosTestExame :exame="exame"/>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>

  <div v-else class="bg-indigo-50">
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-24 lg:px-8">
      <h2 class="text-3xl font-bold tracking-tight text-gray-900 md:text-4xl">
        <span class="block">Nenhum exame lançado!</span>
        <span class="block text-indigo-600">Aguarde até novos exames sejam agendados.</span>
      </h2>
    </div>
  </div>
</template>


<script>
import { CheckIcon, PhoneIcon } from '@heroicons/vue/solid'
import lancarExame from './lancarExame.vue'
import indexDadosTestExame from './indexDadosTestExame.vue'

export default {
  components: {
    CheckIcon,
    lancarExame,
    indexDadosTestExame,
    
    PhoneIcon
  },
  setup() {
    return {
    }
  },
  methods:{
    
  },
  props: {
    exames: Object,
  }
}

</script>