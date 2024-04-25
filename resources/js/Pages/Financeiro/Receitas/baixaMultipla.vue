<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Baixar Múltiplas Receitas</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Baixar Múltiplas Receitas</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='baixaMultipla' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <h1 class="mb-4">Valor total: {{ convertMoney(receitaTotal) }}</h1>
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="data_vencimento" class="block text-sm font-medium text-gray-700">Data de pagamento</label>
                  <input v-model="transacao.data_pagamento" type="date" name="data_pagamento" id="data_pagamento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="transacao.errors.data_pagamento" v-text="transacao.errors.data_pagamento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="categoria_id" class="block text-sm font-medium text-gray-700">Conta</label>
      
                  <select v-model="transacao.conta_id" name="categoria_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                 <option v-for="(conta, index) in contas" :key="index" :value='index'> {{conta}} </option>
                  </select>

                  <div v-if="transacao.errors.conta_id" v-text="transacao.errors.conta_id" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="aluno_id" class="block text-sm font-medium text-gray-700">Forma de Pagamento</label>
                
                  <select v-model="transacao.forma_pagamento" name="aluno_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='Dinheiro'> Dinheiro </option>
                    <option value='Cartão de Crédito'> Cartão de Crédito </option>
                    <option value='Cartão de Débito'> Cartão de Crédito </option>
                    <option value='Boleto'> Boleto </option>
                    <option value='Pix'> Pix </option>
                    <option value='Transferência Bancária'> Transferência Bancária </option>
                    <option value='Débito Automático'> Débito Automático </option>
                     <option value='Outros'> Outros </option>
                  </select>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                  <input v-model="transacao.descricao" type="text" name="descricao" id="descricao" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="transacao.errors.descricao" v-text="transacao.errors.descricao" class="mt-1 text-xs text-red-500"></div>
                </div>
                
              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('receitas.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="transacao.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Baixar</button>
            </div>

            <progress v-if="transacao.progress" :value="transacao.progress.percentage" max="100">
              {{ receita.progress.percentage }}%
            </progress>
          </div>
        </form>
      </div>
    </div>
  </div>

</template>

<script setup>
import { ref } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";

let links = [
        { name: 'Listagem de Receitas', href: 'receitas.index', current: false },
        { name: 'Baixa de Múltiplas Receitas', current: true },
      ]

const open = ref(false)

const props = defineProps({
  contas: Object,
  receitas: Object,
  receitaTotal: Number
})

const transacao = useForm({
  valor: props.receitaTotal,
  tipo: 'Receita',
  receitas: props.receitas,
  favorecido: '',
  conta_id: '',
  forma_pagamento: '',
  data_pagamento: '',
  descricao: '',
  errors: Object,
})

function baixaMultipla()
{
  transacao.post(route('receitas.efetuarBaixa', props.transacao))
}

function convertMoney(value) {
    var inteiro = null, decimal = null, c = null, j = null
    var aux = new Array()
    value = ""+value
    c = value.indexOf(".",0)

    if(c > 0){
        inteiro = value.substring(0,c)
        decimal = value.substring(c+1,value.length)
    }else{
        inteiro = value
    }
    
    
    for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
        aux[c]=inteiro.substring(j-3,j)
    }
    
    
    inteiro = ""
    for(c = aux.length-1; c >= 0; c--){
        inteiro += aux[c]+'.'
    }
    
    
    inteiro = inteiro.substring(0,inteiro.length-1)
    
    decimal = parseInt(decimal)
    if(isNaN(decimal)){
        decimal = "00"
    }else{
        decimal = ""+decimal;
        if(decimal.length === 1){
            decimal = decimal+"0"
        }
    }
    
    
    value = "R$ "+inteiro+","+decimal
    
    
    return value
}
</script>