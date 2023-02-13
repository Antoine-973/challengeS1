<script setup>
import {useAuthStore} from "../../stores/auth.store";
import {storeToRefs} from "pinia";

const authStore = useAuthStore();
const { user } = storeToRefs(authStore);
</script>

<template>
    <main>
        <div class="flex flex-col h-screen">
            <div class="w-full bg-primary border-b grid grid-cols-12 justify-between items-center py-7 px-2">
                <div class="col-span-2 dropdown dropdown-bottom dropdown-right">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <button class="w-10 rounded-full">
                            <i class="fa-solid fa-user fa-xl text-white"></i>
                        </button>
                    </label>
                    <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                        <li>
                            <router-link to="/profile" class="justify-between" >
                                Profil
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
            <div class="grid grid-cols-12 grid-rows-1 btn-group">
                <button class="btn btn-ghost col-span-6 text-secondary hover:bg-transparent link-hover">Conversations</button>
                <button class="btn btn-ghost col-span-6 text-secondary hover:bg-transparent link-hover">En attente</button>
            </div>
        </div>
    </main>
</template>
