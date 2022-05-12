<template>
    <div>
        <FavoriteListComponent class="mb-5" />
        <v-divider class="mb-4"></v-divider>
        <h1 class="mb-4">2022年 春アニメ</h1>
        <v-row fill-height>
            <v-col
                v-for="anime in animes"
                :key="anime.id"
                cols="12"
                sm="3"
            >
                <v-card
                    max-width="300"
                    class="height-400"
                >
                    <v-img
                        height="250"
                        src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
                    ></v-img>
                    <v-card-title class="justify-center">{{ anime.title }}</v-card-title>
                    <v-card-actions class="justify-center">
                        <router-link :to="`detail/${anime.id}`">
                            <v-btn
                                color="primary"
                                elevation="6"
                                class="mr-2"
                            >
                            詳細
                            </v-btn>
                        </router-link>
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

    import FavoriteListComponent from '../components/FavoriteListComponent.vue'

    export default {
         components: {
            FavoriteListComponent,
        },
        data() {
            return {
                animes: []
            }
        },
        methods: {
            getAnimes() {
                axios.get('/api/animes')
                    .then((res) => {
                        this.animes = res.data;
                    });
            },
            resistFavorite(anime_id) {
                axios.put('api/animes/' + anime_id + '/favorite')
                    .then((res) => {
                        this.$router.go({path: this.$router.currentRoute.path, force: true})
                    });
            }
        },
        mounted() {
            this.getAnimes();
        }
    }
</script>
