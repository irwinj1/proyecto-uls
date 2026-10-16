<script setup>
import GlobalAlert from './components/GlobalAlert.vue';
import Loader from './components/Loader.vue';
import { useLoaderStore } from './store/useLoaderStore';

const loaderStore = useLoaderStore();
</script>

<template>
  <v-app>
    <Loader :loader="loaderStore.isLoading" loader-text="Cargando..." />
    <GlobalAlert />
    <router-view></router-view>
  </v-app>
</template>
