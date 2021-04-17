  <template>
  <div>
    <v-app-bar
      app
      :collapse="!collapseOnScroll"
      :collapse-on-scroll="collapseOnScroll"
      absolute
      color="blue darken-1"
      dark
    >
      <v-app-bar-nav-icon></v-app-bar-nav-icon>
      <v-toolbar-title>Laravel Forum</v-toolbar-title>
      <v-spacer></v-spacer>
      <router-link
        v-for="link in links"
        :key="link.name"
        :to="link.path"
        :class="{ display: link.show }"
        class="nav-link hide"
      >
        {{ link.name }}
      </router-link>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  data() {
    return {
      collapseOnScroll: true,
      links: [
        { path: "/forum", name: "Forum", show: true },
        { path: "/ask", name: "Ask", show: User.loggedIn() },
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
.nav-link {
  padding: 1rem;
  text-decoration: none;
  color: rgb(235, 235, 235);
}
.nav-link:hover {
  color: rgb(255, 255, 255);
}
.hide {
  display: none;
}
.display {
  display: inline-block;
}
</style>