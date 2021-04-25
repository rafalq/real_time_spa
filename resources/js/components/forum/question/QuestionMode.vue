<template>
  <div v-if="question">
    <edit-question-mode
      v-if="editMode"
      :question-data="question"
    ></edit-question-mode>
    <show-question-mode v-else :question-data="question"></show-question-mode>
  </div>
</template>

<script>
import EditQuestionMode from "./mode/EditQuestionMode.vue";
import ShowQuestionMode from "./mode/ShowQuestionMode.vue";

export default {
  components: { EditQuestionMode, ShowQuestionMode },
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
      EventBus.$on("start-edit", () => (this.editMode = true));
      // EventBus.$on("cancel-edit", () => (this.editMode = false));
    },
  },
};
</script>t