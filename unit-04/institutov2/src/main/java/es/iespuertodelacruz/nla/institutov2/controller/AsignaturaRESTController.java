package es.iespuertodelacruz.nla.institutov2.controller;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IController;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.services.AsignaturaService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;

import java.util.List;

public class AsignaturaRESTController implements IController<Asignatura, Integer> {

    @Autowired
    AsignaturaService service;

    @PostMapping
    @Override
    public ResponseEntity<?> add(@RequestBody Asignatura asignatura) {
        return ResponseEntity.ok(service.save(asignatura));
    }

    @Override
    public ResponseEntity<?> update(@RequestParam(value = "id") Integer id, @RequestBody Asignatura asignatura) {
        return null;
    }

    @Override
    public ResponseEntity<List<Asignatura>> getAll() {
        return null;
    }

    @Override
    public ResponseEntity<Asignatura> getById(@RequestParam(value = "id")Integer id) {
        return null;
    }

    @Override
    public ResponseEntity<?> delete(@RequestParam(value = "id") Integer id) {
        return null;
    }
}
