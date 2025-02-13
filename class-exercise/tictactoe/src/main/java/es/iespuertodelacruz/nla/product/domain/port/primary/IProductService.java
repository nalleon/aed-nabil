package es.iespuertodelacruz.nla.product.domain.port.primary;

import es.iespuertodelacruz.nla.product.domain.Product;

import java.util.List;

public interface IProductService {
    Product add(String name, int stock, float price);
    Product findById(Integer id);

    List<Product> findAll();
}
