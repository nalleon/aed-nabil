package es.iespuertodelacruz.nla.institutov2.controller.v3;

import es.iespuertodelacruz.nla.institutov2.controller.abstracts.MatriculaAbstractUtils;
import es.iespuertodelacruz.nla.institutov2.dto.MatriculaOutputDTO;
import es.iespuertodelacruz.nla.institutov2.dto.MatriculaInputDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.services.MatriculaService;
import es.iespuertodelacruz.nla.institutov2.utils.ApiResponse;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.logging.Logger;

@RestController
@RequestMapping("/instituto/api/v3/matriculas")
@CrossOrigin
public class MatriculaRESTControllerV3 extends MatriculaAbstractUtils  {

    @Autowired
    MatriculaService service;
    Logger logger = Logger.getLogger(Globals.LOGGER_MATRICULA);


    @PostMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> add(@RequestBody MatriculaInputDTO dto) {
        if (dto == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "Datos de la matricula inválidos", null));
        }


        Matricula aux = getMatriculaEntity(dto);
        Matricula saved = service.save(aux);
        MatriculaOutputDTO result = getMatriculaDTO(saved);


        return ResponseEntity.status(HttpStatus.CREATED)
                .body(new ApiResponse<>(201, "MAtricula creada correctamente", result));
    }



    @PutMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> update(@RequestParam(value = "id") Integer id, @RequestBody MatriculaInputDTO dto) {
        if (dto == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "La matricula no puede ser nula", null));
        }

        try {
            Matricula aux = getMatriculaEntity(dto);
            aux.setId(id);
            service.update(aux);

            Matricula dbItem = service.findById(id);
            
            MatriculaOutputDTO result = getMatriculaDTO(dbItem);


            return ResponseEntity.ok(new ApiResponse<>(200, "Matricula actualizada correctamente", result));

        } catch (RuntimeException e) {
            logger.info("Error al actualizar la matricula: " + e.getMessage());
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, "Error al intentar actualizar la matricula", null));
        }
    }


    @GetMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> getAll() {
        List<MatriculaOutputDTO> filteredList = service.findAll().stream().map(
                this::getMatriculaDTO).toList();

        if (filteredList.isEmpty()) {
            String message = "No se encontraron matriculas registradas";
            logger.info(message);
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, filteredList));
        }

        String message = "Lista de matriculas obtenida correctamente";
        logger.info(message);
        return ResponseEntity.ok(new ApiResponse<>(200, message, filteredList));
    }

    @GetMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> getById(@RequestParam(value = "id")Integer id) {
        Matricula aux = service.findById(id);

        if (aux != null){
            MatriculaOutputDTO dto = getMatriculaDTO(aux);
            logger.info("Matricula encontrada, status: 204");
            ApiResponse<MatriculaOutputDTO> response = new ApiResponse<>(200, "Asignatura encontrada", dto);
            return ResponseEntity.ok(response);
        }

        ApiResponse<MatriculaOutputDTO> errorResponse = new ApiResponse<>(404, "Asignatura no encontrada", null);
        logger.info("No se ha encontrado la Matricula, status: 404");
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body(errorResponse);
    }



    @DeleteMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> delete(@RequestParam(value = "id") Integer id) {
        boolean deleted = service.delete(id);

        if (deleted) {
            String message = "La matricula ha sido eliminada correctamente";
            logger.info(message + ", status: 204");
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, null));
        } else {
            String message = "Matricula NO eliminada";
            logger.info(message + ", status: 500");
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, message, null));
        }
    }
}
