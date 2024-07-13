<script setup>

import FormCriarPlano from "@/Components/Form/ContactForm/FormCreateContact.vue";
import FullLayout from "@/Layouts/full/FullLayout.vue";
import UiParentCard from "@/Components/shared/UiParentCard.vue";


</script>

<template>
  <FullLayout>
    <v-row>
      <v-col cols="12">
        <UiParentCard title="Criar Contato">
          <div
              class="v-card v-theme--ORANGE_THEME v-card--density-default elevation-10 rounded-md v-card--variant-elevated mt-6 mx-auto">
            <div
                class="v-card v-theme--ORANGE_THEME v-card--density-default elevation-10 rounded-md v-card--variant-elevated">
              <div class="v-card__loader">
                <div class="v-progress-linear v-theme--ORANGE_THEME v-locale--is-ltr" role="progressbar"
                     aria-hidden="true" aria-valuemin="0" aria-valuemax="100"
                     style="top: 0px; height: 0px; --v-progress-linear-height: 2px; left: 50%; transform: translateX(-50%);">
                  <div class="v-progress-linear__background" style="width: 100%;"></div>
                  <div class="v-progress-linear__indeterminate">
                    <div class="v-progress-linear__indeterminate long"></div>
                    <div class="v-progress-linear__indeterminate short"></div>
                  </div>
                </div>
              </div>
              <hr class="v-divider v-theme--ORANGE_THEME" aria-orientation="horizontal" role="separator">
              <div class="v-card-text">
                  {{ $page.props.auth }}
                <FormCriarPlano/>
              </div>
            </div>
          </div>
        </UiParentCard>
      </v-col>
    </v-row>
  </FullLayout>
</template>
<style scoped lang="scss">

</style>
