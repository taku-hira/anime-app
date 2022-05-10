<template>
    <v-container>
        <h1 class="mb-5">{{ anime.title }}</h1>
        <div class="d-flex">
            <div class="mr-5">
                <p>
                    {{ anime.summary }}
                </p>

                    <router-link to="/">
                        <v-btn
                            color="primary"
                            elevation="6"
                            class="mr-2"
                        >
                            戻る
                        </v-btn>
                    </router-link>
                    <v-btn
                        color="primary"
                        elevation="6"
                    >
                        お気に入り登録
                    </v-btn>
            </div>
            <v-img
                height="500"
                src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
            ></v-img>
        </div>
    </v-container>
</template>

<script>
    export default {
        props: {
            id: String
        },
        data() {
            return {
                anime: {}
            }
        },
        methods: {
            getAnime() {
                axios.get('/api/animes/' + this.$route.params.id)
                    .then((res) => {
                        this.anime = res.data;
                    });
            }
        },
        mounted() {
            this.getAnime();
        }
    }
</script>
