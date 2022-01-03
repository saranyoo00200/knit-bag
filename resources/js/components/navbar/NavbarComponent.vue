<template>
  <div id="navbar">
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
      <div class="container-fluid">
        <a href="/" class="navbar-brand text-dark">KNIT BAG</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span><i class="fas fa-bars"></i></span>
        </button>
        <div
          class="collapse navbar-collapse text-center"
          id="navbarSupportedContent"
        >
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link to="/" class="nav-link text-dark active"
                >Product</router-link
              >
            </li>
            <li class="nav-item">
              <router-link to="/knitBag/reviews" class="nav-link text-dark"
                >Review</router-link
              >
            </li>
            <li class="nav-item">
              <router-link to="/knitBag/contacts" class="nav-link text-dark"
                >Contact</router-link
              >
            </li>
          </ul>
          <a
            v-show="false"
            class="position-relative"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight"
            ><i class="fas fa-shopping-cart"></i>
            <span
              class="
                position-absolute
                top-0
                start-100
                translate-middle
                badge
                rounded-pill
                bg-danger
              "
            >
              1
            </span>
          </a>
          <a href="/login" class="btn btn-default me-2" v-if="!isLogged"
            >Login</a
          >
          <a href="/register" class="btn btn-default" v-if="!isLogged"
            >Sign-up</a
          >
          <!-- <a href="/login" type="button" class="btn btn-outline-primary me-2">
            Login
          </a> -->
          <!-- <a href="/register" type="button" class="btn btn-primary">Sign-up</a> -->
          <a href="/home" class="btn btn-default" v-if="isLogged">Home</a>
          <button
            type="button"
            class="btn btn-default"
            @click="logout()"
            v-if="isLogged"
          >
            Logout
          </button>
        </div>
      </div>
    </nav>

    <!-- offcanvas shopping -->
    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="offcanvasRight"
      aria-labelledby="offcanvasRightLabel"
    >
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">สินค้าของฉัน</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <hr />
      <div class="offcanvas-body">...</div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "navbar",
  data() {
    return {};
  },
  computed: {
    ...mapGetters(["isLogged"]),
  },
  methods: {
    logout() {
      const config = {
        headers: {
          Authorization: "Bearer " + this.$store.state.token.access_token,
          "Content-Type": "application/json",
        },
      };

      axios
        .post("/logout", config)
        .then((res) => {
          this.$store.dispatch("logout");
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
  },
};
</script>

<style>
</style>
