<template>
    <div>
        <v-card
            :loading="loading"
            class="mx-auto my-12"
            max-width="300"
        >
        <template slot="progress">
            <v-progress-linear
                color="deep-purple"
                height="10"
                indeterminate
            ></v-progress-linear>
            </template>
            <v-img
                height="250"
                src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
            ></v-img>
            <v-card-title class="justify-center">SPY FAMILY</v-card-title>
            <v-card-actions class="justify-center">
                <v-btn
                    color="primary"
                    elevation="6"
                    x-large
                >
                詳細
                </v-btn>
                <v-btn
                    color="primary"
                    elevation="6"
                    x-large
                >
                お気に入り登録
                </v-btn>
            </v-card-actions>
        </v-card>
        <RouterLink class="button button--link" to="/about">
            About
        </RouterLink>
    </div>
</template>
