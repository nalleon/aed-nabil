package es.iespuertodelacruz.nla.institutov2.controller.v3;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IController;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoRecord;
import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaRecord;
import es.iespuertodelacruz.nla.institutov2.dto.MatriculaRecord;
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
@RequestMapping("/instituto/api/v1/matriculas")
@CrossOrigin
public class MatriculaRESTControllerV3 implements IController<MatriculaRecord, Integer> {

    @Autowired
    MatriculaService service;

    @PostMapping
    @Override
    public ResponseEntity<?> add(@RequestBody MatriculaRecord matriculaRecord) {
        if (matriculaRecord != null){
            Matricula aux = getMatricula(matriculaRecord);

            return ResponseEntity.ok(service.save(aux));
        }
        return null;
    }

    private static Matricula getMatricula(MatriculaRecord matriculaRecord) {
        Matricula aux = new Matricula();
        aux.setYear(matriculaRecord.year());

        Alumno alumnoAux = new Alumno();
        alumnoAux.setDni(matriculaRecord.alumnoRecord().dni());
        alumnoAux.setApellidos(matriculaRecord.alumnoRecord().apellidos());
        alumnoAux.setFechanacimiento(matriculaRecord.alumnoRecord().fechanacimiento());
        alumnoAux.setNombre(matriculaRecord.alumnoRecord().nombre());

        aux.setAlumno(alumnoAux);

        List<Asignatura> asignaturaList = new ArrayList<>();
        for (AsignaturaRecord asignaturaRecord : matriculaRecord.listAsignaturas()){
            Asignatura asignaturaAux = new Asignatura();
            asignaturaAux.setId(asignaturaRecord.id());
            asignaturaAux.setNombre(asignaturaRecord.nombre());
            asignaturaAux.setCurso(asignaturaRecord.curso());
            asignaturaList.add(asignaturaAux);
        }
        aux.setAsignaturas(asignaturaList);
        return aux;
    }

    @PutMapping("/{id}")
    @Override
    public ResponseEntity<?> update(@RequestParam(value = "id") Integer id, @RequestBody MatriculaRecord matriculaRecord) {
        return null;
    }

    @GetMapping
    @Override
    public ResponseEntity<List<MatriculaRecord>> getAll() {
        return ResponseEntity.ok(service.findAll().stream().map(matricula ->
                getMatriculaRecord(matricula)).collect(Collectors.toList()));
    }

    @GetMapping("/{id}")
    @Override
    public ResponseEntity<MatriculaRecord> getById(@RequestParam(value = "id")Integer id) {
        Matricula aux = service.findById(id);
        Logger logger = Logger.getLogger(Globals.LOGGER_MATRICULA);
        logger.info("found");

        if (aux != null){
            MatriculaRecord record = getMatriculaRecord(aux);
            return ResponseEntity.ok(record);
        }

        return null;
    }

    private MatriculaRecord getMatriculaRecord(Matricula aux) {
        List<AsignaturaRecord> asignaturaList = new ArrayList<>();
        for (Asignatura asignatura : aux.getAsignaturas()){
            AsignaturaRecord asignaturaRecord = new AsignaturaRecord(
                    asignatura.getId(),
                    asignatura.getCurso(), asignatura.getNombre()
            );
            asignaturaList.add(asignaturaRecord);
        }


        AlumnoRecord alumnoRecord = new AlumnoRecord(aux.getAlumno().getDni(),
                aux.getAlumno().getApellidos(), aux.getAlumno().getFechanacimiento(),
                aux.getAlumno().getNombre());


        return new MatriculaRecord(
                aux.getYear(), asignaturaList, alumnoRecord);
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
