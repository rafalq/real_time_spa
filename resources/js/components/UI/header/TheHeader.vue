  <template>
  <v-toolbar dense>
    <v-toolbar-title>Laravel Forum</v-toolbar-title>

    <v-spacer></v-spacer>
    <navbar-link
      v-for="link in links"
      :key="link.name"
      :link-path="link.path"
      :link-title="link.name"
    ></navbar-link>
  </v-toolbar>
</template>

<script>
import NavbarLink from "../navbar/NavbarLink.vue";
export default {
  components: { NavbarLink },
  data() {
    return {
      links: [
        { path: "/forum", name: "Forum" },
        { path: "/ask", name: "Ask" },
        { path: "/category", name: "Category" },
        { path: "/login", name: "Login" },
        { path: "/register", name: "Register" },
      ],
    };
  },
};
</script>