<template>
  <v-app>
    <v-main>
      <v-card width="400px" class="mx-auto mt-5">
        <v-card-title>
          <h1 class="display-1">ユーザー情報編集</h1>
        </v-card-title>
        <div class="err_msg">
          {{ message }}
        </div>
        <v-card-text>
          <v-form  ref="form" @submit.prevent="update">
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
            <v-btn
              class="mr-4"
              type="submit"
            >
              更新
            </v-btn>
            <v-btn
              class="mr-4"
              to="/home"
            >
              戻る
            </v-btn>
          </v-form>
          <router-link
            to="/user/password"
          >
            <p class="mt-4 mb-0">パスワードの更新はこちらから</p>
          </router-link>
        </v-card-text>
        <delete-dialog-component />
      </v-card>
    </v-main>
  </v-app>
</template>

<script>
import DeleteDialogComponent from '../components/DeleteDialogComponent.vue'
export default {
  metaInfo: {
    title: 'ユーザー登録'
    },
    components: {
      DeleteDialogComponent,
    },
  data(){
    return {
      input: {
        'name': '',
        'email': '',
        'prefecture': '',
      },
      user: [],
      message: '',
      prefectures: [],
      required: value => !!value || "必ず入力してください",
      limit_length: value => value.length <= 20 || "20文字以内で入力してください",
      minimum_length: value => value.length >= 8 || "8文字以上で入力してください",
      email_check: value => /.+@.+\..+/.test(value) || 'メールアドレスが不正です'
    }
  },
  methods: {
    update() {
      if (this.$refs.form.validate()) {
          this.$axios.put('/api/user', {
            name: this.input.name,
            email: this.input.email,
            prefecture_id: this.input.prefecture,
            },
          )
          .then(() => {
              this.$router.push('/home')
          })
          .catch((error) => {
            this.message = error.response.data.message
          })
      }
    },
    deleteUser() {
      this.$axios.delete('/api/user')
      .then(() => {
        localStorage.removeItem("isAuth")
        this.$router.push("/")
      })
    },
    getUser() {
      this.$axios.get('/api/user')
      .then((res) => {
        this.input.name = res.data.name
        this.input.email = res.data.email
        this.input.prefecture = res.data.prefecture_id
      })
    },
    getPrefecture() {
      this.$axios.get('/api/prefectures')
        .then((res) => {
            this.prefectures = res.data
        })
    }
  },
  mounted() {
    this.getPrefecture(),
    this.getUser()
  }
}
</script>
