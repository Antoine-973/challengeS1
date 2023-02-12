<script setup>

import {storeToRefs} from "pinia";
import {useAuthStore} from "../../stores/auth.store";

const props = defineProps({
    author: {
        type: Object,
        required: true
    },
    message: {
        type:Object,
        required: true
    }
})
const authStore = useAuthStore();
const {user} = storeToRefs(authStore);



</script>

<template>
    <Suspense>
        <div :class=" user.id === author.id ? 'chat chat-end' : 'chat chat-start' " >
            <div class="chat-header">
                {{author.firstname }}   {{author.lastname }}
            </div>
            <div class="chat-bubble">{{message.text}}</div>

        </div>
    </Suspense>
</template>
