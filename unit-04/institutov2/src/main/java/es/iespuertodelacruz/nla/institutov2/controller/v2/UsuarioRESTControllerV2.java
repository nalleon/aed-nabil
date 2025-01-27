package es.iespuertodelacruz.nla.institutov2.controller.v2;

import java.util.List;
import java.util.stream.Collectors;

import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v2/usuarios")
public class UsuarioRESTControllerV2 {

    @Autowired
    private IUsuarioRepository usuarioRepository;

    @GetMapping

    public List<Usuario> listarUsuarios() {
        Object principal = SecurityContextHolder.getContext().getAuthentication().getPrincipal();
        String nombreAutenticado = ((UserDetails)principal).getUsername();

        List<Usuario> all = usuarioRepository.findAll();
        return all.stream()
                .filter(u-> u.getNombre().equals(nombreAutenticado) )
                .collect(Collectors.toList());
    }
}
