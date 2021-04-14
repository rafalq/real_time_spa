<template>
  <v-app>
    <the-header></the-header>

    <v-main>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>

    <the-footer></the-footer>
  </v-app>
</template>

<script>
import TheFooter from "./layouts/TheFooter.vue";
import TheHeader from "./layouts/TheHeader";

export default {
  components: { TheHeader, TheFooter },
};
</script>