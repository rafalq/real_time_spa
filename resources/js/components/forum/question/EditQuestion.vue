<template>
  <v-container class="mx-auto">
    <v-btn text class="red--text lighten-3 mb-4" @click="cancelEdit">
      <v-icon class="mr-1">mdi-close-circle-outline</v-icon>
      Cancel
    </v-btn>

    <v-form @submit.prevent="updateQuestion">
      <v-row class="justify-center">
        <v-col cols="12" md="8">
          <h3 class="text-center">Update Question</h3>
        </v-col>

        <v-col cols="12" md="8">
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
        </v-col>

        <v-col cols="12" md="8">
          <span class="error-text" v-if="errors.body">
            {{ errors.body[0] }}
          </span>
          <vue-simplemde
            v-model="form.body"
            ref="markdownEditor"
            label="More About Your Question"
            class="mt-2"
          />
        </v-col>

        <v-col cols="12" md="8">
          <v-btn type="submit" id="submit-btn">Submit</v-btn>
        </v-col>
      </v-row>
    </v-form>
  </v-container>
</template>

<script>
export default {
  props: ["questionData"],
  data() {
    return {
      errors: {},
      form: {
        title: "",
        body: "",
      },
    };
  },
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    updateQuestion() {
      axios
        .patch(`/api/question/${this.form.slug}`, this.form)
        .then((response) => {
          this.cancelEdit();
          this.errors = {};
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
    cancelEdit() {
      EventBus.$emit("cancelEdit");
    },
  },
  mounted() {
    this.form = this.questionData;
  },
};
</script>

<style scoped>
@import "~simplemde/dist/simplemde.min.css";

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
.create__forum-linkk:hover {
  color: rgb(41, 41, 41);
}
</style>