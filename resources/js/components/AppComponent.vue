<template>
    <div class="app h-100">
      <HeaderComponent />
      <div class="main-content row flex-grow-1">
        <div class="col-md-8 h-70">
            <ProductListComponent 
                class="container-margin" 
                :products="products"
            />
        </div>
        <div class="col-md-4 h-70">
            <SummaryComponent class="container-margin"/>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import HeaderComponent from './HeaderComponent.vue';
  import ProductListComponent from './ProductListComponent.vue';
  import SummaryComponent from './SummaryComponent.vue';
  
  export default {
    name: 'AppComponent',
    components: {
      HeaderComponent,
      ProductListComponent,
      SummaryComponent
    },
    data() {
        return {
        products: [
            { id: 1, name: 'Producto 1', description: 'Descripción del producto', price: '$9.99', quantity: 1 },
            { id: 2, name: 'Producto 2', description: 'Descripción del producto', price: '$14.99', quantity: 1 }
        ],
        barcodeInput: ''
        };
    },
    mounted() {
        document.addEventListener('keydown', this.handleBarcodeScan);
    },
    beforeDestroy() {
        document.removeEventListener('keydown', this.handleBarcodeScan);
    },
    methods: {
        handleBarcodeScan(event) {
        if (event.key === 'Tab') {
            event.preventDefault();
            this.addProductByBarcode(this.barcodeInput);
            this.barcodeInput = '';
        } else {
            this.barcodeInput += event.key;
        }
        },
        addProductByBarcode(barcode) {
       
        //TODO: cambiar esto a una llamada al backend
        const newProduct = {
            id: this.products.length + 1,
            name: `Producto ${this.products.length + 1}`,
            description: `Descripción del producto`,
            price: '$9.99',  
            quantity: 1
        };
        
        this.products.push(newProduct);
        console.log(this.products);
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
  