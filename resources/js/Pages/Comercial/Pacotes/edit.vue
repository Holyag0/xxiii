<template>
  <Head>
    <title>Edição de Pacotes</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Edição de Pacotes</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
     <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='updatePacote' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">

                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="form.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.nome" v-text="form.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-12 sm:col-span-3">
                  <label for="funcoes" class="block text-sm font-medium text-gray-700">Serviços</label>
                
                  <select v-model="form.servicos" multiple name="servicos" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(servico, index) in servicos" :key="index" :value='index'> {{servico}} </option>
                  </select>

                  <div v-if="form.errors.servicos" v-text="form.errors.servicos" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="desconto_boleto" class="block text-sm font-medium text-gray-700">Desconto Boleto</label>
                  
                  <select v-model="form.desconto_boleto" name="status" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='1'> Permitir Desconto </option>
                    <option value='0'> Não Permitir </option>
                  </select>
                  
                  <div v-if="form.errors.desconto_boleto" v-text="form.errors.desconto_boleto" class="mt-1 text-xs text-red-500"></div>               
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                
                  <select v-model="form.status" name="status" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='1'> Ativado </option>
                    <option value='0'> Desativado </option>
                  </select>

                  <div v-if="form.errors.status" v-text="form.errors.status" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div v-if="pacote.credito_cfc" class="col-span-4 sm:col-span-3">
                  <!-- ou form.credito_cfc -->
                  <label for="desconto_boleto" class="block text-sm font-medium text-gray-700">Desconto Boleto</label>
                  
                   <input v-money="money" v-model="pacote.credito_cfc" type="text" name="entrada" id="entrada" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  
                  <div v-if="form.errors.desconto_boleto" v-text="form.errors.desconto_boleto" class="mt-1 text-xs text-red-500"></div>               
                </div>
                
              </div>
              <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                <Link :href="route('pacote.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
                <button type="submit" :disabled="form.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
              </div>
              
              <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
              </progress>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { defineComponent } from "@vue/runtime-core";
import BreadCrumbs from '../../../Shared/BreadCrumbs.vue'

let links = [
        { name: 'Listagem de Pacotes', href: 'pacote.index', current: false },
        { name: 'Edição de Pacotes', current: true },
      ]

const props = defineProps({
  pacote: Object,
  servicos: Object
})

defineComponent({
  BreadCrumbs
})

const form = useForm({
  nome: props.pacote.data.nome,
  servicos: props.pacote.data.servicos,
  desconto_boleto: props.pacote.data.desconto_boleto,
  status: props.pacote.data.status,
  credito_cfc: props.pacote.data.credito_cfc,
  errors: Object,
})

function updatePacote(){
  form.put(route('pacote.update', props.pacote.data.id))
}
  

</script>

<script>
import {mask} from 'vue-the-mask'

export default {
  directives:{
      mask
    },
    money:{
        decimal: ',',
        thousands: '.',
        precision: 2,
        masked: false /* doesn't work with directive */
      },
};
</script>

