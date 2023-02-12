<script setup>

import SideBar from "../../../components/Home/SideBar.vue";
import Conversation from "../../../components/Chat/Conversation.vue" ;
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
               <Conversation/>
            </div>
        </div>
    </main>
</template>
