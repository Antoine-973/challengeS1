<script setup>
import Menu from "../../../components/TemplateBO.vue";
import {useAuthStore} from "../../../stores/auth.store";
import {storeToRefs} from "pinia";
import {useRouter} from "vue-router";
import {onBeforeMount,ref} from "vue";
import {getConversations} from "../../../services/conversationService";

const router = useRouter() ;

const authStore = useAuthStore();
const { user } = storeToRefs(authStore);

const conversations = ref(null) ;
onBeforeMount(async () => {
    conversations.value = await getConversations() ;

}) ;

</script>

<template>
    <main>
        <div class="flex justify-between mt-5">
            <Menu/>

            <div class="grow ">
                <h1 class="text-center mb-11 text-lg">Liste des conversations</h1>

                <div class="overflow-x-auto">
                    <ul class="menu bg-base-100 w-58">
                        <template v-if="user.roles.includes('ROLE_ADMIN')">
                            <template v-for="conversation in conversations">
                                <li>
                                    <router-link :to="'/back-office/conversations/'+conversation.id">
                                        Discuter avec  {{conversation.adopter.firstname}} {{conversation.adopter.lastname}}  pour l'adoption de {{conversation.adoptionRequest.animal.name}}
                                    </router-link>

                                </li>
                            </template>
                        </template>
                        <template v-else>
                            <template v-for="conversation in conversations">
                                <li v-if="conversation.adoptionRequest.animal.spa.id === user.spa.id">
                                    <router-link :to="'/back-office/conversations/'+conversation.id">
                                        Discuter avec  {{conversation.adopter.firstname}} {{conversation.adopter.lastname}}  pour l'adoption de {{conversation.adoptionRequest.animal.name}}
                                    </router-link>
                                </li>
                            </template>
                        </template>
                    </ul>

                </div>
            </div>
        </div>
    </main>
</template>

