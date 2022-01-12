<template>
  <section>
    <div id="contact">
      <div class="container-fluid">
        <div class="bg-white shadow-lg my-3 p-3">
          <div class="text-center mb-3">
            <h3>My Product</h3>
          </div>
          <div class="table-responsive-md">
            <table class="table table-bordered table-hover text-center">
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
              <tbody>
                <tr v-for="(data, index) in infoUserProduct" :key="index">
                  <th scope="row">{{ index + 1 }}</th>
                  <td><img width="50px" :src="data.Pimage" alt="" /></td>
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
                      >Delete</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr />
          <div class="text-center">
            <span class="badge bg-secondary mb-2">Total = {{ total }} $</span
            ><br />
            <button class="btn btn-success">Pay Money</button>
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
    };
  },
  props: ["auth_user"],
  mounted() {
    this.getProducts();
  },
  methods: {
    getProducts() {
      axios
        .get("/api/users/product/" + this.auth_user.id + "/index")
        .then((res) => {
          this.infoUserProduct = res.data;
          for (let i = 0; i < this.infoUserProduct.length; i++) {
            this.total +=
              this.infoUserProduct[i].Pprice * this.infoUserProduct[i].number;
          }
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
  },
};
</script>

<style>
</style>
