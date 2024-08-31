export default class Product {
    constructor(id, name, price, bar_code, quantity = 1) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.bar_code = bar_code;
        this.quantity = quantity;
    }
}