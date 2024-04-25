<template>
    <TransitionRoot as="template" :show="isOpen">
      <Dialog as="div" class="relative z-10" @close="isOpen = false">
        <div class="fixed inset-0" />
  
        <div class="fixed inset-0 overflow-hidden">
          <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
              <TransitionChild @after-leave="closeCreate" as="template" enter="transform transition  ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                <DialogPanel class="pointer-events-auto w-screen max-w-2xl">
                  <form  @submit.prevent='submitProcesso' method="POST" class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                    <div class="flex-1">
                      <!-- Header -->
                      <div class="bg-gray-50 px-4 py-6 sm:px-6">
                        <div class="flex items-start justify-between space-x-3">
                          <div class="space-y-1">
                            <DialogTitle class="text-base font-semibold leading-6 text-gray-900">Iniciar Processo do Aluno</DialogTitle>
                            <p class="text-sm text-gray-500">Inicie um processo para fazer a venda de pacotes e serviços para o aluno.</p>
                          </div>
                          <div class="flex h-7 items-center">
                            <button type="button" class="relative text-gray-400 hover:text-gray-500"  @click="isOpen = false">
                              <span class="absolute -inset-2.5" />
                              <span class="sr-only">Close panel</span>
                                X
                            </button>
                          </div>
                        </div>
                      </div>
  
                      <!-- Divider container -->
                      <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">
                        <!-- Project name -->
                        <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                          <div>
                            <label for="project-name" class="block text-sm font-medium leading-6 text-gray-900 sm:mt-1.5">Categorias</label>
                          </div>
                          <div>
                                <div class="flex items-center justify-between">
                                  <!-- <h2 class="text-sm font-medium leading-6 text-gray-900">RAM</h2> -->
                                  <!-- <a href="#" class="text-sm font-medium leading-6 text-indigo-600 hover:text-indigo-500">See performance specs</a> -->
                                </div>

                                <RadioGroup v-model="mem" class="w-full block">
                                  <RadioGroupLabel class="sr-only">Choose a memory option</RadioGroupLabel>
                                  <div class="grid grid-cols-3 gap-3 sm:grid-cols-6">
                                    <RadioGroupOption v-for="option in memoryOptions" :key="option.name" :value="option" :disabled="!option.inStock" v-slot="{ active, checked }">
                                      <div :class="[option.inStock ? 'cursor-pointer focus:outline-none' : 'cursor-not-allowed opacity-25', active ? 'ring-2 ring-indigo-600 ring-offset-2' : '', checked ? 'bg-indigo-600 text-white hover:bg-indigo-500' : 'ring-1 ring-inset ring-gray-300 bg-white text-gray-900 hover:bg-gray-50', 'flex items-center justify-center rounded-md py-3 px-3 text-sm font-semibold uppercase sm:flex-1']">
                                        <RadioGroupLabel as="span">{{ option.name }}</RadioGroupLabel>
                                      </div>
                                    </RadioGroupOption>
                                  </div>
                                </RadioGroup>
                              </div>
                            </div>
  
                        <!-- Project description -->
                        <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                          <div>
                            <label for="project-description" class="block text-sm font-medium leading-6 text-gray-900 sm:mt-1.5">Selecione o Serviço</label>
                          </div>
                              <fieldset class="border-b border-t border-gray-200">
                                <legend class="sr-only">Notifications</legend>
                                <div class="divide-y divide-gray-200">
                                  <div  v-for="(value, key) in optionServicos" :key="key" class="relative flex items-start pb-4 pt-3.5">
                                    <div class="min-w-0 flex-1 text-sm leading-6">
                                      <label :for="key" class="font-medium text-gray-900">{{key}}</label>
                                      <!-- <p id="comments-description" class="text-gray-500">Get notified when someones posts a comment on a posting.</p> -->
                                    </div>
                                    <div class="ml-3 flex h-6 items-center">
                                      <input :id="key" aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" 
                                        v-model="optionServicos[key]" :disabled="servicoDisable(key)" :class="{ 'cursor-not-allowed': servicoDisable(key) }" />
                                    </div>
                                  </div>
                                </div>
                              </fieldset>
                        </div>
                        <!-- Team members -->
                        <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                          <div>
                            <h3 class="text-sm font-medium leading-6 text-gray-900">validade do processo:</h3>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="flex space-x-2">
                                <input v-model="processo.validade_processo" type="date" name="password" id="password" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                <div v-if="processo.errors.password" v-text="processo.errors.password" class="mt-1 text-xs text-red-500"></div> 
                              <button type="button" class="relative inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full border-2 border-dashed border-gray-200 bg-white text-gray-400 hover:border-gray-300 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="absolute -inset-2" />
                                <span class="sr-only">Add team member</span>
                                <PlusIcon class="h-5 w-5" aria-hidden="true" />
                              </button>
                            </div>
                          </div>
                        </div>
  
                        <!-- Privacy -->
                        <fieldset class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                          <legend class="sr-only">Role</legend>
                          <div class="text-sm font-medium leading-6 text-gray-900" aria-hidden="true">Status do processo:</div>
                          <div class="space-y-5 sm:col-span-2">
                            <div class="space-y-5 sm:mt-0">
                              <div v-for="(value, option) in processOptions" :key="option" class="relative flex items-start pb-4">
                                <div class="absolute flex h-6 items-center">
                                  <div class="text-sm leading-6">
                                    <label class="font-medium text-gray-900 px-2">{{option}}:</label>
                                  </div>
                                  <label class="font-medium text-gray-900 px-4">Não</label>
                                  <Switch leave="opacity-0 duration-100 ease-out" v-model="processOptions[option]" @click="open = true" :class="[processOptions[option]? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out ']">
                                        <span class="sr-only">Use setting</span>
                                          <span :class="[processOptions[option] ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']">
                                                  <span :class="[processOptions[option] ? 'opacity-0 duration-100 ease-out' : 'opacity-100 duration-200 ease-in', 'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity']" aria-hidden="true">
                                                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                                      <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                  </span>
                                                  <span :class="[processOptions[option] ? 'opacity-100 duration-200 ease-in' : 'opacity-0 duration-100 ease-out', 'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity']" aria-hidden="true">
                                                    <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
                                              <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                            </svg>
                                        </span>
                                      </span>
                                  </Switch>
                                  <label class="font-medium text-gray-900 pl-4">Sim</label>
                                </div>
                              </div>
                          
                            </div>
                            <hr class="border-gray-200" />
                            <div class="flex flex-col items-start space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                              <div>
                                <a href="#" class="group flex items-center space-x-2.5 text-sm font-medium text-black">
                                  <!-- <LinkIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-900" aria-hidden="true" /> -->
                                  <span>Taxa Inclusas</span>
                                </a>
                              </div>
                              <div>
                                <label class="font-medium text-gray-900 px-4">Não</label>
                                  <Switch leave="opacity-0 duration-100 ease-out" v-model="enabled" @click="open = true" :class="[enabled ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out ']">
                                        <span class="sr-only">Use setting</span>
                                          <span :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']">
                                                  <span :class="[enabled ? 'opacity-0 duration-100 ease-out' : 'opacity-100 duration-200 ease-in', 'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity']" aria-hidden="true">
                                                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                                      <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                  </span>
                                                  <span :class="[enabled ? 'opacity-100 duration-200 ease-in' : 'opacity-0 duration-100 ease-out', 'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity']" aria-hidden="true">
                                                    <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
                                              <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                            </svg>
                                        </span>
                                      </span>
                                  </Switch>
                                  <label class="font-medium text-gray-900 pl-4">Sim</label>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                      </div>
                    </div>
                    <!-- Action buttons -->
                    <div class="flex-shrink-0 border-t border-gray-200 px-4 py-5 sm:px-6">
                      <div class="flex justify-end space-x-3">
                        <button type="button" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" @click="isOpen = false">Cancel</button>
                        <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
                      </div>
                    </div>
                  </form>
                </DialogPanel>
              </TransitionChild>
            </div>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>
   <script>
   export default {
    data() {
  return {
   
  }
},
   };
   </script>

  <script setup>
  import { ref,defineEmits,watchEffect } from 'vue'
  import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot,RadioGroup, RadioGroupLabel, RadioGroupOption,Switch   } from '@headlessui/vue'
  import { XMarkIcon, PlusIcon} from '@heroicons/vue/solid'
  import { useForm } from "@inertiajs/inertia-vue3";

