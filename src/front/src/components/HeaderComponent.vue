<template>
  <div>
    <v-app-bar>
      Anitify
      <v-row justify="end">
        <router-link
        to="register"
        v-if="this.$route.path === '/login' || this.$route.path === '/'"
        >
          <v-btn
          class="my-8 mx-4"
          color="primary"
          elevation="2"
          rounded
          >
            <v-icon class="mr-2">
              mdi-account-plus
            </v-icon>
            ユーザー登録
          </v-btn>
        </router-link>
        <router-link
        to="login"
        v-if="this.$route.path === '/register' || this.$route.path === '/'"
        >
          <v-btn
          class="my-8"
          color="primary"
          elevation="2"
          rounded
          >
            <v-icon class="mr-2">
              mdi-login
            </v-icon>
            ログイン
          </v-btn>
        </router-link>
        <v-menu
        v-if="this.$route.path === '/home' || this.$route.name === 'detail' || this.$route.path === '/user' || this.$route.path === '/user/password'"
        bottom offset-y
        >
          <template v-slot:activator="{ on }">
            <v-btn
            v-on="on"
            class="mr-12"
            >
              <v-icon>
                mdi-account-details
              </v-icon>
            </v-btn>
          </template>
          <v-list>
            <v-list-item to="/user">
              <v-list-item-icon>
                <v-icon>
                  mdi-account-circle
                </v-icon>
              </v-list-item-icon>
              <v-list-item-title>{{ this.user.name }}</v-list-item-title>
            </v-list-item>
            <v-list-item @click="logout">
              <v-list-item-icon>
                <v-icon>
                  mdi-logout
                </v-icon>
              </v-list-item-icon>
              <v-list-item-title> ログアウト </v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-row>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  watch: {
      $route (to, from) {
        if (to.name == 'home' && from.name == 'login' || from.name == 'register' || from.name == 'user') {
          this.$axios.get('api/user')
        .then((res) => {
          this.user = res.data
        })
        }
      }
    },
  data () {
    return {
      user: []
    }
  },
  methods: {
    logout() {
      this.$axios.post('/logout').then((res) => {
        this.message = res.data.message
        localStorage.removeItem("isAuth")
        this.$router.push("/login")
      })
    },
    isAuth() {
      return localStorage.getItem("isAuth")
    }
  },
  mounted() {
    if (this.isAuth()) {
      this.$axios.get('api/user')
        .then((res) => {
          this.user = res.data
        })
    }
  }
}
</script>
