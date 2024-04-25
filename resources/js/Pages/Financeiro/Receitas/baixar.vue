<template>
  <Head>
    <title>Baixa de Receitas</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Baixar Receitas</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='baixarReceitas' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">

                <div class="col-span-4 sm:col-span-3">
                  <label for="conta" class="block text-sm font-medium text-gray-700">Conta</label>
                
                  <select v-model="transacao.conta_id" name="conta_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(conta, index) in contas" :key="index" :value='index'> {{conta}} </option>
                  </select>

                  <div v-if="transacao.errors.conta_id" v-text="transacao.errors.conta_id" class="mt-1 text-xs text-red-500"></div>
                </div>
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                  <input disabled v-money="money" type="text" :value="convertFloatMoney(receita.valor)" id="valor" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                

                <div class="col-span-3 sm:col-span-2">
                  <label for="forma_pagamento" class="block text-sm font-medium text-gray-700">Forma de Pagamento</label>
                
                  <select v-model="transacao.forma_pagamento" name="forma_pagamento" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='Dinheiro'> Dinheiro </option>
                    <option value='Cartão de Crédito'> Cartão de Crédito </option>
                    <option value='Cartão de Débito'> Cartão de Crédito </option>
                    <option value='Boleto'> Boleto </option>
                    <option value='Pix'> Pix </option>
                    <option value='Transferência Bancária'> Transferência Bancária </option>
                    <option value='Débito Automático'> Débito Automático </option>
                     <option value='Outros'> Outros </option>
                  </select>

                  <div v-if="transacao.errors.forma_pagamento" v-text="transacao.errors.forma_pagamento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="data_pagamento" class="block text-sm font-medium text-gray-700">Data</label>
                  <input v-model="transacao.data_pagamento" type="date" name="data_pagamento" id="data_pagamento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="transacao.errors.data_pagamento" v-text="transacao.errors.data_pagamento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                  <input v-model="transacao.descricao" type="text" name="descricao" id="descricao" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="transacao.errors.descricao" v-text="transacao.errors.descricao" class="mt-1 text-xs text-red-500"></div>
                </div>
                
              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('receitas.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="transacao.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Baixar</button>
            </div>

            <progress v-if="transacao.progress" :value="transacao.progress.percentage" max="100">
              {{ transacao.progress.percentage }}%
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
      transacao: useForm({
        valor: '',
        tipo: 'Receita',
        aluno_id: '',
        receita_id: '',
        conta_id: '',
        forma_pagamento: '',
        data_pagamento: '',
        descricao: '',
        errors: Object,
      }),
      links:[
        { name: 'Listagem de Receitas', href: 'receitas.index', current: false },
        { name: 'Baixar Receitas', current: true },
      ]
    }
  },
  methods:{
    baixarReceitas(){
      this.transacao.receita_id = this.receita.id
      this.transacao.aluno_id = this.receita.aluno.id
      this.transacao.valor = this.receita.valor
      this.transacao.post(this.route('receitas.efetuarBaixa', this.transacao))
    }
  },
  directives: {mask},
  props: {
    receita: Object,
    contas: Object,
  }
}
</script>
