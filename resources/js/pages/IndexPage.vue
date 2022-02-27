<template>
  <section class="bg-light">
    <div id="header-slide">
      <div
        id="carouselExampleCaptions"
        class="carousel slide mb-3"
        data-bs-ride="carousel"
        data-bs-interval="5000"
      >
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="https://cdn.discordapp.com/attachments/773251194344570923/934489702990483466/271407417_347288056986686_618822836729769351_n.jpg"
              height="530px"
              class="d-block w-100"
              alt="..."
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>
                Some representative placeholder content for the first slide.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="https://cdn.discordapp.com/attachments/773251194344570923/934489703246344242/271591661_1332710613807773_3246559653038667427_n.jpg"
              height="530px"
              class="d-block w-100"
              alt="..."
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>
                Some representative placeholder content for the second slide.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="https://cdn.discordapp.com/attachments/773251194344570923/934489703581904926/271781371_4658030667579084_968520632802453409_n.jpg"
              height="530px"
              class="d-block w-100"
              alt="..."
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>
                Some representative placeholder content for the third slide.
              </p>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div id="Products">
      <div class="container">
        <section class="products-content">
          <h2 class="text-center p-3">BAG</h2>

          <div class="row">
            <div
              v-for="(data, index) in dataLists"
              :key="index"
              class="col-md-4 mb-3"
            >
              <div class="card">
                <img
                  :src="data.Pimage"
                  height="400px"
                  class="card-img-top w-100"
                  alt="..."
                />
                <div class="card-body text-center">
                  <h5 class="card-title">{{ data.Pname }}</h5>
                  <p>Price: {{ data.Pprice }}</p>
                  <p
                    class="card-text"
                    :inner-html.prop="data.Pdetail | truncate(70)"
                  ></p>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#ClickShowInfoProduct"
                    @click="GetClickProduct(data.id)"
                  >
                    เลือกสินค้า
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <!-- Modal show info product -->
    <div
      class="modal fade"
      id="ClickShowInfoProduct"
      tabindex="-1"
      aria-labelledby="modalInfoProduct"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form v-on:submit.prevent="submit" method="post">
            <div class="modal-header d-flex justify-content-end">
              <i
                @click="clockClose"
                type="button"
                class="fas fa-times"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></i>
            </div>
            <div class="modal-body text-center">
              <div v-if="loadingModel" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
              <div v-else class="info-body">
                <div class="header-image mb-3">
                  <img class="w-25" :src="infoClickProduct.Pimage" alt="" />
                </div>
                <div class="body-text">
                  <div class="title-text">
                    <h4>{{ infoClickProduct.Pname }}</h4>
                  </div>
                  <div class="body-text">
                    <p>{{ infoClickProduct.Pdetail }}</p>
                  </div>
                </div>
                <div class="footer-text d-flex justify-content-center">
                  <a @click="DeleteNumPro" class="btn btn-default">
                    <i class="fas fa-minus-square"></i>
                  </a>
                  <h3>{{ productNumber }}</h3>
                  <a @click="PushNumPro" class="btn btn-default">
                    <i class="fas fa-plus-circle"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                @click="clockClose"
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
export default {
  data() {
    return {
      dataLists: [],
      infoClickProduct: [],
      productNumber: 0,
      loadingModel: true,
    };
  },
  props: ["auth_user"],
  mounted() {
    axios
      .get("/api/products/show")
      .then((res) => {
        this.dataLists = res.data;
      })
      .catch((error) => {
        console.log("error");
      });
  },
  methods: {
    GetClickProduct(value) {
      axios
        .get("/api/get/products/info/product/" + value)
        .then((res) => {
          this.infoClickProduct = res.data;
          this.loadingModel = false;
        })
        .catch((error) => {
          console.log("error");
        });
    },
    PushNumPro() {
      this.productNumber++;
    },
    DeleteNumPro() {
      if (this.productNumber > 0) {
        this.productNumber--;
      }
    },
    clockClose() {
      setTimeout(() => {
        this.loadingModel = true;
        this.productNumber = 0;
      }, 1000);
    },
    submit() {
      if (this.productNumber != 0) {
        if (this.auth_user) {
          axios
            .post("/api/users/addProduct/create", {
              user_id: this.auth_user.id,
              product_id: this.infoClickProduct.id,
              number: this.productNumber,
            })
            .then((res) => {
              window.location.assign("/my-products");
            })
            .catch((error) => {
              console.log("error!");
            });
        } else {
          window.location.assign("/login");
        }
      } else {
        this.$swal(
          "Alert!",
          "Please specify the number of products.",
          "warning"
        );
      }
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
