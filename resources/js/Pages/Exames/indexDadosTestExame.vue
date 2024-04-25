
<!-- This example requires Tailwind CSS v2.0+ -->
<template>
<a href="#" @click="open = true"  class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
              <PresentationChartLineIcon class="w-5 h-5 text-gray-800" aria-hidden="true" />
              <span class="ml-3">Resultado dos Testes </span>
            </a>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="open = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full sm:p-6">
              <div>
                <div v-if="exame.status =='Inapto Temporariamente' || exame.status=='À Fazer' || exame.status=='Perícia Médica' " class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-orange-100">
                  <MinusSmIcon class="h-6 w-6 text-orange-600" aria-hidden="true" />
                </div>
                <div v-if="exame.status === 'Aprovado'" class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                  <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                </div>
                <div v-if="exame.status === 'Reprovado'" class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                  <XIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
                </div>
                <!-- CheckIcon XIcon-->
                <div class="mt-3 text-center sm:mt-5">
                    <span>Aluno:</span>
                  <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900"> {{exame.venda.aluno.nome}} </DialogTitle>
                <div class="mt-2 sm:flex sm:justify-between">
              <div  class="sm:flex">
                <p class="flex items-center text-sm text-gray-500">
                  <UsersIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                  <!-- {{ position.department }} -->{{exame.profissional.nome}}
                </p>
                
              </div>
              <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                <CalendarIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                <p>
                  
                  {{ exame.data_exame }}
                  <!-- <time :datetime="position.closeDate">{{ position.closeDateFull }}</time> -->
                </p>
                
              </div>
            </div>
             <div class="mt-2 sm:flex sm:justify-between">
              <div  class="sm:flex">
                <p class="flex items-center text-sm text-gray-500">
                  <IdentificationIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                  <!-- {{ position.department }} -->{{exame.exame_teste.sexo}}
                </p>
                <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                  <ReceiptTaxIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                  <!-- {{ position.location }} -->{{exame.exame_teste.faixa_etaria}}
                </p>
              </div>
              <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
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
                      <div class="ml-2 flex-shrink-0 flex">
                        <p v-if="exame.exame_teste.concentrada == 'Apto'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                          {{exame.exame_teste.concentrada}}
                        </p>
                        <p v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
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
                        <div class="ml-2 flex-shrink-0 flex">
                          <p v-if="exame.exame_teste.dividida == 'Apto'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                           {{exame.exame_teste.dividida}}
                          </p>
                          <p v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
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
                        <div class="ml-2 flex-shrink-0 flex">
                          <p v-if="exame.exame_teste.alternada =='Apto'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                           {{exame.exame_teste.alternada}}
                          </p>
                          <p v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
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
                          <div class="ml-2 flex-shrink-0 flex">
                            <p v-if="exame.exame_teste.memoria == 'Apto'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                              {{exame.exame_teste.memoria}}
                            </p>
                            <p v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
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
                            <div class="ml-2 flex-shrink-0 flex">
                              <p v-if="exame.exame_teste.personalidade == 'Apto'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{exame.exame_teste.personalidade}}
                              </p>
                              <p v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
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
                            <div class="ml-2 flex-shrink-0 flex">
                              <p v-if="exame.exame_teste.personalidade == 'Apto'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{exame.exame_teste.raciocinio}}
                              </p>
                               <p v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
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
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" @click="open = false">OK</button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="open = false" ref="cancelButtonRef">Cancel</button>
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
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/outline'
import { PresentationChartLineIcon,CalendarIcon, LocationMarkerIcon, UsersIcon,MinusSmIcon,IdentificationIcon,ReceiptTaxIcon,AcademicCapIcon,XIcon } from '@heroicons/vue/solid'

const positions = [
  {
    id: 1,
    title: 'Back End Developer',
    type: 'Full-time',
    location: 'Remote',
    department: 'Engineering',
    closeDate: '2020-01-07',
    closeDateFull: 'January 7, 2020',
  },
  {
    id: 2,
    title: 'Front End Developer',
    type: 'Full-time',
    location: 'Remote',
    department: 'Engineering',
    closeDate: '2020-01-07',
    closeDateFull: 'January 7, 2020',
  },
  {
    id: 3,
    title: 'User Interface Designer',
    type: 'Full-time',
    location: 'Remote',
    department: 'Design',
    closeDate: '2020-01-14',
    closeDateFull: 'January 14, 2020',
  },
]

const open = ref(false)
const props = defineProps({

  exame: Object,
 profissionais: Object
})
</script>

 