package es.iespuertodelacruz.vsa.product.domain;


public class Product {
    int id;
    String name;
    int stock;
    float price;

    public Product(String name, int stock, float price) {
        this.name = name;
        this.stock = stock;
        this.price = price;
    }

    public Product(int id, String name, int stock, float price) {
        this.id = id;
        this.name = name;
        this.stock = stock;
        this.price = price;
    }

    /**
     * Getters and setters
     */
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getStock() {
        return stock;
    }

    public void setStock(int stock) {
        this.stock = stock;
    }

    public float getPrice() {
        return price;
    }

    public void setPrice(float price) {
        this.price = price;
    }
}
