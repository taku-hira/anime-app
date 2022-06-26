<template>
  <v-main>
    <v-container>
      <v-layout>
        <v-flex align-self-center>
          <h1>アニメを見逃してしまったことありませんか・・・？</h1>
          <h1 class="mt-8">もう見逃さないために・・・ </h1>
          <router-link to="register">
            <v-btn
            class="my-8"
            color="primary"
            elevation="2"
            rounded
            block
            >
            ユーザー登録して始める
            </v-btn>
          </router-link>
          <router-link to="login">
            <v-btn
            class="my-8"
            color="primary"
            elevation="2"
            rounded
            block
            >
            ログインして始める
            </v-btn>
          </router-link>
        </v-flex>
        <v-flex>
          <img src="@/assets/image/top_image1.png" alt="落ち込んでいる">
        </v-flex>
      </v-layout>
      <h2>Anitifyを使えば登録したアニメの放送</h2>
    </v-container>
  </v-main>
</template>

<script>
export default {
  metaInfo () {
      return {
          title: 'Anitify'
      }
  }
}
</script>

<style>

</style>
