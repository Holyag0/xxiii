<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Listagem de Clínicas</title>
  </Head>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

    <title-and-button-cad v-if="getPermission('clinica-create')" :link="'clinica.create'" :title="'Listagem de Clínicas'" />
    <bread-crumbs class="ml-8 mr-8 " :pages="links" />

      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
          
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-500 sm:pl-6">ID</th>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-500 sm:pl-6">Nome</th>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-500 sm:pl-6">Ações</th>
               
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
               <tr v-for="clinica in clinicas.data" :key="clinica.id">
                 <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-500 whitespace-nowrap sm:pl-6">{{ clinica.id }}</td>
                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-500 whitespace-nowrap sm:pl-6">{{ clinica.nome }}</td>
                
                <td class="py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                   <Link v-if="getPermission('clinica-edit')" :href="route('clinica.edit', clinica.id)" class="text-indigo-600 hover:text-indigo-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    
    </div>
  </div>
  <Pagination :links="clinicas.links" class="mt-6"/>
</template>

<script>
import TitleAndButtonCad from '../../../Shared/TitleAndButtonCad.vue'
import BreadCrumbs from '../../../Shared/BreadCrumbs.vue'
import Pagination from '../../../Shared/Pagination.vue'

export default {
  components: { TitleAndButtonCad, BreadCrumbs, Pagination },
  setup() {
    return {
       links:[
        { name: 'Menu de Cadastros', href: 'menuCadastros', current: false },
        { name: 'Listagem de Clínicas', current: true },
      ],
    }
  },
  props: {
    clinicas: Object,
  }
}
</script>