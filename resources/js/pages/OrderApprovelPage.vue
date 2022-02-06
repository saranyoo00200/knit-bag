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
            <tbody>
              <tr v-for="(data, index) in datas" :key="index">
                <th scope="row">1</th>
                <td>
                  <img
                    width="35px"
                    height="35px"
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
                  <button class="btn btn-primary">
                    <i class="fas fa-eye"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
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
      loading: true,
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
