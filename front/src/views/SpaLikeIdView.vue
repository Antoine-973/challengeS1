<script setup>
import { ref } from 'vue'
import {getLikesId, patchAcceptLikes, patchRejectLikes} from '../services/likesServices';
const data = ref(null)

let idUrl = (new URL(window.location)).pathname.split('/')[2];

const getLikeId = async(id) => {
  const responseGetLikeId = await getLikesId(id);
  const likeGetId = await responseGetLikeId.json();
  data.value = likeGetId;
  console.log(data.value);
}

const accpetLike = async(id) => {
  const responsePatchLike = await patchAcceptLikes(id);
  const likePatch = await responsePatchLike.json();
  // data.value = likePatch['hydra:member'];
  // console.log("testestesPAtch");
  console.log(likePatch);
  redirectToAllAnimalsLike();
}

const rejectLike = async(id) => {
  const responseRefuseLike = await patchRejectLikes(id);
  const likeRefusePatch = await responseRefuseLike.json();
  // data.value = likePatch['hydra:member'];
  // console.log("testestesPAtch");
  console.log(likeRefusePatch);
  redirectToAllAnimalsLike();
}

const redirectToAllAnimalsLike = () => {
  window.location.href = "/AllAnimalsLike";
}

getLikeId(idUrl);

</script>

<template>
  <router-link to="/AllAnimalsLike"><i class="fas fa-arrow-left"></i> Retour à la liste des demandes</router-link>
  <h1>Récapitulatif de la demande d'adoption N°{{ data.id }}</h1>
  <div class="container-info">
    <div class="card lg:card-side bg-base-100 shadow-xl">
      <!-- <figure><img v-bind:src="`${data.animalId.animalPictures}`" alt="animal"/></figure> -->
      <figure><img src="https://www.veterinaire-lecres.com/Uploads/conseils/Canitie.jpg" alt="animal"/></figure>
      <div class="card-body">
        <h2 class="card-title">{{ data.animalId.name }}</h2>
        <p>{{ new Date(data.animalId.birthday).getDate() + '/' + (new Date(data.animalId.birthday).getMonth() + 1) + '/' + new Date(data.animalId.birthday).getFullYear() }}</p>
        <p>{{ new Date().getFullYear() - new Date(data.animalId.birthday).getFullYear() + ' ans'}}</p>
        <!-- new Date().getDate() -  new Date(data.animalId.birthday).getDate() + '/' + new Date().getDate() - (new Date(data.animalId.birthday).getMonth() + 1) + '/' + new Date().getDate() - new Date(data.animalId.birthday).getFullYear() -->
        <p><strong>Ville de naissance :</strong> {{ data.animalId.birthLocation }}</p>
        <p>{{ data.animalId.description }}</p>
      </div>
    </div>

    <div class="card lg:card-side bg-base-100 shadow-xl">
      <!-- <figure><img v-bind:src="`${data.userId.picture}`" alt="adopteur"/></figure> -->
      <figure><img src="https://st2.depositphotos.com/1662991/8837/i/450/depositphotos_88370500-stock-photo-mechanic-wearing-overalls.jpg" alt="adopteur"/></figure>
      <div class="card-body">
        <h2 class="card-title">{{ data.userId.lastname }} {{ data.userId.firstname }}</h2>
        <p> {{ data.userId.city }}</p>
        <p>{{ data.userId.description }}</p>
      </div>
    </div>
  </div>

  <div class="container-button">
    <button @click="accpetLike(data.id)" class="btn btn-accent">Accepter la demande</button>
    <button @click="rejectLike(data.id)" class="btn btn-primary">Refuser la demande</button>
  </div>
</template>

<style scoped>

.fa-arrow-left {
  margin-left: 2%;
  margin-top: 2%;
}
h1 {
  text-align: center;
  margin-top: 2%;
  font-size: 20px;
  margin-bottom: 5%;
}

img {
  width: 100%;
}

.container-info {
  margin-top: 5%;
  display: flex;
  justify-content: space-between;
}

.container-button {
  width: 50%;
  display: flex;
  justify-content: space-around;
  margin-top: 5%;
  margin-left: 25%;
}



</style>

<!-- <div class="container-info">
    <div>
      <h2>Information sur l'animal</h2>
      <img v-bind:src="`${data.animal_id.picture}`"/>
      <p><strong>Nom :</strong> {{ data.animal_id.name }}</p>
      <p><strong>Date de naissance :</strong> {{ data.animal_id.birthday }}</p>
      <p><strong>Ville de naissance :</strong> {{ data.animal_id.birthLocation }}</p>
      <p><strong>Description :</strong> {{ data.animal_id.description }}</p>
    </div>
    <div>
      <h2>Information sur le demandeur</h2>
      <img v-bind:src="`${data.user_id.picture}`"/>
      <p><strong>Nom :</strong> {{ data.user_id.lastname }}</p>
      <p><strong>Prénom :</strong> {{ data.user_id.firstname }}</p>
      <p><strong>Description :</strong> {{ data.user_id.description }}</p>
      <p><strong>Ville :</strong> {{ data.user_id.city }}</p>
    </div>
  </div> -->