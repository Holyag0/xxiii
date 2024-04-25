<template>
  <Head>
    <title>Edição de Despesas</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Edição de despesas</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
     <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='updateDespesa' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">

                <div class="col-span-4 sm:col-span-3">
                  <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                  <input v-model="form.valor" v-money="money" type="text" name="valor" id="valor" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.valor" v-text="form.errors.valor" class="mt-1 text-xs text-red-500"></div>
                </div>
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="data_vencimento" class="block text-sm font-medium text-gray-700">Data</label>
                  <input v-model="form.data_vencimento" type="date" name="data_vencimento" id="data_vencimento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.data_vencimento" v-text="form.errors.data_vencimento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="centro_custo_id" class="block text-sm font-medium text-gray-700">Centro de Custos</label>
                
                  <select v-model="form.centro_custo_id" name="centro_custo_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(centroCusto, index) in centroCustos" :key="index" :value='index'> {{centroCusto}} </option>
                  </select>

                  <div v-if="form.errors.centro_custo_id" v-text="form.errors.centro_custo_id" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="fornecedor_id" class="block text-sm font-medium text-gray-700">Fornecedores</label>
                
                  <select v-model="form.fornecedor_id" name="fornecedor_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(fornecedor, index) in fornecedores" :key="index" :value='index'> {{fornecedor}} </option>
                  </select>

                  <div v-if="form.errors.fornecedor_id" v-text="form.errors.fornecedor_id" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6">
                  <label for="obs" class="block text-sm font-medium text-gray-700">Observação</label>
                  <input v-model="form.obs" type="text" name="obs" id="obs" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.obs" v-text="form.errors.obs" class="mt-1 text-xs text-red-500"></div>
                </div>
                
              </div>
              <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                <Link :href="route('despesas.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
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
        { name: 'Listagem de Despesas', href: 'despesas.index', current: false },
        { name: 'Edição de Despesas', current: true },
      ]

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
    
const props = defineProps({
  despesa: Object,
  centroCustos: Object,
  fornecedores: Object,
})

const money = {
  decimal: ',',
  thousands: '.',
  precision: 2,
  masked: false /* doesn't work with directive */ 
}
    
defineComponent({
  BreadCrumbs
})

const form = useForm({
  valor: props.despesa.valor,
  data_vencimento: props.despesa.data_vencimento,
  centro_custo_id: props.despesa.centro_custo_id,
  fornecedor_id: props.despesa.fornecedor_id,
  obs: props.despesa.obs,
  errors: Object,
})

function updateDespesa(){
  form.valor = convertMoneyFloat(form.valor)
  form.put(route('despesas.update', props.despesa.id))
}

</script>

