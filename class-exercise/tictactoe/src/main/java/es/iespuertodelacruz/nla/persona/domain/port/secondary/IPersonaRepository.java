package es.iespuertodelacruz.nla.persona.domain.port.secondary;

import es.iespuertodelacruz.nla.persona.domain.Persona;

import java.util.*;
public interface IPersonaRepository {
    // extends JpaRepository<Persona, Integer>
    Persona save(Persona persona);
    List<Persona> findAll();

    Persona findById(Integer id);
}
