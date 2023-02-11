import {defineStore} from "pinia";
import {computed, ref} from "vue";
import AnimalService from "../services/AnimalService";

export const useAnimalsStore = defineStore('animals', () => {

  const animals = ref(null)
  const currentAnimal = computed(() => {
    if (animals.value) {
      return animals.value[currentAnimalIndex.value];
    }
    return null;
  })
  const currentAnimalIndex = ref(0)

  const getAnimals = async () => {
    animals.value = await AnimalService().getAnimals();
  }

  const getAnimalsWithParams = async (species, breeds, age, sex) => {
    animals.value = await AnimalService().getAnimalsWithParams(species, breeds, age, sex);
  }

  return {
    animals,
    currentAnimal,
    currentAnimalIndex,
    getAnimals,
    getAnimalsWithParams,
  }
})
