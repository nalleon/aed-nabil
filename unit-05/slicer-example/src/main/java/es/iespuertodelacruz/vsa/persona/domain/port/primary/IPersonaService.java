package es.iespuertodelacruz.vsa.persona.domain.port.primary;

import es.iespuertodelacruz.vsa.persona.domain.Persona;
import org.springframework.stereotype.Service;
import java.util.*;
@Service
public interface IPersonaService {
    Persona add(String nombre, int edad, Integer id);
    Persona findById(Integer id);

    List<Persona> findAll();
}
