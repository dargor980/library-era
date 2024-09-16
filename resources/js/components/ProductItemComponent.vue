<template>
    <tr>
      <td>
        <h5>{{truncateText(product.name, 50) }}</h5>
        <p>{{ product.description }}</p>
      </td>

      <td class="text-center align-middle">
        <input
              type="number"
              class="form-control"
              v-model.number="product.quantity" 
              min="1" 
              @change="updateQuantity"
          >
      </td>

      <td class="text-center align-middle">
        <span><strong>{{ product.price }}</strong></span>
      </td>

      <td class="text-center align-middle">
        <span><strong>{{ product.subtotal }}</strong></span>
      </td>

      <td class="text-center align-middle">
        <button @click="removeProduct()" class="btn btn-danger"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
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
    },
    removeProduct() {
      this.$emit("remove-product", this.product)

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
  