package es.iespuertodelacruz.nla.institutov2.controller;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IController;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoRecord;
import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaRecord;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.services.AsignaturaService;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/instituto/api/v1/asignaturas")
@CrossOrigin
public class AsignaturaRESTController implements IController<AsignaturaRecord, Integer> {

    @Autowired
    AsignaturaService service;

    @PostMapping
    @Override
    public ResponseEntity<?> add(@RequestBody AsignaturaRecord asignaturaRecord) {
        if (asignaturaRecord != null){
            Asignatura aux = new Asignatura();
            aux.setId(asignaturaRecord.id());
            aux.setNombre(asignaturaRecord.nombre());
            aux.setCurso(asignaturaRecord.curso());
            return ResponseEntity.ok(service.save(aux));
        }
        return null;
    }

    @PutMapping("/{id}")
    @Override
    public ResponseEntity<?> update(@RequestParam(value = "id") Integer id, @RequestBody AsignaturaRecord asignaturaRecord) {
        if (asignaturaRecord != null){
            Asignatura aux = new Asignatura();
            aux.setId(asignaturaRecord.id());
            aux.setNombre(asignaturaRecord.nombre());
            aux.setCurso(asignaturaRecord.curso());
            return ResponseEntity.ok(service.update(aux));
        }
        return null;
    }

    @GetMapping
    @Override
    public ResponseEntity<List<AsignaturaRecord>> getAll() {
        return ResponseEntity.ok(service.findAll().stream().map(asignatura -> new AsignaturaRecord(
                asignatura.getId(), asignatura.getCurso(), asignatura.getNombre()))
                .collect(Collectors.toList()));
    }
    @GetMapping("/{id}")
    @Override
    public ResponseEntity<AsignaturaRecord> getById(@RequestParam(value = "id")Integer id) {
        Asignatura aux = service.findById(id);

        if (aux != null){
            AsignaturaRecord record = new AsignaturaRecord(aux.getId(),
                    aux.getCurso(), aux.getNombre());
            return ResponseEntity.ok(record);
        }

        return null;
    }

    @DeleteMapping("/{id}")
    @Override
    public ResponseEntity<?> delete(@RequestParam(value = "id") Integer id) {
        Logger logger = Logger.getLogger(Globals.LOGGER_ALUMNO);
        boolean deleted = service.delete(id);
        String message = "";
        int status = 0;

        if(deleted){
            message = "La asignatura ha sido correcŧamente eliminado";
            status = 204;
            logger.info(message + ", status: " + status);
            return ResponseEntity.ok("message: " + message + "\n status: " + status);
        } else {
            message = "La asignatura no ha sido eliminado";
            status = 500;
            logger.info(message + ", status: " + status);
            return ResponseEntity.ok("message: " + message + "\n status: " + status);
        }
    }
}
