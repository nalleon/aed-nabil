package es.iespuertodelacruz.vsa.product.domain.service;

import es.iespuertodelacruz.vsa.persona.domain.Persona;
import es.iespuertodelacruz.vsa.persona.domain.port.secondary.IPersonaRepository;
import es.iespuertodelacruz.vsa.product.domain.Product;
import es.iespuertodelacruz.vsa.product.domain.port.primary.IProductService;
import es.iespuertodelacruz.vsa.product.domain.port.secondary.IProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.parameters.P;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ProductService implements IProductService {
    @Autowired
    IProductRepository repository;
    @Override
    public Product add(String name, int stock, float price) {
        Product aux = new Product(name, stock, price);
        return repository.save(aux);
    }

    @Override
    public Product findById(Integer id) {
        return repository.findById(id);
    }

    @Override
    public List<Product> findAll() {
        return repository.findAll();
    }
}
