
<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Listagem de Despesas</title>
  </Head>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

    <title-and-button-cad :link="'despesas.create'" :title="'Listagem Despesas'" />
  
    <bread-crumbs class="ml-8 mr-8" :pages="links" />
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">

          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-3 sm:col-span-2 lg:col-span-2">
              <input @keyup="searchFornecedor" v-model="filtro.fornecedor" type="text" placeholder="Pesquisar por fornecedor" class="block w-full py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>

            <div class="flex text-sm font-medium text-right-inline">
         
              <a href="#" @click="open = true" class="block px-3 py-2 mx-2 mt-1 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                <p class="sr-only">Filtrar</p>
              </a>

              <Link :href="route('despesas.index')" class="block px-3 py-2 mt-1 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"><span class="sr-only">Filtrar</span><svg xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" /></svg></Link>
           <a :href="route('gerar_relatorio.despesa')" @click="open = true" class=" inline-flex items-center  px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-black bg-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" /><path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" /> </svg>
                    Relatórios
                <p class="sr-only"></p>
              </a>
            </div>
            
          </div>

          <table class="min-w-full mt-3 divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Fornecedor</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Centro de Custos</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Valor</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="despesa in despesas.data" :key="despesa.id">
               
               <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ despesa.id }}
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ despesa.fornecedor.nome }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ despesa.centro_custo.name }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ convertFloatMoney(despesa.valor) }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  <span v-if="despesa.status == 1">Recebida</span>
                  <span v-else>Á receber</span>
                </td>

                <td class="flex px-6 py-4 text-sm font-medium text-right-inline">
                  <Link v-if="despesa.status == 1" :href="route('despesas.reabrir', despesa.id)" class="text-sm text-blue-600 hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                  </Link>

                  <Link v-else :href="route('despesas.baixar', despesa.id)" class="text-sm text-blue-600 hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                  </Link>
                  
                  <Link :href="route('despesas.show', despesa.id)" class="ml-2 mr-2 text-sm text-blue-600 hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                  </Link>
                  
                  <Link :href="route('despesas.edit', despesa.id)" v-if="despesa.status != 1" class="text-sm text-blue-600 hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                  </Link>

                  <a href="javascript:void(0);" v-if="despesa.status != 1" class="mr-2 text-sm text-blue-600 hover:text-blue-400" @click.prevent="deleteDespesa(despesa.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  </a>
                </td>
                
              </tr>
            </tbody>
          </table>


        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="fixed inset-0 z-10 overflow-y-auto" @close="open = false">
              <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                  <DialogOverlay class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" />
                </TransitionChild>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                  <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                    <div>
                      
                      <div class="col-span-3 mb-5 sm:col-span-2 lg:col-span-2">
                        <span>Centro de Custos</span>
                        <select aria-placeholder="Centro De Custos" v-model="filtro.centro_custo_id" id="centro_custo_id" name="centro_custo_id" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option v-for="(centroCusto, index) in centroCustos" :key="index" :value='index'> {{centroCusto}} </option>
                        </select>
                      </div>

                      <div class="col-span-3 mb-5 sm:col-span-2 lg:col-span-1">
                        <span>Status</span>
                        <select v-model="filtro.status" id="status" name="status" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option selected>Status</option>
                          <option value="0">Á receber</option>
                          <option value="1">Recebida</option>
                        </select>
                      </div>

                      <div class="col-span-3 mb-5 sm:col-span-2 lg:col-span-1">
                        <label for="data_inicio" class="block text-sm font-medium text-gray-700">Data Inicial</label>
                        <input v-model="filtro.data_inicio" type="date" name="data_inicio" id="data_inicio" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                      </div>

                      <div class="col-span-3 mb-5 sm:col-span-2 lg:col-span-1">
                        <label for="data_fim" class="block text-sm font-medium text-gray-700">Data Final</label>
                        <input v-model="filtro.data_fim" type="date" name="data_fim" id="data_fim" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                      </div>
                    
                      
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                      <button type="button" @click="searchDespesas" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">Filtrar</button>
                      <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="open = false" ref="cancelButtonRef">Cancelar</button>
                    </div>
                  </div>
                </TransitionChild>
              </div>
            </Dialog>
          </TransitionRoot>
  
        </div>
      </div>
    </div>
  </div>
  <Pagination :links="despesas.links" class="mt-6"/>
</template>

<script>
import TitleAndButtonCad from '../../../Shared/TitleAndButtonCad.vue'
import BreadCrumbs from '../../../Shared/BreadCrumbs.vue'
import { ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/outline' 

export default {
  components: { 
    TitleAndButtonCad, 
    BreadCrumbs, 
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    CheckIcon,
    },
  setup() {      
    const open = ref(false)
      
    return {
      open,
      filtro: {
        fornecedor: '',
        status: '0',
        centro_custo_id: ''
      },
       links:[
        { name: 'Menu Financeiro', href: 'menuFinanceiro', current: false },
        { name: 'Listagem de Despesas', current: true },
      ]
    }
  },
  methods:{
    deleteDespesa(id){
      if (!confirm('Tem certeza?')) return;
      this.$inertia.delete(route('despesas.destroy', {id}));
    },
    searchDespesas()
    {
      this.$inertia.replace(
        this.route("despesas.index", { search: this.filtro })
      );
      this.open = false
    },
    searchFornecedor(){     
      this.$inertia.replace(
        this.route('despesas.index', {search: this.filtro}, { preserveState: true, replace: true})
      );
    },
    limparFiltro()
    {
      this.route("despesas.index")
    },
  },
  props: {
    despesas: Object,
    centroCustos: Object
  }
}
</script>