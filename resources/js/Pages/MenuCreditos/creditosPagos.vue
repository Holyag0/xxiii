<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Créditos Pagos</title>
  </Head>
  
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      
    <bread-crumbs class="ml-8 mr-8 " :pages="links" />
 
    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
      <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Valor Pago</th>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Descrição</th>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Data de Pagamento</th>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Alunos</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="credito in creditosPagos" :key="credito.id">
              
              <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ credito.id }}
              </td>

               <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ convertFloatMoney(credito.valor_pago) }}
              </td>
              
              <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ credito.descricao }}
              </td>
        
              <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ convertData(credito.data_pagamento) }}
              </td>

              <td>
                <a href="#" @click="open = true" class="block px-3 py-2 mx-2 mt-1">Lista de Alunos</a>
              </td>
              
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="px-4 py-3 text-left bg-gray-50 sm:px-6">
      <Link :href="route('menuCreditos')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
    </div>

    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="fixed inset-0 z-10 overflow-y-auto" @close="open = false">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
            <DialogOverlay class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" />
          </TransitionChild>

          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
              
              <div class="text-center">
                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900"> Lista de Alunos </DialogTitle>
              </div>
               
              <div v-for="creditoPago in creditosPagos" :key="creditoPago.id">
              <div v-for="creditoDisponivel in creditoPago.creditos" :key="creditoDisponivel.id">
                  <table class="min-w-full divide-y divide-gray-300">
                      <thead>
                          <tr>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nome</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">CPF</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                <div class="text-gray-900"> {{creditoDisponivel.aluno.nome}}</div>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                <div class="text-gray-900"> {{creditoDisponivel.aluno.cpf}}</div>
                            </td>
                            
                          </tr>
                      </tbody>
                  </table>  
                </div>   
            </div>
            </div>
          </TransitionChild>
        </div>
      </Dialog>
    </TransitionRoot>
    
    </div>
  </div>
</template>

<script>
import BreadCrumbs from '../../Shared/BreadCrumbs.vue'
import { ref } from 'vue'
import {mask} from 'vue-the-mask'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

export default {
  components: { 
    BreadCrumbs,   
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
      links:[
        { name: 'Menu de Créditos', href: 'menuCreditos', current: false },
        { name: 'Listagem de Créditos Pagos', current: true },
      ],
    }
  },
  props: {
    creditosPagos: Object,
    auto_escola_id: Number
  },
   directives: {mask}
}
</script>