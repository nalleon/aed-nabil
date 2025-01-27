package es.iespuertodelacruz.nla.institutov2.controller;

import java.util.List;

import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin
@RequestMapping("/api/v3/usuarios")
public class UsuarioControllerV3 {
    @Autowired
    private IUsuarioRepository usuarioRepository;

    @GetMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public List<Usuario> listarUsuarios() {
        return usuarioRepository.findAll();
    }

    @PostMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public Usuario crearUsuario(@RequestBody Usuario usuario) {
        return usuarioRepository.save(usuario);
    }

    @DeleteMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> eliminarUsuario(@PathVariable String id) {
        usuarioRepository.deleteById(id);
        return ResponseEntity.noContent().build();
    }
}
