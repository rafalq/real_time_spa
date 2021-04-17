<template>
  <div class="d-flex flex-wrap pt-4">
    <category-list-item
      v-for="category in categories"
      :key="category.name"
      :name="category.name"
    ></category-list-item>
  </div>
</template>

<script>
import CategoryListItem from "./CategoryListItem.vue";

export default {
  components: { CategoryListItem },
  data() {
    return {
      categories: [],
    };
  },

  methods: {
    getAllCategories() {
      axios
        .get("/api/category")
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },

  created() {
    this.getAllCategories();
  },
};
</script>
