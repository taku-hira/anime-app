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
                sm="3"
            >
                <v-card
                    max-width="300"
                    class="height-400"
                >
                    <v-img
                        :src="anime.img_file_name"
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
import FavoriteListComponent from '../components/FavoriteListComponent.vue';
    export default {
        components: { FavoriteListComponent },
        metaInfo: {
            title: 'トップページ'
        },
        data() {
            return {
                animes: []
            }
        },
        methods: {
            getAnimes() {
                this.$axios.get('/api/animes')
                    .then((res) => {
                        this.animes = res.data;
                    });
            },
            resistFavorite(anime_id) {
                this.$axios.put('/api/animes/' + anime_id + '/favorite')
                    .then(() => {
                        this.$router.go({path: this.$router.currentRoute.path, force: true})
                    });
            }
        },
        mounted() {
            this.getAnimes();
        }
    }
</script>
