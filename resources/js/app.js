require("./bootstrap");

window.Vue = require("vue").default;

import Vuetify from "../plugins/vuetify";
import App from "./components/App.vue";
import router from "./router/router.js";
import User from "./helpers/User";

window.User = User;
window.EventBus = new Vue();

Vue.component("app", App);

const app = new Vue({
    vuetify: Vuetify,
    el: "#app",
    router
});
