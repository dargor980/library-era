<template>
    <div class="app">
      <HeaderComponent />
      <div class="main-content row flex-grow-1">
        <div class="col-md-8 h-70">
            <ProductListComponent 
                class="container-margin" 
                :products="products"
                :selected-products="selectedProducts"
                @update-quantity="handleQuantityUpdate"
                @quantity-exceeded="handleQuantityExceeded"
                @remove-product="handleRemoveProduct"
            />
        </div>
        <div class="col-md-4 h-70">
            <SummaryComponent 
            class="container-margin"
            :total="total"
            :products="products"
            @payment-completed="handlePaymentCompleted"
            @clear-cart="clearCart()"
            @manual-product-input="handleManualProductInput"
        />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import HeaderComponent from './HeaderComponent.vue';
  import ProductListComponent from './ProductListComponent.vue';
  import SummaryComponent from './SummaryComponent.vue';
  import Swal from 'sweetalert2';
  
  export default {
    name: 'AppComponent',
    components: {
      HeaderComponent,
      ProductListComponent,
      SummaryComponent
    },
    data() {
        return {
            products: [],
            selectedProducts: [],
            barcodeInput: '',
            total: 0,
        };
    },
    mounted() {
        document.addEventListener('keydown', this.handleBarcodeScan);
    },
    created() {
        axios.get('/sales/products-sale').then(res => {
            this.products = res.data;
        });
    },
    beforeDestroy() {
        document.removeEventListener('keydown', this.handleBarcodeScan);
    },
    methods: {
        handleQuantityExceeded(product) {
            Swal.fire({
                    title: 'No hay stock',
                    text: `El producto "${product.name}" supera el stock disponible.`,
                    icon: 'error',
                    confirmButtonText: 'OK'
            })

            product.quantity -=1;
        },
        handleQuantityUpdate(updatedProduct) {
            this.checkStock(updatedProduct);
            this.updateTotal();

        },

        updateTotal() {
            this.total = this.selectedProducts.reduce((acc, product) => {
                return acc + product.subtotal;
            }, 0);
        },

        handleBarcodeScan(event) {
            if (event.key === 'Tab') {
                event.preventDefault();
                this.barcodeInput = this.barcodeInput.replace("Clear", "");
                this.addProductByBarcode(this.barcodeInput);
                this.barcodeInput = '';
            } else {
                this.barcodeInput += event.key;
            }
        },

        addProductByBarcode(barcode) {
       
            barcode = barcode.replace("Clear", "");
    
            let product = this.products.find(product => product.bar_code == barcode);
            if(product) {

                const newProduct = {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: 1
                };

                let selectedProduct = this.selectedProducts.find(selectedProduct => selectedProduct.id === newProduct.id);

                if(selectedProduct) {
                    selectedProduct.quantity += 1;
                    selectedProduct.subtotal += selectedProduct.price;

                    this.handleQuantityUpdate(selectedProduct);
                } else {
                    const newSelectedProduct ={
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        bar_code: product.bar_code,
                        quantity: 1,
                        subtotal: product.price,
                    };

                    this.selectedProducts.push(newSelectedProduct);

                    this.handleQuantityUpdate(newSelectedProduct);
                } 
            } else {
                Swal.fire({
                    title: 'Producto no encontrado',
                    text: 'Registre el producto o intente nuevamente',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            }
    
        },

        checkStock(product) {
            const selectedProduct = this.products.find(p => p.id === product.id);
            
            if(selectedProduct && selectedProduct.quantity < product.quantity) {
                this.handleQuantityExceeded(product);
            }
        },

        async handlePaymentCompleted(paymentInfo) {
            try {

                const saleData = {
                    total: this.total,
                    products: this.selectedProducts.map(product => ({
                        product_id: product.id,
                        quantity: product.quantity,
                    }))
                };

                if(paymentInfo.method === 'cash') {
                    saleData.payment_type = 'cash'
                } else {
                    saleData.payment_type = 'transfer';
                }

                const response = await axios.post('/sales/complete', saleData);
    
                if(response.status != 201) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al crear la venta. Por favor, Inténtelo de nuevo.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                this.selectedProducts = [];
                this.total = 0;
    
                Swal.fire({
                    title: 'Pago Completado',
                    text: `El pago se ha registrado correctamente mediante ${paymentInfo.method === 'cash' ? 'Efectivo' : 'Transferencia'}.`,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } catch(error) {
                let errorMessage = 'Ha ocurrido un error. Por favor inténtelo nuevamente';

                if(error.response && error.response.data && error.response.data.message) {
                    errorMessage = error.response.data.message;
                }

                Swal.fire({
                    title: 'Error',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });

                console.error(error);
            }


        },
        clearCart() {
            this.selectedProducts = [];
            this.total = 0;
        },

        handleRemoveProduct(product) {
            const index = this.selectedProducts.findIndex(p => p.id === product.id);

            if(index !== -1) {
                this.selectedProducts.splice(index, 1);

                this.updateTotal();
            }
        },

        handleManualProductInput(product) {
            this.addProductToCart(product);
        },

        addProductToCart(product) {
            const existingProduct = this.selectedProducts.find(p => p.id === product.id);

            if (existingProduct) {
                existingProduct.quantity +=1;
                existingProduct.subtotal += existingProduct.price;

                this.handleQuantityUpdate(existingProduct);
            } else {
                const newSelectedProduct = {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    bar_code: product.bar_code,
                    quantity: 1,
                    subtotal: product.price,
                };

                this.selectedProducts.push(newSelectedProduct);

                this.handleQuantityUpdate(newSelectedProduct);
            }
        }
    }
  }
  </script>
  
  <style scoped>
  .app {
    display: flex;
    flex-direction: column;
    height: 90%;
  }
  .main-content {
    display: flex;
    justify-content: space-between;
  }
  .container-margin {
    margin-top: 1em;
  }
  </style>
  