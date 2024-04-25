<template>
    <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">
        <fieldset class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
            <Disclosure v-slot="{ open }">
                <legend class="sr-only">P</legend>
                <DisclosureButton class="flex w-full justify-between rounded-lg bg-purple-100 px-4 py-2 text-left text-sm font-medium text-purple-900 hover:bg-purple-200 focus:outline-none focus-visible:ring focus-visible:ring-purple-500/75">
                    <span>Serviços</span>
                    <ChevronUpIcon :class="open ? 'rotate-180 transform' : ''" class="h-5 w-5 text-purple-500" />
                </DisclosureButton>
                <div class="space-y-5 sm:col-span-2">
                    <div class="space-y-5 sm:mt-0">
                        <div class="relative flex items-start">
                            <DisclosurePanel class="w-full px-4 pb-2 pt-4 text-semi-bold text-gray-500">
                                <h3 id="payment-heading" class="text-lg font-medium text-gray-900"> Selecione os Serviços</h3>
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <select @change="checkPacote(servico)" v-model="venda.servico" multiple name="servicos" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option v-for="(servico, index) in serv.data" :key="index" :value='servico'>{{servico.nome}}|{{ servico.categoria }}|R${{ servico.valor }} </option>
                                        </select>
                                        <a href="#" @click="addService" class="mt-2 inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> 
                                            + Incluir   
                                        </a>
                                    </div>
                                </div>
                                <div v-if="todoList">
                                    <hr class="border-gray-200 w-full mt-4" />
                                    <h2 class="text-black font-medium">Serviços Incluidos</h2>
                                    <ul role="list" class="divide-y divide-white/5">
                                            <li v-for="(service, index) in serviceList" :key="index" class="relative flex items-center space-x-4 py-4">
                                            <div class="min-w-0 flex-auto">
                                                <div class="flex items-center gap-x-3">
                                                <!-- <h2 class="min-w-0 text-sm font-semibold leading-6 text-white"> -->
                                                    <a href="#" class="flex gap-x-2">
                                                    <span class="text-sm text-gray-700">{{ service[0].nome }}|</span>
                                                    <!-- <span class="text-sm text-gray-700">Categoria:{{ service[0].categoria}}|</span> -->
                                                    <span class="text-sm text-gray-700">R$ {{ service[0].valor }}</span>
                                                    </a>
                                                <!-- </h2> -->
                                                </div>
                                                <div class="mt-3 flex items-center gap-x-2.5 text-xs leading-5 text-gray-400">
                                                    <div v-if="venda.forma_pagamento != 'Auto Escola'" class="grid grid-cols-3 mt-6 sm:grid-cols-4 gap-y-6 gap-x-4">
                                                        <div class="col-span-3 sm:col-span-4">
                                                            <label for="desconto" class="block py-2 text-sm font-medium text-gray-700">Desconto</label>
                                                            <input v-money="money" v-model="service[0].desconto" type="text" name="desconto" id="desconto" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a @click="removeTask(index)" href="#" class="rounded-full flex-none m-2 py-1 px-2 text-xs text-red-300 font-medium ring-1 ring-red-700">excluir</a>
                                                    <select  v-model="service[0].quantidade" class="max-w-full rounded-md border border-gray-300 py-1.5 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                   </select>
                                                </li>
                                            </ul>
                                        </div>
                                <div v-if="detalhesPagamento">
                                    <hr class="border-gray-200 w-full mt-4" />
                                    <div class="mt-10">
                                        <h3 id="payment-heading" class="text-lg font-medium     text-gray-900">Detalhes do pagamento</h3>
                                        <div class="grid grid-cols-3 mt-6 sm:grid-cols-4 gap-y-6 gap-x-4">
                                            <div class="col-span-3 sm:col-span-4">
                                                <label for="location" class="block py-2 text-sm font-medium text-gray-700"> Forma de Pagamento</label>
                                                <select @change="selecionaFormaPagamento(venda.forma_pagamento)" v-model="venda.forma_pagamento" id="location" name="location" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option value="à Vista">Dinheiro</option>
                                                    <option value="Entrada + Parcelas">2 formas de pagamento</option>
                                                    <option value="Cartão de Débito">Cartão de Débito</option>
                                                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                                                    <option value="PIX">PIX</option>
                                                    <option value="Conta Bancária"> Conta Bancária</option>
                                                    <option value="Boleto">Boleto</option>
                                                    <option value="Auto Escola">Auto Escola</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="border-gray-200 w-full mt-4" />
                                    <div class="grid grid-cols-3 mt-6 sm:grid-cols-4 gap-y-6 gap-x-4">
                                        <!-- <div v-if="divEntrada" class="col-span-2 sm:col-span-3">
                                            <label for="entrada" class="block py-2 text-sm font-medium text-gray-700">Entrada</label>
                                            <input v-money="money" v-model="venda.entrada" type="text" name="entrada" id="entrada" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                        </div> -->
                                        <div v-if="divParcelas">
                                            <label for="parcelas" class="block py-2 text-sm font-medium text-gray-700">Parcelas</label>
                                            <select name="parcelas" v-model="venda.parcelas" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option selected value="1">1X</option>
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
                                        <hr class="border-gray-200 w-full mt-4" />
                                    </div>
                                    
                                    
                                    <div class="flow-root mt-4">
                                        <dl class="-my-4 divide-y divide-gray-200 text-sm">
                                            <div class="flex items-center justify-between py-4">
                                            <dt class="text-gray-600">Serviço</dt>
                                            <dd class="font-medium text-gray-900">{{convertFloatMoney(totalServico)}}</dd>
                                            </div>
                                            <div class="flex items-center justify-between py-4">
                                            <dt class="text-gray-600">Desconto</dt>
                                            <dd class="font-medium text-gray-900">{{convertFloatMoney(totalDesconto)}}</dd>
                                            </div>
                                            <div class="flex items-center justify-between py-4">
                                            <dt class="text-base font-medium text-gray-900">Total</dt>
                                            <dd class="font-medium text-gray-900">{{convertFloatMoney(totalServico - totalDesconto)}}</dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                                <div v-if="detalhesPagamento" class="mt-4 flex justify-end space-x-3">
                                    <button type="button" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" @click="fechaSide">Cancelar</button>
                                    <button type="button" @click="finalizarVenda" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Finalizar</button>
                                </div>
                            </DisclosurePanel>
                        </div>
                    </div>
                    <div class="flex flex-col items-start space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                    </div>
                </div>
            </Disclosure>
        </fieldset>
    </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import {mask} from 'vue-the-mask'
