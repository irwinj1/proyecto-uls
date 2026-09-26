<template>
  <div>
    <h1>Admin Dashboard</h1>
    <p>Welcome to the secure admin area.</p>
    <v-btn v-role="['user', 'admin']">Prueba</v-btn>
    <v-text-field @keydown="validarTexto" type="text" v-model="inputValue" placeholder="Type something..." />
  </div>

</template>

<script setup>
const validarTexto = (e)=>{
  console.log(e.target.value);
}
</script>

<style scoped>
input[type="text"] {
 display: block;
 font-size: 24px;
 border: 1px solid #ccc;
 border-radius: 4px;
  padding: 10px;
}
</style>