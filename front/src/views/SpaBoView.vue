<script setup>
import { ref } from 'vue'
import {getLikes, patchAcceptLikes, patchRejectLikes} from '../services/likesServices';
import { getUserInfo } from '../services/rateUserService';
import Menu from "../components/TemplateBO.vue";
import jwt_decode from 'jwt-decode';
const data = ref(null);
const filterDataLike = ref(null);
let connectedUserSpaId = ref(null);
let connectedUser;

const getUserConnected = async(id) => {
  const response = await getUserInfo(id);
  const user = await response.json();
  connectedUserSpaId.value = user.spa.id;
  getLike(connectedUserSpaId.value);
}

const getLike = async(id) => {
  const response = await getLikes('is_pending=true');
  const likes = await response.json();
  data.value = likes['hydra:member'];
  filterDataLike.value = data.value.filter(el => el.animalId.spa.id === id);
}

const getConnectedUser = async(id) => {
  const token = localStorage.getItem('token');
  connectedUser = jwt_decode(token);
}

const patchAcceptLike = async(id, user) => {
  const responsePatchLike = await patchAcceptLikes(id, user);
  const likePatch = await responsePatchLike.json();
  window.location.href = "/AllAnimalsLike";
  updateLike(id);
}

const patchRejectLike = async(id, user) => {
  const responseRefuseLike = await patchRejectLikes(id, user);
  const likeRefusePatch = await responseRefuseLike.json();
  window.location.href = "/AllAnimalsLike";
  updateLike(id);
}

const updateLike = (id) => {
  const index = data.value.findIndex((like) => like.id === id);
  data.value[index].isPending = false;
}

getConnectedUser();
getUserConnected(connectedUser.id);

</script>

<template>
  <main>
    <div class="flex justify-between mt-5">
      <Menu></Menu>
      <div class="grow ml-32">
        <h1 class="text-center mb-11 text-lg">Les demandes d'adoption</h1>
        <div class="overflow-x-auto">
          <table class="table w-5/6 mt-12 justify-center">
            <!-- head -->
            <thead>
              <tr>
                <th></th>
                <th>Nom animal</th>
                <th>Date de naissance</th>
                <th>Nom adopteur</th>
                <th>Prénom adopteur</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <template v-for='like in filterDataLike' v-bind:key="like.id">
                <tr v-if="like.isPending">
                  <th></th>
                  <th>{{ like.animalId.name }}</th>
                  <th>{{ new Date(like.animalId.birthday).getDate() + '/' + (new Date(like.animalId.birthday).getMonth() + 1) + '/' + new Date(like.animalId.birthday).getFullYear() }}</th>
                  <th>{{ like.userId.lastname }}</th>
                  <th>{{ like.userId.firstname }}</th>
                  <th class="action-icon">
                    <router-link :to="'likes/' + like.id"><i class="fas fa-eye"></i></router-link>
                    <label :for="'accept' + like.id" class="request-icon"><i class="fas fa-check"></i></label>
                    <label :for="'reject' + like.id" class="request-icon"><i class="fas fa-close"></i></label>
                  </th>
                </tr>

                <!-- Modal accept request -->
                <input type="checkbox" :id="'accept' + like.id" class="modal-toggle" />
                <div class="modal">
                  <div class="modal-box">
                    <h3 class="font-bold text-lg">Êtes-vous sûr de vouloir accepter la demande d'adoption N°{{like.id}} ?</h3>
                    <div class="container-info-request">
                      <div>
                        <p class="py-4">Nom animal : <em>{{ like.animalId.name }}</em></p>
                        <p class="py-4">Date de naissance : <em>{{ new Date(like.animalId.birthday).getDate() + '/' + (new Date(like.animalId.birthday).getMonth() + 1) + '/' + new Date(like.animalId.birthday).getFullYear() }}</em></p>
                      </div>
                      <div>
                        <p class="py-4">Nom adopteur : <em>{{ like.userId.lastname }}</em></p>
                        <p class="py-4">Prénom adopteur : <em>{{ like.userId.firstname }}</em></p>
                      </div>
                    </div>
                      <p class="text-warning"><strong>Cette action est irreversible.</strong></p>
                    <div class="modal-action">
                      <button @click="patchAcceptLike(like.id, like.userId.email)" class="btn">Accepter</button>
                      <label :for="'accept' + like.id" class="btn">Annuler</label>
                    </div>
                  </div>
                </div>

                <!-- Modal reject request -->
                <input type="checkbox" :id="'reject' + like.id" class="modal-toggle" />
                <div class="modal">
                  <div class="modal-box">
                    <h3 class="font-bold text-lg">Êtes-vous sûr de vouloir refuser la demande d'adoption N°{{like.id}} ?</h3>
                    <div class="container-info-request">
                      <div>
                        <p class="py-4">Nom animal : <em>{{ like.animalId.name }}</em></p>
                        <p class="py-4">Date de naissance : <em>{{ new Date(like.animalId.birthday).getDate() + '/' + (new Date(like.animalId.birthday).getMonth() + 1) + '/' + new Date(like.animalId.birthday).getFullYear() }}</em></p>
                      </div>
                      <div>
                        <p class="py-4">Nom adopteur : <em>{{ like.userId.lastname }}</em></p>
                        <p class="py-4">Prénom adopteur : <em>{{ like.userId.firstname }}</em></p>
                      </div>
                    </div>
                      <p class="text-warning"><strong>Cette action est irreversible.</strong></p>
                    <div class="modal-action">
                      <button @click="patchRejectLike(like.id, like.userId.email)" class="btn">Refuser</button>
                      <label :for="'reject' + like.id" class="btn">Annuler</label>
                    </div>
                  </div>
                </div>

              </template>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped>
.action-icon {
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.request-icon {
  cursor: pointer;
}

.container-info-request {
  margin-top: 5%;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10%;
}
.text-warning {
  color: #f6b93b;
  font-weight: bold;
  text-align: center;
  margin-top: 5%;
}

</style>