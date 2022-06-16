<template>
  <div>
    <v-app-bar>
      Anitify
      <v-tabs right>
        <v-tab @click="logout">logout</v-tab>
      </v-tabs>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  data () {
    return {
      drawer: false
    }
  },
  methods: {
    logout() {
      this.$axios.post('/logout').then((res) => {
        this.message = res.data.message
        localStorage.removeItem("isAuth");
        this.$router.push("/login");
      })
    },

  }
}
</script>

<style>

</style>
