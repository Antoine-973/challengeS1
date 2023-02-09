import {createRouter, createWebHistory} from 'vue-router'
import {useAuthStore} from "../stores/auth.store";

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
      name: "error",
      path: "/error/:code",
      meta: {
        roles: ['ROLE_GUEST']
      },
      component: () => import("../views/ErrorView.vue"),
    },
    {
      name:"logout",
      path: "/logout",
      meta: {
        roles: ['ROLE_USER']
      }
    },
    {
      name: "confirmAccount",
      path: "/confirmAccount",
      meta: {
        roles: ['ROLE_GUEST']
      },
      component: () => import("../views/security/ConfirmAccountView.vue"),
    },
    {
      path: "/:pathMatch(.*)*",
      redirect: {name: "error", params: {code: 404}}
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  if (to.meta.roles.includes('ROLE_GUEST')) {
    if (to.name === 'login' || to.name === 'register'){
      if (localStorage.getItem('token') !== null) {
        const authStore = useAuthStore();
        const user = authStore.me();
        if (user) {
          next({name: 'home'});
        }
        else {
          next();
        }
      }
      else {
        next();
      }
    }
    else {
      next();
    }
  }
  else {
    if (localStorage.getItem('token') !== null) {
      if (to.name === 'logout') {
        const authStore = useAuthStore();
        await authStore.logout();
      }
      const authStore = useAuthStore();
      const user = await authStore.me();
      if (user) {
        if (user.roles.some(role => to.meta.roles.includes(role)))
          next();
        else
          next({name: 'error', params: {code: 403}});
      }
      else {
        next({name: 'login'});
      }
    }
    else {
      next({name: 'login'});
    }
  }
})

export default router
