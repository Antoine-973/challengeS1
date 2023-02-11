<script setup>
import Menu from "../../components/TemplateBO.vue";
import { getReviewById, RefuseReview, ValidateReview, getAllReviews, BanUser, GetUser} from '../../services/adminService';
import { Field } from 'vee-validate';
import {onBeforeMount, onMounted, ref} from 'vue'
import {useRouter} from "vue-router";

const router = useRouter();
let idReview = router.currentRoute.value.params.id;
const review = ref(null);
const rate = ref(null);
const description = ref(null);
let responseStatusRefuse = ref(false);
let responseStatusValidate = ref(false);

let isAlreadyValidate = ref(false);

onBeforeMount(async () => {
    review.value = await getReviewById(idReview);
    rate.value = review.value.rate;
    description.value = review.value.description;

    if(review.value.isValidate){
        isAlreadyValidate.value = true;
    }
})

const RefuseComment = async(id) => {
    const response = RefuseReview(id);

    if(response.status === 200){
        responseStatusRefuse.value = true;
        setTimeout(() => {
            console.log('redirection')
            router.push('/back-office/admin/reviews')
        }, 2000)
    }
}

const ValidateComment = async(id) => {
    const response = await ValidateReview(id);

    if(response.status === 200){
        responseStatusValidate.value = true;
        AutoBan();
        setTimeout(() => {
            router.push('/back-office/admin/reviews')
        }, 2000)
    }
}

const AutoBan = async() => {

    let idTab = [];
    let occurences = {};
    let usersToBan = [];
    const responseGetReviews = await getAllReviews();
    const data = await responseGetReviews.json();
    const allReviews = data['hydra:member'];

    const validateReviews = allReviews.filter(el => el.rate <= 3 && el.isValidate == true);

    validateReviews.map((el) =>{
        idTab.push(el.user.id);
    })

    idTab.forEach(function(elem){
        if(elem in occurences){
            occurences[elem] = ++ occurences[elem];
        }
        else{
            occurences[elem] = 1
        }
    });

    for(let i in occurences){
        if(occurences[i] == 5){
            usersToBan.push(i);
        }
    }


    if(usersToBan.length > 0){
        usersToBan.forEach(function(el){
            CallBanUser(el);
        })
    }

}

const CallBanUser = async (id) =>{

    const user = await GetUser(id);
    const data = await user.json();

    if( typeof(data.isBan) == 'undefined' || data.isBan === false){
        await BanUser(id);
    }

}
</script>

<template>
  <main>
    <div class="flex justify-between">
        <Menu/>

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

            <h1 class="text-xl text-center mt-11">Commentaire pour : {{ review.user.firstname }} {{ review.user.lastname }}</h1>
            <p class="mt-11">Par : {{ review.spaUser.firstname }} {{ review.spaUser.lastname }}</p>
            <div class="flex flex-col">

                <div class="rating mt-20">
                    <input type="radio" name="rating-2" :checked="rate == 1" class="mask mask-star-2 bg-warning" value="1" disabled>
                    <input type="radio" name="rating-2" :checked="rate == 2" class="mask mask-star-2 bg-warning" value="2" disabled>
                    <input type="radio" name="rating-2" :checked="rate == 3" class="mask mask-star-2 bg-warning" value="3" disabled>
                    <input type="radio" name="rating-2" :checked="rate == 4" class="mask mask-star-2 bg-warning" value="4" disabled>
                    <input type="radio" name="rating-2" :checked="rate == 5" class="mask mask-star-2 bg-warning" value="5" disabled>
                </div>


                <Field as="textarea" name="description" class="w-3/4 mt-11 h-40" v-model ="description" disabled/>

                <div class="flex justify-evenly mt-20">
                    <label for="my-modal" class="btn btn-error">Refuser</label>
                    <label for="my-modal2" class="btn btn-success">Valider</label>
                </div>

            </div>
        </div>
    </div>
  </main>
</template>
