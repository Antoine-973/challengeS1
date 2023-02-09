<script setup>
import {reactive, ref, watch} from "vue";
import BreedService from "../../services/BreedService";
import {useAnimalsStore} from "../../stores/animals.store";

const speciesData = await BreedService().getSpecies();
    const species = reactive(speciesData);
    const currentSpecies = ref(null);
    const selectedBreeds = ref(null);
    const currentAge = ref(null);
    const currentSex = ref(null);
    let currentBreeds = reactive(null)
    const animalsStore = useAnimalsStore();

    watch(currentSpecies, () => {
        if (currentSpecies.value) {
            currentBreeds = speciesData.find(specie => specie.id === currentSpecies.value).breeds
        }
    })

    const filterAnimals = async (event) => {
        event.preventDefault();
        await animalsStore.getAnimalsWithParams(currentSpecies.value, selectedBreeds.value, currentAge.value, currentSex.value);
    }
</script>

<template>
    <div class="dropdown dropdown-left dropdown-bottom">
        <div tabindex="0" class="btn btn-ghost btn-circle avatar">
            <button class="btn-ghost btn-circle">
                <i class="fa-solid fa-filter fa-xl"></i>
            </button>
        </div>
        <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-[24rem]">
            <form class="grid grid-cols-12 gap-4">
                <div class="col-span-6">
                    <select class="select select-bordered w-full max-w-xs" v-model="currentSpecies" @change="filterAnimals" id="species" name="species">
                        <option value="" selected>Espèce de l'animal</option>
                        <option v-for="specie in species" :key="specie.id" :value="specie.id">{{ specie.name }}</option>
                    </select>
                </div>
                <div class="col-span-6">
                    <select class="select select-bordered w-full max-w-xs" v-model="selectedBreeds" @change="filterAnimals" id="breed" name="breed">
                        <option value="" selected>Race de l'animal</option>
                        <option v-for="breed in currentBreeds" :key="breed.id" :value="breed.id">{{ breed.name }}</option>
                    </select>
                </div>
                <div class="col-span-6">
                    <select class="select select-bordered w-full max-w-xs" v-model="currentSex" @change="filterAnimals" id="sex" name="sex">
                        <option value="" selected>Sexe de l'animal</option>
                        <option value="1">Mâle</option>
                        <option value="2">Femelle</option>
                    </select>
                </div>
                <div class="col-span-6">
                    <input type="number" min="1" max="60" placeholder="Age de l'animal" class="input input-bordered w-full" v-model="currentAge" @change="filterAnimals" id="age" name="age" />
                </div>
            </form>
        </ul>
    </div>
</template>
