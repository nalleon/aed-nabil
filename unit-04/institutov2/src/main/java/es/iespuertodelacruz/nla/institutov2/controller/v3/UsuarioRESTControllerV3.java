package es.iespuertodelacruz.nla.institutov2.controller.v3;

import java.util.List;
import java.util.stream.Collectors;

import es.iespuertodelacruz.nla.institutov2.controller.interfaces.IControllerV3;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioDTOV2V3;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.services.UsuarioService;
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
public class UsuarioRESTControllerV3 implements IControllerV3<UsuarioDTOV2V3, Integer> {
    @Autowired
    private UsuarioService service;


    @Override
    @PostMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> add(UsuarioDTOV2V3 dto) {
        if(dto == null){
            return ResponseEntity.badRequest().body("Usuario null");
        }

        Usuario aux = new Usuario();
        aux.setNombre(dto.nombre());
        //aux.setPassword(dto.);
        aux.setCorreo(dto.correo());

        return ResponseEntity.ok(service.save(aux));
    }

    @Override
    public ResponseEntity<?> update(Integer id, UsuarioDTOV2V3 dto) {
        if(dto == null){
            return ResponseEntity.badRequest().body("Usuario null");
        }

        Usuario aux = new Usuario();
        aux.setNombre(dto.nombre());
        //aux.setPassword(dto.);
        aux.setCorreo(dto.correo());

        return ResponseEntity.ok(service.update(aux));
    }

    @Override
    @GetMapping
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<List<UsuarioDTOV2V3>> getAll() {
        return ResponseEntity.ok(service.findAll().stream().map(usuario ->
                new UsuarioDTOV2V3(usuario.getNombre(), usuario.getCorreo())).collect(Collectors.toList()));
    }

    @GetMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    @Override
    public ResponseEntity<UsuarioDTOV2V3> getById(Integer id) {
        Usuario aux = service.findById(id);
        if (aux != null){
            UsuarioDTOV2V3 dto =  new UsuarioDTOV2V3(aux.getNombre(), aux.getCorreo());
            return ResponseEntity.ok(dto);
        }

        return ResponseEntity.notFound().build();
    }

    @Override
    @DeleteMapping("/{id}")
    @PreAuthorize("hasRol('ROLE_ADMIN')")
    public ResponseEntity<?> delete(Integer id) {
        service.delete(id);
        return ResponseEntity.noContent().build();
    }
}
