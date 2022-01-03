<template>
  <section>
    <div id="contact">
      <div class="container-fluid">
        <div class="bg-white shadow-lg my-3 p-3">
          <div class="text-center mb-3">
            <h3>Contact</h3>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <form>
                <div class="mb-3">
                  <label for="exampleInputFristname" class="form-label"
                    >Fristname</label
                  >
                  <input
                    type="text"
                    name="fristname"
                    class="form-control"
                    id="exampleInputFristname"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputLastname" class="form-label"
                    >Lastname</label
                  >
                  <input
                    type="text"
                    name="lastname"
                    class="form-control"
                    id="exampleInputLastname"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label"
                    >Email address</label
                  >
                  <input
                    id="exampleInputEmail1"
                    class="form-control"
                    type="email"
                    name="email"
                    aria-describedby="emailHelp"
                    required
                  />
                  <div id="emailHelp" class="form-text">
                    We'll never share your email with anyone else.
                  </div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputMassages" class="form-label"
                    >Massages</label
                  >
                  <div class="form-floating">
                    <textarea
                      id="exampleInputMassages"
                      class="form-control"
                      name="massages"
                      style="height: 100px"
                      required
                    ></textarea>
                    <label for="exampleInputMassages">massages</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
            <div class="col-md-6">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3774.8296456381013!2d99.00867291398986!3d18.894637162560155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3cca984ecc69%3A0x2980791c600add52!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4LmB4Lih4LmI4LmC4LiI4LmJ!5e0!3m2!1sth!2sth!4v1640677440047!5m2!1sth!2sth"
                width="100%"
                height="450px"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
              ></iframe>
            </div>
          </div>
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
