import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import DetailView from '@/views/DetailView.vue'
import TopPage from '@/views/TopPage.vue'
import LoginView from '@/views/LoginView.vue'
import UserRegisterView from '@/views/UserRegisterView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'top',
    component: TopPage
  },
  {
    path: '/home',
    name: 'home',
    component: HomeView,
    meta: {
      isLogin: true
    }
  },
  {
    path: '/detail/:id',
    name: 'detail',
    component: DetailView,
    meta: {
      isLogin: true
    }
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/register',
    name: 'register',
    component: UserRegisterView
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

function isAuth() {
  return localStorage.getItem("isAuth");
}

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.isLogin)) {
    if (!isAuth()) {
        next("/login");
    } else {
        next();
    }
  } else {
    next()
  }
})

export default router
