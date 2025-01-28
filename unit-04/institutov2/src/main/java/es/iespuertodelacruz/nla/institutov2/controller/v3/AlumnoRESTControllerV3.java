package es.iespuertodelacruz.nla.institutov2.controller.v3;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IControllerV3;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/instituto/api/v3/alumnos")
@CrossOrigin
public class AlumnoRESTControllerV3 implements IControllerV3<AlumnoDTO, String> {

    @Autowired AlumnoService alumnoService;


    @PostMapping
    @Override
    public ResponseEntity<?> add(@RequestBody AlumnoDTO alumnoRecord) {
        if (alumnoRecord != null){
            Alumno aux = new Alumno();
            aux.setDni(alumnoRecord.dni());
            aux.setApellidos(alumnoRecord.apellidos());
            aux.setFechanacimiento(alumnoRecord.fechanacimiento());
            aux.setNombre(alumnoRecord.nombre());
            return ResponseEntity.ok(alumnoService.save(aux));
        }
        return null;
    }

    @PutMapping("/{id}")
    @Override
    public ResponseEntity<?> update(@RequestParam(value = "id") String id, @RequestBody AlumnoDTO alumnoRecord) {
        if (alumnoRecord != null){
            Alumno aux = new Alumno();
            aux.setDni(alumnoRecord.dni());
            aux.setApellidos(alumnoRecord.apellidos());
            aux.setFechanacimiento(alumnoRecord.fechanacimiento());
            aux.setNombre(alumnoRecord.nombre());
            return ResponseEntity.ok(alumnoService.update(aux));
        }

        return null;
    }


    @GetMapping
    @Override
    public ResponseEntity<List<AlumnoDTO>> getAll() {


        return ResponseEntity.ok(alumnoService.findAll().stream().map(alumno -> new AlumnoDTO(
                alumno.getDni(), alumno.getApellidos(), alumno.getFechanacimiento(),
                alumno.getNombre())).collect(Collectors.toList()));
    }
    @GetMapping("/{id}")
    @Override
    public ResponseEntity<AlumnoDTO> getById(@RequestParam(value = "id") String id) {
        Alumno aux = alumnoService.findById(id);

        if (aux != null){
            AlumnoDTO record = new AlumnoDTO(aux.getDni(),
                    aux.getApellidos(), aux.getFechanacimiento(), aux.getNombre());
            return ResponseEntity.ok(record);
        }

        return null;
    }

    @DeleteMapping("/{id}")
    @Override
    public ResponseEntity<?> delete(@RequestParam(value = "id") String id) {
        Logger logger = Logger.getLogger(Globals.LOGGER_ALUMNO);
        boolean deleted = alumnoService.delete(id);
        String message = "";
        int status = 0;

        if(deleted){
            message = "El alumno ha sido correcŧamente eliminado";
            status = 204;
            logger.info(message + ", status: " + status);
            return ResponseEntity.ok("message: " + message + "\n status: " + status);
        } else {
            message = "El alumno no ha sido eliminado";
            status = 500;
            logger.info(message + ", status: " + status);
            return ResponseEntity.ok("message: " + message + "\n status: " + status);
        }
    }
}
