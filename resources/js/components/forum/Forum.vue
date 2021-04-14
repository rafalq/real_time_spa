<template>
  <v-container class="pa-6 mx-auto">
    <v-row>
      <v-col cols="12" md="8">
        <question
          v-for="question in questions"
          :key="question.path"
          :question-data="question"
        ></question>
      </v-col>
      <v-col class="d-none d-sm-flex">sidebar</v-col>
    </v-row>
  </v-container>
</template>

<script>
import Question from "./question/Question.vue";
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