<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Listagem de Usuários</title>
  </Head>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

    <title-and-button-cad :link="'user.create'" :title="'Listagem Usuários'" />
    <bread-crumbs class="ml-8 mr-8 " :pages="links" />

      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nome</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Funções</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Ações</th>
                
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="user in users.data" :key="user.id">
               
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ user.name }}
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ user.email }}
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  <span v-for="role in user.roles" :key="role.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize mr-1"> {{role.name}} </span>  
                </td>
                
                <td class="flex px-6 py-4 text-sm font-medium text-right-inline">
                  <Link v-if="getPermission('user-show')" :href="route('user.show', user.id)" class="mr-2 text-sm text-blue-600 hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                  </Link>
                    
                  <Link v-if="getPermission('user-edit')" :href="route('user.edit', user.id)" class="text-sm text-blue-600 hover:text-blue-400">
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
  <Pagination :links="users.links" class="mt-6"/>
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
        { name: 'Menu de Cadastros', href: 'menuCadastros', current: false },
        { name: 'Listagem de Usuários', current: false },
      ]
    }
  },
  props: {
    users: Object,
  }
}
</script>