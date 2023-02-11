<script setup>
import {RouterView} from "vue-router";
import SnackbarProvider from "./components/provider/SnackbarProvider.vue";</script>

<template>
        <SnackbarProvider>
            <div class="full h-full w-full">
                <RouterView/>
            </div>
        </SnackbarProvider>
</template>
