import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/",
            name: "index",
            component: () => import("./pages/Index.vue"),
        },
        {
            path: "/reviews",
            name: "reviews",
            component: () => import("./pages/ReviewsPage.vue"),
        },
        {
            path: "/contact",
            name: "contact",
            component: () => import("./pages/ContactPage.vue"),
        },
        {
            path: "*",
            name: "error",
            component: () => import("./pages/404.vue"),
        },
    ],
});

export default router;
