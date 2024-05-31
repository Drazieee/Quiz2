<template>
    <div>
      <HeaderPage />
      <section id="userAccount">
        <div class="wrapper">
          <div class="user-con">
            <div class="header-container">
              <h2>Users Account</h2>
              <button @click="toggleAddUserModal()" class="btn-primary">
                ADD USER
              </button>
            </div>
            <table>
              <thead>
                <tr>
                  <th>User Name</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Account Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td>{{ user.user_name }}</td>
                  <td>{{ user.full_name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.address }}</td>
                  <td>{{ user.account_type == 1 ? "Owner" : "Customer" }}</td>
                  <td>
                    <button @click="toggleEditUser(user.id)" class="btn-edit">
                      Edit
                    </button>
                    <button @click="toggleDeleteUser(user.id)" class="btn-delete">
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <AddUser
          :visible="showAddUserModal"
          @update:visible="toggleAddUserModal"
          @addUser="addUser"
        />
        <EditUser :visible="showEditUser" @update:visible="toggleEditUser" />
        <DeleteUser
          :visible="showDeleteUser"
          @update:visible="toggleDeleteUser"
        />
      </section>
    </div>
  </template>
  
  <script>
  import AddUser from "./modals/AddUser.vue";
  import HeaderPage from "./partials/HeaderPage.vue";
  import DeleteUser from "./modals/DeleteUser.vue";
  import EditUser from "./modals/EditUser.vue";
  import axios from "axios";
  
  export default {
    data() {
      return {
        showAddUserModal: false,
        showDeleteUser: false,
        showEditUser: false,
      };
    },
    components: {
      AddUser,
      HeaderPage,
      DeleteUser,
      EditUser,
    },
    mounted() {
      this.fetchUsers();
    },
    methods: {
      async fetchUsers() {
        await this.$store.dispatch("fetchUsers");
      },
      toggleAddUserModal() {
        this.showAddUserModal = !this.showAddUserModal;
      },
      async addUser(newUser) {
        try {
          await axios.post("http://127.0.0.1:8000/api/users", newUser);
        } catch (error) {
          console.error("Error adding user:", error);
        }
      },
      toggleEditUser(id) {
        this.$store.getters.getUser(id);
        this.showEditUser = !this.showEditUser;
  
        if (this.showEditUser == false) {
          this.$store.dispatch("fetchUsers");
        }
      },
      toggleDeleteUser(id) {
        this.$store.getters.getUser(id);
        this.showDeleteUser = !this.showDeleteUser;
  
        if (this.showDeleteUser == false) {
          this.$store.dispatch("fetchUsers");
        }
      },
    },
    computed: {
      users() {
        return this.$store.getters.getUsers;
      },
    },
  };
  </script>
  
  <style scoped>
  #userAccount .wrapper {
    max-width: 1440px;
  }
  
  #userAccount {
    padding: 100px 0;
  }
  
  .header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
  }
  
  .btn-secondary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .btn-edit {
    background-color: #facc15;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    font-family: "Montserrat", sans-serif;
    transition: 0.2s;
  }
  
  .btn-edit:hover,
  .btn-delete:hover {
    transform: scale(1.02);
  }
  
  .btn-delete {
    background-color: #ef4444;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    font-weight: 600;
    font-size: 14px;
    transition: 0.2s;
    font-family: "Montserrat", sans-serif;
    cursor: pointer;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  table th,
  table td {
    padding: 8px;
    border: 1px solid #ddd;
  }
  
  table td:last-of-type {
    display: flex;
    gap: 10px;
  }
  
  table th {
    background-color: turquoise;
    color: black;
  }
  </style>
  