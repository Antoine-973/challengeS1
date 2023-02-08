<script setup>
import {inject} from 'vue' ;

const user = inject('AuthProvider:user') ;
</script>

<template>
    <main>
        <div class="flex flex-col bg-white h-screen text-white">
            <div class="w-full bg-gradient-to-b from-orange-500 to-orange-400 border-b grid grid-cols-5 justify-between items-center py-7 px-2">
                <div class="avatar">
                    <div class="w-8 rounded-full">
                        <img src="https://placeimg.com/192/192/people" />
                    </div>
                </div>
                <div>{{user.firstname}} {{user.lastname}}</div>
                <div class="avatar">
                    <div class="avatar placeholder">
                        <div class="bg-white text-neutral-content rounded-full w-8">
                            <span class="text-sm">K</span>
                        </div>
                    </div>
                </div>
                <div class="avatar">
                    <div class="avatar placeholder">
                        <div class="bg-white text-neutral-content rounded-full w-8">
                            <span class="text-sm">K</span>
                        </div>
                    </div>
                </div>
                <div class="avatar">
                    <div class="avatar placeholder">
                        <div class="bg-white text-neutral-content rounded-full w-8">
                            <span class="text-sm">K</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>test</div>
        </div>
    </main>
</template>
