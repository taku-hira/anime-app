<template>
    <div>
        <v-row>
            <v-col
                v-for="n in 8"
                :key="n"
                cols="12"
                sm="3"
            >
                <v-card
                    :loading="loading"
                    max-width="300"
                >
                    <v-img
                        height="250"
                        src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
                    ></v-img>
                    <v-card-title class="justify-center">SPY FAMILY</v-card-title>
                    <v-card-actions class="justify-center">
                        <router-link to="/about">
                            <v-btn
                                color="primary"
                                elevation="6"
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
    // import HeaderComponent from '../../components/HeaderComponent.vue'
</script>
