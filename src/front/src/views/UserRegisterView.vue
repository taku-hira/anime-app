<template>
  <v-app>
    <v-main>
      <v-card width="400px" class="mx-auto mt-5">
        <v-card-title>
          <h1 class="display-1">Let's Sign UP!</h1>
        </v-card-title>
        <v-card-text>
          <form @submit.prevent="register">
            <v-text-field
              v-model="input.name"
              label="name"
              required
            ></v-text-field>
            <v-text-field
              v-model="input.email"
              label="e-mail"
              required
            ></v-text-field>
            <v-select
              v-model="input.prefecture"
              item-text="name"
              item-value="id"
              :items="prefectures"
              label="都道府県"
            ></v-select>
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
              ユーザー登録
            </v-btn>
          </form>
        </v-card-text>
      </v-card>
    </v-main>
  </v-app>
</template>

<script>
export default {
  metaInfo: {
    title: 'ユーザー登録'
    },
  data(){
    return {
      input: {
        'name': '',
        'email': '',
        'prefecture': '',
        'password': '',
      },
      status: '',
      message: '',
      prefectures: [],
    }
  },
  methods: {
    register() {
      this.$axios.get('/sanctum/csrf-cookie', { withCredentials: true }).then(() => {
        this.$axios.post('/register', {
          name: this.input.name,
          email: this.input.email,
          prefecture_id: this.input.prefecture,
          password: this.input.password,
          },
          { withCredentials: true }
        )
        .then(() => {
            localStorage.setItem("isAuth", "ture");
            this.$router.push('/home')
        })
        .catch((error) => {
          console.log(error.response)
          this.message = error.response.data.message
        })
      })
    },
    getPrefecture() {
      this.$axios.get('/api/prefectures')
        .then((res) => {
            this.prefectures = res.data;
        });
    }
  },
  mounted() {
    this.getPrefecture()
  }
}
</script>
