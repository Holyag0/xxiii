<template>
  <Head>
    <title>Cadastro de Serviços</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Cadastro de Serviços</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='submitServico' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-3 sm:col-span-2">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="servico.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="servico.errors.nome" v-text="servico.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>
                <div class="col-span-4 sm:col-span-3">
                  <label for="servicos" class="block text-sm font-medium text-gray-700">Categoria</label>
                
                  <select v-model="servico.categoria"  name="categoria" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(option, index) in categorias" :key="index" :value='option'> {{option}} </option>
                  </select>

                  <div v-if="servico.errors.servicos" v-text="servico.errors.servicos" class="mt-1 text-xs text-red-500"></div>
                    </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                  <input v-model="servico.valor" v-money="money" type="text" name="valor" id="valor" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="servico.errors.valor" v-text="servico.errors.valor" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                
                  <select v-model="servico.status" name="status" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='1'> Ativado </option>
                    <option value='0'> Desativado </option>
                  </select>

                  <div v-if="servico.errors.status" v-text="servico.errors.status" class="mt-1 text-xs text-red-500"></div>
                </div>

              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('servico.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="servico.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="servico.progress" :value="servico.progress.percentage" max="100">
              {{ servico.progress.percentage }}%
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
    const categorias = ['A', 'B', 'AB', 'C', 'D', 'E', 'SC']
    return {
      categorias,
      servico: useForm({
        nome: '',
        valor:'',
        tipo_processo:'',
        status: '1',
        errors: Object,
      }),
      money:{
            decimal: ',',
            thousands: '.',
            precision: 2,
            masked: false /* doesn't work with directive */
      },
      links:[
        { name: 'Listagem de Servicos', href: 'servico.index', current: false },
        { name: 'Cadastro de Servicos', current: true },
      ]
    }
  },
  methods:{
    submitServico(){
      this.servico.valor = this.convertMoneyFloat(this.servico.valor)
      this.servico.post(this.route('servico.store', this.servico))
    }
  },
  directives: {mask},
  props: {
    servicos: Object,
  }
}
</script>
