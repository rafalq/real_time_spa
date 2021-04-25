<template>
  <v-dialog
    v-model="dialog"
    max-width="30rem"
    transition="dialog-bottom-transition"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        icon
        dark
        v-bind="attrs"
        v-on="on"
        @click="$emit('open-dialog', (dialog = true))"
      >
        <v-icon class="green--text lighten-2 mr-3"
          >mdi-circle-edit-outline</v-icon
        >
      </v-btn>
    </template>
    <v-card>
      <v-form @submit.prevent="submitReplyInput">
        <v-toolbar dark color="primary">
          <v-btn icon dark @click="dialog = false">
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
                <vue-simplemde v-model="dialogReplyBodyValue" class="mt-2" />
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-form>
    </v-card>
  </v-dialog>
</template>


<script>
export default {
  props: ["replyId", "error", "dialogReplyBodyValue"],
  emits: ["update-reply", "close-dialog", "set-reply-input"],
  data() {
    return {
      dialog: false,
    };
  },
  methods: {
    submitReplyInput() {
      const enteredInput = this.$refs.replyInput.value;
      this.$emit("update-reply", this.replyId, enteredInput);
      console.log(enteredInput);
      this.dialog = false;
    },
  },
};
</script>