<script setup>
import {onBeforeMount} from "vue";
import calculateAge from "../../helper/calculateAge";
import LikeService from "../../services/LikeService";
import {useAuthStore} from "../../stores/auth.store";
import {useAnimalsStore} from "../../stores/animals.store";
import {storeToRefs} from "pinia";

    const authStore = useAuthStore();
    const { user } = storeToRefs(authStore);
    const animalsStore = useAnimalsStore();
    const { animals, currentAnimalIndex, currentAnimal } = storeToRefs(animalsStore);

    onBeforeMount(async () => {
        await animalsStore.getAnimals();
    })

    const like = () => {
        LikeService().createLike(user.value.id, currentAnimal.value.id);
        currentAnimalIndex.value++;
    }

    const dislike = () => {
        currentAnimalIndex.value++;
    }
</script>

<template>
    <div v-if="currentAnimal" class="card bg-base-100 shadow-xl w-96 h-[600px] rounded-lg relative drop-shadow-sm">
        <div class="carousel w-full h-full rounded-lg">
            <div id="slide1" class="carousel-item relative w-full">
                <img src="https://cataas.com/cat/says/Je" class="w-full" :alt="currentAnimal.name + ' image'">
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide9" class="btn btn-circle">❮</a>
                    <a href="#slide2" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide2" class="carousel-item relative w-full">
                <img src="https://cataas.com/cat/says/suis" class="w-full" :alt="currentAnimal.name + ' image'" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide1" class="btn btn-circle">❮</a>
                    <a href="#slide3" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide3" class="carousel-item relative w-full">
                <img src="https://cataas.com/cat/says/un" class="w-full" :alt="currentAnimal.name + ' image'" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide2" class="btn btn-circle">❮</a>
                    <a href="#slide4" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide4" class="carousel-item relative w-full">
                <img src="https://cataas.com/cat/says/chat" class="w-full" :alt="currentAnimal.name + ' image'" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide3" class="btn btn-circle">❮</a>
                    <a href="#slide5" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide5" class="carousel-item relative w-full">
                <img src="https://cataas.com/cat/says/qui" class="w-full" :alt="currentAnimal.name + ' image'" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide4" class="btn btn-circle">❮</a>
                    <a href="#slide6" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide6" class="carousel-item relative w-full">
                <img src="https://cataas.com/cat/says/parle" class="w-full" :alt="currentAnimal.name + ' image'" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide5" class="btn btn-circle">❮</a>
                    <a href="#slide7" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide7" class="carousel-item relative w-full">
                <img src="https://cataas.com/cat/says/et" class="w-full" :alt="currentAnimal.name + ' image'" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide6" class="btn btn-circle">❮</a>
                    <a href="#slide8" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide8" class="carousel-item relative w-full">
                <img src="https://cataas.com/cat/says/puis" class="w-full" :alt="currentAnimal.name + ' image'" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide7" class="btn btn-circle">❮</a>
                    <a href="#slide9" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide9" class="carousel-item relative w-full">
                <img src="https://cataas.com/cat/says/voila" class="w-full" :alt="currentAnimal.name + ' image'" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide8" class="btn btn-circle">❮</a>
                    <a href="#slide1" class="btn btn-circle">❯</a>
                </div>
            </div>
        </div>
        <div class="w-full p-5 absolute bottom-0 text-white bg-gradient-to-b from-transparent to-black rounded-lg">
            <div class="flex flex-row gap-2 items-center">
                <h2 class="text-2xl font-bold inline">{{ currentAnimal.name }}</h2>
                <h2 class="text-2xl inline">{{ calculateAge(currentAnimal.birthday) }}</h2>
                <i v-if="currentAnimal.sex === 1" class="fa-solid fa-mars fa-lg"></i>
                <i v-if="currentAnimal.sex === 2" class="fa-solid fa-venus fa-lg"></i>
                <i class="absolute right-10 fa-solid fa-lg fa-circle-info"></i>
            </div>
            <p>{{ currentAnimal.description.substring(0, 100) }}...</p>
            <p>{{ currentAnimal.spa.name }}</p>
            <div class="card-actions justify-end">
                <button class="btn btn-circle btn-primary" @click="like">
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
