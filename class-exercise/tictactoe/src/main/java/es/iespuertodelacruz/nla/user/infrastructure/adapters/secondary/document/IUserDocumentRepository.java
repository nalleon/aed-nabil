package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.document;

import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
//@Repository
public interface IUserDocumentRepository extends MongoRepository<UserDocument, String> {
    UserDocument findUserByName(String name);

    UserDocument findUserByEmail(String email);
    int deleteUserById(@Param("id") String id);

}
