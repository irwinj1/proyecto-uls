<template>
    <div>
        <data-table :verAcciones="acciones" :totalPage="pagination.last_page" :page="pagination.current_page" :headers="headers" :items="proyectos" @viewAction="verProyecto"  @update:page="paginationMethod">
        </data-table>
         <v-dialog
      v-model="dialogVerProyecto"
      
        persistent
    >
      <v-card
    class="mx-auto my-8"
    elevation="4"
    width="500"
    rounded="lg"
  >
    <v-card-item >
      <v-card-title>
        {{ proyecto.titulo }}
      </v-card-title>

    </v-card-item>

    <v-card-text>
      {{ proyecto.descripcion }}    
    </v-card-text>
    <v-card-actions>
        <v-row>
            <v-col cols="12"  class="text-center">
                <v-btn rounded="lg" variant="outlined" color="error" text @click="dialogVerProyecto = false">Cerrar</v-btn>
            </v-col>
        </v-row>
    </v-card-actions>
    </v-card>
    </v-dialog>
    </div>
</template>

<script setup>
import {onMounted, ref} from 'vue'
import {useProyectos} from './composables/proyectosComposable'
import DataTable from '../../components/DataTable.vue';
const acciones = ref(true);
const dialogVerProyecto = ref(false);
const proyecto = ref(null);
const {proyectos, pagination,obtenerProyectos} = useProyectos();
const headers = ref([
        { title: 'Título', key: 'titulo' },
        { title: 'Descripción', key: 'descripcion' },
        { title: 'Estado', key: 'estado' },
    ]);
acciones.value ? headers.value.push({ title: 'Acciones', key: 'acciones' }) : null;
const verProyecto = (item) =>{
    dialogVerProyecto.value = true;
    proyecto.value = item;
}



onMounted(async()=>{
    await obtenerProyectos();
    console.log(pagination.value);
    
})
</script>

