package es.iespuertodelacruz.nla.user.infrastructure.adapters.primary;

import es.iespuertodelacruz.nla.user.domain.port.primary.IUserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin
@RequestMapping("/api/products")
public class UserRESTController {


    @Autowired
    private IUserService service;

    @GetMapping
    public ResponseEntity<?> getAll() {
        return ResponseEntity.ok().body(service.findAll());
    }
}