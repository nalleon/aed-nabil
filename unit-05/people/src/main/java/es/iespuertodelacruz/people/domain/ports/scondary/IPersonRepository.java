package es.iespuertodelacruz.people.domain.ports.scondary;

import es.iespuertodelacruz.people.domain.models.Person;
import org.springframework.stereotype.Repository;

@Repository
public interface IPersonRepository {
    Person save(Person person);
    Person findById();
}

