package es.iespuertodelacruz.jc.apiprueba202425.controllers;

import java.util.List;
import java.util.UUID;

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

import es.iespuertodelacruz.jc.apiprueba202425.dto.UsuarioDTO;
import es.iespuertodelacruz.jc.apiprueba202425.entities.Usuario;
import es.iespuertodelacruz.jc.apiprueba202425.mappers.UsuarioMapper;
import es.iespuertodelacruz.jc.apiprueba202425.repositories.UsuarioRepository;

@RestController
@RequestMapping("/api/v1/usuarios")
public class UsuarioControllerV1 {

    @Autowired
    private UsuarioRepository usuarioRepository;


  
    
    
    
    @GetMapping
    //@PreAuthorize("hasRole('ROLE_ADMIN')")
    public ResponseEntity<?> listarUsuarios() {
    	
    	List<Usuario> findAll = usuarioRepository.findAll();
    	
    	List<UsuarioDTO> allDTO = UsuarioMapper.INSTANCE.toDTOList(findAll);
        return ResponseEntity.ok(allDTO);
    }

    @PostMapping
    public Usuario crearUsuario(@RequestBody UsuarioDTO dto) {
        Usuario u = new Usuario();
        u.setCorreo(dto.correo());
        u.setFechaCreacion(dto.fechaCreacion().getTime());
        u.setNombre(dto.nombre());
        u.setPassword(dto.password());
        u.setRol("ROLE_USER");
        String tokenDeVerificacion = UUID.randomUUID().toString();
        u.setTokenVerificacion(tokenDeVerificacion);
    	return usuarioRepository.save(u);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<?> eliminarUsuario(@PathVariable Integer id) {
        usuarioRepository.deleteById(id);
        return ResponseEntity.noContent().build();
    }
}