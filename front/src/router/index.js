import { createRouter, createWebHistory } from 'vue-router'
import jwt_decode from 'jwt-decode';
import { getUserInfo } from '../services/rateUserService';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/donation',
      name: 'donation',
      component: () => import('../views/DonationView.vue')
    },
    {
      path: '/success',
      name: 'success',
      component: () => import('../views/SuccessView.vue')
    },
    {
      path: '/error',
      name: 'error',
      component: () => import('../views/ErrorView.vue')
    },
    {
      path: '/AllAnimalsLike',
      name: 'animalsLike',
      component: () => import('../views/SpaBoView.vue'),
      meta:{
        isAuth: true,
        authorize: "ROLE_SPA", 
      }
    },
    {
      path: '/likes/:id',
      name: 'likeId',
      component: () => import('../views/SpaLikeIdView.vue'),
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
      name: 'backOffice review',
      component: () => import('../views/ReviewBO.vue'),
      meta:{
        isAuth: true,
        authorize: "ROLE_SPA", 
      }
    },
    {
      path: "/backOffice/review/:id",
      name: "rateUser",
      component: () => import('../views/RateUserBO.vue'),
      meta:{
        isAuth: true,
        authorize: "ROLE_SPA",
      }
    },
    {
      path: "/backOffice/admin",
      name: "backoffice",
      component: () => import('../views/Admin/ReviewList.vue'),
      meta:{
        isAuth: true,
        authorize_admin: "ROLE_ADMIN",
      }
    },
    {
      path: "/backOffice/admin/reviews/:id",
      name: "backoffice reviews",
      component: () => import('../views/Admin/ReviewManagement.vue'),
      meta:{
        isAuth: true,
        authorize_admin: "ROLE_ADMIN",
      }
    }
  ]
})

router.beforeEach((to, from, next)=>{
  if(to.matched.some(record => record.meta.isAuth)){
    let token = localStorage.getItem('token')
    if(!token){
      next('/login')
    }
  }

  if(to.matched.some(record => record.meta.authorize)){
    let token = localStorage.getItem('token')
    let connectedUser = jwt_decode(token)
    let roleUser = connectedUser.roles;
    let isAuthorize = roleUser.includes('ROLE_SPA');

    if(!isAuthorize){
      next('/login')
    }

  }

  if(to.matched.some(record => record.meta.authorize_admin)){
    let token = localStorage.getItem('token')
    let connectedUser = jwt_decode(token)
    let roleUser = connectedUser.roles;
    let isAuthorize = roleUser.includes('ROLE_ADMIN');

    if(!isAuthorize){
      next('/login')
    }

  }

  next()
})

export default router
