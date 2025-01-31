package es.iespuertodelacruz.nla.institutov2.controller.v3;

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

@RestController
@RequestMapping("/instituto/api/v3/asignaturas")
@CrossOrigin
public class AsignaturaRESTControllerV3{

    @Autowired
    AsignaturaService service;
    Logger logger = Logger.getLogger(Globals.LOGGER_ASIGNATURA);


    @PostMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> add(@RequestBody AsignaturaDTO dto) {
        if (dto == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "Datos de la asignatura inválidos", null));
        }

        Asignatura dbItem = service.findByNombreCurso(dto.nombre(), dto.curso());
        if (dbItem != null) {
            logger.info("La asignatura ya existe");
            return ResponseEntity.status(HttpStatus.NOT_FOUND)
                    .body(new ApiResponse<>(404, "Asignatura no encontrada", null));
        }


        Asignatura aux = new Asignatura();
        aux.setCurso(dto.curso());
        aux.setNombre(dto.nombre());

        service.save(aux);

        dbItem = service.findByNombreCurso(dto.nombre(), dto.curso());

        AsignaturaDTO result = new AsignaturaDTO(dto.curso(), dto.nombre());

        return ResponseEntity.status(HttpStatus.CREATED)
                .body(new ApiResponse<>(201, "Asignatura creada correctamente", result));
    }

    @PutMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> update(@RequestParam(value = "id") Integer id, @RequestBody AsignaturaDTO dto) {

        if (dto == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "Datos de la asignatura inválidos", null));
        }

        Asignatura dbItem = service.findById(id);
        if (dbItem == null) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND)
                    .body(new ApiResponse<>(404, "Asignatura no encontrada", null));
        }


        dbItem.setNombre(dto.nombre());
        dbItem.setCurso(dto.curso());

        service.update(dbItem);

        AsignaturaDTO result = new AsignaturaDTO(dto.curso(), dto.nombre());

        return ResponseEntity.ok(new ApiResponse<>(200, "Asignatura actualizado correctamente", result));

    }

    @GetMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
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
    @PreAuthorize("hasRol('ROLE_ADMIN')")
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
    @PreAuthorize("hasRole('ROLE_ADMIN')")
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

    @DeleteMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> delete(@RequestParam(value = "id") Integer id) {
        boolean deleted = service.delete(id);

        if (deleted) {
            String message = "La asignatura ha sido eliminada correctamente";
            logger.info(message + ", status: 204");
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, null));
        } else {
            String message = "Asignatura NO eliminada";
            logger.info(message + ", status: 500");
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, message, null));
        }
    }

    @DeleteMapping("nombre/{nombre}/curso/{curso}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> deleteByNombreCurso(@PathVariable(value = "nombre") String nombre, @PathVariable(value = "curso") String curso) {
        Asignatura aux = service.findByNombreCurso(nombre, curso);

        if(aux == null){
            ApiResponse<AsignaturaDTO> errorResponse = new ApiResponse<>(404, "Asignatura no encontrada", null);
            logger.info("No se ha encontrado la asignatura, status: 404");
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(errorResponse);
        }

        boolean deleted = service.delete(aux.getId());

        if (deleted) {
            String message = "La asignatura "+ nombre + "del curso " + curso +" sido eliminada correctamente";
            logger.info(message + ", status: 204");
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, null));
        } else {
            String message = "Asignatura NO eliminada";
            logger.info(message + ", status: 500");
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, message, null));
        }
    }
}
