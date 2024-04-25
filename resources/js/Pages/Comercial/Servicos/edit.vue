<template>
  <Head>
    <title>Edição de Serviços</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Edição de Servicos</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
     <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='updateServico' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">

                <div class="col-span-3 sm:col-span-2">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="form.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.nome" v-text="form.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                  <input v-model="form.valor" v-money="money" type="text" name="valor" id="valor" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.valor" v-text="form.errors.valor" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                
                  <select v-model="form.status" name="status" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='1'> Ativado </option>
                    <option value='0'> Desativado </option>
                  </select>

                  <div v-if="form.errors.status" v-text="form.errors.status" class="mt-1 text-xs text-red-500"></div>
                </div>
                
              </div>
              <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                <Link :href="route('servico.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
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
        { name: 'Listagem de Serviços', href: 'servico.index', current: false },
        { name: 'Edição de Serviços', current: true },
      ]

const props = defineProps({
  servico: Object,
})

let convertMoneyFloat = function (value) {
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
};
    
defineComponent({
  BreadCrumbs
})

const form = useForm({
  nome: props.servico.nome,
  valor: props.servico.valor,
  status: props.servico.status,
  errors: Object,
})

const money = {
  decimal: ',',
  thousands: '.',
  precision: 2,
  masked: false /* doesn't work with directive */ 
}

function updateServico(){
  form.valor = convertMoneyFloat(form.valor)
  form.put(route('servico.update', props.servico.id))
}

</script>

