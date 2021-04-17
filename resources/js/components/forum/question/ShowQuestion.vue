<template>
  <v-container>
    <v-row justify="space-around">
      <v-col cols="12" md="8">
        <v-card>
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
                  {{ questionData.created_at }}
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
                    color="primary"
                    class="mr-2"
                    @click="editQuestion"
                  >
                    <v-icon>mdi-pen</v-icon>
                  </v-btn>
                </template>
                <span>Edit</span>
              </v-tooltip>

              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    icon
                    v-bind="attrs"
                    v-on="on"
                    color="error"
                    class="mr-2"
                    @click="deleteQuestion"
                  >
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </template>
                <span>Delete</span>
              </v-tooltip>
            </v-card-actions>
          </v-app-bar>
          <v-card-title class="mt-4">
            <div class="text-h6 blue-grey--text darken-4">
              {{ questionData.title }}
            </div>
          </v-card-title>
          <v-card-text v-html="body" class="pt-1"> </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" md="4">
        <v-card>
          <v-card-text>
            <v-timeline align-top dense>
              <v-timeline-item
                v-for="message in messages"
                :key="message.time"
                :color="message.color"
                small
              >
                <div>
                  <div class="font-weight-normal">
                    <strong>{{ message.from }}</strong> @{{ message.time }}
                  </div>
                  <div>{{ message.message }}</div>
                </div>
              </v-timeline-item>
            </v-timeline>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  props: ["questionData"],
  data() {
    return {
      own: User.own(this.questionData.user_id),
      messages: [
        {
          from: "You",
          message: `Sure, I'll see you later.`,
          time: "10:42am",
          color: "deep-purple lighten-1",
        },
        {
          from: "John Doe",
          message: "Yeah, sure. Does 1:00pm work?",
          time: "10:37am",
          color: "green",
        },
        {
          from: "You",
          message: "Did you still want to grab lunch today?",
          time: "9:47am",
          color: "deep-purple lighten-1",
        },
      ],
    };
  },
  computed: {
    body() {
      if (this.questionData.body !== null) {
        return marked.parse(this.questionData.body);
      }
    },
  },
  methods: {
    editQuestion() {
      EventBus.$emit("startEdit");
    },
    deleteQuestion() {
      axios
        .delete(`/api/question/${this.questionData.slug}`)
        .then((response) => {
          this.$router.push("/forum");
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
};
</script>