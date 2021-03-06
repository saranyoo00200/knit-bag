/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
window.Vue = require("vue").default;

Vue.use(VueSweetalert2);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("login", require("./pages/auth/Login.vue").default);
Vue.component("index", require("./pages/IndexPage.vue").default);
Vue.component("reviews", require("./pages/ReviewsPage.vue").default);
Vue.component("contact", require("./pages/ContactPage.vue").default);
Vue.component("profile", require("./pages/profile.vue").default);
Vue.component("my-product", require("./pages/UserProductPage.vue").default);
Vue.component("order-history", require("./pages/OrderHistoryPage.vue").default);
Vue.component("check-sales", require("./pages/CheckSalesPage.vue").default);
Vue.component("order-approval", require("./pages/OrderApprovelPage.vue").default);
Vue.component(
    "admin-dashboard",
    require("./pages/AdminsHomePages.vue").default
);
Vue.component("user-dashboard", require("./pages/UsersHomePages.vue").default);
Vue.component(
    "products-management",
    require("./pages/ProductsManagementPages.vue").default
);
Vue.component(
    "users-management",
    require("./pages/UserManagementPage.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});
