<template>
    <div>
        <h1 class="mb-4">お気に入り一覧</h1>
        <v-row fill-height>
            <v-col
                v-for="favorite in favorites"
                :key="favorite.id"
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
                    <v-card-title class="justify-center">{{ favorite.title }}</v-card-title>
                    <v-card-actions class="justify-center">
                        <router-link :to="detail/1">
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
                        >
                        お気に入り解除
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    data() {
        return {
            favorites: []
        }
    },
    methods: {
        getFavoriteAnimes() {
            this.$axios.get('http://localhost:8888/api/animes/favorite')
                .then((res) => {
                    this.favorites = res.data;
                });
        }
    },
    mounted() {
        this.getFavoriteAnimes();
    }
}
</script>
