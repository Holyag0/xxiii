<template>
  <Head>
    <title>Edição de Instrutor</title>
  </Head>
  
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Edição de Instrutor</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />

    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='updateInstrutor' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                   
                <div class="col-span-3 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="form.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.nome" v-text="form.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input v-model="form.email" type="email" name="email" id="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  
                  <div v-if="form.errors.email" v-text="form.errors.email" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-3">
                  <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                  <input v-model="form.cpf" v-mask="mascaraCpfOuCnpj" type="text" name="cpf" id="cpf" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  <div v-if="form.errors.cpf" v-text="form.errors.cpf" class="mt-1 text-xs text-red-500"></div>                
                </div>

                <div class="col-span-3 sm:col-span-3">
                  <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                  <input v-model="form.data_nascimento" type="date" name="data_nascimento" id="data_nascimento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.data_nascimento" v-text="form.errors.data_nascimento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-12 sm:col-span-3">
                  <label for="categoria" class="block text-sm font-medium text-gray-700">Categoria</label>
                 
                  <select v-model="form.categoria" name="tipo_pessoa" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='A'> A </option>
                    <option value='B'> B </option>
                    <option value='C'> D </option>
                    <option value='D'> C </option>
                    <option value='E'> E </option>
                    <option value='AB'> AB </option>
                    <option value='AD'> AD </option>
                    <option value='AD'> AE </option>
                  </select>

                  <div v-if="form.errors.categoria" v-text="form.errors.categoria" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="venc_cnh" class="block text-sm font-medium text-gray-700">Vencimento da CNH</label>
                  <input v-model="form.venc_cnh" type="date" name="venc_cnh" id="venc_cnh" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.venc_cnh" v-text="form.errors.venc_cnh" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="venc_ci" class="block text-sm font-medium text-gray-700">Vencimento da Carteira de form</label>
                  <input v-model="form.venc_ci" type="date" name="venc_ci" id="venc_ci" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.venc_ci" v-text="form.errors.venc_ci" class="mt-1 text-xs text-red-500"></div>
                </div>


                <div class="col-span-3 sm:col-span-3">
                  <label for="n_registro_cnh" class="block text-sm font-medium text-gray-700">Número de Registro da CNH</label>
                  <input v-model="form.n_registro_cnh" type="text" name="n_registro_cnh" id="n_registro_cnh" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.n_registro_cnh" v-text="form.errors.n_registro_cnh" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="inicio_ferias" class="block text-sm font-medium text-gray-700">Data de Inicio Férias</label>
                  <input v-model="form.inicio_ferias" type="date" name="inicio_ferias" id="inicio_ferias" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.inicio_ferias" v-text="form.errors.inicio_ferias" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="fim_ferias" class="block text-sm font-medium text-gray-700">Data de Fim Férias</label>
                  <input v-model="form.fim_ferias" type="date" name="fim_ferias" id="fim_ferias" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.fim_ferias" v-text="form.errors.fim_ferias" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="cep" class="block text-sm font-medium text-gray-700">Cep</label>
                  <input @keyup="searchCep" v-model="form.cep" v-mask="'#####-###'" type="text" name="cep" id="cep" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.cep" v-text="form.errors.cep" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="logradouro" class="block text-sm font-medium text-gray-700">Logradouro</label>
                  <input v-model="form.logradouro" type="text" name="logradouro" id="rua" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
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
                  <input v-model="form.estado" type="text" name="estado" id="uf" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.estado" v-text="form.errors.estado" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="cel" class="block text-sm font-medium text-gray-700">Celular</label>
                  <input v-model="form.cel" v-mask="'(##)#####-####'" type="text" name="cel" id="cel" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
               
                  <div v-if="form.errors.cel" v-text="form.errors.cel" class="mt-1 text-xs text-red-500"></div>               
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="valor_hora_extra" class="block text-sm font-medium text-gray-700">Valor Hora Extra</label>
                  <input v-model="form.valor_hora_extra" v-money="money" type="text" name="valor_hora_extra" id="valor_hora_extra" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.valor_hora_extra" v-text="form.errors.valor_hora_extra" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="valor_aula_extra" class="block text-sm font-medium text-gray-700">Valor Aula Extra</label>
                  <input v-model="form.valor_aula_extra" v-money="money" type="text" name="valor_aula_extra" id="valor_aula_extra" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.valor_aula_extra" v-text="form.errors.valor_aula_extra" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="valor_produtividade" class="block text-sm font-medium text-gray-700">Valor Produtividade</label>
                  <input v-model="form.valor_produtividade" v-money="money" type="text" name="valor_produtividade" id="valor_produtividade" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.valor_produtividade" v-text="form.errors.valor_produtividade" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="saida_almoco" class="block text-sm font-medium text-gray-700">Saída Almoço</label>
                  <input v-model="form.saida_almoco" type="text" name="saida_almoco" id="uf" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.saida_almoco" v-text="form.errors.saida_almoco" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="retorno_almoco" class="block text-sm font-medium text-gray-700">Retorno Almoço</label>
                  <input v-model="form.retorno_almoco" type="text" name="retorno_almoco" id="uf" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.retorno_almoco" v-text="form.errors.retorno_almoco" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="portal" class="block text-sm font-medium text-gray-700">Portal</label>
                
                  <select v-model="form.portal" name="portal" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='1'> Ativado </option>
                    <option value='0'> Desativado </option>
                  </select>

                  <div v-if="form.errors.portal" v-text="form.errors.portal" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                
                  <select v-model="form.status" name="status" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='1'> Ativado </option>
                    <option value='0'> Desativado </option>
                  </select>

                  <div v-if="form.errors.status" v-text="form.errors.status" class="mt-1 text-xs text-red-500"></div>
                </div>
                
                
              </div>
              <div class="px-4 py-3 text-right sm:px-6">
                <Link :href="route('instrutor.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
                <button type="submit" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
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
        { name: 'Listagem de Profissionais', href: 'instrutor.index', current: false },
        { name: 'Edição de Profissionais', current: true },
      ]

const props = defineProps({
  instrutor: Object,
})

defineComponent({
  BreadCrumbs
})

const form = useForm({
  nome: props.instrutor.nome,
  cargo: props.instrutor.cargo,
  email: props.instrutor.email,
  cpf: props.instrutor.cpf,
  data_nascimento: props.instrutor.data_nascimento,
  categoria: props.instrutor.categoria,
  venc_cnh: props.instrutor.venc_cnh,
  venc_ci: props.instrutor.venc_ci,
  n_registro_cnh: props.instrutor.n_registro_cnh,
  inicio_ferias: props.instrutor.inicio_ferias,
  fim_ferias: props.instrutor.fim_ferias,
  portal: props.instrutor.portal,
  cep: props.instrutor.cep,
  logradouro: props.instrutor.logradouro,
  numero: props.instrutor.numero,
  complemento: props.instrutor.complemento,
  cidade: props.instrutor.cidade,
  estado: props.instrutor.estado,
  bairro: props.instrutor.bairro,
  cel: props.instrutor.cel,
  valor_hora_extra: props.instrutor.valor_hora_extra,
  valor_aula_extra: props.instrutor.valor_aula_extra,
  valor_produtividade: props.instrutor.valor_produtividade,
  saida_almoco: props.instrutor.saida_almoco,
  retorno_almoco: props.instrutor.retorno_almoco,
  status: props.instrutor.status,
  errors: Object,
})

const mascaraCpfOuCnpj = "###.###.###-##"

function updateInstrutor(){
  form.put(route('instrutor.update', props.instrutor.id))
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