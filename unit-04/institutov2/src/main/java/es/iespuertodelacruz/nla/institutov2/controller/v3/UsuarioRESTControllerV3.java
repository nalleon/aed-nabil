package es.iespuertodelacruz.nla.institutov2.controller.v3;

import java.util.List;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IController;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v3/usuarios")
public class UsuarioRESTControllerV3 implements IController<Usuario, Integer> {
    @Autowired
    private IUsuarioRepository usuarioRepository;


    @Override
    @PostMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> add(Usuario usuario) {
        return ResponseEntity.ok(usuarioRepository.save(usuario));
    }

    @Override
    public ResponseEntity<?> update(Integer id, Usuario usuario) {
        return ResponseEntity.ok(usuarioRepository.save(usuario));
    }

    @Override
    @GetMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<List<Usuario>> getAll() {
        return ResponseEntity.ok(usuarioRepository.findAll());
    }

    @GetMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    @Override
    public ResponseEntity<Usuario> getById(Integer id) {
        Usuario usuario = usuarioRepository.findById(id).orElse(null);
        return ResponseEntity.ok(usuario);
    }

    @Override
    @DeleteMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> delete(Integer id) {
        usuarioRepository.deleteUsuarioById(id);
        return ResponseEntity.noContent().build();
    }
}
