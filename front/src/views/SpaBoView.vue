<script setup>
import { ref } from 'vue'
// import { RouterLink } from 'vue-router'
// import TemplateBO from '../components/TemplateBO.vue';
import {getLikes, patchAcceptLikes, patchRejectLikes} from '../services/likesServices';
const data = ref(null)

const getLike = async() => {
  const response = await getLikes('is_pending=true');
  const likes = await response.json();
  data.value = likes['hydra:member'];
  console.log(data.value);
}

const patchAccpetLike = async(id) => {
  const responsePatchLike = await patchAcceptLikes(id);
  const likePatch = await responsePatchLike.json();
  // data.value = likePatch['hydra:member'];
  // console.log("testestesPAtch");
  console.log(likePatch);
  updateLike(id);
}

const patchRejectLike = async(id) => {
  const responseRefuseLike = await patchRejectLikes(id);
  const likeRefusePatch = await responseRefuseLike.json();
  // data.value = likePatch['hydra:member'];
  console.log(likeRefusePatch);
  updateLike(id);
}

const updateLike = (id) => {
  const index = data.value.findIndex((like) => like.id === id);
  data.value[index].isPending = false;
}

getLike();
</script>

<template>
  <h1>Les demandes d'adoption</h1>

  <!-- <TemplateBO /> -->

  <div class="overflow-x-auto">
    <table class="table w-full">
      <!-- head -->
      <thead>
        <tr>
          <th></th>
          <th>Nom animal</th>
          <th>Age animal</th>
          <th>Nom adopteur</th>
          <th>Prénom adopteur</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <template v-for='like in data' v-bind:key="like.id">
          <tr v-if="like.isPending">
            <th></th>
            <th>{{ like.animalId.name }}</th>
            <th>{{ new Date(like.animalId.birthday).getDate() + '/' + (new Date(like.animalId.birthday).getMonth() + 1) + '/' + new Date(like.animalId.birthday).getFullYear() }}</th>
            <th>{{ like.userId.lastname }}</th>
            <th>{{ like.userId.firstname }}</th>
            <th class="action-icon">
              <router-link :to="'likes/' + like.id"><i class="fas fa-eye"></i></router-link>
              <button @click="patchAccpetLike(like.id)"><i class="fas fa-check"></i></button>
              <button @click="patchRejectLike(like.id)"><i class="fas fa-close"></i></button>
            </th>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<style scoped>

h1 {
  text-align: center;
  margin-top: 2%;
  font-size: 20px;
  margin-bottom: 5%;
}
.action-icon {
  display: flex;
  justify-content: space-around;
  align-items: center;
}
</style>