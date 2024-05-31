import { createStore } from "vuex";
import axios from "axios";
export default createStore({
  state: {
    apiUrl: "http://127.0.0.1:8000/api",
    products: [],
    users: [],
    product: [],
    user: [],
  },
  getters: {
    getProducts(state) {
      return state.products;
    },
    getUsers(state) {
      return state.users;
    },
    getProduct: (state) => (id) => {
      return axios
        .get(state.apiUrl + "/showProduct/" + id)
        .then((response) => {
          state.product = response.data;
        })
        .catch((error) => {
          alert(error.message);
        });
    },
    getUser: (state) => (id) => {
      return axios
        .get(state.apiUrl + "/showUser/" + id)
        .then((response) => {
          state.user = response.data;
        })
        .catch((error) => {
          alert(error.message);
        });
    },
  },
  mutations: {
    setProducts(state, products) {
      state.products = products;
    },
    setUsers(state, users) {
      state.users = users;
    },
    updateProductName(state, productName) {
      state.product.product_name = productName;
    },
    updateProductDescription(state, productDescription) {
      state.product.product_description = productDescription;
    },
    updateProductQuantity(state, productQuantity) {
      state.product.quantity = productQuantity;
    },
    updateProductPrice(state, productPrice) {
      state.product.price = productPrice;
    },
    updateUserName(state, userName) {
      state.user.user_name = userName;
    },
    updateFullName(state, fullName) {
      state.user.full_name = fullName;
    },
    updateEmail(state, email) {
      state.user.email = email;
    },
    updateAddress(state, address) {
      state.user.address = address;
    },
  },
  actions: {
    async fetchProducts({ state, commit }) {
      try {
        const response = await axios.get(state.apiUrl + "/products");
        commit("setProducts", response.data);
      } catch (error) {
        alert("Error fetching products: " + error.message);
      }
    },
    async fetchUsers({ state, commit }) {
      try {
        const response = await axios.get(state.apiUrl + "/users");
        commit("setUsers", response.data);
      } catch (error) {
        alert("Error fetching products: " + error.message);
      }
    },
    async filterProducts({ state, commit }, price) {
      try {
        let response;
        if (price === "") {
          response = await axios.get(state.apiUrl + "/products");
        } else {
          response = await axios.get(state.apiUrl + "/filter/" + price);
        }
        commit("setProducts", response.data);
      } catch (error) {
        alert("Error filtering products: " + error.message);
      }
    },
    updateProductName({ commit }, productName) {
      commit("updateProductName", productName);
    },
    updateProductDescription({ commit }, productDescription) {
      commit("updateProductDescription", productDescription);
    },
    updateProductQuantity({ commit }, productQuantity) {
      commit("updateProductQuantity", productQuantity);
    },
    updateProductPrice({ commit }, productPrice) {
      commit("updateProductPrice", productPrice);
    },
  },
  modules: {},
});
