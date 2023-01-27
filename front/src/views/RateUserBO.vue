<script setup>
    import Menu from "../components/TemplateBO.vue";
    import { Field, Form } from 'vee-validate';
    import { ref, reactive } from 'vue'
    import {getUserToRate} from '../services/rateUserService';

    const dataUser = ref(null)

    let idUser = (new URL(window.location)).pathname.split('/')[3];

    const formData = reactive({
        message: '',
        stars: '',
    });

    // fetch("https://localhost/users/" + idUser, {

    // }).then(response => {
    //     if(response.ok) {
    //         return response.json();
    //     }
    //     return Promise.reject(new Error("Erreur: impossible de récupérer les informations de l'utilisateur :("));
    // }).then((datas) => {
    //     dataUser.value = datas;
    //     // console.log(datas)
    //     return datas;
    // }).catch(function(error) {
    //     console.log(error.message);
    // });

    const onSubmit = () => {
        console.log("message: " + formData.message);
        console.log("note: " + formData.stars);
        console.log("id user: " + idUser);

        //Ici rajouter appel API et envoyer les données en BDD
        //Récupérer l'id du user connecté et l'id SPA
    }

    const getUser = async() => {
        const responseGetUser = await getUserToRate(idUser);
        const user = await responseGetUser.json();
        dataUser.value = user;
        // console.log(dataUser.value);
    }

    getUser();
    
    
</script>

<template>
  <main>
     <div class="flex justify-between">
        <Menu></Menu>

        <div class="grow ml-32">
            
            <h1 class="text-xl text-center mt-11" v-if="dataUser != null">Noter l'utilisateur : {{ dataUser.firstname }} {{ dataUser.lastname }}</h1>
            
            <div class="flex flex-col">

                <Form @submit="onSubmit" class="flex flex-col w-full">
                    <div class="rating mt-28">
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-warning" value="1" v-model="formData.stars"> 
                        <input type="radio" name="rating-2" checked="checked" class="mask mask-star-2 bg-warning" value="2" v-model="formData.stars"> 
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-warning" v-model="formData.stars" value="3"> 
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-warning" v-model="formData.stars" value="4"> 
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-warning" v-model="formData.stars" value="5">
                    </div>

                    <Field as="textarea" name="description" class="w-3/4 mt-11 h-40" v-model="formData.message"/>

                    <button class="btn btn-primary w-24 mt-16" type="submit">Envoyer</button>
                </Form>

                <!-- <p>message : {{ formData.message }}</p>
                <p>Nombre d'étoiles: {{ formData.stars }}</p> -->

                
            </div>
        </div>
     </div>
  </main>
</template>
