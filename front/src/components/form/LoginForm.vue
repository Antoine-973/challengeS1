<script setup>
import {inject, reactive, ref} from "vue";

    const props = defineProps({
        submit: {
            type: Function,
            required: true
        }
    });

    const user = reactive({
        email: '',
        password: ''
    }) ;
    const isSubmitting = ref(false) ;
    const openSnackbar = inject('SnackbarProvider:openSnackbar') ;

    const onSubmit = async () => {
        isSubmitting.value = true ;
        if(user.email && user.password) {
            try {
                await props.submit(user) ;
                user.email = null ;
                user.password = null ;
                setTimeout(() => {
                    isSubmitting.value = false;
                }, 1000);

            } catch (e) {
                openSnackbar({
                    message: 'Error during login',
                    type: 'error'
                }) ;
                setTimeout(() => {
                    isSubmitting.value = false;
                }, 1000);
            }
        }
        else {
            openSnackbar({
                message: 'Please fill all fields',
                type: 'error'
            }) ;
        }
    }
</script>

<template>
    <div class="grid grid-cols-12 justify-center p-8">
        <form @submit.prevent="onSubmit" class="col-span-12">
            <div class="grid grid-cols-12 gap-6 justify-center p-8">
                <div class="col-span-6 form-control w-full">
                    <label for="email" class="label">Email</label>
                    <input type="email" id="email" name="email" v-model="user.email" autocomplete="current-email" class="input input-bordered w-full">
                </div>
                <div class="col-span-6 form-control w-full">
                    <label for="password" class="label">Password</label>
                    <input type="password" id="password" name="password" v-model="user.password" autocomplete="current-password" class="input input-bordered w-full">
                </div>
                <div class="bg-gray-50 col-span-12 w-full">
                    <button type="submit" class="btn w-full btn-primary" :disabled="isSubmitting">Login</button>
                </div>

            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
