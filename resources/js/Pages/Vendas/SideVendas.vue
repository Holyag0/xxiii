<template>
    <TransitionRoot as="template" :show="openSide">
        <Dialog as="div" class="relative z-10" @close="openSide = false">
            <div class="fixed inset-0" />

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                        <TransitionChild @after-leave="closeSide" as="template"
                            enter="transform transition ease-in-out duration-500 sm:duration-700"
                            enter-from="translate-x-full" enter-to="translate-x-0"
                            leave="transform transition ease-in-out duration-500 sm:duration-700"
                            leave-from="translate-x-0" leave-to="translate-x-full">
                            <DialogPanel class="pointer-events-auto w-screen max-w-2xl">
                                <form class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                                    <div class="flex-1">
                                        <!-- Header -->
                                        <div class="bg-gray-50 px-4 py-6 sm:px-6">
                                            <div class="flex items-start justify-between space-x-3">
                                                <div class="space-y-1">
                                                    <DialogTitle
                                                        class="text-base font-semibold leading-6 text-gray-900">Painel
                                                        de Pacotes e Serviços</DialogTitle>
                                                    <p class="text-sm text-gray-500">Inicie a venda do aluno escolhendo
                                                        um pacote ou um ou mais serviço específico</p>
                                                </div>
                                                <div class="flex h-7 items-center">
                                                    <button type="button"
                                                        class="relative text-gray-400 hover:text-gray-500"
                                                        @click="openSide = false">
                                                        <span class="absolute -inset-2.5" />
                                                        <span class="sr-only">Close panel</span>
                                                        X
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Divider container -->
                                        <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">
                                            <div v-if="diVazio" class="bg-indigo-50">
                                                         <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-24 lg:px-8">
                                                            <h2 class="text-3xl font-bold tracking-tight text-gray-900 md:text-4xl">
                                                                <span class="block">Nenhum Pacote!</span>
                                                                <span class="block text-indigo-600">Pacote não existe ou não foi cadastrado para esse processo.</span>
                                                            </h2>
                                                        </div>
                                                    </div>
                                            <!-- Privacy -->
                                            <fieldset v-else
                                                class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                                                <Disclosure v-slot="{ open }">
                                                    <legend class="sr-only">P</legend>
                                                    <DisclosureButton
                                                        class="flex w-full justify-between rounded-lg bg-purple-100 px-4 py-2 text-left text-sm font-medium text-purple-900 hover:bg-purple-200 focus:outline-none focus-visible:ring focus-visible:ring-purple-500/75">
                                                        <span>Pacotes</span>
                                                        <ChevronUpIcon :class="open ? 'rotate-180 transform' : ''"
                                                            class="h-5 w-5 text-purple-500" />
                                                    </DisclosureButton>
                                                    <div class="space-y-5 sm:col-span-2">
                                                        <div class="space-y-5 sm:mt-0">
                                                            <div class="relative flex items-start">
                                                                <DisclosurePanel
                                                                    class="w-full px-4 pb-2 pt-4 text-semi-bold text-gray-500">
                                                                    <h3 id="payment-heading"
                                                                        class="text-lg font-medium text-gray-900">
                                                                        Selecione o Pacote</h3>
                                                                    <div class="grid grid-cols-6 gap-6">
                                                                        <div class="col-span-6">
                                                                            <select @change="checkPacote(pacote)"
                                                                                v-model="pacote" name="pacote"
                                                                                class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                                <option
                                                                                    v-for="(pacote, index) in pacotes"
                                                                                    :key="index" :value='pacote'>
                                                                                    {{ pacote.nome }}| {{pacote.categoria}} </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="border-gray-200 w-full mt-4" />
                                                                    <div v-if="detalhesPagamento == true">
                                                                        <div class="mt-10">
                                                                            <h3 id="payment-heading"
                                                                                class="text-lg font-medium text-gray-900">
                                                                                Detalhes do pagamento</h3>
                                                                            <div
                                                                                class="grid grid-cols-3 mt-6 sm:grid-cols-4 gap-y-6 gap-x-4">
                                                                                <div class="col-span-3 sm:col-span-4">
                                                                                    <label for="location"
                                                                                        class="block py-2 text-sm font-medium text-gray-700">
                                                                                        Forma de Pagamento</label>
                                                                                    <select
                                                                                        @change="selecionaFormaPagamento(venda.forma_pagamento)"
                                                                                        v-model="venda.forma_pagamento"
                                                                                        id="location" name="location"
                                                                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                                        <option value="à Vista">Dinheiro
                                                                                        </option>
                                                                                        <option
                                                                                            value="Entrada + Parcelas">
                                                                                            2 formas de pagamento</option>
                                                                                        <option
                                                                                            value="Cartão de Débito">
                                                                                            Cartão de Débito</option>
                                                                                        <option
                                                                                            value="Cartão de Crédito">
                                                                                            Cartão de Crédito</option>
                                                                                        <option value="PIX">PIX</option>
                                                                                        <option value="Conta Bancária">
                                                                                            Conta
                                                                                            Bancária</option>
                                                                                        <option value="Boleto">Boleto
                                                                                        </option>
                                                                                        <option value="Auto Escola">Auto
                                                                                            Escola</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr class="border-gray-200 w-full mt-4" />
                                                                        <div
                                                                            class="grid grid-cols-3 mt-6 sm:grid-cols-4 gap-y-6 gap-x-4">
                                                                            <!-- <div v-if="divEntrada"
                                                                                class="col-span-2 sm:col-span-3">
                                                                                <label for="entrada"
                                                                                    class="block py-2 text-sm font-medium text-gray-700">Entrada</label>
                                                                                <input v-money="money"
                                                                                    v-model="venda.entrada" type="text"
                                                                                    name="entrada" id="entrada"
                                                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                                                            </div> -->
                                                                            <div v-if="divParcelas">
                                                                                <label for="parcelas"
                                                                                    class="block py-2 text-sm font-medium text-gray-700">Parcelas</label>
                                                                                <select name="parcelas"
                                                                                    v-model="venda.parcelas"
                                                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                                                                        <hr class="border-gray-200 w-full mt-4" />
                                                                        <div v-if="venda.forma_pagamento != 'Auto Escola'"
                                                                            class="grid grid-cols-3 mt-6 sm:grid-cols-4 gap-y-6 gap-x-4">
                                                                            <div class="col-span-3 sm:col-span-4">
                                                                                <label for="desconto"
                                                                                    class="block py-2 text-sm font-medium text-gray-700">Desconto</label>
                                                                                <input v-money="money"
                                                                                    v-model="venda.desconto" type="text"
                                                                                    name="desconto" id="desconto"
                                                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-4 flex justify-end space-x-3">
                                                                        <button type="button"
                                                                            class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                                                            @click="fechaModal">Cancelar</button>
                                                                        <button type="button" @click="finalizarVenda"
                                                                            class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Finalizar</button>
                                                                    </div>
                                                                </DisclosurePanel>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="flex flex-col items-start space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">

                                                        </div>
                                                    </div>
                                                </Disclosure>
                                            </fieldset>
                                            <div v-if="divServico" class="bg-indigo-50">
                                                    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-24 lg:px-8">
                                                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 md:text-4xl">
                                                            <span class="block">Nenhum Serviço!</span>
                                                            <span class="block text-indigo-600">Serviço não existe ou não foi cadastrado para esse processo.</span>
                                                        </h2>
                                                    </div>
                                                </div>
                                                <VendaServico v-else  :serv="serv" :auth="auth" :aluno="aluno" :contas="contas" :pacotes="pacotes.data" />
                                            </div>
                                        </div>
                                        
                                        
                                    <!-- Action buttons -->
                                    <div class="flex-shrink-0 border-t border-gray-200 px-4 py-5 sm:px-6">
                                        <div class="flex justify-end space-x-3">
                                            <button type="button"
                                                class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                                @click="openSide = false">Fechar</button>
                                        </div>
                                    </div>
                                </form>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";
