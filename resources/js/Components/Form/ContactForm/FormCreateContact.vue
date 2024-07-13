<script setup lang="ts">
import {ref} from 'vue';
import {useForm} from "@inertiajs/vue3";
import {Form} from "vee-validate";

const select = ref('select');
const gender = ref(['True', 'False']);

const form = useForm({
  name: '',
  phone: '',
  email: '',
  address: '',
});

const submit = () => {
  form.post(route('agenda.store'), {
    onFinish: () => form.reset(
        'name',
        'phone',
        'email',
        'address',
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
            <v-label class="mb-2 font-weight-medium">Nome</v-label>
            <v-text-field variant="outlined" color="primary" v-model="form.name"/>
          </v-col>

          <v-col cols="12" md="6">
            <v-label class="mb-2 font-weight-medium">Telefone</v-label>
            <v-text-field variant="outlined" color="primary" v-model="form.phone"/>
            <v-label class="mb-2 font-weight-medium">Email</v-label>
            <v-text-field variant="outlined" color="primary" v-model="form.email"/>
          </v-col>
          <v-col cols="12" md="6">
            <v-label class="mb-2 font-weight-medium">Endereço</v-label>
            <v-text-field variant="outlined" color="primary" v-model="form.address"/>
          </v-col>
        </v-row>
        <v-btn color="error" class="mr-3">Cancelar</v-btn>
        <v-btn color="primary" :loading="isSubmitting" type="submit" >Adicinar</v-btn>
      </v-col>
    </v-row>
  </Form>
</template>

