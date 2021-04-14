<template>
  <div id="login-form">
    <v-form @submit.prevent="login">
      <v-container>
        <h3 class="form-heading">Log Into Your Account</h3>
        <div class="error-text" v-if="error">{{ error }}</div>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="form.email"
              label="E-mail*"
              type="email"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="form.password"
              label="Password*"
              type="password"
              required
            ></v-text-field>
            <v-btn type="submit" id="login-btn">Login</v-btn>
            <router-link
              v-for="link in links"
              :key="link.name"
              :to="link.path"
              class="login__registration-link"
            >
              {{ link.name }}
            </router-link>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </div>
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
#login-form {
  padding: 5rem 10rem;
  width: 100%;
}
.form-heading {
  padding-bottom: 2.5rem;
}

#login-btn {
  float: right;
  background-color: rgb(109, 109, 255);
  color: #fff;
}

.error-text {
  margin: auto;
  margin-bottom: 2rem;
  padding: 0.3rem;
  color: rgb(255, 73, 73);
  border: 1px solid rgb(255, 73, 73);
  font-size: 1rem;
  font-weight: 500;
  text-align: center;
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