package es.iespuertodelacruz.nla.institutov2.controller.v2;

import es.iespuertodelacruz.nla.institutov2.controller.abstracts.MatriculaAbstractUtils;
import es.iespuertodelacruz.nla.institutov2.dto.MatriculaDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.services.MatriculaService;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;

@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v2/matriculas")
public class MatriculaRESTControllerV2 extends MatriculaAbstractUtils {
    @Autowired
    MatriculaService service;

    @GetMapping("/{id}")
    public ResponseEntity<MatriculaDTO> getById(@RequestParam(value = "id")Integer id) {
        Logger logger = Logger.getLogger(Globals.LOGGER_MATRICULA);
        logger.info("Buscando la matricula con el id: "+ id);

        Authentication authentication = SecurityContextHolder.getContext().getAuthentication();
        String authenticatedUsername = null;

        if (authentication != null && authentication.getPrincipal() instanceof UserDetails) {
            authenticatedUsername = ((UserDetails) authentication.getPrincipal()).getUsername();
        }

        Matricula aux = service.findById(id);

        if (aux != null && authenticatedUsername != null &&
                authenticatedUsername.equals(aux.getAlumno().getDni())){
            MatriculaDTO record = getMatriculaRecord(aux);
            return ResponseEntity.ok(record);
        }

        return ResponseEntity.status(HttpStatus.FORBIDDEN).build();
    }

    @GetMapping
    public ResponseEntity<List<MatriculaDTO>> getAll() {
        Object principal = SecurityContextHolder.getContext().getAuthentication().getPrincipal();
        String authenticatedUsername = ((UserDetails)principal).getUsername();

        List<Matricula> all = service.findAll();
        List<Matricula> filteredList = all.stream()
                .filter(u-> u.getAlumno().getDni().equals(authenticatedUsername))
                .toList();

        return ResponseEntity.ok(filteredList.stream().map(this::getMatriculaRecord).collect(Collectors.toList()));
    }


}
