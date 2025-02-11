package es.iespuertodelacruz.vsa.persona.domain.service;

import es.iespuertodelacruz.vsa.persona.domain.Persona;
import es.iespuertodelacruz.vsa.persona.domain.port.primary.IPersonaService;
import es.iespuertodelacruz.vsa.persona.domain.port.secondary.IPersonaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
@Service
public class PersonaService implements IPersonaService {
    
    @Autowired
    private IPersonaRepository repository;
    @Override
    public Persona add(String nombre, int edad, Integer id) {
        Persona aux = new Persona(id, nombre, edad);
        return repository.save(aux);
    }

    @Override
    public Persona findById(Integer id) {
        return repository.findById(id);
    }

    @Override
    public List<Persona> findAll() {
        return repository.findAll();
    }
}
