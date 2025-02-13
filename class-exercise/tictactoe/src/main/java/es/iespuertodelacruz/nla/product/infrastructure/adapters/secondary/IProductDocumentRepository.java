package es.iespuertodelacruz.nla.product.infrastructure.adapters.secondary;

import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface IProductDocumentRepository extends MongoRepository<ProductDocument, Integer> {
    ProductDocument findByName(String name);

    ProductDocument findByStock(int stock);

    ProductDocument findByPrice(float stock);


}
