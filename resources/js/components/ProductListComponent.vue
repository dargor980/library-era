<template>
    <div class="product-list card my-3 h-100">
        <table class="table table-striped table-hover ">
          <thead class="thead-dark">
            <tr>
              <th><h2>Productos</h2></th>
              <th><h2>Cantidad</h2></th>
              <th><h2>Precio</h2></th>
              <th><h2>Subtotal</h2></th>
              <th><h2>Acción</h2></th>
            </tr>
          </thead>

          <tbody>
            <ProductItemComponent
              v-for="product in selectedProducts"
              :key="product.id"
              :product="product"
              @update-quantity="checkQuantity(product)"
            />
          </tbody>

        </table>
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
          console.log("checkquantityproduct", this.product);
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