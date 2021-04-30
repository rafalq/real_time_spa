  <template>
  <div id="parallax-wrapper">
    <v-app-bar app absolute color="blue darken-1" dark>
      <router-link class="nav-link" to="/"
        ><v-toolbar-title
          >Laravel Forum <v-icon>mdi-laravel</v-icon></v-toolbar-title
        >
      </router-link>
      <v-spacer></v-spacer>
      <reply-notification v-if="loggedIn"></reply-notification>
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
import ReplyNotification from "../forum/notification/ReplyNotification.vue";

export default {
  components: { ReplyNotification },
  data() {
    return {
      loggedIn: User.loggedIn(),
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
#parallax-wrapper {
  min-height: auto;
}
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