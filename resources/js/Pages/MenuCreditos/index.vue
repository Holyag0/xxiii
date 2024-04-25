<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Listagem de Auto Escolas</title>
  </Head>
  
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      
    <bread-crumbs class="ml-8 mr-8 " :pages="links" />
    <div class="grid grid-cols-4 gap-6">
            <div v-if="divNome" class="px-8 sm:col-span-2 lg:col-span-2">
              <input @keyup="searchCliente" v-model="filtro.nome" type="text" placeholder="Pesquisar por nome" class="block w-full py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div v-if="divCPF" class="px-8 sm:col-span-2 lg:col-span-2">
              <input @keyup="searchCliente" v-model="filtro.cpf" v-mask="'###.###.###-##'" type="text" placeholder="Pesquisar por cpf" class="block w-full py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
              <div v-if="divCNPJ" class="px-8 sm:col-span-2 lg:col-span-2">
              <input @keyup="searchCliente" v-model="filtro.cnpj" v-mask="'##.###.###/####-##'" type="text" placeholder="Pesquisar por cnpj" class="block w-full py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            
            
             <select @change="selecionaFiltro(filtro.forma_filtro)" v-model="filtro.forma_filtro" id="location" name="location" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                 <option value="selecione o filtro">selecione o filtro</option>              
                <option value="Nome">Nome</option>
                <option value="CPF">CPF</option>
                <option value="CNPJ">CNPJ</option>
             </select>

            <div class="flex text-sm font-medium text-right-inline">
         
              <!-- <a href="#" @click="open = true" class="block px-3 py-2 mx-2 mt-1 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                <p class="sr-only">F</p>
              </a> -->

              <Link :href="route('autoescola.index')" class="block px-3 py-2 mt-1 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"><span class="sr-only">Filtrar</span><svg xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" /></svg></Link>
           
            </div>
            
          </div>

      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nome</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">CPF / CNPJ</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Ações</th>
                
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="autoEscola in autoEscolas.data" :key="autoEscola.id">
               
               <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ autoEscola.id }}
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ autoEscola.nome }}
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ autoEscola.cnpj }}
                </td>
                
                <td class="flex px-6 py-4 text-sm font-medium text-right-inline">
                  <Link :href="route('creditos.visualizar', autoEscola.id)" title="Visualizar Créditos Disponíveis" class="mr-2 text-sm text-blue-600 hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                  </Link>

                  <Link :href="route('creditosPagos.visualizar', autoEscola.id)" title="Visualizar Créditos Pagos" class="mr-2 text-sm text-blue-600 hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  </Link>
                </td>
                
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <Pagination :links="autoEscolas.links" class="mt-6"/>
</template>

<script>
import BreadCrumbs from '../../Shared/BreadCrumbs.vue'
import Pagination from '../../Shared/Pagination.vue'
import { ref } from 'vue'
import {mask} from 'vue-the-mask'

export default {
  components: { BreadCrumbs, Pagination},
  setup() {
    const open = ref(false)
    const divNome = ref(true)
    const divCPF = ref(false)
    const divCNPJ = ref(false)
    return {
       links:[
        { name: 'Menu de Créditos', href: 'menuCreditos', current: false },
        { name: 'Listagem de Auto Escolas', current: true },
      ],
      open,
      filtro: {
        nome: '',
        status: '',
        cpf: '',
        cnpj: '',
        auto_escola_id: '',
        forma_filtro: 'Selecione o filtro'
      },
      divNome,
      divCPF,
      divCNPJ
    }
  },
  methods:{
    searchCliente(){
      this.$inertia.replace(
        // this.route('autoescola.index', {search: this.filtro}, { preserveState: true, replace: true})
      );
    },
    limparFiltro()
    {
      // this.route("autoescola.index")
    },
   selecionaFiltro(forma_filtro)
    {
      switch (forma_filtro) {
        case 'Nome':
          this.divNome = true
          this.divCPF = false
          this.divCNPJ = false
          break;

        case 'CPF':
          this.divCPF = true
          this.divNome = false
          this.divCNPJ = false
          break;
           case 'CNPJ':
          this.divCPF = false
          this.divNome = false
          this.divCNPJ = true
          break;
      
        default:
          this.divCPF = false
          this. divNome= true
         this.divCNPJ = false
          break;
      }
    },
  },
  props: {
    autoEscolas: Object,
  },
   directives: {mask}
}
</script>