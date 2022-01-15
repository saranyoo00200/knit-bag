<template>
  <section class="bg-light">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products Manage</h1>
    <p class="mb-4">
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit itaque
      in eaque harum ratione consequatur, deleniti quisquam inventore, dolore
      error facere illum perspiciatis? Excepturi, rem cupiditate accusantium
      esse maxime quaerat.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Products Tables</h6>
        <button
          type="button"
          class="btn btn-success"
          data-bs-toggle="modal"
          data-bs-target="#AddProducts"
        >
          +
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            id="myTable"
            class="table table-striped table-bordered table-hover"
            style="width: 100%"
          >
            <thead>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Detail</th>
                <th>Class</th>
                <th>Tool</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Detail</th>
                <th>Class</th>
                <th>Tool</th>
              </tr>
            </tfoot>
            <tbody>
              <tr v-for="(data, index) in DataList" :key="index">
                <td>{{ index + 1 }}</td>
                <td><img :src="data.Pimage" width="50px" alt="" /></td>
                <td>{{ data.Pname }}</td>
                <td>{{ data.Pprice }}</td>
                <td :inner-html.prop="data.Pdetail | truncate(25)"></td>
                <td>{{ data.Pclass }}</td>
                <td>
                  <button
                    @click="getEditProduct(data.id)"
                    class="btn btn-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#EditProducts"
                  >
                    <i class="fas fa-edit"></i>
                  </button>
                  <button
                    @click="DeleteProduct(data.id, index)"
                    class="btn btn-danger"
                  >
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Edit Products -->
    <div
      class="modal fade"
      id="EditProducts"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form v-on:submit.prevent="updateProduct" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
              <i
                @click="clockClose"
                type="button"
                class="fas fa-times"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></i>
            </div>
            <div class="modal-body">
              <div v-if="loadingModel" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
              <div v-else>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="NameProducts" class="label-control"
                        >Name</label
                      >
                      <input
                        v-model="DataEdit.Pname"
                        type="text"
                        name="Pname"
                        class="form-control"
                        id="NameProducts"
                        placeholder="Name Product ......."
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="PriceProduct" class="label-control"
                        >Price</label
                      >
                      <input
                        v-model="DataEdit.Pprice"
                        type="number"
                        name="Pprice"
                        class="form-control"
                        id="PriceProduct"
                        placeholder="Price Product ......."
                        required
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="PriceProduct" class="label-control">Detail</label>
                  <textarea
                    v-model="DataEdit.Pdetail"
                    type="text"
                    name="Pdetail"
                    class="form-control"
                    id="DetailProduct"
                    placeholder="Detail Product ......."
                    required
                  />
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="PriceProduct" class="label-control"
                        >Class</label
                      >
                      <select
                        class="form-control dropdown"
                        v-model="DataEdit.Pclass"
                        name="Pclass"
                        required
                      >
                        <option value="">Select Class .........</option>
                        <option value="1">Bag</option>
                        <option value="2">Shirt</option>
                        <option value="3">Scarf</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="PriceProduct" class="label-control"
                        >Image</label
                      >
                      <input
                        type="file"
                        @change="onEditFileImageChange"
                        name="user_photo"
                        accept="image/jpeg, image/png"
                        class="form-control"
                        multiple
                      />
                    </div>
                  </div>
                </div>
                <div class="mx-auto" style="width: 140px">
                  <img
                    v-if="file_photo_edit"
                    :src="file_photo_edit"
                    class="rounded-circle"
                    alt=""
                    width="auto"
                    height="140px;"
                  />
                  <img
                    v-else
                    src=""
                    class="rounded-circle"
                    alt=""
                    width="100%"
                    height="140px;"
                  />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                id="closeModal"
                @click="clockClose"
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button
                type="submit"
                data-dismiss="modal"
                class="btn btn-primary"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Add Product-->
    <div
      class="modal fade"
      id="AddProducts"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form v-on:submit.prevent="AddProduct" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
              <i
                type="button"
                class="fas fa-times"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></i>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="NameProducts" class="label-control">Name</label>
                    <input
                      v-model="DataAdd.Pname"
                      type="text"
                      name="Pname"
                      class="form-control"
                      id="NameProducts"
                      placeholder="Name Product ......."
                      required
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="PriceProduct" class="label-control"
                      >Price</label
                    >
                    <input
                      v-model="DataAdd.Pprice"
                      type="number"
                      name="Pprice"
                      class="form-control"
                      id="PriceProduct"
                      placeholder="Price Product ......."
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="PriceProduct" class="label-control">Detail</label>
                <textarea
                  v-model="DataAdd.Pdetail"
                  type="text"
                  name="Pdetail"
                  class="form-control"
                  id="DetailProduct"
                  placeholder="Detail Product ......."
                  required
                />
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="PriceProduct" class="label-control"
                      >Class</label
                    >
                    <select
                      class="form-control dropdown"
                      v-model="DataAdd.Pclass"
                      name="Pclass"
                      required
                    >
                      <option value="">Select Class .........</option>
                      <option value="1">Bag</option>
                      <option value="2">Shirt</option>
                      <option value="3">Scarf</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="PriceProduct" class="label-control"
                      >Image</label
                    >
                    <input
                      type="file"
                      @change="onAddFileImageChange"
                      name="user_photo"
                      accept="image/jpeg, image/png"
                      class="form-control"
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="mx-auto" style="width: 140px">
                <img
                  v-if="file_photo_add"
                  :src="file_photo_add"
                  class="rounded-circle"
                  alt=""
                  width="auto"
                  height="140px;"
                />
                <img
                  v-else
                  src=""
                  class="rounded-circle"
                  alt=""
                  width="100%"
                  height="140px;"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                id="closeModalAdd"
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";
import "jquery/dist/jquery.min.js";
import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

