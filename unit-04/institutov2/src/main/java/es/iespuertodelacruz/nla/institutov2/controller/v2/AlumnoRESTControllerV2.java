package es.iespuertodelacruz.nla.institutov2.controller.v2;

import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTOV2;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTOV3;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoOutputDTOV3;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
import es.iespuertodelacruz.nla.institutov2.utils.ApiResponse;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v2/alumnos")
public class AlumnoRESTControllerV2 {
    @Autowired
    AlumnoService service;
    Logger logger = Logger.getLogger(Globals.LOGGER_ALUMNO);

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


    @GetMapping("/nombre/{nombre}")
    public  ResponseEntity<?> getByNombre(@PathVariable("nombre") String nombre) {
        List<AlumnoOutputDTOV3> filteredList = service.findByNombre(nombre).stream()
                .map(alumno -> new AlumnoOutputDTOV3(alumno.getDni(), alumno.getNombre(), alumno.getApellidos()))
                .toList();

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

}
