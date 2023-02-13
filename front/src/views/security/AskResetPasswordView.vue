<script setup>

import {inject, ref} from "vue";
const openSnackbar = inject('SnackbarProvider:openSnackbar') ;

const onSubmitMethod = async () => {
    isSubmitting.value = true ;
    try {
        const response = await fetch('https://localhost/reset-password', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({users: {email: email.value}})
        });
        await response.json();
        isSubmitting.value = false ;
        openSnackbar({
            message: "Une demande a été envoyé à ce mail s'il existe",
            type: 'success'
        }) ;
    } catch (e) {
        openSnackbar({
            message: "Une demande a été envoyé à ce mail s'il existe",
            type: 'success'
        }) ;
    }
}
const email = ref() ;
const isSubmitting = ref(false) ;
</script>

<template>
    <div class="grid grid-cols-12 grid-rows-1 h-screen w-full">
        <div class="col-span-6">
            <img src="src/assets/images/connexion.png" alt="login" class="h-screen w-full object-cover">
        </div>
        <div class="flex flex-col col-span-6 justify-center justify-items-center">
            <h1 class="text-4xl text-center">Changement de mot de passe</h1>
            <div class="grid grid-cols-12 gap-6 justify-center p-8">

                <div class="col-span-12 form-control w-full">
                    <label for="email" class="label">Email</label>
                    <input type="email" v-model="email" autocomplete="current-email" class="input input-bordered w-full">
                </div>
                <div class=" col-span-12 w-full">
                    <button @click="onSubmitMethod" :disabled="isSubmitting" type="submit" class="btn btn-primary w-full">Envoyer une demande</button>
                </div>
            </div>
            <div class="col-span-12 pr-8 text-right">
                <router-link to="/register" class="btn-link">Register</router-link>
                <router-link class="px-8 btn-link" to="/login"  >Login</router-link>
            </div>
        </div>
    </div>
</template>


<style scoped>

</style>
