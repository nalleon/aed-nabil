package es.iespuertodelacruz.nla.institutov2.controller;

import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.services.MatriculaService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/instituto/api/v1/matriculas")
@CrossOrigin
public class MatriculaRESTController {

    @Autowired
    MatriculaService service;

    @PostMapping
    public ResponseEntity<?> save(@RequestBody Matricula matricula){
        return ResponseEntity.ok(service.save(matricula));
    }
}
