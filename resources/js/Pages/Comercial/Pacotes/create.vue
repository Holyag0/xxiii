<template>
  <Head>
    <title>Cadastro de Pacotes</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Cadastro de Pacotes</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='submitPacote' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="pacote.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="pacote.errors.nome" v-text="pacote.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="servicos" class="block text-sm font-medium text-gray-700">Serviços</label>
                
                  <select v-model="pacote.servicos" multiple name="servicos" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(servico, index) in servicos" :key="index" :value='index'> {{servico}} </option>
                  </select>

                  <div v-if="pacote.errors.servicos" v-text="pacote.errors.servicos" class="mt-1 text-xs text-red-500"></div>
                    </div>
                    <div class="col-span-4 sm:col-span-3">
                  <label for="servicos" class="block text-sm font-medium text-gray-700">Categoria</label>
                
                  <select v-model="pacote.categoria"  name="categoria" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(option, index) in categorias" :key="index" :value='option'> {{option}} </option>
                  </select>

                  <div v-if="pacote.errors.servicos" v-text="pacote.errors.servicos" class="mt-1 text-xs text-red-500"></div>
                    </div>
                <div class="col-span-4 sm:col-span-3">
                  <label for="desconto_boleto" class="block text-sm font-medium text-gray-700">Desconto Boleto</label>
                  
                  <select @change="selecionaFormaPagamento(pacote.desconto_boleto)" v-model="pacote.desconto_boleto" name="status" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='1'> Permitir Desconto </option>
                    <option value='0'> Não Permitir </option>
                  </select>
                  <div v-if="pacote.errors.desconto_boleto" v-text="pacote.errors.desconto_boleto" class="mt-1 text-xs text-red-500"></div>               
                </div>  
                <div class="col-span-4 sm:col-span-3">
                  <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                
                  <select v-model="pacote.status" name="status" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='1'> Ativado </option>
                    <option value='0'> Desativado </option>
                  </select>

                  <div v-if="pacote.errors.status" v-text="pacote.errors.status" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div v-if="pacote.desconto_boleto != 0" class="col-span-4 sm:col-span-3">
                  <label for="valor" class="block text-sm font-medium text-gray-700">Retorno CFC</label>
                  <input v-model="pacote.valor_credito" v-money="money" type="text" name="valor_credito" id="valor_credito" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="pacote.errors.valor_credito" v-text="pacote.errors.valor_credito" class="mt-1 text-xs text-red-500"></div>
                </div>

              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('pacote.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="pacote.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="pacote.progress" :value="pacote.progress.percentage" max="100">
              {{ pacote.progress.percentage }}%
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
import { ref} from 'vue'

export default {
  components: {
    BreadCrumbs,
  },
  setup() {
    const categorias = ['A', 'B', 'AB', 'C', 'D', 'E', 'SC']
    return {
      categorias,
      pacote: useForm({
        nome: '',
        cpf:'',
        servicos: '',
        valor_credito: '',
        desconto_boleto: '0',
        status: '1',
        credito_cfc:'',
        errors: Object,
      }),
       money:{
            decimal: ',',
            thousands: '.',
            precision: 2,
            masked: false /* doesn't work with directive */
      },
      links:[
        { name: 'Listagem de Pacotes', href: 'pacote.index', current: false },
        { name: 'Cadastro de Pacotes', current: true },
      ],
      money:{
        decimal: ',',
        thousands: '.',
        precision: 2,
        masked: false /* doesn't work with directive */
      },
    }
  },
  methods:{
    submitPacote(){
      this.pacote.valor_credito = this.convertMoneyFloat(this.pacote.valor_credito)
      this.pacote.post(this.route('pacote.store', this.pacote))
    }
  },
  directives: {mask},
  props: {
    servicos: Object,
  }
}
</script>

