package es.iespuertodelacruz.vsa.product.domain.port.primary;

import es.iespuertodelacruz.vsa.product.domain.Product;

import java.util.List;

public interface IProductService {
    Product add(String name, int stock, float price);
    Product findById(Integer id);

    List<Product> findAll();
}
