<template>
  <v-container>
    <v-row>
      <v-col
        col="12"
        md="6"
        sm="12"
        xs="12"
      >
        <h1 class="mb-5">{{ anime.title }}</h1>
        <p>
          {{ anime.summary }}
        </p>
        <div v-if="onAirData.date">
          <h4 class="mt-4">放送日</h4>
          {{ onAirData.date }}
          <v-divider />
          <h4 class="mt-4">放送情報</h4>
          {{ onAirData.info }}
          <v-divider />
        </div>
        <div v-if="!onAirData.date">
          番組情報はありません
        </div>
        <router-link to="/home">
          <v-btn
            color="primary"
            elevation="6"
            class="my-4"
          >
            戻る
          </v-btn>
        </router-link>
      </v-col>
      <v-col
        col="12"
        md="6"
        sm="12"
        xs="12"
      >
        <v-img
          :src="anime.img_file_name"
        ></v-img>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
      props: {
        id: String
      },
      data() {
          return {
              anime: {},
              onAirData: {},
          }
      },
      metaInfo () {
        return {
          title: this.anime.title
        }
      },
      methods: {
        getAnime() {
          this.$axios.get('/api/anime/' + this.$route.params.id)
            .then((res) => {
              this.anime = res.data;
            })
        },
        getOnAirData() {
          this.$axios.get('/api/onair/' + this.$route.params.id)
            .then((res) => {
              this.onAirData = res.data
            })
            .catch(() => {
              this.onAirData = null
            })
        }
      },
      mounted() {
        this.getAnime(),
        this.getOnAirData()
      }
    }
</script>
