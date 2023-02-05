<script setup>
    import Menu from "../components/TemplateBO.vue";
    import { ref } from 'vue'
    import {getAcceptedLikesUsers} from '../services/reviewUserService';
    import jwt_decode from 'jwt-decode';
    import { getUserInfo } from '../services/rateUserService';

    const data = ref(null)
    const filterData = ref(null);
    let connectedUser;
    let connectedUserSpaId = ref(null);

    const getUserList = async(id) => {
        const responseGetList = await getAcceptedLikesUsers();
        const user = await responseGetList.json();
        data.value = user['hydra:member'];

        filterData.value = data.value.filter(el => el.animalId.spa.id === id);
    }

    const getConnectedUser = async() => {
        const token = localStorage.getItem("token");
        connectedUser = jwt_decode(token)
    }

    const getInfoConnectedUser = async(id) => {
        const info = await getUserInfo(id);
        const response = await info.json();
        connectedUserSpaId.value = response.spa.id;
        getUserList(connectedUserSpaId.value);
    }

    getConnectedUser();
    getInfoConnectedUser(connectedUser.id);
    
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
                        <tr v-for="user in filterData">
                            <th>1</th>
                            <td>{{ user.userId.lastname }}</td>
                            <td>{{ user.userId.firstname }}</td>
                            <td><a :href="'/backOffice/review/' + user.userId.id"><i class="fas fa-pen"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
     </div>
  </main>
</template>
