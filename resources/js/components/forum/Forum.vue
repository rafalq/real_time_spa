<template>
  <div>
    <v-overlay :opacity="1" :value="overlay">
      <v-progress-circular indeterminate size="64">
        Loading...
      </v-progress-circular>
    </v-overlay>
    <v-container class="pa-6 mx-auto">
      <v-row justify-md="center">
        <v-col cols="12" md="8">
          <div @click="checkAuth">
            <question
              v-for="question in questions"
              :key="question.path"
              :question-data="question"
            ></question>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import Question from "./question/Question.vue";
export default {
  components: {
    Question,
  },
  mounted() {
    setTimeout(() => (this.overlay = false), 500);
    this.getAllQuestions();
  },
  data() {
    return {
      questions: {},
      overlay: true,
    };
  },
  methods: {
    checkAuth() {
      if (!User.loggedIn()) {
        this.$router.push({ name: "login" });
      }
    },

    getAllQuestions() {
      axios
        .get("/api/question")
        .then((response) => (this.questions = response.data.data))
        .catch((error) => console.error(error.response.data));
    },
  },
};
</script>