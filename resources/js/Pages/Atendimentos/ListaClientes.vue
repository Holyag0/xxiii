<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Lista de Clientes</title>
    <meta name="description" content="Listagem de Clientes">
  </Head>
    
  <div  class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <title-and-button-cad :link="'aluno.create'" :title="'Listagem de Clientes'" />
     <div class="grid grid-cols-4 gap-6">
            <div v-if="divNome" class="px-8 sm:col-span-2 lg:col-span-2">
              <input @keyup="searchCliente" v-model="filtro.nome" type="text" placeholder="Pesquisar por nome" class="block w-full py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div v-if="divCPF" class="px-8 sm:col-span-2 lg:col-span-2">
              <input @keyup="searchCliente" v-model="filtro.cpf" v-mask="'###.###.###-##'" type="text" placeholder="Pesquisar por cpf" class="block w-full py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
             
            
             <select  @change="selecionaFiltro(filtro.forma_filtro)" v-model="filtro.forma_filtro" id="location" name="location" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                 <option value="selecione o filtro">selecione o filtro</option>              
                <option value="Nome">Nome</option>
                <option value="CPF">CPF</option>
             </select>

            <div class="flex text-sm font-medium text-right-inline">
         
              <a href="#" @click="open = true" class="block px-3 py-2 mx-2 mt-1 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                <p class="sr-only">F</p>
              </a>

              <Link :href="route('aluno.index')" class="block px-3 py-2 mt-1 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"><span class="sr-only">Filtrar</span><svg xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" /></svg></Link>
              <a target="__blank" :href="route('aluno.relatorio', filtro)" class="block px-3 py-2 mt-1 ml-2 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" /></svg></a>
            </div>
            
          </div>

      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
          <table id="table" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nome</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">CFC</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">CPF</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Ações</th>
                
              </tr>
            </thead>
            <tbody ref='content' class="bg-white divide-y divide-gray-200">
              <tr v-for="aluno in alunos.data" :key="aluno.id">
               
                <td  id='pdf' class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ aluno.nome }}
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ aluno.cfc.nome }}
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                 {{ aluno.cpf }}
                </td>
                
                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                  <Link :href="route('aluno.show', aluno.id)" class="text-sm text-blue-600 hover:text-blue-400">Visualizar</Link>
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
                        <span>Auto Escolas</span>
                        <select aria-placeholder="Centro De Custos" v-model="filtro.cfc" id="centro_custo_id" name="centro_custo_id" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option v-for="(autoEscola, index) in autoEscolas" :key="index" :value='index'> {{autoEscola}} </option>
                        </select>
                      </div>

                      <div class="col-span-3 mb-5 sm:col-span-2 lg:col-span-1">
                        <span>Status</span>
                        <select v-model="filtro.status" id="status" name="status" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option selected>Status</option>
                          <option value="Inapto Temporariamente">Inapto Temporariamente</option>
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
                      <button type="button" @click="searchCliente" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" >Filtrar</button>
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
</template>

<script>
import TitleAndButtonCad from '../../Shared/TitleAndButtonCad.vue'
import {mask} from 'vue-the-mask'
import { ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, Menu, MenuButton, MenuItem, MenuItems, TransitionRoot} from '@headlessui/vue'
export default {
  components: { TitleAndButtonCad, Dialog,DialogOverlay,DialogTitle,TransitionChild,Menu, MenuButton, MenuItem, MenuItems
    ,TransitionRoot },
  setup() {
    const open = ref(false)
    const divNome = ref(true)
    const divCPF = ref(false)

    return {
      open,
      filtro: {
        nome: '',
        status: '',
        cpf: '',
        cfc:'',
        data_inicio:'',
        data_fim: '',
        forma_filtro:'selecione o filtro'
      },
      divNome,
      divCPF
    }
  },
  props: {
    alunos: Object,
    autoEscolas: Object,
  },
  methods:{
    searchCliente(){  
      this.$inertia.replace(
        this.route('aluno.index', {search: this.filtro}, { preserveState: true, replace: true})
      );
      this.open = false
    },
    limparFiltro()
    {
      this.route("aluno.index")
    },
    selecionaFiltro(forma_filtro)
    {
      switch (forma_filtro) {
        case 'Nome':
          this.divNome = true
          this.divCPF = false
         
          break;

        case 'CPF':
          this.divCPF = true
          this.divNome = false
         
          break;
      
        default:
          this.divCPF = false
          this. divNome= true
         
          break;
      }
    },
  },
  directives: {mask}
}
</script>