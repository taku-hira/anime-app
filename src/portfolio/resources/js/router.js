import Vue from 'vue'
import VueRouter from 'vue-router'

import About from './Pages/About.vue'
import TopPage from './Pages/TopPage.vue'

Vue.use(VueRouter)

const routes = [
    {
        name: 'TopPage',
        path: '/',
        component: TopPage
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
