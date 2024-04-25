<template>
        
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
                      
                      <div class="col-span-3 mb-5 sm:col-span-2 lg:col-span-2">
                        <span>Categorias</span>
                        <select v-model="filtro.categoria_id" aria-placeholder="Centro De Custos" id="categoria_id" name="categoria_id" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                           <option v-for="(categoria, index) in categorias" :key="index" :value='index'> {{categoria}} </option>
                        </select>
                      </div>

                      <div class="col-span-3 mb-5 sm:col-span-2 lg:col-span-1">
                        <span>Statuss</span>
                        <select v-model="filtro.status" id="status" name="status" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option selected>Status</option>
                          <option value="0">Á receber</option>
                          <option value="1">Recebid</option>
                        </select>
                      </div>

                      <div class="col-span-3 mb-5 sm:col-span-2 lg:col-span-1">
                        <label for="data_inicio" class="block text-sm font-medium text-gray-700">Data Inicial</label>
                        <input v-model="filtro.data_inicio" type="date" name="data_inicio" id="data_inicio" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                      </div>

                      <div class="col-span-3 mb-5 sm:col-span-2 lg:col-span-1">
                        <label for="data_fim" class="block text-sm font-medium text-gray-700"></label>
                        <input v-model="filtro.data_fim" type="date" name="data_fim" id="data_fim" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                      </div>
                    
                      
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                      <button type="submit" @click="searchRelatorio" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">Filtrar</button>
                      <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="open = false" ref="cancelButtonRef">Cancelar</button>
                    </div>
                  </div>
                </TransitionChild>
              </div>
            </Dialog>
          </TransitionRoot>
</template>

<script>
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ref } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    //v-model="filtro.data_fim"
    //v-model="filtro.status"
    // v-model="filtro.categoria_id"
    //v-model="filtro.data_inicio"
    components: {
            Dialog,
            DialogOverlay,
            DialogTitle,
            TransitionChild,
            TransitionRoot,
    },
    setup(){
        const open = ref(false)
        return{ 
            open,
             filtro: {
              data_inicio:'',
             data_fim:'',
             cliente: '',
             status: '',
             categoria_id: ''
      },
        }
       
    },
    methods:{
        searchRelatorio()
    {
      this.$inertia.replace(
        this.route('receita.relatorio',{search: this.filtro})
      );
      this.open = false
    },     
    },
    props: {
        receita: Object,
        categorias: Object,
    }
}
</script>

<style>

</style>