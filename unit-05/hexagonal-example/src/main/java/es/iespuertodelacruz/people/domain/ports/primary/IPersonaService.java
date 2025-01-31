package es.iespuertodelacruz.people.domain.ports.primary;

import es.iespuertodelacruz.people.domain.models.Person;

public interface IPersonaService {
     Person create(String name, int age);
     Person findById(Integer id);



}
