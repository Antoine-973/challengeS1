import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
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
    },
    {
      name: "confirmAccount",
      path: "/confirmAccount",
      component: () => import("../views/security/ConfirmAccountView.vue"),
    },
    {
      path: '/backOffice/review',
      name: 'backOffice',
      component: () => import('../views/ReviewBO.vue')
    },
    {
      path: "/backOffice/review/:id",
      name: "rateUser",
      component: () => import('../views/RateUserBO.vue')
    }
  ]
})

export default router
