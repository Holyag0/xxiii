<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Seleção de Unidade</title>
  </Head>
  <div class="bg-white"> 
    
    <!-- Header -->
    <div class="relative pb-32 bg-gray-800">
      <div class="absolute inset-0">
        <img class="object-cover w-full h-full" src="https://images.unsplash.com/photo-1525130413817-d45c1d127c42?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1920&q=60&&sat=-100" alt="" />
        <div class="absolute inset-0 bg-gray-800 mix-blend-multiply" aria-hidden="true" />
      </div>
      <div class="relative px-4 py-24 mx-auto text-center max-w-7xl sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white md:text-5xl lg:text-6xl">Escolha uma Unidade</h1>
      </div>
    </div>
    <!-- Overlapping cards -->
    <section class="relative z-10 px-4 pb-32 mx-auto -mt-32 max-w-7xl sm:px-6 lg:px-8" aria-labelledby="contact-heading">
      <h2 class="sr-only" id="contact-heading">Entrar</h2>
      <div class="grid grid-cols-1 gap-y-20 lg:grid-cols-3 lg:gap-y-0 lg:gap-x-8">
        
        <div v-for="cfc in cfcs" :key="cfc.id" class="flex flex-col bg-white shadow-xl mt-14 rounded-2xl">
          <div class="relative flex-1 px-6 pt-16 pb-8 md:px-8">
            <div class="absolute top-0 inline-block p-5 transform -translate-y-1/2 bg-indigo-600 shadow-lg rounded-xl">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" class="w-6 h-6 text-white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <h3 class="text-xl font-medium text-gray-900">{{ cfc.nome }}</h3>
            <!-- <p class="mt-4 text-base text-gray-500">{{ link.description }}</p> -->
          </div>
          
          <div class="p-6 bg-gray-50 rounded-bl-2xl rounded-br-2xl md:px-8">
            <a :href="route('alternaUnidade', cfc.id)" class="text-base font-medium text-indigo-700 hover:text-indigo-600">Entrar<span aria-hidden="true"> &rarr;</span></a>
          </div>
        </div>
      
      </div>
      <flash-messages/>
    </section>

    
  </div>
</template>

<script>
import FlashMessages from "../Shared/FlashMessages.vue"

export default {
  layout: null,
  components: { FlashMessages },
  props: {
    auth: Object,
    cfcs: Object
  },
};
</script>