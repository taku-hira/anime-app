<template>
    <div>
      <v-app>
        <header>
          <header-component />
        </header>
        <v-main>
            <v-container>
              <router-view />
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
