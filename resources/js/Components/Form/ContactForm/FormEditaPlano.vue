<script setup lang="ts">
import {ref} from 'vue';
import {useForm} from "@inertiajs/vue3";
import {Form} from "vee-validate";

const select = ref('select');
const gender = ref(['True', 'False']);

const props = defineProps({
    planoAcademicos: Object
});
console.log(props.planoAcademicos)

const form = useForm({
  descricao: props.planoAcademicos.descricao,
  data_inicio: props.planoAcademicos.data_inicio,
  data_fim: props.planoAcademicos.data_fim,
  ativo: props.planoAcademicos.ativo,
  ano: props.planoAcademicos.ano,
  periodo_intensivo: props.planoAcademicos.periodo_intensivo,
  periodo_extensivo: props.planoAcademicos.periodo_extensivo,
  pit_inicio: props.planoAcademicos.pit_inicio,
  pit_fim: props.planoAcademicos.pit_fim,
  rit_inicio: props.planoAcademicos.rit_inicio,
  rit_fim: props.planoAcademicos.rit_fim,
});

const submit = () => {
  form.post(route('contato.store', {planoAcademicos :props.planoAcademicos.id}), {
    onFinish: () => form.reset(
        'descricao',
        'data_inicio',
        'data_fim',
        'ativo',
        'ano',
        'periodo_intensivo',
        'periodo_extensivo',
        'pit_inicio',
        'pit_fim',
        'rit_inicio',
        'rit_fim'
    )
  })
};

</script>


<template>
  <Form @submit="submit" v-slot="{ errors, isSubmitting }" class="mt-5">
    <v-row>
      <v-col cols="12" lg="12">
        <v-row>
          <v-col cols="12">
            <v-label class="mb-2 font-weight-medium">Descricao</v-label>
            <v-text-field variant="outlined" color="primary" v-model="form.descricao"/>
          </v-col>

          <v-col cols="12" md="6">
            <v-label class="mb-2 font-weight-medium">Data de inicio</v-label>
            <v-text-field color="primary" variant="outlined" type="date" v-model="form.data_inicio"/>
            <v-label class="mb-2 font-weight-medium">Ano</v-label>
            <v-text-field label="1"  color="primary" variant="outlined" type="number" v-model="form.ano"/>
          </v-col>
          <v-col cols="12" md="6">
            <v-label class="mb-2 font-weight-medium">Data de Fim</v-label>
            <v-text-field color="primary" variant="outlined" type="date" v-model="form.data_fim"/>
            <v-label class="mb-2 font-weight-medium">Periodo Intensivo</v-label>
            <v-text-field color="primary" variant="outlined" type="number" v-model="form.periodo_intensivo"/>
          </v-col>
        </v-row>

        <!--            <v-alert variant="tonal" type="warning" color="primary" class="mb-6"> Address </v-alert>-->
        <v-row>

          <v-col cols="12" md="6">
            <v-label class="mb-2 font-weight-medium">Periodo Extensivo</v-label>
            <v-text-field variant="outlined" color="primary" type="number" v-model="form.periodo_extensivo"/>
            <v-label class="mb-2 font-weight-medium">Inicio do PIT</v-label>
            <v-text-field color="primary" variant="outlined" type="date" v-model="form.pit_inicio"/>
          </v-col>
          <v-col cols="12" md="6">
            <v-label class="mb-2 font-weight-medium">Ativo</v-label>
            <v-select :items="gender" item-title="ativo" item-value="abbr" return-object single-line
                      variant="outlined" v-model="form.ativo"></v-select>
            <v-label class="mb-2 font-weight-medium">Fim do PIT</v-label>
            <v-text-field color="primary" variant="outlined" type="date" v-model="form.pit_fim"/>
          </v-col>

          <v-col cols="12" md="6">
            <v-label class="mb-2 font-weight-medium">Inicio do RIT</v-label>
            <v-text-field color="primary" variant="outlined" type="date" v-model="form.rit_inicio"/>
          </v-col>
          <v-col cols="12" md="6">
            <v-label class="mb-2 font-weight-medium">Fim do RIT</v-label>
            <v-text-field color="primary" variant="outlined" type="date" v-model="form.rit_fim"/>
          </v-col>
        </v-row>

        <v-btn color="error" class="mr-3">Cancel</v-btn>
        <v-btn color="primary" :loading="isSubmitting" type="submit" >Edita</v-btn>

      </v-col>
    </v-row>
  </Form>

</template>
