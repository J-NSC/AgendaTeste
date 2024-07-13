<script setup>
import FullLayout from '@/Layouts/full/FullLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import UiParentCard from '@/Components/shared/UiParentCard.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    contacts: Array,
});

</script>

<template>
    <Head title="Contatos"/>
    <FullLayout>
        <v-row>
            <v-col cols="12">
                <UiParentCard title="Contatos">
                    <Link method="get"
                          :href="route('contato.create')"
                          type="button"
                          class="v-btn v-btn--elevated v-theme--ORANGE_THEME bg-secondary v-btn--density-default v-btn--size-default v-btn--variant-elevated mt-10 v-btn-se">
                        Adicionar Contato
                    </Link>

                    <div class="mx-auto sm:px-6 lg:px-8">
                        <v-card class="border" elevation="0">
                            <v-table class="month-table">
                                <thead>
                                <tr>
                                    <th>NOME</th>
                                    <th>EMAIL</th>
                                    <th>TELEFONE</th>
                                    <th>ENDEREÇO</th>
                                    <th>AÇÕES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="contato in contacts" :key="contato.id">
                                    <td>{{ contato.name }}</td>
                                    <td>{{ contato.email }}</td>
                                    <td>{{ contato.phone }}</td>
                                    <td>{{ contato.address }}</td>
                                    <td>

                                        <Link method="get" :href="route('contato.edit',contato.id)" type="button">
                                            <v-btn color="primary" variant="outlined">Editar</v-btn>
                                        </Link>

                                        <Link method="delete" :href="route('contato.destroy',contato.id)" type="button">
                                            <v-btn color="red" variant="outlined">Deletar</v-btn>
                                        </Link>
                                    </td>
                                </tr>
                                </tbody>
                            </v-table>
                        </v-card>
                    </div>
                </UiParentCard>
            </v-col>
        </v-row>
    </FullLayout>
</template>
