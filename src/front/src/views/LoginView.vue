<template>
  <v-app>
    <v-main>
      <v-card width="400px" class="mx-auto mt-5">
        <v-card-title>
          <h1 class="display-1">ログイン</h1>
        </v-card-title>
        <v-card-text>
          {{ message }}
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
          <v-btn
            class="mr-4"
            @click="logout"
          >
            ログアウト
          </v-btn>
        </v-card-text>
      </v-card>
    </v-main>
  </v-app>
</template>

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
        .then((res) => {
            console.log(res.data)
            this.$router.push('/home')
        })
        .catch((error) => {
          this.message = error.response.data.message
        })
      })
    },
    logout() {
      this.$axios.post('/logout').then((res) => {
        this.message = res.data.message
      })
    },
  }

}
</script>
