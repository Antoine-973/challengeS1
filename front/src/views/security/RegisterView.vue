<script setup >

import UserForm from "../../components/form/UserForm.vue";
const register = async (data) => {

    try {
        const response = await fetch('https://localhost/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const json = await response.json();
    } catch (e) {
        console.log(e);
    }

}


</script>

<template>
    <div class="flex justify-center justify-items-center flex-col  h-full w-full">
        <h1 class="text-4xl text-center">Register</h1>
        <UserForm :submit="register" />
    </div>
</template>

