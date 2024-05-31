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
                id="userName"
                v-model="this.$store.state.user.user_name"
                @input="updateUserName"
                placeholder="Enter User Name"
                required
              />
            </div>
            <div class="field-con">
              <input
                type="text"
                id="fullName"
                v-model="this.$store.state.user.full_name"
                @input="updateFullName"
                placeholder="Enter Full Name"
                required
              />
            </div>
            <div class="field-con">
              <input
                type="text"
                id="email"
                v-model="this.$store.state.user.email"
                @input="updateEmail"
                placeholder="Enter Email"
                required
              />
            </div>
            <div class="field-con">
              <input
                type="text"
                id="address"
                v-model="this.$store.state.user.address"
                @input="updateAddress"
                placeholder="Enter Address"
                required
              />
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn-secondary" @click="CloseModal()">Close</button>
            <button
              type="button"
              @click="UpdateUser()"
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
    name: "EditUser",
    data() {
      return {
        openClose: this.visible,
        userName: this.$store.state.user.user_name,
        fullName: this.$store.state.user.full_name,
        email: this.$store.state.user.email,
        address: this.$store.state.user.address,
        errors: null,
      };
    },
    props: {
      visible: Boolean,
    },
    methods: {
      updateUserName() {
        this.$store.dispatch(
          "updateUserName",
          this.$store.state.user.user_name
        );
      },
      updateFullName() {
        this.$store.dispatch(
          "updateFullName",
          this.$store.state.user.full_name
        );
      },
      updateEmail() {
        this.$store.dispatch(
          "updateEmail",
          this.$store.state.user.email
        );
      },
      updateAddress() {
        this.$store.dispatch(
          "updateAddress",
          this.$store.state.user.address
        );
      },
      async UpdateUser() {
        try {
          const response = await axios.put(
            this.$store.state.apiUrl +
              "/editUser/" +
              this.$store.state.user.id,
            {
              userName: this.$store.state.user.user_name,
              fullName: this.$store.state.user.full_name,
              email: this.$store.state.user.email,
              address: this.$store.state.user.address,
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