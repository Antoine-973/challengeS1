<script setup>

import Message from '../../components/Chat/Message.vue' ;
import ChatInput from '../../components/Chat/ChatInput.vue' ;

import {useRouter} from "vue-router";
import {onBeforeMount, onUpdated, ref} from "vue";
import {getConversation} from "../../services/conversationService";
import {createMessage} from "../../services/messageService";

const router = useRouter();
const idUrl = router.currentRoute.value.params.id;
const conversation = ref(null) ;

onBeforeMount(async () => {
    conversation.value = await getConversation( {id:idUrl}) ;
    console.log(conversation.value) ;
}) ;


const sendMessage = async (message) => {

    await createMessage({
        text:message,
        author: conversation.value.adopter.id,
        conversation: idUrl
    }) ;

};
</script>

<template>
    <template v-if="conversation && conversation.messages.length > 0">
        <h1>Discussion pour l'adoption de : {{conversation.adoptionRequest.animal.name}}</h1>
        <Message v-for="message in conversation.messages"
                 :message="message"
                 :author="message.author"
        />
    </template>
    <ChatInput :on-submit="sendMessage"  style="position: fixed; bottom: 0"  />
</template>
