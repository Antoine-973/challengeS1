import { createRouter, createWebHistory } from 'vue-router'
import jwt_decode from 'jwt-decode';
import HomeView from '../views/HomeView.vue'

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

  next()
})

export default router
