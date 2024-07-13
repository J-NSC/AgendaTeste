<script setup lang="ts">
import {ref} from 'vue';
import {useForm} from "@inertiajs/vue3";
import {Form} from "vee-validate";

const form = useForm({
    name: '',
    phone: '',
    email: '',
    address: '',
    image: null,
});

const handleFileUpload = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0] || null;
    form.image = file;
};

const submit = () => {
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('phone', form.phone);
    formData.append('email', form.email);
    formData.append('address', form.address);
    if (form.image) {
        formData.append('image', form.image);
    }

    form.post(route('contato.store'), {
        onFinish: () => form.reset(
            'name',
            'phone',
            'email',
            'address',
            'image'
        ),
        data: formData,
        transform: (data) => formData,
        preserveState: true,
    });
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
          <v-col cols="12">
            <v-label class="mb-2 font-weight-medium">Imagem</v-label>
            <input type="file" @change="handleFileUpload"/>
          </v-col>
        </v-row>
        <v-btn color="error" class="mr-3">Cancelar</v-btn>
        <v-btn color="primary" :loading="isSubmitting" type="submit" >Adicinar</v-btn>
      </v-col>
    </v-row>
  </Form>
</template>

