<script setup>
import {computed, reactive, ref} from "vue";
import calculateAge from "../../helper/calculateAge";

    const animalsData = [
        {
            id: 1,
            name : "Socrate",
            dateOfBirth : new Date(2021, 6, 1),
            birthLocation : "La Street",
            isSterilize : true,
            disease : null,
            description : "MIAAAAAAAAAAAAAAAOU",
            spa : {
                name : "SPA de la rue de la paix",
                address : "12 rue de la paix",
                city : "Paris",
                postalCode : "75000",
                phone : "01 23 45 67 89",
                email : "spa75000@spa.fr",
            },
            breed : {
                id : 1,
                name : "Chat de gouttière",
                description : "Une race de chat qui vit dans les gouttières",
            },
            species: {
                id : 1,
                name : "Chat",
                description : "Un chat c'est un chat"
            }
        },
        {
            id: 2,
            name: "Serra",
            dateOfBirth: new Date(2021, 6, 1),
            birthLocation: "La Street",
            isSterilize: true,
            disease: null,
            description: "MIAAAAAAAAAAAAAAAOU2",
            spa: {
                id: 1,
                name: "SPA de la rue de la paix",
                address: "12 rue de la paix",
                city: "Paris",
                postalCode: "75000",
                phone: "01 23 45 67 89",
                email: "spa75000@spa.fr"
            },
            breed : {
                id : 1,
                name : "Chat de gouttière",
                description : "Une race de chat qui vit dans les gouttières",
            },
            species: {
                id: 1,
                name : "Chat",
                description : "Un chat c'est un chat"
            }
        },
    ];

    const index = ref(0);
    const animals = reactive(animalsData);
    const currentAnimal = computed(() => animals[index.value]);

    const like = () => {
        console.log("Like" + currentAnimal.value.name);
        index.value++;
    }

    const dislike = () => {
        console.log("Dislike" + currentAnimal.value.name);
        index.value++;
    }
</script>

<template>
    <div v-if="currentAnimal" class="card bg-base-100 shadow-xl w-96 h-[600px] rounded-lg relative drop-shadow-sm">
        <div class="carousel w-full h-full rounded-lg">
            <div id="slide1" class="carousel-item relative w-full">
                <img src="https://placeimg.com/800/200/arch" class="w-full" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide4" class="btn btn-circle">❮</a>
                    <a href="#slide2" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide2" class="carousel-item relative w-full">
                <img src="https://placeimg.com/800/200/arch" class="w-full" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide1" class="btn btn-circle">❮</a>
                    <a href="#slide3" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide3" class="carousel-item relative w-full">
                <img src="https://placeimg.com/800/200/arch" class="w-full" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide2" class="btn btn-circle">❮</a>
                    <a href="#slide4" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide4" class="carousel-item relative w-full">
                <img src="https://placeimg.com/800/200/arch" class="w-full" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide3" class="btn btn-circle">❮</a>
                    <a href="#slide1" class="btn btn-circle">❯</a>
                </div>
            </div>
        </div>
        <div class="w-full p-5 absolute bottom-0 text-white bg-gradient-to-b from-transparent to-black rounded-lg">
            <div class="flex flex-row gap-2 items-center">
                <h2 class="text-3xl font-bold inline">{{ currentAnimal.name }}</h2>
                <h2 class="text-3xl inline">{{ calculateAge(currentAnimal.dateOfBirth) }}</h2>
            </div>
            <p>{{ currentAnimal.spa.name }}</p>
            <div class="card-actions justify-end">
                <button class="btn btn-circle" @click="like">
                    <i class="fa-solid fa-heart fa-2xl"></i>
                </button>
                <button class="btn btn-circle" @click="dislike">
                    <i class="fa-solid fa-xmark fa-2xl"></i>
                </button>
            </div>
        </div>
    </div>
    <div v-else class="h-full">
        <div class="flex flex-col h-full justify-center items-center">
            <h2 class="text-black text-2xl font-bold inline">Plus d'animaux à adopter</h2>
            <h3 class="text-black text-xl font-bold inline">Veuillez modifier vos critères de recherche</h3>
        </div>
    </div>
</template>
