<template>
  <v-container class="mx-auto">
    <v-btn
      text
      class="red--text lighten-3 mb-4"
      type="button"
      @click="cancelEditQuestionMode"
    >
      <v-icon class="mr-1">mdi-close-circle-outline</v-icon>
      Cancel
    </v-btn>

    <v-form @submit.prevent="updateQuestion">
      <v-row class="justify-center">
        <v-col cols="12" md="8">
          <span class="error-text" v-if="errors.title">
            {{ errors.title[0] }}
          </span>
          <v-text-field
            outlined
            v-model.lazy="form.title"
            label="Title*"
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
            v-model.lazy="form.body"
            ref="markdownEditor"
            class="mt-2"
          />
        </v-col>

        <v-col cols="12" md="8">
          <v-btn type="submit" id="submit-btn" class="primary white--tezt"
            >Update Question</v-btn
          >
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
        body: "",
      },
    };
  },
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
    this.form = this.questionData;
  },
  methods: {
    updateQuestion() {
      axios
        .patch(`/api/question/${this.form.slug}`, this.form)
        .then((response) => {
          this.errors = {};
          this.cancelEditQuestionMode();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },

    cancelEditQuestionMode() {
      location.reload();
    },
  },
};
</script>

<style scoped>
#submit-btn {
  float: right;
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