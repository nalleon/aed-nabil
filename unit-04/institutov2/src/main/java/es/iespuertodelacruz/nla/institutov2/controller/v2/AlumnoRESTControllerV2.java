package es.iespuertodelacruz.nla.institutov2.controller.v2;

import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTO;
import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioDTOV2V3;
import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
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
@RequestMapping("/instituto/api/v2/alumnos")
public class AlumnoRESTControllerV2 {
    @Autowired
    AlumnoService service;
    Logger logger = Logger.getLogger(Globals.LOGGER_ALUMNO);

    @GetMapping
    public ResponseEntity<List<AlumnoDTO>> getAll() {
        Object principal = SecurityContextHolder.getContext().getAuthentication().getPrincipal();
        String authenticatedUsername = ((UserDetails)principal).getUsername();

        List<Alumno> all = service.findAll();
        List<Alumno> filteredList = all.stream()
                .filter(u-> u.getNombre().equals(authenticatedUsername))
                .toList();

        return ResponseEntity.ok(filteredList.stream().map(alumno ->
                new AlumnoDTO(alumno.getDni(), alumno.getApellidos(), alumno.getFechanacimiento(), alumno.getNombre())
        ).collect(Collectors.toList()));
    }

    @GetMapping("/{id}")
    public ResponseEntity<AlumnoDTO> getById(@RequestParam(value = "id")String id) {
        logger.info("Buscando el con el dni: " + id);

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
