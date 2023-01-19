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
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      name: "UserList",
      path: "/users/",
      component: () => import("../components/user/List.vue"),
    },
    {
      name: "UserCreate",
      path: "/users/create",
      component: () => import("../components/user/Create.vue"),
    },
    {
      name: "UserUpdate",
      path: "/users/edit/:id",
      component: () => import("../components/user/Update.vue"),
    },
    {
      name: "UserShow",
      path: "/users/show/:id",
      component: () => import("../components/user/Show.vue"),
    },
    {
      name: "register",
      path: "/register",
      component: () => import("../views/security/RegisterView.vue"),
    }
  ]
})

export default router
