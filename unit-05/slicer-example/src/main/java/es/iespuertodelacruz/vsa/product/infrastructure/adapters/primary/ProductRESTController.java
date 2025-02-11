package es.iespuertodelacruz.vsa.product.infrastructure.adapters.primary;

import es.iespuertodelacruz.vsa.product.domain.port.primary.IProductService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin
@RequestMapping("/api/products")
public class ProductRESTController {


    @Autowired
    private IProductService service;

    @GetMapping
    public ResponseEntity<?> getAll() {
        return ResponseEntity.ok().body(service.findAll());
    }
}