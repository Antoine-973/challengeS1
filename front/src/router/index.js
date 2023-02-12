import {createRouter, createWebHistory} from 'vue-router'
import {useAuthStore} from "../stores/auth.store";

const router = createRouter({
  history: createWebHistory(),
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
      path: '/back-office/likes',
      name: 'animalsLike',
      component: () => import('../views/SpaBoView.vue'),
      meta: {
        roles: ['ROLE_SPA']
      },
    },
    {
      path: '/back-office/likes/:id',
      name: 'likeId',
      component: () => import('../views/SpaLikeIdView.vue'),
      meta: {
        roles: ['ROLE_SPA']
      },
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
      name: "confirm-account",
      path: "/confirm-account",
      meta: {
        roles: ['ROLE_GUEST']
      },
      component: () => import("../views/security/ConfirmAccountView.vue"),
    },
    {
      path: '/back-office/reviews',
      name: 'backOffice review',
      component: () => import('../views/ReviewBO.vue'),
      meta: {
        roles: ['ROLE_SPA']
      }
    },
    {
      path: "/back-office/reviews/:id",
      name: "rateUser",
      component: () => import('../views/RateUserBO.vue'),
      meta: {
        roles: ['ROLE_SPA']
      }
    },
    {
      path: "/back-office/admin/reviews",
      name: "backoffice",
      component: () => import('../views/Admin/ReviewList.vue'),
      meta: {
        roles: ['ROLE_ADMIN']
      }
    },
    {
      path: "/back-office/admin/reviews/:id",
      name: "backoffice reviews",
      component: () => import('../views/Admin/ReviewManagement.vue'),
      meta: {
        roles: ['ROLE_ADMIN']
      }
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
        if (user.roles.some(role => to.meta.roles.includes(role) || user.roles.includes('ROLE_ADMIN')))
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
