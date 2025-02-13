package es.iespuertodelacruz.nla.product.domain.port.secondary;

import es.iespuertodelacruz.nla.product.domain.Product;

import java.util.List;

public interface IProductRepository {
    Product save(Product product);
    List<Product> findAll();
    Product findById(Integer id);
}
