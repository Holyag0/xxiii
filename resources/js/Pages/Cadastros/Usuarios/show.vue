<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Visualização de Usuários</title>
  </Head>
  
  <div>
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="overflow-hidden bg-white shadow sm:rounded-md"> 
      <ul role="list" class="divide-y divide-gray-200">
        <li>
          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Nome
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{user.name}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Email
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{user.email}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Auto Escolas
              </p>
              <div class="flex ml-2">
                  <p class="mr-1 text-xs font-semibold" v-for="cfc in user.cfcs" :key="cfc.id"> {{cfc.nome}}</p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Funções
              </p>
              <div class="flex ml-2">
                  <span v-for="role in user.roles" :key="role.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize mr-1"> {{role.name}} </span> 
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import BreadCrumbs from '../../../Shared/BreadCrumbs.vue'
  
export default {
  components: {
    BreadCrumbs,
  },
  setup() {
    return {
      links:[
        { name: 'Listagem de Usuários', href: 'user.index', current: false },
        { name: 'Visualizacão de Usuário', current: false },
      ]
    }
  },
   props: {
    user: Object,
  }
}
</script>