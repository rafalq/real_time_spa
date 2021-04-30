require("./bootstrap");

window.Vue = require("vue").default;

import Vuetify from "../plugins/vuetify";
import App from "./components/App.vue";
import router from "./router/router.js";
import User from "./helpers/User";
import Exception from "./helpers/Exception";

// https://github.com/F-loat/vue-simplemde
import VueSimplemde from "vue-simplemde";
import marked from "marked";
import "simplemde/dist/simplemde.min.css";

window.User = User;
window.Exception = Exception;
window.EventBus = new Vue();
window.marked = marked;

Vue.component("app", App);
Vue.component("vue-simplemde", VueSimplemde);

const app = new Vue({
    vuetify: Vuetify,
    el: "#app",
    router
});
