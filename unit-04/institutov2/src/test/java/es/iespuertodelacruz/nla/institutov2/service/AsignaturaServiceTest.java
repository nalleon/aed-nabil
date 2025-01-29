package es.iespuertodelacruz.nla.institutov2.service;

import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.services.AsignaturaService;
import es.iespuertodelacruz.nla.institutov2.utils.TestUtilities;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.jdbc.Sql;
import org.springframework.test.context.junit.jupiter.SpringExtension;

import java.util.ArrayList;

import java.util.List;

@SpringBootTest
@ExtendWith(SpringExtension.class)
@ActiveProfiles("test")
@Sql("/institutotest.sql")
public class AsignaturaServiceTest extends TestUtilities {


    @Autowired
    AsignaturaService service;


    @Test
    void getAllTest() {
        List<Asignatura> list = service.findAll();
        Assertions.assertNotNull(list, MESSAGE_ERROR);
        Assertions.assertEquals(10, list.size(), MESSAGE_ERROR);
    }

    @Test
    void getOneTest() {
        Assertions.assertNotNull(service.findById(1), MESSAGE_ERROR);
    }

    @Test
    void getOneByNameYearTest() {
        Assertions.assertNotNull(service.findByNombreCurso("BAE", "1º DAM"), MESSAGE_ERROR);
    }


    @Test
    void addTest() {
        Asignatura itemToAdd = new Asignatura();
        itemToAdd.setNombre("testNombre");
        itemToAdd.setMatriculas(new ArrayList<>());
        itemToAdd.setCurso("cursoTest");

        Asignatura dbItem = service.save(itemToAdd);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getNombre(), dbItem.getNombre(), MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getCurso(), dbItem.getCurso(), MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getMatriculas(), dbItem.getMatriculas(), MESSAGE_ERROR);
    }

    @Test
    void updateTest() {
        Asignatura itemToAdd = new Asignatura();
        itemToAdd.setNombre("testNombre");
        itemToAdd.setMatriculas(new ArrayList<>());
        itemToAdd.setCurso("cursoTest");

        Asignatura dbItem = service.save(itemToAdd);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);

        Asignatura itemToUpdate = new Asignatura();
        itemToUpdate.setId(dbItem.getId());
        itemToAdd.setNombre("testNombreUpdate");
        itemToAdd.setMatriculas(new ArrayList<>());
        itemToAdd.setCurso("cursoTestUpdate");

        boolean dbUpdatedItem = service.update(itemToUpdate);

        Assertions.assertTrue(dbUpdatedItem, MESSAGE_ERROR);
    }



    @Test
    void deleteTest() {
        Asignatura itemToAdd = new Asignatura();
        itemToAdd.setNombre("testNombre");
        itemToAdd.setMatriculas(new ArrayList<>());
        itemToAdd.setCurso("cursoTest");

        Asignatura dbItem = service.save(itemToAdd);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);
        Assertions.assertTrue(service.delete(dbItem.getId()), MESSAGE_ERROR);
    }
}