export default {
  data() {
    return {
      DataList: [],
      DataEdit: {
        id: "",
        Pname: "",
        Pprice: "",
        Pdetail: "",
        Pclass: "",
        Pimage: "",
      },
      file_photo_edit: "",
      DataAdd: {
        Pname: "",
        Pprice: "",
        Pdetail: "",
        Pclass: "",
        Pimage: "",
      },
      file_photo_add: "",
      loadingModel: true,
    };
  },
  mounted() {
    this.getProducts();
  },
  methods: {
    getProducts() {
      axios
        .get("/api/products/index/list")
        .then((res) => {
          this.DataList = res.data;
          //   console.log(this.DataList);
          this.UseDataTable();
        })
        .catch((error) => {
          console.log("error");
        });
    },
    getEditProduct(value) {
      axios
        .get("/api/products/edit/" + value)
        .then((res) => {
          this.DataEdit = {
            id: res.data.id,
            Pname: res.data.Pname,
            Pprice: res.data.Pprice,
            Pdetail: res.data.Pdetail,
            Pclass: res.data.Pclass,
          };
          this.file_photo_edit = "http://127.0.0.1:8000/" + res.data.Pimage;
          // console.log(this.DataEdit);
          this.loadingModel = false;
        })
        .catch((error) => {
          console.log("error");
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
      });
    },
    updateProduct() {
      let formData = new FormData();
      formData.append("Pname", this.DataEdit.Pname);
      formData.append("Pdetail", this.DataEdit.Pdetail);
      formData.append("Pclass", this.DataEdit.Pclass);
      formData.append("Pprice", this.DataEdit.Pprice);

      if (this.DataEdit.Pimage != "") {
        formData.append("Pimage", this.DataEdit.Pimage);
      }

      // update original!
      axios
        .post("/api/products/update/" + this.DataEdit.id, formData)
        .then((res) => {
          // close
          $("#closeModal").click();

          // refresh
          window.location.reload();
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    DeleteProduct(value, index) {
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
            .get("/api/products/delete/" + value)
            .then((response) => {
              this.$swal("Deleted!", "Your file has been deleted.", "success");
              this.DataList.splice(index, 1);
            })
            .catch((error) => {
              console.log("error");
            });
        }
      });
    },
    AddProduct() {
      let formData = new FormData();
      formData.append("Pimage", this.DataAdd.Pimage);
      formData.append("Pname", this.DataAdd.Pname);
      formData.append("Pdetail", this.DataAdd.Pdetail);
      formData.append("Pclass", this.DataAdd.Pclass);
      formData.append("Pprice", this.DataAdd.Pprice);

      axios
        .post("/api/products/addProduct/store", formData)
        .then((response) => {
          // close
          $("#closeModalEdit").click();

          //refresh
          window.location.reload();
        })
        .catch((error) => {
          console.log("error");
        });
    },
    clockClose() {
      setTimeout(() => {
        this.loadingModel = true;
      }, 1000);
    },
    onAddFileImageChange(e) {
      const file = e.target.files[0];
      this.file_photo_add = URL.createObjectURL(file);

      this.DataAdd.Pimage = e.target.files[0];
      //   console.log(this.file_photo_add);
    },
    onEditFileImageChange(e) {
      const file = e.target.files[0];
      this.file_photo_edit = URL.createObjectURL(file);
      this.DataEdit.Pimage = e.target.files[0];
      //   console.log(this.file_photo_edit);
    },
  },
};

Vue.filter("truncate", function (value, length) {
  if (!value) return "";
  value = value.toString();
  if (value.length > length) {
    return value.substring(0, length) + "...";
  } else {
    return value;
  }
});
</script>

<style>
</style>
