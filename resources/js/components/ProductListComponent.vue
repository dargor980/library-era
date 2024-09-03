<template>
    <div class="product-list card my-3 h-100">
        <div class="row">
            <div class="col-md-3">
                <h2>Productos</h2>
            </div>
            <div class="col-md-3">
                <h2 style="text-align: end;">Cantidad</h2>
            </div>
            <div class="col-md-3">
                <h2 style="text-align: end;">Precio</h2>
            </div>
            <div class="col-md-3">
                <h2 style="text-align: end;">Subtotal</h2>
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