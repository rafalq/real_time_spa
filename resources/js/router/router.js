import Vue from "vue";
import VueRouter from "vue-router";
import Login from "../components/login/Login.vue";
import Register from "../components/register/Register.vue";

Vue.use(VueRouter);

const routes = [
    { path: "/login", component: Login },
    { path: "/register", component: Register }
];

const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});

export default router;
