<template>
  <v-tooltip bottom>
    <template v-slot:activator="{ on, attrs }">
      <v-icon
        v-bind="attrs"
        v-on="on"
        @click="$emit('delete-reply', replyId)"
        class="red--text lighten-2 ml-3"
      >
        mdi-delete-outline
      </v-icon>
    </template>
    <span>Delete Reply</span>
  </v-tooltip>
</template>

<script>
export default {
  props: ["replyId"],
  emits: ["delete-reply"],
};
</script>