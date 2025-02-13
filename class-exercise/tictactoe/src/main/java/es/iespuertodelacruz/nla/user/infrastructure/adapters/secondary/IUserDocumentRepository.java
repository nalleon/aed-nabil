package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary;

import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface IUserDocumentRepository extends MongoRepository<UserDocument, Integer> {
    UserDocument findByName(String name);

    UserDocument findByStock(int stock);

    UserDocument findByPrice(float stock);


}
