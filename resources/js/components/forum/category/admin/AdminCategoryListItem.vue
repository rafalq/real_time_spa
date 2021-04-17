<template>
  <div>
    <v-chip label class="grey lighten-1 ma-1 py-0">
      <div class="d-flex">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              icon
              v-bind="attrs"
              v-on="on"
              @click="$emit('edit')"
              class="green--text lighten-2"
            >
              mdi-update
            </v-icon>
          </template>
          <span>Edit Category</span>
        </v-tooltip>

        <span class="my-1 mx-2">
          {{ name }}
        </span>

        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              v-bind="attrs"
              v-on="on"
              @click="$emit('delete')"
              class="red--text lighten-2"
            >
              mdi-delete-outline
            </v-icon>
          </template>
          <span>Delete Category</span>
        </v-tooltip>
      </div>
    </v-chip>
  </div>
</template>

<script>
export default {
  props: ["name"],
  emits: ["edit", "delete"],
};
</script>