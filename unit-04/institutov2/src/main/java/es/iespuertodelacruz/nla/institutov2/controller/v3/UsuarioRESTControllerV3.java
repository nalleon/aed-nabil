package es.iespuertodelacruz.nla.institutov2.controller.v3;

import java.util.Date;
import java.util.List;
import java.util.UUID;
import java.util.logging.Logger;
import java.util.stream.Collectors;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IControllerV3;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioDTOV2V3;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioRegisterDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.security.AuthService;
import es.iespuertodelacruz.nla.institutov2.security.JwtService;
import es.iespuertodelacruz.nla.institutov2.services.UsuarioService;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;

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

    Logger logger = Logger.getLogger(Globals.LOGGER_ASIGNATURA);


    @PostMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> createUser(UsuarioRegisterDTO registerDTO, String rol) {
        if(registerDTO == null){
            return ResponseEntity.badRequest().body("Usuario null");
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

            return ResponseEntity.ok(result);

        } catch (RuntimeException e){
            logger.info("Error tratando de registrar un nuevo usuario: " + e);
            throw new RuntimeException(e);
        }
    }

    @PutMapping("/{id}")
    public ResponseEntity<?> update(@PathVariable Integer id, @RequestBody UsuarioRegisterDTO registerDTO,
                                    @RequestBody String rol) {
        if(registerDTO == null){
            return ResponseEntity.badRequest().body("Usuario null");
        }

        Usuario dbItem = service.findById(id);

        if(dbItem == null){
            logger.info("El usuario con nombre" + registerDTO.nombre() + " no existe en BBDD");
            return ResponseEntity.notFound().build();
        }

        try {
            Usuario usuarioEntity = new Usuario();
            usuarioEntity.setId(dbItem.getId());
            usuarioEntity.setNombre(dbItem.getNombre());
            usuarioEntity.setPassword(passwordEncoder.encode(registerDTO.password()));
            usuarioEntity.setCorreo(registerDTO.correo());
            usuarioEntity.setRol(rol);

            service.update(usuarioEntity);

            Usuario updatedDbItem = service.findByNombre(registerDTO.nombre());

            UsuarioDTOV2V3 result = new UsuarioDTOV2V3(updatedDbItem.getNombre(), updatedDbItem.getCorreo());

            return ResponseEntity.ok(result);

        } catch (RuntimeException e){
            logger.info("Error tratando de modificar un nuevo usuario: " + e);
            throw new RuntimeException(e);
        }
    }

    
    @GetMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<List<UsuarioDTOV2V3>> getAll() {
        return ResponseEntity.ok(service.findAll().stream().map(usuario ->
                new UsuarioDTOV2V3(usuario.getNombre(), usuario.getCorreo())).collect(Collectors.toList()));
    }

    @GetMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<UsuarioDTOV2V3> getById(@PathVariable Integer id) {
        Usuario aux = service.findById(id);
        if (aux != null){
            UsuarioDTOV2V3 dto =  new UsuarioDTOV2V3(aux.getNombre(), aux.getCorreo());
            return ResponseEntity.ok(dto);
        }

        return ResponseEntity.notFound().build();
    }

    @GetMapping("/{nombre}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<UsuarioDTOV2V3> getByNombre(@PathVariable String nombre) {
        Usuario aux = service.findByNombre(nombre);
        if (aux != null){
            UsuarioDTOV2V3 dto =  new UsuarioDTOV2V3(aux.getNombre(), aux.getCorreo());
            return ResponseEntity.ok(dto);
        }

        return ResponseEntity.notFound().build();
    }

    @GetMapping("/{correo}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<UsuarioDTOV2V3> getByCorreo(@PathVariable String correo) {
        Usuario aux = service.findByCorreo(correo);
        if (aux != null){
            UsuarioDTOV2V3 dto =  new UsuarioDTOV2V3(aux.getNombre(), aux.getCorreo());
            return ResponseEntity.ok(dto);
        }

        return ResponseEntity.notFound().build();
    }

    
    @DeleteMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> delete(@PathVariable Integer id) {
        service.delete(id);
        return ResponseEntity.noContent().build();
    }
}
