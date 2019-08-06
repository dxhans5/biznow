<template>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Login</div>

                  <div class="card-body">

                    <div class="alert alert-danger" role="alert">
                      {{ test }}
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
          email: null,
          password: null
        }
      },
      methods:{
        authenticateAndLogin: function (e) {
          if (this.email && this.password) {
            axios.post( '/login', { email: this.email, password: this.password }).then( response => {
              this.errors = [];

              if (response.data.error) {
                this.errors.push(response.data.error);
              }
            })
          }

          e.preventDefault();
        }
      }
    }
</script>
