package es.iespuertodelacruz.nla.institutov2.controller.v3;

import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTOV3;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/instituto/api/v3/alumnos")
@CrossOrigin
public class AlumnoRESTControllerV3 {

    @Autowired AlumnoService alumnoService;

    private final String RUTA_FOTOS = "uploads/fotos/";

    @PostMapping(consumes = {MediaType.MULTIPART_FORM_DATA_VALUE})
    @Api(value = "Agregar un nuevo alumno con foto", consumes = "multipart/form-data")
    public ResponseEntity<?> add(@RequestPart(value = "alumno") AlumnoDTOV3 dto,
                                 @RequestPart(value = "foto", required = false)
                                 MultipartFile foto) throws IOException {
        if (dto == null){
            return null;
        }
        System.out.println("pruebita");
            Alumno aux = new Alumno();
            aux.setDni(dto.dni());
            aux.setApellidos(dto.apellidos());
            aux.setFechanacimiento(dto.fechanacimiento());
            aux.setNombre(dto.nombre());
            if(foto != null && !foto.isEmpty()){
                String nombreArchivo = dto.dni() + "_" + foto.getOriginalFilename();
                Path rutaFoto = Paths.get(RUTA_FOTOS + nombreArchivo);
                Files.createDirectories(rutaFoto.getParent());
                Files.write(rutaFoto, foto.getBytes());

                aux.setPath_foto(rutaFoto.toString());
            }

            return ResponseEntity.ok(alumnoService.save(aux));

    }

    @PutMapping("/{id}")
    public ResponseEntity<?> update(@RequestParam(value = "id") String id, @RequestBody AlumnoDTOV3 dto) {
        if (dto != null){
            Alumno aux = new Alumno();
            aux.setDni(dto.dni());
            aux.setApellidos(dto.apellidos());
            aux.setFechanacimiento(dto.fechanacimiento());
            aux.setNombre(dto.nombre());
            return ResponseEntity.ok(alumnoService.update(aux));
        }

        return null;
    }


    @GetMapping
    public ResponseEntity<List<AlumnoDTOV3>> getAll() {


        return ResponseEntity.ok(alumnoService.findAll().stream().map(alumno -> new AlumnoDTOV3(
                alumno.getDni(), alumno.getApellidos(), alumno.getFechanacimiento(),
                alumno.getNombre())).collect(Collectors.toList()));
    }
    @GetMapping("/{id}")
    public ResponseEntity<AlumnoDTOV3> getById(@RequestParam(value = "id") String id) {
        Alumno aux = alumnoService.findById(id);

        if (aux != null){
            AlumnoDTOV3 record = new AlumnoDTOV3(aux.getDni(),
                    aux.getApellidos(), aux.getFechanacimiento(), aux.getNombre());
            return ResponseEntity.ok(record);
        }

        return null;
    }

    @DeleteMapping("/{id}")
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
