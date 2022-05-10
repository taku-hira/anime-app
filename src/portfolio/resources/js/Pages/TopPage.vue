<template>
    <div>
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
    export default {
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
            }
        },
        mounted() {
            this.getAnimes();
        }
    }
</script>
