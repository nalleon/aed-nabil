package es.iespuertodelacruz.vsa.persona.infrastructure.adapters.secondary.mapper;

import es.iespuertodelacruz.vsa.persona.domain.Persona;
import es.iespuertodelacruz.vsa.persona.infrastructure.adapters.secondary.PersonaEntity;

public class PersonaEntityMapper {

    public PersonaEntityMapper() {
    }

    public PersonaEntity toPersistence(Persona p){
        PersonaEntity entity = new PersonaEntity();
        entity.setId(p.getId());
        entity.setNombre(p.getNombre());
        entity.setEdad(p.getEdad());
        return entity;
    }

    public Persona toDomain(PersonaEntity entity){
        Persona domain = new Persona();
        domain.setId(entity.getId());
        domain.setNombre(entity.getNombre());
        domain.setEdad(entity.getEdad());
        return domain;
    }

}
