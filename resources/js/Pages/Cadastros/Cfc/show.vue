<template>
  <Head>
    <title>Visualização de Auto Escola</title>
  </Head>
  <div>
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="overflow-hidden bg-white shadow sm:rounded-md"> 
      <ul role="list" class="divide-y divide-gray-200">
        <li>
          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Nome
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.nome}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                CPF / CNPJ
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.cnpj}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Email
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.email}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Celular
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.celular}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                CEP
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.cep}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Logradouro
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.logradouro}}
                </p>
              </div>
            </div>
          </div>

           <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Número
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.numero}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Telefone
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.fone}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Estado
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.estado}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Cidade
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.cidade}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Bairro
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.bairro}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Complemento
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{cfc.complemento}}
                </p>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="px-4 py-3 text-left bg-gray-50 sm:px-6">
      <Link :href="route('cfc.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
    </div>
  </div>
</template>

<script>
import BreadCrumbs from '../../../Shared/BreadCrumbs.vue'
  
export default {
  components: {
    BreadCrumbs,
  },
  setup() {
    return {
      links:[
        { name: 'Listagem de Auto Escolas', href: 'cfc.index', current: false },
        { name: 'Visualizacão de Auto Escolas', current: true },
      ]
    }
  },
   props: {
    cfc: Object,
  }
}
</script>