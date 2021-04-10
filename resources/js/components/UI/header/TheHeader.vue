  <template>
  <v-toolbar dense>
    <v-toolbar-title>Laravel Forum</v-toolbar-title>

    <v-spacer></v-spacer>
    <navbar-base
      v-for="link in links"
      :key="link.name"
      :link-path="link.path"
      :link-title="link.name"
    ></navbar-base>
  </v-toolbar>
</template>

<script>
import NavbarBase from "../navbar/NavbarBase.vue";
export default {
  components: { NavbarBase },
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