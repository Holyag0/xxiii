<template>
  <Head>
    <title>Edição de Auto Escola</title>
  </Head>
  
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Edição de Auto Escola</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='updateCfc' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">

                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="form.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.nome" v-text="form.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="cep" class="block text-sm font-medium text-gray-700">Cep</label>
                  <input v-model="form.cep" v-mask="'#####-###'" type="text" name="cep" id="cep" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.cep" v-text="form.errors.cep" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="logradouro" class="block text-sm font-medium text-gray-700">Logradouro</label>
                  <input v-model="form.logradouro" type="text" name="logradouro" id="logradouro" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.logradouro" v-text="form.errors.logradouro" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
                  <input v-model="form.numero" type="text" name="numero" id="numero" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.numero" v-text="form.errors.numero" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="numero" class="block text-sm font-medium text-gray-700">Complemento</label>
                  <input v-model="form.complemento" type="text" name="complemento" id="complemento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.complemento" v-text="form.errors.complemento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                  <input v-model="form.cidade" type="text" name="cidade" id="cidade" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.cidade" v-text="form.errors.cidade" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                  <input v-model="form.bairro" type="text" name="bairro" id="bairro" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.bairro" v-text="form.errors.bairro" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                  <input v-model="form.estado" type="text" name="estado" id="estado" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.estado" v-text="form.errors.estado" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6">
                  <label for="obs" class="block text-sm font-medium text-gray-700">Observações</label>
                  <input v-model="form.obs" type="text" name="obs" id="obs" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.obs" v-text="form.errors.obs" class="mt-1 text-xs text-red-500"></div>
                </div> 

                <div class="col-span-6 sm:col-span-3">
                  <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                  <input v-model="form.celular" v-mask="'(##)#####-####'" type="text" name="celular" id="celular" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
               
                  <div v-if="form.errors.celular" v-text="form.errors.celular" class="mt-1 text-xs text-red-500"></div>               
                </div>

                 <div class="col-span-6 sm:col-span-3">
                  <label for="fone" class="block text-sm font-medium text-gray-700">Telefone</label>
                  <input v-model="form.fone" v-mask="'#####-####'" type="text" name="fone" id="fone" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
               
                  <div v-if="form.errors.fone" v-text="form.errors.fone" class="mt-1 text-xs text-red-500"></div>               
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input v-model="form.email" type="email" name="email" id="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  
                  <div v-if="form.errors.email" v-text="form.errors.email" class="mt-1 text-xs text-red-500"></div>
                </div>
  
              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('cfc.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="form.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
              {{ form.progress.percentage }}%
            </progress>
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
        { name: 'Listagem de Auto Escolas', href: 'cfc.index', current: false },
        { name: 'Edição de Auto Escolas', current: true },
      ]

const props = defineProps({
  cfc: Object,
})

defineComponent({
  BreadCrumbs
})

const mascaraCpfOuCnpj = "###.###.####/##"

const form = useForm({
  nome: props.cfc.nome,
  celular: props.cfc.celular,
  email: props.cfc.email,
  cep: props.cfc.cep,
  logradouro:props.cfc.logradouro,
  numero: props.cfc.numero,
  complemento: props.cfc.complemento,
  bairro: props.cfc.bairro,
  cidade: props.cfc.cidade,
  estado: props.cfc.estado,
  fone: props.cfc.fone,
  errors: Object,
})

function updateCfc(){
  form.put(route('cfc.update', props.cfc.id))
}

</script>

<script>
import {mask} from 'vue-the-mask'

export default {
  directives:{
      mask
    }
};
</script>

