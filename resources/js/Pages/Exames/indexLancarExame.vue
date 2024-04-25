
<template>
  
    <div class="m-4"> 
      <ul role="list" class="divide-y divide-gray-200">
        <form @submit.prevent='submitExame(exame.id)' method="POST">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-4 sm:col-span-3">
                  <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                
                  <select v-model="form.status" name="status" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='Agendado'>Agendado</option>
                    <option value='Aprovado'> Aprovado </option>
                    <option value='Inapto Temporariamente'> Inapto Temporariamente </option>
                    <option value='Perícia Médica'> Perícia Médica </option>
                    <option> À Fazer</option>
                  </select>

                  <div v-if="form.errors.status" v-text="form.errors.status" class="mt-1 text-xs text-red-500"></div>
                </div>
                

                <div class="col-span-4 sm:col-span-3">
                  <label for="profissional_id" class="block text-sm font-medium text-gray-700">Profissional Responsável</label>
                
                  <select v-model="form.profissional_id" name="profissional_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                     <option v-for="(profissional, index) in profissionais" :key="index" :value='index'> {{profissional}} </option>
                  </select>

                  <div v-if="form.errors.profissional_id" v-text="form.errors.profissional_id" class="mt-1 text-xs text-red-500"></div>
                </div>                            

                  
                <div class="col-span-4 sm:col-span-3">
                  <label for="data_exame" class="block text-sm font-medium text-gray-700">Data Exame</label>
                  <input v-model="form.data_exame" type="date" name="data_exame" id="data_exame" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                
                  <div v-if="form.errors.data_exame" v-text="form.errors.data_exame" class="mt-1 text-xs text-red-500"></div>
                </div>

                <div class="col-span-4 sm:col-span-3">
                  <label for="turno" class="block text-sm font-medium text-gray-700">Turno</label>
                
                  <select v-model="form.turno" name="turno" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value='Manhã'> Manhã </option>
                    <option value='Tarde'> Tarde </option>
                  </select>

                  <div v-if="form.errors.turno" v-text="form.errors.turno" class="mt-1 text-xs text-red-500"></div>
                </div>
                
                <div class="col-span-4 sm:col-span-3" v-if="exame.tipo == 'Exame Psicológico'">
                  <label for="escolaridade" class="block text-sm font-medium text-gray-700">Escolaridade</label>
                  <select v-model="form.escolaridade" id="escolaridade" name="escolaridade" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="Analfabeto">Analfabeto</option>
                    <option value="Semi-Analfabeto">Semi-Analfabeto</option>
                    <option value="Fundamental Incompleto">Fundamental Incompleto</option>
                    <option value="Fundamental completo">Fundamental completo</option>
                    <option value="Ensino médio incompleto">Ensino médio incompleto</option>
                    <option value="Ensino médio completo">Ensino médio completo</option>
                    <option value="Ensino superior incompleto">Ensino superior incompleto</option>
                    <option value="Ensino superior completo">Ensino superior completo</option>
                  </select>
                </div> 
                

                <div class="col-span-4 sm:col-span-3" v-if="exame.tipo == 'Exame Psicológico'">
                  <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                  <select v-model="form.sexo" id="sexo" name="sexo" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                  </select>
                </div>

                <div class="col-span-4 sm:col-span-3" v-if="exame.tipo == 'Exame Psicológico'">
                  <label for="faixa_etaria" class="block text-sm font-medium text-gray-700">Faixa Etária</label>
                  <select v-model="form.faixa_etaria" id="faixa_etaria" name="faixa_etaria" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="18 - 25">18 - 25</option>
                    <option value="25 - 30">25 - 30</option>
                    <option value="30 - 35">30 - 35</option>
                    <option value="35 - 40">35 - 40</option>
                    <option value="40 - 45">40 - 45</option>
                    <option value="45 - 50">45 - 50</option>
                    <option value="50 - 60">50 - 60</option>
                    <option value="60 - 70">60 - 70</option>
                    <option value="70+">70+</option>
                  </select>
                </div> 

                <div class="col-span-4 sm:col-span-3" v-if="exame.tipo == 'Exame Psicológico'">
                    <label for="concentrada" class="block text-sm font-medium text-gray-700">Atenção Concentrada</label>
                    <select v-model="form.concentrada" id="concentrada" name="concentrada" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <option value="Apto">Apto</option>
                      <option value="Inapto">Inapto</option>
                      <option >A Fazer</option>
                    </select>
                  </div> 

                  <div class="col-span-4 sm:col-span-3" v-if="exame.tipo == 'Exame Psicológico'">
                    <label for="dividida" class="block text-sm font-medium text-gray-700">Atenção Dividida</label>
                    <select v-model="form.dividida" id="dividida" name="dividida" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <option value="Apto">Apto</option>
                      <option value="Inapto">Inapto</option>
                      <option >A Fazer</option>
                    </select>
                  </div> 

                  <div class="col-span-4 sm:col-span-3" v-if="exame.tipo == 'Exame Psicológico'">
                    <label for="alternada" class="block text-sm font-medium text-gray-700">Atenção Alternada</label>
                    <select v-model="form.alternada" id="alternada" name="alternada" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <option value="Apto">Apto</option>
                      <option value="Inapto">Inapto</option>
                      <option>A Fazer</option>
                    </select>
                  </div> 

                  <div class="col-span-4 sm:col-span-3" v-if="exame.tipo == 'Exame Psicológico'">
                    <label for="memoria" class="block text-sm font-medium text-gray-700">Memória</label>
                    <select v-model="form.memoria" id="memoria" name="memoria" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <option value="Apto">Apto</option>
                      <option value="Inapto">Inapto</option>
                      <option>A Fazer</option>
                    </select>
                  </div> 

                  <div class="col-span-4 sm:col-span-3" v-if="exame.tipo == 'Exame Psicológico'">
                    <label for="personalidade" class="block text-sm font-medium text-gray-700">Personalidade</label>
                    <select v-model="form.personalidade" id="personalidade" name="personalidade" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <option value="Apto">Apto</option>
                      <option value="Inapto">Inapto</option>
                      <option>A fazer</option>
                    </select>
                  </div> 

                  <div class="col-span-4 sm:col-span-3" v-if="exame.tipo == 'Exame Psicológico'">
                    <label for="raciocinio" class="block text-sm font-medium text-gray-700">Raciocinio</label>
                    <select v-model="form.raciocinio" id="raciocinio" name="raciocinio" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <option value="Apto">Apto</option>
                      <option value="Inapto">Inapto</option>
                     <option>A Fazer</option>
                    </select>
                  </div> 
              </div>
            </div>
            <!-- <div class="flex px-4 py-3 text-right bg-gray-50 sm:px-6">
              <button type="submit" :disabled="form.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Atualizar</button>
            </div>
              <div class="flex px-4 py-3 text-left bg-gray-50 sm:px-6">
              <button type="submit" :disabled="form.processing" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Atualizar</button>
            </div> 
            --> <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('exames.index')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">Voltar</Link>
              <button type="submit"  class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Lançar Exame</button>
            </div>

            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
              {{ form.progress.percentage }}%
            </progress>
          </div>
        </form>
      </ul>
    </div>

    <div class="relative">
      <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-gray-200" /></div>
        <div class="relative flex justify-center">
      </div>
    </div>
    
             
