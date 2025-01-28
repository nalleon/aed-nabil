package es.iespuertodelacruz.nla.institutov2.controller.v1;

import java.util.Date;
import java.util.List;
import java.util.UUID;

import es.iespuertodelacruz.nla.institutov2.dto.UsuarioDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/instituto/api/v1/usuarios")
@CrossOrigin
public class UsuarioRESTControllerV1 {

    @Autowired
    private IUsuarioRepository usuarioRepository;

    @GetMapping
    //@PreAuthorize("hasRole('ROLE_ADMIN')")
    public ResponseEntity<?> listarUsuarios() {

        List<Usuario> findAll = usuarioRepository.findAll();

        //List<UsuarioDTO> allDTO = UsuarioMapper.INSTANCE.toDTOList(findAll);
        return ResponseEntity.ok(findAll);
    }

    @PostMapping
    public Usuario crearUsuario(@RequestBody UsuarioDTO record) {
        Usuario u = new Usuario();
        u.setCorreo(record.correo());
        u.setFecha_creacion(new Date());
        u.setNombre(record.nombre());
        u.setPassword(record.password());
        u.setRol("ROLE_USER");
        String tokenDeVerificacion = UUID.randomUUID().toString();
        u.setToken_verificacion(tokenDeVerificacion);
        return usuarioRepository.save(u);
    }
}
