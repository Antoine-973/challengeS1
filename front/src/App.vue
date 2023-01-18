<script setup>
    import AuthProvider from "./components/provider/AuthProvider.vue";
    import {RouterView} from "vue-router";
</script>

<template>

    <AuthProvider>
        <div class="full">
            <RouterView/>
        </div>
    </AuthProvider>

</template>

<style scoped>

.full {
    height: 100vh;
    width: 100vw;
}
</style>

