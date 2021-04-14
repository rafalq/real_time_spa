<template>
  <v-container fluid grid-list-md class="pa-6">
    <v-layout row wrap>
      <v-flex xs12 md7>
        <v-card>
          <v-card-title class="mt-4">
            <div>
              <div class="text-h5 mb-4">
                {{ questionData.title }}
              </div>
              <div class="d-flex">
                <v-avatar size="50">
                  <img
                    alt="user"
                    src="https://cdn.pixabay.com/photo/2020/06/24/19/12/cabbage-5337431_1280.jpg"
                  />
                </v-avatar>
                <p class="grey--text ml-3 mt-3">{{ questionData.user }}</p>
              </div>
            </div>
          </v-card-title>

          <v-card-text>
            {{ questionData.body }}
            <div class="d-flex flex-row-reverse grey--text darken-4">
              {{ questionData.created_at }}
            </div>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex>
        <v-card>
          <v-card-text>
            <div class="font-weight-bold ml-8 mb-2">Today</div>

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
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  props: ["questionData"],
  data: () => ({
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
  }),
};
</script>