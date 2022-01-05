<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Login</div>
          <div class="card-body">
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="text"
                class="form-control"
                name="email"
                v-model="formData.email"
              />
              <p class="text-danger" v-text="errors.email"></p>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                class="form-control"
                name="password"
                v-model="formData.password"
              />
              <p class="text-danger" v-text="errors.password"></p>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <button @click="login" class="btn btn-primary">Login</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      formData: {
        email: "",
        password: "",
        device_name: "browser",
      },
      errors: {},
    };
  },
  methods: {
    login() {
      axios;
      this.$store
        .dispatch("login", {
          email: this.formData.email,
          password: this.formData.password,
        })
        .then(() => {
          window.location.assign("/home");
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
