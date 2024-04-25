<template>
  <Head>
    <title>Cadastro de Auto Escolas</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Cadastro de Auto Escolas</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='submitCfc' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="cfc.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cfc.errors.nome" v-text="cfc.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>


                <div class="col-span-6 sm:col-span-3">
                  <label for="cnpj" class="block text-sm font-medium text-gray-700">CNPJ</label>
                  <input v-model="cfc.cnpj" v-mask="mascaraCpfOuCnpj" type="text" name="cpfCnpj" id="cnpj" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  <div v-if="cfc.errors.cnpj" v-text="cfc.errors.cnpj" class="mt-1 text-xs text-red-500"></div>                
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="cep" class="block text-sm font-medium text-gray-700">Cep</label>
                  <input v-model="cfc.cep" v-mask="'#####-###'" type="text" name="cep" id="cep" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cfc.errors.cep" v-text="cfc.errors.cep" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="logradouro" class="block text-sm font-medium text-gray-700">Logradouro</label>
                  <input v-model="cfc.logradouro" type="text" name="logradouro" id="logradouro" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cfc.errors.logradouro" v-text="cfc.errors.logradouro" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
                  <input v-model="cfc.numero" type="text" name="numero" id="numero" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cfc.errors.numero" v-text="cfc.errors.numero" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="numero" class="block text-sm font-medium text-gray-700">Complemento</label>
                  <input v-model="cfc.complemento" type="text" name="complemento" id="complemento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cfc.errors.complemento" v-text="cfc.errors.complemento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                  <input v-model="cfc.cidade" type="text" name="cidade" id="cidade" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cfc.errors.cidade" v-text="cfc.errors.cidade" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                  <input v-model="cfc.bairro" type="text" name="bairro" id="bairro" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cfc.errors.bairro" v-text="cfc.errors.bairro" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                  <input v-model="cfc.estado" type="text" name="estado" id="estado" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cfc.errors.estado" v-text="cfc.errors.estado" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                  <input v-model="cfc.celular" v-mask="'(##)#####-####'" type="text" name="celular" id="celular" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
               
                  <div v-if="cfc.errors.celular" v-text="cfc.errors.celular" class="mt-1 text-xs text-red-500"></div>               
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="fone" class="block text-sm font-medium text-gray-700">Telefone</label>
                  <input v-model="cfc.fone" v-mask="'####-####'" type="text" name="fone" id="fone" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
               
                  <div v-if="cfc.errors.fone" v-text="cfc.errors.fone" class="mt-1 text-xs text-red-500"></div>               
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input v-model="cfc.email" type="email" name="email" id="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  
                  <div v-if="cfc.errors.email" v-text="cfc.errors.email" class="mt-1 text-xs text-red-500"></div>
                </div>

  
              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('cfc.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="cfc.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="cfc.progress" :value="cfc.progress.percentage" max="100">
              {{ cfc.progress.percentage }}%
            </progress>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import {mask} from 'vue-the-mask'
import BreadCrumbs from '../../../Shared/BreadCrumbs.vue'

export default {
  components: {
    BreadCrumbs,
  },
  setup() {
    return {
      mascaraCpfOuCnpj: "###.###.####/##",
      cfc: useForm({
        nome: '',
        cnpj:'',
        celular: '',
        email: '',
        cep: '',
        logradouro:'',
        numero: '',
        complemento: '',
        bairro: '',
        cidade: '',
        estado: '',
        fone: '',
        errors: Object,
      }),
      links:[
        { name: 'Listagem de Auto Escolas', href: 'cfc.index', current: false },
        { name: 'Cadastro de Auto Escolas', current: true },
      ]
    }
  },
  methods:{
    submitCfc(){
      this.cfc.cnpj = this.cfc.cnpj.replace(/[^\d]+/g, '');
      this.cfc.post(this.route('cfc.store', this.cfc))
    }
  },
  directives: {mask}
}
</script>
