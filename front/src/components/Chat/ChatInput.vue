<script setup>
import {defineProps, ref} from "vue";
const props = defineProps({
    onSubmit : {
        type:Function,
        required: true
    }
});
const message = ref() ;
const handleSubmit = async () => {
    await props.onSubmit(message.value) ;
    message.value="" ;
}
</script>

<template>
    <div class='grid grid-cols-12 grid-rows-1 ' >
        <div class="col-span-11 w-full">
            <input  v-model="message" class="rounded-none input input-bordered w-full" autofocus type="text" placeholder="Mon message" />
        </div>
        <div class="col-span-1 w-full">
            <button class="rounded-none btn w-full" @click="handleSubmit" >
                Envoyer
            </button>
        </div>
    </div>
</template>
