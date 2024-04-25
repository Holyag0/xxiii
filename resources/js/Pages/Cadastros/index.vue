<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Menu de Cadastros</title>
  </Head>
  <div>
    <h3 class="text-lg font-medium leading-6 text-gray-900">Menu Cadastros</h3>
    <dl class="grid grid-cols-1 gap-6 mt-2 sm:grid-cols-2 lg:grid-cols-6">
      
      <div v-if="getPermission('cadastro-clinica')" class="relative px-4 pt-5 pb-3 overflow-hidden text-center bg-white rounded-lg shadow sm:pt-6 sm:px-6">
        <Link :href="route('clinica.index')" class="font-medium text-indigo-600 hover:text-indigo-500">
          <dt>
            <div class="p-4 pl-10 mb-4 bg-indigo-500 rounded-md">
              <component :is="BeakerIcon" class="w-8 h-8 text-white" aria-hidden="true" />
            </div>
          </dt>
          
          <dd class="flex items-baseline pb-6 ml-16 sm:pb-7">
            <div class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6">
              <p class="text-center text-gray-500">Clínicas</p>
            </div>
          </dd>
        </Link>
      </div>

      <div v-if="getPermission('cadastro-fornecedor')" class="relative px-4 pt-5 pb-3 overflow-hidden text-center bg-white rounded-lg shadow sm:pt-6 sm:px-6">
        <Link :href="route('fornecedores.index')" class="font-medium text-indigo-600 hover:text-indigo-500">
          <dt>
            <div class="p-4 pl-10 mb-4 bg-indigo-500 rounded-md">
              <component :is="ColorSwatchIcon" class="w-8 h-8 text-white" aria-hidden="true" />
            </div>
          </dt>
          
          <dd class="flex items-baseline pb-6 ml-16 sm:pb-7">
            <div class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6">
              <p class="text-center text-gray-500">Fornecedores</p>
            </div>
          </dd>
        </Link>
      </div>

      <div v-if="getPermission('cadastro-usuario')" class="relative px-4 pt-5 pb-3 overflow-hidden text-center bg-white rounded-lg shadow sm:pt-6 sm:px-6">
        <Link :href="route('user.index')" class="font-medium text-indigo-600 hover:text-indigo-500">
          <dt>
            <div class="p-4 pl-10 mb-4 bg-indigo-500 rounded-md">
              <component :is="UserGroupIcon" class="w-8 h-8 text-white" aria-hidden="true" />
            </div>
          </dt>
          
          <dd class="flex items-baseline pb-6 ml-16 sm:pb-7">
            <div class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6">
              <p class="text-center text-gray-500">Usuários</p>
            </div>
          </dd>
        </Link>
      </div>

      <div v-if="getPermission('cadastro-colaborador')" class="relative px-4 pt-5 pb-3 overflow-hidden text-center bg-white rounded-lg shadow sm:pt-6 sm:px-6">
        <Link :href="route('colaboradores.index')" class="font-medium text-indigo-600 hover:text-indigo-500">
          <dt>
            <div class="p-4 pl-10 mb-4 bg-indigo-500 rounded-md">
              <component :is="UserCircleIcon" class="w-8 h-8 text-white" aria-hidden="true" />
            </div>
          </dt>
          
          <dd class="flex items-baseline pb-6 ml-16 sm:pb-7">
            <div class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6">
              <p class="text-center text-gray-500">Colaboradores</p>
            </div>
          </dd>
        </Link>
      </div>

      <div v-if="getPermission('cadastro-cfc')" class="relative px-4 pt-5 pb-3 overflow-hidden text-center bg-white rounded-lg shadow sm:pt-6 sm:px-6">
        <Link :href="route('cfc.index')" class="font-medium text-indigo-600 hover:text-indigo-500">
          <dt>
            <div class="p-4 pl-10 mb-4 bg-indigo-500 rounded-md">
              <component :is="TruckIcon" class="w-8 h-8 text-white" aria-hidden="true" />
            </div>
          </dt>
          
          <dd class="flex items-baseline pb-6 ml-16 sm:pb-7">
            <div class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6">
              <p class="text-center text-gray-500">Auto Escolas</p>
            </div>
          </dd>
        </Link>
      </div>

      <div v-if="getPermission('cadastro-instrutor')" class="relative px-4 pt-5 pb-3 overflow-hidden text-center bg-white rounded-lg shadow sm:pt-6 sm:px-6">
        <Link :href="route('instrutor.index')" class="font-medium text-indigo-600 hover:text-indigo-500">
          <dt>
            <div class="p-4 pl-10 mb-4 bg-indigo-500 rounded-md">
              <component :is="GlobeIcon" class="w-8 h-8 text-white" aria-hidden="true" />
            </div>
          </dt>
          
          <dd class="flex items-baseline pb-6 ml-16 sm:pb-7">
            <div class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6">
              <p class="text-center text-gray-500">Instrutores</p>
            </div>
          </dd>
        </Link>
      </div>
     
    </dl>
  </div>
</template>

<script>
import { ArrowSmDownIcon, ArrowSmUpIcon, UserGroupIcon } from '@heroicons/vue/solid'
import { BeakerIcon, ColorSwatchIcon, TruckIcon, UserCircleIcon, GlobeIcon } from '@heroicons/vue/outline'

export default {
  
  components: {
    ArrowSmDownIcon,
    ArrowSmUpIcon,
  },
  
  setup() {
    return {
      BeakerIcon,
      ColorSwatchIcon,
      UserGroupIcon,
      UserCircleIcon,
      TruckIcon,
      GlobeIcon
    }
  },
}
</script>