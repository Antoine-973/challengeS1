<script setup>
import {inject} from "vue";
import LoginForm from "../../components/form/LoginForm.vue";
import {useAuthStore} from "../../stores/auth.store";
import environment from "../../environments/environment";

const authStore = useAuthStore();
const openSnackbar = inject('SnackbarProvider:openSnackbar');

const onSubmitMethod = async (data) => {

        try {
            const response = await fetch(environment.API_BASE_URL + '/auth', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });
            const json = await response.json();
            await authStore.login(json);
            openSnackbar({
                message: 'Connexion réussie',
                type: 'success'
            }) ;
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
            <h1 class="text-4xl text-center">Connexion Spadoption</h1>
            <LoginForm :submit="onSubmitMethod" />
        </div>
    </div>
</template>


<style scoped>

</style>