import {ref,defineEmits,onMounted} from 'vue'
import { Disclosure,DisclosureButton,DisclosurePanel,Dialog,DialogPanel,DialogTitle,TransitionChild,TransitionRoot} from '@headlessui/vue'
import {LinkIcon,PlusIcon,QuestionMarkCircleIcon,ChevronUpIcon,XIcon} from '@heroicons/vue/solid'

 export default {
 props: {
    pacotes: Object,
    aluno: Object,
    contas: Object,
    auth: Object,
    serv:Object,
 openSide: Boolean
},  
components: {
LinkIcon,PlusIcon,XIcon,
QuestionMarkCircleIcon,ChevronUpIcon,
Dialog,DialogPanel,DialogTitle,
TransitionChild,TransitionRoot,Disclosure,DisclosureButton,DisclosurePanel
 },
 
created() {
 this.venda.aluno_id = this.aluno.id
 },
 setup(_,{emit}){

const closeSide = (el) => {
emit('side-closed', true);
}
const open = ref(false)
const detalhesPagamento = ref(false)
const divBoleto = ref(false)
const divEntrada = ref(false)
const divParcelas = ref(false)
const todoList =  ref(false)
const nomeServicos = [] 
const newTask = ref([])
const serviceList = ref([]) 
const valor_totalServico = ref(0)      

return {
    valor_totalServico,
    newTask,
    serviceList,
    closeSide,
    venda: useForm({
          nome: '',
          entrada: '',
          desconto: '',
          aluno_id: '',
          pacote_id: '',
          servico_id:'',
          valor_venda: '',
          valor_pago:'',
          parcelas: '',
          forma_pagamento: '',
          exames: '',
          servicos: '',
          errors: Object,
        }),
                todoList,
                open,
                detalhesPagamento,
                servico: Object,
                divBoleto,
                divParcelas,
                divEntrada,
                nomeServicos,
                money: {
                    decimal: ',',
                    thousands: '.',
                    precision: 2,
                    masked: false /* doesn't work with directive */
                },
            }
        },
computed: { 
            
            totalServico () {
                let valor = 0;
                this.serviceList.forEach((element) => {
                    let quantidade = element[0].quantidade ? parseInt(element[0].quantidade) : 1;
                    valor += parseFloat(element[0].valor) * quantidade;
                });
                return valor;
            },
            totalDesconto () {
                let desconto = 0;
                this.serviceList.forEach((element) => {
                    if (element[0].desconto) {
                    let descontoStr = element[0].desconto.replace('R$', '').replace(',', '.')
                        desconto += parseFloat(descontoStr)
                    }
                });
                
                return desconto;
            },
},
 methods: {
            addService() {
                let servicoAdd = this.serviceList.some(service => service[0].id === this.venda.servico[0].id);
                if (servicoAdd) {
                    alert('Este serviço já foi selecionado!');
                } else {
                    this.serviceList.push(this.venda.servico);
                    this.venda.servico = [];
                    this.todoList = true;
                    this.detalhesPagamento = true;
                }
            },
            removeTask(index) {
                this.serviceList.splice(index, 1);
                if(this.serviceList.length === 0) {
                    this.todoList = false
                    this.detalhesPagamento = false
                }
            },
            checkPacote(servico) {
                this.servico = servico
                this.venda.nome = this.servico.nome
                this.venda.pacote_id = this.servico.id
                
            },
            fechaSide() {
                this.serviceList = []
                this.todoList = false
                this.venda.servico = null
                this.detalhesPagamento = false
                this.pacote = null
                this.venda.entrada = null
                this.venda.parcelas = null
                this.venda.forma_pagamento = null
                this.venda.servico = null;
                this.valor_totalServico = 0
            },
            finalizarVenda() {
                this.serviceList.forEach((servico) => {
                    this.nomeServicos.push(servico[0].nome);
                });
                // this.venda.nome = this.nomeServicos.join(", ");
                this.venda.servicos = this.serviceList;
                this.venda.valor_venda = this.totalServico;
                this.venda.valor_pago = this.totalServico - this.totalDesconto;
                this.venda.desconto = this.totalDesconto;
                this.venda.post(this.route('vendas.store'))
                this.fechaSide()
            },
            selecionaFormaPagamento(forma_pagamento) {
                switch (forma_pagamento) {
                    case 'Entrada + Parcelas':
                        this.divParcelas = true
                        this.divEntrada = true
                        this.venda.entrada = null
                        this.venda.parcelas = null
                        break;
                    case 'Cartão de Crédito':
                        this.divParcelas = true
                        this.divEntrada = false
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
            
        },
        directives: {
            mask
        },
        emits: ['side-closed']
    }
</script>
