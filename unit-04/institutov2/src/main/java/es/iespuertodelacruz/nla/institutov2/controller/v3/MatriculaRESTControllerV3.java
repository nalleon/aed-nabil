package es.iespuertodelacruz.nla.institutov2.controller.v3;

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
public class MatriculaRESTControllerV3 implements IControllerV3<MatriculaDTO, Integer> {

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

    private static Matricula getMatricula(MatriculaDTO matriculaRecord) {
        Matricula aux = new Matricula();
        aux.setYear(matriculaRecord.year());

        Alumno alumnoAux = new Alumno();
        alumnoAux.setDni(matriculaRecord.alumnoRecord().dni());
        alumnoAux.setApellidos(matriculaRecord.alumnoRecord().apellidos());
        alumnoAux.setFechanacimiento(matriculaRecord.alumnoRecord().fechanacimiento());
        alumnoAux.setNombre(matriculaRecord.alumnoRecord().nombre());

        aux.setAlumno(alumnoAux);

        List<Asignatura> asignaturaList = new ArrayList<>();
        for (AsignaturaDTO asignaturaRecord : matriculaRecord.listAsignaturas()){
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

    private MatriculaDTO getMatriculaRecord(Matricula aux) {
        List<AsignaturaDTO> asignaturaList = new ArrayList<>();
        for (Asignatura asignatura : aux.getAsignaturas()){
            AsignaturaDTO asignaturaRecord = new AsignaturaDTO(
                    asignatura.getId(),
                    asignatura.getCurso(), asignatura.getNombre()
            );
            asignaturaList.add(asignaturaRecord);
        }


        AlumnoDTO alumnoRecord = new AlumnoDTO(aux.getAlumno().getDni(),
                aux.getAlumno().getApellidos(), aux.getAlumno().getFechanacimiento(),
                aux.getAlumno().getNombre());


        return new MatriculaDTO(
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
