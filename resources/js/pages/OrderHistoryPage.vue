<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-header">Order History</div>
      <div class="card-body">Bienvenue sur votre trading history.</div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      info: [],
    };
  },
  props: ["auth_user"],
};
</script>
