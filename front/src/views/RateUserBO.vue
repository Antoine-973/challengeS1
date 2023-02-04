<script setup>
    import Menu from "../components/TemplateBO.vue";
    import { Field, Form, defineRule } from 'vee-validate';
    import { ref, reactive } from 'vue'
    import {getUserInfo, rateUser} from '../services/rateUserService';
    import jwt_decode from 'jwt-decode';

    const dataUser = ref(null)
    

    let idUser = (new URL(window.location)).pathname.split('/')[3];
    let connectedUser;
    let connectedUserSpaId;
    let apiResponseStatus = ref(false);

    const formData = reactive({
        message: '',
        stars: '1',
    });

    const getConnectedUser = async() => {
        const token = localStorage.getItem("token");
        connectedUser = jwt_decode(token)
    }
    

    const getUser = async() => {
        const responseGetUser = await getUserInfo(idUser);
        const user = await responseGetUser.json();
        dataUser.value = user;
    }

    
    const getInfoConnectedUser = async(id) => {
        const info = await getUserInfo(id);
        const response = await info.json();
        connectedUserSpaId = response.spa.id;
    }

    getUser();
    getConnectedUser();
    getInfoConnectedUser(connectedUser.id);


    const onSubmit = async() => {
        let rate = parseInt(formData.stars);
        const responseSubmit = await rateUser(idUser, rate, formData.message, connectedUser.id, connectedUserSpaId);
        if(responseSubmit.status === 201){
            apiResponseStatus.value = true;
        }
    }

    defineRule('required', value => {
        if (!value || !value.length) {
            return 'This field is required';
        }
        return true;
    }); 

    
</script>

<template>
  <main>
     <div class="flex justify-between">
        <Menu></Menu>

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
                       


                    <button class="btn btn-primary w-24 mt-16" type="submit">Envoyer</button> 
                </Form>

            </div>
        </div>
     </div>
  </main>
</template>
