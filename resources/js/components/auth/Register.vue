<template>
  <div>
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
        <router-link
          :key="links[1].name"
          :to="links[1].path"
          class="registration__snackbar-link"
        >
          {{ links[1].name }}
        </router-link>
        <v-btn text v-bind="attrs" @click="snackbar = false" relative top right>
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </template>
    </v-snackbar>

    <v-row class="justify-center py-10">
      <v-col cols="12" md="6">
        <v-form @submit.prevent="register">
          <h3 class="text-center mb-4">Create New Account</h3>

          <span class="error-text" v-if="errors.name">
            {{ errors.name[0] }}
          </span>
          <v-text-field
            outlined
            v-model="form.name"
            label="Name*"
            type="text"
            required
          ></v-text-field>

          <span class="error-text" v-if="errors.email">
            {{ errors.email[0] }}
          </span>
          <v-text-field
            outlined
            v-model="form.email"
            label="Email*"
            type="email"
            required
          ></v-text-field>

          <span class="error-text" v-if="errors.password">
            {{ errors.password[0] }}
          </span>
          <v-text-field
            outlined
            v-model="form.password"
            label="Password*"
            type="password"
            required
          ></v-text-field>

          <span class="error-text" v-if="errors.password_confirmation">
            {{ errors.password_confirmation[0] }}
          </span>
          <v-text-field
            outlined
            v-model="form.password_confirmation"
            label="Confirm Password*"
            type="password"
            required
          ></v-text-field>

          <v-col cols="12">
            <v-row>
              <v-col cols="12" md="6">
                <router-link
                  :key="links[0].name"
                  :to="links[0].path"
                  class="registration__login-link"
                >
                  {{ links[0].name }}
                </router-link>
              </v-col>
              <v-spacer></v-spacer>
              <v-col cols="12" md="6">
                <v-btn type="submit" id="register-btn" class="blue darken-1"
                  >Register</v-btn
                >
              </v-col>
            </v-row>
          </v-col>
        </v-form>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
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
#register-btn {
  float: right;
  background-color: rgb(109, 109, 255);
  color: #fff;
}

.error-text {
  color: red;
}
.registration__login-link {
  margin-top: 1rem;
  padding: 1rem;
  text-decoration: none;
  color: rgb(49, 49, 49);
  font-size: 0.8rem;
  padding-left: 0;
}
.registration__login-link:hover {
  color: rgb(41, 41, 41);
}

.registration__snackbar-link {
  padding-left: 0.5rem;
  padding-right: 0.5rem;
  text-decoration: none;
  color: #4caf50;
  font-size: 1rem;
}
.registration__snackbar-link:hover {
  color: #428b44;
}
</style>