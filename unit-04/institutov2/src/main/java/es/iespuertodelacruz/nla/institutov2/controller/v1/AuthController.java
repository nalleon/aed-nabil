package es.iespuertodelacruz.nla.institutov2.controller.v1;

import es.iespuertodelacruz.nla.institutov2.dto.UsuarioDTOV2V3;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioLoginDTO;
import es.iespuertodelacruz.nla.institutov2.dto.UsuarioRegisterDTO;
import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import es.iespuertodelacruz.nla.institutov2.security.AuthService;
import es.iespuertodelacruz.nla.institutov2.security.JwtService;
import es.iespuertodelacruz.nla.institutov2.services.MailService;
import es.iespuertodelacruz.nla.institutov2.services.UsuarioService;
import es.iespuertodelacruz.nla.institutov2.utils.ApiResponse;
import es.iespuertodelacruz.nla.institutov2.utils.Globals;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;

import java.util.Map;
import java.util.UUID;
import java.util.logging.Logger;

@RestController
@RequestMapping("/instituto/api")
@CrossOrigin
public class AuthController {

    /**
     * Properties
     */
    @Autowired
    private UsuarioService service;
    @Autowired
    private MailService mailService;

    @Autowired
    private JwtService jwtService;

    @Autowired
    private AuthService authService;

    Logger logger = Logger.getLogger(Globals.LOGGER_AUTH);



    /**
     * Funcion para hacer login
     * @param loginDTO usuario pàra hacerlo
     * @return el token si todo va bien, RunTimeException si no
     */
    @PostMapping("/login")
    public String login(@RequestBody UsuarioLoginDTO loginDTO ) {
        String token = authService.authenticate(loginDTO.nombre(), loginDTO.password());

        if (token == null) {
            logger.info("Credenciales invalidas");
            throw new RuntimeException("Credenciales inválidas");
        }

        logger.info("Logeo exitosos");
        return token;
    }

    /**
     * Funcion para registrarse
     * @param registerDTO usuario para hacerlo
     * @return mensaje de que el correo de verificacion llegará
     */
    @PostMapping("/register")
    public ResponseEntity<?> register(@RequestBody UsuarioRegisterDTO registerDTO ) {

        authService.register(registerDTO.nombre(), registerDTO.password(), registerDTO.correo());

        Usuario usuario = service.findByCorreo(registerDTO.correo());

        String authToken = usuario.getToken_verificacion();

        String confirmationUrl =
                "http://localhost:8080/instituto/api/confirmation?correo=" + registerDTO.correo() + "&token=" + authToken;

        String[] senders = {registerDTO.correo()};
        mailService.send(senders, "Confirmacion de usuario", confirmationUrl);

        return ResponseEntity.status(HttpStatus.CREATED)
                .body(new ApiResponse<>(201, "En breves momentos, le llegara un correo de verificacion",
                        null));}

    /**
     * Funcion para confirmar y validar un usuario a traves de su correo electronico
     * @param correo del usuario
     * @param token del usuario
     */
    @GetMapping("/confirmation")
    public ResponseEntity<?> confirmation (@RequestParam String correo, @RequestParam String token){
        Usuario authUsuario = service.findByCorreo(correo);

        if(authUsuario != null) {
            String tokenDB = authUsuario.getToken_verificacion();

            if(tokenDB != null && tokenDB.equals(token)) {
                authUsuario.setVerificado(1);
                service.save(authUsuario);
                logger.info("Cuenta verificada");

                return ResponseEntity.ok("Cuenta verificada.");
            } else {
                logger.info("Token de verificacion invalido.");
                return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Token de verificacion invalido.");
            }
        } else {
            logger.info("Usuario no encontrado.");
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Usuario no encontrado.");
        }
    }
}
