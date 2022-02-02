<template>
  <div class="container">
    <div v-if="this.loading" id="load"></div>
    <div class="card card-default">
      <div class="card-header">Order History</div>
      <div class="card-body">
        <p>Bienvenue sur votre trading history.</p>
        <div class="table-responsive p-3">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col" class="w-100">Date</th>
                <th scope="col">Tool</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>date and time...</td>
                <td>
                  <button class="btn btn-primary">
                    <i class="fas fa-eye"></i>
                  </button>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>date and time...</td>
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
export default {
  data() {
    return {
      loading: true,
    };
  },
  props: ["auth_user"],
  mounted() {
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
