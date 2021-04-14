<template>
  <show-question :question-data="question"></show-question>
</template>

<script>
import ShowQuestion from "./ShowQuestion.vue";

export default {
  components: { ShowQuestion },
  props: ["questionData"],
  data() {
    return {
      question: {},
    };
  },
  created() {
    axios
      .get(`/api/question/${this.$route.params.slug}`)
      .then((response) => (this.question = response.data.data))
      .catch((error) => console.error(error.response.data));
  },
};
</script>t