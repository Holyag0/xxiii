<template>
  <div v-if="aluno.vendas != ''"> 
    <div class="flex">
      <a v-if="getPermission('vendas-create')" href="#" @click="open = true" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> 
      Iniciar Vendas <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" /><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" /></svg>
  </a>
      <SideVendas @side-closed="divSide" :openSide="open" :serv="serv" :auth="auth" :aluno="aluno" :contas="contas" :pacotes="pacotes.data" />
    </div>
    
    <div v-if="divListaVendas">
      <div v-for="venda in aluno.vendas" :key="venda.id" class="mt-2 mb-2 overflow-hidden bg-white shadow sm:rounded-md"> 
          
        <div class="mt-2 mb-4 ml-2 overflow-hidden bg-white border-gray-400 border-solid sm:rounded-md">
          
          <ul role="list" class="grid grid-cols-1 gap-8 sm:grid-cols-1 lg:grid-cols-1">
            <li class="col-span-1 bg-white divide-y divide-gray-200 rounded-lg shadow">
              
              <div class="flex items-center justify-between w-full p-6 space-x-6">
                
                <div  class="flex-1 truncate">
                  <div   class="flex items-center space-x-3">
                    <h3 class="font-medium text-gray-900 truncate">{{venda.nome}}</h3>
                    <span class="flex-shrink-0 inline-block px-2 py-0.5 text-gray-800 text-xs font-medium bg-gray-100 rounded-full"> {{venda.status}}</span>
                  </div>
                  <p class="mt-1 text-sm text-gray-500 truncate">Vendedor: {{venda.user.name}} - {{convertData(venda.data_venda)}}</p>
                  <p class="mt-1 text-sm text-gray-500 truncate">Valor: {{convertFloatMoney(venda.valor_venda)}} {{'- Valor à pagar:'+ convertFloatMoney(convertMoneyFloat(venda.valor_venda) - convertMoneyFloat(venda.desconto))}} {{'- Desconto:'+ convertFloatMoney(venda.desconto)}} </p>
                  <!-- <p class="mt-1 text-sm text-gray-500 truncate">Valor da Pago: {{ convertFloatMoney(venda.valor_pago) }}</p> -->
                    <!-- <a href="#" class="items-center justify-center w-0 py-2 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500
                                                                                                                  parcela && parcela.forma_pagamento ? parcela.forma_pagamento : 'Exibido quando efetuar a baixa' ">
                      <CheckIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                      <span class="ml-3">Encerrar processo</span>
                    </a> -->
                  <div class="text-sm font-medium text-gray-700 border border-transparent rounded-bl-lg ">
                    <Accordion title="Visualizar serviços">
                      <div v-if="venda.venda_servico != null" class="mt-2">
                        <div  v-for="servico in venda.venda_servico" :key="servico.id">
                        <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg shadow md:grid-cols-3 md:divide-x md:divide-y-0">
                          <div  class="px-4 py-5 sm:p-6">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">{{ servico.nome }}</h3>
                            <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                              <span class="'inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0">
                                {{convertFloatMoney(servico.valor)}}
                              </span>
                              <div class="flex items-baseline text-sm font-medium text-gray-700 ">
                                desconto:
                              </div>
                              <span class="'inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0">
                                R${{servico.desconto}}
                              </span>
                              <div class="flex items-baseline text-sm font-medium text-gray-700 ">
                                quantidade:
                                <span class="ml-2 text-md font-semibold text-gray-700 ">{{'x' + servico.quantidade}}</span>
                              </div>                             
                            </dd>
                          </div>
                        </dl>
                      </div>
                      </div>
                      <div v-if="venda.pacote != null" class="mt-2">
                          <dl  v-for=" servico in venda.pacote.servicos" :key="servico.id" class="mt-5 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg shadow md:grid-cols-3 md:divide-x md:divide-y-0">
                            <div  class="px-4 py-5 sm:p-6">
                              <h3 class="text-base font-semibold leading-6 text-gray-900">{{ servico.nome }}-{{ servico.categoria}} </h3>
                              <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                                <span class="'inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0">
                                  {{convertFloatMoney(servico.valor)}}
                                </span>           
                              </dd>
                            </div>
                          </dl>
                      </div>
                    </Accordion>
                    
                    <Accordion title="Visualizar Financeiro">
                      <div  class="m-4"> 
                        <table v-if="venda.forma_pagamento != 'Boleto' && venda.forma_pagamento != 'Auto Escola'" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">forma de pagamento</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Valor</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                      Ações
                                  </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                              <!-- <div v-if="venda.forma_pagamento != 'Boleto'"> -->
                                <tr v-for="parcela in venda.parcelas" :key="parcela.id">
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <div v-if="venda.forma_pagamento == 'Entrada + Parcelas'" class="text-gray-900">
                                      {{ parcela.forma_pagamento ? parcela.forma_pagamento : 'Exibido quando efetuar a baixa' }}</div>
                                      <div v-else class="text-gray-900">{{venda.forma_pagamento}}</div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                      <div class="text-gray-900">{{parcela.valor_parcela ? convertFloatMoney(parcela.valor_parcela) : 'Defina o valor na baixa'}}</div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                      <div class="text-gray-900">{{statusParcela(parcela.status)}}</div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                      <div v-if="(parcela.status == 1)" class="text-gray-900">
                                        <!-- <a href="#"> Recibo</a> -->
                                        <modalReabir v-if="getPermission('vendas-reabre-parcela')" :aluno_id="aluno.id" :contas="contas" :parcela="parcela"/>
                                        <a target="__blank" :href="route('recibo.aluno', aluno.id)" > 
                                          <div class="px-4 text-gray-900">Recibo</div>
                                        </a>
                                      </div>

                                      <div v-else class="text-gray-900">
                                        <modalBaixar v-if="getPermission('vendas-baixa-parcela')" :venda="venda" :aluno="aluno" :contas="contas" :parcela="parcela" :pacotes="pacotes.data"/>
                                      </div>
                                  </td>
                                </tr>
                            </tbody>
                        </table>  
                        <table v-if="venda.forma_pagamento == 'Boleto'" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">#</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Valor</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                      Ações
                                  </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                              <!-- <div v-if="venda.forma_pagamento != 'Boleto'"> -->
                                <tr v-for="transacao in venda.boleto" :key="transacao.id">
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                      <div class="text-gray-900">{{transacao.id}}</div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                      <div class="text-gray-900">{{valorBoleto(venda.valor_venda, venda.desconto)}}</div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                      <div class="text-gray-900">{{statusBoleto(transacao.status)}}</div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <a v-if="transacao.status != 'canceled'" :href="transacao.boleto" target="_blank" class="text-sm text-blue-600 hover:text-blue-400">Visualizar Boleto</a>
                                    <a v-if="transacao.status != 'canceled' && getPermission('boleto-cancelar')" target='_self' class="pl-2 text-sm text-blue-600 hover:text-blue-400" :href="route('boleto.cancelar', transacao.transaction_id)">Cancelar</a>
                                  </td>
                                </tr>
                            </tbody>
                        </table> 
                        <gerarBoleto v-if="venda.forma_pagamento == 'Boleto' && getPermission('boleto-gerar')" :venda="venda" />

                         <table v-if="venda.forma_pagamento == 'Auto Escola'" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">#</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Valor</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">Informações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                              <tr v-for="parcela in venda.parcelas" :key="parcela.id">
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                      <div class="text-gray-900">{{parcela.id}}</div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                      <div class="text-gray-900">{{convertFloatMoney(parcela.valor_parcela)}}</div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                      <div class="text-gray-900">{{statusParcela(parcela.status)}}</div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    Pagamento gerenciado pela Auto Escola
                                  </td>
                                </tr>
                            </tbody>
                        </table>
                      </div>
                      
                    </Accordion>
              
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
  </div>

  <div v-else class="bg-indigo-50">
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-24 lg:px-8">
      <h2 class="text-3xl font-bold tracking-tight text-gray-900 md:text-4xl">
        <span class="block">Nenhuma venda encontrada!</span>
        <span class="block text-indigo-600">Inicie uma venda agora mesmo.</span>
      </h2>
      <div class="flex mt-8 lg:mt-0 lg:flex-shrink-0">
        <div class="inline-flex rounded-md">
          <a v-if="getPermission('vendas-create')" href="#" @click="open = true" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> 
              Iniciar Vendas <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" /><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" /></svg>
          </a>
      <SideVendas @side-closed="divSide" :openSide="open" :serv="serv" :auth="auth" :aluno="aluno" :contas="contas" :pacotes="pacotes.data" />
        </div>
      </div>
    </div>
  </div>

  
