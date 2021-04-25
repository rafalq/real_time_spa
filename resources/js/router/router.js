import Vue from "vue";
import VueRouter from "vue-router";
import Login from "../components/auth/Login.vue";
import Register from "../components/auth/Register.vue";
import Forum from "../components/forum/Forum.vue";
import CreateQuestion from "../components/forum/question/CreateQuestion.vue";
import Logout from "../components/auth/Logout.vue";
import QuestionMode from "../components/forum/question/QuestionMode.vue";
// import CreateCategory from "../components/forum/category/CreateCategoryForm.vue";

Vue.use(VueRouter);

const routes = [
    { path: "/", redirect: "/forum" },
    { path: "/login", component: Login, name: "login" },
    { path: "/register", component: Register, name: "register" },
    { path: "/forum", component: Forum, name: "forum" },
    { path: "/ask", component: CreateQuestion, name: "ask" },
    { path: "/logout", component: Logout, name: "logout" },
    { path: "/question/:slug", component: QuestionMode, name: "read" }
    // { path: "/category", component: CreateCategory, name: "category" }
];

const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});

export default router;
