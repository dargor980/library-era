<template>
    <div>
        <div>
            <div v-if="showModal" class="modal-overlay">
                <div class="modal-content">
                    <h3>Agregar Producto Manualmente</h3>
                    <input 
                        type="text"
                        v-model="searchQuery"
                        @input="onSearch"
                        placeholder="Ingrese el nombre o código de barras"
                    />

                    <ul>
                        <li
                            v-for="product in filteredProducts"
                            :key="product.id"
                            @click="selectProduct(product)"
                        >
                           <span v-html="highlightMatch(product.name)"></span> - {{ product.bar_code }}
                        </li>
                    </ul>
                    <button class="btn btn-success" @click="closeModal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'ProductSearchModal',
    props: {
        products: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            showModal: false,
            searchQuery: '',
            filteredProducts: []
        };
    },
    methods: {
        openModal() {
            this.showModal = true;
            this.searchQuery = '';
            this.filteredProducts = [];
        },
        closeModal() {
            this.showModal = false;
            this.$emit('closed');
        },
        onSearch() {
            const query = this.searchQuery.toLowerCase();
            if (query.length > 0) {
                this.filteredProducts = this.products.filter(product => {
                    return (
                        product.name.toLowerCase().includes(query) ||
                        product.bar_code.toLowerCase().includes(query)
                    );
                });
            } else {
                this.filteredProducts = [];
            }
        },
        selectProduct(product) {
            this.$emit('product-selected', product);
            this.closeModal();
        },
        highlightMatch(text) {
            const query = this.searchQuery;
            if (!query) return text;
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<strong>$1</strong>');
        }
    }
};

</script>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5) !important;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff !important;
    padding: 20px;
    border-radius: 5px;
    max-width: 80%;
    max-height: 80%;
    overflow-y: auto;
    z-index: 9999 !important;
}

.modal-content h3 {
    margin-top: 0;
}

.modal-content input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
}

.modal-content ul {
    list-style: none;
    padding: 0;
}

.modal-content li {
    padding: 10px;
    cursor: pointer;
}

.modal-content li:hover {
    background-color: #f0f0f0;
}

.modal-content button {
    margin-top: 10px;
}
</style>