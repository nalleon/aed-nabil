package es.iespuertodelacruz.nla.institutov2.controller.v3;

import java.util.Date;
import java.util.List;
import java.util.UUID;
import java.util.logging.Logger;
import java.util.stream.Collectors;

import es.iespuertodelacruz.nla.institutov2.dto.AsignaturaDTO;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioDTOV2V3;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioRegisterDTO;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioUpdateDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.services.UsuarioService;
import es.iespuertodelacruz.nla.institutov2.utils.ApiResponse;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v3/usuarios")
public class UsuarioRESTControllerV3  {

    /**
     * Properties
     */
    @Autowired
    private UsuarioService service;

    @Autowired
    private PasswordEncoder passwordEncoder;

    Logger logger = Logger.getLogger(Globals.LOGGER_USUARIO);


    @PostMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<ApiResponse<UsuarioDTOV2V3>> createUser(UsuarioRegisterDTO registerDTO, String rol) {
        if (registerDTO == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "El usuario no puede ser nulo", null));
        }

        try {
            Usuario usuario = new Usuario();
            usuario.setNombre(registerDTO.nombre());
            usuario.setPassword(passwordEncoder.encode(registerDTO.password()));
            usuario.setCorreo(registerDTO.correo());
            usuario.setFecha_creacion(new Date());
            usuario.setRol(rol);
            usuario.setToken_verificacion(UUID.randomUUID().toString());
            usuario.setVerificado(0);

            service.save(usuario);

            Usuario dbItem = service.findByNombre(registerDTO.nombre());

            UsuarioDTOV2V3 result = new UsuarioDTOV2V3(dbItem.getNombre(), dbItem.getCorreo());

            return ResponseEntity.status(HttpStatus.CREATED)
                    .body(new ApiResponse<>(201, "Usuario creado correctamente", result));

        } catch (RuntimeException e) {
            logger.info("Error al crear un nuevo usuario: " + e.getMessage());
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, "Error al intentar registrar el usuario", null));
        }
    }



    @GetMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
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

    @PutMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<ApiResponse<UsuarioDTOV2V3>> update(
            @PathVariable Integer id,
            @RequestBody UsuarioUpdateDTO registerDTO,
            @RequestBody String rol) {

        if (registerDTO == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "El usuario no puede ser nulo", null));
        }

        Usuario dbItem = service.findById(id);

        if (dbItem == null) {
            logger.info("El usuario con id " + id + " NO existe en BBDD");
            return ResponseEntity.status(HttpStatus.NOT_FOUND)
                    .body(new ApiResponse<>(404, "Usuario no encontrado", null));
        }

        try {

            dbItem.setPassword(passwordEncoder.encode(registerDTO.password()));
            dbItem.setCorreo(registerDTO.correo());
            dbItem.setRol(rol);

            service.update(dbItem);

            Usuario updatedDbItem = service.findByCorreo(registerDTO.correo());

            UsuarioDTOV2V3 result = new UsuarioDTOV2V3(updatedDbItem.getNombre(), updatedDbItem.getCorreo());

            return ResponseEntity.ok(new ApiResponse<>(200, "Usuario actualizado correctamente", result));

        } catch (RuntimeException e) {
            logger.info("Error al actualizar el usuario: " + e.getMessage());
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, "Error al intentar actualizar el usuario", null));
        }
    }

    @GetMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
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

    @GetMapping("nombre/{nombre}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
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
    @PreAuthorize("hasRol('ROLE_ADMIN')")
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

    
    @DeleteMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> delete(@PathVariable Integer id) {
        if(id == 1){
            return ResponseEntity.status(HttpStatus.FORBIDDEN).body(
                    new ApiResponse<>(403, "", null));
        }

        boolean deleted = service.delete(id);

        if (deleted) {
            String message = "Usuario eliminado correctamente";
            logger.info(message + ", status: 204");
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, null));
        } else {
            String message = "Usuario NO eliminado";
            logger.info(message + ", status: 500");
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, message, null));
        }
        
    }


}
