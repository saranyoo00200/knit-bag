<template>
  <div class="container">
    <div v-if="this.loading" id="load"></div>
    <div class="card card-default">
      <div class="card-header">Order Approval</div>
      <div class="card-body">
        <p>Bienvenue sur votre trading Approval.</p>
        <div class="table-responsive p-3">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Image</th>
                <th scope="col">Name-surname</th>
                <th scope="col">Amount money</th>
                <th scope="col">Approvel</th>
                <th scope="col">Tool</th>
              </tr>
            </thead>
            <tbody v-if="datas == ''" class="text-center">
              <tr>
                <th scope="row" colspan="6">ไม่มีรายการสินค้า</th>
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
                <td v-if="data.approvel == true">
                  <span class="badge badge-success">อนุมัติแล้ว</span>
                </td>
                <td v-if="data.approvel == false">
                  <span class="badge badge-danger">ยังไม่ได้อนุมัติ</span>
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
                    data-bs-target="#modelApprove"
                  >
                    <i class="fas fa-eye"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- model approve -->
    <div
      class="modal fade"
      id="modelApprove"
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
              <h3>Order product</h3>
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
                <p>Total Amount</p>
                <p class="ms-auto">
                  <span class="fas fa-dollar-sign"></span
                  >{{ modelOrderDetails.amount_money }}
                </p>
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
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
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
    axios.get("/api/order/approval/index").then((res) => {
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
</style>
