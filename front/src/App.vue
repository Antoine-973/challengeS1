<script setup>
    import AuthProvider from "./components/provider/AuthProvider.vue";
    import {RouterView} from "vue-router";
</script>

<template>

    <AuthProvider>
        <div class="w-full h-full">
            <RouterView/>
        </div>
    </AuthProvider>

</template>