</template>

<script setup>
import { CheckIcon } from '@heroicons/vue/solid'

import { useForm } from "@inertiajs/inertia-vue3"
import { defineComponent } from "@vue/runtime-core";

const props = defineProps({
  
  profissionais: Object,
  exame: Object
})

defineComponent({
  CheckIcon,
  
})

const form = useForm({
  // aluno_id: props.exame.venda.aluno_id,
  data_exame: props.exame.data_exame,
  turno: props.exame.turno,
  status: props.exame.status,
  profissional_id: props.exame.profissional_id,
  tipo: props.exame.tipo,
  
  sexo: props.exame.exame_teste != null ? props.exame.exame_teste.sexo : '',
  escolaridade: props.exame.exame_teste != null ? props.exame.exame_teste.escolaridade : '',
  faixa_etaria: props.exame.exame_teste != null ? props.exame.exame_teste.faixa_etaria : '',
  concentrada: props.exame.exame_teste != null ? props.exame.exame_teste.concentrada : '',
  dividida: props.exame.exame_teste != null ? props.exame.exame_teste.dividida : '',
  alternada: props.exame.exame_teste != null ? props.exame.exame_teste.alternada : '',
  memoria: props.exame.exame_teste != null ?  props.exame.exame_teste.memoria : '',
  personalidade: props.exame.exame_teste != null ? props.exame.exame_teste.personalidade : '',
  raciocinio: props.exame.exame_teste != null ? props.exame.exame_teste.raciocinio : '',
  errors: Object,
})

function submitExame(id)
{
  form.put(route('index.update', id))
}

</script>