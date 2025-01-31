package es.iespuertodelacruz.nla.institutov2.controller.v2;

import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.services.AsignaturaService;
import es.iespuertodelacruz.nla.institutov2.utils.ApiResponse;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v2/asignaturas")
public class AsignaturaRESTControllerV2  {

    @Autowired
    AsignaturaService service;
    Logger logger = Logger.getLogger(Globals.LOGGER_ASIGNATURA);

    @GetMapping
    public ResponseEntity<?> getAll() {
        List<AsignaturaDTO> filteredList =service.findAll().stream().map(
                        asignatura ->
                                new AsignaturaDTO(
                                        asignatura.getCurso(), asignatura.getNombre())
                )
                .collect(Collectors.toList());

        if (filteredList.isEmpty()) {
            String message = "No se encontraron asignaturas registradas";
            logger.info(message);
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, filteredList));
        }

        String message = "Lista de asignaturas obtenida correctamente";
        logger.info(message);
        return ResponseEntity.ok(new ApiResponse<>(200, message, filteredList));
    }

    @GetMapping("/{id}")
    public  ResponseEntity<?> getById(@RequestParam(value = "id") Integer id) {
        Asignatura aux = service.findById(id);

        if (aux != null){
            AsignaturaDTO dto = new AsignaturaDTO(aux.getCurso(), aux.getNombre());
            logger.info("Asignatura encontrada, status: 204");
            ApiResponse<AsignaturaDTO> response = new ApiResponse<>(200, "Asignatura encontrada", dto);
            return ResponseEntity.ok(response);
        }

        ApiResponse<AsignaturaDTO> errorResponse = new ApiResponse<>(404, "Asignatura no encontrada", null);
        logger.info("No se ha encontrado la asignatura, status: 404");
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body(errorResponse);
    }


    @GetMapping("/{nombre}/{curso}")
    public  ResponseEntity<?> getByNombreCurso(@RequestParam(value = "nombre") String nombre, @RequestParam(value = "curso") String curso) {
        Asignatura aux = service.findByNombreCurso(nombre, curso);

        if (aux != null){
            AsignaturaDTO dto = new AsignaturaDTO(aux.getCurso(), aux.getNombre());
            logger.info("Asignatura encontrada, status: 204");
            ApiResponse<AsignaturaDTO> response = new ApiResponse<>(200, "Asignatura encontrada", dto);
            return ResponseEntity.ok(response);
        }

        ApiResponse<AsignaturaDTO> errorResponse = new ApiResponse<>(404, "Asignatura no encontrada", null);
        logger.info("No se ha encontrado la asignatura, status: 404");
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body(errorResponse);
    }
}
