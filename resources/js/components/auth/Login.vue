<template>
  <v-row class="justify-center py-10">
    <v-col cols="12" md="6">
      <v-form @submit.prevent="login">
        <h3 class="text-center mb-4">Log Into Your Account</h3>

        <div class="error-text mt-2" v-if="error">
          <v-icon class="error-icon">mdi-alert-circle-outline</v-icon>
          {{ error }}
        </div>

        <v-text-field
          outlined
          v-model="form.email"
          label="Email*"
          type="email"
        ></v-text-field>

        <v-text-field
          outlined
          v-model="form.password"
          label="Password*"
          type="password"
        ></v-text-field>

        <v-col cols="12">
          <v-row>
            <v-col cols="12" md="6">
              <router-link
                :key="links[0].name"
                :to="links[0].path"
                class="login__registration-link"
              >
                {{ links[0].name }}
              </router-link>
            </v-col>
            <v-spacer></v-spacer>
            <v-col cols="12" md="6">
              <v-btn type="submit" id="login-btn" color="blue darken-1"
                >Login</v-btn
              >
            </v-col>
          </v-row>
        </v-col>
      </v-form>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      error: "",
      links: [{ path: "/register", name: "No Account? REGISTER" }],
      form: {
        email: "",
        password: "",
      },
    };
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    login() {
      axios
        .post("/api/auth/login", this.form)
        .then((response) => {
          User.responseAfterLogin(response);
          this.errors = "";
        })
        .catch((error) => {
          this.error = error.response.data.error;
          this.form.password = "";
        });
    },
  },
};
</script>

<style scoped>
#login-btn {
  float: right;
  background-color: rgb(109, 109, 255);
  color: #fff;
}

.error-text {
  margin: 0;
  margin-bottom: 1.5rem;
  padding: 0.8rem;
  color: rgb(255, 73, 73);
  border: 1px solid rgb(255, 73, 73);
  font-size: 1rem;
  text-align: center;
}

.error-icon {
  color: rgb(255, 73, 73);
  margin-right: 0.5rem;
}

.login__registration-link {
  margin-top: 1rem;
  padding: 1rem;
  text-decoration: none;
  color: rgb(49, 49, 49);
  font-size: 0.8rem;
  padding-left: 0;
}
.login__registration-link:hover {
  color: rgb(41, 41, 41);
}
</style>