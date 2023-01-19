import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Home.vue')
    },
    {
      name: "register",
      path: "/register",
      component: () => import("../views/security/RegisterView.vue"),
    },
    {
      name: "login",
      path: "/login",
      component: () => import("../views/security/LoginView.vue"),
    }
  ]
})

export default router
