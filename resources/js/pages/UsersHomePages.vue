<template>
  <div class="container">
    <div v-if="this.loading" id="load"></div>
    <div class="card card-default">
      <div class="card-header">User Dashboard</div>
      <div class="card-body">Bienvenue sur votre dashboard user</div>
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
  mounted() {
    setTimeout(() => {
      this.loading = false;
    }, 1000);
  },
};
</script>

<style>
#load {
  position: fixed;
  width: 81%;
  height: 81%;
  z-index: 9999;
  background: url("https://cdn.discordapp.com/attachments/773251194344570923/934464155644211210/XOsX.gif")
    50% 50% no-repeat rgb(249, 249, 249);
  background-size: 100px;
}
</style>
