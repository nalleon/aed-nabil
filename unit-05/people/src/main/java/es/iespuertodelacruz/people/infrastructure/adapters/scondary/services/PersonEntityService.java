package es.iespuertodelacruz.people.infrastructure.adapters.scondary.services;

import es.iespuertodelacruz.people.infrastructure.adapters.scondary.entities.PersonaEntity;
import es.iespuertodelacruz.people.infrastructure.adapters.scondary.repository.IPersonEntityRepository;
import es.iespuertodelacruz.people.domain.ports.scondary.IPersonRepository;
import es.iespuertodelacruz.people.domain.models.Person;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

@Service
public class PersonEntityService implements IPersonRepository {

    @Autowired
    IPersonEntityRepository repository;
    @Override
    @Transactional
    public Person save(Person person) {
        PersonaEntity entity = new PersonaEntity();
        entity.setNombre(person.getName());
        entity.setEdad(person.getAge());

        PersonaEntity save = repository.save(entity);

        return new Person(save.getId(), save.getNombre(), save.getEdad());
    }
}