</template>

<script>
import SideVendas from './SideVendas.vue'
import selecionaPacote from './selecionaPacote.vue'
import modalBaixar from './baixarParcela.vue'
import modalReabir from './reabrirParcela.vue'
import gerarBoleto from './gerarBoleto.vue'
import { CheckIcon } from '@heroicons/vue/solid'
import Accordion from '../../Shared/Accordion.vue'
import { useForm } from "@inertiajs/inertia-vue3";
import {ref} from 'vue'


export default {
  components: {
    CheckIcon,
    Accordion,
    selecionaPacote,
    modalBaixar,
    modalReabir,
    gerarBoleto,
    SideVendas
  },
  data(){
    const open = ref(false)
    return{
      tab:  '',
      boleto: useForm({
        aluno_id: '',
        nome_venda: '',
        valor_venda: '',
        errors: Object,
      }),
      showModal: false,
      divNovaVenda: false,
      divListaVendas: true,
      divFinanceiro: false,
      open
    }
  },
  methods: {
  divSide() {
  this.open = !this.open
 
},
    currentTab: function (tabNumber) {
      this.tab = tabNumber;
    },
    novaVenda(){
      this.divNovaVenda = true
      this.divListaVendas = false
    },
    statusParcela(status){
      if(status == 1){
        return 'Pago'
      }else{
        return 'Em Aberto' 
      }
    },
    convertFloatMoney(value) {
      var inteiro = null, decimal = null, c = null, j = null
      var aux = new Array()
      value = ""+value
      c = value.indexOf(".",0)

      if(c > 0){
          inteiro = value.substring(0,c)
          decimal = value.substring(c+1,value.length)
      }else{
          inteiro = value
      }
      
      
      for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
          aux[c]=inteiro.substring(j-3,j)
      }
      
      
      inteiro = ""
      for(c = aux.length-1; c >= 0; c--){
          inteiro += aux[c]+'.'
      }
      
      
      inteiro = inteiro.substring(0,inteiro.length-1)
      
      decimal = parseInt(decimal)
      if(isNaN(decimal)){
          decimal = "00"
      }else{
          decimal = ""+decimal;
          if(decimal.length === 1){
              decimal = decimal+"0"
          }
      }
      
      
      value = "R$ "+inteiro+","+decimal
      
      
      return value
    },
    valorBoleto(valor, desconto){
        let valorBoleto = valor - desconto
        return this.convertFloatMoney(valorBoleto);
    },
    statusBoleto(status)
    {
      switch (status) {
         case 'pending':
                return 'Aguardando Pagamento';
            case 'canceled':
                return 'Boleto Cancelado';
            case 'completed':
                return 'Completo';
            case 'paid':
                return 'Pago';
            case 'processing':
                return 'Boleto em análise';
            case 'refunded':
                return 'Boleto Estornado';
        default:
            return 'Não foi possível verificar o status'
          break;
      }
    },
  },

  props: {
    aluno: Object,
    pacotes:Object,
    contas: Object,
    auth: Object,
    serv: Object
  }
}
</script>