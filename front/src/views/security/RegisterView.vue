<script setup >

import UserForm from "../../components/form/UserForm.vue";
const register = (data) => {
    console.log(data);
}


</script>

<template>
    <div class="flex justify-center justify-items-center flex-col  h-full w-full">
        <h1 class="text-4xl text-center">Register</h1>
        <UserForm :submit="register" />
    </div>
</template>

