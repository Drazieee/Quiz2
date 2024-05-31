<template>
  <HeaderPage />
  <section id="cart">
    <div class="wrapper">
      <div class="cart-con">
        <h2>My Cart</h2>
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
#cart .wrapper {
  max-width: 1440px;
}

#cart .cart-con {
  padding: 100px 0;
}
</style>