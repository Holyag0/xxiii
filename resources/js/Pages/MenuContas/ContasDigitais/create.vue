<template>
  <Head>
    <title>Cadastro de Contas Digitais</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Cadastro de Contas Digitais</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='submitConta' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="conta.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="conta.errors.nome" v-text="conta.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="data_abertura" class="block text-sm font-medium text-gray-700">Data de Abertura</label>
                  <input v-model="conta.data_abertura" type="date" name="data_abertura" id="data_abertura" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="conta.errors.data_abertura" v-text="conta.errors.data_abertura" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="saldo_inicial" class="block text-sm font-medium text-gray-700">Saldo Inicial</label>
                  <input v-model="conta.saldo_inicial" v-money="money" type="text" name="saldo_inicial" id="saldo_inicial" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="conta.errors.saldo_inicial" v-text="conta.errors.saldo_inicial" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                
                  <select v-model="conta.status" name="status" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='1'> Ativado </option>
                    <option value='0'> Desativado </option>
                  </select>

                  <div v-if="conta.errors.status" v-text="conta.errors.status" class="mt-1 text-xs text-red-500"></div>
                </div>

              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('contas.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="conta.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="conta.progress" :value="conta.progress.percentage" max="100">
              {{ conta.progress.percentage }}%
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
      conta: useForm({
        nome: '',
        saldo_inicial:'',
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
        { name: 'Listagem de contas', href: 'contas.index', current: false },
        { name: 'Cadastro de contas', current: true },
      ]
    }
  },
  methods:{
    submitConta(){
      this.conta.saldo_inicial = this.convertMoneyFloat(this.conta.saldo_inicial)
      this.conta.post(this.route('contas.store', this.conta))
    }
  },
  directives: {mask},
  props: {
    contas: Object,
  }
}
</script>
