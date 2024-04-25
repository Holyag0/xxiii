<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Listagem de Transações</title>
  </Head>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

    <bread-crumbs class="ml-8 mr-8 " :pages="links" />

      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
          
          <div class="grid grid-cols-6 gap-6">
            
            <div class="col-span-4 mb-2 sm:col-span-1 lg:col-span-1">
              <label for="conta_id" class="block text-sm font-medium text-gray-700">Contas Digitais</label>
              <select aria-placeholder="Contas Digitais" v-model="filtro.conta_id" id="conta_id" name="conta_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option v-for="(conta, index) in contas" :key="index" :value='index'> {{conta}} </option>
              </select>
            </div>

            <div class="col-span-4 mb-2 sm:col-span-1 lg:col-span-1">
              <label for="data_inicial" class="block text-sm font-medium text-gray-700">Data Inicial</label>
              <input v-model="filtro.data_inicio" type="date" name="data_inicio" id="data_inicio" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>

            <div class="col-span-4 mb-2 sm:col-span-1 lg:col-span-1">
              <label for="data_fim" class="block text-sm font-medium text-gray-700">Data Final</label>
              <input v-model="filtro.data_fim" type="date" name="data_fim" id="data_fim" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
              
            <div class="flex px-6 py-4 mt-1 text-sm font-medium text-right-inline">
              <a href="#" @click="searchTransacoes" class="block px-3 py-2 mt-1 mr-2 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></a>
              <Link :href="route('transacoes.index')" class="block px-3 py-2 mt-1 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"><span class="sr-only">Filtrar</span><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" /></svg></Link>
            </div>
          </div>
          
          <table class="min-w-full mt-2 divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Data</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Descrição</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tipo</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Valor</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="transacao in transacoes.data" :key="transacao.id">
               
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ transacao.id }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ convertData(transacao.data_pagamento) }}
                </td>
              
                <td class="px-6 py-4 text-sm text-black whitespace-nowrap">
                  {{ transacao.descricao }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ transacao.tipo }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  <div :class="(transacao.tipo ==  'Despesa' ? 'text-red-500' : 'text-green-500')">
                    {{ transacao.tipo == "Despesa" ? '- ' : '+ '}} {{ convertFloatMoney(transacao.valor)}}
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <h2 v-if='filtro.conta_id == null' class="p-2 mt-2">Valor total de transações:  <span :class="labelTransacoes">{{convertFloatMoney(saldoTransacoes)}}</span></h2>
          <h2 v-else class="p-2 mt-2">Saldo Caixa:  <span :class="labelCaixa">{{convertFloatMoney(saldoCaixa)}}</span></h2>

        </div>
      </div>
    </div>
  </div>
  <Pagination :links="transacoes.links" class="mt-6"/>
</template>

<script>
import TitleAndButtonCad from '../../../Shared/TitleAndButtonCad.vue'
import BreadCrumbs from '../../../Shared/BreadCrumbs.vue'
import Pagination from '../../../Shared/Pagination.vue'

export default {
  components: { TitleAndButtonCad, BreadCrumbs, Pagination},
  setup() {
    return {
      label_saldo_transacoes: '',
      label_saldo_caixa: '',
      filtro: {
        conta_id: null,
        data_inicio: '',
        data_fim: ''
      },
      links:[
        { name: 'Menu de Contas', href: 'menuContas', current: false },
        { name: 'Transações', current: true },
      ]
    }
  },
   computed: {
    labelTransacoes: function (){
      if(this.saldoTransacoes > 0){
          return this.label_saldo_transacoes = 'text-green-500'
      }else{
         return this.label_saldo_transacoes = 'text-red-500'
      }
    },
    labelCaixa: function (){
      if(this.saldoCaixa > 0){
          return this.label_saldo_caixa = 'text-green-500'
      }else{
         return this.label_saldo_caixa = 'text-red-500'
      }
    },
    saldoCaixa: function () {
      let saldo = parseFloat(this.conta.saldo_inicial)

      this.transacoes.data.forEach((element) => {
          if(element.tipo == 'Receita')
            saldo += parseFloat(element.valor)

          if(element.tipo == 'Despesa')
            saldo -= parseFloat(element.valor)
      })
      
      return saldo
    },
    saldoTransacoes: function () {
      let saldo = 0

      this.transacoes.data.forEach((element) => {
          if(element.tipo == 'Receita')
            saldo += parseFloat(element.valor)

          if(element.tipo == 'Despesa')
            saldo -= parseFloat(element.valor)
      })
      
      return saldo
    }
  },
  methods:{
    searchTransacoes()
    {
      this.$inertia.replace(
        this.route("transacoes.index", { search: this.filtro })
      );
    },
  },
  props: {
    transacoes: Object,
    contas: Object,
    conta: Object
  }
}
</script>