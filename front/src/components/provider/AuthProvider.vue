<template>
<slot :login="login" :user="user">
</slot>
</template>

<script setup>

import {provide, ref} from "vue";
import {useRouter} from "vue-router";
import UserService from "../../services/UserService";

const user = ref(null) ;
const router = useRouter();

const updateUser = async () => {
    user.value = await UserService().getUser();
    console.log(user.value);
}

const login = async (data) => {
    localStorage.setItem('token', data.token);
} ;

const logout = () => {
   user.value = null ;
} ;

provide('AuthProvider:user', user);
provide('AuthProvider:updateUser', updateUser);
provide('AuthProvider:login', login);
provide('AuthProvider:logout', logout);


</script>

