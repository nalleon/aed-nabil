package es.iespuertodelacruz.nla.institutov2.controller.v2;

import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;

import es.iespuertodelacruz.nla.institutov2.dto.UsuarioDTOV2V3;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.services.UsuarioService;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.web.bind.annotation.*;

@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v2/usuarios")
public class UsuarioRESTControllerV2 {
    Logger logger = Logger.getLogger(Globals.LOGGER_MATRICULA);

    @Autowired
    private UsuarioService service;

    @GetMapping

    public ResponseEntity<List<UsuarioDTOV2V3>> getAll() {
        Object principal = SecurityContextHolder.getContext().getAuthentication().getPrincipal();
        String authenticatedUsername = ((UserDetails)principal).getUsername();

        List<Usuario> all = service.findAll();
        List<Usuario> filteredList = all.stream()
                .filter(u-> u.getNombre().equals(authenticatedUsername))
                .toList();

        return ResponseEntity.ok(filteredList.stream().map(usuario ->
                new UsuarioDTOV2V3(usuario.getNombre(), usuario.getCorreo())).collect(Collectors.toList()));
    }


    @GetMapping("/{id}")
    public ResponseEntity<UsuarioDTOV2V3> getById(@RequestParam(value = "id")Integer id) {
        logger.info("Buscando su id: "+ id);

        Authentication authentication = SecurityContextHolder.getContext().getAuthentication();
        String authenticatedUsername = null;

        if (authentication != null && authentication.getPrincipal() instanceof UserDetails) {
            authenticatedUsername = ((UserDetails) authentication.getPrincipal()).getUsername();
        }

        Usuario aux = service.findById(id);

        if (aux != null && authenticatedUsername != null &&
                authenticatedUsername.equals(aux.getNombre())){

            UsuarioDTOV2V3 dto = new UsuarioDTOV2V3(aux.getNombre(), aux.getCorreo());

            return ResponseEntity.ok(dto);
        }

        return ResponseEntity.status(HttpStatus.FORBIDDEN).build();
    }

}
