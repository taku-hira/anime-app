<template>
  <v-app>
    <v-main>
      <v-card width="400px" class="mx-auto mt-5">
        <v-card-title>
          <h1 class="display-1">Let's Sign In</h1>
        </v-card-title>
        <v-card-text>
          <div class="err_msg">
          {{ message }}
          </div>
          <form @submit.prevent="login">
            <v-text-field
              v-model="input.email"
              label="e-mail"
              required
            ></v-text-field>
            <v-text-field
              v-model="input.password"
              label="password"
              type="password"
              required
            ></v-text-field>
            <v-btn
              class="mr-4"
              type="submit"
            >
              ログイン
            </v-btn>
          </form>
        </v-card-text>
      </v-card>
    </v-main>
  </v-app>
</template>

<style>
  .err_msg {
    color: red;
  }
</style>

<script>
export default {
  metaInfo: {
    title: 'ログイン'
    },
  data(){
    return {
      input: {
        'email': '',
        'password': '',
      },
      status: '',
      message: '',
      user: '',
    }
  },
  methods: {
    login() {
      this.$axios.get('/sanctum/csrf-cookie', { withCredentials: true }).then(() => {
        this.$axios.post('/login', {
          email: this.input.email,
          password: this.input.password},
          { withCredentials: true }
        )
        .then(() => {
            localStorage.setItem("isAuth", "ture");
            this.$router.push('/home')
        })
        .catch((error) => {
          this.message = error.response.data.message
        })
      })
    },
  }

}
</script>
