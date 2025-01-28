package es.iespuertodelacruz.people.infrastructure.adapters.primary.controllers;

import es.iespuertodelacruz.people.domain.models.Person;
import es.iespuertodelacruz.people.domain.ports.primary.IPersonaService;
import es.iespuertodelacruz.people.infrastructure.adapters.primary.dto.PersonDTO;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin
@RequestMapping("/api/")
public class PersonRestController {
    @Autowired IPersonaService service;

    public ResponseEntity<?> save(PersonDTO dto){
        Person person = new Person(dto.id(), dto.name(), dto.edad());

        Person saved = service.create(person.getName(), person.getAge());

        PersonDTO dtoResult = new PersonDTO(saved.getId(), saved.getName(), saved.getAge());
        return ResponseEntity.ok(dtoResult);
    }

    public ResponseEntity<?> findAll(){
        return null;
    }


    public ResponseEntity<?> findById(){
        return null;
    }

    public ResponseEntity<?> update(){
        return null;
    }


    public ResponseEntity<?> delete(){
        return null;
    }
}
