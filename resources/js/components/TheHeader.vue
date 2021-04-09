  <template>
  <v-card color="grey lighten-4" flat height="200px" tile>
    <v-toolbar dense>
      <v-toolbar-title>Laravel Forum</v-toolbar-title>

      <v-spacer></v-spacer>

      <navbar-link
        v-for="link in navbarLinks"
        :key="link.iconName"
        :icon-name="link.iconName"
        :tooltip-title="link.tooltipTitle"
      >
      </navbar-link>
    </v-toolbar>
  </v-card>
</template>

<script>
import NavbarLink from "./NavbarLink.vue";
export default {
  components: { NavbarLink },
  data() {
    return {
      navbarLinks: [
        {
          iconName: "mdi-forum",
          tooltipTitle: "Forum",
        },
        {
          iconName: "mdi-comment-question",
          tooltipTitle: "Ask Question",
        },
        {
          iconName: "mdi-shape",
          tooltipTitle: "Category",
        },
        {
          iconName: "mdi-login",
          tooltipTitle: "Login",
        },
        {
          iconName: "mdi-account-plus",
          tooltipTitle: "Register",
        },
      ],
    };
  },
};
</script>