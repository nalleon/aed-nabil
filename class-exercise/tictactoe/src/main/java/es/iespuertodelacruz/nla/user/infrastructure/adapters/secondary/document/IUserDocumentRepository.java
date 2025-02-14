package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.document;

import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.stereotype.Repository;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Repository
public interface IUserDocumentRepository extends MongoRepository<UserDocument, String> {
    UserDocument findByName(String name);

    UserDocument findByEmail(String email);

}
