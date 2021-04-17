<template>
  <div>
    <v-chip label class="grey lighten-1 ma-1 py-0">
      <div class="d-flex">
        <span class="my-1 mx-2">
          {{ name }}
        </span>
      </div>
    </v-chip>
  </div>
</template>

<script>
export default {
  props: ["name"],
};
</script>