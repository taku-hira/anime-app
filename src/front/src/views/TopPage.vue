<template>
  <v-main>
    <v-container>
      <div class="my-4">
        <h1 class="text-center">アニメを見逃さないようにAnitifyを始めましょう</h1>
      </div>
      <v-img src="@/assets/image/top_image.png"></v-img>
      <div class="mt-8">
        <h2 class="text-center">Anitifyを使えば登録したアニメの放送日に通知が届きます</h2>
      </div>
      <v-img
      src="@/assets/image/anitify-top.png" alt="カードの説明"
      class="my-8"
      >
      </v-img>
      <h2 class="text-center">ログイン後、お気に入り登録ができ、通知が届くようになります</h2>
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
