package es.iespuertodelacruz.nla.persona.infrastructure.adapters.secondary;

import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface IPersonaDocumentRepository extends MongoRepository<PersonaDocument, String> {
    PersonaDocument findByDni(String dni);
}
