<template>
  <v-app>
    <v-main>
      <v-card width="400px" class="mx-auto mt-5">
        <v-card-title>
          <h1 class="display-1">Let's Sign UP!</h1>
        </v-card-title>
        <div class="err_msg">
          {{ message }}
        </div>
        <v-card-text>
          <v-form  ref="form" @submit.prevent="register">
            <v-text-field
              v-model="input.name"
              label="name"
              :rules="[required, limit_length]"
              counter="20"
            ></v-text-field>
            <v-text-field
              v-model="input.email"
              label="e-mail"
              :rules="[required, email_check]"
            ></v-text-field>
            <v-select
              v-model="input.prefecture"
              item-text="name"
              item-value="id"
              :items="prefectures"
              label="都道府県"
              :rules="[required,]"
            ></v-select>
            <v-text-field
              v-model="input.password"
              label="password(8文字以上)"
              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              :type="showPassword ? 'text' : 'password'"
              :rules="[required, minimum_length]"
              counter
              @click:append="showPassword = !showPassword"
            ></v-text-field>
            <v-btn
              class="mr-4"
              type="submit"
            >
              ユーザー登録
            </v-btn>
          </v-form>
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
      showPassword: false,
      status: '',
      message: '',
      prefectures: [],
      required: value => !!value || "必ず入力してください",
      limit_length: value => value.length <= 20 || "20文字以内で入力してください",
      minimum_length: value => value.length >= 8 || "8文字以上で入力してください",
      email_check: value => /.+@.+\..+/.test(value) || 'メールアドレスが不正です'
    }
  },
  methods: {
    register() {
      if (this.$refs.form.validate()) {
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
              localStorage.setItem("isAuth", "true")
              this.$router.push('/home')
          })
          .catch((error) => {
            this.message = error.response.data.message
          })
        })
      } else {
        this.$refs.form.validate()
      }
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
