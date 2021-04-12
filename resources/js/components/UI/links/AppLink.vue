<template>
  <div class="nav-link-wrapper">
    <router-link :to="linkPath" class="nav-link">{{ linkTitle }}</router-link>
  </div>
</template>

<script>
export default {
  props: ["linkPath", "linkTitle"],
};
</script>

<style scoped>
.nav-link-wrapper {
  padding: 1rem;
}
.nav-link {
  text-decoration: none;
  color: rgb(82, 81, 81);
  font-size: 0.8rem;
}
.nav-link:hover {
  color: rgb(56, 56, 56);
}
</style>