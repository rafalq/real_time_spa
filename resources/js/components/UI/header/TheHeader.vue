  <template>
  <v-toolbar dense>
    <v-toolbar-title>Laravel Forum</v-toolbar-title>

    <v-spacer></v-spacer>
    <app-link
      v-for="link in links"
      :key="link.name"
      :link-path="link.path"
      :link-title="link.name"
      class="hide"
      :class="{ display: link.show }"
    ></app-link>
  </v-toolbar>
</template>

<script>
import AppLink from "../links/AppLink.vue";
export default {
  components: { AppLink },
  data() {
    return {
      links: [
        { path: "/forum", name: "Forum", show: true },
        { path: "/ask", name: "Ask", show: User.loggedIn() },
        { path: "/category", name: "Category", show: User.loggedIn() },
        { path: "/logout", name: "Logout", show: User.loggedIn() },
        { path: "/login", name: "Login", show: !User.loggedIn() },
        { path: "/register", name: "Register", show: !User.loggedIn() },
      ],
    };
  },
  created() {
    EventBus.$on("logout", () => {
      User.logout();
    });
  },
};
</script>
<style scoped>
.hide {
  display: none;
}
.display {
  display: inline-block;
}
</style>