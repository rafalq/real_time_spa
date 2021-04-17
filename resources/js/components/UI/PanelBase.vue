<template>
  <v-expansion-panels>
    <v-expansion-panel>
      <v-expansion-panel-header class="grey lighten-2">
        <slot name="header"></slot>
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <slot></slot>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script>
export default {};
</script>