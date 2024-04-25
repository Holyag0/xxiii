<template>
<Head title="Login" />

<div class="flex flex-col justify-center min-h-full py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="w-auto h-12 mx-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
      <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900">Faça login em sua conta</h2>
      <p class="mt-2 text-sm text-center text-gray-600"></p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" action="#" @submit.prevent="submit" method="POST">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
            <div class="mt-1">
              <input id="email" v-model="form.email" name="email" type="email" autocomplete="email" required="" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>

            <div v-if="form.errors.email" v-text="form.errors.email" class="mt-1 text-xs text-red-500"></div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700"> Senha </label>
            <div class="mt-1">
              <input id="password" v-model="form.password" name="password" type="password" autocomplete="current-password" required="" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>

            <div v-if="form.errors.password" v-text="form.errors.password" class="mt-1 text-xs text-red-500"></div>
          </div>

          <div>
            <button type="submit" :disabled="form.processing" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Entrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
</template>

<script>
export default {
  layout: null,
};
</script>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

let form = useForm({
  email: '',
  password: '',
});

let submit = () => {
  form.post('/login');
};
</script>
