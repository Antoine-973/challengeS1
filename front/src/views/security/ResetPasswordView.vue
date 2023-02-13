<script setup>

import {inject, ref} from "vue";
import {useRouter} from "vue-router";
const openSnackbar = inject('SnackbarProvider:openSnackbar') ;
const router = useRouter();
import img from '../../../src/assets/images/connexion.png' ;
import environment from "../../environments/environment";

const onSubmitMethod = async () => {
    isSubmitting.value = true ;
    try {
        if(password.value === confirmPassword.value) {
            const response = await fetch(environment.API_BASE_URL + '/reset_passwords');
            const data = await response.json();
            const token = router.currentRoute.value.params.token ;
            let user  ;
            for (const reset of data['hydra:member']) {
                if (token === reset.token)
                    user = reset.users ;
            }

            await fetch(environment.API_BASE_URL + '/reset-password-user/' +user.split('/')[2] , {
                method:'PATCH',
                headers: {
                    'Content-Type': 'application/merge-patch+json',
                },
                body: JSON.stringify({ 'plainPassword': password.value})
            }) ;
        }

        openSnackbar({
            'message' :'Mot de passe modifié',
            'type' : 'success'
        }) ;



    } catch (e) {
        openSnackbar({
            'message' :'Une erreur est survenu',
            'type' : 'error'
        }) ;
    }
    isSubmitting.value = false ;
}
const password = ref() ;
const confirmPassword = ref() ;
const isSubmitting = ref(false) ;
</script>

<template>
    <div class="grid grid-cols-12 grid-rows-1 h-screen w-full">
        <div class="col-span-6">
            <img :src="img" alt="login" class="h-screen w-full object-cover">
        </div>
        <div class="flex flex-col col-span-6 justify-center justify-items-center">
            <h1 class="text-4xl text-center">Changement de mot de passe</h1>
            <div class="grid grid-cols-12 gap-6 justify-center p-8">

                <div class="col-span-6 form-control w-full">
                    <label for="password" class="label">Mot de passe</label>
                    <input type="password" v-model="password" class="input input-bordered w-full">
                </div>
                <div class="col-span-6 form-control w-full">
                    <label for="confirmPassword" class="label">Confirmation du mot de passe</label>
                    <input type="password" v-model="confirmPassword" class="input input-bordered w-full">
                </div>
                <div class=" col-span-12 w-full">
                    <button @click="onSubmitMethod" :disabled="isSubmitting" type="submit" class="btn btn-primary w-full">Changer le mot de passe</button>
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
