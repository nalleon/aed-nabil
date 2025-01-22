package es.iespuertodelacruz.jc.apiprueba202425.controllers;

import java.util.List;

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

import es.iespuertodelacruz.jc.apiprueba202425.entities.Usuario;
import es.iespuertodelacruz.jc.apiprueba202425.repositories.UsuarioRepository;

@RestController
@CrossOrigin
@RequestMapping("/api/v3/usuarios")
public class UsuarioControllerV3 {

    @Autowired
    private UsuarioRepository usuarioRepository;


    
    
    
    
    @GetMapping
    //@PreAuthorize("hasRole('ROLE_ADMIN')")
    public List<Usuario> listarUsuarios() {
        return usuarioRepository.findAll();
    }

    @PostMapping
    public Usuario crearUsuario(@RequestBody Usuario usuario) {
        return usuarioRepository.save(usuario);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<?> eliminarUsuario(@PathVariable Integer id) {
        usuarioRepository.deleteById(id);
        return ResponseEntity.noContent().build();
    }
}