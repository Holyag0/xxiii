<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Listagem de Contas Digitais</title>
  </Head>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

    <title-and-button-cad :link="'contas.create'" :title="'Listagem Contas Digitais'" />
    <bread-crumbs class="ml-8 mr-8 " :pages="links" />

      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nome</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Saldo</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="conta in contas.data" :key="conta.id">
               
               <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ conta.id }}
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ conta.nome }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    <!-- {{ convertFloatMoney(conta.saldo)}} -->
                </td>

                <td class="flex px-6 py-4 text-sm font-medium text-right-inline">
                  <Link :href="route('contas.show', conta.id)" class="mr-2 text-sm text-blue-600 hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                  </Link>
                  
                  <Link :href="route('contas.edit', conta.id)" class="text-sm text-blue-600 hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                  </Link>
                </td>
                
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <Pagination :links="contas.links" class="mt-6"/>
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
        { name: 'Menu Contas', href: 'menuContas', current: false },
        { name: 'Listagem de Contas Digitais', current: true },
      ]
    }
  },
  props: {
    contas: Object,
  }
}
</script>