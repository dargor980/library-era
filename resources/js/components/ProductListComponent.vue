<template>
    <div class="product-list card my-3 h-100">
        <div class="row">
            <div class="col-md-4">
                <h2>Productos</h2>
            </div>
            <div class="col-md-4">
                <h2 style="text-align: end;">Cantidad</h2>
            </div>
            <div class="col-md-4">
                <h2 style="text-align: end;">Precio</h2>
            </div>
        </div>
      <ProductItemComponent
        v-for="product in products"
        :key="product.id"
        :product="product"
      />
    </div>
  </template>
  
  <script>
  import ProductItemComponent from './ProductItemComponent.vue';
  
  export default {
    name: 'ProductListComponent',
    components: {
      ProductItemComponent
    },
    props: {
        products: {
            type: Array,
            required: true
        }
    }

  }
  </script>
  
  <style scoped>
  .product-list {
    padding: 20px;
  }
  </style>