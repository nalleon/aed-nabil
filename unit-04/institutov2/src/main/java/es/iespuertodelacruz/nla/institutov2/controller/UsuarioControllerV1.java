package es.iespuertodelacruz.nla.institutov2.controller;

import java.util.List;
import java.util.UUID;

import es.iespuertodelacruz.nla.institutov2.dto.UsuarioRecord;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/api/v1/usuarios")
public class UsuarioControllerV1 {

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
    public Usuario crearUsuario(@RequestBody UsuarioRecord record) {
        Usuario u = new Usuario();
        u.setCorreo(record.correo());
        u.setFecha_creacion(record.fechaCreacion());
        u.setNombre(record.nombre());
        u.setPassword(record.password());
        u.setRol("ROLE_USER");
        String tokenDeVerificacion = UUID.randomUUID().toString();
        u.setToken_verificacion(tokenDeVerificacion);
        return usuarioRepository.save(u);
    }
}
