<template>
  <v-app>
    <v-main>
      <v-card width="400px" class="mx-auto mt-5">
        <v-card-title>
          <h1 class="display-1">パスワード更新</h1>
        </v-card-title>
        <div class="err_msg">
          {{ message }}
        </div>
        <v-card-text>
          <v-form  ref="form" @submit.prevent="update">
            <v-text-field
              v-model="input.password"
              label="password"
              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              :type="showPassword ? 'text' : 'password'"
              :rules="[required]"
              hint="新しいパスワードを８文字以上で設定してください"
              counter
              @click:append="showPassword = !showPassword"
            ></v-text-field>
            <v-btn
              class="mr-4"
              type="submit"
            >
              パスワード更新
            </v-btn>
            <v-btn
              class="mr-4"
              to="/user"
            >
              戻る
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
    title: 'パスワード更新'
    },
  data(){
    return {
      input: {
        'password': '',
      },
      user: [],
      message: '',
      showPassword: false,
      prefectures: [],
      required: value => !!value || "必ず入力してください",
      minimum_length: value => value.length >= 8 || "8文字以上で入力してください",
    }
  },
  methods: {
    update() {
      if (this.$refs.form.validate()) {
          this.$axios.put('/api/user/password', {
            password: this.input.password
          })
          .then(() => {
              this.$router.push('/user')
          })
          .catch((error) => {
            this.message = error.response.data.message
          })
      }
    },
  },
}
</script>
