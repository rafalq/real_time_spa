<template>
  <v-app>
    <div id="register-form">
      <v-form @submit.prevent="register">
        <v-container>
          <v-snackbar
            v-model="snackbar"
            :value="true"
            absolute
            centered
            bottom
            outlined
            color="success"
            elevation="24"
          >
            <template v-slot:action="{ attrs }">
              {{ text }}
              <app-link
                :link-path="links[1].path"
                :link-title="links[1].name"
                class="registration__login-link"
              ></app-link>
              <v-btn
                text
                v-bind="attrs"
                @click="snackbar = false"
                relative
                top
                right
              >
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </template>
          </v-snackbar>

          <h3 class="form-heading">Create New Account</h3>
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.name"
                name="name"
                label="Name*"
                type="text"
                required
              ></v-text-field>
              <span class="error-text" v-if="errors.name">
                {{ errors.name[0] }}
              </span>
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.email"
                name="email"
                label="E-mail*"
                type="email"
                required
              ></v-text-field>
              <span class="error-text" v-if="errors.email">
                {{ errors.email[0] }}
              </span>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.password"
                name="password"
                label="Password*"
                type="password"
                required
              ></v-text-field>
              <span class="error-text" v-if="errors.password">
                {{ errors.password[0] }}
              </span>
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.password_confirmation"
                label="Confirm Password*"
                type="password"
                required
              ></v-text-field>
              <v-btn type="submit" id="register-btn">Register</v-btn>
              <app-link
                :link-path="links[0].path"
                :link-title="links[0].name"
              ></app-link>
            </v-col>
          </v-row>
        </v-container>
      </v-form>
    </div>
  </v-app>
</template>

<script>
import AppLink from "../../UI/links/AppLink";
export default {
  components: { AppLink },
  data() {
    return {
      snackbar: false,
      text: `Registration succesfull. You can now`,
      errors: {},
      links: [
        { path: "/login", name: "Already Have An Account? LOGIN" },
        { path: "/login", name: "LOGIN" },
      ],
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    register() {
      axios
        .post("/api/auth/register", this.form)
        .then(() => {
          this.form = {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
          };
          this.errors = {};
        })
        .then(() => {
          this.snackbar = true;
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>

<style scoped>
#register-form {
  padding: 5rem 10rem;
  width: 100%;
}
.form-heading {
  padding-bottom: 2.5rem;
}

#register-btn {
  float: right;
  background-color: rgb(109, 109, 255);
  color: #fff;
}

.error-text {
  color: red;
}

.registration__login-link {
  padding: 0;
  margin-left: 0.3rem;
  margin-right: 0.3rem;
}
</style>