import { createRouter, createWebHashHistory } from "vue-router";
import LoginPage from "../components/LoginPage.vue";
import RegisterPage from "../components/RegisterPage.vue";
import HomePage from "../components/HomePage.vue";
import StorePage from "../components/StorePage.vue";
import CartPage from "../components/CartPage.vue";
import OrderPage from "../components/OrderPage.vue";
import UserPage from "../components/UserPage.vue";

const isAuthenticated = () => {
  return localStorage.getItem("token");
};

const isAdmin = () => {
  return localStorage.getItem("account_type") == 1;
};

const isCustomer = () => {
  return localStorage.getItem("account_type") == 2;
};

const authGuard = (to, from, next) => {
  if (isAuthenticated()) {
    next();
  } else {
    next(from);
  }
};

const adminGuard = (to, from, next) => {
  if (isAuthenticated() && isAdmin()) {
    next();
  } else {
    next(from);
  }
};

const customerGuard = (to, from, next) => {
  if (isAuthenticated() && isCustomer()) {
    next();
  } else {
    next(from);
  }
};

const routes = [
  {
    path: "/",
    name: "login",
    component: LoginPage,
  },
  {
    path: "/register",
    name: "register",
    component: RegisterPage,
  },
  {
    path: "/dashboard",
    component: HomePage,
    name: "home",
    beforeEnter: authGuard,
  },
  {
    path: "/myStore",
    component: StorePage,
    name: "myStore",
    beforeEnter: adminGuard,
  },
  {
    path: "/userAccounts",
    component: UserPage,
    name: "userAccounts",
    beforeEnter: adminGuard,
  },
  {
    path: "/myCart",
    component: CartPage,
    name: "myCart",
    beforeEnter: customerGuard,
  },
  {
    path: "/myOrder",
    component: OrderPage,
    name: "myOrder",
    beforeEnter: customerGuard,
  },
  {
    path: "/logout",
    name: "logout",
    component: LoginPage,
    beforeEnter: (to, from, next) => {
      localStorage.removeItem("token");
      localStorage.removeItem("user_id");
      localStorage.removeItem("account_type");
      next("/");
    },
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
