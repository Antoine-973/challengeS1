<script setup>
import {useAuthStore} from "../../stores/auth.store";
import {storeToRefs} from "pinia";
import {useRouter} from "vue-router";
import {onBeforeMount,ref} from "vue";
import {getUserConversation} from "../../services/conversationService";

const router = useRouter() ;

const authStore = useAuthStore();
const { user } = storeToRefs(authStore);

const conversations = ref(null) ;
onBeforeMount(async () => {
    conversations.value = await getUserConversation({userId: user.value.id}) ;
}) ;


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

            <div class="grid grid-cols-12 ">
                <button @click="router.push('/')" class="btn btn-ghost col-span-12 text-secondary hover:bg-transparent link-hover">Voir les animaux</button>
            </div>

            <span class="  text-secondary ">Conversations</span>
            <ul class="menu bg-base-100 w-full">
                <template v-for="conversation in conversations">
                   <li>
                       <router-link :to="'/conversations/'+conversation.id">
                           {{conversation.adoptionRequest.animal.name}} - {{conversation.adoptionRequest.animal.spa.name}}
                       </router-link>
                   </li>
                </template>
            </ul>

        </div>
    </main>
</template>
