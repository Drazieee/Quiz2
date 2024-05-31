<template>
  <HeaderPage />
  <section id="login">
    <div class="wrapper">
      <div class="betamart">
      <h2>BetaMart</h2>
      <hr>
      </div>
      <div class="login-container">
        
        <form @submit.prevent="loginUser">
          <div class="field-con">
            <input
              type="email"
              class="form-control"
              name="email"
              id="email"
              v-model="email"
              placeholder="Email"
              @input="clearErrors"
              required
            />
            <small class="text-danger" v-if="errors">{{ errors }}</small>
          </div>
          <div class="field-con">
            <input
              type="password"
              class="form-control"
              name="password"
              placeholder="Password"
              v-model="password"
              @input="clearErrors"
              required
            />
          </div>
          <div class="btn-con">
            <button type="submit" class="btn-primary">LOGIN</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>
  
<script>
import HeaderPage from "./partials/HeaderPage.vue";
import axios from "axios";
export default {
  data() {
    return {
      email: "",
      password: "",
      errors: null,
    };
  },
  components: {
    HeaderPage,
  },
  methods: {
    async loginUser() {
      try {
        const response = await axios.post(this.$store.state.apiUrl + "/login", {
          email: this.email,
          password: this.password,
        });
        if (response.status === 201) {
          localStorage.setItem("user_id", response.data.user_id);
          localStorage.setItem("token", response.data.token);
          localStorage.setItem("account_type", JSON.stringify(response.data.account_type));
          this.$router.push("/dashboard");
        }
      } catch (error) {
        this.errors = error.response.data.message;
      }
    },
    clearErrors() {
      this.errors = null;
    },
  },
};
</script>

<style scoped>

.betamart {
  max-width: fit-content;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: -200px;
  margin-top: 100px;
}

#login .wrapper {
  max-width: 1440px;
}

#login .login-container {
  display: flex;
  justify-content: center;
  gap: 100px;
  align-items: center;
}

#login .login-details {
  max-width: 500px;
  width: 100%;
}

#login .login-container form {
  max-width: 500px;
  width: 100%;
  border-radius: 10px;
  padding: 20px;
}

@media screen and (max-width: 767px) {
  #login .login-container {
    padding: 100px 0;
    text-align: center;
    gap: 50px;
    flex-direction: column;
  }
}

@media screen and (min-width: 768px) {
  #login .login-container {
    padding: 100px 0;
    text-align: center;
    gap: 50px;
    flex-direction: column;
  }
}

@media screen and (min-width: 1024px) {
  #login .login-container {
    flex-direction: row;
    padding: 200px 0;
    text-align: left;
  }
}

#btn-primary {
  background-color: #FA7070;
  margin-top: 100px;
}

</style>