<script setup>
import Menu from "../../components/TemplateBO.vue";
import { getAllReviews } from '../../services/adminService';
import { ref } from 'vue'

const reviews = ref(null);
const filteredReviews = ref(null);

const getReviews = async() => {
    const responseGetReviews = await getAllReviews();
    const data = await responseGetReviews.json();
    reviews.value = data['hydra:member'];

    filteredReviews.value = reviews.value.filter(el => el.rate <= 3 && el.isValidate == null);
}

getReviews();

</script>

<template>
  <main>
    <div class="flex justify-between">
        <Menu></Menu>

        <div class="grow ml-32">
            <h1 class="text-xl text-center mt-11">Gérer les commentaires</h1>

            <div class="overflow-x-auto">
                <table class="table w-5/6 mt-12 justify-center h-2 overflow-auto">
                    <thead>
                        <tr>
                            <th>Utilisateur noté</th>
                            <th>Note /5</th>
                            <th>Commentaire</th>
                            <th>Gérer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="review in filteredReviews">
                            <td>{{ review.user.firstname }}  {{ review.user.lastname }}</td>
                            <td>{{ review.rate }}</td>
                            <td>{{ review.description }}</td>
                            <td><a :href="'/backOffice/admin/reviews/' + review.id"><i class="fa-solid fa-eye"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
    
  </main>
</template>