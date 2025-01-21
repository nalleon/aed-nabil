package es.iespuertodelacruz.nla.institutov2.controller;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IController;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoRecord;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.List;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/instituto/api/v1/alumnos")
@CrossOrigin
public class AlumnoRESTController implements IController<AlumnoRecord, String> {

    @Autowired AlumnoService alumnoService;


    @PostMapping
    @Override
    public ResponseEntity<?> add(@RequestBody AlumnoRecord alumnoRecord) {
        if (alumnoRecord != null){
            Alumno aux = new Alumno();
            aux.setDni(alumnoRecord.dni());
            aux.setApellidos(alumnoRecord.apellidos());
            aux.setFechanacimiento(alumnoRecord.fechanacimiento());
            aux.setMatriculas(alumnoRecord.matriculas());
            aux.setNombre(alumnoRecord.nombre());
            return ResponseEntity.ok(alumnoService.save(aux));
        }
        return null;
    }

    @PutMapping
    @Override
    public ResponseEntity<?> update(@RequestParam(value = "id") String id, @RequestBody AlumnoRecord alumnoRecord) {
        if (alumnoRecord != null){
            Alumno aux = new Alumno();
            aux.setDni(alumnoRecord.dni());
            aux.setApellidos(alumnoRecord.apellidos());
            aux.setFechanacimiento(alumnoRecord.fechanacimiento());
            aux.setMatriculas(alumnoRecord.matriculas());
            aux.setNombre(alumnoRecord.nombre());
            return ResponseEntity.ok(alumnoService.update(aux));
        }

        return null;
    }


    @GetMapping
    @Override
    public ResponseEntity<List<AlumnoRecord>> getAll() {
        return ResponseEntity.ok(alumnoService.findAll().stream().map(alumno -> new AlumnoRecord(
                alumno.getDni(), alumno.getApellidos(), alumno.getFechanacimiento(),
                alumno.getNombre(),alumno.getMatriculas())).collect(Collectors.toList()));
    }
    @GetMapping("/{id}")
    @Override
    public ResponseEntity<AlumnoRecord> getById(@RequestParam(value = "id") String id) {
        Alumno aux = alumnoService.findById(id);

        if (aux != null){
            AlumnoRecord record = new AlumnoRecord(aux.getDni(),
                    aux.getApellidos(), aux.getFechanacimiento(), aux.getNombre(), aux.getMatriculas());
            return ResponseEntity.ok(record);
        }

        return null;
    }

    @DeleteMapping("/{id}")
    @Override
    public ResponseEntity<?> delete(@RequestParam(value = "id") String id) {
        boolean deleted = alumnoService.delete(id);
        String message = "";
        int status = 0;

        if(deleted){
            message = "El alumno ha sido correcŧamente eliminado";
            status = 204;
            return ResponseEntity.ok("message: " + message + "\n status: " + status);
        } else {
            message = "El alumno no ha sido eliminado";
            status = 500;
            return ResponseEntity.ok("message: " + message + "\n status: " + status);
        }
    }
}
