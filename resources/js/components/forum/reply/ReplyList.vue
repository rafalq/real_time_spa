te<template>
  <div v-if="repliesData">
    <reply-item
      v-for="reply in repliesData"
      :key="reply.id"
      :reply-id="reply.id"
      :reply-user-name="reply.user"
      :reply-date="reply.updated_at"
      :reply-body="parseReplyBody(reply.reply)"
    >
      <div class="d-flex">
        <div>
          <like-reply :reply-data="reply"></like-reply>
        </div>
        <v-spacer></v-spacer>
        <div v-if="userOwn(reply.user_id)">
          <v-dialog
            v-model="replyDialog"
            max-width="30rem"
            transition="dialog-bottom-transition"
            :retain-focus="false"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                icon
                dark
                v-bind="attrs"
                v-on="on"
                @click="openUpdateReplyDialog(reply.id)"
              >
                <v-icon class="green--text lighten-2 mr-3"
                  >mdi-circle-edit-outline</v-icon
                >
              </v-btn>
            </template>
            <v-card>
              <v-form
                v-if="replyDialog"
                @submit.prevent="updateReply(reply.id)"
              >
                <v-toolbar dark color="primary">
                  <v-btn icon dark @click="closeUpdateReplyDialog(reply.id)">
                    <v-icon>mdi-close</v-icon>
                  </v-btn>
                  <v-spacer></v-spacer>
                  <v-toolbar-items>
                    <v-btn dark text type="submit"> Update Reply</v-btn>
                  </v-toolbar-items>
                </v-toolbar>

                <v-card-text>
                  <v-container fill-height>
                    <v-row>
                      <v-col cols="12">
                        <span class="error-text" v-if="error">
                          {{ error }}
                        </span>
                        <vue-simplemde
                          v-model="dialogReplyInput.body"
                          class="mt-2"
                        />
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>
              </v-form>
            </v-card>
          </v-dialog>
          <delete-reply
            @delete-reply="removeReply(reply.id, reply.reply)"
          ></delete-reply>
        </div>
      </div>
    </reply-item>
  </div>
</template>

<script>
import LikeReply from "../likes/LikeReply.vue";
import DeleteReply from "./actions/DeleteReply.vue";
// import EditReply from "./actions/EditReply.vue";
import ReplyItem from "./ReplyItem.vue";
export default {
  components: {
    // EditReply,
    DeleteReply,
    ReplyItem,
    LikeReply,
  },
  props: ["question"],
  created() {
    this.listen();
  },
  // computed: {
  //   updatedDialogReplyInput() {
  //     return this.$store.state.dialogReplyInput;
  //   },
  // },
  data() {
    return {
      questionData: this.question,
      repliesData: this.question.replies,
      cachedDialogReplyInput: {
        id: null,
        body: "",
        index: null,
      },
      dialogReplyInput: {
        id: null,
        body: "",
        index: null,
      },
      error: null,
      replyDialog: false,
      // replyInput: null,
    };
  },
  methods: {
    listen() {
      EventBus.$on("new-reply", (reply) => {
        this.repliesData.unshift(reply);
      });
    },
    userOwn(userId) {
      if (User.own(userId)) {
        return true;
      }
      return false;
    },
    parseReplyBody(replyBody) {
      return marked.parse(replyBody);
    },
    removeReply(replyId) {
      const replyIndex = this.repliesData.findIndex(
        (reply) => reply.id === replyId
      );
      axios
        .delete(
          `/api/question/${this.questionData.slug}/reply/${this.repliesData[replyIndex].id}`
        )
        .then((response) => {
          this.repliesData.splice(replyIndex, 1);
          EventBus.$emit("update-reply-counter-remove");
        })
        .catch((error) => {
          console.log((this.error = error.response.data));
        });
    },
    updateReply(replyId) {
      const replyIndex = this.repliesData.findIndex(
        (reply) => reply.id === replyId
      );
      axios
        .patch(
          `/api/question/${this.questionData.slug}/reply/${this.dialogReplyInput.id}`,
          { body: this.dialogReplyInput.body }
        )
        .then((response) => {
          this.repliesData[
            this.cachedDialogReplyInput.index
          ].reply = this.dialogReplyInput.body;
          this.replyDialog = false;
        })
        .catch((error) => {
          console.log((this.error = error));
        });
    },

    openUpdateReplyDialog(replyId) {
      this.replyDialog = true;

      let replyIndex = this.repliesData.findIndex(
        (reply) => reply.id === replyId
      );

      this.dialogReplyInput.id = this.repliesData[replyIndex].id;
      this.dialogReplyInput.body = this.repliesData[replyIndex].reply;
      this.dialogReplyInput.index = replyIndex;

      this.cachedDialogReplyInput.id = this.repliesData[replyIndex].id;
      this.cachedDialogReplyInput.body = this.repliesData[replyIndex].reply;
      this.cachedDialogReplyInput.index = replyIndex;
    },
    closeUpdateReplyDialog() {
      this.dialogReplyInput.id = this.cachedDialogReplyInput.id;
      this.dialogReplyInput.body = this.cachedDialogReplyInput.body;
      this.dialogReplyInput.index = this.cachedDialogReplyInput.index;

      this.cachedDialogReplyInput.id = null;
      this.cachedDialogReplyInput.body = "";
      this.cachedDialogReplyInput.index = null;

      this.replyDialog = false;
    },
  },
};
</script>