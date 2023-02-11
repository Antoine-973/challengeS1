<script setup>
import {onBeforeMount, ref} from 'vue'
import LikeService from "../services/LikeService";
import Menu from "../components/TemplateBO.vue";
import {useRouter} from "vue-router";

const like = ref(null)
const router = useRouter();
const idUrl = router.currentRoute.value.params.id;

onBeforeMount(async () => {
  like.value = await LikeService().getLike(idUrl);
})

const acceptLike = async(id) => {
  const responsePatchLike = await LikeService().patchAcceptLikes(id);
  const likePatch = await responsePatchLike.json();
  redirectToAllAnimalsLike();
}

const rejectLike = async(id) => {
  const responseRefuseLike = await LikeService().patchRejectLikes(id);
  const likeRefusePatch = await responseRefuseLike.json();
  redirectToAllAnimalsLike();
}

const redirectToAllAnimalsLike = () => {
    router.push('/back-office/likes');
}
</script>

<template>
  <main>
    <div class="flex justify-between mt-5">
      <Menu/>
      <div class="grow ml-32">
        <router-link to="/back-office/likes"><i class="fas fa-arrow-left"></i> Retour à la liste des demandes</router-link>
        <h1 class="text-center mb-11 text-lg">Récapitulatif de la demande d'adoption N°{{ like.id }}</h1>
        <div class="overflow-x-auto">
          <div class="container-info">
            <div class="card card-side bg-base-100 shadow-xl">
              <!-- <figure><img v-bind:src="`${like.animal.animalPictures}`" alt="animal"/></figure> -->
              <figure><img src="https://www.veterinaire-lecres.com/Uploads/conseils/Canitie.jpg" alt="animal"/></figure>
              <div class="card-body">
                <h2 class="card-title">{{ like.animal.name }}</h2>
                <p>{{ new Date(like.animal.birthday).getDate() + '/' + (new Date(like.animal.birthday).getMonth() + 1) + '/' + new Date(like.animal.birthday).getFullYear() }}</p>
                <p>{{ new Date().getFullYear() - new Date(like.animal.birthday).getFullYear() + ' ans'}}</p>
                <p><strong>Ville de naissance :</strong> {{ like.animal.birthLocation }}</p>
                <p>{{ like.animal.description }}</p>
              </div>
            </div>

            <div class="card lg:card-side bg-base-100 shadow-xl">
              <figure><img src="https://st2.depositphotos.com/1662991/8837/i/450/depositphotos_88370500-stock-photo-mechanic-wearing-overalls.jpg" alt="adopteur"/></figure>
              <div class="card-body">
                <h2 class="card-title">{{ like.user.lastname }} {{ like.user.firstname }}</h2>
                <p> {{ like.user.city }}</p>
                <p>{{ like.user.description }}</p>
              </div>
            </div>
          </div>

          <div class="container-button">
            <label :for="'accept' + like.id" class="btn btn-primary">Accepter la demande</label>
            <label :for="'reject' + like.id" class="btn btn-accent">Refuser la demande</label>
          </div>

          <!-- Modal accept request -->
          <input type="checkbox" :id="'accept' + like.id" class="modal-toggle" />
          <div class="modal">
            <div class="modal-box">
              <h3 class="font-bold text-lg">Êtes-vous sûr de vouloir accepter cette demande d'adoption ?</h3>
                <p class="text-warning"><strong>Cette action est irreversible.</strong></p>
              <div class="modal-action">
                <button @click="acceptLike(like.id)" class="btn">Accepter</button>
                <label :for="'accept' + like.id" class="btn">Annuler</label>
              </div>
            </div>
          </div>

        <!-- Modal reject request -->
          <input type="checkbox" :id="'reject' + like.id" class="modal-toggle" />
          <div class="modal">
            <div class="modal-box">
              <h3 class="font-bold text-lg">Êtes-vous sûr de vouloir refuser cette demande d'adoption ?</h3>
                <p class="text-warning"><strong>Cette action est irreversible.</strong></p>
              <div class="modal-action">
                <button @click="rejectLike(like.id)" class="btn btn-primary">Refuser</button>
                <label :for="'reject' + like.id" class="btn">Annuler</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
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
  max-height: 160%;
  min-height: 100%;
}

.container-info {
  margin-top: 5%;
  display: flex;
  justify-content: space-between;
  gap: 20px;
}

.container-button {
  width: 50%;
  display: flex;
  justify-content: space-around;
  margin-top: 5%;
  margin-left: 25%;
}

.text-warning {
  text-align: center;
  margin-top: 5%;
}



</style>
