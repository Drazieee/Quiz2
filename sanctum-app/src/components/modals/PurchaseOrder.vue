<template>
  <div
    v-if="openClose"
    class="modal fade show"
    tabindex="-1"
    aria-hidden="true"
    style="display: block"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="field-con">
            <input
              type="text"
              class="form-control"
              id="productName"
              v-model="productName"
              placeholder="Product Name"
              required
            />
          </div>
          <div class="field-con">
            <input
              type="text"
              class="form-control"
              id="productDescription"
              placeholder="Product Description"
              v-model="productDescription"
              required
            />
          </div>
          <div class="field-con">
            <input
              type="number"
              class="form-control"
              id="productQuantity"
              placeholder="Product Quantity"
              v-model="productQuantity"
              required
            />
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn-secondary" @click="OpenCloseModal()">Close</button>
          <button type="button" class="btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import axios from "axios";
export default {
  name: "PurchaseOrder",
  data() {
    return {
      openClose: this.visible,
      productDescription: "",
      productQuantity: "",
      errors: null,
    };
  },
  props: {
    visible: Boolean,
    product: Object,
  },
  methods: {
    OpenCloseModal() {
      this.openClose = !this.openClose;
      this.$emit("update:visible", false);
      this.$emit("modal-closed");
    },
    async SaveNewPost() {
      try {
        const response = await axios.post(
          this.$store.state.apiUrl + "/addProduct",
          {
            productName: this.productName,
            productDescription: this.productDescription,
            productQuantity: this.productQuantity,
            user_id: localStorage.getItem("user_id"),
          }
        );
        if (response.status === 201) {
          this.openClose = !this.openClose;
          this.$emit("update:visible", false);
          this.$emit("modal-closed");
        }
      } catch (error) {
        alert(error.response.data.message);
        this.errors = error.response.data.message;
      }
    },
  },
  watch: {
    visible: {
      handler(newVal) {
        this.openClose = newVal;
      },
    },
    product: {
      handler(product) {
        this.productName = product.productName;
        this.productDescription = product.productDescription;
      },
    },
  },
};
</script>