<template>
    <div class="header">
      <div>
        <img src="/logo.svg" class="icono">
      </div>
      <div>
        <h1 class="ml-3">Nueva Venta</h1>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'HeaderComponent',
  }
  </script>
  
  <style scoped>
  .header {
    background-color: #000;
    display: flex;
    vertical-align: center;
    color: #fff;
    padding: 10px;
  }
  </style>
  