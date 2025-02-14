package es.iespuertodelacruz.nla.user.infrastructure.adapters.primary;

import es.iespuertodelacruz.nla.shared.config.MailService;
import es.iespuertodelacruz.nla.shared.security.AuthService;
import es.iespuertodelacruz.nla.shared.security.JwtService;
import es.iespuertodelacruz.nla.shared.utils.ApiResponse;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.primary.IUserService;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.primary.dto.UserLoginDTO;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.primary.dto.UserRegisterDTO;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@CrossOrigin
@RequestMapping("/api/v1/auth")
public class AuthRESTController {
    /**
     * Properties
     */
    @Autowired
    private IUserService service;
    @Autowired
    private MailService mailService;

    @Autowired
    private AuthService authService;


    /**
     * Funcion para hacer login
     * @param loginDTO usuario pàra hacerlo
     * @return el token si todo va bien, RunTimeException si no
     */
    @PostMapping("/login")
    public String login(@RequestBody UserLoginDTO loginDTO ) {
        String token = authService.authenticate(loginDTO.name(), loginDTO.password());

        if (token == null) {
            throw new RuntimeException("Credenciales inválidas");
        }

        return token;
    }

    /**
     * Funcion para registrarse
     * @param registerDTO usuario para hacerlo
     * @return mensaje de que el correo de verificacion llegará
     */
    @PostMapping("/register")
    public ResponseEntity<?> register(@RequestBody UserRegisterDTO registerDTO ) {

        authService.register(registerDTO.name(), registerDTO.password(), registerDTO.email());

        User user = service.findByEmail(registerDTO.email());

        String authToken = user.getVerificationToken();

        String confirmationUrl =
                "http://localhost:8080/api/v1/auth/confirmation?email=" + registerDTO.email() + "&token=" + authToken;

        String[] senders = {registerDTO.email()};
        mailService.send(senders, "Confirmacion de usuario", confirmationUrl);

        return ResponseEntity.status(HttpStatus.CREATED)
                .body(new ApiResponse<>(201, "En breves momentos, le llegara un correo de verificacion",
                        null));}

    /**
     * Funcion para confirmar y validar un usuario a traves de su correo electronico
     * @param email del usuario
     * @param token del usuario
     */
    @GetMapping("/confirmation")
    public ResponseEntity<?> confirmation (@RequestParam String email, @RequestParam String token){
        User authUser = service.findByEmail(email);

        if(authUser != null) {
            String tokenDB = authUser.getVerificationToken();

            if(tokenDB != null && tokenDB.equals(token)) {
                authUser.setVerified(1);
                service.updateVerify(authUser.getName(), authUser.getEmail(), authUser.getPassword(),
                        authUser.getVerified());

                return ResponseEntity.ok("Cuenta verificada.");
            } else {
                return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Token de verificacion invalido.");
            }
        } else {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Usuario no encontrado.");
        }
    }
}
