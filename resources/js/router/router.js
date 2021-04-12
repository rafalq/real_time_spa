import Vue from "vue";
import VueRouter from "vue-router";
import Login from "../components/auth/login/Login.vue";
import Register from "../components/auth/register/Register.vue";
import Forum from "../components/forum/Forum.vue";
import Logout from "../components/auth/logout/Logout.vue";

Vue.use(VueRouter);

const routes = [
    { path: "/login", component: Login, name: "login" },
    { path: "/register", component: Register, name: "register" },
    { path: "/forum", component: Forum, name: "forum" },
    { path: "/logout", component: Logout, name: "logout" }
];

const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});

export default router;
