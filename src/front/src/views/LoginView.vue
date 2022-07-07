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
          <v-form ref="form" @submit.prevent="login">
            <v-text-field
              v-model="input.email"
              label="e-mail"
              :rules="[required, email_check]"
            ></v-text-field>
            <v-text-field
              v-model="input.password"
              label="password"
              type="password"
              :rules="[required]"
            ></v-text-field>
            <v-btn
              class="mr-4"
              type="submit"
            >
              ログイン
            </v-btn>
          </v-form>
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
      required: value => !!value || "必ず入力してください",
      email_check: value => /.+@.+\..+/.test(value) || 'メールアドレスが不正です'
    }
  },
  methods: {
    login() {
      if (this.$refs.form.validate()) {
        this.$axios.get('/sanctum/csrf-cookie', { withCredentials: true }).then(() => {
          this.$axios.post('/login', {
            email: this.input.email,
            password: this.input.password
            },
            { withCredentials: true }
          )
          .then(() => {
              localStorage.setItem("isAuth", "ture");
              this.$router.push('/home')
          })
          .catch((error) => {
            console.log(error)
            this.message = error.response.data.message
          })
        })
      }
    },
  }

}
</script>
