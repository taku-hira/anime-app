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
        <router-link :to="`detail/${anime.id}`">
          <v-card
          max-width="300"
          >
            <v-img
            class="height-200"
            :src="anime.img_file_name"
            ></v-img>
            <v-card-title class="justify-center">{{ anime.title }}</v-card-title>
            <v-card-actions class="justify-center">
              <v-layout class="justify-center">
                <v-icon
                large
                :class="{ 'pink--text': anime.favorite_by_user }"
                @click.prevent="onFavoriteClick(anime)"
                >
                mdi-heart
                </v-icon>
              </v-layout>
            </v-card-actions>
          </v-card>
        </router-link>
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
            console.log(res)
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
      }
    },
    mounted() {
      this.getAnimes();
    }
  }
</script>
