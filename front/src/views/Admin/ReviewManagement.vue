<script setup>
import Menu from "../../components/TemplateBO.vue";
import { getReviewById, DeleteReview, ValidateReview } from '../../services/adminService';
import { Field } from 'vee-validate';
import { ref } from 'vue'

let idReview = (new URL(window.location)).pathname.split('/')[4];
const review = ref(null);
const rate = ref(null);
const description = ref(null);
const userRatedInfo = ref(null);
const userWhoRate = ref(null);
let responseStatusRefuse = ref(false);
let responseStatusValidate = ref(false);

let isAlreadyValidate = ref(false);

const getReview = async(id) => {
    const response = await getReviewById(id);
    const data = await response.json();
    review.value = data;
    rate.value = review.value.rate;
    description.value = review.value.description;
    userRatedInfo.value = review.value.user;
    userWhoRate.value = review.value.spaUser;

    if(review.value.isValidate){
        isAlreadyValidate.value = true;
    }

}

const RefuseComment = async(id) => {
    const response = await DeleteReview(id);
    
    if(response.status === 204){
        responseStatusRefuse.value = true;
        setTimeout(() => {
            window.location.href = '/backOffice/admin'
        }, 2000)
    }

    console.log(response.status);
}

const ValidateComment = async(id) => {
    const response = await ValidateReview(id);
    
    if(response.status === 200){
        responseStatusValidate.value = true;
        setTimeout(() => {
            window.location.href = '/backOffice/admin'
        }, 2000)
    }

    console.log(response.status);
}

getReview(idReview);

</script>

<template>
  <main>
    <div class="flex justify-between">
        <Menu></Menu>

        <div class="grow ml-32">

            <input type="checkbox" id="my-modal" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Êtes-vous sûr de vouloir refuser le commentaire ?</h3>
                    <p class="py-4">Cette action est irréversible.</p>
                    <div class="modal-action">
                        <label for="my-modal" class="btn">Annuler</label>
                        <button className="btn btn-error" v-on:click.stop="RefuseComment(idReview)">Refuser</button>
                    </div>
                </div>
            </div>

            <input type="checkbox" id="my-modal2" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Êtes-vous sûr de vouloir valider le commentaire ?</h3>
                    <p class="py-4">Cette action est irréversible.</p>
                    <div class="modal-action">
                        <label for="my-modal2" class="btn">Annuler</label>
                        <button className="btn btn-success" v-on:click.stop="ValidateComment(idReview)">Valider</button>
                    </div>
                </div>
            </div>

            <div class="alert alert-success shadow-lg" v-if="responseStatusRefuse">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>Le commentaire à bien été refusé !</span>
                </div>
            </div>

            <div class="alert alert-success shadow-lg" v-if="responseStatusValidate">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>Le commentaire à bien été validé !</span>
                </div>
            </div>

            <h1 class="text-xl text-center mt-11" v-if="userRatedInfo">Commentaire pour : {{ userRatedInfo.firstname }} {{ userRatedInfo.lastname }}</h1>
            <p class="mt-11" v-if="userWhoRate">Par : {{ userWhoRate.firstname }} {{ userWhoRate.lastname }}</p>
            <div class="flex flex-col">

                <div class="rating mt-20">
                    <input type="radio" name="rating-2" :checked="rate == 1" class="mask mask-star-2 bg-warning" value="1" disabled> 
                    <input type="radio" name="rating-2" :checked="rate == 2" class="mask mask-star-2 bg-warning" value="2" disabled> 
                    <input type="radio" name="rating-2" :checked="rate == 3" class="mask mask-star-2 bg-warning" value="3" disabled> 
                    <input type="radio" name="rating-2" :checked="rate == 4" class="mask mask-star-2 bg-warning" value="4" disabled> 
                    <input type="radio" name="rating-2" :checked="rate == 5" class="mask mask-star-2 bg-warning" value="5" disabled>
                </div>

                
                <Field as="textarea" name="description" class="w-3/4 mt-11 h-40" v-model = "description" disabled/>
                
                <div class="flex justify-evenly mt-20">
                    <label for="my-modal" class="btn btn-error">Refuser</label>
                    <label for="my-modal2" class="btn btn-success">Valider</label>
                </div>

            </div>
        </div>
    </div>
  </main>
</template>