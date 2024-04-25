<!-- This example requires Tailwind CSS v2.0+ -->
<template>
 <a href="#" @click="open = true" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> 
    Resultado dos Exames<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
  <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
  <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
</svg>
  </a>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="open = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:max-w-lg sm:w-full sm:p-6">
              <div>
                <div v-if="exame.status ==='Inapto Temporariamente'  " class="flex items-center justify-center w-12 h-12 mx-auto bg-orange-100 rounded-full">
                  <MinusSmIcon class="w-6 h-6 text-orange-600" aria-hidden="true" />
                </div>
                <div v-if="exame.status === 'Aprovado'" class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full">
                  <CheckIcon class="w-6 h-6 text-green-600" aria-hidden="true" />
                </div>
                <div v-if="exame.status === 'Reprovado'" class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                  <XIcon class="w-6 h-6 text-red-600" aria-hidden="true" />
                </div>
                <!-- CheckIcon XIcon-->
                <div class="mt-3 text-center sm:mt-5">
                    <span>Aluno2:</span>
                  <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900"> {{aluno.nome}} </DialogTitle>
                <div class="mt-2 sm:flex sm:justify-between">
              <div  class="sm:flex">
                <p class="flex items-center text-sm text-gray-500">
                  <UsersIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                  {{exame.profissional_id}}
                </p>
                
              </div>
              <div class="flex items-center mt-2 text-sm text-gray-500 sm:mt-0">
                <CalendarIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                <p>
                  {{ exame.data_exame }}
                </p>
                
              </div>
            </div>
             <div class="mt-2 sm:flex sm:justify-between">
              <div  class="sm:flex">
                <p class="flex items-center text-sm text-gray-500">
                  <IdentificationIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                 {{exame.exame_teste.sexo}}
                </p>
                <p class="flex items-center mt-2 text-sm text-gray-500 sm:mt-0 sm:ml-6">
                  <ReceiptTaxIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                  {{exame.exame_teste.faixa_etaria}}
                </p>
              </div>
              <div class="flex items-center mt-2 text-sm text-gray-500 sm:mt-0">
                <AcademicCapIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                <p>
                  
                  {{ exame.exame_teste.escolaridade }}
                  <!-- <time :datetime="position.closeDate">{{ position.closeDateFull }}</time> -->
                </p>
                
              </div>
            </div>
    <ul role="list" class="divide-y divide-gray-200">
      <li >
                <a href="#" class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p class="text-sm font-medium text-indigo-600 truncate">
                       Concentrada
                      </p>
                      <div class="flex flex-shrink-0 ml-2">
                        <p v-if="exame.exame_teste.concentrada === 'Apto'" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                          {{exame.exame_teste.concentrada}}
                        </p>
                        <p v-else class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                              {{exame.exame_teste.concentrada}}
                            </p> 
                      </div>
                    </div>
          
                    </div>
                    <div class="px-4 py-4 sm:px-6">
                      <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-indigo-600 truncate">
                        Dividida
                        </p>
                        <div class="flex flex-shrink-0 ml-2">
                          <p v-if="exame.exame_teste.dividida === 'Apto'" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                           {{exame.exame_teste.dividida}}
                          </p>
                          <p v-else class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                              {{exame.exame_teste.dividida}}
                            </p> 
                        </div>
                      </div>
                      
                    </div>
                    <div class="px-4 py-4 sm:px-6">
                      <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-indigo-600 truncate">
                         Alternada
                        </p>
                        <div class="flex flex-shrink-0 ml-2">
                          <p v-if="exame.exame_teste.alternada === 'Apto'" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                           {{exame.exame_teste.alternada}}
                          </p>
                          <p v-else class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                              {{exame.exame_teste.alternada}}
                            </p> 
                        </div>
                      </div>
          
                      </div>
                      <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                          <p class="text-sm font-medium text-indigo-600 truncate">
                           Memória
                          </p>
                          <div class="flex flex-shrink-0 ml-2">
                            <p v-if="exame.exame_teste.memoria === 'Apto'" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                              {{exame.exame_teste.memoria}}
                            </p>
                            <p v-else class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                {{exame.exame_teste.memoria}}
                              </p> 
                          </div>
                        </div>
           
                        </div>
                        <div class="px-4 py-4 sm:px-6">
                          <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-indigo-600 truncate">
                             Personalidade
                            </p>
                            <div class="flex flex-shrink-0 ml-2">
                              <p v-if="exame.exame_teste.personalidade === 'Apto'" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                {{exame.exame_teste.personalidade}}
                              </p>
                              <p v-else class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                  {{exame.exame_teste.personalidade}}
                                </p>  
                            </div>
                          </div>
           
                        </div>
                        <div class="px-4 py-4 sm:px-6">
                          <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-indigo-600 truncate">
                              Raciocinio
                            </p>
                            <div class="flex flex-shrink-0 ml-2">
                              <p v-if="exame.exame_teste.personalidade === 'Apto'" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                {{exame.exame_teste.raciocinio}}
                              </p>
                               <p v-else class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                  {{exame.exame_teste.personalidade}}
                                </p> 
                            </div>
                          </div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                <button type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" @click="open = false">Deactivate</button>
                <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="open = false" ref="cancelButtonRef">Cancel</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue'

const open = ref(false)
const props = defineProps({
aluno: Object,
  exame: Object,
  profissionais: Object
})

</script>