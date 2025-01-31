package es.iespuertodelacruz.vsa.persona.infrastructure.adapters.primary;

import es.iespuertodelacruz.vsa.persona.domain.port.primary.IPersonaService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin
@RequestMapping("/api/personas")
public class PersonaRESTController {


    @Autowired
    private IPersonaService service;

    @GetMapping
    public ResponseEntity<?> getAll(){

        return ResponseEntity.ok().body(service.findAll());
    }
}
