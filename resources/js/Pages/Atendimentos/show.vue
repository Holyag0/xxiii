<template>
  <div class="">
    <Head>
      <title>Painel de Dados do Cliente</title>
      <meta name="description" content="visualização de informções do cliente">
    </Head>
    
    <bread-crumbs class="mt-2" :pages="links" :t="tabNumber"/>
      <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select a tab</label>
        <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
        <!-- <select id="tabs" name="tabs" class="block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
          <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
        </select> -->
      </div>
      <div class="hidden mt-8 overflow-hidden bg-white shadow sm:block sm:rounded-md">
        <div class="border-b border-gray-200">
          <nav class="flex -mb-px" aria-label="Tabs">
          
            <button
              @click="currentTab(1)"
              :class="[tab == 1 ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm']"
            >
              Meus Processos
            </button>
        
          
            <button
              @click="currentTab(2)"
              :class="[tab == 2 ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm']"
              v-if="getPermission('aluno-edit')"
            >
              Editar Dados
            </button>
        
          
            <button
              @click="currentTab(3)"
              :class="[tab == 3 ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm']"
              v-if="getPermission('aluno-vendas')"
            >
              Vendas
            </button>

            <button
              @click="currentTab(4)"
              :class="[tab == 4 ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm']"
              v-if="getPermission('aluno-exames')"
            >
              Exames
            </button>
        
            
          </nav>
        </div>
      </div>
    </div>

    
    <div>
      <div class="container mx-auto">
        
        <div class="p-3 mt-2">
          <div v-if="tab === 1">
            <meusDados :aluno="aluno"/>
          </div>
          <div v-if="tab === 2">
            <editarDados v-if="getPermission('aluno-edit')" :auth="auth" :autoEscolas='autoEscolas' :clinicas="clinicas" :aluno="aluno"/>
          </div>
          <div v-if="tab === 3">
            <vendas v-if="getPermission('aluno-vendas')" :serv="serv" :auth="auth" :aluno="aluno" :contas="contas" :pacotes="pacotes"  />
          </div>
          <div v-if="tab === 4">
            <exames v-if="getPermission('aluno-exames')" :auth="auth" :aluno="aluno"/>
          </div>
        </div>
      </div>
    </div>
</template>


<script>
import BreadCrumbs from '../../Shared/BreadCrumbs.vue'
import meusDados from './meusDados.vue'
import editarDados from './editarDados.vue'
import vendas from '../Vendas/PainelVendas.vue'
import exames from '../Exames/PainelExames.vue'

export default {
  components: {
    BreadCrumbs, meusDados, editarDados, vendas, exames
  },
  data() {
    return {
      links:[
        { name: 'Listagem de Clientes', href: 'aluno.index', current: false },
        { name: 'Painel Clientes', current: true },
      ],
      tab: 1
    };
  },
  methods: {
    currentTab: function (tabNumber) {
      this.tab = tabNumber;
    },
  },
  props:{
    aluno: Object,
    autoEscolas: Object,
    pacotes: Object,
    contas: Object,
    profissionais: Object,
    clinicas: Object,
    auth: Object,
    serv:Object
  }
};
</script>