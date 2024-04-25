<template>
  <Head>
    <title>Cadastro de Fornecedores</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Cadastro de Fornecedores</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='submitFornecedor' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="fornecedor.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="fornecedor.errors.nome" v-text="fornecedor.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-12 sm:col-span-3">
                  <label for="auto_escola_id" class="block text-sm font-medium text-gray-700">Tipo</label>
                 
                  <select v-model="mascaraCpfOuCnpj" name="tipo_pessoa" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='###.###.###-##'> Pessoa Física </option>
                    <option value='##.###.###.####-##'> Pessoa Jurídica </option>
                  </select>

                  <div v-if="fornecedor.errors.tipo_pessoa" v-text="fornecedor.errors.tipo_pessoa" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="cpfCnpj" class="block text-sm font-medium text-gray-700">CPF / CNPJ</label>
                  <input v-model="fornecedor.cpfCnpj" v-mask="mascaraCpfOuCnpj" type="text" name="cpfCnpj" id="cpfCnpj" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  <div v-if="fornecedor.errors.cpfCnpj" v-text="fornecedor.errors.cpfCnpj" class="mt-1 text-xs text-red-500"></div>                
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input v-model="fornecedor.email" type="email" name="email" id="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  
                  <div v-if="fornecedor.errors.email" v-text="fornecedor.errors.email" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                  <input v-model="fornecedor.celular" v-mask="'(##)#####-####'" type="text" name="celular" id="celular" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
               
                  <div v-if="fornecedor.errors.celular" v-text="fornecedor.errors.celular" class="mt-1 text-xs text-red-500"></div>               
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="cep" class="block text-sm font-medium text-gray-700">Cep</label>
                  <input v-model="fornecedor.cep" v-mask="'#####-###'" type="text" name="cep" id="cep" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="fornecedor.errors.cep" v-text="fornecedor.errors.cep" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="logradouro" class="block text-sm font-medium text-gray-700">Logradouro</label>
                  <input v-model="fornecedor.logradouro" type="text" name="logradouro" id="logradouro" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="fornecedor.errors.logradouro" v-text="fornecedor.errors.logradouro" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
                  <input v-model="fornecedor.numero" type="text" name="numero" id="numero" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="fornecedor.errors.numero" v-text="fornecedor.errors.numero" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="numero" class="block text-sm font-medium text-gray-700">Complemento</label>
                  <input v-model="fornecedor.complemento" type="text" name="complemento" id="complemento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="fornecedor.errors.complemento" v-text="fornecedor.errors.complemento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                  <input v-model="fornecedor.cidade" type="text" name="cidade" id="cidade" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="fornecedor.errors.cidade" v-text="fornecedor.errors.cidade" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                  <input v-model="fornecedor.bairro" type="text" name="bairro" id="bairro" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="fornecedor.errors.bairro" v-text="fornecedor.errors.bairro" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                  <input v-model="fornecedor.estado" type="text" name="estado" id="estado" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="fornecedor.errors.estado" v-text="fornecedor.errors.estado" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6">
                  <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                  <input v-model="fornecedor.observacoes" type="text" name="observacoes" id="observacoes" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="fornecedor.errors.observacoes" v-text="fornecedor.errors.observacoes" class="mt-1 text-xs text-red-500"></div>
                </div>
  
              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('fornecedores.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="fornecedor.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="fornecedor.progress" :value="fornecedor.progress.percentage" max="100">
              {{ fornecedor.progress.percentage }}%
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
      mascaraCpfOuCnpj: "###.###.###-##",
      fornecedor: useForm({
        nome: '',
        cpfCnpj:'',
        telefone:'',
        celular: '',
        email: '',
        cep: '',
        logradouro:'',
        numero: '',
        complemento: '',
        bairro: '',
        cidade: '',
        estado: '',
        observacoes: '',
        errors: Object,
      }),
      links:[
        { name: 'Listagem de Fornecedores', href: 'fornecedores.index', current: false },
        { name: 'Cadastro de Fornecedores', current: true },
      ]
    }
  },
  methods:{
    submitFornecedor(){
      this.fornecedor.cpfCnpj = this.fornecedor.cpfCnpj.replace(/[^\d]+/g, '');
      this.fornecedor.post(this.route('fornecedores.store', this.fornecedor))
    }
  },
  directives: {mask}
}
</script>
