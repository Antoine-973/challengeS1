<script setup>
    import Menu from "../components/TemplateBO.vue";
    import { ref } from 'vue'
    import {getAcceptedLikesUsers} from '../services/reviewUserService';

    const data = ref(null)


       
    // fetch("https://localhost/likes/getAcceptedLikes", {

    // }).then(response => {
    //     if(response.ok) {
    //         return response.json();
    //     }
    //     return Promise.reject(new Error("Erreur: impossible de récupérer la liste des utilisateurs :("));
    // }).then((datas) => {
    //     // console.log(datas['hydra:member']);
    //     data.value = datas['hydra:member'];
    //     // console.log(data.value[0].userId.firstname);
    //     return datas;
    // }).catch(function(error) {
    //     console.log(error.message);
    // });

    const getUserList = async() => {
        const responseGetList = await getAcceptedLikesUsers();
        const user = await responseGetList.json();
        data.value = user['hydra:member'];
    }

    getUserList();
    
</script>

<template>
  <main>
     <div class="flex justify-between mt-5">
        <Menu></Menu>

        <div class="grow ml-32">
            <h1 class="text-center mb-11 text-lg">Notation des utilisateurs</h1>

            <div class="overflow-x-auto">
                <table class="table w-5/6 mt-12 justify-center">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Noter l'utilisateur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in data">
                            <th>1</th>
                            <td>{{ user.userId.lastname }}</td>
                            <td>{{ user.userId.firstname }}</td>
                            <td><a :href="'/backOffice/review/' + user.userId.id"><i class="fa-regular fa-pen"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
     </div>
  </main>
</template>
