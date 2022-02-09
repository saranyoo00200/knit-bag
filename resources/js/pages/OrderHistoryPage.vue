<template>
  <div class="container">
    <div v-if="this.loading" id="load"></div>
    <div class="card card-default">
      <div class="card-header">Order History</div>
      <div class="card-body">
        <p>Bienvenue sur votre trading history.</p>
        <div class="table-responsive p-3">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Image</th>
                <th scope="col">Name-surname</th>
                <th scope="col">Amount money</th>
                <th scope="col">Created_at</th>
                <th scope="col">Approvel</th>
                <th scope="col">Tool</th>
              </tr>
            </thead>
            <tbody v-if="datas == ''" class="text-center">
              <tr>
                <th scope="row" colspan="7">ไม่มีประวัติสินค้า</th>
              </tr>
            </tbody>
            <tbody v-else>
              <tr v-for="(data, index) in datas" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>
                  <img
                    width="37px"
                    height="50px"
                    :src="data.PaymentImage"
                    alt=""
                  />
                </td>
                <td>{{ data.fname }} {{ data.lname }}</td>
                <td>{{ data.amount_money }} บาท($)</td>
                <td>{{ format_date(data.created_at) }}</td>
                <td>
                  <span
                    v-show="data.approvel == true && data.alert == null"
                    class="badge badge-success"
                    >กำลังดำเนินงาน</span
                  >
                  <span v-show="data.alert != null" class="badge badge-success"
                    >จัดส่งเรียบร้อยแล้ว</span
                  >
                  <span
                    v-show="data.approvel == false"
                    class="badge badge-danger"
                    >ยังไม่ได้อนุมัติ</span
                  >
                </td>
                <td>
                  <button
                    @click="
                      ClickModel(
                        data.user_id,
                        data.product_id,
                        data.paymentDate,
                        data.paymentTime
                      )
                    "
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modelMyOrder"
                  >
                    <i class="fas fa-eye"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <hr>
        </div>
      </div>
    </div>

    <!-- model My Order -->
    <div
      class="modal fade"
      id="modelMyOrder"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div v-if="ModelLoading" class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <div v-else>
              <div class="d-flex justify-content-between mb-2">
                <h3>Order product</h3>
                <button
                  v-show="modelOrderDetails.approvel == 0"
                  @click="deleteOrder(modelOrderDetails.id)"
                  class="btn btn-outline-secondary btn-floating m-1"
                >
                  ยกเลิกการสั่งสินค้า
                </button>
              </div>
              <h6
                v-show="modelOrderDetails.approvel == 1"
                class="font-weight-bold"
              >
                เลขพัสดุ:
                <span
                  v-if="modelOrderDetails.alert != ''"
                  class="font-weight-normal text-danger"
                  >{{ modelOrderDetails.alert }}</span
                >
                <span v-else class="font-weight-normal text-danger"
                  >กำลังดำเนินการ</span
                >
              </h6>
              <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th scope="col"><i class="fas fa-images"></i></th>
                    <th scope="col">Name</th>
                    <th scope="col">Number</th>
                    <th scope="col">Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(data, index) in modelProducts" :key="index">
                    <th scope="row">
                      <img
                        width="35px"
                        height="35px"
                        :src="data.Pimage"
                        alt=""
                      />
                    </th>
                    <td>{{ data.Pname }}</td>
                    <td>{{ data.amount_products }}</td>
                    <td>${{ data.Pprice * data.amount_products }}</td>
                  </tr>
                </tbody>
              </table>
              <div class="d-flex justify-content-center">
                <p class="font-weight-bold">Total Amount</p>
                <p class="ms-auto">
                  <span class="fas fa-dollar-sign"></span
                  >{{ modelOrderDetails.amount_money }}
                </p>
              </div>
              <hr />
              <div>
                <p class="font-weight-bold">
                  Address:
                  <span class="font-weight-normal">{{
                    modelOrderDetails.address
                  }}</span>
                </p>
                <p class="font-weight-normal">
                  Subdistrict: {{ modelOrderDetails.subdistrict }}, district:
                  {{ modelOrderDetails.district }}, province:
                  {{ modelOrderDetails.province }}, code_zip:
                  {{ modelOrderDetails.code_zip }}
                </p>
                <p class="font-weight-bold">
                  Tel:
                  <span class="font-weight-normal">{{
                    modelOrderDetails.tel
                  }}</span>
                </p>
                <p class="font-weight-bold">Slib:</p>
                <div class="text-center">
                  <img
                    class="border-custom01 mb-3"
                    :src="modelOrderDetails.PaymentImage"
                    width="250px"
                    alt=""
                  />
                  <p class="font-weight-bold">
                    Date:
                    <span class="font-weight-normal">{{
                      modelOrderDetails.paymentDate
                    }}</span>
                  </p>
                  <p class="font-weight-bold">
                    Time:
                    <span class="font-weight-normal">{{
                      modelOrderDetails.paymentTime
                    }}</span>
                  </p>
                  <p class="font-weight-bold">
                    Bank transfer 4:
                    <span class="font-weight-normal"
                      >ธนาคาร{{ modelOrderDetails.bankTransfer }}</span
                    >
                  </p>
                  <p class="font-weight-bold">
                    To bank:
                    <span class="font-weight-normal"
                      >ธนาคาร{{ modelOrderDetails.toBank }}</span
                    >
                  </p>
                  <p class="font-weight-bold">
                    Code 4:
                    <span class="font-weight-normal">{{
                      modelOrderDetails.paymentCode
                    }}</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import moment from "moment";
export default {
  data() {
    return {
      datas: [],
      modelProducts: [],
      modelOrderDetails: [],
      loading: true,
      ModelLoading: true,
    };
  },
  props: ["auth_user"],
  mounted() {
    axios
      .get("/api/user/order/" + this.auth_user.id + "/get/historys")
      .then((res) => {
        this.datas = res.data;
      });
    setTimeout(() => {
      this.loading = false;
    }, 1000);
  },
  methods: {
    ClickModel(id, product_id, date, time) {
      axios
        .get(
          "/api/order/approval/" +
            id +
            "/" +
            product_id +
            "/" +
            date +
            "/" +
            time +
            "/get/products"
        )
        .then((res) => {
          this.modelProducts = res.data.Products;
          this.modelOrderDetails = res.data.Order[0];
          this.ModelLoading = false;
        })
        .catch((error) => {
          console.log("Error!");
        });
    },
    deleteOrder(id) {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          // API Delete
          axios
            .get("/api/order/approval/" + id + "/delete")
            .then((res) => {
              window.location.reload();
            })
            .catch((error) => {
              console.log("error");
            });
        }
      });
    },
    format_date(value) {
      if (value) {
        moment.locale("th");
        return moment(String(value)).add(543, "years").format("DD/MMM/YYYY");
      }
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
.border-custom01 {
  border: 1px solid #444444;
  border-radius: 15px;
}
</style>
