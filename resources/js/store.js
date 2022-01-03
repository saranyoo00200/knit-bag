import axios from "axios";
import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

axios.defaults.baseURL = "http://127.0.0.1:8000/api";

export const store = new Vuex.Store({
    state: {
        // user: null,
        token: localStorage.getItem("token") || "",
    },

    mutations: {
        setUserData(state, userData) {
            state.user = userData;
            localStorage.setItem("token", JSON.stringify(userData));
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`;
        },

        clearUserData() {
            localStorage.removeItem("token");
            location.reload();
        },
    },

    actions: {
        login({ commit }, credentials) {
            return axios.post("/login", credentials).then(({ data }) => {
                commit("setUserData", data);
            });
        },

        logout({ commit }) {
            commit("clearUserData");
        },
    },

    getters: {
        isLogged: (state) => !!state.token,
    },
});
