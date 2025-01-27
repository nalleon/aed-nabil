package es.iespuertodelacruz.nla.institutov2.service;

import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Matricula;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
import es.iespuertodelacruz.nla.institutov2.services.AsignaturaService;
import es.iespuertodelacruz.nla.institutov2.services.MatriculaService;
import es.iespuertodelacruz.nla.institutov2.utils.TestUtilities;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.jdbc.Sql;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

@SpringBootTest
@ActiveProfiles("test")
@Sql("/institutotest.sql")
public class MatriculaServiceTest extends TestUtilities {


    @Autowired
    MatriculaService service;

    @Autowired
    AlumnoService alumnoService;
    @Autowired
    AsignaturaService asignaturaService;

    @Test
    void getAllTest() {
        List<Matricula> list = service.findAll();
        Assertions.assertNotNull(list, MESSAGE_ERROR);
        Assertions.assertEquals(1, list.size(), MESSAGE_ERROR);
    }

    @Test
    void getOneTest() {
        Assertions.assertNotNull(service.findById(1), MESSAGE_ERROR);
    }

    @Test
    void addTest() {

        Matricula itemToAdd = new Matricula();

        itemToAdd.setAlumno(alumnoService.findById("12345678Z"));
        itemToAdd.setAsignaturas(asignaturaService.findAll());
        itemToAdd.setYear(2023);
        Matricula dbItem = service.save(itemToAdd);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getAsignaturas(), dbItem.getAsignaturas(), MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getAlumno(), dbItem.getAlumno(), MESSAGE_ERROR);
        Assertions.assertEquals(itemToAdd.getYear(), dbItem.getYear(), MESSAGE_ERROR);
    }

    @Test
    void updateTest() {

        Matricula dbItem = service.findById(1);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);

        Matricula itemToUpdate = new Matricula();
        itemToUpdate.setId(dbItem.getId());
        itemToUpdate.setAlumno(alumnoService.findById("87654321X"));
        itemToUpdate.setAsignaturas(asignaturaService.findAll());
        itemToUpdate.setYear(2025);

        boolean dbUpdatedItem = service.update(itemToUpdate);

        System.out.println(dbUpdatedItem);
        //Assertions.assertTrue(dbUpdatedItem, MESSAGE_ERROR);
    }



    @Test
    void deleteTest() {
        Matricula itemToAdd = new Matricula();

        itemToAdd.setAlumno(alumnoService.findById("87654321X"));
        itemToAdd.setAsignaturas(asignaturaService.findAll());
        itemToAdd.setYear(2023);
        Matricula dbItem = service.save(itemToAdd);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);

        Assertions.assertNotNull(dbItem, MESSAGE_ERROR);
        Assertions.assertTrue(service.delete(dbItem.getId()), MESSAGE_ERROR);
    }
}
