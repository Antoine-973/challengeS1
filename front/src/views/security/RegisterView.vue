<script setup >

import UserForm from "../../components/form/UserForm.vue";
const register = async (data) => {

    try {
        const response = await fetch('https://localhost/register', {
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
    <div class="grid grid-cols-12 grid-rows-1 h-screen w-full">
        <div class="col-span-6">
            <img src="../../../public/connexion.png" alt="login" class="h-screen w-full object-cover">
        </div>
        <div class="flex flex-col col-span-6 justify-center justify-items-center">
            <h1 class="text-4xl text-center">Inscription</h1>
            <UserForm :submit="register" />
        </div>
    </div>
</template>

