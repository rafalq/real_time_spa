<template>
  <panel-base>
    <template v-slot:header>CATEGORIES</template>
    <div v-if="checkIfLoggedIn()">
      <admin-category-list v-if="checkifAdmin()"></admin-category-list>
      <category-list v-else></category-list>
    </div>
    <category-list v-else></category-list>
  </panel-base>
</template>

<script>
import PanelBase from "../../UI/PanelBase.vue";
import AdminCategoryList from "./admin/AdminCategoryList.vue";
import CategoryList from "./CategoryList.vue";
export default {
  components: { PanelBase, CategoryList, AdminCategoryList },
  methods: {
    checkifAdmin() {
      return User.admin() ? true : false;
    },
    checkIfLoggedIn() {
      const token = sessionStorage.getItem("token");
      if (token !== null) {
        return true;
      } else {
        return false;
      }
    },
  },
  created() {
    if (this.checkIfLoggedIn()) {
      return this.checkifAdmin();
      console.log(this.checkifAdmin);
    }
  },
};
</script>,
    