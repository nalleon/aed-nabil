package es.iespuertodelacruz.nla.institutov2.controller;

import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import es.iespuertodelacruz.nla.institutov2.security.AuthService;
import es.iespuertodelacruz.nla.institutov2.security.JwtService;
import es.iespuertodelacruz.nla.institutov2.services.MailService;
import es.iespuertodelacruz.nla.institutov2.services.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;

import java.util.Map;

@RestController
@RequestMapping("/instituto/api")
@CrossOrigin
public class AuthController {

    @Autowired
    private UsuarioService service;


    @Autowired
    private MailService mailService;

    @Autowired
    private JwtService jwtService;

    @Autowired
    private AuthService authService;

    static class UsuarioLogin{
        public UsuarioLogin() {}
        public String nombre;
        public String password;
        public String getPassword() {
            return password;
        }
        public void setPassword(String password) {
            this.password = password;
        }
        public String getNombre() {
            return nombre;
        }
        public void setNombre(String nombre) {
            this.nombre = nombre;
        }
    }

    @PostMapping("/login")
    public String login(@RequestBody UsuarioLogin u ) {
        //return "recibe: "+u.nombre + " "+ u.password;
        String token = authService.authenticate(u.getNombre(), u.getPassword());


        if ( token == null ) {
            throw new RuntimeException("Credenciales inválidas");
        }
        return token;

    }



    static class UsuarioRegister{
        public UsuarioRegister() {}
        public String nombre;
        public String password;
        public String correo;
        public String getPassword() {
            return password;
        }
        public void setPassword(String password) {
            this.password = password;
        }
        public String getNombre() {
            return nombre;
        }
        public void setNombre(String nombre) {
            this.nombre = nombre;
        }
        public String getCorreo() {
            return correo;
        }
        public void setCorreo(String correo) {
            this.correo = correo;
        }
    }




    @PostMapping("/register")
    public String register(@RequestBody UsuarioRegister u ) {
        //return "recibe: "+u.nombre + " "+ u.password;
        String token = authService.register(u.getNombre(), u.getPassword(), u.getCorreo());

        if(token != null){
            Usuario user = service.findByCorreo(u.correo);
            user.setToken_verificacion(token);
            service.save(user);
        }

        String confirmationUrl =
                "http://localhost:8080/instituto/api/confirmation?username=" + u.getNombre() + "&token=" + token;

        String senders[] = {u.getCorreo()};
        mailService.send(senders, "Confirmacion de usuario", confirmationUrl);

        return "En breves momentos, le llegara un correo de verificacion";
    }

    @GetMapping("/confirmation")
    public ResponseEntity<?> confirmation (@RequestParam String username, @RequestParam String token){

        Usuario authUsuario = service.findByNombre(username);

        if(authUsuario != null) {
            String tokenAlmacenado = authUsuario.getToken_verificacion();

            System.out.println(tokenAlmacenado);
            System.out.println(token);
            if(tokenAlmacenado != null && tokenAlmacenado.equals(token)) {
                authUsuario.setVerificado(1);
                service.save(authUsuario);
                return ResponseEntity.ok("Cuenta creada.");
            } else {
                return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Token de verificacion invalido.");
            }
        } else {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Usuario no encontrado.");
        }
    }
}
