<template>
    <div class="product-list-container card my-3 h-100">
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

          <tbody class="table-body-scroll">
            <ProductItemComponent
              v-for="product in selectedProducts"
              :key="product.id"
              :product="product"
              @update-quantity="handleQuantityUpdate"
              @remove-product="handleRemoveProduct"
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
            this.checkQuantity(updatedProduct);
            this.$emit('update-quantity', updatedProduct);
        },

        checkQuantity(product) {
          const selectedProduct = this.products.find(p => p.id === product.id)
          if(selectedProduct && selectedProduct.quantity < product.quantity) {
            this.$emit('quantity-exceeded', product);
          }
        },

        handleRemoveProduct(product) {
          this.$emit('remove-product', product);
        }
    }

  }
  </script>
  
  <style scoped>
    .product-list {
      padding: 20px;
    }

    .product-list-container {
      max-height: 90vh;
      overflow-y: auto;
    }

    .table-body-scroll {
      max-height: 90vh;
      overflow-y: auto;
    }

    .table-body-scroll::-webkit-scrollbar {
      width: 8px;
    }

    .table-body-scroll::-webkit-scrollbar-thumb {
      background-color: #ccc;
      border-radius: 4px;
    }

    .table-body-scroll::-webkit-scrollbar-thumb:hover {
      background-color: #aaa;
    }
  </style>