const memoryOptions = [
  { name: 'A', inStock: true },
  { name: 'B', inStock: true },
  { name: 'AB', inStock: true },
  { name: 'C', inStock: true },
  { name: 'D', inStock: true },
  { name: 'E', inStock: true },
  { name: 'SC', inStock: true },
]
let optionServicos = ref({'Primeira Habilitação':false, 'Inclusão':false, 'Reabilitação':false, 'Aluno Habilitado':false, 'Mudança':false,'Renovação':false})
let processOptions = ref({'Processo Prescrito': false,'Processo em Andamento': false,'Processo Concluído': false});

const open = ref(false)
const enabled = ref(false)
const mem = ref(memoryOptions[2])
const emit = defineEmits(['create-closed'])

const closeCreate = (el) => {
 emit('create-closed',true);
}
const props = defineProps({
isOpen: Boolean,
aluno:Object
});
let processo = useForm({
categoria:'',
servicos:'',
status:'',
taxas:'',
aluno_id:'',
errors: Object,
}); 

let Servicos = () => {
  let selected = [];
  for (let key in optionServicos.value) {
    if (optionServicos.value[key]) {
      selected.push(key);
    }
  }
  return selected.join(',');
};
const submitProcesso= () => {
  processo.servicos = Servicos();
  processo.aluno_id = props.aluno.id
  processo.categoria = mem
  processo.status = processOptions
  processo.taxas = enabled
processo.post(route('processo.store',processo));
props.isOpen = false
};


let servicoDisable = (key) => {
  if (optionServicos.value['Primeira Habilitação'] && key !== 'Primeira Habilitação') return true;
  if (optionServicos.value['Inclusão'] && key !== 'Inclusão' && key !== 'Renovação') return true;
  if (optionServicos.value['Reabilitação'] && key !== 'Reabilitação') return true;
  if (optionServicos.value['Aluno Habilitado'] && key !== 'Aluno Habilitado') return true;
  if (optionServicos.value['Mudança'] && key !== 'Mudança' && key !== 'Renovação') return true;
  return false;
};
watchEffect(() => {
  for (let key in optionServicos.value) {
    if (servicoDisable(key)) {
      optionServicos.value[key] = false;
    }
  }
});

  </script>