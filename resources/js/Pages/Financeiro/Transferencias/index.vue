<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Listagem de transferencias</title>
  </Head>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

    <div class="px-4 py-4 border-b border-gray-200 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
      <div class="flex-1 min-w-0">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Cadastro de Transferências</h1>
      </div>
      <div class="flex mt-4 sm:mt-0 sm:ml-4">
        <Link v-if="getPermission('transferencia-create')" :href="route('transferencias.create')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-md shadow-sm order-0 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
          </svg>
        </Link>
      </div>
    </div>

    
    <bread-crumbs class="ml-8 mr-8 " :pages="links" />

      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Data</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Conta Origem</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Conta Destino</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Valor</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Observação</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="transferencia in transferencias.data" :key="transferencia.id">
               
               <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ transferencia.id }}
                </td>

                 <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ convertData(transferencia.data_transferencia) }}
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ transferencia.conta_origem.nome }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ transferencia.conta_destino.nome }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ convertFloatMoney(transferencia.valor)}}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ transferencia.obs }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <Pagination :links="transferencias.links" class="mt-6"/>
</template>

<script>
import TitleAndButtonCad from '../../../Shared/TitleAndButtonCad.vue'
import BreadCrumbs from '../../../Shared/BreadCrumbs.vue'
import Pagination from '../../../Shared/Pagination.vue'

export default {
  components: { TitleAndButtonCad, BreadCrumbs, Pagination},
  setup() {
    return {
       links:[
        { name: 'Menu Financeiro', href: 'menuFinanceiro', current: false },
        { name: 'Listagem de Transferências', current: true },
      ]
    }
  },
  props: {
    transferencias: Object,
  }
}
</script>