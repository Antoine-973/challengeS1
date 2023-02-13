<script setup>
import Menu from "../components/TemplateBO.vue";
import {onBeforeMount, ref} from 'vue'
import {getAcceptedLikesUsers} from '../services/reviewUserService';
import {useAuthStore} from "../stores/auth.store";
import {storeToRefs} from "pinia";

const authStore = useAuthStore();
const {user} = storeToRefs(authStore);
const likes = ref(null);

onBeforeMount(async () => {
    const likesData = await getAcceptedLikesUsers();
    likes.value = likesData.filter(el => el.animal.spa.id === user.value.spa.id);
})
</script>

<template>
  <main>
     <div class="flex justify-between mt-5">
        <Menu/>

        <div class="grow ml-32">
            <h1 class="text-center mb-11 text-lg">Notation des utilisateurs</h1>

            <div class="overflow-x-auto">
                <table class="table w-5/6 mt-12 justify-center">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Noter l'utilisateur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="likes" v-for="like in likes">
                            <td>{{ like.user.lastname }}</td>
                            <td>{{ like.user.firstname }}</td>
                            <td><a :href="'/back-office/reviews/' + like.user.id"><i class="fas fa-pen"></i></a></td>
                        </tr>
                        <tr v-else>
                            <td colspan="4" class="text-center">Aucune notation</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
     </div>
  </main>
</template>
