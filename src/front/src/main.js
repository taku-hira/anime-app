import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import axios from 'axios'
import VueMeta from 'vue-meta'
import StarRating from 'vue-star-rating'

Vue.config.productionTip = false

Vue.prototype.$axios = axios
axios.defaults.baseURL = process.env.VUE_APP_API_ORIGIN
axios.defaults.withCredentials = true
Vue.use(VueMeta)
Vue.use(StarRating)

new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
