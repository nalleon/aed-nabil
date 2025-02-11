package es.iespuertodelacruz.vsa.product.infrastructure.adapters.secondary;

import es.iespuertodelacruz.vsa.product.domain.Product;
import es.iespuertodelacruz.vsa.product.domain.port.secondary.IProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ProductDocumentService implements IProductRepository {
    @Autowired
    private IProductEntityRepository repository;

    @Override
    public Product save(Product product) {
//        ProductDocument
        return null;
    }

    @Override
    public List<Product> findAll() {
        return null;
    }

    @Override
    public Product findById(Integer id) {
        return null;
    }
}
