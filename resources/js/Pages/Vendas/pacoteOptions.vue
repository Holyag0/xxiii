<template>
    <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">
    <fieldset class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 
                      sm:space-y-0 sm:px-6 sm:py-5">
    <Disclosure v-slot="{ open }">
        <form @submit.prevent='submitPacote' class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
        <DisclosureButton
            class="flex w-full justify-between rounded-lg bg-purple-100 px-4 py-2 text-left text-sm font-medium text-purple-900 hover:bg-purple-200 focus:outline-none focus-visible:ring focus-visible:ring-purple-500/75">
            <span>Pacotes</span>
            <ChevronUpIcon :class="open ? 'rotate-180 transform' : ''" class="h-5 w-5 text-purple-500" />
        </DisclosureButton>
        <!-- <div class="text-sm font-medium leading-6 text-gray-900" aria-hidden="true">Privacy</div> -->
        <div class="space-y-5 sm:col-span-2">
            <div class="space-y-5 sm:mt-0">
                <div class="relative flex items-start">
                    <div class="w-full px-4 ">
                        <div class="mx-auto w-full max-w-md rounded-2xl bg-white p-2">
                            <DisclosurePanel class="px-4 pb-2 pt-4 text-sm text-gray-500">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <select @change="checkPacote(pacote)" v-model="pacote" name="pacote"
                                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option v-for="(pacote, index) in pacotes" :key="index" :value='pacote'>
                                                {{ pacote.nome }}</option>
                                        </select>
                                    </div>
                                </div>
                            </DisclosurePanel>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="border-gray-200" />
            <div
                class="flex flex-col items-start space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                <div>
                    <!-- <a href="#"
                        class="group flex items-center space-x-2.5 text-sm font-medium text-indigo-600 hover:text-indigo-900">
                        <LinkIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-900" aria-hidden="true" />
                        <span>Copy link</span>
                    </a> -->
                    <button type="button" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" @click="open = false">Cancel</button>
                </div>
                <div>
                    <!-- <a href="#" class="group flex items-center space-x-2.5 text-sm text-gray-500 hover:text-gray-900">
                        <QuestionMarkCircleIcon class="h-5 w-5 text-gray-400 group-hover:text-gray-500"
                            aria-hidden="true" />
                        <span>Learn more about sharing</span>
                    </a> --> <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Vender</button>
                </div>
            </div>
        </div>
    </form>
    </Disclosure>
</fieldset>
</div>
</template>
<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { useForm } from "@inertiajs/inertia-vue3";
import { ref,defineEmits } from 'vue'

const submitPacote = () => {
venda.post(route('venda.store',venda));
};
console.log(props.aluno)
let vendaPacote = useForm({
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
    });

const props = defineProps({
pacotes: Object,
  aluno: Object,
  contas: Object,
  auth: Object,


});
</script>
<script>
export default {
    methods: {
        checkPacote(pacote) {
            this.detalhesPagamento = true
            this.pacote = pacote
            this.venda.nome = this.pacote.nome
            this.venda.pacote_id = this.pacote.id
            this.venda.exames = this.pacote.servicos
            this.venda.valor_venda = this.valorPacote(this.pacote.servicos)
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
    }
};
</script>