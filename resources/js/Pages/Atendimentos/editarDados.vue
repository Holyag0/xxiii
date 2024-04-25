<template>
  <div>
    <div class="overflow-hidden bg-white shadow sm:rounded-md"> 
      <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='updateAluno' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <!-- <div class="col-span-4 sm:col-span-3">
                  <label for="auto_escola_id" class="block text-sm font-medium text-gray-700">Auto Escola</label>
                 
                  <select v-model="form.cfc_id" name="auto_escola_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(autoEscola, index) in autoEscolas" :key="index" :value='index'> {{autoEscola}} </option>
                  </select>

                  <div v-if="form.errors.cfc_id" v-text="form.errors.cfc_id" class="mt-1 text-xs text-red-500"></div>
                </div> -->

                <!-- <div class="col-span-4 sm:col-span-3">
                  <label for="clinica_id" class="block text-sm font-medium text-gray-700">Clinicas</label>
                 
                  <select v-model="form.clinica_id" name="clinica_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(clinica, index) in clinicas" :key="index" :value='index'> {{clinica}} </option>
                  </select>

                  <div v-if="form.errors.clinica_id" v-text="form.errors.clinica_id" class="mt-1 text-xs text-red-500"></div>
                </div> -->


                 <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="form.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.nome" v-text="form.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>


                <div class="col-span-6 sm:col-span-3">
                  <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                  <input v-model="form.cpf" v-mask="'###.###.###-##'" type="text" name="cpf" id="cpf" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  <div v-if="form.errors.cpf" v-text="form.errors.cpf" class="mt-1 text-xs text-red-500"></div>                
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input v-model="form.email" type="email" name="email" id="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  
                  <div v-if="form.errors.email" v-text="form.errors.email" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                  <input v-model="form.celular" v-mask="'(##)#####-####'" type="text" name="celular" id="celular" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
               
                  <div v-if="form.errors.celular" v-text="form.errors.celular" class="mt-1 text-xs text-red-500"></div>               
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
                
              </div>
              <div class="px-4 py-3 text-right sm:px-6">
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
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3"
import {mask} from 'vue-the-mask'

export default {
  setup() {
    return {
      form: ''
    }
  },
  created(){
    this.form = useForm({
      cfc_id: this.aluno.cfc_id,
      // clinica_id: this.aluno.clinica_id,
      nome: this.aluno.nome,
      cpf: this.aluno.cpf,
      email: this.aluno.email,
      celular: this.aluno.celular,
      cep: this.aluno.cep,
      logradouro: this.aluno.logradouro,
      numero: this.aluno.numero,
      complemento: this.aluno.complemento,
      bairro: this.aluno.bairro,
      cidade: this.aluno.cidade,
      estado: this.aluno.estado,
      errors: Object,
      })
  },
  props: {
    aluno: Object,
    autoEscolas: Object,
    clinicas: Object,
    auth: Object
  },
  methods:{
    updateAluno(){
      this.form.put(route('aluno.update', this.aluno.id))
    }
  },
  directives: {mask}
}
</script>