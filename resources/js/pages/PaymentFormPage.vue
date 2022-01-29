<template>
  <div class="container">
    <div v-if="this.loading" id="load"></div>
    <div class="bg-white shadow p-5 mb-4">
      <h1>Payment Form</h1>
      <form id="regForm" action="/action_page.php">
        <div class="tab">
          <div class="text-center p-3">
            <i class="fas fa-3x fa-map-marker-alt"></i>
          </div>
          <div class="form-group">
            <div class="row mt-2">
              <div class="col-md-6 mb-2">
                <input
                  type="text"
                  class="form-control"
                  name="fname"
                  placeholder="ชื่อ - นามสกุล ..."
                />
              </div>
              <div class="col-md-6 mb-2">
                <input
                  type="text"
                  class="form-control"
                  name="lname"
                  placeholder="อีเมล ..."
                />
              </div>
            </div>
          </div>
          <div class="form-group">
            <textarea
              id="textArea"
              class="form-control"
              name="address"
              placeholder="ที่อยู่ ..."
            ></textarea>
          </div>
          <div class="form-group">
            <div class="row mt-3">
              <div class="col-md-6 mb-2">
                <input
                  type="tel"
                  class="form-control"
                  name="tel"
                  pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                  placeholder="เบอร์โทร ..."
                />
              </div>
              <div class="col-md-6 mb-2">
                <input
                  type="text"
                  class="form-control"
                  name="subdistrict"
                  placeholder="ตำบล/แขวง ..."
                />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row mt-3">
              <div class="col-md-6 mb-2">
                <input
                  type="text"
                  class="form-control"
                  name="district"
                  placeholder="อำเภอ/เขต"
                />
              </div>
              <div class="col-md-6 mb-2">
                <input
                  type="text"
                  class="form-control"
                  name="province"
                  placeholder="จังหวัด ..."
                />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row mt-3">
              <div class="col-md-6 mb-2">
                <input
                  type="number"
                  class="form-control"
                  name="zip"
                  placeholder="รหัสไปรษณีย์ ..."
                />
              </div>
            </div>
          </div>
        </div>
        <div class="tab">
          <div class="text-center p-3">
            <i class="fas fa-3x fa-piggy-bank"></i>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input
                type="radio"
                class="form-check-input"
                name="bank"
                value="ธนาคารกรุงไทย"
              />ธนาคารกรุงไทย
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input
                type="radio"
                class="form-check-input"
                name="bank"
                value="ธนาคารกสิการไทย"
              />ธนาคารกสิการไทย
            </label>
          </div>
        </div>
        <div class="tab">
          <div class="text-center p-3">
            <i class="fas fa-3x fa-check-circle"></i>
          </div>
          <label for="" class="label-control">Login Info:</label>
          <p>
            <input
              class="form-control"
              placeholder="Username..."
              name="uname"
            />
          </p>
          <p>
            <input
              class="form-control"
              placeholder="Password..."
              name="pword"
              type="password"
            />
          </p>
        </div>
        <div style="overflow: auto">
          <div style="float: right">
            <button
              @click="nextPrev(-1)"
              class="btn btn-secondary"
              type="button"
              id="prevBtn"
            >
              Previous
            </button>
            <button
              @click="nextPrev(1)"
              class="btn btn-success"
              type="button"
              id="nextBtn"
            >
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
</template>

<script>
import axios from "axios";

export default {
  name: "paymentForm",
  data() {
    return {
      form: {
        location: {
          fname: "",
          lname: "",
          address: "",
          tel: "",
          subdistrict: "",
          district: "",
          province: "",
          zip: "",
        },
        bank: "",
      },
      loading: true,
      currentTab: 0,
    };
  },
  mounted() {
    setTimeout(() => {
      this.showTab(this.currentTab);
      this.loading = false;
    }, 1000);
  },
  methods: {
    showTab(n) {
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == x.length - 1) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      this.fixStepIndicator(n);
    },

    nextPrev(n) {
      var x = document.getElementsByClassName("tab");
      if (n == 1 && !this.validateForm()) return false;
      x[this.currentTab].style.display = "none";
      this.currentTab = this.currentTab + n;
      if (this.currentTab >= x.length) {
        document.getElementById("regForm").submit();
        return false;
      }
      this.showTab(this.currentTab);
    },

    validateForm() {
      var x,
        y,
        i,
        valid = true;
      x = document.getElementsByClassName("tab");
      y = x[this.currentTab].getElementsByTagName("input");
      var textArea = x[this.currentTab].querySelector("#textArea");
      valid = true;
      if (this.currentTab == 0 && textArea.value === "") {
        textArea.className += " invalid";
        valid = false;
      }
      for (i = 0; i < y.length; i++) {
        if (y[i].value === "") {
          y[i].className += " invalid";
          valid = false;
        }
        if (y[i].type === "radio" && !(y[0].checked || y[1].checked)) {
          y[i].className += " invalid";
          valid = false;
        }
      }
      if (valid) {
        if (this.currentTab == 0) {
          textArea.classList.remove("invalid");
        }
        for (i = 0; i < y.length; i++) {
          y[i].classList.remove("invalid");
        }
        document.getElementsByClassName("step")[this.currentTab].className +=
          " finish";
      }
      return valid;
    },

    fixStepIndicator(n) {
      var i,
        x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      x[n].className += " active";
    },
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

h1 {
  text-align: center;
}

input.invalid {
  background-color: #ffdddd;
}

textarea.invalid {
  background-color: #ffdddd;
}

.tab {
  display: none;
}

.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.3;
}

.step.active {
  opacity: 1;
}

.step.finish {
  background-color: #04aa6d;
}
</style>
