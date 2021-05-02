  <template>
  <div id="parallax-wrapper">
    <v-app-bar app absolute color="blue darken-1" dark>
      <router-link class="nav-link" to="/">
        <v-toolbar-title>
          <span class="d-none d-md-inline">Laravel Forum</span>
          <v-icon>mdi-laravel</v-icon>
        </v-toolbar-title>
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
        <span class="d-none d-md-inline">{{ link.name }}</span>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon v-bind="attrs" v-on="on" class="d-sm-flex d-md-none"
              >mdi-{{ link.iconName }}</v-icon
            >
          </template>
          <span>{{ link.name }}</span>
        </v-tooltip>
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
        { path: "/forum", name: "Forum", iconName: "forum", show: true },
        {
          path: "/ask",
          name: "Ask",
          iconName: "help-box",
          show: User.loggedIn(),
        },
        {
          path: "/logout",
          name: "Logout",
          iconName: "logout",
          show: User.loggedIn(),
        },
        {
          path: "/login",
          name: "Login",
          iconName: "login",
          show: !User.loggedIn(),
        },
        {
          path: "/register",
          name: "Register",
          iconName: "account-plus",
          show: !User.loggedIn(),
        },
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