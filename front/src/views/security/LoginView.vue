<script setup>
import {inject} from "vue";
import LoginForm from "../../components/form/LoginForm.vue";

const login = inject('AuthProvider:login');
const openSnackbar = inject('SnackbarProvider:openSnackbar');
const onSubmitMethod = async (data) => {

        try {
            const response = await fetch('https://localhost/auth', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });
            const json = await response.json();
            await login(json);
            openSnackbar({
                message: 'Login successful',
                type: 'success'
            }) ;
        } catch (e) {
            console.log(e);
        }
}

</script>

<template>
    <div class="flex justify-center justify-items-center flex-col  h-full w-full">
        <h1 class="text-4xl text-center">Login</h1>
        <LoginForm :submit="onSubmitMethod" />
    </div>
</template>


<style scoped>

</style>
