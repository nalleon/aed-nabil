package es.iespuertodelacruz.nla.institutov2.controller.v2;

import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTO;
import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.web.bind.annotation.*;

import java.util.logging.Logger;
@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v2/alumnos")
public class AlumnoRESTControllerV2 {
    @Autowired
    AlumnoService service;
    @GetMapping("/{id}")
    public ResponseEntity<AlumnoDTO> getById(@RequestParam(value = "id")String id) {
        Logger logger = Logger.getLogger(Globals.LOGGER_ASIGNATURA);
        logger.info("Buscando el con el id: " + id);

        Authentication authentication = SecurityContextHolder.getContext().getAuthentication();
        String authenticatedUsername = null;

        if (authentication != null && authentication.getPrincipal() instanceof UserDetails) {
            authenticatedUsername = ((UserDetails) authentication.getPrincipal()).getUsername();
        }
        Alumno aux = service.findById(id);

        if (aux != null && authenticatedUsername != null &&
                authenticatedUsername.equals(aux.getDni())){

            AlumnoDTO dto = new AlumnoDTO(aux.getDni(),
                    aux.getApellidos(), aux.getFechanacimiento(), aux.getNombre());
            return ResponseEntity.ok(dto);
        }

        return ResponseEntity.status(HttpStatus.FORBIDDEN).build();
    }
}
