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
      path: '/conversations/:id',
      name : 'conversations',
      meta: {
        roles: ['ROLE_USER']
      },
      component: () => import('../views/Chat/adopter/AdopterConversationView.vue')
    },
    {
      path:'/back-office/conversations/:id',
      name:'back-office-conversationId',
      meta: {
        roles:['ROLE_SPA']
      },
      component: () => import('../views/Chat/adopter/SpaConversationView.vue')
    },
    {
      path:'/back-office/conversations',
      name:'back-office-conversations',
      meta: {
        roles:['ROLE_SPA']
      },
      component: () => import('../views/Chat/adopter/SpaConversationList.vue')
    },
    {
      path: '/donation',
      name: 'donation',
      component: () => import('../views/DonationView.vue'),
      meta: {
        roles: ['ROLE_USER']
      },
    },
    {
      path: '/donation/success',
      name: 'donationSuccess',
      component: () => import('../views/SuccessView.vue'),
      meta: {
        roles: ['ROLE_USER']
      },
    },
    {
      path: '/donation/error',
      name: 'donationError',
      component: () => import('../views/DonationErrorView.vue'),
      meta: {
        roles: ['ROLE_USER']
      },
    },
    {
      path: '/ask-reset-password',
      name: 'askResetPassword',
      meta: {
        roles: ['ROLE_GUEST']
      },
      component: () => import('../views/security/AskResetPasswordView.vue')
    },
    {
      path: '/reset-password/:token',
      name: 'resetPassword',
      meta : {
        roles: ['ROLE_GUEST']
      },
      component: () => import('../views/security/ResetPasswordView.vue')
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
      path:'/profile',
      name: 'profile',
      meta: {
        roles:['ROLE_USER']
      },
      component: () => import('../views/profile/UserProfileView.vue')
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
    if (to.name === 'login' || to.name === 'register' || to.name === 'askResetPassword' || to.name === 'resetPassword' ){
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
