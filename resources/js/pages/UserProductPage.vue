<template>
  <section>
    <div v-if="this.loading" id="load"></div>
    <div id="contact">
      <div class="container-fluid">
        <div class="bg-white shadow-lg my-3 p-3">
          <div class="text-center mb-3">
            <i class="fas fa-3x fa-shopping-cart"></i>
          </div>
          <div class="table-responsive-md">
            <table
              class="table table-bordered table-hover text-center"
              style="width: 100%"
            >
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Number</th>
                  <th scope="col">Tool</th>
                </tr>
              </thead>
              <tbody v-if="infoUserProduct == ''">
                <tr>
                  <th scope="row" colspan="6">ไม่มีรายการสินค้า</th>
                </tr>
              </tbody>
              <tbody v-else>
                <tr v-for="(data, index) in infoUserProduct" :key="index">
                  <th scope="row">
                    {{ index + 1 }}
                  </th>
                  <td>
                    <img
                      class="img-profile rounded-circle"
                      width="35px"
                      height="35px"
                      :src="data.Pimage"
                      alt=""
                    />
                  </td>
                  <td>{{ data.Pname }}</td>
                  <td>{{ data.Pprice * data.number }}</td>
                  <td>
                    <div class="btn-group">
                      <a
                        @click="clickPlus(data.id, index)"
                        class="btn btn-outline-secondary p-1"
                        href="#"
                        ><i class="fas fa-plus"></i
                      ></a>
                      <span class="fs-5 badge text-dark">{{
                        data.number
                      }}</span>
                      <a
                        @click="clickMinus(data.id, index)"
                        class="btn btn-outline-secondary p-1"
                        href="#"
                        ><i class="fas fa-minus"></i
                      ></a>
                    </div>
                  </td>
                  <td>
                    <a
                      class="btn btn-danger"
                      @click="DeleteProduct(data.id, index)"
                      href="#"
                    >
                      <i class="fas fa-trash-alt"></i
                    ></a>
                  </td>
                </tr>
              </tbody>
            </table>
            <hr />
            <div class="text-center">
              <span class="badge bg-secondary mb-2">Total = {{ total }} $</span
              ><br />
              <button
                type="button"
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#Payment"
              >
                Payment
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Add user-->
    <div
      class="modal fade"
      id="Payment"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
            <button
              type="button"
              class="close"
              data-bs-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
                    readonly
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
                        readonly
                      />
                    </div>
                    <div class="col-md-6 mb-2">
                      <input
                        type="text"
                        v-model="form.location.subdistrict"
                        class="form-control"
                        name="subdistrict"
                        placeholder="ตำบล/แขวง ..."
                        readonly
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
                        readonly
                      />
                    </div>
                    <div class="col-md-6 mb-2">
                      <input
                        type="text"
                        v-model="form.location.province"
                        class="form-control"
                        name="province"
                        placeholder="จังหวัด ..."
                        readonly
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mt-3">
                    <div class="col-md-6 mb-2">
                      <input
                        type="number"
                        v-model="form.location.code_zip"
                        class="form-control"
                        name="code_zip"
                        placeholder="รหัสไปรษณีย์ ..."
                        readonly
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab mb-3">
                <div class="text-center">
                  <i class="fas fa-3x fa-piggy-bank"></i>
                </div>
                <div class="radio-with-Icon">
                  <div class="radioOption-Item">
                    <input
                      v-model="form.bank"
                      type="radio"
                      name="bank"
                      id="KrungThaiBank"
                      value="ธนาคารกรุงไทย"
                    />
                    <label for="KrungThaiBank">
                      <img
                        class="w-100 h-75"
                        src="https://cdn.discordapp.com/attachments/773251194344570923/937320316043165796/png-clipart-krung-thai-bank-money-credit-kasikornbank-bank-blue-text-depositphotos-bgremover.png"
                        alt=""
                      />
                      ธนาคารกรุงไทย
                    </label>
                  </div>

                  <div class="radioOption-Item">
                    <input
                      v-model="form.bank"
                      type="radio"
                      name="bank"
                      id="KasikornBank"
                      value="ธนาคารกสิการไทย"
                    />
                    <label for="KasikornBank">
                      <img
                        class="w-100 h-75"
                        src="https://cdn.discordapp.com/attachments/773251194344570923/937320315858608158/png-clipart-kasikornbank-money-payment-credit-card-wavy-lines-leaf-text-depositphotos-bgremover.png"
                        alt=""
                      />
                      ธนาคารกสิการไทย
                    </label>
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
                    @change="onFilePaymentImage"
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
                  <input
                    v-model="form.payment_slip.paymentDate"
                    id="paymentProofDate"
                    class="form-control"
                    type="date"
                  />
                </div>
                <div class="form-group">
                  <label class="label-control" for="paymentProofTime"
                    >เวลาที่โอนเงินตามหลักฐานการซำระเงิน</label
                  >
                  <input
                    v-model="form.payment_slip.paymentTime"
                    id="paymentProofTime"
                    class="form-control"
                    type="time"
                  />
                </div>
                <div class="form-group">
                  <label for="paymentProofOption1">โอนจากธนาคาร</label>
                  <select
                    v-model="form.payment_slip.paymentProofOption1"
                    id="paymentProofOption1"
                    class="custom-select"
                    name="paymentProofOption1"
                  >
                    <option selected value="">เลือก...</option>
                    <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                    <option value="ธนาคารกสิการไทย">ธนาคารกสิการไทย</option>
                    <option value="ธนาคารออมสิน">ธนาคารออมสิน</option>
                    <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                    <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                    <option value="ธนาคารกรุงศรี">ธนาคารกรุงศรี</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label for="paymentProofOption2">ไปยังธนาคาร</label>
                  <select
                    v-model="form.payment_slip.paymentProofOption2"
                    id="paymentProofOption2"
                    class="custom-select"
                    name="paymentProofOption2"
                  >
                    <option selected value="">เลือก...</option>
                    <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                    <option value="ธนาคารกสิการไทย">ธนาคารกสิการไทย</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="label-control" for="paymentProofPrice"
                    >จำนวนเงินถูกโอนแล้ว (฿)</label
                  >
                  <input
                    v-model="form.payment_slip.paymentPrice"
                    id="paymentProofPrice"
                    class="form-control"
                    type="number"
                  />
                </div>
                <div class="form-group">
                  <label class="label-control" for="paymentProofSlibCode4"
                    >โอนจากบัญชีธนาคารเลขที่ 4 หลักสุดท้าย</label
                  >
                  <input
                    v-model="form.payment_slip.paymentCode"
                    id="paymentProofSlibCode4"
                    class="form-control"
                    type="number"
                  />
                </div>
              </div>

              <div style="text-align: center; margin-top: 40px">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
              </div>
            </form>
          </div>
          <div class="modal-footer">
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
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";

