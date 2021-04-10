<template>
  <div>
    <the-header></the-header>
    <router-view></router-view>
    <the-footer></the-footer>
  </div>
</template>

<script>
import TheHeader from "./UI/header/TheHeader";
// import Login from "./login/Login";
import TheFooter from "./UI/footer/TheFooter";

export default {
  components: { TheHeader, TheFooter },
};
</script>
