<template>
  <Head>
    <title>Cadastro de Despesas</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Cadastro de Despesas</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='submitDespesas' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                  <input v-model="despesa.valor" v-money="money" type="text" name="valor" id="valor" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="despesa.errors.valor" v-text="despesa.errors.valor" class="mt-1 text-xs text-red-500"></div>
                </div>
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="data_vencimento" class="block text-sm font-medium text-gray-700">Data</label>
                  <input v-model="despesa.data_vencimento" type="date" name="data_vencimento" id="data_vencimento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="despesa.errors.data_vencimento" v-text="despesa.errors.data_vencimento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="centro_custo_id" class="block text-sm font-medium text-gray-700">Centro de Custos</label>
                
                  <select v-model="despesa.centro_custo_id" name="centro_custo_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(centroCusto, index) in centroCustos" :key="index" :value='index'> {{centroCusto}} </option>
                  </select>

                  <div v-if="despesa.errors.centro_custo_id" v-text="despesa.errors.centro_custo_id" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="fornecedor_id" class="block text-sm font-medium text-gray-700">Fornecedor</label>
                
                  <select v-model="despesa.fornecedor_id" name="fornecedor_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(fornecedor, index) in fornecedores" :key="index" :value='index'> {{fornecedor}} </option>
                  </select>

                  <div v-if="despesa.errors.fornecedor_id" v-text="despesa.errors.fornecedor_id" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6">
                  <label for="obs" class="block text-sm font-medium text-gray-700">Observação</label>
                  <input v-model="despesa.obs" type="text" name="obs" id="obs" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="despesa.errors.obs" v-text="despesa.errors.obs" class="mt-1 text-xs text-red-500"></div>
                </div>
                
              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('despesas.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="despesa.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="despesa.progress" :value="despesa.progress.percentage" max="100">
              {{ despesa.progress.percentage }}%
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
      despesa: useForm({
        valor: '',
        data_vencimento: '',
        centro_custo_id: '',
        fornecedor_id: '',
        obs: '',
        errors: Object,
      }),
      money:{
          decimal: ',',
          thousands: '.',
          precision: 2,
          masked: false /* doesn't work with directive */
      },
      links:[
        { name: 'Listagem de Despesas', href: 'despesas.index', current: false },
        { name: 'Cadastro de Despesas', current: true },
      ]
    }
  },
  methods:{
    submitDespesas(){
      this.despesa.valor = this.convertMoneyFloat(this.despesa.valor)
      this.despesa.post(this.route('despesas.store', this.despesa))
    }
  },
  directives: {mask},
  props: {
    despesas: Object,
    centroCustos: Object,
    fornecedores: Object
  }
}
</script>
