import Vue from 'vue'
import VueRouter from 'vue-router'

import About from './Pages/About.vue'
import Welcome from './Pages/Welcome.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Welcome
    },
    {
        path: '/about',
        component: About
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
