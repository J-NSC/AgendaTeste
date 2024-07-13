<script setup>
import FullLayout from '@/Layouts/full/FullLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import UiParentCard from '@/Components/shared/UiParentCard.vue';
const props = defineProps({
  contacts: Array,
});

const handleClick = () => {
  console.log('Botão Criar Contato foi clicado!');
};

</script>

<template>
  <Head title="Contatos"/>
  <FullLayout>
    <v-row>
      <v-col cols="12">
        <UiParentCard title="Contatos">

          <a :href="route('contato.create')"
             class="v-btn v-btn--elevated v-theme--ORANGE_THEME bg-secondary v-btn--density-default v-btn--size-default v-btn--variant-elevated mt-10 v-btn-se">
            Adicionar Contato
          </a>

          <div class=" mx-auto sm:px-6 lg:px-8">
            <v-card class="border" elevation="0">
              <v-table class="month-table">
                <thead>
                <tr>
                  <th>{{ $page.props.auth }}</th>
                  <th>EMAIL</th>
                  <th>TELEFONE</th>
                  <th>ENDEREÇO</th>
                </tr>

                </thead>
                <tbody>
                <tr v-for="contato in contacts">
                  <td>
                    {{ contato.name }}
                  </td>
                  <td>
                    {{ contato.email }}
                  </td>
                  <td>
                    {{ contato.phone }}
                  </td>
                  <td>
                    {{ contato.address }}
                  </td>
                  <td>
                    <v-btn color="primary" variant="outlined">Visualizar</v-btn>
                  </td>
                  <td>
                    <v-btn color="primary" variant="outlined">Visualizar</v-btn>
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
