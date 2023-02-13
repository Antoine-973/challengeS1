<script setup>
import {onMounted, ref} from 'vue'
import Menu from "../components/TemplateBO.vue";
import {useAuthStore} from "../stores/auth.store";
import {storeToRefs} from "pinia";
import LikeService from "../services/LikeService";
import {createConversation} from "../services/conversationService";
const data = ref(null);
const authStore = useAuthStore();
const { user } = storeToRefs(authStore);
const likes = ref(null);

const getLike = async(id) => {
  const response = await LikeService().getLikes('is_pending=true');
  likes.value = await response.json();
}

onMounted(async () => {
    if (user.value.roles.includes('ROLE_ADMIN')) {
        likes.value = await LikeService().getLikes('is_pending=true');
    } else {
        const likesData = await getLike(user.value.spa.id);
        likes.value = likesData.value.filter(el => el.animal.spa.id === id);
    }
})

const patchAcceptLike = async(id, user) => {
  const responsePatchLike = await LikeService().patchAcceptLikes(id, user.email);
  const likePatch = await responsePatchLike.json();
  await createConversation({
      adoptionRequest:id,
      adopter:user.id
  }) ;
  window.location.href = "/back-office/likes";
  updateLike(id);
}

const patchRejectLike = async(id, user) => {
  const responseRefuseLike = await LikeService().patchRejectLikes(id, user);
  const likeRefusePatch = await responseRefuseLike.json();
  window.location.href = "/back-office/likes";
  updateLike(id);
}

const updateLike = (id) => {
  const index = data.value.findIndex((like) => like.id === id);
  data.value[index].isPending = false;
}
</script>

<template>
  <main>
    <div class="flex justify-between mt-5">
      <Menu/>
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
              <template v-for='like in likes' v-bind:key="like.id">
                <tr v-if="like.isPending">
                  <th></th>
                  <th>{{ like.animal.name }}</th>
                  <th>{{ new Date(like.animal.birthday).getDate() + '/' + (new Date(like.animal.birthday).getMonth() + 1) + '/' + new Date(like.animal.birthday).getFullYear() }}</th>
                  <th>{{ like.user.lastname }}</th>
                  <th>{{ like.user.firstname }}</th>
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
                        <p class="py-4">Nom animal : <em>{{ like.animal.name }}</em></p>
                        <p class="py-4">Date de naissance : <em>{{ new Date(like.animal.birthday).getDate() + '/' + (new Date(like.animal.birthday).getMonth() + 1) + '/' + new Date(like.animal.birthday).getFullYear() }}</em></p>
                      </div>
                      <div>
                        <p class="py-4">Nom adopteur : <em>{{ like.user.lastname }}</em></p>
                        <p class="py-4">Prénom adopteur : <em>{{ like.user.firstname }}</em></p>
                      </div>
                    </div>
                      <p class="text-warning"><strong>Cette action est irreversible.</strong></p>
                    <div class="modal-action">
                      <button @click="patchAcceptLike(like.id, like.user)" class="btn">Accepter</button>
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
                        <p class="py-4">Nom animal : <em>{{ like.animal.name }}</em></p>
                        <p class="py-4">Date de naissance : <em>{{ new Date(like.animal.birthday).getDate() + '/' + (new Date(like.animal.birthday).getMonth() + 1) + '/' + new Date(like.animal.birthday).getFullYear() }}</em></p>
                      </div>
                      <div>
                        <p class="py-4">Nom adopteur : <em>{{ like.user.lastname }}</em></p>
                        <p class="py-4">Prénom adopteur : <em>{{ like.user.firstname }}</em></p>
                      </div>
                    </div>
                      <p class="text-warning"><strong>Cette action est irreversible.</strong></p>
                    <div class="modal-action">
                      <button @click="patchRejectLike(like.id, like.user.email)" class="btn">Refuser</button>
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
