import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SpaBoView from '../views/SpaBoView.vue'
import SpaLikeIdView from '../views/SpaLikeIdView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/AllAnimalsLike',
      name: 'animalsLike',
      component: SpaBoView
    },
    {
      path: '/likes/:id',
      name: 'likeId',
      component: SpaLikeIdView
    },
    {
      name: "register",
      path: "/register",
      component: () => import("../views/security/RegisterView.vue"),
    }
  ]
})

export default router