import { mask } from 'vue-the-mask'
import { ref, defineEmits,onMounted } from 'vue'
import { Disclosure, DisclosureButton, DisclosurePanel, Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { LinkIcon, PlusIcon, QuestionMarkCircleIcon, ChevronUpIcon } from '@heroicons/vue/solid'
import VendaServico from "./VendaServico.vue";
export default {
    props: {
        pacotes: Object,
        aluno: Object,
        contas: Object,
        auth: Object,
        openSide: Boolean,
        serv:Object
    },
    components: {
        LinkIcon, PlusIcon, QuestionMarkCircleIcon, ChevronUpIcon,
        Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot,
        Disclosure, DisclosureButton, DisclosurePanel,VendaServico
    },
    created() {
        this.venda.aluno_id = this.aluno.id
    },
    setup(props, { emit }) {
        const closeSide = (el) => {
            emit('side-closed', true);
        }
        const open = ref(false)
        const detalhesPagamento = ref(false)
        const divBoleto = ref(false)
        const divEntrada = ref(false)
        const divParcelas = ref(false)
        const diVazio = ref(false)
        const divServico = ref(false)

onMounted(() => {
    if (!props.serv.data || Object.keys(props.serv.data).length === 0 ) {
                divServico.value = !divServico.value 
                console.log(divServico,'s')
        }
     if (!props.pacotes || Object.keys(props.pacotes).length === 0  ) {
                diVazio.value = !diVazio.value
                console.log(diVazio,'|p|',props.pacotes)
        }  
})
        return {
            closeSide,
            diVazio,
            divServico,
            venda: useForm({
                nome: '',
                entrada: '',
                desconto: '',
                aluno_id: '',
                pacote_id: '',
                valor_venda: '',
                parcelas: '',
                forma_pagamento: '',
                exames: '',
                errors: Object,
            }),
            open,
            detalhesPagamento,
            pacote: Object,
            divBoleto,
            divParcelas,
            divEntrada,
            money: {
                decimal: ',',
                thousands: '.',
                precision: 2,
                masked: false /* doesn't work with directive */
            },
        }
    },
    methods: {
        checkPacote(pacote) {
            this.detalhesPagamento = true
            this.pacote = pacote
            this.venda.nome = this.pacote.nome
            this.venda.pacote_id = this.pacote.id
            this.venda.exames = this.pacote.servicos
            this.venda.valor_venda = this.valorPacote(this.pacote.servicos)
        },
        fechaModal() {
            //   this.open = false  
            this.detalhesPagamento = false
            this.pacote = null
            this.venda.entrada = null
            this.venda.parcelas = null
            this.venda.forma_pagamento = null
            this.openSide = false
        },
        finalizarVenda() {
            console.log('pacote')
            this.venda.post(this.route('vendas.store', this.venda))
            this.fechaModal()
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
            if (value === "") {
                value = 0
            } else {
                let currency = value;
                let regex = /([+-]?[0-9|^.|^,]+)[\.|,]([0-9]+)$/igm
                let result = regex.exec(currency);
                let floatResult = result ? result[1].replace(/[.,]/g, "") + "." + result[2] : currency.replace(/[^0-9-+]/g, "");

                return floatResult;
            }
            return value;
        },
    },
    directives: { mask },
    emits: ['side-closed']
}


</script>