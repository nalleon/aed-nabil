package es.iespuertodelacruz.nla.institutov2.controller.v3;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IControllerV3;
import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
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
@RequestMapping("/instituto/api/v3/asignaturas")
@CrossOrigin
public class AsignaturaRESTControllerV3 implements IControllerV3<AsignaturaDTO, Integer> {

    @Autowired
    AsignaturaService service;

    @PostMapping
    @Override
    public ResponseEntity<?> add(@RequestBody AsignaturaDTO asignaturaRecord) {
        if (asignaturaRecord != null){
            Asignatura aux = new Asignatura();
            aux.setId(asignaturaRecord.id());
            aux.setNombre(asignaturaRecord.nombre());
            aux.setCurso(asignaturaRecord.curso());
            Asignatura result = service.save(aux);

            //return ResponseEntity.ok();
        }
        return null;
    }

    @PutMapping("/{id}")
    @Override
    public ResponseEntity<?> update(@RequestParam(value = "id") Integer id, @RequestBody AsignaturaDTO asignaturaRecord) {
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
    public ResponseEntity<List<AsignaturaDTO>> getAll() {
        Logger logger = Logger.getLogger(Globals.LOGGER_ASIGNATURA);
        logger.info("Buscando a todos los alumnos");
        return ResponseEntity.ok(service.findAll().stream().map(asignatura -> new AsignaturaDTO(
                asignatura.getId(), asignatura.getCurso(), asignatura.getNombre()))
                .collect(Collectors.toList()));
    }
    @GetMapping("/{id}")
    @Override
    public ResponseEntity<AsignaturaDTO> getById(@RequestParam(value = "id")Integer id) {
        Asignatura aux = service.findById(id);

        if (aux != null){
            AsignaturaDTO record = new AsignaturaDTO(aux.getId(),
                    aux.getCurso(), aux.getNombre());
            return ResponseEntity.ok(record);
        }

        return null;
    }

    @DeleteMapping("/{id}")
    @Override
    public ResponseEntity<?> delete(@RequestParam(value = "id") Integer id) {
        Logger logger = Logger.getLogger(Globals.LOGGER_ASIGNATURA);
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
