<template>
  <v-container>
    <router-link to="/forum" class="question__forum-link">
      <v-btn text @click="cancelEdit" class="grey--text lighten-3 mb-4">
        <v-icon class="mr-1">mdi-arrow-left-circle</v-icon>
        FORUM
      </v-btn>
    </router-link>

    <v-row justify="space-around">
      <v-col cols="12" md="8">
        <v-card
          :class="{ 'user-own-identifier': userOwn(questionData.user_id) }"
        >
          <v-app-bar flat color="rgba(0, 0, 0, 0)" class="pt-4">
            <v-avatar size="50">
              <img
                alt="user"
                src="https://cdn.pixabay.com/photo/2020/06/24/19/12/cabbage-5337431_1280.jpg"
              />
            </v-avatar>

            <v-toolbar-title class="title pl-0">
              <div class="d-flex flex-column ml-3">
                <p class="mb-0 mt-4 blue-grey--text darken-3">
                  {{ questionData.user_name }}
                </p>
                <p class="grey--text darken-4 caption">
                  {{ questionData.updated_at }}
                </p>
              </div>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <v-card-actions v-if="own">
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    icon
                    v-bind="attrs"
                    v-on="on"
                    color="green--text lighten-2"
                    class="mr-2 green--text lighten-2"
                    @click="editQuestion"
                  >
                    <v-icon>mdi-circle-edit-outline</v-icon>
                  </v-btn>
                </template>
                <span>Edit Question</span>
              </v-tooltip>

              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    icon
                    v-bind="attrs"
                    v-on="on"
                    class="mr-2 red--text lighten-2"
                    @click="deleteQuestion"
                  >
                    <v-icon>mdi-delete-outline</v-icon>
                  </v-btn>
                </template>
                <span>Delete Question</span>
              </v-tooltip>
            </v-card-actions>
          </v-app-bar>
          <v-card-title class="mt-4">
            <div class="text-h6">
              {{ questionData.title }}
            </div>
          </v-card-title>
          <v-card-text v-html="body" class="pt-1"> </v-card-text>
          <div class="pa-0">
            <v-dialog
              v-model="dialog"
              max-width="30rem"
              transition="dialog-bottom-transition"
            >
              <template v-slot:activator="{ on, attrs }">
                <div class="d-flex flex-row-reverse pa-4 pt-0">
                  <v-btn color="primary" dark v-bind="attrs" v-on="on">
                    <span class="white--text">Reply</span>
                  </v-btn>
                </div>
              </template>
              <v-card>
                <v-form ref="replyForm" @submit.prevent="submitReply">
                  <v-toolbar dark color="primary">
                    <v-btn icon dark @click="closeDialog">
                      <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-spacer></v-spacer>

                    <v-toolbar-items>
                      <v-btn dark text @click="submitReply"> Send Reply </v-btn>
                    </v-toolbar-items>
                  </v-toolbar>

                  <v-card-text>
                    <v-container fill-height>
                      <v-row class="justify-center">
                        <v-col cols="12">
                          <span class="error-text" v-if="errors.body">
                            {{ errors.body[0] }}
                          </span>
                          <vue-simplemde
                            v-model="formBody"
                            ref="replyBody"
                            class="mt-2"
                          />
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-card-text>
                </v-form>
              </v-card>
            </v-dialog>
          </div>
        </v-card>
      </v-col>
      <v-col cols="12" md="8">
        <v-card>
          <v-card-text class="mt-4">
            {{ updatedCounterReply }} replies from users
          </v-card-text>
          <v-card-text class="py-0">
            <reply-list :question="questionData"></reply-list>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import ReplyList from "../../reply/ReplyList.vue";

export default {
  props: ["questionData"],
  components: { ReplyList },
  emits: ["start-edit", "cancel-edit"],
  data() {
    return {
      own: User.own(this.questionData.user_id),
      replyCount: null,
      questionSlug: this.questionData.slug,
      formBody: "",
      dialog: false,
      errors: {},
    };
  },
  computed: {
    body() {
      if (this.questionData.body !== null) {
        return marked.parse(this.questionData.body);
      }
    },
    replyBody() {
      return marked.parse(this.replyData.reply);
    },
    updatedCounterReply() {
      return this.replyCount;
    },
  },

  methods: {
    listenReplyDeleted() {
      EventBus.$on("update-reply-counter-remove", () => {
        return this.replyCount--;
      });
    },
    listenReplyCreated() {
      EventBus.$on("update-reply-counter-added", () => {
        return this.replyCount++;
      });
      EventBus.$on("new-reply", () => {
        return this.replyCount++;
      });
    },
    closeDialog() {
      this.formBody = "";
      this.errors = {};
      this.dialog = false;
    },
    editQuestion() {
      EventBus.$emit("start-edit");
    },
    cancelEdit() {
      EventBus.$emit("cancel-edit");
    },
    deleteQuestion() {
      axios
        .delete(`/api/question/${this.questionSlug}`)
        .then((response) => {
          this.$router.push("/forum");
        })
        // // --------- token expired ---------
        // .catch((error) => Exception.handle(error));
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    submitReply() {
      axios
        .post(`/api/question/${this.questionSlug}/reply`, {
          body: this.formBody,
        })
        .then((response) => {
          EventBus.$emit("new-reply", response.data.reply);
          this.formBody = "";
          this.$refs.replyBody.simplemde.value(this.formBody);
          this.errors = {};
          this.dialog = false;
        })
        // // --------- token expired ---------
        // .catch((error) => Exception.handle(error));
        .catch((error) => (this.errors = error.response.data.errors));
    },
    userOwn(userId) {
      if (User.own(userId)) {
        return true;
      }
      return false;
    },
  },
  mounted() {
    setTimeout(() => (this.overlay = false), 1000);
    this.question = this.questionData;
    this.replyCount = this.questionData.reply_count;
    this.listenReplyDeleted();
    this.listenReplyCreated();
    // -------------------- counter --------------------
    // Echo.private("notify-" + User.getId()).notification((notification) => {
    //   this.replyCount++;
    // });
  },
};
</script>

<style scoped>
.user-own-identifier {
  border: 0.1rem solid green;
}
.question__forum-link {
  text-decoration: none;
}
.error-text {
  color: red;
}
</style>