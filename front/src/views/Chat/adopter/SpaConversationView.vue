<script setup>
import Menu from "../../../components/TemplateBO.vue";
import Message from '../../../components/Chat/Message.vue' ;
import ChatInput from '../../../components/Chat/ChatInput.vue' ;

import {useRouter} from "vue-router";
import {onBeforeMount, ref} from "vue";
import {getConversation} from "../../../services/conversationService";
import {createMessage} from "../../../services/messageService";

const router = useRouter();
const idUrl = router.currentRoute.value.params.id;
const conversation = ref(null) ;

onBeforeMount(async () => {
    conversation.value = await getConversation( {id:idUrl}) ;
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
    <main>
        <div class="flex justify-between mt-5">
            <Menu/>

            <div class="grow">
                <div class="text-center mb-5 ">
                    <h1 class="text-center  text-lg">Discussion pour l'adoption de {{conversation.adoptionRequest.animal.name}}</h1>
                    <button @click="router.push('/back-office/reviews/' + conversation.adopter.id )" class="btn btn-ghost hover:bg-transparent link-hover text-primary " > Signaler l'utilisateur </button>
                </div>

                <div class="overflow-x-auto">
                    <template v-if="conversation && conversation.messages.length > 0">
                        <Message v-for="message in conversation.messages"
                                 :message="message"
                                 :author="message.author"
                        />
                    </template>
                    <ChatInput :on-submit="sendMessage"  style="position: fixed; bottom: 0"  />

                </div>
            </div>
        </div>
    </main>
</template>

