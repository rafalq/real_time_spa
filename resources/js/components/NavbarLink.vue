<template >
  <v-tooltip bottom>
    <template v-slot:activator="{ on, attrs }">
      <v-btn v-bind="attrs" v-on="on" icon>
        <v-icon>{{ iconName }}</v-icon>
      </v-btn>
    </template>
    <span>{{ tooltipTitle }}</span>
  </v-tooltip>
</template>

<script>
export default {
  props: ["iconName", "tooltipTitle"],
};
</script>
