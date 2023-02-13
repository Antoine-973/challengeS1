<script setup>

import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import environment from "../../environments/environment";

// const data =  window.location.href.split('/').pop().split('?')[1].split('&').reduce((acc, item) => {
//     const [key, value] = item.split('=');
//     acc[key] = value;
//     return acc;
// },{});


const router = useRouter();
const data = router.currentRoute.value.query;
console.log(data)
const isValid = ref(false);
const isPending = ref(true);
const sec = ref(5);

const verifyUser = async () => {
    const response = await fetch(environment.API_BASE_URL + '/confirm', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({confirmAccount: data.token.trim() })
    });
    return await response.json();

}

onMounted(async () => {
    try {
        await verifyUser();
        isValid.value = true;
        isPending.value=false;

    } catch (e) {
        isPending.value=false;
    }

    while(sec.value > 0) {
        await new Promise(resolve => setTimeout(resolve, 1000));
        sec.value--;
        if(sec.value === 0) {
            window.location.href = 'http://localhost:3000/login';
        }
    }

})




</script>

<template>

    <div v-if="isPending" class="flex justify-center justify-items-center flex-col  h-full w-full">
        <h1 class="text-4xl text-center pt-8">Loading ...</h1>
    </div>

    <div v-else >
        <div v-if="isValid"  class="text-4xl text-center pt-8">
            <h1 >Account verified</h1>
            <h2>You will be redirect in {{sec}} secondes</h2>
        </div>

        <h1 v-else  class="text-4xl text-center pt-8"> Le lien de confirmation est invalide</h1>
    </div>



</template>



<style scoped>

</style>
