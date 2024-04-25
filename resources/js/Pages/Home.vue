<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Head>
    <title>Home</title>
  </Head>
  
  <div>
    <h3 class="text-lg font-medium leading-6 text-gray-900">Em Desenvolvimento</h3>
    <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
      <div v-for="item in stats" :key="item.name" class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">
          <!-- {{ item.name }} -->
        </dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">
          <!-- {{ item.stat }} -->
        </dd>
      </div>
    </dl>
  </div>
</template>

<script>
const stats = [
  { name: '#', stat: '0' },
  { name: '#', stat: '0' },
  { name: '#', stat: '0' },
]

export default {
  setup() {
    return {
      stats,
    }
  },
}
</script>