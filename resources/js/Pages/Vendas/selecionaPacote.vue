<template>
  <a v-if="getPermission('vendas-create')" href="#" @click="open = true" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> 
    Contratar Serviço <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" /><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" /></svg>
  </a>

  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed inset-0 z-10 overflow-y-auto" @close="open = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:max-w-lg sm:w-full sm:p-6">
              <div v-if="pacotes != ''" class="mt-3 text-center sm:mt-5">
                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900"> Selecione seu Pacote! </DialogTitle>
               
                  
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6">
                    <select @change="checkPacote(pacote)" v-model="pacote" name="pacote" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <option v-for="(pacote, index) in pacotes" :key="index" :value='pacote' > {{pacote.nome}} </option>
                    </select>
                  </div>
                </div>

                <h2 id="payment-and-shipping-heading" class="sr-only text-green">Detalhes do Pagamento</h2>

          
                <form v-if="detalhesPagamento == true" @submit.prevent='finalizarVenda' method="POST">
                  <div class="max-w-2xl px-4 mx-auto mt-4 lg:max-w-none lg:px-0">    
                    <div class="mt-10">
                      <h3 id="payment-heading" class="text-lg font-medium text-gray-900">Detalhes do pagamento</h3>
                      <div class="grid grid-cols-3 mt-6 sm:grid-cols-4 gap-y-6 gap-x-4">
                        <div class="col-span-3 sm:col-span-4">
                            <label for="location" class="block py-2 text-sm font-medium text-gray-700">Forma de Pagamento</label>
                            <select @change="selecionaFormaPagamento(venda.forma_pagamento)" v-model="venda.forma_pagamento" id="location" name="location" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              <option value="à Vista">Dinheiro</option>
                              <option value="Entrada + Parcelas">Entrada + Parcelas</option>
                              <option value="Cartão de Débito">Cartão de Débito</option>
                              <option value="Cartão de Crédito">Cartão de Crédito</option>
                              <option value="PIX">PIX</option>
                              <option value="Conta Bancária">Conta Bancária</option>
                              <option value="Boleto">Boleto</option>
                              <option value="Auto Escola">Auto Escola</option>
                            </select>
                          </div>
                      </div>

                      <div class="grid grid-cols-3 mt-6 sm:grid-cols-4 gap-y-6 gap-x-4">
                        <div v-if="divEntrada" class="col-span-2 sm:col-span-3">
                          <label for="entrada" class="block py-2 text-sm font-medium text-gray-700">Entrada</label>
                          <input v-money="money" v-model="venda.entrada" type="text" name="entrada" id="entrada" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                        
                        <div v-if="divParcelas">
                          <label for="parcelas" class="block py-2 text-sm font-medium text-gray-700">Parcelas</label>
                          <select name="parcelas" v-model="venda.parcelas" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="1">1X</option>
                            <option value="2">2X</option>
                            <option value="3">3X</option>
                            <option value="4">4X</option>
                            <option value="5">5X</option>
                            <option value="6">6X</option>
                            <option value="7">7X</option>
                            <option value="8">8X</option>
                            <option value="9">9X</option>
                            <option value="10">10X</option>
                          </select>
                        </div>
                      </div>
          
                      <div v-if="venda.forma_pagamento != 'Auto Escola'" class="grid grid-cols-3 mt-6 sm:grid-cols-4 gap-y-6 gap-x-4">
                        <div class="col-span-3 sm:col-span-4">
                            <label for="desconto" class="block py-2 text-sm font-medium text-gray-700">Desconto</label>
                            <input v-money="money" v-model="venda.desconto"  type="text" name="desconto" id="desconto" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                          </div>
                      </div>
                      
                    </div>
                    
                  </div>
              
                      
                  <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-1 sm:gap-3 sm:grid-flow-row-dense">
                    <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-1 sm:text-sm" >Finalizar</button>
                  </div>
                </form>
              
              </div>

              <div v-else class="bg-indigo-50">
                <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-24 lg:px-8">
                  <p class="text-2xl font-bold tracking-tight text-gray-900 md:text-2xl">
                    <span class="block">É necessário cadastrar um pacote!</span>
                    <span class="block text-indigo-600">Para iniciar sua primeira venda, <u><a :href="route('pacote.create')">cadastre um pacote!</a></u></span>
                  </p>
                </div>
              </div>

              <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-1 sm:gap-3 sm:grid-flow-row-dense">
              <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="open = false" ref="cancelButtonRef">Fechar</button>
              </div>

              
            </DialogPanel>
          </TransitionChild>

         
        </div>
      </div>   
    </Dialog>
     
  </TransitionRoot>   
