<template>
  <div>
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog as="div" class="fixed inset-0 z-40 flex md:hidden" @close="sidebarOpen = false">
        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
        </TransitionChild>
        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
          <div class="relative flex flex-col flex-1 w-full max-w-xs pt-5 pb-4 bg-indigo-700">
            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
              <div class="absolute top-0 right-0 pt-2 -mr-12">
                <button type="button" class="flex items-center justify-center w-10 h-10 ml-1 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                  <span class="sr-only">Close sidebar</span>
                  <XIcon class="w-6 h-6 text-white" aria-hidden="true" />
                </button>
              </div>
            </TransitionChild>
            <div class="flex items-center flex-shrink-0 px-4">
              <img class="w-auto h-8" src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg" alt="DM | Desktop Medical" />
            </div>
            <div class="flex-1 h-0 mt-5 overflow-y-auto">
              <nav class="px-2 space-y-1">
                <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']">
                  <component :is="item.icon" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-300" aria-hidden="true" />
                  {{ item.name }}
                </a>       
              </nav>
            </div>
          </div>
        </TransitionChild>
        <div class="flex-shrink-0 w-14" aria-hidden="true">
          <!-- Dummy element to force sidebar to shrink to fit close icon -->
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-indigo-700">
        <div class="flex items-center flex-shrink-0 px-4">
          <img class="w-auto h-8" src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg" alt="DM | Desktop Medical" />
        </div>
        <div class="flex flex-col flex-1 mt-5">
          <nav class="flex-1 px-2 pb-4 space-y-1">
            <!-- <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-600', 'group flex items-center px-2 py-2 text-sm font-medium rounded-md']">
              <component :is="item.icon" class="flex-shrink-0 w-6 h-6 mr-3 text-indigo-300" aria-hidden="true" />
              {{ item.name }}
            </a> -->

            <Link v-if="getPermission('atendimentos')"  :href="route('atendimentos')" class="text-indigo-100 hover:bg-indigo-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md"><component :is="HomeIcon" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-300" aria-hidden="true" />
            Atendimentos
            </Link>

            <Link v-if="getPermission('cadastros')" :href="route('menuCadastros')" class="text-indigo-100 hover:bg-indigo-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md"><component :is="UsersIcon" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-300" aria-hidden="true" />
            Cadastros
            </Link>

            <Link v-if="getPermission('financeiro')" :href="route('menuFinanceiro')" class="text-indigo-100 hover:bg-indigo-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md"><component :is="FolderIcon" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-300" aria-hidden="true" />
            Financeiro
            </Link>

            <Link v-if="getPermission('comercial')" :href="route('menuComercial')" class="text-indigo-100 hover:bg-indigo-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md"><component :is="CalendarIcon" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-300" aria-hidden="true" />
            Comercial
            </Link>

            <!-- <Link v-if="getPermission('boletos')" :href="route('boletos.index')" class="text-indigo-100 hover:bg-indigo-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md"><component :is="InboxIcon" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-300" aria-hidden="true" />
            Boletos
            </Link> -->

            <Link v-if="getPermission('contas')" :href="route('menuContas')" class="text-indigo-100 hover:bg-indigo-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md"><component :is="ChartBarIcon" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-300" aria-hidden="true" />
            Caixas
            </Link>

          </nav>
        </div>
      </div>
    </div>
    
    <div class="flex flex-col flex-1 md:pl-64">
      <div class="sticky top-0 z-10 flex flex-shrink-0 h-16 bg-white shadow">
        <button type="button" class="px-4 text-gray-500 border-r border-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden" @click="sidebarOpen = true">
          <span class="sr-only">Open sidebar</span>
          <MenuAlt2Icon class="w-6 h-6" aria-hidden="true" />
        </button>
        <div class="flex justify-between flex-1 px-4">
          <div class="flex flex-1">
          </div>
          <div class="flex items-center ml-4 md:ml-6">
            <strong class="mr-1">Unidade Selecionada: </strong><p v-if="auth.cfc_selecionado">  {{auth.cfc_selecionado.nome}}</p>
            <!-- <button type="button" class="p-1 text-gray-400 bg-white rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              <span class="sr-only">View notifications</span>
              <BellIcon class="w-6 h-6" aria-hidden="true" />
            </button> -->

            <!-- Profile dropdown -->
            <Menu as="div" class="relative ml-3">
              <div>
                <MenuButton class="flex items-center max-w-xs text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                </MenuButton>
              </div>
              <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
                <MenuItems class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                  <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                    <a :href="item.href" :method="item.method" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{ item.name }}</a>
                  </MenuItem>
                </MenuItems>
              </transition>
            </Menu>
          </div>
        </div>
      </div>

      <main>
        <div class="py-6">
          <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900"></h1>
          </div>
          <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
            <flash-messages/>
            <slot/>
          </div>
        </div>
      </main>
    </div>
  </div>

    
</template>

<script>
import { ref } from 'vue'
import {
  Dialog,
  DialogOverlay,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import {
  BellIcon,
  CalendarIcon,
  ChartBarIcon,
  FolderIcon,
  HomeIcon,
  InboxIcon,
  MenuAlt2Icon,
  UsersIcon,
  XIcon,
} from '@heroicons/vue/outline'
import { CashIcon, SearchIcon, PlusCircleIcon } from '@heroicons/vue/solid'
import FlashMessages from './FlashMessages.vue'
import getRole from '../utils/getRole'

const userNavigation = [
  { name: 'Seu Perfil', href: '#' },
  { name: 'Configurações', href: '#' },
  { name: 'Trocar Unidade', href: '/menu-alterna-unidade', method: 'get' },
  { name: 'Sair', href: '/logout', method: 'post' },
]

export default {
  components: {
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
    BellIcon,
    MenuAlt2Icon,
    SearchIcon,
    XIcon,
    FlashMessages,
  },
  setup() {
    const sidebarOpen = ref(false)

    return {
      userNavigation,
      sidebarOpen,
      PlusCircleIcon,
      HomeIcon,
      UsersIcon,
      FolderIcon,
      CalendarIcon,
      InboxIcon,
      ChartBarIcon,
      CashIcon
    }
  },
  props:{
    auth: Object
  }
}
</script>
