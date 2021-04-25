<template>
  <v-card class="mx-auto mt-6">
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
    selection: 1,
    loginLink: "/login",
  }),

  methods: {
    // reserve() {
    //   this.loading = true;
    //   setTimeout(() => (this.loading = false), 2000);
    // },
  },
};
</script>

<style scoped>
.no-decoration {
  text-decoration: none;
}
</style>