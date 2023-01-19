<template>
<slot :login="login" :user="user">
</slot>
</template>

<script setup>

import {provide, ref} from "vue";
import jwtDecode from"jwt-decode";

const user = ref(null) ;

const login = async (data) => {

    localStorage.setItem('token', data.token);
    await getUser(data.token);
} ;

const logout = () => {
   user.value = null ;
} ;

const getUser = async (data) => {
    try {
        const decoded = await jwtDecode(data.token);

        const response = await fetch('https://localhost/users?email='+decoded.username) ;
        const json = await response.json();
        user.value = json['hydra:member'][0];
    } catch (e) {
        console.log(e);
    }
}

if (localStorage.getItem('token')) {
    getUser({token: localStorage.getItem('token')});
}

provide('AuthProvider:user', user);
provide('AuthProvider:login', login);
provide('AuthProvider:logout', logout);


</script>

