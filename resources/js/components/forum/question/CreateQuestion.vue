<template>
  <v-container class="mx-auto">
    <v-btn text class="pt-4">
      <router-link
        :key="links[0].name"
        :to="links[0].path"
        class="grey--text lighten-3 mb-4 create__forum-link"
      >
        <v-icon>mdi-arrow-left-circle</v-icon>
        {{ links[0].name }}
      </router-link>
    </v-btn>
    <v-form @submit.prevent="createQuestion">
      <v-row class="justify-center">
        <v-col cols="12" md="8">
          <h3 class="text-center mb-4">Ask Question</h3>

          <span class="error-text" v-if="errors.title">
            {{ errors.title[0] }}
          </span>
          <v-text-field
            outlined
            v-model="form.title"
            label="Question*"
            type="text"
            required
            class="mt-2"
          ></v-text-field>

          <span class="error-text" v-if="errors.category_id">
            {{ errors.category_id[0] }}
          </span>
          <v-select
            :items="categories"
            item-text="name"
            item-value="id"
            v-model="form.category_id"
            label="Category*"
            required
            dense
            outlined
            class="mt-2"
          ></v-select>

          <span class="error-text" v-if="errors.body">
            {{ errors.body[0] }}
          </span>
          <vue-simplemde
            v-model="form.body"
            ref="markdownEditor"
            label="More About Your Question"
            class="mt-2"
          />

          <v-btn type="submit" id="submit-btn" class="blue darken-1"
            >Send Question</v-btn
          >
        </v-col>
      </v-row>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      errors: {},
      links: [{ path: "/forum", name: "Forum" }],
      form: {
        title: "",
        category_id: null,
        body: null,
      },
    };
  },
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
    axios
      .get("/api/category")
      .then((response) => {
        this.categories = response.data.data;
      })
      // --------- token expired ---------
      .catch((error) => Exception.handle(error));
  },
  methods: {
    createQuestion() {
      axios
        .post("/api/question", this.form)
        .then((response) => {
          this.$router.push(response.data.path);
          this.errors = {};
        })
        // // --------- token expired ---------
        // .catch((error) => Exception.handle(error));
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>

<style scoped>
#submit-btn {
  float: right;
  background-color: rgb(109, 109, 255);
  color: #fff;
}
.error-text {
  color: red;
}
.create__forum-link {
  text-decoration: none;
  color: rgb(49, 49, 49);
  font-size: 1rem;
  padding-left: 0;
}
.create__forum-link:hover {
  color: rgb(41, 41, 41);
}
</style>