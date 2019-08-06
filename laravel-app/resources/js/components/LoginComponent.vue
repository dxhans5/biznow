<template>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Login</div>

                  <div class="card-body">

                    <div v-for="error in errors" class="alert alert-danger" role="alert">
                      {{ error | capitalize }}
                    </div>


                    <form
                      id="login"
                      @submit="authenticateAndLogin"
                      action="/login"
                      method="post"
                      >

                      <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control"
                          id="email"
                          v-model="email"
                          type="text"
                          name="email"
                        >
                      </div>

                      <div class="form-group">
                        <label for="email">Password</label>
                        <input class="form-control"
                          id="password"
                          v-model="password"
                          type="password"
                          name="password"
                        >
                      </div>

                      <input
                        type="submit"
                        value="Submit"
                      >
                    </form>
                  </div>
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
          email: 'eve.holt@reqres.in',
          password: 'cityslicka'
        }
      },
      methods:{
        authenticateAndLogin: function (e) {
          if (this.email && this.password) {
            // TODO: change submit button to working spinner
            axios.post( '/login', { email: this.email, password: this.password }).then( response => {
              this.errors = [];

              if (response.data.error) {
                this.errors.push(response.data.error);
              } else if (response.data.token) {
                window.location.href = '/users';
              }
            })
          }

          e.preventDefault();
        }
      },
      filters: {
        capitalize: function (value) {
          if (!value) return ''
          value = value.toString()
          return value.charAt(0).toUpperCase() + value.slice(1)
        }
      }
    }
</script>
