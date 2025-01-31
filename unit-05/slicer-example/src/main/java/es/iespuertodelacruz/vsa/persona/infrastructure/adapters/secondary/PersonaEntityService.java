package es.iespuertodelacruz.vsa.persona.infrastructure.adapters.secondary;

import es.iespuertodelacruz.vsa.persona.domain.model.Persona;
import es.iespuertodelacruz.vsa.persona.domain.port.secondary.IPersonaRepository;
import es.iespuertodelacruz.vsa.persona.infrastructure.adapters.secondary.mapper.PersonaEntityMapper;
import org.springframework.beans.factory.annotation.Autowired;

import java.util.List;

public class PersonaEntityService implements IPersonaRepository {

    @Autowired
    IPersonaEntityRepository repository;
    @Override
    public Persona save(Persona persona) {
        PersonaEntityMapper mapper = new PersonaEntityMapper();
        PersonaEntity entity = mapper.toPersistence(persona);
        PersonaEntity saved = repository.save(entity);

        return mapper.toDomain(saved);
    }

    @Override
    public List<Persona> findAll() {
        PersonaEntityMapper mapper = new PersonaEntityMapper();

        return repository.findAll().stream().map(
                mapper::toDomain
        ).toList();
    }

    @Override
    public Persona findById(Integer id) {
        return null;
    }
}
