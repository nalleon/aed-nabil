package es.iespuertodelacruz.nla.institutov2.controller.v3;

import com.fasterxml.jackson.databind.ObjectMapper;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTOV2;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTOV3;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
import es.iespuertodelacruz.nla.institutov2.utils.ApiResponse;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
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

    @Autowired AlumnoService service;
    Logger logger = Logger.getLogger(Globals.LOGGER_ALUMNO);


    private final String RUTA_FOTOS = "uploads/fotos/";

    @PostMapping(consumes = {MediaType.MULTIPART_FORM_DATA_VALUE})
    public ResponseEntity<ApiResponse<AlumnoDTOV2>> add(
            @RequestPart(value = "alumno") String alumnoJSON,
            @RequestPart(value = "foto", required = false) MultipartFile foto) throws IOException {

        if (alumnoJSON == null || alumnoJSON.isEmpty()) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "El objeto alumno no puede estar vacío", null));
        }

        ObjectMapper objectMapper = new ObjectMapper();
        AlumnoDTOV3 dto;

        try {
            dto = objectMapper.readValue(alumnoJSON, AlumnoDTOV3.class);
        } catch (Exception e) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "Error al procesar el JSON del alumno", null));
        }

        if (dto == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "Datos del alumno inválidos", null));
        }

        if (service.findById(dto.dni()) != null) {
            return ResponseEntity.status(HttpStatus.CONFLICT)
                    .body(new ApiResponse<>(409, "El alumno con este DNI ya existe", null));
        }

        Alumno aux = new Alumno();
        aux.setDni(dto.dni());
        aux.setApellidos(dto.apellidos());
        aux.setFechanacimiento(dto.fechanacimiento());
        aux.setNombre(dto.nombre());

        if (foto != null && !foto.isEmpty()) {
            String nombreArchivo = dto.dni() + "_foto";
            Path rutaFoto = Paths.get(RUTA_FOTOS, nombreArchivo);
            Files.createDirectories(rutaFoto.getParent());
            Files.write(rutaFoto, foto.getBytes());

            aux.setPath_foto(rutaFoto.toString());
        }

        Alumno saved = service.save(aux);
        AlumnoDTOV2 result = new AlumnoDTOV2(saved.getNombre(), saved.getApellidos());

        return ResponseEntity.status(HttpStatus.CREATED)
                .body(new ApiResponse<>(201, "Alumno creado correctamente", result));
    }


    @PutMapping("/{id}")
    public ResponseEntity<ApiResponse<AlumnoDTOV2>> update(
            @PathVariable("id") String id,
            @RequestPart(value = "alumno") String alumnoJSON,
            @RequestPart(value = "foto", required = false) MultipartFile foto) throws IOException {

        if (alumnoJSON == null || alumnoJSON.isEmpty()) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "El objeto alumno no puede estar vacío", null));
        }

        ObjectMapper objectMapper = new ObjectMapper();
        AlumnoDTOV3 dto;
        try {
            dto = objectMapper.readValue(alumnoJSON, AlumnoDTOV3.class);
        } catch (Exception e) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "Error al procesar el JSON del alumno", null));
        }

        if (dto == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "Datos del alumno inválidos", null));
        }

        Alumno dbItem = service.findById(id);
        if (dbItem == null) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND)
                    .body(new ApiResponse<>(404, "Alumno no encontrado", null));
        }

        dbItem.setApellidos(dto.apellidos());
        dbItem.setFechanacimiento(dto.fechanacimiento());
        dbItem.setNombre(dto.nombre());

        if (foto != null && !foto.isEmpty()) {
            String nombreArchivo = dto.dni() + "_foto";
            Path rutaFoto = Paths.get(RUTA_FOTOS, nombreArchivo);
            Files.createDirectories(rutaFoto.getParent());
            Files.write(rutaFoto, foto.getBytes());

            dbItem.setPath_foto(rutaFoto.toString());
        }

        service.update(dbItem);

        AlumnoDTOV2 result = new AlumnoDTOV2(dbItem.getNombre(), dbItem.getApellidos());

        return ResponseEntity.ok(new ApiResponse<>(200, "Alumno actualizado correctamente", result));
    }



    @GetMapping
    public ResponseEntity<?> getAll() {
        List<AlumnoDTOV2> filteredList = service.findAll().stream()
                .map(alumno -> new AlumnoDTOV2(alumno.getNombre(), alumno.getApellidos()))
                .collect(Collectors.toList());

        if (filteredList.isEmpty()) {
            String message = "No se encontraron alumnos registrados";
            logger.info(message);
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, filteredList));
        }

        String message = "Lista de alumnos obtenida correctamente";
        logger.info(message);
        return ResponseEntity.ok(new ApiResponse<>(200, message, filteredList));
    }

    @GetMapping("/{id}")
    public  ResponseEntity<?> getById(@RequestParam(value = "id") String id) {
        Alumno aux = service.findById(id);

        if (aux != null){
            AlumnoDTOV2 dto = new AlumnoDTOV2(aux.getNombre(),
                    aux.getApellidos());
            ApiResponse<AlumnoDTOV2> response = new ApiResponse<>(200, "Alumno encontrado", dto);
            return ResponseEntity.ok(response);
        }

        ApiResponse<AlumnoDTOV2> errorResponse = new ApiResponse<>(404, "Alumno no encontrado", null);
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body(errorResponse);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<?> delete(@RequestParam(value = "id") String id) {
        boolean deleted = service.delete(id);

        if (deleted) {
            String message = "El alumno ha sido eliminado correctamente";
            logger.info(message + ", status: 204");
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, null));
        } else {
            String message = "El alumno no ha sido eliminado, puede que no exista";
            logger.info(message + ", status: 500");
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, message, null));
        }
    }
}
