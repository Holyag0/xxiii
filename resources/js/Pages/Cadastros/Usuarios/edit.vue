<template>
  <Head>
    <title>Edição de Usuários</title>
  </Head>
  <div class="mt-10 sm:mt-0">
    <div class="flex-1 min-w-0 pb-4">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">Edição de Usuários</h1>
    </div>
    
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="md:grid md:grid-cols-2 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent='updateUsuario' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">

                <div class="col-span-4 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input v-model="form.name" type="text" name="nome" id="nome" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.name" v-text="form.errors.name" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input v-model="form.email" type="email" name="email" id="email" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                  
                  <div v-if="form.errors.email" v-text="form.errors.email" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <input v-model="form.password" type="password" name="password" id="password" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
              
                  <div v-if="form.errors.password" v-text="form.errors.password" class="mt-1 text-xs text-red-500"></div>               
                </div>

                <div class="col-span-12 sm:col-span-3">
                  <label for="funcoes" class="block text-sm font-medium text-gray-700">Funções</label>
                
                  <select v-model="form.roles" multiple name="roles" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(role, index) in roles" :key="index" :value='index'> {{role}} </option>
                  </select>

                  <div v-if="form.errors.role" v-text="form.errors.role" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-12 sm:col-span-3">
                  <label for="cfc" class="block text-sm font-medium text-gray-700">Auto Escolas</label>
                
                  <select v-model="form.cfcs" multiple name="clinica" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="(cfc, index) in cfcs" :key="index" :value='index'> {{cfc}} </option>
                  </select>

                  <div v-if="form.errors.cfcs" v-text="form.errors.cfcs" class="mt-1 text-xs text-red-500"></div>
                </div>
  
              </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('user.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit" :disabled="form.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>

            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
              {{ form.progress.percentage }}%
            </progress>
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
        { name: 'Listagem de Usuários', href: 'user.index', current: false },
        { name: 'Edição de Usuário', current: true },
      ]

const props = defineProps({
  user: Object,
  cfcs: Object,
  roles: Object
})

defineComponent({
  BreadCrumbs
})

const form = useForm({
  name: props.user.data.name,
  email: props.user.data.email,
  password: props.user.data.password,
  roles: props.user.data.roles,
  cfcs: props.user.data.cfcs,
  errors: Object,
})

function updateUsuario(){
  form.put(route('user.update', props.user.data.id))
}

</script>
