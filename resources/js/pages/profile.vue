<template>
  <section class="bg-light">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Profile</h1>
    <p class="mb-4">
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit itaque
      in eaque harum ratione consequatur, deleniti quisquam inventore, dolore
      error facere illum perspiciatis? Excepturi, rem cupiditate accusantium
      esse maxime quaerat.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="container rounded bg-white mt-5">
          <form v-on:submit.prevent="updateProfile" method="post">
            <div class="row">
              <div class="col-md-4 border-right">
                <div
                  class="
                    d-flex
                    flex-column
                    align-items-center
                    text-center
                    p-3
                    py-5
                  "
                >
                  <img
                    v-if="file_photo"
                    :src="file_photo"
                    class="rounded-circle mt-5"
                    alt=""
                    width="90"
                  />
                  <img
                    v-else
                    :src="infoProfile.image"
                    class="rounded-circle mt-5"
                    alt=""
                    width="90"
                  /><span class="font-weight-bold">{{ nameShow }}</span
                  ><span class="text-black-50">{{ emailShow }}</span
                  ><span>Thailand</span>
                  <div class="form-group mt-2">
                    <input
                      type="file"
                      @change="onAddFileImageChange"
                      name="user_photo"
                      accept="image/jpeg, image/png"
                      class="form-control"
                    />
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="p-3 py-5">
                  <div
                    class="
                      d-flex
                      justify-content-between
                      align-items-center
                      mb-3
                    "
                  >
                    <div class="d-flex flex-row align-items-center back">
                      <a
                        href="/home"
                        class="text-decoration-none text-dark text-muted"
                        ><i class="fas fa-long-arrow-alt-left mr-1 mb-1"></i>
                        Back to home</a
                      >
                    </div>
                    <h6 class="text-right">Edit Profile</h6>
                  </div>
                  <div class="form-group">
                    <div class="row mt-2">
                      <div class="col-md-6 mb-2">
                        <input
                          v-model="infoProfile.name"
                          type="text"
                          class="form-control"
                          placeholder="ชื่อ - นามสกุล ..."
                        />
                      </div>
                      <div class="col-md-6 mb-2">
                        <input
                          v-model="infoProfile.email"
                          type="text"
                          class="form-control"
                          placeholder="อีเมล ..."
                        />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea
                      class="form-control"
                      name=""
                      id=""
                      placeholder="ที่อยู่ ..."
                      readonly
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <div class="row mt-3">
                      <div class="col-md-6 mb-2">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="เบอร์โทร ..."
                          readonly
                        />
                      </div>
                      <div class="col-md-6 mb-2">
                        <input
                          type="text"
                          class="form-control"
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
                          class="form-control"
                          placeholder="อำเภอ/เขต"
                          readonly
                        />
                      </div>
                      <div class="col-md-6 mb-2">
                        <input
                          type="text"
                          class="form-control"
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
                          type="text"
                          class="form-control"
                          placeholder="รหัสไปรษณีย์ ..."
                          readonly
                        />
                      </div>
                      <div class="col-md-6 mb-2">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          data-bs-toggle="modal"
                          data-bs-target="#CurrentPassword"
                        >
                          เปลี่ยนรหัสผ่าน (Change password)
                        </button>
                      </div>
                      <button
                        type="button"
                        id="ShowFormNewPassword"
                        class="d-none"
                        data-bs-toggle="modal"
                        data-bs-target="#NewPassword"
                      ></button>
                    </div>
                  </div>
                  <div class="mt-5 text-right">
                    <button
                      class="btn btn-primary profile-button"
                      type="submit"
                    >
                      Save Profile
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal current_password -->
    <div
      class="modal fade"
      id="CurrentPassword"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form v-on:submit.prevent="CurrentPassword" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                Current password
              </h5>
              <i
                type="button"
                class="fas fa-times"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></i>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="NameProducts" class="label-control">Password</label>
                <input
                  v-model="current_password"
                  type="password"
                  name="current_password"
                  class="form-control"
                  placeholder="Current password ......."
                  required
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                id="closeModalCurrentPassword"
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

    <!-- Modal new password -->
    <div
      class="modal fade"
      id="NewPassword"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form
            v-on:submit.prevent="UpdateNewPassword"
            method="post"
            oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'
          >
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New password</h5>
              <i
                type="button"
                class="fas fa-times"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></i>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label class="label-control">Password</label>
                <input
                  v-model="new_password"
                  id="password"
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="Password ......."
                  required
                />
              </div>
              <div class="form-group">
                <label class="label-control">Password confirm</label>
                <input
                  id="password_confirmation"
                  type="password"
                  name="password_confirm"
                  class="form-control"
                  placeholder="Password confirm ......."
                  required
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                id="closeModalNewPassword"
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
import $ from "jquery";
export default {
  data() {
    return {
      current_password: "",
      new_password: "",
      infoProfile: {
        name: "",
        email: "",
        image: "",
      },
      file_photo: "",
      image: "",
      nameShow: "",
      emailShow: "",
      imageNull: "",
    };
  },
  mounted() {
    this.getInfoProfile();
  },
  methods: {
    getInfoProfile() {
      axios
        .get("/info/profile")
        .then((response) => {
          console.log(response.data);
          this.infoProfile = {
            id: response.data.id,
            name: response.data.name,
            email: response.data.email,
            image: response.data.image,
          };
          this.nameShow = response.data.name;
          this.emailShow = response.data.email;

          if (this.infoProfile.image == null) {
            this.infoProfile.image =
              "https://image.shutterstock.com/mosaic_250/169412572/1040084344/stock-vector-man-icon-vector-1040084344.jpg";
          }
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    updateProfile() {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update it!",
      }).then((result) => {
        if (result.value) {
          let formData = new FormData();
          formData.append("name", this.infoProfile.name);
          formData.append("email", this.infoProfile.email);

          if (this.image != "") {
            formData.append("image", this.image);
          }

          // update original!
          axios
            .post("/api/profile/update/" + this.infoProfile.id, formData)
            .then((res) => {
              // reload page
              location.reload();
            })
            .catch((err) => {
              this.error = "Error!!";
            });
        }
      });
    },
    CurrentPassword() {
      axios
        .post("/api/profile/checkPasswprd/" + this.infoProfile.id, {
          current_password: this.current_password,
        })
        .then((res) => {
          if (res.data.success == true) {
            $("#closeModalCurrentPassword").click();
            // clear value
            this.current_password = "";
            $("#ShowFormNewPassword").click();
          } else {
            this.$swal("Alert!", "Password does not match.", "warning");
          }
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    UpdateNewPassword() {
      axios
        .post("/api/profile/changePasswprd/" + this.infoProfile.id, {
          new_password: this.new_password,
        })
        .then((res) => {
          if (res.data.success === true) {
            $("#closeModalNewPassword").click();
            this.$swal("Updated!", "Your profile has been updated.", "success");
            // clear value
            this.new_password = "";
          }
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    onAddFileImageChange(e) {
      const file = e.target.files[0];
      this.file_photo = URL.createObjectURL(file);

      this.image = e.target.files[0];
    },
  },
};
</script>

<style>
</style>
