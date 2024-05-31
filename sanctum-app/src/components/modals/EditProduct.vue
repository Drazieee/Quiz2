<template>
  <div
    v-if="openClose"
    class="modal fade show"
    tabindex="-1"
    aria-hidden="true"
    id="viewProduct"
    style="display: block"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="field-con">
            <input
              type="text"
              id="productName"
              v-model="this.$store.state.product.product_name"
              @input="updateProductName"
              placeholder="Enter Product Name"
              required
            />
          </div>
          <div class="field-con">
            <input
              type="text"
              id="productDescription"
              v-model="this.$store.state.product.product_description"
              @input="updateProductDescription"
              placeholder="Enter Product Description"
              required
            />
          </div>
          <div class="field-con">
            <input
              type="text"
              id="productQuantity"
              v-model="this.$store.state.product.quantity"
              @input="updateProductQuantity"
              placeholder="Enter Product Quantity"
              required
            />
          </div>
          <div class="field-con">
            <input
              type="text"
              id="productPrice"
              v-model="this.$store.state.product.price"
              @input="updateProductPrice"
              placeholder="Enter Product Price"
              required
            />
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn-secondary" @click="CloseModal()">Close</button>
          <button
            type="button"
            @click="UpdateProduct()"
            class="btn btn-primary"
          >
            Update
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "EditProduct",
  data() {
    return {
      openClose: this.visible,
      productName: this.$store.state.product.product_name,
      productDescription: this.$store.state.product.product_description,
      quantity: this.$store.state.product.quantity,
      price: this.$store.state.product.price,
      errors: null,
    };
  },
  props: {
    visible: Boolean,
  },
  methods: {
    updateProductName() {
      this.$store.dispatch(
        "updateProductName",
        this.$store.state.product.product_name
      );
    },
    updateProductDescription() {
      this.$store.dispatch(
        "updateProductDescription",
        this.$store.state.product.product_description
      );
    },
    updateProducQuantity() {
      this.$store.dispatch(
        "updateProducQuantity",
        this.$store.state.product.quantity
      );
    },
    updateProductPrice() {
      this.$store.dispatch(
        "updateProductPrice",
        this.$store.state.product.price
      );
    },
    async UpdateProduct() {
      try {
        const response = await axios.put(
          this.$store.state.apiUrl +
            "/editProduct/" +
            this.$store.state.product.product_id,
          {
            productName: this.$store.state.product.product_name,
            productDescription: this.$store.state.product.product_description,
            quantity: this.$store.state.product.quantity,
            price: this.$store.state.product.price,
            user_id: localStorage.getItem("user_id"),
          }
        );

        if (response.status === 200) {
          this.openClose = !this.openClose;
          this.$emit("update:visible", false);
          this.$emit("modal-closed");
        }
      } catch (error) {
        alert(error.response.data.message);
      }
    },
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
  },
};
</script>
  
<style scoped>
#viewProduct img {
  width: 250px;
  height: 200px;
  object-fit: cover;
}
</style>