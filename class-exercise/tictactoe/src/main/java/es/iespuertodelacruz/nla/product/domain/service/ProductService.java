package es.iespuertodelacruz.nla.product.domain.service;

import es.iespuertodelacruz.nla.product.domain.Product;
import es.iespuertodelacruz.nla.product.domain.port.primary.IProductService;
import es.iespuertodelacruz.nla.product.domain.port.secondary.IProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
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
