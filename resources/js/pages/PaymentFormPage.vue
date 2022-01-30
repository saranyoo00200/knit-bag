<template>
  <div class="container ">
    <div v-if="this.loading" id="load"></div>
    <div class="bg-white shadow p-5 mb-4">
      <h1>Payment Form</h1>
      <form id="regForm">
        <div class="tab mb-3">
          <div class="text-center p-3">
            <i class="fas fa-3x fa-map-marker-alt"></i>
          </div>
          <div class="form-group">
            <div class="row mt-2">
              <div class="col-md-6 mb-2">
                <input
                  type="text"
                  v-model="form.location.fname"
                  class="form-control"
                  name="fname"
                  placeholder="ชื่อ - นามสกุล ..."
                />
              </div>
              <div class="col-md-6 mb-2">
                <input
                  type="text"
                  v-model="form.location.lname"
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
              v-model="form.location.address"
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
                  v-model="form.location.tel"
                  class="form-control"
                  name="tel"
                  pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                  placeholder="เบอร์โทร ..."
                />
              </div>
              <div class="col-md-6 mb-2">
                <input
                  type="text"
                  v-model="form.location.subdistrict"
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
                  v-model="form.location.district"
                  class="form-control"
                  name="district"
                  placeholder="อำเภอ/เขต"
                />
              </div>
              <div class="col-md-6 mb-2">
                <input
                  type="text"
                  v-model="form.location.province"
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
                  v-model="form.location.zip"
                  class="form-control"
                  name="zip"
                  placeholder="รหัสไปรษณีย์ ..."
                />
              </div>
            </div>
          </div>
        </div>
        <div class="tab mb-3">
          <div class="text-center">
            <i class="fas fa-3x fa-piggy-bank"></i>
          </div>
          <div class="form-check text-center">
            <div class="radio-with-Icon">
              <p class="radioOption-Item">
                <input
                  type="radio"
                  name="bank"
                  id="KrungThaiBank"
                  value="ธนาคารกรุงไทย"
                  class="ng-valid ng-dirty ng-touched ng-empty"
                />
                <label for="KrungThaiBank">
                  <img
                    class="w-100 h-75"
                    src="https://cdn.discordapp.com/attachments/773251194344570923/937320316043165796/png-clipart-krung-thai-bank-money-credit-kasikornbank-bank-blue-text-depositphotos-bgremover.png"
                    alt=""
                  />
                  ธนาคารกรุงไทย
                </label>
              </p>

              <p class="radioOption-Item">
                <input
                  type="radio"
                  name="bank"
                  id="KasikornBank"
                  value="ธนาคารกสิการไทย"
                  class="ng-valid ng-dirty ng-touched ng-empty"
                />
                <label for="KasikornBank">
                  <img
                    class="w-100 h-75"
                    src="https://cdn.discordapp.com/attachments/773251194344570923/937320315858608158/png-clipart-kasikornbank-money-payment-credit-card-wavy-lines-leaf-text-depositphotos-bgremover.png"
                    alt=""
                  />
                  ธนาคารกสิการไทย
                </label>
              </p>
            </div>
          </div>
        </div>
        <div class="tab mb-3">
          <div class="text-center p-3">
            <i class="fas fa-3x fa-check-circle"></i>
          </div>
          <div class="form-group">
            <label class="label-control" for="paymentProof"
              >อัพโหลดหลักฐานการซำระเงิน</label
            >
            <input
              id="paymentProof"
              class="form-control"
              type="file"
              accept="image/jpeg, image/png"
            />
          </div>
          <div class="form-group">
            <label class="label-control" for="paymentProofDate"
              >วันที่โอนเงินตามหลักฐานการซำระเงิน</label
            >
            <input id="paymentProofDate" class="form-control" type="date" />
          </div>
          <div class="form-group">
            <label class="label-control" for="paymentProofTime"
              >เวลาที่โอนเงินตามหลักฐานการซำระเงิน</label
            >
            <input id="paymentProofTime" class="form-control" type="time" />
          </div>
          <div class="form-group">
            <label for="paymentProofOption1">โอนจากธนาคาร</label>
            <select
              v-model="paymentProofOption1"
              id="paymentProofOption1"
              class="custom-select"
              name="paymentProofOption1"
            >
              <option selected disabled value="">เลือก...</option>
              <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
              <option value="ธนาคารกสิการไทย">ธนาคารกสิการไทย</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="paymentProofOption2">ไปยังธนาคาร</label>
            <select
              v-model="paymentProofOption2"
              id="paymentProofOption2"
              class="custom-select"
              name="paymentProofOption2"
            >
              <option selected disabled value="">เลือก...</option>
              <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
              <option value="ธนาคารกสิการไทย">ธนาคารกสิการไทย</option>
            </select>
          </div>
          <div class="form-group">
            <label class="label-control" for="paymentProofPrice"
              >จำนวนเงินถูกโอนแล้ว (฿)</label
            >
            <input id="paymentProofPrice" class="form-control" type="number" />
          </div>
          <div class="form-group">
            <label class="label-control" for="paymentProofSlibCode4"
              >โอนจากบัญชีธนาคารเลขที่ 4 หลักสุดท้าย</label
            >
            <input
              id="paymentProofSlibCode4"
              class="form-control"
              type="number"
            />
          </div>
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
          lname: "Khunkham",
          address: "-",
          tel: "0958493654",
          subdistrict: "-",
          district: "San Sai",
          province: "Chiang Mai",
          zip: "50210",
        },
        bank: "",
      },
      loading: true,
      currentTab: 0,
      paymentProofOption1: "",
      paymentProofOption2: "",
    };
  },
  props: ["auth_user"],
  mounted() {
    setTimeout(() => {
      this.form.location.fname = this.auth_user.name;
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
      console.log(n);
      var x = document.getElementsByClassName("tab");
      if (n == 1 && !this.validateForm()) return false;
      if (this.currentTab < x.length - 1) {
        x[this.currentTab].style.display = "none";
        this.currentTab = this.currentTab + n;
      } else {
        if (n === 1) {
          this.$swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
          }).then((result) => {
            if (result.value) {
              window.location.assign("/order-historys");
            }
          });
          return false;
        } else {
          x[this.currentTab].style.display = "none";
          this.currentTab = this.currentTab + n;
        }
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
      var select = x[this.currentTab].getElementsByTagName("select");
      valid = true;
      if (this.currentTab == 0 && textArea.value === "") {
        textArea.className += " invalid";
        valid = false;
      }
      if (this.currentTab == 2 && this.paymentProofOption1 == "") {
        select[0].className += " invalid";
      }
      if (this.currentTab == 2 && this.paymentProofOption2 == "") {
        select[1].className += " invalid";
      }
      for (i = 0; i < y.length; i++) {
        if (y[i].value === "") {
          y[i].className += " invalid";
          valid = false;
        }
        if (y[i].type === "radio" && !(y[0].checked || y[1].checked)) {
          valid = false;
        }
      }
      if (valid) {
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

<style scoped>
#load {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 9999;
  background: url("https://cdn.discordapp.com/attachments/773251194344570923/934464155644211210/XOsX.gif")
    no-repeat rgb(249, 249, 249);
  background-position: center;
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

select.invalid {
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

/* radio image */
div.radio-with-Icon {
  display: block;
}
div.radio-with-Icon p.radioOption-Item {
  display: inline-block;
  width: 200px;
  height: 200px;
  box-sizing: border-box;
  /* margin: 25px 15px; */
  border: none;
}
div.radio-with-Icon p.radioOption-Item label {
  display: block;
  height: 100%;
  width: 100%;
  padding: 10px;
  border-radius: 10px;
  border: 1px solid #de1831;
  color: #de1831;
  cursor: pointer;
  opacity: 0.8;
  transition: none;
  font-size: 13px;
  padding-top: 25px;
  text-align: center;
  margin: 0 !important;
}
div.radio-with-Icon p.radioOption-Item label:hover,
div.radio-with-Icon p.radioOption-Item label:focus,
div.radio-with-Icon p.radioOption-Item label:active {
  opacity: 0.5;
  background-color: #de1831;
  color: #fff;
  margin: 0 !important;
}
div.radio-with-Icon p.radioOption-Item label::after,
div.radio-with-Icon p.radioOption-Item label:after,
div.radio-with-Icon p.radioOption-Item label::before,
div.radio-with-Icon p.radioOption-Item label:before {
  opacity: 0 !important;
  width: 0 !important;
  height: 0 !important;
  margin: 0 !important;
}
div.radio-with-Icon p.radioOption-Item label i.fa {
  display: block;
  font-size: 50px;
}
div.radio-with-Icon p.radioOption-Item input[type="radio"] {
  opacity: 0 !important;
  width: 0 !important;
  height: 0 !important;
}
div.radio-with-Icon p.radioOption-Item input[type="radio"]:active ~ label {
  opacity: 1;
}
div.radio-with-Icon p.radioOption-Item input[type="radio"]:checked ~ label {
  opacity: 1;
  border: none;
  background-color: #de1831;
  color: #fff;
}
div.radio-with-Icon p.radioOption-Item input[type="radio"]:hover,
div.radio-with-Icon p.radioOption-Item input[type="radio"]:focus,
div.radio-with-Icon p.radioOption-Item input[type="radio"]:active {
  margin: 0 !important;
}
div.radio-with-Icon p.radioOption-Item input[type="radio"] + label:before,
div.radio-with-Icon p.radioOption-Item input[type="radio"] + label:after {
  margin: 0 !important;
}
</style>
