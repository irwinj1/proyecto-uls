<template>
    <v-container>
        <data-table :headers="headers" :items="proyectos"></data-table>
    </v-container>
</template>

<script setup>
import {onMounted, ref} from 'vue'
import {useProyectos} from './composables/proyectosComposable'
import DataTable from '../../components/DataTable.vue';
const {proyectos,obtenerProyectos} = useProyectos();
const headers = ref([
        { title: 'Título', key: 'titulo' },
        { title: 'Descripción', key: 'descripcion' },
        { title: 'Estado', key: 'estado' },
        { title: 'Acciones', key: 'acciones' }
])
onMounted(async()=>{
    await obtenerProyectos();
    console.log(proyectos.value);
    
})
</script>

