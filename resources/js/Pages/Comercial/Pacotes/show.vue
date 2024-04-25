<template>
  <Head>
    <title>Visualizacão de Pacotes</title>
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
                  {{pacote.nome}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Valor
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{convertFloatMoney(valorPacote(pacote.servicos))}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Serviços
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p v-for="servico in pacote.servicos" :key="servico.id" class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{servico.nome}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Status
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  <span v-if="pacote.status == 1">Ativo</span>
                  <span v-else>Desativado</span>
                </p>
              </div>
            </div>
          </div>

           <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Desconto Boleto
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  <span v-if="pacote.desconto_boleto == 1">Permitido</span>
                  <span v-else>Não Permitido</span>
                </p>
              </div>
            </div>
          </div>

           <div v-if="pacote.desconto_boleto == 1" class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Valor do retorno para CFC
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{convertFloatMoney(pacote.valor_credito)}}
                </p>
              </div>
            </div>
          </div>
          
        </li>
      </ul>
    </div>
  </div>
  <hr>
  <div class="px-0 py-3 mx-0 text-left sm:px-6">
      <Link :href="route('pacote.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
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
        { name: 'Listagem de Pacotes', href: 'pacote.index', current: false },
        { name: 'Visualizacão de Pacotes', current: true },
      ]
    }
  },
   props: {
    pacote: Object,
  }
}
</script>