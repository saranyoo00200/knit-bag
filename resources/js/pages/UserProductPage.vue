<template>
  <section>
    <div id="contact">
      <div class="container-fluid">
        <div class="bg-white shadow-lg my-3 p-3">
          <div class="text-center mb-3">
            <h3>My Product</h3>
          </div>
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
              <tr>
                <th scope="row">1</th>
                <td>Image</td>
                <td>Bag01</td>
                <td>350.00</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-outline-secondary p-1" href=""
                      ><i class="fas fa-plus"></i
                    ></a>
                    <span class="fs-5 badge text-dark">1</span>
                    <a class="btn btn-outline-secondary p-1" href=""
                      ><i class="fas fa-minus"></i
                    ></a>
                  </div>
                </td>
                <td>
                  <a class="btn btn-danger" href="">Delete</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "index",
  data() {
    return {
      dataLists: [],
    };
  },
  mounted() {
    this.getProducts();
  },
  methods: {
    getProducts() {
      axios
        .get("/api/products/show")
        .then((res) => {
          this.dataLists = res.data;
        })
        .catch((error) => {
          console.log("error");
        });
      //   console.log(this.dataLists);
    },
  },
};
</script>

<style>
</style>
