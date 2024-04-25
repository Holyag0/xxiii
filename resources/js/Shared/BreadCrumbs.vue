<template>
  <nav class="flex bg-white border-b border-gray-200" aria-label="Breadcrumb">
    <ol role="list" class="flex w-full max-w-screen-xl px-4 mx-auto space-x-4 sm:px-6 lg:px-8">
      <li class="flex">
        <div class="flex items-center">
            <Link :href="route('home')" class="text-gray-800 hover:text-gray-500">
                <HomeIcon class="flex-shrink-0 w-5 h-5" aria-hidden="true" />
                <span class="sr-only">Home</span>
            </Link>
        </div>
      </li>
      <li v-for="page in pages" :key="page.name" class="flex">
        <div class="flex items-center">
          <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
          </svg>
          <div v-if="page.href == null">
              <a href="#" class="ml-4 text-sm font-medium text-gray-800 hover:text-gray-500" :aria-current="page.current ? 'page' : undefined">{{ page.name }}</a>
          </div>
          <div v-else>
              <Link :href="route(page.href)" class="ml-4 text-sm font-medium text-gray-800 hover:text-gray-500" :aria-current="page.current ? 'page' : undefined">{{ page.name }}</Link>
          </div>
        </div>
      </li>
    </ol>
  </nav>
</template>

<script>
import { HomeIcon } from '@heroicons/vue/solid'

export default {
  components: {
    HomeIcon,
  },
  setup() {
    return {
    
    }
  },
  props:{
      pages: Object
  }
}
</script>