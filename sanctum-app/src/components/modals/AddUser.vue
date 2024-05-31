<template>
    <div
      v-if="openClose"
      class="modal fade show"
      tabindex="-1"
      aria-hidden="true"
      id="AddUser"
      style="display: block"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <form @submit.prevent="registerUser">
              <div class="field-con">
                <select
                  name="account_type"
                  v-model="account_type"
                  id="account_type"
                  class="form-control"
                >
                  <option value="" hidden selected disabled>
                    Select Account Type
                  </option>
                  <option value="1">Owner</option>
                  <option value="2">Customer</option>
                </select>
                <small class="text-danger" v-if="errors.account_type">{{
                  errors.account_type[0]
                }}</small>
              </div>
              <div class="field-con">
                <input
                  type="text"
                  name="user_name"
                  id="user_name"
                  v-model="user_name"
                  class="form-control"
                  placeholder="Username"
                  required
                />
                <small class="text-danger" v-if="errors.user_name">{{
                  errors.user_name[0]
                }}</small>
              </div>
              <div class="field-con">
                <input
                  type="text"
                  name="full_name"
                  id="full_name"
                  v-model="full_name"
                  class="form-control"
                  placeholder="Full Name"
                />
                <small class="text-danger" v-if="errors.full_name">{{
                  errors.full_name[0]
                }}</small>
              </div>
              <div class="field-con">
                <input
                  type="email"
                  name="email"
                  id="email"
                  v-model="email"
                  class="form-control"
                  placeholder="Email"
                  required
                />
                <small class="text-danger" v-if="errors.email">{{
                  errors.email[0]
                }}</small>
              </div>
              <div class="field-con">
                <input
                  type="text"
                  name="address"
                  id="address"
                  v-model="address"
                  class="form-control"
                  placeholder="Address"
                  required
                />
                <small class="text-danger" v-if="errors.address">{{
                  errors.address[0]
                }}</small>
              </div>
              <div class="field-con">
                <input
                  type="password"
                  id="password"
                  name="password"
                  v-model="password"
                  placeholder="Password"
                  required
                />
                <small class="text-danger" v-if="errors.password">{{
                  errors.password[0]
                }}</small>
              </div>
              <div class="field-con">
                <input
                  type="password"
                  class="form-control"
                  id="confirm"
                  v-model="confirm"
                  placeholder="Confirm Password"
                  required
                />
              </div>
              <div class="modal-footer">
                <button class="btn-secondary" @click="CloseFormModal()">Close</button>
                <button type="submit" class="btn-primary">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  export default {
    name: "AddUser",
    data() {
      return {
        users: [],
        account_type: "",
        user_name: "",
        full_name: "",
        email: "",
        address: "",
        password: "",
        confirm: "",
        errors: {},
        openClose: this.visible,
      };
    },
    props: {
      visible: Boolean,
    },
    methods: {
      CloseFormModal() {
        this.openClose = !this.openClose;
        this.$emit("update:visible", false);
        this.$emit("modal-closed");
      },
      async registerUser() {
        try {
          const response = await axios.post(
            this.$store.state.apiUrl + "/register",
            {
              account_type: this.account_type,
              user_name: this.user_name,
              full_name: this.full_name,
              email: this.email,
              address: this.address,
              password: this.password,
              password_confirmation: this.confirm,
            }
          );
          if (response.status === 201) {
            this.account_type = "";
            this.user_name = "";
            this.full_name = "";
            this.email = "";
            this.address = "";
            this.password = "";
            this.confirm = "";
            this.openClose = !this.openClose;
            this.$emit("update:visible", false);
            this.$emit("modal-closed");
            alert("Registration successful");
            this.$router.push("/userAccounts");
          }
        } catch (error) {
          this.errors = error.response.data.errors;
        }
      },
      clearErrors(field) {
        this.errors[field] = null;
      },
      toggleAddUserModal() {
        this.openClose = !this.openClose;
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