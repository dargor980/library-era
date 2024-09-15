<template>
    <div class="summary card my-3 h-100">
      <h2>Total</h2>
      <h2>{{ total }}<strong></strong></h2>
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
            <button  class="btn btn-lg btn-success" @click="pay()">Pagar</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>

  import Swal from 'sweetalert2';

  export default {
    name: 'SummaryComponent',
    props: {
        total: {
            type: Number,
            required: true
        }
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