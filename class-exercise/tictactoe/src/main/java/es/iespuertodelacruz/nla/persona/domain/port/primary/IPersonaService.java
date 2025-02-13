package es.iespuertodelacruz.nla.persona.domain.port.primary;

import es.iespuertodelacruz.nla.persona.domain.Persona;
import org.springframework.stereotype.Service;
import java.util.*;
@Service
public interface IPersonaService {
    Persona add(String nombre, int edad, Integer id);
    Persona findById(Integer id);

    List<Persona> findAll();
}
