<template>
  <div class="my-2">
    <div class="d-flex align-center">
      <v-btn
        color="primary"
        elevation="2"
        fab
        x-small
        icon
        dark
        @click="toggleLike"
      >
        <v-icon v-if="is_liked_by_user"> mdi-thumb-down-outline </v-icon>
        <v-icon v-else> mdi-thumb-up </v-icon>
      </v-btn>
      <div class="ml-2 red--text mr-11 font-weight-medium">
        <v-icon small class="red--text mr-1"> mdi-heart </v-icon
        >{{ updatedLikeCounter }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["replyData"],
  data() {
    return {
      is_liked_by_user: this.replyData.is_liked_by_user,
      likeCounter: this.replyData.like_counter,
    };
  },
  computed: {
    updatedLikeCounter() {
      return this.likeCounter;
    },
  },
  methods: {
    toggleLike() {
      if (User.loggedIn()) {
        this.is_liked_by_user ? this.unlikeReply() : this.likeReply();
        this.is_liked_by_user = !this.is_liked_by_user;
      }
    },
    likeReply() {
      axios
        .post(`/api/like/${this.replyData.id}`)
        .then((response) => this.likeCounter++)
        .catch((error) => {
          console.log((this.error = error.response.data));
        });
    },
    unlikeReply() {
      if (this.likeCounter > 0) {
        axios
          .delete(`/api/like/${this.replyData.id}`)
          .then((response) => this.likeCounter--)
          .catch((error) => {
            console.log((this.error = error.response.data));
          });
      }
    },
  },
};
</script>