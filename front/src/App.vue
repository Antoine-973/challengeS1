<script setup>
    import AuthProvider from "./components/provider/AuthProvider.vue";
    import {RouterView} from "vue-router";
    import SnackbarProvider from "./components/provider/SnackbarProvider.vue";
</script>

<template>

    <AuthProvider>
        <SnackbarProvider>
            <div class="full">
                <RouterView/>
            </div>
        </SnackbarProvider>
    </AuthProvider>

</template>

<style scoped>

.full {
    height: 100vh;
    width: 100vw;
}
</style>

