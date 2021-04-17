<template>
  <v-app>
    <the-header></the-header>
    <the-main>
      <template v-slot:subnav>
        <category-panel></category-panel>
      </template>
      <template v-slot:default>
        <router-view></router-view>
      </template>
    </the-main>

    <the-footer></the-footer>
  </v-app>
</template>

<script>
import CategoryPanel from "./forum/category/CategoryPanel.vue";
import TheFooter from "./layouts/TheFooter.vue";
import TheHeader from "./layouts/TheHeader";
import TheMain from "./layouts/TheMain.vue";

export default {
  components: { TheHeader, TheFooter, TheMain, CategoryPanel },
  // data() {
  //   return {
  //     categories: [],
  //   };
  // },
  // provide() {
  //   return {
  //     categories: this.categories,
  //   };
  // },
  // created() {
  //   axios
  //     .get("/api/category")
  //     .then((response) => {
  //       this.categories = response.data.data;
  //     })
  //     .catch((error) => {
  //       console.log(error.response.data);
  //     });
  // },
};
</script>