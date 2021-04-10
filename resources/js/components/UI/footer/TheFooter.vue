<template>
  <div id="app-footer">
    <v-col class="text-center" cols="12">
      {{ new Date().getFullYear() }} — <strong>Laravel Forum</strong>
    </v-col>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
#app-footer {
  position: relative;
  bottom: 0;
  background-color: rgb(163, 163, 163);
  padding: 1rem 2rem;
}
</style>