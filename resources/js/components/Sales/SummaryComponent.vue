<template>
    <div class="summary card my-3 h-100">
      <h1>TOTAL</h1>
      <h1>{{ total }}<strong></strong></h1>
      <div class="actions row">
        <div class="col-md-6">
            <button class="btn btn-lg custom-button btn-block" @click="inputManually" style="background-color: #bd0003;"><i class="fa fa-keyboard-o"></i></button>
        </div>
        <div class="col-md-6">
            <button  class="btn btn-lg custom-button btn-block" @click="clearCart" style="background-color: #bd0003;"><i class="fa fa-trash-o"></i></button>
        </div>

      </div>
      <div class="checkout row">
        <div class="col-md-12">
            <button  class="btn btn-lg custom-button btn-block" @click="pay()" style="background-color: #bd0003;">Pagar</button>
        </div>
      </div>

      <ProductSearchModal
        ref="productSearchModal"
        :products="products"
        @product-selected="handleProductSelected"
      />
    </div>

  </template>
  
  <script>

  import Swal from 'sweetalert2';
  import ProductSearchModal from './ProductSearchModal.vue';

  export default {
    name: 'SummaryComponent',
    components: {
      ProductSearchModal
    },
    props: {
        total: {
            type: Number,
            required: true
        },
        products: {
          type: Array,
          required: true
        }
    },
    methods: {
      inputManually() {
        this.$refs.productSearchModal.openModal();
      },
      clearCart() {
        this.$emit('clear-cart');
      },
      pay() {
        if(this.total === 0) {
          Swal.fire({
            title: "Venta no ingresada",
            text: `Debe ingresar al menos un producto para registrar la venta`,
            icon: 'error',
            confirmButtonText: 'OK',
          });

          return;
        }
        
        Swal.fire({
          title: 'Método de pago',
          input: 'radio',
          inputOptions: {
            'cash': 'Efectivo',
            'transfer': 'Transferencia'
          },
          inputValidator: (value) => {
            if(!value) {
              return 'Debe seleccionar un método de pago';
            }
          },
          confirmButtonText: 'Continuar',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if(result.isConfirmed) {
            if(result.value === 'cash') {
              this.handleCashPayment();
            } else if (result.value === 'transfer') {
              this.handleTransferPayment();
            }
          }
        });
      },
      
      handleCashPayment() {
        Swal.fire({
          title: 'Pago en efectivo',
          html: `<p><Total a pagar: <strong>$${this.total.toFixed(2)}</strong></p>
                <p>Ingrese el efectivo recibido: </p>`,
          input: 'number',
          inputAttributes: {
            min: this.total,
            step: '10'
          },
          inputValidator: (value) => {
            if(!value || parseFloat(value) < this.total) {
              return 'El efectivo recibido debe ser mayor o igual al total a pagar'
            }
          },
          confirmButtonText: 'Calcular vuelto',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          const cashReceived = parseFloat(result.value);
          const change = cashReceived - this.total;
          Swal.fire({
            title: 'Vuelto',
            html: `<p>Efectivo recibido: <strong>$${cashReceived.toFixed(2)}</strong></p>
                  <p>Total a pagar: <strong>$${this.total.toFixed(2)}</strong></p>
                  <p><strong>Cambio: $${change.toFixed(2)}</strong></p>`,
            icon: 'success',
            confirmButtonText: 'Finalizar',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
          }).then((finalResult) => {
            if(finalResult.isConfirmed) {
              this.finalizePayment('cash', cashReceived, change);
            }
          });
        })
      },
      handleTransferPayment() {
        Swal.fire({
          title: 'Pago por Transferencia',
          html: `<p>Total a pagar: <strong>$${this.total.toFixed(2)}</strong></p>
                <p>Confirme que ha recibido la transferencia.</p>`,
          icon: 'info',
          confirmButtonText: 'Confirmar Pago',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            this.finalizePayment('transfer');
          }
        });
      },

      finalizePayment(method, cashReceived = null, change = null) {
        this.$emit('payment-completed', {
          method: method,
          total: this.total,
          cashReceived: cashReceived,
          change: change
        });
      },

      handleProductSelected(product) {
        this.$emit('manual-product-input', product);
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

  .custom-button {
    background: #bd0003;
    color: white;
  }
  </style>