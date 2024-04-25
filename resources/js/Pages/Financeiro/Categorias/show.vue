<template>
  <Head>
    <title>Visualização de Categorias</title>
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
                  {{categoria.name}}
                </p>
              </div>
            </div>
          </div>
          
        </li>
      </ul>
    </div>
  </div>
  <hr>
  <div class="px-0 py-3 mx-0 text-left sm:px-6">
      <Link :href="route('categorias.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
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
        { name: 'Listagem de Categorias', href: 'categorias.index', current: false },
        { name: 'Visualizacão de Categorias', current: true },
      ]
    }
  },
   props: {
    categoria: Object,
  }
}
</script>