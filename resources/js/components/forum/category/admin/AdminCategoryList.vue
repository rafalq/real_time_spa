<template>
  <div class="d-flex flex-wrap pt-4">
    <div class="pa-0 ma-0" v-if="isLoggedIn()">
      <v-dialog
        v-model="dialog"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            color="primary"
            dark
            v-bind="attrs"
            v-on="on"
            @click="dialogTitle = 'Create New Category'"
          >
            <v-icon class="white--text">mdi-tag-plus</v-icon>
          </v-btn>
        </template>
        <v-card>
          <v-form @submit.prevent="submitForm">
            <v-toolbar dark color="primary">
              <v-btn icon dark @click="dialog = false">
                <v-icon>mdi-close</v-icon>
              </v-btn>
              <v-toolbar-title>{{ dialogTitle }}</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-toolbar-items>
                <v-btn dark text @click="submitForm" v-if="editSlug">
                  Update
                </v-btn>
                <v-btn dark text @click="submitForm" v-else> Create </v-btn>
              </v-toolbar-items>
            </v-toolbar>

            <v-card-text>
              <v-row>
                <v-col cols="12">
                  <span class="error-text" v-if="errors.name">
                    {{ errors.name[0] }}
                  </span>
                  <v-text-field
                    outlined
                    v-model="form.name"
                    label="Category Name*"
                    type="text"
                    required
                    class="mt-2"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-card-text>
          </v-form>
        </v-card>
      </v-dialog>
    </div>
    <admin-category-list-item
      v-for="(category, index) in categories"
      :key="category.name"
      :name="category.name"
      @edit="editCategory(index)"
      @delete="deleteCategory(category.slug, index)"
    ></admin-category-list-item>
  </div>
</template>

<script>
import AdminCategoryListItem from "./AdminCategoryListItem.vue";

export default {
  components: { AdminCategoryListItem },
  data() {
    return {
      categories: [],
      dialog: false,
      dialogTitle: "",
      editSlug: null,
      categoryIndex: null,
      notifications: false,
      sound: true,
      widgets: false,
      errors: {},
      form: {
        name: "",
      },
    };
  },
  watch: {
    dialog(value) {
      if (value === false && this.form.name.length === 0) {
        this.errors = {};
      }
    },
  },
  methods: {
    isLoggedIn() {
      if (User.loggedIn()) {
        return true;
      } else {
        return false;
      }
    },
    submitForm() {
      if (this.editSlug) {
        this.updateCategory();
      } else {
        this.createCategory();
      }
    },
    createCategory() {
      axios
        .post("/api/category", this.form)
        .then((response) => {
          this.categories.unshift(response.data);
          this.form.name = "";
          this.errors = {};
          this.dialog = false;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    updateCategory() {
      // console.log(this.categoryIndex);
      axios
        .patch(`/api/category/${this.editSlug}`, this.form)
        .then((response) => {
          this.categories.splice(this.categoryIndex, 1);
          this.categories.unshift(response.data);

          this.form.name = "";
          this.errors = {};
          this.dialog = false;
          this.categoryIndex = null;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    editCategory(index) {
      this.dialog = true;
      this.dialogTitle = "Update Category";
      this.form.name = this.categories[index].name;
      console.log(this.form.name);
      this.editSlug = this.categories[index].slug;
      this.categoryIndex = index;
      // this.categories.splice(index, 1);
    },
    deleteCategory(slug, index) {
      axios
        .delete(`/api/category/${slug}`)
        .then((response) => this.categories.splice(index, 1));
    },
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

<style scoped>
.error-text {
  color: red;
}
</style>