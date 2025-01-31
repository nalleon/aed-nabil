package es.iespuertodelacruz.nla.institutov2.security;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import es.iespuertodelacruz.nla.institutov2.services.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.Date;
import java.util.UUID;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

@Service
public class AuthService {
    @Autowired
    private UsuarioService service;

    @Autowired
    private JwtService jwtService;

    @Autowired
    private PasswordEncoder passwordEncoder;


    /**
     * Función para registrar un nuevo usuario
     * @param username del usuario (DNI)
     * @param password del usuario
     * @param email del usuario
     * @return el token si el registro fue exitoso
     */
    public boolean register(String username, String password, String email) {
        Usuario usuario = new Usuario();
        usuario.setNombre(username);
        usuario.setPassword(passwordEncoder.encode(password));
        usuario.setCorreo(email);
        usuario.setFecha_creacion(new Date());
        usuario.setRol("ROLE_USER");
        usuario.setToken_verificacion(UUID.randomUUID().toString());
        usuario.setVerificado(0);

        Usuario saved = service.save(usuario);
        return saved != null;
    }

    /**
     * Funcion para autenticar un usuario de cara al login
     * @param username del usuario
     * @param password del usuario
     * @return token si la autenticacion fue exitosa, null si algo fue mal
     */
    public String authenticate(String username, String password)  {
        String generateToken = null;
        Usuario usuario = service.findByNombre(username);

        if (usuario != null) {
            if (passwordEncoder.matches(password, usuario.getPassword())) {
                generateToken = jwtService.generateToken(usuario.getNombre(), usuario.getRol(), usuario.getVerificado());
            }
        }

        return generateToken;
    }
}
