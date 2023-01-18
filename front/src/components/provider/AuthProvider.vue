<template>
<slot :login="login" :user="user">
</slot>
</template>

<script setup>

import {provide, ref} from "vue";

const user = ref(null) ;

const login = (data) => {
   user.value = data ;
} ;

const logout = () => {
   user.value = null ;
} ;

provide('AuthProvider:user', user);
provide('AuthProvider:login', login);
provide('AuthProvider:logout', logout);


</script>