</template>



<script>
import BreadCrumbs from '../../Shared/BreadCrumbs.vue'
import { CheckIcon,XCircleIcon } from '@heroicons/vue/solid'
import gerarBoleto from './gerarBoleto.vue'
import { ref } from 'vue'
import {mask} from 'vue-the-mask'
import { useForm } from "@inertiajs/inertia-vue3";
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

export default {
  components: {
    CheckIcon,
    XCircleIcon,
    BreadCrumbs,
    gerarBoleto,
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
  },
  created(){
    this.venda.aluno_id = this.aluno.id
  },
   setup() {
    const open = ref(false)
    const detalhesPagamento = ref(false)
    const divBoleto = ref(false)
    const divEntrada = ref(false)
    const divParcelas = ref(false)
    return {
      venda: useForm({
        nome: '',
        entrada: '',
        desconto: '',
        aluno_id: '',
        pacote_id: '',
        valor_venda: '',
        parcelas: '',
        forma_pagamento:'',
        exames: '',
        errors: Object,
      }),
      open,
      detalhesPagamento,
      pacote: Object,
      divBoleto,
      divParcelas,
      divEntrada,
      money:{
        decimal: ',',
        thousands: '.',
        precision: 2,
        masked: false /* doesn't work with directive */
      },
    }
  },
  methods:{
    checkPacote(pacote){
      this.detalhesPagamento = true
      this.pacote = pacote
      this.venda.nome = this.pacote.nome
      this.venda.pacote_id = this.pacote.id
      this.venda.exames = this.pacote.servicos
      this.venda.valor_venda = this.valorPacote(this.pacote.servicos)
    },
    fechaModal(){
      this.open = false  
      this.detalhesPagamento = false
      this.pacote = null
      this.venda.entrada = null
      this.venda.parcelas = null
      this.vendas.forma_pagamento = null
    },
    finalizarVenda(){
      this.venda.post(this.route('vendas.store', this.venda))
      this.fechaModal()
    },
    selecionaFormaPagamento(forma_pagamento)
    {
      switch (forma_pagamento) {
        case 'Entrada + Parcelas':
          this.divParcelas = true
          this.divEntrada = true 
          this.venda.entrada = null
          this.venda.parcelas = null
          break;

        case 'Cartão de Crédito':
          this.divParcelas = true
          this.divEntrad = false
          this.venda.entrada = null
          this.venda.parcelas = null
          break;
      
        default:
          this.divParcelas = false
          this.divEntrada = false
          this.venda.entrada = null
          this.venda.parcelas = null
          break;
      }
    },
    valorPacote(servico) {
        let servicos = JSON.parse(JSON.stringify(servico))
        let valorTotal = 0;

        servicos.forEach((element) => {
            valorTotal += parseFloat(element.valor)
        })
      
        
        return valorTotal
    },
    convertMoneyFloat(value) {
            if(value === ""){
                value =  0
            }else{
                let currency = value;
                let regex = /([+-]?[0-9|^.|^,]+)[\.|,]([0-9]+)$/igm
                let result = regex.exec(currency);
                let floatResult = result ? result[1].replace(/[.,]/g, "") + "." + result[2] : currency.replace(/[^0-9-+]/g, "");

                return floatResult;
            }
            return value;
        },
  },
  props: {
    pacotes: Object,
    aluno: Object,
    contas: Object,
    auth: Object
  },
  directives: {mask},
}
</script>