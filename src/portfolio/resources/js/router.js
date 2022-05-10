import Vue from 'vue'
import VueRouter from 'vue-router'

import Detail from './Pages/Detail.vue'
import TopPage from './Pages/TopPage.vue'

Vue.use(VueRouter)

const routes = [
    {
        name: 'TopPage',
        path: '/',
        component: TopPage
    },
    {
        name: 'detail',
        path: '/detail/:id',
        component: Detail
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
