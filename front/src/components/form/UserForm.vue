<script setup>
import {reactive, defineProps} from "vue";

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
    password: '',
    confirmPassword: '',
    email: '',
    roles: []
});

for (const value in props.defaultValues) {
    user[value] = props.defaultValues[value];
}

const onSubmit = () => {

   if(user.password === user.confirmPassword) {
       if (user.lastname && user.firstname && user.email && user.password && user.birthdate) {
           props.submit(user);
       }
   }

}

</script>

<template>
    <form @submit.prevent="onSubmit">
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
                    <input type="password" id="password" v-model="user.password" class="input input-bordered w-full ">
                </div>
                <div class="col-span-6  ">
                    <label for="confirmPassword" class="label">Confirm password</label>
                    <input type="password" id="confirmPassword" v-model="user.confirmPassword" class="input input-bordered w-full ">
                </div>
                <div  class="bg-gray-50 col-span-12 w-full">
                    <button type="submit" class="w-full btn">Submit</button>
                </div>
            </div>
    </form>
</template>

<style scoped>

</style>
