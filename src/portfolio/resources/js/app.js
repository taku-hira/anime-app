require('./bootstrap');
import Vue from 'vue'
import router from './router'
import App from './App.vue'
import Vuetify from 'vuetify'
import axios from 'axios'

Vue.use(Vuetify);
Vue.prototype$axios = axios

new Vue({
    el: '#app',
    router,
    components: { App },
    template: '<App />',
    vuetify: new Vuetify()
})
