<template>
  <section class="bg-light">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users Manage</h1>
    <p class="mb-4">
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit itaque
      in eaque harum ratione consequatur, deleniti quisquam inventore, dolore
      error facere illum perspiciatis? Excepturi, rem cupiditate accusantium
      esse maxime quaerat.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Users Tables</h6>
        <button
          type="button"
          class="btn btn-success"
          data-bs-toggle="modal"
          data-bs-target="#AddUsers"
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
                <th>Email</th>
                <th>Status</th>
                <th>Tool</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Tool</th>
              </tr>
            </tfoot>
            <tbody>
              <tr v-for="(data, index) in DataList" :key="index">
                <td>{{ index + 1 }}</td>
                <td>
                  <div v-if="data.image == null">
                    <img
                      src="https://prinnie333.com/assets/img/unknow.jpg"
                      width="50px"
                      alt=""
                    />
                  </div>
                  <div v-else>
                    <img :src="data.image" width="50px" alt="" />
                  </div>
                </td>
                <td>{{ data.name }}</td>
                <td>{{ data.email }}</td>
                <td>Active</td>
                <td>
                  <button
                    @click="getEditUsers(data.id)"
                    class="btn btn-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#EditUsers"
                  >
                    <i class="fas fa-edit"></i>
                  </button>
                  <button
                    @click="DeleteUsers(data.id, index)"
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
      id="EditUsers"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form
            v-on:submit.prevent="updateUsers"
            method="post"
            oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'
          >
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
              <i
                type="button"
                class="fas fa-times"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></i>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="NameUsers" class="label-control">Name</label>
                <input
                  v-model="InfoEdit.name"
                  type="text"
                  name="name"
                  class="form-control"
                  id="NameUsers"
                  placeholder="First name - Last name  .......... "
                  required
                />
              </div>
              <div class="form-group">
                <label for="UsersEmail" class="label-control">Email</label>
                <input
                  v-model="InfoEdit.email"
                  type="text"
                  name="email"
                  class="form-control"
                  id="UsersEmail"
                  placeholder="Eamil .......... "
                  required
                />
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password" class="label-control">Password</label>
                    <input
                      v-model="InfoEdit.password"
                      id="password"
                      type="password"
                      class="form-control"
                      name="password"
                      placeholder="password .........."
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password_confirmation" class="label-control"
                      >Password confirm</label
                    >
                    <input
                      v-model="InfoEdit.password_confirmation"
                      id="password_confirmation"
                      type="password"
                      name="password_confirmation"
                      class="form-control"
                      placeholder="password confirmation .........."
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="UsersStatus" class="label-control"
                      >Usage status</label
                    >
                    <select
                      v-model="InfoEdit.status"
                      id="UsersStatus"
                      class="form-control dropdown"
                      name="status"
                      required
                    >
                      <option value="">Select status ..........</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="UsersFileImage" class="label-control"
                      >Image</label
                    >
                    <input
                      type="file"
                      @change="onEditFileImageChange"
                      name="user_photo"
                      id="UsersFileImage"
                      accept="image/jpeg, image/png"
                      class="form-control"
                      multiple
                    />
                  </div>
                </div>
              </div>
              <div class="image-show">
                <div class="mx-auto" style="width: 140px">
                  <img
                    :src="file_photo_edit"
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
                id="closeModalEdit"
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

    <!-- Modal Add Product-->
    <div
      class="modal fade"
      id="AddUsers"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form
            v-on:submit.prevent="AddUsers"
            method="post"
            oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'
          >
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
              <div class="form-group">
                <label for="AddNameUsers" class="label-control">Name</label>
                <input
                  v-model="InfoAdd.name"
                  type="text"
                  name="name"
                  class="form-control"
                  id="AddNameUsers"
                  placeholder="First name - Last name  .......... "
                  required
                />
              </div>
              <div class="form-group">
                <label for="AddUsersEmail" class="label-control">Email</label>
                <input
                  v-model="InfoAdd.email"
                  type="text"
                  name="email"
                  class="form-control"
                  id="AddUsersEmail"
                  placeholder="Eamil .......... "
                  required
                />
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="AddPassword" class="label-control"
                      >Password</label
                    >
                    <input
                      v-model="InfoAdd.password"
                      id="AddPassword"
                      type="password"
                      class="form-control"
                      name="password"
                      placeholder="password .........."
                      required
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="AddPassword_confirmation" class="label-control"
                      >Password confirm</label
                    >
                    <input
                      v-model="InfoAdd.password_confirmation"
                      id="AddPassword_confirmation"
                      type="password"
                      name="password_confirmation"
                      class="form-control"
                      placeholder="password confirmation .........."
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="AddUsersFileImage" class="label-control"
                  >Image</label
                >
                <input
                  type="file"
                  @change="onAddFileImageChange"
                  name="user_photo"
                  id="AddUsersFileImage"
                  accept="image/jpeg, image/png"
                  class="form-control"
                  multiple
                />
              </div>
              <div class="image-show">
                <div class="mx-auto" style="width: 140px">
                  <img
                    :src="file_photo_add"
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
      InfoEdit: {
        id: "",
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        status: "",
        image: "",
      },
      file_photo_edit: "",
      InfoAdd: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        image: "",
      },
      file_photo_add:
        "https://www.kpsq.org/wp-content/uploads/2019/07/Community-hour-blank-face.jpg",
    };
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    getUsers() {
      axios
        .get("/api/users/index/list")
        .then((res) => {
          this.DataList = res.data;
          this.UseDataTable();
        })
        .catch((error) => {
          console.log("error");
        });
    },
    getEditUsers(value) {
      axios
        .get("/api/users/edit/" + value)
        .then((res) => {
          this.InfoEdit = {
            id: res.data.id,
            name: res.data.name,
            email: res.data.email,
            status: res.data.status,
          };
          if (res.data.image) {
            this.file_photo_edit = res.data.image;
          } else {
            this.file_photo_edit =
              "https://www.kpsq.org/wp-content/uploads/2019/07/Community-hour-blank-face.jpg";
          }
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
    updateUsers() {
      let formData = new FormData();
      formData.append("name", this.InfoEdit.name);
      formData.append("email", this.InfoEdit.email);
      formData.append("status", this.InfoEdit.status);
      if (this.InfoEdit.password != "") {
        formData.append("password", this.InfoEdit.password);
      }
      if (this.InfoEdit.image != "") {
        formData.append("image", this.InfoEdit.image);
      }

      // update original!
      axios
        .post("/api/users/update/" + this.InfoEdit.id, formData)
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
    DeleteUsers(value, index) {
      // API Delete
      if (confirm("Do you really want to delete?")) {
        axios
          .get("/api/users/delete/" + value)
          .then((response) => {
            this.DataList.splice(index, 1);
          })
          .catch((error) => {
            console.log("error");
          });
      }
    },
    AddUsers() {
      let formData = new FormData();
      formData.append("name", this.InfoAdd.name);
      formData.append("email", this.InfoAdd.email);
      formData.append("password", this.InfoAdd.password);
      formData.append("image", this.InfoAdd.image);

      axios
        .post("/api/users/addUsers/create", formData)
        .then((response) => {
          // close
          $("#closeModalAdd").click();
          //refresh
          window.location.reload();
        })
        .catch((error) => {
          console.log("error");
        });
    },
    onAddFileImageChange(e) {
      const file = e.target.files[0];
      this.file_photo_add = URL.createObjectURL(file);

      this.InfoAdd.image = e.target.files[0];
      //   console.log(this.file_photo_add);
    },
    onEditFileImageChange(e) {
      const file = e.target.files[0];
      this.file_photo_edit = URL.createObjectURL(file);

      this.InfoEdit.image = e.target.files[0];
      //   console.log(this.file_photo_edit);
    },
  },
};
</script>

<style>
</style>
