<script setup lang="ts">
import { ref } from 'vue';
import {Link, useForm} from "@inertiajs/vue3";
import { Form } from "vee-validate";
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    contact: Object
});
console.log(props.contact.id);
const form = useForm({
    name: props.contact.name,
    phone: props.contact.phone,
    email: props.contact.email,
    address: props.contact.address,
});

const submit = () => {
    form.put(route('contato.update', props.contact.id), {
        onFinish: () => form.reset('name', 'phone', 'email', 'address')
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
                </v-row>
                <v-btn color="error" class="mr-3" >Cancelar</v-btn>
                <v-btn color="primary" :loading="isSubmitting" type="submit">Editar</v-btn>
            </v-col>
        </v-row>
    </Form>
</template>
