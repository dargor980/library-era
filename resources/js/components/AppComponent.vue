<template>
    <div class="app h-100">
      <HeaderComponent />
      <div class="main-content row flex-grow-1">
        <div class="col-md-8 h-70">
            <ProductListComponent 
                class="container-margin" 
                :products="products"
                :selected-products="selectedProducts"
                @update-quantity="handleQuantityUpdate"
                @quantity-exceeded="handleQuantityExceeded"
            />
        </div>
        <div class="col-md-4 h-70">
            <SummaryComponent 
            class="container-margin"
            :total="total"
        />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import HeaderComponent from './HeaderComponent.vue';
  import ProductListComponent from './ProductListComponent.vue';
  import SummaryComponent from './SummaryComponent.vue';
  import SelectedProduct from '../models/SelectedProduct';
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

            console.log("product", product);
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
                    const newSelectedProduct = new SelectedProduct(
                        product.id,
                        product.name,
                        product.price,
                        product.bar_code,
                        1,
                        product.price,
                    );

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

            console.log("selected product", selectedProduct);
            console.log("product", product);
            if(selectedProduct && selectedProduct.quantity < product.quantity) {
                this.handleQuantityExceeded(product);
            }
        }
    }
  }
  </script>
  
  <style scoped>
  .app {
    display: flex;
    flex-direction: column;
    height: 100%;
  }
  .main-content {
    display: flex;
    justify-content: space-between;
  }
  .container-margin {
    margin-top: 1em;
  }
  </style>
  