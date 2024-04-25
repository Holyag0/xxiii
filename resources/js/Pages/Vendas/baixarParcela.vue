<template>
  <a href="#" @click="open = true" class="mr-2 text-sm text-blue-600 hover:text-blue-400">Baixar</a>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed inset-0 z-10 overflow-y-auto" @close="open = false">
      <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" />
        </TransitionChild>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
            <div>
              
              <div class="col-span-4 sm:col-span-3">
                <label for="conta" class="block text-sm font-medium text-gray-700">Conta</label>
              
                <select v-model="transacao.conta_id" name="conta_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option v-for="(conta, index) in contas" :key="index" :value='index'> {{conta}} </option>
                </select>

                <div v-if="transacao.errors.conta_id" v-text="transacao.errors.conta_id" class="mt-1 text-xs text-red-500"></div>
              </div>
                

              <div class="col-span-3 sm:col-span-2">
                <label for="forma_pagamento" class="block text-sm font-medium text-gray-700">Forma de Pagamento</label>
              
                <select v-model="transacao.forma_pagamento" name="forma_pagamento" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='Dinheiro'> Dinheiro </option>
                    <option value='Cartão de Crédito'> Cartão de Crédito </option>
                    <option value='Cartão de Débito'> Cartão de Débito </option>
                    <option value='Pix'> Pix </option>
                    <option value='Conta Bancária'> Transferência Bancária </option>
                    <option value='Outros'>outros</option>
                </select>

                <div v-if="transacao.errors.forma_pagamento" v-text="transacao.errors.forma_pagamento" class="mt-1 text-xs text-red-500"></div>
              </div>

              <div class="col-span-3 sm:col-span-2">
                <label for="data_pagamento" class="block text-sm font-medium text-gray-700">Data</label>
                <input v-model="transacao.data_pagamento" type="date" name="data_pagamento" id="data_pagamento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
              
                <div v-if="transacao.errors.data_pagamento" v-text="transacao.errors.data_pagamento" class="mt-1 text-xs text-red-500"></div>
              </div>
                    <div v-if='venda.forma_pagamento == "Entrada + Parcelas"' class="col-span-2 sm:col-span-3">
                        <label for="entrada" class="block py-2 text-sm font-medium text-gray-700">valor da baixa</label>
                       <input v-money="money" v-model="transacao.valor"  type="text" name="entrada" id="entrada" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                   </div>
              <div class="col-span-3 sm:col-span-2">
                <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                <input v-model="transacao.descricao" type="text" name="descricao" id="descricao" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
              
                <div v-if="transacao.errors.descricao" v-text="transacao.errors.descricao" class="mt-1 text-xs text-red-500"></div>
              </div>
              
            </div>
            <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
              <button type="button" @click="baixarParcela" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">Baixar</button>
              <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="open = false" ref="cancelButtonRef">Cancelar</button>
            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import {mask} from 'vue-the-mask'
import { ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'


export default {
   components:{
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
  },
  setup() {
    const open = ref(false)
    return {
      open,
      // aluno:Object,
      transacao: useForm({
        status: '1',
        conta_id: '',
        tipo: 'Receita',
        valor: '',
        aluno_id:'',
        forma_pagamento: '',
        data_pagamento: '',
        descricao: '',
        errors: Object,
        
      }),
       money:{
        decimal: ',',
        thousands: '.',
        precision: 2,
        masked: false /* doesn't work with directive */
      },
    }
  },
  methods:{
    
    baixarParcela(){
      if(this.venda.forma_pagamento == "Entrada + Parcelas"){
              this.transacao.aluno_id = this.aluno.id
              this.transacao.post(this.route('baixarParcela', this.parcela.id))
              this.open = false
      }else{
         this.transacao.valor = this.parcela.valor_parcela
            this.transacao.aluno_id = this.aluno.id
              this.transacao.post(this.route('baixarParcela', this.parcela.id))
              this.open = false
      }
     
    },
  },
  directives: {mask},
  props: {
    parcela:Object,
    contas:Object,
    aluno:Object,
    aluno_id: Number,
    venda:Object
  }
}
</script>