<script setup lang="ts">
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth';
import { Form } from 'vee-validate';

/*Social icons*/
import google from '@/assets/images/svgs/google-icon.svg';
import facebook from '@/assets/images/svgs/facebook-icon.svg';
import { Link, useForm } from '@inertiajs/vue3';
import InputError from '../InputError.vue';

const checkbox = ref(false);
const valid = ref(false);
const show1 = ref(false);
const password = ref('');
const username = ref('');
const passwordRules = ref([
    (v: string) => !!v || 'Password is required',
    (v: string) => (v && v.length <= 10) || 'Password must be less than 10 characters'
]);
const emailRules = ref([(v: string) => !!v || 'E-mail is required', (v: string) => /.+@.+\..+/.test(v) || 'E-mail must be valid']);

function validate(values: any, { setErrors }: any) {
    const authStore = useAuthStore();
    return authStore.login(username.value, password.value).catch((error) => setErrors({ apiError: error }));
}


defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>    
    <Form @submit="submit" v-slot="{ errors, isSubmitting }" class="mt-5">
        <v-label class="text-subtitle-1 font-weight-semibold pb-2 text-lightText">Usuário</v-label>
        <VTextField
            v-model="form.email"                        
            required
            hide-details="auto"
        ></VTextField>
        <InputError class="mt-2" :message="form.errors.email" />
        <v-label class="text-subtitle-1 mt-8 font-weight-semibold pb-2 text-lightText">Senha</v-label>
        <VTextField
            v-model="form.password"         
            required
            hide-details="auto"
            type="password"
            class="pwdInput"
        ></VTextField>
        <InputError class="mt-2" :message="form.errors.password" />
        <div class="d-flex flex-wrap align-center my-3 ml-n2">
            <v-checkbox v-model="checkbox" :rules="[(v:any) => !!v || 'You must agree to continue!']" required hide-details color="primary">
                <template v-slot:label class="">Lembre-se de mim</template>
            </v-checkbox>
            <div class="ml-sm-auto">
                <Link href="" class="text-primary text-decoration-none text-body-1 opacity-1 font-weight-medium"
                    >Esqueceu sua senha?</Link
                >
            </div>
        </div>
        <v-btn size="large" :loading="isSubmitting" color="primary" :disabled="valid" block type="submit" flat>Entrar</v-btn>
        <div v-if="errors.apiError" class="mt-2">
            <v-alert color="error">{{ errors.apiError }}</v-alert>
        </div>
    </Form>
</template>
