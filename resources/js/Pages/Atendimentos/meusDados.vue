<template>
  <div>
    <div v-if="divProcessoVazio" class="bg-indigo-50">
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-24 lg:px-8">
      <h2 class="text-3xl font-bold tracking-tight text-gray-900 md:text-4xl">
        <span class="block">Nenhum Processo!</span>
        <span class="block text-indigo-600">Inicie um Proceso agora mesmo.</span>
      </h2>
      <div class="flex mt-8 lg:mt-0 lg:flex-shrink-0">
        <div class="flex p-4">
            <Switch leave="opacity-0 duration-100 ease-out" v-model="enabled" @click="open = true" :class="[enabled ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
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
        </div>
        </div>
      </div>
      <CreateProcess :isOpen="open" @create-closed="divCreate" :aluno="aluno"/>
    </div>
    
   
    
    <div v-else class="overflow-hidden bg-white shadow sm:rounded-md"> 
      <ul role="list" class="divide-y divide-gray-200">
        <li v-for="(processo,index) in aluno.processos " :key="index" >
          
          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Categoria
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{processo.categoria}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Serviços
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{processo.servicos}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Status
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{processo.status}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Validade
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{convertData(processo.validade_processo)}}
                </p>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import CreateProcess from './CreateProcess.vue';
import {ref,defineProps,onMounted} from 'vue'
import { Switch  } from '@headlessui/vue'
const open= ref(false)
const enabled = ref(false)
const divProcessoVazio = ref(false)
onMounted(() => {
  if (!props.aluno.processos || Object.keys(props.aluno.processos).length === 0) {
            enabled.value = ref(true)
            open.value = !open.value
            divProcessoVazio.value = !divProcessoVazio.value
    }else{
          open.value = ref(false)
          }
})
function divCreate() {
  open.value = !open.value
  enabled.value = !enabled.value;
}
const props = defineProps({
      aluno:Object
})

</script>