package es.iespuertodelacruz.nla.institutov2.controller;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IController;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.services.MatriculaService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/instituto/api/v1/matriculas")
@CrossOrigin
public class MatriculaRESTController implements IController<Matricula, Integer> {

    @Autowired
    MatriculaService service;

    @PostMapping
    @Override
    public ResponseEntity<?> add(@RequestBody Matricula matricula) {
        return ResponseEntity.ok(service.save(matricula));
    }

    @Override
    public ResponseEntity<?> update(@RequestParam(value = "id") Integer id, @RequestBody Matricula matricula) {
        return null;
    }

    @Override
    public ResponseEntity<List<Matricula>> getAll() {
        return null;
    }

    @Override
    public ResponseEntity<Matricula> getById(@RequestParam(value = "id")Integer id) {
        return null;
    }

    @Override
    public ResponseEntity<?> delete(@RequestParam(value = "id") Integer id) {
        return null;
    }
}
