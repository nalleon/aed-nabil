package es.iespuertodelacruz.vsa.product.domain.port.secondary;

import es.iespuertodelacruz.vsa.persona.domain.Persona;
import es.iespuertodelacruz.vsa.product.domain.Product;

import java.util.List;

public interface IProductRepository {
    Product save(Product product);
    List<Product> findAll();
    Product findById(Integer id);
}
