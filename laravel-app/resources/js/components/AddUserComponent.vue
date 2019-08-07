<template>
    <b-modal no-fade v-model="modalShow" title="Add User">

      <form
        id="addUserForm"
        >

        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input class="form-control"
            id="fullName"
            v-model="fullName"
            type="text"
            name="fullName"
          >
        </div>

        <div class="form-group">
          <label for="job">Job</label>
          <input class="form-control"
            id="job"
            v-model="job"
            type="text"
            name="job"
          >
        </div>
      </form>

      <template slot="modal-footer" slot-scope="{ ok, cancel}">
        <!-- Emulate built in modal footer ok and cancel button actions -->
        <b-button size="sm" variant="success" @click="saveUser()">
          Save User
        </b-button>
        <b-button size="sm" variant="danger" @click="closeModal()">
          Cancel
        </b-button>
      </template>
    </b-modal>
</template>

<script>
    export default {
      data: function() {
        return {
          errors: [],
          modalShow: true,
          fullName: null,
          job: null
        }
      },
      methods: {
        saveUser: function() {
          axios.post( '/add-user', { fullName: this.fullName, job: this.job }).then( response => {
            this.errors = [];

            if (response.data.error) {
              this.errors.push(response.data.error);
            } else if (response.data.id) {

              // Reload the users list and close modal
              // Unfortunately it does not appear that regres will actually save
              // new objects to their dummy data, so the user will not appear
              // on the users list :(
              this.$parent.fetchUsers();
              this.closeModal();
            }
          })
        },
        closeModal: function() {
          console.log('close modal clicked');
          this.$parent.addingUser = false;
        }
      }
    }
</script>
