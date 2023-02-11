<script setup>
import {onMounted, ref} from "vue";
const sec = ref(5);

onMounted(async () => {
    while(sec.value > 0) {
        await new Promise(resolve => setTimeout(resolve, 1000));
        sec.value--;
        if(sec.value === 0) {
            window.location.href = 'http://localhost:3000';
        }
    }
})
</script>

<template>
    <div class="text-4xl text-center pt-8">
        <h1>Votre paiement a été pris en compte</h1>
        <p>Merci de la part de la SPA et de nos amis les animaux :)</p>
        <h2>Vous serez redirigé sur la page d'acceuil dans {{sec}} secondes</h2>
    </div>
</template>