package es.iespuertodelacruz.nla.institutov2.service;

import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.services.UsuarioService;
import es.iespuertodelacruz.nla.institutov2.utils.TestUtilities;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.jdbc.Sql;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.UUID;

@SpringBootTest
@ActiveProfiles("test")
@Sql("/institutotest.sql")

public class UsuarioServiceTest extends TestUtilities {
    @Autowired
    UsuarioService service;


    @Autowired
    private PasswordEncoder passwordEncoder;


    @Test
    void getAllTest() {
        List<Usuario> list = service.findAll();
        Assertions.assertNotNull(list, MESSAGE_ERROR);
        Assertions.assertEquals(1, list.size(), MESSAGE_ERROR);
    }

    @Test
    void getOneTest() {
        Assertions.assertNotNull(service.findById(1), MESSAGE_ERROR);
    }

    @Test
    void getOneByNameYearTest() {
        Assertions.assertNotNull(service.findByNombre("root"), MESSAGE_ERROR);
    }

    @Test
    void getOneByEmailTest() {
        Assertions.assertNotNull(service.findByCorreo("admin@gmail.com"), MESSAGE_ERROR);
    }


    @Test
    void addTest() {
        Usuario itemToAdd = new Usuario();
        itemToAdd.setNombre("testNombre");
        itemToAdd.setPassword(passwordEncoder.encode("password"));
        itemToAdd.setCorreo("test@gmail.com");
        itemToAdd.setFecha_creacion(new Date());
        itemToAdd.setRol("ROLE_USER");
        itemToAdd.setToken_verificacion(UUID.randomUUID().toString());
        itemToAdd.setVerificado(0);

        Usuario dbItem = service.save(itemToAdd);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getNombre(), dbItem.getNombre(), MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getCorreo(), dbItem.getCorreo(), MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getPassword(), dbItem.getPassword(), MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getToken_verificacion(), dbItem.getToken_verificacion(), MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getFecha_creacion(), dbItem.getFecha_creacion(), MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getRol(), dbItem.getRol(), MESSAGE_ERROR);
    }

    @Test
    void updateTest() {
        Usuario itemToAdd = new Usuario();
        itemToAdd.setNombre("testNombre");
        itemToAdd.setPassword(passwordEncoder.encode("password"));
        itemToAdd.setCorreo("test@gmail.com");
        itemToAdd.setFecha_creacion(new Date());
        itemToAdd.setRol("ROLE_USER");
        itemToAdd.setToken_verificacion(UUID.randomUUID().toString());
        itemToAdd.setVerificado(0);

        Usuario dbItem = service.save(itemToAdd);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);

        Usuario itemToUpdate = new Usuario();
        itemToUpdate = dbItem;
        itemToAdd.setCorreo("test@gmail.com");
        itemToAdd.setPassword(passwordEncoder.encode("passwordUpdate"));

        boolean dbUpdatedItem = service.update(itemToUpdate);

        Assertions.assertTrue(dbUpdatedItem, MESSAGE_ERROR);
    }



    @Test
    void deleteTest() {
        Usuario itemToAdd = new Usuario();
        itemToAdd.setNombre("testNombre");
        itemToAdd.setPassword(passwordEncoder.encode("password"));
        itemToAdd.setCorreo("test@gmail.com");
        itemToAdd.setFecha_creacion(new Date());
        itemToAdd.setRol("ROLE_USER");
        itemToAdd.setToken_verificacion(UUID.randomUUID().toString());
        itemToAdd.setVerificado(0);

        Usuario dbItem = service.save(itemToAdd);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);
        Assertions.assertTrue(service.delete(dbItem.getId()), MESSAGE_ERROR);
    }
}
