package es.iespuertodelacruz.people.domain.services;

import es.iespuertodelacruz.people.domain.models.Person;
import es.iespuertodelacruz.people.domain.ports.primary.IPersonaService;
import es.iespuertodelacruz.people.domain.ports.scondary.IPersonRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class PersonServiceDomain implements IPersonaService {

	@Autowired
	IPersonRepository repository;

	@Override
	public Person create(String name, int age) {
		Person aux = new Person(name, age);
		return repository.save(aux);
	}
}
