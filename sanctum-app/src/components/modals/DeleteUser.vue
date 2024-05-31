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
         
          <div class="modal-footer">
            <button class="btn-secondary" @click="CloseModal()">Close</button>
            <button
              type="button"
              @click="RemoveUser()"
              class="btn btn-primary"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
      
      <script>
  import axios from "axios";
  export default {
    name: "DeleteUser",
    data() {
      return {
        openClose: this.visible,
        errors: null,
      };
    },
    props: {
      visible: Boolean,
    },
    methods: {
      async RemoveUser() {
        try {
          const response = await axios.delete(
            this.$store.state.apiUrl +
              "/removeUser/" +
              this.$store.state.user.id,
            {}
          );
  
          if (response.status === 200) {
            this.openClose = !this.openClose;
            alert('Successfully Removed.');
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