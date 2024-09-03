<template>
    <div class="row">
      <div class="col-md-6">
        <h5>{{truncateText(product.name, 50) }}</h5>
        <p>{{ product.description }}</p>
      </div>
      <div class="col-md-2 d-flex justify-content-center align-items-center">
          <input
              type="number"
              class="form-control"
              v-model.number="product.quantity" 
              min="1" 
              @change="updateQuantity"
          >
      </div>
      <div class="col-md-2 d-flex justify-content-center align-items-cente">
        <span><strong>{{ product.price }}</strong></span>
      </div>
      <div class="col-md-2 d-flex justify-content-center align-items-cente">
        <span><strong>{{ product.subtotal }}</strong></span>
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
      this.product.subtotal = this.product.quantity * this.product.price;

      this.$emit('update-quantity', this.product);
    },
    truncateText(text, length) {
      return text.length > length ? text.substring(0, length) + '...' : text;
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
  