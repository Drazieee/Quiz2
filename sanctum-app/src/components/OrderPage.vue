<template>
  <HeaderPage />
  <section id="order">
    <div class="wrapper">
      <div class="order-containter">
        <h2>MyOrders</h2>
      </div>
    </div>
  </section>
</template>

<script>
import HeaderPage from "./partials/HeaderPage.vue";
export default {
  data() {
    return {};
  },
  components: {
    HeaderPage,
  },
};
</script>

<style scoped>
#order .wrapper {
  max-width: 1440px;
}

#order .order-containter {
  padding: 100px 0;
}
</style>
