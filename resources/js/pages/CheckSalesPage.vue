<template>
  <div class="container">
    <div v-if="this.loading" id="load"></div>
    <div class="card card-default">
      <div class="card-header">Check sales</div>
      <div class="card-body">
        Welcome to check the sale.
        <hr />
        <div class="table-responsive">
          <table id="myTable" class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Price</th>
                <th scope="col">Tool</th>
              </tr>
            </thead>
            <tbody v-if="info == ''" class="text-center">
              <tr>
                <th scope="row" colspan="7">ไม่มีข้อมูล</th>
              </tr>
            </tbody>
            <tbody v-else>
              <tr v-for="(data, index) in info" :key="index">
                <td scope="row">{{ format_date(data.SaleDate) }}</td>
                <td>${{ data.TotalPrice }}</td>
                <td>
                  <button
                    @click="ClickModel(data.OrderAppID)"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modelSale"
                  >
                    <i class="fas fa-eye"></i>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th scope="col">Total Amount</th>
                <th scope="col">${{ Total }}</th>
                <th scope="col"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <!-- model Sale -->
    <div
      class="modal fade"
      id="modelSale"
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
              <table id="myTable" class="table table-bordered text-center">
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
                  <span class="fas fa-dollar-sign">{{ modelTotal }}</span>
                </p>
              </div>
              <hr />
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
//Bootstrap and jQuery libraries
import "jquery/dist/jquery.min.js";
import "bootstrap/dist/css/bootstrap.min.css";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import moment from "moment";
import axios from "axios";
import $ from "jquery";

export default {
  data() {
    return {
      info: [],
      modelProducts: [],
      modelTotal: "",
      Total: "",
      loading: true,
      ModelLoading: true,
    };
  },
  props: ["auth_user"],
  mounted() {
    this.getInfo();
  },
  methods: {
    getInfo() {
      axios
        .get("/api/seles/all/index")
        .then((res) => {
          this.info = res.data.Order;
          this.Total = res.data.Total[0].Total;
          this.UseDataTable();
          this.loading = false;
        })
        .catch((error) => {
          console.log("error");
        });
    },
    ClickModel(id) {
      axios
        .get("/api/seles/" + id + "/get/products")
        .then((res) => {
          this.modelProducts = res.data.products;
          this.modelTotal = res.data.amount_money;
          this.ModelLoading = false;
        })
        .catch((error) => {
          console.log("Error!");
        });
    },
    UseDataTable() {
      // use data tables
      setTimeout(() => {
        $("#myTable").DataTable({
          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
          pageLength: 5,
        });
        this.loading = false;
      });
    },
    format_date(value) {
      if (value) {
        moment.locale("th");
        return moment(String(value))
          .add(543, "years")
          .format("DD/MMM/YYYY HH:mm" + "นาที");
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
</style>
