<script setup>
import {useAuthStore} from "../../stores/auth.store";
import {storeToRefs} from "pinia";
import {inject, reactive, ref} from "vue";
import {editUser} from "../../services/UserService";
const openSnackbar = inject('SnackbarProvider:openSnackbar');

const authStore = useAuthStore();
const {user} = storeToRefs(authStore);
const isSubmitting = ref(false);

const data = reactive ({
    firstname: user.value.firstname,
    lastname: user.value.lastname,
    description: user.value.description,
});

const onSubmit = async () => {
    isSubmitting.value = true;
    try {
        await editUser({
            firstname: data.firstname,
            lastname: data.lastname,
            id: user.value.id,
            description: data.description,
        });
        openSnackbar({
            message: 'User updated',
            type: 'success'
        });
    }catch (e) {
        openSnackbar({
            message: 'Une erreur est survenue' + e ,
            type: 'error'
        });
    }
    isSubmitting.value = false;

}
</script>
<template>
    <main>
        <div class="grid grid-cols-12 grid-rows-1 w-full h-full">
            <div class="h-screen col-span-3 border-r border-1 border-gray-300">
                <div class="w-full bg-primary border-b grid grid-cols-12 justify-between items-center py-7 px-2">
                    <div class="col-span-2 dropdown dropdown-bottom dropdown-right">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <button class="w-10 rounded-full">
                                <i class="fa-solid fa-user fa-xl text-white"></i>
                            </button>
                        </label>
                        <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                            <li>
                                <router-link to="/" class="justify-between" >
                                    home
                                </router-link>
                            </li>
                            <li v-if="user.roles.includes('ROLE_ADMIN') || user.roles.includes('ROLE_SPA')">
                                <router-link to="/back-office/likes">Pannel d'administration</router-link>
                            </li>
                            <li><router-link to="/logout">Déconnexion</router-link></li>
                        </ul>
                    </div>
                    <div class="text-white mx-4 col-span-10 text-lg font-bold">{{user.firstname}} {{user.lastname}}</div>
                </div>
                <div class="text-center pt-4">
                    <span>
                         {{user.description}}
                    </span>
                </div>
            </div>
            <div class="col-span-9 relative bg-accent">
                <div class="flex flex-col justify-between items-center h-full py-5">
                    <form @submit.prevent="onSubmit" class="col-span-12">

                        <div class="grid grid-cols-12 gap-6 justify-center p-8">
                            <div class="col-span-6 form-control w-full ">
                                <label for="firstname" class="label" >Prénom</label>
                                <input type="text" id="firstname" v-model="data.firstname" autocomplete="given-name" class="input input-bordered w-full ">
                            </div>
                            <div class="col-span-6 form-control w-full ">
                                <label for="lastname" class="label">Nom de famille</label>
                                <input type="text" id="lastname" v-model="data.lastname" autocomplete="family-name" class="input input-bordered w-full ">
                            </div>
                            <div class="col-span-12 form-control w-full ">
                                <label for="lastname" class="label">Description</label>
                                <textarea type="text"  v-model="data.description" class="input input-bordered w-full "/>
                            </div>
                            <div  class=" col-span-12 w-full">
                                <button :disabled="isSubmitting" type="submit" class="w-full btn btn-primary">Modifier mon profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</template>
