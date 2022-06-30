<template>
  <div>
    <h1 class="mb-4">2022年 春アニメ</h1>
    <v-row fill-height>
      <v-col
      v-for="anime in animes"
      :key="anime.id"
      cols="12"
      md="3"
      sm="6"
      >
        <v-card
        class="py-4"
        :to="`detail/${anime.id}`">
          <v-img max-height="350" :src="anime.img_file_name"></v-img>
          <v-card-title class="justify-center">{{ anime.title }}</v-card-title>
          <v-layout class="justify-center">
            <v-icon
            large
            :class="{ 'pink--text': anime.favorite_by_user }"
            @click.prevent="onFavoriteClick(anime)"
            >
            mdi-heart
            </v-icon>
          </v-layout>
          <v-layout class="justify-center">
            <v-btn
            @click.prevent="openLink(anime)"
            class="text-caption mt-4"
            >
              オフィシャルサイトへ
              <v-icon x-small>mdi-open-in-new</v-icon>
            </v-btn>
          </v-layout>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<style>
  a {
    text-decoration: none;
  }
</style>

<script>
  export default {
    metaInfo: {
      title: 'Anitify'
    },
    data() {
      return {
        animes: [],
      }
    },
    methods: {
      getAnimes() {
        this.$axios.get('/api/animes')
          .then((res) => {
            this.animes = res.data;
          })
          .catch(() => {
            this.$router.push('/login')
          })
      },
      favorite(anime) {
        this.$axios.put('/api/animes/' + anime.id + '/favorite')
          .then(() => {
            anime.favorite_by_user = true
          })
          .catch(() => {
            this.$router.push('/login')
          })
      },
      unFavorite(anime) {
        this.$axios.delete('/api/animes/' + anime.id + '/favorite')
          .then(() => {
            anime.favorite_by_user = false
          })
          .catch(() => {
            this.$router.push('/login')
          })
      },
      onFavoriteClick(anime) {
        console.log(anime.favorite_by_user)
        if (anime.favorite_by_user) {
          this.unFavorite(anime)
        } else {
          this.favorite(anime)
        }
      },
      openLink(anime) {
        window.open(anime.official_site_url, '_blank')
      }
    },
    mounted() {
      this.getAnimes();
    }
  }
</script>
