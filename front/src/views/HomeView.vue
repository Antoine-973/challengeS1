<script setup>
import SideBar from "../components/Home/SideBar.vue";
import ProfileCard from "../components/Home/ProfileCard.vue";</script>

<template>
  <main>
      <div class="grid grid-cols-12 grid-rows-1 w-full h-full">
        <div class="h-screen col-span-3 bg-grey-500 border-r border-1 border-gray-300">
            <SideBar/>
        </div>
        <div class="col-span-9 bg-gray-100">
            <div class="flex flex-col justify-between items-center h-full py-5">
                <ProfileCard />
                <div class="flex flex-row justify-center gap-5 w-full">
                    <div>Non</div>
                    <div>Like</div>
                    <div>Ouvrir le profil</div>
                    <div>Photo Suivante</div>
                </div>
            </div>
        </div>
      </div>
  </main>
</template>
