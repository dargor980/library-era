<template>
    <div class="product-list card my-3 h-100">
        <div class="row">
            <div class="col-md-6">
                <h2>Productos</h2>
            </div>
            <div class="col-md-2">
                <h2 style="text-align: center;">Cantidad</h2>
            </div>
            <div class="col-md-2">
                <h2 style="text-align: center;">Precio</h2>
            </div>
            <div class="col-md-2">
                <h2 style="text-align: center;">Subtotal</h2>
            </div>
        </div>
      <ProductItemComponent
        v-for="product in selectedProducts"
        :key="product.id"
        :product="product"
        @update-quantity="checkQuantity(product)"
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
        },
        selectedProducts: {
          type: Array,
          required: true
        },
    },
    methods: {
        handleQuantityUpdate(updatedProduct) {

            this.$emit('update-quantity', updatedProduct);
        },

        checkQuantity(product) {
          const selectedProduct = this.products.find(p => p.id === product.id)
          if(selectedProduct && selectedProduct.quantity < product.quantity) {
            this.$emit('quantity-exceeded', product);
          }
        }
    }

  }
  </script>
  
  <style scoped>
    .product-list {
      padding: 20px;
    }
  </style>