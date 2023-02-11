import {defineStore} from "pinia";
import router from "../router";
import UserService from "../services/UserService";
import {ref} from "vue";

export const useAuthStore = defineStore('auth', () => {
  const tokenInLocalStorage = localStorage.getItem('token') || null

  const token = ref(tokenInLocalStorage)
  const user = ref(null)

  const me = async () => {
    user.value = await UserService.getUser().catch(() => {
      logout();
    });
    return user.value;
  }

  const login = async (data) => {
    localStorage.setItem('token', data.token);
    token.value = data.token
    await router.push('/');
  } ;

  const logout = () => {
    localStorage.removeItem('token');
    token.value = null
    user.value = null
    router.push({ name: 'login' })
  }

  return {
    token,
    user,
    me,
    login,
    logout,
  }
})