export default {
  name: "index",
  data() {
    return {
      infoUserProduct: [],
      total: 0,
      form: {
        location: {
          fname: "Saranyoo",
          lname: "Khunkham",
          address: "-",
          tel: "0958493654",
          subdistrict: "-",
          district: "San Sai",
          province: "Chiang Mai",
          code_zip: "50210",
        },
        bank: "",
        payment_slip: {
          paymentImage: "",
          paymentDate: "",
          paymentTime: "",
          paymentProofOption1: "",
          paymentProofOption2: "",
          paymentPrice: "",
          paymentCode: "",
        },
      },
      currentTab: 0,
      loading: true,
    };
  },
  props: ["auth_user"],
  mounted() {
    this.getProducts();
    this.showTab(this.currentTab);
  },
  methods: {
    getProducts() {
      axios
        .get("/api/users/product/" + this.auth_user.id + "/index")
        .then((res) => {
          this.infoUserProduct = res.data;
          this.total = 0;
          for (let i = 0; i < this.infoUserProduct.length; i++) {
            this.total +=
              this.infoUserProduct[i].Pprice * this.infoUserProduct[i].number;
          }
          this.loading = false;
        })
        .catch((error) => {
          console.log("error");
        });
    },
    DeleteProduct(value, index) {
      axios
        .get("/api/users/product/" + value + "/delete")
        .then((res) => {
          this.infoUserProduct.splice(index, 1);
          this.total = 0;
          for (let i = 0; i < this.infoUserProduct.length; i++) {
            this.total +=
              this.infoUserProduct[i].Pprice * this.infoUserProduct[i].number;
          }
        })
        .catch((error) => {
          console.log("error!");
        });
    },
    clickPayMoney() {
      if (this.total == 0) {
        this.$swal(
          "Warning!",
          "Unable to pay due to lack of product information.",
          "warning"
        );
      } else {
        window.location.assign("/payment-form/checkout");
      }
    },
    clickSelect() {
      //price total
      this.total = 0;
      for (let i = 0; i < this.infoUserProduct.length; i++) {
        this.total +=
          this.infoUserProduct[i].Pprice * this.infoUserProduct[i].number;
      }
    },
    clickPlus(value, index) {
      axios
        .post("/api/users/product/" + value + "/plus", {
          user_id: this.auth_user.id,
        })
        .then((res) => {
          this.infoUserProduct[index].number++;
          this.total = 0;
          for (let i = 0; i < this.infoUserProduct.length; i++) {
            this.total +=
              this.infoUserProduct[i].Pprice * this.infoUserProduct[i].number;
          }
        })
        .catch((error) => {
          console.log("error!");
        });
    },
    clickMinus(value, index) {
      if (this.infoUserProduct[index].number > 1) {
        axios
          .post("/api/users/product/" + value + "/minus", {
            user_id: this.auth_user.id,
          })
          .then((res) => {
            this.infoUserProduct[index].number--;
            this.total = 0;
            for (let i = 0; i < this.infoUserProduct.length; i++) {
              this.total +=
                this.infoUserProduct[i].Pprice * this.infoUserProduct[i].number;
            }
          })
          .catch((error) => {
            console.log("error!");
          });
      }
    },
    // tab payment
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
              alert(this.form.payment_slip.paymentImage);
              // window.location.assign("/order-historys");
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
      if (
        this.currentTab == 2 &&
        this.form.payment_slip.paymentProofOption1 == ""
      ) {
        select[0].className += " invalid";
      }
      if (
        this.currentTab == 2 &&
        this.form.payment_slip.paymentProofOption2 == ""
      ) {
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

    onFilePaymentImage(e) {
      //   const file = e.target.files[0];
      //   this.file_photo = URL.createObjectURL(file);
      this.form.payment_slip.paymentImage = e.target.files[0];
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

#regForm {
  padding: 15px 15px;
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
  text-align: center;
}
div.radio-with-Icon div.radioOption-Item {
  display: inline-block;
  width: 150px;
  height: 150px;
  box-sizing: border-box;
  margin: 15px 15px;
  border: none;
}
div.radio-with-Icon div.radioOption-Item label {
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
div.radio-with-Icon div.radioOption-Item label:hover,
div.radio-with-Icon div.radioOption-Item label:focus,
div.radio-with-Icon div.radioOption-Item label:active {
  opacity: 0.5;
  background-color: #de1831;
  color: #fff;
  margin: 0 !important;
}
div.radio-with-Icon div.radioOption-Item label::after,
div.radio-with-Icon div.radioOption-Item label:after,
div.radio-with-Icon div.radioOption-Item label::before,
div.radio-with-Icon div.radioOption-Item label:before {
  opacity: 0 !important;
  width: 0 !important;
  height: 0 !important;
  margin: 0 !important;
}
div.radio-with-Icon div.radioOption-Item label i.fa {
  display: block;
  font-size: 50px;
}
div.radio-with-Icon div.radioOption-Item input[type="radio"] {
  opacity: 0 !important;
  width: 0 !important;
  height: 0 !important;
}
div.radio-with-Icon div.radioOption-Item input[type="radio"]:active ~ label {
  opacity: 1;
}
div.radio-with-Icon div.radioOption-Item input[type="radio"]:checked ~ label {
  opacity: 1;
  border: none;
  background-color: #de1831;
  color: #fff;
}
div.radio-with-Icon div.radioOption-Item input[type="radio"]:hover,
div.radio-with-Icon div.radioOption-Item input[type="radio"]:focus,
div.radio-with-Icon div.radioOption-Item input[type="radio"]:active {
  margin: 0 !important;
}
div.radio-with-Icon div.radioOption-Item input[type="radio"] + label:before,
div.radio-with-Icon div.radioOption-Item input[type="radio"] + label:after {
  margin: 0 !important;
}
</style>
