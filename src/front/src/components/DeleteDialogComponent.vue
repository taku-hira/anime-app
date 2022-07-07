<template>
  <v-dialog
    v-model="dialog"
    persistent
    max-width="290"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        class="mb-4 ml-4"
        v-bind="attrs"
        v-on="on"
      >
        アカウント削除
      </v-btn>
    </template>
    <v-card>
      <v-card-title class="text-h5">
        アカウント削除
      </v-card-title>
      <v-card-text>アカウント削除を実行しますか？</v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="green darken-1"
          text
          @click="deleteUser"
        >
          削除する
        </v-btn>
        <v-btn
          color="green darken-1"
          text
          @click="dialog = false"
        >
          キャンセル
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
  export default {
    data() {
      return {
        dialog: false,
      }
    },
    methods: {
      deleteUser() {
      this.$axios.delete('/api/user')
      .then(() => {
        localStorage.removeItem("isAuth")
        this.$router.push("/")
      })
    },
    }
  }
</script>
