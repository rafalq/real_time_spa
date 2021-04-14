<template>
  <v-container fluid grid-list-md class="pa-6">
    <v-layout row wrap>
      <v-flex xs10 md8>
        <h1 class="text-center grey--text">Questions</h1>
        <question
          v-for="question in questions"
          :key="question.path"
          :question-data="question"
        ></question>
      </v-flex>
      <v-flex>sidebar</v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Question from "./Question.vue";
export default {
  components: { Question },
  created() {
    axios
      .get("/api/question")
      .then((response) => (this.questions = response.data.data))
      .catch((error) => console.error(error.response.data));
  },
  data() {
    return {
      questions: {},
    };
  },
};
</script>