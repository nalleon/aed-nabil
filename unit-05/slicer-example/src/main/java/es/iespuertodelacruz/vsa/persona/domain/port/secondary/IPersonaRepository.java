package es.iespuertodelacruz.vsa.persona.domain.port.secondary;

import es.iespuertodelacruz.vsa.persona.domain.model.Persona;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.*;
public interface IPersonaRepository {
    // extends JpaRepository<Persona, Integer>
    Persona save(Persona persona);
    List<Persona> findAll();

    Persona findById(Integer id);
}
