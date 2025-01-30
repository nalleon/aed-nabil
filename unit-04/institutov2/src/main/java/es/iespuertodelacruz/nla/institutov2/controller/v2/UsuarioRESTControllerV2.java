package es.iespuertodelacruz.nla.institutov2.controller.v2;

import java.util.List;
import java.util.Map;
import java.util.logging.Logger;
import java.util.stream.Collectors;

import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioDTOV2V3;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioUpdateDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.security.JwtService;
import es.iespuertodelacruz.nla.institutov2.services.UsuarioService;
import es.iespuertodelacruz.nla.institutov2.utils.ApiResponse;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import jakarta.servlet.http.HttpServletRequest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;

import static es.iespuertodelacruz.nla.institutov2.security.JwtFilter.authHeader;
import static es.iespuertodelacruz.nla.institutov2.security.JwtFilter.authHeaderTokenPrefix;

@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v2/usuarios")
public class UsuarioRESTControllerV2 {
    Logger logger = Logger.getLogger(Globals.LOGGER_USUARIO);

    @Autowired
    private UsuarioService service;
    @Autowired
    private PasswordEncoder passwordEncoder;

    @Autowired
    private JwtService jwtTokenManager;

    @GetMapping
    @PreAuthorize("hasRole('ROLE_ADMIN') or hasRole('ROLE_USER')")
    public ResponseEntity<?> getAll() {
        List<UsuarioDTOV2V3> filteredList = service.findAll().stream().map(usuario ->
                new UsuarioDTOV2V3(usuario.getNombre(), usuario.getCorreo())).collect(Collectors.toList());

        if (filteredList.isEmpty()) {
            String message = "NO se encontraron usuarios registrados";
            logger.info(message);
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, filteredList));
        }

        String message = "Lista de usuarios obtenida correctamente";
        logger.info(message);
        return ResponseEntity.ok(new ApiResponse<>(200, message, filteredList));
    }

    @GetMapping("/{id}")
    @PreAuthorize("hasRole('ROLE_ADMIN') or hasRole('ROLE_USER')")
    public ResponseEntity<?> getById(@PathVariable Integer id) {
        Usuario aux = service.findById(id);
        if (aux != null){
            UsuarioDTOV2V3 dto =  new UsuarioDTOV2V3(aux.getNombre(), aux.getCorreo());
            logger.info("Usuario encontrado, status: 204");
            ApiResponse<UsuarioDTOV2V3> response = new ApiResponse<>(200, "Usuario encontrado", dto);
            return ResponseEntity.ok(response);
        }

        ApiResponse<AsignaturaDTO> errorResponse = new ApiResponse<>(404, "Usuario NO encontrado", null);
        logger.info("Usuario NO encontrado, status: 404");
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body(errorResponse);
    }

    @GetMapping("/nombre/{nombre}")
    @PreAuthorize("hasRole('ROLE_ADMIN') or hasRole('ROLE_USER')")
    public ResponseEntity<?> getByNombre(@PathVariable String nombre) {
        Usuario aux = service.findByNombre(nombre);

        if (aux != null){
            UsuarioDTOV2V3 dto =  new UsuarioDTOV2V3(aux.getNombre(), aux.getCorreo());

            logger.info("Usuario encontrado, status: 204");
            ApiResponse<UsuarioDTOV2V3> response = new ApiResponse<>(200, "Usuario encontrado", dto);
            return ResponseEntity.ok(response);
        }

        ApiResponse<AsignaturaDTO> errorResponse = new ApiResponse<>(404, "Usuario NO encontrado", null);
        logger.info("Usuario NO encontrado, status: 404");
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body(errorResponse);
    }

    @GetMapping("correo/{correo}")
    @PreAuthorize("hasRole('ROLE_ADMIN') or hasRole('ROLE_USER')")
    public ResponseEntity<?> getByCorreo(@PathVariable String correo) {
        Usuario aux = service.findByCorreo(correo);
        if (aux != null){
            UsuarioDTOV2V3 dto =  new UsuarioDTOV2V3(aux.getNombre(), aux.getCorreo());

            logger.info("Usuario encontrado, status: 204");
            ApiResponse<UsuarioDTOV2V3> response = new ApiResponse<>(200, "Usuario encontrado", dto);
            return ResponseEntity.ok(response);
        }

        ApiResponse<AsignaturaDTO> errorResponse = new ApiResponse<>(404, "Usuario NO encontrado", null);
        logger.info("Usuario NO encontrado, status: 404");
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body(errorResponse);
    }

    @PutMapping("/{id}")
    @PreAuthorize("hasRole('ROLE_ADMIN') or hasRole('ROLE_USER')")
    public ResponseEntity<?> update(
            @PathVariable Integer id,
            @RequestBody UsuarioUpdateDTO dto,
            HttpServletRequest request) {

        if (dto == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "El usuario no puede ser nulo", null));
        }

        String header = request.getHeader(authHeader);

        String auxNombre = "";
        if (header != null && header.startsWith(authHeaderTokenPrefix)) {
            String token = header.substring(authHeaderTokenPrefix.length());
            Map<String, String> mapInfoToken = jwtTokenManager.validateAndGetClaims(token);
            auxNombre = mapInfoToken.get("username");
        }

        Usuario dbItem = service.findById(id);

        if (dbItem == null) {
            logger.info("El usuario con id " + id + " NO existe en BBDD");
            return ResponseEntity.status(HttpStatus.NOT_FOUND)
                    .body(new ApiResponse<>(404, "Usuario no encontrado", null));
        }

        if(!auxNombre.equals(dbItem.getNombre())) {
            logger.info("El usuario con id " + id + " NO puede modificar a otro");
            return ResponseEntity.status(HttpStatus.FORBIDDEN)
                    .body(new ApiResponse<>(403, "Permiso denegado", null));
        }

        try {

            dbItem.setPassword(passwordEncoder.encode(dto.password()));
            dbItem.setCorreo(dto.correo());

            service.update(dbItem);

            Usuario updatedDbItem = service.findByCorreo(dto.correo());

            UsuarioDTOV2V3 result = new UsuarioDTOV2V3(updatedDbItem.getNombre(), updatedDbItem.getCorreo());

            return ResponseEntity.ok(new ApiResponse<>(200, "Usuario actualizado correctamente", result));

        } catch (RuntimeException e) {
            logger.info("Error al actualizar el usuario: " + e.getMessage());
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, "Error al intentar actualizar el usuario", null));
        }

    }
}
