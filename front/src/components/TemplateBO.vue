<script setup>
import {useAuthStore} from "../stores/auth.store";
import {storeToRefs} from "pinia";

const authStore = useAuthStore();
  const { user } = storeToRefs(authStore);

</script>

<template>
  <main>
    <div class="border-r-[1px] h-full h-screen" v-if="user.roles.includes('ROLE_SPA')">
        <h1 class="text-center text-3xl text-primary font-bold mt-11">SPAdoption</h1>
        <div class="drawer-side">
          <label for="my-drawer-2" class="drawer-overlay"></label>
          <ul class="menu p-4 w-80 bg-base-100 text-base-content mt-11">
            <li class="text-lg"><a href="/back-office/likes">Liste des likes</a></li>
            <li class="text-lg"><a href="/back-office/reviews">Noter un utilisateur</a></li>
            <li class="text-lg"><a href="/back-office/conversations">Liste des conversations</a></li>
            <li class="text-lg"><router-link to="/">Retour au site</router-link></li>
          </ul>
        </div>
    </div>
    <div class="border-r-[1px] h-full h-screen" v-else>
        <h1 class="text-center text-3xl text-primary font-bold mt-11">SPAdoption Admin</h1>
        <div class="drawer-side">
          <label for="my-drawer-2" class="drawer-overlay"></label>
          <ul class="menu p-4 w-80 bg-base-100 text-base-content mt-11">
              <li class="text-lg"><a href="/back-office/likes">Liste des likes</a></li>
              <li class="text-lg"><a href="/back-office/admin/reviews">Gestion des commentaires</a></li>
              <li class="text-lg"><a href="/back-office/conversations">Liste des conversations</a></li>
              <li class="text-lg"><router-link to="/">Retour au site</router-link></li>
          </ul>
        </div>
    </div>

  </main>
</template>
