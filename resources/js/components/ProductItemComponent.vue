<template>
    <div class="product-item">
      <div class="product-details">
        <h5>{{ product.name }}</h5>
        <p>{{ product.description }}</p>
      </div>
      <div class="product-quantity">
          <input
              type="number"
              class="form-control"
              v-model.number="product.quantity" 
              min="1" 
              @change="updateQuantity"
          >
      </div>
      <div class="product-price">
        <span><strong>{{ product.price }}</strong></span>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ProductItemComponent',
    props: {
      product: {
        type: Object,
        required: true
      }
    },
    methods: {
    updateQuantity() {
      //TODO: Implementar evento.
      this.$emit('update-quantity', this.product);
    }
  }
  }
  </script>
  
  <style scoped>
  .product-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
  }
  .product-image img {
    width: 50px;
    height: 50px;
  }
  .product-quantity input {
    width: 60px;
  }
  </style>
  