<template>
  <Head>
    <title>Transferências</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Transferências entre transferencias</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='submitTransferencia' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="servicos" class="block text-sm font-medium text-gray-700">Conta Origem</label>
                
                  <select v-model="transferencia.conta_origem" name="conta_origem" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(conta, index) in contas" :key="index" :value='index'> {{conta}} </option>
                  </select>

                  <div v-if="transferencia.errors.conta_origem" v-text="transferencia.errors.conta_origem" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="servicos" class="block text-sm font-medium text-gray-700">Conta Destino</label>
                
                  <select v-model="transferencia.conta_destino" name="conta_destino" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(conta, index) in contas" :key="index" :value='index'> {{conta}} </option>
                  </select>

                  <div v-if="transferencia.errors.conta_destino" v-text="transferencia.errors.conta_destino" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                  <input v-model="transferencia.valor" v-money="money" type="text" name="valor" id="valor" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="transferencia.errors.valor" v-text="transferencia.errors.valor" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="data_transferencia" class="block text-sm font-medium text-gray-700">Data</label>
                  <input v-model="transferencia.data_transferencia" type="date" name="data_transferencia" id="data_transferencia" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="transferencia.errors.data_transferencia" v-text="transferencia.errors.data_transferencia" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="obs" class="block text-sm font-medium text-gray-700">Observação</label>
                  <input v-model="transferencia.obs" type="text" name="obs" id="obs" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="transferencia.errors.obs" v-text="transferencia.errors.obs" class="mt-1 text-xs text-red-500"></div>
                </div>


              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('transferencias.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="transferencia.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="transferencia.progress" :value="transferencia.progress.percentage" max="100">
              {{ transferencia.progress.percentage }}%
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
      transferencia: useForm({
        conta_origem:'',
        conta_destino:'',
        valor: '',
        data_transferencia: '',
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
        { name: 'Listagem de Transferências', href: 'transferencias.index', current: false },
        { name: 'Cadastro de Transferências', current: true },
      ]
    }
  },
  methods:{
    submitTransferencia(){
      this.transferencia.valor = this.convertMoneyFloat(this.transferencia.valor)
      this.transferencia.post(this.route('transferencias.store', this.transferencia))
    }
  },
  directives: {mask},
  props: {
    transferencias: Object,
    contas: Object
  }
}
</script>
