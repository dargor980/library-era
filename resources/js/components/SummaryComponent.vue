<template>
    <div class="summary card my-3 h-100">
      <h2>Total</h2>
      <h3><strong>{{ total }}</strong></h3>
      <div class="actions row">

        <div class="col-md-4">
            <button class="btn btn-lg btn-success" @click="scan"><i class="fa fa-barcode"></i></button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-lg btn-success" @click="inputManually"><i class="fa fa-keyboard-o"></i></button>
        </div>
        <div class="col-md-4">
            <button  class="btn btn-lg btn-success" @click="clearCart"><i class="fa fa-trash-o"></i></button>
        </div>

      </div>
      <div class="checkout row">
        <div class="col-md-6">
            <button class="btn btn-lg btn-success" @click="finalize">Finalizar</button>
        </div>
        <div class="col-md-6">
            <button  class="btn btn-lg btn-success" @click="pay">Pagar</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'SummaryComponent',
    data() {
      return {
        total: '$24.98'
      };
    },
    methods: {
      scan() {
        //TODO: IMPLEMENTAR
      },
      inputManually() {
        //TODO: IMPLEMENTAR
      },
      clearCart() {
        //TODO: IMPLEMENTAR
      },
      finalize() {
        //TODO: IMPLEMENTAR
      },
      pay() {
        //TODO: IMPLEMENTAR
      }
    }
  }
  </script>
  
  <style scoped>
  .summary {
    padding: 20px;
  }
  .actions button {
    margin-right: 10px;
  }
  .checkout button {
    margin-right: 10px;
    margin-top: 10px;
  }
  </style>