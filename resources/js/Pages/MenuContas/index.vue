<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Gerenciamento de Caixas</title>
  </Head>
  <div>
    <h3 class="text-lg font-medium leading-6 text-gray-900">Menu Caixas</h3>
    <dl class="grid grid-cols-1 gap-6 mt-2 sm:grid-cols-2 lg:grid-cols-6">
      
      <div v-if="getPermission('contas-list')" class="relative px-4 pt-5 pb-3 overflow-hidden text-center bg-white rounded-lg shadow sm:pt-6 sm:px-6">
        
        <Link :href="route('contas.index')" class="font-medium text-indigo-600 hover:text-indigo-500">
          <dt>
            <div class="p-4 pl-10 mb-4 bg-indigo-500 rounded-md">
              <component :is="LibraryIcon" class="w-8 h-8 text-white" aria-hidden="true" />
            </div>
          </dt>
          
          <dd class="flex items-baseline pb-6 ml-16 sm:pb-7">
            <div class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6">
              <p class="text-center text-gray-500">Contas Digitais</p>
            </div>
          </dd>
        </Link>
      </div>

      <div v-if="getPermission('transacoes')" class="relative px-4 pt-5 pb-3 overflow-hidden text-center bg-white rounded-lg shadow sm:pt-6 sm:px-6">
        
        <Link :href="route('transacoes.index')" class="font-medium text-indigo-600 hover:text-indigo-500">
          <dt>
            <div class="p-4 pl-10 mb-4 bg-indigo-500 rounded-md">
              <component :is="TrendingUpIcon" class="w-8 h-8 text-white" aria-hidden="true" />
            </div>
          </dt>
          
          <dd class="flex items-baseline pb-6 ml-16 sm:pb-7">
            <div class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6">
              <p class="text-center text-gray-500">Transações</p>
            </div>
          </dd>
        </Link>
      </div>

    </dl>
  </div>
</template>

<script>
import { ArrowSmDownIcon, ArrowSmUpIcon } from '@heroicons/vue/solid'
import { TrendingUpIcon, FolderIcon, LibraryIcon } from '@heroicons/vue/outline'

export default {
  components: {
    ArrowSmDownIcon,
    ArrowSmUpIcon,
  },
  setup() {
    return {
      LibraryIcon,
      TrendingUpIcon
    }
  },
}
</script>