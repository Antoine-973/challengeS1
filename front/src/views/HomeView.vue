<script setup>
import SideBar from "../components/Home/SideBar.vue";
import ProfileCard from "../components/Home/ProfileCard.vue";
import FilterForm from "../components/Home/FilterForm.vue";
</script>
<template>
  <main>
      <div class="grid grid-cols-12 grid-rows-1 w-full h-full">
        <div class="h-screen col-span-3 border-r border-1 border-gray-300">
            <Suspense>
                <SideBar/>
            </Suspense>
        </div>
        <div class="col-span-9 relative bg-accent">
            <div class="absolute top-5 right-5">
                <Suspense>
                    <FilterForm />
                </Suspense>
            </div>
            <div class="flex flex-col justify-between items-center h-full py-5">
                <Suspense>
                    <ProfileCard />
                </Suspense>
            </div>
            <div class="absolute bottom-5 right-5">
                <a href="donation"><button class="btn btn-primary">Faire un don</button></a>
            </div>
        </div>
      </div>
  </main>
</template>
