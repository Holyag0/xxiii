<template>
  <Head>
    <title>Cadastro de Categorias</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Cadastro de Categorias</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='submitCategoria' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-6">
                  <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="categoria.name" type="text" name="name" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="categoria.errors.name" v-text="categoria.errors.name" class="mt-1 text-xs text-red-500"></div>
                </div>

              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('categorias.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="categoria.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="categoria.progress" :value="categoria.progress.percentage" max="100">
              {{ categoria.progress.percentage }}%
            </progress>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import {mask} from 'vue-the-mask'
import BreadCrumbs from '../../../Shared/BreadCrumbs.vue'

export default {
  components: {
    BreadCrumbs,
  },
  setup() {
    return {
      categoria: useForm({
        name: '',
        errors: Object,
      }),
      links:[
        { name: 'Listagem de Ctegorias', href: 'categorias.index', current: false },
        { name: 'Cadastro de Categorias', current: true },
      ]
    }
  },
  methods:{
    submitCategoria(){
      this.categoria.post(this.route('categorias.store', this.categoria))
    }
  },
  directives: {mask},
  props: {
    categorias: Object,
  }
}
</script>
