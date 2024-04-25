<template>
  <Head>
    <title>Visualização de Receitas</title>
  </Head>
  <div>
    <bread-crumbs class="mb-2" :pages="links" />
    <div class="overflow-hidden bg-white shadow sm:rounded-md"> 
      <ul role="list" class="divide-y divide-gray-200">
        <li>
          
          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Cliente
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{receita.aluno.nome}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Auto Escola
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p v-if="receita.auto_escola_id" class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                    {{ receita.auto_escola.nome }}
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
                  {{convertFloatMoney(receita.valor)}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Categoria
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  <span v-if="receita.categoria">{{receita.categoria.name}}</span>
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Observação
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{receita.obs}}
                </p>
              </div>
            </div>
          </div>

          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">
                Data de Vencimento
              </p>
              <div class="flex flex-shrink-0 ml-2">
                <p class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full">
                  {{convertData(receita.data_vencimento)}}
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
                  <span v-if="receita.status == 1">Recebida</span>
                  <span v-else>Á receber</span>
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
      <Link :href="route('receitas.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
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
        { name: 'Listagem de receitas', href: 'receitas.index', current: false },
        { name: 'Visualizacão de receitas', current: true },
      ]
    }
  },
   props: {
    receita: Object,
  }
}
</script>