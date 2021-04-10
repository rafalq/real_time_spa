<template>
  <div id="login-form">
    <v-form @submit.prevent="login">
      <v-container>
        <h3 class="form-heading">Login</h3>
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
      form: {
        email: null,
        password: null,
      },
    };
  },
  methods: {
    login() {
      axios
        .post("/api/auth/login", this.form)
        .then((response) => console.log(response.data))
        .catch((err) => console.error(err));
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
</style>