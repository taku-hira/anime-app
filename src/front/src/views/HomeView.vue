<template>
  <div>
    <favorite-list-component class="mb-5" />
    <v-divider class="mb-4"></v-divider>
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
        max-width="300"
        >
          <router-link :to="`detail/${anime.id}`">
            <v-img
            class="height-200"
            :src="anime.img_file_name"
            ></v-img>
          </router-link>
          <v-card-title class="justify-center">{{ anime.title }}</v-card-title>
          <v-card-actions class="justify-center">
            <v-btn
            color="primary"
            elevation="6"
            @click="resistFavorite(anime.id)"
            >
              お気に入り登録
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import FavoriteListComponent from '../components/FavoriteListComponent.vue';
  export default {
    components: { FavoriteListComponent },
    metaInfo: {
      title: 'Anitify'
    },
    data() {
      return {
        animes: [],
        favorite: false
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
      resistFavorite(anime_id) {
        this.$axios.put('/api/animes/' + anime_id + '/favorite')
          .then(() => {
            this.$router.go({path: this.$router.currentRoute.path, force: true})
            this.favorite = true
          })
          .catch(() => {
            this.$router.push('/login')
          })
      },
    },
    mounted() {
      this.getAnimes();
    }
  }
</script>
