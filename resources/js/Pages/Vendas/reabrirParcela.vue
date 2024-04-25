<template>
  <a href="#" @click="open = true" class="block px-3 py-2 mx-2 mt-1">Reabrir</a>
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
              
              <div class="px-4 py-5 bg-white sm:p-6">
                Tem certeza que deseja reabrir esta parcela?
              </div>
              
            </div>
            <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
              <button type="button" @click="reabrirParcela" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">Reabrir</button>
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
      transacao: useForm({
        status: '0',
        aluno_id: '',
        errors: Object,
      }),
    }
  },
  methods:{
    reabrirParcela(){
      this.transacao.aluno_id = this.aluno_id
      this.transacao.post(this.route('reabrirParcela', this.parcela.id))
      this.open = false
    },
  },
  directives: {mask},
  props: {
    parcela: Object,
    contas: Object,
    aluno_id: Number,
  }
}
</script>