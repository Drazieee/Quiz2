<template>
  <HeaderPage />
  <section id="register">
    <div class="wrapper">
      <div class="register-container">
        <div class="register-details">
          <h1>BetaMart</h1>
          
        </div>
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
          <div class="btn-con">
            <button type="submit" class="btn-primary">REGISTER</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>
  
<script>
import axios from "axios";
import HeaderPage from "./partials/HeaderPage.vue";
export default {
  data() {
    return {
      account_type: "",
      user_name: "",
      full_name: "",
      email: "",
      address: "",
      password: "",
      confirm: "",
      errors: {},
    };
  },
  components: {
    HeaderPage,
  },
  methods: {
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
          alert("Registration successful");
          this.$router.push("/");
        }
      } catch (error) {
        this.errors = error.response.data.errors;
      }
    },
    clearErrors(field) {
      this.errors[field] = null;
    },
  },
};
</script>

<style scoped>
#register .wrapper {
  max-width: 1440px;
}

#register .register-container {
  display: flex;
  justify-content: center;
  gap: 100px;
  align-items: center;
  padding: 200px 0;
}

#register .register-details {
  max-width: 500px;
  width: 100%;
}

#register .register-container form {
  max-width: 500px;
  width: 100%;
  border-radius: 10px;
  padding: 20px;
  background: var(--global-color-white);
  box-shadow: var(--global-shadow);
}

@media screen and (max-width: 767px) {
  #register .register-container {
    padding: 100px 0;
    text-align: center;
    gap: 50px;
    flex-direction: column;
  }
}

@media screen and (min-width: 768px) {
  #register .register-container {
    padding: 100px 0;
    text-align: center;
    gap: 50px;
    flex-direction: column;
  }
}

@media screen and (min-width: 1024px) {
  #register .register-container {
    flex-direction: row;
    padding: 200px 0;
    text-align: left;
  }
}
</style>
