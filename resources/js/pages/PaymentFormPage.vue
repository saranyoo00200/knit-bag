<template>
  <div class="container">
    <div v-if="this.loading" id="load"></div>
    <div v-else class="card card-default my-3">
      <div class="card-header">Payment Form</div>
      <div class="card-body">
        Bienvenue sur votre Payment Form.
        <hr />
        <form id="regForm" action="/action_page.php">
          <h1>Payment Form</h1>
          <div class="tab">
            <div class="text-center">
              <i class="fas fa-3x fa-map-marker-alt"></i>
            </div>
            <label for="" class="label-control">Name:</label>
            <p>
              <input
                class="form-control"
                placeholder="First name..."
                oninput="this.className = ''"
                name="fname"
              />
            </p>
            <p>
              <input
                class="form-control"
                placeholder="Last name..."
                oninput="this.className = ''"
                name="lname"
              />
            </p>
          </div>
          <div class="tab">
            <div class="text-center">
              <i class="fas fa-3x fa-piggy-bank"></i>
            </div>
            <label for="" class="label-control">Contact Info:</label>
            <p>
              <input
                class="form-control"
                placeholder="E-mail..."
                oninput="this.className = ''"
                name="email"
              />
            </p>
            <p>
              <input
                class="form-control"
                placeholder="Phone..."
                oninput="this.className = ''"
                name="phone"
              />
            </p>
          </div>
          <div class="tab">
            <div class="text-center">
              <i class="fab fa-3x fa-angellist"></i>
            </div>
            <label for="" class="label-control">Login Info:</label>
            <p>
              <input
                class="form-control"
                placeholder="Username..."
                oninput="this.className = ''"
                name="uname"
              />
            </p>
            <p>
              <input
                class="form-control"
                placeholder="Password..."
                oninput="this.className = ''"
                name="pword"
                type="password"
              />
            </p>
          </div>
          <div style="overflow: auto">
            <div style="float: right">
              <button class="btn btn-secondary" type="button" id="prevBtn">
                Previous
              </button>
              <button class="btn btn-success" type="button" id="nextBtn">
                Next
              </button>
            </div>
          </div>

          <div style="text-align: center; margin-top: 40px">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "paymentForm",
  data() {
    return {
      loading: true,
    };
  },
  mounted() {
    setTimeout(() => {
      this.loading = false;
    }, 1000);
  },
};
</script>

<style>
#load {
  position: fixed;
  width: 81%;
  height: 81%;
  z-index: 9999;
  background: url("https://cdn.discordapp.com/attachments/773251194344570923/934464155644211210/XOsX.gif")
    50% 50% no-repeat rgb(249, 249, 249);
  background-size: 100px;
}
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

input.invalid {
  background-color: #ffdddd;
}

.tab {
  /* display: none; */
  display: inline;
}

.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

.step.finish {
  background-color: #04aa6d;
}
</style>
