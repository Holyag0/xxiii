<template>
  <Head>
    <title>Cadastro de Clientes</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Cadastro de Clientes</h1>
    </div>
    
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='submitCliente' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">

                <!-- <div class="col-span-12 sm:col-span-3">
                  <label for="auto_escola_id" class="block text-sm font-medium text-gray-700">Auto Escola</label>
                 
                  <select v-model="cliente.cfc_id" name="cfc_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(autoEscola, index) in autoEscolas" :key="index" :value='index'> {{autoEscola}} </option>
                  </select>

                  <div v-if="cliente.errors.cfc_id" v-text="cliente.errors.cfc_id" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-12 sm:col-span-3">
                  <label for="auto_escola_id" class="block text-sm font-medium text-gray-700">Clinica</label>
                 
                  <select v-model="cliente.clinica_id" name="auto_escola_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(clinica, index) in clinicas" :key="index" :value='index'> {{clinica}} </option>
                  </select>

                  <div v-if="cliente.errors.clinica_id" v-text="cliente.errors.clinica_id" class="mt-1 text-xs text-red-500"></div>
                </div> -->
                

                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="cliente.nome" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.nome" v-text="cliente.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>
                <div class="col-span-4 sm:col-span-3 flex gap-2 mt-2">
                  <Listbox as="div" v-model="selected">
                    <!-- <ListboxLabel class="sr-only">Change published status</ListboxLabel> -->
                    <div class="relative mt-4">
                      <div class="inline-flex divide-x divide-indigo-700 rounded-md shadow-sm">
                        <div class="inline-flex items-center gap-x-1.5 rounded-l-md bg-indigo-600 px-3 py-2 text-white shadow-sm">
                          <CheckIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                          <p class="text-sm font-semibold">{{selected.title}}</p>
                        </div>
                        <ListboxButton class="inline-flex items-center rounded-l-none rounded-r-md bg-indigo-600 p-2 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-50">
                          <span class="sr-only">Change published status</span>
                          <ChevronDownIcon class="h-5 w-5 text-white" aria-hidden="true" />
                        </ListboxButton>
                      </div>

                      <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                        <ListboxOptions class="absolute right-0 z-10 mt-2 w-72 origin-top-right divide-y divide-gray-200 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                          <ListboxOption as="template" v-for="option in options" :key="option.title" :value="option" v-slot="{ active, selected }">
                            <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'cursor-default select-none p-4 text-sm']">
                              <div class="flex flex-col">
                                <div class="flex justify-between">
                                  <p :class="selected ? 'font-semibold' : 'font-normal'">{{option.title }}</p>
                                  <span v-if="selected" :class="active ? 'text-white' : 'text-green-600'">
                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                  </span>
                                </div>
                                <!-- <p :class="[active ? 'text-indigo-200' : 'text-gray-500', 'mt-2']">{{ option.description }}</p> -->
                              </div>
                            </li>
                          </ListboxOption>
                        </ListboxOptions>
                      </transition>
                    </div>
                  </Listbox>

                  <Listbox as="div" v-model="select2">
                    <!-- <ListboxLabel class="sr-only">Change published status</ListboxLabel> -->
                    <div class="relative mt-4">
                      <div class="inline-flex divide-x divide-indigo-700 rounded-md shadow-sm">
                        <div class="inline-flex items-center gap-x-1.5 rounded-l-md bg-indigo-600 px-3 py-2 text-white shadow-sm">
                          <CheckIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                          <p class="text-sm font-semibold">{{select2.title}}</p>
                        </div>
                        <ListboxButton class="inline-flex items-center rounded-l-none rounded-r-md bg-indigo-600 p-2 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-50">
                          <span class="sr-only">Change published status</span>
                          <ChevronDownIcon class="h-5 w-5 text-white" aria-hidden="true" />
                        </ListboxButton>
                      </div>

                      <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                         <ListboxOptions class="absolute right-0 z-10 mt-2 w-72 origin-top-right divide-y divide-gray-200 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                          <ListboxOption as="template" v-for="option in options2" :key="option.title" :value="option" v-slot="{ active, selected }">
                            <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'cursor-default select-none p-4 text-sm']">
                              <div class="flex flex-col">
                                <div class="flex justify-between">
                                  <p :class="selected ? 'font-semibold' : 'font-normal'">{{ option.title }}</p>
                                  <span v-if="selected" :class="active ? 'text-white' : 'text-green-600'">
                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                  </span>
                                </div>
                                <!-- <p :class="[active ? 'text-indigo-200' : 'text-gray-500', 'mt-2']">{{ option.description }}</p> -->
                              </div>
                            </li>
                          </ListboxOption>
                        </ListboxOptions>
                      </transition>
                    </div>
                  </Listbox>
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="RG" class="block text-sm font-medium text-gray-700">RG</label>
                  <input v-model="cliente.rg" v-mask="'##########-#'" type="text" name="RG" id="RG" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  <div v-if="cliente.errors.cpf" v-text="cliente.errors.rg" class="mt-1 text-xs text-red-500"></div>                
                </div>


                <div class="col-span-6 sm:col-span-3">
                  <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                  <input v-model="cliente.cpf" v-mask="'###.###.###-##'" type="text" name="cpf" id="cpf" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  <div v-if="cliente.errors.cpf" v-text="cliente.errors.cpf" class="mt-1 text-xs text-red-500"></div>                
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="date_nasc" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                  <input v-model="cliente.date_nasc" type="date" name="date_nasc" id="date_nasc" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  
                  <div v-if="cliente.errors.email" v-text="cliente.errors.data" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome Pai</label>
                  <input v-model="cliente.pai" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.nome" v-text="cliente.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>
                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome Mãe</label>
                  <input v-model="cliente.mae" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.nome" v-text="cliente.errors.nome" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input v-model="cliente.email" type="email" name="email" id="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  
                  <div v-if="cliente.errors.email" v-text="cliente.errors.email" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                  <input v-model="cliente.celular" v-mask="'(##)#####-####'" type="text" name="celular" id="celular" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
               
                  <div v-if="cliente.errors.celular" v-text="cliente.errors.celular" class="mt-1 text-xs text-red-500"></div>               
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="cep" class="block text-sm font-medium text-gray-700">Cep</label>
                  <input @blur="pesquisarCep" v-model="cliente.cep" v-mask="'#####-###'" type="text" name="cep" id="cep" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.cep" v-text="cliente.errors.cep" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="logradouro" class="block text-sm font-medium text-gray-700">Logradouro</label>
                  <input v-model="cliente.logradouro" type="text" name="logradouro" id="rua" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.logradouro" v-text="cliente.errors.logradouro" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
                  <input v-model="cliente.numero" type="text" name="numero" id="numero" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.numero" v-text="cliente.errors.numero" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="numero" class="block text-sm font-medium text-gray-700">Complemento</label>
                  <input v-model="cliente.complemento" type="text" name="complemento" id="complemento" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.complemento" v-text="cliente.errors.complemento" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                  <input v-model="cliente.cidade" type="text" name="cidade" id="cidade" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.cidade" v-text="cliente.errors.cidade" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                  <input v-model="cliente.bairro" type="text" name="bairro" id="bairro" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.bairro" v-text="cliente.errors.bairro" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                  <input v-model="cliente.estado" type="text" name="estado" id="uf" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="cliente.errors.estado" v-text="cliente.errors.estado" class="mt-1 text-xs text-red-500"></div>
                </div>
                <div class="col-span-12 sm:col-span-3">
                  <label for="auto_escola_id" class="block text-sm font-medium text-gray-700">Estado Civil</label>
                 
                  <select v-model="cliente.estado_civil" name="auto_escola_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="option in options3" :key="option"> {{option}} </option>
                  </select>

                  <div v-if="cliente.errors.clinica_id" v-text="cliente.errors.estado_civil" class="mt-1 text-xs text-red-500"></div>
                </div> 
              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <button type="submit" :disabled="cliente.processing" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <button type="submit" :disabled="cliente.processing" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-white border border-transparent rounded-md shadow-sm "></button>
            </div>
            <div class="px-4 py-3 text-right bg-white sm:px-6">
              <button type="submit" :disabled="cliente.processing" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-white border border-transparent rounded-md shadow-sm"></button>
            </div>

            <progress v-if="cliente.progress" :value="cliente.progress.percentage" max="100">
              {{ cliente.progress.percentage }}%
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
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, ChevronDownIcon } from '@heroicons/vue/solid'
export default {
  setup() {
    const options = [
  { title: 'Amigo',  current: true },{ title: 'Anuncio Internet',  current: false },
  { title: 'Carro de Som',  current: false },{ title: 'E-mail',  current: false },{ title: 'Ex-Aluno ',  current: false },
  { title: ' Fachada Autoescola',  current: false },{ title: 'Facebook ',  current: false },
  { title: 'Folheto Impresso',  current: false },{ title: 'Pesquisa sem compromisso',  current: false },
  { title: 'Site',  current: false },{ title: 'Outros', current: false },{ title: 'sem indicação', current: false },

]
const options2 = [
  { title: 'sem nivel', current: true },{ title: 'fundamental',  current: false },{ title: 'fundamental incompleto',  current: false },
  { title: 'médio',  current: false },{ title: 'médio incompleto',  current: false },{ title: 'superior',  current: false },
  { title: 'superior incompleto',  current: false }
]
const options3 = ['Solteiro','Casado','Separado','Divorciado', 'Viúvo',]

const selected = ref(options[11])
const select2 = ref(options2[0])
const cliente = useForm({
      clinica_id: '',
      auto_escola_id: '',
      nome: '',
      cpf: '',
      email: '',
      celular: '',
      cep: '',
      logradouro:'',
      numero: '',
      complemento: '',
      bairro: '',
      cidade: '',
      estado: '',
      viacep: '',
    });

    const limparFormulario = () => {
      cliente.logradouro = '';
      cliente.bairro = '';
      cliente.cidade = '';
      cliente.estado = '';
      
    };

    const pesquisarCep = () => {
      const cep = cliente.cep.replace(/\D/g, '');
      if (cep !== "") {
        const validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
          limparFormulario();
          window.meuCallback = (conteudo) => {
              if (!("erro" in conteudo)) {
                cliente.logradouro = conteudo.logradouro;
                cliente.bairro = conteudo.bairro;
                cliente.cidade = conteudo.localidade;
                cliente.estado = conteudo.uf;
              
              } else {
                limparFormulario();
                alert("CEP não encontrado.");
                
              }
            };
          const script = document.createElement('script');
          script.src = `https://viacep.com.br/ws/${cep}/json/?callback=meuCallback`;
          document.body.appendChild(script);
         
          
        } else {
          limparFormulario();
          alert("Formato de CEP inválido.");
        }
      } else {
        limparFormulario();
      }
    };
    return {
      options,selected,
      options2,select2,
      options3,
      cliente,
      pesquisarCep
    }
  },
  components:{
    CheckIcon, ChevronDownIcon,
    Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions 
  },
  props: {
    autoEscolas: Object,
    clinicas: Object
  },
	methods : {
     submitCliente(){
      this.cliente.indicado = this.selected.title;
      this.cliente.escolaridade = this.select2.title;
      this.cliente.post(this.route('aluno.store', this.cliente))
    }
	}, 
  directives: {mask}
}
</script>