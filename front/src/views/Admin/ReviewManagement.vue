<script setup>
import Menu from "../../components/TemplateBO.vue";
import { getReviewById, RefuseReview, ValidateReview, getAllReviews, BanUser, GetUser} from '../../services/adminService';
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
const toBan = ref([]);

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
    const response = await RefuseReview(id);
    
    if(response.status === 200){
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
        AutoBan();
        setTimeout(() => {
            window.location.href = '/backOffice/admin'
        }, 2000)
    }

    console.log(response.status);
}

const AutoBan = async() => {
    // Appeler cette fonction dès qu'une review est acceptée pour recompter les reviews

    // 1 recup toutes les reviews avec le is validate à true et notes sup ou = à 3 DONE
    // 2 compter les reviews qui ont le même id DONE
    // 3 quand on à un user avec 5 reviews on déclenche le traitement DONE
    // 4 traitement = passer le isBan dans user (le créer) à true DONE
    // Avant de bannir l'utilisateur, vérifier qu'il n'est pas déjà ban DONE

    // 5 dans le traitement, récupérer le mail du user en question et lui envoyer un mail
    // 6 Lui bloquer les accès

    let idTab = [];
    let occurences = {};
    let usersToBan = [];
    const responseGetReviews = await getAllReviews();
    const data = await responseGetReviews.json();
    const allReviews = data['hydra:member'];

    const validateReviews = allReviews.filter(el => el.rate <= 3 && el.isValidate == true); // parcourir le tableau

    validateReviews.map((el) =>{
        console.log(el);
        console.log(el.user.id)
        idTab.push(el.user.id);
    }) // On récupère les id utilisateur et on les met dans un tableau

    idTab.forEach(function(elem){
        if(elem in occurences){
            occurences[elem] = ++ occurences[elem];
        }
        else{
            occurences[elem] = 1
        }
    }); // on parcours le tableau d'id pour compter le nombre d'occurence et on les enregistre dans occurences

    for(let i in occurences){
        if(occurences[i] == 5){
            console.log(i);
            console.log(occurences[i]);
            usersToBan.push(i);

            // toBan.value.push(i);
            // console.log(toBan.value);
        }
    } // on parcours occurences et on enregistre l'id utilisateur quand le nb d'occurence est égal à 5
    

    if(usersToBan.length > 0){
        //appel api pour chaque id du tableau

        // banUser(usersToBan);

        usersToBan.forEach(function(el){
            console.log(el);
            CallBanUser(el);
            // const result = ban.json();
            // console.log(result)
        })
    }
    console.log(usersToBan.length);

    console.log(idTab);
    console.log(occurences);
    console.log(usersToBan);

}

const CallBanUser = async (id) =>{
    // id = parseInt(id);
    // console.log(typeof(id));

    const user = await GetUser(id);
    const data = await user.json();
    console.log(data.isBan);
    // data.foreach(function(el){
    //     console.log(el.isBan);
    // })

    // for(let el in data){
    //     console.log(el);
    // }

    console.log(typeof(data.isBan));

    if( typeof(data.isBan) == 'undefined' || data.isBan === false){
        const responseBan = await BanUser(id);
        const donnee = responseBan;
    }

}

// AutoBan();
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