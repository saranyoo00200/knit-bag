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
              src="https://img.freepik.com/free-photo/multiple-colored-balls-yarn-top-view_1268-17322.jpg?size=626&ext=jpg"
              height="400px"
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
              src="https://st4.depositphotos.com/36458286/38379/i/450/depositphotos_383791554-stock-photo-string-bag-process-knitting-turquoise.jpg"
              height="400px"
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
              src="https://wallpaperaccess.com/full/2135518.jpg"
              height="400px"
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
        <div class="d-flex justify-content-center mb-2">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button
                class="nav-link fs-5 active"
                id="bag-tab"
                data-bs-toggle="tab"
                data-bs-target="#bag"
                type="button"
                role="tab"
                aria-controls="bag"
                aria-selected="true"
              >
                BAG
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link fs-5"
                id="shirt-tab"
                data-bs-toggle="tab"
                data-bs-target="#shirt"
                type="button"
                role="tab"
                aria-controls="shirt"
                aria-selected="false"
              >
                SHIRT
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link fs-5"
                id="contact-tab"
                data-bs-toggle="tab"
                data-bs-target="#contact"
                type="button"
                role="tab"
                aria-controls="contact"
                aria-selected="false"
              >
                SCARF
              </button>
            </li>
          </ul>
        </div>

        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="bag"
            role="tabpanel"
            aria-labelledby="bag-tab"
          >
            <div class="row">
              <div
                v-for="(data, index) in dataLists"
                :key="index"
                class="col-md-4 mb-3"
              >
                <div class="card">
                  <img :src="data.Pimage" height="400px" class="card-img-top w-100" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">{{ data.Pname }}</h5>
                    <p
                      class="card-text"
                      :inner-html.prop="data.Pdetail | truncate(70)"
                    ></p>
                    <a href="#" class="btn btn-primary">หยิบใส่ตะกร้า</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="shirt"
            role="tabpanel"
            aria-labelledby="shirt-tab"
          >
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <img
                    src="https://cf.shopee.co.th/file/9de1b6ca5b9fa7bcad2cf96f8aaccc72"
                    class="card-img-top"
                    alt="..."
                  />
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-primary">หยิบใส่ตะกร้า</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
          >
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <img
                    src="https://cf.shopee.co.th/file/06d92961e36548efe8f4ed43c8aaeb04"
                    class="card-img-top"
                    alt="..."
                  />
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-primary">หยิบใส่ตะกร้า</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
    };
  },
  mounted() {
    axios
      .get("/api/products/show")
      .then((response) => {
        this.dataLists = response.data;
      })
      .catch((error) => {
        console.log("error");
      });
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
