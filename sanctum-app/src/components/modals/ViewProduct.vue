<template>
  <div
    v-if="openClose"
    class="modal fade show modal-lg"
    tabindex="-1"
    aria-hidden="true"
    id="viewProduct"
    style="display: block"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <img src="../../assets/default_product.webp" alt="Image" />
          <div class="product-details-con">
            <div class="product-name-con">
              <h3>{{ displayedProduct.product_name }}</h3>
            </div>
            <p>{{ displayedProduct.product_description }}</p>
            <p>Stocks: {{ displayedProduct.quantity }}</p>
            <p>₱ {{ displayedProduct.price }}</p>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn-secondary" @click="CloseModal()">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "ViewProduct",
  data() {
    return {
      openClose: this.visible,
      displayedProduct: {
        productName: "",
        productDescription: "",
        productQuantity: 0,
        price: 0,
      },
    };
  },
  props: {
    visible: Boolean,
    product: Object,
  },
  methods: {
    CloseModal() {
      this.openClose = !this.openClose;
      this.$emit("update:visible", false);
      this.$emit("modal-closed");
    },
  },
  watch: {
    visible: {
      handler(newVal) {
        this.openClose = newVal;
      },
    },
    product: {
      handler(newVal) {
        this.displayedProduct = newVal;
      },
      deep: true,
    },
  },
};
</script>

<style scoped>
#viewProduct .modal-body {
  display: flex;
  align-items: center;
  gap: 20px;
}

#viewProduct .product-name-con h3 {
  font-size: 30px;
  font-weight: 700;
}

#viewProduct img {
  width: 250px;
  height: 200px;
  object-fit: cover;
}
</style>