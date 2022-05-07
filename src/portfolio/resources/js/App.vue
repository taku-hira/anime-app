<template>
    <div>
        <v-app>
            <header>
            <HeaderComponent />
            </header>
            <v-main>
                <v-container>
                    <RouterView />
                </v-container>
            </v-main>
        </v-app>
    </div>
</template>

<script>
import HeaderComponent from './components/HeaderComponent.vue'

export default {
  components: {
    HeaderComponent,
  }
}
</script>
