<template>
  <div class="container">
      <div v-if="addingUser">
        <add-user-component></add-user-component>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-12 underline">
          <div class="row">
            <div class="col-md-6">
              <h1>Users</h1>
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-primary" v-on:click="addingUser = true">Add User</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div v-for="error in errors" class="alert alert-danger" role="alert">
            {{ error | capitalize }}
          </div>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users">
                    <th scope="row"><img :src="user.avatar"></th>
                    <td>{{ user.first_name }} {{ user.last_name }}</td>
                    <td>{{ user.email }}</td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
    export default {
      data: function() {
        return {
          errors: [],
          users: null,
          addingUser: false
        }
      },
      created: function () {
        this.fetchUsers();
      },
      methods: {
        fetchUsers: function() {
          axios.get( '/get-users').then( response => {
            this.errors = [];

            if (response.data.error) {
              this.errors.push(response.data.error);
            } else if (response.data.data) {
              this.users = response.data.data;
            }
          })
        }
      }
    }
</script>
