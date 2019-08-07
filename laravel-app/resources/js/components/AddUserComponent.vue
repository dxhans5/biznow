<template>
    <b-modal no-fade v-model="modalShow" title="Add User">
      ...

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
          modalShow: true
        }
      },
      methods: {
        saveUser: function() {
          console.log('add user clicked');
        },
        closeModal: function() {
          console.log('close modal clicked');
          this.$parent.addingUser = false;
        }
      }
    }
</script>
