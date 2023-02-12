<script setup>
    import {useRouter} from "vue-router";

    const router = useRouter();
    const code = router.currentRoute.value.params.code;
</script>

<template>
    <main>
        <div class="grid grid-cols-12 grid-rows-1 h-screen w-full">
            <div class="col-span-6">
                <img v-if="code === '403'" src="../../public/403.jpeg" alt="login" class="h-screen w-full object-cover">
                <img v-if="code === '404'" src="../../public/404.jpeg" alt="login" class="h-screen w-full object-cover">
                <img v-if="code === '500'" src="../../public/500.jpeg" alt="login" class="h-screen w-full object-cover">
            </div>
            <div class="flex flex-col gap-4 col-span-6 justify-center items-center">
                <h1 class="text-4xl text-center">Erreur {{code}}</h1>
                <h2 v-if="code === '404'" class="text-2xl text-center">La page demandée n'existe pas</h2>
                <h2 v-if="code === '403'" class="text-2xl text-center">Vous n'avez pas accès à cette page</h2>
                <h2 v-if="code === '500'" class="text-2xl text-center">Une erreur est survenue</h2>
                <router-link to="/" class="btn btn-primary">Retour à l'accueil</router-link>
            </div>
        </div>
    </main>
</template>
