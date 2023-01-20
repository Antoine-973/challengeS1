<script setup>
import {reactive, defineProps, ref, inject} from "vue";

const props = defineProps({
    submit: {
        type: Function,
        required: true
    },
    defaultValues: {
        type: Object,
        defaultValues: {},
        required: false
    }
});

const user = reactive({
    firstname: '',
    lastname: '',
    birthdate: '',
    plainPassword: '',
    confirmPassword: '',
    email: '',
    roles: []
});

const isSubmitting = ref(false);

for (const value in props.defaultValues) {
    user[value] = props.defaultValues[value];
}

const openSnackbar = inject('SnackbarProvider:openSnackbar');


const onSubmit = async () => {
    isSubmitting.value = true;

    if(user.plainPassword === user.confirmPassword) {
       if (user.lastname && user.firstname && user.email && user.plainPassword && user.birthdate) {
           try {
               await props.submit(user);
               user.plainPassword = null ;
               user.confirmPassword = null ;
               user.birthdate = null ;
               user.firstname = null ;
               user.lastname = null ;
               user.email = null ;
               user.roles = null ;
               openSnackbar({
                   message: 'User created verify your email',
                   type: 'success'
               });
               setTimeout(() => {
                   isSubmitting.value = false;
               }, 1000);
           } catch (e) {
               openSnackbar({
                   message: 'Error during user creation',
                   type: 'error'
               });
               setTimeout(() => {
                   isSubmitting.value = false;
               }, 1000);
           }
       }
       else {
           openSnackbar({
                message: 'Please fill all the fields',
                type: 'error'
              });
       }
    }
    else {
        openSnackbar({
            message: 'Passwords do not match',
            type: 'error'
          });
    }


}

</script>

<template>
    <div class="grid grid-cols-12  justify-center p-8">
        <form @submit.prevent="onSubmit" class="col-span-12">
            <div class="grid grid-cols-12 gap-6 justify-center p-8">
                <div class="col-span-6 form-control w-full ">
                    <label for="firstname" class="label" >Firstname</label>
                    <input type="text" id="firstname" v-model="user.firstname" autocomplete="given-name" class="input input-bordered w-full ">
                </div>
                <div class="col-span-6 form-control w-full ">
                    <label for="lastname" class="label">Lastname</label>
                    <input type="text" id="lastname" v-model="user.lastname" autocomplete="family-name" class="input input-bordered w-full ">
                </div>
                <div class="col-span-6 form-control w-full ">
                    <label for="birthdate" class="label">Birthdate</label>
                    <input type="date" id="birthdate" v-model="user.birthdate" class="input input-bordered w-full ">
                </div>
                <div class="col-span-6 form-control w-full ">
                    <label for="email" class="label">Email</label>
                    <input type="email" id="email" v-model="user.email" class="input input-bordered w-full ">
                </div>
                <div class="col-span-6 ">
                    <label for="password" class="label">Password</label>
                    <input type="password" id="password" v-model="user.plainPassword" class="input input-bordered w-full ">
                </div>
                <div class="col-span-6  ">
                    <label for="confirmPassword" class="label">Confirm password</label>
                    <input type="password" id="confirmPassword" v-model="user.confirmPassword" class="input input-bordered w-full ">
                </div>
                <div  class=" col-span-12 w-full">
                    <button :disabled="isSubmitting" type="submit" class="w-full btn">Submit</button>
                </div>
            </div>
        </form>
        <router-link to="/login" class="col-span-12 pr-8 text-right" >Déjà un compte ? Connecte-toi</router-link>
    </div>
</template>

<style scoped>

</style>
