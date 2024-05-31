<template>
  <HeaderPage />
  <section id="store">
    <div class="wrapper">
      <div class="store-container">
        <div class="header-container">
          <h2>My Store</h2>
          <button @click="toggleAddProduct" class="btn-primary">
            ADD NEW PRODUCT
          </button>
        </div>
        <div class="product-list-con">
          <div
            class="product-widget"
            v-for="product in products"
            :key="product.id"
          >
            <div class="product-img-con">
              <img src="../assets/default_product.jpg" alt="Image" />
            </div>
            <div class="product-details">
              <h4>{{ product.product_name }}</h4>
              <p>{{ product.product_description }}</p>
              <p>₱ {{ product.quantity }}</p>
            </div>
            <div class="product-button-con">
              <button
                class="btn-primary"
                @click="toggleEditProduct(product.product_id)"
              >
                Edit
              </button>
              <button
                class="btn-primary"
                @click="toggleDeleteProduct(product.product_id)"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <AddProduct :visible="showAddProduct" @update:visible="toggleAddProduct" />
    <EditProduct :visible="showEditModal" @update:visible="toggleEditProduct" />
    <DeleteProduct
      :visible="showDeleteProduct"
      @update:visible="toggleDeleteProduct"
    />
  </section>
</template>

<script>

import AddProduct from "./modals/AddProduct.vue";
import HeaderPage from "./partials/HeaderPage.vue";
import EditProduct from "./modals/EditProduct.vue";
import DeleteProduct from "./modals/DeleteProduct.vue";
export default {
  data() {
    return {
      showAddProduct: false,
      showEditModal: false,
      showDeleteProduct: false,
    };
  },
  components: {
    AddProduct,
    HeaderPage,
    EditProduct,
    DeleteProduct,
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      await this.$store.dispatch("fetchProducts");
    },
    toggleAddProduct() {
      this.showAddProduct = !this.showAddProduct;

      if (!this.showAddProduct) {
        this.$store.dispatch("fetchProducts");
      }
    },
    toggleEditProduct(id) {
      this.$store.getters.getProduct(id);
      this.showEditModal = !this.showEditModal;

      if (this.showEditModal == false) {
        this.$store.dispatch("fetchProducts");
      }
    },
    toggleDeleteProduct(id) {
      this.$store.getters.getProduct(id);
      this.showDeleteProduct = !this.showDeleteProduct;

      if (this.showDeleteProduct == false) {
        this.$store.dispatch("fetchProducts");
      }
    },
  },
  computed: {
    products() {
      return this.$store.getters.getProducts;
    },
  },
};
</script>

<style scoped>
#store .wrapper {
  max-width: 1440px;
}

#store .store-container {
  padding: 100px 0;
}

#store .header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 50px;
}

#store .product-list-con {
  display: flex;
  margin-top: 50px;
  flex-wrap: wrap;
  gap: 50px;
}

#store .store-container .product-widget {
  padding: 20px;
  border-radius: 10px;
  position: relative;
  overflow: hidden;
  display: flex;
  text-align: center;
  gap: 10px;
  align-items: center;
  flex-direction: column;
  box-shadow: var(--global-shadow);
  background: #e0e7ff;
}

#store .store-container .product-widget::before {
  position: absolute;
  content: "";
  width: 100%;
  height: 100%;
  transition: 0.2s;
  opacity: 0;
  top: 0;
  left: 0;
  background: linear-gradient(
    360deg,
    rgb(125, 112, 251) 0.01%,
    rgba(126, 108, 192, 0.1) 100%
  );
}

#store .store-container .product-widget:hover::before {
  opacity: 10;
}

#store .store-container .product-widget:hover .product-button-con {
  opacity: 1;
}

#store .product-img-con {
  width: 250px;
  height: 200px;
}

#store .product-button-con {
  transition: 0.2s;
  position: absolute;
  opacity: 0;
  height: 100%;
  width: 100%;
  flex-direction: column;
  gap: 20px;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

#store .product-button-con button {
  max-width: 150px;
  width: 100%;
}

#store .product-img-con img {
  width: 100%;
  object-fit: cover;
  height: 100%;
}
</style>