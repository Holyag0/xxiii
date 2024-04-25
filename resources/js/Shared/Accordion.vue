<template>
    <div class="flex mt-2 mb-2 text-center divide-gray-200">
        <div class="flex flex-1 w-2 ">
            <span v-on:click="isOpen = !isOpen" class="ml-3 font-bold rounded cursor-pointer hover:text-gray-500">{{ title }}</span>
        </div>
    </div> 
            
    <div class="mt-4 mb-4 overflow-hidden bg-white shadow sm:rounded-md" :class="isOpen ? 'd-block' : 'hidden'">
        <slot></slot>
    </div>
</template>

<script>
export default {
    data: () => {
        return {
            isOpen: false
        }
    },
    name: 'Accordion',
    props: {
        title: String,
    }
}
</script>