<template>
  <v-card :loading="loading" class="mx-auto mt-6">
    <template slot="progress">
      <v-progress-linear
        color="deep-purple"
        height="10"
        indeterminate
      ></v-progress-linear>
    </template>
    <v-card-title class="d-flex flex-column">
      <div>
        <router-link :to="questionData.path" class="read-link black--text">
          {{ questionData.title }}
        </router-link>
      </div>
      <div class="mt-2">
        <v-row align="center" class="mx-0 mt-1">
          <v-icon color="blue lighten-2" size="16">mdi-thumb-up</v-icon>
          <div class="grey--text ml-1 subtitle-2">415</div>
        </v-row>
      </div>
    </v-card-title>
    <v-card-text>
      <div class="mb-4 subtitle-1 ml-6">
        <span class="caption">by</span>
        {{ questionData.user }} •
        <span class="caption">{{ questionData.created_at }}</span>
      </div>
      <div class="d-flex flex-row-reverse blue--text darken-4">
        <router-link
          :to="questionData.path"
          class="read-link blue lighten-4 px-2"
        >
          Read More...
        </router-link>
      </div>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["questionData"],
  data: () => ({
    loading: false,
    selection: 1,
  }),

  methods: {
    reserve() {
      this.loading = true;

      setTimeout(() => (this.loading = false), 2000);
    },
  },
};
</script>

<style scoped>
.read-link {
  text-decoration: none;
}
</style>