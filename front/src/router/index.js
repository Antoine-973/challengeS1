import {createRouter, createWebHistory} from 'vue-router'
import UserService from "../services/UserService";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      meta: {
        roles: ['ROLE_USER']
      },
      component: () => import('../views/HomeView.vue')
    },
    {
      name: "register",
      path: "/register",
      meta: {
        roles: ['ROLE_GUEST']
      },
      component: () => import("../views/security/RegisterView.vue"),
    },
    {
      name: "login",
      path: "/login",
      meta: {
        roles: ['ROLE_GUEST']
      },
      component: () => import("../views/security/LoginView.vue"),
    },
    {
      name: "confirmAccount",
      path: "/confirmAccount",
      meta: {
        roles: ['ROLE_GUEST']
      },
      component: () => import("../views/security/ConfirmAccountView.vue"),
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  if (to.meta.roles.includes('ROLE_GUEST')) {
    next();
  } else {
    if (localStorage.getItem('token') !== null) {
      const user = await UserService().getUser();
      if (user.roles.some(role => to.meta.roles.includes(role))) {
        next();
      }
      else {
        next();
      }
    } else {
      next({name: 'login'});
    }
  }
})

export default router
