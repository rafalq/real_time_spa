<template>
  <v-card
    class="mx-auto mt-6"
    :class="{
      'user-own-identifier': loggedIn && userOwn(questionData.user_id),
    }"
  >
    <template slot="progress">
      <v-progress-linear
        color="deep-purple"
        height="10"
        indeterminate
      ></v-progress-linear>
    </template>
    <v-card-title class="d-flex flex-column">
      <router-link
        :to="questionData.path"
        class="no-decoration blue-grey--text darken-4"
      >
        {{ questionData.title }}
      </router-link>
      <div class="mt-2">
        <v-row align="center" class="mx-0 mt-1">
          <v-icon color="blue" size="16">mdi-tag</v-icon>
          <div class="grey--text ml-1 subtitle-2">
            {{ questionData.category }}
          </div>
        </v-row>
      </div>
    </v-card-title>
    <v-card-text>
      <div class="mb-4 subtitle-1 ml-6">
        <span class="caption">by</span>
        {{ questionData.user_name }} •
        <span class="caption">{{ questionData.updated_at }}</span>
      </div>
      <div class="d-flex flex-row-reverse">
        <router-link
          :to="questionData.path"
          class="blue--text lighten-3 mb-4 no-decoration"
          ><v-btn text class="py-2 caption"> Read More... </v-btn>
        </router-link>
      </div>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["questionData"],
  data: () => ({
    loggedIn: User.loggedIn(),
    selection: 1,
    loginLink: "/login",
  }),

  methods: {
    userOwn(userId) {
      if (User.own(userId)) {
        return true;
      }
      return false;
    },
  },
};
</script>

<style scoped>
.no-decoration {
  text-decoration: none;
}
.user-own-identifier {
  border: 0.1rem solid green;
}
</style>