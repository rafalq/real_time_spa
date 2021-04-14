<template>
  <v-container id="login-form" class="mx-auto">
    <v-form @submit.prevent="login">
      <v-row class="justify-center">
        <v-col cols="12" md="10">
          <h3 class="text-center">Log Into Your Account</h3>
        </v-col>
        <v-col cols="12" md="10" v-if="error">
          <div class="error-text">
            <v-icon class="error-icon">mdi-alert-circle-outline</v-icon>
            {{ error }}
          </div>
        </v-col>
        <v-col cols="12" md="10">
          <v-text-field
            outlined
            v-model="form.email"
            label="Email*"
            type="email"
          ></v-text-field>
        </v-col>

        <v-col cols="12" md="10">
          <v-text-field
            outlined
            v-model="form.password"
            label="Password*"
            type="password"
          ></v-text-field>
        </v-col>

        <v-col cols="12" md="10">
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
              <v-btn type="submit" id="login-btn">Submit</v-btn>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-form>
  </v-container>
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