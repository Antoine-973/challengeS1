<script setup>
    import AuthProvider from "./components/provider/AuthProvider.vue";
    import {RouterView} from "vue-router";
    import SnackbarProvider from "./components/provider/SnackbarProvider.vue";
</script>

<template>

    <AuthProvider>

        <SnackbarProvider>
            <div class="full h-full w-full">
                <RouterView/>
            </div>
        </SnackbarProvider>
    </AuthProvider>

</template>
