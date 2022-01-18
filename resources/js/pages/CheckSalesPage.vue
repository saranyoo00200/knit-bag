<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-header">Check sales</div>
      <div class="card-body">Welcome to check the sale.</div>
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
