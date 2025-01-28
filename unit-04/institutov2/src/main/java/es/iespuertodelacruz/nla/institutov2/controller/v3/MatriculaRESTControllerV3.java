package es.iespuertodelacruz.nla.institutov2.controller.v3;

import es.iespuertodelacruz.nla.institutov2.controller.abstracts.MatriculaAbstractUtils;
import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IControllerV3;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTO;
import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
import es.iespuertodelacruz.nla.institutov2.dto.MatriculaDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.services.MatriculaService;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/instituto/api/v3/matriculas")
@CrossOrigin
public class MatriculaRESTControllerV3 extends MatriculaAbstractUtils implements IControllerV3<MatriculaDTO, Integer>  {

    @Autowired
    MatriculaService service;

    @PostMapping
    @Override
    public ResponseEntity<?> add(@RequestBody MatriculaDTO matriculaRecord) {
        if (matriculaRecord != null){
            Matricula aux = getMatricula(matriculaRecord);

            return ResponseEntity.ok(service.save(aux));
        }
        return null;
    }



    @PutMapping("/{id}")
    @Override
    public ResponseEntity<?> update(@RequestParam(value = "id") Integer id, @RequestBody MatriculaDTO matriculaRecord) {
        return null;
    }

    @GetMapping
    @Override
    public ResponseEntity<List<MatriculaDTO>> getAll() {
        return ResponseEntity.ok(service.findAll().stream().map(matricula ->
                getMatriculaRecord(matricula)).collect(Collectors.toList()));
    }

    @GetMapping("/{id}")
    @Override
    public ResponseEntity<MatriculaDTO> getById(@RequestParam(value = "id")Integer id) {
        Matricula aux = service.findById(id);
        Logger logger = Logger.getLogger(Globals.LOGGER_MATRICULA);
        logger.info("found");

        if (aux != null){
            MatriculaDTO record = getMatriculaRecord(aux);
            return ResponseEntity.ok(record);
        }

        return null;
    }



    @DeleteMapping("/{id}")
    @Override
    public ResponseEntity<?> delete(@RequestParam(value = "id") Integer id) {
        Logger logger = Logger.getLogger(Globals.LOGGER_MATRICULA);
        boolean deleted = service.delete(id);
        String message = "";
        int status = 0;

        if(deleted){
            message = "La matricula ha sido correcŧamente eliminada";
            status = 204;
            logger.info(message + ", status: " + status);
            return ResponseEntity.ok("message: " + message + "\nstatus: " + status);
        } else {
            message = "La matricula no ha sido eliminada";
            status = 500;
            logger.info(message + ", status: " + status);
            return ResponseEntity.ok("message: " + message + "\nstatus: " + status);
        }
    }
}
