<script setup>
import Menu from "../components/TemplateBO.vue";
import {defineRule, Field, Form} from 'vee-validate';
import {onBeforeMount, reactive, ref} from 'vue'
import {getUserInfo, rateUser} from '../services/rateUserService';
import {useRouter} from "vue-router";
import {useAuthStore} from "../stores/auth.store";
import {storeToRefs} from "pinia";

    const dataUser = ref(null)
    const router = useRouter();
    const idUser = router.currentRoute.value.params.id;
    const authStore = useAuthStore();
    const {user} = storeToRefs(authStore);
    const apiResponseStatus = ref(false);

    const formData = reactive({
        message: '',
        stars: '1',
    });

    const getUser = async() => {
        const responseGetUser = await getUserInfo(idUser);
        dataUser.value = await responseGetUser.json();
    }

    const onSubmit = async() => {
        let rate = parseInt(formData.stars);
        const response = await rateUser(idUser, rate, formData.message, user.value.id, user.value.spa.id);
        if(response.status === 201){
            apiResponseStatus.value = true;
            setTimeout(() => {
                router.push('/back-office/reviews')
            }, 2000)
        }
    }

    defineRule('required', value => {
        if (!value || !value.length) {
            return 'This field is required';
        }
        return true;
    });

    onBeforeMount(() => {
        getUser();
    })
</script>

<template>
  <main>
     <div class="flex justify-between">
        <Menu/>

        <div class="grow ml-32">

            <div class="alert alert-success shadow-lg" v-if="apiResponseStatus">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>La note à bien été enregistrée !</span>
                </div>
            </div>

            <h1 class="text-xl text-center mt-11" v-if="dataUser != null">Noter l'utilisateur : {{ dataUser.firstname }} {{ dataUser.lastname }}</h1>

            <div class="flex flex-col">

                <Form @submit="onSubmit" class="flex flex-col w-full">
                    <div class="rating mt-28">
                        <input type="radio" name="rating-2" checked="checked" class="mask mask-star-2 bg-warning" value="1" v-model="formData.stars">
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-warning" value="2" v-model="formData.stars">
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-warning" v-model="formData.stars" value="3">
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-warning" v-model="formData.stars" value="4">
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-warning" v-model="formData.stars" value="5">
                    </div>


                    <Field as="textarea" name="description" class="w-3/4 mt-11 h-40" rules="required" v-model="formData.message"/>


                    <input type="checkbox" id="my-modal" class="modal-toggle" />
                    <div class="modal">
                        <div class="modal-box">
                            <h3 class="font-bold text-lg">Êtes-vous sûr de vouloir envoyer ce commentaire ?</h3>
                            <p class="py-4">Cette action est irréversible.</p>
                            <div class="modal-action">
                                <label for="my-modal" class="btn">Annuler</label>
                                <button class="btn btn-success" type="submit">Envoyer</button>
                            </div>
                        </div>
                    </div>

                    <label for="my-modal" class="btn btn-primary w-24 mt-16">Envoyer</label>
                </Form>

            </div>
        </div>
     </div>
  </main>
</template>
