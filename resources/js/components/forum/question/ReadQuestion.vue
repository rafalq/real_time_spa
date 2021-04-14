<template>
  <div v-if="question">
    <edit-question v-if="editMode" :question-data="question"></edit-question>
    <show-question v-else :question-data="question"></show-question>
  </div>
</template>

<script>
import ShowQuestion from "./ShowQuestion.vue";
import EditQuestion from "./EditQuestion.vue";

export default {
  components: { ShowQuestion, EditQuestion },
  props: ["questionData"],
  data() {
    return {
      question: null,
      editMode: false,
    };
  },
  created() {
    this.getQuestion();
    this.listen();
  },
  methods: {
    getQuestion() {
      axios
        .get(`/api/question/${this.$route.params.slug}`)
        .then((response) => (this.question = response.data.data))
        .catch((error) => console.error(error.response.data));
    },
    listen() {
      EventBus.$on("startEdit", () => (this.editMode = true));
      EventBus.$on("cancelEdit", () => (this.editMode = false));
    },
  },
};
</script>t