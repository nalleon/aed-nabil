package es.iespuertodelacruz.nla.institutov2.controller;

import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import es.iespuertodelacruz.nla.institutov2.security.AuthService;
import es.iespuertodelacruz.nla.institutov2.services.MailService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/instituto/api")
public class AuthController {

    @Autowired
    private IUsuarioRepository usuarioRepository;


    @Autowired
    private MailService mailService;

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


        String senders[] = {"ccpprr@gmail.com"};
        mailService.send(senders, "usuario creado", token);
        //return ResponseEntity.ok(token);
        return token;

    }
}
